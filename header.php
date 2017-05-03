<?php require_once('resources/functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Site Title</title>
<meta charset="utf-8">
<!-- Mobile Enable -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Nav Bar Mobile Color -->
<meta name="theme-color" content="#333333">
<meta name="msapplication-navbutton-color" content="#333333">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<!-- Meta Details -->
<meta name="description" content="ejemplo"/>
<meta name="keywords" content="ejemplo" />
<meta name="author" content="ejemplo" />
<!-- Tab & App Icons -->
<link href="img/favicon.png" rel="shortcut icon">
<link href="img/favicon_ios.png" rel="apple-touch-icon"/>
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap theme -->
<link href="css/bootstrap-theme.min.css" rel="stylesheet">
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
<!-- Bootstrap Data Tables -->
<link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
<!-- jQuery UI CSS (Rename "images-dark" folder to "image" in css to use dark theme) -->
<link href="css/jquery-ui.css" rel="stylesheet">
<link href="css/jquery-ui.structure.css" rel="stylesheet">
<link href="css/jquery-ui.theme-light.css" rel="stylesheet">
<!-- LightGallery Lightbox -->
<link href="css/lightgallery.css" rel="stylesheet">
<link href="css/lg-transitions.css" rel="stylesheet">
<link href="css/lg-fb-comment-box.css" rel="stylesheet">
<!-- CSS Dynamic -->
<link href="css/main.php?url=<?php echo $baseURL; ?>" rel="stylesheet">
<!-- IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="js/html5shiv.min.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
</head>
<?php if($baseHOME): ?>
<body id="home">
<?php else: ?>
<body>
<?php endif; ?>
<!-- ================================================= ANALYTICS ================================================= -->
<?php if($_SERVER['HTTP_HOST'] == 'localhost' OR filter_var($_SERVER['HTTP_HOST'], FILTER_VALIDATE_IP)): ?>
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