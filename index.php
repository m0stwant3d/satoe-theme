<?php get_header(); ?>
<?php $homepage = get_option( 'homepage_options' ); ?>
<?php if ( ! empty( $homepage['slider_items'] ) ) get_template_part( 'index', 'slider' ); ?>
<div id="slowest-content">
	<div id="slowest-featured">
		<?php get_template_part( 'index', 'featured' ); ?>
	</div>
	<div id="slowest-post">
		<?php get_template_part( 'index', 'latest' ); ?>
	</div>	
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>