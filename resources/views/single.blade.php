@extends('layouts.app')

@section('content')
  @if (is_singular('movie'))
    @include('pages.single-movie.sm-hero-section')  
    <section class="sm_subhero_wraper">
        @include('components.comment-form')
        @include('components.comment-list')
        @include('components.comment-banner')
    </section>        
  @else
    @include('pages.single-blog.single-blog-hero')  
    @include('pages.single-blog.single-blog-content')  
    @include('pages.single-blog.single-blog-comment')  
    @include('components.comment-list')
  @endif

  
@endsection
