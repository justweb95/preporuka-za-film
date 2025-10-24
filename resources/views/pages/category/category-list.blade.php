
@php
$category = get_queried_object();
// Get the current page for pagination
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$movies = new WP_Query([
  'category_name' => $category->slug,  // Using the category slug for filtering
  'posts_per_page' => 20,  // One post per page
  'post_type' => 'movie',  // Ensure we're querying the 'movie' post type
  'paged' => $paged,  // Handle pagination
]);

$max_pages = $movies->max_num_pages;
@endphp

<section class="category-list">
  <div class="category-list-holder container">
    @if($movies->have_posts())
      @while($movies->have_posts())
        @php
          $movies->the_post(); // Set up post data for the loop
          $poster_path = get_post_meta(get_the_ID(), 'poster_path', true);
          $release_date = get_post_meta(get_the_ID(), 'release_date', true);
          $release_year = date('Y', strtotime($release_date));
          $our_recommendations = get_post_meta(get_the_ID(), 'our_recommendations', true) || false;
        @endphp
        <article class="movie-item">

          <a href="{{ get_permalink() }}">
            <img src="{{ 'https://media.themoviedb.org/t/p/w300_and_h450_bestv2/' . $poster_path }}"
              alt="{{ get_the_title() }} Poster" 
              class="movie-poster">
            <h2>{{ get_the_title() }}</h2>
          </a>
          <p>Godina: {{ $release_year }}</p>

          <div class="card-menu-btn-holder">
            <button class="movie-btn-our-recomentation">
              <svg class="our-recommendation" width="24" height="24" viewBox="0 0 50 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24.6665 43.1253C34.861 43.1253 43.1253 34.861 43.1253 24.6665C43.1253 14.4719 34.861 6.20762 24.6665 6.20762C14.4719 6.20762 6.20763 14.4719 6.20763 24.6665C6.20763 24.7212 6.20786 24.7759 6.20834 24.8305H6.20763L6.20762 56H0L1.48001e-06 24.8305H0.000533918C0.000178155 24.7759 0 24.7212 0 24.6665C0 11.0436 11.0436 0 24.6665 0C38.2894 0 49.333 11.0436 49.333 24.6665C49.333 38.2894 38.2894 49.3329 24.6665 49.3329C19.0965 49.3329 13.9578 47.4868 9.82874 44.373V35.6489C13.1919 40.1852 18.5858 43.1253 24.6665 43.1253Z" fill="#4FC998"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M39.1766 24.6659C39.1766 32.6794 32.6804 39.1756 24.6669 39.1756C16.6534 39.1756 10.1572 32.6794 10.1572 24.6659C10.1572 16.6525 16.6534 10.1562 24.6669 10.1562C32.6804 10.1562 39.1766 16.6525 39.1766 24.6659ZM24.667 18.4475C26.3206 18.4475 27.6611 17.107 27.6611 15.4534C27.6611 13.7998 26.3206 12.4593 24.667 12.4593C23.0134 12.4593 21.6729 13.7998 21.6729 15.4534C21.6729 17.107 23.0134 18.4475 24.667 18.4475ZM30.1443 21.5014C30.9711 22.9335 32.8022 23.4241 34.2343 22.5973C35.6663 21.7705 36.1569 19.9394 35.3302 18.5074C34.5034 17.0753 32.6722 16.5847 31.2402 17.4115C29.8081 18.2382 29.3175 20.0694 30.1443 21.5014ZM15.2838 22.5973C16.7158 23.4241 18.547 22.9335 19.3738 21.5014C20.2006 20.0694 19.7099 18.2382 18.2779 17.4115C16.8458 16.5847 15.0147 17.0753 14.1879 18.5074C13.3611 19.9394 13.8518 21.7705 15.2838 22.5973ZM24.667 36.8724C26.3206 36.8724 27.6611 35.5319 27.6611 33.8783C27.6611 32.2248 26.3206 30.8843 24.667 30.8843C23.0134 30.8843 21.6729 32.2248 21.6729 33.8783C21.6729 35.5319 23.0134 36.8724 24.667 36.8724ZM18.2778 31.8094C16.8457 32.6361 15.0146 32.1455 14.1878 30.7135C13.361 29.2814 13.8516 27.4503 15.2837 26.6235C16.7157 25.7967 18.5469 26.2874 19.3737 27.7194C20.2004 29.1514 19.7098 30.9826 18.2778 31.8094ZM35.3301 30.7135C34.5033 32.1455 32.6722 32.6361 31.2401 31.8094C29.8081 30.9826 29.3174 29.1514 30.1442 27.7194C30.971 26.2874 32.8022 25.7967 34.2342 26.6235C35.6662 27.4503 36.1569 29.2814 35.3301 30.7135ZM23.7385 25.925C24.045 26.2296 24.409 26.382 24.8306 26.382C25.2521 26.382 25.6161 26.2296 25.9226 25.925C26.2292 25.6203 26.3825 25.2585 26.3825 24.8396C26.3825 24.408 26.2292 24.0398 25.9226 23.7352C25.6161 23.4305 25.2521 23.2782 24.8306 23.2782C24.409 23.2782 24.045 23.4305 23.7385 23.7352C23.4319 24.0398 23.2786 24.408 23.2786 24.8396C23.2786 25.2585 23.4319 25.6203 23.7385 25.925Z" fill="white"/>
              </svg>
              <span class="card-menu-btn-tooltip">Preporučujemo</span>
            </button>   

            <button class="movie-btn-already-watched">
              <svg onclick="alreadywatched({{ get_the_ID() }})" id="{{ get_the_ID() }}_watched" class="watched-button" width="24" height="24" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.83082 2H15.5117C16.1075 2 16.6392 2.01836 17.1158 2.08252C19.655 2.36669 20.3425 3.55834 20.3425 6.82168V12.615C20.3425 15.8784 19.655 17.07 17.1158 17.3542C16.6392 17.4183 16.1167 17.4367 15.5117 17.4367H6.83082C6.23499 17.4367 5.70332 17.4183 5.22666 17.3542C2.68749 17.07 2 15.8784 2 12.615V6.82168C2 3.55834 2.68749 2.36669 5.22666 2.08252C5.70332 2.01836 6.23499 2 6.83082 2Z" fill="#06131E" stroke="#EDFEEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M6 20H15.1667" stroke="#EDFEEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8 10L10.5 12.5L15 8" stroke="#EDFEEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>

              <span class="card-menu-btn-tooltip">Dodaj u vec gledane</span>
            </button>

            <button class="movie-btn-favorites">
              <svg onclick="likeButtonHandler({{ get_the_ID() }})" id="{{ get_the_ID() }}_favorites" class="like-button" width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.3725 2.85593C11.5111 3.06761 11.747 3.19517 12 3.19517C12.253 3.19517 12.489 3.06761 12.6275 2.85592C13.6562 1.28437 15.1845 0.727064 16.789 0.750709C20.0209 0.798338 23.25 3.50673 23.25 7.33386C23.25 11.2953 20.7388 14.7747 17.9448 17.3208C16.5604 18.5824 15.139 19.5844 13.9963 20.2679C13.4246 20.6098 12.9308 20.8672 12.5535 21.0363C12.3642 21.1211 12.2131 21.1797 12.102 21.2156C12.0533 21.2313 12.02 21.2401 12 21.2449C11.98 21.2401 11.9467 21.2313 11.898 21.2156C11.7869 21.1797 11.6358 21.1211 11.4466 21.0363C11.0693 20.8672 10.5754 20.6098 10.0038 20.2679C8.86105 19.5844 7.4396 18.5824 6.05517 17.3208C3.26118 14.7747 0.75 11.2953 0.75 7.33386C0.75 3.49765 3.98649 0.750792 7.2 0.750792C8.79265 0.750792 10.3484 1.29143 11.3725 2.85593Z" fill="#06131E" stroke="#EDFEEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="card-menu-btn-tooltip">Dodaj u omiljene</span>
            </button>
            
          </div>
        </article>
      @endwhile
    @else
      <article>
        <h2>Nijedan film nije pronađen u ovoj kategoriji</h2>
      </article>
    @endif
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

