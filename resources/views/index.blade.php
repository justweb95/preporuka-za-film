@extends('layouts.app')

@section('content')

  {{-- @include('partials.page-header') --}}
  
  
  @include('pages.category.category-hero')
  @include('pages.category.category-list')


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
