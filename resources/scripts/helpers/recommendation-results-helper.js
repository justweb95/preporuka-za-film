import { cyrillicFormat, durationFromat } from '@scripts/partials/textFormatingControler';

export async function poplateResult(resultObject) {
  let tmdbData = await resultObject

  let poster_holder = document.querySelector('#result-poster');
  let poster_holder_mobile = document.querySelector('#result-description-poster');
  let result_content_title = document.querySelector('#result-content-title');
  let result_description_text = document.querySelector('#result-description-text');
  let imdb_rating = document.querySelector('#imdb-rating');
  let result_genres_text = document.querySelector('#result-genres-text');
  let result_year_text = document.querySelector('#result-year-text');
  let result_cta_read_more = document.querySelector('.result-cta-read-more');
  let result_cta_trailer = document.querySelector('.result-cta-trailer');
  let movie_duration = document.querySelector('#result-duration-text');
  let youtube_player = document.querySelector('#youtube-player');

  let affiliate_amazon = document.querySelector('.affiliate-amazon');


  poster_holder.setAttribute('src', `https://media.themoviedb.org/t/p/w300_and_h450_bestv2/${tmdbData.poster_path}`)
  poster_holder_mobile.setAttribute('src', `https://media.themoviedb.org/t/p/w300_and_h450_bestv2/${tmdbData.poster_path}`)
  
  // result_content_title.textContent = tmdbData.original_title;
  result_content_title.textContent = cyrillicFormat(tmdbData.title);
  imdb_rating.textContent = parseFloat(tmdbData.vote_average.toFixed(1));

  result_description_text.textContent = cyrillicFormat(tmdbData.overview.substring(0, 300));

  result_genres_text.textContent = cyrillicFormat(tmdbData.genres);
  movie_duration.textContent = durationFromat(tmdbData.runtime);
  result_year_text.textContent = tmdbData.release_date.split('-')[0];


  // Set the href attribute to the result_cta_read_more element
  const fullUrl = tmdbData.url;
  result_cta_read_more.setAttribute('href', fullUrl);


  if (tmdbData.video_trailer && tmdbData.video_trailer.key) {
    youtube_player.setAttribute('src', `https://www.youtube.com/embed/${tmdbData.video_trailer.key}`);
  } else {
    result_cta_trailer.setAttribute('aria-disabled', 'true');
    result_cta_trailer.disabled = true;
  }

  let amazonProvider;

  if (tmdbData.movie_watch_on && Array.isArray(tmdbData.movie_watch_on.buy)) {
    amazonProvider = tmdbData.movie_watch_on.buy.find(provider => 
      provider.provider_name === 'Amazon Video' || provider.provider_name === 'Amazon Prime Video'
    );
  } else {
    // console.log("movie_watch_on or buy array does not exist.");
    
  }

  if (amazonProvider) {
    affiliate_amazon.setAttribute('href', `https://www.amazon.com/gp/video/primesignup?tag=preporukazafi-20`);
    affiliate_amazon.removeAttribute('aria-disabled');
    affiliate_amazon.style.opacity = '1';
    affiliate_amazon.style.pointerEvents = 'auto';
    affiliate_amazon.disabled = false;
  } else {
    affiliate_amazon.setAttribute('aria-disabled', 'true');
    affiliate_amazon.style.opacity = '.6';
    affiliate_amazon.style.pointerEvents = 'none';
    affiliate_amazon.disabled = true;
  }
  return true;
}


