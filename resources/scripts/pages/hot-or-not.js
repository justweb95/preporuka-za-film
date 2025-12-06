console.log('Hot or Not page script loaded');

// Hot or Not Variables

let step_index = 1;

const steps_id = [
  'hot_or_not_home',
  'hon_add_custom',
  'hon_pop_up',
  'hon_game'
]

// Making array fo elements from array of steps id
const steps_element = steps_id.map(step =>document.getElementById(step));

// Function
function honStepHandler(step_index) {
  steps_element.forEach(step => step.hidden = true);  
  steps_element[step_index - 1].hidden = false;
}


const start_game_btns = document.querySelectorAll('.start-game-btn');

start_game_btns.forEach(btn => btn.addEventListener('click', (event) => {
  const isCustom = event.currentTarget.dataset.isCustom === 'true';
  startGameHandler(isCustom);
}));

async function startGameHandler(isCustom) {
  

  if(!isCustom) {
    const button_loader = document.querySelector('.suprise-start-btn');
    button_loader.textContent = 'AI Nalazi Filmove...'
    
    const movies_response = await getFiveMoviesForGame();
    if(!movies_response) return;

    button_loader.textContent = 'Pokreni igru'
    honStepHandler(4);
    





  }
  else {
    honStepHandler(2);
  
  
  }





}

async function getFiveMoviesForGame() {  
  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: "POST",
    credentials: 'same-origin',
    body: new URLSearchParams({
      action: 'get_five_movies',
    })
  })  

  const data = await response.json();
  return data;
}









