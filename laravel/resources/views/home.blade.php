@extends('layouts.main')
@section('content')

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
			<a class="navbar-brand notranslate" href="{{ url('/') }}">Website Base</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="{{ url('/') }}" class="notranslate">Home</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Contact <span class="caret"></span></a>
					<ul class="dropdown-menu dropdown-overflow-lg notranslate" role="menu">
						<li><a href="https://github.com/TriForceX" target="_blank">GitHub</a></li>
						<li><a href="http://stackoverflow.com/users/7613382/triforce" target="_blank">StackOverflow</a></li>
						<li class="divider"></li>
						<li><a href="https://github.com/TriForceX/WebsiteBase" target="_blank">Repository</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Resources <span class="caret"></span></a>
					<ul class="dropdown-menu dropdown-overflow-lg notranslate" role="menu">
						<li><a href="http://bootboxjs.com/" target="_blank">BootBox JS</a></li>
						<li><a href="https://uxsolutions.github.io/bootstrap-datepicker/" target="_blank">Bootstrap Date Picker</a></li>
						<li><a href="http://jdewit.github.io/bootstrap-timepicker/" target="_blank">Bootstrap Time Picker</a></li>
						<li><a href="https://clipboardjs.com/" target="_blank">Clipboard JS</a></li>
						<li><a href="https://datatables.net/examples/styling/bootstrap.html" target="_blank">Data Tables</a></li>
						<li><a href="http://fontawesome.io/" target="_blank">Font Awesome</a></li>
						<li><a href="http://holderjs.com/" target="_blank">Holder JS</a></li>
                        <li><a href="http://ianlunn.github.io/Hover/" target="_blank">Hover CSS</a></li>
                        <li><a href="https://github.com/aFarkas/html5shiv" target="_blank">HTML5 Shiv</a></li>
						<li><a href="https://github.com/karacas/imgLiquid" target="_blank">ImgLiquid JS</a></li>
						<li><a href="https://jquery.com/" target="_blank">jQuery</a></li>
						<li><a href="https://github.com/pupunzi/jquery.mb.browser" target="_blank">jQuery Browser</a></li>
						<li><a href="https://github.com/js-cookie/js-cookie" target="_blank">jQuery Cookie</a></li>
						<li><a href="https://github.com/kayahr/jquery-fullscreen-plugin" target="_blank">jQuery Fullscreen</a></li>
						<li><a href="http://jqueryrotate.com/" target="_blank">jQuery Rotate</a></li>
						<li><a href="https://jqueryui.com/" target="_blank">jQuery UI</a></li>
						<li><a href="http://sachinchoolur.github.io/lightGallery/" target="_blank">Light Gallery</a></li>
                        <li><a href="https://masonry.desandro.com/" target="_blank">Masonry JS</a></li>
						<li><a href="https://github.com/PHPMailer/PHPMailer/" target="_blank">PHP Mailer</a></li>
						<li><a href="https://github.com/chuckcarpenter/REM-unit-polyfill" target="_blank">REM Unit Polyfill</a></li>
						<li><a href="https://github.com/scottjehl/Respond" target="_blank">Respond JS</a></li>
						<li><a href="https://www.tiny.cloud/" target="_blank">TinyMCE</a></li>
						<li><a href="http://labs.rampinteractive.co.uk/touchSwipe/demos/" target="_blank">Touch Swipe</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Utilities <span class="caret"></span></a>
					<ul class="dropdown-menu dropdown-overflow-lg notranslate" role="menu">
						<li><a href="https://github.com/TriForceX/WebsiteBase/wiki" target="_blank">Repository Wiki</a></li>
						<li class="divider"></li>
						<li><a href="https://www.w3schools.com" target="_blank">W3 Schools Tutorials</a></li>
						<li><a href="http://bootsnipp.com" target="_blank">Bootstrap Snippets</a></li>
						<li><a href="https://libraries.io" target="_blank">Open Source Libraries</a></li>
						<li><a href="https://www.jqueryscript.net/" target="_blank">jQuery Scripts</a></li>
						<li><a href="https://api.jquery.com" target="_blank">jQuery API</a></li>
						<li><a href="http://jqueryui.com" target="_blank">jQuery UI API</a></li>
						<li><a href="http://php.net" target="_blank">PHP Documentation</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle notranslate" data-toggle="dropdown" role="button" aria-expanded="false">Bootstrap <sup>3.3.7</sup> <span class="caret"></span></a>
					<ul class="dropdown-menu dropdown-overflow-lg" role="menu">
						<li><a href="http://getbootstrap.com/docs/3.3/css/" target="_blank">CSS</a></li>
						<li><a href="http://getbootstrap.com/docs/3.3/components/" target="_blank">Components</a></li>
						<li><a href="http://getbootstrap.com/docs/3.3/javascript/" target="_blank">Javascript</a></li>
						<li class="divider"></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/starter-template/" target="_blank">Starter template</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/grid/" target="_blank">Grids</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/jumbotron/" target="_blank">Jumbotron</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/jumbotron-narrow/" target="_blank">Narrow jumbotron</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/navbar/" target="_blank">Navbar</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/navbar-static-top/" target="_blank">Static top navbar</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/navbar-fixed-top/" target="_blank">Fixed navbar</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/cover/" target="_blank">Cover</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/carousel/" target="_blank">Carousel</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/blog/" target="_blank">Blog</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/dashboard/" target="_blank">Dashboard</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/signin/" target="_blank">Sign-in page</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/justified-nav/" target="_blank">Justified nav</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/sticky-footer/" target="_blank">Sticky footer</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/sticky-footer-navbar/" target="_blank">Sticky footer fixed navbar</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/non-responsive/" target="_blank">Non-responsive Bootstrap</a></li>
						<li class="dropdown-header"><a href="http://getbootstrap.com/docs/3.3/examples/offcanvas/" target="_blank">Off-canvas</a></li>
					</ul>
				</li>
				@if(!(stripos(Request::ip(), 'localhost') !== false) || !(stripos(Request::ip(), '192.168.') !== false))
				<li>
					<div id="google_translate_element"></div>
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
					<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
				</li>
				@endif
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</nav>
<!-- ================================================= NAV MENU ================================================= -->

