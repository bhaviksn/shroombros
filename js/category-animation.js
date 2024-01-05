jQuery( document ).ready(function() {
	let categories = document.querySelectorAll('.categories');
	let width = window.innerWidth;
	
	if (width < 977) {
		var autoPlay = true;
	} else {
		var autoPlay = false;
	}
	for (const category of categories) {
	    
	  let animationMenu = bodymovin.loadAnimation({
		  container: category,
		  renderer: 'svg',
		  loop: true,
		  autoplay: autoPlay,
		  path: category.dataset.path,
		  rendererSettings: {
	    	preserveAspectRatio: 'none'
	    }
	  });
	
	  var directionMenu = 1;
	  category.addEventListener('mouseenter', (e) => {
	    animationMenu.setDirection(directionMenu);
	    animationMenu.play();
	  });
	
		category.addEventListener('mouseleave', (e) => {
	    animationMenu.setDirection(-directionMenu);
	    animationMenu.stop();
	  });
	
	  
	};
});