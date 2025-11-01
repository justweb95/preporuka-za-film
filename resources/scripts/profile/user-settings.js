import { logOutHandler } from './profile-navigation-controller.js';

let global_avatar_path = '';

document.querySelectorAll('.avatar-wrapper').forEach(wrapper => {
  wrapper.addEventListener('click', () => {
    // Remove active from all
    document.querySelectorAll('.avatar-wrapper').forEach(w => w.classList.remove('active-avatar'));

    // Add active to clicked
    wrapper.classList.add('active-avatar');

    console.log('Selected avatar:', wrapper.dataset.avatarSrc);
    global_avatar_path = wrapper.dataset.avatarSrc;
  });
});

async function updateUserAvatar(avatarSrc) {
  const formData = new FormData();
  formData.append('action', 'update_user_avatar');
  formData.append('avatarSrc', avatarSrc);
  formData.append('nonce', pzfilm_globals.nonce);
  

  try {
    const response = await fetch(pzfilm_globals.ajaxurl, {
      method: 'POST',
      credentials: 'include',
      body: formData
    });

    const data = await response.json();
    if (data.success) {
      // Optionally update the avatar in the DOM
      const avatarElements = document.querySelectorAll('.avatar-image');
      const avatarPath = pzfilm_globals.theme_uri + '/' + data.data.avatar; // Adjust path

      console.log(avatarPath);
      

      avatarElements.forEach(el => {
          el.src = avatarPath;
      });

      if (profile_popup) profile_popup.style.display = 'none';
      if (removeProfilePopup) removeProfilePopup.hidden = true;
      if (changeAvatarPopup) changeAvatarPopup.hidden = true;
    }
  } catch (err) {
    console.error(err);
    alert('Došlo je do greške prilikom ažuriranja avatara.');
  }
}

const profile_navigation_holder = document.querySelector('.user-settings-options-nav');  
const profile_navigation_link = document.querySelectorAll('.user-settings-options-nav-link');
const profile_options_tabs = document.querySelectorAll('.user-settings-options-tab');
const profile_popup = document.querySelector('.user-settings-options-pop-up');

const removeProfilePopup = profile_popup?.querySelector('[data-popup="obrisi_profil"]');
const changeAvatarPopup = profile_popup?.querySelector('[data-popup="promeni_sliku"]');

const notification_toggler = document.querySelector('#notification_toggler');


profile_navigation_holder.addEventListener('click', (e) => {
  const linkElement = e.target.closest('[data-link-id]');
  if (!linkElement) return;

  const linkId = linkElement.dataset.linkId;
  if (!linkId) return;


  if (linkId === 'obrisi_nalog' || linkId === 'odjavi_se') {
    
    if (linkId === 'obrisi_nalog' && removeProfilePopup) {
      removeProfilePopup.hidden = false;
      if (profile_popup) profile_popup.style.display = 'flex';
      if (changeAvatarPopup) changeAvatarPopup.hidden = true;

    } else if (linkId === 'odjavi_se' && changeAvatarPopup) {
      logOutHandler();
    }

    return;
  }

  // Highlight active link for normal tabs
  if (linkId === 'uredi_profil' || linkId === 'promeni_lozinku') {
    profile_navigation_link.forEach(link => link.classList.remove('active-options-link'));
    linkElement.classList.add('active-options-link');
  }
  profile_options_tabs.forEach(tab => tab.hidden = true);

  if (profile_popup) profile_popup.style.display = 'none';
  if (removeProfilePopup) removeProfilePopup.hidden = true;
  if (changeAvatarPopup) changeAvatarPopup.hidden = true;

  const activeTab = document.querySelector(`[data-tab-id="${linkId}"]`);
  if (activeTab) activeTab.hidden = false;
});



document.addEventListener('click', (e) => {
  if (e.target.classList.contains('cancel-btn')) {
    if (profile_popup) profile_popup.style.display = 'none';
    if (removeProfilePopup) removeProfilePopup.hidden = true;
    if (changeAvatarPopup) changeAvatarPopup.hidden = true;
  }

  if (e.target.classList.contains('change-user-avatar')) {
    if (profile_popup) profile_popup.style.display = 'flex';
    if (removeProfilePopup) removeProfilePopup.hidden = true;
    if (changeAvatarPopup) changeAvatarPopup.hidden = false;
  }


  if (e.target.classList.contains('confirm-btn')) {
    console.log('Confirm button clicked! You can add your function here.');
    updateUserAvatar(global_avatar_path);
  }

});


