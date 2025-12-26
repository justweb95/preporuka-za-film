@php
  use App\Controllers\NotificationManager;

  $user_id = get_current_user_id();
  $notificationManager = new NotificationManager($user_id);

  // Get notifications
  $notificationsJson = $notificationManager->getNotifications($user_id);
  
  // SAFETY: Decode and ensure it's an array
  $notifications = json_decode($notificationsJson, true);
  
  // If json_decode failed or returned null, set empty array
  if (!is_array($notifications)) {
      $notifications = [];
  }
  
  // SAFETY: Ensure each notification is an array
  $notifications = array_filter($notifications, function($notification) {
      return is_array($notification);
  });
@endphp

<div class="notification-overlay" id="notification_overlay">
  <section class="notification-list-holder">
    <h2 class="notification-main-title">Notifikacije</h2>
    <p class="notification-note">Notifikacije neće biti napadne pojavljivaće se povremeno kada bude nešto važno.</p>
    <p class="notification-note notification-note-red">Sve notifikacije će biti automatski obrisane nakon 7 dana.</p>
    <ul class="notification-list">
      @if (empty($notifications))
        <li><p class="no-notification-note">Nema notifikacija za prikaz.</p></li>
      @else
        @foreach ($notifications as $notification)
          @if(is_array($notification))
            <li>
              @include('pages.notification.single-notification-card', [
                'type' => $notification['type'] ?? 'info',
                'id' => $notification['id'] ?? uniqid(),
                'title' => $notification['title'] ?? '',
                'message' => $notification['message'] ?? '',
                'icon' => $notification['icon'] ?? '',
                'is_seen' => $notification['is_seen'] ?? false,
                'timestamp' => $notification['created_at'] ?? time(),
                'link' => $notification['link'] ?? ''
              ])
            </li>
          @endif
        @endforeach
      @endif
    </ul>
  </section>
</div>
