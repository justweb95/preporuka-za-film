@extends('layouts.app')

@section('content')
  @php
    $person = get_post();
    $name = get_the_title($person);

    $tmdb_id = absint(get_post_meta($person->ID, 'tmdb_person_id', true));
    $profile_path = get_post_meta($person->ID, 'profile_path', true);

    $cache = get_post_meta($person->ID, 'tmdb_person_cache', true);
    $details = is_array($cache) ? ($cache['details'] ?? []) : [];
    $movies = is_array($cache) ? ($cache['movies'] ?? []) : [];

    $bio = $details['biography'] ?? '';
    $known_for = $details['known_for_department'] ?? '';
    $birthday = $details['birthday'] ?? '';
    $deathday = $details['deathday'] ?? '';
    $place_of_birth = $details['place_of_birth'] ?? '';

    $profile_path = $details['profile_path'] ?? $profile_path;
    $image_url = $profile_path ? ('https://media.themoviedb.org/t/p/w300_and_h450_bestv2' . $profile_path) : '';
	  @endphp

	  <section class="container pz-person-page">
	    <div class="pz-person-hero">
	      <div class="pz-person-photo">
	        @if($image_url)
	          <img src="{{ $image_url }}" alt="{{ $name }}" loading="lazy" decoding="async" width="560" height="840">
	        @else
	          <div class="pz-person-photo-fallback" aria-hidden="true">{{ substr(trim($name ?: '?'), 0, 1) }}</div>
	        @endif
	      </div>

	      <div>
	        <h1 class="pz-person-title">{{ $name }}</h1>

        <div class="pz-person-subtitle">
          @if(!empty($known_for))
            <span>{{ $known_for }}</span>
	          @endif
	          @if($tmdb_id)
	            <span class="pz-person-subtitle-muted"> · TMDB: {{ $tmdb_id }}</span>
	          @endif
	        </div>

	        <div class="pz-person-facts">
          @if(!empty($birthday))
            <div class="pz-person-fact">
              <span class="pz-person-fact-label">Datum rodjenja</span>
              <span class="pz-person-fact-value">{{ $birthday }}</span>
            </div>
          @endif

          @if(!empty($deathday))
            <div class="pz-person-fact">
              <span class="pz-person-fact-label">Datum smrti</span>
              <span class="pz-person-fact-value">{{ $deathday }}</span>
            </div>
          @endif

          @if(!empty($place_of_birth))
            <div class="pz-person-fact">
              <span class="pz-person-fact-label">Mesto rodjenja</span>
              <span class="pz-person-fact-value">{{ $place_of_birth }}</span>
            </div>
          @endif

          @if(empty($birthday) && empty($deathday) && empty($place_of_birth))
            <div class="pz-person-fact">
              <span class="pz-person-fact-label">Info</span>
              <span class="pz-person-fact-value"></span>
            </div>
          @endif
	        </div>

	        <div class="pz-person-bio-block">
	          <h2 class="pz-person-h2">Biografija</h2>
	          @if(!empty($bio))
	            <p class="pz-person-bio">{{ $bio }}</p>
	          @else
	            <p class="pz-person-bio"></p>
	          @endif
	        </div>
	      </div>
	    </div>

	    <div class="pz-person-section" data-person-filmography-section data-person-id="{{ $person->ID }}">
	      <h2 class="pz-person-h2">Filmografija</h2>
	      <div class="pz-person-movies" data-person-filmography>
	        <p class="pz-person-bio">Ucitavanje filmografije....</p>
	      </div>
	      <noscript>
	        <p class="pz-person-bio">Ukljuci JavaScript da bi video filmografiju.</p>
	      </noscript>
	    </div>
	  </section>
@endsection
