import Toastify from 'toastify-js';
import 'toastify-js/src/toastify.css'; // Importing CSS for Toastify

import { getLoggedInUserInfo } from '@scripts/profile/profile-main.js';
import { scrolToTop } from '@scripts/helpers/scrool-to-top-helper';
import { cyrillicFormat } from '@scripts/partials/textFormatingControler';

// Toster
function showToast(message) {
  Toastify({
    text: message,
    duration: 3000,
    gravity: 'top',
    position: 'right',
    stopOnFocus: true,
    style: {
      background: 'linear-gradient(90deg, #172938 70%, #172938 100%)',
      fontFamily: 'Red Hat Display',
      fontSize: '16px',
    },
  }).showToast();
}
// Needs refactoring
// Bulshit code that remove not-valid class from inputs
// let form_comment = document.querySelector('form#commentform');
// form_comment.addEventListener('click', (e) => {
//   if (
//     (e.target.tagName === 'INPUT' && e.target.type !== 'submit') ||
//     e.target.tagName === 'TEXTAREA'
//   ) {
//     e.target.classList.remove('input-not-valid');
//   }
// });

// form_comment.addEventListener('input', (e) => {
//   if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') {
//     e.target.classList.remove('input-not-valid');
//   }
// });

// let form_labels = document.querySelectorAll('form#commentform label');
// form_labels.forEach((label) => {
//   label.addEventListener('click', () => {
//     form_labels.forEach((l) => l.classList.remove('input-not-valid'));
//   });
// });
// Needs refactoring
// Bulshit code that remove not-valid class from inputs

// Handle Form Submit Click;
let form_submit_button = document.querySelector('#submit');
form_submit_button.addEventListener('click', handleFormSubmit);

const FALLBACK_MOVIE_DESCRIPTION = 'Opis filma trenutno nije dostupan';
const MOVIE_DESCRIPTION_LOADING_TEXT = 'Ucitavanje svezeg contenta....';
const MOVIE_PEOPLE_LOADING_TEXT = 'Ucitavanje svezeg contenta....';

loadMissingMovieDescription();
loadMoviePeopleCarousels();
initPeopleCarouselNav();
initPeopleCardGlow();

async function handleFormSubmit(e) {
  // Prevent defult behavior
  e.preventDefault();

  // Collect data from form
  let comment_data = await handleCollectingData();

  // Validate form
  if (!validateFormHandler(comment_data)) {
    showToast('Popunite sva polja unutar forme!');
    return;
  }

  // Handle Comment Post
  handleCommentPost(comment_data);
}

// Valdiate Email Regex
function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}

// Validate Form Handler for Comment Form Adding class input-not-valid
function validateFormHandler(comment_data) {
  let isValid = true;

  // Comment
  if (comment_data.form_comment.value.trim() === '') {
    comment_data.form_comment.classList.add('input-not-valid');
    isValid = false;
  } else {
    comment_data.form_comment.classList.remove('input-not-valid');
  }

  // Author
  if (comment_data.form_author.value.trim() === '') {
    comment_data.form_author.classList.add('input-not-valid');
    isValid = false;
  } else {
    comment_data.form_author.classList.remove('input-not-valid');
  }

  // Email
  if (comment_data.form_email.value.trim() === '') {
    comment_data.form_email.classList.add('input-not-valid');
    isValid = false;
  } else if (!validateEmail(comment_data.form_email.value.trim())) {
    comment_data.form_email.classList.add('input-not-valid');
    isValid = false;
  } else {
    comment_data.form_email.classList.remove('input-not-valid');
  }

  // Stars
  if (comment_data.selected_stars_rating === null) {
    Array.from(comment_data.form_stars_ratin_label).forEach(label =>
      label.classList.add('input-not-valid')
    );
    isValid = false;
  } else {
    Array.from(comment_data.form_stars_ratin_label).forEach(label =>
      label.classList.remove('input-not-valid')
    );
  }

  return isValid;
}

