<div class="related-posts">
	<h3>Related Posts for &ldquo;<?php the_title(); ?>&rdquo;</h3>
	<?php
		$rp_count = get_post_meta($post->ID, '_related_posts_count', true);
		$rp_count = $rp_count == '' ? 3 : $rp_count;
		if ( $rp_count > 0 ) {
	?>
	<ul class="thumb-style">
		<?php			
			$orig_post = $post;
			global $post;
			$categories = get_the_category($post->ID);
			if ( $categories ) {
				$category_ids = array();
				foreach ( $categories as $individual_category )
					$category_ids[] = $individual_category->term_id;
					
				$args = array(
					'category__in' => $category_ids,
					'post__not_in' => array( $post->ID ),
					'posts_per_page'=> $rp_count,
					'orderby' => 'date',
					'ignore_sticky_posts' => -1
				);
				
				$my_query = new wp_query( $args );
				
				if( $my_query->have_posts() ): while( $my_query->have_posts() ): $my_query->the_post();
					if ( has_post_thumbnail( $post->ID ) ) {
						$html = get_the_post_thumbnail( $post->ID, 'full' );
						$html = empty( $html ) ? '<img src="' . get_template_directory_uri() . '/images/default-177x115.jpg">' : $html;
						$xpath = new DOMXPath(@DOMDocument::loadHTML($html));
						$src = $xpath->evaluate("string(//img/@src)");
						$src = get_template_directory_uri() . '/timthumb.php?src=' . $src . '&amp;w=177&amp;h=115&amp;zc=1&amp;q=80';
					} else {
						$src = get_template_directory_uri() . '/images/default-177x115.jpg';
					}
		?>
		<li>
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><img src="<?php echo $src; ?>" alt="<?php the_title(); ?>" width="177" height="115"/></a>
			<span><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></span>
			<p class="post-meta"><span class="date-icon"></span><span class="post-meta"><?php the_time('F jS Y'); ?>&nbsp;</span></p>
		</li>
		<?php
				endwhile;
				else:
				_e( 'No related posts found.' );
				endif;
			}
			$post = $orig_post;
			wp_reset_query();
		?>
	</ul>
	<?php } else { _e( 'No related posts found.' ); } ?>
</div>