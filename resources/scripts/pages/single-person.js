const FILMOGRAPHY_LOADING_TEXT = 'Ucitavanje filmografije....';

function renderMovieCard(container, movie) {
  const hasLink = Boolean(movie?.permalink);
  const el = document.createElement(hasLink ? 'a' : 'div');
  el.className = hasLink
    ? 'pz-person-movie-card'
    : 'pz-person-movie-card pz-person-movie-card--disabled';

  if (hasLink) {
    el.href = movie.permalink;
  } else {
    el.setAttribute('aria-disabled', 'true');
  }

  const posterWrap = document.createElement('div');
  posterWrap.className = 'pz-person-movie-poster';
  posterWrap.setAttribute('aria-hidden', 'true');

  if (movie?.poster_url) {
    const img = document.createElement('img');
    img.src = movie.poster_url;
    img.alt = movie?.title || '';
    img.loading = 'lazy';
    img.decoding = 'async';
    img.width = 300;
    img.height = 450;
    posterWrap.appendChild(img);
  }

  const body = document.createElement('div');
  body.className = 'pz-person-movie-body';

  const title = document.createElement('h3');
  title.className = 'pz-person-movie-title';
  title.textContent = movie?.title || '';

  const meta = document.createElement('div');
  meta.className = 'pz-person-movie-meta';

  if (movie?.year) {
    meta.textContent = String(movie.year);
  } else {
    const muted = document.createElement('span');
    muted.className = 'pz-person-movie-meta-muted';
    muted.textContent = 'Bez godine';
    meta.appendChild(muted);
  }

  body.appendChild(title);
  body.appendChild(meta);

  if (movie?.role) {
    const role = document.createElement('div');
    role.className = 'pz-person-movie-role';
    role.textContent = movie.role;
    body.appendChild(role);
  }

  el.appendChild(posterWrap);
  el.appendChild(body);

  container.appendChild(el);
}

async function fetchFilmography(personId) {
  const formData = new FormData();
  formData.append('action', 'pzfilm_person_filmography');
  formData.append('person_id', String(personId));
  formData.append('nonce', pzfilm_globals?.nonce || '');

  const res = await fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    credentials: 'include',
    body: formData,
  });

  const data = await res.json();
  if (!data?.success || !data?.data) {
    return null;
  }

  return data.data;
}

function initLazyFilmography() {
  const section = document.querySelector('[data-person-filmography-section]');
  const grid = document.querySelector('[data-person-filmography]');
  if (!section || !grid) return;

  const personId = section.dataset.personId;
  if (!personId || typeof pzfilm_globals === 'undefined') return;

  let started = false;

  const start = async () => {
    if (started) return;
    started = true;

    grid.innerHTML = '';
    const loader = document.createElement('p');
    loader.className = 'pz-person-bio';
    loader.textContent = FILMOGRAPHY_LOADING_TEXT;
    grid.appendChild(loader);

    try {
      const payload = await fetchFilmography(personId);
      grid.innerHTML = '';

      const movies = payload?.movies;
      if (!Array.isArray(movies) || movies.length === 0) {
        const empty = document.createElement('p');
        empty.className = 'pz-person-bio';
        empty.textContent = 'Nema dostupnih informacija.';
        grid.appendChild(empty);
        return;
      }

      movies.forEach((m) => renderMovieCard(grid, m));
    } catch (e) {
      grid.innerHTML = '';
      const err = document.createElement('p');
      err.className = 'pz-person-bio';
      err.textContent = 'Filmografija trenutno nije dostupna.';
      grid.appendChild(err);
    }
  };

  if (!('IntersectionObserver' in window)) {
    start();
    return;
  }

  const io = new IntersectionObserver(
    (entries) => {
      if (entries.some((e) => e.isIntersecting)) {
        io.disconnect();
        start();
      }
    },
    { root: null, rootMargin: '200px 0px', threshold: 0.01 }
  );

  io.observe(section);
}

initLazyFilmography();
