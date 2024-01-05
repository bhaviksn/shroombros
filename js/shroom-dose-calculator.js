jQuery(document).on('click','.shroom-dose-submit',function(event){
	event.preventDefault();
	
	jQuery('.number').text(0);
	
	var doseArray = {'micro': [], 'low': [], 'normal': [], 'high': []}
	doseArray.micro.push({'min':40,'max':50,'dose':0.1});
	doseArray.micro.push({'min':51,'max':90,'dose':0.2});
	doseArray.micro.push({'min':91,'max':120,'dose':0.3});
	doseArray.micro.push({'min':121,'max':999,'dose':0.4});
	
	doseArray.low.push({'min':40,'max':50,'dose':0.5});
	doseArray.low.push({'min':51,'max':60,'dose':0.7});
	doseArray.low.push({'min':61,'max':70,'dose':0.8});
	doseArray.low.push({'min':71,'max':80,'dose':0.9});
	doseArray.low.push({'min':81,'max':85,'dose':1});
	doseArray.low.push({'min':86,'max':90,'dose':1.1});
	doseArray.low.push({'min':91,'max':100,'dose':1.3});
	doseArray.low.push({'min':100,'max':999,'dose':1.5});
	
	doseArray.normal.push({'min':40,'max':44,'dose':1.2});
	doseArray.normal.push({'min':45,'max':51,'dose':1.5});
	doseArray.normal.push({'min':52,'max':56,'dose':1.6});
	doseArray.normal.push({'min':57,'max':59,'dose':1.7});
	doseArray.normal.push({'min':60,'max':65,'dose':1.9});
	doseArray.normal.push({'min':65,'max':70,'dose':2.1});
	doseArray.normal.push({'min':71,'max':75,'dose':2.3});
	doseArray.normal.push({'min':76,'max':80,'dose':2.4});
	doseArray.normal.push({'min':81,'max':85,'dose':2.5});
	doseArray.normal.push({'min':86,'max':90,'dose':2.6});
	doseArray.normal.push({'min':91,'max':100,'dose':3});
	doseArray.normal.push({'min':101,'max':999,'dose':3.5});
	
	doseArray.high.push({'min':40,'max':44,'dose':2.2});
	doseArray.high.push({'min':45,'max':51,'dose':2.5});
	doseArray.high.push({'min':52,'max':56,'dose':2.6});
	doseArray.high.push({'min':57,'max':59,'dose':2.7});
	doseArray.high.push({'min':60,'max':65,'dose':2.9});
	doseArray.high.push({'min':65,'max':70,'dose':3.1});
	doseArray.high.push({'min':71,'max':75,'dose':3.5});
	doseArray.high.push({'min':76,'max':80,'dose':3.5});
	doseArray.high.push({'min':81,'max':85,'dose':3.75});
	doseArray.high.push({'min':86,'max':90,'dose':3.75});
	doseArray.high.push({'min':91,'max':100,'dose':4});
	doseArray.high.push({'min':101,'max':999,'dose':4.5});
	
	var dose = jQuery('input[name="dose"]:checked').val();
	var weight = jQuery('input[name="weight"]').val();

	if (dose == 'micro') {
		for (const dosage of doseArray.micro) {
	
			if (weight >= dosage.min && weight <= dosage.max) {
				console.log(dosage.dose);
				jQuery('.number').text(dosage.dose);
			}	
		  
		}
	}

	if (dose == 'low') {
		for (const dosage of doseArray.low) {
		
			if (weight >= dosage.min && weight <= dosage.max) {
				console.log(dosage.dose);
				jQuery('.number').text(dosage.dose);
			}	
		  
		}
	}

	if (dose == 'normal') {
		for (const dosage of doseArray.normal) {
		
			if (weight >= dosage.min && weight <= dosage.max) {
				console.log(dosage.dose);
				jQuery('.number').text(dosage.dose);
			}	
		  
		}
	}

	if (dose == 'high') {
		for (const dosage of doseArray.high) {
	
			if (weight >= dosage.min && weight <= dosage.max) {
				console.log(dosage.dose);
				jQuery('.number').text(dosage.dose);
			}	
		  
		}
	}

});