document.querySelectorAll('.avatar-wrapper').forEach(wrapper => {
  wrapper.addEventListener('click', () => {
    // Remove active from all
    document.querySelectorAll('.avatar-wrapper').forEach(w => w.classList.remove('active-avatar'));

    // Add active to clicked
    wrapper.classList.add('active-avatar');

    // Optionally store selected path for form submission
    const selectedAvatar = wrapper.querySelector('img').src;
    console.log('Selected avatar:', selectedAvatar);
  });
});
