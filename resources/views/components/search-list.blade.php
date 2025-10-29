
@php
  // Get the current page for pagination
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

  $movies = new WP_Query([
    's' => get_search_query(),
    'posts_per_page' => 20,
    'post_type' => 'movie',
    'paged' => $paged, 
  ]);

  $max_pages = $movies->max_num_pages;

@endphp


<section class="search-list">
  <div class="search-list-holder container">
      @while($movies->have_posts())
        @php
          $movies->the_post(); // Set up post data for the loop
          $poster_path = get_post_meta(get_the_ID(), 'poster_path', true);
          $release_date = get_post_meta(get_the_ID(), 'release_date', true);
          $release_year = date('Y', strtotime($release_date));
          $our_recommendations = get_post_meta(get_the_ID(), 'our_recommendations', true) || false;
        @endphp
        @include('partials/single-movie-card',[
          'movie_index' => $loop->iteration,
          'poster_path' => $poster_path,
          'movie_ID' => get_the_ID(),
          'release_year' => $release_year,
          'our_recommendations' => $our_recommendations,
        ])
      @endwhile
  </div>
  <!-- Pagination Links -->
  <div class="pagination container">
    @if($movies->max_num_pages > 1 && $movies->have_posts())
      <div class="pagination-links">
        @if($paged > 1)
          <span class="page-number back-button">
            <a href="{{ get_pagenum_link($paged - 1) }}">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                <path d="M17.5 7L2.5 7M2.5 7L8 12.5M2.5 7L8 1.5" stroke="white" stroke-width="2.4"/>
              </svg>
            </a>
          </span>
        @endif

          {{-- If there are less than 6 pages, show all of them --}}
          @if ($max_pages <= 5)
            @for ($i = 1; $i <= $max_pages; $i++)
              <span class="page-number {{ $i == $paged ? 'active-page' : '' }}">
                <a href="{{ get_pagenum_link($i) }}">{{ $i }}</a>
              </span>
            @endfor
          @else
          {{-- For more than 5 pages, show a dynamic range of pages --}}
          {{-- Display first pages or pages around the current page --}}
          @if ($paged <= 3)
            @for ($i = 1; $i <= 4; $i++)
              <span class="page-number {{ $i == $paged ? 'active-page' : '' }}">
                <a href="{{ get_pagenum_link($i) }}">{{ $i }}</a>
              </span>
            @endfor
          @elseif ($paged >= $max_pages - 2)
            {{-- Display last 4 pages when we're near the end --}}
            @for ($i = $max_pages - 3; $i <= $max_pages; $i++)
              <span class="page-number {{ $i == $paged ? 'active-page' : '' }}">
                <a href="{{ get_pagenum_link($i) }}">{{ $i }}</a>
              </span>
            @endfor
          @else
            {{-- Show 2 pages before and after the current page --}}
            @for ($i = $paged - 1; $i <= $paged + 2; $i++)
              <span class="page-number {{ $i == $paged ? 'active-page' : '' }}">
                <a href="{{ get_pagenum_link($i) }}">{{ $i }}</a>
              </span>
            @endfor
          @endif
          @endif

        @if($paged < $movies->max_num_pages)
          <span class="page-number forward-button">
            <a href="{{ get_pagenum_link($paged + 1) }}">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                <path d="M0.5 7L15.5 7M15.5 7L10 12.5M15.5 7L10 1.5" stroke="white" stroke-width="2.4"/>
              </svg>
            </a>
          </span>
        @endif
      </div>
    @endif
  </div>
</section>

