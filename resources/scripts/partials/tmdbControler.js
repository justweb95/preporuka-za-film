import { cyrillicFormat } from '@scripts/partials/textFormatingControler';

async function tmdbCallHandler(movieParams) {

  let rendom_movie = Math.floor(Math.random() * 5);
  // console.log('rendom_movie');
  // console.log(rendom_movie);

  // console.log('Ime Filma');
  // console.log(movieParams[rendom_movie].movie_title);

  // console.log('Kada je film izasao');
  // console.log(movieParams[rendom_movie].movie_year);
  
  // Keywords
  // let key_words = [];
  // key_words = key_words.join('|');

  // //Genres 
  // let with_genres = movieParams[2];
  // with_genres = with_genres.join('%2C');

  // // Adult movie
  // let include_adult = movieParams[4];

  // // How Old Movie
  // let current_date = new Date(); // Get the current date
  // let releaseYear = parseInt(movieParams[3]); // Convert to an integer
  // let url_current_date = formatDate(current_date);

  // // Subtract years and create past date
  // let past_date = new Date(current_date.getFullYear() - releaseYear, current_date.getMonth(), current_date.getDate());
  // let url_past_date = formatDate(past_date);


  // const url = `https://api.themoviedb.org/3/discover/movie?include_adult=${include_adult}&with_genres=${with_genres}&primary_release_date.lte=${url_current_date}&primary_release_date.gte=${url_past_date}&include_video=true&language=sr-Latn&page=1&sort_by=popularity.desc&with_keywords=${key_words}&with_origin_country=US%7CSRB%7CES%7CCA%7CMX%7CGB%7CDE%7CFR%7CBR'`;
  const url = `https://api.themoviedb.org/3/search/movie?query=${encodeURIComponent(movieParams[rendom_movie].movie_title)}&year=${movieParams[rendom_movie].movie_year}&language=sr-Latn&with_runtime.gte=40`;

  
  const options = {
    method: 'GET',
    headers: {
      accept: 'application/json',
      Authorization: `Bearer ${TMDB_API_KEY}`
    }
  };
  
  return fetch(url, options)
    .then(res => res.json())
    .then( async json => {
      let movie_result = json.results[0];      
      const movie_id = movie_result.id;

      let single_movie_result = await tmdbSingleMovieHandler(movie_id);
      let single_movie_trailer = await movieTrailer(movie_id);
      let single_movie_watch_on = await movieWatchOn(movie_id);
      let single_movie_credits = await movieCredits(movie_id);
      
      single_movie_result.video_trailer = single_movie_trailer.results[0];
      single_movie_result.movie_watch_on = single_movie_watch_on.results['US'];

      single_movie_result.single_movie_cast = single_movie_credits.cast.slice(0, 5);
      single_movie_result.single_movie_director = single_movie_credits.crew.filter(member => member.department === 'Directing');
      single_movie_result.single_movie_writer = single_movie_credits.crew.filter(member => member.department === 'Writing');

      single_movie_result.genres = cyrillicFormat(single_movie_result.genres[0].name.replace(/^"|"$/g, ''));

      single_movie_result.title = cyrillicFormat(single_movie_result.title);
      single_movie_result.overview = single_movie_result.overview ? cyrillicFormat(single_movie_result.overview) : "Trenutno nema opis za ovaj film";

      // console.log('single_movie_result');
      // console.log(single_movie_result);

      // Call Create movie Post function
      let response = await createMoviePost(single_movie_result);

      single_movie_result.url = response.data.post_url;
      
      return single_movie_result;
    })
    .catch(err => {
      console.error(err);
      throw err;
    });
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
        console.log('Movie created successfully!')
        return data;
      } else {
        console.log('Movie with this ID already exists!')  
      }
  } catch (error) {
    console.log('Movie with this ID already exists! Post ID: ' + error)  
  }
};

export { tmdbCallHandler, tmdbSingleMovieHandler, movieWatchOn, movieTrailer }