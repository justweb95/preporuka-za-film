@php
  $current_user = wp_get_current_user();
  $current_user_notifications = get_user_meta($current_user->ID, 'notifications_enabled', true); 
@endphp

<section class="user-settings-tab">
  <div class="user-settings-container">
    <ul class="user-settings-options-nav">
      {{-- Uredi Profil --}}
      <li class="user-settings-options-nav-link active-options-link" data-link-id="uredi_profil">
        <svg class="user-settings-options-nav-link-icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M10.9998 10.9997C13.5311 10.9997 15.5832 8.94765 15.5832 6.41634C15.5832 3.88504 13.5311 1.83301 10.9998 1.83301C8.46853 1.83301 6.4165 3.88504 6.4165 6.41634C6.4165 8.94765 8.46853 10.9997 10.9998 10.9997Z" stroke="#C4D4E3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M17.6093 14.4286L14.3643 17.6736C14.2359 17.802 14.1168 18.0403 14.0893 18.2144L13.9151 19.4519C13.8509 19.9011 14.1626 20.2128 14.6118 20.1486L15.8493 19.9744C16.0234 19.9469 16.271 19.8278 16.3901 19.6994L19.6351 16.4544C20.1943 15.8953 20.4601 15.2444 19.6351 14.4194C18.8193 13.6036 18.1685 13.8694 17.6093 14.4286Z" stroke="#C4D4E3" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M17.1416 14.8965C17.4166 15.8865 18.1866 16.6565 19.1766 16.9315" stroke="#C4D4E3" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M3.12598 20.1667C3.12598 16.6192 6.65517 13.75 11.0002 13.75C11.9535 13.75 12.8701 13.8875 13.7226 14.1442" stroke="#C4D4E3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p class="user-settings-options-nav-link-text">Uredi Profil</p>
      </li>

      {{-- Promeni lozinku --}}
      <li class="user-settings-options-nav-link" data-link-id="promeni_lozinku">
        <svg class="user-settings-options-nav-link-icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M19.1675 10.193C19.1675 14.6754 15.9134 18.8738 11.4675 20.1021C11.165 20.1846 10.835 20.1846 10.5325 20.1021C6.08668 18.8738 2.83252 14.6754 2.83252 10.193V6.16877C2.83252 5.4171 3.40087 4.56461 4.1067 4.28044L9.21251 2.19047C10.3583 1.72297 11.6508 1.72297 12.7967 2.19047L17.9025 4.28044C18.5992 4.56461 19.1767 5.4171 19.1767 6.16877L19.1675 10.193Z" stroke="#C4D4E3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M10.9998 11.4587C12.0124 11.4587 12.8332 10.6378 12.8332 9.62533C12.8332 8.6128 12.0124 7.79199 10.9998 7.79199C9.98731 7.79199 9.1665 8.6128 9.1665 9.62533C9.1665 10.6378 9.98731 11.4587 10.9998 11.4587Z" stroke="#C4D4E3" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M11 11.459V14.209" stroke="#C4D4E3" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p class="user-settings-options-nav-link-text">Promeni lozinku</p>
      </li>

      {{-- Obaveštenja --}}
      <li class="user-settings-options-nav-link">
        <svg class="user-settings-options-nav-link-icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M11 2.9502C14.0791 2.9502 16.7472 5.08408 17.4238 8.08789L18.4688 12.7285C18.7326 13.9004 18.1036 15.0901 16.9863 15.5312L16.5117 15.7178C12.9703 17.1157 9.02972 17.1157 5.48828 15.7178L5.01465 15.5312C3.89723 15.0902 3.26742 13.9005 3.53125 12.7285L4.57617 8.08789C5.25275 5.0841 7.92094 2.95029 11 2.9502Z" stroke="#C4D4E3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M7.7002 16.5L8.10449 17.7129C8.51996 18.9593 9.68638 19.8 11.0002 19.8C12.314 19.8 13.4804 18.9593 13.8959 17.7129L14.3002 16.5" stroke="#C4D4E3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        <p class="user-settings-options-nav-link-text">Obaveštenja</p>
        <label class="switch">
          <input type="checkbox" id="notification_toggler" {{ $current_user_notifications === '1' ? 'checked' : '' }}>
          <span class="slider round"></span>
        </label>
      </li>

      {{-- Odjavi se --}}
      <li class="user-settings-options-nav-link" data-link-id="odjavi_se">
        <svg class="user-settings-options-nav-link-icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M14.584 1.25C15.9249 1.25 16.7618 1.24145 17.4629 1.4541C18.981 1.91461 20.1694 3.10299 20.6299 4.62109C20.8425 5.32217 20.834 6.15905 20.834 7.5V14.5C20.834 15.841 20.8425 16.6778 20.6299 17.3789C20.1694 18.897 18.981 20.0854 17.4629 20.5459C16.7618 20.7586 15.9249 20.75 14.584 20.75H14.0342C13.1856 20.75 12.6571 20.7536 12.2031 20.668C10.2818 20.3054 8.7786 18.8022 8.41602 16.8809C8.33036 16.4269 8.33398 15.8984 8.33398 15.0498V14.5996C8.3342 14.1856 8.6699 13.8496 9.08398 13.8496C9.49807 13.8496 9.83377 14.1856 9.83398 14.5996V15.0498C9.83398 15.9665 9.83755 16.3212 9.89062 16.6025C10.1387 17.9171 11.1669 18.9453 12.4814 19.1934C12.7628 19.2464 13.1174 19.25 14.0342 19.25H14.584C16.034 19.25 16.5929 19.2421 17.0273 19.1104C18.066 18.7953 18.8792 17.9821 19.1943 16.9434C19.3261 16.5089 19.334 15.95 19.334 14.5V7.5C19.334 6.05003 19.3261 5.49112 19.1943 5.05664C18.8792 4.01794 18.066 3.20474 17.0273 2.88965C16.5929 2.75789 16.034 2.75 14.584 2.75H14.0342C13.1174 2.75 12.7628 2.75357 12.4814 2.80664C11.1669 3.05474 10.1387 4.08291 9.89062 5.39746C9.83755 5.67879 9.83398 6.03344 9.83398 6.9502V7.40039C9.83377 7.81442 9.49807 8.15039 9.08398 8.15039C8.6699 8.15039 8.3342 7.81442 8.33398 7.40039V6.9502C8.33398 6.1016 8.33036 5.5731 8.41602 5.11914C8.77862 3.19788 10.2819 1.69463 12.2031 1.33203C12.6571 1.24637 13.1856 1.25 14.0342 1.25H14.584ZM4.54785 7.46387C4.84404 7.17464 5.31897 7.17972 5.6084 7.47559C5.89764 7.77179 5.89259 8.2467 5.59668 8.53613L3.8418 10.25H15C15.4142 10.25 15.75 10.5858 15.75 11C15.75 11.4142 15.4142 11.75 15 11.75H3.8418L5.59668 13.4639C5.89259 13.7533 5.89764 14.2282 5.6084 14.5244C5.31897 14.8203 4.84405 14.8254 4.54785 14.5361L1.47559 11.5361C1.33137 11.395 1.25 11.2018 1.25 11C1.25001 10.7982 1.33136 10.605 1.47559 10.4639L4.54785 7.46387Z" fill="#C4D4E3"/>
        </svg>
        <p class="user-settings-options-nav-link-text">Odjavi se</p>
      </li>

      {{-- Obriši nalog --}}
      <li class="user-settings-options-nav-link" data-link-id="obrisi_nalog">
        <svg class="user-settings-options-nav-link-icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M2.75 5.5H4.58333H19.25" stroke="#FF6161" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M7.3335 5.49967V3.66634C7.3335 3.18011 7.52665 2.7138 7.87047 2.36998C8.21428 2.02616 8.6806 1.83301 9.16683 1.83301H12.8335C13.3197 1.83301 13.786 2.02616 14.1299 2.36998C14.4737 2.7138 14.6668 3.18011 14.6668 3.66634V5.49967M17.4168 5.49967V18.333C17.4168 18.8192 17.2237 19.2856 16.8799 19.6294C16.536 19.9732 16.0697 20.1663 15.5835 20.1663H6.41683C5.9306 20.1663 5.46428 19.9732 5.12047 19.6294C4.77665 19.2856 4.5835 18.8192 4.5835 18.333V5.49967H17.4168Z" stroke="#FF6161" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M9.1665 10.083V15.583" stroke="#FF6161" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M12.8335 10.083V15.583" stroke="#FF6161" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <p class="user-settings-options-nav-link-text">Obriši nalog</p>
      </li>
    </ul>    

    <article class="user-settings-options-tab" data-tab-id="uredi_profil">
      @include('pages.my-profile.partials.update-profile-info')
    </article>

    <article class="user-settings-options-tab" data-tab-id="promeni_lozinku" hidden>
      @include('pages.my-profile.partials.update-profile-password')
    </article>

    <article class="user-settings-options-pop-up" data-tab-id='pop-up' style="display: none">
    @include('pages.my-profile.partials.remove-profile-pop-up-content', [
      'hidden' => false,
      'data-popup' => 'remove-profile'
    ])

    @include('pages.my-profile.partials.change-avatar-pop-up-content', [
      'hidden' => true,
      'data-popup' => 'change-avatar'
    ])

    </article>
  </div>
</section>