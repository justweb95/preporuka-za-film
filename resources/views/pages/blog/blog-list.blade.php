@php
  // Get the current page for pagination
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

  $blog_posts = new WP_Query([
    'posts_per_page' => 6,  // One post per page
    'post_type' => 'post',  // Ensure we're querying the 'movie' post type
    'paged' => $paged,  // Handle pagination
  ]);
@endphp

<section class="blog_list">
  <div class="blog_list_holder container">
    @if($blog_posts->have_posts())
      @foreach($blog_posts->posts as $blog_post)
        @php
          $thumbnail_url = get_the_post_thumbnail_url($blog_post->ID);
          
          $categories = get_the_category($blog_post->ID);
          $category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized';

          $post_date = get_serbian_post_date($blog_post->ID);
          
          $read_time = ceil(str_word_count($blog_post->post_content) / 200); // Assuming average reading speed of 200 words per minute
          $excerpt = mb_substr(html_entity_decode(strip_tags($blog_post->post_content)), 0, 200) . '...';
        @endphp
        <article class="blog_post_item">
          <a class="blog_post_heading_img" href="{{ get_permalink($blog_post->ID) }}">
            @if ($thumbnail_url)
              <img src="{{ $thumbnail_url }}" alt="{{ get_the_title($blog_post->ID) }} Thumbnail" class="blog_thumbnail">                
            @else
              <img src="@asset('images/blog/default-blog.webp')" alt="Default Image" class="blog_thumbnail">                
            @endif
            <p class="blog_post_category {{ $categories[0]->slug }}">{{ $category_name }}</p>            
          </a>
          <div class="blog_post_content">
            <span class="date_read_time">
              <p class="date">{{ $post_date }}</p>
              <svg class="devider" width="12" height="1" viewBox="0 0 12 1" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0.5L12 0.500001" stroke="#F57C36"/>
              </svg>                
              <p class="read_time">{{ $read_time }}/min čitanja</p>              
            </span>
            <h2 class="blog_post_title">{{ get_the_title($blog_post->ID) }}</h2>
            <p class="blog_post_text">{{ $excerpt }}</p>
            <a class="btn_read_more" href="{{ get_permalink($blog_post->ID) }}" class="read-more-button">
              Pročitaj više
              <svg class="arrow-right" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M-4.37114e-07 6L10.5 6M10.5 6L5.73333 11M10.5 6L5.73333 0.999999" stroke="white" stroke-width="2"/>
              </svg>                
            </a>
          </div>
        </article>
      @endforeach
    @else
      <article>
        <h4>Nijedan film nije pronađen u ovoj kategoriji</h2>
      </article>
    @endif
  </div>

  
  <!-- Pagination Links -->
  <div class="pagination container">
    @if($blog_posts->max_num_pages > 1 && $blog_posts->have_posts())
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
    @for($i = 1; $i <= $blog_posts->max_num_pages; $i++)
      <span class="page-number {{ $i == $paged ? 'active-page' : '' }}">
        <a href="{{ get_pagenum_link($i) }}">{{ $i }}</a>
      </span>
    @endfor
    @if($paged < $blog_posts->max_num_pages)
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