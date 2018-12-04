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
	var JSoldBrowserStyle = 'body {										'+
							'	background: white !important;			'+
							'}											'+
							'body *{									'+
							'	visibility: hidden !important; 			'+
							'}											'+
							'.JSoldBrowserElem {						'+
							'	background-color: white;				'+
							'	position: fixed;						'+
							'	display: table !important;				'+
							'	visibility: visible !important;			'+
							'	z-index: 9999;							'+
							'	top: 0px;								'+
							'	left: 0px;								'+
							'	width: 100%;							'+
							'	height: 100%;							'+
							'}											'+
							'.JSoldBrowserElem * {						'+
							'	visibility: visible !important;			'+
							'}											'+
							'.JSoldBrowserElem > div {					'+
							'	display: table-cell !important;			'+
							'	vertical-align: middle;					'+
							'	text-align: center;						'+
							'	padding: 15px;							'+
							'}											'+
							'.JSoldBrowserElem > div > a {				'+
							'	margin: 0px 5px 10px 5px;				'+
							'	display: inline-block;					'+
							'	position: relative;						'+
							'	color: black;							'+
							'}											'+
							'.JSoldBrowserElem > div > a > img {		'+
							'	width: 60px;							'+
							'	height: 60px;							'+
							'}											'+
							'.JSoldBrowserElem > div > a > span {		'+
							'	width: 60px;							'+
							'	height: 70px;							'+
							'	font-size: 11px;						'+
							'	line-height: 13px;						'+
							'	position: absolute;						'+
							'	z-index: 10;							'+
							'	background: white;						'+
							'	padding: 5px 0px;						'+
							'	display: none;							'+
							'}											'+
							'.JSoldBrowserElem > div > a:hover > span {	'+
							'	display: block;							'+
							'}											';

	// Set style type
	JSoldBrowserCSS.type = 'text/css';

	// Set to IExplorer or other browsers
	if(JSoldBrowserCSS.styleSheet) JSoldBrowserCSS.styleSheet.cssText = JSoldBrowserStyle;
	else JSoldBrowserCSS.appendChild(document.createTextNode(JSoldBrowserStyle));

	// Append to head
	document.getElementsByTagName('head')[0].appendChild(JSoldBrowserCSS);

	// Append when body loads
	window.onload = function(){
		// Set browser screen element
		var JSoldBrowserElem = '<div class="JSoldBrowserElem">'+
								'	<div>'+
								'		<h1>Update your browser</h1>'+
								'		<p>You are using an old browser, please update.</p>'+
								'		<a target="_blank" href="https://www.mozilla.org/firefox/new">'+
								'			<img src="'+JSoldBrowserURL+'/img/base/browser/firefox.png">'+
								'			<span>Mozilla Firefox</span>'+
								'		</a>'+
								'		<a target="_blank" href="https://www.google.com/chrome">'+
								'			<img src="'+JSoldBrowserURL+'/img/base/browser/chrome.png">'+
								'			<span>Google Chrome</span>'+
								'		</a>'+
								'		<a target="_blank" href="https://www.opera.com/download">'+
								'			<img src="'+JSoldBrowserURL+'/img/base/browser/opera.png">'+
								'			<span>Opera Browser</span>'+
								'		</a>'+
								'		<a target="_blank" href="https://www.microsoft.com/en-us/download/internet-explorer-11-for-windows-7-details.aspx">'+
								'			<img src="'+JSoldBrowserURL+'/img/base/browser/iexplorer.png">'+
								'			<span>Internet Explorer 11</span>'+
								'		</a>'+
								'	</div>'+
								'</div>';
		
		// Append element to body
		document.body.innerHTML += JSoldBrowserElem;
	};
}

// Check browser
function JSoldBrowserCheck(system)
{
	// Defaults
	var detect = null;
	var get = null;
	var version = -1;
	
	// Checks
	if(system == 'iexplorer')
	{
		if(navigator.appName == 'Microsoft Internet Explorer')
		{
		  detect = navigator.userAgent;
		  get  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
		  if(get.exec(detect) != null)
		  {
			  version = parseFloat(RegExp.$1);
		  }
		}
	}
	else if(system == 'ios')
	{
		if(/iP(hone|od|ad)/.test(navigator.platform))
		{
			detect = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/);
			get = [parseInt(detect[1], 10), parseInt(detect[2], 10), parseInt(detect[3] || 0, 10)];
			version = get[0];
		}
	}
	
	return version;
}

// Do check version
if((JSoldBrowserCheck('iexplorer') > -1 && JSoldBrowserCheck('iexplorer') <= 10.0) || (JSoldBrowserCheck('ios') > -1 && JSoldBrowserCheck('ios') < 7))
{
	JSoldBrowserScreen();
}
		
/* ================================================= BASE BROWSER ================================================= */
