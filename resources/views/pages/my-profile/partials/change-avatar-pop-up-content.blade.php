 @php
  $current_user = wp_get_current_user();
  $current_user_img_src = get_user_meta($current_user->ID, 'profile_image', true); 

  $male_avatars = [
    'images/avatars/Profile1.svg',
    'images/avatars/Profile2.svg',
    'images/avatars/Profile3.svg',
    'images/avatars/Profile4.svg',
    'images/avatars/Profile5.svg',
    'images/avatars/Profile6.svg',
    'images/avatars/Profile7.svg',
  ];

  $female_avatars = [
    'images/avatars/Profile8.svg',
    'images/avatars/Profile9.svg',
    'images/avatars/Profile10.svg',
    'images/avatars/Profile11.svg',
    'images/avatars/Profile12.svg',
    'images/avatars/Profile13.svg',
    'images/avatars/Profile14.svg',
  ];
@endphp


 <div class="change-user-picture" data-id="promeni_sliku" {{ $hidden ? 'hidden' : '' }}>
  <h2 class="change-user-picture-title">Želiš da promeniš svoj avatar?</h2>
  <div class="change-user-picture-content">
    <div class="male-avatar">
      @foreach($male_avatars as $avatar)
        <span class="avatar-wrapper {{ $current_user_img_src === $avatar ? 'active-avatar' : '' }}">
          <img class="avatar-icon" src="@asset($avatar)" alt="User Avatar">
        </span>
      @endforeach
    </div>

    <div class="female-avatar">
      @foreach($female_avatars as $avatar)
        <span class="avatar-wrapper {{ $current_user_img_src === $avatar ? 'active-avatar' : '' }}">
          <img class="avatar-icon" src="@asset($avatar)" alt="User Avatar">
        </span>
      @endforeach
    </div>
  </div>
  <div class="btn-holder">
    <button class="cancel-btn">Odustani</button>
    <button class="confirm-btn">Potvrdi</button>
  </div>
</div>