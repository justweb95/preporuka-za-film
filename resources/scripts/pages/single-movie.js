import { 
  tmdbSingleMovieHandler,
  movieWatchOn, 
  movieTrailer

  } from "@scripts/partials/tmdbControler";

// Get the current URL
const url = window.location.href;
// Separate the URL from '/#'
const [baseUrl, movieDetails] = url.split('single-movie/');
// Extract the movie name and name_id
const [movie_name, movie_id] = movieDetails.split('-');

// Log the results
console.log('Movie Name:', movie_name);
console.log('Movie ID:', movie_id);

tmdbSingleMovieHandler(movie_id)
  .then((res) => {
    // Turn off loader;
    handleLoader();

    // Turn populate hero navigation;
    populateHeroNavigation(cyrillicFormat(res.genres[0].name), res.original_title);

    // Populate Hero Background Image
    populateHeroBackground(res.backdrop_path)
    
    
    console.log('Podaci skinuti');
    console.log(res);
  })
  .catch((err) => console.log(err))


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


function cyrillicFormat(text) {
  const cyrillicToLatinMap = {
    'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd',
    'ђ': 'đ', 'е': 'e', 'ж': 'ž', 'з': 'z', 'и': 'i',
    'ј': 'j', 'к': 'k', 'л': 'l', 'љ': 'lj', 'м': 'm',
    'н': 'n', 'њ': 'nj', 'о': 'o', 'п': 'p', 'р': 'r',
    'с': 's', 'т': 't', 'ћ': 'ć', 'у': 'u', 'ф': 'f',
    'х': 'h', 'ц': 'c', 'ч': 'č', 'џ': 'dž','ш': 'š',
    // Uppercase letters
    'А': 'A',  'Б': 'B',  'В': 'V',  'Г': 'G',
     'Д': 'D',  'Ђ': 'Đ',  'Е': 'E',  'Ж': 'Ž',
     'З': 'Z',  'И': 'I',  'Ј': 'J',  'К': 'K',
     'Л': 'L',  'Љ':'LJ','М':'M','Н':'N','Њ':'NJ',
     'О':'O','П':'P','Р':'R','С':'S','Т':'T',
     'Ћ':'Ć','У':'U','Ф':'F','Х':'H','Ц':'C',
     'Ч':'Č','Џ':'Dž', 'Ш':'Š'
  }


  return text.split('').map(char => cyrillicToLatinMap[char] || char).join('');
}