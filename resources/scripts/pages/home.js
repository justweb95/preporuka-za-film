  // Function to animate number increment
  function animateNumber(id, start, end, duration) {
    const element = document.getElementById(id);
    if (!element) return; // Return if the element does not exist
    let startTime = null;

    function updateNumber(timestamp) {
      if (!startTime) startTime = timestamp;
      const progress = timestamp - startTime;
      const increment = Math.min(progress / duration, 1); // Ensure it doesn't exceed 100%
      const currentNumber = Math.floor(start + (end - start) * increment);
      element.innerHTML = `<strong>${currentNumber}</strong>+`;
      if (increment < 1) {
        requestAnimationFrame(updateNumber);
      }
    }

    requestAnimationFrame(updateNumber);
  }

  // Function to observe when element is in viewport
  function observeElement(id, start, end, duration) {
    const element = document.getElementById(id);
    if (!element) return; // Return if the element does not exist
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateNumber(id, start, end, duration);
          observer.unobserve(element); // Stop observing after animation starts
        }
      });
    });

    observer.observe(element);
  }

  // Call the observeElement function for each id and number to animate
  observeElement('interactive-pf', 0, 5000, 2000);
  observeElement('interactive-fp', 0, 32, 2000);
  observeElement('interactive-sg', 0, 14000, 2000);
  observeElement('interactive-fz', 0, 20, 2000);