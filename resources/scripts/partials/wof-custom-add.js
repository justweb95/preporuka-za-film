import { scrolToTop } from "@scripts/helpers/scrool-to-top-helper";
import { saveSelectedMovies, loadSelectedMovies } from "@scripts/helpers/session-storage";
import { showToast } from "@scripts/helpers/toastify-helper";

loadSelectedMovies('wof', populateMovieHandlerWof);

const customMovieCards = document.querySelectorAll('.wof-movie-card');

if(customMovieCards.length) {
  customMovieCards.forEach(btn => {
    btn.addEventListener('click', (e) => {
      if(e.currentTarget.classList.contains('movie-added')) {
        removeMovieFromCard(btn);
        removePosterFromWheelSlice(btn)
        return
      }

      wofPopUpHandler(true);
      handleFilterChange(0)
    })
  })
}

const searchResultsAddMovie = document.querySelectorAll('.wof-search-results-add-movie');
searchResultsAddMovie.forEach(btn => btn.addEventListener('click', (e) => {

  const selected_movie = e.currentTarget.parentNode.querySelector('.single-movie-card'); 

  const img = selected_movie.querySelector('img.movie-card-poster').src;
  const name = selected_movie.querySelector('h2').textContent;
  const year = selected_movie.querySelector('p').textContent.replace('Godina: ', '');
  const movieID = selected_movie.dataset.movieId;
  
  if(selected_movie) {    
    // console.log("Film Je Selectovan");
    wofPopUpHandler(false);
    handleFilterChange(0);
    populateMovieHandlerWof(name, movieID, year, img)
  } 
}))

function populateMovieHandlerWof(movie_name, movie_id, movie_year, movie_poster) {
  // Find the first empty card
  const emptyCard = document.querySelector('.wof-movie-card.empty-card');
  if (!emptyCard) {
    showToast('Nema više slobodnih mesta za filmove!');
    return;
  }

  const button = emptyCard.querySelector('.wof-movie-btn');

  // Fill card with movie data
  emptyCard.classList.remove('empty-card');
  emptyCard.classList.add('movie-added');

  emptyCard.dataset.movieId = movie_id;
  emptyCard.dataset.movieName = movie_name;
  emptyCard.dataset.movieYear = movie_year;

  // Update button content with image + remove icon
  button.dataset.tooltip = 'Izbaci film';
  button.innerHTML = `
    <img class="wof-movie-card-img" src="${movie_poster}" alt="${movie_name} Poster">
    <svg class="wof-remove-movie-icon" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
      <rect x="0.5" y="0.5" width="59" height="59" rx="29.5" fill="#22374A" fill-opacity="0.5"/>
      <rect x="0.5" y="0.5" width="59" height="59" rx="29.5" stroke="#22374A"/>
      <path d="M20 30L40 30" stroke="#EDFEEC" stroke-width="2"/>
    </svg>
  `;

  // Poppulate wheel
  populateWofWheel(movie_name, movie_id, movie_year, movie_poster)

  saveSelectedMovies('wof');

  const newButton = button.cloneNode(true);
  button.replaceWith(newButton);
  newButton.addEventListener('click', (e) => {
    e.stopPropagation();
    removeMovieFromCard(emptyCard);
    removePosterFromWheelSlice(emptyCard);
  });
}

function populateWofWheel(movie_name, movie_id, movie_year, movie_poster) {
  const emptyCircleSlice = document.querySelector('.wof-slice.empty-slice');
  if (!emptyCircleSlice) {
    showToast('Nema više slobodnih mesta za filmove!');
    return;
  }

  const poster_element = document.createElement('img');
  poster_element.src = movie_poster;
  poster_element.alt = movie_name;

  emptyCircleSlice.dataset.wheelMovieId = movie_id;
  emptyCircleSlice.dataset.wheelMovieName = movie_name;
  emptyCircleSlice.dataset.wheelMovieYear = movie_year;

  emptyCircleSlice.classList.add('movie-added-in-slice');
  emptyCircleSlice.classList.remove('empty-slice');
  
  emptyCircleSlice.appendChild(poster_element);
}

function removePosterFromWheelSlice(card) {
  const slices = document.querySelectorAll('.wof-slice.movie-added-in-slice');

  for (const slice of slices) {
    if (slice.dataset.wheelMovieId === card.dataset.movieId) {
      slice.querySelector('img')?.remove();

      slice.classList.remove('movie-added-in-slice');
      slice.classList.add('empty-slice');

      delete slice.dataset.wheelMovieId;
      delete slice.dataset.wheelMovieName;
      delete slice.dataset.wheelMovieYear;
      break;
    }
  }
}


function removeMovieFromCard(card) {
  const button = card.querySelector('.wof-movie-btn');
  card.classList.remove('movie-added');
  card.classList.add('empty-card');

  // Reset button content to "add" icon
  button.dataset.tooltip = 'Dodaj film';
  button.innerHTML = `
    <svg class="wof-add-movie-icon" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
      <rect x="0.5" y="0.5" width="59" height="59" rx="29.5" fill="#22374A" fill-opacity="0.5"/>
      <rect x="0.5" y="0.5" width="59" height="59" rx="29.5" stroke="#22374A"/>
      <path d="M30 40L30 20" stroke="#EDFEEC" stroke-width="2"/>
      <path d="M20 30L40 30" stroke="#EDFEEC" stroke-width="2"/>
    </svg>
  `;

  saveSelectedMovies('wof');

  const newButton = button.cloneNode(true);
  button.replaceWith(newButton);
  newButton.addEventListener('click', (e) => {
    e.preventDefault();
    wofPopUpHandler(true);
    handleFilterChange(0);
  });
}


