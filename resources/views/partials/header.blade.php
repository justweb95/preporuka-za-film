<?php
  $user_id = get_current_user_id();
  $profile_image = get_user_meta($user_id, 'profile_image', true);

  // fallback if no custom profile image exists
  if (empty($profile_image)) {
      $profile_image = 'images/avatars/Profile1.svg';
  }

  // prepend the theme's public folder path
  $theme_public_url = get_template_directory_uri() . '/public/';
  $profile_image_url = $theme_public_url . $profile_image;

 // Ako je user ulogovan, klase nema, ako nije, dodeljujemo disabled-link
  $disabledClass = ($user_id > 0) ? '' : 'disabled-link';
?>


<header class="header-main">
  {{-- Temporary notification --}}
  <div class="site-notice">    
    <p>Sajt je dobio prvi veći update. Ako primetite nepravilnosti u radu, javite nam putem
    <a href="mailto:infor@preporukazafilm.com">mejla</a> ili na
    <a href="https://www.instagram.com/preporukazafilm/" target="_blank" rel="noopener">Instagramu</a>.</p>
  </div>
  {{-- Temporary notification --}}

  <div class="header-holder container">
    <a class="header-logo-holder" href="{{ url('/') }}">
      <img class="header-logo" width="264" height="40" src="@asset('images/partials/preporuka-za-film-logo.svg')" alt="Preporuka za film logo">
    </a>   
    <nav class="main-nav-desktop">
      <ul class="nav-link">
        <li class="link-item">
          <a href="#">Preporuke</a>
          <svg class="category-icon" width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 1L6.49999 6L12 1ZM6.49999 6L1 1L6.49999 6Z" fill="#EDFEEC"/>
            <path d="M12 1L6.49999 6L1 1" stroke="#18BF7C" stroke-width="2"/>
          </svg>          
          <ul class="link-drop-down">

              <li class="drop-down-item">
                  <a href="{{ url('/anketa') }}">
                      Brza preporuka
                      <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                          <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
                      </svg>
                  </a>
              </li>
              <li class="drop-down-item">
                  <a class="{{ $disabledClass }}" href="{{ url('/moj-profil/?tab=napredna_pretraga') }}">
                      Napredna preporuka
                      <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                          <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
                      </svg>
                  </a>
              </li>
              <li class="drop-down-item">
                  <a href="{{ url('/ili') }}">
                      Ili Ili
                      <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                          <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
                      </svg>
                  </a>
              </li>
              <li class="drop-down-item">
                  <a href="{{ url('/tocak-srece') }}">
                      Točak sreće
                      <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                          <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
                      </svg>
                  </a>
              </li>
          </ul>

        </li>
        <li class="link-item">
          <a href="#">Kategorije</a>
          <svg class="category-icon" width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 1L6.49999 6L12 1ZM6.49999 6L1 1L6.49999 6Z" fill="#EDFEEC"/>
            <path d="M12 1L6.49999 6L1 1" stroke="#18BF7C" stroke-width="2"/>
          </svg>          
          <ul class="link-drop-down">
            <li class="drop-down-item"><a href="{{ url('/category/akcioni') }}">
              Akcija
              <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
              </svg>              
            </a></li>
            <li class="drop-down-item"><a href="{{ url('/category/komedija') }}">
              Komedija
              <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
              </svg>              
            </a></li>
            <li class="drop-down-item"><a href="{{ url('/category/drama') }}">
              Drama
              <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
              </svg>              
            </a></li>
            <li class="drop-down-item"><a href="{{ url('/category/avanturisticki') }}">
              Avantura
              <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
              </svg>              
            </a></li>
            <li class="drop-down-item"><a href="{{ url('/category/triler') }}">
              Triler
              <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
              </svg>
            </a></li>
            <li class="drop-down-item"><a href="{{ url('/category/horor') }}">
              Horor
              <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
              </svg>              
            </a></li>
          </ul>
        </li>
        <li class="link-item blog"><a href="{{ home_url() }}/blog">Blog</a></li>
      </ul>
    </nav>

    <ul class="search-login-list">
      <li class="link-item search">
        <input id="movie-search" class="link-search-input" type="text" aria-label="Search" placeholder="Pretraga..."> 
        <svg id="movie-search-submit" aria-label="Search" class="link-search-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0882 16.7415C13.5044 17.9727 11.5143 18.7058 9.3529 18.7058C4.18744 18.7058 0 14.5184 0 9.3529C0 4.18744 4.18744 0 9.3529 0C14.5184 0 18.7058 4.18744 18.7058 9.3529C18.7058 11.5143 17.9727 13.5044 16.7415 15.0882L20 18.3466L18.3466 20L15.0882 16.7415ZM16.3676 9.3529C16.3676 13.227 13.227 16.3676 9.3529 16.3676C5.4788 16.3676 2.33823 13.227 2.33823 9.3529C2.33823 5.4788 5.4788 2.33823 9.3529 2.33823C13.227 2.33823 16.3676 5.4788 16.3676 9.3529Z" fill="#EDFEEC"/>
        </svg>      
      </li>
      <?php if (is_user_logged_in()): ?>
        <li id="my-profile" class="link-item my-profile">
          <a href="<?php echo home_url('/moj-profil'); ?>">
            <img id="user-avatar" src="<?php echo esc_url($profile_image_url); ?>"  alt="User Avatar">
          </a>
        </li>
      <?php else: ?>
        <li id="login" class="link-item login">
          <a href="{{ home_url() }}/wp-login.php">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.5098 1.18164C16.6132 1.18164 17.5016 1.18068 18.2188 1.23926C18.9475 1.29881 19.5884 1.4248 20.1807 1.72656C21.1212 2.2059 21.8859 2.97152 22.3652 3.91211C22.6669 4.50422 22.793 5.14447 22.8525 5.87305C22.9111 6.59014 22.9102 7.47862 22.9102 8.58203V15.418C22.9102 16.5214 22.9111 17.4098 22.8525 18.127C22.793 18.8555 22.6668 19.4958 22.3652 20.0879C21.886 21.0285 21.1212 21.7941 20.1807 22.2734C19.5884 22.5752 18.9475 22.7002 18.2188 22.7598C17.5016 22.8183 16.6132 22.8184 15.5098 22.8184H14.2197C12.9853 22.8184 12.1611 22.827 11.4619 22.6299C9.78772 22.1576 8.47901 20.849 8.00684 19.1748C7.80986 18.4758 7.81934 17.652 7.81934 16.418V15.9268C7.81972 15.3748 8.26729 14.9268 8.81934 14.9268C9.37129 14.9269 9.81895 15.3749 9.81934 15.9268V16.418C9.81934 17.7868 9.82869 18.2661 9.93164 18.6318C10.2149 19.6364 11.0004 20.4217 12.0049 20.7051C12.3707 20.8082 12.85 20.8184 14.2197 20.8184H15.5098C16.6461 20.8184 17.4389 20.817 18.0557 20.7666C18.6607 20.7172 19.0091 20.6254 19.2725 20.4912C19.8367 20.2036 20.2955 19.744 20.583 19.1797C20.717 18.9164 20.81 18.5686 20.8594 17.9639C20.9097 17.3471 20.9102 16.5543 20.9102 15.418V8.58203C20.9102 7.44579 20.9097 6.65287 20.8594 6.03613C20.8099 5.43118 20.7172 5.08264 20.583 4.81934C20.2954 4.25521 19.8366 3.79632 19.2725 3.50879C19.0091 3.37462 18.6607 3.28187 18.0557 3.23242C17.4389 3.18206 16.646 3.18164 15.5098 3.18164H14.2197C12.8502 3.18164 12.3707 3.19085 12.0049 3.29395C11.0004 3.57724 10.2151 4.36281 9.93164 5.36719C9.82848 5.73298 9.81934 6.2124 9.81934 7.58203V8.07227C9.81933 8.62448 9.37153 9.07215 8.81934 9.07227C8.26705 9.07226 7.81933 8.62455 7.81934 8.07227V7.58203C7.81933 6.34775 7.80966 5.52334 8.00684 4.82422C8.47916 3.1502 9.78784 1.84133 11.4619 1.36914C12.161 1.17203 12.9854 1.18164 14.2197 1.18164H15.5098ZM12.2969 8.0293C12.6827 7.63417 13.3158 7.62588 13.7109 8.01172L17.0625 11.2852C17.2549 11.4732 17.3632 11.7309 17.3633 12C17.3632 12.2692 17.255 12.5277 17.0625 12.7158L13.7109 15.9883C13.3159 16.3738 12.6827 16.3665 12.2969 15.9717C11.9111 15.5766 11.9186 14.9435 12.3135 14.5576L13.9092 13H2.18164C1.62954 12.9999 1.18177 12.5521 1.18164 12C1.18178 11.4479 1.62955 11.0001 2.18164 11H13.9082L12.3135 9.44336C11.9184 9.05759 11.9113 8.42446 12.2969 8.0293Z" fill="#EDFEEC"/>
          </svg>
          Prijavi se</a>
        </li>
      <?php endif; ?>
    </ul>


    <svg class="burger-open-btn" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
      <rect y="0.00012207" width="40" height="40" rx="20" fill="#22374A"/>
      <path fill-rule="evenodd" clip-rule="evenodd" d="M20 11.0001H11V13.2501H20V11.0001ZM11 21.1251V18.8751H29V21.1251H11ZM20 26.7501H29V29.0001H20V26.7501Z" fill="#EDFEEC"/>
    </svg>

    <nav class="burger-menu-content">
      <ul class="nav-link">
        <li class="burger-header">
          <img src="@asset('images/partials/burger-logo.svg')" loading="lazy" alt="Burger Logo">
          <svg class="burger-close" width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect y="0.00012207" width="40" height="40" rx="20" fill="#172938"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.409 19.9203L12.7607 25.5686L14.3517 27.1596L20 21.5113L25.6483 27.1596L27.2393 25.5686L21.591 19.9203L27.0797 14.4317L25.4887 12.8407L20 18.3293L14.5113 12.8407L12.9203 14.4317L18.409 19.9203Z" fill="#EDFEEC"/>
          </svg>
        </li>
        <li class="burger-link-item burger-search">
          <input id="movie-search-mobile" class="link-search-input" type="text" aria-label="Search" placeholder="Pretraga..."> 
          <svg id="movie-search-submit-mobile" aria-label="Search" class="link-search-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0882 16.7415C13.5044 17.9727 11.5143 18.7058 9.3529 18.7058C4.18744 18.7058 0 14.5184 0 9.3529C0 4.18744 4.18744 0 9.3529 0C14.5184 0 18.7058 4.18744 18.7058 9.3529C18.7058 11.5143 17.9727 13.5044 16.7415 15.0882L20 18.3466L18.3466 20L15.0882 16.7415ZM16.3676 9.3529C16.3676 13.227 13.227 16.3676 9.3529 16.3676C5.4788 16.3676 2.33823 13.227 2.33823 9.3529C2.33823 5.4788 5.4788 2.33823 9.3529 2.33823C13.227 2.33823 16.3676 5.4788 16.3676 9.3529Z" fill="#EDFEEC"/>
          </svg>      
        </li>
        <li class="burger-link-item"><a href="{{ home_url() }}/">Početna</a></li>
        <li class="burger-link-item"><a href="{{ home_url() }}/o-nama">O Nama</a></li>
        <li class="burger-link-item burger-open-dropdown">
          <a href="#">Preporuke</a>
           <svg class="burger-category-icon" width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 1L6.49999 6L12 1ZM6.49999 6L1 1L6.49999 6Z" fill="#EDFEEC"/>
            <path d="M12 1L6.49999 6L1 1" stroke="#18BF7C" stroke-width="2"/>
          </svg>          
          <ul class="link-drop-down burger-dropdown-content">
            <li class="drop-down-item"><a href="{{ home_url() }}/anketa">
              Brza preporuka
              <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
              </svg>              
            </a></li>
            <li class="drop-down-item"><a class="{{ $disabledClass }}" href="{{ home_url() }}/moj-profil/?tab=napredna_pretraga">
              Napredna preporuka
              <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
              </svg>              
            </a></li>
            <li class="drop-down-item"><a href="{{ home_url() }}/ili">
              Ili Ili
              <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
              </svg>              
            </a></li>
            <li class="drop-down-item"><a href="{{ home_url() }}/tocak-srece">
              Točak sreće
              <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
              </svg>
            </a></li>
          </ul>
        </li>

        <li class="burger-link-item burger-open-dropdown">
          <a href="#">Kategorije</a>
           <svg class="burger-category-icon" width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 1L6.49999 6L12 1ZM6.49999 6L1 1L6.49999 6Z" fill="#EDFEEC"/>
            <path d="M12 1L6.49999 6L1 1" stroke="#18BF7C" stroke-width="2"/>
          </svg>          
          <ul class="link-drop-down burger-dropdown-content">
            <li class="drop-down-item"><a href="{{ url('/category/akcioni') }}">
              Akcija
              <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
              </svg>              
            </a></li>
            <li class="drop-down-item"><a href="{{ url('/category/komedija') }}">
              Komedija
              <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
              </svg>              
            </a></li>
            <li class="drop-down-item"><a href="{{ url('/category/avanturisticki') }}">
              Avantura
              <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
              </svg>              
            </a></li>
            <li class="drop-down-item"><a href="{{ url('/category/triler') }}">
              Triler
              <svg width="8" height="13" viewBox="0 0 8 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L6 6.50001ZM6 6.50001L1 12Z" fill="#EDFEEC"/>
                <path d="M1 1L6 6.50001L1 12" stroke="#18BF7C" stroke-width="2"/>
              </svg>
            </a></li>
          </ul>
        </li>
        <li class="burger-link-item"><a href="{{ home_url() }}/blog">Blog</a></li>
        
        <?php if (is_user_logged_in()): ?>
          <li class="burger-link-item login-mobile">
            <a href="<?php echo home_url('/moj-profil'); ?>">
              <img id="user-avatar-mobile" src="<?php echo esc_url($profile_image_url); ?>"  alt="User Avatar">
              Moj profil
            </a>
          </li>
        <?php else: ?>
          <li class="burger-link-item login-mobile">
            <a href="{{ home_url() }}/wp-login.php">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.5098 1.18164C16.6132 1.18164 17.5016 1.18068 18.2188 1.23926C18.9475 1.29881 19.5884 1.4248 20.1807 1.72656C21.1212 2.2059 21.8859 2.97152 22.3652 3.91211C22.6669 4.50422 22.793 5.14447 22.8525 5.87305C22.9111 6.59014 22.9102 7.47862 22.9102 8.58203V15.418C22.9102 16.5214 22.9111 17.4098 22.8525 18.127C22.793 18.8555 22.6668 19.4958 22.3652 20.0879C21.886 21.0285 21.1212 21.7941 20.1807 22.2734C19.5884 22.5752 18.9475 22.7002 18.2188 22.7598C17.5016 22.8183 16.6132 22.8184 15.5098 22.8184H14.2197C12.9853 22.8184 12.1611 22.827 11.4619 22.6299C9.78772 22.1576 8.47901 20.849 8.00684 19.1748C7.80986 18.4758 7.81934 17.652 7.81934 16.418V15.9268C7.81972 15.3748 8.26729 14.9268 8.81934 14.9268C9.37129 14.9269 9.81895 15.3749 9.81934 15.9268V16.418C9.81934 17.7868 9.82869 18.2661 9.93164 18.6318C10.2149 19.6364 11.0004 20.4217 12.0049 20.7051C12.3707 20.8082 12.85 20.8184 14.2197 20.8184H15.5098C16.6461 20.8184 17.4389 20.817 18.0557 20.7666C18.6607 20.7172 19.0091 20.6254 19.2725 20.4912C19.8367 20.2036 20.2955 19.744 20.583 19.1797C20.717 18.9164 20.81 18.5686 20.8594 17.9639C20.9097 17.3471 20.9102 16.5543 20.9102 15.418V8.58203C20.9102 7.44579 20.9097 6.65287 20.8594 6.03613C20.8099 5.43118 20.7172 5.08264 20.583 4.81934C20.2954 4.25521 19.8366 3.79632 19.2725 3.50879C19.0091 3.37462 18.6607 3.28187 18.0557 3.23242C17.4389 3.18206 16.646 3.18164 15.5098 3.18164H14.2197C12.8502 3.18164 12.3707 3.19085 12.0049 3.29395C11.0004 3.57724 10.2151 4.36281 9.93164 5.36719C9.82848 5.73298 9.81934 6.2124 9.81934 7.58203V8.07227C9.81933 8.62448 9.37153 9.07215 8.81934 9.07227C8.26705 9.07226 7.81933 8.62455 7.81934 8.07227V7.58203C7.81933 6.34775 7.80966 5.52334 8.00684 4.82422C8.47916 3.1502 9.78784 1.84133 11.4619 1.36914C12.161 1.17203 12.9854 1.18164 14.2197 1.18164H15.5098ZM12.2969 8.0293C12.6827 7.63417 13.3158 7.62588 13.7109 8.01172L17.0625 11.2852C17.2549 11.4732 17.3632 11.7309 17.3633 12C17.3632 12.2692 17.255 12.5277 17.0625 12.7158L13.7109 15.9883C13.3159 16.3738 12.6827 16.3665 12.2969 15.9717C11.9111 15.5766 11.9186 14.9435 12.3135 14.5576L13.9092 13H2.18164C1.62954 12.9999 1.18177 12.5521 1.18164 12C1.18178 11.4479 1.62955 11.0001 2.18164 11H13.9082L12.3135 9.44336C11.9184 9.05759 11.9113 8.42446 12.2969 8.0293Z" fill="#EDFEEC"/>
              </svg>
              Prijavi se
            </a>
          </li>
        <?php endif; ?>
        
        <li class="burger-link-item follow-us-on-instagram">
          <a class="follow-us-on-insta-link" href="https://www.instagram.com/preporukazafilm" target="_blank" rel="noopener noreferrer">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10.3038 7.9998C10.3038 8.45549 10.1687 8.90095 9.91551 9.27984C9.66234 9.65873 9.30251 9.95404 8.88151 10.1284C8.46051 10.3028 7.99725 10.3484 7.55032 10.2595C7.10338 10.1706 6.69285 9.9512 6.37063 9.62898C6.04841 9.30676 5.82898 8.89622 5.74008 8.44929C5.65117 8.00236 5.6968 7.5391 5.87119 7.1181C6.04557 6.6971 6.34088 6.33727 6.71977 6.0841C7.09866 5.83093 7.54412 5.6958 7.9998 5.6958C8.61028 5.6977 9.19521 5.94106 9.62688 6.37273C10.0586 6.8044 10.3019 7.38933 10.3038 7.9998ZM15.1998 4.8318V11.1678C15.1998 12.2372 14.775 13.2627 14.0189 14.0189C13.2627 14.775 12.2372 15.1998 11.1678 15.1998H4.8318C3.76245 15.1998 2.7369 14.775 1.98075 14.0189C1.2246 13.2627 0.799805 12.2372 0.799805 11.1678V4.8318C0.799805 3.76245 1.2246 2.7369 1.98075 1.98075C2.7369 1.2246 3.76245 0.799805 4.8318 0.799805H11.1678C12.2372 0.799805 13.2627 1.2246 14.0189 1.98075C14.775 2.7369 15.1998 3.76245 15.1998 4.8318ZM11.4558 7.9998C11.4558 7.31627 11.2531 6.64809 10.8734 6.07975C10.4936 5.51142 9.95386 5.06845 9.32236 4.80688C8.69086 4.5453 7.99597 4.47686 7.32557 4.61021C6.65517 4.74356 6.03937 5.07271 5.55604 5.55604C5.07271 6.03937 4.74356 6.65517 4.61021 7.32557C4.47686 7.99597 4.5453 8.69086 4.80688 9.32236C5.06845 9.95386 5.51142 10.4936 6.07975 10.8734C6.64809 11.2531 7.31627 11.4558 7.9998 11.4558C8.91639 11.4558 9.79544 11.0917 10.4436 10.4436C11.0917 9.79544 11.4558 8.91639 11.4558 7.9998ZM12.6078 4.2558C12.6078 4.08492 12.5571 3.91788 12.4622 3.77579C12.3673 3.63371 12.2323 3.52297 12.0744 3.45757C11.9166 3.39218 11.7428 3.37507 11.5752 3.40841C11.4076 3.44174 11.2537 3.52403 11.1329 3.64486C11.012 3.7657 10.9297 3.91965 10.8964 4.08725C10.8631 4.25485 10.8802 4.42857 10.9456 4.58644C11.011 4.74432 11.1217 4.87926 11.2638 4.97419C11.4059 5.06913 11.5729 5.1198 11.7438 5.1198C11.973 5.1198 12.1927 5.02878 12.3547 4.86674C12.5168 4.70471 12.6078 4.48495 12.6078 4.2558Z" fill="#F57C36"/>
            </svg>                         
            Pratite nas na Instagramu</a>     
        </li>
      </ul>
    </nav>
  </div>
</header>