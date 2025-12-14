function wheelOfFortune(selector) {
  const node = document.querySelector(selector);
  if (!node) return;

  const spin = node.parentElement.querySelector('.wof-start-game');
  const wheel = node;

  let animation;
  let previousEndDegree = 0;

  spin.addEventListener('click', () => {

    if (animation) animation.cancel();

    const randomAdditionalDegrees = Math.random() * 360 + 1800;
    const newEndDegree = previousEndDegree + randomAdditionalDegrees;

    animation = wheel.animate([
      { transform: `rotate(${previousEndDegree}deg)` },
      { transform: `rotate(${newEndDegree}deg)` }
    ], {
      duration: 4000,
      easing: 'cubic-bezier(0.440, -0.205, 0.000, 1.130)',
      fill: 'forwards'
    });

    previousEndDegree = newEndDegree;

    const rangeAngles = [
      {index: "Film 1", from: 345, to: 360},
      {index: "Film 1", from: 0, to: 15},
      {index: "Film 2", from: 15, to: 75},
      {index: "Film 3", from: 75, to: 135},
      {index: "Film 4", from: 135, to: 195},
      {index: "Film 5", from: 195, to: 255},
      {index: "Film 6", from: 255, to: 345}
    ];

    const calculateZeroAngle = finalAngle => {
      let zeroAngle = 360 - finalAngle + 90;
      zeroAngle = ((zeroAngle % 360) + 360) % 360;
      return Math.round(zeroAngle * 10) / 10;
    };

    animation.onfinish = () => {
      const finalAngle = ((newEndDegree % 360) + 360) % 360;
      const zeroAngle = calculateZeroAngle(finalAngle);
      const winner = rangeAngles.find(a => a.from < zeroAngle && a.to >= zeroAngle);
      alert(`Pobednik Je: ${winner ? winner.index : 'unknown'}`);
    };
  });
}

wheelOfFortune('.wof-wheel-imgs-holder');
