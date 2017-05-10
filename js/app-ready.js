$(document).ready(function(){

/* ================================================= DOCUMENT READY ================================================= */

	
	//Example lightGallery Prev/Next functions
	$(document).on("onNextPageChange.lg", function(event){
		window.location.href = $(".lg-next").attr("href"); 
	});
	
	$(document).on("onPrevPageChange.lg", function(event){
		window.location.href = $(".lg-prev").attr("href");
	});
	//Example lightGallery Prev/Next functions
	
	//Example keyboard input text
	var exampleInput = 0;
	$(document).keyup(function(e){

		if(e.which == 69 && exampleInput == 0){ //E
			exampleInput = 1;
		}
		if(e.which == 88 && exampleInput == 1){ //X
			exampleInput = 2;
		}
		if(e.which == 65 && exampleInput == 2){ //A
			exampleInput = 3;
		}
		if(e.which == 77 && exampleInput == 3){ //M
			exampleInput = 4;
		}
		if(e.which == 80 && exampleInput == 4){ //P
			exampleInput = 5;
		}
		if(e.which == 76 && exampleInput == 5){ //L
			exampleInput = 6;
		}
		if(e.which == 69 && exampleInput == 6){ //E
			exampleInput = 7;
		}
		if(e.which == 13 && exampleInput == 7){ //Enter
			exampleInput = 8;
		}
		if(exampleInput == 8){
			exampleInput = 0;
			showAlert("Keyboard Input Test","You typed <b>Example</b> and then pressed <u>Enter</u> key");
		}

	});
	//Example keyboard input text
	
	//Form validation
	$(".JSformExample").validateForm();
	//Form validation
	
/* ================================================= DOCUMENT READY ================================================= */

});