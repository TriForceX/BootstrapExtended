<?php include('header.php'); ?>

<!-- ================================================= NAV MENU ================================================= -->

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
	<div class="container">
		<!-- NAVBAR CONTAINER -->
		
		<a class="navbar-brand notranslate d-block d-md-none d-lg-block" href="#">Website Base</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ml-auto mr-sm-auto  ml-lg-auto mr-lg-0">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown01" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Information
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown01">
						<a class="dropdown-item" href="https://github.com/TriForceX/WebsiteBase/wiki" target="_blank">Wiki</a>
						<a class="dropdown-item" href="https://github.com/TriForceX/WebsiteBase" target="_blank">Repository</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown02" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Resources
					</a>
					<div class="dropdown-menu dropdown-overflow-lg" aria-labelledby="navbarDropdown02">
						<a class="dropdown-item" href="http://bootboxjs.com/" target="_blank">BootBox JS</a>
						<a class="dropdown-item" href="https://clipboardjs.com/" target="_blank">Clipboard JS</a>
						<a class="dropdown-item" href="https://datatables.net/examples/styling/bootstrap4" target="_blank">Data Tables</a>
						<a class="dropdown-item" href="https://fontawesome.com/start" target="_blank">Font Awesome</a>
						<a class="dropdown-item" href="http://holderjs.com/" target="_blank">Holder JS</a>
                        <a class="dropdown-item" href="http://ianlunn.github.io/Hover/" target="_blank">Hover CSS</a>
						<a class="dropdown-item" href="https://imagesloaded.desandro.com" target="_blank">Images Loaded</a>
						<a class="dropdown-item" href="https://jquery.com/" target="_blank">jQuery</a>
						<a class="dropdown-item" href="https://github.com/pupunzi/jquery.mb.browser" target="_blank">jQuery Browser</a>
						<a class="dropdown-item" href="https://github.com/js-cookie/js-cookie" target="_blank">jQuery Cookie</a>
						<a class="dropdown-item" href="https://github.com/kayahr/jquery-fullscreen-plugin" target="_blank">jQuery Fullscreen</a>
						<a class="dropdown-item" href="http://jqueryrotate.com/" target="_blank">jQuery Rotate</a>
						<a class="dropdown-item" href="https://jqueryui.com/" target="_blank">jQuery UI</a>
						<a class="dropdown-item" href="http://sachinchoolur.github.io/lightGallery/" target="_blank">Light Gallery</a>
                        <a class="dropdown-item" href="https://masonry.desandro.com/" target="_blank">Masonry JS</a>
						<a class="dropdown-item" href="https://github.com/PHPMailer/PHPMailer/" target="_blank">PHP Mailer</a>
						<a class="dropdown-item" href="https://popper.js.org/" target="_blank">Popper</a>
						<a class="dropdown-item" href="https://tempusdominus.github.io/bootstrap-4/" target="_blank">Tempus Dominus</a>
						<a class="dropdown-item" href="https://www.tiny.cloud/" target="_blank">TinyMCE</a>
						<a class="dropdown-item" href="http://labs.rampinteractive.co.uk/touchSwipe/demos/" target="_blank">Touch Swipe</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown03" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Utilities
					</a>
					<div class="dropdown-menu dropdown-overflow-lg" aria-labelledby="navbarDropdown03">
						<a class="dropdown-item" href="https://www.w3schools.com" target="_blank">W3 Schools Tutorials</a>
						<a class="dropdown-item" href="https://www.w3schools.com/howto/" target="_blank">W3 Schools How To</a>
						<a class="dropdown-item" href="https://bootsnipp.com/tags/4.1.1" target="_blank">Bootstrap Snippets</a>
						<a class="dropdown-item" href="https://libraries.io" target="_blank">Open Source Libraries</a>
						<a class="dropdown-item" href="https://www.jqueryscript.net/" target="_blank">jQuery Scripts</a>
						<a class="dropdown-item" href="https://api.jquery.com" target="_blank">jQuery API</a>
						<a class="dropdown-item" href="http://jqueryui.com" target="_blank">jQuery UI API</a>
						<a class="dropdown-item" href="http://php.net" target="_blank">PHP Documentation</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown04" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Bootstrap
					</a>
					<div class="dropdown-menu dropdown-overflow-lg" aria-labelledby="navbarDropdown04">
						<a class="dropdown-item" href="https://getbootstrap.com/docs/4.1/layout/overview/" target="_blank">Layout</a>
						<a class="dropdown-item" href="https://getbootstrap.com/docs/4.1/layout/grid/" target="_blank">Grid</a>
						<a class="dropdown-item" href="https://getbootstrap.com/docs/4.1/components/buttons/" target="_blank">Components</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-header" href="https://getbootstrap.com/docs/4.1/examples/starter-template/" target="_blank">Starter Template</a>
						<a class="dropdown-header" href="https://getbootstrap.com/docs/4.1/examples/grid/" target="_blank">Grid</a>
						<a class="dropdown-header" href="https://getbootstrap.com/docs/4.1/examples/jumbotron/" target="_blank">Jumborton</a>
						<a class="dropdown-header" href="https://getbootstrap.com/docs/4.1/examples/album/" target="_blank">Album</a>
						<a class="dropdown-header" href="https://getbootstrap.com/docs/4.1/examples/pricing/" target="_blank">Pricing</a>
						<a class="dropdown-header" href="https://getbootstrap.com/docs/4.1/examples/checkout/" target="_blank">Checkout</a>
						<a class="dropdown-header" href="https://getbootstrap.com/docs/4.1/examples/product/" target="_blank">Product</a>
						<a class="dropdown-header" href="https://getbootstrap.com/docs/4.1/examples/cover/" target="_blank">Cover</a>
						<a class="dropdown-header" href="https://getbootstrap.com/docs/4.1/examples/carousel/" target="_blank">Carousel</a>
						<a class="dropdown-header" href="https://getbootstrap.com/docs/4.1/examples/blog/" target="_blank">Blog</a>
						<a class="dropdown-header" href="https://getbootstrap.com/docs/4.1/examples/dashboard/" target="_blank">Dashboard</a>
						<a class="dropdown-header" href="https://getbootstrap.com/docs/4.1/examples/sign-in/" target="_blank">Sign-In</a>
						<a class="dropdown-header" href="https://getbootstrap.com/docs/4.1/examples/sticky-footer/" target="_blank">Sticky Footer</a>
						<a class="dropdown-header" href="https://getbootstrap.com/docs/4.1/examples/sticky-footer-navbar/" target="_blank">Sticky Footer Navbar</a>
					</div>
				</li>
				<li class="nav-item pl-0 pl-md-2">
					<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
					<script type="text/javascript">
					function googleTranslateElementInit(){
					  new google.translate.TranslateElement({
						  pageLanguage: 'en', 
						  includedLanguages: 'de,en,es,fr,pt', 
						  layout: google.translate.TranslateElement.InlineLayout.SIMPLE, 
						  autoDisplay: false
					  }, 'google_translate_element');
					}
					</script>
					<div id="google_translate_element"></div>
				</li>
			</ul>
		</div>
		
		<!-- NAVBAR CONTAINER -->
	</div>
