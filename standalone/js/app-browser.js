/* ================================================= BASE BROWSER ================================================= */

// Update browser screen
function JSoldBrowserScreen()
{
	// Create style element
	var JSoldBrowserCSS = document.createElement('style');

	// Get main URL from SRC
	var JSoldBrowserNUM = document.getElementsByTagName('script').length - 1;
	var JSoldBrowserURL = document.getElementsByTagName('script')[JSoldBrowserNUM].getAttribute('src').replace(/\/js\/app-browser.js/g,'');

	// Set style code
	var JSoldBrowserStyle = 'body {								'+
							'	background: white !important;	'+
							'}									'+
							'body *{							'+
							'	visibility: hidden !important 	'+
							'}									'+
							'.JSoldBrowserElem {				'+
							'	background-color: white;		'+
							'	position: fixed;				'+
							'	display: table !important;		'+
							'	visibility: visible !important;	'+
							'	z-index: 9999;					'+
							'	top: 0px;						'+
							'	left: 0px;						'+
							'	width: 100%;					'+
							'	height: 100%;					'+
							'}									'+
							'.JSoldBrowserElem * {				'+
							'	visibility: visible !important;	'+
							'}									'+
							'.JSoldBrowserElem > div {			'+
							'	display: table-cell !important;	'+
							'	vertical-align: middle;			'+
							'	text-align: center;				'+
							'	padding: 15px;					'+
							'}									'+
							'.JSoldBrowserElem > div > a {		'+
							'	margin: 0px 5px 10px 5px;		'+
							'	display: inline-block;			'+
							'}									'+
							'.JSoldBrowserElem > div > a > img {'+
							'	width: 60px;					'+
							'	height: 60px;					'+
							'}									';

	// Set style type
	JSoldBrowserCSS.type = 'text/css';

	// Set to IExplorer or other browsers
	if(JSoldBrowserCSS.styleSheet) JSoldBrowserCSS.styleSheet.cssText = JSoldBrowserStyle;
	else JSoldBrowserCSS.appendChild(document.createTextNode(JSoldBrowserStyle));

	// Append to head
	document.getElementsByTagName('head')[0].appendChild(JSoldBrowserCSS);

	// Append when body loads
	window.onload = function(){
		// Set browser URL
		var JSoldBrowserLinks = { 0 : { 'name' : 'firefox' , 'url' : 'https://www.mozilla.org/firefox/new' },
								  1 : { 'name' : 'chrome' , 'url' : 'https://www.google.com/chrome' },
								  2 : { 'name' : 'opera' , 'url' : 'https://www.opera.com/download' },
								  3 : { 'name' : 'edge' , 'url' : 'https://www.microsoft.com/en-us/download/internet-explorer.aspx' } };
		
		// Set browser screen element
		var JSoldBrowserElem = '<div class="JSoldBrowserElem">'+
								'	<div>'+
								'		<h1>Update your browser</h1>'+
								'		<p>You are using an old browser, please update.</p>'+
								'		<a href="'+JSoldBrowserLinks[0].url+'" target="_blank"><img src="'+JSoldBrowserURL+'/img/base/browser/'+JSoldBrowserLinks[0].name+'.png"></a>'+
								'		<a href="'+JSoldBrowserLinks[1].url+'" target="_blank"><img src="'+JSoldBrowserURL+'/img/base/browser/'+JSoldBrowserLinks[1].name+'.png"></a>'+
								'		<a href="'+JSoldBrowserLinks[2].url+'" target="_blank"><img src="'+JSoldBrowserURL+'/img/base/browser/'+JSoldBrowserLinks[2].name+'.png"></a>'+
								'		<a href="'+JSoldBrowserLinks[3].url+'" target="_blank"><img src="'+JSoldBrowserURL+'/img/base/browser/'+JSoldBrowserLinks[3].name+'.png"></a>'+
								'	</div>'+
								'</div>';
		
		// Append element to body
		document.body.innerHTML += JSoldBrowserElem;
	};
}

//JSoldBrowserScreen();
		
/* ================================================= BASE BROWSER ================================================= */
