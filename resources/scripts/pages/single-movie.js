import { 
  tmdbSingleMovieHandler,
  movieWatchOn, 
  movieTrailer

  } from "@scripts/partials/tmdbControler";

  import { cyrillicFormat } from '@scripts/partials/textFormatingControler';

// Get the current URL
const url = window.location.href;
// Separate the URL from '/#'
const [baseUrl, movieDetails] = url.split('single-movie/');
// Extract the movie name and name_id
const [movie_name, movie_id] = movieDetails.split('&');

// Log the results
console.log('Movie Name:', movie_name);
console.log('Movie ID:', movie_id);

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