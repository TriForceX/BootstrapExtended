$(document).on("responsiveCode", function(event, bodyWidth, bodyHeight, bodyOrientation, bodyScreen){
	
/* ================================================= RESPONSIVE CODE ================================================= */
	
	//Example size
	$("body").attr("window-size",bodyWidth+"x"+bodyHeight);
	
	//Example lower than tablet
	if (bodyWidth < bodyScreen.tablet)
	{
		console.log('Tablet size and lower!');
	}
	
	//Example orientation
	if(bodyOrientation){ 
		$("body").attr("window-orientation","landscape");
	}
	else{ 
		$("body").attr("window-orientation","portrait");
	}

/* ================================================= RESPONSIVE CODE ================================================= */

});