import {
  fetchGameLeaderboard,
  saveGameScore,
  isTopTenScore,
  renderSimpleLeaderboard,
} from '@scripts/helpers/game-leaderboard';
import { MOVIE_DATA } from '@scripts/data/movie-quiz';

const GAME_KEY = 'movie_quiz';
const QUESTIONS_PER_GAME = 10;
const TOTAL_POOL_PER_MOVIE = 30;
const QUESTION_TIME_LIMIT = 15;

const homeSection = document.getElementById('movie_quiz_home');
const cardsSection = document.getElementById('movie_quiz_cards_section');
const gameSection = document.getElementById('movie_quiz_game');
const cardsContainer = document.getElementById('movie-quiz-cards');

const questionTitle = document.getElementById('movie-quiz-selected-title');
const questionText = document.getElementById('movie-quiz-question-text');
const optionsContainer = document.getElementById('movie-quiz-options');
const feedbackElement = document.getElementById('movie-quiz-feedback');
const scoreElement = document.getElementById('movie-quiz-score');
const correctElement = document.getElementById('movie-quiz-correct');
const timeBonusElement = document.getElementById('movie-quiz-time-bonus');
const questionIndexElement = document.getElementById('movie-quiz-question-index');
const restartButton = document.getElementById('movie-quiz-restart');
const playAgainButton = document.getElementById('movie-quiz-play-again');
const endActions = document.getElementById('movie-quiz-end-actions');
const timerElement = document.getElementById('movie-quiz-timer');
const timeLeftElement = document.getElementById('movie-quiz-time-left');
const sideImageElement = document.getElementById('movie-quiz-side-image');

const leaderboardHome = document.getElementById('movie-quiz-leaderboard');

const popup = document.getElementById('movie-quiz-score-popup');
const playerNameInput = document.getElementById('movie-quiz-player-name');
const saveScoreButton = document.getElementById('movie-quiz-save-score');
const cancelScoreButton = document.getElementById('movie-quiz-cancel-score');

let leaderboard = [];
let selectedMovie = null;
let questions = [];
let currentQuestionIndex = 0;
let score = 0;
let correctAnswers = 0;
let timeBonus = 0;
let timeLeft = QUESTION_TIME_LIMIT;
let timerId = null;
let isGameOver = false;

if (homeSection && cardsContainer) {
  initializeQuiz();
}

async function initializeQuiz() {
  renderMovieCards();

  leaderboard = await fetchGameLeaderboard(GAME_KEY);
  renderSimpleLeaderboard(leaderboardHome, leaderboard);

  restartButton?.addEventListener('click', goToHome);
  playAgainButton?.addEventListener('click', restartCurrentQuiz);
  saveScoreButton?.addEventListener('click', handleSaveScore);
  cancelScoreButton?.addEventListener('click', closePopup);
}

function renderMovieCards() {
  cardsContainer.innerHTML = MOVIE_DATA.map((movie) => `
    <article class="movie-quiz-card" data-movie-id="${movie.id}">
      <img src="${movie.poster}" alt="${movie.title} poster">
      <h3>${movie.title}</h3>
      <p>${movie.year} • ${movie.genre}</p>
      <button type="button">Pokreni kviz</button>
    </article>
  `).join('');

  cardsContainer.querySelectorAll('.movie-quiz-card button').forEach((button) => {
    button.addEventListener('click', (event) => {
      const card = event.currentTarget.closest('.movie-quiz-card');
      const movieId = card?.dataset.movieId;
      if (!movieId) {
        return;
      }

      const movie = MOVIE_DATA.find((entry) => entry.id === movieId);
      if (movie) {
        startQuiz(movie);
      }
    });
  });
}

function startQuiz(movie) {
  selectedMovie = movie;
  questions = buildMovieQuestionPool(movie, MOVIE_DATA).slice(0, TOTAL_POOL_PER_MOVIE);
  questions = shuffleArray(questions).slice(0, QUESTIONS_PER_GAME);

  currentQuestionIndex = 0;
  score = 0;
  correctAnswers = 0;
  timeBonus = 0;
  isGameOver = false;

  updateScoreUI();
  questionIndexElement.textContent = '1';
  feedbackElement.textContent = '';
  questionTitle.textContent = movie.title;
  if (endActions) {
    endActions.hidden = true;
  }
  if (sideImageElement) {
    sideImageElement.src = movie.poster;
    sideImageElement.alt = `${movie.title} poster`;
  }

  homeSection.hidden = true;
  if (cardsSection) {
    cardsSection.hidden = true;
  }
  gameSection.hidden = false;

  renderQuestion();
}

