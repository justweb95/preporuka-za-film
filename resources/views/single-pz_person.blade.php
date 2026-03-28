@extends('layouts.app')

@section('content')
  @php
    $person = get_post();
    $name = get_the_title($person);
    $profile_path = get_post_meta($person->ID, 'profile_path', true);
    $tmdb_id = get_post_meta($person->ID, 'tmdb_person_id', true);
    $image_url = $profile_path ? ('https://media.themoviedb.org/t/p/w300_and_h450_bestv2' . $profile_path) : '';
  @endphp

  <section class='container' style='padding: 40px 0;'>
    <h1 style='color: #FFF; font-family: Red Hat Display; font-weight: 800;'>{{ $name }}</h1>

    @if($image_url)
      <img src='{{ $image_url }}' alt='{{ $name }}' loading='lazy' decoding='async' style='max-width: 220px; border-radius: 12px; border: 1px solid #22374A; margin-top: 16px;' />
    @endif

    @if($tmdb_id)
      <p style='color: #EDFEEC; font-family: Red Hat Display; margin-top: 16px;'>TMDB ID: {{ $tmdb_id }}</p>
    @endif

    <div style='color: #EDFEEC; font-family: Red Hat Display; margin-top: 20px;'>
      {!! apply_filters('the_content', get_the_content()) !!}
    </div>
  </section>
@endsection
