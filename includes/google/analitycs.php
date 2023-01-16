<?php
/*
 * Adding Google Analytics to the header
 */
function googleAnalitycs()
{
    if ((get_field('theme_settings', 'option')['google_analitycs_select']) == 'enabled') {
        $googleAnalitycs = get_field('theme_settings', 'option')['google_analytics_code'];
        echo $googleAnalitycs;
    }
} //favIconsCode
add_action('wp_head', 'googleAnalitycs');