function buildMovieQuestionPool(movie, allMovies) {
  const customQuestions = normalizeCustomQuestions(movie.questions || []);
  const generatedQuestions = createQuestionPool(movie, allMovies);
  const mergedQuestions = [...customQuestions, ...generatedQuestions];

  const seen = new Set();
  return mergedQuestions.filter((entry) => {
    if (!entry?.question || seen.has(entry.question)) {
      return false;
    }

    seen.add(entry.question);
    return true;
  });
}

function renderQuestion() {
  if (isGameOver) {
    return;
  }

  const question = questions[currentQuestionIndex];
  if (!question) {
    finishQuiz('completed');
    return;
  }

  feedbackElement.textContent = '';
  questionIndexElement.textContent = String(currentQuestionIndex + 1);
  questionText.textContent = question.question;

  optionsContainer.innerHTML = question.options
    .map((option, index) => `<button type="button" class="movie-quiz-option" data-index="${index}">${option}</button>`)
    .join('');

  optionsContainer.querySelectorAll('.movie-quiz-option').forEach((button) => {
    button.addEventListener('click', () => handleOptionClick(Number(button.dataset.index)));
  });

  startQuestionTimer();
}

function handleOptionClick(index) {
  if (isGameOver) {
    return;
  }

  const question = questions[currentQuestionIndex];
  const optionButtons = optionsContainer.querySelectorAll('.movie-quiz-option');

  clearQuestionTimer();

  optionButtons.forEach((button, buttonIndex) => {
    button.disabled = true;

    if (buttonIndex === question.correctIndex) {
      button.classList.add('is-correct');
    } else if (buttonIndex === index) {
      button.classList.add('is-wrong');
    }
  });

  if (index === question.correctIndex) {
    const earnedTimeBonus = Math.max(0, timeLeft);
    correctAnswers += 1;
    timeBonus += earnedTimeBonus;
    score = correctAnswers + timeBonus;
    updateScoreUI();

    feedbackElement.textContent = `Tacno! +${earnedTimeBonus} bonus sekundi.`;
  } else {
    feedbackElement.textContent = `Netacno. Tacan odgovor je: ${question.options[question.correctIndex]}`;
  }

  setTimeout(() => {
    goToNextQuestion();
  }, 700);
}

function goToNextQuestion() {
  if (isGameOver) {
    return;
  }

  currentQuestionIndex += 1;

  if (currentQuestionIndex >= questions.length) {
    finishQuiz('completed');
    return;
  }

  renderQuestion();
}

function finishQuiz(reason) {
  clearQuestionTimer();
  isGameOver = true;

  if (reason === 'completed') {
    questionText.textContent = `Bravo! Zavrsio si svih ${questions.length} pitanja.`;
    feedbackElement.textContent = `Ukupno: ${score} poena (${correctAnswers} tacnih + ${timeBonus} bonus sekundi).`;
  } else if (reason === 'timeout') {
    questionText.textContent = 'Vreme je isteklo. Game over.';
    feedbackElement.textContent = `Ukupno: ${score} poena (${correctAnswers} tacnih + ${timeBonus} bonus sekundi).`;
    setTimerState('timeout');
  }

  optionsContainer.innerHTML = '';
  if (endActions) {
    endActions.hidden = false;
  }

  if (isTopTenScore(score, leaderboard)) {
    openPopup();
  }
}

function goToHome() {
  clearQuestionTimer();
  isGameOver = false;
  closePopup();
  homeSection.hidden = false;
  if (cardsSection) {
    cardsSection.hidden = false;
  }
  gameSection.hidden = true;
}

function restartCurrentQuiz() {
  if (!selectedMovie) {
    goToHome();
    return;
  }

  closePopup();
  startQuiz(selectedMovie);
}

