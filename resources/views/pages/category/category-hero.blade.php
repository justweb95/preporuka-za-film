@php
  // Get the currently queried category
  $category = get_queried_object();
  
  // Get the name and slug of the category
  $category_name = $category->name;
  $category_link = $category->slug;

  // Get all categories for the 'movie' post type
  $movie_categories = get_categories(array(
    'taxonomy' => 'category',
    'type' => 'movie',
  ));

  // Remove categories with names 'Blog', 'Recenzije', 'Top List', and 'Vesti' from the list
  $movie_categories = array_filter($movie_categories, function($cat) {
    return !in_array($cat->name, ['Blog', 'Recenzije', 'Top List', 'Vesti']);
  });
  // Re-index the array to avoid any gaps in the keys after filtering
  $movie_categories = array_values($movie_categories);
@endphp


<section class="category_hero container">
    {{-- Category navigation --}}
    <ul id="category_hero_navigation" class="category_hero_navigation">
      <li><a href="{{ home_url() }}/">Početna</a></li>
      <li><svg width="11" height="12" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 1.5L8 7.00001L3 1.5ZM8 7.00001L3 12.5L8 7.00001Z" fill="#EDFEEC"/>
          <path d="M3 1.5L8 7.00001L3 12.5" stroke="#18BF7C" stroke-width="2"/>
        </svg></li>
      <li>Kategorije</li>
      <li><svg width="11" height="12" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M3 1.5L8 7.00001L3 1.5ZM8 7.00001L3 12.5L8 7.00001Z" fill="#EDFEEC"/>
        <path d="M3 1.5L8 7.00001L3 12.5" stroke="#18BF7C" stroke-width="2"/>
      </svg></li>
      <li>
        <a id="movie_category" href="{{ url('/category/' . $category_link) }}">{{ $category_name }} Filmovi</a>
      </li>
    </ul>
  
    {{-- Category Header --}}
    <div class="category-header">
      <h1>Najbolji {{ $category_name}} filmovi</h1>
      <h2>Ne možeš se odlučiti? koristi nasu <a href="{{ home_url() }}/anketa">AI pretragu</a></h2>
    </div>

    {{-- Category drop-down --}}
    <div class="category-drop-down">
      <span class="category-drop-down-holder" onclick="handleCategoryDropdown()">
        <p class="cat">Katekorija:</p>
        <p class="cat-net">{{ $category_name }}</p>
        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="8" viewBox="0 0 13 8" fill="none">
          <path d="M12 1.5L6.49999 6.5L12 1.5ZM6.49999 6.5L1 1.5L6.49999 6.5Z" fill="#EDFEEC"/>
          <path d="M12 1.5L6.49999 6.5L1 1.5" stroke="white" stroke-width="2"/>
        </svg>
      </span>
      <ul class="category-drop-down-list">
        @foreach ($movie_categories as $movie_category)
          <li class="category-drop-down-item">
            <a href="{{ get_category_link($movie_category->term_id) }}">
              {{ $movie_category->name }}
              <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
              </svg>
            </a>
          </li>
        @endforeach
      </ul>
    </div>
</section>
