// Helpers
import './advance-reommendation-helper.js';
import { callPerplexityAdvance } from '../partials/openAiControler.js';
import { parseAiJson } from '@scripts/partials/textFormatingControler.js';
import { getLoggedInUsername } from '@scripts/profile/profile-main.js';
import { saveMovieRecommendation } from '@scripts/pages/anketa.js';
import { tmdbCallHandler, tmdbAllMoviesHandler } from '../partials/tmdbControler.js'
import { poplateResult, populateMultipleResults } from '@scripts/helpers/recommendation-results-helper.js';
import { scrolToTop } from '@scripts/helpers/scrool-to-top-helper.js';

// swifti slider
// import Swiffy Slider JS
import { swiffyslider } from 'swiffy-slider'
window.swiffyslider = swiffyslider;
import "swiffy-slider/css"


// Advance Search Prompt
const submitAdvanceRecommendation = document.getElementById('start_recommendation');
let advanceRecommendationQuestionHolder = document.querySelector('.advance-recommendation-questionnaire');
let advanceRecommendationResultHolder = document.querySelector('.advance-recommendation-result');
let advanceRecommendationResultLoading = document.getElementById('loading');
let advanceRecommendationResultContent = document.getElementById('results');
let swipeAnimation = document.querySelector('.swipe-animation'); 

submitAdvanceRecommendation.addEventListener('click', async () => {
  newAdvanceRecomendationHandler()
  scrolToTop();
});

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

      if (window.innerWidth < 1024) {
        swipeAnimation.style.display = 'block';
      }

      setTimeout(() => {
        window.swiffyslider.init(); // re-initialize Swiffy Slider
      }, 0);
    }, 1000)
  }  

  setTimeout(()=> {
    swipeAnimation.style.display = 'none';
  }, 4000)

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
  return finalPrompt;
}

// perplexity advance recommendation end
// function generateAdvancePrompt() {
//   const questions = document.querySelectorAll('.advance-question-holder');
//   let criteria = {};
//   let promptParts = [];

//   questions.forEach((question) => {
//     const questionTitle = question.querySelector('.advance-question-content')?.textContent.trim();
//     if (!questionTitle) return;

//     const checkedInputs = question.querySelectorAll('input[type="checkbox"]:checked');
//     const textInputs = question.querySelectorAll('input[type="text"]');

//     // For checkbox: collect text answers or default to NIJE BITNO
//     if (checkedInputs.length === 0 && textInputs.length === 0) {
//       criteria[questionTitle] = "NIJE BITNO";
//     } else if (checkedInputs.length > 0) {
//       const answers = Array.from(checkedInputs).map(input => {
//         const label = question.querySelector(`label[for="${input.id}"]`);
//         return label ? label.textContent.trim().toUpperCase() : input.value.toUpperCase();
//       });
//       criteria[questionTitle] = answers.join(', ');
//     }

//     // For text inputs like "similar movies" append separately
//     textInputs.forEach(input => {
//       if (input.value.trim()) {
//         promptParts.push(`Similar movies input: ${input.value.trim()}`);
//       }
//     });
//   });

//   // Transform criteria object into prompt lines
//   for (const [question, answer] of Object.entries(criteria)) {
//     promptParts.push(`Question: ${question}\nSelected Answer: ${answer}\n`);
//   }

//   // Handle global inputs (similar movies, do not recommend, togglers)
//   const similarFilmsSelected = document.getElementById('similar_films_selected');
//   const doNotRecommendWatched = document.getElementById('do_not_recommend_watched');
//   const doNotRecommendRecommended = document.getElementById('do_not_recommend_recommended');
//   const alreadyWatchedToggler = document.getElementById('already_watched_toggler');
//   const alreadyRecommendedToggler = document.getElementById('already_recommended_toggler');

