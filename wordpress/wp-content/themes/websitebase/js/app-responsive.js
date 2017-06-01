$(document).on("responsiveCode", function(event, bodyWidth, bodyHeight, bodyOrientation){
	
/* ================================================= RESPONSIVE CODE ================================================= */
	
	//Example size
	$("body").attr("window-size",bodyWidth+"x"+bodyHeight);
	
	//Example orientation
	if(bodyOrientation){ 
		$("body").attr("window-orientation","landscape");
	}
	else{ 
		$("body").attr("window-orientation","portrait");
	}

/* ================================================= RESPONSIVE CODE ================================================= */

});