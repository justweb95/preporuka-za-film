import {
  fetchGameLeaderboard,
  saveGameScore,
  isTopTenScore,
  renderSimpleLeaderboard,
} from '@scripts/helpers/game-leaderboard';
import { MOVIES } from '@scripts/data/higher-lower-movies';

const GAME_KEY = 'higher_lower_movies';

// The three metrics we randomly cycle through
const METRICS = [
  {
    key: 'votes',
    label: 'glasova na IMDB-u',
    format: (v) => v.toLocaleString('sr-RS'),
  },
  {
    key: 'rating',
    label: 'prosecna IMDB ocena',
    format: (v) => v.toFixed(1) + ' / 10',
  },
  {
    key: 'budget',
    label: 'budzet filma (USD)',
    format: (v) => '$' + v.toLocaleString('en-US'),
  },
];

// DOM — home
const homeSection    = document.getElementById('higher_lower_home');
const gameSection    = document.getElementById('higher_lower_game');
const startButton    = document.querySelector('.higher-lower-start-btn');
const leaderboardList = document.getElementById('hl-leaderboard-list');

// DOM — game
const leftPanel         = document.getElementById('hl-left-panel');
const rightPanel        = document.getElementById('hl-right-panel');
const vsCircleEl        = document.getElementById('hl-vs-circle');
const currentTitleEl    = document.getElementById('hl-current-title');
const statValueEl       = document.getElementById('hl-stat-value');
const statLabelEl       = document.getElementById('hl-stat-label');
const challengerTitleEl = document.getElementById('hl-challenger-title');
const revealValueEl     = document.getElementById('hl-reveal-value');
const revealLabelEl     = document.getElementById('hl-reveal-label');
const questionVsEl      = document.getElementById('hl-question-vs');
const scoreEl           = document.getElementById('hl-current-score');
const highScoreEl       = document.getElementById('hl-high-score');
const feedbackEl        = document.getElementById('hl-feedback');
const restartButton     = document.querySelector('.hl-restart-btn');
const backHomeButton    = document.querySelector('.hl-back-home-btn');
const answerButtons     = document.querySelectorAll('.hl-answer-btn');

// DOM — popup
const popup           = document.getElementById('hl-score-popup');
const saveScoreBtn    = document.getElementById('hl-save-score');
const cancelScoreBtn  = document.getElementById('hl-cancel-score');
const playerNameInput = document.getElementById('hl-player-name');

// State
let leaderboard  = [];
let score        = 0;
let highScore    = 0;
let currentMovie = null;
let challenger   = null;
let metric       = METRICS[0];
let usedIndexes  = new Set();
let isAnimating  = false;

if (homeSection && gameSection && startButton) {
  initGame();
}

async function initGame() {
  leaderboard = await fetchGameLeaderboard(GAME_KEY);
  highScore = leaderboard.length > 0 ? leaderboard[0].score : 0;
  renderSimpleLeaderboard(leaderboardList, leaderboard);

  startButton.addEventListener('click', startGame);
  restartButton?.addEventListener('click', startGame);
  backHomeButton?.addEventListener('click', goHome);

  answerButtons.forEach((btn) => {
    btn.addEventListener('click', () => {
      if (!isAnimating) handleAnswer(btn.dataset.answer);
    });
  });

  saveScoreBtn?.addEventListener('click', handleSaveScore);
  cancelScoreBtn?.addEventListener('click', () => goHome());
  window.addEventListener('beforeunload', disableImmersiveMode);
}

function startGame() {
  score       = 0;
  usedIndexes = new Set();
  isAnimating = false;

  scoreEl.textContent     = '0';
  highScoreEl.textContent = String(highScore);
  clearFeedback();

  currentMovie = pickMovie();
  challenger   = pickMovie();
  metric       = pickMetric();

  renderRound();
  setButtonsDisabled(false);
  resetVsState();

  homeSection.hidden = true;
  gameSection.hidden = false;
  enableImmersiveMode();
}