//   if (similarFilmsSelected && similarFilmsSelected.value.trim()) {
//     const selectedMovies = similarFilmsSelected.value.split(',').map(m => m.trim()).filter(Boolean);
//     if (selectedMovies.length) {
//       promptParts.push(`Question: Similar movies selected\nSelected Answer: ${selectedMovies.join(', ')}\n`);
//     }
//   }

//   if (doNotRecommendWatched && alreadyWatchedToggler && !alreadyWatchedToggler.checked) {
//     const movies = doNotRecommendWatched.value.split(',').map(m => m.trim()).filter(Boolean);
//     if (movies.length) {
//       promptParts.push(`Do NOT recommend these watched movies:\n${movies.join(', ')}\n`);
//     }
//   }

//   if (doNotRecommendRecommended && alreadyRecommendedToggler && !alreadyRecommendedToggler.checked) {
//     const movies = doNotRecommendRecommended.value.split(',').map(m => m.trim()).filter(Boolean);
//     if (movies.length) {
//       promptParts.push(`Do NOT recommend already recommended movies:\n${movies.join(', ')}\n`);
//     }
//   }

//   const advancedPromptData = promptParts.join('\n');

//   // Construct final prompt with clear strict rules including do-not-recommend instructions
//   const finalPrompt = `
// You are the best movie recommendation engine in the world. Strictly follow these rules:

// 1. ALWAYS RETURN EXACTLY 3 MOVIES in a single JSON array.
// 2. Format:
// [
//   {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"},
//   {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"},
//   {"movie_title": "[Full Movie Title]", "movie_year": "[Release Year]"}
// ]
// 3. NEVER include explanations, comments, or markdown in the output.
// 4. DO NOT recommend movies from "Do NOT recommend watched" or "Do NOT recommend already recommended" lists.
// 5. ALWAYS include movies from "Similar movies selected" list if applicable.
// 6. Prioritize by user criteria match, TMDB popularity >= 6, IMDb rating >= 5.6, and release recency.
// 7. No null or empty values; always capitalize movie titles correctly.

// User Criteria Analysis (Advanced):
// ${advancedPromptData}

// PROCESSING STEPS:
// 1. Analyze user criteria with NLP.
// 2. Cross-reference TMDB & IMDb databases.
// 3. Apply content filtering based on criteria.
// 4. Use collaborative filtering with user context.
// 5. Ensure compliance with age ratings.
// 6. Rank movies on match strength, popularity, and recency.

// REQUIRED OUTPUT EXAMPLE:
// [
//   {"movie_title": "Full Movie Title", "movie_year": "Release Year"},
//   {"movie_title": "Full Movie Title", "movie_year": "Release Year"},
//   {"movie_title": "Full Movie Title", "movie_year": "Release Year"}
// ]

// STRICT RULES:
// - Exactly 3 entries
// - Valid JSON array
// - No markdown formatting
// - No null or empty values
// - Always capitalize titles properly
// `;

//   // For debugging:
//   console.log(finalPrompt);

//   return finalPrompt;
// }

// Deepseek   advance recommendation end}
// function generateAdvancePrompt() {
//   const questions = document.querySelectorAll('.advance-question-holder');
  
//   // Build structured preferences object
//   const preferences = {};
//   const questionToKey = {
//     "Iz koje zemlje ili regiona želiš da bude film?": "country",
//     "Koji žanr filma preferiraš?": "genre",
//     "Kakav ton i atmosferu filma želiš?": "tone",
//     "Koji tempo radnje želiš da film ima?": "pace",
//     "U kojem vremenskom periodu ili okruženju želiš da se odvija film?": "setting",
//     "Koliko složenu priču želiš?": "story_complexity",
//     "Šta ti je važnije u filmu?": "focus",
//     "Da li te zanima neki specifičan potžanr ili tema?": "subgenre",
//     "Koje trajanje filma preferiraš?": "duration",
//     "Koji stil filma preferiraš?": "style",
//     "Koju emociju bi voleo/la da ti film prenese?": "emotion",
//     "Koliko ti je važno da film ima visoke VFX i raskošnu scenografiju?": "vfx",
//     "Kako voliš da se film završi?": "ending",
//     "Da li ti je važno da su u filmu poznati glumci ili reditelj?": "famous_cast",
//     "Da li želiš da film bude poznat?": "popularity",
//     "Koji tip filma preferiraš?": "format"
//   };

