jQuery( document ).ready(function() {	
	
	let tree = document.querySelector('.trees');
	    
	let animationTree = bodymovin.loadAnimation({
	  container: tree,
	  renderer: 'svg',
	  loop: true,
	  autoplay: true,
	  path: tree.dataset.animation,
	  rendererSettings: {
	  	preserveAspectRatio: 'none'
	  }
	});
});