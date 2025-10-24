@php
  use App\Controllers\RecentRecommendationsController;
  $my_favorites = RecentRecommendationsController::getAlreadyWatchedMovies(10);
@endphp

<section class="recent-recommendations swiffy-slider slider-item-show5 slider-item-show2-sm slider-nav-sm slider-nav-touch slider-nav-autoplay slider-nav-autopause slider-indicators-round slider-indicators-highlight" data-slider-nav-autoplay-interval="4000">

  @include('pages.my-profile.partials.profile-section-header', [
    'header_title' => 'Poslednje preporuke',
    'tab_id' => 'recommendations',
    'link_text' => 'Prikaži sve'    
  ])

  @if (!empty($my_favorites))
    <ul class="recent-recommendations-list slider-container">
      @foreach ($my_favorites as $movie)
        <li class="recent-recommendations-card">
          @include('pages.my-profile.partials.single-movie-card', [
            'movie_index' => $loop->iteration,
            'movie_ID' => $movie['ID'],
            'movie_poster_url' => $movie['poster_url'],
            'movie_post_title' => $movie['title'],
            'movie_year' => $movie['year'],
            'our_recommendations' => $movie['our_recommendations'],
            'my_favorites' => $movie['my_favorites'],
          ])
        </li>
      @endforeach
    </ul>

    <button type="button" class="slider-nav"></button>
    <button type="button" class="slider-nav slider-nav-next"></button>
  @else
    <p class="no-results-found">Trenutno nema preporučenih filmova.</p>
  @endif
</section>