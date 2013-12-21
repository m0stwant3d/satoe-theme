<br class="clear" />
<div id="footer">
	<div id="footbar">
		<div class="content">
			<div class="footer_navi">
				<div class="footer_nav">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( "footer-wleft" ) ) : ?>
					<?php endif; ?>	
				</div>
			</div>
			<div class="footer_navi">
				<div class="footer_nav">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( "footer-wcenter" ) ) : ?>
					<?php endif; ?>	
				</div>
			</div>
			<div class="footer_navi">
				<div class="footer_nav">
					<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( "footer-wright" ) ) : ?>
					<?php endif; ?>	
				</div>
			</div>
		</div>
		<br class="clear" />
		<?php $options = get_option( 'general_options' ); ?>
		<p><?php echo empty( $options['footer_text'] ) ? '' : $options['footer_text']; ?></p>
	</div>
	<br class="clear" />
	<span id="backtotop">&uarr; Back to Top</span>		
</div>
<?php wp_footer(); ?>
</div>
</div>
</body>
</html>