<header class="header-main">
  <div class="header-holder container">
    <a href="{{ url('/') }}">
      <img class="header-logo" width="264" height="40" src="@asset('images/partials/preporuka-za-film-logo.svg')" alt="Preporuka za film logo">
    </a>   
    <nav class="main-nav-desktop">
      <ul class="nav-link">
        {{-- <li class="link-item"><a href="{{ home_url() }}/">Početna</a></li> --}}
        <li class="link-item"><a href="{{ home_url() }}/anketa">Anketa</a></li>
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
        <li class="link-item"><a href="{{ home_url() }}/blog">Blog</a></li>
        <li class="link-item search">
          <input id="movie-search" class="link-search-input" type="text" aria-label="Search" placeholder="Pretraga..."> 
          <svg id="movie-search-submit" aria-label="Search" class="link-search-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0882 16.7415C13.5044 17.9727 11.5143 18.7058 9.3529 18.7058C4.18744 18.7058 0 14.5184 0 9.3529C0 4.18744 4.18744 0 9.3529 0C14.5184 0 18.7058 4.18744 18.7058 9.3529C18.7058 11.5143 17.9727 13.5044 16.7415 15.0882L20 18.3466L18.3466 20L15.0882 16.7415ZM16.3676 9.3529C16.3676 13.227 13.227 16.3676 9.3529 16.3676C5.4788 16.3676 2.33823 13.227 2.33823 9.3529C2.33823 5.4788 5.4788 2.33823 9.3529 2.33823C13.227 2.33823 16.3676 5.4788 16.3676 9.3529Z" fill="#EDFEEC"/>
          </svg>      
        </li>
      </ul>
    </nav>

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
        <li class="burger-link-item"><a href="{{ home_url() }}/">Početna</a></li>
        <li class="burger-link-item"><a href="{{ home_url() }}/anketa">Anketa</a></li>
        <li class="burger-link-item burger-open-dropdown">
          <a>Kategorije</a>
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
        <li class="burger-link-item burger-search">
          <input id="movie-search-mobile" class="link-search-input" type="text" aria-label="Search" placeholder="Pretraga..."> 
          <svg id="movie-search-submit-mobile" aria-label="Search" class="link-search-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.0882 16.7415C13.5044 17.9727 11.5143 18.7058 9.3529 18.7058C4.18744 18.7058 0 14.5184 0 9.3529C0 4.18744 4.18744 0 9.3529 0C14.5184 0 18.7058 4.18744 18.7058 9.3529C18.7058 11.5143 17.9727 13.5044 16.7415 15.0882L20 18.3466L18.3466 20L15.0882 16.7415ZM16.3676 9.3529C16.3676 13.227 13.227 16.3676 9.3529 16.3676C5.4788 16.3676 2.33823 13.227 2.33823 9.3529C2.33823 5.4788 5.4788 2.33823 9.3529 2.33823C13.227 2.33823 16.3676 5.4788 16.3676 9.3529Z" fill="#EDFEEC"/>
          </svg>      
        </li>
      </ul>
    </nav>
  </div>
</header>