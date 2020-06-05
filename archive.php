<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CROSS
 */

get_header();
?>

<div class="post-container">
	
	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>
		
			<?php custom_breadcrumb(); ?>
			
			<header class="page-header">
				<?php
				if ( is_single() ) {
					the_archive_title( '<h1 class="page-title">Blog<span>', '</span></h1>' );
				} elseif ( is_category() ) {
					the_archive_title( '<h1 class="page-title">Category<span>', '</span></h1>' );
				} elseif ( is_tag() ) {
					the_archive_title( '<h1 class="page-title">Tag<span>', '</span></h1>' );
				} elseif ( is_month() ) {
					the_archive_title( '<h1 class="page-title">Month<span>', '</span></h1>' );
				}
				?>
			</header><!-- .page-header -->
			
			<div class="news-list">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'archive' );

			endwhile;
			?>
			
			</div>
			
			<?php

			pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

	<?php get_sidebar(); ?>
	
</div>

<?php
get_footer();
