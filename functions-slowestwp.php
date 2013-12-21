<?php
if ( ! defined( 'THEME_NAME' ) )  define( 'THEME_NAME', 'SATOE Theme' );
if ( ! defined( 'VERSION' ) )     define( 'VERSION', '1.0' );
if ( ! defined( 'CHANGELOG' ) )   define( 'CHANGELOG', 'http://www.slowestwp.com/premium-theme/satoe-theme-premium-magazine-theme-slowestwp/' );
if ( ! defined( 'DOCS' ) )        define( 'DOCS', 'http://www.slowestwp.com/premium-theme/satoe-theme-premium-magazine-theme-slowestwp/' );
if ( ! defined( 'SUPPORT' ) )     define( 'SUPPORT', 'http://www.slowestwp.com' );

add_action( 'admin_enqueue_scripts', 'premium_admin_script' );
function premium_admin_script( $hook ) {
	global $premium_admin_page;
	if ( $hook == $premium_admin_page ) {
		wp_enqueue_script(
			'satoe-theme-options',
			get_template_directory_uri() . '/js/satoe-theme-options.min.js',
			array( 'jquery' ),
			null,
			false
		);
		
		wp_enqueue_script( 
			'media-uploader',
			get_template_directory_uri() . '/js/media-uploader.min.js',
			array( 'jquery' ),
			null,
			false
		);
		
		wp_enqueue_script( 
			'twitter-bootstrap',
			get_template_directory_uri() . '/js/bootstrap.min.js',
			array( 'jquery' ),
			null,
			false
		);
		
		wp_enqueue_script( 
			'bootstrap-switch',
			get_template_directory_uri() . '/js/bootstrapSwitch.min.js',
			array( 'twitter-bootstrap' ),
			null,
			false
		);
		
		wp_localize_script(
			'satoe-theme-options',
			'obj',
			array(
				'loading' => get_template_directory_uri() . '/images/loaderB16.gif'
			)
		);
		
		wp_localize_script(
			'media-uploader',
			'uploads',
			array(
				'title' => __( 'Select An Image' ),
				'button' => __( 'Insert Image' )
			)
		);
		
		wp_enqueue_style( 'admin-style' );
		
		wp_enqueue_style( 'wp-color-picker' );
		
		wp_enqueue_style( 'bootstrap-switch-style' );
		
		wp_enqueue_style( 'tipsy-style' );
		
		wp_enqueue_script( 'wp-color-picker' );
		
		wp_enqueue_script( 'tipsy' );
		
		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}
	} elseif ( $hook == 'post.php' ) {
		wp_enqueue_script(
			'related-posts-conf',
			get_template_directory_uri() . '/js/related-posts-conf.min.js',
			array( 'jquery' ),
			null,
			false
		);
	
		wp_enqueue_style( 'admin-style' );
	}
}

add_action( 'admin_init', 'satoe_theme_admin_styles_init' );
function satoe_theme_admin_styles_init() {
	wp_register_style(
		'admin-style',
		get_template_directory_uri() . '/css/admin-style.css',
		false,
		null,
		'screen'
	);
	
	wp_register_style(
		'bootstrap-switch-style',
		get_template_directory_uri() . '/css/bootstrapSwitch.css',
		false,
		null,
		'screen'
	);
}

add_action( 'init', 'satoe_theme_styles_init' );
function satoe_theme_styles_init() {
	wp_register_style(
		'satoe-style',
		get_template_directory_uri() . '/style.css',
		false,
		null,
		'screen'
	);
	
	wp_register_style(
		'jcarousel-skin-style',
		get_template_directory_uri() . '/css/skin.css',
		false,
		null,
		'screen'
	);
	
	wp_register_style(
		'nivo-style',
		get_template_directory_uri() . '/css/nivo-slider.css',
		false,
		null,
		'screen'
	);
	
	wp_register_style(
		'idangerous-style',
		get_template_directory_uri() . '/css/idangerous.swiper.css',
		false,
		null,
		'screen'
	);
}

add_action( 'admin_init', 'tipsy_init' );
add_action( 'init', 'tipsy_init' );
function tipsy_init() {
	wp_register_style(
		'tipsy-style',
		get_template_directory_uri() . '/css/tipsy.css',
		false,
		null,
		'screen'
	);
	
	wp_register_script( 
		'tipsy',
		get_template_directory_uri() . '/js/jquery.tipsy.min.js',
		array( 'jquery' ),
		null,
		false
	);
}

add_action( 'print_satoe_frontend_styles', 'satoe_frontend_styles' );
function satoe_frontend_styles() {
	$homepage = get_option( 'homepage_options' );	
			
	wp_enqueue_style( 'satoe-style' );
	wp_enqueue_style( 'tipsy-style' );
	
	if ( is_home() ) {
		wp_enqueue_style( 'jcarousel-skin-style' );
		
		if ( ! empty( $homepage['slider_items'] ) ) {
			wp_enqueue_style( 'nivo-style' );
		} 
	}
	
	if ( is_active_widget( false, false, 'swp_tabbed', true ) ) {
		wp_enqueue_style( 'idangerous-style' );
	}
}

add_action( 'init', 'satoe_theme_scripts_init' );
function satoe_theme_scripts_init() {
	wp_register_script( 
		'hover-intent',
		get_template_directory_uri() . '/js/jquery.hoverIntent.minified.js',
		array( 'jquery' ),
		null,
		false
	);
	
	wp_register_script( 
		'jcarousel',
		get_template_directory_uri() . '/js/jquery.jcarousel.min.js',
		array( 'jquery' ),
		null,
		false
	);
	
	wp_register_script( 
		'nivo-slider',
		get_template_directory_uri() . '/js/jquery.nivo.slider.pack.js',
		array( 'jquery' ),
		null,
		false
	);
	
	wp_register_script( 
		'idangerous',
		get_template_directory_uri() . '/js/idangerous.swiper-1.9.1.min.js',
		array( 'jquery' ),
		null,
		false
	);
	
	wp_register_script( 
		'responsive-slides',
		get_template_directory_uri() . '/js/responsiveslides.min.js',
		false,
		null,
		false
	);
	
	wp_register_script(
		'attachment-gallery',
		get_template_directory_uri() . '/js/attachment-gallery.min.js',
		array( 'jquery' ),
		null,
		false
	);
}

add_action( 'print_satoe_frontend_scripts', 'satoe_frontend_scripts' );
function satoe_frontend_scripts() {
	$homepage = get_option( 'homepage_options' );
	$social = get_option( 'social_options' );
	
	wp_enqueue_script( 'hover-intent' );
	wp_enqueue_script( 'tipsy' );
	wp_enqueue_script( 'responsive-slides' );
	
	if ( is_home() ) {
		wp_enqueue_script( 'jcarousel' );
	
		if ( ! empty( $homepage['slider_items'] ) ) {
			wp_enqueue_script( 'nivo-slider' );
		}
	}
	
	if ( is_active_widget( false, false, 'swp_tabbed', true ) ) {
		wp_enqueue_script( 'idangerous' );
	}
	
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( is_attachment() ) {
		wp_enqueue_script( 'attachment-gallery' );
	}
}

