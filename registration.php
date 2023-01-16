<?php
/*
* Template name: Registration
*/
get_header();

if (have_posts()) :
	while (have_posts()) :
		the_post();
		$data = get_field('data');
?>

		<!-- CARDS -->
		<div class="side-padding">
			<div class="container-fluid mt-5">
				<div class="row justify-content-center gx-xl-5">
					<?php
					foreach ($data["cards"] as $card) :
						$link = $card["link"];
						if ($link): 
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
					?>
						<div class="col-11 col-lg-4 mb-4 mb-lg-0 text-center">
							<a href="<?= $link_url ?>" target="<?= esc_attr( $link_target ) ?>">
								<img class="date-img-size" src="<?= $card["image"]["url"]; ?>">
							</a>
						</div>
					<?php
						endif;
					endforeach;
					?>
				</div>
			</div>
		</div>

		<!-- ADS -->
		<div class="side-padding">
			<div class="container-fluid my-5 d-none d-md-block d-lg-block">
				<div class="row">
					<div class="col-12">
						<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
							<div class="carousel-inner">
								<?php
								foreach ($data["ads"] as $key => $ad) :
									$active = ($key == 0) ? 'active' : '';
								?>
									<div class="carousel-item <?= $active ?>">
										<a href="<?= $ad["url"] ?>">
											<img src="<?= $ad["image"]["url"] ?>" class="img-fluid long-ad-height" />
										</a>
									</div>
								<?php
								endforeach;
								?>
							</div>
							<button class="carousel-control-prev d-flex justify-content-start ps-3" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Previous</span>
							</button>
							<button class="carousel-control-next d-flex justify-content-end pe-3" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Next</span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php
	endwhile;
endif;

get_footer();
?>
