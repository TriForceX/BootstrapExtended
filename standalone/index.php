<?php include('header.php'); ?>

<!-- ================================================= NAV MENU ================================================= -->

<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Website Base</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="index.php">Home</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">About Me <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="https://github.com/TriForceX" target="_blank">GitHub</a></li>
						<li><a href="http://stackoverflow.com/users/7613382/triforce" target="_blank">StackOverflow</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Resources <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="https://datatables.net/examples/styling/bootstrap.html" target="_blank">Data Tables</a></li>
						<li><a href="http://sachinchoolur.github.io/lightGallery/" target="_blank">Light Gallery</a></li>
						<li><a href="http://holderjs.com/" target="_blank">Holder JS</a></li>
						<li><a href="http://bootboxjs.com/" target="_blank">BootBox JS</a></li>
						<li><a href="https://github.com/karacas/imgLiquid" target="_blank">ImgLiquid JS</a></li>
						<li><a href="http://labs.rampinteractive.co.uk/touchSwipe/demos/" target="_blank">Touch Swipe</a></li>
						<li><a href="https://clipboardjs.com/" target="_blank">Clipboard JS</a></li>
                        <li><a href="http://ianlunn.github.io/Hover/" target="_blank">Hover CSS</a></li>
						<li><a href="https://jqueryui.com/" target="_blank">jQuery UI</a></li>
						<li><a href="https://github.com/js-cookie/js-cookie" target="_blank">jQuery Cookie</a></li>
						<li><a href="https://github.com/pupunzi/jquery.mb.browser" target="_blank">jQuery Browser</a></li>
						<li><a href="http://jqueryrotate.com/" target="_blank">jQuery Rotate</a></li>
						<li><a href="https://github.com/PHPMailer/PHPMailer/" target="_blank">PHP Mailer</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Bootstrap <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="http://getbootstrap.com/css/" target="_blank">CSS</a></li>
						<li><a href="http://getbootstrap.com/components/" target="_blank">Components</a></li>
						<li><a href="http://getbootstrap.com/javascript/" target="_blank">Javascript</a></li>
						<li class="divider"></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/starter-template/" target="_blank">Starter template</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/grid/" target="_blank">Grids</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/jumbotron/" target="_blank">Jumbotron</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/jumbotron-narrow/" target="_blank">Narrow jumbotron</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/navbar/" target="_blank">Navbar</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/navbar-static-top/" target="_blank">Static top navbar</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/navbar-fixed-top/" target="_blank">Fixed navbar</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/cover/" target="_blank">Cover</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/carousel/" target="_blank">Carousel</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/blog/" target="_blank">Blog</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/dashboard/" target="_blank">Dashboard</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/signin/" target="_blank">Sign-in page</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/justified-nav/" target="_blank">Justified nav</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/sticky-footer/" target="_blank">Sticky footer</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/sticky-footer-navbar/" target="_blank">Sticky footer fixed navbar</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/non-responsive/" target="_blank">Non-responsive Bootstrap</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/examples/offcanvas/" target="_blank">Off-canvas</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Utilities <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="https://www.w3schools.com" target="_blank">W3 Schools Tutorials</a></li>
						<li><a href="http://bootsnipp.com" target="_blank">Bootstrap Snippets</a></li>
						<li><a href="https://libraries.io" target="_blank">Open Source Libraries</a></li>
						<li><a href="https://api.jquery.com" target="_blank">jQuery API</a></li>
						<li><a href="http://jqueryui.com" target="_blank">jQuery UI API</a></li>
						<li><a href="http://php.net" target="_blank">PHP Documentation</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</nav>
<!-- ================================================= NAV MENU ================================================= -->

<!-- ================================================= CONTENT ================================================= -->
<div class="content">
	<div class="container theme-showcase" role="main">
		<!-- MAIN CONTAINER -->
		
		<!-- ******** LOADING BAR ******** -->
		
		<div class="progress JSloadProgressTest">
			<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">80% Complete (danger)</span>
			</div>
		</div>
		
		<!-- ******** LOADING BAR ******** -->
		
		<!-- ******** STRUCTURE EXAMPLES ******** -->
		
		<div class="jumbotron">
			<h1>Main Structure</h1>
			<p>This template consists of two main parts, <code>header</code> and <code>footer</code>, which are called from the <code>index</code> (or pages). The <code>CSS</code> and <code>JS</code> files are called from a <code>PHP</code> file.</p>
		</div>
		
		<!-- Header example -->
		<div class="page-header">
			<h1>Header <span class="label label-primary">Template</span></h1>
		</div>
		<p>The main header structure contains the access to main <code>PHP</code> functions, website data, <code>META</code> tags, <code>CSS</code> files (and the base one) and <code>HTML</code> header containers.</p>
		
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;!DOCTYPE html&gt;
&lt;html lang="&lt;?php echo php::get_html_data('lang'); ?&gt;"&gt;
&lt;head&gt;
	...
	&lt;link href="&lt;?php echo get_bloginfo('template_url'); ?&gt;/css/style.php" rel="stylesheet"&gt;
	...
&lt;/head&gt;<br>&lt;body&gt;<br>...</code></pre>
		</figure>
		
		<p>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Note for HTML data</h3>
			</div>
			<div class="panel-body">
				Main HTML data for <i>meta tags</i> are located in <code>functions.php</code> using an extended function from PHP utilities. <i>php::get_html_data()</i>
			</div>
		</div>
		</p>
		
		<!-- Index/page example -->
		<div class="page-header">
			<h1>Page <span class="label label-primary">Template</span></h1>
		</div>
		<p>The main page (or index) structure contains <code>HTML</code> contents and access to the main <code>header</code> and <code>footer</code> files.</p>
		
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;?php include('header.php'); ?&gt;<br>&lt;div class="content"&gt;<br>...<br>&lt;/div&gt;<br>&lt;?php include('footer.php'); ?&gt;</code></pre>
		</figure>
		
		<!-- Footer example -->
		<div class="page-header">
			<h1>Footer <span class="label label-primary">Template</span></h1>
		</div>
		<p>The main footer structure contains the access to <code>JS</code> files (and the base one) and <code>HTML</code> footer containers.</p>
		
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">...<br>&lt;!-- Main JS File --&gt;
&lt;script src="&lt;?php echo get_bloginfo('template_url'); ?&gt;/js/app.php"&gt;&lt;/script&gt;
...
&lt;/body&gt;
&lt;/html&gt;</code></pre>
		</figure>
		
		<p>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Note for main PHP Functions</h3>
			</div>
			<div class="panel-body">
				You can use the PHP functions from the main library like <i>php::function()</i>, If you will use Wordpress (or another CMS) is highly recommended to use their main functions instead the base here. For example use <code>get_bloginfo('template_url')</code> instead <code>php::get_main_url()</code>
			</div>
		</div>
		</p>
		
		<!-- Utilities example -->
		<div class="page-header">
			<h1>Utilities <span class="label label-primary">Functions</span></h1>
		</div>
		<p>The main php functions are located in <code>resources/php/main.php</code> and contains a bunch of useful functions to use in PHP</p>
		
		<div class="bs-example">
			<figure class="highlight">
				<pre><code class="language-html" data-lang="html">//Get the main URL will return: <?php echo php::get_main_url(); ?><br>&lt;?php echo php::get_main_url(); ?&gt;
			
