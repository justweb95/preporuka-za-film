import { likeButtonHandler } from '../pages/category-page.js';
window.likeButtonHandler = likeButtonHandler;

// Desktop
const search_input_filed = document.getElementById('movie-search');
const search_input_submit = document.getElementById('movie-search-submit');

// Mobile 
const search_input_filed_mobile = document.getElementById('movie-search-mobile');
const search_input_submit_mobile = document.getElementById('movie-search-submit-mobile');

function inputHandler(isMobile) {
  let search_term = '';
  let home_url = ''; 

  if(isMobile) {
    search_term = search_input_filed_mobile.value; 
  }
  else {
    search_term = search_input_filed.value; 
  }
  
  if (PRODUCTION) {
    home_url = `${window.location.origin}/`; 
  } else {
    home_url = `${window.location.origin}/preporuka-za-film`;
  }

  window.location = `${home_url}?s=${search_term}`;  

}

search_input_filed.addEventListener('keydown', function(event) {
  if (event.key === 'Enter') {
    inputHandler(false);
  }
});

search_input_submit.addEventListener('click', () => inputHandler(false));

search_input_filed_mobile.addEventListener('keydown', function(event) {
  if (event.key === 'Enter') {
    inputHandler(true);
  }
});

search_input_submit_mobile.addEventListener('click', () => inputHandler(false));