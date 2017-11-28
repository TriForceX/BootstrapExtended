<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Website Base</title>
    
    <!-- ******** META TAGS ******** -->
	
	<!-- HTML Charset -->
	<meta charset="UTF-8">
	<!-- Mobile Enable -->
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Nav Bar Mobile Color -->
	<meta name="theme-color" content="#333333">
	<meta name="msapplication-navbutton-color" content="#333333">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<!-- Meta Details -->
	<meta name="description" content="Website based on Bootstrap with some CSS/JS/PHP improvements"/>
	<meta name="keywords" content="html, jquery, javascript, php, responsive, css3" />
	<meta name="author" content="TriForce" />
	
	<!-- ******** META TAGS ******** -->
	
	<!-- ******** CSS FILES ******** -->
	
	<!-- Tab & App Icons -->
	<link href="{{ url('assets/img/icons/favicon/all.png') }}" rel="shortcut icon">
	<link href="{{ url('assets/img/icons/favicon/apple.png') }}" rel="apple-touch-icon">
	<!-- jQuery UI CSS -->
	<link href="{{ url('assets/resources/jquery-ui/css/jquery-ui.min.css') }}" rel="stylesheet">
	<link href="{{ url('assets/resources/jquery-ui/css/jquery-ui.structure.min.css') }}" rel="stylesheet">
	<link href="{{ url('assets/resources/jquery-ui/css/jquery-ui.theme.min.css') }}" rel="stylesheet">
	<!-- Bootstrap core CSS -->
	<link href="{{ url('assets/resources/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Bootstrap theme -->
	<link href="{{ url('assets/resources/bootstrap/css/bootstrap-theme.min.css') }}" rel="stylesheet">
	<!-- Bootstrap Data Tables -->
	<link href="{{ url('assets/resources/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
	<!-- LightGallery Lightbox -->
	<link href="{{ url('assets/resources/lightgallery/css/lightgallery.css') }}" rel="stylesheet">
	<link href="{{ url('assets/resources/lightgallery/css/lg-transitions.css') }}" rel="stylesheet">
	<link href="{{ url('assets/resources/lightgallery/css/lg-fb-comment-box.css') }}" rel="stylesheet">
    <!-- Hover CSS -->
	<link href="{{ url('assets/resources/hover/css/hover.min.css') }}" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="{{ url('assets/resources/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	<!-- Main CSS File -->
    <link href="{{ url('assets/css/all.css') }}" rel="stylesheet">
	<!-- IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="{{ url('assets/resources/bootstrap/js/html5shiv.min.js') }}"></script>
	<script src="{{ url('assets/resources/bootstrap/js/respond.min.js') }}"></script>
	<![endif]-->
	
	<!-- ******** CSS FILES ******** -->
    
    
    
</head>
@if(Request::path() == '/')
<body class="JSisHome">
@else
<body>
@endif

<!-- ================================================= ANALYTICS ================================================= -->
@if(stripos(Request::ip(), '192.168.') !== false)
<script>
	function ga(){ console.log('Google Analytics:\n',arguments); } //Dont track in localhost
</script>
@else
<script>
	//Script here
</script>
@endif
<!-- ================================================= ANALYTICS ================================================= -->

<!-- ================================================= HEADER ================================================= -->
<div class="header">
    <div class="container">
        
    </div>
</div>
<!-- ================================================= HEADER ================================================= -->

@yield('content')

<!-- ================================================= FOOTER ================================================= -->
<div class="footer">
    <div class="container">
        
    </div>
</div>
<!-- ================================================= FOOTER ================================================= -->

<!-- ================ Core JavaScript Placed at the end of the document so the pages load faster! ================ -->

<!-- jQuery -->
<script src="{{ url('assets/resources/jquery/js/jquery.min.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ url('assets/resources/jquery-ui/js/jquery-ui.min.js') }}"></script>
<!-- Browser Detection over jQuery 1.9+ -->
<script src="{{ url('assets/resources/jquery-browser/js/jquery.mb.browser.min.js') }}"></script>
<!-- jQuery Cookie -->
<script src="{{ url('assets/resources/jquery-cookie/js/js.cookie.js') }}"></script>
<!-- Touch Swipe -->
<script src="{{ url('assets/resources/touchswipe/js/jquery.touchSwipe.min.js') }}"></script>
<!-- Bootstrap 3 -->
<script src="{{ url('assets/resources/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Bootstrap 3 Prompt y Confirm -->
<script src="{{ url('assets/resources/bootbox/js/bootbox.min.js') }}"></script>
<!-- Holder JS Images -->
<script src="{{ url('assets/resources/holder/js/holder.min.js') }}"></script>
<!-- Bootstrap 3 Data Tables -->
<script src="{{ url('assets/resources/datatables/js/jquery.dataTables.min.js') }}"></script>
<!-- imgLiquid Fix -->
<script src="{{ url('assets/resources/imgliquid/js/imgliquid.min.js') }}"></script>
<!-- LightGallery Lightbox -->
<script src="{{ url('assets/resources/lightgallery/js/lightgallery.js') }}"></script>
<script src="{{ url('assets/resources/lightgallery/js/lg-fullscreen.js') }}"></script>
<script src="{{ url('assets/resources/lightgallery/js/lg-thumbnail.js') }}"></script>
<script src="{{ url('assets/resources/lightgallery/js/lg-video.js') }}"></script>
<script src="{{ url('assets/resources/lightgallery/js/lg-autoplay.js') }}"></script>
<script src="{{ url('assets/resources/lightgallery/js/lg-zoom.js') }}"></script>
<script src="{{ url('assets/resources/lightgallery/js/lg-hash.js') }}"></script>
<script src="{{ url('assets/resources/lightgallery/js/lg-pager.js') }}"></script>
<!-- Clipboard JS -->
<script src="{{ url('assets/resources/clipboard/js/clipboard.min.js') }}"></script>
<!-- Masonry -->
<script src="{{ url('assets/resources/masonry/js/masonry.min.js') }}"></script>
<!-- Main JS File -->
<script src="{{ url('assets/js/all.js') }}"></script>

</body>
</html>