/**
 * Save selected movies for the given game type
 */
function saveSelectedMovies(game_type) {
  const selected = [];

  // Configure per game type
  let selector = '';
  let img_selector = '';
  let storageKey = '';

  if (game_type === 'hon') {
    selector = '.custom-movie-card.movie-added';
    img_selector = 'img.movie-card-img'
    storageKey = 'hotOrNotSelectedMovies';
  } else {
    selector = '.wof-movie-card.movie-added';
    img_selector = 'img.wof-movie-card-img'
    storageKey = 'hotOrNotSelectedMoviesWof';
  }

  document.querySelectorAll(selector).forEach(card => {
    selected.push({
      id: card.dataset.movieId,
      name: card.dataset.movieName,
      year: card.dataset.movieYear,
      poster: card.querySelector(img_selector)?.src || ''
    });
  });

  sessionStorage.setItem(storageKey, JSON.stringify(selected));
}

/**
 * Load selected movies from sessionStorage and populate UI
 */
function loadSelectedMovies(game_type, populator) {
  // Configure per game type
  let storageKey = '';

  if (game_type === 'hon') {
    storageKey = 'hotOrNotSelectedMovies';
  } else {
    storageKey = 'hotOrNotSelectedMoviesWof';
  }

  const selected = JSON.parse(sessionStorage.getItem(storageKey) || '[]');
  selected.forEach(movie => {
      populator(
        movie.name,
        movie.id,
        movie.year || 'N/A',
        movie.poster || '',
        movie.rating || 0
      );
  });
}

export { saveSelectedMovies, loadSelectedMovies };
