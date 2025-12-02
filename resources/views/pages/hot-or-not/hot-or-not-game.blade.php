@php
    
@endphp


<section class="hot-or-not-holder hot-or-not-section">
  <div class="hot-or-not-container">
    <div class="custom-movie-card-heading">
      <h3>U svakoj rundi eliminacije biraj film koji ti se više dopada. On ostaje, drugi ispada. 
          Nakon 5 rundi eliminacije ostaje samo jedan, savršen film za tvoje veče.</h3>
    </div>
    
    {{-- Progress Bar --}}
    @include('pages/hot-or-not/hot-or-not-progress')
    
    {{-- Hot or Not Game  --}}
    <div class="hot-or-not-game-holder">
      <article class="hon-first-option-card">
        @include('partials/single-movie-card',[
          'movie_index' => 0,
          'poster_path' => '/8cdWjvZQUExUUTzyp4t6EDMubfO.jpg',
          'movie_ID' => 554,
          'release_year' => '2024',
          'single_movie_control' => false,
          'our_recommendations' => true,
        ])    
        <button class="choose-movie-btn" data-movie-id='554'>Izaberi ovaj film</button>
      </article>
      <div class="hon-option-devider">
        <h3 class="devider-text">VS</h3>
      </div>
      <article class="hon-second-option-card">
        @include('partials/single-movie-card',[
          'movie_index' => 0,
          'poster_path' => '/8cdWjvZQUExUUTzyp4t6EDMubfO.jpg',
          'movie_ID' => 554,
          'release_year' => '2024',
          'single_movie_control' => false,
          'our_recommendations' => true,
        ])
        <button class="choose-movie-btn" data-movie-id='554'>Izaberi ovaj film</button>
      </article>
    </div>
  </div>
</section>