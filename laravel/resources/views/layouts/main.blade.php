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
	<meta name="description" content="Website based on Bootstrap with some CSS/JS/PHP improvements">
	<meta name="keywords" content="html, jquery, javascript, php, responsive, css3">
	<meta name="author" content="TriForce">
	
	<!-- ******** META TAGS ******** -->
	
	<!-- ******** HEADER RESOURCES ******** -->
	
	<!-- Nav Tab & App Icons -->
	<link href="{{ url('assets/img/icons/favicon/apple.png') }}" rel="apple-touch-icon">
	<link href="{{ url('assets/img/icons/favicon/global.png') }}" rel="shortcut icon">
	<!-- jQuery UI -->
	<link href="{{ url('assets/resources/jquery-ui/css/jquery-ui.min.css') }}" rel="stylesheet">
	<link href="{{ url('assets/resources/jquery-ui/css/jquery-ui.structure.min.css') }}" rel="stylesheet">
	<link href="{{ url('assets/resources/jquery-ui/css/jquery-ui.theme.min.css') }}" rel="stylesheet">
	<!-- Bootstrap Core -->
	<link href="{{ url('assets/resources/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Bootstrap Theme -->
	<!-- <link href="{{ url('assets/resources/bootstrap/css/bootstrap-theme.min.css') }}" rel="stylesheet"> -->
	<!-- Bootstrap Data Tables -->
	<link href="{{ url('assets/resources/datatables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
	<!-- Bootstrap Date Picker -->
	<link href="{{ url('assets/resources/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
	<!-- Bootstrap Time Picker -->
	<link href="{{ url('assets/resources/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet">
	<!-- LightGallery Lightbox -->
	<link href="{{ url('assets/resources/lightgallery/css/lightgallery.min.css') }}" rel="stylesheet">
	<link href="{{ url('assets/resources/lightgallery/css/lg-transitions.min.css') }}" rel="stylesheet">
	<link href="{{ url('assets/resources/lightgallery/css/lg-fb-comment-box.min.css') }}" rel="stylesheet">
    <!-- Hover CSS -->
	<link href="{{ url('assets/resources/hover/css/hover.min.css') }}" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="{{ url('assets/resources/font-awesome/css/all.css') }}" rel="stylesheet">
	<!-- Main CSS File -->
    <link href="{{ url('assets/css/all.css') }}" rel="stylesheet">
	<!-- IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="{{ url('assets/resources/html5shiv/js/html5shiv.min.js') }}"></script>
	<script src="{{ url('assets/resources/respond/js/respond.min.js') }}"></script>
	<script src="{{ url('assets/resources/rem/js/rem.js') }}"></script>
	<![endif]-->
	
	<!-- ******** HEADER RESOURCES ******** -->
    
    <!-- Extra Code -->
	@yield('extra_code_header')
    
</head>

<body class="<?php echo Request::path() == '/' ? 'JSisHome' : ''; ?>">
<!-- ================================================= ANALYTICS ================================================= -->
@if(preg_match('/(::1|127.0.0.|192.168.|localhost|.app|.dev|.site.|.test)/i', Request::ip()))
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
		<!-- HEADER CONTAINER -->
    	
		<!-- HEADER CONTAINER -->
    </div>
</div>
<!-- ================================================= HEADER ================================================= -->

@yield('content')

<!-- ================================================= FOOTER ================================================= -->
<div class="footer">
	<div class="container">
		<!-- FOOTER CONTAINER -->
		
		<!-- FOOTER CONTAINER -->
    </div>
</div>
<!-- ================================================= FOOTER ================================================= -->

<!-- ******** FOOTER RESOURCES ******** -->

<!-- jQuery -->
<script src="{{ url('assets/resources/jquery/js/jquery.min.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ url('assets/resources/jquery-ui/js/jquery-ui.min.js') }}"></script>
<!-- jQuqey Browser -->
<script src="{{ url('assets/resources/jquery-browser/js/jquery.mb.browser.min.js') }}"></script>
<!-- jQuery Cookie -->
<script src="{{ url('assets/resources/jquery-cookie/js/js.cookie.js') }}"></script>
<!-- jQuery Fullscreen -->
<script src="{{ url('assets/resources/jquery-fullscreen/js/jquery.fullscreen.min.js') }}"></script>
<!-- jQuery Rotate -->
<script src="{{ url('assets/resources/jquery-rotate/js/jQueryRotate.js') }}"></script>
<!-- Touch Swipe -->
<script src="{{ url('assets/resources/touchswipe/js/jquery.touchSwipe.min.js') }}"></script>
<!-- Bootstrap 3 -->
<script src="{{ url('assets/resources/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Bootbox Modals -->
<script src="{{ url('assets/resources/bootbox/js/bootbox.min.js') }}"></script>
<!-- Holder JS -->
<!--[if gt IE 8]><!-- -->
<script src="{{ url('assets/resources/holder/js/holder.min.js') }}"></script>
<!--<![endif]-->
<!-- Bootstrap Data Tables -->
<script src="{{ url('assets/resources/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('assets/resources/datatables/js/dataTables.bootstrap.min.js') }}"></script>
<!-- Bootstrap Date Picker -->
<script src="{{ url('assets/resources/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap Time Picker -->
<script src="{{ url('assets/resources/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
<!-- imgLiquid -->
<script src="{{ url('assets/resources/imgliquid/js/imgliquid.min.js') }}"></script>
<!-- LightGallery Lightbox -->
<!--[if lt IE 9]>
<script src="{{ url('assets/resources/lightgallery/js/lightgallery.js') }}"></script>
<![endif]-->
<!--[if gt IE 8]><!-- -->
<script src="{{ url('assets/resources/lightgallery/js/lightgallery-all.min.js') }}"></script>
<!--<![endif]-->
<!-- Clipboard JS -->
<script src="{{ url('assets/resources/clipboard/js/clipboard.min.js') }}"></script>
<!-- Masonry -->
<script src="{{ url('assets/resources/masonry/js/masonry.min.js') }}"></script>
<!-- TinyMCE -->
<script src="{{ url('assets/resources/tinymce/js/tinymce.min.js') }}"></script>
<!-- Main JS File -->
<script src="{{ url('assets/js/all.js') }}"></script>
	
<!-- ******** FOOTER RESOURCES ******** -->

<!-- Extra Code -->
@yield('extra_code_footer')

</body>
</html>