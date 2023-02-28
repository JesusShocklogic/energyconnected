<?php
get_header();
$single_post_settings = get_field('single_post_settings', 'option');

if (have_posts()) { ?>
	<style>
		.article-top-image {
			object-fit: contain !important;
		}

		.article-title {
			color: #004259;
		}
	</style>
	<?php
	while (have_posts()) {
		the_post(); ?>
		<div class="container-fluid pb-5 ">
			<div class="row side-padding">
				<!-- MAIN CONTENT -->
				<div class="col-12 col-lg-12 pe-lg-5">
					<!-- ARTICLE -->
					<div class="row justify-content-center">
						<div class="col-11 col-lg-12">
							<div class="card border-0">
								<!-- ARTICLE IMAGE -->
								<?php
								if (get_the_post_thumbnail_url()) { ?>
									<img src="<?php echo get_the_post_thumbnail_url(); ?>" class="article-top-image card-img-top" alt="">
								<?php
								}
								?>
								<div class="card-body px-0 pb-0">
									<div class="row">
										<!-- TITLE -->
										<div class="col-12 col-lg-9">
											<h2 class="mb-0 article-title">
												<?php the_title(); ?>
											</h2>
										</div>
										<!-- DATE -->
										<div class="col-12 col-xl-3 mt-1 mt-xl-2 me-3 me-lg-0">
											<div class="d-flex justify-content-end">
												<svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="#000000" class="bi bi-clock mt-1 me-1" viewBox="0 0 16 16">
													<path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
													<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
												</svg>
												<p class="text-small mb-0">
													<?php echo get_the_date(); ?>
												</p>
											</div>
										</div>
									</div>
									<!-- CONTENT -->
									<div class="row mt-5 mb-3">
										<div class="col-12">
											<div class="sub-text">
												<?php the_content(); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<?php
						$image_url = isset($single_post_settings['add_1']['url']) ? $single_post_settings['add_1']['url'] : null;
						?>
						<div class="col-12 <?= ($image_url) ? "col-lg-8" : "";  ?> ">
							<!-- Latest ARTICLES -->
							<?php posts_latest() ?>
						</div>

						<div class="col-12 <?= ($image_url) ? "col-lg-4" : "d-none";  ?>" style="padding-top: 6rem;">
							<div class="row justify-content-center mb-2">
								<div class="col-11 col-lg-12">
									<?php
									$link = $single_post_settings['link_1'];

									if ($link) {
										$item = <<<ITEM
												<a href="$link" >
													<img src="$image_url" class="img-fluid topAd-img-size" alt="">
												</a>
											ITEM;
									} else {
										$item = <<<ITEM
												<img src="$image_url" class="img-fluid topAd-img-size" alt="">
											ITEM;
									}
									echo $item;
									?>
								</div>
							</div>
						</div>
					</div>

					<!-- TOP AD IMAGE -->
				</div>
				<!-- SIDEBAR -->
				<div class="d-none col-12 col-lg-4 mt-3 mt-md-5 mt-lg-0">
					<!-- MOST READ ARTICLES -->
					<div class="row justify-content-center mt-5">
						<div class="col-11 col-xl-12">
							<h2 class="mb-0">Most Read</h2>
						</div>
					</div>
					<!-- ARTICLES -->
					<div class="row justify-content-center mt-4 mb-4">
						<div class="col-12">
							<?php most_read(4); ?>
						</div>
					</div>
					<!-- ADS -->
					<div class="row justify-content-center mt-5">
						<div class="col-11 col-lg-12">
							<?php
							$image_url = isset($single_post_settings['add_2']['url']) ? $single_post_settings['add_2']['url'] : null;;
							$link = $single_post_settings['link_2'];
							if ($image_url) {
								if ($link) {
									$link_url = esc_url($link['url']);
									$link_title = esc_html($link['title']);
									$link_target = $link['target'] ? $link['target'] : '_self';
									$link_target = esc_attr($link_target);
									$item = <<<ITEM
										<a href="$link_url" target="$link_target">
											<img src="$image_url" class="ad-img-size" alt="">
										</a>
									ITEM;
								} else {
									$item = <<<ITEM
										<img src="$image_url" class="ad-img-size" alt="">
									ITEM;
								}
								echo $item;
							} // if image URL
							?>

						</div>
					</div>
					<div class="row justify-content-center mt-5">
						<div class="col-11 col-lg-12">
							<?php
							$image_url = isset($single_post_settings['add_3']['url']) ? $single_post_settings['add_3']['url'] : null;
							$link = $single_post_settings['link_3'];
							if ($image_url) {
								if ($link) {
									$link_url = esc_url($link['url']);
									$link_title = esc_html($link['title']);
									$link_target = $link['target'] ? $link['target'] : '_self';
									$link_target = esc_attr($link_target);
									$item = <<<ITEM
										<a href="$link_url" target="$link_target">
											<img src="$image_url" class="ad-img-size" alt="">
										</a>
									ITEM;
								} else {
									$item = <<<ITEM
										<img src="$image_url" class="ad-img-size" alt="">
									ITEM;
								}
								echo $item;
							} //if image url
							?>
						</div>
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
