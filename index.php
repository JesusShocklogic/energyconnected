<?php
get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post(); ?>
		<div class="side-padding">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
<?php

	}
} else {
	echo "No content was found";
}

get_footer();
