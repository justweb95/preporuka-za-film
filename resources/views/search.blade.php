@extends('layouts.app')

@section('content')

  @include('components.search-header')








  @if (! have_posts())
    @include('components.search-nothing-found')
  @endif

  @while(have_posts()) @php(the_post())
    @include('components.search-list')
    {{-- @include('partials.content-search') --}}
  @endwhile

  {{-- {!! get_the_posts_navigation() !!} --}}
@endsection
