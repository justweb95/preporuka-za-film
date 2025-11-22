const notificationButtons = document.querySelectorAll('#notification_button');
let notificationPanel = document.getElementById('notification_overlay');
let notificationCards = document.querySelectorAll('.notification-card');

if(notificationButtons) {
  notificationButtons.forEach(notificationButton => {
    notificationButton.addEventListener('click', () => {
      toggleNotificationPanel();
    });    
  });

}
if (notificationPanel) {
  notificationPanel.addEventListener('click', async (event) => {
    if (event.target === notificationPanel) {
      toggleNotificationPanel();
      return;
    }

    const card = event.target.closest('.notification-card');
    if (!card) {
      return;
    }

    const notificationId = card.dataset.notificationId;
    try {
      const notification_update = await setNotificationAsSeen(notificationId);
      if (notification_update.success) {
        card.classList.add('read');
      }
    } catch (err) {
      console.log("Error updating notification as seen:", err);
    }
  });
}


function toggleNotificationPanel() {
  notificationPanel.classList.toggle('notification-overlay-active');
}

async function setNotificationAsSeen(notificationId) {
  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    credentials: 'include',
    body: new URLSearchParams({
      action: 'mark_notifications_seen',
      notification_id: notificationId
    })
  });

  const data = await response.json();
  return data; // return parsed JSON
}
