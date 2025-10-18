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
          'new_recommendations' => false
        ])
      
        @include('pages.my-profile.partials.advance-search-banner')
        @include('pages.my-profile.sections.recent-recommendations')
        @include('pages.my-profile.sections.my-favorites')      
      </div>
      

      <div class="tab-content" id="advanced_recommendation" hidden>
        @include('pages.my-profile.partials.profile-section-header', [
          'header_title' => 'Poslednje preporuke',
          'tab_id' => 'recommendations',
          'link_text' => 'Prikaži sve'    
        ])
      </div>
      
      <div class="tab-content" id="favorite_movies" hidden>
        <h1>Moji Omiljeni Filmovi</h1>
      </div>
      
      <div class="tab-content" id="already_watched" hidden>
        <h1>Vec gledano</h1>
      </div>
      
      <div class="tab-content" id="settings" hidden>
        <h1>Podesavanja</h1>
      </div>      
    </div>
  </section>
@endsection
