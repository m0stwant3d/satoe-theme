<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php 
	if ( is_home() ) { bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); } ?>
	<?php if ( is_front_page() ) { _e( 'Homepage' ); } ?>
	<?php if ( is_single() || is_page() ) { wp_title( '' ); ?> | <?php bloginfo( 'name' ); } ?>
	<?php if ( is_category() ) { ?>Category of <?php single_cat_title(); ?> | <?php bloginfo( 'name' );	} ?>
	<?php if ( is_tag() ) { single_tag_title(); ?> Tag | <?php bloginfo( 'name' ); } ?>
	<?php if ( is_author() ) { ?> Author Page of 
	<?php global $author; $user = get_userdata($author); echo $user->display_name; } ?>
	<?php if ( is_day() ) { the_time( 'F jS, Y' ); ?> | <?php bloginfo( 'name' ); } ?>
	<?php if ( is_month() ) { the_time( 'F Y' ); ?> | <?php bloginfo( 'name' ); } ?>
	<?php if ( is_year() ) { the_time( 'Y' ); ?> | <?php bloginfo( 'name' ); } ?>
	<?php if ( is_search() ) { ?>Search Result For: <?php the_search_query(); ?> | <?php bloginfo( 'name' ); } ?>
	<?php if ( is_404() ) { ?>ERROR 404 - Not Found | <?php bloginfo( 'name' ); } ?>
	<?php $paged = ( get_query_var('paged') ) ? get_query_var( 'paged' ) : 1; ?>
	<?php if ( $paged != 1 ) { echo " - Page " . $paged; } 
?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic" type="text/css">
<?php do_action( 'print_satoe_frontend_styles' ); ?>
<?php do_action( 'print_satoe_verifications' ); ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php do_action( 'print_satoe_frontend_scripts' ); ?>
<?php wp_head(); ?>
</head>
<body>
<div id="wrapper">	
	<div id="head">
		<div id="header" class="clearfix">
			<?php $display = get_option( 'display_options' ); ?>
			<!-- BEGIN #logo -->
			<div id="logo">
				<?php if ( ! empty( $display['logo_image'] ) ) { ?>
				<a href="<?php bloginfo( 'url' ); ?>"><img id="site-logo" src="<?php echo esc_url( sanitize_text_field( $display['logo_image'] ) ); ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" width="320" height="90" /></a>
				<h1 class="alt-site-title"><a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
				<?php } else { ?>
				<h1 id="site-title"><a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a></h1><?php } ?><!-- END #logo -->
			</div>
			<!-- BEGIN #banner-header -->
			<div id="banner-header">
				<?php $ads = get_option( 'ads_options' ); ?>
				<?php if ( ! empty( $ads['ads_top_banner'] ) ) { echo $ads['ads_top_banner']; } ?><!-- END #banner-header -->
			</div><br class="clear" />
			<p id="tagline"><?php bloginfo( 'description' ); ?></p>
		</div>
		<!-- BEGIN #menu -->
		<div id="menus">
			<div class="content">
				<div class="content_left">
					<div id="topmenu">
						<?php wp_nav_menu( array( 'theme_location' => 'top-menu', 'fallback_cb' => '' ) ); ?>
					</div>
				</div>
				<div class="content_right">
					<div class="search_cont">
					<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
						<input type="text" name="s" id="header-search" onblur="this.value=(this.value=='') ? '<?php _e('Search website..', "wpct"); ?>' : this.value;" onfocus="this.value=(this.value=='<?php _e('Search website..', "wpct"); ?>') ? '' : this.value;" value="<?php _e( 'Search website..' ); ?>" />
						<input type="image" src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/search.png" class="search_icon" alt="Submit Form" />
					</form>
					</div>
				</div><!-- END #menu -->
			</div>
			<!-- BEGIN #breakingnews -->
			<?php get_template_part( 'header', 'breakingnews' ); ?>
			<!-- BEGIN #soc_med -->
			<div class="a_kanan">
				<?php
					$socials = get_option( 'social_options' );

					$rss = empty( $socials['rss_feed'] ) ? 'javascript:;' : esc_url( sanitize_text_field( $socials['rss_feed'] ) );
					$rss_target = $rss == 'javascript:;' ? '_self' : '_blank';
					
					$twitter = empty( $socials['twitter'] ) ? 'javascript:;' : esc_url( sanitize_text_field( $socials['twitter'] ) );
					$twitter_target = $twitter == 'javascript:;' ? '_self' : '_blank';
					
					$fb = empty( $socials['fb'] ) ? 'javascript:;' : esc_url( sanitize_text_field( $socials['fb'] ) );
					$fb_target = $fb == 'javascript:;' ? '_self' : '_blank';
					
					$gplus = empty( $socials['gplus'] ) ? 'javascript:;' : esc_url( sanitize_text_field( $socials['gplus'] ) );
					$gplus_target = $gplus == 'javascript:;' ? '_self' : '_blank';
					
					$pinterest = empty( $socials['pinterest'] ) ? 'javascript:;' : esc_url( sanitize_text_field( $socials['pinterest'] ) );
					$pinterest_target = $pinterest == 'javascript:;' ? '_self' : '_blank';
					
					$youtube = empty( $socials['youtube'] ) ? 'javascript:;' : esc_url( sanitize_text_field( $socials['youtube'] ) );
					$youtube_target = $youtube == 'javascript:;' ? '_self' : '_blank';
				?>
				<div id="social-icons" class="icon_flat">
					<a class="tooldown facebook-tieicon" href="<?php echo $fb ; ?>" target="<?php echo $fb_target; ?>" title="Facebook"></a>
					<a class="tooldown twitter-tieicon" href="<?php echo $twitter; ?>" target="<?php echo $twitter_target; ?>" title="Twitter"></a>
					<a class="tooldown google-tieicon" href="<?php echo $gplus; ?>" target="<?php echo $gplus_target; ?>" title="Google+"></a>
					<a class="tooldown pinterest-tieicon" href="<?php echo $pinterest; ?>" target="<?php echo $pinterest_target; ?>" title="Pinterest"></a>
					<a class="tooldown youtube-tieicon" href="<?php echo $youtube; ?>" target="<?php echo $youtube_target; ?>" title="Youtube"></a>
					<a class="tooldown rss-tieicon" href="<?php echo $rss; ?>" target="<?php echo $rss_target; ?>" title="Rss"></a>
				</div><!-- END #soc_med -->
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<div id="leaderboard-ads"><?php echo empty( $ads['ads_leaderboard'] ) ? '' : $ads['ads_leaderboard']; ?></div>
	<div id="page">
		<div id="pagein">
			<?php $general = get_option( 'general_options' ); ?>
			<?php if ( ! empty( $general['show_breadcrumbs'] ) ) { the_breadcrumb(); } ?>