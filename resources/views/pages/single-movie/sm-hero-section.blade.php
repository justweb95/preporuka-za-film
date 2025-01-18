@php
  // Get the current post object
  $movie = get_post();

  // Get the title of the movie (post title)
  $title = get_the_title($movie);

  // Remove everything after '&' in the title
  if (strpos($title, '&amp;') !== false) {
      $title = substr($title, 0, strpos($title, '&amp;'));
  }

  // Get the 'genres' meta field
  $genres = get_post_meta($movie->ID, 'genres', true);

  // If the genres are a string with quotes at the beginning and end, remove them
  if (is_string($genres)) {
      // Remove the leading and trailing quotes (if they exist)
      $genres = trim($genres, '"');
  }

  // var_dump($genres);
  // var_dump($adult);
@endphp

{{-- Hero Single Movie --}}
<section id="sm_hero_section" class="sm-hero-section">
  {{-- <h2>{{ $movie->ID }}</h2> --}}

  <div class="sm-hero-holder container">
  {{-- <span id="loading" class="sm-loader">Ucitavanje...</span> --}}
  <ul id="sm_navigation" class="sm-navigation">
    <li>Početna</li>
    <li>
    <svg width="11" height="12" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M3 1.5L8 7.00001L3 1.5ZM8 7.00001L3 12.5L8 7.00001Z" fill="#EDFEEC"/>
      <path d="M3 1.5L8 7.00001L3 12.5" stroke="#18BF7C" stroke-width="2"/>
    </svg>
    </li>
    <li>Kategorije</li>
    <li>
    <svg width="11" height="12" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M3 1.5L8 7.00001L3 1.5ZM8 7.00001L3 12.5L8 7.00001Z" fill="#EDFEEC"/>
      <path d="M3 1.5L8 7.00001L3 12.5" stroke="#18BF7C" stroke-width="2"/>
    </svg>
    </li>
    <li id="movie_category">{{$genres}}</li>
    <li>
    <svg width="11" height="12" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M3 1.5L8 7.00001L3 1.5ZM8 7.00001L3 12.5L8 7.00001Z" fill="#EDFEEC"/>
      <path d="M3 1.5L8 7.00001L3 12.5" stroke="#18BF7C" stroke-width="2"/>
    </svg>
    </li>
    <li id="movie_name">{{ $title }}</li>
  </ul>
  </div>
</section>
