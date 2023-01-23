<?php

include("includes/index.php");


// Remove the Wordpress Version Generator meta tag
remove_action('wp_head', 'wp_generator');

// Removing the admin bar
add_filter('show_admin_bar', '__return_false');

// Adding Feature Image
add_theme_support('post-thumbnails');

/**
 * Disable the emoji's
 */
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
    add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'disable_emojis');

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
    if ('dns-prefetch' == $relation_type) {
        /** This filter is documented in wp-includes/formatting.php */
        $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');

        $urls = array_diff($urls, array($emoji_svg_url));
    }

    return $urls;
}

/*
* Adding styles and scripts
*/
function AddingStylesAndScripts()
{
    wp_enqueue_style('the-student-festival-style', get_template_directory_uri() . '/style.css', array(), true);
    //wp_enqueue_style('bootstrap-5-0-2-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array());
    wp_enqueue_style('bootstrap-5-0-2-style', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css', array(),true);

    wp_enqueue_script('jQuery-3-6-0', "https://code.jquery.com/jquery-3.6.0.min.js", array(), wp_get_theme()->get('Version'), true);
    //wp_enqueue_script('bootstrap-5-0-2-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array(), wp_get_theme()->get('Version'), true);
    wp_enqueue_script('bootstrap-5-0-2-script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array(), true);
}
add_action('wp_enqueue_scripts', 'AddingStylesAndScripts');

/*
 * Register my Menu
 */
function register_my_menus()
{
    register_nav_menus(
        array(
            'main-menu' => __('Main Menu'),
            'top-menu' => __('Top Menu'),
			'mobile-menu' => __('Mobile Menu')
        )
    );
}
add_action('init', 'register_my_menus');

/*
 * Delete the space between the Gutenberg editor and the bottom
 */
function my_custom_bottom_editor()
{
    echo '
	<style>
	    .block-editor-writing-flow__click-redirect{
	      display: none;
	    } 
	</style>';
}
add_action('admin_head', 'my_custom_bottom_editor');

/*
 * Fav Icons
 */
function favIconsCode()
{
    $themeFavIcon = get_field('theme_settings', 'option')['fav_icon']['url'];
    $fav_icon = !empty($themeFavIcon) ? $themeFavIcon : "";
    $favIconsCode = <<<CODE
    <!-- Fav Icons -->
    <link rel="apple-touch-icon" type="image/png" href="$fav_icon">
    <link rel="shortcut icon" type="image/png" href="$fav_icon">
    <link rel="icon" type="image/png" href="$fav_icon">
CODE;
    echo $favIconsCode;
} //favIconsCode
add_action('wp_head', 'favIconsCode');