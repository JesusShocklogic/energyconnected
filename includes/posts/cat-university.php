<?php
function post_cat_university()
{
	$args = array(
		'post_type'         => 'post', //it does accept Custom Types
		'posts_per_page'   => 4,
		'offset'			=> 0,
		'post_status'      => 'publish',
		'order'             => 'DESC', // ASC ascended , DESC descend
		'category_name'     => 'university'
	);
	// query
	$wp_query = new WP_Query($args);

	if ($wp_query->have_posts()) {
		$results = '';
		$results = <<<RESULTS
		<div class="row pb-xl-1">
				<div class="col-12">
					<h3 class="title notoBold">University articles</h3>
				</div>
			</div>
			<!-- ARTICLE -->
			<div class="row">
		RESULTS;
		while ($wp_query->have_posts()) {
			$wp_query->the_post();

			$image=get_the_post_thumbnail_url();
			$title=get_the_title();
			$link=get_the_permalink();

			$results .= <<<RESULTS
				<div class="col-12 col-md-6 pe-xl-3 mb-4 pb-4">
					<div class="card card-height border-0">
						<a href="$link">
							<img src="$image" class="card-img-size" alt="">
						</a>
						<div class="card-body pb-0">
							<div class="row">
								<div class="col-12">
									<a href="$link" class="text-decoration-none text-black">
										<p class="card-title">
											$title
										</p>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			RESULTS;
		};
		$results .= <<<RESULTS
			</div>
			RESULTS;
	}
	echo $results;
}
