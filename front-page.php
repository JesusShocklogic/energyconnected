<?php
/*
* Template name: Front page
*/
get_header('front'); ?>

<!-- Text section -->
<div class="side-padding">
	<div class="container-fluid">
		<div class="col-12 pb-4">
			<?php the_field('text_section'); ?>
		</div>
	</div>
</div>

<!-- STATS -->
<div class="side-padding">
	<div class="container-fluid">
		<div class="row justify-content-around align-items-center">
			<?php
			$stats_repeater = get_field('stats_repeater');
			if ($stats_repeater) {
				foreach ($stats_repeater as $key => $stat) { ?>
					<div class="col-md-3 col-12 pb-4 pb-md-3">
						<div class="row text-center">
							<div class="col-12">
								<?php
								if ($stat['top'] == "text") { ?>
									<h2 class="notoBold stats-font"><?= $stat['text'] ?></h2>
								<?php } //if top
								elseif ($stat['top'] == "image") { ?>
									<div class="ratio ratio-1x1" style="max-height: 125px;">
										<img src="<?= $stat['image']['url'] ?>" style="object-fit: contain;" class="d-block mx-auto img-fluid">
									</div>
								<?php
								}
								?>

							</div>
							<div class="col-12">
								<h2><?= $stat['bottom_text'] ?></h2>
							</div>
						</div>
					</div>
			<?php }
			} //if stats repeater
			?>
		</div>
	</div>
</div>

<!-- DATES IMAGES -->
<div class="side-padding">
	<div class="container-fluid mt-5">
		<div class="row justify-content-center gx-xl-5">
			<!-- IMAGE 1 -->
			<div class="col-11 col-lg-4 mb-4 mb-lg-0 text-center">
				<a href="<?php echo get_field("date_image_1_url")["url"]; ?>">
					<img class="date-img-size" src="<?php echo get_field("date_image_1")["url"]; ?>">
				</a>
			</div>
			<!-- IMAGE 2 -->
			<div class="col-11 col-lg-4 mb-4 mb-lg-0 text-center">
				<a href="<?php echo get_field("date_image_2_url")["url"]; ?>">
					<img class="date-img-size" src="<?php echo get_field("date_image_2")["url"]; ?>">
				</a>
			</div>
			<!-- IMAGE 3 -->
			<div class="col-11 col-lg-4 mb-4 mb-lg-0 text-center">
				<a href="<?php echo get_field("date_image_3_url")["url"]; ?>">
					<img class="date-img-size" src="<?php echo get_field("date_image_3")["url"]; ?>">
				</a>
			</div>
		</div>
	</div>
</div>

<!-- CARRUSEL SPEAKERS -->
<?php speakers_carousel(get_field('speakers_carousel')); ?>

<!-- CARRUSEL PARTNERS -->
<?php partners_carousel(); ?>

<!-- Exhibitors Carousel -->
<?php //exhibitors_carousel(); 
?>

<!-- LATEST POSTS -->
<div class="side-padding">
	<div class="container-fluid">
		<div class="row justify-content-center">
			<!-- MAIN CONTENT -->
			<div class="col-12 col-lg-8">
				<!-- CAROUSEL AD -->
				<?php
				//Building carousel
				$carousel = "";
				if (!empty(get_field('adds_carousel'))) {

					$carouselArray = get_field('adds_carousel');

					$carousel .= <<<ITEMS
							<div class="row">
								<div class="col-12">
									<div id="addsCarousel" class="carousel slide" data-bs-ride="carousel">
										<div class="carousel-inner">
ITEMS;

					foreach ($carouselArray as $key => $carouselItem) {
						$image = $carouselItem['image']['url'];
						$link = $carouselItem['link'];
						if ($link) {
							$active = ($key == 0) ? 'active' : '';
							$link_url = esc_url($link['url']);
							$link_title = esc_html($link['title']);
							$link_target = $link['target'] ? $link['target'] : '_self';
							$link_target = esc_attr($link_target);

							$carousel .= <<<ITEMS
								<div class="carousel-item $active">
									<a href="$link_url" target="$link_target">
										<img src="$image" class="d-block w-100" alt="...">
									</a>
								</div>
ITEMS;
						} else {
							$carousel .= <<<ITEMS
								<div class="carousel-item $active">
									<img src="$image" class="d-block w-100" alt="...">
								</div>
ITEMS;
						}
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
ITEMS;
				} //Building carousel
				echo $carousel;
				//calling the latest articles
				posts_latest(); ?>
			</div>
			<!-- SIDEBAR -->
			<div class="col-11 col-lg-4 ps-xl-4 mt-lg-0">
				<!-- MOST READ ARTICLES -->
				<div class="row">
					<div class="col-12 col-md-6 col-lg-12">
						<?php
						if (isset(get_field('theme_settings', 'options')["most_read_image"]["url"])) { ?>
							<img src="<?= get_field('theme_settings', 'options')["most_read_image"]["url"]; ?>" class="mostRead-img-size" alt="">
						<?php
						}
						?>
					</div>
				</div>
				<?php most_read($limit = 5); ?>
			</div>
		</div>
	</div>
</div>
<!-- Latest posts -->

<!-- Testimonials-->
<style>
	.testimonial {
		background: #F8F8F9 0% 0% no-repeat padding-box;
		box-shadow: 5px 5px 8px #00000029;
		padding: 2rem;
	}

	.testimonials-grid {
		display: grid;
		grid-gap: 1.5rem;
		grid-template-columns: repeat(auto-fit, minmax(15rem, 1fr));

	}

	@media (min-width: 576px) {}

	@media (min-width: 768px) {}

	@media (min-width: 992px) {}

	@media (min-width: 1200px) {}

	@media (min-width: 1400px) {}
</style>
<?php
$testimonials_repeater = get_field('testimonials_repeater');
if ($testimonials_repeater) { ?>
	<div class="side-padding">
		<div class="mt-5 testimonials-grid">
			<?php
			foreach ($testimonials_repeater as $key => $testimonial) { ?>
				<div class="testimonial">
					<?= $testimonial['testimonial'] ?>
				</div>
			<?php
			}
			?>
		</div>
	</div>
<?php
} //if testimonials 
?>

<?php get_footer(); ?>