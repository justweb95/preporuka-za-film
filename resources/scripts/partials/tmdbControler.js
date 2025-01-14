



function tmdbCallHandler(movieParams) {
  // Keywords
  let key_words = [];
  // key_words.push(movieParams[0]);
  // key_words.push(movieParams[5]);
  // key_words = key_words.join(',');

  // console.log(key_words);
  

  //Genres 
  let with_genres = movieParams[2];
  with_genres = with_genres.join('%2C');

  // Adult movie
  let include_adult = movieParams[4];

  // How Old Movie
  let current_date = new Date(); // Get the current date
  let releaseYear = parseInt(movieParams[3]); // Convert to an integer
  let url_current_date = formatDate(current_date);

  // Subtract years and create past date
  let past_date = new Date(current_date.getFullYear() - releaseYear, current_date.getMonth(), current_date.getDate());
  let url_past_date = formatDate(past_date);


  const url = `https://api.themoviedb.org/3/discover/movie?include_adult=${include_adult}&with_genres=${with_genres}&primary_release_date.lte=${url_current_date}&primary_release_date.gte=${url_past_date}&include_video=true&language=sr-Latn&page=1&sort_by=popularity.desc&with_keywords=${key_words}`;
  
  const options = {
    method: 'GET',
    headers: {
      accept: 'application/json',
      Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJiYjRlNTRkYTQ4NTI0ZWU4ZWE0ZTk2NTA3NDQ5YzY5YyIsIm5iZiI6MTczNDYwNjE0OS40MTEsInN1YiI6IjY3NjNmZDQ1NmU1MmVkZDE2MDRhNDk0MSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.owZGL4jYtg_T6oLczlUCyNA5mJoawZ5urusJfe3B5SY'
    }
  };
  
  return fetch(url, options)
    .then(res => res.json())
    .then( async json => {
      const random = Math.floor(Math.random(0, 20) * 10);

      let movie_result = json.results[random];
      const movie_id = movie_result.id;

      let single_movie_result = await tmdbSingleMovieHandler(movie_id);
      
      console.log('movie_result');
      console.log(movie_result);

      console.log('single_movie_result');
      console.log(single_movie_result);

      return single_movie_result;
    })
    .catch(err => {
      console.error(err);
      throw err;
    });
}

async function tmdbSingleMovieHandler(movie_id) {
  const url = `https://api.themoviedb.org/3/movie/${movie_id}?language=sr-SR&include_video=true`;
  
  const options = {
    method: 'GET',
    headers: {
      accept: 'application/json',
      Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJiYjRlNTRkYTQ4NTI0ZWU4ZWE0ZTk2NTA3NDQ5YzY5YyIsIm5iZiI6MTczNDYwNjE0OS40MTEsInN1YiI6IjY3NjNmZDQ1NmU1MmVkZDE2MDRhNDk0MSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.owZGL4jYtg_T6oLczlUCyNA5mJoawZ5urusJfe3B5SY'
    }
  };

  return fetch(url, options)
  .then(res => res.json())
  .then(data => {
    return data
  })
  .catch(err => 
    console.log(err)
  )
}


function formatDate(date) {
  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const day = String(date.getDate()).padStart(2, '0');
  return `${year}-${month}-${day}`;
}


export { tmdbCallHandler }