notification_toggler.addEventListener('change', async () => {
  const enabled = notification_toggler.checked ? '1' : '0';

  const formData = new FormData();
  formData.append('action', 'update_user_notifications');
  formData.append('notifications_enabled', enabled);
  formData.append('nonce', pzfilm_globals.user_settings_nonce); // only if PHP expects it

  try {
    const response = await fetch(pzfilm_globals.ajaxurl, {
      method: 'POST',
      credentials: 'include',
      body: formData
    });

    const data = await response.json();

    if (data.success) {
    } else {
      console.log('Error:', data.data.message);
    }

  } catch (error) {
    console.log('Request failed:', error);
  }
});

const form = document.getElementById('password-change-form');
const feedback = document.getElementById('password-feedback');

form.addEventListener('submit', async (e) => {
  e.preventDefault();
  feedback.textContent = 'Čekajte...';
  feedback.style.color = '#FFF';

  const formData = new FormData(form);
  formData.append('action', 'ajax_change_password');

  try {
    const response = await fetch(pzfilm_globals.ajaxurl, {
      method: 'POST',
      credentials: 'include',
      body: formData
    });
    const data = await response.json();

    if (data.success) {
      feedback.textContent = data.data.message;
      feedback.style.color = '#18BF7C'; // success green
      form.reset();
    } else {
      feedback.textContent = data.data.message;
      feedback.style.color = '#FF6161'; // error red
    }

  } catch (error) {
    feedback.textContent = 'Došlo je do greške. Pokušajte ponovo.';
    feedback.style.color = '#FF6161';
    console.error(error);
  }
});


document.querySelectorAll('.toggle-password').forEach(icon => {
  icon.addEventListener('click', () => {
    const input = icon.previousElementSibling;
    if (input.type === 'password') {
      input.type = 'text';
      icon.style.opacity = '0.9'; // optional visual feedback
      icon.innerHTML = `    <svg class="toggle-password" data-state="visible" width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M16.5293 1.06055L2.5293 15.0605L1.46875 14L3.23242 12.2354C3.14733 12.161 3.06212 12.0877 2.98047 12.0117C1.51824 10.6556 0.539632 9.03063 0.0771484 7.91504C-0.0259303 7.6682 -0.0259303 7.39234 0.0771484 7.14551C0.539632 6.02991 1.51824 4.40498 2.98047 3.04883C4.45217 1.68017 6.47441 0.530331 8.99902 0.530273C10.7722 0.530358 12.297 1.09821 13.5576 1.91016L15.4688 0L16.5293 1.06055ZM15.7715 3.81738C16.8199 4.98401 17.5426 6.23438 17.9229 7.14551C18.026 7.39238 18.026 7.66816 17.9229 7.91504C17.4572 9.03065 16.4788 10.6525 15.0166 12.0117C13.545 13.3803 11.5234 14.5302 8.99902 14.5303C7.79762 14.5302 6.71071 14.2672 5.74219 13.8467L7.73926 11.8496C8.13901 11.9661 8.5618 12.0303 8.99902 12.0303C11.483 12.0301 13.498 10.0145 13.498 7.53027C13.498 7.09315 13.4337 6.67116 13.3174 6.27148L15.7715 3.81738ZM8.99902 3.03027C6.51495 3.03038 4.49902 5.04596 4.49902 7.53027C4.49902 8.50151 4.80835 9.40027 5.33203 10.1357L6.41602 9.05176C6.15185 8.60584 5.99902 8.08625 5.99902 7.53027C5.99902 7.43965 6.00547 7.35507 6.01172 7.26758C6.30223 7.43624 6.63982 7.53024 6.99902 7.53027C8.10195 7.53015 8.99902 6.63332 8.99902 5.53027C8.99902 5.17099 8.90186 4.83354 8.73633 4.54297C8.82371 4.53361 8.91164 4.53028 8.99902 4.53027C9.55498 4.53035 10.0748 4.68285 10.5205 4.94727L11.6045 3.86328C10.869 3.33965 9.97012 3.03036 8.99902 3.03027Z" fill="#465463"/>
      </svg>`;
    } else {
      input.type = 'password';
      icon.style.opacity = '1';
      icon.innerHTML = `      <svg class="toggle-password" width="18" height="16" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M8.99844 0C6.47366 0 4.45196 1.06786 2.98021 2.33884C1.51784 3.59821 0.539797 5.10714 0.077337 6.14308C-0.025779 6.37232 -0.025779 6.62768 0.077337 6.85692C0.539797 7.89286 1.51784 9.40178 2.98021 10.6612C4.45196 11.9321 6.47366 13 8.99844 13C11.5232 13 13.5449 11.9321 15.0167 10.6612C16.479 9.39888 17.4571 7.89286 17.9227 6.85692C18.0258 6.62768 18.0258 6.37232 17.9227 6.14308C17.4571 5.10714 16.479 3.59821 15.0167 2.33884C13.5449 1.06786 11.5232 0 8.99844 0ZM13.498 6.5C13.498 8.80692 11.4826 10.6786 8.99844 10.6786C6.51428 10.6786 4.49883 8.80692 4.49883 6.5C4.49883 4.19308 6.51428 2.32143 8.99844 2.32143C11.4826 2.32143 13.498 4.19308 13.498 6.5ZM8.99844 4.64286C8.99844 5.66719 8.10164 6.5 6.99861 6.5C6.63927 6.5 6.3018 6.41295 6.0112 6.25625C6.00495 6.3375 5.9987 6.41585 5.9987 6.5C5.9987 8.03795 7.34233 9.28571 8.99844 9.28571C10.6545 9.28571 11.9982 8.03795 11.9982 6.5C11.9982 4.96205 10.6545 3.71429 8.99844 3.71429C8.91095 3.71429 8.82345 3.71719 8.73596 3.72589C8.90157 3.99576 8.99844 4.30915 8.99844 4.64286Z" fill="#687382"/>
      </svg>`;
    }
  });
});


