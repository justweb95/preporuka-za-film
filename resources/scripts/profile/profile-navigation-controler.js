const navigationSidebarLinks = document.querySelectorAll('.nav-link-button');
const profileSections = document.querySelectorAll('.tab-content');

navigationSidebarLinks.forEach(link => {
  link.addEventListener('click', () => {  
    const targetId = link.dataset.tab;
    handleNavigationClick(targetId, link);
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