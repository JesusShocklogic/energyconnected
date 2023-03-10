<?php

function exhibitor_carousel_wiper_start()
{
	$result = "";
	$result .= <<<RESULT
        <script>
            const swiperexhibitor = new Swiper('.exhibitor-swiper-container', {
                loop: false,
                autoplay: {
                delay: 2500,
                disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                slidesPerView: 2,
                spaceBetween: 0,
                breakpoints: {
                    1400: {
                        slidesPerView: 5
                    },
                    1200: {
                        slidesPerView: 4
                    },
                    992: {
                        slidesPerView: 3
                    }
                }
            });
        </script>
    RESULT;
	echo $result;
}

function exhibitors_carousel()
{
	$result = "";
	$result .= <<<RESULT
    <style>
        .swiper-button-next, .swiper-button-prev {
            color: var(--swiper-navigation-color,#000);
        }
        .swiper-slide {
            text-align: center;
            padding: 3vw;
        }
        
        .exhibitor-swiper-container-pointer-events {
            touch-action: pan-y;
        }
        .exhibitor-swiper-container {
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
                    Exhibitors
                </div>
                <div class="col-12">
                    <!-- Slider main container -->
                    <div class="exhibitor-swiper-container">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
    RESULT;

	$args = array(
		'post_type'         => 'exhibitor', //it does accept Custom Types
		'offset'            => 0,
		'post_status'      => 'publish',
		'order'             => 'DESC',
		'orderby'           => 'date',
	);
	// query
	$wp_query = new WP_Query($args);

	if ($wp_query->have_posts()) {
		while ($wp_query->have_posts()) {
			$wp_query->the_post();
			$image = get_the_post_thumbnail_url();
			//$link = get_the_permalink();
			$link = get_field('link');
			if ($link) {
				$link_url = esc_url($link['url']);
				$link_title = esc_html($link['title']);
				$link_target = $link['target'] ? $link['target'] : '_self';
				$link_target = esc_attr($link_target);

				$result .= <<<RESULT
				<div class="swiper-slide align-self-center">
					<a href="$link_url" target="$link_target">
						<img class=" mx-auto w-100 img-fluid" src="$image">
					</a> 
				</div>
RESULT;
			} else {
				$result .= <<<RESULT
				<div class="swiper-slide align-self-center">
					<img class=" mx-auto w-100 img-fluid" src="$image">
				</div>
RESULT;
			}
		};
		wp_reset_query();
	}
	$result .= <<<RESULT
                        </div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
RESULT;
	echo $result;
	//After printing the carousel, we initialize it after the wp_footer is executed, using this hook and adding priority 100
	add_action('wp_footer', 'exhibitor_carousel_wiper_start', 100);
}
