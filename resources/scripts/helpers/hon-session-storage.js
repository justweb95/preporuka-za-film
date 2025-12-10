import { populateMovieHandler } from "@scripts/partials/hon-custom-add";

function saveSelectedMovies() {
  const selected = [];
  document.querySelectorAll('.custom-movie-card.movie-added').forEach(card => {
    selected.push({
      id: card.dataset.movieId,
      name: card.dataset.movieName,
      year: card.dataset.movieYear,
      poster: card.querySelector('img.movie-card-img')?.src || ''
    });
  });
  sessionStorage.setItem('hotOrNotSelectedMovies', JSON.stringify(selected));
}

function loadSelectedMovies() {
  const selected = JSON.parse(sessionStorage.getItem('hotOrNotSelectedMovies') || '[]');
  selected.forEach(movie => {
    populateMovieHandler(
      movie.name,
      movie.id,
      movie.year || 'N/A',
      movie.poster || '',
      movie.rating || 0   // <-- provide default if expected
    );
  });
}

export { saveSelectedMovies, loadSelectedMovies}
