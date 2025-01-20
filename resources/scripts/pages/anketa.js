import { 
  collectProgressItems,
  handleProgressNumber,
  handleProgressCheckbox,
  removeProgressBar

} from '@scripts/partials/question-progress';
import { 
  tmdbCallHandler,
  movieTrailer,
 

} from '@scripts/partials/tmdbControler';

import { cyrillicFormat, removeDiacritics } from '@scripts/partials/textFormatingControler';

import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css'; // Importing CSS for Toastify

collectProgressItems();

// Here is all questions components
const allQuestionsCompontents = document.querySelectorAll('.qa');
let currentQuestionIndex = 0;
let allAnswers = [];


// Toster
function showToast(message) {
  Toastify({
    text: message,
    duration: 2000,
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
function changeQuestionHandler(currentQuestionIndex) {
  handleProgressNumber(currentQuestionIndex);
  handleProgressCheckbox(currentQuestionIndex);


  allQuestionsCompontents.forEach((singleQuestion) => {
    singleQuestion.style.setProperty('display', 'none', 'important');
  });   

  allQuestionsCompontents[currentQuestionIndex].style.setProperty('display', 'block');

  if(currentQuestionIndex === 0) {
    disableBackButton();
  }

  if(currentQuestionIndex === 6) {
    removeProgressBar();
    
    const tmdbResult =  tmdbCallHandler(allAnswers);

    poplateResult(tmdbResult);


    setTimeout(() => {
      currentQuestionIndex = 7;
      changeQuestionHandler(currentQuestionIndex);
    }, 4300)
  }
}

// Here is the function to show the next question
window.nextQuestion = function() {

  if(inputVerification()) {
    showToast('Izaberite polje.', 'warning')
    return
  };

  allAnswers.push(inputValue());

  console.log("All Answers: ");
  console.log(allAnswers);
  

  if(currentQuestionIndex < 6) {
    currentQuestionIndex++;
    changeQuestionHandler(currentQuestionIndex);
  }
}

// Here is the function to show the previous question
window.backQuestion = function(event) {
  if(currentQuestionIndex > 0) {
    currentQuestionIndex--;
    changeQuestionHandler(currentQuestionIndex);
  }
}

window.newRecomendation = function() {
  changeQuestionHandler(6);
}

window.openTrailerPopUp = function () {
  const trailerModal = document.querySelector('#trailer-modal');
  
  // Show the modal
  trailerModal.showModal();

  // Close button functionality
  const closeModalBtn = document.getElementById('closeModalBtn');

  closeModalBtn.onclick = function() {
      trailerModal.close();
      stopVideo()
  };

  // Close modal when clicking outside of it
  trailerModal.addEventListener('click', function(event) {
      if (event.target === trailerModal) {
          trailerModal.close();
          stopVideo()
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

async function poplateResult(resultObject) {
  let tmdbData = await resultObject

  let poster_holder = document.querySelector('#result-poster');
  let poster_holder_mobile = document.querySelector('#result-description-poster');
  let result_content_title = document.querySelector('#result-content-title');
  let result_description_text = document.querySelector('#result-description-text');
  let imdb_rating = document.querySelector('#imdb-rating');
  let result_genres_text = document.querySelector('#result-genres-text');
  let result_year_text = document.querySelector('#result-year-text');
  let result_cta_read_more = document.querySelector('.result-cta-read-more');
  let result_cta_trailer = document.querySelector('.result-cta-trailer');
  let movie_duration = document.querySelector('#result-duration-text');
  let youtube_player = document.querySelector('#youtube-player');

  let affiliate_amazon = document.querySelector('.affiliate-amazon');


  poster_holder.setAttribute('src', `https://media.themoviedb.org/t/p/w300_and_h450_bestv2/${tmdbData.poster_path}`)
  poster_holder_mobile.setAttribute('src', `https://media.themoviedb.org/t/p/w300_and_h450_bestv2/${tmdbData.poster_path}`)
  
  // result_content_title.textContent = tmdbData.original_title;
  result_content_title.textContent = cyrillicFormat(tmdbData.title);
  imdb_rating.textContent = parseFloat(tmdbData.vote_average.toFixed(1));

  result_description_text.textContent = cyrillicFormat(tmdbData.overview.substring(0, 300));

  result_genres_text.textContent = cyrillicFormat(tmdbData.genres);
  movie_duration.textContent = durationFromat(tmdbData.runtime);
  result_year_text.textContent = tmdbData.release_date.split('-')[0];


  // Set the href attribute to the result_cta_read_more element
  const fullUrl = tmdbData.url;
  result_cta_read_more.setAttribute('href', fullUrl);


  if (tmdbData.video_trailer && tmdbData.video_trailer.key) {
    youtube_player.setAttribute('src', `https://www.youtube.com/embed/${tmdbData.video_trailer.key}`);
  } else {
    result_cta_trailer.setAttribute('aria-disabled', 'true');
    result_cta_trailer.disabled = true;
  }

  let amazonProvider;

  if (tmdbData.movie_watch_on && Array.isArray(tmdbData.movie_watch_on.buy)) {
    amazonProvider = tmdbData.movie_watch_on.buy.find(provider => provider.provider_name === 'Amazon Video');
  } else {
    console.log("movie_watch_on or buy array does not exist.");
  }

  if (amazonProvider) {
    affiliate_amazon.setAttribute('href', `https://www.amazon.com/dp/${amazonProvider.provider_id}`);
    affiliate_amazon.removeAttribute('aria-disabled');
    affiliate_amazon.style.opacity = '1';
    affiliate_amazon.disabled = false;
  } else {
    affiliate_amazon.setAttribute('aria-disabled', 'true');
    affiliate_amazon.style.opacity = '.6';
    affiliate_amazon.disabled = true;
  }
}

function durationFromat(time) {
  const hours = Math.floor(time / 60); // Calculate full hours
  const minutes = time % 60; // Calculate remaining minutes
  return `${hours}h ${minutes}min`; // Return formatted string
}

changeQuestionHandler(currentQuestionIndex);