<!-- ================================================= CONTENT ================================================= -->
<div class="content">
	<div class="container theme-showcase">
		<!-- MAIN CONTAINER -->
		
		<!-- ******** LOADING BAR ******** -->
		
		<div class="progress JSloadProgressTest">
			<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">0% Complete (danger)</span>
			</div>
		</div>
		
		<!-- ******** LOADING BAR ******** -->
		
		<p>&nbsp;</p>
		
		<!-- ******** RESOURCES EXAMPLES ******** -->

		<!-- Section Description -->

		<div class="jumbotron">
			<h1>Resources Examples</h1>
			<p>Some useful code functions and improvments in <code>PHP</code> or <code>JS</code> using the included resources in this repository.</p>
		</div>

		<!-- Section Description -->

		<!-- lightGallery Example -->

		<div class="page-header notranslate">
			<h1>Light Gallery <span class="label label-danger">Plugin</span></h1>
		</div>
		<p>A customizable, modular, responsive, gallery plugin for <b>jQuery</b>. Below you will find an improved usage method via <code>data-lg-attributes</code> applied to the main gallery container.

		<table class="table table-bordered table-striped js-options-table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="notranslate">data-lg-item</td>
					<td>Defines which element contains the image <b>url</b> and the <b>thumbnail</b>. If is <code>auto</code> it will takes all <code>&lt;a&gt;</code> tag.</td>
				</tr>
				<tr>
					<td class="notranslate">data-lg-title</td>
					<td>Set a custom title to all images in the gallery. If is <code>auto</code> it will takes all <code>&lt;a&gt;</code> title attribute.</td>
				</tr>
				<tr>
					<td class="notranslate">data-lg-thumb</td>
					<td>Defines if thumbnails will be shown when the gallery is executed.</td>
				</tr>
				<tr>
					<td class="notranslate">data-lg-download</td>
					<td>Enables downloads, the download url will be taken from <code>data-src</code> or <code>href</code>.</td>
				</tr>
				<tr>
					<td class="notranslate">data-lg-autoplay</td>
					<td>Enables autoplay controls.</td>
				</tr>
				<tr>
					<td class="notranslate">data-lg-loop</td>
					<td>When you get the last image it will change to the first image.</td>
				</tr>
				<tr>
					<td class="notranslate">data-lg-share</td>
					<td>Enables social share buttons.</td>
				</tr>
				<tr>
					<td class="notranslate">data-lg-gallery</td>
					<td>Show the <b>previous</b> or <b>next</b> page controls inside the gallery. Includes auto redirection.</td>
				</tr>
				<tr>
					<td class="notranslate">data-lg-page-total</td>
					<td>Set the <b>total amount</b> of the gallery pages. This is <b>show</b> or <b>hide</b> the <b>previous</b> or <b>next</b> controls inside the gallery.</td>
				</tr>
				<tr>
					<td class="notranslate">data-lg-page-current</td>
					<td>Set the current <b>active</b> page. This is <b>show</b> or <b>hide</b> the <b>previous</b> or <b>next</b> controls inside the gallery.</td>
				</tr>
			</tbody>
		</table>

		<div class="bs-example">
			<div class="row JSlightGallery" data-lg-item="auto" data-lg-title="auto" data-lg-thumb="false" data-lg-download="false" data-lg-share="true" data-lg-autoplay="true" data-lg-loop="false" data-lg-gallery="false">
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 1" href="https://getbootstrap.com/docs/3.3/examples/screenshots/theme.jpg">
						<img src="https://getbootstrap.com/docs/3.3/examples/screenshots/theme.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 2" href="https://getbootstrap.com/docs/3.3/examples/screenshots/cover.jpg">
						<img src="https://getbootstrap.com/docs/3.3/examples/screenshots/cover.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 3" href="https://getbootstrap.com/docs/3.3/examples/screenshots/justified-nav.jpg">
						<img src="https://getbootstrap.com/docs/3.3/examples/screenshots/justified-nav.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 3" href="https://getbootstrap.com/docs/3.3/examples/screenshots/dashboard.jpg">
						<img src="https://getbootstrap.com/docs/3.3/examples/screenshots/dashboard.jpg">
					</a>
				</div>
			</div>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;div class="JSlightGallery" data-lg-item="auto" data-lg-title="auto" data-lg-thumb="false" data-lg-download="false" data-lg-share="true" data-lg-autoplay="true" data-lg-loop="false" data-lg-gallery="false"&gt;<br>...<br>&lt;/div&gt;</code></pre>
		</figure>
		
		<h3 class="JSlightGalleryExample">Gallery Mode</h3>
		<p>This mode allows to improve the way to show paged galleries executing custom functions when you get the <code>first</code> or <code>last</code> page.</p>

		<div class="bs-example">
			<?php
			if(!isset($_GET['page'])){
				$_GET['page'] = null;
			}
			?>
			<div class="row JSlightGallery" data-lg-item="auto" data-lg-title="Gallery title" data-lg-thumb="true" data-lg-download="true" data-lg-share="true" data-lg-autoplay="true" data-lg-loop="false" data-lg-gallery="true" data-lg-page-total="3" data-lg-page-current="<?php echo empty($_GET["page"]) ? '1' : $_GET["page"]; ?>">
				<?php if($_GET["page"]=="2"): ?>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 5" href="https://getbootstrap.com/docs/3.3/examples/screenshots/offcanvas.jpg">
						<img src="https://getbootstrap.com/docs/3.3/examples/screenshots/offcanvas.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 6" href="https://getbootstrap.com/docs/3.3/examples/screenshots/sign-in.jpg">
						<img src="https://getbootstrap.com/docs/3.3/examples/screenshots/sign-in.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 7" href="https://getbootstrap.com/docs/3.3/examples/screenshots/jumbotron-narrow.jpg">
						<img src="https://getbootstrap.com/docs/3.3/examples/screenshots/jumbotron-narrow.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 8" href="https://getbootstrap.com/docs/3.3/examples/screenshots/blog.jpg">
						<img src="https://getbootstrap.com/docs/3.3/examples/screenshots/blog.jpg">
					</a>
				</div>
				<?php elseif($_GET["page"]=="3"): ?>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 5" href="https://getbootstrap.com/docs/3.3/examples/screenshots/carousel.jpg">
						<img src="https://getbootstrap.com/docs/3.3/examples/screenshots/carousel.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 6" href="https://getbootstrap.com/docs/3.3/examples/screenshots/sticky-footer-navbar.jpg">
						<img src="https://getbootstrap.com/docs/3.3/examples/screenshots/sticky-footer-navbar.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 7" href="https://getbootstrap.com/docs/3.3/examples/screenshots/grid.jpg">
						<img src="https://getbootstrap.com/docs/3.3/examples/screenshots/grid.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 8" href="https://getbootstrap.com/docs/3.3/examples/screenshots/navbar.jpg">
						<img src="https://getbootstrap.com/docs/3.3/examples/screenshots/navbar.jpg">
					</a>
				</div>
				<?php else: ?>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 1" href="https://getbootstrap.com/docs/3.3/examples/screenshots/theme.jpg">
						<img src="https://getbootstrap.com/docs/3.3/examples/screenshots/theme.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 2" href="https://getbootstrap.com/docs/3.3/examples/screenshots/cover.jpg">
						<img src="https://getbootstrap.com/docs/3.3/examples/screenshots/cover.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 3" href="https://getbootstrap.com/docs/3.3/examples/screenshots/justified-nav.jpg">
						<img src="https://getbootstrap.com/docs/3.3/examples/screenshots/justified-nav.jpg">
					</a>
				</div>
				<div class="col-md-3">
					<a class="thumbnail" style="height:100px; overflow: hidden" title="My image 4" href="https://getbootstrap.com/docs/3.3/examples/screenshots/dashboard.jpg">
						<img src="https://getbootstrap.com/docs/3.3/examples/screenshots/dashboard.jpg">
					</a>
				</div>
				<?php endif; ?>
			</div>

			<nav aria-label="Page navigation">
				<ul class="pagination no-margin">
					<li>
						<a href="?page=<?php echo $_GET["page"]=="3" ? '2' : ($_GET["page"]=="2" ? '1' : ($_GET["page"]=="1" ? '#' : '#')); ?>" aria-label="Previous" class="JSpagePrev">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>
					<li class="<?php echo $_GET["page"]=="1" || empty($_GET["page"]) ? 'active' : '' ?>"><a href="?page=1">1</a></li>
					<li class="<?php echo $_GET["page"]=="2" ? 'active' : '' ?>"><a href="?page=2">2</a></li>
					<li class="<?php echo $_GET["page"]=="3" ? 'active' : '' ?>"><a href="?page=3">3</a></li>
					<li>
						<a href="?page=<?php echo $_GET["page"]=="3" ? '#' : ($_GET["page"]=="2" ? '3' : ($_GET["page"]=="1" ? '2' : '2')); ?>" aria-label="Next" class="JSpageNext">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>
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
				Remember to add the <b>previous</b> and <b>next</b> events in the <b>JS</b> to detect which actions will be executed on each case. Take a look in the file <code>app-example.js</code> for <code>onPrevPageChange.lg</code> and <code>onNextPageChange.lg</code> events examples.
			</div>
		</div>
		</p>

		<!-- lightGallery Example -->

		<!-- Data Tables Example -->

		<div class="page-header notranslate">
			<h1>Data Tables <span class="label label-danger">Plugin</span></h1>
		</div>
		
		<p>Improve the way to show plain or dynamic <b>HTML tables</b>. Below you will find the usage method via <code>data</code> attributes.</p>
		
		<table class="table table-bordered table-striped js-options-table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="notranslate">data-paging</td>
					<td>Enables a paginator</td>
				</tr>
				<tr>
					<td class="notranslate"> data-searching</td>
					<td>Enables a search box to filter results</td>
				</tr>
				<tr>
					<td class="notranslate">data-info</td>
					<td>Show info at the table footer</td>
				</tr>
				<tr>
					<td class="notranslate">data-ordering</td>
					<td>Enables ordering by column</td>
				</tr>
			</tbody>
		</table>

		<div class="bs-example table-responsive notranslate">
			<table class="table table-striped table-bordered JSdataTables" data-paging="true" data-searching="true" data-info="true" data-ordering="true" cellspacing="0" cellpadding="0" border="0">
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
			<pre><code class="language-html" data-lang="html">&lt;table class="table table-striped table-bordered JSdataTables" data-paging="true" data-searching="true" data-info="true" data-ordering="true"&gt;<br>...<br>&lt;/table&gt;</code></pre>
		</figure>

		<!-- Data Tables Example -->

		<!-- Show Alert example -->

		<div class="page-header notranslate">
			<h1>Show Alert BootBox <span class="label label-danger">Plugin</span></h1>
		</div>
		<p>Launch a custom modal box using <b>BootBox</b> features, the function structure is <code>showAlert(title, text, size, align, animate)</code>. You can alternatively set a size and alignment classes like <b>horizontal vertical</b> (For example: <code>right center</code>).</p>

		<div class="bs-example">
			<button type="button" class="btn btn-primary" onclick="showAlert('Small Size Box','This is a text shown in a modal box','small','center')">Show Alert Small Size (Centered)</button>
			<button type="button" class="btn btn-primary" onclick="showAlert('Medium Size Box','This is a text shown in a modal box')">Show Alert Medium Size (By default)</button>
			<button type="button" class="btn btn-primary" onclick="showAlert('Large Size Box','This is a text shown in a modal box','large')">Show Alert Large Size</button>
			<button type="button" class="btn btn-primary" onclick="showAlert('Extra Large Size Box','This is a text shown in a modal box','extra-large')">Show Alert Extra Large Size</button>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;a onclick="showAlert('Small Size Box','This is a text shown in a modal box','small','center')">Click Here&lt;/a&gt;<br>&lt;a onclick="showAlert('Medium Size Box','This is a text shown in a modal box')">Click Here&lt;/a&gt;<br>&lt;a onclick="showAlert('Large Size Box','This is a text shown in a modal box','large')">Click Here&lt;/a&gt;<br>&lt;a onclick="showAlert('Extra Large Size Box','This is a text shown in a modal box','extra-large')">Click Here&lt;/a&gt;</code></pre>
		</figure>

		<!-- Show Alert example -->
		
		<!-- Show Content Example -->

		<div class="page-header notranslate">
			<h1>Show Content BootBox <span class="label label-danger">Plugin</span></h1>
		</div>
		<p>Launch a custom modal box using <b>BootBox</b> features, the function shows the content from an element, the structure is <code>showContent(title, element, size, align, animate)</code>. You can alternatively set a size and alignment classes like <b>horizontal vertical</b> (For example: <code>right center</code>).</p>

		<div class="bs-example">
			<button type="button" class="btn btn-primary" onclick="showContent('Small Size Box','.showContentExample','small','center')">Show Content Small Size (Centered)</button>
			<button type="button" class="btn btn-primary" onclick="showContent('Medium Size Box','.showContentExample')">Show Content Medium Size (By default)</button>
			<button type="button" class="btn btn-primary" onclick="showContent('Large Size Box','.showContentExample','large')">Show Content Large Size</button>
			<button type="button" class="btn btn-primary" onclick="showContent('Large Size Box','.showContentExample','extra-large')">Show Alert Extra Large Size</button>
			<div class="showContentExample hidden">
				Hello <b>World!</b><br><i><u>This is my message in HTML</u> from a hidden element...</i>
			</div>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;a onclick="showContent('Small Size Box','.showContentExample','small')">Click Here&lt;/a&gt;<br>&lt;a onclick="showContent('Medium Size Box','.showContentExample')">Click Here&lt;/a&gt;<br>&lt;a onclick="showContent('Large Size Box','.showContentExample','large')">Click Here&lt;/a&gt;<br>&lt;a onclick="showContent('Extra Large Size Box','.showContentExample','extra-large')">Click Here&lt;/a&gt;</code></pre>
		</figure>

		<!-- Show Content Example -->

		<!-- Video Launch Example -->

		<div class="page-header notranslate">
			<h1>Video Launch <span class="label label-danger">Custom</span></h1>
		</div>
		<p>Launch a modal box with a basic video player, the function structure is <code>videoLaunch(title, url, share, autoplay, size, align, animate)</code>. You can alternatively set a size and alignment classes like <b>horizontal vertical</b> (For example: <code>right center</code>).</p>

		<div class="bs-example">
			<button type="button" class="btn btn-primary" onclick="videoLaunch('My YouTube Video','https://youtube.com/watch?v=ae6aeo9-Kn8',true,true,'medium','center')">YouTube Video (Medium size & centered)</button>
			<button type="button" class="btn btn-primary" onclick="videoLaunch('My Vimeo Video','https://vimeo.com/214352663',false,false)">Vimeo Video (No share URL + No autoplay)</button>
			<button type="button" class="btn btn-primary" onclick="videoLaunch('My Facebook Video','https://web.facebook.com/ign/videos/275980713021701/')">Facebook Video (Only title + URL)</button>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;a onclick="videoLaunch('My YouTube Video','https://youtube.com/watch?v=ae6aeo9-Kn8',true,true,'medium','center')">Click Here&lt;/a&gt;<br>&lt;a onclick="videoLaunch('My Vimeo Video','https://vimeo.com/214352663',false,false)">Click Here&lt;/a&gt;<br>&lt;a onclick="videoLaunch('My Facebook Video','https://web.facebook.com/ign/videos/275980713021701/')">Click Here&lt;/a&gt;</code></pre>
		</figure>

		<!-- Video Launch Example -->

		<!-- Window Popup Example -->

		<div class="page-header notranslate">
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
					<td class="notranslate">data-win-url</td>
					<td>Website URL to show in the pop-up</td>
				</tr>
				<tr>
					<td class="notranslate">data-win-size</td>
					<td>Width & Height (in pixels) of the pop-up, Need to be written like <b>Width</b>x<b>Height</b></td>
				</tr>
				<tr>
					<td class="notranslate">data-win-align</td>
					<td>Horizontal & Vertical alignment (in pixels) of the pop-up, Need to be written like <b>horizontal</b>,<b>vertical</b> and the values can be <code>left</code>, <code>center</code> or <code>right</code></td>
				</tr>
				<tr>
					<td class="notranslate">data-win-scroll</td>
					<td>Enable or disable scrollbar in the pop-up</td>
				</tr>
				<tr>
					<td class="notranslate">data-win-modal-size</td>
					<td>Alternative to set error modal size classes like <code>small</code>, <code>medium</code>, <code>large</code> or <code>extra-large</code></td>
				</tr>
				<tr>
					<td class="notranslate">data-win-modal-align</td>
					<td>Alternative to set error modal alignment classes like <b>horizontal vertical</b> (For example: <code>right center</code>)</td>
				</tr>
				<tr>
					<td class="notranslate">data-win-modal-animate</td>
					<td>Alternative to change or disable the modal animation. You can choose between <code>true</code>, <code>false</code> or <code>alternative</code></td>
				</tr>
			</tbody>
		</table>

		<div class="bs-example">
			<button type="button" class="btn btn-primary JSwindowPopup" data-win-url="http://getbootstrap.com/docs/3.3" data-win-size="640x480" data-win-align="center,center" data-win-scroll="yes">Center Center 640 x 480</button>
			<button type="button" class="btn btn-primary JSwindowPopup" data-win-url="http://getbootstrap.com/docs/3.3" data-win-size="320x480" data-win-align="right,bottom" data-win-scroll="yes">Right Bottom 320 x 480</button>
			<button type="button" class="btn btn-primary JSwindowPopup" data-win-url="http://getbootstrap.com/docs/3.3" data-win-size="320x480" data-win-align="left,top" data-win-scroll="yes">Left Top 320 x 480</button>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;a class="JSwindowPopup" data-win-url="http://getbootstrap.com/docs/3.3" data-win-size="640x480" data-win-align="center,center" data-win-scroll="yes">Click Here&lt;/a&gt;<br>&lt;a class="JSwindowPopup" data-win-url="http://getbootstrap.com/docs/3.3" data-win-size="320x480" data-win-align="right,bottom" data-win-scroll="yes">Click Here&lt;/a&gt;<br>&lt;a class="JSwindowPopup" data-win-url="http://getbootstrap.com/docs/3.3" data-win-size="320x480" data-win-align="left,top" data-win-scroll="yes">Click Here&lt;/a&gt;</code></pre>
		</figure>
				
		<!-- Window Popup Example -->
				
		<!-- Map launch example -->

		<div class="page-header notranslate">
			<h1>Map Launch <span class="label label-danger">Custom</span></h1>
		</div>
		<p>Show a modal box with map options such as <code>Google Maps</code> and <code>Waze</code>. Below you will find an improved usage method via <code>data-map</code> attributes.</p>

		<table class="table table-bordered table-striped js-options-table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="notranslate">data-map-address</td>
					<td>The map address to search</code>
					</td>
				</tr>
				<tr>
					<td class="notranslate">data-map-coords-1</td>
					<td>Desired address coords from <code>Google Maps</code> <b>latitude</b>, <b>longitude</b>, <b>zoom</b>
					</td>
				</tr>
				<tr>
					<td class="notranslate">data-map-coords-2</td>
					<td>Desired address coords from <code>Waze</code> <b>latitude</b>, <b>longitude</b>, <b>zoom</b>
					</td>
				</tr>
				<tr>
					<td class="notranslate">data-map-iframe</td>
					<td>Alternative to show an iframe for <code>Google Maps</code> with <code>true</code> or <code>false</code> 
					</td>
				</tr>
				<tr>
					<td class="notranslate">data-map-modal-size</td>
					<td>Alternative to set modal size classes like <code>small</code>, <code>medium</code>, <code>large</code> or <code>extra-large</code>
					</td>
				</tr>
				<tr>
					<td class="notranslate">data-map-modal-align</td>
					<td>Alternative to set modal alignment classes like <b>horizontal vertical</b> (For example: <code>right center</code>)
					</td>
				</tr>
				<tr>
					<td class="notranslate">data-map-modal-animate</td>
					<td>Alternative to change or disable the modal animation. You can choose between <code>true</code>, <code>false</code> or <code>alternative</code></td>
				</tr>
			</tbody>
		</table>

		<div class="bs-example">
			<button type="button" class="btn btn-primary JSmapLaunch" data-map-address="Renato Sánchez 4265, Las Condes, Santiago, Chile" data-map-coords-1="-33.4176466,-70.585256,17" data-map-coords-2="-33.41748,-70.58519,17" data-map-modal-size="small" data-map-modal-align="center" data-map-modal-animate="true">Show Map Launch (Normal & Centered)</button>
			<button type="button" class="btn btn-primary JSmapLaunch" data-map-address="Renato Sánchez 4265, Las Condes, Santiago, Chile" data-map-coords-1="-33.4176466,-70.585256,17" data-map-coords-2="-33.41748,-70.58519,17" data-map-iframe="true">Show Map Launch (With Map)</button>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;button type="button" class="btn btn-primary JSmapLaunch" data-map-address="Renato Sánchez 4265, Las Condes, Santiago, Chile" data-map-coords-1="-33.4176466,-70.585256,17" data-map-coords-2="-33.41748,-70.58519,17" data-map-modal-size="small" data-map-modal-align="center"&gt;Show Map Launch (Normal & Centered)&lt;/button&gt;
