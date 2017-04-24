<?php include('header.php'); ?>

<style type="text/css">
	
.content{
  padding-bottom: 30px;
}
.theme-dropdown .dropdown-menu {
  position: static;
  display: block;
  margin-bottom: 20px;
}
.theme-showcase > p > .btn {
  margin: 5px 0;
}
.theme-showcase .navbar .container {
  width: auto;
}
.bs-example {
  position: relative;
  padding: 45px 15px 15px;
  margin: 0 -15px 15px;
  border-color: #e5e5e5 #eee #eee;
  border-style: solid;
  border-width: 1px 0;
  -webkit-box-shadow: inset 0 3px 6px rgba(0,0,0,.05);
          box-shadow: inset 0 3px 6px rgba(0,0,0,.05);
}
/* Echo out a label for the example */
/*
 * Examples
 *
 * Isolated sections of example content for each component or feature. Usually
 * followed by a code snippet.
 */

.bs-example {
  position: relative;
  padding: 45px 15px 15px;
  margin: 0 -15px 15px;
  border-color: #e5e5e5 #eee #eee;
  border-style: solid;
  border-width: 1px 0;
  -webkit-box-shadow: inset 0 3px 6px rgba(0,0,0,.05);
          box-shadow: inset 0 3px 6px rgba(0,0,0,.05);
}
/* Echo out a label for the example */
.bs-example:after {
  position: absolute;
  top: 15px;
  left: 15px;
  font-size: 12px;
  font-weight: bold;
  color: #959595;
  text-transform: uppercase;
  letter-spacing: 1px;
  content: "Example";
}

.bs-example-padded-bottom {
  padding-bottom: 24px;
}

/* Tweak display of the code snippets when following an example */
.bs-example + .highlight,
.bs-example + .zero-clipboard + .highlight {
  margin: -15px -15px 15px;
  border-width: 0 0 1px;
  border-radius: 0;
}

/* Make the examples and snippets not full-width */
@media (min-width: 768px) {
  .bs-example {
    margin-right: 0;
    margin-left: 0;
    background-color: #fff;
    border-color: #ddd;
    border-width: 1px;
    border-radius: 4px 4px 0 0;
    -webkit-box-shadow: none;
            box-shadow: none;
  }
  .bs-example + .highlight,
  .bs-example + .zero-clipboard + .highlight {
    margin-top: -16px;
    margin-right: 0;
    margin-left: 0;
    border-width: 1px;
    border-bottom-right-radius: 4px;
    border-bottom-left-radius: 4px;
  }
  .bs-example-standalone {
    border-radius: 4px;
  }
}

/* Undo width of container */
.bs-example .container {
  width: auto;
}

/* Tweak content of examples for optimum awesome */
.bs-example > p:last-child,
.bs-example > ul:last-child,
.bs-example > ol:last-child,
.bs-example > blockquote:last-child,
.bs-example > .form-control:last-child,
.bs-example > .table:last-child,
.bs-example > .navbar:last-child,
.bs-example > .jumbotron:last-child,
.bs-example > .alert:last-child,
.bs-example > .panel:last-child,
.bs-example > .list-group:last-child,
.bs-example > .well:last-child,
.bs-example > .progress:last-child,
.bs-example > .table-responsive:last-child > .table {
  margin-bottom: 0;
}
.bs-example > p > .close {
  float: none;
}

/* Contextual background colors */
.bs-example-bg-classes p {
  padding: 15px;
}

/* Images */
.bs-example > .img-circle,
.bs-example > .img-rounded,
.bs-example > .img-thumbnail {
  margin: 5px;
}

/* Buttons */
.bs-example > .btn,
.bs-example > .btn-group {
  margin-top: 5px;
  margin-bottom: 5px;
}
.bs-example > .btn-toolbar + .btn-toolbar {
  margin-top: 10px;
}
	
.highlight {
  padding: 9px 14px;
  margin-bottom: 14px;
  background-color: #f7f7f9;
  border: 1px solid #e1e1e8;
  border-radius: 4px;
}
.highlight pre {
  padding: 0;
  margin-top: 0;
  margin-bottom: 0;
  word-break: normal;
  white-space: nowrap;
  background-color: transparent;
  border: 0;
}
.highlight pre code {
  font-size: inherit;
  color: #333; /* Effectively the base text color */
}
.highlight pre code:first-child {
  display: inline-block;
  padding-right: 45px;
}

</style>

