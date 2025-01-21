@extends('layouts.app')

@section('content')
  {{-- @while(have_posts()) @php(the_post())
    @includeFirst(['partials.content-single-' . get_post_type(), 'partials.content-single'])
  @endwhile --}}

  @include('pages.single-movie.sm-hero-section')
  <section class="sm_subhero_wraper">
      @include('components.comment-form')
      @include('components.comment-list')
      @include('components.comment-banner')
  </section>
  
@endsection
