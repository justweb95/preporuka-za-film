// Helpers
import './advance-reommendation-helper.js';
import { callPerplexityAdvance } from '../partials/openAiControler.js';

// Advance Search Prompt
const submitAdvanceRecommendation = document.getElementById('start_recommendation');
const advanceRecommendationQuestionHolder = document.querySelector('.advance-recommendation-questionnaire');
const advanceRecommendationResultHolder = document.querySelector('.advance-recommendation-result');
const advanceRecommendationResultLoading = document.getElementById('loading');
const advanceRecommendationResultContent = document.getElementById('results');

submitAdvanceRecommendation.addEventListener('click', async () => {
  advanceRecommendationQuestionHolder.hidden = true;
  advanceRecommendationResultContent.hidden = true;
  
  advanceRecommendationResultHolder.hidden = false;
  advanceRecommendationResultLoading.hidden = false;

  const advancePrompot = generateAdvancePrompt();
  const openAiAdvanceResponse = await callPerplexityAdvance(advancePrompot);
  
  if (openAiAdvanceResponse) {
    advanceRecommendationResultContent.hidden = false;
    advanceRecommendationResultLoading.hidden = true;
  }


  // Send `finalPrompt` to your backend or ChatGPT API
  console.log('openAiAdvanceResponse');
  console.log(advancePrompot);
  
});




function generateAdvancePrompt() {
  const questions = document.querySelectorAll('.advance-question-holder');
  let promptParts = [];

  questions.forEach((question) => {
    const questionTitle = question.querySelector('.advance-question-content')?.textContent.trim();
    if (!questionTitle) return;

    // Handle checkbox questions
    const checkedInputs = question.querySelectorAll('input[type="checkbox"]:checked');
    // Handle text inputs for similar movies
    const textInputs = question.querySelectorAll('input[type="text"]');
    // Hidden inputs for autocomplete selected movies
    const hiddenInputs = question.querySelectorAll('input[type="hidden"]');

    // No selection at all → NIJE BITNO
    if (checkedInputs.length === 0 && textInputs.length === 0 && hiddenInputs.length === 0) {
      promptParts.push(`Question: ${questionTitle}\nSelected Answer: NIJE BITNO\n`);
    } else {
      // Checkbox answers
      if (checkedInputs.length > 0) {
        const answers = Array.from(checkedInputs).map(input => {
          const label = question.querySelector(`label[for="${input.id}"]`);
          return label ? label.textContent.trim().toUpperCase() : input.value.toUpperCase();
        });
        promptParts.push(`Question: ${questionTitle}\nSelected Answer: ${answers.join(', ')}\n`);
      }

      // Text inputs (similar movies)
      textInputs.forEach((input) => {
        if (input.value.trim()) {
          promptParts.push(`Question: Similar movies input\nSelected Answer: ${input.value.trim()}\n`);
        }
      });

      // Hidden inputs (autocomplete selected movies)
      hiddenInputs.forEach((input) => {
        if (!input.value.trim()) return;

        // Check if this is the do_not_recommend_movies field
        if (input.id === 'do_not_recommend_movies') {
          // Only include if toggle is OFF
          const toggle = document.getElementById('already_watched_toggler');
          if (toggle && !toggle.checked) {
            const movies = input.value.split(',').map(m => m.trim()).filter(Boolean);
            if (movies.length) {
              promptParts.push(`Do NOT recommend these movies:\n${movies.join(', ')}\n`);
            }
          }
        } else {
          const selectedMovies = input.value.split(',').map(m => m.trim()).filter(Boolean);
          if (selectedMovies.length) {
            promptParts.push(`Question: Similar movies selected\nSelected Answer: ${selectedMovies.join(', ')}\n`);
          }
        }
      });
    }
  });

  // Join all parts with extra line breaks for readability
  const advancedPromptData = promptParts.join('\n');

  // Construct final ChatGPT prompt
  const finalPrompt = `
    You are the best movie recommendation engine in the world. Strictly follow these rules:

    1. ALWAYS RETURN EXACTLY 5 MOVIES IN A JSON ARRAY.
    2. Format: [
        {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"},
        {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"}
      ]
    3. NEVER add explanations, comments, or markdown.
    4. Prioritize movies based on this hierarchy:
      a) Matches 4+ user criteria exactly
      b) High TMDB popularity (>=6)
      c) IMDb rating >=6.0
      d) Recent release year
    5. If needed, include movies matching 3 criteria but with strong secondary indicators.

    User Criteria Analysis (Advanced):
    ${advancedPromptData}

    Processing Steps:
    1. Analyze user criteria using Natural Language Processing (NLP).
    2. Cross-reference potential movies with TMDB and IMDb databases.
    3. Apply content-based filtering using both primary and advanced criteria.
    4. Utilize collaborative filtering considering user context and viewing habits.
    5. Ensure recommendations comply with specified age ratings.
    6. Rank movies based on match strength, popularity, and release recency.

    REQUIRED OUTPUT EXAMPLE:
    [
      {"movie_title": "Full Movie Title", "movie_year": "Release Year"},
      {"movie_title": "Full Movie Title", "movie_year": "Release Year"},
      {"movie_title": "Full Movie Title", "movie_year": "Release Year"},
      {"movie_title": "Full Movie Title", "movie_year": "Release Year"},
      {"movie_title": "Full Movie Title", "movie_year": "Release Year"}
    ]

    STRICT RULES:
    - Only 5 entries
    - Valid JSON array
    - No markdown formatting
    - No null or empty values
    - Always capitalize movie titles correctly
    `;

    return finalPrompt;
}
