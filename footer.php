<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CROSS
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<p class="copyright"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">&copy; <?php bloginfo( 'name' ); ?></a></p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<div id="switch">
	<input id="dark-mode" type="checkbox">
	<label for="dark-mode" class="btn-switch"></label>
</div>

<?php wp_footer(); ?>

<?php if ( is_front_page() ) { ?>
	<script src="<?php echo get_template_directory_uri() ?>/js/mouse-stalker.js"></script>
<?php } ?>
</body>
</html>
