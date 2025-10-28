@php
  use App\Controllers\RecentRecommendationsController;
  $my_favorites = RecentRecommendationsController::getAlreadyWatchedMovies(10);
@endphp

<section class="already-watched-tab">

  @include('pages.my-profile.partials.profile-section-header', [
    'header_title' => 'Poslednje preporuke',
    'show_more' => false,
    'tab_id' => 'recommendations',
    'link_text' => 'Prikaži sve'    
  ])

  @if (!empty($my_favorites))
    <ul class="already-watched-list">
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
  @else
    <p class="no-results-found">Trenutno nema preporučenih filmova.</p>
  @endif
</section>