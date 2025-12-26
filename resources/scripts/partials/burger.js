// Burger menu open close and dropdown

const burgerOpenDropdown = document.querySelectorAll('.burger-open-dropdown');
const burgerDropdownContent = document.querySelectorAll('.burger-dropdown-content');
const burgerOpenBtn = document.querySelector('.burger-open-btn');
const burgerClose = document.querySelector('.burger-close');
const burgerMenuContent = document.querySelector('.burger-menu-content');
const categoriesIcon = document.querySelectorAll('.burger-category-icon');

const toggleDisplay = (element, icon) => {    
  let body = document.querySelector('body');
  element.style.display = (element.style.display === 'flex') ? 'none' : 'flex';

  if (element.classList.contains('burger-menu-content')) {
    element.classList.toggle('burger-active');
    body.style.overflowY = (body.style.overflowY === 'hidden') ? 'auto' : 'hidden';
  }  

  if (icon) {
    icon.classList.toggle('rotate-icon');
  }
};

// Close all dropdowns except the one with the specified index
const closeOtherDropdowns = (currentIndex) => {
  burgerDropdownContent.forEach((content, index) => {
    if (index !== currentIndex && content.style.display === 'flex') {
      content.style.display = 'none';
      if (categoriesIcon[index]) {
        categoriesIcon[index].classList.remove('rotate-icon');
      }
    }
  });
};

// Handle multiple dropdowns by index
burgerOpenDropdown.forEach((dropdown, index) => {
  dropdown.addEventListener('click', () => {
    closeOtherDropdowns(index);
    toggleDisplay(burgerDropdownContent[index], categoriesIcon[index]);
  });
});

if (burgerOpenBtn && burgerMenuContent) {
  burgerOpenBtn.addEventListener('click', () => toggleDisplay(burgerMenuContent, false));
}

if (burgerClose && burgerMenuContent) {
  burgerClose.addEventListener('click', () => toggleDisplay(burgerMenuContent, false));
}

// const headerHolder = document.querySelector('.header-holder');

// window.addEventListener('scroll', () => {
//   if (headerHolder) {
//     if (window.scrollY > 16) {
//   