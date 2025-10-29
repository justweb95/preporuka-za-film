window.handleCategoryDropdown = handleCategoryDropdown;

export function handleCategoryDropdown() {
  const categoryDropdownList = document.querySelector('.category-drop-down-list');
  const categorySVG = document.querySelector('.category-drop-down-holder svg');

  if (window.innerWidth > 550) return;

  if (!categoryDropdownList.style.display || categoryDropdownList.style.display === 'none') {
    categoryDropdownList.style.display = 'flex';
    categorySVG.style.transform = 'rotate(180deg)';
  } else {
    categoryDropdownList.style.display = 'none';
    categorySVG.style.transform = 'rotate(0deg)';
  }
}