&lt;button type="button" class="btn btn-primary JSmapLaunch" data-map-address="Renato Sánchez 4265, Las Condes, Santiago, Chile" data-map-coords-1="-33.4176466,-70.585256,17" data-map-coords-2="-33.41748,-70.58519,17" data-map-iframe="true"&gt;Show Map Launch (With Map)&lt;/button&gt;</code></pre>
		</figure>

		<!-- Map Launch Example -->

		<!-- Form Validation -->

		<div class="page-header notranslate">
			<h1>Forms Validation <span class="label label-danger">Custom</span></h1>
		</div>
		<p>Basic validation for forms. The elements validated are <code>input</code>, <code>select</code>, <code>checkbox</code>, <code>radio</code> and <code>textarea</code>. The main function is <code>$(elem).validateForm(options);</code></p></p>
		
		<div class="bs-example notranslate">
			<form class="JSformExample" method="post" action="javascript:showAlert('Form Success!','The form passed sucessfully! Thanks!');">
				<div class="form-group">
					<label for="example-input-username">User Name</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
						<input type="text" class="form-control" id="example-input-username" name="example-input-username" placeholder="Type your User Name">
					</div>
				</div>
				<div class="form-group">
					<label for="example-input-password">Password</label>
					<div class="input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></span>
						<input type="password" class="form-control" id="example-input-password" name="example-input-password" placeholder="Type your Password">
					</div>
				</div>
				<div class="form-group">
					<label for="example-input-firstname">First Name</label>
					<input type="text" class="form-control" id="example-input-firstname" name="example-input-firstname" placeholder="Type your First Name">
				</div>
				<div class="form-group">
					<label for="example-input-lastname">Last Name</label>
					<input type="text" class="form-control" id="example-input-lastname" name="example-input-lastname" placeholder="Type your Last Name (Optional)">
				</div>
				<div class="form-group">
					<label for="example-input-age">Age</label>
					<input type="number" step="any" class="form-control" id="example-input-age" name="example-input-age" placeholder="Type your Age">
				</div>
				<div class="form-group">
					<label for="example-input-custom">Custom Input</label>
					<input type="text" class="form-control" id="example-input-custom" name="example-input-custom" placeholder="Type the word 'Custom'">
				</div>
				<div class="form-group">
					<label for="example-input-email">E-Mail address</label>
					<input type="email" class="form-control" id="example-input-email" name="example-input-email" placeholder="Type your E-Mail">
				</div>
				<div class="form-group">
					<label for="example-input-tel">Phone Number</label>
					<input type="tel" class="form-control" id="example-input-tel" name="example-input-tel" placeholder="Type your Phone Number">
				</div>
				<div class="form-group has-feedback">
					<label for="example-select">Select Item</label>
					<select class="form-control" id="example-select" name="example-select">
						<option>Select an item</option>
						<option value="1">Item 1</option>
						<option value="2">Item 2</option>
						<option value="3">Item 3</option>
						<option value="4">Item 4</option>
						<option value="5">Item 5</option>
					</select>
					<span class="glyphicon glyphicon-chevron-down form-control-feedback" aria-hidden="true"></span>
				</div>
				<div class="form-group">
					<label for="example-textarea">Message</label>
					<textarea class="form-control textarea-no-resize" rows="3" id="example-textarea" name="example-textarea" placeholder="Write a Message"></textarea>
				</div>
				<div class="form-group">
					<label for="bases-archivo">File</label>
					<div class="input-group">
						<div class="form-control custom-file">
							<div class="custom-file-text"><span>Select File</span></div>
							<input type="file" id="example-file" name="example-file" placeholder="Select File">
						</div>
						<label class="input-group-btn" for="example-file">
							<span class="btn btn-primary">Search</span>
						</label>
					</div>
				</div>
				<div class="form-group" data-group="checkbox-addon">
					<label for="example-website-url">Website</label>
					<div class="input-group">
						<span class="input-group-addon">
							<label for="example-website-enable">
								<input type="checkbox" name="example-website-enable" id="example-website-enable"> 
								Enable
							</label>
						</span>
						<input type="text" class="form-control" name="example-website-url" id="example-website-url" placeholder="Type your Website URL">
					</div>
				</div>
				<div class="form-group" data-group="radio-addon">
					<label for="example-website-url">Social Network</label>
					<div class="row">
						<div class="col-xs-12 col-sm-6 mb-3 mb-sm-0">
							<div class="input-group">
								<span class="input-group-addon">
									<input type="radio" name="example-social-enable" id="example-social-1" autocomplete="off" value="Social 1 Enable">
								</span>
								<input type="text" class="form-control" name="example-social-1-url" id="example-social-1-url" placeholder="Type your Social Network URL">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 mb-3 mb-sm-0">
							<div class="input-group">
								<span class="input-group-addon">
									<input type="radio" name="example-social-enable" id="example-social-2" autocomplete="off" value="Social 2 Enable">
								</span>
								<input type="text" class="form-control" name="example-social-2-url" id="example-social-2-url" placeholder="Type your Social Network URL">
							</div>
						</div>
					</div>
				</div>
				<div class="form-group" data-group="checkbox">
					<p class="mb-0">
						<label>Check items</label>
					</p>
					<div class="checkbox">
						<label for="example-checkbox-1">
							<input type="checkbox" autocomplete="off" name="example-checkbox-1" id="example-checkbox-1" value="Selected 1"> Checkbox Item 1
						</label>
					</div>
					<div class="checkbox">
						<label for="example-checkbox-2">
							<input type="checkbox" autocomplete="off" name="example-checkbox-2" id="example-checkbox-2" value="Selected 2"> Checkbox Item 2
						</label>
					</div>
					<div class="checkbox">
						<label for="example-checkbox-3">
							<input type="checkbox" autocomplete="off" name="example-checkbox-3" id="example-checkbox-3" value="Selected 3"> Checkbox Item 3
						</label>
					</div>
					<div class="checkbox">
						<label for="example-checkbox-4">
							<input type="checkbox" autocomplete="off" name="example-checkbox-4" id="example-checkbox-4" value="Selected 4"> Checkbox Item 4
						</label>
					</div>
				</div>
				<div class="form-group" data-group="radio">
					<p class="mb-0">
						<label>Radio items</label>
					</p>
					<div class="radio">
						<label for="example-radio-1">
							<input type="radio" name="example-radio" id="example-radio-1" autocomplete="off" value="Choosen 1"> Radio Item 1
						</label>
					</div>
					<div class="radio">
						<label for="example-radio-2">
							<input type="radio" name="example-radio" id="example-radio-2" autocomplete="off" value="Choosen 2"> Radio Item 2
						</label>
					</div>
					<div class="radio">
						<label for="example-radio-3">
							<input type="radio" name="example-radio" id="example-radio-3" autocomplete="off" value="Choosen 3"> Radio Item 3
						</label>
					</div>
					<div class="radio">
						<label for="example-radio-4">
							<input type="radio" name="example-radio" id="example-radio-4" autocomplete="off" value="Choosen 3"> Radio Item 4
						</label>
					</div>
				</div>
				<div class="form-group" data-group="checkbox">
					<p class="mb-0">
						<label>Check items (overflow box)</label>
					</p>
					<div class="input-group-overflow">
						<div class="checkbox">
							<label for="example-checkbox-box-1">
								<input type="checkbox" autocomplete="off" name="example-checkbox-box-1" id="example-checkbox-box-1" value="Selected 1"> Checkbox Box Item 1
							</label>
						</div>
						<div class="checkbox">
							<label for="example-checkbox-box-2">
								<input type="checkbox" autocomplete="off" name="example-checkbox-box-2" id="example-checkbox-box-2" value="Selected 2"> Checkbox Box Item 2
							</label>
						</div>
						<div class="checkbox">
							<label for="example-checkbox-box-3">
								<input type="checkbox" autocomplete="off" name="example-checkbox-box-3" id="example-checkbox-box-3" value="Selected 3"> Checkbox Box Item 3
							</label>
						</div>
						<div class="checkbox">
							<label for="example-checkbox-box-4">
								<input type="checkbox" autocomplete="off" name="example-checkbox-box-4" id="example-checkbox-box-4" value="Selected 4"> Checkbox Box Item 4
							</label>
						</div>
						<div class="checkbox">
							<label for="example-checkbox-box-5">
								<input type="checkbox" autocomplete="off" name="example-checkbox-box-5" id="example-checkbox-box-5" value="Selected 5"> Checkbox Box Item 5
							</label>
						</div>
						<div class="checkbox">
							<label for="example-checkbox-box-6">
								<input type="checkbox" autocomplete="off" name="example-checkbox-box-6" id="example-checkbox-box-6" value="Selected 6"> Checkbox Box Item 6
							</label>
						</div>
					</div>
				</div>
				<div class="form-group" data-toggle="buttons" data-group="checkbox">
					<p class="mb-0">
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
					<p class="mb-0">
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
				<div class="form-group mb-0">
					<button type="reset" class="btn btn-default">Reset</button>
					<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</form>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">$(".JSformExample").validateForm({
	noValidate: "#example-input-lastname",
	hasConfirm: true,
	customValidate: null,
	resetSubmit: true,
	errorStyling: true,
	modalSize: 'medium',
	modalAlign: 'top',
	modalAnimate: true,
});</code></pre>
		</figure>

		<!-- Form Validation -->

		<!-- More Functions -->

		<div class="page-header">
			<h1>More functions! <span class="label label-danger">JS & PHP</span></h1>
		</div>
		<p>There is more functions in the whole code, just play and try it. Remember to check <code>app-base.js</code>, <code>resources.php</code> and <code>utilities.php</code> for more stuff. Also you can find more info about the resources in the main menu.</p>

		<!-- More Functions -->

		<!-- ******** RESOURCES EXAMPLES ******** -->

		<p>&nbsp;</p>
		
		<!-- ******** CSS EXAMPLES ******** -->

		<!-- Section Description -->

		<div class="jumbotron">
			<h1>CSS Resources</h1>
			<p>Some custom classes to use in addition to <code>CSS</code> included in this repository.</p>
		</div>

		<!-- Section Description -->

		<!-- Float BS4 example -->

		<div class="page-header notranslate">
			<h1>Float <span class="label label-danger">BS4</span></h1>
		</div>
		<p>Imported <code>Float</code> property classes from <b>Bootstrap 4</b>. These utility classes float an element to the <b>left</b>, <b>right</b>, or <b>disable</b> floating. Use the same viewport breakpoints as our grid system.</p>

		<p>As such, the classes are named using the format:</p>

		<ul>
		  <li><code class="highlighter-rouge">float-{value}</code> for <code class="highlighter-rouge">xs</code></li>
		  <li><code class="highlighter-rouge">float-{breakpoint}-{value}</code> for <code class="highlighter-rouge">sm</code>, <code class="highlighter-rouge">md</code>, <code class="highlighter-rouge">lg</code>, and <code class="highlighter-rouge">xl</code>.</li>
		</ul>

		<p>Here are all the support classes:</p>

		<ul>
		  <li><code class="highlighter-rouge">float-left</code></li>
		  <li><code class="highlighter-rouge">float-right</code></li>
		  <li><code class="highlighter-rouge">float-none</code></li>
		  <li><code class="highlighter-rouge">float-sm-left</code></li>
		  <li><code class="highlighter-rouge">float-sm-right</code></li>
		  <li><code class="highlighter-rouge">float-sm-none</code></li>
		  <li><code class="highlighter-rouge">float-md-left</code></li>
		  <li><code class="highlighter-rouge">float-md-right</code></li>
		  <li><code class="highlighter-rouge">float-md-none</code></li>
		  <li><code class="highlighter-rouge">float-lg-left</code></li>
		  <li><code class="highlighter-rouge">float-lg-right</code></li>
		  <li><code class="highlighter-rouge">float-lg-none</code></li>
		  <li><code class="highlighter-rouge">float-xl-left</code></li>
		  <li><code class="highlighter-rouge">float-xl-right</code></li>
		  <li><code class="highlighter-rouge">float-xl-none</code></li>
		</ul>

		<div class="bs-example">
			<div class="padding-15" style="display: block">
				<div class="row">
					<div class="col-xs-12">
						<div class="float-sm-right">Float right on viewports sized SM (small) or wider</div><br>
						<div class="float-md-left">Float left on viewports sized MD (medium) or wider</div><br>
						<div class="float-lg-right">Float right on viewports sized LG (large) or wider</div><br>
						<div class="float-xl-left">Float left on viewports sized XL (extra-large) or wider</div>
					</div>
				</div>
			</div>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;div class="float-sm-right"&gt;Float right on viewports sized SM (small) or wider&lt;/div&gt;