function openPopup() {
  if (!popup) {
    return;
  }

  playerNameInput.value = '';
  popup.hidden = false;
}

function closePopup() {
  if (!popup) {
    return;
  }

  popup.hidden = true;
}

async function handleSaveScore() {
  const playerName = (playerNameInput.value || '').trim();

  if (playerName.length < 2) {
    feedbackElement.textContent = 'Ime mora imati bar 2 karaktera.';
    return;
  }

  const response = await saveGameScore(GAME_KEY, playerName, score);

  if (!response.success) {
    feedbackElement.textContent = response.data?.message || 'Neuspesno cuvanje rezultata.';
    closePopup();
    return;
  }

  leaderboard = response.data.leaderboard || [];
  renderSimpleLeaderboard(leaderboardHome, leaderboard);
  feedbackElement.textContent = 'Rezultat je sacuvan!';
  closePopup();
}

function updateScoreUI() {
  scoreElement.textContent = String(score);
  if (correctElement) {
    correctElement.textContent = String(correctAnswers);
  }
  if (timeBonusElement) {
    timeBonusElement.textContent = String(timeBonus);
  }
}

function startQuestionTimer() {
  clearQuestionTimer();
  timeLeft = QUESTION_TIME_LIMIT;
  renderTimeLeft();

  timerId = window.setInterval(() => {
    timeLeft -= 1;

    if (timeLeft <= 0) {
      timeLeft = 0;
      renderTimeLeft();
      clearQuestionTimer();
      handleTimeout();
      return;
    }

    renderTimeLeft();
  }, 1000);
}

function handleTimeout() {
  if (isGameOver) {
    return;
  }

  const optionButtons = optionsContainer.querySelectorAll('.movie-quiz-option');
  optionButtons.forEach((button) => {
    button.disabled = true;
  });

  feedbackElement.textContent = 'Vreme je isteklo!';
  finishQuiz('timeout');
}

function clearQuestionTimer() {
  if (!timerId) {
    return;
  }

  window.clearInterval(timerId);
  timerId = null;
}

function renderTimeLeft() {
  if (!timeLeftElement) {
    return;
  }

  timeLeftElement.textContent = String(timeLeft);

  if (timeLeft <= 5) {
    setTimerState('warning');
  } else {
    setTimerState('normal');
  }
}

function setTimerState(state) {
  if (!timerElement || !timeLeftElement) {
    return;
  }

  timerElement.classList.remove('is-warning', 'is-timeout');
  if (state === 'warning') {
    timerElement.classList.add('is-warning');
  }
  if (state === 'timeout') {
    timerElement.classList.add('is-timeout');
    timeLeftElement.textContent = 'X';
  }
}