async function handleAnswer(answer) {
  if (!currentMovie || !challenger) return;

  const isHigher  = challenger[metric.key] > currentMovie[metric.key];
  const isCorrect = (answer === 'higher' && isHigher) || (answer === 'lower' && !isHigher);

  isAnimating = true;
  setButtonsDisabled(true);

  await animateRevealValue(metric, challenger[metric.key]);

  if (isCorrect) {
    score += 1;
    scoreEl.textContent = String(score);
    if (score > highScore) {
      highScore = score;
      highScoreEl.textContent = String(highScore);
    }
    setVsState(true);
    showFeedback('Tacno!', true);

    setTimeout(() => {
      currentMovie = challenger;
      challenger   = pickMovie();
      metric       = pickMetric();
      renderRound();
      setButtonsDisabled(false);
      resetVsState();
      clearFeedback();
      isAnimating = false;
    }, 1200);
  } else {
    setVsState(false);
    showFeedback(`Netacno! Rezultat: ${score}`, false);
    setTimeout(() => endGame(), 1500);
  }
}

function endGame() {
  isAnimating = false;
  setButtonsDisabled(true);
  if (isTopTenScore(score, leaderboard)) {
    openPopup();
  }
}

function renderRound() {
  // Background images
  leftPanel.style.backgroundImage  = `url('${currentMovie.poster}')`;
  rightPanel.style.backgroundImage = `url('${challenger.poster}')`;

  // Left panel: known stat
  currentTitleEl.textContent = `"${currentMovie.title}"`;
  statValueEl.textContent    = metric.format(currentMovie[metric.key]);
  statLabelEl.textContent    = metric.label;

  // Right panel: question
  challengerTitleEl.textContent = `"${challenger.title}"`;
  revealValueEl.textContent     = '?';
  revealLabelEl.textContent     = metric.label;
  questionVsEl.textContent      = `${metric.label} nego "${currentMovie.title}"?`;
}

function animateRevealValue(metricConfig, targetValue) {
  const duration = metricConfig.key === 'rating' ? 850 : 1200;
  const start = performance.now();

  return new Promise((resolve) => {
    const frame = (now) => {
      const progress = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3);

      const current = metricConfig.key === 'rating'
        ? targetValue * eased
        : Math.round(targetValue * eased);

      revealValueEl.textContent = metricConfig.format(current);

      if (progress < 1) {
        window.requestAnimationFrame(frame);
      } else {
        revealValueEl.textContent = metricConfig.format(targetValue);
        resolve();
      }
    };

    window.requestAnimationFrame(frame);
  });
}

function pickMovie() {
  if (usedIndexes.size >= MOVIES.length) usedIndexes.clear();
  let idx = Math.floor(Math.random() * MOVIES.length);
  while (usedIndexes.has(idx)) idx = Math.floor(Math.random() * MOVIES.length);
  usedIndexes.add(idx);
  return MOVIES[idx];
}

function pickMetric() {
  return METRICS[Math.floor(Math.random() * METRICS.length)];
}

function setButtonsDisabled(disabled) {
  answerButtons.forEach((btn) => { btn.disabled = disabled; });
}

function showFeedback(msg, correct) {
  feedbackEl.textContent = msg;
  feedbackEl.className   = `hl-feedback-bar ${correct ? 'is-correct' : 'is-wrong'}`;
}

function clearFeedback() {
  feedbackEl.textContent = '';
  feedbackEl.className   = 'hl-feedback-bar';
}

function setVsState(isCorrect) {
  if (!vsCircleEl) return;
  vsCircleEl.classList.remove('is-correct', 'is-wrong');
  vsCircleEl.classList.add(isCorrect ? 'is-correct' : 'is-wrong');
}

function resetVsState() {
  if (!vsCircleEl) return;
  vsCircleEl.classList.remove('is-correct', 'is-wrong');
}

function enableImmersiveMode() {
  document.body.classList.add('hl-immersive-mode');
}

function disableImmersiveMode() {
  document.body.classList.remove('hl-immersive-mode');
}

function openPopup() {
  if (!popup) return;
  playerNameInput.value = '';
  popup.hidden = false;
}

function goHome() {
  popup && (popup.hidden = true);
  gameSection.hidden = true;
  homeSection.hidden = false;
  disableImmersiveMode();
  clearFeedback();
  resetVsState();
}

async function handleSaveScore() {
  const name = (playerNameInput.value || '').trim();
  if (name.length < 2) {
    playerNameInput.style.borderColor = '#EF8D53';
    return;
  }
  playerNameInput.style.borderColor = '';

  const response = await saveGameScore(GAME_KEY, name, score);
  if (response.success) {
    leaderboard = response.data.leaderboard || [];
    highScore   = leaderboard.length > 0 ? leaderboard[0].score : highScore;
    renderSimpleLeaderboard(leaderboardList, leaderboard);
  }
  goHome();
}
