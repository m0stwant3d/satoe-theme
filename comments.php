<?php // Do not delete these lines
	if ( 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
		die ( 'Please do not load this page directly. Thanks!' );
	if ( post_password_required() ) { ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'standar' ); ?></p><?php
		return;
	}	
?>
<div id="comment-section">
	<?php if ( have_comments() ) { ?>
	<h3 id="comments-title"><?php comments_number( __( 'No Comments', 'standar' ), __( 'One Comment', 'standar' ), __( '% Comments', 'standar' ) ); ?> 
	<span class="comments-title">to &#8220;<?php the_title(); ?>&#8221;</span></h3>
	<ul class="commentlist">
		<?php wp_list_comments( 'avatar_size=42&callback=custom_comment' ); ?>
	</ul>
	<div class="comment-nav">
		<div class="navleft"><?php previous_comments_link() ?></div>
		<div class="navright"><?php next_comments_link() ?></div>
	</div><div class="clear"></div>
	<?php } else { ?>
		<?php if ( comments_open() ) { ?><p class="nocomment"><em><?php _e( 'There are no comments yet', 'standar' ); ?></em></p>
		<?php } else { ?><p class="nocomment"><em><?php _e( 'Comments are closed', 'standar' ); ?></em></p>
	<?php } } ?>
	
	<?php if ('open' == $post->comment_status) : ?>
 
	<div id="respond">
		<span><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?> <small class="cancel-reply"><?php cancel_comment_reply_link('Cancel Reply'); ?></small></span>
		<p>Your email address will not be published. Required fields are marked *</p>
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
		<?php else : ?>

		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
		<?php if ( $user_ID ) : ?>
		<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>
		<?php else : ?>

		<p><label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label><input type="text" name="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" /></p>

		<p><label for="email"><small>Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label><input type="text" name="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" /></p>

		<p><label for="url"><small>Website</small></label><input type="text" name="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" /></p>

		<?php endif; ?>
		<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
		<p><textarea name="comment" id="comment" cols="10" rows="10" tabindex="4"></textarea></p>

		<p class="form-submit"><input name="submit" type="submit" id="submit" tabindex="5" value="Post Comment" />
		<?php comment_id_fields(); ?>
		</p>
		<?php do_action('comment_form', $post->ID); ?>
		</form>

		<?php endif; // If registration required and not logged in ?>
	</div>
<?php endif; // if you delete this the sky will fall on your head ?>
</div>