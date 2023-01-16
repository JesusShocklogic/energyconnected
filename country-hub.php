<?php
/*
* Template name: Country Hub
*/
get_header();

if (have_posts()) :
	while (have_posts()) :
		the_post();
?>

		<!-- VIDEO -->
		<div class="side-padding">
			<div class="container-fluid">
				<div class="row g-lg-5">
					<div class="col col-lg-8">
						<div class="country-hub-video">
							<?= get_field("video")["iframe"] ?>
						</div>
						<div class="my-4">
							<div class="d-flex mt-4">
								<div style="width: 100px" class="align-self-center">
									<img src="<?= get_template_directory_uri() ?>/images/play.svg" class="w-100" />
								</div>
								<div class="w-100 ms-4">
									<h3 style="color: #000000">
										<strong><?= get_field("video")["title"] ?></strong>
									</h3>
									<div>
										<?= get_field("video")["description"] ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg d-none d-lg-block">
						<?php
						$link = get_field("main_ad")["link"];
						$image_url = get_field("main_ad")["image"]["url"];
						if ($link) {
							$link_url = esc_url($link['url']);
							$link_target = $link['target'] ? $link['target'] : '_self';
							$link_target = esc_attr($link_target);
							$item = <<<ITEM
								<a href="$link_url">
									<img src="$image_url" class="img-fluid" />
								</a>
							ITEM;
						} else {
							$item = <<<ITEM
								<img src="$image_url" class="img-fluid" />
							ITEM;
						}

						echo $item;
						?>

					</div>
				</div>
			</div>
		</div>

		<?php
		speakers_carousel();
		universities_carousel( get_field('universities_carousel_category') );
		?>

		<!-- AD -->
		<?php
		if (have_rows('ads')) :
			the_row();
		?>
			<div class="side-padding">
				<div class="container-fluid my-5 d-none d-md-block d-lg-block">
					<div class="row">
						<div class="col-12">
							<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
								<div class="carousel-inner">
									<?php
									$carousel = get_field('ads');
									if ($carousel) {
										$items = "";
										foreach ($carousel as $key => $item) {
											$link = $item['link'];
											if ($link) {
												$image = $item['image']['url'];
												$link_url = esc_url($link['url']);
												$link_target = $link['target'] ? $link['target'] : '_self';
												$link_target = esc_attr($link_target);
												$active = $key == 0 ? "active" : "";
												$items .= <<<ITEM
													<div class="carousel-item $active">
														<a href="$link_url" target="$link_target">
															<img src="$image" class="img-fluid long-ad-height" />
														</a>
													</div>
												ITEM;
											}
										}
										echo $items;
									}
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
		endif;
		?>

		<?php
		partners_carousel()
		?>

<?php
	endwhile;
endif;

get_footer();
?>