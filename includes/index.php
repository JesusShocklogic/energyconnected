<?php
global $wp_query;

//Adding options page in wordpress dashboard
if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Single Post Settings',
		'menu_title'	=> 'Single Post',
		'parent_slug'	=> 'theme-options',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-options',
	));
}

include('timezone/timezone.php');
include("custom_post_types/main.php");
include("google/analitycs.php");
include("facebook/pixel.php");
include("extra/head.php");
include("swiper-js/main.php");
include("menu/index.php");
include("partners/carousel.php");
include("exhibitors/carousel.php");
include("posts/cat-university.php");
include("posts/latest.php");
include("posts/sidebar.php");
include("speakers/carousel.php");
include("most-read/most-read.php");
include("collapse-data/collapse-data.php");