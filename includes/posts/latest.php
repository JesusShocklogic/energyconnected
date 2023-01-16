<?php

function posts_latest($amount = 3)
{
    $result = "";
    $args = array(
        'post_type'         => 'post', //it does accept Custom Types
        'posts_per_page'   => $amount,
        'offset'            => 0,
        'post_status'      => 'publish',
        'order'             => 'DESC', // ASC ascended , DESC descend
    );
    // query
    $wp_query = new WP_Query($args);

    if ($wp_query->have_posts()) {
        $result = <<<RESULT
            <div class="row pb-1">
                <div class="col-12">
                    <h3 class="notoBold pb-3">Latest articles</h3>
                </div>
        RESULT;

        while ($wp_query->have_posts()) {
            $wp_query->the_post();

            $image = get_the_post_thumbnail_url();
            $title = get_the_title();
            $excerpt = get_the_excerpt();
            $permalink = get_the_permalink();

            $result .= <<<RESULT
                <div class="col-12 col-md-4 pe-xl-3 pb-4 mb-4">
                    <a class="d-flex text-black text-decoration-none" href="$permalink">
                        <div class="card card-height w-100 border-0">
                            <div class="pb-4">
                                <img src="$image" class="card-img-size" alt="">
                            </div>
                            <div class="pb-0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card-title">
                                            $title
                                        </div>
                                        <div>
                                            $excerpt
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            RESULT; 
        };
        $result .= <<<RESULT
            </div>
        RESULT;
        wp_reset_query();
    }
    echo $result;
} //posts_latest