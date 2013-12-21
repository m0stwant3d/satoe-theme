<form class="form-wrapper cf" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
	<input type="text" name="s" id="s" value="<?php the_search_query(); ?>">
	<button type="submit"><?php _e( 'Search' ); ?></button>
</form>