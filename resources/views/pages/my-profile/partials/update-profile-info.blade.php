@php
  $current_user = wp_get_current_user();
  $current_user_name = $current_user->user_login; 
  $current_user_email = $current_user->user_email;
  $current_user_img_src = get_user_meta($current_user->ID, 'profile_image', true); 
@endphp

<div class="user-info-holder">
  
  {{-- Avatar section --}}
  <div class="user-avatar-update">
    <img class="avatar-icon" src="@asset($current_user_img_src)" alt="User Avatar Icon">
    <button class="change-user-avatar">Promeni avatar</button>
    <button class="remove-user-avatar">Ukloni avatar</button>
  </div>

  {{-- General info section --}}
  <div class="user-general-update">

    {{-- Username --}}
    <span class="user-general-name">
      <label for="name">Puno Ime</label>
      <input type="text" id="name" placeholder="Ime" value="{{$current_user_name}}">
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_926_6163)">
        <path d="M14.1665 2.49993C14.3854 2.28106 14.6452 2.10744 14.9312 1.98899C15.2171 1.87054 15.5236 1.80957 15.8332 1.80957C16.1427 1.80957 16.4492 1.87054 16.7352 1.98899C17.0211 2.10744 17.281 2.28106 17.4998 2.49993C17.7187 2.7188 17.8923 2.97863 18.0108 3.2646C18.1292 3.55057 18.1902 3.85706 18.1902 4.16659C18.1902 4.47612 18.1292 4.78262 18.0108 5.06859C17.8923 5.35455 17.7187 5.61439 17.4998 5.83326L6.24984 17.0833L1.6665 18.3333L2.9165 13.7499L14.1665 2.49993Z" stroke="#F57C36" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </g>
        <defs>
        <clipPath id="clip0_926_6163">
        <rect width="20" height="20" fill="white"/>
        </clipPath>
        </defs>
      </svg>
    </span>

    {{-- Email --}}
    <span class="user-general-email">
      <label for="email">Email</label>
      <input type="email" id="email" placeholder="Email" value="{{$current_user_email}}">
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_926_6163)">
        <path d="M14.1665 2.49993C14.3854 2.28106 14.6452 2.10744 14.9312 1.98899C15.2171 1.87054 15.5236 1.80957 15.8332 1.80957C16.1427 1.80957 16.4492 1.87054 16.7352 1.98899C17.0211 2.10744 17.281 2.28106 17.4998 2.49993C17.7187 2.7188 17.8923 2.97863 18.0108 3.2646C18.1292 3.55057 18.1902 3.85706 18.1902 4.16659C18.1902 4.47612 18.1292 4.78262 18.0108 5.06859C17.8923 5.35455 17.7187 5.61439 17.4998 5.83326L6.24984 17.0833L1.6665 18.3333L2.9165 13.7499L14.1665 2.49993Z" stroke="#F57C36" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </g>
        <defs>
        <clipPath id="clip0_926_6163">
        <rect width="20" height="20" fill="white"/>
        </clipPath>
        </defs>
      </svg>
    </span>

    {{-- Bio / About --}}
    <span class="user-general-bio">
      <label for="bio">Biografija</label>
      <textarea id="bio" placeholder="Napiši nešto o sebi">{{$current_user_bio}}</textarea>
      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <g clip-path="url(#clip0_926_6163)">
        <path d="M14.1665 2.49993C14.3854 2.28106 14.6452 2.10744 14.9312 1.98899C15.2171 1.87054 15.5236 1.80957 15.8332 1.80957C16.1427 1.80957 16.4492 1.87054 16.7352 1.98899C17.0211 2.10744 17.281 2.28106 17.4998 2.49993C17.7187 2.7188 17.8923 2.97863 18.0108 3.2646C18.1292 3.55057 18.1902 3.85706 18.1902 4.16659C18.1902 4.47612 18.1292 4.78262 18.0108 5.06859C17.8923 5.35455 17.7187 5.61439 17.4998 5.83326L6.24984 17.0833L1.6665 18.3333L2.9165 13.7499L14.1665 2.49993Z" stroke="#F57C36" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </g>
        <defs>
        <clipPath id="clip0_926_6163">
        <rect width="20" height="20" fill="white"/>
        </clipPath>
        </defs>
      </svg>
    </span>
  </div>

  {{-- Action buttons --}}
  <div class="user-btn-holder">
    <button class="cancel-update">Odbaci promene</button>
    <button class="update-user-info">Sačuvaj promene</button>
  </div>

</div>
