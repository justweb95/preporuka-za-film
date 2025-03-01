@php
// Get the parent category "Blog" by slug (assuming "blog" is the slug of the parent category)
$blog_parent_category = get_category_by_slug('blog');  // Replace with correct slug if necessary

if ($blog_parent_category) {
  $parent_category_id = $blog_parent_category->term_id;
  
  // Get child categories of the "Blog" category
  $categories = get_categories(array(
    'parent' => $parent_category_id,  // Get categories with this parent ID
  ));
}

// Add default category "Sve Kategorije" to the beginning of the categories array
array_unshift($categories, (object) [
  'term_id' => 0,
  'name' => 'Sve Kategorije',
  'slug' => 'sve-kategorije'
]);

// Get the name and slug of the category
$category_name = !empty($category->name) ? $category->name : "Sve Kategorije";
$category_link =  !empty($category->slug) ? $category->slug : "Sve Kategorije";

// Get the current page for pagination
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$category = get_queried_object();

$haveCategory = $category->name === '' ? false : true;

// Check if a category is selected
$category_id = $haveCategory ? $category->term_id : '';

// If 'Sve Kategorije' is selected, set category_id to null (to show all posts)
if ($category_id === 0) {
    $category_id = ''; // Show all posts if 'Sve Kategorije' is selected
}

$args = [
  'posts_per_page' => 6,  // Show 6 posts per page
  'post_type' => 'post',  // Ensure we're querying the 'post' post type
  'paged' => $paged,  // Handle pagination
];

// If a category is selected, add it to the query arguments
if ($category_id) {
  $args['cat'] = $category_id;
}

$blog_posts = new WP_Query($args);
@endphp

<section class="blog_list">
  {{-- Blog drop-down --}}
  <div class="category-drop-down container">
    <span class="category-drop-down-holder" onclick="handleCategoryDropdown()">
      <p class="cat">Katekorija:</p>
      <p class="cat-net">{{ $category_name }}</p>
      <svg class="cat-svg" xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 13 8" fill="none">
        <path d="M12 1.5L6.49999 6.5L12 1.5ZM6.49999 6.5L1 1.5L6.49999 6.5Z" fill="#EDFEEC"/>
        <path d="M12 1.5L6.49999 6.5L1 1.5" stroke="white" stroke-width="2"/>
      </svg>
      <ul class="category-drop-down-list">
        @foreach ($categories as $movie_category)
          <li class="category-drop-down-item">
            @if ($movie_category->term_id === 0)
              <a href="{{ home_url() }}/blog">
                {{ $movie_category->name }}
                <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                  <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
                </svg>
              </a>
            @else
              <a href="{{ get_category_link($movie_category->term_id) }}">
                {{ $movie_category->name }}
                <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                  <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
                </svg>
              </a>
            @endif
          </li>
        @endforeach
      </ul>
      
    </span>
  </div>

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