// Collecting data from form and returning it as object
async function handleCollectingData() {
  let form_comment = document.querySelector('#comment');
  let form_author = document.querySelector('#author');
  let form_email = document.querySelector('#email');

  // If author/email inputs DO NOT exist in DOM
  if (!form_author && !form_email) {
    const user_data = await getLoggedInUserInfo();

    // Create virtual inputs so validation logic still works
    const authorInput = document.createElement('input');
    authorInput.value = user_data.username || '';
    form_author = authorInput;

    const emailInput = document.createElement('input');
    emailInput.value = user_data.email || '';
    form_email = emailInput;
  }

  // Stars
  const form_stars_rating = document.querySelectorAll(
    '.stars-container input[type="radio"]'
  );
  const form_stars_ratin_label = document.querySelectorAll(
    '.stars-container label'
  );

  let selected_stars_rating = null;
  form_stars_rating.forEach(input => {
    if (input.checked) selected_stars_rating = input.value;
  });

  // Movie ID
  const movie_id =
    document.querySelector('#sm_hero_section')?.dataset.movieId;

  return {
    form_author,
    form_comment,
    form_email,
    selected_stars_rating,
    movie_id,
    form_stars_rating,
    form_stars_ratin_label,
  };
}




function handleCommentPost(comment_data) {
  // Construct the action URL dynamically based on current location
  let actionUrl = ``;
  if (PRODUCTION) {
    actionUrl = `${window.location.origin}/wp-comments-post.php`;
  } else {
    actionUrl = `${window.location.origin}/preporuka-za-film/wp-comments-post.php`;
  }

  // Prepare data to be sent
  const data = new FormData();
  data.append('comment', comment_data.form_comment.value);
  data.append('author', comment_data.form_author.value);
  data.append('email', comment_data.form_email.value);
  data.append('rating', comment_data.selected_stars_rating);
  data.append('submit', 'Pošalji');
  data.append('comment_post_ID', comment_data.movie_id);
  data.append('comment_parent', 0);

  fetch(actionUrl, {
    method: 'POST',
    body: data,
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
    },
  })
    .then((response) => {
      return response;
    })
    .then((data) => {
      if (data) {
        // Handle success response with toast message and clear form inputs
        showToast('Vaš komentar je uspešno poslat!');
        comment_data.form_comment.value = '';
        comment_data.form_author.value = '';
        comment_data.form_email.value = '';
        Array.from(comment_data.form_stars_rating).forEach((input) => {
          input.checked = false;
        });
        return;
      } else {
        return;
      }
    })
    .catch((error) => {
      // Handle error response with toast message
      // console.log('Error:', error);
    });
}


window.openTrailerPopUp = function () {
  const trailerModal = document.querySelector('#trailer-modal');  
  scrolToTop();
  
  // Show the modal
  trailerModal.showModal();

  // Close button functionality
  const closeModalBtn = document.getElementById('closeModalBtn');

  closeModalBtn.onclick = function() {
      trailerModal.close();
      stopVideo()
  };

  // Close modal when clicking outside of it
  trailerModal.addEventListener('click', function(event) {
      if (event.target === trailerModal) {
          trailerModal.close();
          stopVideo()
      }
  });
}

// Function to stop the YouTube video
function stopVideo() {
  const iframe = document.getElementById('youtube-player');
  const src = iframe.src;
  iframe.src = '';
  iframe.src = src;
}

async function loadMissingMovieDescription() {
  const heroSection = document.querySelector('#sm_hero_section');
  const descriptionElement = document.querySelector('#sm-info-description-text');

  if (!heroSection || !descriptionElement) {
    return;
  }

  const currentDescription = descriptionElement.textContent.trim();
  const postId = heroSection.dataset.movieId;
  const tmdbMovieId = heroSection.dataset.tmdbMovieId;

  if (
    currentDescription !== FALLBACK_MOVIE_DESCRIPTION ||
    !postId ||
    !tmdbMovieId
  ) {
    return;
  }

  descriptionElement.dataset.loading = 'true';
  descriptionElement.textContent = MOVIE_DESCRIPTION_LOADING_TEXT;

  const formData = new FormData();
  formData.append('action', 'refresh_movie_description');
  formData.append('post_id', postId);
  formData.append('tmdb_movie_id', tmdbMovieId);
  formData.append('nonce', pzfilm_globals.nonce);

  try {
    const response = await fetch(pzfilm_globals.ajaxurl, {
      method: 'POST',
      credentials: 'include',
      body: formData,
    });

    const data = await response.json();

    if (!data?.success || !data?.data?.overview) {
      descriptionElement.textContent = FALLBACK_MOVIE_DESCRIPTION;
      return;
    }

    descriptionElement.textContent = cyrillicFormat(data.data.overview.trim());
  } catch (error) {
    descriptionElement.textContent = FALLBACK_MOVIE_DESCRIPTION;
    console.error('refresh_movie_description error:', error);
  } finally {
    delete descriptionElement.dataset.loading;
  }
}


