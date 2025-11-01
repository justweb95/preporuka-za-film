@php
  $current_user = wp_get_current_user();
  $current_user_img_src = get_user_meta($current_user->ID, 'profile_image', true); 
@endphp

<div class="user-info-holder">

  {{-- Avatar section --}}
  <div class="user-avatar-update">
    @if($current_user_img_src)
      <img class="avatar-image" src="@asset($current_user_img_src)" alt="User Avatar">
    @else
      <img class="avatar-image" src="@asset('images/avatars/Profile12.svg')" alt="User Avatar">
    @endif
    <button class="change-user-avatar">Promeni avatar</button>
  </div>

  {{-- Password change form --}}
  <form id="password-change-form" class="user-general-update">
    @csrf
    @php wp_nonce_field('change_pass_action', 'change_pass_nonce'); @endphp

    <p id="password-feedback"></p>

    <span class="user-general-password">
      <label for="old_password">Stara lozinka</label>
      <input type="password" id="old_password" name="old_password" placeholder="Unesite staru lozinku">
      <svg class="toggle-password" width="18" height="16" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M8.99844 0C6.47366 0 4.45196 1.06786 2.98021 2.33884C1.51784 3.59821 0.539797 5.10714 0.077337 6.14308C-0.025779 6.37232 -0.025779 6.62768 0.077337 6.85692C0.539797 7.89286 1.51784 9.40178 2.98021 10.6612C4.45196 11.9321 6.47366 13 8.99844 13C11.5232 13 13.5449 11.9321 15.0167 10.6612C16.479 9.39888 17.4571 7.89286 17.9227 6.85692C18.0258 6.62768 18.0258 6.37232 17.9227 6.14308C17.4571 5.10714 16.479 3.59821 15.0167 2.33884C13.5449 1.06786 11.5232 0 8.99844 0ZM13.498 6.5C13.498 8.80692 11.4826 10.6786 8.99844 10.6786C6.51428 10.6786 4.49883 8.80692 4.49883 6.5C4.49883 4.19308 6.51428 2.32143 8.99844 2.32143C11.4826 2.32143 13.498 4.19308 13.498 6.5ZM8.99844 4.64286C8.99844 5.66719 8.10164 6.5 6.99861 6.5C6.63927 6.5 6.3018 6.41295 6.0112 6.25625C6.00495 6.3375 5.9987 6.41585 5.9987 6.5C5.9987 8.03795 7.34233 9.28571 8.99844 9.28571C10.6545 9.28571 11.9982 8.03795 11.9982 6.5C11.9982 4.96205 10.6545 3.71429 8.99844 3.71429C8.91095 3.71429 8.82345 3.71719 8.73596 3.72589C8.90157 3.99576 8.99844 4.30915 8.99844 4.64286Z" fill="#687382"/>
      </svg>
    </span>

    <span class="user-general-password">
      <label for="new_password">Nova lozinka</label>
      <input type="password" id="new_password" name="new_password" placeholder="Unesite novu lozinku">
      <svg class="toggle-password" width="18" height="16" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M8.99844 0C6.47366 0 4.45196 1.06786 2.98021 2.33884C1.51784 3.59821 0.539797 5.10714 0.077337 6.14308C-0.025779 6.37232 -0.025779 6.62768 0.077337 6.85692C0.539797 7.89286 1.51784 9.40178 2.98021 10.6612C4.45196 11.9321 6.47366 13 8.99844 13C11.5232 13 13.5449 11.9321 15.0167 10.6612C16.479 9.39888 17.4571 7.89286 17.9227 6.85692C18.0258 6.62768 18.0258 6.37232 17.9227 6.14308C17.4571 5.10714 16.479 3.59821 15.0167 2.33884C13.5449 1.06786 11.5232 0 8.99844 0ZM13.498 6.5C13.498 8.80692 11.4826 10.6786 8.99844 10.6786C6.51428 10.6786 4.49883 8.80692 4.49883 6.5C4.49883 4.19308 6.51428 2.32143 8.99844 2.32143C11.4826 2.32143 13.498 4.19308 13.498 6.5ZM8.99844 4.64286C8.99844 5.66719 8.10164 6.5 6.99861 6.5C6.63927 6.5 6.3018 6.41295 6.0112 6.25625C6.00495 6.3375 5.9987 6.41585 5.9987 6.5C5.9987 8.03795 7.34233 9.28571 8.99844 9.28571C10.6545 9.28571 11.9982 8.03795 11.9982 6.5C11.9982 4.96205 10.6545 3.71429 8.99844 3.71429C8.91095 3.71429 8.82345 3.71719 8.73596 3.72589C8.90157 3.99576 8.99844 4.30915 8.99844 4.64286Z" fill="#687382"/>
      </svg>
    </span>

    <span class="user-general-password">
      <label for="repeat_new_password">Ponovite novu lozinku</label>
      <input type="password" id="repeat_new_password" name="repeat_new_password" placeholder="Ponovite novu lozinku">
      <svg class="toggle-password" width="18" height="16" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M8.99844 0C6.47366 0 4.45196 1.06786 2.98021 2.33884C1.51784 3.59821 0.539797 5.10714 0.077337 6.14308C-0.025779 6.37232 -0.025779 6.62768 0.077337 6.85692C0.539797 7.89286 1.51784 9.40178 2.98021 10.6612C4.45196 11.9321 6.47366 13 8.99844 13C11.5232 13 13.5449 11.9321 15.0167 10.6612C16.479 9.39888 17.4571 7.89286 17.9227 6.85692C18.0258 6.62768 18.0258 6.37232 17.9227 6.14308C17.4571 5.10714 16.479 3.59821 15.0167 2.33884C13.5449 1.06786 11.5232 0 8.99844 0ZM13.498 6.5C13.498 8.80692 11.4826 10.6786 8.99844 10.6786C6.51428 10.6786 4.49883 8.80692 4.49883 6.5C4.49883 4.19308 6.51428 2.32143 8.99844 2.32143C11.4826 2.32143 13.498 4.19308 13.498 6.5ZM8.99844 4.64286C8.99844 5.66719 8.10164 6.5 6.99861 6.5C6.63927 6.5 6.3018 6.41295 6.0112 6.25625C6.00495 6.3375 5.9987 6.41585 5.9987 6.5C5.9987 8.03795 7.34233 9.28571 8.99844 9.28571C10.6545 9.28571 11.9982 8.03795 11.9982 6.5C11.9982 4.96205 10.6545 3.71429 8.99844 3.71429C8.91095 3.71429 8.82345 3.71719 8.73596 3.72589C8.90157 3.99576 8.99844 4.30915 8.99844 4.64286Z" fill="#687382"/>
      </svg>
    </span>

    <div class="user-btn-holder">
      <button type="reset" class="cancel-update">Odbaci promene</button>
      <button type="submit" class="update-user-info">Sačuvaj promene</button>
    </div>
  </form>

</div>
