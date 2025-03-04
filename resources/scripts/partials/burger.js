// Burger menu open close and dropdown

const burgerOpenDropdown = document.querySelector('.burger-open-dropdown');
const burgerDropdownContent = document.querySelector('.burger-dropdown-content');
const burgerOpenBtn = document.querySelector('.burger-open-btn');
const burgerClose = document.querySelector('.burger-close');
const burgerMenuContent = document.querySelector('.burger-menu-content');
const categoriesIcon = document.querySelector('.burger-category-icon');

const toggleDisplay = (element, icon) => {    
  let body = document.querySelector('body');
  element.style.display = (element.style.display === 'flex') ? 'none' : 'flex';
    
  if (element.classList.contains('burger-menu-content')) {
    element.classList.toggle('burger-active');
    body.style.overflowY =  (body.style.overflowY === 'hidden') ? 'auto' : 'hidden';
  }  

  if(icon) {
    console.log('clicked');
    console.log(categoriesIcon);
    categoriesIcon.classList.toggle('rotate-icon');
  }
};

if (burgerOpenDropdown && burgerDropdownContent) {
  burgerOpenDropdown.addEventListener('click', () => toggleDisplay(burgerDropdownContent, true));  
}

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
//       headerHolder.style.padding = '16px 0px';
//     } else {
//       headerHolder.style.padding = '';
//     }
//   }
// });