<?php get_header(); ?>
<div id="content" class="narrowcolumn">
	<h1 class="searching">I'm sorry but the Page You're Looking for Is Not Here</h1>
	<strong>Let us Help You Find What you are Looking For</strong>
	<p>We can't find the page you're currently looking for but there are a few ways that we might be able to track it down for you.</p>
	<p><strong>Search</strong> - use the following search box to track down the page you're after:</p>
	<div><center><?php get_search_form(); ?></center></div>
	<p>Contact Me If you still can't find it please <a href="mailto:<?php bloginfo( 'admin_email' ); ?>">Send me an Email</a> and I'll try to track it down for you.</p>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>