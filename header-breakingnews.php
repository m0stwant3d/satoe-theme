<?php $options = get_option( 'breakingnews_options' ); ?>
<div class="tabs">
	<div class="message">
		<div class="a_kiri">
			<span class="wicon i-diamond"></span>
			<span class="titles">Breaking News: </span>
		</div>
		<div class="arrow-right"></div>
		<div class="a_tengah">
			<ul class="rslides">
				<?php
					if ( ! empty( $options['breakingnews_mode'] ) ) {	
						$args = array( 
							'posts_per_page' => $options['breakingnews_by_view_count'],
							'orderby' => 'meta_value_num',
							'meta_key' => '_views',
							'post_status' => 'publish',
							'ignore_sticky_posts' => 1
						);
						$my_query = new WP_Query( $args );
					if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); $do_not_duplicate = $post->ID;
				?>	
				<li style="display:none"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; endif; wp_reset_postdata(); ?>
				<?php
					} elseif ( ! empty( $options['breakingnews_manual_list'] ) ) {
						$list = $options['breakingnews_manual_list'];
						$breakingnews = explode( ',', $list );
						foreach ( $breakingnews as $post ) {
							//setup_postdata( $post );
				?>
				<li style="display:none"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				<?php } wp_reset_postdata(); } ?>
			</ul>
		</div>					
	</div><!-- END #breakingnews -->
</div>