//   questions.forEach((question) => {
//     const questionTitle = question.querySelector('.advance-question-content')?.textContent.trim();
//     if (!questionTitle || !questionToKey[questionTitle]) return;

//     const key = questionToKey[questionTitle];
//     const checkedInputs = question.querySelectorAll('input[type="checkbox"]:checked');
//     const textInputs = question.querySelectorAll('input[type="text"]');

//     // Handle checkbox answers
//     if (checkedInputs.length > 0) {
//       const answers = Array.from(checkedInputs).map(input => {
//         const label = question.querySelector(`label[for="${input.id}"]`);
//         return label ? label.textContent.trim().toUpperCase() : input.value.toUpperCase();
//       });
//       preferences[key] = answers.join(', ');
//     } 
//     // Handle no selection
//     else if (textInputs.length === 0) {
//       preferences[key] = "NIJE BITNO";
//     }
//   });

//   // Handle special inputs
//   const userMessage = {
//     preferences: preferences,
//     similar_to: [],
//     do_not_recommend: {
//       watched: [],
//       already_recommended: []
//     }
//   };

//   // Get DOM elements
//   const similarFilmsSelected = document.getElementById('similar_films_selected');
//   const doNotRecommendWatched = document.getElementById('do_not_recommend_watched');
//   const doNotRecommendRecommended = document.getElementById('do_not_recommend_recommended');
//   const alreadyWatchedToggler = document.getElementById('already_watched_toggler');
//   const alreadyRecommendedToggler = document.getElementById('already_recommended_toggler');

//   // Handle similar films
//   if (similarFilmsSelected && similarFilmsSelected.value.trim()) {
//     userMessage.similar_to = similarFilmsSelected.value.split(',').map(m => m.trim()).filter(Boolean);
//   }

//   // Handle do not recommend watched
//   if (doNotRecommendWatched && alreadyWatchedToggler && !alreadyWatchedToggler.checked) {
//     userMessage.do_not_recommend.watched = doNotRecommendWatched.value.split(',').map(m => m.trim()).filter(Boolean);
//   }

//   // Handle do not recommend already recommended
//   if (doNotRecommendRecommended && alreadyRecommendedToggler && !alreadyRecommendedToggler.checked) {
//     userMessage.do_not_recommend.already_recommended = doNotRecommendRecommended.value.split(',').map(m => m.trim()).filter(Boolean);
//   }

//   // Construct optimized API payload
//   const apiPayload = {
//     "model": "sonar",
//     "messages": [
//       {
//         "role": "system",
//         "content": `You are an expert movie recommendation engine. STRICTLY follow these rules:

// 1. ALWAYS return EXACTLY 3 movie recommendations in valid JSON array format
// 2. NEVER recommend movies from the "do_not_recommend" lists
// 3. Format: [{"movie_title": "Full Title", "movie_year": "YYYY"}]
// 4. Prioritize movies that match user criteria + high ratings (TMDB >=6, IMDb >=5.6)
// 5. No explanations, comments, or markdown - ONLY JSON output`
//       },
//       {
//         "role": "user", 
//         "content": `Recommend exactly 3 movies based on these preferences:\n${JSON.stringify(userMessage, null, 2)}\n\nOUTPUT ONLY: Valid JSON array with 3 movies, no other text.`
//       }
//     ],
//     "max_tokens": 500,
//     "temperature": 0.3,
//     "top_p": 0.9
//   };

//   console.log('Optimized API Payload:');
//   console.log(apiPayload);
  
//   return apiPayload;
// }