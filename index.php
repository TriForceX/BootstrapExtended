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
		<h3>Light Gallery Normal</h3>
   		<p class="lightgallery" lg-selector="auto" lg-autotitle="false" lg-thumbnail="false" lg-gallerymode="false">
   			<a title="My image 1" href="http://files.vladstudio.com/joy/where_tahrs_live/wall/vladstudio_where_tahrs_live_800x600_signed.jpg">
   				<img style="width: 100px" src="http://www.dailymobile.net/wp-content/uploads/wallpapers/landscape-wallpapers-320x240/nokia-320x240-wallpaper-2363.jpg">
			</a>
			<a title="My image 2" href="http://www.hdfondos.eu/pictures/2014/0315/1/new-york-sunset-hd-wallpaper-4325.jpg">
   				<img style="width: 100px" src="https://s-media-cache-ak0.pinimg.com/564x/2c/cd/16/2ccd161ecb5634004c17e489d053cb10.jpg">
			</a>
			<a title="My image 3" href="http://www.hdfondos.eu/pictures/2014/0322/1/blue-night-full-moon-scenery-wallpaper-3967.jpg">
   				<img style="width: 100px" src="http://s1.picswalls.com/thumbs1/2014/02/08/summer-wallpaper_06311240_26.jpg">
			</a>
		</p>
		<!-- LIGHTGALLERY CONTAINER MANUALLY -->
		<br>
   		<!-- LIGHTGALLERY CONTAINER AUTOMATICALLY -->
   		<h3>Light Gallery Mode (<?php echo isset($_GET["page-2"]) ? 'Page 2' : 'Page 1' ?>)</h3>
		<p class="lightgallery" lg-selector="auto" lg-autotitle="My gallery" lg-thumbnail="true" lg-gallerymode="true">
			<?php if(isset($_GET["page-2"])): ?>
			<a title="My image 1" href="http://files.vladstudio.com/joy/where_tahrs_live/wall/vladstudio_where_tahrs_live_800x600_signed.jpg">
   				<img style="width: 100px" src="http://www.dailymobile.net/wp-content/uploads/wallpapers/landscape-wallpapers-320x240/nokia-320x240-wallpaper-2363.jpg">
			</a>
			<a title="My image 2" href="http://www.hdfondos.eu/pictures/2014/0315/1/new-york-sunset-hd-wallpaper-4325.jpg">
   				<img style="width: 100px" src="https://s-media-cache-ak0.pinimg.com/564x/2c/cd/16/2ccd161ecb5634004c17e489d053cb10.jpg">
			</a>
			<a title="My image 3" href="http://www.hdfondos.eu/pictures/2014/0322/1/blue-night-full-moon-scenery-wallpaper-3967.jpg">
   				<img style="width: 100px" src="http://s1.picswalls.com/thumbs1/2014/02/08/summer-wallpaper_06311240_26.jpg">
			</a>
			<?php else: ?>
			<a href="https://speckycdn-sdm.netdna-ssl.com/wp-content/uploads/2011/09/dualscreenwall13.jpg">
   				<img style="width: 100px" src="https://speckycdn-sdm.netdna-ssl.com/wp-content/uploads/2011/09/dualscreenwall13.jpg">
			</a>
			<a href="https://i.stack.imgur.com/SiNEQ.jpg">
   				<img style="width: 100px" src="https://i.stack.imgur.com/SiNEQ.jpg">
			</a>
			<a href="http://es.naturewallpaperfree.com/bosque-otono/wallpaper-naturaleza-640x480-4198-5e295eea.jpg">
   				<img style="width: 100px" src="http://es.naturewallpaperfree.com/bosque-otono/wallpaper-naturaleza-640x480-4198-5e295eea.jpg">
			</a>
			<?php endif; ?>
		</p>
  		<p>
			<a class="lg-prev" href="?page-1">&laquo; Page 1</a>
			<a class="lg-next" href="?page-2">Page 2 &raquo;</a>
		</p>
   		<!-- LIGHTGALLERY CONTAINER AUTOMATICALLY -->
    </div>
</div>
<!-- ================================================= CONTENT ================================================= -->

<?php include('footer.php'); ?>