add_action( 'wp_head', 'satoe_inline_scripts' );
function satoe_inline_scripts() {
	$homepage = get_option( 'homepage_options' );
	$socials = get_option( 'social_options' );
	?>
<script type="text/javascript">
/* <![CDATA[ */
$ = jQuery.noConflict();
function mainMenu() {
	$("#topmenu .menu ul").css({display: "none"}); // Opera Fix
	$("#topmenu .menu li").hoverIntent(
		function() {
			$(this).find('ul:first').slideDown(400);
		},
		function() {
			$(this).find('ul:first').slideUp(400);
		}
	);
}

function backToTop() {
	$(window).scroll(function() {
		if ($(this).scrollTop() > 500) {
			$("#backtotop").fadeIn(400);
		} else {
			$("#backtotop").fadeOut(400);
		}
	});
	
	$("#backtotop").click(function(event) {
		event.preventDefault();			
		$("html, body").animate({scrollTop: 0}, 1000);
	});
}

jQuery(document).ready(function($) {					
	mainMenu();
	$(".rslides").responsiveSlides();
	$("#social-icons a").tipsy({fade:true});
	backToTop();
});/* ]]> */
</script>
	<?php	
	if ( is_home() ) { ?>
<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($) {
	<?php if ( ! empty( $homepage['slider_items'] ) ) { ?>
	$("#slider").nivoSlider({
		effect:"<?php echo $homepage['slider_effect']; ?>",
		animSpeed:<?php echo $homepage['slider_animation_speed'] == null ? '500' : $homepage['slider_animation_speed']; ?>
	});<?php } ?>
	$('#container1').jcarousel({scroll: 1});
	$('#container2').jcarousel({scroll: 1});
});/* ]]> */
</script><?php }

	if ( is_active_widget( false, false, 'swp_tabbed', true ) ) { ?>
<script type="text/javascript">
/* <![CDATA[ */
function tabify(theID) {
	var theID = theID;
	var idx = $(theID + " .widget-tabs .active").index();
	var initHeight = $(theID + " .swiper-slide").eq(idx).find("ul").outerHeight();
	$(theID + " .swiper-container").eq(idx).css("height", (initHeight + 10));
	var swiperTabs = $(theID + ' .swiper-tabs').swiper({
		onlyExternal : true,
		speed:500
	});
	$(theID + " .widget-tabs a").bind('touchstart',function(e){
		e.preventDefault();
		$(theID + " .widget-tabs .active").removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
		swiperTabs.swipeTo( $(this).index() );
	});
	$(theID + " .widget-tabs a").click(function(e){
		e.preventDefault();
	});
	$(theID + " .widget-tabs a").mousedown(function(e){
		$(theID + " .widget-tabs .active").removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
		swiperTabs.swipeTo( $(this).index() );
		var height = $(theID + " .swiper-slide").eq($(this).index()).find("ul").outerHeight();
		$(theID + " .swiper-container").animate({height:(height + 10)}, 400);
	});
}
	
jQuery(document).ready(function($) {
	var temp = [];
	$(".widget-tabs").each(function() {
		new tabify("#" + $(this).parent().attr("id"));
	});
});/* ]]> */
</script>
	<?php }
	
	if ( is_active_widget( false, false, 'flickr_photostream', true ) ) { ?>
<script>
/* <![CDATA[ */
function flickrize(theID) {
	var theID = theID;
	var idx = $(theID + " .flickr").index();
	var id = $(theID + " .flickr").eq(idx - 1).data("flickr-id");
	var limit = $(" .flickr").eq(idx - 1).data("count");

	// Flickr Photostream feed link.
	$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?id=" + id + "&lang=en-us&format=json&jsoncallback=?", 
	function(data){
		$.each(data.items, function(i,item){
		// Number of thumbnails to show.            
			if (i < limit){
				// Create images and append to div id flickr and wrap link around the image.
				$("<img/>").attr({src: item.media.m.replace('_m', '_s'), width: 75, height: 75}).appendTo(theID + " .flickr").wrap("<a href='" + item.media.m.replace('_m', '_z') + "' name='"+ item.link + "' title='" +  item.title +"'></a>");
			}
		}); 
	});
}

jQuery(document).ready(function($) {
	var temp = [];
	$(".widget_flickr_photostream").each(function() {
		new flickrize("#" + $(this).attr("id"));
	});
});/* ]]> */
</script>
	<?php }
}

add_action('wp_ajax_general_tab', 'general_tab_cb');
function general_tab_cb() {
	echo settings_fields( 'general_options' ); 
	echo do_settings_sections( 'general_options' );
	echo submit_button();
	die();
}

add_action('wp_ajax_homepage_tab', 'homepage_tab_cb');
function homepage_tab_cb() {
	echo settings_fields( 'homepage_options' ); 
	echo do_settings_sections( 'homepage_options' );
	echo submit_button();
	die();
}

add_action('wp_ajax_display_tab', 'display_tab_cb');
function display_tab_cb() {
	echo settings_fields( 'display_options' ); 
	echo do_settings_sections( 'display_options' );
	echo submit_button();
	die();
}

add_action('wp_ajax_breakingnews_tab', 'breakingnews_tab_cb');
function breakingnews_tab_cb() {
	echo settings_fields( 'breakingnews_options' ); 
	echo do_settings_sections( 'breakingnews_options' );
	echo submit_button();
	die();
}

add_action('wp_ajax_ads_tab', 'ads_tab_cb');
function ads_tab_cb() {
	echo settings_fields( 'ads_options' ); 
	echo do_settings_sections( 'ads_options' );
	echo submit_button();
	die();
}

add_action('wp_ajax_social_tab', 'social_tab_cb');
function social_tab_cb() {
	echo settings_fields( 'social_options' ); 
	echo do_settings_sections( 'social_options' );
	echo submit_button();
	die();
}

add_action('wp_ajax_site_verifications_tab', 'site_verifications_tab_cb');
function site_verifications_tab_cb() {
	echo settings_fields( 'site_verifications_options' ); 
	echo do_settings_sections( 'site_verifications_options' );
	echo submit_button();
	die();
}

