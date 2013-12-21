<?php
	$featured_cat_count = 2; 
	$homepage = get_option( 'homepage_options' ); 
	$ads = get_option( 'ads_options' );
	if ( $homepage != null ) {
		for ( $j = 0; $j < $featured_cat_count; $j++ ) {
			if ( $homepage['featured_cat_' . $j][0] != 'skip' ) {
?>
<?php if ( $j == 1 ) { ?><div class="ads"><?php echo empty( $ads['ads_banner'] ) ? '' : $ads['ads_banner']; ?></div><?php } ?>
<div class="cat-title"><?php echo get_cat_name( $homepage['featured_cat_' . $j][0] );?></div>
<ul id="container<?php echo ($j + 1);?>" class="jcarousel-skin-tango">
	<?php
		$my_query = new WP_Query( 'cat=' . $homepage['featured_cat_' . $j][0] . '&posts_per_page=' . $homepage['featured_cat_' . $j][1] . '&ignore_sticky_posts=1' );
		$i = 1;
		if ( have_posts() ) : while( $my_query->have_posts() ): $my_query->the_post();$do_not_duplicate = $post->ID;
	?>
	<?php if ( $i % 2 == 1 ) { ?><li class="indexpost"><?php } ?>		
		<div class="slowestwp">
			<?php 
				if ( has_post_thumbnail() ) { 
					$html = get_the_post_thumbnail( $post->ID, 'full' );
					$html = empty( $html ) ? '<img src="' . get_template_directory_uri() . '/images/default.png">' : $html;
					$xpath = new DOMXPath(@DOMDocument::loadHTML($html));
					$src = $xpath->evaluate("string(//img/@src)");
			?>			
			<a href="<?php the_permalink(); ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/timthumb.php?src=<?php echo $src; ?>&amp;h=100&amp;w=120&amp;zc=1&amp;q=80" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" width="120" height="100" /></a>
			<?php } else { ?>
			<a href="<?php the_permalink(); ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/images/default.png" alt="no-image" title="no-image" width="120" height="100" /></a>
			<?php } ?>
			<h3><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo odd_title( $post->ID, 40 ); ?></a></h3>
			<div class="home-excerpt"><?php print_excerpt( 150 ); ?></div>
		</div>
	<?php if ( $i % 2 == 0 || $i == $my_query->post_count ) { ?></li><?php } ?>
	<?php $i++; ?>
	<?php endwhile; ?>		
	<?php else: ?>
	<h2 class="center">Not Found</h2>
	<p class="center">Sorry, but you are looking for something that isn't here.</p>
	<?php get_search_form(); ?>
	<?php endif; wp_reset_postdata(); ?>
</ul>
<?php } } } ?>