<!-- ================================================= FOOTER ================================================= -->
<div class="footer">
	<div class="container">
		<!-- FOOTER CONTAINER -->
		
		<!-- FOOTER CONTAINER -->
    </div>
</div>
<!-- ================================================= FOOTER ================================================= -->

<!-- ******** FOOTER RESOURCES ******** -->

<!-- jQuery -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/jquery/js/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/jquery-ui/js/jquery-ui.min.js"></script>
<!-- jQuqey Browser -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/jquery-browser/js/jquery.mb.browser.min.js"></script>
<!-- jQuery Cookie -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/jquery-cookie/js/js.cookie.js"></script>
<!-- jQuery Fullscreen -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/jquery-fullscreen/js/jquery.fullscreen.min.js"></script>
<!-- jQuery Rotate -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/jquery-rotate/js/jQueryRotate.js"></script>
<!-- Popper -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/popper/js/popper.js"></script>
<!-- Bootstrap -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/bootstrap/js/bootstrap.min.js"></script>
<!-- Touch Swipe -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/touchswipe/js/jquery.touchSwipe.min.js"></script>
<!-- Bootbox -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/bootbox/js/bootbox.min.js"></script>
<!-- Holder -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/holder/js/holder.min.js"></script>
<!-- Data Tables -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/datatables/js/jquery.dataTables.min.js"></script>
<!-- Data Tables Bootstrap -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/datatables/js/dataTables.bootstrap4.min.js"></script>
<!-- Moment -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/moment/js/moment.min.js"></script>
<!-- Moment Locales -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/moment/js/locales.min.js"></script>
<!-- Tempus Dominus -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- LightGallery -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/lightgallery/js/lightgallery-all.min.js"></script>
<!-- Clipboard -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/clipboard/js/clipboard.min.js"></script>
<!-- Masonry -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/masonry/js/masonry.pkgd.min.js"></script>
<!-- Images Loaded -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/imagesloaded/js/imagesloaded.pkgd.min.js"></script>
<!-- TinyMCE -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/tinymce/js/tinymce.min.js"></script>
<!-- Main JS File -->
<?php echo php::get_template('js'); ?>

<!-- ******** FOOTER RESOURCES ******** -->

<!-- Extra Code -->
<?php echo php::section('footer','get'); ?>

<?php
/* Always have wp_footer() just before the closing </body>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to reference JavaScript files.
 */
wp_footer();
?>
</body>
</html>