&lt;div class="float-md-left"&gt;Float left on viewports sized MD (medium) or wider&lt;/div&gt;
&lt;div class="float-lg-right"&gt;Float right on viewports sized LG (large) or wider&lt;/div&gt;
&lt;div class="float-xl-left"&gt;Float left on viewports sized XL (extra-large) or wider&lt;/div&gt;</code></pre>
		</figure>

		<!-- Float BS4 example -->

		<!-- Spacing BS4 example -->

		<div class="page-header notranslate">
			<h1>Spacing <span class="label label-danger">BS4</span></h1>
		</div>
		<p>Imported <code>Margin</code> and <code>Padding</code> classes from <b>Bootstrap 4</b>. The classes are named using the format <code>{property}{sides}-{size}</code> for xs and <code>{property}{sides}-{breakpoint}-{size}</code> for <b>sm, md, lg,</b> and <b>xl</b>.</p>

		<p>Where <em>property</em> is one of:</p>

		<ul>
		  <li><code class="highlighter-rouge">m</code> - for classes that set <code class="highlighter-rouge">margin</code></li>
		  <li><code class="highlighter-rouge">p</code> - for classes that set <code class="highlighter-rouge">padding</code></li>
		</ul>

		<p>Where <em>sides</em> is one of:</p>

		<ul>
		  <li><code class="highlighter-rouge">t</code> - for classes that set <code class="highlighter-rouge">margin-top</code> or <code class="highlighter-rouge">padding-top</code></li>
		  <li><code class="highlighter-rouge">b</code> - for classes that set <code class="highlighter-rouge">margin-bottom</code> or <code class="highlighter-rouge">padding-bottom</code></li>
		  <li><code class="highlighter-rouge">l</code> - for classes that set <code class="highlighter-rouge">margin-left</code> or <code class="highlighter-rouge">padding-left</code></li>
		  <li><code class="highlighter-rouge">r</code> - for classes that set <code class="highlighter-rouge">margin-right</code> or <code class="highlighter-rouge">padding-right</code></li>
		  <li><code class="highlighter-rouge">x</code> - for classes that set both <code class="highlighter-rouge">*-left</code> and <code class="highlighter-rouge">*-right</code></li>
		  <li><code class="highlighter-rouge">y</code> - for classes that set both <code class="highlighter-rouge">*-top</code> and <code class="highlighter-rouge">*-bottom</code></li>
		  <li>blank - for classes that set a <code class="highlighter-rouge">margin</code> or <code class="highlighter-rouge">padding</code> on all 4 sides of the element</li>
		</ul>

		<p>Where <em>size</em> is one of:</p>

		<ul>
		  <li><code class="highlighter-rouge">0</code> - for classes that eliminate the <code class="highlighter-rouge">margin</code> or <code class="highlighter-rouge">padding</code> by setting it to <code class="highlighter-rouge">0</code></li>
		  <li><code class="highlighter-rouge">1</code> - (by default) for classes that set the <code class="highlighter-rouge">margin</code> or <code class="highlighter-rouge">padding</code> to <code class="highlighter-rouge">$spacer * .25</code></li>
		  <li><code class="highlighter-rouge">2</code> - (by default) for classes that set the <code class="highlighter-rouge">margin</code> or <code class="highlighter-rouge">padding</code> to <code class="highlighter-rouge">$spacer * .5</code></li>
		  <li><code class="highlighter-rouge">3</code> - (by default) for classes that set the <code class="highlighter-rouge">margin</code> or <code class="highlighter-rouge">padding</code> to <code class="highlighter-rouge">$spacer</code></li>
		  <li><code class="highlighter-rouge">4</code> - (by default) for classes that set the <code class="highlighter-rouge">margin</code> or <code class="highlighter-rouge">padding</code> to <code class="highlighter-rouge">$spacer * 1.5</code></li>
		  <li><code class="highlighter-rouge">5</code> - (by default) for classes that set the <code class="highlighter-rouge">margin</code> or <code class="highlighter-rouge">padding</code> to <code class="highlighter-rouge">$spacer * 3</code></li>
		  <li><code class="highlighter-rouge">auto</code> - for classes that set the <code class="highlighter-rouge">margin</code> to auto</li>
		</ul>

		<div class="bs-example text-capitalize">
			<div class="m-5 p-5" style="display:inline-block; vertical-align:top; background:yellow">
				Full margin & padding
			</div><div class="m-5 p-0" style="display:inline-block; vertical-align:top; background:lime">
				Full margin & no padding
			</div><div class="ml-5 mr-5 pt-5" style="display:inline-block; vertical-align:top; background:blue; color:white">
				Margin left + right & padding top
			</div><div class="ml-5 mt-5 pt-5 pb-5" style="display:inline-block; vertical-align:top; background:red; color:white">
				Margin left + top & padding top + bottom
			</div>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;div class="m-5 p-5"&gt;Full margin & padding&lt;/div&gt;
