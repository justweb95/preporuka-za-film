import { poplateResult } from '@scripts/helpers/recommendation-results-helper.js';
import {
  collectProgressItems,
  handleProgressNumber,
  handleProgressCheckbox
} from '../partials/hon-progress.js'


// Hot or Not Variables
let step_index = 1;
let five_movie_array = [];
let currentIndex = 2; // Start from 2 because first two movies are displayed
let leftMovie = null;
let rightMovie = null;

const steps_id = [
  'hot_or_not_home',
  'hon_add_custom',
  'hon_pop_up',
  'hon_game',
  'game_results',
]



// Making array of elements from array of steps id
const steps_element = steps_id.map(step => document.getElementById(step));

// Function
function honStepHandler(step_index) {
  steps_element.forEach(step => step.hidden = true);  
  steps_element[step_index - 1].hidden = false;
}

// Start Game Buttons
const start_game_btns = document.querySelectorAll('.start-game-btn');

start_game_btns.forEach(btn => btn.addEventListener('click', (event) => {
  if (event.currentTarget.dataset.isCustom === "start_game") {
    five_movie_array = collectFiveCustomAddedMovie();
    startGameWithMovies(five_movie_array);
    collectProgressItems();
    handleProgressNumber(0);
    handleProgressCheckbox(0);
    honStepHandler(4);
    return;
  }

  const isCustom = event.currentTarget.dataset.isCustom === 'true';
  startGameHandler(isCustom);
}));

// Start Game Handler
async function startGameHandler(isCustom) {
  if(!isCustom) {
    const button_loader = document.querySelector('.suprise-start-btn');
    button_loader.textContent = 'AI Nalazi Filmove...'
    
    const movies_response = await getFiveMoviesForGame();
    if(!movies_response) return;
    
    button_loader.textContent = 'Pokreni igru'
    five_movie_array = movies_response.data.movies;

    startGameWithMovies(five_movie_array);

    collectProgressItems();
    handleProgressNumber(0);
    handleProgressCheckbox(0);
    honStepHandler(4);
  } else {
    honStepHandler(2);
  }
}

// Collect Custom Added Movies
function collectFiveCustomAddedMovie() {
  return [...document.querySelectorAll('.custom-movie-card')].map(movie => ({
    id: movie.dataset.movieId || '',
    title: movie.dataset.movieName || '',
    release_year: movie.dataset.movieYear || '',
    poster: movie.querySelector('img')?.src || ''
  }));
}

// Start Game with two slots
function startGameWithMovies(movies) {
  if (movies.length < 2) return console.error("Need at least 2 movies");

  leftMovie = movies[0];
  rightMovie = movies[1];
  currentIndex = 2;

  renderMovies(leftMovie, rightMovie);
}

// Render movies in two slots
function renderMovies(left, right) {
  const leftSlot = document.querySelector('.hon-option-card.left');
  const rightSlot = document.querySelector('.hon-option-card.right');

  leftSlot.innerHTML = createMovieCardHTML(left);
  rightSlot.innerHTML = createMovieCardHTML(right);

  // Add click events
  leftSlot.querySelector('.choose-movie-btn').addEventListener('click', () => pickMovie("left"));
  rightSlot.querySelector('.choose-movie-btn').addEventListener('click', () => pickMovie("right"));
}

// Create single movie card HTML
function createMovieCardHTML(movie) {
  return `
    <article class="single-movie-card" data-movie-id="${movie.id}">
      <img class="movie-card-poster" src="${movie.poster ? `https://image.tmdb.org/t/p/w200${movie.poster}` : 'https://via.placeholder.com/150x225?text=No+Image'}" alt="${movie.title} Poster"/>
      <h2>${movie.title}</h2>
      <p>Godina: ${movie.release_year || 'N/A'}</p>
      <button class="choose-movie-btn">Izaberi ovaj film</button>
    </article>
  `;
}

// Pick a movie
function pickMovie(side) {
  if (currentIndex >= five_movie_array.length) {
    const lastPicked = side === "left" ? leftMovie : rightMovie;
    gameEnd(lastPicked);
    return;
  }

  const nextMovie = five_movie_array[currentIndex];
  currentIndex++;

  if (side === "left") {
    // Picked left, only update right
    rightMovie = nextMovie;
    updateSlot('.hon-option-card.right', rightMovie);
  } else {
    // Picked right, only update left
    leftMovie = nextMovie;
    updateSlot('.hon-option-card.left', leftMovie);
  }

  // Update progress
  collectProgressItems();
  handleProgressNumber(currentIndex - 2);
  handleProgressCheckbox(currentIndex - 2);
}

async function gameEnd(resultObject) {
  // Fetch full movie data from your DB
  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    body: new URLSearchParams({
      action: 'get_movie_for_result',
      movie_id: resultObject.id
    }),
    credentials: 'same-origin'
  });
  
  const data = await response.json();
  if (!data.success) {
    console.error('Movie data not found:', data);
    return;
  }
  
  const isPopulated = await poplateResult(data.data);
  if(isPopulated) {
    honStepHandler(5);
  }
}



function updateSlot(slotSelector, movie) {
  const slot = document.querySelector(slotSelector);
  slot.innerHTML = createMovieCardHTML(movie);
  // Add click event to the new button
  slot.querySelector('.choose-movie-btn').addEventListener('click', () => {
    pickMovie(slotSelector.includes('left') ? 'left' : 'right');
  });
}

// Backend Related Function
async function getFiveMoviesForGame() {  
  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: "POST",
    credentials: 'same-origin',
    body: new URLSearchParams({
      action: 'get_five_movies',
    })
  });  

  const data = await response.json();
  return data;
}

export { honStepHandler };
