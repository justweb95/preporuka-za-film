@php
    
@endphp

<section class="hot-or-not-holder hot-or-not-section" id="hon_game" hidden>
  <div class="hot-or-not-container">
    <div class="custom-movie-card-heading">
      <h3>U svakoj rundi eliminacije biraj film koji ti se više dopada. On ostaje, drugi ispada. 
          Nakon 5 rundi eliminacije ostaje samo jedan, savršen film za tvoje veče.</h3>
    </div>
    
    {{-- Progress Bar --}}
    @include('pages/hot-or-not/hot-or-not-progress')
    
    {{-- Hot or Not Game  --}}
    <div class="hot-or-not-game-holder">
      <article class="hon-option-card hon-first-option-card left not-populated" data-position="left">  
        {{-- <button class="choose-movie-btn" data-movie-id='554'>Izaberi ovaj film</button> --}}
      </article>
      <div class="hon-option-devider">
        <h3 class="devider-text">VS</h3>
      </div>
      <article class="hon-option-card hon-second-option-card right not-populated" data-position="right">
        {{-- <button class="choose-movie-btn" data-movie-id='554'>Izaberi ovaj film</button> --}}
      </article>
    </div>
  </div>
</section>