add_action( 'admin_init', 'slowestwp_init_options' );
function slowestwp_init_options() {
	$optionslist = array(
					'general_options',
					'homepage_options',
					'display_options',
					'breakingnews_options',
					'ads_options',
					'social_options',
					'site_verifications_options'
				);
	
	foreach ( $optionslist as $option ) {
		if( false == get_option( $option ) ) {
			add_option( $option );  
		}
	}
	
	// <-- General Options
	add_settings_section(
		'general_section',
		'',
		'general_section_cb',
		'general_options'
	);
	
	$general_settings_items = array(
		'show_breadcrumbs' => array( 'Enable Custom Breadcrumbs', 'Display a breadcrumbs?' ),
		'show_pagination' => array( 'Enable Custom Pagination', 'Display a pagination?' ),
		'show_related_posts' => array( 'Enable Custom Related Posts', 'Display a related posts?' ),
		'show_author_box' => array( 'Show Author Box', 'Display the author box below the main content?' )		
	);
	foreach ( $general_settings_items as $key => $val ) {
		add_settings_field(
			$key,
			$val[0],
			'general_settings_field_cb',
			'general_options',
			'general_section',
			array( $key, $val[1] )
		);
	}
	
	add_settings_field( 
		'footer_text',
		'Footer Text',
		'footer_text_cb',
		'general_options',
		'general_section',
		array( __( 'Insert your site\'s footer text in the above box' ) )
	);
	// General Options -->
	
	// <-- Homepage Options
	// <-- Slider Section
	add_settings_section(
		'slider_section',
		'Slider',
		'slider_section_cb',
		'homepage_options'
	);
		
	add_settings_field(
		'slider_items',
		'Slider Items',
		'slider_items_cb',
		'homepage_options',
		'slider_section'
	);
	
	add_settings_field(
		'slider_effect',
		'Slider Effect',
		'slider_effect_cb',
		'homepage_options',
		'slider_section',
		array( 'Select the effect' )
	);
	
	add_settings_field(
		'slider_animation_speed',
		'Slider Animation Speed',
		'slider_animation_speed_cb',
		'homepage_options',
		'slider_section'
	);
	// Slider Section -->
	
	// <-- Featured Category Section
	add_settings_section(
		'featured_category_section',
		'Featured Category',
		'featured_category_section_cb',
		'homepage_options'
	);
	
	$featured_category_count = 2;
	for ( $i = 0; $i < $featured_category_count; $i++ ) {
		add_settings_field(
			'featured_cat_' . $i,
			'Featured Category #' . ($i + 1),
			'featured_cat_cb',
			'homepage_options',
			'featured_category_section',
			array( $i )
		);
	}
	// Featured Category Section -->	
	// Homepage Options -->
	
	// <-- Display Options
	add_settings_section(
		'display_section',
		'Color Settings',
		'color_section_cb',
		'display_options'
	);
	
	$bgcolor_items = array(
		'body_bgcolor' => array( 'Body', '#f6f6f6' ),
		'header_bgcolor' => array( 'Header', '#ffffff' ),
		'accent_bgcolor' => array( 'Accent Color', '#e64946' ),
		'tabbed_widget_hover_bgcolor' => array( 'Tabbed Widget Hover', '#000000' ),
		'sidebar_title_font_color' => array( 'Sidebar Title Font', '#ffffff' ),
		'footer_bgcolor' => array( 'Footer', '#111111' ),
		'footer_link_color' => array( 'Footer Link', '#ffffff' ),
		'footer_link_hover_color' => array( 'Footer Link Hover', '#cccccc' )
	);
	foreach ( $bgcolor_items as $key => $val ) {
		add_settings_field(
			$key,
			$val[0],
			'bgcolor_cb',
			'display_options',
			'display_section',
			array( $key, $val[1] )
		);
	}
	
	add_settings_section(
		'site_logo_section',
		'Site Logo',
		'site_logo_section_cb',
		'display_options'
	);
	
	add_settings_field(
		'logo_image',
		'Image',
		'logo_image_cb',
		'display_options',
		'site_logo_section'
	);
	// Display Options -->
	
	// Breaking News Options -->
	add_settings_section(
		'breakingnews_section',
		'',
		'breakingnews_section_cb',
		'breakingnews_options'
	);
	
	add_settings_field(
		'breakingnews_mode',
		'Toggle Mode',
		'breakingnews_mode_cb',
		'breakingnews_options',
		'breakingnews_section'
	);
	
	add_settings_field(
		'breakingnews_by_view_count',
		'Number of Displayed Post',
		'breakingnews_by_view_count_cb',
		'breakingnews_options',
		'breakingnews_section'
	);
	
	add_settings_field(
		'breakingnews_manual_list',
		'Breaking News List',
		'breakingnews_manual_list_cb',
		'breakingnews_options',
		'breakingnews_section'
	);
	// <-- Breaking News Options
	
	// <-- Ads Options
	add_settings_section(
		'ads_section',
		'',
		'ads_section_cb',
		'ads_options'
	);
	
	$ads_list = array(
					array( 'leaderboard', 'Leaderboard (728 x 90)', __( 'Displayed under the breakingnews section.' ) ),
					array( 'top_banner', 'Top Banner (468 x 60)', __( 'Displayed next to the Site Title/Site Logo.' ) ),
					array( 'banner', 'Banner (468 x 60)', __( 'Displayed between two featured category boxes on the homepage.' ) ),
					array( 'large_rectangle', 'Large Rectangle (336 x 280)', __( 'Displayed below the content on the Single Post page.' ) ),
					array( 'medium_rectangle', 'Medium Rectangle (300 x 250)', __( 'Displayed on the Medium Rectangle Ads Widget.' ) ),
					array( 'toggle_search_ads', 'Toggle Search Ads', __( 'Click to switch between default search form and custom search ads.' ) ),
					array( 'search', 'Search Ads', 'Insert the Ads code' )
			);
	for ( $i = 0; $i < count( $ads_list ); $i++ ) {
		add_settings_field(
			'ads_' . $ads_list[$i][0],
			$ads_list[$i][1],
			'ads_cb',
			'ads_options',
			'ads_section',
			array( $ads_list[$i][0], $ads_list[$i][2] )
		);
	}	
	// Ads Options -->
	
	// <-- Social Options
	// <-- Social Media Section
	add_settings_section(
		'social_section',
		'Social Media',
		'social_section_cb',
		'social_options'
	);
	
	$socmed = array(
				'fb' => 'Facebook',
				'twitter' => 'Twitter',
				'gplus' => 'Google+',
				'pinterest' => 'Pinterest',
				'youtube' => 'Youtube',
				'rss_feed' => 'RSS Feed'
	);
	foreach ( $socmed as $key => $val ) {
		add_settings_field(
			$key,
			$val,
			'social_media_cb',
			'social_options',
			'social_section',
			array( $key )
		);
	}
	// Social Media Section -->
	
	// <-- Subsribe Section
	add_settings_section(
		'subscription_section',
		'Subscription',
		'subscription_section_cb',
		'social_options'
	);
	
	add_settings_field(
		'subscription_id',
		'Your Subscription ID',
		'subscription_id_cb',
		'social_options',
		'subscription_section'
	);
	// Subscribe Section -->
	// Social Options -->
	
	// <-- Site Verifications Options
	add_settings_section(
		'site_verifications_section',
		'',
		'site_verifications_section_cb',
		'site_verifications_options'
	);
	
	$verifications = array(
				'google' => 'Google',
				'bing' => 'Bing',
				'alexa' => 'Alexa'
	);
	foreach ( $verifications as $key => $val ) {
		add_settings_field(
			$key,
			$val,
			'site_verifications_cb',
			'site_verifications_options',
			'site_verifications_section',
			array( $key )
		);
	}
	// Site Verifications Options -->
	
	foreach ( $optionslist as $option ) {
		register_setting(
			$option,
			$option,
			'validate_' . $option
		);
	}
}

// <-- Callbacks
function general_section_cb() {
	return;
}

function slider_section_cb() {
	return;
}

function featured_category_section_cb() {
	return;
}

function color_section_cb() {
	return;
}

function site_logo_section_cb() {
	return;
}

function breakingnews_section_cb() {
	return;
}

function ads_section_cb() {
	return;
}

function social_section_cb() {
	return;
}

function subscription_section_cb() {
	_e( 'The system natively supports Google FeedBurner. Please insert your subscription ID below here.' );
	return;
}

function site_verifications_section_cb() {
	_e( '<p>Insert only the ID of each verification code. The system will automatically generate the HTML meta tag in the front end.</p>' );
	return;
}

function general_settings_field_cb( $args ) {
	$options = get_option( 'general_options' );
	$val = empty( $options[$args[0]] ) ? '' : $options[$args[0]];
	$html = '<div class="switch switch-small"><input type="checkbox" name="general_options[' . $args[0] . ']" value="1" ' . checked( '1', $val, false ) . ' /></div>';
	$html .= '<p class="description">' . $args[1] . '</p>';
	echo $html;
}

function footer_text_cb( $args ) {
	$options = get_option( 'general_options' );
	$val = empty( $options['footer_text'] ) ? '' : $options['footer_text'];
	$html = '<textarea class="regular-text" name="general_options[footer_text]" cols="70" rows="4">' . $val . '</textarea>';
	$html .= '<p class="description">' . $args[0] . '<br />';
	$html .= 'Allowed tags: ' . allowed_tags() . '</p>';
	echo $html;
}

function slider_items_cb( $args ) {
	$options = get_option( 'homepage_options' );
	$opts = array( 'numberposts' => -1, 'orderby' => 'post_date' );
	$postslist = get_posts( $opts );
	$val = empty( $options['slider_items'] ) ? '' : $options['slider_items'];
	$html = '<input type="hidden" name="homepage_options[slider_items]" id="slider-item-ids" value="' . $val . '" />';
	$html .= '<select id="posts-list">';
	$slider_items = empty( $options['slider_items'] ) ? '' : explode( ',', $options['slider_items'] );
	
	foreach ( $postslist as $post ) {
		if ( is_array( $slider_items ) ) {
			if ( !in_array( $post->ID, $slider_items ) ) {
				$html .= '<option value="' . $post->ID . '">' . odd_title( $post->ID, 60 ) . '</option>';
			}
		} else {
			$html .= '<option value="' . $post->ID . '">' . odd_title( $post->ID, 60 ) . '</option>';
		}
	}
	
	if ( is_array( $slider_items ) ) {
		$li = '';
		foreach ( $slider_items as $item ) {
			$li .= '<li class="ui-state-default slider-item" data-id="' . $item . '">' . odd_title( $item, 60 ) . ' <span class="remove" data-rem="slider-item">x</span></li>';
		}
	}
	$html .= '</select><span class="help-icon" title="' . __( 'The post list is sorted by date in Descending order.' ) . '"></span>';
	$html .= '<p><input type="button" class="button add-item" id="add-slider-item" value="Add Slider Item" />';
	$html .= '<div id="drop-slider-items"><ul id="slider-item-list">';
	$html .= isset( $li ) ? $li : '';
	$html .= '</ul></div>';
	echo $html;
}

function slider_effect_cb() {
	$options = get_option( 'homepage_options' );
	$html = '<select name="homepage_options[slider_effect]" id="slider-effect">';
	$effectlist = array( 
					'sliceDown',
					'sliceDownLeft',
					'sliceUp',
					'sliceUpLeft',
					'sliceUpDown',
					'sliceUpDownLeft',
					'fold',
					'fade',
					'random',
					'slideInRight',
					'slideInLeft',
					'boxRandom',
					'boxRain',
					'boxRainReverse',
					'boxRainGrow',
					'boxRainGrowReverse'
				);
	foreach ( $effectlist as $effect ) {
		$val = empty( $options['slider_effect'] ) ? '' : $options['slider_effect'];
		$selected = selected( $effect, $val, false );
		$html .= '<option value="' . $effect . '" ' . $selected . '>' . $effect . '</option>';
	}	
	$html .= '</select>';
	echo $html;
}

