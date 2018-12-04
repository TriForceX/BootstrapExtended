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
	
	<!-- Apple Touch Icon -->
	<link href="{{ url('assets/img/base/favicon/apple.png') }}" rel="apple-touch-icon">
	<!-- Favicon -->
	<link href="{{ url('assets/img/base/favicon/global.png') }}" rel="icon">
	<!-- Bootstrap -->
	<link href="{{ url('assets/resources/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<!-- Data Tables Bootstrap -->
	<link href="{{ url('assets/resources/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
	<!-- Tempus Dominus -->
	<link href="{{ url('assets/resources/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
	<!-- jQuery UI -->
	<link href="{{ url('assets/resources/jquery-ui/css/jquery-ui.min.css') }}" rel="stylesheet">
	<link href="{{ url('assets/resources/jquery-ui/css/jquery-ui.structure.min.css') }}" rel="stylesheet">
	<link href="{{ url('assets/resources/jquery-ui/css/jquery-ui.theme.min.css') }}" rel="stylesheet">
	<!-- LightGallery -->
	<link href="{{ url('assets/resources/lightgallery/css/lightgallery.min.css') }}" rel="stylesheet">
	<link href="{{ url('assets/resources/lightgallery/css/lg-transitions.min.css') }}" rel="stylesheet">
	<link href="{{ url('assets/resources/lightgallery/css/lg-fb-comment-box.min.css') }}" rel="stylesheet">
    <!-- Hover CSS -->
	<link href="{{ url('assets/resources/hover/css/hover.min.css') }}" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="{{ url('assets/resources/fontawesome/css/all.min.css') }}" rel="stylesheet">
	<!-- Check Old Browser -->
	<script src="{{ url('assets/js/app-browser.js') }}"></script>
	<!-- Main CSS File -->
    <link href="{{ url('assets/css/all.css') }}" rel="stylesheet">
	
	<!-- ******** HEADER RESOURCES ******** -->
    
    <!-- Extra Code -->
	@yield('extra_code_header')
    
</head>
<body data-js-lang="en" data-js-hashtag="true" <?php echo Request::path() == '/' ? 'data-js-home="true"' : ''; ?> data-js-console="false">
<!-- ================================================= ANALYTICS ================================================= -->
@if(preg_match('/(::1|127.0.0.|192.168.|localhost|.app|.dev|.site.|.test)/i', Request::ip()))
<script>
	function ga(){ console.log('Google Analytics:\n', arguments); } //Dont track in localhost
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
<!-- Popper -->
<script src="{{ url('assets/resources/popper/js/popper.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ url('assets/resources/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Touch Swipe -->
<script src="{{ url('assets/resources/touchswipe/js/jquery.touchSwipe.min.js') }}"></script>
<!-- Bootbox -->
<script src="{{ url('assets/resources/bootbox/js/bootbox.min.js') }}"></script>
<!-- Holder -->
<script src="{{ url('assets/resources/holder/js/holder.min.js') }}"></script>
<!-- Data Tables -->
<script src="{{ url('assets/resources/datatables/js/jquery.dataTables.min.js') }}"></script>
<!-- Data Tables Bootstrap -->
<script src="{{ url('assets/resources/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Moment -->
<script src="{{ url('assets/resources/moment/js/moment.min.js') }}"></script>
<!-- Moment Locales -->
<script src="{{ url('assets/resources/moment/js/locales.min.js') }}"></script>
<!-- Tempus Dominus -->
<script src="{{ url('assets/resources/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- LightGallery -->
<script src="{{ url('assets/resources/lightgallery/js/lightgallery-all.min.js') }}"></script>
<!-- Clipboard -->
<script src="{{ url('assets/resources/clipboard/js/clipboard.min.js') }}"></script>
<!-- Masonry -->
<script src="{{ url('assets/resources/masonry/js/masonry.pkgd.min.js') }}"></script>
<!-- Images Loaded -->
<script src="{{ url('assets/resources/imagesloaded/js/imagesloaded.pkgd.min.js') }}"></script>
<!-- TinyMCE -->
<script src="{{ url('assets/resources/tinymce/js/tinymce.min.js') }}"></script>
<!-- Main JS File -->
<script src="{{ url('assets/js/all.js') }}"></script>
	
<!-- ******** FOOTER RESOURCES ******** -->

<!-- Extra Code -->
@yield('extra_code_footer')

</body>
</html>