<nav class="navbar navbar-inverse">
	<div class="container">
	  <div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
		  <span class="sr-only">Toggle navigation</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">Features Examples</a>
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
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Plugins <span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
			  <li><a href="https://datatables.net/examples/styling/bootstrap.html" target="_blank">Data Tables</a></li>
			  <li><a href="http://sachinchoolur.github.io/lightGallery/" target="_blank">Light Gallery</a></li>
			  <li><a href="http://holderjs.com/" target="_blank">Holder JS</a></li>
			  <li class="dropdown-header"><a href="js/holder.html" target="_blank">Holder JS Examples</a></li>
			  <li><a href="http://bootboxjs.com/" target="_blank">BootBox JS</a></li>
			  <li><a href="https://github.com/karacas/imgLiquid" target="_blank">ImgLiquid JS</a></li>
			  <li><a href="https://jqueryui.com/" target="_blank">jQuery UI</a></li>
			  <li><a href="https://github.com/js-cookie/js-cookie" target="_blank">jQuery Cookie</a></li>
			  <li><a href="https://jquerymobile.com/" target="_blank">jQuery Mobile</a></li>
			</ul>
		  </li>
		  <li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Bootstrap <span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
			  <li><a href="http://getbootstrap.com/css/" target="_blank">CSS</a></li>
			  <li><a href="http://getbootstrap.com/components/" target="_blank">Components</a></li>
			  <li><a href="http://getbootstrap.com/javascript/" target="_blank">Javascript</a></li>
			  <li class="divider"></li>
			  <li class="dropdown-header"><a href="examples/starter-template/index.html" target="_blank">Starter template</a></li>
			  <li class="dropdown-header"><a href="examples/blog/index.html" target="_blank">Blog</a></li>
			  <li class="dropdown-header"><a href="examples/carousel/index.html" target="_blank">Carousel</a></li>
			  <li class="dropdown-header"><a href="examples/carousel-more/" target="_blank">Carousel More</a></li>
			  <li class="dropdown-header"><a href="examples/cover/index.html" target="_blank">Cover</a></li>
			  <li class="dropdown-header"><a href="examples/dashboard/index.html" target="_blank">Dashboard</a></li>
			  <li class="dropdown-header"><a href="examples/grid/index.html" target="_blank">Grid</a></li>
			  <li class="dropdown-header"><a href="examples/Jumbotron/index.html" target="_blank">Jumbotron</a></li>
			  <li class="dropdown-header"><a href="examples/jumbotron-narrow/index.html" target="_blank">Jumbotron Narrow</a></li>
			  <li class="dropdown-header"><a href="examples/justified-nav/index.html" target="_blank">Justified Nav</a></li>
			  <li class="dropdown-header"><a href="examples/navbar/index.html" target="_blank">Navbar</a></li>
			  <li class="dropdown-header"><a href="examples/navbar-fixed-top/index.html" target="_blank">Navbar Fixed Top</a></li>
			  <li class="dropdown-header"><a href="examples/navbar-static-top/index.html" target="_blank">Navbar Static Top</a></li>
			  <li class="dropdown-header"><a href="examples/non-responsive/index.html" target="_blank">Non Responsive</a></li>
			  <li class="dropdown-header"><a href="examples/offcanvas/index.html" target="_blank">Off Canvas</a></li>
			  <li class="dropdown-header"><a href="examples/signin/index.html" target="_blank">Sign In</a></li>
			  <li class="dropdown-header"><a href="examples/sticky-footer/index.html" target="_blank">Sticky Footer</a></li>
			  <li class="dropdown-header"><a href="examples/sticky-footer-navbar/index.html" target="_blank">Sticky Footer Navbar</a></li>
			  <li class="dropdown-header"><a href="examples/tooltip-viewport/index.html" target="_blank">Tooltip Viewport</a></li>
			</ul>
		  </li>
		</ul>
	  </div><!--/.nav-collapse -->
	</div>
</nav>