function slider_animation_speed_cb() {
	$options = get_option( 'homepage_options' );
	$val = empty( $options['slider_animation_speed'] ) ? '' : $options['slider_animation_speed'];
	echo '<input type="text" name="homepage_options[slider_animation_speed]" class="small-text" value="' . $val . '" /> <span class="description">ms</span>';
}

function featured_cat_cb( $args ) {
	$categories = get_categories( 'hide_empty=1' );
	$cat_arr = array();
	$cat_arr['skip'] = '&nbsp;';
	foreach ( $categories as $category ) {
		$cat_arr[$category->cat_ID] = $category->name . ' (' . $category->count . ')';
	}	
	$options = get_option( 'homepage_options' );
	$html = '<select name="homepage_options[featured_cat_' . $args[0] . '][0]" id="featured-cat">'; 
	foreach ( $cat_arr as $key => $val ) {
		$ID_val = empty( $options['featured_cat_' . $args[0]][0] ) ? '' : $options['featured_cat_' . $args[0]][0];
		$selected = selected( $key, $ID_val, false );
		$html .= '<option value="' . $key . '" ' . $selected . '>' . $val . '</option>';
	}
	$html .= '</select>';
	$val = empty( $options['featured_cat_' . $args[0]][1] ) ? '' : $options['featured_cat_' . $args[0]][1];
	$html .= '<p><input type="text" name="homepage_options[featured_cat_' . $args[0] . '][1]" class="small-text" value="' . $val . '" />&nbsp;&nbsp;<span class="description">Number of posts displayed?</span></p>';
	echo $html;
}

function bgcolor_cb( $args ) {
	$options = get_option( 'display_options' );
	$color_val = empty( $options[$args[0]] ) ? $args[1] : $options[$args[0]];
	echo '<input type="text" class="color-picker small-text" name="display_options[' . $args[0] . ']" value="' . $color_val . '" data-default-color="' . $args[1] . '" />';
}

function logo_image_cb( $args ) {
	$options = get_option( 'display_options' );
	$val = empty( $options['logo_image'] ) ? '' : $options['logo_image'];
	$html = '<input type="hidden" name="display_options[logo_image]" id="logo-image" value="' . $val . '" />';
	$html .= ' <input type="button" class="button add-image" value="Add Image" />';
	$html .= ' <input type="button" class="button remove-image" value="Reset" />';
	$html .= '<p><strong>Preview</strong></p><div id="logo-preview"><img src="' . $val . '" /></div>';
	echo $html;
}

function breakingnews_mode_cb( $args ) {
	$options = get_option( 'breakingnews_options' );
	$val = empty( $options['breakingnews_mode'] ) ? '' : $options['breakingnews_mode'];
	$html = '<div id="switch-breakingnews" class="switch switch-small" data-on-label="AUTO" data-off-label="MANUAL"><input type="checkbox" id="toggle-search-ads" name="breakingnews_options[breakingnews_mode]" value="1" ' . checked( $val, 1, false ) . ' /></div>';
	$html .= '<p class="description">' . __( 'Toggle to switch whether to display breakingnews by most viewed or by manually selected posts' ) . '</p>';
	echo $html;
}

function breakingnews_by_view_count_cb( $args ) {
	$options = get_option( 'breakingnews_options' );
	$val = empty( $options['breakingnews_by_view_count'] ) ? '' : $options['breakingnews_by_view_count'];
	echo '<input type="text" class="small-text" id="breakingnews-by-view-count" name="breakingnews_options[breakingnews_by_view_count]" value="' . $val . '" />';
}

function breakingnews_manual_list_cb( $args ) {
	$options = get_option( 'breakingnews_options' );
	$opts = array( 'numberposts' => -1, 'orderby' => 'post_date' );
	$postslist = get_posts( $opts );
	$val = empty( $options['breakingnews_manual_list'] ) ? '' : $options['breakingnews_manual_list'];
	$html = '<input type="hidden" id="breakingnews-item-ids" name="breakingnews_options[breakingnews_manual_list]" value="' . $val . '" />';
	$html .= '<select id="posts-list">';
	$breakingnews_list = empty( $options['breakingnews_manual_list'] ) ? '' : explode( ',', $options['breakingnews_manual_list'] );
	
	foreach ( $postslist as $post ) {
		if ( is_array( $breakingnews_list ) ) {
			if ( !in_array( $post->ID, $breakingnews_list ) ) {
				$html .= '<option value="' . $post->ID . '">' . odd_title( $post->ID, 60 ) . '</option>';
			}
		} else {
			$html .= '<option value="' . $post->ID . '">' . odd_title( $post->ID, 60 ) . '</option>';
		}		
	}
	$html .= '</select><span class="help-icon" title="' . __( 'The post list is sorted by date in Descending order.' ) . '"></span>';
	if ( is_array( $breakingnews_list ) ) {
		$li = '';
		foreach ( $breakingnews_list as $item ) {
			$li .= '<li class="ui-state-default breakingnews-item" data-id="' . $item . '">' . odd_title( $item, 60 ) . ' <span class="remove" data-rem="breakingnews-item">x</span></li>';
		}
	}
	
	$html .= '<p><input type="button" id="add-breakingnews-item" class="button add-item" value="Add" /></p>';
	$html .= '<div id="breakingnews-drop"><ul id="breakingnews-item-list">';
	$html .= isset( $li ) ? $li : '';
	$html .= '</ul></div>';
	echo $html;
}

function ads_cb( $args ) {
	$options = get_option( 'ads_options' );
	if ( $args[0] == 'toggle_search_ads' ) {
		$val = empty( $options[$args[0]] ) ? '' : $options[$args[0]];
		$html = '<div class="switch switch-small"><input type="checkbox" id="toggle-search-ads" name="ads_options[' . $args[0] . ']" value="1" ' . checked( $val, 1, false ) . ' /></div>';
		$html .= '<p class="description">' . $args[1] . '</p>';
	} else {
		$val = empty( $options['ads_' . $args[0]] ) ? '' : $options['ads_' . $args[0]];
		$html = '<textarea class="regular-text" name="ads_options[ads_' . $args[0] . ']" cols="70" rows="4">' . $val . '</textarea>';
		$html .= '<p class="description">' . $args[1] . '</p>';
	}
	
	echo $html;
}

function social_media_cb( $args ) {
	$options = get_option( 'social_options' );
	$val = empty( $options[$args[0]] ) ? '' : $options[$args[0]];
	echo'<input type="text" id="' . $args[0] . '" class="regular-text" name="social_options[' . $args[0] . ']" value="' . $val . '" />';
}

function subscription_id_cb( $args ) {
	$options = get_option( 'social_options' );
	$val = empty( $options['subscription_id'] ) ? '' : $options['subscription_id'];
	echo'<input type="text" id="subscription_id" class="regular-text" name="social_options[subscription_id]" value="' . $val . '" />';
}

function site_verifications_cb( $args ) {
	$options = get_option( 'site_verifications_options' );
	$val = empty( $options[$args[0]] ) ? '' : $options[$args[0]];
	echo'<input type="text" id="' . $args[0] . '" class="regular-text" name="site_verifications_options[' . $args[0] . ']" value="' . $val . '" />';
}

// <-- Validations
function validate_general_options( $input ) {
	$input['footer_text'] = wp_kses_data( $input['footer_text'] );
	
	return apply_filters( 'validate_general_options', $input );
}

function validate_homepage_options( $input ) {
	$input['slider_animation_speed'] = intval( $input['slider_animation_speed'] );
	$input['featured_cat_0'][0] = intval( $input['featured_cat_0'][0] );
	$input['featured_cat_0'][1] = intval( $input['featured_cat_0'][1] );
	$input['featured_cat_1'][0] = intval( $input['featured_cat_1'][0] );
	$input['featured_cat_1'][1] = intval( $input['featured_cat_1'][1] );
	
	return apply_filters( 'validate_homepage_options', $input );
}

function validate_display_options( $input ) {
	$output = array();
	foreach ( $input as $key => $value ) {
		if ( isset( $input[$key] ) ) {
			$output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
		}
	}
	$output['logo_image'] = esc_url( $output['logo_image'] );
	
	return apply_filters( 'validate_display_options', $output, $input );
}

