// Amount of question show part of the code
const advance_questions = document.querySelectorAll('.advance-question-holder');
const expand_question_list = document.querySelector('.expand-question-list');

if (expand_question_list && advance_questions.length) {
  expand_question_list.addEventListener('click', (e) => {
    const btn = e.target.closest('.limit-button');
    if (!btn) return;

    const limit = parseInt(btn.dataset.limit, 10);
    if (!limit) return;

    document.querySelectorAll('.limit-button').forEach(b => b.classList.remove('active-limit'));
    btn.classList.add('active-limit');

    advance_questions.forEach(q => q.hidden = true);

    for (let i = 0; i < limit && i < advance_questions.length; i++) {
      advance_questions[i].hidden = false;
    }
  });
}

// Already watched movies note
const already_watched_switch = document.getElementById('already_watched_toggler');
const already_watched_note_on = document.getElementById('note_on');
const already_watched_note_off = document.getElementById('note_off');

already_watched_switch.addEventListener('change', (e) => {
  const isChecked = e.target.checked;
  already_watched_note_on.hidden = !isChecked;
  already_watched_note_off.hidden = isChecked;

  updateDisplayAlreadyWatched(isChecked ? '1' : '0');
});


async function updateDisplayAlreadyWatched(display) {
  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    credentials: 'include',
    body: new URLSearchParams({
      action: 'update_user_already_watched',
      display_already_watched: display
    })
  })
}



// Similar movie search bar function
const similarInput = document.getElementById('similar_films');
const suggestionsContainer = document.getElementById('similar_films_suggestions');
const selectedHiddenInput = document.getElementById('similar_films_selected');

// Container to display selected movies
let selectedMoviesContainer = document.createElement('div');
selectedMoviesContainer.classList.add('selected-movies-container');
similarInput.parentNode.appendChild(selectedMoviesContainer);

let fetchTimeout = null;
let selectedMovies = {}; // { movieId: { title, poster, release_year } }

// Disable form submission on Enter
similarInput.addEventListener('keydown', (e) => {
  if (e.key === 'Enter') e.preventDefault();
});

similarInput.addEventListener('input', (e) => {
  const query = e.target.value.trim();

  if (fetchTimeout) clearTimeout(fetchTimeout);

  if (query.length >= 3) {
    fetchTimeout = setTimeout(() => {
      fetchMovieSuggestions(query);
    }, 300);
  } else {
    suggestionsContainer.innerHTML = '';
  }
});

async function fetchMovieSuggestions(query) {
  try {
    const response = await fetch(pzfilm_globals.ajaxurl, {
      method: 'POST',
      credentials: 'include',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({
        action: 'fetch_movie_suggestions',
        movie_name: query,
      }),
    });

    const data = await response.json();

    if (data.success && data.data.suggestions?.length) {
      renderSuggestions(data.data.suggestions);
    } else {
      suggestionsContainer.innerHTML = '<p class="no-suggestions">Nema predloga</p>';
    }
  } catch (err) {
    console.error('Error fetching movie suggestions:', err);
    suggestionsContainer.innerHTML = '<p class="no-suggestions">Greška pri pretrazi</p>';
  }
}

function renderSuggestions(suggestions) {
  suggestionsContainer.innerHTML = '';
  suggestions.forEach((movie) => {
    const div = document.createElement('div');
    div.classList.add('suggestion-item');
    div.textContent = movie.title;
    div.dataset.movieId = movie.id;

    // Highlight if already selected
    if (selectedMovies[movie.id]) div.classList.add('selected');

    div.addEventListener('click', () => {
      // Store full movie object
      selectedMovies[movie.id] = {
        title: movie.title,
        poster: movie.poster,
        release_year: movie.release_year
      };
      similarInput.value = '';
      suggestionsContainer.innerHTML = '';
      renderSelectedMovies();
      updateHiddenInput();
    });

    suggestionsContainer.appendChild(div);
  });
}

function toggleSelectedMovie(id) {
  if (selectedMovies[id]) {
    delete selectedMovies[id];
  }
  renderSelectedMovies();
  updateHiddenInput();
}

function renderSelectedMovies() {
  selectedMoviesContainer.innerHTML = '';

  // Create an array to store movie names + years for hidden input
  const hiddenMovieData = [];

  for (const [id, movie] of Object.entries(selectedMovies)) {
    const div = document.createElement('div');
    div.classList.add('selected-movie');
    div.dataset.movieId = id;
    div.dataset.movieName = movie.title;
    div.dataset.movieYear = movie.release_year;

    // Add movie info to hidden data array
    hiddenMovieData.push(`${movie.title} (${movie.release_year || 'N/A'})`);

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

    // Click to remove
    div.addEventListener('click', () => toggleSelectedMovie(id));

    // Append elements
    div.appendChild(img);
    div.appendChild(h2);
    div.appendChild(p);

    selectedMoviesContainer.appendChild(div);
  }

  // Update hidden input with names + years
  selectedHiddenInput.value = hiddenMovieData.join(', ');
}

// Call this whenever movies are added/removed
function updateHiddenInput() {
  const hiddenMovieData = Object.values(selectedMovies)
    .map(movie => `${movie.title} (${movie.release_year || 'N/A'})`);
  selectedHiddenInput.value = hiddenMovieData.join(', ');
}
