<?php get_header(); ?>
<div id="content">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 
	<div class="single-post" id="post-<?php the_ID(); ?>"> 
		<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h2>   
		<div class="entry">
			<p class="center"><a href="<?php echo wp_get_attachment_url( $post->ID ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
			<?php $attr = array( 'class'	=> 'attachment-full featured-img aligncenter' ); ?>
			<?php echo wp_get_attachment_image( $post->ID, 'full', false, $attr ); ?></a></p>
			<?php the_content(); ?>			
		</div>
		<div id="galleries">
			<h3>Other pictures for &ldquo;<?php the_title(); ?>&rdquo;</h3><br class="clear" />
			<?php
				$args = array(
					'post_type' => 'attachment',
					'numberposts' => null,
					'post_status' => 'published',
					'post_parent' => $post->post_parent
				); 
				$attachments = get_posts($args);
				if ($attachments) {
					foreach ($attachments as $attachment) {
						$img = wp_get_attachment_image_src( $attachment->ID, 'full' );
						$meta = wp_get_attachment_metadata( $attachment->ID );	
						echo '<img src="' . get_template_directory_uri() . '/timthumb.php?src=' . $img[0] . '&amp;w=100&amp;h=100&amp;zc=1&amp;q=100" width="100" height="100" class="gallery-thumb" data-width="' . $meta['width'] . '" data-height="' . $meta['height'] . '" data-src="' . $img[0] . '">';
					}
				}
			?>
		</div>
	</div><br class="clear" />
	<?php comments_template(); ?>
	<?php endwhile; else: ?>
	<p>Sorry, no posts matched your criteria.</p>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>