function validate_breakingnews_options( $input ) { 
	$output = array();
	foreach ( $input as $key => $value ) {
		if ( isset( $input[$key] ) ) {
			$output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
		}
	}
	$output['breakingnews_by_view_count'] = intval( $output['breakingnews_by_view_count'] );
	
	return apply_filters( 'validate_breakingnews_options', $output, $input );
}

function validate_ads_options( $input ) {
	return $input;
}

function validate_social_options( $input ) {
	$output = array();
	foreach ( $input as $key => $value ) {
		if ( isset( $input[$key] ) ) {
			$output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
		}
	}
	
	return apply_filters( 'validate_social_options', $output, $input );
}

function validate_site_verifications_options( $input ) {
	$output = array();
	foreach ( $input as $key => $value ) {
		if ( isset( $input[$key] ) ) {
			$output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
		}
	}
	
	return apply_filters( 'validate_site_verifications_options', $output, $input );
}
// Validations -->
// Callbacks -->

add_action('admin_menu', 'premium_theme_menu');
function premium_theme_menu() {
	global $premium_admin_page;
    $premium_admin_page = add_theme_page(  
							'Theme Options',
							'Theme Options',
							'administrator',
							'theme_options',
							'theme_options_display'
						);
}

function theme_options_display() {
?>
	<div class="wrap" id="slowest_container">
		<div id="header">
			<div class="logo">
				<img alt="SlowestWP-Themes" src="<?php bloginfo( 'template_directory' ); ?>/images/slowestwp.png">
			</div>
			<div class="theme-info">
				<span class="theme"><?php echo THEME_NAME . ' ' . VERSION; ?></span>
				<span class="framework">Premium Wordpress Theme</span>
			</div>
			<div class="clear"></div>
		</div>
		<div id="support-links">
			<ul>
				<li class="changelog"><span class="icon"></span><a title="Theme Changelog" href="<?php echo esc_url( CHANGELOG ); ?>"><?php _e( 'View Changelog' ); ?></a></li>
				<li class="docs"><span class="icon"></span><a title="Theme Documentation" href="<?php echo esc_url( DOCS ); ?>"><?php _e( 'View Theme Documentation' ); ?></a></li>
				<li class="support"><span class="icon"></span><a href="<?php echo esc_url( SUPPORT ); ?>" target="_blank"><?php _e( 'Visit Support Desk' ); ?></a></li>
			</ul>
		</div>
		<div id="main">
			<div id="slowest-nav">
				<div id="slowest-nav-shadow"></div>
				<ul>
					<li class="top-level general has-children swp-tab-active">
						<div class="arrow"><div></div></div>
						<a href="" id="general-tab" class="nav-tab nav-tab-active" title="General Setting"><span class="icon"></span>General Settings</a>
					</li>
					<li class="top-level display has-children">
						<div class="arrow"><div></div></div>
						<a href="" id="display-tab" class="nav-tab" title="Display Option"><span class="icon"></span>Display Options</a>
					</li>
					<li class="top-level home has-children">
						<div class="arrow"><div></div></div>
						<a href="" id="homepage-tab" class="nav-tab" title="Homepage"><span class="icon"></span>Homepage</a>
					</li>
					<li class="top-level breakingnews has-children">
						<div class="arrow"><div></div></div>
						<a href="" id="breakingnews-tab" class="nav-tab" title="Breaking News"><span class="icon"></span>Breaking News</a>
					</li>
					<li class="top-level ads has-children">
						<div class="arrow"><div></div></div>
						<a href="" id="ads-tab" class="nav-tab" title="Advertising"><span class="icon"></span>Advertising</a>
					</li>
					<li class="top-level connect has-children">
						<div class="arrow"><div></div></div>
						<a href="" id="social-tab" class="nav-tab" title="Socials & Connect"><span class="icon"></span>Socials & Connect</a>
					</li>
					<li class="top-level verify has-children">
						<div class="arrow"><div></div></div>
						<a href="" id="site-verifications-tab" class="nav-tab" title="Site Verification"><span class="icon"></span>Site Verification</a>
					</li>
				</ul>
			</div>
			<div id="content">
				<?php settings_errors(); ?>
				<img src="<?php bloginfo( 'template_directory' ); ?>/images/loaderA64.gif" class="transition" />
				<form action="" enctype="multipart/form-data" method="post" id="slowestform">			
					<?php
						settings_fields( 'general_options' );
						do_settings_sections( 'general_options' );
						submit_button();
					?>			
				</form>
			</div>
		</div>
    </div>
<?php }

add_action( 'wp_head', 'add_view' );
function add_view() {
	if ( ! is_single() )
		return;
	
	$postid = get_the_ID();
	$key = '_views';
	$views = get_post_meta( $postid, $key, true );
	if ( $views != null ) {
		update_post_meta( $postid, $key, ($views + 1) );
	} else {
		add_post_meta( $postid, $key, 1 );
	}
}

add_action( 'wp_head', 'my_theme_style' );
function my_theme_style() {    
	$display = get_option( 'display_options' );
	$homepage = get_option( 'homepage_options' );
	$body_bgcolor = isset( $display['body_bgcolor'] ) ? $display['body_bgcolor'] : '#f6f6f6';
	$header_bgcolor = isset( $display['header_bgcolor'] ) ? $display['header_bgcolor'] : '#ffffff';
	$accent_bgcolor = isset( $display['accent_bgcolor'] ) ? $display['accent_bgcolor'] : '#e64946';
	$tabbed_widget_hover_bgcolor = empty( $display['tabbed_widget_hover_bgcolor'] ) ? '#000000' : $display['tabbed_widget_hover_bgcolor'];
	$sidebar_title_font_color = empty( $display['sidebar_title_font_color'] ) ? '#ffffff' : $display['sidebar_title_font_color'];
	$footer_bgcolor = isset( $display['footer_bgcolor'] ) ? $display['footer_bgcolor'] : '#111111';
	$footer_link_color = isset( $display['footer_link_color'] ) ? $display['footer_link_color'] : '#ffffff';
	$footer_link_hover_color = isset( $display['footer_link_hover_color'] ) ? $display['footer_link_hover_color'] : '#cccccc';
	
	$sf_bgcolor_hover = hexdec(substr($accent_bgcolor, 1)) + 852996;
	$sf_bgcolor_active = hexdec(substr($accent_bgcolor, 1)) - 1314061;
	echo '<style data="' . dechex($val2) . '">';
	echo 'body{background:' . $body_bgcolor . '}';
	echo '#header{background:' . $header_bgcolor . '}';
	echo '#wrapper{background:' . $wrapper_bgcolor . '}';
	echo '.post h1 a:hover, .post h2 a:hover, .single-post h1 a:hover, .single-post h2 a:hover, .indexpost h3 a:hover{color:' . $accent_bgcolor . '}';
	echo 'span.catr a:hover,span.author-title,h3.searcher,#footbar #wp-calendar a,#backtotop:hover{color:' . $accent_bgcolor . '}';
	echo 'p.readmore a:hover{color:' . $accent_bgcolor . '}';
	echo '#backtotop:hover,h1.errors{color:' . $accent_bgcolor . '}';
	echo 'h1,h2,h3,h4,h5,h6,a:hover,a:active,.related-posts h3,#comments-title,h1.searching{color:' . $accent_bgcolor . '}';
	echo '#topmenu ul li a:hover,.a_kiri,span.comm,.wp-pagenavi a:hover, .wp-pagenavi .current{background:' . $accent_bgcolor . '}';
	echo '.wp-pagenavi a:hover, .wp-pagenavi .current{border:1px solid' . $accent_bgcolor . '}';
	echo '.widget-tabs a.active, .widget-tabs a:hover{background:' . $tabbed_widget_hover_bgcolor . '}';
	echo 'div.arrow-right{border-left-color:' . $accent_bgcolor . '}';
	echo '#slider{border-color:' . $accent_bgcolor . '}';
	echo '#sidebar .widget-title,.widget-tabs a{background:' . $accent_bgcolor . ';color:' . $sidebar_title_font_color . '}';
	echo '.footer_nav h4{color:' . $sidebar_title_font_color . '}';
	echo '#footbar{background:' . $footer_bgcolor . '}';
	echo '#footer,#footer a:link,#footer a:visited{color:' . $footer_link_color . '}';
	echo '#footer a:hover,#footer a:active{color:' . $footer_link_hover_color . '}';
	echo '.form-wrapper button{background:' . $accent_bgcolor . '}';
	echo '.form-wrapper button:before{border-color:transparent ' . $accent_bgcolor . ' transparent}';
	echo '.form-wrapper button:hover{background:#' . dechex( $sf_bgcolor_hover ) . '}';
	echo '.form-wrapper button:hover:before{border-right-color:#' . dechex( $sf_bgcolor_hover ) . '}';
	echo '.form-wrapper button:active,.form-wrapper button:focus{background:#' . dechex( $sf_bgcolor_active ) . '}';
	echo '.form-wrapper button:focus:before,.form-wrapper button:active:before{border-right-color:#' . dechex( $sf_bgcolor_active ) . '}';
	echo is_home() && ! empty( $homepage['slider_items'] ) ? '#sidebar{margin-top:-310px}' : '';
	echo "</style>\n";   
}