&lt;div class="m-5 p-0"&gt;Full margin & no padding&lt;/div&gt;
&lt;div class="ml-5 mr-5 pt-5"&gt;Margin left + right & padding top&lt;/div&gt;
&lt;div class="ml-5 mt-5 pt-5 pb-5"&gt;Margin left + top & padding top + bottom&lt;/div&gt;</code></pre>
		</figure>

		<!-- Spacing BS4 example -->

		<!-- Display BS4 example -->

		<div class="page-header notranslate">
			<h1>Display property <span class="label label-danger">BS4</span></h1>
		</div>
		<p>Imported <code>Display</code> property classes from <b>Bootstrap 4</b>. Change the value of the display property with our responsive display utility classes.</p>

		<p>As such, the classes are named using the format:</p>

		<ul>
		  <li><code class="highlighter-rouge">d-{value}</code> for <code class="highlighter-rouge">xs</code></li>
		  <li><code class="highlighter-rouge">d-{breakpoint}-{value}</code> for <code class="highlighter-rouge">sm</code>, <code class="highlighter-rouge">md</code>, <code class="highlighter-rouge">lg</code>, and <code class="highlighter-rouge">xl</code>.</li>
		</ul>

		<p>Where <em>value</em> is one of:</p>

		<ul>
		  <li><code class="highlighter-rouge">none</code></li>
		  <li><code class="highlighter-rouge">inline</code></li>
		  <li><code class="highlighter-rouge">inline-block</code></li>
		  <li><code class="highlighter-rouge">block</code></li>
		  <li><code class="highlighter-rouge">table</code></li>
		  <li><code class="highlighter-rouge">table-cell</code></li>
		  <li><code class="highlighter-rouge">table-row</code></li>
		  <li><code class="highlighter-rouge">flex</code></li>
		  <li><code class="highlighter-rouge">inline-flex</code></li>
		</ul>

		<p>The media queries effect screen widths with the given breakpoint <em>or larger</em>. For example, <code class="highlighter-rouge">.d-lg-none</code> sets <code class="highlighter-rouge">display: none;</code> on both <code class="highlighter-rouge">lg</code> and <code class="highlighter-rouge">xl</code> screens.</p>

		<div class="bs-example notranslate">
			<div class="padding-15" style="display: block">
				<div class="row">
					<div class="col-xs-12">
						<div class="d-inline-block mb-4 mr-4" style="background: yellow">Display Inline Block</div> 
						<div class="d-inline-block mb-4" style="background: lime">Display Inline Block</div>
						<div class="d-block mb-4" style="background: blue; color: white">Display Block</div>
						<div class="d-block" style="background: red; color: white">Display Block</div>
					</div>
				</div>
			</div>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;div class="d-inline-block"&gt;Display Inline Block&lt;/div&gt; 
