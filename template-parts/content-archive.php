<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CROSS
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-thumbnail">
		<a href="<?php the_permalink(); ?>" class="thumbnail">
			<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'thumbnail' );
			} else {
				echo '<img src="' . get_bloginfo('template_directory') . '/img/no-image.png" alt="No Image">';
			} ?>
		</a>
	</div>
	<div class="entry-excerpt">
		<p class="entry-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></p>
		<p class="entry-date"><?php the_time('Y.m.d') ?></p>
	</div>

</article>
