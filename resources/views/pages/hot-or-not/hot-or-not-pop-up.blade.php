@php
  use App\Controllers\RecentRecommendationsController;

  $my_recent_recommendations = RecentRecommendationsController::getRecentRecommendations(5);
  $my_favorites = RecentRecommendationsController::getMyFavoritesMovies(5);
  $my_already_watched = RecentRecommendationsController::getAlreadyWatchedMovies(5);
@endphp

<section class="hot-or-not-pop-up" id="hon_pop_up" hidden>
  <button class="hot-or-not-pop-up-close-btn">
    <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
      <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" fill="#22374A" fill-o2pacity="0.5"/>
      <rect x="0.5" y="0.5" width="47" height="47" rx="23.5" stroke="#22374A"/>
      <path d="M17 17L31 31M31 17L17 31" stroke="white" stroke-width="2"/>
    </svg>
  </button>
  <div class="hon-pop-up-container">
    <h2 class="hon-pop-up-title">Dodaj željeni film</h2>
    <div class="hon-pop-up-search-box">
      <input 
        id="hon-pop-up-search-input"  
        class="hon-pop-up-search-input" 
        placeholder="Pretraži željeni film..." 
        type="text">
      <svg class="hon-pop-up-search-input-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0882 16.7415C13.5044 17.9727 11.5143 18.7058 9.3529 18.7058C4.18744 18.7058 0 14.5184 0 9.3529C0 4.18744 4.18744 0 9.3529 0C14.5184 0 18.7058 4.18744 18.7058 9.3529C18.7058 11.5143 17.9727 13.5044 16.7415 15.0882L20 18.3466L18.3466 20L15.0882 16.7415ZM16.3676 9.3529C16.3676 13.227 13.227 16.3676 9.3529 16.3676C5.4788 16.3676 2.33823 13.227 2.33823 9.3529C2.33823 5.4788 5.4788 2.33823 9.3529 2.33823C13.227 2.33823 16.3676 5.4788 16.3676 9.3529Z" fill="#EDFEEC"/>
      </svg>
    </div>
    <div class="hon-pop-up-search-results">
      <div class="search-results-header">
        <h3 class="search-results-filter">Poslednje preporuke</h3>
        <div class="search-results-filter-control">
          <button class="filter-control-back" data-is-forward="false">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <foreignObject x="-40" y="-40" width="120" height="120">
              </foreignObject><g data-figma-bg-blur-radius="40">
              <rect width="40" height="40" rx="20" transform="matrix(-1 0 0 1 40 0)" fill="#22374A"/>
              <path d="M23 26L17 20L23 14" stroke="white" stroke-width="2"/>
              </g>
              <defs>
              <clipPath id="bgblur_0_851_4895_clip_path" transform="translate(40 40)"><rect width="40" height="40" rx="20" transform="matrix(-1 0 0 1 40 0)"/>
              </clipPath></defs>
            </svg>
          </button>
          <button class="filter-control-next" data-is-forward="true">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <foreignObject x="-40" y="-40" width="120" height="120">
              </foreignObject><g data-figma-bg-blur-radius="40">
              <rect width="40" height="40" rx="20" fill="#22374A"/>
              <path d="M17 26L23 20L17 14" stroke="white" stroke-width="2"/>
              </g>
              <defs>
              <clipPath id="bgblur_0_851_4897_clip_path" transform="translate(40 40)"><rect width="40" height="40" rx="20"/>
              </clipPath></defs>
            </svg>
          </button>
        </div>
      </div>
      <ul id="recent-recommendations-list" class="search-results-content">
        @foreach ($my_recent_recommendations as $movie)
          <li class="search-results-content-card">
            @include('partials/single-movie-card',[
              'movie_index' => $loop->iteration,
              'poster_path' => $movie['poster_url'],
              'movie_ID' => $movie['ID'],
              'release_year' => $movie['year'],
              'single_movie_control' => false,
              'our_recommendations' => $movie['our_recommendations'],
            ])
            <button class="search-results-add-movie">
              <svg class="add-movie-icon" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="59" height="59" rx="29.5" fill="#06131E" fill-opacity="0.8"/>
                <rect x="0.5" y="0.5" width="59" height="59" rx="29.5" stroke="#22374A"/>
                <path d="M30 40L30 20" stroke="#EDFEEC" stroke-width="2"/>
                <path d="M20 30L40 30" stroke="#EDFEEC" stroke-width="2"/>
              </svg>
            </button>
          </li>            
        @endforeach
      </ul>
      <ul id="my-favorites-list" class="search-results-content">
        @foreach ($my_favorites as $movie)
          <li class="search-results-content-card">
            @include('partials/single-movie-card',[
              'movie_index' => $loop->iteration,
              'poster_path' => $movie['poster_url'],
              'movie_ID' => $movie['ID'],
              'release_year' => $movie['year'],
              'single_movie_control' => false,
              'our_recommendations' => $movie['our_recommendations'],
            ])
            <button class="search-results-add-movie">
              <svg class="add-movie-icon" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="59" height="59" rx="29.5" fill="#06131E" fill-opacity="0.8"/>
                <rect x="0.5" y="0.5" width="59" height="59" rx="29.5" stroke="#22374A"/>
                <path d="M30 40L30 20" stroke="#EDFEEC" stroke-width="2"/>
                <path d="M20 30L40 30" stroke="#EDFEEC" stroke-width="2"/>
              </svg>
            </button>
          </li>            
        @endforeach
      </ul>
      <ul id="already-watched-list" class="search-results-content">
        @foreach ($my_already_watched as $movie)
          <li class="search-results-content-card">
            @include('partials/single-movie-card',[
              'movie_index' => $loop->iteration,
              'poster_path' => $movie['poster_url'],
              'movie_ID' => $movie['ID'],
              'release_year' => $movie['year'],
              'single_movie_control' => false,
              'our_recommendations' => $movie['our_recommendations'],
            ])
            <button class="search-results-add-movie">
              <svg class="add-movie-icon" width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="59" height="59" rx="29.5" fill="#06131E" fill-opacity="0.8"/>
                <rect x="0.5" y="0.5" width="59" height="59" rx="29.5" stroke="#22374A"/>
                <path d="M30 40L30 20" stroke="#EDFEEC" stroke-width="2"/>
                <path d="M20 30L40 30" stroke="#EDFEEC" stroke-width="2"/>
              </svg>
            </button>
          </li>            
        @endforeach
      </ul>
      <ul id="custom-search-list" class="search-results-content"></ul>
    </div>
  </div>
</section>