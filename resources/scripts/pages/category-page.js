import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css'; // Importing CSS for Toastify

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


if(checkLocalSort()) {
  colorLikedButton(JSON.parse(localStorage.getItem('favorit')));
}
else {
  colorLikedButton([]);
}

export function likeButtonHandler(clicked_movie_id) {
  let movie_id = clicked_movie_id;

  populateList(movie_id);

  colorLikedButton(JSON.parse(localStorage.getItem('favorit')));
}

window.likeButtonHandler = likeButtonHandler;

function populateList(movie_id) {
  let favoritesList;

  if (checkLocalSort()) {
    favoritesList = JSON.parse(localStorage.getItem('favorit'));

    const movieIndex = favoritesList.indexOf(movie_id);
    if (movieIndex === -1) {
      favoritesList.push(movie_id);
      showToast("Film je dodat omiljenima");
    } else {
      favoritesList.splice(movieIndex, 1);
      showToast("Film je uklonjen iz omiljenih");
    }

    pushInLocalStorage(favoritesList);
  } else {
    favoritesList = [movie_id];
    pushInLocalStorage(favoritesList);
    showToast("Film je dodat omiljenima");
  }

  return favoritesList;
}

function checkLocalSort() {
  if (localStorage.getItem('favorit') === null) {
    return false;
  }
  return true;
}

function pushInLocalStorage(movie_ids) {
  localStorage.setItem('favorit', JSON.stringify(movie_ids));
}


function colorLikedButton(all_movies_id) {
  let allButtons = document.querySelectorAll('.like-button');

  allButtons.forEach(element => {
    element.classList.remove('liked');
  });

  all_movies_id.forEach(element => {
    let movieElement = document.getElementById(element);
    
    if (movieElement) {
      movieElement.classList.add('liked');
    }
  });
}


window.handleCategoryDropdown = handleCategoryDropdown;

export function handleCategoryDropdown() {
  let categoryDropdownList = document.querySelector('.category-drop-down-list');
  let categorySVG = document.querySelector('.category-drop-down-holder').querySelector('svg');

  // Work only on mobile devices
  let isMobile = window.innerWidth > 550 ? false : true;
  if(!isMobile) {
    return;
  }
  
  if(!categoryDropdownList.style.display || categoryDropdownList.style.display === 'none') {
    categoryDropdownList.style.display = 'flex';
    categorySVG.style.transform = 'rotate(180deg)';
  }
  else {
    categoryDropdownList.style.display = 'none';
    categorySVG.style.transform = 'rotate(0deg)';
  }
}