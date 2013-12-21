<div class="related-posts">
	<h3>Related Posts for &ldquo;<?php the_title(); ?>&rdquo;</h3>
	<?php
		$list = get_post_meta($post->ID, '_related_posts_list', true);
		if ( strlen( $list ) != 0 ) {
	?>
	<ul class="thumb-style">
		<?php			
			$temp = explode( ',', $list );			
			for ( $i = 0; $i < count( $temp ); $i++ ) {
				if ( has_post_thumbnail( $temp[$i] ) ) {
					$html = get_the_post_thumbnail( $temp[$i], 'full' );
					$html = empty( $html ) ? '<img src="' . get_template_directory_uri() . '/images/default-177x115.jpg">' : $html;
					$xpath = new DOMXPath(@DOMDocument::loadHTML($html));
					$src = $xpath->evaluate("string(//img/@src)");
					$src = get_bloginfo( 'template_directory' ) . '/timthumb.php?src=' . $src . '&amp;w=177&amp;h=115&amp;zc=1&amp;q=80';
				} else {
					$src = get_bloginfo( 'template_directory' ) . '/images/default-177x115.jpg';
				}
		?>
		<li>
			<a href="<?php echo get_permalink( $temp[$i] ); ?>" rel="bookmark" title="<?php echo get_the_title( $temp[$i] ); ?>"><img src="<?php echo $src; ?>" alt="<?php get_the_title( $temp[$i] ); ?>" width="177" height="115"/></a>
			<span><a href="<?php echo get_permalink( $temp[$i] ); ?>" rel="bookmark" title="<?php echo get_the_title( $temp[$i] ); ?>"><?php echo get_the_title( $temp[$i] ); ?></a></span>
			<p class="post-meta"><span class="post-meta"><?php echo get_the_time( 'F jS Y', $temp[$i] ); ?>&nbsp;</span></p>
		</li><?php } ?>		
	</ul>
	<?php } else { _e( 'No related posts found.' ); } ?>
</div>