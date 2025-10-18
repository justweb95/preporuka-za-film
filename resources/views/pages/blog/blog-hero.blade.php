<?php
  $category = get_queried_object();

  $haveCategory = $category->name === '' ? false : true;

?>

<section class="blog_hero">
  <div class="blog_hero_holder container">
    <ul id="blog_hero_navigation" class="blog_hero_navigation">
      <li><a href="{{ home_url() }}/">Početna</a></li>
      <li><svg width="11" height="12" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 1.5L8 7.00001L3 1.5ZM8 7.00001L3 12.5L8 7.00001Z" fill="#EDFEEC"/>
          <path d="M3 1.5L8 7.00001L3 12.5" stroke="#18BF7C" stroke-width="2"/>
        </svg></li>
      @if ($haveCategory)
      <li><a href="{{ home_url() }}/blog">Blog</a></li>
      <li><svg width="11" height="12" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M3 1.5L8 7.00001L3 1.5ZM8 7.00001L3 12.5L8 7.00001Z" fill="#EDFEEC"/>
        <path d="M3 1.5L8 7.00001L3 12.5" stroke="#18BF7C" stroke-width="2"/>
      </svg></li>
      <li><a id="bh_name" href="{{ url('/category/blog/' . $category->slug) }}">{{ $category->name }}</a></li>
      @else 
        <li><a id="bh_name" href="{{ home_url() }}/blog">Blog</a></li>
      @endif
    </ul>
  
    {{-- Blog Header --}}
    <div class="blog_header">
      <h1>Blog</h1>
      <h2>Pratite aktuelnosti iz sveta kinematografije</h2>
    </div>
  </div>
</section>