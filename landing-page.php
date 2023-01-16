<?php
/*
* Template name: Landing page
*/
get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post(); ?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 p-0">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
<?php

	}
} else {
	echo "No content was found";
}

get_footer();
