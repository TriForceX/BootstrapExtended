<?php include('header.php'); ?>

<!-- ================================================= CONTENT ================================================= -->
<div class="content">
	<div class="container">
		<?php 
		/*
		require_once('resources/curl.php');
		$url = "http://www.examplesite.com";
		$data = LoadCURLPage($url);
		$string_one = '<!-- initContent -->';
		$string_two = '<!-- endContent -->';
		$info = extract_unit($data, $string_one, $string_two);
		echo $info;
		*/
		?>
		<!-- CONTENT CONTAINER -->
		Content, you can take a look in <b>Bootsptrap</b> example 1 <a href="_bootstrap1.php" target="_blank">here</a>, or example 2 <a href="_bootstrap2.php" target="_blank">here</a>
		<!-- CONTENT CONTAINER -->
   		<!-- LIGHTGALLERY CONTAINER MANUALLY -->
   		<p class="lightgallery" lg-selector="a" lg-autolink="false" lg-autotitle="false" lg-thumbnail="false">
   			<a href="http://files.vladstudio.com/joy/where_tahrs_live/wall/vladstudio_where_tahrs_live_800x600_signed.jpg">
   				<img style="width: 100px" src="http://www.dailymobile.net/wp-content/uploads/wallpapers/landscape-wallpapers-320x240/nokia-320x240-wallpaper-2363.jpg">
			</a>
			<a href="http://www.hdfondos.eu/pictures/2014/0315/1/new-york-sunset-hd-wallpaper-4325.jpg">
   				<img style="width: 100px" src="https://s-media-cache-ak0.pinimg.com/564x/2c/cd/16/2ccd161ecb5634004c17e489d053cb10.jpg">
			</a>
			<a href="http://www.hdfondos.eu/pictures/2014/0322/1/blue-night-full-moon-scenery-wallpaper-3967.jpg">
   				<img style="width: 100px" src="http://s1.picswalls.com/thumbs1/2014/02/08/summer-wallpaper_06311240_26.jpg">
			</a>
		</p>
		<!-- LIGHTGALLERY CONTAINER MANUALLY -->
		<br>
   		<!-- LIGHTGALLERY CONTAINER AUTOMATICALLY -->
		<p class="lightgallery" lg-selector="a" lg-autolink="true" lg-autotitle="My Example Title" lg-thumbnail="true">
			<img style="width: 100px" src="https://speckycdn-sdm.netdna-ssl.com/wp-content/uploads/2011/09/dualscreenwall13.jpg">
			<img style="width: 100px" src="https://i.stack.imgur.com/SiNEQ.jpg">
			<img style="width: 100px" src="http://es.naturewallpaperfree.com/bosque-otono/wallpaper-naturaleza-640x480-4198-5e295eea.jpg">
		</p>
   		<!-- LIGHTGALLERY CONTAINER AUTOMATICALLY -->
    </div>
</div>
<!-- ================================================= CONTENT ================================================= -->

<?php include('footer.php'); ?>