async function loadMoviePeopleCarousels() {
  const heroSection = document.querySelector('#sm_hero_section');
  if (!heroSection || typeof pzfilm_globals === 'undefined') {
    return;
  }

  const postId = heroSection.dataset.movieId;
  const tmdbMovieId = heroSection.dataset.tmdbMovieId;

  if (!postId || !tmdbMovieId) {
    return;
  }

  const carousels = Array.from(
    document.querySelectorAll('[data-people-carousel]')
  );

  if (!carousels.length) {
    return;
  }

  const hasRealCards = (carousel) =>
    carousel.querySelector('.sm-person-card:not(.sm-person-card--skeleton)');

  const shouldFetch = carousels.some((carousel) => !hasRealCards(carousel));

  if (!shouldFetch) {
    return;
  }

  carousels.forEach((carousel) => ensurePeopleLoader(carousel));
  const setLoaderText = (text) => {
    carousels.forEach((carousel) => {
      ensurePeopleLoader(carousel);
      const loader = carousel.querySelector('[data-sm-people-loader]');
      if (loader) loader.textContent = text;
    });
  };

  const formData = new FormData();
  formData.append('action', 'refresh_movie_people');
  formData.append('post_id', postId);
  formData.append('tmdb_movie_id', tmdbMovieId);
  formData.append('nonce', pzfilm_globals.nonce);

  try {
    const response = await fetch(pzfilm_globals.ajaxurl, {
      method: 'POST',
      credentials: 'include',
      body: formData,
    });

    const data = await response.json();

    if (!data?.success || !data?.data) {
      setLoaderText('Nema dostupnih informacija');
      return;
    }

    const payload = data.data;

    renderPeopleCarousel(
      'credits',
      []
        .concat(payload.directors || [])
        .concat(payload.writers || [])
    );
    renderPeopleCarousel('cast', payload.cast || []);
  } catch (error) {
    setLoaderText('Nema dostupnih informacija');
    console.error('refresh_movie_people error:', error);
  }
}

function ensurePeopleLoader(carousel) {
  if (carousel.querySelector('[data-sm-people-loader]')) {
    return;
  }

  const loader = document.createElement('p');
  loader.className = 'sm-people-loader';
  loader.dataset.smPeopleLoader = 'true';
  loader.textContent = MOVIE_PEOPLE_LOADING_TEXT;

  carousel.prepend(loader);
}

function renderPeopleCarousel(role, people) {
  const carousel = document.querySelector('[data-people-carousel=\"' + role + '\"]');
  if (!carousel) {
    return;
  }

  if (!Array.isArray(people) || people.length === 0) {
    // Keep skeletons if we have them.
    const loader = carousel.querySelector('[data-sm-people-loader]');
    if (loader) {
      loader.textContent = 'Nema dostupnih informacija';
    }
    return;
  }

  carousel.innerHTML = '';

  people.forEach((person) => {
    carousel.appendChild(createPersonCard(person, role));
  });

  // After (re)render, try to tint glow based on the new images.
  initPeopleCardGlow(carousel);
}

