<?php
/*
* Template name: Articles
*/
get_header();
$data = get_field('data');
$add1 = $data['add_1']['url'];
$add1_link = $data['add_1_link']['url'];
$longAdd = $data['long_add']['url'];
$longAdd_link = $data['long_add_link']['url'];
$tiktokAdd = $data['tiktok_add']['url'];
$tiktokAdd_link = $data['tiktok_add_link']['url'];
$tiktokAdd_target = $data['tiktok_add_link']['target'] ? $data['tiktok_add_link']['target'] : '_self';
$most_read = get_field('theme_settings', 'options')['most_read_image']['url'];
?>

<style>
	.sidebar-ad-img-size {
		height: 350px;
		width: 100%;
		object-fit: contain;
		object-position: center top;
	}

	.title {
		font-size: 20px;
	}

	.card-title {
		font-size: 20px;
		font-weight: 600;
	}

	/* HEADER STYLE */
	.social-icons {
		height: 34px;
	}


	.logo-size {
		max-width: 130px;
	}

	.text-black {
		color: #000000;
	}

	.bg-green {
		background-color: #00fa0c;
	}

	.bgcolor-black {
		background-color: #000000;
	}

	.menu-bgcolor {
		background-color: #000000;
	}

	.white {
		color: #ffffff;
	}

	/* ---------------------- */

	.text-footer {
		text-align: center;
	}

	.offcanvas-size {
		width: 300px;
	}

	.art-icons-size {
		height: 15px;
		color: #8b8b8b;
	}

	.side-padding {
		padding-left: 8vw;
		padding-right: 8vw;
	}

	.carousel-item img {
		width: 100%;
		object-fit: contain;
		min-height: 200px;
		height: 15rem;
	}

	@media (min-width: 576px) {}

	@media (min-width: 768px) {}

	@media (min-width: 992px) {}

	@media (min-width: 1200px) {

		.carousel-item img {
			min-height: 320px;
			height: 320px;
		}

		.side-padding {
			padding-left: 5vw;
			padding-right: 5vw;
		}

		.menu-bgcolor {
			background-image: linear-gradient(#acacac, #FFFFFF);
		}

		.text-footer {
			text-align: left;
		}

		.logo-size {
			max-width: 200px;
		}

		.art-icons-size {
			height: 16px;
			color: #8b8b8b;
		}

		.tiktok-ad-img-size {
			height: 760px;
			width: 100%;
			object-fit: cover;
			object-position: center center;
		}
	}

	/* min-width: 1200px */

	@media (min-width: 1400px) {
		.carousel-item img {
			min-height: 350px;
			height: 350px;
		}

		.menu-bgcolor {
			background-image: linear-gradient(#acacac, #FFFFFF);
		}

		.text-footer {
			text-align: left;
		}

		.logo-size {
			max-width: 200px;
		}
	}

	/* min-width: 1400px */
</style>

<div class="container-fluid side-padding pb-5">
	<!-- MAIN CONTENT -->
	<div class="row">
		<!-- LATEST ARTICLES -->
		<div class="col-12 col-xl-8">
			<div class="row pb-1">
				<div class="col-12">
					<h3 class="title notoBold">Latest articles</h3>
				</div>

				<?php
				$args = array(
					'post_type'         => 'post', //it does accept Custom Types
					'posts_per_page'   => 6,
					'offset'            => 0,
					'post_status'      => 'publish',
					'order'             => 'DESC', // ASC ascended , DESC descend
					'category_name'     => 'articles'
				);
				// query
				$wp_query = new WP_Query($args);
				if ($wp_query->have_posts()) {
					$articles_cont = 0;
					while (have_posts()) {
						the_post();

						$articles_cont++;
						if ($articles_cont == 3) {
				?>
							<!-- CAROUSEL AD -->
							<div class="col-12 mb-5">
								<div id="articlesPageAd" class="carousel slide" data-bs-ride="carousel">
									<div class="carousel-inner">
										<?php
										$carouselArray = $data['carousel_adds'];
										if ($carouselArray) {
											$carousel = "";
											foreach ($carouselArray as $key => $item) {
												$image = $item['image']['url'];
												$link = $item['link'];
												if ($link) {
													$url = esc_url($item['link']['url']);
													$target  = $link['target'] ? $link['target'] : '_self';
													$target = esc_attr($target);
													$active = ($key == 0) ? "active" : "";
													$carousel .= <<<ITEM
													<div class="carousel-item $active">
														<a class="d-flex" href="$url" target="$target">
															<img src="$image" class="d-block mx-auto img-fluid" alt="...">
														</a>
													</div>
													ITEM;
												}
											} //foreach
											echo $carousel;
										} //if
										?>
									</div>
								</div>
							</div>
						<?php
						}
						?>
						<div class="col-12 col-md-6 pe-xl-3 pb-4">
							<div class="card card-height border-0">
								<a href="<?php echo get_the_permalink(); ?>">
									<img src="<?php echo get_the_post_thumbnail_url(); ?>" class="card-img-size" alt="">
								</a>
								<div class="card-body pb-0 ps-0">
									<div class="row">
										<div class="col-12">
											<a href="<?php echo get_the_permalink(); ?>" class="text-decoration-none text-black">
												<p class="card-title">
													<?php the_title(); ?>
												</p>
												<p><?php the_excerpt(); ?></p>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
				<?php
					}
					wp_reset_postdata();
				} else {
					echo "No content was found";
				} ?>
			</div>
		</div>
		<!-- SIDEBAR 1 -->
		<div class="col-4 pt-3 ps-xl-5 mt-4 mt-md-0 d-none d-xl-block">
			<!-- AD 1 -->
			<div class="row pt-xl-3">
				<div class="col-12">
					<a href="<?= $add1_link ?>">
						<img src="<?= $add1 ?>" class="sidebar-ad-img-size" alt="">
					</a>
				</div>
			</div>
			<!-- MOST READ ARTICLES -->
			<div class="row pt-5">
				<div class="col-12 col-md-6 col-lg-12">
					<img src="<?= $most_read ?>" class="mostRead-img-size" alt="">
				</div>
			</div>
			<?php posts_sidebar(); ?>
		</div>
	</div>
	<!-- LONG AD -->
	<?php if($longAdd_link && $longAdd): ?>
	<div class="row mt-4 d-none d-lg-flex">
		<div class="col-12">
			<a href="<?= $longAdd_link ?>">
				<img src="<?= $longAdd ?>" class="img-fluid w-100 rounded long-ad-height" alt="">
			</a>
		</div>
	</div>
	<?php endif; ?>
	<!-- MAIN CONTENT -->
	<div class="row mt-5">
		<!-- UNIVERSITY ARTICLES -->
		<div class="col-12 col-xl-8">
			<?php post_cat_university(); ?>
		</div>
		<!-- SIDEBAR 2-->
		<?php if($tiktokAdd_link && $tiktokAdd): ?>
		<div class="col-12 col-xl-4 ps-xl-5 mt-5 mt-xl-0 d-none d-xl-block">
			<div class="row pb-xl-1">
				<div class="col-12">
					<h3 class="title notoBold">Learn on TikTok</h3>
				</div>
			</div>			
			<div class="row">
				<div class="col-12">
					<a href="<?= $tiktokAdd_link ?>" target="<?= esc_attr($tiktokAdd_target) ?>">
						<img src="<?= $tiktokAdd ?>" class="tiktok-ad-img-size img-fluid" alt="">
					</a>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
</div>


<?php
get_footer();
?>