function createQuestionPool(movie, allMovies) {
  const others = allMovies.filter((entry) => entry.id !== movie.id);
  const countries = uniqueValues(allMovies.map((entry) => entry.country));
  const directors = uniqueValues(allMovies.map((entry) => entry.director));
  const genres = uniqueValues(allMovies.map((entry) => entry.genre));
  const leads = uniqueValues(allMovies.map((entry) => entry.lead));

  const decade = `${Math.floor(movie.year / 10) * 10}-e`;

  const templates = [
    buildQuestion(`Koje godine je izasao film "${movie.title}"?`, String(movie.year), allMovies.map((entry) => String(entry.year))),
    buildQuestion(`Ko je reziser filma "${movie.title}"?`, movie.director, directors),
    buildQuestion(`Koji zanr najbolje opisuje "${movie.title}"?`, movie.genre, genres),
    buildQuestion(`U kojoj zemlji je dominantno produciran film "${movie.title}"?`, movie.country, countries),
    buildQuestion(`Ko je jedno od zastitnih glumackih imena filma "${movie.title}"?`, movie.lead, leads),
    buildQuestion(`Film "${movie.title}" je premijerno prikazan koje decenije?`, decade, ['1970-e', '1980-e', '1990-e', '2000-e', '2010-e', '2020-e']),
    buildQuestion(`Koja tvrdnja je tacna za "${movie.title}"?`, `Film je iz godine ${movie.year}.`, [
      `Film je iz godine ${movie.year - 6}.`,
      `Film je iz godine ${movie.year + 5}.`,
      'Film je TV serija.',
    ]),
    buildQuestion(`Koji je tacan naslov filma?`, movie.title, others.map((entry) => entry.title)),
    buildQuestion(`Koji opis najvise odgovara filmu "${movie.title}"?`, movie.quote, others.map((entry) => entry.quote)),
    buildQuestion(`Sta vazi za film "${movie.title}"?`, `Zanr filma je ${movie.genre}.`, [
      `Zanr filma je ${pickDifferent(genres, movie.genre)}.`,
      `Zanr filma je ${pickDifferent(genres, movie.genre)}.`,
      `Film je snimljen pre 1960.`,
    ]),
    buildQuestion(`Reziser "${movie.title}" je povezan i sa kojim od sledecih filmova iz liste?`,
      pickMovieByDirector(allMovies, movie.director, movie.id)?.title || movie.title,
      others.map((entry) => entry.title)
    ),
    buildQuestion(`Izaberi tacnu kombinaciju za "${movie.title}".`, `${movie.year} / ${movie.genre}`, [
      `${movie.year - 3} / ${movie.genre}`,
      `${movie.year} / ${pickDifferent(genres, movie.genre)}`,
      `${movie.year + 2} / ${pickDifferent(genres, movie.genre)}`,
    ]),
    buildQuestion(`Koji glumac je najvise vezan za "${movie.title}" u ovoj listi?`, movie.lead, leads),
    buildQuestion(`Za "${movie.title}" tacno je:`, `Reziser je ${movie.director}.`, [
      `Reziser je ${pickDifferent(directors, movie.director)}.`,
      `Reziser je ${pickDifferent(directors, movie.director)}.`,
      'Reziser nije poznat.',
    ]),
    buildQuestion(`U kom periodu je nastao film "${movie.title}"?`, `${Math.floor(movie.year / 10) * 10}-e`, ['1970-e', '1980-e', '1990-e', '2000-e', '2010-e', '2020-e']),
    buildQuestion(`Koji od navoda je netacan za "${movie.title}"?`, `Film nije iz ${movie.year + 1}.`, [
      `Film je iz ${movie.year}.`,
      `Jedan od glavnih zanrova je ${movie.genre}.`,
      `Film je povezan sa zemljom ${movie.country}.`,
    ]),
    buildQuestion(`Koja od sledecih drzava NIJE zemlja porekla filma "${movie.title}"?`, pickDifferent(countries, movie.country), [movie.country, movie.country, movie.country]),
    buildQuestion(`Koji je tacan par za "${movie.title}"?`, `${movie.director} / ${movie.lead}`, [
      `${pickDifferent(directors, movie.director)} / ${movie.lead}`,
      `${movie.director} / ${pickDifferent(leads, movie.lead)}`,
      `${pickDifferent(directors, movie.director)} / ${pickDifferent(leads, movie.lead)}`,
    ]),
    buildQuestion(`Film "${movie.title}" pripada kom zanru?`, movie.genre, genres),
    buildQuestion(`Koji naslov iz liste je iz iste godine kao "${movie.title}"?`,
      pickMovieByYear(allMovies, movie.year, movie.id)?.title || movie.title,
      others.map((entry) => entry.title)
    ),
    buildQuestion(`Koji navod je tacan o naslovu "${movie.title}"?`, 'To je dugometrazni film.', [
      'To je muzicki album.',
      'To je mini serija od 2 epizode.',
      'To je knjiga bez ekranizacije.',
    ]),
    buildQuestion(`Ako trazis film "${movie.title}", koji podatak sigurno pomaze?`, `Godina: ${movie.year}`, [
      `Godina: ${movie.year - 8}`,
      `Godina: ${movie.year + 9}`,
      'Godina: 1955',
    ]),
    buildQuestion(`Koja rec najbolje opisuje ton filma "${movie.title}"?`, movie.genre, ['Romansa', 'Vestern', 'Biografski', 'Animacija', 'Horor']),
    buildQuestion(`Ko je povezan sa filmom "${movie.title}"?`, movie.director, directors),
    buildQuestion(`Koja kombinacija je tacna za film "${movie.title}"?`, `${movie.country} / ${movie.year}`, [
      `${pickDifferent(countries, movie.country)} / ${movie.year}`,
      `${movie.country} / ${movie.year + 7}`,
      `${pickDifferent(countries, movie.country)} / ${movie.year - 4}`,
    ]),
    buildQuestion(`Koja recenica je tacna?`, `"${movie.title}" je film iz ${movie.year}.`, [
      `"${movie.title}" je film iz ${movie.year + 12}.`,
      `"${movie.title}" je animirani kratki metar iz 1930.`,
      `"${movie.title}" nije film vec serija.`,
    ]),
    buildQuestion(`Izaberi ispravan odgovor za "${movie.title}".`, movie.lead, leads),
    buildQuestion(`Kako glasi tacan naslov?`, movie.title, others.map((entry) => `${entry.title} 2`)),
    buildQuestion(`Koji je tacan podatak o filmu "${movie.title}"?`, `Reziser: ${movie.director}`, [
      `Reziser: ${pickDifferent(directors, movie.director)}`,
      `Reziser: ${pickDifferent(directors, movie.director)}`,
      'Reziser: Nepoznat',
    ]),
    buildQuestion(`Za film "${movie.title}" tacno je sledece:`, `Glavni zanr je ${movie.genre}.`, [
      `Glavni zanr je ${pickDifferent(genres, movie.genre)}.`,
      `Glavni zanr je ${pickDifferent(genres, movie.genre)}.`,
      'Glavni zanr je Sport.',
    ]),
  ];

  return templates.slice(0, TOTAL_POOL_PER_MOVIE);
}

