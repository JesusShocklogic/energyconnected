<?php
/*
* Template name: Exhibitors
*/
get_header();

$data = get_field('data');
//the_content();
$the_content = get_the_content();
$args = array(
	//'posts_per_page'   => -1, // Negative numbers means ALL. Cero means ALL too, but some errors have been detected.
	'post_type'         => 'exhibitor', //it does accept Custom Types
	'offset'			=> 0,
	'post_status'      => 'publish',
	'order'           => 'ASC',
);
// query
$wp_query = new WP_Query($args);

if ($wp_query->have_posts()) {
	$partners = "";
	$dir = get_template_directory_uri();

	while ($wp_query->have_posts()) {
		$wp_query->the_post();
		$id = get_the_ID();
		$image = get_the_post_thumbnail_url();
		$title = get_the_title();
		$content = get_the_content();
		$link = get_field("link");
		$partners .= <<<PARTNER
		<div class="col-6 col-md-4 col-lg-3">
			<div class="ratio ratio-1x1 p-4" type="button" id="submit" data-bs-toggle="modal" data-bs-target="#partnerModal-$id" data-id="$id">
				<div class="d-flex p-4">
					<img src="$image" class="img-fluid align-self-center" />
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="partnerModal-$id" tabindex="-1">
			<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
				<div class="modal-content border-dark">
					<div class="modal-body">
						<div class="d-flex p-2 justify-content-end">
							<img src="$dir/images/btn-close-green.svg" type="button" data-bs-dismiss="modal" aria-label="Close" />
						</div>
						<div class="d-flex flex-lg-row flex-column">
							<div class="d-flex flex-column p-4 align-self-lg-center">
								<div class="modal-image ratio ratio-1x1 m-auto">
									<img src="$image" style="object-fit: scale-down;" />
								</div>
PARTNER;
		if ($link) :
			$link_url = $link['url'];
			$link_title = $link["title"];
			$link_target = $link['target'] ?: '_self';
			$link_target = esc_attr($link_target);
			$partners .= <<<PARTNER
								<a href=$link_url class="btn rounded-pill bg-green my-3 p-1" target=" $link_target">
									$link_title
								</a>
PARTNER;
		endif;
		$partners .= <<<PARTNER
							</div>
							<div class="px-4">
								<div class="pb-4">
									<div><b>$title</b></div>
								</div>
								<div class="pb-4">
									$content
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
PARTNER;
	};

	//Building carousel
	if (!empty($data['adds_carousel'])) {
		$carousel = "";
		$carouselArray = $data['adds_carousel'];

		$carousel .= <<<ITEMS
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div id="addsCarousel" class="carousel slide" data-bs-ride="carousel">
						<div class="carousel-inner">
ITEMS;
		foreach ($carouselArray as $key => $carouselItem) {
			$image = $carouselItem['image']['url'];
			$active = ($key == 0) ? 'active' : '';
			$carousel .= <<<ITEMS
							<div class="carousel-item $active">
								<img src="$image" class="d-block w-100" alt="...">
							</div>
ITEMS;
		}
		$carousel .= <<<ITEMS
							<button class="carousel-control-prev" type="button" data-bs-target="#addsCarousel" data-bs-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Previous</span>
							</button>
							<button class="carousel-control-next" type="button" data-bs-target="#addsCarousel" data-bs-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Next</span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
ITEMS;
	}
?>

	<style>
		.carousel-item img {
			height: 150px;
			object-fit: contain;
		}
	</style>
	<!--SPONSOR GRID-->
	<div class="container">
		<div class="row g-5">
			<?php echo $partners; ?>
			<?= $the_content ?>
		</div>
	</div>
	<?= $carousel; ?>

<?php
	wp_reset_query();
}
get_footer();
?>