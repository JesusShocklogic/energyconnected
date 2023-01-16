<?php

function university_carousel_wiper_start()
{
    $result = "";
    $result .= <<<RESULT
        <script>
            const swiperUniversity = new Swiper('.university-swiper-container', {
                loop: true,
                autoplay: {
                delay: 4000,
                disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                slidesPerView: 1,
                spaceBetween: 50,
                breakpoints: {
                    1400: {
                        slidesPerView: 3
                    },
                    1200: {
                        slidesPerView: 3
                    },
                    968: {
                        slidesPerView: 2
                    },
                    768: {
                        slidesPerView: 2
                    },
                    576: {
                        slidesPerView: 2
                    }
                }
            });
        </script>
    RESULT;
    echo $result;
}

function universities_carousel($category = null)
{
	$args = array(
		'post_type'         => 'university', //it does accept Custom Types
		'offset'			=> 0,
		'post_status'      => 'publish',
		'orderby'           => 'asc',
		'cat' => "$category",
	);
	// query
	$wp_query = new WP_Query( $args );
	$result = "";
	if($wp_query->have_posts()):
		$result .= <<<RESULT
			<style>
			    .swiper-button-next, .swiper-button-prev {
			        color: var(--swiper-navigation-color,#000);
			    }
			    .swiper-slide {
			        text-align: center;
			        padding: 3vw;
			    }
			
			    .university-swiper-container-pointer-events {
			        touch-action: pan-y;
			    }
			    .university-swiper-container {
			        margin-left: auto;
			        margin-right: auto;
			        position: relative;
			        overflow: hidden;
			        list-style: none;
			        padding: 0;
			        z-index: 1;
			    }
			</style>
			<div class="side-padding mt-5">
				<div class="container-fluid">
			    	<div class="row">
						<div class="col-12 h3 text-black notoBold">
							Universities 
						</div>
						<div class="col-12">
							<!-- Slider main container -->
							<div class="university-swiper-container">
								<!-- Additional required wrapper -->
								<div class="swiper-wrapper">
			RESULT;
								while ($wp_query->have_posts()):
									$wp_query->the_post();
  						          	$image = get_the_post_thumbnail_url();
  						          	$logo = get_field("logo")["url"];
  						          	$title = get_the_title();
  						          	$country = get_field("country");
  						          	$link = get_field('web');
  						          	if ($link) :
  						          	    $link_url = esc_url($link['url']);
  						          	    $link_title = esc_html($link['title']);
  						          	    $link_target = $link['target'] ? $link['target'] : '_self';
  						          	    $link_target = esc_attr($link_target);
  						          	endif;
									$result .= <<<RESULT
										<div class="swiper-slide align-self-center px-0">
											<div class="ratio ratio-1x1">
												<img src="$image" class="img-fluid" style="object-fit: cover">
											</div>
											<div class="d-flex mt-4"> 
												<div
													class="ratio ratio-1x1 border border-dark"
													style="max-width: 100px; max-height: 100px"
												>
													<img
														src="$logo"
														style="object-fit: scale-down"
													/>
												</div>
												<div class="w-100 ms-3">
													<h3 class="m-0 text-start"><strong>$title</strong></h3>
													<div class="fs-4 text-start"> $country</div>
													<div class="text-end">
														<a href="$link_url" type="button" target="$link_target" class="p-1 view-more-btn">
															<small>$link_title</small>
														</a>
													</div>
												</div>
											</div>
										</div>
									RESULT;
								endwhile;
		$result .= <<<RESULT
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		RESULT;
	endif;
	wp_reset_query();
	echo $result;
	//After printing the carousel, we initialize it after the wp_footer is executed, using this hook and adding priority 100
	add_action('wp_footer', 'university_carousel_wiper_start', 100);
}
