import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css';
import { getLoggedInUsername } from '@scripts/profile/profile-main.js';

// Toast helper
function showToast(message, time) {
  Toastify({
    text: message,
    duration: time || 2000,
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

console.log("script loading");


getFavorites();
getWatched();

colorLikedButton(getLocalFavorites());


export function likeButtonHandler(movieId) {
  populateList(movieId);
}

export function alreadywatched(movieId) {
  toggleWatched(movieId);
}



async function populateList(movieId) {
  const username = await getLoggedInUsername();

  if (username === 'guest') {
    // Guest: show message and update localStorage
    showToast("Za čuvanje omiljenih filmova, prijavite se ili registrujte nalog!", 4000);
    let favorites = getLocalFavorites();

    if (!favorites.includes(movieId)) {
      favorites.push(movieId);
      showToast("Omiljeni filmovi su ažurirani");
    } else {
      favorites = favorites.filter(id => id !== movieId);
      showToast("Omiljeni filmovi su ažurirani");
    }

    localStorage.setItem('favorit', JSON.stringify(favorites));
    colorLikedButton(favorites);
    return;
  }

  // Logged-in: AJAX update
  toggleFavorite(movieId);
}

function getLocalFavorites() {
  return JSON.parse(localStorage.getItem('favorit') || '[]');
}

function colorLikedButton(allMovieIds) {
  document.querySelectorAll('.like-button').forEach(button => button.classList.remove('liked'));

allMovieIds.forEach(id => {
  const movieElements = document.querySelectorAll(`.like-button[data-favorites-id="${id}"]`);
  movieElements.forEach(el => el.classList.add('liked'));
});

}

async function toggleFavorite(movieId) {
  const username = await getLoggedInUsername();

  fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    credentials: 'same-origin',
    body: new URLSearchParams({
      action: 'toggle_favorite_movie',
      username: username,
      movie_id: movieId
    })
  })
  .then(r => r.json())
  .then(res => {
    if (res.success) {
      colorLikedButton(res.data.favorites);
      showToast("Omiljeni filmovi su ažurirani");
    } else {
      console.error(res.data?.message || "Greška prilikom ažuriranja omiljenih filmova");
      showToast("Greška prilikom ažuriranja omiljenih filmova");
    }
  });
}


async function getFavorites() {
  const username = await getLoggedInUsername();
  

  if (username === 'guest') {
    // Guest: use localStorage only
    const favorites = getLocalFavorites();
    colorLikedButton(favorites);
    return;
  }

  fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    credentials: 'same-origin',
    body: new URLSearchParams({
      action: 'get_favorite_movies_by_username',
      username: username
    })
  })
  .then(r => r.json())
  .then(res => {
    if (res.success) {
      colorLikedButton(res.data.favorites);
    } else {
      console.error(res.data?.message || "Greška prilikom učitavanja omiljenih filmova");
    }
  });
}

async function toggleWatched(movieId) {
    const username = await getLoggedInUsername();
    if (username === 'guest') {
        showToast("Za čuvanje odgledanih filmova, prijavite se!");
        return;
    }

    fetch(pzfilm_globals.ajaxurl, {
        method: 'POST',
        credentials: 'same-origin',
        body: new URLSearchParams({
            action: 'toggle_watched_movie',
            username: username,
            movie_id: movieId
        })
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            colorWatchedButton(res.data.already_watched);
            showToast("Status odgledanog filma je ažuriran");
        } else {
            console.log(res.data?.message || "Greška prilikom ažuriranja odgledanog filma");
            showToast("Greška prilikom ažuriranja odgledanog filma");
        }
    });
}

function colorWatchedButton(all_movies_id) {
    const allButtons = document.querySelectorAll('.watched-button');

    allButtons.forEach(btn => btn.classList.remove('watched'));

    all_movies_id.forEach(id => {
      const movieElements = document.querySelectorAll(`.watched-button[data-watched-id="${id}"]`);
      movieElements.forEach(el => el.classList.add('watched'));
    });
}

// Load watched movies on page load
async function getWatched() {
    const username = await getLoggedInUsername();
    if (username === 'guest') return;

    fetch(pzfilm_globals.ajaxurl, {
        method: 'POST',
        credentials: 'same-origin',
        body: new URLSearchParams({
            action: 'get_watched_movies_by_username',
            username: username
        })
    })
    .then(r => r.json())
    .then(res => {
      if (res.success) colorWatchedButton(res.data.already_watched);
    });
}


window.likeButtonHandler = likeButtonHandler;
window.alreadywatched = alreadywatched;