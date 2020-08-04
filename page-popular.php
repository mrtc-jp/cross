<?php
/**
 * Template Name: Popular
 * Description: 人気記事
 */

get_header();
?>

	<main id="primary" class="site-main <?php echo esc_attr($post->post_name);?>">
		
		<?php if ( have_posts() ) : ?>
		
			<?php custom_breadcrumb(); ?>
			
			<header class="page-header">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</header><!-- .page-header -->
			
			<?php
				if (function_exists('sga_ranking_get_date')) {
					$popular_posts_ranking = get_option('popular_posts_ranking');
					$popular_posts_number = get_option('popular_posts_number');
					$popular_posts_period = get_option('popular_posts_period');
					
				    $args = array(
				        'display_count' => $popular_posts_number,
				        'period' => $popular_posts_period,
				        'post_type' => 'post'
					);
					$ranking_data = sga_ranking_get_date($args);
					if ( !empty( $ranking_data ) ) {
				        if ( popular_posts_ranking == true) {
			        		echo '<div class="news-list ranking">';
			        	} else {
				        	echo '<div class="news-list">';
			        	}
						foreach ( $ranking_data as $post_id ) {
				        	include( locate_template( 'template-parts/content-popular.php' ));
			        	}
						echo '</div>';
				    }
				};

			pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
