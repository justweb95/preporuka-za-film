import { 
  collectProgressItems,
  handleProgressNumber,
  handleProgressCheckbox,
  removeProgressBar,
  removeadvertisementBanner,
  addAdvertisementBanner

} from '@scripts/partials/question-progress';
import { 
  tmdbCallHandler,
  movieTrailer,
 
} from '@scripts/partials/tmdbControler';

import {
  callPerplexity,
  buildPromt

} from '@scripts/partials/openAiControler'

import { poplateResult } from '@scripts/helpers/recommendation-results-helper';

import { getLoggedInUsername } from '@scripts/profile/profile-main.js';

import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css'; // Importing CSS for Toastify

// Spam Counter
let spamCounter = 0
let newRecomendationButton = document.getElementById ('new-recomendation');
let startOverButton = document.getElementById('start-over');

collectProgressItems();
// Here is all questions components
const allQuestionsCompontents = document.querySelectorAll('.qa');
let currentQuestionIndex = 0;
let allAnswers = [];


// Toster
function showToast(message, duration) {
  Toastify({
    text: message,
    duration: 3000,
    gravity: 'top', 
    position: 'right', 
    stopOnFocus: true,
    style: {
      background: "linear-gradient(90deg, #172938 70%, #172938 100%)",
      fontFamily: "Red Hat Display",
      fontSize: "16px",
    }
  }).showToast();
}


// Here is the function to show the next question
async function changeQuestionHandler(currentQuestionIndex) {
  handleProgressNumber(currentQuestionIndex);
  handleProgressCheckbox(currentQuestionIndex);


// Filter out those whose parent has 'advance-recommendation-result'
const filteredQuestions = Array.from(allQuestionsCompontents).filter(q => 
  !q.closest('.advance-recommendation-result')
);

// Hide only the filtered ones
filteredQuestions.forEach(singleQuestion => {
  singleQuestion.style.setProperty('display', 'none', 'important');
});

// Show the current question
if (allQuestionsCompontents[currentQuestionIndex]) {
  allQuestionsCompontents[currentQuestionIndex].style.setProperty('display', 'block', 'important');
}


  if(currentQuestionIndex === 0) {
    // spamCounter = 0
    disableBackButton();
  }

  if(currentQuestionIndex === 6) {
    removeProgressBar();
    removeadvertisementBanner();

    // Call ai
    const createdPropmt = buildPromt(allAnswers);
    const recommendation = await callPerplexity(createdPropmt);
    let recommendation_movie_array;
    let isOkay = false;

    try {
      recommendation_movie_array = JSON.parse(recommendation.choices[0].message.content);
      isOkay = Array.isArray(recommendation_movie_array) && recommendation_movie_array.length > 0;
      isOkay = true;
    } catch (error) {
      isOkay = false;
    }

    if (isOkay) {
      try {
        const tmdbResult = await tmdbCallHandler(recommendation_movie_array);
        await poplateResult(tmdbResult);
        
        setTimeout(() => {
          currentQuestionIndex = 7;
          changeQuestionHandler(currentQuestionIndex);
          addAdvertisementBanner();
        }, 300)

        const username = await getLoggedInUsername();
        if (username) {
          // Wrap single ID in an array
          saveMovieRecommendation([tmdbResult.id], username);
        }

        else {
          showToast('Za čuvanje preporuka, prijavite se ili registrujte nalog!', 4000);
        }

        // You can directly change the question after tmdbResult is populated
        // currentQuestionIndex = 7;
        // changeQuestionHandler(currentQuestionIndex);
      } catch (error) {
        // Handle any errors that may have occurred during tmdbCallHandler
        console.error('Error fetching TMDB data:', error);
        showToast('Oops doslo je do greske.', 'warning');
        showToast('Probaj ponovo.', 'warning');
        currentQuestionIndex = 0;
        changeQuestionHandler(currentQuestionIndex);
      }
    } else {
      showToast('Oops doslo je do greske.', 'warning');
      showToast('Probaj ponovo.', 'warning');
      currentQuestionIndex = 0;
      changeQuestionHandler(currentQuestionIndex);
    }

    // if(isOkay) {
    //   const tmdbResult = await tmdbCallHandler(recommendation_movie_array);  


    //   console.log(tmdbResult);
    //   poplateResult(tmdbResult);
  
    //   setTimeout(() => {
    //     currentQuestionIndex = 7;
    //     changeQuestionHandler(currentQuestionIndex);
    //   }, 3000)
    // }
    // else {
    //   showToast('Oops doslo je do greske.', 'warning')
    //   showToast('Probaj ponovo.', 'warning')
    //   currentQuestionIndex = 0;
    //   changeQuestionHandler(currentQuestionIndex);
    // }
  }
}

