<?php
get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post();
		the_content(); ?>
		<h1>Page not found</h1>
<?php
	}
} else {
	echo "No content was found";
}

get_footer();
