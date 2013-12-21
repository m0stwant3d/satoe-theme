<?php get_header(); ?>
// Add a comment.
<div id="content">
	<?php if (have_posts()): ?>
	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	<?php /* If this is a category archive */ if (is_category()) { ?>
	<h1 class="pagetitle">Category: &ldquo;<?php echo single_cat_title(); ?>&rdquo;</h1>
	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
	<h1 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h1>
	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	<h1 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h1>
	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	<h1 class="pagetitle">Archive for <?php the_time('Y'); ?></h1>
	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
	<h1 class="pagetitle">Author Archive</h1>
	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<h1 class="pagetitle">Blog Archives</h1>
	<?php } ?>
	<br class="clear" />
	<?php while (have_posts()): the_post(); ?>
	<div class="post">
		<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		<p class="postmetadata">
			<span class="timr"><span class="timr-icon"></span><?php the_time('M jS Y') ?>&nbsp;</span>
			<span class="author"><span class="author-icon"></span>By: <?php the_author(); ?>&nbsp;</span>
			<span class="catr"><span class="catr-icon"></span><?php the_category(', ', 'showposts=2') ?></span>			
			<span class="comm"><span class="comment-icon"></span><?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?></span>
		</p>
		<div class="index">
			<img src="<?php echo bloginfo('template_url'); ?>/timthumb.php?src=<?php echo get_first_image(); ?>&amp;h=70&amp;w=70&amp;zc=1" alt="<?php the_title(); ?>" />
			<div class="excerpt"><?php echo excerpt(45); ?>...</div>
			<p class="readmore"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">learn more &nbsp;<span class="icon-text">&raquo;</span></a></p>
		</div>
	</div>
	<?php endwhile; ?>
	<?php else : ?>
	<h2 class="center">Not Found</h2>
	<?php get_search_form(); ?>
	<?php endif; ?>
	<?php get_template_part( 'navigator' ); ?>
	<div class="clear"></div>
	<br/>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