function createPersonCard(person, role) {
  const isLink = Boolean(person?.permalink);
  const el = document.createElement(isLink ? 'a' : 'div');

  el.className = 'sm-person-card';
  if (isLink) {
    el.href = person.permalink;
  } else {
    el.setAttribute('aria-disabled', 'true');
  }

  if (person?.tmdb_id) {
    el.dataset.personId = String(person.tmdb_id);
  }

  const avatar = document.createElement('span');
  avatar.className = 'sm-person-avatar';

  if (person?.profile_url) {
    const img = document.createElement('img');
    img.src = person.profile_url;
    img.alt = person?.name || '';
    img.loading = 'lazy';
    img.decoding = 'async';
    img.width = 138;
    img.height = 175;
    img.addEventListener(
      'error',
      () => {
        // If the cached URL is bad, fall back to initials instead of broken image icon.
        avatar.innerHTML = '';
        const initials = document.createElement('span');
        initials.className = 'sm-person-initials';
        initials.textContent = (person?.name || '?').trim().slice(0, 1) || '?';
        avatar.appendChild(initials);
      },
      { once: true }
    );
    avatar.appendChild(img);
  } else {
    const initials = document.createElement('span');
    initials.className = 'sm-person-initials';
    initials.textContent = (person?.name || '?').trim().slice(0, 1) || '?';
    avatar.appendChild(initials);
  }

  const name = document.createElement('span');
  name.className = 'sm-person-name';
  name.textContent = person?.name || '';

  const meta = document.createElement('span');
  meta.className = 'sm-person-meta';

  if (role === 'cast') {
    meta.textContent = person?.character || 'Glumac';
  } else {
    meta.textContent = person?.job || (role === 'writers' ? 'Writer' : 'Director');
  }

  el.appendChild(avatar);
  el.appendChild(name);
  el.appendChild(meta);

  return el;
}

function initPeopleCardGlow(root = document) {
  const cards = Array.from(root.querySelectorAll('.sm-person-card'));
  if (!cards.length) return;

  cards.forEach((card) => {
    if (card.dataset.smGlowApplied === 'true') return;

    const img = card.querySelector('.sm-person-avatar img');
    if (!img) return;

    const apply = () => {
      try {
        const color = extractDominantColorFromImage(img);
        if (color) {
          card.style.setProperty(
            '--sm-person-glow',
            `rgba(${color.r}, ${color.g}, ${color.b}, 0.55)`
          );
        }
      } catch (e) {
        // CORS or decoding failures: keep CSS fallback glow.
      } finally {
        card.dataset.smGlowApplied = 'true';
      }
    };

    if (img.complete && img.naturalWidth > 0) {
      apply();
    } else {
      img.addEventListener('load', apply, { once: true });
      img.addEventListener('error', () => {
        card.dataset.smGlowApplied = 'true';
      }, { once: true });
    }
  });
}

function extractDominantColorFromImage(img) {
  // Best-effort: requires image pixels to be readable (CORS).
  const canvas = document.createElement('canvas');
  const size = 16;
  canvas.width = size;
  canvas.height = size;
  const ctx = canvas.getContext('2d', { willReadFrequently: true });
  if (!ctx) return null;

  ctx.drawImage(img, 0, 0, size, size);
  const { data } = ctx.getImageData(0, 0, size, size);

  let r = 0;
  let g = 0;
  let b = 0;
  let count = 0;

  for (let i = 0; i < data.length; i += 4) {
    const a = data[i + 3];
    if (a < 32) continue;

    const pr = data[i];
    const pg = data[i + 1];
    const pb = data[i + 2];

    // Skip near-black pixels (common in posters) so glow doesn't turn muddy.
    const lum = 0.2126 * pr + 0.7152 * pg + 0.0722 * pb;
    if (lum < 22) continue;

    r += pr;
    g += pg;
    b += pb;
    count += 1;
  }

  if (!count) return null;

  return {
    r: Math.round(r / count),
    g: Math.round(g / count),
    b: Math.round(b / count),
  };
}

function initPeopleCarouselNav() {
  const buttons = Array.from(document.querySelectorAll('[data-carousel-target][data-carousel-scroll]'));
  if (!buttons.length) {
    return;
  }

  buttons.forEach((btn) => {
    btn.addEventListener('click', () => {
      const target = btn.dataset.carouselTarget;
      const dir = btn.dataset.carouselScroll;
      if (!target || !dir) return;

      const carousel = document.querySelector(`[data-people-carousel="${target}"]`);
      if (!carousel) return;

      const amount = Math.max(260, Math.floor(carousel.clientWidth * 0.85));
      const left = dir === 'prev' ? -amount : amount;
      carousel.scrollBy({ left, behavior: 'smooth' });
    });
  });
}