/*
 * Related Posts Meta
 */
add_action( 'add_meta_boxes', 'my_related_posts_meta_boxes' );
function my_related_posts_meta_boxes() { 
     add_meta_box(  
        'my_related_posts',  
        'Related Posts',  
        'my_related_posts',  
        'post',  
        'normal',
		'high'
    ); 
}

function my_related_posts() {
	global $post;
	wp_nonce_field( plugin_basename( __FILE__ ), 'my_related_posts_nonce' );
	
	$mode = get_post_meta($post->ID, '_related_posts_mode', true);
	$count = get_post_meta($post->ID, '_related_posts_count', true);
	$list = get_post_meta($post->ID, '_related_posts_list', true);	
	
	$temp = explode( ',', $list );
	$opts = array( 'numberposts' => -1, 'orderby' => 'post_date' );
	$postslist = get_posts( $opts );
	$select_conf = '<select id="post-list" class="widefat">';
	$rp_items = '';
	foreach ( $postslist as $item ) {
		if ( in_array( $item->ID, $temp ) ) {
			$rp_items .= '<li class="related-post-item" data-id="' . $item->ID . '">' . odd_title( $item->ID, 60 ) . ' <span class="remove">x</span></li>';
		} elseif ( $item->ID != $post->ID ) {
			$select_conf .= '<option value="' . $item->ID . '">' . odd_title( $item->ID, 60 ) . '</option>';
		}		
	}
	$select_conf .= '</select>';
	
	echo '<table>';
	echo '<tr>			
			<td>Mode</td>
			<td>
				<label><input type="radio" name="_related_posts_mode" class="mode-radio" value="auto" ' . checked( $mode, 'auto', false ) . ' /> Auto</label>
				<label><input type="radio" name="_related_posts_mode" class="mode-radio" value="manual" ' . checked( $mode, 'manual', false ) . ' /> Manual</label>
			</td>
		  </tr>';
	echo '</table>';
	echo '<table>';
	echo '<tr class="auto-related-posts">			
			<td>Number of displayed posts:</td>
			<td><input type="text" name="_related_posts_count" id="_related_posts_count" class="small-text" value="' . esc_attr( $count ) . '" /></td>
		  </tr>';
	echo '<tr class="manual-related-posts">			
			<td>Post List:</td>
			<td>' . $select_conf . '</td>
		  </tr>';
	echo '<tr class="manual-related-posts">			
			<td></td>
			<td><input type="button" id="add-related" class="button" value="Add" /></td>
		  </tr>';
	echo '<tr class="manual-related-posts">			
			<td></td>
			<td><div id="relatedpost-drop"><ul id="related-posts-list">';
	echo isset( $rp_items ) ? $rp_items : '';
	echo '</ul></div><input type="hidden" name="_related_posts_list" id="related-posts" value="' . esc_attr( $list ) . '" /></td>
		  </tr>';
	echo '</table>';
}

add_action('save_post', 'my_save_related_posts', 1, 2);
function my_save_related_posts( $post_id, $post ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return;

	if ( !isset( $_POST['my_related_posts_nonce'] ) || !wp_verify_nonce( $_POST['my_related_posts_nonce'], plugin_basename( __FILE__ ) ) )
		return;
		
	if ( !current_user_can( 'edit_post', $post->ID ))
		return;
	
	$temp['_related_posts_mode'] = isset( $_POST['_related_posts_mode'] ) ? $_POST['_related_posts_mode'] : '';
	$temp['_related_posts_count'] = isset( $_POST['_related_posts_count'] ) ? $_POST['_related_posts_count'] : '';
	$temp['_related_posts_list'] = isset( $_POST['_related_posts_list'] ) ? $_POST['_related_posts_list'] : '';
	foreach ( $temp as $key => $value ) {
		if( $post->post_type == 'revision' ) return;
		$value = implode( ',', (array)$value );
		if ( get_post_meta( $post->ID, $key, FALSE ) ) {
			update_post_meta($post->ID, $key, $value);
		} else {
			add_post_meta( $post->ID, $key, $value );
		}
		
		if ( !$value ) delete_post_meta( $post->ID, $key );
	}
}
// End Related Post Meta

/**
 * Adds popular_posts_widget widget.
 */
add_action( 'widgets_init', create_function( '', 'register_widget( "popular_posts_widget" );' ) );
class popular_posts_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'popular_posts',
			'Custom Popular Posts',
			array( 'description' => 'With Custom Popular Posts, you can show your visitors what are the most popular entries on your blog.' )
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$mode = $instance['mode'];
		$count = isset( $instance['count'] ) ?  $instance['count'] : 5;
		$thumb = $instance['thumb'];
		
		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
		if ( $mode == 'comment' ) {
			$my_query = new WP_Query( array( 'posts_per_page' => $count, 'orderby' => 'comment_count', 'ignore_sticky_posts' => 1 ) );
			echo '<ul>';
			if ( $my_query->have_posts() ): while ( $my_query->have_posts() ): $my_query->the_post(); $do_not_duplicate = get_the_ID();
				$img_tag = '';
				$span_open = '';
				$span_close = '';
				if ( $thumb ) {
					$img_tag = swp_get_post_thumbnail( get_the_ID(), 60, 60 );
					$span_open = '<span class="custom-widget-links">';
					$span_close = '</span>';
				}
?>
			<li><?php echo $img_tag; ?><?php echo $span_open; ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			<span class="comment-count"><?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?></span><?php echo $span_close; ?></li>
<?php
			endwhile;
			endif;
			echo '</ul>';
		} else {
			$my_query = new WP_Query( array( 'posts_per_page' => $count, 'orderby' => 'meta_value_num', 'meta_key' => '_views', 'order' => 'DESC', 'ignore_sticky_posts' => 1 ) );
			echo '<ul>';
			if ( $my_query->have_posts() ): while ( $my_query->have_posts() ): $my_query->the_post(); $do_not_duplicate = get_the_ID();
				$views = get_post_meta( get_the_ID(), '_views', true );
				$img_tag = '';
				$span_open = '';
				$span_close = '';
				if ( $thumb ) {
					$img_tag = swp_get_post_thumbnail( get_the_ID(), 60, 60 );
					$span_open = '<span class="custom-widget-links">';
					$span_close = '</span>';
				}
?>
			<li><?php echo $img_tag; ?><?php echo $span_open; ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a> 
			<span class="view-count"><?php echo $views; ?> <?php _e( 'views' ); ?></span><?php echo $span_close; ?></li>
<?php
			endwhile;
			endif;
			echo '</ul>';
		}
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['mode'] = $new_instance['mode'];
		$instance['count'] = strip_tags( $new_instance['count'] );
		$instance['thumb'] = $new_instance['thumb'];
				
		return $instance;
	}

	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : 'Popular Post';
		$mode = isset( $instance['mode'] ) ?  $instance['mode'] : 'view';
		$count = empty( $instance['count'] ) ?  5 : $instance['count'];
		$thumb = isset( $instance['thumb'] ) ? $instance['thumb'] : '';
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
		
		<p><?php _e( 'Popular by:' ); ?><br />
		<label><input type="radio" name="<?php echo $this->get_field_name( 'mode' ); ?>" value="comment" <?php checked( $mode, 'comment' ); ?> /> <?php _e( 'Comment' ); ?></label><br />
		<label><input type="radio" name="<?php echo $this->get_field_name( 'mode' ); ?>" value="view" <?php checked( $mode, 'view' ); ?> /> <?php _e( 'View' ); ?></label></p>
		
		<p><?php _e( 'Number of posts to show:' ); ?> 
		<input type="text" class="small-text" name="<?php echo $this->get_field_name( 'count' ); ?>" id="<?php echo $this->get_field_id( 'count' ); ?>" value="<?php echo esc_attr( $count ); ?>" /></p>
		
		<p><label><input type="checkbox" name="<?php echo $this->get_field_name( 'thumb' ); ?>" id="<?php echo $this->get_field_id( 'thumb' ); ?>" value="1" <?php checked( $thumb, 1 ); ?> /> 
		<?php _e( 'Show Thumbnail?' ); ?></label></p>
		<?php 
	}
}