</nav>

<!-- ================================================= NAV MENU ================================================= -->

<!-- ================================================= CONTENT ================================================= -->
<div class="content">
	<div class="container">
		<!-- MAIN CONTAINER -->
		
		<!-- Description -->
		
		<div class="progress my-3 JSloadProgressTest">
			<div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
		</div>

		<div class="jumbotron">
			<!--<h1 class="display-4">Resources Examples</h1>
			<p class="lead">Some useful code functions and improvments in <code>PHP</code> or <code>JS</code> using the included resources in this repository.</p>-->
			<div class="media d-block d-md-flex">
				<img class="align-self-center mr-3 mb-2 mb-md-0" src="https://avatars0.githubusercontent.com/u/44783903" alt="Website Base">
				<div class="media-body">
					<h1 class="display-4">Resources Examples</h1>
					<p class="lead">Some useful code functions and improvments in <code>PHP</code> or <code>JS</code> using the included resources in this repository.</p>
				</div>
			</div>
		</div>
	
		<!-- Description -->
		
		<!-- lightGallery Example -->

		<h2>Light Gallery <span class="badge badge-danger">Plugin</span></h2>
	
		<p>A customizable, modular, responsive, gallery plugin for <b>jQuery</b>. Below you will find an improved usage method via <code>data-lg-attributes</code> applied to the main gallery container.</p>
	
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="text-nowrap notranslate">data-lg-item</td>
					<td>Defines which element contains the image <b>url</b> and the <b>thumbnail</b>. If is <code>auto</code> it will takes all <code>&lt;a&gt;</code> tag.</td>
				</tr>
				<tr>
					<td class="text-nowrap notranslate">data-lg-title</td>
					<td>Set a custom title to all images in the gallery. If is <code>auto</code> it will takes all <code>&lt;a&gt;</code> title attribute.</td>
				</tr>
				<tr>
					<td class="text-nowrap notranslate">data-lg-thumb</td>
					<td>Defines if thumbnails will be shown when the gallery is executed.</td>
				</tr>
				<tr>
					<td class="text-nowrap notranslate">data-lg-download</td>
					<td>Enables downloads, the download url will be taken from <code>data-src</code> or <code>href</code>.</td>
				</tr>
				<tr>
					<td class="text-nowrap notranslate">data-lg-autoplay</td>
					<td>Enables autoplay controls.</td>
				</tr>
				<tr>
					<td class="text-nowrap notranslate">data-lg-loop</td>
					<td>When you get the last image it will change to the first image.</td>
				</tr>
				<tr>
					<td class="text-nowrap notranslate">data-lg-share</td>
					<td>Enables social share buttons.</td>
				</tr>
				<tr>
					<td class="text-nowrap notranslate">data-lg-hide-delay</td>
					<td>Delay time (in miliseconds) to hide bars and thumbnails.</td>
				</tr>
				<tr>
					<td class="text-nowrap notranslate">data-lg-gallery</td>
					<td>Show the <b>previous</b> or <b>next</b> page controls inside the gallery. Includes auto redirection.</td>
				</tr>
				<tr>
					<td class="text-nowrap notranslate">data-lg-page-total</td>
					<td>Set the <b>total amount</b> of the gallery pages. This is <b>show</b> or <b>hide</b> the <b>previous</b> or <b>next</b> controls inside the gallery.</td>
				</tr>
				<tr>
					<td class="text-nowrap notranslate">data-lg-page-current</td>
					<td>Set the current <b>active</b> page. This is <b>show</b> or <b>hide</b> the <b>previous</b> or <b>next</b> controls inside the gallery.</td>
				</tr>
			</tbody>
		</table>
	
		<div class="bs-example">
			<div class="row JSlightGallery" data-lg-item="auto" data-lg-title="auto" data-lg-thumb="false" data-lg-download="false" data-lg-share="true" data-lg-autoplay="true" data-lg-loop="false" data-lg-gallery="false">
				<div class="col-12 col-md">
					<a title="My Image 1" href="https://getbootstrap.com/docs/4.1/examples/screenshots/product.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/product.png">
					</a>
				</div>
				<div class="col-12 col-md">
					<a title="My Image 2" href="https://getbootstrap.com/docs/4.1/examples/screenshots/carousel.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/carousel.png">
					</a>
				</div>
				<div class="col-12 col-md">
					<a title="My Image 3" href="https://getbootstrap.com/docs/4.1/examples/screenshots/cover.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/cover.png">
					</a>
				</div>
				<div class="col-12 col-md">
					<a title="My Image 4" href="https://getbootstrap.com/docs/4.1/examples/screenshots/dashboard.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/dashboard.png">
					</a>
				</div>
				<div class="col-12 col-md">
					<a title="My Image 5" href="https://getbootstrap.com/docs/4.1/examples/screenshots/album.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/album.png">
					</a>
				</div>
			</div>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;div class="JSlightGallery" data-lg-item="auto" data-lg-title="auto" data-lg-thumb="false" data-lg-download="false" data-lg-share="true" data-lg-autoplay="true" data-lg-loop="false" data-lg-gallery="false"&gt;<br>...<br>&lt;/div&gt;</code></pre>
		</figure>
	
		<h2 class="JSlightGalleryScroll">Gallery Mode</h2>
		<p>This mode allows to improve the way to show paged galleries executing custom functions when you get the <code>first</code> or <code>last</code> page.</p>

		<div class="bs-example">
			<div class="row JSlightGallery" data-lg-item="auto" data-lg-title="Gallery Title" data-lg-thumb="true" data-lg-download="true" data-lg-share="true" data-lg-autoplay="true" data-lg-loop="false" data-lg-gallery="true" data-lg-page-total="3" data-lg-page-current="1">
				<!-- Group 1 -->
				<div class="col-12 col-md d-none">
					<a title="My Image 1" href="https://getbootstrap.com/docs/4.1/examples/screenshots/product.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/product.png">
					</a>
				</div>
				<div class="col-12 col-md d-none">
					<a title="My Image 2" href="https://getbootstrap.com/docs/4.1/examples/screenshots/carousel.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/carousel.png">
					</a>
				</div>
				<div class="col-12 col-md d-none">
					<a title="My Image 3" href="https://getbootstrap.com/docs/4.1/examples/screenshots/cover.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/cover.png">
					</a>
				</div>
				<div class="col-12 col-md d-none">
					<a title="My Image 4" href="https://getbootstrap.com/docs/4.1/examples/screenshots/dashboard.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/dashboard.png">
					</a>
				</div>
				<div class="col-12 col-md d-none">
					<a title="My Image 5" href="https://getbootstrap.com/docs/4.1/examples/screenshots/album.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/album.png">
					</a>
				</div>
				<!-- Group 1 -->
				<!-- Group 2 -->
				<div class="col-12 col-md d-none">
					<a title="My Image 6" href="https://getbootstrap.com/docs/4.1/examples/screenshots/pricing.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/pricing.png">
					</a>
				</div>
				<div class="col-12 col-md d-none">
					<a title="My Image 7" href="https://getbootstrap.com/docs/4.1/examples/screenshots/blog.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/blog.png">
					</a>
				</div>
				<div class="col-12 col-md d-none">
					<a title="My Image 8" href="https://getbootstrap.com/docs/4.1/examples/screenshots/sign-in.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/sign-in.png">
					</a>
				</div>
				<div class="col-12 col-md d-none">
					<a title="My Image 9" href="https://getbootstrap.com/docs/4.1/examples/screenshots/offcanvas.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/offcanvas.png">
					</a>
				</div>
				<div class="col-12 col-md d-none">
					<a title="My Image 10" href="https://getbootstrap.com/docs/4.1/examples/screenshots/grid.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/grid.png">
					</a>
				</div>
				<!-- Group 2 -->
				<!-- Group 3 -->
				<div class="col-12 col-md d-none">
					<a title="My Image 11" href="https://getbootstrap.com/docs/4.1/examples/screenshots/jumbotron.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/3.3/examples/screenshots/offcanvas.jpg">
					</a>
				</div>
				<div class="col-12 col-md d-none">
					<a title="My Image 12" href="https://getbootstrap.com/docs/4.1/examples/screenshots/checkout.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/checkout.png">
					</a>
				</div>
				<div class="col-12 col-md d-none">
					<a title="My Image 13" href="https://getbootstrap.com/docs/4.1/examples/screenshots/navbars.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/navbars.png">
					</a>
				</div>
				<div class="col-12 col-md d-none">
					<a title="My Image 14" href="https://getbootstrap.com/docs/4.1/examples/screenshots/navbar-bottom.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/navbar-bottom.png">
					</a>
				</div>
				<div class="col-12 col-md d-none">
					<a title="My Image 15" href="https://getbootstrap.com/docs/4.1/examples/screenshots/floating-labels.png">
						<img class="img-thumbnail" src="https://getbootstrap.com/docs/4.1/examples/screenshots/floating-labels.png">
					</a>
				</div>
				<!-- Group 3 -->
			</div>

			<nav aria-label="Page navigation">
				<ul class="pagination mt-3 mb-0">
					<!--
					<li class="page-item"><a class="page-link prev" href="?page=1"><span aria-hidden="true">&laquo;</span></a></li>
					<li class="page-item active"><a class="page-link" href="?page=1">1</a></li>
					<li class="page-item"><a class="page-link" href="?page=2">2</a></li>
					<li class="page-item"><a class="page-link" href="?page=3">3</a></li>
					<li class="page-item"><a class="page-link next" href="?page=2"><span aria-hidden="true">&raquo;</span></a></li>
					-->
				</ul>
			</nav>
		</div>
		
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;div class="JSlightGallery" data-lg-item="auto" data-lg-title="Gallery Title" data-lg-thumb="true" data-lg-download="true" data-lg-share="true" data-lg-autoplay="true" data-lg-loop="false" data-lg-gallery="true" data-lg-page-total="3" data-lg-page-current="1"&gt;<br>...<br>&lt;/div&gt;</code></pre>
		</figure>

		<p>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Note for gallery paginator</h3>
				</div>
				<div class="panel-body">
					Remember to add the <b>previous</b> and <b>next</b> events in the <b>JS</b> to detect which actions will be executed on each case. Take a look in the file <code>extras/example.js</code> for <code>onPrevPageChange.lg</code> and <code>onNextPageChange.lg</code> events examples.
				</div>
			</div>
		</p>
	
		<!-- lightGallery Example -->

		<!-- MAIN CONTAINER -->
	</div>
</div>
<!-- ================================================= CONTENT ================================================= -->

<?php include('footer.php'); ?>