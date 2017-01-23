<?php require_once('resources/info.php'); ?>
<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<meta name="apple-mobile-web-app-capable" content="yes"><!-- iOS -->
<link rel="apple-touch-icon" href="img/favicon_ios.png"/><!-- iOS -->
<meta name="mobile-web-app-capable" content="yes">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="description" content="ejemplo"/>
<meta name="keywords" content="ejemplo" />
<meta name="author" content="ejemplo" />
<title>Site Title</title>
<link href="img/favicon.png" rel="shortcut icon">
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap theme -->
<link href="css/bootstrap-theme.min.css" rel="stylesheet">
<!-- Bootstrap Data Tables -->
<link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
<!-- jQuery UI CSS (Rename "images-dark" folder to "image" in css to use dark theme) -->
<link href="css/jquery-ui.css" rel="stylesheet">
<link href="css/jquery-ui.structure.css" rel="stylesheet">
<link href="css/jquery-ui.theme-light.css" rel="stylesheet">
<!-- CSS Dinamico -->
<link href="css/main.php?url=<?php echo $baseURL; ?>" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="js/html5shiv.min.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" href="resources/swipebox/css/swipebox.css"><!-- Swipebox Temp -->
</head>
<?php if ($baseHOME){ ?>
<body id="home" url="<?php echo $baseURL; ?>">
<?php } else { ?>
<body url="<?php echo $baseURL; ?>">
<?php }  ?>
<!-- ================================================= ANALYTICS ================================================= -->

<!-- ================================================= ANALYTICS ================================================= -->

<!-- ================================================= HEADER ================================================= -->
<?php 
/*
$menu_home = array($baseURL,"Home");
$menu_1 = array("#link","Menu 1");
$menu_2 = array("#link","Menu 2");
$menu_3 = array("#link","Menu 3");
$menu_4 = array("#link","Menu 4");
$menu_5 = array("#link","Menu 5");

echo '<a href="'.$menu_home[0].'" class="button first">'.$menu_home[1].'</a>'.
	 '<a href="'.$menu_1[0].'" class="button">'.$menu_1[1].'</a>'.
	 '<a href="'.$menu_2[0].'" class="button">'.$menu_2[1].'</a>'.
	 '<a href="'.$menu_3[0].'" class="button">'.$menu_3[1].'</a>'.
	 '<a href="'.$menu_4[0].'" class="button">'.$menu_4[1].'</a>'.
	 '<a href="'.$menu_5[0].'" class="button last">'.$menu_5[1].'</a>';
*/
?>
<div class="header">
	<div class="container">
		<!-- HEADER CONTAINER -->
    	Header
		<!-- HEADER CONTAINER -->
    </div>
</div>
<!-- ================================================= HEADER ================================================= -->