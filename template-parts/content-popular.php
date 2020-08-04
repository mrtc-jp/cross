<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CROSS
 */

?>

<article id="post-<?php the_ID(); ?>" class="post">
	<div class="entry-thumbnail">
		<a href="<?php echo get_permalink($post_id); ?>" class="thumbnail">
			<?php
				$post_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ) , 'thumbnail' );
				$post_thumb_url = $post_thumb[0];
				
				if ( has_post_thumbnail($post_id) ) {
					echo '<img src="' . $post_thumb_url . '" alt="' . get_the_title($post_id) . '">';
				} else {
					echo '<img src="' . get_bloginfo('template_directory') . '/img/no-image.png" alt="No Image">';
				}
			?>
		</a>
	</div>
	<div class="entry-excerpt">
		<p class="entry-title"><a href="<?php echo get_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></p>
		<p class="entry-date"><?php echo get_the_date('Y.m.d', $post_id); ?></p>
	</div>

</article>
