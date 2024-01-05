jQuery(window).on('load resize', function() { 
	
	var carAnimationTop     = jQuery(".car-animation").offset().top;
	var carAnimationBottom  = carAnimationTop + jQuery(".car-animation").height();    
	var animationCounter    = 0;
	var oldScroll           = 0;
	
	if( jQuery('.car').css('width') == '300px' ) {
  	var distanceOffset = 100;
  	carWidthMultiplier = 1.3;
	} else {
  	var distanceOffset = 200;
  	carWidthMultiplier = 1.5;
	}
	
	jQuery(window).scroll(function() {
  	  var topViewportPos    = jQuery(this).scrollTop();
			var bottomViewportPos = topViewportPos + jQuery(this).height();
			var distanceScrolled  = (bottomViewportPos - distanceOffset) - carAnimationTop;
	    
			var animationCounter = distanceScrolled;
			
			if (animationCounter < 0) {
				animationCounter = 0;
			}
			
			if (animationCounter > 400) {
				animationCounter = 400;
			}
			
			var carPathWidth = (420+(carWidthMultiplier*animationCounter)) > 829 ? 829 : (420+(carWidthMultiplier*animationCounter));
			
			jQuery('.car-path').css({
				width : carPathWidth+'px'
			});
			
			var carScale = (.65 + .0009 * animationCounter) > 1 ? 1 : (.65 + .0009 * animationCounter);
			var carXPos = (-700 + 2 * animationCounter) > 0 ? 0 : (-700 + 2 * animationCounter);
			var carYPos = (-150 + .55 * animationCounter) > 0 ? 0 : (-150 + .55 * animationCounter);
			
			jQuery('.car').css({
				transform : 'scale('+carScale+') translateX('+carXPos+'px) translateY('+carYPos+'px)'
			});
	    
	    oldScroll = jQuery(this).scrollTop();
	});
});