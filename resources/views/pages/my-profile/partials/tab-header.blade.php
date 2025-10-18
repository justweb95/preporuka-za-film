<header class="tab-header">
  <h1 class="main-heading">{{ $tab_heading }}</h1>

  @if($notification)
    <div class="notification-holder">
      <button class="profile-search">
        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect width="48" height="48" rx="24" fill="#142534"/>
          <path d="M32 32L28.5 28.5" stroke="#EDFEEC" stroke-width="1.5"/>
          <circle cx="23.5" cy="23.5" r="6.75" stroke="#EDFEEC" stroke-width="1.5"/>
        </svg>
      </button>

      <button class="profile-notification active-notification">
        <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect width="48" height="48" rx="24" fill="#142534"/>
          <path d="M24 16.75C26.7674 16.75 29.1655 18.6683 29.7734 21.3682L30.7236 25.5859C30.9562 26.6185 30.4014 27.6669 29.417 28.0557L28.9854 28.2256C25.782 29.49 22.218 29.49 19.0146 28.2256L18.583 28.0557C17.5986 27.6669 17.0438 26.6185 17.2764 25.5859L18.2266 21.3682C18.8345 18.6683 21.2326 16.75 24 16.75Z" stroke="#EDFEEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M21 29L21.3675 30.1026C21.7452 31.2357 22.8056 32 24 32C25.1944 32 26.2548 31.2357 26.6325 30.1026L27 29" stroke="#EDFEEC" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
    </div>
  @endif

  @if($new_recommendations)
    <button class="new-recommendations-btn">
      <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6 4H10V6H6V10H4V6H0V4H4V0H6V4Z" fill="white"/>
      </svg>
      Nova preporuka
    </button>
  @endif
  
</header>
