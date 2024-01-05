jQuery( document ).ready(function() {
	
	jQuery.ajax({
     type : "post",
     dataType : "json",
     url : '/custom-scripts/countdown.php',
     success: function(response) {
	     console.log(response);
        jQuery(".shipping-counter").html(response.text);
     }
  });
	
/*
	setInterval( function() { 
		jQuery.ajax({
	     type : "post",
	     dataType : "json",
	     url : myAjax.ajaxurl,
			 data : {action: "sb_shipping_counter"},
	     success: function(response) {
	     console.log(response);
	        jQuery(".shipping-counter").html(response.text);
	     }
	  });
	}, 60000);
*/
	
});