&lt;div class="d-inline-block"&gt;Display Inline Block&lt;/div&gt;
&lt;div class="d-block">Display Block&lt;/div&gt;
&lt;div class="d-block">Display Block&lt;/div&gt;</code></pre>
		</figure>

		<!-- Display BS4 example -->

		<!-- Vertical Alignment BS4 example -->

		<div class="page-header notranslate">
			<h1>Vertical Alignment <span class="label label-danger">BS4</span></h1>
		</div>
		<p>Imported <i>Alignment Classes</i> from <b>Bootstrap 4</b>. Choose from <code>.align-baseline, .align-top, .align-middle, .align-bottom, .align-text-bottom,</code> and <code>.align-text-top</code> as needed.</p>

		<div class="bs-example text-capitalize">
			<div class="padding-15" style="display: block">
				<div class="row">
					<div class="col-xs-12">
						<div class="d-table float-left" style="width:50%; height:150px; background:yellow">
							<div class="d-table-cell align-bottom text-center">
								Aligned bottom
							</div>
						</div><div class="d-table float-left" style="width:50%; height:150px; background:lime">
							<div class="d-table-cell align-middle text-center">
								Aligned middle
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;div class="d-table" style="height:150px;"&gt;
	&lt;div class="d-table-cell align-bottom text-center"&gt;
		Aligned bottom
	&lt;/div&gt;
