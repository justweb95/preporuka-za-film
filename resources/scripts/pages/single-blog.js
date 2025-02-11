import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css'; // Importing CSS for Toastify

console.log('Alo');


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
let form_comment = document.querySelector('form#commentform');
form_comment.addEventListener('click', (e) => {
  if (
    (e.target.tagName === 'INPUT' && e.target.type !== 'submit') ||
    e.target.tagName === 'TEXTAREA'
  ) {
    e.target.classList.remove('input-not-valid');
  }
});

form_comment.addEventListener('input', (e) => {
  if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') {
    e.target.classList.remove('input-not-valid');
  }
});

let form_labels = document.querySelectorAll('form#commentform label');
form_labels.forEach((label) => {
  label.addEventListener('click', () => {
    form_labels.forEach((l) => l.classList.remove('input-not-valid'));
  });
});
// Needs refactoring
// Bulshit code that remove not-valid class from inputs

// Handle Form Submit Click;
let form_submit_button = document.querySelector('#submit');
form_submit_button.addEventListener('click', handleFormSubmit);

function handleFormSubmit(e) {
  // Prevent defult behavior
  e.preventDefault();

  // Collect data from form
  let comment_data = handleCollectingData();

  // Validate form
  if (!validateFormHandler(comment_data)) {
    console.log('Forma nije validna');
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
  // set isValid to true
  let isValid = true;

  // Check if form_comment is empty
  if (comment_data.form_comment.value.trim() === '') {
    comment_data.form_comment.classList.add('input-not-valid');
    isValid = false;
  } else {
    comment_data.form_comment.classList.remove('input-not-valid');
  }

  // Check if form_author is empty
  if (comment_data.form_author.value.trim() === '') {
    comment_data.form_author.classList.add('input-not-valid');
    isValid = false;
  } else {
    comment_data.form_author.classList.remove('input-not-valid');
  }

  // Check if form_email is empty or not valid
  if (comment_data.form_email.value.trim() === '') {
    comment_data.form_email.classList.add('input-not-valid');
    isValid = false;
  } else if (!validateEmail(comment_data.form_email.value.trim())) {
    comment_data.form_email.classList.add('input-not-valid');
    isValid = false;
  } else {
    comment_data.form_email.classList.remove('input-not-valid');
  }

  // Return isValid
  return isValid;
}

// Collecting data from form and returning it as object
function handleCollectingData() {
  // data about outhor, email, comment
  let form_comment = document.querySelector('#comment');
  let form_author = document.querySelector('#author');
  let form_email = document.querySelector('#email');

  // Collect movie_id
  let smHeroSection = document.querySelector('#blog_post_item');
  let blog_post_id = smHeroSection.dataset.blogId;

  // prepare comment_data object
  let comment_data = {
    form_comment: form_comment,
    form_author: form_author,
    form_email: form_email,
    blog_post_id: blog_post_id,
  };

  // return comment_data object
  return comment_data;
}

function handleCommentPost(comment_data) {
  console.log(PRODUCTION);
  
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
  data.append('submit', 'Pošalji');
  data.append('comment_post_ID', comment_data.blog_post_id);
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
      return;
    } else {
      console.log('No data returned.');
      return;
    }
  })
  .catch((error) => {
    // Handle error response with toast message
    console.log('Error:', error);
  });
}