let searchFilterIndex = 0;
const searchResultsFilterH3 = document.querySelector('.wof-search-results-filter');
const searchResultsFilterControlBtns = document.querySelector('.wof-search-results-filter-control');
const searchResultsContent = document.querySelectorAll('.wof-search-results-content');

if(searchResultsFilterControlBtns) {
  searchResultsFilterControlBtns.addEventListener('click', (e) => {
  const isForward = e.target.dataset.isForward === 'true';
  searchFilterIndex = isForward ? searchFilterIndex + 1 : searchFilterIndex - 1;

  handleFilterChange(searchFilterIndex)    
})
}

function handleFilterChange(filterIndex) {
  if(filterIndex === 4) {
    searchResultsContent.forEach(filter => filter.classList.remove('show-filter-results'));
    searchResultsContent[3].classList.add('show-filter-results');
    searchResultsFilterH3.textContent = 'Rezultati Pretrage';
    return
  }

  if (filterIndex > 2) filterIndex = 0;
  if (filterIndex < 0) filterIndex = 2;

  searchFilterIndex = filterIndex;

  searchResultsContent.forEach(filter => filter.classList.remove('show-filter-results'));
  searchResultsContent[filterIndex].classList.add('show-filter-results');

  switch (filterIndex) {
    case 0:
      searchResultsFilterH3.textContent = 'Poslednje preporuke';
      break;
    case 1:
      searchResultsFilterH3.textContent = 'Omiljeni filmovi';
      break;
    case 2:
      searchResultsFilterH3.textContent = 'Već gledano';
      break;  
    default:
      searchResultsFilterH3.textContent = 'Pretraga';
      break;
  }
}

// Custom Search Input render Movie Cards
const MIN_INPUT_LENGTH = 3;
const customSearchInput = document.querySelector('.wof-pop-up-search-input');
const suggestionsContainer = document.getElementById('wof-custom-search-list');

if (customSearchInput) {
  let debounceTimeout = null;

  customSearchInput.addEventListener('input', (e) => {
    const query = e.target.value.trim();

    if (query.length < MIN_INPUT_LENGTH) return;

    if (debounceTimeout) clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
      customSearchHandler(query);
      handleFilterChange(4);
    }, 300);
  });
}

async function customSearchHandler(search_query) {
  try {
    const response = await fetch(pzfilm_globals.ajaxurl, {
      method: 'POST',
      credentials: 'include',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({
        action: 'fetch_movie_suggestions',
        movie_name: search_query,
      }),
    });

    const data = await response.json();

    if (data.success && data.data.suggestions?.length) {
      renderSearchedMovieCard(data.data.suggestions);
    } else {
      suggestionsContainer.innerHTML = '<p class="no-suggestions">Nema predloga</p>';
    }
  } catch (err) {
    console.error('Error fetching movie suggestions:', err);
    suggestionsContainer.innerHTML = '<p class="no-suggestions">Greška pri pretrazi</p>';
  }
}

function renderSearchedMovieCard(suggestions) {
  // Clear previous suggestions
  suggestionsContainer.innerHTML = '';

  if (!suggestions.length) return;

  suggestions.forEach((movie) => {
    const li = document.createElement('li');
    li.classList.add('wof-search-results-content-card');

    const article = document.createElement('article');
    article.classList.add('single-movie-card');
    article.dataset.movieId = movie.id;
    article.dataset.movieName = movie.title;
    article.dataset.movieYear = movie.release_year;

    // Movie poster
    const img = document.createElement('img');
    img.src = movie.poster ? `https://image.tmdb.org/t/p/w200${movie.poster}` : 'https://via.placeholder.com/150x225?text=No+Image';
    img.alt = `${movie.title} Poster`;
    img.classList.add('movie-card-poster');

    // Movie title
    const h2 = document.createElement('h2');
    h2.textContent = movie.title;

    // Movie year
    const p = document.createElement('p');
    p.textContent = `Godina: ${movie.release_year || 'N/A'}`;

    const btn = document.createElement('button');
    btn.classList.add('wof-search-results-add-movie');
    btn.innerHTML = `
      <svg class="wof-add-movie-icon" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="0.5" y="0.5" width="59" height="59" rx="29.5" fill="#06131E" fill-opacity="0.8"/>
        <rect x="0.5" y="0.5" width="59" height="59" rx="29.5" stroke="#22374A"/>
        <path d="M30 40L30 20" stroke="#EDFEEC" stroke-width="2"/>
        <path d="M20 30L40 30" stroke="#EDFEEC" stroke-width="2"/>
      </svg>`;

    // Click to add movie to selected
    btn.addEventListener('click', () => {
      customSearchInput.value = '';
      wofPopUpHandler(false);
      handleFilterChange(0);
      populateMovieHandlerWof(movie.title, movie.id, movie.release_year, `https://image.tmdb.org/t/p/w200${movie.poster}`)
    });

    // Append elements
    article.appendChild(img);
    article.appendChild(h2);
    article.appendChild(p);
    article.appendChild(btn);

    li.appendChild(article);

    suggestionsContainer.appendChild(li);
  });
}


const addMoviePopUp = document.getElementById('wheel_of_fortune_pop_up');
// Close Pop Up Handler
const closeMoviePopUpBTN = document.querySelector('.wof-pop-up-close-btn');
// Opening modal Modal 
function wofPopUpHandler(isOpen) {
  addMoviePopUp.hidden = !isOpen;
  
  document.body.classList.toggle('disable-scroll', isOpen);

  if(isOpen) {
    scrolToTop();
  }

  handleFilterChange(0);
}

// CLosing Modal 
closeMoviePopUpBTN.addEventListener('click', () => wofPopUpHandler(false));

export { populateMovieHandlerWof, removeMovieFromCard, wofPopUpHandler };