{{-- 
  Template Name: My Profile Page Template 
--}}

<?php
  // Redirect users who are not logged in or not subscribers
  // if (!is_user_logged_in() || !in_array('subscriber', (array) wp_get_current_user()->roles)) {
  //     wp_redirect(home_url('/wp-login.php'));
  //     exit;
  // }
?>

@extends('layouts.app')

@section('content')
  @include('pages.my-profile.navigation-sidebar')

  <section class="profile-main">
    <div class="profile-container">      
      <div class="my-recommendations-tab tab-content" id="recommendations">
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
      

      <div class="tab-content" id="advanced_recommendation" hidden>
        @include('pages.my-profile.partials.tab-header', [ 
          'tab_heading' => 'Napredna Pretraga', 
          'notification' => false, 
          'new_recommendations' => true
        ])
      </div>
      
      <div class="tab-content" id="favorite_movies" hidden>
        @include('pages.my-profile.partials.tab-header', [ 
          'tab_heading' => 'Moji Omiljeni Filmovi', 
          'notification' => false, 
          'new_recommendations' => true
        ])
      </div>
      
      <div class="tab-content" id="already_watched" hidden>
        @include('pages.my-profile.partials.tab-header', [ 
          'tab_heading' => 'Već Gledani Filmovi', 
          'notification' => false, 
          'new_recommendations' => true
        ])
      </div>
      
      <div class="tab-content" id="settings" hidden>
        @include('pages.my-profile.partials.tab-header', [ 
          'tab_heading' => 'Korisnička podešavanja', 
          'notification' => true, 
          'new_recommendations' => false
        ])
      </div>      
    </div>
  </section>
@endsection
