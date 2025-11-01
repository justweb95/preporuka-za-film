const navigationSidebarLinks = document.querySelectorAll('.nav-link-button');
const profileSections = document.querySelectorAll('.tab-content');


// navigationSidebarLinks[0].classList.add('active-nav');
 

navigationSidebarLinks.forEach(link => {
  link.addEventListener('click', () => {  
    const targetId = link.dataset.tab;

    if (targetId !== 'logout') {
      handleNavigationClick(targetId, link);

      const newUrl = `${window.location.pathname}?tab=${targetId}`;
      history.pushState(null, '', newUrl);
    } else {
      logOutHandler();
    }
  });
});

function setActiveNavFromURL() {
  const params = new URLSearchParams(window.location.search);
  const tab = params.get('tab');

  if (tab) {
    const link = Array.from(navigationSidebarLinks).find(l => l.dataset.tab === tab);
    if (link) {
      handleNavigationClick(tab, link);
      return;
    }
  }

  // If no tab in URL, activate the tab marked in HTML (with hidden removed)
  const activeTabEl = document.querySelector('.tab-content:not([hidden])');
  if (activeTabEl) {
    const defaultTab = activeTabEl.id;
    const link = Array.from(navigationSidebarLinks).find(l => l.dataset.tab === defaultTab);
    if (link) {
      handleNavigationClick(defaultTab, link);
    }
  }
}


// Call on page load
setActiveNavFromURL();

function handleNavigationClick(id, link) {
  profileSections.forEach(profile_tab => {
    profile_tab.hidden = profile_tab.id !== id;
  });

  

  navigationSidebarLinks.forEach(otherLink => {    
      otherLink.classList.remove('active-nav');
      
      if(link.dataset.tab === otherLink.dataset.sidebarId) {
        otherLink.classList.add('active-nav');
      }
  });
}

export async function logOutHandler() {
  const response = await fetch(pzfilm_globals.ajaxurl, {
    method: 'POST',
    body: new URLSearchParams({
      action: 'logout_user'
    })
  });

  const data = await response.json();
  if (data.success) {
    window.location.href = data.data.redirect_url;
  } else {
    console.log('Logout failed', data);
  }
}
