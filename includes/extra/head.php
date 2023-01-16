<?php
/*
 * Adding Google Analytics to the header
 */
function extraCodeHead()
{
    if ((get_field('theme_settings', 'option')['extra_code_in_the_head_select']) == 'enabled') {
        $extraCodeHead = get_field('theme_settings', 'option')['extra_code_in_the_head'];
        echo $extraCodeHead;
    }
} //favIconsCode
add_action('wp_head', 'extraCodeHead');
