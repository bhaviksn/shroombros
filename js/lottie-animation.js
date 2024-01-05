jQuery( document ).ready(function() {	
	
	let banner = document.querySelector('.animated-banner-logo');
	    
	let animationBanner = bodymovin.loadAnimation({
	  container: banner,
	  renderer: 'svg',
	  loop: true,
	  autoplay: true,
	  path: banner.dataset.animation,
	});
	
	let treeCar = document.querySelector('.trees-car');
	    
	let animationTreeCar = bodymovin.loadAnimation({
	  container: treeCar,
	  renderer: 'svg',
	  loop: true,
	  autoplay: true,
	  path: treeCar.dataset.animation,
	  rendererSettings: {
	  	preserveAspectRatio: 'none'
	  }
	});
});