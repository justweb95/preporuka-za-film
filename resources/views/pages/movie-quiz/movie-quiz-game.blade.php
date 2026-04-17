<section class="movie-quiz-holder movie-quiz-game" id="movie_quiz_game" hidden>
  <div class="movie-quiz-layout container">
    <article class="movie-quiz-left-panel">
      <div class="movie-quiz-game-header">
        <h2 id="movie-quiz-selected-title"></h2>
        <div class="movie-quiz-game-meta">
          <p>Pitanje <span id="movie-quiz-question-index">1</span>/10</p>
          <p>Poeni: <span id="movie-quiz-score">0</span></p>
          <p>Tacno: <span id="movie-quiz-correct">0</span></p>
          <p>Bonus vreme: <span id="movie-quiz-time-bonus">0</span></p>
        </div>
      </div>

      <div class="movie-quiz-question-box">
        <h3 id="movie-quiz-question-text"></h3>
        <div class="movie-quiz-options" id="movie-quiz-options"></div>
      </div>

      <div class="movie-quiz-actions" id="movie-quiz-end-actions" hidden>
        <button type="button" id="movie-quiz-play-again">Igraj opet</button>
        <button type="button" id="movie-quiz-restart">Nazad na rezultate</button>
      </div>

      <p class="movie-quiz-feedback" id="movie-quiz-feedback"></p>
    </article>

    <aside class="movie-quiz-right-panel movie-quiz-right-panel--game">
      <div class="movie-quiz-side-image-wrap">
        <img id="movie-quiz-side-image" src="" alt="Poster izabranog filma">

        <div class="movie-quiz-side-overlay">
          <h3>Preostalo vreme</h3>
          <div class="movie-quiz-timer" id="movie-quiz-timer">
            <span id="movie-quiz-time-left">15</span>
          </div>
        </div>
      </div>
    </aside>
  </div>

  <div class="movie-quiz-fixed-ad" aria-label="Reklamni prostor">
    @include('placements.horizontal-980-250')
  </div>
</section>
