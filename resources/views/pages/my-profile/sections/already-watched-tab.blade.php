@php
  use App\Controllers\RecentRecommendationsController;
  $my_favorites = RecentRecommendationsController::getAlreadyWatchedMovies(10);
@endphp

<section class="already-watched-tab">

  @include('pages.my-profile.partials.profile-section-header', [
    'header_title' => 'Već gledano',
    'show_more' => false,
    'tab_id' => 'recommendations',
    'link_text' => 'Prikaži sve'    
  ])

  @if (!empty($my_favorites))
    <ul class="already-watched-list">
      @foreach ($my_favorites as $movie)
        <li class="recent-recommendations-card">
          @include('partials/single-movie-card',[
            'movie_index' => $loop->iteration,
            'poster_path' => $movie['poster_url'],
            'movie_ID' => $movie['ID'],
            'release_year' => $movie['year'],
            'vote_average' => $movie['vote_average'],
            'genres' => $movie['genres'],
            'our_recommendations' => $movie['our_recommendations'],
          ])
        </li>
      @endforeach
    </ul>
  @else
    <p class="no-results-found">Trenutno nema preporučenih filmova.</p>
  @endif
</section>