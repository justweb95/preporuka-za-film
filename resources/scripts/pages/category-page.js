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

window.likeButtonHandler = function(clicked_movie_id) {
  let movie_id = clicked_movie_id;
  
  populateList(movie_id);

  colorLikedButton(JSON.parse(localStorage.getItem('favorit')));
}

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
  let favoritesList;

  if (localStorage.getItem('favorit') === null) {
    favoritesList = [];
    colorLikedButton(favoritesList);
    return false;
  }
  else {
    favoritesList = JSON.parse(localStorage.getItem('favorit'));
    colorLikedButton(favoritesList);
    return true;
  }
}

function pushInLocalStorage(movie_ids) {
  localStorage.setItem('favorit', JSON.stringify(movie_ids));
}


function colorLikedButton(all_movies_id) {
  let allButtons = document.querySelectorAll('.like-button');

  allButtons.forEach(element => {
    element.classList.remove('liked');
  });
  
  console.log(allButtons);
  

  all_movies_id.forEach(element => {
    document.getElementById(element).classList.add('liked');
  });
}