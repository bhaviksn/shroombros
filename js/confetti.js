jQuery( document ).ready(function() {	
	var colors = ["#E5339E", "#6EECE7"];
	
	var duration = 25 * 1000;
	var end = Date.now() + duration;
	
	myCanvas = document.querySelector('.confetti');
	
	var myConfetti = confetti.create(myCanvas, {
	  resize: true,
	  useWorker: false
	});
	
	function frame() {
	  myConfetti({
	    particleCount: 2,
	    spread: 400,
	    colors: colors,
	    origin: { y:0 },
	    disableForReducedMotion: true,
	  });
	/*
	  confetti({
	    particleCount: 2,
	    angle: 60,
	    spread: 100,
	    startVelocity: 15,
	    origin: { x: 0 },
	    colors: colors,
	    disableForReducedMotion: true,
	  });
	  confetti({
	    particleCount: 2,
	    angle: 120,
	    spread: 100,
	    startVelocity: 15,
	    origin: { x: 1 },
	    colors: colors,
	    disableForReducedMotion: true,
	  });
	*/
	
	  if (Date.now() < end) {
	    requestAnimationFrame(frame);
	  }
	}
	
	window.onload = frame();
});