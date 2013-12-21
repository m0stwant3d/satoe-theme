<?php get_header(); ?>
<div id="content">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 
	<div class="single-post" id="post-<?php the_ID(); ?>"> 
		<h2><a href="<?php echo get_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<div class="entry">
			<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
		<div style="clear: both"></div><br/>
		<div class="categories">Categories: <?php the_category( ' ' ) ?></div>
		<div class="tag"><?php $posttags = get_the_tags(); if ($posttags) { $tagstrings = array('Tags:'); foreach($posttags as $tag) { $tagstrings[] = '<a href="' . get_tag_link($tag->term_id) . '" class="tag-link-' . $tag->term_id . '">' . $tag->name . '</a>'; } echo implode(' ', $tagstrings); }?></div>
		<?php $ads = get_option( 'ads_options' ); ?>
		<?php if ( ! empty( $ads['ads_large_rectangle'] ) ) { ?><div id="single-post-ads"><?php echo $ads['ads_large_rectangle']; ?></div><?php } ?>
	</div>	
	<div class="clear"></div>
	<?php get_template_part( 'navigator' ); ?>
	<div style="clear: both"></div>
	<?php $options = get_option( 'general_options' ); ?>
	<?php if ( ! empty( $options['show_author_box'] ) ) get_template_part( 'single', 'author' ); ?>
	<br class="clear" />
	<?php $social = get_option( 'social_options' ); ?>
	<?php if ( ! empty( $social['subscription_id'] ) ) { ?>
	<div id="subscribe-box" class="subscribe">
		<p class="intro">If you enjoyed this article, subscribe to receive more just like it.</p>
		<p class="feed">Join Our Newsletter</p>
		
		<form method="post" action="http://feedburner.google.com/fb/a/mailverify" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo sanitize_text_field( $social['subscription_id'] ); ?>', 'popupwindow', 'scrollbars=yes,width=650,height=500');return true">
			<input type="text" id="email" name="email" value="Your Email Address..." onfocus="if (this.value == 'Your Email Address...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Your Email Address...';}"/>
			<input type="hidden" value="" name="uri"/>
			<input type="hidden" name="loc" value="en_US"/>
			<input type="submit" value="Submit" id="submitButton">
		</form>		
	</div><?php } ?>
	<?php
		if ( ! empty( $options['show_related_posts'] ) ) {
			$rp_mode = get_post_meta($post->ID, '_related_posts_mode', true);
			$rp_mode = $rp_mode == '' ? 'auto' : $rp_mode;
			if ( $rp_mode == 'manual' ) {
				get_template_part( 'relatedposts', 'manual' );
			} elseif ( $rp_mode == 'auto' ) {
				get_template_part( 'relatedposts', 'auto' );
			}
		}				
	?>	
	<div class="clear"></div>
	<?php comments_template(); ?>
	<?php endwhile; else: ?>
	<p>Sorry, no posts matched your criteria.</p>
	<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>