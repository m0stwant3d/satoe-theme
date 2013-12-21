<?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>		
<div class="post post-<?php the_ID(); ?>" style="width:570px;float:left">
	<div class="posttitle">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
	</div>
	<p class="postmetadata"><span class="timr"><span class="timr-icon"></span><?php the_time('M jS Y'); ?>&nbsp;</span>
	<span class="author"><span class="author-icon"></span>Posted By: <?php the_author(); ?>&nbsp;</span>	  
	<span class="comm"><span class="comment-icon"></span><?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?></span></p>
	
	<a href="<?php the_permalink(); ?>"><img src="<?php echo bloginfo( 'template_directory' ); ?>/timthumb.php?src=<?php echo get_first_image(); ?>&amp;h=100&amp;w=120&amp;zc=1&amp;q=80" alt="<?php the_title(); ?>" width="120" height="100" /></a>
	<div class="home-post-excerpt"><?php echo excerpt(50); ?>...</div>
	<p class="readmore"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">learn more &nbsp;<span class="icon-text">&raquo;</span></a></p>
	<div style="clear: both"></div>
</div>
<?php endwhile; ?>
<?php else : ?>
<div class="notfound"></div>
<div class="post"><center><h2>404 Not Found</h2></center></div>
<?php endif; ?>
<?php get_template_part( 'navigator' ); ?>
<div class="clear"></div>