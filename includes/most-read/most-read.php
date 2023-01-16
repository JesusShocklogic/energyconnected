<?php
/*
* This functions requires the plugin https://wordpress.org/plugins/wordpress-popular-posts/ in order to work
*/

function most_read($limit = 5)
{
    $args = array(
        'post_html' => '
            <div class="col-11 col-lg-12 pb-3 mb-3">
                <div class="card border-0">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <a href="{url}">
                                <img src="{thumb_url}" class="card-img" alt="">
                            </a>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="card-body py-0 ps-0">
                                
                                <a href="{url}" class="text-decoration-none text-black">
                                    <h6 class="pb-2 notoSemibold">
                                        {text_title}
                                    </h6>
                                </a>
                                <p class="card-text pt-0 pt-lg-2 pt-xl-4" style="font-size: small;">
                                    {date}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ',
        'post_type' => 'post',
        'range' => 'all',
        'order_by' => 'views',
        'thumbnail_width' => 500,
        'thumbnail_height' => 250,
        'wpp_start' => '<div class="pt-4">',
        'wpp_end' => '</div>',
        'limit' => $limit
    );

    wpp_get_mostpopular($args);
}