//Show current date will return: <?php echo php::show_date(false,'F j l, Y, g:i a'); ?><br>&lt;?php echo php::show_date(false,'F j l, Y, g:i a'); ?&gt;</code></pre>
			</figure>
		</div>
		
		<!-- ******** STRUCTURE EXAMPLES ******** -->
		
		<p>&nbsp;</p>
		
		<!-- ******** CSS/JS EXAMPLES ******** -->
		
		<div class="jumbotron">
			<h1>CSS & JS</h1>
			<p>This template contains a <code>PHP</code> files to call <code>JS</code> and <code>CSS</code> files which are ordered and minified for a better reading.</p>
		</div>
		
		<!-- CSS example -->
		<div class="page-header">
			<h1>CSS <span class="label label-success">Template</span></h1>
		</div>
		<p>The main file structure contains the access to <code>CSS</code> files and <code>Variables</code> to improve the use.</p>
		
		<table class="table table-bordered table-striped js-options-table">
			<thead>
				<tr>
					<th>variable</th>
					<th>description</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>$cssFiles</td>
					<td>Defines which <code>CSS</code> files will be called, you can add more to the array. The <code>style-fonts.css</code> is used to call <i>Fonts Files</i>, <code>style-theme.css</code> is used to define <i>Theme Styles</i>
					</td>
				</tr>
				<tr>
					<td>$cssMinify</td>
					<td>Defines if the <code>CSS</code> code will be minified, this will reduce the size of the file to the client.
					</td>
				</tr>
				<tr>
					<td>$cssVariables</td>
					<td>Defines custom variables to replace inside the <code>CSS</code>files, such as colors, sizes and another data.
					</td>
				</tr>
			</tbody>
		</table>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">$cssFiles = array(
		  $cssUrl.'/css/style-base.css',
		  $cssUrl.'/css/style-fonts.css',
		  $cssUrl.'/css/style-theme.css',
		  ...
		);<br>...<br>$cssVariables = array(
			//Screen
			'@screen-small-phone' => '320px', 
			'@screen-medium-phone' => '360px',
			'@screen-phone' => '480px',
			'@screen-tablet' => '768px',
			'@screen-desktop' => '992px',  
			'@screen-widescreen' => '1200px', 
			'@screen-full-hd' => '1920px', 
			//Colors
			'@color-custom' => '#ffffff',
			...
		);</code></pre>
		</figure>
        
        <p>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Note for included CSS files</h3>
			</div>
			<div class="panel-body">
				The file <code>style-examples.css</code> is only for test purposes in this page, don't add this file to your website. Is not recomemded to modify the <code>style-base.css</code> because contains the main functions inside.
			</div>
		</div>
		</p>
		
		<!-- JS example -->
		<div class="page-header">
			<h1>JS <span class="label label-success">Template</span></h1>
		</div>
		<p>The main file structure contains the access to <code>JS</code> files and <code>Variables</code> to improve the use.</p>
		
		<table class="table table-bordered table-striped js-options-table">
			<thead>
				<tr>
					<th>variable</th>
					<th>description</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>$jsFiles</td>
					<td>Defines which <code>JS</code> files will be called, you can add more to the array. The <code>app-ready.js</code> is used to be executed on <i>DOM Ready</i>, <code>app-load.js</code> is used to be executed on <i>Window Load</i> and <code>app-responsive.js</code> is used to be executed on <i>Responsive Changes</i>
					</td>
				</tr>
				<tr>
					<td>$jsMinify</td>
					<td>Defines if the <code>JS</code> code will be minified, this will reduce the size of the file to the client.
					</td>
				</tr>
				<tr>
					<td>$jsVariables</td>
					<td>Defines custom variables to replace inside the <code>JS</code>files, such as colors, sizes and another data. <b>Note:</b> is important to keep the <code>@global-url</code> variable and the <code>@screen</code> ones, because are used in the <i>Base</i> code.
					</td>
				</tr>
			</tbody>
		</table>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">$jsFiles = array(
		  $jsUrl.'/js/app-base.js',
		  $jsUrl.'/js/app-ready.js',
		  $jsUrl.'/js/app-load.js',
		  $jsUrl.'/js/app-responsive.js',
		  ...
		);<br>...<br>$jsVariables = array(
			//Screen
			'@screen-small-phone' => '320', 
			'@screen-medium-phone' => '360',
			'@screen-phone' => '480',
			'@screen-tablet' => '768',
			'@screen-desktop' => '992',  
			'@screen-widescreen' => '1200', 
			'@screen-full-hd' => '1920', 
			//Global
			'@global-url' => $jsUrl,
			...
		);</code></pre>
		</figure>
		
		<p>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Note for included JS files</h3>
			</div>
			<div class="panel-body">
				The file <code>app-ready.js</code>, <code>app-load.js</code> and <code>app-responsive.js</code> contains some code pieces for test/examples purposes you can delete with no problems. Is not recomemded to modify the <code>app-base.js</code> because contains the main functions inside.
			</div>
		</div>
		</p>
		
		<!-- ******** CSS/JS EXAMPLES ******** -->
		
		<p>&nbsp;</p>
		
		<!-- ******** PLUGINS EXAMPLES ******** -->

		<!-- Section description -->
		<div class="jumbotron">
			<h1>Resources Examples</h1>
			<p>Some useful code functions and improvments in <code>PHP</code> or <code>JS</code> using the included resources in this repository.</p>
		</div>

		<!-- lightGallery examples -->
		<div class="page-header">
			<h1>Light Gallery <span class="label label-danger">Plugin</span></h1>
		</div>
		<p>A customizable, modular, responsive, lightbox gallery plugin for jQuery. Below you will find an improved usage method via <code>data-lg-attributes</code> applied to the main gallery container.

		<table class="table table-bordered table-striped js-options-table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>data-lg-item</td>
					<td>Defines which element contains the image <code>url</code> and the <code>thumbnail</code>
					</td>
				</tr>
				<tr>
					<td>data-lg-title</td>
					<td>Set a custom title to all images in the lightbox</td>
				</tr>
				<tr>
					<td>data-lg-thumb</td>
					<td>Defines if thumbnails will be shown when the lightbox is executed</td>
				</tr>
				<tr>
					<td>data-lg-gallery</td>
					<td>Execute custom functions when you get the <code>first</code> or <code>last</code> page</td>
				</tr>
				<tr>
					<td>data-lg-download</td>
					<td>Enables downloads, the download url will be taken from data-<code>src/href</code> attribute</td>
				</tr>
			</tbody>
		</table>

		<div class="bs-example">
			<div class="row JSlightGallery" data-lg-item="auto" data-lg-title="false" data-lg-thumb="false" data-lg-gallery="false" data-lg-download="false">
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 1" href="http://getbootstrap.com/examples/screenshots/theme.jpg">
						<img src="http://getbootstrap.com/examples/screenshots/theme.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 2" href="http://getbootstrap.com/examples/screenshots/cover.jpg">
						<img src="http://getbootstrap.com/examples/screenshots/cover.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 3" href="http://getbootstrap.com/examples/screenshots/justified-nav.jpg">
						<img src="http://getbootstrap.com/examples/screenshots/justified-nav.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 3" href="http://getbootstrap.com/examples/screenshots/dashboard.jpg">
						<img src="http://getbootstrap.com/examples/screenshots/dashboard.jpg">
					</a>
				</div>
			</div>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;div class="JSlightGallery" data-lg-item="auto" data-lg-title="false" data-lg-thumb="false" data-lg-gallery="false" data-lg-download="false"&gt;<br>...<br>&lt;/div&gt;</code></pre>
		</figure>
		
		<h3>Gallery Mode</h3>
		<p>This mode allows to improve the way to show paged galleries executing custom functions when you get the <code>first</code> or <code>last</code> page</p>

		<div class="bs-example">

			<?php //echo isset($_GET["page-2"]) ? 'Page 2' : 'Page 1' ?>
			<div class="row JSlightGallery" data-lg-item="auto" data-lg-title="Gallery Title" data-lg-thumb="true" data-lg-gallery="true" data-lg-download="true">
				<?php if($_GET["page"]!="2"): ?>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 1" href="http://getbootstrap.com/examples/screenshots/theme.jpg">
						<img src="http://getbootstrap.com/examples/screenshots/theme.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 2" href="http://getbootstrap.com/examples/screenshots/cover.jpg">
						<img src="http://getbootstrap.com/examples/screenshots/cover.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 3" href="http://getbootstrap.com/examples/screenshots/justified-nav.jpg">
						<img src="http://getbootstrap.com/examples/screenshots/justified-nav.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 4" href="http://getbootstrap.com/examples/screenshots/dashboard.jpg">
						<img src="http://getbootstrap.com/examples/screenshots/dashboard.jpg">
					</a>
				</div>
				<?php else: ?>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 5" href="http://getbootstrap.com/examples/screenshots/offcanvas.jpg">
						<img src="http://getbootstrap.com/examples/screenshots/offcanvas.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 6" href="http://getbootstrap.com/examples/screenshots/sign-in.jpg">
						<img src="http://getbootstrap.com/examples/screenshots/sign-in.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 7" href="http://getbootstrap.com/examples/screenshots/jumbotron-narrow.jpg">
						<img src="http://getbootstrap.com/examples/screenshots/jumbotron-narrow.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 8" href="http://getbootstrap.com/examples/screenshots/blog.jpg">
						<img src="http://getbootstrap.com/examples/screenshots/blog.jpg">
					</a>
				</div>
				<?php endif; ?>
			</div>

			<nav aria-label="Page navigation">
				<ul class="pagination no-margin">
					<li>
						<a href="?page=1" aria-label="Previous" class="lg-prev">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
					<li class="<?php echo $_GET["page"]!="2" ? 'active' : '' ?>"><a href="?page=1">1</a></li>
					<li class="<?php echo $_GET["page"]=="2" ? 'active' : '' ?>"><a href="?page=2">2</a></li>
					<li>
						<a href="?page=2" aria-label="Next" class="lg-next">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
		
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;div class="JSlightGallery" data-lg-item="auto" data-lg-title="Gallery Title" data-lg-thumb="true" data-lg-gallery="true" data-lg-download="true"&gt;<br>...<br>&lt;/div&gt;</code></pre>
		</figure>

		<!-- Data Tables example -->
		<div class="page-header">
			<h1>Data Tables <span class="label label-danger">Plugin</span></h1>
		</div>
		
		<p>Improve the way to show plain html tables. Below you will find an improved usage method via <code>data-table-attributes</code>.</p>
		
		<table class="table table-bordered table-striped js-options-table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>data-table-paginator</td>
					<td>Enable a custom paginator with show amount option</td>
				</tr>
				<tr>
					<td>data-table-search</td>
					<td>Enables a search box to filter results</td>
				</tr>
				<tr>
					<td>data-table-info</td>
					<td>Show info at the table footer</td>
				</tr>
				<tr>
					<td>data-table-sorting</td>
					<td>Enables ordering by column</td>
				</tr>
			</tbody>
		</table>

		<div class="bs-example table-responsive">
			<table class="table-striped cell-border JSdataTables" data-table-pages="true" data-table-search="false" data-table-info="false" data-table-sort="true" cellspacing="0" cellpadding="0" border="0">
				<thead>
					<tr>
						<th>Name</th>
						<th>Position</th>
						<th>Office</th>
						<th>Age</th>
						<th>Start date</th>
						<th>Salary</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Tiger Nixon</td>
						<td>System Architect</td>
						<td>Edinburgh</td>
						<td>61</td>
						<td>2011/04/25</td>
						<td>$320,800</td>
					</tr>
					<tr>
						<td>Garrett Winters</td>
						<td>Accountant</td>
						<td>Tokyo</td>
						<td>63</td>
						<td>2011/07/25</td>
						<td>$170,750</td>
					</tr>
					<tr>
						<td>Ashton Cox</td>
						<td>Junior Technical Author</td>
						<td>San Francisco</td>
						<td>66</td>
						<td>2009/01/12</td>
						<td>$86,000</td>
					</tr>
					<tr>
						<td>Cedric Kelly</td>
						<td>Senior Javascript Developer</td>
						<td>Edinburgh</td>
						<td>22</td>
						<td>2012/03/29</td>
						<td>$433,060</td>
					</tr>
					<tr>
						<td>Airi Satou</td>
						<td>Accountant</td>
						<td>Tokyo</td>
						<td>33</td>
						<td>2008/11/28</td>
						<td>$162,700</td>
					</tr>
					<tr>
						<td>Brielle Williamson</td>
						<td>Integration Specialist</td>
						<td>New York</td>
						<td>61</td>
						<td>2012/12/02</td>
						<td>$372,000</td>
					</tr>
					<tr>
						<td>Herrod Chandler</td>
						<td>Sales Assistant</td>
						<td>San Francisco</td>
						<td>59</td>
						<td>2012/08/06</td>
						<td>$137,500</td>
					</tr>
					<tr>
						<td>Rhona Davidson</td>
						<td>Integration Specialist</td>
						<td>Tokyo</td>
						<td>55</td>
						<td>2010/10/14</td>
						<td>$327,900</td>
					</tr>
					<tr>
						<td>Colleen Hurst</td>
						<td>Javascript Developer</td>
						<td>San Francisco</td>
						<td>39</td>
						<td>2009/09/15</td>
						<td>$205,500</td>
					</tr>
					<tr>
						<td>Sonya Frost</td>
						<td>Software Engineer</td>
						<td>Edinburgh</td>
						<td>23</td>
						<td>2008/12/13</td>
						<td>$103,600</td>
					</tr>
					<tr>
						<td>Jena Gaines</td>
						<td>Office Manager</td>
						<td>London</td>
						<td>30</td>
						<td>2008/12/19</td>
						<td>$90,560</td>
					</tr>
					<tr>
						<td>Quinn Flynn</td>
						<td>Support Lead</td>
						<td>Edinburgh</td>
						<td>22</td>
						<td>2013/03/03</td>
						<td>$342,000</td>
					</tr>
					<tr>
						<td>Charde Marshall</td>
						<td>Regional Director</td>
						<td>San Francisco</td>
						<td>36</td>
						<td>2008/10/16</td>
						<td>$470,600</td>
					</tr>
					<tr>
						<td>Haley Kennedy</td>
						<td>Senior Marketing Designer</td>
						<td>London</td>
						<td>43</td>
						<td>2012/12/18</td>
						<td>$313,500</td>
					</tr>
					<tr>
						<td>Tatyana Fitzpatrick</td>
						<td>Regional Director</td>
						<td>London</td>
						<td>19</td>
						<td>2010/03/17</td>
						<td>$385,750</td>
					</tr>
					<tr>
						<td>Michael Silva</td>
						<td>Marketing Designer</td>
						<td>London</td>
						<td>66</td>
						<td>2012/11/27</td>
						<td>$198,500</td>
					</tr>
					<tr>
						<td>Paul Byrd</td>
						<td>Chief Financial Officer (CFO)</td>
						<td>New York</td>
						<td>64</td>
						<td>2010/06/09</td>
						<td>$725,000</td>
					</tr>
					<tr>
						<td>Gloria Little</td>
						<td>Systems Administrator</td>
						<td>New York</td>
						<td>59</td>
						<td>2009/04/10</td>
						<td>$237,500</td>
					</tr>
					<tr>
						<td>Bradley Greer</td>
						<td>Software Engineer</td>
						<td>London</td>
						<td>41</td>
						<td>2012/10/13</td>
						<td>$132,000</td>
					</tr>
					<tr>
						<td>Dai Rios</td>
						<td>Personnel Lead</td>
						<td>Edinburgh</td>
						<td>35</td>
						<td>2012/09/26</td>
						<td>$217,500</td>
					</tr>
					<tr>
						<td>Jenette Caldwell</td>
						<td>Development Lead</td>
						<td>New York</td>
						<td>30</td>
						<td>2011/09/03</td>
						<td>$345,000</td>
					</tr>
					<tr>
						<td>Yuri Berry</td>
						<td>Chief Marketing Officer (CMO)</td>
						<td>New York</td>
						<td>40</td>
						<td>2009/06/25</td>
						<td>$675,000</td>
					</tr>
					<tr>
						<td>Caesar Vance</td>
						<td>Pre-Sales Support</td>
						<td>New York</td>
						<td>21</td>
						<td>2011/12/12</td>
						<td>$106,450</td>
					</tr>
					<tr>
						<td>Doris Wilder</td>
						<td>Sales Assistant</td>
						<td>Sidney</td>
						<td>23</td>
						<td>2010/09/20</td>
						<td>$85,600</td>
					</tr>
					<tr>
						<td>Angelica Ramos</td>
						<td>Chief Executive Officer (CEO)</td>
						<td>London</td>
						<td>47</td>
						<td>2009/10/09</td>
						<td>$1,200,000</td>
					</tr>
					<tr>
						<td>Gavin Joyce</td>
						<td>Developer</td>
						<td>Edinburgh</td>
						<td>42</td>
						<td>2010/12/22</td>
						<td>$92,575</td>
					</tr>
					<tr>
						<td>Jennifer Chang</td>
						<td>Regional Director</td>
						<td>Singapore</td>
						<td>28</td>
						<td>2010/11/14</td>
						<td>$357,650</td>
					</tr>
					<tr>
						<td>Brenden Wagner</td>
						<td>Software Engineer</td>
						<td>San Francisco</td>
						<td>28</td>
						<td>2011/06/07</td>
						<td>$206,850</td>
					</tr>
					<tr>
						<td>Fiona Green</td>
						<td>Chief Operating Officer (COO)</td>
						<td>San Francisco</td>
						<td>48</td>
						<td>2010/03/11</td>
						<td>$850,000</td>
					</tr>
					<tr>
						<td>Shou Itou</td>
						<td>Regional Marketing</td>
						<td>Tokyo</td>
						<td>20</td>
						<td>2011/08/14</td>
						<td>$163,000</td>
					</tr>
					<tr>
						<td>Michelle House</td>
						<td>Integration Specialist</td>
						<td>Sidney</td>
						<td>37</td>
						<td>2011/06/02</td>
						<td>$95,400</td>
					</tr>
					<tr>
						<td>Suki Burks</td>
						<td>Developer</td>
						<td>London</td>
						<td>53</td>
						<td>2009/10/22</td>
						<td>$114,500</td>
					</tr>
					<tr>
						<td>Prescott Bartlett</td>
						<td>Technical Author</td>
						<td>London</td>
						<td>27</td>
						<td>2011/05/07</td>
						<td>$145,000</td>
					</tr>
					<tr>
						<td>Gavin Cortez</td>
						<td>Team Leader</td>
						<td>San Francisco</td>
						<td>22</td>
						<td>2008/10/26</td>
						<td>$235,500</td>
					</tr>
					<tr>
						<td>Martena Mccray</td>
						<td>Post-Sales support</td>
						<td>Edinburgh</td>
						<td>46</td>
						<td>2011/03/09</td>
						<td>$324,050</td>
					</tr>
					<tr>
						<td>Unity Butler</td>
						<td>Marketing Designer</td>
						<td>San Francisco</td>
						<td>47</td>
						<td>2009/12/09</td>
						<td>$85,675</td>
					</tr>
					<tr>
						<td>Howard Hatfield</td>
						<td>Office Manager</td>
						<td>San Francisco</td>
						<td>51</td>
						<td>2008/12/16</td>
						<td>$164,500</td>
					</tr>
					<tr>
						<td>Hope Fuentes</td>
						<td>Secretary</td>
						<td>San Francisco</td>
						<td>41</td>
						<td>2010/02/12</td>
						<td>$109,850</td>
					</tr>
					<tr>
						<td>Vivian Harrell</td>
						<td>Financial Controller</td>
						<td>San Francisco</td>
						<td>62</td>
						<td>2009/02/14</td>
						<td>$452,500</td>
					</tr>
					<tr>
						<td>Timothy Mooney</td>
						<td>Office Manager</td>
						<td>London</td>
						<td>37</td>
						<td>2008/12/11</td>
						<td>$136,200</td>
					</tr>
					<tr>
						<td>Jackson Bradshaw</td>
						<td>Director</td>
						<td>New York</td>
						<td>65</td>
						<td>2008/09/26</td>
						<td>$645,750</td>
					</tr>
					<tr>
						<td>Olivia Liang</td>
						<td>Support Engineer</td>
						<td>Singapore</td>
						<td>64</td>
						<td>2011/02/03</td>
						<td>$234,500</td>
					</tr>
					<tr>
						<td>Bruno Nash</td>
						<td>Software Engineer</td>
						<td>London</td>
						<td>38</td>
						<td>2011/05/03</td>
						<td>$163,500</td>
					</tr>
					<tr>
						<td>Sakura Yamamoto</td>
						<td>Support Engineer</td>
						<td>Tokyo</td>
						<td>37</td>
						<td>2009/08/19</td>
						<td>$139,575</td>
					</tr>
					<tr>
						<td>Thor Walton</td>
						<td>Developer</td>
						<td>New York</td>
						<td>61</td>
						<td>2013/08/11</td>
						<td>$98,540</td>
					</tr>
					<tr>
						<td>Finn Camacho</td>
						<td>Support Engineer</td>
						<td>San Francisco</td>
						<td>47</td>
						<td>2009/07/07</td>
						<td>$87,500</td>
					</tr>
					<tr>
						<td>Serge Baldwin</td>
						<td>Data Coordinator</td>
						<td>Singapore</td>
						<td>64</td>
						<td>2012/04/09</td>
						<td>$138,575</td>
					</tr>
					<tr>
						<td>Zenaida Frank</td>
						<td>Software Engineer</td>
						<td>New York</td>
						<td>63</td>
						<td>2010/01/04</td>
						<td>$125,250</td>
					</tr>
					<tr>
						<td>Zorita Serrano</td>
						<td>Software Engineer</td>
						<td>San Francisco</td>
						<td>56</td>
						<td>2012/06/01</td>
						<td>$115,000</td>
					</tr>
					<tr>
						<td>Jennifer Acosta</td>
						<td>Junior Javascript Developer</td>
						<td>Edinburgh</td>
						<td>43</td>
						<td>2013/02/01</td>
						<td>$75,650</td>
					</tr>
					<tr>
						<td>Cara Stevens</td>
						<td>Sales Assistant</td>
						<td>New York</td>
						<td>46</td>
						<td>2011/12/06</td>
						<td>$145,600</td>
					</tr>
					<tr>
						<td>Hermione Butler</td>
						<td>Regional Director</td>
						<td>London</td>
						<td>47</td>
						<td>2011/03/21</td>
						<td>$356,250</td>
					</tr>
					<tr>
						<td>Lael Greer</td>
						<td>Systems Administrator</td>
						<td>London</td>
						<td>21</td>
						<td>2009/02/27</td>
						<td>$103,500</td>
					</tr>
					<tr>
						<td>Jonas Alexander</td>
						<td>Developer</td>
						<td>San Francisco</td>
						<td>30</td>
						<td>2010/07/14</td>
						<td>$86,500</td>
					</tr>
					<tr>
						<td>Shad Decker</td>
						<td>Regional Director</td>
						<td>Edinburgh</td>
						<td>51</td>
						<td>2008/11/13</td>
						<td>$183,000</td>
					</tr>
					<tr>
						<td>Michael Bruce</td>
						<td>Javascript Developer</td>
						<td>Singapore</td>
						<td>29</td>
						<td>2011/06/27</td>
						<td>$183,000</td>
					</tr>
					<tr>
						<td>Donna Snider</td>
						<td>Customer Support</td>
						<td>New York</td>
						<td>27</td>
						<td>2011/01/25</td>
						<td>$112,000</td>
					</tr>
				</tbody>
			</table>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;table class="JSdataTables" data-table-pages="true" data-table-search="false" data-table-info="false" data-table-sort="true"&gt;<br>...<br>&lt;/table&gt;</code></pre>
		</figure>

		<!-- Show alert example -->
		<div class="page-header">
			<h1>Show Alert BootBox <span class="label label-danger">Plugin</span></h1>
		</div>
		<p>Launch a custom modal box using BootBox Features, the function structure is <code>showAlert(title, text, size)</code> you can alternatively set a size</p>

		<div class="bs-example">
			<button type="button" class="btn btn-primary" onclick="showAlert('Small Size Box','This is a text shown in a modal box','small')">Show Alert Small Size</button>
			<button type="button" class="btn btn-primary" onclick="showAlert('Medium Size Box','This is a text shown in a modal box')">Show Alert Medium Size (By default)</button>
			<button type="button" class="btn btn-primary" onclick="showAlert('Large Size Box','This is a text shown in a modal box','large')">Show Alert Large Size</button>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;a onclick="showAlert('Small Size Box','This is a text shown in a modal box','small')">Click Here&lt;/a&gt;<br>&lt;a onclick="showAlert('Medium Size Box','This is a text shown in a modal box')">Click Here&lt;/a&gt;<br>&lt;a onclick="showAlert('Large Size Box','This is a text shown in a modal box','large')">Click Here&lt;/a&gt;</code></pre>
		</figure>

		<!-- Video launch example -->
		<div class="page-header">
			<h1>Video Launch <span class="label label-danger">Custom</span></h1>
		</div>
		<p>Launch a modal box with a basic video player, the function structure is <code>videoLaunch(url, share, title)</code></p>

		<div class="bs-example">
			<button type="button" class="btn btn-primary" onclick="videoLaunch('https://www.youtube.com/watch?v=ae6aeo9-Kn8', true, 'My YouTube Video')">YouTube Video</button>
			<button type="button" class="btn btn-primary" onclick="videoLaunch('https://vimeo.com/214352663', false, 'My Vimeo Video')">Vimeo Video (No share URL)</button>
			<button type="button" class="btn btn-primary" onclick="videoLaunch('https://www.facebook.com/1399203336817784/videos/1470830192988431',true, 'My Facebook Video')">Facebook Video</button>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;a onclick="videoLaunch('https://www.youtube.com/watch?v=ae6aeo9-Kn8', true, 'My YouTube Video')">Click Here&lt;/a&gt;<br>&lt;a onclick="videoLaunch('https://vimeo.com/214352663', false, 'My Vimeo Video')">Click Here&lt;/a&gt;<br>&lt;a onclick="videoLaunch('https://www.facebook.com/1399203336817784/videos/1470830192988431',true, 'My Facebook Video')">Click Here&lt;/a&gt;</code></pre>
		</figure>

		<!-- Window popup example -->
		<div class="page-header">
			<h1>Window Pop-Up <span class="label label-danger">Custom</span></h1>
		</div>
		<p>Launch a custom pop-up window via javascript. Below you will find an improved usage method via <code>data-win-attributes</code>.</p>

		<table class="table table-bordered table-striped js-options-table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>data-win-url</td>
					<td>Website URL to show in the pop-up</td>
				</tr>
				<tr>
					<td>data-win-size</td>
					<td>Width & Height (in pixels) of the pop-up, Need to be written like <code>width<code>x<code>height</code></td>
				</tr>
				<tr>
					<td>data-win-align</td>
					<td>Horizontal & Vertical alignment (in pixels) of the pop-up, Need to be written like <code>horizontal<code>,<code>vertical</code> and the values can be <code>left</code>, <code>center</code> or <code>right</code></td>
				</tr>
				<tr>
					<td>data-win-scroll</td>
					<td>Enable or disable scrollbar in the pop-up</td>
				</tr>
			</tbody>
		</table>

		<div class="bs-example">
			<button type="button" class="btn btn-primary JSwindowPopup" data-win-url="http://getbootstrap.com" data-win-size="640x480" data-win-align="center,center" data-win-scroll="yes">Center Center 640 x 480</button>
			<button type="button" class="btn btn-primary JSwindowPopup" data-win-url="http://getbootstrap.com" data-win-size="320x480" data-win-align="right,bottom" data-win-scroll="yes">Right Bottom 320 x 480</button>
			<button type="button" class="btn btn-primary JSwindowPopup" data-win-url="http://getbootstrap.com" data-win-size="320x480" data-win-align="left,top" data-win-scroll="yes">Left Top 320 x 480</button>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;a class="JSwindowPopup" data-win-url="http://getbootstrap.com" data-win-size="640x480" data-win-align="center,center" data-win-scroll="yes">Click Here&lt;/a&gt;<br>&lt;a class="JSwindowPopup" data-win-url="http://getbootstrap.com" data-win-size="320x480" data-win-align="right,bottom" data-win-scroll="yes">Click Here&lt;/a&gt;<br>&lt;a class="JSwindowPopup" data-win-url="http://getbootstrap.com" data-win-size="320x480" data-win-align="left,top" data-win-scroll="yes">Click Here&lt;/a&gt;</code></pre>
		</figure>

		<!-- Form validation -->
		<div class="page-header">
			<h1>Form Validation <span class="label label-danger">Custom</span></h1>
		</div>
		<p>Basic validation for <code>input</code>, <code>select</code>, <code>checkbox</code> and <code>textarea</code> elements. The main function is <code>$()validateForm(options);</code></p></p>
		
		<div class="bs-example">
			<form class="JSformExample" method="post" action="javascript:showAlert('Form Success!','The form passed sucessfully! Thanks!');">
				<div class="form-group">
					<label for="example-input-username">User Name</label>
					<input type="text" class="form-control" id="example-input-username" placeholder="Type your User Name">
				</div>
				<div class="form-group">
					<label for="example-input-firstname">First Name</label>
					<input type="text" class="form-control" id="example-input-firstname" placeholder="Type your First Name">
				</div>
				<div class="form-group">
					<label for="example-input-lastname">Last Name</label>
					<input type="text" class="form-control" id="example-input-lastname" placeholder="Type your Last Name (Optional)">
				</div>
				<div class="form-group">
					<label for="example-input-age">Age</label>
					<input type="number" step="any" class="form-control" id="example-input-age" placeholder="Type your Age">
				</div>
				<div class="form-group">
					<label for="example-input-email">E-Mail address</label>
					<input type="email" class="form-control" id="example-input-email" placeholder="Type your E-Mail">
				</div>
				<div class="form-group">
					<label for="example-input-tel">Phone Number</label>
					<input type="tel" class="form-control" id="example-input-tel" placeholder="Type your Phone Number">
				</div>
				<div class="form-group">
					<label for="example-input-password">Password</label>
					<input type="password" class="form-control" id="example-input-password" placeholder="Type your Password">
				</div>
				<div class="form-group form-group-icon">
					<label for="example-select">Select Item</label>
					<select class="form-control" id="example-select">
						<option>Select an item</option>
						<option value="1">Item 1</option>
						<option value="2">Item 2</option>
						<option value="3">Item 3</option>
						<option value="4">Item 4</option>
						<option value="5">Item 5</option>
					</select>
					<span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
				</div>
				<div class="form-group">
					<label for="example-textarea">Message</label>
					<textarea class="form-control" rows="3" id="example-textarea" placeholder="Write a Message"></textarea>
				</div>
				<div class="form-group" data-group="checkbox">
					<p class="no-margin-b">
						<label>Check items</label>
					</p>
					<div class="checkbox">
						<input type="checkbox" autocomplete="off" name="example-checkbox-1" id="example-checkbox-1" value="Selected 1"> 
						<label for="example-checkbox-1">Checkbox Item 1</label>
					</div>
					<div class="checkbox checkbox-primary">
						<input type="checkbox" autocomplete="off" name="example-checkbox-2" id="example-checkbox-2" value="Selected 2"> 
						<label for="example-checkbox-2">Checkbox Item 2</label>
					</div>
					<div class="checkbox checkbox-success">
						<input type="checkbox" autocomplete="off" name="example-checkbox-3" id="example-checkbox-3" value="Selected 3"> 
						<label for="example-checkbox-3">Checkbox Item 3</label>
					</div>
					<div class="checkbox checkbox-danger">
						<input type="checkbox" autocomplete="off" name="example-checkbox-4" id="example-checkbox-4" value="Selected 3"> 
						<label for="example-checkbox-4">Checkbox Item 4</label>
					</div>
				</div>
				<div class="form-group" data-group="radio">
					<p class="no-margin-b">
						<label>Radio items</label>
					</p>
					<div class="radio">
						<input type="radio" name="example-radio" id="example-radio-1" autocomplete="off" value="Choosen 1"> 
						<label for="example-radio-1">Radio Item 1</label>
					</div>
					<div class="radio radio-primary">
						<input type="radio" name="example-radio" id="example-radio-2" autocomplete="off" value="Choosen 2"> 
						<label for="example-radio-2">Radio Item 2</label>
					</div>
					<div class="radio radio-success">
						<input type="radio" name="example-radio" id="example-radio-3" autocomplete="off" value="Choosen 3"> 
						<label for="example-radio-3">Radio Item 3</label>
					</div>
					<div class="radio radio-danger">
						<input type="radio" name="example-radio" id="example-radio-4" autocomplete="off" value="Choosen 3"> 
						<label for="example-radio-4">Radio Item 4</label>
					</div>
				</div>
				<div class="form-group" data-toggle="buttons" data-group="checkbox">
					<p class="no-margin-b">
						<label>Check items (Button style)</label>
					</p>
					<label class="btn btn-primary" for="example-checkbox-1-style">
						<input type="checkbox" autocomplete="off" name="example-checkbox-1-style" id="example-checkbox-1-style" value="Selected 1 style"> Checkbox Item 1
					</label>
					<label class="btn btn-success" for="example-checkbox-2-style">
						<input type="checkbox" autocomplete="off" name="example-checkbox-2-style" id="example-checkbox-2-style" value="Selected 2 style"> Checkbox Item 2
					</label>
					<label class="btn btn-danger" for="example-checkbox-3-style">
						<input type="checkbox" autocomplete="off" name="example-checkbox-3-style" id="example-checkbox-3-style" value="Selected 3 style"> Checkbox Item 3
					</label>
				</div>
				<div class="form-group" data-toggle="buttons" data-group="radio">
					<p class="no-margin-b">
						<label>Radio items (Button style)</label>
					</p>
					<label class="btn btn-primary" for="example-radio-1-style">
						<input type="radio" name="example-radio-style" id="example-radio-1-style" autocomplete="off" value="Choosen 1 style"> Radio Item 1
					</label>
					<label class="btn btn-success" for="example-radio-2-style">
						<input type="radio" name="example-radio-style" id="example-radio-2-style" autocomplete="off" value="Choosen 2 style"> Radio Item 2
					</label>
					<label class="btn btn-danger" for="example-radio-3-style">
						<input type="radio" name="example-radio-style" id="example-radio-3-style" autocomplete="off" value="Choosen 3 style"> Radio Item 3
					</label>
				</div>
				<div class="form-group no-margin-b">
					<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</form>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">$(".JSformExample").validateForm({
	noValidate: "#example-input-lastname",
	hasConfirm: true,
});</code></pre>
		</figure>
		
		<!-- Map launch example -->
		<div class="page-header">
			<h1>Map Launch <span class="label label-danger">Custom</span></h1>
		</div>
		<p>Show a modal box with map options such as <i>Google Maps</i> and <i>Waze</i>. Below you will find an improved usage method via <code>data-map-attributes</code>.</p>

		<table class="table table-bordered table-striped js-options-table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>data-map-address</td>
					<td>The map address to search</code>
					</td>
				</tr>
				<tr>
					<td>data-map-coords</td>
					<td>Desired address coords <code>latitude</code>, <code>longitude</code>, <code>zoom</code>
					</td>
				</tr>
			</tbody>
		</table>

		<div class="bs-example">
			<button type="button" class="btn btn-primary JSmapLaunch" data-map-address="Renato Sánchez 4265, Las Condes, Santiago, Chile" data-map-coords="-33.4176466,-70.585256,17">Show Map Launch</button>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;button type="button" class="btn btn-primary JSmapLaunch" data-map-address="Renato Sánchez 4265, Las Condes, Santiago, Chile" data-map-coords="-33.4176466,-70.585256,17"&gt;Show Map Launch&lt;/button&gt;</code></pre>
		</figure>

		<!-- ******** BOOTSTRAP THEME EXAMPLES ******** -->
		
		<p>&nbsp;</p>

		<div class="jumbotron">
			<h1>Theme example</h1>
			<p>This is a template showcasing the optional theme stylesheet included in Bootstrap. Use it as a starting point to create something more unique by building on or modifying it.</p>
		</div>

		<div class="page-header">
			<h1>Buttons</h1>
		</div>
		<p>
			<button type="button" class="btn btn-lg btn-default">Default</button>
			<button type="button" class="btn btn-lg btn-primary">Primary</button>
			<button type="button" class="btn btn-lg btn-success">Success</button>
			<button type="button" class="btn btn-lg btn-info">Info</button>
			<button type="button" class="btn btn-lg btn-warning">Warning</button>
			<button type="button" class="btn btn-lg btn-danger">Danger</button>
			<button type="button" class="btn btn-lg btn-link">Link</button>
		</p>
		<p>
			<button type="button" class="btn btn-default">Default</button>
			<button type="button" class="btn btn-primary">Primary</button>
			<button type="button" class="btn btn-success">Success</button>
			<button type="button" class="btn btn-info">Info</button>
			<button type="button" class="btn btn-warning">Warning</button>
			<button type="button" class="btn btn-danger">Danger</button>
			<button type="button" class="btn btn-link">Link</button>
		</p>
		<p>
			<button type="button" class="btn btn-sm btn-default">Default</button>
			<button type="button" class="btn btn-sm btn-primary">Primary</button>
			<button type="button" class="btn btn-sm btn-success">Success</button>
			<button type="button" class="btn btn-sm btn-info">Info</button>
			<button type="button" class="btn btn-sm btn-warning">Warning</button>
			<button type="button" class="btn btn-sm btn-danger">Danger</button>
			<button type="button" class="btn btn-sm btn-link">Link</button>
		</p>
		<p>
			<button type="button" class="btn btn-xs btn-default">Default</button>
			<button type="button" class="btn btn-xs btn-primary">Primary</button>
			<button type="button" class="btn btn-xs btn-success">Success</button>
			<button type="button" class="btn btn-xs btn-info">Info</button>
			<button type="button" class="btn btn-xs btn-warning">Warning</button>
			<button type="button" class="btn btn-xs btn-danger">Danger</button>
			<button type="button" class="btn btn-xs btn-link">Link</button>
		</p>

		<div class="page-header">
			<h1>Tables</h1>
		</div>
		<div class="row">
			<div class="col-md-6">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Username</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Mark</td>
							<td>Otto</td>
							<td>@mdo</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Jacob</td>
							<td>Thornton</td>
							<td>@fat</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Larry</td>
							<td>the Bird</td>
							<td>@twitter</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-6">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Username</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Mark</td>
							<td>Otto</td>
							<td>@mdo</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Jacob</td>
							<td>Thornton</td>
							<td>@fat</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Larry</td>
							<td>the Bird</td>
							<td>@twitter</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Username</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td rowspan="2">1</td>
							<td>Mark</td>
							<td>Otto</td>
							<td>@mdo</td>
						</tr>
						<tr>
							<td>Mark</td>
							<td>Otto</td>
							<td>@TwBootstrap</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Jacob</td>
							<td>Thornton</td>
							<td>@fat</td>
						</tr>
						<tr>
							<td>3</td>
							<td colspan="2">Larry the Bird</td>
							<td>@twitter</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-6">
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>#</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Username</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Mark</td>
							<td>Otto</td>
							<td>@mdo</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Jacob</td>
							<td>Thornton</td>
							<td>@fat</td>
						</tr>
						<tr>
							<td>3</td>
							<td colspan="2">Larry the Bird</td>
							<td>@twitter</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="page-header">
			<h1>Thumbnails</h1>
		</div>
		<img data-src="holder.js/200x200" class="img-thumbnail" alt="A generic square placeholder image with a white border around it, making it resemble a photograph taken with an old instant camera">

		<div class="page-header">
			<h1>Labels</h1>
		</div>
		<h1>
			<span class="label label-default">Default</span>
			<span class="label label-primary">Primary</span>
			<span class="label label-success">Success</span>
			<span class="label label-info">Info</span>
			<span class="label label-warning">Warning</span>
			<span class="label label-danger">Danger</span>
		</h1>
		<h2>
			<span class="label label-default">Default</span>
			<span class="label label-primary">Primary</span>
			<span class="label label-success">Success</span>
			<span class="label label-info">Info</span>
			<span class="label label-warning">Warning</span>
			<span class="label label-danger">Danger</span>
		</h2>
		<h3>
			<span class="label label-default">Default</span>
			<span class="label label-primary">Primary</span>
			<span class="label label-success">Success</span>
			<span class="label label-info">Info</span>
			<span class="label label-warning">Warning</span>
			<span class="label label-danger">Danger</span>
		</h3>
		<h4>
			<span class="label label-default">Default</span>
			<span class="label label-primary">Primary</span>
			<span class="label label-success">Success</span>
			<span class="label label-info">Info</span>
			<span class="label label-warning">Warning</span>
			<span class="label label-danger">Danger</span>
		</h4>
		<h5>
			<span class="label label-default">Default</span>
			<span class="label label-primary">Primary</span>
			<span class="label label-success">Success</span>
			<span class="label label-info">Info</span>
			<span class="label label-warning">Warning</span>
			<span class="label label-danger">Danger</span>
		</h5>
		<h6>
			<span class="label label-default">Default</span>
			<span class="label label-primary">Primary</span>
			<span class="label label-success">Success</span>
			<span class="label label-info">Info</span>
			<span class="label label-warning">Warning</span>
			<span class="label label-danger">Danger</span>
		</h6>
		<p>
			<span class="label label-default">Default</span>
			<span class="label label-primary">Primary</span>
			<span class="label label-success">Success</span>
			<span class="label label-info">Info</span>
			<span class="label label-warning">Warning</span>
			<span class="label label-danger">Danger</span>
		</p>
		
		<div class="page-header">
			<h1>Badges</h1>
		</div>
		<p>
			<a href="#">Inbox <span class="badge">42</span></a>
		</p>
		<ul class="nav nav-pills" role="tablist">
			<li role="presentation" class="active"><a href="#">Home <span class="badge">42</span></a></li>
			<li role="presentation"><a href="#">Profile</a></li>
			<li role="presentation"><a href="#">Messages <span class="badge">3</span></a></li>
		</ul>

		<div class="page-header">
			<h1>Dropdown menus</h1>
		</div>
		<div class="dropdown theme-dropdown clearfix">
			<a id="dropdownMenu1" href="#" class="sr-only dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
			<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<li class="active"><a href="#">Action</a></li>
				<li><a href="#">Another action</a></li>
				<li><a href="#">Something else here</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="#">Separated link</a></li>
			</ul>
		</div>

		<div class="page-header">
			<h1>Navs</h1>
		</div>
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#">Home</a></li>
			<li role="presentation"><a href="#">Profile</a></li>
			<li role="presentation"><a href="#">Messages</a></li>
		</ul>
		<ul class="nav nav-pills" role="tablist">
			<li role="presentation" class="active"><a href="#">Home</a></li>
			<li role="presentation"><a href="#">Profile</a></li>
			<li role="presentation"><a href="#">Messages</a></li>
		</ul>

		<div class="page-header">
			<h1>Navbars</h1>
		</div>

		<nav class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Project name</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#about">About</a></li>
						<li><a href="#contact">Contact</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li role="separator" class="divider"></li>
								<li class="dropdown-header">Nav header</li>
								<li><a href="#">Separated link</a></li>
								<li><a href="#">One more separated link</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<!--/.nav-collapse -->
			</div>
		</nav>

		<nav class="navbar navbar-inverse">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Project name</a>
				</div>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#about">About</a></li>
						<li><a href="#contact">Contact</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li role="separator" class="divider"></li>
								<li class="dropdown-header">Nav header</li>
								<li><a href="#">Separated link</a></li>
								<li><a href="#">One more separated link</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<!--/.nav-collapse -->
			</div>
		</nav>

		<div class="page-header">
			<h1>Alerts</h1>
		</div>
		<div class="alert alert-success" role="alert">
			<strong>Well done!</strong> You successfully read this important alert message.
		</div>
		<div class="alert alert-info" role="alert">
			<strong>Heads up!</strong> This alert needs your attention, but it's not super important.
		</div>
		<div class="alert alert-warning" role="alert">
			<strong>Warning!</strong> Best check yo self, you're not looking too good.
		</div>
		<div class="alert alert-danger" role="alert">
			<strong>Oh snap!</strong> Change a few things up and try submitting again.
		</div>


		<div class="page-header">
			<h1>Progress bars</h1>
		</div>
		<div class="progress">
			<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
				<span class="sr-only">60% Complete</span>
			</div>
		</div>
		<div class="progress">
			<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
				<span class="sr-only">40% Complete (success)</span>
			</div>
		</div>
		<div class="progress">
			<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
				<span class="sr-only">20% Complete</span>
			</div>
		</div>
		<div class="progress">
			<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
				<span class="sr-only">60% Complete (warning)</span>
			</div>
		</div>
		<div class="progress">
			<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
				<span class="sr-only">80% Complete (danger)</span>
			</div>
		</div>
		<div class="progress">
			<div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
				<span class="sr-only">60% Complete</span>
			</div>
		</div>
		<div class="progress">
			<div class="progress-bar progress-bar-success" style="width: 35%">
				<span class="sr-only">35% Complete (success)</span>
			</div>
			<div class="progress-bar progress-bar-warning" style="width: 20%">
				<span class="sr-only">20% Complete (warning)</span>
			</div>
			<div class="progress-bar progress-bar-danger" style="width: 10%">
				<span class="sr-only">10% Complete (danger)</span>
			</div>
		</div>

		<div class="page-header">
			<h1>List groups</h1>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<ul class="list-group">
					<li class="list-group-item">Cras justo odio</li>
					<li class="list-group-item">Dapibus ac facilisis in</li>
					<li class="list-group-item">Morbi leo risus</li>
					<li class="list-group-item">Porta ac consectetur ac</li>
					<li class="list-group-item">Vestibulum at eros</li>
				</ul>
			</div>
			<!-- /.col-sm-4 -->
			<div class="col-sm-4">
				<div class="list-group">
					<a href="#" class="list-group-item active">Cras justo odio</a>
					<a href="#" class="list-group-item">Dapibus ac facilisis in</a>
					<a href="#" class="list-group-item">Morbi leo risus</a>
					<a href="#" class="list-group-item">Porta ac consectetur ac</a>
					<a href="#" class="list-group-item">Vestibulum at eros</a>
				</div>
			</div>
			<!-- /.col-sm-4 -->
			<div class="col-sm-4">
				<div class="list-group">
					<a href="#" class="list-group-item active">
						<h4 class="list-group-item-heading">List group item heading</h4>
						<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
					</a>
					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">List group item heading</h4>
						<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
					</a>
					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">List group item heading</h4>
						<p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
					</a>
				</div>
			</div>
			<!-- /.col-sm-4 -->
		</div>

		<div class="page-header">
			<h1>Panels</h1>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Panel title</h3>
					</div>
					<div class="panel-body">
						Panel content
					</div>
				</div>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Panel title</h3>
					</div>
					<div class="panel-body">
						Panel content
					</div>
				</div>
			</div>
			<!-- /.col-sm-4 -->
			<div class="col-sm-4">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">Panel title</h3>
					</div>
					<div class="panel-body">
						Panel content
					</div>
				</div>
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Panel title</h3>
					</div>
					<div class="panel-body">
						Panel content
					</div>
				</div>
			</div>
			<!-- /.col-sm-4 -->
			<div class="col-sm-4">
				<div class="panel panel-warning">
					<div class="panel-heading">
						<h3 class="panel-title">Panel title</h3>
					</div>
					<div class="panel-body">
						Panel content
					</div>
				</div>
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h3 class="panel-title">Panel title</h3>
					</div>
					<div class="panel-body">
						Panel content
					</div>
				</div>
			</div>
			<!-- /.col-sm-4 -->
		</div>

		<div class="page-header">
			<h1>Wells</h1>
		</div>
		<div class="well">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Cras mattis consectetur purus sit amet fermentum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Aenean lacinia bibendum nulla sed consectetur.</p>
		</div>

		<div class="page-header">
			<h1>Carousel</h1>
		</div>
		<p>Note: A special class <code>carousel-swipe</code> was added to enable <b>touch gesture</b> on mobile <i>(right or left)</i>. Also there is another class <code>carousel-fade</code>to change the carousel transition. To manage the transition time interval an attribute <code>data-interval</code> was added to modify <i>(time in milliseconds)</i>. To disable shadows on controls just add <code>carousel-noshadow</code> class.</p>
		
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="3000">
			<ol class="carousel-indicators">
				<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-example-generic" data-slide-to="1"></li>
				<li data-target="#carousel-example-generic" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img data-src="holder.js/1140x500/auto/#777:#555/text:First slide" alt="First slide">
				</div>
				<div class="item">
					<img data-src="holder.js/1140x500/auto/#666:#444/text:Second slide" alt="Second slide">
				</div>
				<div class="item">
					<img data-src="holder.js/1140x500/auto/#555:#333/text:Third slide" alt="Third slide">
				</div>
			</div>
			<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
		
			<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>

		<!-- ******** BOOTSTRAP THEME ******** -->

		<!-- MAIN CONTAINER -->
	</div>
</div>
<!-- ================================================= CONTENT ================================================= -->

<?php include('footer.php'); ?>