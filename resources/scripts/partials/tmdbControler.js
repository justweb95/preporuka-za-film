



function tmdbCallHandler(movieParams) {
  //Genres 
  let with_genres = movieParams[2];
  with_genres = with_genres.join('%2C');

  // Adult movie
  let include_adult = movieParams[4];

  const url = `https://api.themoviedb.org/3/discover/movie?include_adult=${include_adult}&with_genres=${with_genres}&include_video=false&language=sr-Latn&page=1&sort_by=popularity.desc`;
  
  const options = {
    method: 'GET',
    headers: {
      accept: 'application/json',
      Authorization: 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiJiYjRlNTRkYTQ4NTI0ZWU4ZWE0ZTk2NTA3NDQ5YzY5YyIsIm5iZiI6MTczNDYwNjE0OS40MTEsInN1YiI6IjY3NjNmZDQ1NmU1MmVkZDE2MDRhNDk0MSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.owZGL4jYtg_T6oLczlUCyNA5mJoawZ5urusJfe3B5SY'
    }
  };
  
  return fetch(url, options)
    .then(res => res.json())
    .then(json => {
      const random = parseInt(Math.random(0, 20) * 10);
      let movie_result = json.results[random];
      console.log(movie_result);
      
      return movie_result;
    })
    .catch(err => {
      console.error(err);
      throw err;
    });
}




export { tmdbCallHandler }