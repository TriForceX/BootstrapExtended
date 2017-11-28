<?php include('functions.php'); ?>

<!DOCTYPE html>
<html lang="<?php echo php::get_html_data('lang'); ?>">
<head>
	<title><?php echo php::get_html_data('title'); ?><?php echo php::get_page_title('&raquo;'); ?></title>
	
	<!-- ******** META TAGS ******** -->
	
	<!-- HTML Charset -->
	<meta charset="<?php echo php::get_html_data('charset'); ?>">
	<!-- Mobile Enable -->
	<meta name="mobile-web-app-capable" content="<?php echo php::get_html_data('mobile-capable'); ?>">
	<meta name="apple-mobile-web-app-capable" content="<?php echo php::get_html_data('mobile-capable'); ?>">
	<meta name="viewport" content="<?php echo php::get_html_data('viewport'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Nav Bar Mobile Color -->
	<meta name="theme-color" content="<?php echo php::get_html_data('nav-color'); ?>">
	<meta name="msapplication-navbutton-color" content="<?php echo php::get_html_data('nav-color'); ?>">
	<meta name="apple-mobile-web-app-status-bar-style" content="<?php echo php::get_html_data('nav-color-apple'); ?>">
	<!-- Meta Details -->
	<meta name="description" content="<?php echo php::get_html_data('description'); ?>"/>
	<meta name="keywords" content="<?php echo php::get_html_data('keywords'); ?>" />
	<meta name="author" content="<?php echo php::get_html_data('author'); ?>" />
	
	<!-- ******** META TAGS ******** -->
	
	<!-- ******** CSS FILES ******** -->
	
	<!-- Tab & App Icons -->
	<link href="<?php echo php::get_main_url(); ?>/img/icons/favicon/all.png" rel="shortcut icon">
	<link href="<?php echo php::get_main_url(); ?>/img/icons/favicon/apple.png" rel="apple-touch-icon">
	<!-- jQuery UI CSS -->
	<link href="<?php echo php::get_main_url(); ?>/resources/jquery-ui/css/jquery-ui.min.css" rel="stylesheet">
	<link href="<?php echo php::get_main_url(); ?>/resources/jquery-ui/css/jquery-ui.structure.min.css" rel="stylesheet">
	<link href="<?php echo php::get_main_url(); ?>/resources/jquery-ui/css/jquery-ui.theme.min.css" rel="stylesheet">
	<!-- Bootstrap core CSS -->
	<link href="<?php echo php::get_main_url(); ?>/resources/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap theme -->
	<link href="<?php echo php::get_main_url(); ?>/resources/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
	<!-- Bootstrap Data Tables -->
	<link href="<?php echo php::get_main_url(); ?>/resources/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
	<!-- LightGallery Lightbox -->
	<link href="<?php echo php::get_main_url(); ?>/resources/lightgallery/css/lightgallery.css" rel="stylesheet">
	<link href="<?php echo php::get_main_url(); ?>/resources/lightgallery/css/lg-transitions.css" rel="stylesheet">
	<link href="<?php echo php::get_main_url(); ?>/resources/lightgallery/css/lg-fb-comment-box.css" rel="stylesheet">
    <!-- Hover CSS -->
	<link href="<?php echo php::get_main_url(); ?>/resources/hover/css/hover.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="<?php echo php::get_main_url(); ?>/resources/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- Main CSS File -->
	<link href="<?php echo php::get_main_url(); ?>/css/style.php" rel="stylesheet">
	<!-- IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?php echo php::get_main_url(); ?>/resources/bootstrap/js/html5shiv.min.js"></script>
	<script src="<?php echo php::get_main_url(); ?>/resources/bootstrap/js/respond.min.js"></script>
	<![endif]-->
	
	<!-- ******** CSS FILES ******** -->
</head>
<?php if(php::is_home()): ?>
<body class="JSisHome">
<?php else: ?>
<body>
<?php endif; ?>
<!-- ================================================= ANALYTICS ================================================= -->
<?php if(php::is_localhost()): ?>
<script>
	function ga(){ console.log('Google Analytics:\n',arguments); } //Dont track in localhost
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
