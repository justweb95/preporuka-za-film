import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css'; // Importing CSS for Toastify

import { getLoggedInUserInfo } from '@scripts/profile/profile-main.js';
import { scrolToTop } from '@scripts/helpers/scrool-to-top-helper';

// Toster
function showToast(message) {
  Toastify({
    text: message,
    duration: 3000,
    gravity: 'top',
    position: 'right',
    stopOnFocus: true,
    style: {
      background: 'linear-gradient(90deg, #172938 70%, #172938 100%)',
      fontFamily: 'Red Hat Display',
      fontSize: '16px',
    },
  }).showToast();
}
// Needs refactoring
// Bulshit code that remove not-valid class from inputs
// let form_comment = document.querySelector('form#commentform');
// form_comment.addEventListener('click', (e) => {
//   if (
//     (e.target.tagName === 'INPUT' && e.target.type !== 'submit') ||
//     e.target.tagName === 'TEXTAREA'
//   ) {
//     e.target.classList.remove('input-not-valid');
//   }
// });

// form_comment.addEventListener('input', (e) => {
//   if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') {
//     e.target.classList.remove('input-not-valid');
//   }
// });

// let form_labels = document.querySelectorAll('form#commentform label');
// form_labels.forEach((label) => {
//   label.addEventListener('click', () => {
//     form_labels.forEach((l) => l.classList.remove('input-not-valid'));
//   });
// });
// Needs refactoring
// Bulshit code that remove not-valid class from inputs

// Handle Form Submit Click;
let form_submit_button = document.querySelector('#submit');
form_submit_button.addEventListener('click', handleFormSubmit);

async function handleFormSubmit(e) {
  // Prevent defult behavior
  e.preventDefault();

  // Collect data from form
  let comment_data = await handleCollectingData();

  // Validate form
  if (!validateFormHandler(comment_data)) {
    showToast('Popunite sva polja unutar forme!');
    return;
  }

  // Handle Comment Post
  handleCommentPost(comment_data);
}

// Valdiate Email Regex
function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}

// Validate Form Handler for Comment Form Adding class input-not-valid
function validateFormHandler(comment_data) {
  let isValid = true;

  // Comment
  if (comment_data.form_comment.value.trim() === '') {
    comment_data.form_comment.classList.add('input-not-valid');
    isValid = false;
  } else {
    comment_data.form_comment.classList.remove('input-not-valid');
  }

  // Author
  if (comment_data.form_author.value.trim() === '') {
    comment_data.form_author.classList.add('input-not-valid');
    isValid = false;
  } else {
    comment_data.form_author.classList.remove('input-not-valid');
  }

  // Email
  if (comment_data.form_email.value.trim() === '') {
    comment_data.form_email.classList.add('input-not-valid');
    isValid = false;
  } else if (!validateEmail(comment_data.form_email.value.trim())) {
    comment_data.form_email.classList.add('input-not-valid');
    isValid = false;
  } else {
    comment_data.form_email.classList.remove('input-not-valid');
  }

  // Stars
  if (comment_data.selected_stars_rating === null) {
    Array.from(comment_data.form_stars_ratin_label).forEach(label =>
      label.classList.add('input-not-valid')
    );
    isValid = false;
  } else {
    Array.from(comment_data.form_stars_ratin_label).forEach(label =>
      label.classList.remove('input-not-valid')
    );
  }

  return isValid;
}

// Collecting data from form and returning it as object
async function handleCollectingData() {
  let form_comment = document.querySelector('#comment');
  let form_author = document.querySelector('#author');
  let form_email = document.querySelector('#email');

  // If author/email inputs DO NOT exist in DOM
  if (!form_author && !form_email) {
    const user_data = await getLoggedInUserInfo();

    // Create virtual inputs so validation logic still works
    const authorInput = document.createElement('input');
    authorInput.value = user_data.username || '';
    form_author = authorInput;

    const emailInput = document.createElement('input');
    emailInput.value = user_data.email || '';
    form_email = emailInput;
  }

  // Stars
  const form_stars_rating = document.querySelectorAll(
    '.stars-container input[type="radio"]'
  );
  const form_stars_ratin_label = document.querySelectorAll(
    '.stars-container label'
  );

  let selected_stars_rating = null;
  form_stars_rating.forEach(input => {
    if (input.checked) selected_stars_rating = input.value;
  });

  // Movie ID
  const movie_id =
    document.querySelector('#sm_hero_section')?.dataset.movieId;

  return {
    form_author,
    form_comment,
    form_email,
    selected_stars_rating,
    movie_id,
    form_stars_rating,
    form_stars_ratin_label,
  };
}




function handleCommentPost(comment_data) {
  // Construct the action URL dynamically based on current location
  let actionUrl = ``;
  if (PRODUCTION) {
    actionUrl = `${window.location.origin}/wp-comments-post.php`;
  } else {
    actionUrl = `${window.location.origin}/preporuka-za-film/wp-comments-post.php`;
  }

  // Prepare data to be sent
  const data = new FormData();
  data.append('comment', comment_data.form_comment.value);
  data.append('author', comment_data.form_author.value);
  data.append('email', comment_data.form_email.value);
  data.append('rating', comment_data.selected_stars_rating);
  data.append('submit', 'Pošalji');
  data.append('comment_post_ID', comment_data.movie_id);
  data.append('comment_parent', 0);

  fetch(actionUrl, {
    method: 'POST',
    body: data,
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
    },
  })
    .then((response) => {
      return response;
    })
    .then((data) => {
      if (data) {
        // Handle success response with toast message and clear form inputs
        showToast('Vaš komentar je uspešno poslat!');
        comment_data.form_comment.value = '';
        comment_data.form_author.value = '';
        comment_data.form_email.value = '';
        Array.from(comment_data.form_stars_rating).forEach((input) => {
          input.checked = false;
        });
        return;
      } else {
        return;
      }
    })
    .catch((error) => {
      // Handle error response with toast message
      console.log('Error:', error);
    });
}


window.openTrailerPopUp = function () {
  const trailerModal = document.querySelector('#trailer-modal');  
  scrolToTop();
  
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