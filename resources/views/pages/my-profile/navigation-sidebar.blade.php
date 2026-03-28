@php
  $navLinks = [
      ['nav_name' => 'Moje preporuke', 'nav_icon' => 'images/sidebar-icons/my-recomendation-icon.svg', 'tab_id' => 'moje_preporuke', 'sidebar_id' => 'moje_preporuke'],
      ['nav_name' => 'Napredna Preporuka', 'nav_icon' => 'images/sidebar-icons/advance-search-icon.svg', 'tab_id' => 'napredna_pretraga', 'sidebar_id' => 'napredna_pretraga'],
      ['nav_name' => 'Moji omiljeni filmovi', 'nav_icon' => 'images/sidebar-icons/my-favorite-icon.svg', 'tab_id' => 'omiljeni_filmovi', 'sidebar_id' => 'omiljeni_filmovi'],
      ['nav_name' => 'Već gledano', 'nav_icon' => 'images/sidebar-icons/watched-icon.svg', 'tab_id' => 'vec_gledani', 'sidebar_id' => 'vec_gledani'],
      ['nav_name' => 'Podešavanja', 'nav_icon' => 'images/sidebar-icons/settings-icon.svg', 'tab_id' => 'podesavanja', 'sidebar_id' => 'podesavanja'],
      ['nav_name' => 'Odjavi se', 'nav_icon' => 'images/sidebar-icons/sign-out.svg', 'tab_id' => 'logout', 'sidebar_id' => 'logout'],
  ];

  $current_user = wp_get_current_user();
  $current_user_name = $current_user->display_name; 
  $current_user_img_src = get_user_meta($current_user->ID, 'profile_image', true); 
@endphp

<aside class="sidebar-navigation">
  <a href="{{ home_url() }}/" class="sidebar-logo">
    <img src="@asset('images/partials/preporuka-za-film-logo.svg')" alt="Preporuka za film logo">
    <p class="back-to-main">Povratak na početnu</p>
  </a>
  <div class="sidebar-avatar">
    @if($current_user_img_src)
      <img class="avatar-image" src="@asset($current_user_img_src)" alt="User Avatar">
    @else
      <img class="avatar-image" src="@asset('images/avatars/Profile1.svg')" alt="User Avatar">
    @endif
    <h2 class="sidebar-username">{{$current_user_name}}</h2>
    <div class="sidebar-my-account">Moj Nalog</div>
  </div>
  <ul class="sidebar-nav-list">
    @foreach ($navLinks as $link)
      @include('pages.my-profile.partials.navigation-link', [
        'nav_name' => $link['nav_name'],
        'nav_icon' => $link['nav_icon'],
        'tab_id' => $link['tab_id'],
        'sidebar_id' => $link['sidebar_id'],
      ])
    @endforeach
  </ul>
</aside>