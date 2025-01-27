@php
  // Get the current post object
  $movie = get_post();
  $movie_id = $movie->ID;

  // Get the title of the movie (post title) and sanitize it
  $title = get_the_title($movie);
  $title = strtok($title, '&'); // Remove everything after '&'
  // Get the 'genres' meta field
  $genres = get_post_meta($movie->ID, 'genres', true);
  // Poster Path
  $poster_path = get_post_meta($movie->ID, 'poster_path', true);
  // backdrop_path
  $backdrop_path = get_post_meta($movie->ID, 'backdrop_path', true);
  $base_url = "background: linear-gradient(180deg, rgba(6,19,30,1) 0%, rgba(6,19,30,0.7) 50%, rgba(6,19,30,0.1) 50%, rgba(6,19,30,1) 50%), url('https://media.themoviedb.org/t/p/w300_and_h450_bestv2/";
  $backgroundImageUrl = $base_url . $backdrop_path . "')";
  // Movie Trailer
  $video_trailer = get_post_meta($movie->ID, 'video_trailer', true);
  $video_trailer_data = json_decode($video_trailer, true);
  $video_url = $video_trailer_data['key'];

  // Movie Count
  $vote_average = round(get_post_meta($movie->ID, 'vote_average', true), 1);

  // Runtime
  $runtime = get_post_meta($movie->ID, 'runtime', true);
  $hours = floor($runtime / 60);
  $minutes = $runtime % 60;
  $formatted_runtime = sprintf('%dh %02dm', $hours, $minutes);

  // Release date
  $release_date = get_post_meta($movie->ID, 'release_date', true);
  $release_year = date('Y', strtotime($release_date));
  
  // Get the content of the post
  $content = strip_tags(apply_filters('the_content', get_the_content()));

  // Release date
  $director = get_post_meta($movie->ID, 'director', true) ?: [];
  $cast = get_post_meta($movie->ID, 'cast', true) ?: [];
  $writing = get_post_meta($movie->ID, 'writing', true) ?: [];

  // Decode and trim the genres if it's a string
  if (is_string($genres)) {
      $genres = html_entity_decode(trim($genres, '"'));
  }

  // Get the category associated with the post
  $categories = get_the_category($movie->ID);
  
  // Get the name of the first category if it exists
  $category_name = !empty($categories) ? $categories[0]->name : '';
  $category_link = !empty($categories) ? $categories[0]->slug : '';
@endphp

