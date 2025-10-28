// ======== FILTER & SORT SETUP ========

// Select dropdowns and category filters
const dropdowns = document.querySelectorAll('.filter-sort-dropdown');
const header_category_filter = document.querySelectorAll('.single-category-filter');
const moviesContainer = document.querySelector('.movies-container');

// ------- DROPDOWN LOGIC -------
dropdowns.forEach(dropdown => {
  const selected = dropdown.querySelector('.filter-sort-selected');
  const options = dropdown.querySelectorAll('.filter-sort-options p');

  // Toggle dropdown open/close
  selected.addEventListener('click', e => {
    dropdown.classList.toggle('filter-sort-open');
  });

  // Select an option
  options.forEach(option => {
    option.addEventListener('click', () => {
      selected.querySelector('p').textContent = option.textContent;
      dropdown.classList.remove('filter-sort-open');

      // Run sorting function
      const sortBy = option.dataset.value; // 'sort_year' or 'sort_rating'
      sortMovies(sortBy);
    });
  });

  // Close dropdown if click outside
  document.addEventListener('click', e => {
    if (!dropdown.contains(e.target)) {
      dropdown.classList.remove('filter-sort-open');
    }
  });
});

// ------- CATEGORY FILTER LOGIC -------
header_category_filter.forEach(filter_btn => {
  filter_btn.addEventListener('click', () => {
    handleFilterChange(filter_btn);
  });
});

function handleFilterChange(filter_value) {
  const category = filter_value.dataset.categoryType;

  // Update active button style
  header_category_filter.forEach(filter => filter.classList.remove('active-category'));
  filter_value.classList.add('active-category');

  // Filter movies
  const movies = document.querySelectorAll('.movie-card');
  movies.forEach(movie => {
    if (category === 'all' || movie.dataset.category === category) {
      movie.style.display = 'flex'; // show
    } else {
      movie.style.display = 'none'; // hide
    }
  });
}

// ------- SORT FUNCTION -------
function sortMovies(sortBy) {
  const movies = Array.from(document.querySelectorAll('.movie-card'))
    .filter(movie => movie.style.display !== 'none'); // sort only visible cards

  movies.sort((a, b) => {
    const aVal = sortBy === 'sort_year' ? parseInt(a.dataset.year) : parseFloat(a.dataset.rating);
    const bVal = sortBy === 'sort_year' ? parseInt(b.dataset.year) : parseFloat(b.dataset.rating);
    return bVal - aVal; // descending order
  });

  // Re-append sorted movies to container
  movies.forEach(movie => moviesContainer.appendChild(movie));
}
