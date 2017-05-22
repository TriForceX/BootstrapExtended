$(document).on("responsiveCode", function(event, bodyWidth, bodyHeight, bodyOrientation){
	
/* ================================================= RESPONSIVE CODE ================================================= */
	
	//Example size
	$("body").attr("window-size",bodyWidth+"x"+bodyHeight);
	
	//Example orientation
	if(bodyOrientation){ 
		$("body").attr("window-orientation","horizontal");
	}
	else{ 
		$("body").attr("window-orientation","vertical");
	}
	//Example orientation

/* ================================================= RESPONSIVE CODE ================================================= */

});