<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CROSS
 */

get_header();
?>

<div class="post-container">

	<main id="primary" class="site-main">

		<?php
		custom_breadcrumb();
		
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'post' );

			the_post_navigation(
				array(
					'prev_text' => '<span class="prev">' . esc_html__( 'Previous', 'cross' ) . '</span>',
					'next_text' => '<span class="next">' . esc_html__( 'Next', 'cross' ) . '</span>',
				)
			);

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<?php get_sidebar(); ?>
	
</div>

<?php
get_footer();
