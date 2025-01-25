import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css'; // Importing CSS for Toastify

// Toster
function showToast(message) {
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


import { 
  tmdbSingleMovieHandler,
  movieWatchOn, 
  movieTrailer

  } from "@scripts/partials/tmdbControler";

  import { cyrillicFormat } from '@scripts/partials/textFormatingControler';

// // Get the current URL
// const url = window.location.href;
// // Separate the URL from '/#'
// const [baseUrl, movieDetails] = url.split('single-movie/');
// // Extract the movie name and name_id
// const [movie_name, movie_id] = movieDetails.split('&');

// Log the results
// console.log('Movie Name:', movie_name);
// console.log('Movie ID:', movie_id);

// tmdbSingleMovieHandler(movie_id)
//   .then((res) => {
//     // Turn off loader;
//     handleLoader();

//     // Turn populate hero navigation;
//     populateHeroNavigation(cyrillicFormat(res.genres[0].name), cyrillicFormat(res.title));

//     // Populate Hero Background Image
//     populateHeroBackground(res.backdrop_path)
    
    
//     console.log('Podaci skinuti');
//     console.log(res);
//   })
//   .catch((err) => console.log(err))

let form_comment = document.querySelector('form#commentform');
let form_submit_button = document.querySelector('#submit');


form_submit_button.addEventListener('click', handleFormSubmit);


function handleFormSubmit(e) {
  e.preventDefault();

  let form_comment = document.querySelector('#comment');
  let form_author = document.querySelector('#author');
  let form_email = document.querySelector('#email');

  let isValid = true;

  if (form_comment.value.trim() === '') {
    form_comment.classList.add('input-not-valid');
    isValid = false;
  } else {
    form_comment.classList.remove('input-not-valid');
  }

  if (form_author.value.trim() === '') {
    form_author.classList.add('input-not-valid');
    isValid = false;
  } else {
    form_author.classList.remove('input-not-valid');
  }

  if (form_email.value.trim() === '') {
    form_email.classList.add('input-not-valid');
    isValid = false;
  } else if (!validateEmail(form_email.value.trim())) {
    form_email.classList.add('input-not-valid');
    isValid = false;
  } else {
    form_email.classList.remove('input-not-valid');
  }

  if (!isValid) {
    console.log('Forma nije validna');
    return;
  }


   // Prepare data to be sent
   const data = new FormData();
   data.append('comment', form_comment.value);
   data.append('author', form_author.value);
   data.append('email', form_email.value);
   data.append('submit', 'Pošalji'); // Submit button value
   data.append('comment_post_ID', generateUniqueId()); // Replace with actual post ID as needed
   data.append('comment_parent', 0); // Assuming no parent comment for now


   // Construct the action URL dynamically based on current location
   let actionUrl = ``;
   if(PRODUCTION) {
    actionUrl = `${window.location.origin}/wp-comments-post.php`;
   }
   else {
    actionUrl = `${window.location.origin}/preporuka-za-film/wp-comments-post.php`;
   }

   fetch(actionUrl, {
    method: 'POST',
    body: data,
    headers: {
      'X-Requested-With': 'XMLHttpRequest' // Indicate that this is an AJAX request
    }
  })
  .then(response => {return response;})
  .then(data => {
      if (data) {
          showToast('Vaš komentar je uspešno poslat!');
          // Optionally, clear the form or provide user feedback here
          form_comment.value = '';
          form_author.value = '';
          form_email.value = '';
      } else {
          console.log('No data returned.');
      }
  })
  .catch(error => {
      console.error('Error:', error); // Handle errors
  });
}

function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}

function generateUniqueId() {
  const now = new Date();
  const year = now.getFullYear(); // e.g., 2025
  const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are 0-based, pad to 2 digits
  const day = String(now.getDate()).padStart(2, '0'); // Pad to 2 digits
  const hours = String(now.getHours()).padStart(2, '0'); // Pad to 2 digits
  const minutes = String(now.getMinutes()).padStart(2, '0'); // Pad to 2 digits
  const seconds = String(now.getSeconds()).padStart(2, '0'); // Pad to 2 digits

  // Create a unique numeric ID in the format: YYYYMMDDHHMMSS
  const uniqueId = Number(`${year}${month}${day}${hours}${minutes}${seconds}`);
  console.log(uniqueId);
  
  return uniqueId;
}


function handleLoader() {
  let loadingElement = document.querySelector('#loading');
  let smNavigationElement = document.querySelector('#sm_navigation');

  loadingElement.style.animation = 'moveLeftLoader 1s forwards';
  smNavigationElement.style.display = 'flex';

}

function populateHeroNavigation(movie_category, movie_name) {
  let movieCategoryElement = document.querySelector('#movie_category');
  let movieNameElement = document.querySelector('#movie_name');
  
  movieCategoryElement.textContent = movie_category;
  movieNameElement.textContent = movie_name;
}

function populateHeroBackground(movie_backdrop_path) {
  let backgroundImageUrl = `https://media.themoviedb.org/t/p/w300_and_h450_bestv2/${movie_backdrop_path}`;
  let sm_hero_section = document.querySelector('#sm_hero_section');

  sm_hero_section.style.backgroundImage = `linear-gradient(180deg, #06131E 0%, rgba(6, 19, 30, 0.60) 100%),  url(${backgroundImageUrl})`;

}