export function populateMultipleResults(resultsArray) {
  console.log('resultsArray', resultsArray);

  const container = document.querySelector('#results');
  container.innerHTML = '';

  resultsArray.forEach((tmdbData, index) => {
    const movieCard = document.createElement('div');
    movieCard.className = 'movie-card'; // template class
    movieCard.dataset.index = index;

    // Poster
    const posterWrapper = document.createElement('div');
    posterWrapper.className = 'movie-card__poster';
    const poster = document.createElement('img');
    if (tmdbData.poster_path) {
      poster.src = `https://media.themoviedb.org/t/p/w300_and_h450_bestv2/${tmdbData.poster_path}`;
      poster.alt = tmdbData.title || 'Movie Poster';
    } else {
      console.warn(`Movie ${index} missing poster_path`);
      poster.src = 'https://via.placeholder.com/300x450?text=No+Poster';
      poster.alt = 'No Poster';
    }
    posterWrapper.appendChild(poster);
    movieCard.appendChild(posterWrapper);

    // Info Wrapper
    const info = document.createElement('div');
    info.className = 'movie-card__info';

    // Title
    const title = document.createElement('h3');
    title.className = 'movie-card__title';
    title.textContent = tmdbData.title ? cyrillicFormat(tmdbData.title) : 'Untitled';
    if (!tmdbData.title) console.warn(`Movie ${index} missing title`);
    info.appendChild(title);

    // IMDb Rating
    const rating = document.createElement('p');
    rating.className = 'movie-card__rating';
    const vote = (tmdbData.vote_average != null) ? parseFloat(tmdbData.vote_average.toFixed(1)) : 'N/A';
    if (vote === 'N/A') console.warn(`Movie ${index} missing vote_average`);
    rating.textContent = `IMDb: ${vote}`;
    info.appendChild(rating);

    // Genres
    const genres = document.createElement('p');
    genres.className = 'movie-card__genres';
    if (tmdbData.genres) {
      genres.textContent = Array.isArray(tmdbData.genres)
        ? cyrillicFormat(tmdbData.genres.map(g => g.name).join(', '))
        : cyrillicFormat(tmdbData.genres);
    } else {
      genres.textContent = 'N/A';
      console.warn(`Movie ${index} missing genres`);
    }
    info.appendChild(genres);

    // Year & Duration
    const yearDuration = document.createElement('p');
    yearDuration.className = 'movie-card__year-duration';
    const releaseYear = tmdbData.release_date ? tmdbData.release_date.split('-')[0] : 'N/A';
    const duration = tmdbData.runtime ? durationFromat(tmdbData.runtime) : 'N/A';
    if (!tmdbData.release_date) console.warn(`Movie ${index} missing release_date`);
    if (!tmdbData.runtime) console.warn(`Movie ${index} missing runtime`);
    yearDuration.textContent = `${releaseYear} • ${duration}`;
    info.appendChild(yearDuration);

    // Overview
    const overview = document.createElement('p');
    overview.className = 'movie-card__overview';
    overview.textContent = tmdbData.overview
      ? cyrillicFormat(tmdbData.overview.substring(0, 300))
      : 'Opis filma trenutno nije dostupan';
    if (!tmdbData.overview) console.warn(`Movie ${index} missing overview`);
    info.appendChild(overview);

    // Read More
    const readMore = document.createElement('a');
    readMore.className = 'movie-card__read-more';
    if (tmdbData.url) {
      readMore.href = tmdbData.url;
      readMore.textContent = 'Pročitaj više';
    } else {
      console.warn(`Movie ${index} missing URL`);
      readMore.href = '#';
      readMore.textContent = 'Link nije dostupan';
    }
    info.appendChild(readMore);

    // Trailer
    const trailerWrapper = document.createElement('div');
    trailerWrapper.className = 'movie-card__trailer';
    const trailer = document.createElement('iframe');
    trailer.allowFullscreen = true;
    if (tmdbData.video_trailer && tmdbData.video_trailer.key) {
      trailer.src = `https://www.youtube.com/embed/${tmdbData.video_trailer.key}`;
    } else {
      console.warn(`Movie ${index} missing video_trailer`);
      trailer.style.display = 'none';
    }
    trailerWrapper.appendChild(trailer);
    info.appendChild(trailerWrapper);

    // Amazon link
    const amazonLink = document.createElement('a');
    amazonLink.className = 'movie-card__amazon';
    amazonLink.textContent = 'Pogledaj na Amazonu';
    if (tmdbData.movie_watch_on && Array.isArray(tmdbData.movie_watch_on.buy)) {
      const amazonProvider = tmdbData.movie_watch_on.buy.find(p =>
        p.provider_name === 'Amazon Video' || p.provider_name === 'Amazon Prime Video'
      );
      if (amazonProvider) {
        amazonLink.href = 'https://www.amazon.com/gp/video/primesignup?tag=preporukazafi-20';
        amazonLink.style.opacity = '1';
        amazonLink.style.pointerEvents = 'auto';
      } else {
        console.warn(`Movie ${index} has no Amazon provider`);
        amazonLink.setAttribute('aria-disabled', 'true');
        amazonLink.style.opacity = '.6';
        amazonLink.style.pointerEvents = 'none';
        amazonLink.href = '#';
      }
    } else {
      console.warn(`Movie ${index} missing movie_watch_on or buy array`);
      amazonLink.setAttribute('aria-disabled', 'true');
      amazonLink.style.opacity = '.6';
      amazonLink.style.pointerEvents = 'none';
      amazonLink.href = '#';
    }
    info.appendChild(amazonLink);

    movieCard.appendChild(info);
    container.appendChild(movieCard);
  });

  return true;
}
