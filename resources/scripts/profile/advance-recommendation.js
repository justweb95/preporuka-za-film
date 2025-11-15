// Helpers
import './advance-reommendation-helper.js';
import { callPerplexityAdvance } from '../partials/openAiControler.js';
import { parseAiJson } from '@scripts/partials/textFormatingControler.js';
import { getLoggedInUsername } from '@scripts/profile/profile-main.js';
import { saveMovieRecommendation } from '@scripts/pages/anketa.js';
import { tmdbCallHandler, tmdbAllMoviesHandler } from '../partials/tmdbControler.js'
import { poplateResult, populateMultipleResults } from '@scripts/helpers/recommendation-results-helper.js';

// Advance Search Prompt
const submitAdvanceRecommendation = document.getElementById('start_recommendation');
let advanceRecommendationQuestionHolder = document.querySelector('.advance-recommendation-questionnaire');
let advanceRecommendationResultHolder = document.querySelector('.advance-recommendation-result');
let advanceRecommendationResultLoading = document.getElementById('loading');
let advanceRecommendationResultContent = document.getElementById('results');

submitAdvanceRecommendation.addEventListener('click', async () => newAdvanceRecomendationHandler());

async function newAdvanceRecomendationHandler () {
  const loadingArticle = document.getElementById('loading');

  if (loadingArticle) {
    loadingArticle.style.setProperty('display', 'block', 'important');
  }
  
  advanceRecommendationQuestionHolder.hidden = true;
  advanceRecommendationResultContent.hidden = true;
  
  advanceRecommendationResultHolder.hidden = false;
  advanceRecommendationResultLoading.hidden = false;

  const advancePrompot = generateAdvancePrompt();
  const openAiAdvanceResponse = await callPerplexityAdvance(advancePrompot);

  const tmdbResult = await tmdbAllMoviesHandler(parseAiJson(openAiAdvanceResponse.choices[0].message.content));
  console.log(tmdbResult);

  const username = await getLoggedInUsername();
  if (username) {
    const movie_ids = tmdbResult.map(m => m.id).filter(Boolean);
    await saveMovieRecommendation(movie_ids, username);
  }


  
  const populateionDone = await populateMultipleResults(tmdbResult);
  if (populateionDone) {
    
    setTimeout(() => {
      const loadingArticle = document.getElementById('loading');

      if (loadingArticle) {
        loadingArticle.style.setProperty('display', 'none', 'important');
      }

      advanceRecommendationResultContent.hidden = false;
      advanceRecommendationResultLoading.hidden = true;

    }, 1000)
  }  
}

window.newAdvanceRecomendation = newAdvanceRecomendationHandler;


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

    // No selection at all → NIJE BITNO
    if (checkedInputs.length === 0 && textInputs.length === 0) {
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
    }
  });

  // Handle global hidden inputs (outside of questions)
  const similarFilmsSelected = document.getElementById('similar_films_selected');
  const doNotRecommendWatched = document.getElementById('do_not_recommend_watched');
  const doNotRecommendRecommended = document.getElementById('do_not_recommend_recommended');
  
  const alreadyWatchedToggler = document.getElementById('already_watched_toggler');
  const alreadyRecommendedToggler = document.getElementById('already_recommended_toggler');

  // Handle similar films selected (always include if exists)
  if (similarFilmsSelected && similarFilmsSelected.value.trim()) {
    const selectedMovies = similarFilmsSelected.value.split(',').map(m => m.trim()).filter(Boolean);
    if (selectedMovies.length) {
      promptParts.push(`Question: Similar movies selected\nSelected Answer: ${selectedMovies.join(', ')}\n`);
    }
  }

  // Handle do_not_recommend_watched - only if toggler is NOT checked
  if (doNotRecommendWatched && alreadyWatchedToggler && !alreadyWatchedToggler.checked) {
    const movies = doNotRecommendWatched.value.split(',').map(m => m.trim()).filter(Boolean);
    if (movies.length) {
      promptParts.push(`Do NOT recommend these watched movies:\n${movies.join(', ')}\n`);
    }
  }

  // Handle do_not_recommend_recommended - only if toggler is NOT checked
  if (doNotRecommendRecommended && alreadyRecommendedToggler && !alreadyRecommendedToggler.checked) {
    const movies = doNotRecommendRecommended.value.split(',').map(m => m.trim()).filter(Boolean);
    if (movies.length) {
      promptParts.push(`Do NOT recommend already recommended movies:\n${movies.join(', ')}\n`);
    }
  }

  // Join all parts with extra line breaks for readability
  const advancedPromptData = promptParts.join('\n');

  // Construct final ChatGPT prompt
  const finalPrompt = `
    You are the best movie recommendation engine in the world. Strictly follow these rules:

    1. ALWAYS RETURN EXACTLY 3 MOVIES IN A JSON ARRAY.
    2. Format: [
        {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"},
        {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"},
        {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"}
      ]
    3. NEVER add explanations, comments, or markdown.
    4. Prioritize movies based on this hierarchy:
      a) Matches ALL user criteria exactly
      b) High TMDB popularity (>=6)
      c) IMDb rating >= 5.6
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
      {"movie_title": "Full Movie Title", "movie_year": "Release Year"}
    ]

    STRICT RULES:
    - Only 3 entries
    - Valid JSON array
    - No markdown formatting
    - No null or empty values
    - Always capitalize movie titles correctly
    `;

    console.log('finalPrompt');
    console.log(finalPrompt);
    
    return finalPrompt;
}