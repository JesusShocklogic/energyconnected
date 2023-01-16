<?php
/*
 * Adding Facebook Pixel to the header
 */
function facebookPixel()
{
    if ((get_field('theme_settings', 'option')['facebook_pixel_select']) == 'enabled') {
        $facebookPixel = get_field('theme_settings', 'option')['facebook_pixel_code'];
        echo $facebookPixel;
    }
} //favIconsCode
add_action('wp_head', 'facebookPixel');
