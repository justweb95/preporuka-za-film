import { 
  collectProgressItems,
  handleProgressNumber,
  handleProgressCheckbox,
  removeProgressBar

} from '@scripts/partials/question-progress';
import { tmdbCallHandler } from '@scripts/partials/tmdbControler';

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
  console.log("Trenutno pitanje: " + currentQuestionIndex);
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

  // result-genres-text 
  // result-duration-text
  // result-year-text
  // result-cta-read-more this one is class
  // result-cta-trailer this one is olso class



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

  poster_holder.setAttribute('src', `https://media.themoviedb.org/t/p/w300_and_h450_bestv2/${tmdbData.poster_path}`)
  poster_holder_mobile.setAttribute('src', `https://media.themoviedb.org/t/p/w300_and_h450_bestv2/${tmdbData.poster_path}`)
  
  result_content_title.textContent = tmdbData.original_title;
  imdb_rating.textContent = parseFloat(tmdbData.vote_average.toFixed(1));

  result_description_text.textContent = cyrillicFormat(tmdbData.overview.substring(0, 300));

  result_genres_text.textContent = cyrillicFormat(tmdbData.genres[0].name);
  movie_duration.textContent = durationFromat(tmdbData.runtime);
  result_year_text.textContent = tmdbData.release_date.split('-')[0];


  // result_description_text.textContent = cyrillicFormat(tmdbData.overview.substring(0, 300));
  // result_description_text.textContent = cyrillicFormat(tmdbData.overview.substring(0, 300));
  // result_description_text.textContent = cyrillicFormat(tmdbData.overview.substring(0, 300));
}


function durationFromat(time) {
  const hours = Math.floor(time / 60); // Calculate full hours
  const minutes = time % 60; // Calculate remaining minutes
  return `${hours}h ${minutes}min`; // Return formatted string
}

function cyrillicFormat(text) {
  const cyrillicToLatinMap = {
      'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd',
      'ђ': 'đ', 'е': 'e', 'ж': 'ž', 'з': 'z', 'и': 'i',
      'ј': 'j', 'к': 'k', 'л': 'l', 'љ': 'lj', 'м': 'm',
      'н': 'n', 'њ': 'nj', 'о': 'o', 'п': 'p', 'р': 'r',
      'с': 's', 'т': 't', 'ћ': 'ć', 'у': 'u', 'ф': 'f',
      'х': 'h', 'ц': 'c', 'ч': 'č', 'џ': 'dž', 
      // Uppercase letters
      'А': 'A',  'Б': 'B', 'В': 'V', 'Г': 'G',
      'Д': 'D', 'Ђ': 'Đ', 'Е': 'E', 'Ж': 'Ž',
      'З': 'Z', 'И': 'I', 'Ј': 'J', 'К': 'K',
      'Л': 'L', 'Љ': 'LJ','М':'M','Н':'N','Њ':'NJ',
      'О':'O','П':'P','Р':'R','С':'S','Т':'T',
      'Ћ':'Ć','У':'U','Ф':'F','Х':'H','Ц':'C',
      'Ч':'Č','Џ':'Dž'
  };

  return text.split('').map(char => cyrillicToLatinMap[char] || char).join('');
}

changeQuestionHandler(currentQuestionIndex);