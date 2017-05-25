<?php 
//Main Functions
require_once('plugins/functions-base.php');

//HTML Data
$htmlData = array('lang'=>'en',
				  'charset'=>'utf-8',
				  'title'=>'Website Base',
				  'mobile-capable'=>'yes',
				  'viewport'=>'width=device-width, initial-scale=1, user-scalable=no',
				  'nav-color'=>'#333333',
				  'nav-color-apple'=>'black',
				  'description'=>'Website based on Bootstrap with some CSS/JS/PHP improvements',
				  'keywords'=>'html, jquery, javascript, php, responsive, css3',
				  'author'=>'TriForce');
?>
<!DOCTYPE html>
<html lang="<?php echo $htmlData['lang']; ?>">
<head>
	<title><?php echo $htmlData['title']; ?><?php echo get_pagetitle(); ?></title>
	
	<!-- ******** META TAGS ******** -->
	
	<!-- HTML Charset -->
	<meta charset="<?php echo $htmlData['charset']; ?>">
	<!-- Mobile Enable -->
	<meta name="mobile-web-app-capable" content="<?php echo $htmlData['mobile-capable']; ?>">
	<meta name="apple-mobile-web-app-capable" content="<?php echo $htmlData['mobile-capable']; ?>">
	<meta name="viewport" content="<?php echo $htmlData['viewport']; ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Nav Bar Mobile Color -->
	<meta name="theme-color" content="<?php echo $htmlData['nav-color']; ?>">
	<meta name="msapplication-navbutton-color" content="<?php echo $htmlData['nav-color']; ?>">
	<meta name="apple-mobile-web-app-status-bar-style" content="<?php echo $htmlData['nav-color-apple']; ?>">
	<!-- Meta Details -->
	<meta name="description" content="<?php echo $htmlData['description']; ?>"/>
	<meta name="keywords" content="<?php echo $htmlData['keywords']; ?>" />
	<meta name="author" content="<?php echo $htmlData['author']; ?>" />
	
	<!-- ******** META TAGS ******** -->
	
	<!-- ******** CSS FILES ******** -->
	
	<!-- Tab & App Icons -->
	<link href="<?php echo get_bloginfo('template_url'); ?>/css/icons/favicon/favicon.png" rel="shortcut icon">
	<link href="<?php echo get_bloginfo('template_url'); ?>/css/icons/favicon/favicon-apple.png" rel="apple-touch-icon"/>
	<!-- jQuery UI CSS -->
	<link href="<?php echo get_bloginfo('template_url'); ?>/plugins/jquery-ui/css/jquery-ui.min.css" rel="stylesheet">
	<link href="<?php echo get_bloginfo('template_url'); ?>/plugins/jquery-ui/css/jquery-ui.structure.min.css" rel="stylesheet">
	<link href="<?php echo get_bloginfo('template_url'); ?>/plugins/jquery-ui/css/jquery-ui.theme.min.css" rel="stylesheet">
	<!-- Bootstrap core CSS -->
	<link href="<?php echo get_bloginfo('template_url'); ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Bootstrap theme -->
	<link href="<?php echo get_bloginfo('template_url'); ?>/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
	<!-- Bootstrap Data Tables -->
	<link href="<?php echo get_bloginfo('template_url'); ?>/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
	<!-- LightGallery Lightbox -->
	<link href="<?php echo get_bloginfo('template_url'); ?>/plugins/lightgallery/css/lightgallery.css" rel="stylesheet">
	<link href="<?php echo get_bloginfo('template_url'); ?>/plugins/lightgallery/css/lg-transitions.css" rel="stylesheet">
	<link href="<?php echo get_bloginfo('template_url'); ?>/plugins/lightgallery/css/lg-fb-comment-box.css" rel="stylesheet">
    <!-- Hover CSS -->
	<link href="<?php echo get_bloginfo('template_url'); ?>/plugins/hover/css/hover.min.css" rel="stylesheet">
	<!-- Main CSS File -->
	<link href="<?php echo get_bloginfo('template_url'); ?>/css/style.php?url=<?php echo get_bloginfo('template_url'); ?>" rel="stylesheet">
	<!-- IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?php echo get_bloginfo('template_url'); ?>/plugins/bootstrap/js/html5shiv.min.js"></script>
	<script src="<?php echo get_bloginfo('template_url'); ?>/plugins/bootstrap/js/respond.min.js"></script>
	<![endif]-->
	
	<!-- ******** CSS FILES ******** -->
	
	<?php
	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	if (function_exists('wp_head')){
		wp_head();
	}
	?>
</head>
<?php if(is_home()): ?>
<body class="isHome">
<?php else: ?>
<body>
<?php endif; ?>
<!-- ================================================= ANALYTICS ================================================= -->
<?php if(is_localhost()): ?>
<?php echo "\n"; //Dont track in localhost ?>
<?php else: ?>
<?php echo "\n"; ?>
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