const userForm = document.getElementById('user-info-form');
const feedbackUpdateUserInfor = document.getElementById('user-update-feedback');

userForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    feedbackUpdateUserInfor.textContent = 'Čekajte...';
    feedbackUpdateUserInfor.style.color = '#FFF';

    const formData = new FormData(userForm);
    formData.append('action', 'ajax_update_user_info');

    try {
        const response = await fetch(pzfilm_globals.ajaxurl, {
            method: 'POST',
            credentials: 'include',
            body: formData
        });

        const data = await response.json();

        if (data.success) {
          feedbackUpdateUserInfor.textContent = data.data.message;
          feedbackUpdateUserInfor.style.color = '#18BF7C';

          // Update inputs with new values
          document.getElementById('name').value = formData.get('name');
          document.getElementById('email').value = formData.get('email');
          document.getElementById('bio').value = formData.get('bio');
        } else {
            feedbackUpdateUserInfor.textContent = data.data.message;
            feedbackUpdateUserInfor.style.color = '#FF6161'; // error
        }
    } catch (err) {
        feedbackUpdateUserInfor.textContent = 'Došlo je do greške. Pokušajte ponovo.';
        feedbackUpdateUserInfor.style.color = '#FF6161';
        console.error(err);
    }
});



const removePopup = document.querySelector('.remove-profile');
const cancelBtn = removePopup.querySelector('.cancel-btn');
const confirmBtn = removePopup.querySelector('.confirm-btn');

cancelBtn.addEventListener('click', () => {
  removePopup.setAttribute('hidden', '');
});

confirmBtn.addEventListener('click', async () => {
  confirmBtn.disabled = true;
  confirmBtn.textContent = 'Brisanje...';

  const formData = new FormData();
  formData.append('action', 'delete_user_account');
  formData.append('nonce', pzfilm_globals.delete_nonce);

  try {
    const response = await fetch(pzfilm_globals.ajaxurl, {
      method: 'POST',
      credentials: 'include',
      body: formData
    });

    const data = await response.json();
    console.log(data);

    if (data.success) {
      confirmBtn.textContent = 'Nalog obrisan';
      setTimeout(() => {
          window.location.href = data.data.redirect_url;
      }, 1000);
    }
 else {
      confirmBtn.disabled = false;
      confirmBtn.textContent = 'Potvrdi';
      alert(data.data.message);
    }
  } catch (err) {
    console.error(err);
    confirmBtn.disabled = false;
    confirmBtn.textContent = 'Potvrdi';
    alert('Došlo je do greške. Pokušajte ponovo.');
  }
});
