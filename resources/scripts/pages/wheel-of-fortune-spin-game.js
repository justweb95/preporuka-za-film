import { showToast } from "@scripts/helpers/toastify-helper";

function wheelOfFortune(selector) {
  const node = document.querySelector(selector);
  if (!node) return null;

  const spinBtn = node.parentElement.querySelector('.wof-start-game');
  const wheel = node;

  const elementToHide = document.querySelector('.wof-movie-cards');
  const mover = wheel.closest('.wof-wheel-mover') || wheel.parentElement;

  let animation;
  let previousEndDegree = 0;

  const rangeAngles = [
    { index: 1, from: 345, to: 360 },
    { index: 1, from: 0,   to: 15  },
    { index: 2, from: 15,  to: 75  },
    { index: 3, from: 75,  to: 135 },
    { index: 4, from: 135, to: 195 },
    { index: 5, from: 195, to: 255 },
    { index: 6, from: 255, to: 345 }
  ];

  const POINTER_ANGLE = 90;

  const calculateFinalAngleFromZero = (zeroAngle) => {
    let angle = 360 + POINTER_ANGLE - zeroAngle;
    return ((angle % 360) + 360) % 360;
  };

  function pickWinner() {
    const sliceCount = 6;
    const winningSlice = Math.floor(Math.random() * sliceCount) + 1;

    const ranges = rangeAngles.filter(r => r.index === winningSlice);

    let centerZeroAngle;
    if (ranges.length === 2) {
      centerZeroAngle = ((ranges[0].from + (ranges[1].to + 360)) / 2) % 360;
    } else {
      centerZeroAngle = (ranges[0].from + ranges[0].to) / 2;
    }

    const targetFinalAngle = calculateFinalAngleFromZero(centerZeroAngle);

    return { winningSlice, targetFinalAngle };
  }

  async function spinOnce() {
    const hasEmptySlice = wheel.querySelector('.wof-slice.empty-slice') !== null;
    if (hasEmptySlice) {
      showToast('Dodaj svih 6 filmova da pokreneš točak!', 4000);
      return null;
    }

    spinBtn.style.display = 'none';

    if (animation) animation.cancel();

    // pre animations
    const preAnims = [];

    if (elementToHide) {
      elementToHide.style.pointerEvents = 'none';
      elementToHide.style.userSelect = 'none';

      const hideAnim = elementToHide.animate(
        [{ opacity: 1, transform: 'scale(1)' }, { opacity: 0, transform: 'scale(0.52)' }],
        { duration: 700, easing: 'ease-in-out', fill: 'forwards' }
      );
      preAnims.push(hideAnim.finished.catch(() => {}));
    }

    if (mover) {
      const rect = mover.getBoundingClientRect();
      const dx = window.innerWidth / 2 - (rect.left + rect.width / 2);

      const moveAnim = mover.animate(
        [{ transform: 'translateX(0px)' }, { transform: `translateX(${dx}px)` }],
        { duration: 1000, easing: 'ease-in-out', fill: 'forwards' }
      );
      preAnims.push(moveAnim.finished.catch(() => {}));
    }

    await Promise.all(preAnims);

    const FULL_SPINS = 5;
    const { winningSlice, targetFinalAngle } = pickWinner();

    const currentTurns = Math.floor(previousEndDegree / 360);
    const nextTurns = currentTurns + FULL_SPINS + 1;

    const newEndDegree = nextTurns * 360 + targetFinalAngle;

    animation = wheel.animate(
      [
        { transform: `rotate(${previousEndDegree}deg)` },
        { transform: `rotate(${newEndDegree}deg)` }
      ],
      {
        duration: 6000,
        easing: 'cubic-bezier(0.25, -0.2, 0.1, 1)',
        fill: 'forwards'
      }
    );

    previousEndDegree = newEndDegree;

    await animation.finished.catch(() => {});

    const slices = wheel.querySelectorAll('.wof-slice');
    const winnerEl = slices[winningSlice - 1];

    return winnerEl;
  }

  return { spin: spinOnce };
}

export { wheelOfFortune };
