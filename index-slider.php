<div id="slider">
	<?php
		$homepage = get_option( 'homepage_options' );
		$temp = explode( ',', $homepage['slider_items'] );
		for ( $i = 0; $i < count( $temp ); $i++ ) {
			if ( has_post_thumbnail( $temp[$i] ) ) { 
				$html = get_the_post_thumbnail( $temp[$i], 'full' );
				$html = empty( $html ) ? '<img src="' . get_template_directory_uri() . '/images/default.jpg">' : $html;
				$xpath = new DOMXPath(@DOMDocument::loadHTML($html));
				$src = $xpath->evaluate("string(//img/@src)");
	?>
	<a href="<?php echo get_permalink( $temp[$i] ); ?>">
	<img src="<?php echo bloginfo( 'template_url' ); ?>/timthumb.php?src=<?php echo $src; ?>&amp;h=290&amp;w=580&amp;zc=1&amp;q=80" width="580" height="290" alt="<?php echo get_the_title( $temp[$i] ); ?>" title="<?php echo get_the_title( $temp[$i] ); ?>" /></a>
	<?php } else { ?>
	<a href="<?php echo get_permalink( $temp[$i] ); ?>">
	<img src="<?php bloginfo( 'template_url' ); ?>/images/default.jpg" width="580" height="290" alt="<?php echo get_the_title( $temp[$i] ); ?>" title="<?php echo get_the_title( $temp[$i] ); ?>" /></a><?php } } ?>	
</div>