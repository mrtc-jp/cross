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
				<h1 class="page-title">Design Archives</h1>
			</header><!-- .page-header -->
			
			<div class="design-list">

			<?php
				while ( have_posts() ) : the_post();
				$URL = post_custom('URL');
			?>	
			
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-thumbnail">
						<a href="<?php echo $URL; ?>" class="thumbnail" target="_blank">
							<img src="https://s.wordpress.com/mshots/v1/<?php echo $URL; ?>?w=400" alt="<?php the_title(); ?>">
						</a>
					</div>
					<div class="entry-excerpt">
						<p class="entry-title"><a href="<?php echo $URL; ?>"><?php the_title(); ?></a></p>
						<?php the_content(); ?>
						<p class="entry-tags"><?php echo get_the_term_list( $post->ID,'design-tags','','' ); ?></p>
					</div>
				
				</article>
				
			<?php
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

	
</div>

<?php
get_footer();
