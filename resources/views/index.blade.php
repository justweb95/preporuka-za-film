@extends('layouts.app')

@section('content')

  {{-- @include('partials.page-header') --}}
  @php
    $category = get_queried_object();
    $isBlog = $category->parent === 0 
  @endphp

  @if ($isBlog)
    @include('pages.category.category-hero')
    @include('pages.category.category-list')
  @else
    @include('pages.blog.blog-hero')
    @include('pages.blog.blog-list')
  @endif


  {{-- @if (! have_posts())
    <x-alert type="warning">
      {!! __('Sorry, no results were found.', 'sage') !!}
    </x-alert>

    {!! get_search_form(false) !!}
  @endif --}}

  {{-- @while(have_posts()) @php(the_post())
    @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
  @endwhile --}}

  {{-- {!! get_the_posts_navigation() !!} --}}
@endsection
{{-- 
@section('sidebar')
  @include('sections.sidebar')
@endsection --}}
