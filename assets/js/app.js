// Global variables
var consoleLog = 0;
var rootStyles = getComputedStyle(document.documentElement);
var screenWidth = document.body.screenWidth;
var screenHeight = document.documentElement.screenHeight;
var screenSize = {'xs'  : { 'up' : 575.98, 'down' : 576 },
				  'sm'  : { 'up' : 767.98, 'down' : 768 },
				  'md'  : { 'up' : 991.98, 'down' : 992 },
				  'lg'  : { 'up' : 1199.98, 'down' : 1200 },
				  'xl'  : { 'up' : 1359.98, 'down' : 1366 },
				  'xxl' : { 'up' : 1399.98, 'down' : 1400 }};

// On resize
window.onresize = function() {
	screenWidth = document.body.screenWidth;
	screenHeight = document.documentElement.screenHeight;
	/*
	// Responsive check
	if (screenWidth < screenSize.lg.up) {
		... more than ...
	}
	*/
};

// On load
window.onload = function() {
    /*
	// Responsive check
	if (screenWidth < screenSize.lg.up) {
		... more than ...
	}
	*/
};

// On ready
window.addEventListener("DOMContentLoaded", function() { 
	/*
	// Responsive check
	if (screenWidth < screenSize.lg.up) {
		... more than ...
	}
	*/
	// Enable tooltip
	const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
	const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
	
});

// On scroll
window.onscroll = function() {
	/*
	// Responsive check
	if (screenWidth < screenSize.lg.up) {
		... more than ...
	}
	*/
};