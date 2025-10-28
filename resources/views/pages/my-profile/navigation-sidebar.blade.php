@php
  $navLinks = [
      ['nav_name' => 'Moje preporuke', 'nav_icon' => 'images/sidebar-icons/my-recomendation-icon.svg', 'tab_id' => 'moje_preporuke'],
      ['nav_name' => 'Napredna Preporuka', 'nav_icon' => 'images/sidebar-icons/advance-search-icon.svg', 'tab_id' => 'napredna_pretraga'],
      ['nav_name' => 'Moji omiljeni filmovi', 'nav_icon' => 'images/sidebar-icons/my-favorite-icon.svg', 'tab_id' => 'omiljeni_filmovi'],
      ['nav_name' => 'Već gledano', 'nav_icon' => 'images/sidebar-icons/watched-icon.svg', 'tab_id' => 'vec_gledani'],
      ['nav_name' => 'Podešavanja', 'nav_icon' => 'images/sidebar-icons/settings-icon.svg', 'tab_id' => 'podesavanja'],
      ['nav_name' => 'Odjavi se', 'nav_icon' => 'images/sidebar-icons/sign-out.svg', 'tab_id' => 'logout'],
  ];

@endphp

<aside class="sidebar-navigation">
  <a href="{{ home_url() }}/" class="sidebar-logo">
    <img src="@asset('images/partials/preporuka-za-film-logo.svg')" alt="Preporuka za film logo">
  </a>
  <div class="sidebar-avatar">
    <img class="avatar-image" src="@asset('images/avatars/Profile2.svg')" alt="User Avatar">

    <h2 class="sidebar-username">Pavle Pesic</h2>
    <div class="sidebar-my-account">Moj Nalog</div>
  </div>
  <ul class="sidebar-nav-list">
    @foreach ($navLinks as $link)
      @include('pages.my-profile.partials.navigation-link', [
        'nav_name' => $link['nav_name'],
        'nav_icon' => $link['nav_icon'],
        'tab_id' => $link['tab_id'],
      ])
    @endforeach
  </ul>
</aside>