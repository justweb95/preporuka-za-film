const navigationSidebarLinks = document.querySelectorAll('.nav-link-button');
const profileSections = document.querySelectorAll('.tab-content');


navigationSidebarLinks[0].classList.add('active-nav');
 

navigationSidebarLinks.forEach(link => {
  link.addEventListener('click', () => {  
    const targetId = link.dataset.tab;

    if (targetId !== 'logout') {
      handleNavigationClick(targetId, link);
    } else {
      logOutHandler();
    }
  });
});

function handleNavigationClick(id, link) {
  profileSections.forEach(profile_tab => {
    profile_tab.hidden = profile_tab.id !== id;
  });

  navigationSidebarLinks.forEach(otherLink => {    
    otherLink.classList.toggle('active-nav', otherLink === link);
  });
}

async function logOutHandler() {
  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    body: new URLSearchParams({
      action: 'logout_user' // must match the PHP hook
    })
  });

  const data = await response.json();
  if (data.success) {
    window.location.href = data.data.redirect_url;

  } else {
    console.log('Logout failed', data);
  }
}
