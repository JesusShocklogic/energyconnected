<?php
function AddingSwiperthings()
{
    wp_enqueue_style('SwiperStyle', 'https://unpkg.com/swiper/swiper-bundle.min.css', array());
    wp_enqueue_script('SwiperJs', "https://unpkg.com/swiper/swiper-bundle.min.js", array(), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'AddingSwiperthings');
