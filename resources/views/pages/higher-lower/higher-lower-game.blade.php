<section class="hl-fullscreen-game" id="higher_lower_game" hidden>

  {{-- Left panel: known movie --}}
  <div class="hl-panel hl-panel--left" id="hl-left-panel">
    <div class="hl-panel-overlay"></div>
    <div class="hl-panel-content">
      <p class="hl-movie-quote" id="hl-current-title"></p>
      <p class="hl-panel-has">ima</p>
      <strong class="hl-stat-value" id="hl-stat-value"></strong>
      <span class="hl-stat-label" id="hl-stat-label"></span>
    </div>
    <p class="hl-corner-score hl-corner-score--left">Rekord: <strong id="hl-high-score">0</strong></p>
  </div>

  {{-- VS badge --}}
  <div class="hl-vs-circle" id="hl-vs-circle">
    <span class="hl-vs-label">VS</span>
    <span class="hl-vs-icon hl-vs-icon--check" aria-hidden="true">
      <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M5 11.5L9.2 15.5L17 7.5" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </span>
    <span class="hl-vs-icon hl-vs-icon--x" aria-hidden="true">
      <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6 6L16 16M16 6L6 16" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/>
      </svg>
    </span>
  </div>

  {{-- Right panel: challenger --}}
  <div class="hl-panel hl-panel--right" id="hl-right-panel">
    <div class="hl-panel-overlay"></div>
    <div class="hl-panel-content">
      <p class="hl-movie-quote" id="hl-challenger-title"></p>
      <p class="hl-panel-has">ima</p>
      <strong class="hl-stat-reveal" id="hl-reveal-value">?</strong>
      <span class="hl-stat-reveal-label" id="hl-reveal-label"></span>
      <div class="hl-answer-actions">
        <button type="button" class="hl-answer-btn" data-answer="higher">
          Vise &nbsp;&#9650;
        </button>
        <button type="button" class="hl-answer-btn" data-answer="lower">
          Manje &nbsp;&#9660;
        </button>
      </div>
      <p class="hl-question-vs" id="hl-question-vs"></p>
    </div>
    <p class="hl-corner-score hl-corner-score--right">Rezultat: <strong id="hl-current-score">0</strong></p>
  </div>

  {{-- Feedback bar (bottom) --}}
  <div class="hl-feedback-bar" id="hl-feedback"></div>

  {{-- Top actions --}}
  <div class="hl-top-actions">
    <button class="hl-restart-btn" type="button">&#8635; Igraj ponovo</button>
    <button class="hl-back-home-btn" type="button">Nazad na score bord</button>
  </div>

  {{-- Fixed ad banner --}}
  <div class="hl-fixed-ad" aria-label="Reklamni prostor">
    @include('placements.horizontal-980-250')
  </div>

</section>
