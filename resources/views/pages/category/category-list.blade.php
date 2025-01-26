@php
$category = get_queried_object();

$movies = get_posts([
  'category' => $category->term_id,
  'numberposts' => -1,
  'post_type' => 'movie',
]);

var_dump($movies);
@endphp

<section class="category-list">
  <div class="category-list-holder">
    @if($movies && count($movies) > 0)
      @foreach($movies as $movie)
      @php
      // Poster Path
      $poster_path = get_post_meta($movie->ID, 'poster_path', true);
      @endphp
        <article class="movie-item" data-movie_id="{{ $movie->ID }}">
          <img src="{{ 'https://media.themoviedb.org/t/p/w300_and_h450_bestv2/' .  $poster_path }}" alt="{{ get_the_title($movie->ID) }} Poster" class="movie-poster">
          <h2>{{ get_the_title($movie->ID) }}</h2>
          <p>Year: {{ get_post_meta($movie->ID, 'release_year', true) }}</p>
        </article>
      @endforeach
    @else
      <p>No movies found in this category.</p>
    @endif
  </div>
</section>
