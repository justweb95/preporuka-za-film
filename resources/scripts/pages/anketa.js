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

  // console.log("All Answers: ");
  // console.log(allAnswers);
  

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

  let poster_holder = document.querySelector('#result-poster');
  let poster_holder_mobile = document.querySelector('#result-description-poster');
  let result_content_title = document.querySelector('#result-content-title');
  let result_description_text = document.querySelector('#result-description-text');
  let imdb_rating = document.querySelector('#imdb-rating');



  poster_holder.setAttribute('src', `https://media.themoviedb.org/t/p/w300_and_h450_bestv2/${tmdbData.poster_path}`)
  poster_holder_mobile.setAttribute('src', `https://media.themoviedb.org/t/p/w300_and_h450_bestv2/${tmdbData.poster_path}`)
  
  result_content_title.textContent = tmdbData.title;
  imdb_rating.textContent = parseFloat(tmdbData.vote_average.toFixed(2));

  result_description_text.textContent = tmdbData.overview.substring(0, 300);
}

changeQuestionHandler(currentQuestionIndex);