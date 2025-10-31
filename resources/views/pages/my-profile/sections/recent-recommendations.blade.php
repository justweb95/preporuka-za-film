@php
  use App\Controllers\RecentRecommendationsController;
  $recent_recommendations = RecentRecommendationsController::getRecentRecommendations(10);
@endphp

<section class="recent-recommendations swiffy-slider slider-item-show5 slider-item-show2-sm slider-nav-sm slider-nav-touch slider-nav-autoplay slider-nav-autopause slider-indicators-round slider-indicators-highlight" data-slider-nav-autoplay-interval="4000">
  @include('pages.my-profile.partials.profile-section-header', [
    'header_title' => 'Poslednje preporuke',
    'show_more' => true,
    'tab_id' => 'moje_preporuke',
    'link_text' => 'Prikaži sve'    
  ])

  @if (!empty($recent_recommendations))
    <ul class="recent-recommendations-list slider-container">
      @foreach ($recent_recommendations as $movie)
        <li class="recent-recommendations-card">
          @include('partials/single-movie-card',[
            'movie_index' => $loop->iteration,
            'poster_path' => $movie['poster_url'],
            'movie_ID' => $movie['ID'],
            'release_year' => $movie['year'],
            'our_recommendations' => $movie['our_recommendations'],
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