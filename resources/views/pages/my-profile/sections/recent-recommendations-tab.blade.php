@php
  use App\Controllers\RecentRecommendationsController;
  $recent_recommendations = RecentRecommendationsController::getRecentRecommendations(50);
@endphp

<section class="recent-recommendations-tab">
  @include('pages.my-profile.partials.profile-section-header', [
    'header_title' => 'Moje Preporuke',
    'show_more' => false,
    'tab_id' => 'moje_preporuke',
    'link_text' => 'Prikaži sve'    
  ])

  @if (!empty($recent_recommendations))
    <ul class="recent-recommendations-list">
      @foreach ($recent_recommendations as $movie)
        <li class="recent-recommendations-card">
          {{-- @include('pages.my-profile.partials.single-movie-card', [
            'movie_index' => $loop->iteration,
            'movie_ID' => $movie['ID'],
            'movie_poster_url' => $movie['poster_url'],
            'movie_post_title' => $movie['title'],
            'movie_year' => $movie['year'],
            'our_recommendations' => $movie['our_recommendations'],
            'my_favorites' => $movie['my_favorites'],
          ]) --}}

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