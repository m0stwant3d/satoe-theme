<?php get_header(); ?>
<div id="content" class="narrowcolumn">
	<?php if (have_posts()) : ?>
	<h1 class="pagetitle">Search Results for: <?php the_search_query();?></h1>
	<?php while (have_posts()) : the_post(); ?>
	<div class="post">
		<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<p class="postmetadata">
			<span class="timr"><span class="timr-icon"></span><?php the_time('M jS Y') ?>&nbsp;</span>
			<span class="author"><span class="author-icon"></span>By: <?php the_author(); ?>&nbsp;</span>
			<?php if ( $post->post_type == 'post' ) { ?><span class="catr"><?php the_category(', ', 'showposts=2') ?></span><?php } ?>			
			<span class="comm"><span class="comment-icon"></span><?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?></span>
		</p>
		<div class="index">
			<img src="<?php echo bloginfo('template_url'); ?>/timthumb.php?src=<?php echo get_first_image(); ?>&amp;h=70&amp;w=70&amp;zc=1" alt="<?php the_title(); ?>" />
			<div class="excerpt"><?php echo excerpt(45); ?>...</div>
			<p class="readmore"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">learn more &nbsp;<span class="icon-text">&raquo;</span></a>
			</p>
		</div>
	</div>
	<?php endwhile; ?>
	<?php else : ?>
	<div id="error">
		<h1 class="errors">Sorry! No posts matched your criteria.</h1>
		<h2 class="errors">Did you try searching? Enter a keyword(s) in the search field above. Or, try one of the links below.</h2>
	</div>
	<p class="aligncenter"><strong>Search</strong> - Use the following search box to track down the page youre after:</p>
		<?php get_template_part( 'searchform' ); ?>
		<?php endif; ?>
		<?php get_template_part( 'navigator' ); ?>
		<div class="clear"></div>
		<br/>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>