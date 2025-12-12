import confetti from 'canvas-confetti';
import { poplateResult } from '@scripts/helpers/recommendation-results-helper.js';
import { showToast } from "@scripts/helpers/toastify-helper";

import {
  collectProgressItems,
  handleProgressNumber,
  handleProgressCheckbox
} from '../partials/hon-progress.js'


// Hot or Not Variables
let step_index = 1;
let five_movie_array = [];
let currentIndex = 2;
let leftMovie = null;
let rightMovie = null;

const steps_id = [
  'hot_or_not_home',
  'hon_add_custom',
  'hon_pop_up',
  'hon_game',
  'game_results',
]

const backButtons = document.querySelectorAll('.back-button'); // note the dot
if (backButtons.length > 0) {
  backButtons.forEach(button => {
    button.addEventListener('click', () => stepBackHandler(step_index));
  });
}

function stepBackHandler(current_step) {
  honStepHandler(1);
}


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
    const fiveMovieAdded = five_movie_array.every(movie => movie.id && movie.id.trim() !== '');

    if (!fiveMovieAdded) {
      showToast('Još filmova nedostaje dodajte svih 5!')
      return;
    }
    
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

  const leftSlot = document.querySelector('.hon-option-card.left');
  const rightSlot = document.querySelector('.hon-option-card.right');

  // Add initial slide-in classes
  leftSlot.classList.add('initial-slide-left');
  rightSlot.classList.add('initial-slide-right');

  renderMovies(leftMovie, rightMovie);

  // Remove initial animation classes after they finish
  setTimeout(() => {
    leftSlot.classList.remove('initial-slide-left');
    rightSlot.classList.remove('initial-slide-right');
  }, 500); // match animation duration
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

function pickMovie(side) {
  const leftSlot = document.querySelector('.hon-option-card.left');
  const rightSlot = document.querySelector('.hon-option-card.right');

  const chosenSlot = side === 'left' ? leftSlot : rightSlot;
  const otherSlot = side === 'left' ? rightSlot : leftSlot;

  // Animate chosen and unchosen cards
  otherSlot.classList.add('shrink-fade');
  chosenSlot.classList.add('chosen-scale');


    // Check if last movie
  if (currentIndex >= 5) {
    const lastPicked = side === "left" ? leftMovie : rightMovie;
    gameEnd(lastPicked); // no animation for last step
    return;
  }

  setTimeout(() => {
    // Reset classes
    chosenSlot.classList.remove('chosen-scale');
    otherSlot.classList.remove('shrink-fade');

    const nextMovie = five_movie_array[currentIndex];
    currentIndex++;

    if (side === "left") {
      rightMovie = nextMovie;
      updateSlotWithAnimation('.hon-option-card.right', rightMovie, 'right');
    } else {
      leftMovie = nextMovie;
      updateSlotWithAnimation('.hon-option-card.left', leftMovie, 'left');
    }

    // Update progress
    collectProgressItems();
    handleProgressNumber(currentIndex - 2);
    handleProgressCheckbox(currentIndex - 2);

  }, 350); // match CSS transition duration
}


// Animate new movie slide-in when updating a slot
function updateSlotWithAnimation(slotSelector, movie, side) {
  const slot = document.querySelector(slotSelector);

  // Add slide-in animation class before setting innerHTML
  const slideClass = side === 'left' ? 'slide-in-left' : 'slide-in-right';
  slot.classList.add(slideClass);

  // Set content
  slot.innerHTML = createMovieCardHTML(movie);

  // Remove slide-in class after animation
  setTimeout(() => {
    slot.classList.remove(slideClass);
  }, 350);

  // Add click event
  slot.querySelector('.choose-movie-btn').addEventListener('click', () => pickMovie(side));
}

async function gameEnd(resultObject) {
  const chosenMovie = await getMovieForGame(resultObject.id);
  const isPopulated = await poplateResult(chosenMovie);

  if(isPopulated) {
    confetti({particleCount: 100,  spread: 70,  origin: { x: 0.7, y: 0.5 }});
    confetti({particleCount: 100,  spread: 70,  origin: { x: 0.3, y: 0.6 }});
    honStepHandler(5);
  }
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

async function getMovieForGame(movie_id) {
  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    body: new URLSearchParams({
      action: 'get_movie_for_result',
      movie_id: movie_id
    }),
    credentials: 'same-origin'
  });
  
  const data = await response.json();

  if (!data.success) {
    console.error('Movie data not found:', data);
    return;
  }

  return data.data
}

export { honStepHandler };