function buildQuestion(question, correctAnswer, distractorPool) {
  const distractors = pickUnique(distractorPool.filter((value) => value !== correctAnswer), 3);
  const options = shuffleArray([correctAnswer, ...distractors]);
  const correctIndex = options.indexOf(correctAnswer);

  return {
    question,
    options,
    correctIndex,
  };
}

function normalizeCustomQuestions(questions) {
  return questions
    .map((entry) => {
      const question = (entry?.question || '').trim();
      const correctAnswer = (entry?.correctAnswer || '').trim();
      const rawOptions = Array.isArray(entry?.options) ? entry.options : [];
      const filteredOptions = rawOptions
        .map((option) => String(option).trim())
        .filter(Boolean)
        .filter((option, index, array) => array.indexOf(option) === index);

      if (!question || !correctAnswer) {
        return null;
      }

      const options = shuffleArray([
        correctAnswer,
        ...filteredOptions.filter((option) => option !== correctAnswer),
      ]).slice(0, 4);

      while (options.length < 4) {
        options.push('N/A');
      }

      const correctIndex = options.indexOf(correctAnswer);
      if (correctIndex === -1) {
        return null;
      }

      return {
        question,
        options,
        correctIndex,
      };
    })
    .filter(Boolean);
}

function pickUnique(array, count) {
  const copy = [...array];
  const result = [];

  while (copy.length && result.length < count) {
    const index = Math.floor(Math.random() * copy.length);
    result.push(copy.splice(index, 1)[0]);
  }

  while (result.length < count) {
    result.push('N/A');
  }

  return result;
}

function pickDifferent(array, currentValue) {
  const filtered = array.filter((entry) => entry !== currentValue);
  return filtered[Math.floor(Math.random() * filtered.length)] || currentValue;
}

function pickMovieByDirector(allMovies, director, excludeId) {
  return allMovies.find((entry) => entry.director === director && entry.id !== excludeId);
}

function pickMovieByYear(allMovies, year, excludeId) {
  return allMovies.find((entry) => entry.year === year && entry.id !== excludeId);
}

function uniqueValues(array) {
  return [...new Set(array)];
}

function shuffleArray(array) {
  const copy = [...array];

  for (let index = copy.length - 1; index > 0; index -= 1) {
    const randomIndex = Math.floor(Math.random() * (index + 1));
    [copy[index], copy[randomIndex]] = [copy[randomIndex], copy[index]];
  }

  return copy;
}
