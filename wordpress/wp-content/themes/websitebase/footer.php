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
<!-- jQuqey Browser for 1.9+ -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/jquery-browser/js/jquery.mb.browser.min.js"></script>
<!-- jQuery Cookie -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/jquery-cookie/js/js.cookie.js"></script>
<!-- jQuery Fullscreen -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/jquery-fullscreen/js/jquery.fullscreen.min.js"></script>
<!-- Touch Swipe -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/touchswipe/js/jquery.touchSwipe.min.js"></script>
<!-- Bootstrap 3 -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/bootstrap/js/bootstrap.min.js"></script>
<!-- Bootbox Modals -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/bootbox/js/bootbox.min.js"></script>
<!-- Holder JS -->
<!--[if gt IE 8]><!-- -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/holder/js/holder.min.js"></script>
<!--<![endif]-->
<!-- Bootstrap Data Tables -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/datatables/js/dataTables.bootstrap.min.js"></script>
<!-- imgLiquid Fix -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/imgliquid/js/imgliquid.min.js"></script>
<!-- LightGallery Lightbox -->
<!--[if lt IE 9]>
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/lightgallery/js/lightgallery.js"></script>
<![endif]-->
<!--[if gt IE 8]><!-- -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/lightgallery/js/lightgallery-all.min.js"></script>
<!--<![endif]-->
<!-- Clipboard JS -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/clipboard/js/clipboard.min.js"></script>
<!-- Masonry -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/masonry/js/masonry.min.js"></script>
<!-- Moment JS -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/moment/js/moment.min.js"></script>
<!-- Tempus Dominus -->
<script src="<?php echo get_bloginfo('template_url'); ?>/resources/tempusdominus/js/tempusdominus.min.js"></script>
<!-- Main JS File -->
<script src="<?php echo php::get_template('js'); ?>"></script>

<!-- ******** FOOTER RESOURCES ******** -->

<!-- Extra Code -->
<?php echo php::extra_code('footer','get'); ?>

<?php
/* Always have wp_footer() just before the closing </body>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to reference JavaScript files.
 */
wp_footer();
?>
</body>
</html>