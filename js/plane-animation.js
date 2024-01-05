jQuery( document ).ready(function() {	
	
	let plane = document.querySelector('.plane');
	    
	let animationPlane = bodymovin.loadAnimation({
	  container: plane,
	  renderer: 'svg',
	  loop: true,
	  autoplay: true,
	  path: plane.dataset.animation,
	  rendererSettings: {
	  	preserveAspectRatio: 'none'
	  }
	});
});