/**
 * Adds custom_recent_posts_widget widget.
 */
add_action( 'widgets_init', create_function( '', 'register_widget( "custom_recent_posts_widget" );' ) );
class custom_recent_posts_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'custom_recent_posts',
			'Custom Recent Posts',
			array( 'description' => 'Hey, it\'s custom recent posts for your site.' )
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );		
		$count = isset( $instance['count'] ) ?  $instance['count'] : 5;
		$show_date = $instance['show_date'];
		$thumb = $instance['thumb'];
		
		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
		
		$my_query = new WP_Query( array( 'posts_per_page' => $count, 'ignore_sticky_posts' => 1 ) );
		echo '<ul>';
		if ( $my_query->have_posts() ): while ( $my_query->have_posts() ): $my_query->the_post(); $do_not_duplicate = get_the_ID();
			$img_tag = '';
			$span_open = '';
			$span_close = '';
			$date = '';
			
			if ( $thumb ) {
				$img_tag = swp_get_post_thumbnail( get_the_ID(), 60, 60 );
				$span_open = '<span class="custom-widget-links">';
				$span_close = '</span>';
			}
				
			if ( $show_date )
				$date = get_the_time('M jS Y');
?>
		<li><?php echo $img_tag; ?><?php echo $span_open; ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
		<span class="post-date"><?php echo $date; ?></span><?php echo $span_close; ?></li>
<?php
		endwhile;
		endif;
		echo '</ul>';
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		$instance['show_date'] = $new_instance['show_date'];		
		$instance['thumb'] = $new_instance['thumb'];
				
		return $instance;
	}

	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : 'Recent Posts';
		$count = empty( $instance['count'] ) ?  5 : $instance['count'];
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : '';
		$thumb = isset( $instance['thumb'] ) ? $instance['thumb'] : '';
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
		
		<p><?php _e( 'Number of posts to show:' ); ?> 
		<input type="text" class="small-text" name="<?php echo $this->get_field_name( 'count' ); ?>" id="<?php echo $this->get_field_id( 'count' ); ?>" value="<?php echo esc_attr( $count ); ?>" /></p>
		
		<p><label><input type="checkbox" name="<?php echo $this->get_field_name( 'show_date' ); ?>" id="<?php echo $this->get_field_id( 'show_date' ); ?>" value="1" <?php checked( $show_date, 1 ); ?> /> 
		<?php _e( 'Display post date?' ); ?></label></p>
		
		<p><label><input type="checkbox" name="<?php echo $this->get_field_name( 'thumb' ); ?>" id="<?php echo $this->get_field_id( 'thumb' ); ?>" value="1" <?php checked( $thumb, 1 ); ?> />
		<?php _e( 'Show Thumbnail?' ); ?></label></p>
		<?php 
	}
}

/**
 * Adds search_ads_widget widget.
 */
add_action( 'widgets_init', create_function( '', 'register_widget( "search_ads_widget" );' ) );
class search_ads_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'search_ads',
			'Search Ads',
			array( 'description' => 'The Search Widget lets you include an website search box on your page.' )
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
		$options = get_option( 'ads_options' );
		if ( $options['toggle_search_ads'] ) {
			echo $options['ads_search'];
		} else {
			get_search_form();
		}		
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
				
		return $instance;
	}

	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : 'Search Website';
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
		<?php 
	}
}

/**
 * Adds swp_tabbed_widget widget.
 */
add_action( 'widgets_init', create_function( '', 'register_widget( "swp_tabbed_widget" );' ) );
class swp_tabbed_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'swp_tabbed',
			'Tabbed Widget',
			array( 'description' => 'It\'s tabbed for your site.' )
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
				
		echo $before_widget; ?>		
		<div class="widget-tabs">
			<a href="#" class="active"><?php echo $instance['recent_title']; ?></a>
			<a href="#"><?php echo $instance['popular_title']; ?></a>
			<a href="#"><?php echo $instance['comment_title']; ?></a>
		</div>
		<div class="swiper-container swiper-tabs">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<div class="content-slide2">
						<ul>
							<?php
								$my_query = new WP_Query( array( 'posts_per_page' => $instance['recent_count'], 'ignore_sticky_posts' => 1 ) );
								if ( $my_query->have_posts() ): while ( $my_query->have_posts() ): $my_query->the_post(); $do_not_duplicate = get_the_ID();
									$img_tag = '';
									$span_open = '';
									$span_close = '';
									if ( $instance['recent_thumb'] ) {
										$img_tag = swp_get_post_thumbnail( get_the_ID(), 60, 60 );
										$span_open = '<span class="custom-widget-links">';
										$span_close = '</span>';
									}
							?>
							<li><?php echo $img_tag; ?><?php echo $span_open; ?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<span class="post-date"><?php echo get_the_time('M jS Y'); ?></span><?php echo $span_close; ?></li>
							<?php endwhile; endif; wp_reset_postdata(); ?>
						</ul>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="content-slide2">
						<ul>
							<?php
								$my_query = new WP_Query( array( 'posts_per_page' => $instance['popular_count'], 'orderby' => 'meta_value_num', 'meta_key' => '_views', 'order' => 'DESC', 'ignore_sticky_posts' => 1 ) );
								if ( $my_query->have_posts() ): while ( $my_query->have_posts() ): $my_query->the_post(); $do_not_duplicate = get_the_ID();
									$views = get_post_meta( get_the_ID(), '_views', true );
									$img_tag = '';
									$span_open = '';
									$span_close = '';
									if ( $instance['popular_thumb'] ) {
										$img_tag = swp_get_post_thumbnail( get_the_ID(), 60, 60 );
										$span_open = '<span class="custom-widget-links">';
										$span_close = '</span>';
									}
							?>
							<li><?php echo $img_tag; ?><?php echo $span_open; ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a> 
							<span class="comment-count"><?php echo $views; ?> <?php _e( 'views' ); ?></span><?php echo $span_close; ?></li>
							<?php
								endwhile;
								endif;
								wp_reset_postdata();
							?>
						</ul>
					</div>
				</div>
				<div class="swiper-slide">
					<div class="content-slide2">
						<?php
							global $wpdb;
							$query = "SELECT * from $wpdb->comments WHERE comment_approved= '1'
							ORDER BY comment_date DESC LIMIT 0, $instance[comment_count]";        
							$comments = $wpdb->get_results($query);

							if ( $comments ) {
								echo '<ul>';
								foreach ( $comments as $comment ) {
									if ( $comment->comment_author_url ) {
										$link_open = '<a href="' . $comment->comment_author_url . '">';
										$link_close = '</a>';
									}

									echo '<li>' . $link_open;
									echo $instance['comment_thumb'] ? get_avatar( $comment->comment_author_email, 32) : '';
									echo $link_close;
									echo $instance['comment_thumb'] ? '<span class="comment-details">' : '';
									echo $link_open . $comment->comment_author . $link_close . ' on <a href="' . get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID . '">' . get_the_title( $comment->comment_post_ID ) . '</a>';
									echo $instance['comment_thumb'] ? '</span>' : '';
									echo '<br class="clear"/></li>';
								}
								echo '</ul>';
							}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php echo $after_widget;		
	}

	public function update( $new_instance, $old_instance ) {
		$opts = get_tabbed_widget_options();
		$instance = array();
		foreach ( $opts as $opt ) {
			$instance[$opt['id'] . 'title'] = strip_tags( $new_instance[$opt['id'] . 'title'] );
			$instance[$opt['id'] . 'count'] = strip_tags( $new_instance[$opt['id'] . 'count'] );
			$instance[$opt['id'] . 'thumb'] = $new_instance[$opt['id'] . 'thumb'];
		}
				
		return $instance;
	}

	public function form( $instance ) {
		$opts = get_tabbed_widget_options();		
		foreach ( $opts as $opt ) {
			$title = isset( $instance[$opt['id'] . 'title'] ) ? $instance[$opt['id'] . 'title'] : $opt['title'];
			$count = isset( $instance[$opt['id'] . 'count'] ) ?  $instance[$opt['id'] . 'count'] : 5;
			$thumb = isset( $instance[$opt['id'] . 'thumb'] ) ? $instance[$opt['id'] . 'thumb'] : '';
		?>
		<p><strong><?php echo $opt['name']; ?></strong></p>
		<p><label for="<?php echo $this->get_field_id(  $opt['id'] . 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( $opt['id'] . 'title' ); ?>" name="<?php echo $this->get_field_name( $opt['id'] . 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
		
		<p><?php _e( 'Number of posts to show:' ); ?> 
		<input type="text" class="small-text" name="<?php echo $this->get_field_name( $opt['id'] . 'count' ); ?>" id="<?php echo $this->get_field_id( $opt['id'] . 'count' ); ?>" value="<?php echo esc_attr( $count ); ?>" /></p>
			
		<p><label><input type="checkbox" name="<?php echo $this->get_field_name( $opt['id'] . 'thumb' ); ?>" id="<?php echo $this->get_field_id( $opt['id'] . 'thumb' ); ?>" value="1" <?php checked( $thumb, 1 ); ?> />
		<?php echo $opt['thumb']; ?></label></p><hr /><?php } ?>
		
		<?php 
	}
}

