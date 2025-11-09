<section class="advance-recommendation-tab">
  <div class="advance-recommendation-questionnaire">
    @include('pages.my-profile.advance-questions.include-watched-movies')
    @include('pages.my-profile.advance-questions.expand-movie-list')
    
    {{-- TIER 1 — OSNOVNI (8 najvažnijih pitanja) --}}
    @include('pages.my-profile.advance-questions.movie-origin', ['question_limit_id' => 1, 'hidden_question'=>false])
    @include('pages.my-profile.advance-questions.movie-genre', ['question_limit_id' => 2, 'hidden_question'=>false])
    @include('pages.my-profile.advance-questions.movie-tone', ['question_limit_id' => 3, 'hidden_question'=>false])
    @include('pages.my-profile.advance-questions.movie-pace', ['question_limit_id' => 4, 'hidden_question'=>false])
    @include('pages.my-profile.advance-questions.movie-period', ['question_limit_id' => 5, 'hidden_question'=>false])
    @include('pages.my-profile.advance-questions.movie-complexity', ['question_limit_id' => 6, 'hidden_question'=>false])
    @include('pages.my-profile.advance-questions.movie-focus', ['question_limit_id' => 7, 'hidden_question'=>false])
    @include('pages.my-profile.advance-questions.movie-similar', ['question_limit_id' => 8, 'hidden_question'=>false])

    {{-- TIER 2 — PROŠIRENI (dodatna 4 = ukupno 12 pitanja) --}}
    @include('pages.my-profile.advance-questions.movie-subgenre', ['question_limit_id' => 9, 'hidden_question'=>true])
    @include('pages.my-profile.advance-questions.movie-duration', ['question_limit_id' => 10, 'hidden_question'=>true])
    @include('pages.my-profile.advance-questions.movie-style', ['question_limit_id' => 11, 'hidden_question'=>true])
    @include('pages.my-profile.advance-questions.movie-emotion', ['question_limit_id' => 12, 'hidden_question'=>true])

    {{-- TIER 3 — NAPREDNI (dodatna 5 = ukupno 17 pitanja) --}}
    @include('pages.my-profile.advance-questions.movie-vfx', ['question_limit_id' => 13, 'hidden_question'=>true])
    @include('pages.my-profile.advance-questions.movie-ending', ['question_limit_id' => 14, 'hidden_question'=>true])
    @include('pages.my-profile.advance-questions.movie-famous', ['question_limit_id' => 15, 'hidden_question'=>true])
    @include('pages.my-profile.advance-questions.movie-status', ['question_limit_id' => 16, 'hidden_question'=>true])
    @include('pages.my-profile.advance-questions.movie-format', ['question_limit_id' => 17, 'hidden_question'=>true])

    <button id="start_recommendation" class="start-recommentation">
      <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M15.0517 7.28688C17.2884 9.52354 17.2884 13.1535 15.0517 15.3902C12.815 17.6268 9.18501 17.6268 6.94834 15.3902C4.71168 13.1535 4.71168 9.52354 6.94834 7.28688C9.18501 5.05021 12.815 5.05021 15.0517 7.28688Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M7.5625 19.8363C5.72916 19.103 4.12499 17.7738 3.06166 15.9313C2.01666 14.1255 1.66833 12.118 1.91583 10.2021" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M5.36252 4.10642C6.92085 2.88725 8.87335 2.16309 11 2.16309C13.0808 2.16309 14.9967 2.86891 16.5367 4.04224" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M14.4375 19.8363C16.2708 19.103 17.875 17.7738 18.9383 15.9313C19.9833 14.1255 20.3317 12.118 20.0842 10.2021" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      STARTUJ PREPORUKU
    </button>
  </div>

  <div class="advance-recommendation-result" hidden>
    @include('pages/questions/loader')
    @include('pages/questions/results');
  </div>
  
</section>
