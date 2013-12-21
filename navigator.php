<?php if ( is_single() ) { ?>
<div id="post-navigator-single">
	<div class="navleft"><?php previous_post_link('&laquo;&nbsp;%link') ?></div>
	<div class="navright"><?php next_post_link('%link&nbsp;&raquo;') ?></div>
	<div class="clearfix"></div>
</div>
<?php } elseif ( is_page() ) { ?>
<div id="post-navigator">
	<?php link_pages('<strong>Page</strong> ', '', 'number'); ?>
	<div class="clearfix"></div>
</div>
<?php } elseif ( is_tag() ) { ?>
<div id="post-navigator">
	<div class="navleft"><?php next_posts_link( '&laquo; Older Entries' ); ?></div>
	<div class="navright"><?php previous_posts_link( 'Newer Entries &raquo;' ); ?></div>
	<div class="clearfix"></div>
</div>
<?php } else { ?>
<div style="clear: both"></div>
<div id="post-navigatorind">
	<?php
		$options = get_option( 'general_options' );
		if ( ! empty( $options['show_pagination'] ) ) {
			if ( function_exists( 'custom_wp_pagenavi' ) ) {
				custom_wp_pagenavi();
			} else {
	?>
	<div class="navleft"><?php next_posts_link( '&laquo; Older Entries' ); ?></div>
	<div class="navright"><?php previous_posts_link( 'Newer Entries &raquo;' ); ?></div>
	<?php
			}
		} else {
	?>
	<div class="navleft"><?php next_posts_link( '&laquo; Older Entries' ); ?></div>
	<div class="navright"><?php previous_posts_link( 'Newer Entries &raquo;' ); ?></div>
	<?php } ?>
	<div class="clearfix"></div>
</div>
<?php } ?>