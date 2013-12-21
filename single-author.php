<div id="author-bio">	
	<span class="author-title"><?php echo get_author_role();?> <?php the_author_link(); ?></span>
	<div class="author-info">
		<?php echo get_avatar( get_the_author_meta('email'), '80' ); ?>
		<p class="author-description"><?php the_author_meta('description'); ?>
		<div class="icons">
			<?php
				$author_url = get_the_author_meta( 'user_url' );
				if ( ! empty( $author_url ) )
					echo __( 'More About' ) . ' : <a href="' . $author_url .'">' . __( 'Personal Blog' ) . '</a> | ';
			
				$gplus = get_the_author_meta( 'gplus' );
				if ( ! empty( $gplus ) )
					echo '<a href="' . esc_url( $gplus ) . '" rel="author">Google+</a> | ';
				
				$twitter = get_the_author_meta( 'twitter' );
				if ( ! empty( $twitter ) ) 
					echo '<a href="' . esc_url( $twitter ) . '">Twitter</a> | ';
				
				$fb = get_the_author_meta( 'fb' );
				if ( ! empty( $fb ) )
					echo '<a href="' . esc_url( $fb ) . '">Facebook</a>';
			?>
		</div>
	</div>
</div>