<section class="hot-or-not-holder hot-or-not-section" id="hon_game" hidden>


  <div class="hot-or-not-container">
    <button class="back-button">
      <svg width="32" height="32" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M5 7L1 11M1 11L5 15M1 11H14C16.7614 11 19 8.76142 19 6C19 3.23858 16.7614 1 14 1H9" stroke="#F57C36" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </button>
    
    <div class="custom-movie-card-heading">
      <h3>U svakoj rundi eliminacije biraj film koji ti se više dopada. On ostaje, drugi ispada. 
          Nakon 5 rundi eliminacije ostaje samo jedan, savršen film za tvoje veče.</h3>
    </div>
    
    {{-- Progress Bar --}}
    @include('pages/hot-or-not/hot-or-not-progress')
    
    {{-- Hot or Not Game  --}}
    <div class="hot-or-not-game-holder">
      <article class="hon-option-card hon-first-option-card left not-populated" data-position="left">  
      </article>
      <div class="hon-option-devider">
        <h3 class="devider-text">VS</h3>
      </div>
      <article class="hon-option-card hon-second-option-card right not-populated" data-position="right">
      </article>
    </div>
  </div>
</section>
