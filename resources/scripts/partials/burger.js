// Burger menu open close and dropdown

const burgerOpenDropdown = document.querySelector('.burger-open-dropdown');
const burgerDropdownContent = document.querySelector('.burger-dropdown-content');
const burgerOpenBtn = document.querySelector('.burger-open-btn');
const burgerClose = document.querySelector('.burger-close');
const burgerMenuContent = document.querySelector('.burger-menu-content');

const toggleDisplay = (element) => {    
  let body = document.querySelector('body');
  element.style.display = (element.style.display === 'flex') ? 'none' : 'flex';
    
  if (element.classList.contains('burger-menu-content')) {
    element.classList.toggle('burger-active');
    body.style.overflowY =  (body.style.overflowY === 'hidden') ? 'auto' : 'hidden';
  }
  
};

if (burgerOpenDropdown && burgerDropdownContent) {
  burgerOpenDropdown.addEventListener('click', () => toggleDisplay(burgerDropdownContent));
}

if (burgerOpenBtn && burgerMenuContent) {
  burgerOpenBtn.addEventListener('click', () => toggleDisplay(burgerMenuContent));
}

if (burgerClose && burgerMenuContent) {
  burgerClose.addEventListener('click', () => toggleDisplay(burgerMenuContent));
}

const headerHolder = document.querySelector('.header-holder');

window.addEventListener('scroll', () => {
  if (headerHolder) {
    if (window.scrollY > 16) {
      headerHolder.style.padding = '16px 0px';
    } else {
      headerHolder.style.padding = '';
    }
  }
});