&lt;/div&gt;
&lt;div class="d-table" style="height:150px;"&gt;
	&lt;div class="d-table-cell align-middle"&gt;
		Aligned middle
	&lt;/div&gt;
&lt;/div&gt;</code></pre>
		</figure>

		<!-- Vertical Alignment BS4 example -->

		<!-- Position BS4 example -->
		
		<div class="page-header notranslate">
			<h1>Position <span class="label label-danger">BS4</span></h1>
		</div>
		<p>Imported <code>Position</code> property classes from <b>Bootstrap 4</b>. Use these shorthand utilities for quickly configuring the position of an element.</p>

		<p>Where <em>value</em> is one of:</p>

		<ul>
		  <li><code class="highlighter-rouge">position-static</code></li>
		  <li><code class="highlighter-rouge">position-relative</code></li>
		  <li><code class="highlighter-rouge">position-absolute</code></li>
		  <li><code class="highlighter-rouge">position-fixed</code></li>
		  <li><code class="highlighter-rouge">position-sticky</code></li>
		  <li><code class="highlighter-rouge">fixed-top</code></li>
		  <li><code class="highlighter-rouge">fixed-bottom</code></li>
		  <li><code class="highlighter-rouge">sticky-top</code></li>
		</ul>

		<div class="bs-example text-capitalize">
			<div class="padding-15" style="display: block">
				<div class="row">
					<div class="col-xs-12">
						<div class="position-relative" style="background: yellow; height: 100px;">
							Position Relative
							<div class="position-absolute" style="background: lime; right: 0px; top: 0px">Position Absolute</div>
						</div> 
					</div>
				</div>
			</div>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;div class="position-relative"&gt;
	Position Relative
	&lt;div class="position-absolute">Position Absolute&lt;/div&gt;
