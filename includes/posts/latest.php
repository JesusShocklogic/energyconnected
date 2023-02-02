<?php

function posts_latest($amount = 4)
{
?>
    <style>
        .card-title {
            color: #004259;
        }
    </style>
<?php
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
        $latest_post_label = get_field('theme_settings', 'option')['latest_post_label'] ?? "";
        $result = <<<RESULT
            <div class="row pb-1">
                <div class="col-12">
                    $latest_post_label
                </div>
        RESULT;

        while ($wp_query->have_posts()) {
            $wp_query->the_post();

            $title = get_the_title();
            $excerpt = get_the_excerpt();
            $permalink = get_the_permalink();

            $image = get_the_post_thumbnail_url() ?? '';

            if ($image) {
                $image_string = <<<ITEM
                <div class="pb-4">
                    <img src="$image" class="card-img-size" alt="">
                </div>
                ITEM;
            } else {
                $image_string = "";
            }

            $result .= <<<RESULT
                <div class="col-12 col-md-6 col-xl-3 pe-xl-3 pb-4 mb-4">
                    <a class="d-flex text-black text-decoration-none" href="$permalink">
                        <div class="card card-height w-100 border-0">
                            $image_string
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