{{-- Hero Single Movie --}}
<section id="sm_hero_section" class="sm-hero-section" data-movie-id="{{ $movie_id }}" style="<?php echo $backgroundImageUrl; ?>">
  {{-- <h2>{{ $movie->ID }}</h2> --}}

  <div class="sm-hero-holder container">
    
    {{-- Hero navigation --}}
    <ul id="sm_navigation" class="sm-navigation">
      <li>Početna</li>
      <li><svg width="11" height="12" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 1.5L8 7.00001L3 1.5ZM8 7.00001L3 12.5L8 7.00001Z" fill="#EDFEEC"/>
          <path d="M3 1.5L8 7.00001L3 12.5" stroke="#18BF7C" stroke-width="2"/>
        </svg></li>
      <li>Kategorije</li>
      <li><svg width="11" height="12" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M3 1.5L8 7.00001L3 1.5ZM8 7.00001L3 12.5L8 7.00001Z" fill="#EDFEEC"/>
        <path d="M3 1.5L8 7.00001L3 12.5" stroke="#18BF7C" stroke-width="2"/>
      </svg></li>
      <li id="movie_category">
        <a href="{{ url('/category/' . $category_link) }}">{{ $category_name }}</a>
      </li>
      <li><svg width="11" height="12" viewBox="0 0 11 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M3 1.5L8 7.00001L3 1.5ZM8 7.00001L3 12.5L8 7.00001Z" fill="#EDFEEC"/>
        <path d="M3 1.5L8 7.00001L3 12.5" stroke="#18BF7C" stroke-width="2"/>
      </svg></li>
      <li id="movie_name">{{ $title }}</li>
    </ul>

    {{-- Hero Single Movie --}}
    <article class="sm-info" >
      <div class="sm-info-poster">
        <img src="{{ 'https://media.themoviedb.org/t/p/w300_and_h450_bestv2/' .  $poster_path }}" alt="{{ $title }}">
        <p class="copyrights">© 2024 TMDb − All rights reserved.</p>
      </div>
      <div class="sm-info-content">
        {{-- Single Movie Title --}}
        <div class="sm-info-content-title-holder">
          <h2 class="sm-info-content-title" id="sm-info-content-title">{{ $title }}</h2>
          <span class="sm-info-imdb-rating-holder">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M6.92439 0.707292C7.33541 -0.235765 8.66458 -0.235764 9.07559 0.707295L10.5194 4.02001C10.6856 4.40146 11.039 4.6667 11.4497 4.71823L14.9694 5.15988C15.947 5.28256 16.3492 6.48929 15.6429 7.1806L12.9628 9.8037C12.6802 10.0802 12.5543 10.481 12.6275 10.8708L13.3267 14.5951C13.5141 15.5931 12.4465 16.3487 11.5768 15.8335L8.59577 14.0675C8.22807 13.8497 7.77193 13.8497 7.40423 14.0675L4.4232 15.8335C3.55358 16.3487 2.48595 15.5931 2.67332 14.5951L3.37256 10.8708C3.44574 10.481 3.31982 10.0802 3.03725 9.8037L0.357138 7.1806C-0.349201 6.48929 0.0530059 5.28256 1.03065 5.15988L4.55031 4.71822C4.96095 4.6667 5.31436 4.40146 5.4806 4.02001L6.92439 0.707292Z" fill="#F6C700"/>
            </svg>
            <p id="imdb-rating">{{ $vote_average }}</p>
            <img src="@asset('./images/questionnaire/imdb-icon.webp')" alt="Imdb Icon">
          </span>
        </div>

        {{-- Single Movie Info --}}
        <div class="sm-info-content-info">
          <span class="sm-info-genres-holder">
            <svg class="sm-info-genres-icon" width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M14.25 18.5H3.75C2.7558 18.4988 1.80267 18.1033 1.09966 17.4003C0.396661 16.6973 0.00119089 15.7442 0 14.75L0 4.25C0.00119089 3.2558 0.396661 2.30267 1.09966 1.59966C1.80267 0.89666 2.7558 0.50119 3.75 0.5H14.25C15.2442 0.50119 16.1973 0.89666 16.9003 1.59966C17.6033 2.30267 17.9988 3.2558 18 4.25V14.75C17.9988 15.7442 17.6033 16.6973 16.9003 17.4003C16.1973 18.1033 15.2442 18.4988 14.25 18.5ZM15 10.25H16.5V8.75H15V10.25ZM15 11.75V13.25H16.5V11.75H15ZM13.5 10.25H4.5V17H13.5V10.25ZM3 8.75H1.5V10.25H3V8.75ZM3 11.75H1.5V13.25H3V11.75ZM1.5 7.25H3V5.75H1.5V7.25ZM4.5 8.75H13.5V2H4.5V8.75ZM15 7.25H16.5V5.75H15V7.25ZM16.5 14.75H15V16.862C15.4372 16.7074 15.8159 16.4216 16.0844 16.0435C16.3529 15.6655 16.4981 15.2137 16.5 14.75ZM3 16.862V14.75H1.5C1.50192 15.2137 1.64706 15.6655 1.91557 16.0435C2.18407 16.4216 2.56282 16.7074 3 16.862ZM1.5 4.25H3V2.138C2.56282 2.29256 2.18407 2.57842 1.91557 2.95648C1.64706 3.33453 1.50192 3.7863 1.5 4.25ZM15 2.138V4.25H16.5C16.4981 3.7863 16.3529 3.33453 16.0844 2.95648C15.8159 2.57842 15.4372 2.29256 15 2.138Z" fill="#F57C36"/>
            </svg>
            <p class="sm-info-genres-text" id="sm-info-genres-text">{{ $category_name }}</p>
          </span>

          <hr class="sm-info-hr">

          <span class="sm-info-duration-holder">
            <svg class="sm-info-duration-icon" width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M9.00004 18.5001C7.22 18.5001 5.47994 17.9722 3.99989 16.9833C2.51984 15.9944 1.36628 14.5887 0.685091 12.9442C0.00389959 11.2997 -0.174331 9.49006 0.172937 7.74422C0.520206 5.99838 1.37738 4.39473 2.63605 3.13605C3.89473 1.87738 5.49838 1.02021 7.24422 0.672937C8.99006 0.325669 10.7997 0.5039 12.4442 1.18509C14.0887 1.86628 15.4944 3.01984 16.4833 4.49989C17.4722 5.97994 18.0001 7.72 18.0001 9.50004C17.9975 11.8862 17.0485 14.1739 15.3612 15.8612C13.6739 17.5485 11.3862 18.4975 9.00004 18.5001ZM9.00004 2.00001C7.51667 2.00001 6.06662 2.43988 4.83325 3.26399C3.59987 4.08811 2.63858 5.25945 2.07092 6.6299C1.50326 8.00035 1.35473 9.50836 1.64412 10.9632C1.93351 12.4181 2.64782 13.7545 3.69672 14.8034C4.74562 15.8523 6.08199 16.5666 7.53686 16.856C8.99172 17.1453 10.4997 16.9968 11.8702 16.4292C13.2406 15.8615 14.412 14.9002 15.2361 13.6668C16.0602 12.4335 16.5001 10.9834 16.5001 9.50004C16.4979 7.51158 15.707 5.60519 14.301 4.19913C12.8949 2.79307 10.9885 2.00219 9.00004 2.00001Z" fill="#F57C36"/>
              <path d="M5.95982 12.1976L5.16406 10.9255L8.24957 8.99279V4.99902H9.74958V9.82379L5.95982 12.1976Z" fill="#F57C36"/>
            </svg>
            <p class="sm-info-duration-text" id="sm-info-duration-text">{{  $formatted_runtime }}</p>
          </span>

          <hr class="sm-info-hr">

          <span class="sm-info-year-holder">
            <svg class="sm-info-year-icon" width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M4.4935 3.50715V4.25685H5.99155V3.50715H11.9845V4.25685H13.4826V3.50715C15.1372 3.50719 16.4786 4.84858 16.4786 6.50325V13.9935C16.4786 15.6482 15.1372 16.9896 13.4825 16.9896H4.49416C2.83946 16.9896 1.49805 15.6482 1.49805 13.9935V8.00202L16.478 8.00202V6.50397L1.49805 6.50397V6.50325C1.49805 4.84877 2.8391 3.5075 4.4935 3.50715ZM5.99155 2.00909H11.9845V0.511719H13.4826V2.00909C15.9646 2.00914 17.9766 4.02122 17.9766 6.50325V13.9935C17.9766 16.4756 15.9645 18.4877 13.4825 18.4877H4.49416C2.0121 18.4877 0 16.4756 0 13.9935V6.50325C0 4.02142 2.01175 2.00945 4.4935 2.00909V0.511719H5.99155V2.00909Z" fill="#F57C36"/>
            </svg>
              
            <p class="sm-info-year-text" id="sm-info-year-text">{{ $release_year }}</p>
          </span>
        </div>

        {{-- Result Description --}}
        <div class="sm-info-content-description">
          <p class="sm-info-content-description-text" id="sm-info-description-text">{{ $content }}</p>  
        </div>

        <hr>
        {{-- Director --}}
        <div class="sm-info-content-director">
          <h4>Director:</h4>
          <ul>
            @forelse($director as $dir)
              <li class="sm-info-content-writer-text" id="sm-info-writer">
          <svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="2" cy="2.5" r="2" fill="white"/>
          </svg>
          {{ $dir }}
              </li>
            @empty
              <li>No data available</li>
            @endforelse
          </ul>
        </div>
        
        <hr>

        {{-- Writers --}}
        <div class="sm-info-content-writers">
          <h4>Pisci:</h4>
          <ul>
            @forelse($writing as $writer)
              <li class="sm-info-content-writer-text" id="sm-info-writer">
          <svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="2" cy="2.5" r="2" fill="white"/>
          </svg>
          {{ $writer }}
              </li>
            @empty
              <li>No data available</li>
            @endforelse
          </ul>
        </div>
        
        <hr>

        {{-- Cast --}}
        <div class="sm-info-content-cast">
          <h4>Glumci:</h4>
          <ul>
            @forelse($cast as $actor)
              <li class="sm-info-content-writer-text" id="sm-info-writer">
          <svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="2" cy="2.5" r="2" fill="white"/>
          </svg>
          {{ $actor }}
              </li>
            @empty
              <li>No data available</li>
            @endforelse
          </ul>
        </div>
        
        <hr>


        {{-- sm-info CTA --}}
        <div class="sm-info-content-cta" id="sm-info-content-cta">
          <button href="#" onclick="openTrailerPopUp()" class="sm-info-cta-trailer">
            <svg width="21" height="24" viewBox="0 0 21 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M2.5911 3.83643V20.1636C2.5911 21.6931 4.30383 22.6054 5.5825 21.7569L17.8861 13.5934C19.0285 12.8354 19.0285 11.1646 17.8861 10.4066L5.5825 2.24306C4.30383 1.39465 2.5911 2.30693 2.5911 3.83643ZM0.666992 3.83643V20.1636C0.666992 23.2226 4.09246 25.0471 6.6498 23.3503L18.9534 15.1867C21.2382 13.6708 21.2382 10.3292 18.9534 8.81325L6.6498 0.649686C4.09245 -1.04714 0.666992 0.777436 0.666992 3.83643Z" fill="white"/>
            </svg>              
            Trejler
          </button>

          <a href="#" class="sm-info-cta-affiliate-amazon">
            <svg width="28" height="24" viewBox="0 0 28 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M21.2544 14.6446L20.4201 13.3693C20.1629 12.9763 20.0261 12.5182 20.0261 12.0501V6.6935C20.0261 4.55533 20.1828 0 14.0099 0C8.98833 0 7.43549 2.64661 6.95535 4.28356C6.76472 4.93344 7.21268 5.59516 7.89332 5.66462L9.83964 5.86321C10.2978 5.90993 10.7371 5.66946 10.9358 5.25856C11.3131 4.47813 11.9707 3.31586 14.0001 3.31586C14.7864 3.31586 15.8919 3.64471 15.8919 4.60623C15.8919 6.00137 15.89 6.66257 15.89 6.66257C15.8953 6.95372 15.6581 7.19262 15.3636 7.19262H13.4612C12.0258 7.19262 6.57129 7.9206 6.57129 13.3149C6.57129 18.7091 12.3592 18.0885 12.7435 17.9994C13.4605 17.8332 14.8038 17.348 16.0662 16.1575C16.2783 15.9575 16.6167 15.975 16.8009 16.2004L17.8204 17.448C18.2166 17.9329 18.9456 17.9839 19.407 17.559L21.0827 16.0155C21.4684 15.6601 21.5408 15.0823 21.2544 14.6446ZM12.887 14.344C10.9492 14.344 11.0044 12.6113 11.4516 11.7888C11.8699 11.0192 12.9752 9.65487 15.9426 9.56195L15.9686 10.9936C15.988 12.0578 15.4929 13.0801 14.6127 13.6925C14.0673 14.0721 13.4722 14.344 12.887 14.344Z" fill="white"/>
              <path d="M0.115567 19.2707C-0.179131 19.0074 0.141563 18.541 0.497823 18.7145C3.00166 19.9343 7.7154 21.8201 12.9259 21.8201C18.2505 21.8201 22.7051 20.5623 24.9471 19.7861C25.3116 19.6599 25.5743 20.1318 25.2742 20.3722C23.4954 21.797 19.6756 24.0011 13.0659 24.0011C6.48092 24.0011 2.20355 21.1367 0.115567 19.2707Z" fill="#FFAC35"/>
              <path d="M22.5996 18.5024C23.2942 17.9938 25.0199 17.117 27.599 17.8837C27.836 17.9541 27.9975 18.1709 27.9993 18.4156C28.0056 19.2524 27.8232 21.217 26.167 22.8497C26.052 22.963 25.8583 22.8517 25.9009 22.6967C26.1838 21.6666 26.7588 19.457 26.5763 19.1487C26.3672 18.7952 23.7533 18.7784 22.6943 18.7862C22.5397 18.7874 22.4754 18.5933 22.5996 18.5024Z" fill="#FFAC35"/>
            </svg>
            Gledaj na Amazonu
          </a>
          <a href="#" class="sm-info-cta-affiliate-netflix">
            <svg width="15" height="24" viewBox="0 0 15 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M0.876953 0V24.0003C2.66933 23.7817 4.24312 23.6506 5.59833 23.6069V1.70494M9.40166 14.7543V0H14.123V24.0003" fill="url(#paint0_linear_192_4792)"/>
              <path d="M0.876953 0H5.59833L14.123 24.0003C12.3307 23.7817 10.7132 23.6506 9.27051 23.6069" fill="#E50914"/>
              <defs>
              <linearGradient id="paint0_linear_192_4792" x1="4.71832" y1="14.6402" x2="11.2613" y2="12.7486" gradientUnits="userSpaceOnUse">
              <stop stop-color="#B1060F"/>
              <stop offset="0.5"/>
              <stop offset="1" stop-color="#B1060F"/>
              </linearGradient>
              </defs>
            </svg>
            Gledaj na Netfliksu
          </a>
        </div>
      </div>
    </article>

    {{-- Donatino --}}
    <div class="sm-info-donation">
      <p class="donation-text">Ako si zadovoljan onime što pruža ovaj sajt možete nas počastiti kafom:</p>
      <a href="" class="donation-link" id="donation-link">
        <svg class="donation-link-icon" aria-label="donation-link" xmlns="http://www.w3.org/2000/svg" width="62" height="21" viewBox="0 0 62 21" fill="none">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M54.1545 3.75H52.4044V0.75H54.1545V3.75ZM50.6543 0.75H48.9042V3.75H50.6543V0.75ZM47.1542 0.75H45.4041V3.75H47.1542V0.75ZM41.0061 20.25H58.5069V18.75H41.001L41.0061 20.25ZM62.001 11.2501C61.9725 12.1578 61.5907 13.0186 60.9369 13.649C60.2831 14.2793 59.409 14.6296 58.5008 14.625H55.7453C55.1142 15.5604 54.4024 16.4388 53.6181 17.25H45.9002C43.4502 14.6689 41.7658 11.4578 41.035 7.975C40.9752 7.6173 40.9944 7.25085 41.0913 6.90136C41.1882 6.55188 41.3604 6.22785 41.5959 5.952C41.8462 5.65394 42.1588 5.41427 42.5116 5.24982C42.8644 5.08536 43.249 5.00009 43.6382 5H55.8757C56.2651 5.00036 56.6497 5.08593 57.0025 5.25069C57.3553 5.41545 57.6678 5.65542 57.918 5.95375C58.1534 6.22932 58.3256 6.55303 58.4227 6.90219C58.5197 7.25135 58.5392 7.61751 58.4798 7.975C58.4574 8.10331 58.4297 8.23163 58.4021 8.35994C58.392 8.40663 58.382 8.45331 58.3722 8.5H58.5008C60.6613 8.5 62.001 9.55437 62.001 11.2501ZM60.2509 11.2501C60.2509 10.5869 59.6637 10.25 58.5008 10.25H57.8997C57.598 11.1536 57.224 12.0315 56.7814 12.875H58.5008C58.9451 12.8797 59.3743 12.7138 59.6999 12.4115C60.0255 12.1092 60.2227 11.6935 60.2509 11.2501ZM20.7679 15.854C21.4079 16.238 22.1225 16.43 22.9119 16.43C23.8079 16.43 24.5972 16.1633 25.2799 15.63V16.318H27.4399V4.75L25.2479 5.118V8.526C24.9172 8.31267 24.5599 8.15267 24.1759 8.046C23.7919 7.92867 23.3919 7.87 22.9759 7.87C22.1652 7.87 21.4345 8.062 20.7839 8.446C20.1332 8.81933 19.6159 9.33133 19.2319 9.982C18.8585 10.622 18.6719 11.342 18.6719 12.142C18.6719 12.942 18.8585 13.6673 19.2319 14.318C19.6159 14.958 20.1279 15.47 20.7679 15.854ZM24.3679 14.366C24.0372 14.494 23.6692 14.558 23.2639 14.558C22.8052 14.558 22.3892 14.4513 22.0159 14.238C21.6532 14.0247 21.3652 13.7367 21.1519 13.374C20.9385 13.0113 20.8319 12.6007 20.8319 12.142C20.8319 11.6833 20.9385 11.2727 21.1519 10.91C21.3652 10.5367 21.6532 10.2487 22.0159 10.046C22.3892 9.83267 22.8052 9.726 23.2639 9.726C23.6585 9.726 24.0265 9.79533 24.3679 9.934C24.7092 10.0727 25.0025 10.2647 25.2479 10.51V13.758C25.0025 14.0247 24.7092 14.2273 24.3679 14.366ZM30.9576 15.9019C31.6403 16.2859 32.3976 16.4779 33.2296 16.4779C33.9016 16.4779 34.5043 16.3819 35.0376 16.1899C35.5816 15.9979 36.1096 15.6939 36.6216 15.2779L35.1816 13.9659C34.9576 14.1792 34.6856 14.3446 34.3656 14.4619C34.0563 14.5792 33.715 14.6379 33.3416 14.6379C32.9683 14.6379 32.6163 14.5632 32.2856 14.4139C31.9656 14.2646 31.6936 14.0566 31.4696 13.7899C31.2563 13.5232 31.1016 13.2246 31.0056 12.8939H37.1816V12.3179C37.1816 11.4646 37.0003 10.7019 36.6376 10.0299C36.2856 9.35789 35.8003 8.82456 35.1816 8.42989C34.563 8.03522 33.8536 7.83789 33.0536 7.83789C32.2536 7.83789 31.5283 8.02989 30.8776 8.41389C30.227 8.79789 29.7096 9.31522 29.3256 9.96589C28.9523 10.6166 28.7656 11.3472 28.7656 12.1579C28.7656 12.9686 28.963 13.6992 29.3576 14.3499C29.7523 15.0006 30.2856 15.5179 30.9576 15.9019ZM35.0216 11.3259H30.9736C31.059 10.9846 31.1923 10.6912 31.3736 10.4459C31.5656 10.1899 31.8003 9.99256 32.0776 9.85389C32.355 9.71522 32.6643 9.64589 33.0056 9.64589C33.3363 9.64589 33.635 9.72056 33.9016 9.86989C34.179 10.0086 34.4136 10.2059 34.6056 10.4619C34.8083 10.7072 34.947 10.9952 35.0216 11.3259ZM12.7125 16.3184L9.14453 7.98242H11.5285L13.8165 13.5344L16.0885 7.98242H18.4245L14.8405 16.3184H12.7125ZM2.192 15.9023C2.864 16.2863 3.616 16.4783 4.448 16.4783C5.29067 16.4783 6.048 16.2863 6.72 15.9023C7.392 15.5183 7.92 15.0009 8.304 14.3503C8.69867 13.6996 8.896 12.9689 8.896 12.1583C8.896 11.3476 8.69867 10.6169 8.304 9.96627C7.92 9.30493 7.38667 8.78227 6.704 8.39827C6.032 8.01427 5.28 7.82227 4.448 7.82227C3.616 7.82227 2.85867 8.01427 2.176 8.39827C1.504 8.78227 0.970667 9.30493 0.576 9.96627C0.192 10.6169 0 11.3476 0 12.1583C0 12.9689 0.197333 13.6996 0.592 14.3503C0.986667 15.0009 1.52 15.5183 2.192 15.9023ZM5.616 14.2543C5.27467 14.4676 4.88533 14.5743 4.448 14.5743C4.02133 14.5743 3.632 14.4676 3.28 14.2543C2.928 14.0409 2.65067 13.7529 2.448 13.3903C2.24533 13.0169 2.144 12.6063 2.144 12.1583C2.144 11.6996 2.24533 11.2889 2.448 10.9263C2.65067 10.5636 2.928 10.2756 3.28 10.0623C3.632 9.83827 4.02133 9.72626 4.448 9.72626C4.88533 9.72626 5.27467 9.83827 5.616 10.0623C5.968 10.2756 6.24533 10.5636 6.448 10.9263C6.66133 11.2889 6.768 11.6996 6.768 12.1583C6.768 12.6063 6.66133 13.0169 6.448 13.3903C6.24533 13.7529 5.968 14.0409 5.616 14.2543ZM37.001 18.75H0.000976562L0 20.25H37.001V18.75Z" fill="#F57C36"/>
        </svg>
      </a>
    </div>
  </div>
</section>

{{-- Video Pop Up --}}
@include('pages.questions.video-popup', ['video_url' => $video_url])