/**
 * Adds medium_rectangle_ads_widget widget.
 */
add_action( 'widgets_init', create_function( '', 'register_widget( "medium_rectangle_ads_widget" );' ) );
class medium_rectangle_ads_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'medium_rectangle_ads',
			'Medium Rectangle Ads',
			array( 'description' => 'Ads 300 x 250 for your site.' )
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
		$options = get_option( 'ads_options' );
		echo $options['ads_medium_rectangle'];					
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
				
		return $instance;
	}

	public function form( $instance ) {
		?>
		<p><?php _e( 'Options can be found in Advertising tab in the Theme Options' ); ?></p>
		<?php 
	}
}

/**
 * Adds flickr_widget widget.
 */
add_action( 'widgets_init', create_function( '', 'register_widget( "flickr_photostream_widget" );' ) );
class flickr_photostream_widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'flickr_photostream',
			'Flickr PhotoStream',
			array( 'description' => 'Displays Flickr PhotoStream' )
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$flickr_id = isset( $instance['flickr_id'] ) ? $instance['flickr_id'] : '';
		$photostream_num = isset( $instance['photostream_num'] ) ? $instance['photostream_num'] : '';
		
		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
		?>
		<div class="flickr" data-flickr-id="<?php echo $flickr_id; ?>" data-count="<?php echo $photostream_num; ?>"></div>
		<?php				
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickr_id'] = strip_tags( $new_instance['flickr_id'] );
		$instance['photostream_num'] = strip_tags( $new_instance['photostream_num'] );
				
		return $instance;
	}

	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : 'Flickr';
		$flickr_id = isset( $instance['flickr_id'] ) ? $instance['flickr_id'] : '';
		$photostream_num = isset( $instance['photostream_num'] ) ? $instance['photostream_num'] : '';
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>"><?php _e( 'Flickr ID' ); ?></label>
		<input type="text" name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" id="<?php echo $this->get_field_id( 'flickr_id' ); ?>" class="widefat" value="<?php echo esc_attr( $flickr_id ); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'photostream_num' ); ?>"><?php _e( 'Number of PhotoStream displayed?' ); ?></label>
		<input type="text" name="<?php echo $this->get_field_name( 'photostream_num' ); ?>" id="<?php echo $this->get_field_id( 'photostream_num' ); ?>" class="small-text" value="<?php echo esc_attr( $photostream_num ); ?>" /></p>
		<?php 
	}
}

function get_tabbed_widget_options() {
	$opts = array(
		array(
			'id' => 'recent_',
			'name' => 'Recent Posts Tab',
			'title' => 'Recent',
			'thumb' => 'Show Thumbnail?'
		),
		array(
			'id' => 'popular_',
			'name' => 'Popular Posts Tab',
			'title' => 'Popular',
			'thumb' => 'Show Thumbnail?'
		),
		array(
			'id' => 'comment_',
			'name' => 'Recent Comments Tab',
			'title' => 'Comments',
			'thumb' => 'Use Gravatar?'
		)
	);
	
	return apply_filters( 'tabbed_widget_options', $opts );
}

function swp_get_post_thumbnail( $postid, $width = 100, $height = 100 ) {
	if ( has_post_thumbnail( $postid ) ) { 
		$html = get_the_post_thumbnail( $postid, 'full' );
		$html = empty( $html ) ? '<img src="' . get_template_directory_uri() . '/images/default-177x115.jpg">' : $html;
		$xpath = new DOMXPath(@DOMDocument::loadHTML($html));
		$img_url = $xpath->evaluate("string(//img/@src)");						
		$img_tag = '<img src="' . get_bloginfo( 'template_directory' ) . '/timthumb.php?src=' . $img_url . '&amp;w=' . $width . '&amp;h=' . $height . '&amp;zc=1&amp;q=100" alt="' . get_the_title( $postid ) . '" title="' . get_the_title(  ) . '" width="' . $width . '" height="' . $height . '" />';
	} else {
		$img_tag = '<img src="' . get_bloginfo( 'template_directory' ) . '/timthumb.php?src=' . get_bloginfo( 'template_url' ) . '/images/default.jpg&amp;w=' . $width . '&amp;h=' . $height . '&amp;zc=1&amp;q=100" alt="' . get_the_title( $postid ) . '" title="' . get_the_title( $postid ) . '" width="' . $width . '" height="' . $height . '" />';
	}
	return $img_tag;
}

add_filter( 'user_contactmethods', 'add_to_author_profile', 10, 1);
function add_to_author_profile( $contactmethods ) {
	$contactmethods['gplus'] = 'Google Plus';
	$contactmethods['fb'] = 'Facebook';
	$contactmethods['twitter'] = 'Twitter';
	return $contactmethods;
}

// Displays custom post title length. Modified by SlowestWP to fit theme needs. 
// Taken from: http://www.wprecipes.com/easily-display-post-titles-with-a-custom-length
function odd_title( $postid, $char ) {
	$title = get_the_title( $postid );
	$title_len = strlen( $title );
	if ( $title_len < $char ) {
		return $title;
	} else {
		$title = substr( $title, 0, $char );
		return $title . '...';
	}        
}

function print_excerpt( $length ) { // Max excerpt length. Length is set in characters
	global $post;
	$text = get_the_excerpt();
	$text = strip_shortcodes( $text ); // optional, recommended
	$text = strip_tags( $text ); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags

	$text = substr( $text, 0, $length );
	$excerpt = reverse_strrchr( $text, '.', 1 );
	if( $excerpt ) {
		echo apply_filters( 'the_excerpt', $excerpt . '[...]' );
	} else {
		echo apply_filters( 'the_excerpt', $text . '[...]' );
	}
}

// Returns the portion of haystack which goes until the last occurrence of needle
function reverse_strrchr( $haystack, $needle, $trail ) {
	return strrpos( $haystack, $needle ) ? substr( $haystack, 0, strrpos( $haystack, $needle ) + $trail ) : false;
}

add_action( 'print_satoe_verifications', 'verification_metas' );
function verification_metas() {
	$verifications = get_option( 'site_verifications_options' );
	$homepage = get_option( 'homepage_options' );
	$general = get_option( 'general_options' );
	$socials = get_option( 'social_options' );
	$ads = get_option( 'ads_options' );
	if ( ! empty( $verifications['google'] ) ) {
		echo '<meta name="google-site-verification" content="' . esc_attr( $verifications['google'] ) .'" />';
		echo "\n";
	}
	
	if ( ! empty( $verifications['bing'] ) ) {
		echo '<meta name="msvalidate.01" content="' . esc_attr( $verifications['bing'] ) . '" />';
		echo "\n";	
	}
	
	if ( ! empty( $verifications['alexa'] ) ) {
		echo '<meta name="alexaVerifyID" content="' . esc_attr( $verifications['alexa'] ) . '" />';
		echo "\n";
	} 
}