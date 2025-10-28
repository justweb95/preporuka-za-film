{{-- 
  Template Name: My Profile Page Template 
--}}

@extends('layouts.app')

@section('content')

@php
  $active_tab = request()->query('tab', 'profil_home');
@endphp

@include('pages.my-profile.navigation-sidebar')

<section class="profile-main">
  <div class="profile-container">      

    {{-- Profile home tab --}}
    <div class="my-profile-home-tab tab-content" id="profil_home" {{ $active_tab === 'profil_home' ? '' : 'hidden' }}>
      @include('pages.my-profile.partials.tab-header', [ 
        'tab_heading' => 'Dobrodošao nazad! 👋', 
        'notification' => true, 
        'new_recommendations' => true
      ])
      @include('pages.my-profile.partials.advance-search-banner')
      @include('pages.my-profile.sections.recent-recommendations')
      @include('pages.my-profile.sections.my-favorites')
      @include('pages.my-profile.sections.already-watched')
    </div>

    {{-- Moje Preporuke --}}
    <div class="my-recommendations-tab tab-content" id="moje_preporuke" {{ $active_tab === 'moje_preporuke' ? '' : 'hidden' }}>
      @include('pages.my-profile.partials.tab-header', [ 
        'tab_heading' => 'Moje Preporuke', 
        'notification' => true, 
        'new_recommendations' => true
      ])
      @include('pages.my-profile.sections.recent-recommendations-tab')
    </div>

    {{-- Napredna Pretraga --}}
    <div class="tab-content" id="napredna_pretraga" {{ $active_tab === 'napredna_pretraga' ? '' : 'hidden' }}>
      @include('pages.my-profile.partials.tab-header', [ 
        'tab_heading' => 'Napredna Pretraga', 
        'notification' => false, 
        'new_recommendations' => true
      ])
    </div>

    {{-- Omiljeni Filmovi --}}
    <div class="tab-content" id="omiljeni_filmovi" {{ $active_tab === 'omiljeni_filmovi' ? '' : 'hidden' }}>
      @include('pages.my-profile.partials.tab-header', [ 
        'tab_heading' => 'Moji Omiljeni Filmovi', 
        'notification' => false, 
        'new_recommendations' => true
      ])

      @include('pages.my-profile.sections.my-favorites-tab')
    </div>

    {{-- Vec Gledani --}}
    <div class="tab-content" id="vec_gledani" {{ $active_tab === 'vec_gledani' ? '' : 'hidden' }}>
      @include('pages.my-profile.partials.tab-header', [ 
        'tab_heading' => 'Već Gledani Filmovi', 
        'notification' => false, 
        'new_recommendations' => true
      ])

      @include('pages.my-profile.sections.already-watched-tab')
    </div>

    {{-- Podešavanja --}}
    <div class="tab-content" id="podesavanja" {{ $active_tab === 'podesavanja' ? '' : 'hidden' }}>
      @include('pages.my-profile.partials.tab-header', [ 
        'tab_heading' => 'Korisnička podešavanja', 
        'notification' => true, 
        'new_recommendations' => false
      ])
    </div>

  </div>
</section>

@endsection