// Here is the function to show the next question
window.nextQuestion = function() {
  if (currentQuestionIndex === 6) {
    currentQuestionIndex = 0;
  }
  if(inputVerification()) {
    showToast('Izaberite polje.', 'warning')
    return
  };
  
  allAnswers.push(inputValue());

  if(currentQuestionIndex < 6) {
    currentQuestionIndex++;
    changeQuestionHandler(currentQuestionIndex);
  }
}

// Here is the function to show the previous question
window.backQuestion = function(event) {
  allAnswers.pop();

  if(currentQuestionIndex > 0) {
    currentQuestionIndex--;
    changeQuestionHandler(currentQuestionIndex);
  }
}

window.newRecomendation = function() {
  if (spamCounter === 1) {
    showToast('Popuni anketu ponovo za bolje rezultate.', 'warning');
    startOverButton.style.display = 'inline';
  } else if (spamCounter > 2) {
    changeQuestionHandler(6);
    newRecomendationButton.style.pointerEvents = 'none';
    newRecomendationButton.style.opacity = '0.6';
    newRecomendationButton.disabled = true;
    return;
  }

  spamCounter++;
  changeQuestionHandler(6);
}

window.openTrailerPopUp = function () {
  const trailerModal = document.querySelector('#trailer-modal');
  
  // Scroll to the top
  window.scrollTo({ top: 0, behavior: 'smooth' });  

  // Show the modal
  trailerModal.showModal();

  // Close button functionality
  const closeModalBtn = document.getElementById('closeModalBtn');

  closeModalBtn.onclick = function() {
      trailerModal.close();
      stopVideo();
  };

  // Close modal when clicking outside of it
  trailerModal.addEventListener('click', function(event) {
      if (event.target === trailerModal) {
          trailerModal.close();
          stopVideo();
      }
  });
}

// Function to stop the YouTube video
function stopVideo() {
  const iframe = document.getElementById('youtube-player');
  const src = iframe.src;
  iframe.src = '';
  iframe.src = src;
}

function disableBackButton() {
  const backButton = document.querySelector('.back-btn');
  if(!backButton) return;
  backButton.style.pointerEvents = 'none';
  backButton.style.opacity = '0.6';
  backButton.disabled = true;
}

function inputVerification() {
  let input_filds = document.getElementById(`form-holder-${currentQuestionIndex}`).querySelectorAll('input');

  return Array.from(input_filds).every(input => {
    if (!input.checked) {
      return true;
    }
    return false;
  })
}

function inputValue() {
  let input_filds = document.getElementById(`form-holder-${currentQuestionIndex}`).querySelectorAll('input');
  let input_value = [];

  Array.from(input_filds).forEach(input => {
    if (input.checked) {      
      input_value.push(input.value)
    }
  })
  
  return input_value;
}

export async function saveMovieRecommendation(movie_ids, username) {
  const formData = new URLSearchParams();
  formData.append('action', 'save_movie_recommendation');
  formData.append('username', username);

  movie_ids.forEach(id => formData.append('movie_ids[]', id)); // ✅ send as array

  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    credentials: 'same-origin',
    body: formData
  });

  const res = await response.json();
  if (res.success) {
    showToast('Preporuka je sačuvana!', 2000);
    console.log('Saved movies:', res.data.recommendations);
  } else {
    console.error(res.data?.message || 'Greška prilikom čuvanja preporuke');
    showToast('Greška prilikom čuvanja preporuke');
  }
}


function extractPureJSON(response) {
  const cleaned = response.replace(/```json/g, '').replace(/```/g, '');

  const jsonStart = cleaned.indexOf('{');
  const jsonEnd = cleaned.lastIndexOf('}') + 1;
  return cleaned.slice(jsonStart, jsonEnd);
}


changeQuestionHandler(currentQuestionIndex);