&lt;/div&gt;</code></pre>
		</figure>

		<!-- Position BS4 example -->

		<!-- Text Align BS4 example -->
		
		<div class="page-header notranslate">
			<h1>Text Align <span class="label label-danger">BS4</span></h1>
		</div>
		<p>Imported <code>Text Align</code> classes from <b>Bootstrap 4</b>. Responsive features to current text utilities to control alignment.</p>

		<p>Where <em>value</em> is one of:</p>

		<ul>
		  <li><code class="highlighter-rouge">text-{breakpoint}-{value}</code> for <code class="highlighter-rouge">sm</code>, <code class="highlighter-rouge">md</code>, <code class="highlighter-rouge">lg</code>, and <code class="highlighter-rouge">xl</code>.</li>
		</ul>

		<div class="bs-example">
			<div class="padding-15" style="display: block">
				<div class="row">
					<div class="col-xs-12">
						<p class="text-sm-left">Left aligned Text on viewports sized SM (small) or wider.</p>
						<p class="text-md-center">Left aligned Text on viewports sized MD (medium) or wider.</p>
						<p class="text-lg-right">Left aligned Text on viewports sized LG (large) or wider.</p>
					</div>
				</div>
			</div>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">&lt;p class="text-sm-left">Left aligned Text on viewports sized SM (small) or wider.&lt;/p&gt;
&lt;p class="text-md-center"&gt;Left aligned Text on viewports sized MD (medium) or wider.&lt;/p&gt;
&lt;p class="text-lg-right"&gt;Left aligned Text on viewports sized LG (large) or wider.&lt;/p&gt;</code></pre>
		</figure>

		<!-- Text Align BS4 example -->

		<!-- Carousel Rxample -->

		<div class="page-header notranslate">
			<h1>Carousel <span class="label label-danger">Custom</span></h1>
		</div>
		<p>New classes to the <b>Bootstrap</b> carousel. Remember to manage the transition time interval you can use the attribute <code>data-interval</code> to modify <i>(time in milliseconds)</i>. <i>Note: Touch gestures was added <b>(right or left)</b> on mobile devices</i></p>

		<table class="table table-bordered table-striped js-options-table">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="notranslate">carousel-fade</td>
					<td>Adding this class will change the slide animation to <b>fade in</b> and <b>fade out</b>
					</td>
				</tr>
				<tr>
					<td class="notranslate">carousel-nogradient</td>
					<td>Adding this class will disable the gradients on <b>left</b> and <b>right</b> controls
					</td>
				</tr>
				<tr>
					<td class="notranslate">carousel-noshadow</td>
					<td>Adding this class will disable the shadows on <b>left</b> and <b>right</b> controls and <b>indicators</b>
					</td>
				</tr>
				<tr>
					<td class="notranslate">carousel-nomobile</td>
					<td>Adding this class will disable the <b>left</b> and <b>right</b> controls on mobile devices
					</td>
				</tr>
				<tr>
					<td class="notranslate">carousel-square</td>
					<td>Adding this class will change the indicators to <b>square</b> buttons
					</td>
				</tr>
			</tbody>
		</table>
		
		<div id="carousel-example-generic" class="carousel slide carousel-square carousel-fade carousel-nogradient carousel-noshadow carousel-nomobile" data-ride="carousel" data-interval="3000">
			<ol class="carousel-indicators">
				<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-example-generic" data-slide-to="1"></li>
				<li data-target="#carousel-example-generic" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img data-src="holder.js/1140x500/?auto=yes&theme=sky&text=First Slide" alt="First slide">
				</div>
				<div class="item">
					<img data-src="holder.js/1140x500/?auto=yes&theme=vine&text=Second Slide" alt="Second slide">
				</div>
				<div class="item">
					<img data-src="holder.js/1140x500/?auto=yes&theme=lava&text=Third Slide" alt="Third slide">
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

		<!-- Carousel Rxample -->

		<!-- More Functions -->

		<div class="page-header">
			<h1>More classes! <span class="label label-danger">CSS</span></h1>
		</div>
		<p>There is more classes in the whole code, just play and try it. Remember to check <code>style-base.css</code> or <code>style-bootstrap.css</code> for more stuff <i>(Some of are commented, just copy them in a new file)</i>.</p>

		<!-- More Functions -->

		<!-- ******** CSS EXAMPLES ******** -->

		<!-- MAIN CONTAINER -->
	</div>
</div>
<!-- ================================================= CONTENT ================================================= -->

@endsection