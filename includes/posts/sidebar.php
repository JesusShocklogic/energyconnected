<?php

function posts_sidebar()
{
    $result = "";
    $args = array(
        'post_type'         => 'post', //it does accept Custom Types
        'posts_per_page'   => 5,
        'offset'            => 0,
        'post_status'      => 'publish',
        'order'             => 'DESC', // ASC ascended , DESC descend
        'category_name'     => 'articles'
    );
    // query
    $wp_query = new WP_Query($args);

    if ($wp_query->have_posts()) {
        $result = <<<RESULT
            <div class="row mt-3 mt-xl-4">
        RESULT;

        while ($wp_query->have_posts()) {
            $wp_query->the_post();

            $image = get_the_post_thumbnail_url();
            $title = get_the_title();
            $permalink = get_the_permalink();
            $date = get_the_date( 'F j, Y');

            $result .= <<<RESULT
            <div class="col-12 col-md-6 col-lg-12 pb-3 mb-3">
                <a href="$permalink" class="d-flex text-black text-decoration-none">
                    <div class="card w-100 border-0">
                        <div class="row">
                            <div class="col-12 col-xl-6">
                                <img src="$image" class="card-img" alt="">
                            </div>
                            <div class="col-12 col-xl-6 mt-1 mt-xl-0">
                                <div class="card-body py-0 px-0">
                                    <h5 class="pb-2 notoSemibold">
                                        $title
                                    </h5>
                                    <p class="card-text pt-0 pt-lg-2 pt-xl-4" style="font-size: small;">
                                        $date
                                    </p>
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
} //posts_sidebar
