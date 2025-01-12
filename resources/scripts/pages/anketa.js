import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css'; // Importing CSS for Toastify

// Here is all questions components
const allQuestionsCompontents = document.querySelectorAll('.qa');
let currentQuestionIndex = 0;

// Toster
function showToast(message, type) {
  Toastify({
    text: message,
    duration: 2000, // Duration in milliseconds
    close: true,
    gravity: 'top', // `top` or `bottom`
    position: 'right', // `left`, `center` or `right`
    backgroundColor: type === 'success' ? 'green' : type === 'warning' ? 'orange' : 'red',
    stopOnFocus: true, // Prevents dismissing of toast on hover
  }).showToast();
}


// Here is the function to show the next question
function changeQuestionHandler(currentQuestionIndex) {
  console.log("Trenutno pitanje:");
  console.log(currentQuestionIndex);

  allQuestionsCompontents.forEach((singleQuestion) => {
    singleQuestion.style.setProperty('display', 'none', 'important');
  });   

  allQuestionsCompontents[currentQuestionIndex].style.setProperty('display', 'block');

  if(currentQuestionIndex === 0) {
    disableBackButton();
  }

  if(currentQuestionIndex === 6) {
    setTimeout(() => {
      currentQuestionIndex = 7;
      changeQuestionHandler(currentQuestionIndex);
    }, 4500)
  }
}

// Here is the function to show the next question
window.nextQuestion = function() {
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

function disableBackButton() {
  const backButton = document.querySelector('.back-btn');
  backButton.style.pointerEvents = 'none';
  backButton.style.opacity = '0.6';
  backButton.disabled = true;
}

changeQuestionHandler(currentQuestionIndex);