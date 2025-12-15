function wheelOfFortune(selector) {
  const node = document.querySelector(selector);
  if (!node) return;

  const spin = node.parentElement.querySelector('.wof-start-game');
  const wheel = node;

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

  // zeroAngle = 360 - finalAngle + pointerAngle
  const POINTER_ANGLE = 90; // pointer points UP

  const calculateZeroAngle = finalAngle => {
    let zeroAngle = 360 - finalAngle + POINTER_ANGLE;
    return ((zeroAngle % 360) + 360) % 360;
  };

  // inverse of calculateZeroAngle
  const calculateFinalAngleFromZero = zeroAngle => {
    let angle = 360 + POINTER_ANGLE - zeroAngle;
    return ((angle % 360) + 360) % 360;
  };

  spin.addEventListener('click', () => {
    if (animation) animation.cancel();

    const FULL_SPINS = 5;

    // 1️⃣ Pick winning slice index (1–6)
    const sliceCount = 6;
    const winningSlice = Math.floor(Math.random() * sliceCount) + 1;

    // 2️⃣ Find ALL ranges for that slice and calculate CENTER
    const ranges = rangeAngles.filter(r => r.index === winningSlice);

    let centerZeroAngle;
    if (ranges.length === 2) {
      // wrap-around slice (Film 1)
      centerZeroAngle =
        ((ranges[0].from + (ranges[1].to + 360)) / 2) % 360;
    } else {
      centerZeroAngle = (ranges[0].from + ranges[0].to) / 2;
    }

    // 3️⃣ Convert zeroAngle → final wheel rotation
    const targetFinalAngle =
      calculateFinalAngleFromZero(centerZeroAngle);

    // 4️⃣ Add full spins + continuity
    const currentTurns = Math.floor(previousEndDegree / 360);
    const nextTurns = currentTurns + FULL_SPINS + 1;

    const newEndDegree =
      nextTurns * 360 +
      targetFinalAngle;


    // 5️⃣ Animate
    animation = wheel.animate(
      [
        { transform: `rotate(${previousEndDegree}deg)` },
        { transform: `rotate(${newEndDegree}deg)` }
      ],
      {
        duration: 5000,
        easing: 'cubic-bezier(0.3, -0.2, 0.25, 0.95)', // last 0.5s slow creep
        fill: 'forwards'
      }
    );


    previousEndDegree = newEndDegree;

    // 6️⃣ Resolve winner (guaranteed center)
    animation.onfinish = () => {
      const finalAngle = ((newEndDegree % 360) + 360) % 360;
      const zeroAngle = calculateZeroAngle(finalAngle);

      console.log('🎯 ZERO ANGLE:', zeroAngle);
      console.log('🎯 WINNING SLICE:', winningSlice);

      const slices = wheel.querySelectorAll('.wof-slice');
      const winnerEl = slices[winningSlice - 1];

      console.log('ID:', winnerEl.dataset.wheelMovieId);
      console.log('NAME:', winnerEl.dataset.wheelMovieName);
      console.log('YEAR:', winnerEl.dataset.wheelMovieYear);
    };
  });
}

export { wheelOfFortune };
