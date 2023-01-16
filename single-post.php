<?php
/*
* Template name: Single post
*/
get_header();
$single_post_settings = get_field('single_post_settings', 'option');

if (have_posts()) {
	while (have_posts()) {
		the_post(); ?>
		<div class="container-fluid pb-5 ">
			<div class="row side-padding">
				<!-- MAIN CONTENT -->
				<div class="col-12 col-lg-8 pe-lg-5">
					<!-- ARTICLE -->
					<div class="row justify-content-center">
						<div class="col-11 col-lg-12">
							<div class="card border-0">
								<!-- ARTICLE IMAGE -->
								<img src="<?php echo get_the_post_thumbnail_url(); ?>" class="article-top-image card-img-top" alt="">
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
									<div class="row mt-5">
										<div class="col-12">
											<div class="sub-text">
												<?php the_content(); ?>
											</div>
										</div>
									</div>
									<!-- READ MORE BUTTON -->
									<div class="row mt-3 d-none">
										<div class="col-5 col-sm-3 col-xl-2 me-3 me-lg-0 pe-0">
											<div class="d-grid">
												<?php
												$link = get_field('read_more_link');
												if ($link) :
													$link_url = $link['url'];
													$link_title = $link['title'];
													$link_target = $link['target'] ? $link['target'] : '_self';
												?>
													<a class="btn btn-sm bgcolor-black text-white latoBold" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
												<?php endif; ?>
											</div>
										</div>
									</div>
									<!-- SOCIAL MEDIA BUTTONS -->
									<div class="row mt-4 d-none">
										<!-- FACEBOOK -->
										<div class="col-8 col-md-4 col-xl-3">
											<a href="<?php echo get_field("facebook_link")["url"]; ?>" class="text-decoration-none">
												<div class="row">
													<div class="col-4 pe-0 text-center">
														<div class="py-2" style="background-color: #2f477a;">
															<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook text-white " viewBox="0 0 16 16">
																<path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
															</svg>
														</div>
													</div>
													<div class="col-7" style="background-color: #3b5998;">
														<p class="text-white m-0 mt-2 notoBold">FACEBOOK</p>
													</div>
												</div>
											</a>
										</div>
										<!-- TWITTER -->
										<div class="col-8 col-md-4 col-xl-3 mt-3 mt-xl-0">
											<a href="<?php echo get_field("twitter_link")["url"]; ?>" class="text-decoration-none">
												<div class="row">
													<div class="col-4 pe-0 text-center">
														<div class="py-2" style="background-color: #008abe;">
															<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-twitter text-white" viewBox="0 0 16 16">
																<path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
															</svg>
														</div>
													</div>
													<div class="col-7" style="background-color: #00aced;">
														<p class="text-white m-0 mt-2 notoBold">TWITTER</p>
													</div>
												</div>
											</a>
										</div>
										<!-- WHATSAPP -->
										<div class="col-8 col-md-4  col-xl-3 mt-3 mt-xl-0">
											<a href="<?php echo get_field("whatsapp_link")["url"]; ?>" class="text-decoration-none">
												<div class="row">
													<div class="col-4 pe-0 text-center">
														<div class="py-2" style="background-color: #3ba147;">
															<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-whatsapp text-white" viewBox="0 0 16 16">
																<path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
															</svg>
														</div>
													</div>
													<div class="col-7" style="background-color: #4ac959;">
														<p class="text-white m-0 mt-2 notoBold">WHATSAPP</p>
													</div>
												</div>
											</a>
										</div>
										<!-- EMAIL -->
										<div class="col-8 col-md-4 col-xl-3 mt-3 mt-xl-0">
											<a href="<?php echo get_field("email_link")["url"]; ?>" class="text-decoration-none">
												<div class="row">
													<div class="col-4 pe-0 text-center">
														<div class="py-2" style="background-color: #292929;">
															<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-envelope text-white" viewBox="0 0 16 16">
																<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z" />
															</svg>
														</div>
													</div>
													<div class="col-7" style="background-color: #333333;">
														<p class="text-white m-0 mt-2 notoBold">E-MAIL</p>
													</div>
												</div>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- CAROUSEL AD -->
					<?php
					$carouselArray = $single_post_settings['carousel'];
					if ($carouselArray) {
						$carousel = "";
						$carousel .= <<<ITEM
						<div class="row justify-content-center mt-5">
							<div class="col-11 col-xl-12">
								<div id="articlesPageAd" class="carousel slide" data-bs-ride="carousel">
									<div class="carousel-inner">
						ITEM;
						foreach ($carouselArray as $key => $item) {
							$image = $item['image']['url'];
							$link_url = esc_url($item['link']['url']);
							$link_target = $item['link']['target'] ? $item['link']['target'] : '_self';
							$link_target = esc_attr($link_target);
							$active = ($key == 0) ? 'active' : '';
							$carousel .= <<<ITEM
										<div class="carousel-item $active">
											<a href="$link_url" target="$link_target">
												<img src="$image" class="d-block w-100 carousel-height" alt="...">
											</a>
										</div>
							ITEM;
						}
						$carousel .= <<<ITEM
									</div>
								</div>
							</div>
						</div>
						ITEM;

						echo $carousel;
					}
					?>
					<!-- Latest ARTICLES -->
					<?php posts_latest(4) ?>
				</div>
				<!-- SIDEBAR -->
				<div class="col-12 col-lg-4 mt-3 mt-md-5 mt-lg-0">
					<!-- TOP AD IMAGE -->
					<div class="row justify-content-center mb-2">
						<div class="col-11 col-lg-12">
							<?php
							$image_url = $single_post_settings['add_1']['url'];
							$link = $single_post_settings['link_1'];
							if ($link) {
								
								$link_url = esc_url($link['url']);
								$link_title = esc_html($link['title']);
								$link_target = $link['target'] ? $link['target'] : '_self';
								$link_target = esc_attr($link_target);
								$item = <<<ITEM
									<a href="$link_url" target="$link_target">
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
					<!-- MOST READ ARTICLES -->
					<div class="row justify-content-center mt-5">
						<div class="col-11 col-xl-12">
							<img src="<?= get_field('theme_settings', 'options')["most_read_image"]["url"]; ?>" class="mostRead-img-size" alt="">
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
							$image_url = $single_post_settings['add_2']['url'];
							$link = $single_post_settings['link_2'];
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
							?>

						</div>
					</div>
					<div class="row justify-content-center mt-5">
						<div class="col-11 col-lg-12">
							<?php
							$image_url = $single_post_settings['add_3']['url'];
							$link = $single_post_settings['link_3'];
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
