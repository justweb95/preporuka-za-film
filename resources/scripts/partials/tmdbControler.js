import { cyrillicFormat } from '@scripts/partials/textFormatingControler';

async function tmdbCallHandler(movieParams, is_single = false) {
  // If `is_single` is true, movieParams is a single movie object
  // If false, movieParams is an array of multiple movie objects

  let movieToUse;

  if (is_single) {
    movieToUse = movieParams; // movieParams is already a single object
  } else {
    // Randomly pick one movie from the array
    const randomIndex = Math.floor(Math.random() * movieParams.length);
    movieToUse = movieParams[randomIndex];
  }
  const url = `https://api.themoviedb.org/3/search/movie?query=${encodeURIComponent(movieToUse.movie_title)}&year=${movieToUse.movie_year}&language=sr-Latn&with_runtime.gte=40`;

  const options = {
    method: 'GET',
    headers: {
      accept: 'application/json',
      Authorization: `Bearer ${TMDB_API_KEY}`
    }
  };

  try {
    const res = await fetch(url, options);
    const json = await res.json();

    const movie_result = json.results[0];
    if (!movie_result) {
      throw new Error('Movie not found on TMDB');
    }

    const movie_id = movie_result.id;

    let single_movie_result = await tmdbSingleMovieHandler(movie_id);
    let single_movie_trailer = await movieTrailer(movie_id);
    let single_movie_watch_on = await movieWatchOn(movie_id);
    let single_movie_credits = await movieCredits(movie_id);

    single_movie_result.video_trailer = single_movie_trailer.results[0] || null;
    single_movie_result.movie_watch_on = single_movie_watch_on.results['US'] || { buy: [] };

    single_movie_result.single_movie_cast = single_movie_credits.cast?.slice(0, 5) || [];
    single_movie_result.single_movie_director = single_movie_credits.crew?.filter(m => m.department === 'Directing') || [];
    single_movie_result.single_movie_writer = single_movie_credits.crew?.filter(m => m.department === 'Writing') || [];

    single_movie_result.genres = single_movie_result.genres?.[0]?.name
      ? cyrillicFormat(single_movie_result.genres[0].name.replace(/^"|"$/g, ''))
      : 'Nepoznato';

    single_movie_result.title = cyrillicFormat(single_movie_result.title || 'Naslov nedostupan');
    single_movie_result.overview = single_movie_result.overview
      ? cyrillicFormat(single_movie_result.overview)
      : 'Opis filma trenutno nije dostupan';

    const response = await createMoviePost(single_movie_result);
    single_movie_result.url = response?.data?.post_url || '#';

    return single_movie_result;

  } catch (err) {
    console.error('tmdbCallHandler error:', err);
    return {
      title: movieToUse.movie_title || 'Naslov nedostupan',
      overview: 'Opis filma trenutno nije dostupan',
      url: '#',
      video_trailer: null,
      movie_watch_on: { buy: [] },
      genres: 'Nepoznato',
      single_movie_cast: [],
      single_movie_director: [],
      single_movie_writer: []
    };
  }
}


// Map all movies in the array
async function tmdbAllMoviesHandler(movieParams) {
  try {
    // Map all movies to promises
    const promises = movieParams.map((movie) => tmdbCallHandler(movie, true));

    // Wait for all TMDB calls to finish
    const movieResponse = await Promise.all(promises);

    return movieResponse;

  } catch (error) {
    console.log('Error fetching all movies:', error);
    return movieParams.map(movie => ({
      id: 0,
      title: movie.movie_title || 'Naslov nedostupan',
      overview: 'Opis filma trenutno nije dostupan',
      url: '#',
      video_trailer: null,
      movie_watch_on: { buy: [] },
      genres: 'Nepoznato',
      single_movie_cast: [],
      single_movie_director: [],
      single_movie_writer: []
    }));
  }
}

async function tmdbSingleMovieHandler(movie_id) {
  const url = `https://api.themoviedb.org/3/movie/${movie_id}?language=sr-SR&include_video=true`;
  return fetchDataControler(url);
}


async function movieTrailer(movie_id) {
  const url = `https://api.themoviedb.org/3/movie/${movie_id}/videos?language=en-US`;
  
  return fetchDataControler(url);
}

async function movieWatchOn(movie_id) {
  const url = `https://api.themoviedb.org/3/movie/${movie_id}/watch/providers`;
  
  return fetchDataControler(url);
}

async function movieCredits(movie_id) {
  const url = `https://api.themoviedb.org/3/movie/${movie_id}/credits?language=en-US`;
  
  return fetchDataControler(url);
}

function formatDate(date) {
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const day = String(date.getDate()).padStart(2, '0');
  return `${year}-${month}-${day}`;
}


async function fetchDataControler(url) {
  const options = {
    method: 'GET',
    headers: {
      accept: 'application/json',
      Authorization: `Bearer ${TMDB_API_KEY}`
    }
  };

  return fetch(url, options)
  .then(res => res.json())
  .then(data => {
    return data
  })
  .catch(err => {
    return 'Something Went wrong' + err;
  })
}



const createMoviePost = async (movie_data) => {
  try {
      const response = await fetch(movieAjax.ajax_url, {
          method: 'POST',
          headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: new URLSearchParams({
              action: 'save_movie',
              nonce: movieAjax.nonce, 
              movie_data: JSON.stringify({movie_data}), 
          }),
      });

      const data = await response.json();

      if (data.success) {
        // console.log('Movie created successfully!')
        return data;
      } else {
        // console.log('Movie with this ID already exists!')  
      }
  } catch (error) {
    console.log('Movie with this ID already exists! Post ID: ' + error)  
  }
};

export { tmdbCallHandler, tmdbAllMoviesHandler, tmdbSingleMovieHandler, movieWatchOn, movieTrailer }