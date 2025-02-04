
@php
  $movies = new WP_Query([
    's' => get_search_query(),  
    'posts_per_page' => 20,  
    'post_type' => 'movie',  
  ]);
@endphp

<section class="search-list">
  <div class="search-list-holder container">
      @while($movies->have_posts())
        @php
          $movies->the_post(); // Set up post data for the loop
          $poster_path = get_post_meta(get_the_ID(), 'poster_path', true);
          $release_date = get_post_meta(get_the_ID(), 'release_date', true);
          $release_year = date('Y', strtotime($release_date));
        @endphp
        <article class="movie-item">
          <a href="{{ get_permalink() }}">
            <img src="{{ 'https://media.themoviedb.org/t/p/w300_and_h450_bestv2/' . $poster_path }}" alt="{{ get_the_title() }} Poster" class="movie-poster">
            <h2>{{ get_the_title() }}</h2>
          </a>
          <p>Godina: {{ $release_year }}</p>
          <svg onclick="likeButtonHandler({{ get_the_ID() }})" id="{{ get_the_ID() }}" class="like-button" width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11.3725 2.85593C11.5111 3.06761 11.747 3.19517 12 3.19517C12.253 3.19517 12.489 3.06761 12.6275 2.85592C13.6562 1.28437 15.1845 0.727064 16.789 0.750709C20.0209 0.798338 23.25 3.50673 23.25 7.33386C23.25 11.2953 20.7388 14.7747 17.9448 17.3208C16.5604 18.5824 15.139 19.5844 13.9963 20.2679C13.4246 20.6098 12.9308 20.8672 12.5535 21.0363C12.3642 21.1211 12.2131 21.1797 12.102 21.2156C12.0533 21.2313 12.02 21.2401 12 21.2449C11.98 21.2401 11.9467 21.2313 11.898 21.2156C11.7869 21.1797 11.6358 21.1211 11.4466 21.0363C11.0693 20.8672 10.5754 20.6098 10.0038 20.2679C8.86105 19.5844 7.4396 18.5824 6.05517 17.3208C3.26118 14.7747 0.75 11.2953 0.75 7.33386C0.75 3.49765 3.98649 0.750792 7.2 0.750792C8.79265 0.750792 10.3484 1.29143 11.3725 2.85593Z" fill="#06131E" stroke="#EDFEEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </article>
      @endwhile
  </div>
</section>