<!-- ================================================= CONTENT ================================================= -->
<div class="content">
	<div class="container theme-showcase" role="main">
	<!-- MAIN CONTAINER -->
		
		<?php 
		
		/*require_once('resources/curl.php');
		$url = "http://www.examplesite.com";
		$data = LoadCURLPage($url);
		$string_one = '<!-- initContent -->';
		$string_two = '<!-- endContent -->';
		$info = extract_unit($data, $string_one, $string_two);
		echo $info;*/
		
		?>
		
		
	<!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Theme example</h1>
        <p>This is a template showcasing the optional theme stylesheet included in Bootstrap. Use it as a starting point to create something more unique by building on or modifying it.</p>
      </div>
		
		
		
  		
  		
  		
		<div class="page-header">
			<h1>Light Gallery</h1>
		</div>
   		<!-- LIGHTGALLERY CONTAINER MANUALLY -->
		<h3>Normal</h3>
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
   		<h3>Gallery Mode (<?php echo isset($_GET["page-2"]) ? 'Page 2' : 'Page 1' ?>)</h3>
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
   		
		
		
		<div class="page-header">
			<h1>Custom PopUp</h1>
		</div>
		<p>Launch a custom pop-up window via javascript, the function structure is <code>windowPopup(url, width, height, alignX, alignY, scroll)</code></p>
		
		<table class="table table-bordered table-striped js-options-table">
			<thead>
				<tr>
					<th>Name</th>
					<th>type</th>
					<th>default</th>
					<th>description</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>url</td>
					<td>string</td>
					<td>null</td>
					<td>Website URL to show in the pop-up</td>
				</tr>
				<tr>
					<td>width</td>
					<td>int</td>
					<td>0</td>
					<td>Width (in pixels) of the pop-up</td>
				</tr>
				<tr>
					<td>height</td>
					<td>int</td>
					<td>0</td>
					<td>Height (in pixels) of the pop-up</td>
				</tr>
				<tr>
					<td>alignX</td>
					<td>string</td>
					<td><code>center</code></td>
					<td>Horizontal alignment of the pop-ip, it can be <code>left</code>, <code>center</code> or <code>right</code></td>
				</tr>
				<tr>
					<td>alignY</td>
					<td>string</td>
					<td><code>center</code></td>
					<td>Vertical alignment of the pop-ip, it can be <code>top</code>, <code>center</code> or <code>bottomt</code></td>
				</tr>
				<tr>
					<td>scroll</td>
					<td>boolean</td>
					<td>false</td>
					<td>Enable or disable scrollbar in the pop-up</td>
				</tr>
			</tbody>
		</table>
		
		<div class="bs-example"> 
			<button type="button" class="btn btn-primary" onclick="windowPopup('http://onlygolf.cl','640','480','center','center','yes')">Center Center 640 x 480</button>
			<button type="button" class="btn btn-primary" onclick="windowPopup('http://onlygolf.cl','320','480','right','bottom','yes')">Right Bottom 320 x 480</button>
			<button type="button" class="btn btn-primary" onclick="windowPopup('http://onlygolf.cl','320','480','left','top','yes')">Left Top 320 x 480</button>
		</div>
		<figure class="highlight">
			<pre><code class="language-html" data-lang="html">windowPopup('http://onlygolf.cl','640','480','center','center','yes')</code></pre>
		</figure>
		
		
		
		<div class="page-header">
			<h1>Show Date Function PHP</h1>
		</div>
		
		<p>
			Date is: <?php echo showDate("2017/09/20", "F j l, Y, g:i a", "esp", true); ?>
		</p>
		
		
		
		
		
		
		
		
		
		
		
		
	


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
          </div><!--/.nav-collapse -->
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
          </div><!--/.nav-collapse -->
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
        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="sr-only">60% Complete</span></div>
      </div>
      <div class="progress">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"><span class="sr-only">40% Complete (success)</span></div>
      </div>
      <div class="progress">
        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"><span class="sr-only">20% Complete</span></div>
      </div>
      <div class="progress">
        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"><span class="sr-only">60% Complete (warning)</span></div>
      </div>
      <div class="progress">
        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"><span class="sr-only">80% Complete (danger)</span></div>
      </div>
      <div class="progress">
        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"><span class="sr-only">60% Complete</span></div>
      </div>
      <div class="progress">
        <div class="progress-bar progress-bar-success" style="width: 35%"><span class="sr-only">35% Complete (success)</span></div>
        <div class="progress-bar progress-bar-warning" style="width: 20%"><span class="sr-only">20% Complete (warning)</span></div>
        <div class="progress-bar progress-bar-danger" style="width: 10%"><span class="sr-only">10% Complete (danger)</span></div>
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
        </div><!-- /.col-sm-4 -->
        <div class="col-sm-4">
          <div class="list-group">
            <a href="#" class="list-group-item active">
              Cras justo odio
            </a>
            <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
            <a href="#" class="list-group-item">Morbi leo risus</a>
            <a href="#" class="list-group-item">Porta ac consectetur ac</a>
            <a href="#" class="list-group-item">Vestibulum at eros</a>
          </div>
        </div><!-- /.col-sm-4 -->
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
        </div><!-- /.col-sm-4 -->
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
        </div><!-- /.col-sm-4 -->
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
        </div><!-- /.col-sm-4 -->
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
        </div><!-- /.col-sm-4 -->
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
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
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
		
		
		
		
		
		
		
		
	<!-- MAIN CONTAINER -->
    </div>
</div>
<!-- ================================================= CONTENT ================================================= -->

<?php include('footer.php'); ?>