<?php include('functions.php'); ?>
<!DOCTYPE html>
<html lang="<?php echo php::get_data('lang'); ?>">
<head>
	<title><?php echo php::get_data('title'); ?><?php echo php::get_page_title('&raquo;','page'); ?></title>
	
	<!-- ******** META TAGS ******** -->
	
	<!-- HTML Charset -->
	<meta charset="<?php echo php::get_data('charset'); ?>">
	<!-- Mobile Enable -->
	<meta name="mobile-web-app-capable" content="<?php echo php::get_data('mobile-capable'); ?>">
	<meta name="apple-mobile-web-app-capable" content="<?php echo php::get_data('mobile-capable'); ?>">
	<meta name="viewport" content="<?php echo php::get_data('viewport'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Nav Bar Mobile Color -->
	<meta name="theme-color" content="<?php echo php::get_data('nav-color'); ?>">
	<meta name="msapplication-navbutton-color" content="<?php echo php::get_data('nav-color'); ?>">
	<meta name="apple-mobile-web-app-status-bar-style" content="<?php echo php::get_data('nav-color-apple'); ?>">
	<!-- Meta Details -->
	<meta name="description" content="<?php echo php::get_data('description'); ?>">
	<meta name="keywords" content="<?php echo php::get_data('keywords'); ?>">
	<meta name="author" content="<?php echo php::get_data('author'); ?>">
	
	<!-- ******** META TAGS ******** -->
	
	<!-- ******** HEADER RESOURCES ******** -->
	
	<!-- Favicon -->
	<link href="<?php echo php::get_main_url(); ?>/img/base/favicon/all.png" rel="icon">
	<!-- Apple Touch Icon -->
	<link href="<?php echo php::get_main_url(); ?>/img/base/favicon/apple.png" rel="apple-touch-icon">
	<!-- Bootstrap -->
	<link href="<?php echo php::get_main_url(); ?>/resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Data Tables Bootstrap -->
	<link href="<?php echo php::get_main_url(); ?>/resources/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<!-- Tempus Dominus -->
	<link href="<?php echo php::get_main_url(); ?>/resources/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">
	<!-- jQuery UI -->
	<link href="<?php echo php::get_main_url(); ?>/resources/jquery-ui/css/jquery-ui.min.css" rel="stylesheet">
	<link href="<?php echo php::get_main_url(); ?>/resources/jquery-ui/css/jquery-ui.structure.min.css" rel="stylesheet">
	<link href="<?php echo php::get_main_url(); ?>/resources/jquery-ui/css/jquery-ui.theme.min.css" rel="stylesheet">
	<!-- LightGallery -->
	<link href="<?php echo php::get_main_url(); ?>/resources/lightgallery/css/lightgallery.min.css" rel="stylesheet">
	<link href="<?php echo php::get_main_url(); ?>/resources/lightgallery/css/lg-transitions.min.css" rel="stylesheet">
	<link href="<?php echo php::get_main_url(); ?>/resources/lightgallery/css/lg-fb-comment-box.min.css" rel="stylesheet">
    <!-- Hover CSS -->
	<link href="<?php echo php::get_main_url(); ?>/resources/hover/css/hover.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="<?php echo php::get_main_url(); ?>/resources/fontawesome/css/all.min.css" rel="stylesheet">
	<!-- Check Old Browser -->
	<script src="<?php echo php::get_main_url(); ?>/js/app-browser.js"></script>
	<!-- Main CSS File -->
	<?php echo php::get_template('css'); ?>
	
	<!-- ******** HEADER RESOURCES ******** -->
	
	<!-- Extra Code -->
	<?php echo php::section('header','get'); ?>
	
</head>
<body data-js-lang="en" data-js-hashtag="true" <?php echo php::is_home() ? 'data-js-home="true"' : ''; ?> data-js-console="false">
<!-- ================================================= ANALYTICS ================================================= -->
<?php if(php::is_localhost()): ?>
<script>
	function ga(){ console.log('Google Analytics:\n', arguments); } //Dont track in localhost
</script>
<?php else: ?>
<?php echo php::convert_to_utf8('<script></script>')."\n"; ?>
<?php endif; ?>
<!-- ================================================= ANALYTICS ================================================= -->

<!-- ================================================= HEADER ================================================= -->
<div class="header">
	<div class="container">
		<!-- HEADER CONTAINER -->
    	
		<!-- HEADER CONTAINER -->
    </div>
</div>
<!-- ================================================= HEADER ================================================= -->
