// const observerOptions = {
//   root: null,
//   rootMargin: '0px',
//   threshold: 0.5
// };

// const observerCallback = (entries, observer) => {
//   entries.forEach(entry => {
//     if (entry.isIntersecting) {
//       const counters = document.querySelectorAll('.card-heading strong');
//       counters.forEach(counter => {
//         animateCounter(counter);
//       });
//       observer.disconnect();
//     }
//   });
// };

// const observer = new IntersectionObserver(observerCallback, observerOptions);
// const target = document.querySelector('.system-holder');
// observer.observe(target);

// function animateCounter(element) {
//   const targetNumber = parseInt(element.textContent.replace(/\D/g, ''), 10);
//   let currentNumber = 0;
//   const increment = targetNumber / 100;

//   const updateCounter = () => {
//     currentNumber += increment;
//     if (currentNumber < targetNumber) {
//       element.textContent = Math.ceil(currentNumber).toLocaleString();
//       requestAnimationFrame(updateCounter);
//     } else {
//       element.textContent = targetNumber.toLocaleString();
//     }
//   };

//   updateCounter();
// }


const observerOptions = {
  root: null,
  rootMargin: '0px',
  thereshold: 0.5
};

const observerCallback = (entries, observer) => {
  entries.forEach(entry => {
    if(entry.isIntersecting) {
      const counters = document.querySelectorAll('.card-heading strong');
      counters.forEach(counter => {
        animateCounter(counter);
      });
      observer.disconnect();
    }
  });
};

const observe = new IntersectionObserver(observerCallback, observerOptions);
const coutnerHolder = document.querySelector('.system-holder');
observe.observe(coutnerHolder)

function animateCounter(element) {
  const targetNumber = parseInt(element.textContent.replace(/\D/g, ''), 10);
  let currentNumber = 0;
  const increment = targetNumber / 100;

  const updateCounter = () => {
    currentNumber += increment;
    if (currentNumber < targetNumber) {
      element.textContent = Math.ceil(currentNumber).toLocaleString();
      requestAnimationFrame(updateCounter);
    } else {
      element.textContent = targetNumber.toLocaleString();
    }
  };

  updateCounter();
}
