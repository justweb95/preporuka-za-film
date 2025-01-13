import { 
  collectProgressItems,
  handleProgressNumber,
  handleProgressCheckbox,
  removeProgressBar

} from '@scripts/partials/question-progress';


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
  
  // callAIHandler(inputValue());

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

function callAIHandler(answer) {

  console.log("All Anwsers");
  console.log(answers);
  
}

changeQuestionHandler(currentQuestionIndex);