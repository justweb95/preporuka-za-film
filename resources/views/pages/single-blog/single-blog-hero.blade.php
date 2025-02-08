@php
  // Getting post
  $post = get_post();
  // Getting post featured img
  $base = "background-image: linear-gradient(180deg, #06131E 0%, rgba(6,19,30,0.7) 50%, rgba(6,19,30,0.7) 100%), url('";
  $backgroundImageUrl = $base . get_the_post_thumbnail_url($post->ID) . "')";
  // Categories
  $categories = get_the_category($post->ID);
  $category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized';
  // Post Name
  $post_name = $post->post_title;
@endphp

<section class="single_blog_hero" style="{{ $backgroundImageUrl }}">
    <div class="single_blog_hero_holder container_blog">
      {{-- Hero navigation --}}
      <ul id="sb_navigation" class="sb_navigation">
        <li><a href="{{ home_url() }}/">Početna</a></li>
        <li><svg width="11" height="12" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 1.5L8 7.00001L3 1.5ZM8 7.00001L3 12.5L8 7.00001Z" fill="#EDFEEC"/>
            <path d="M3 1.5L8 7.00001L3 12.5" stroke="#18BF7C" stroke-width="2"/>
          </svg></li>
        <li>Blog</li>
        <li><svg width="11" height="12" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 1.5L8 7.00001L3 1.5ZM8 7.00001L3 12.5L8 7.00001Z" fill="#EDFEEC"/>
          <path d="M3 1.5L8 7.00001L3 12.5" stroke="#18BF7C" stroke-width="2"/>
        </svg></li>
        <li id="sb_name">{{ $post_name }}</li>
      </ul>
      {{-- Badge --}}
      <span class="sb_badge {{ $categories[0]->slug }}">{{ $category_name }}</span>
      {{-- Post name --}}
      <h1>{{ $post_name }}</h1>
    </div>
</section>