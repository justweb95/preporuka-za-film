@php
  use App\Controllers\NotificationManager;

  $user_id = get_current_user_id();
  $notificationManager = new NotificationManager($user_id);

  $notifications = json_decode($notificationManager->getNotifications($user_id), true);
@endphp

<div class="notification-overlay" id="notification_overlay">
  <section class="notification-list-holder">
    <h2 class="notification-main-title">Notifikacije</h2>
    <p class="notification-note">Notifikacije neće biti napadne  pojavljivaće se povremeno kada bude nešto važno.</p>
    <ul class="notification-list">
      @if (empty($notifications))
        <li><p class="no-notification-note">Nema notifikacija za prikaz.</p></li>
      @else
        @foreach ($notifications as $notification)
          <li>
            @include('pages.notification.single-notification-card', 
            [ 'type' => $notification['type'],
              'id' => $notification['id'],
              'title' => $notification['title'],
              'message' => $notification['message'],
              'icon' => $notification['icon'],
              'is_seen' => $notification['is_seen'],
              'timestamp' => $notification['created_at'],
              'link' => $notification['link']
            ])
          </li>          
        @endforeach
      @endif
    </ul>
  </section>
</div>