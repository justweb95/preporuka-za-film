import confetti from 'canvas-confetti';
import { poplateResult } from '@scripts/helpers/recommendation-results-helper.js';
import { wheelOfFortune } from "./wheel-of-fortune-spin-game";

const wof = wheelOfFortune('.wof-wheel-imgs-holder');
const startBtn = document.querySelector('.wof-start-game');
const wheelOfFortuneHome = document.getElementById('wheel_of_fortune_home');
const wheelOfFortuneResults = document.getElementById('game_results');

startBtn.addEventListener('click', async () => {
  const winnerEl = await wof.spin();
  if (!winnerEl) return;

  console.log('winner:', winnerEl);
  console.log('winner id:', winnerEl.dataset.wheelMovieId);
  
  await gameEnd(winnerEl.dataset.wheelMovieId);
});



async function gameEnd(movie_id) {
  const chosenMovie = await getMovieForGame(movie_id);
  const isPopulated = await poplateResult(chosenMovie);

  if(isPopulated) {
    confetti({particleCount: 100,  spread: 70,  origin: { x: 0.7, y: 0.5 }});
    confetti({particleCount: 100,  spread: 70,  origin: { x: 0.3, y: 0.6 }});
    
    window.scrollTo({top: 0, behavior: 'smooth'});
    
    wheelOfFortuneHome.hidden = true;
    wheelOfFortuneResults.hidden = false;
  }
}


async function getMovieForGame(movie_id) {
  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    body: new URLSearchParams({
      action: 'get_movie_for_result',
      movie_id: movie_id
    }),
    credentials: 'same-origin'
  });
  
  const data = await response.json();

  if (!data.success) {
    console.error('Movie data not found:', data);
    return;
  }

  return data.data
}












 

