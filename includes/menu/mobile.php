<?php

function main_menu_mobile($menu)
{
	global $wp;
	//getting the Current URL for the active class
	$current_url = home_url(add_query_arg(array(), $wp->request)) . '/';


	if (($locations = get_nav_menu_locations()) && isset($locations[$menu])) {
		$menu = wp_get_nav_menu_object($locations[$menu]);
		$menu_items = wp_get_nav_menu_items($menu->term_id);

		$cont = 0;
		$menu_list = "";
		$registration = get_field('registration_menu', get_the_ID());

		foreach ($menu_items as $menu_item) {
			if ($menu_item->menu_item_parent == 0) {
				$parent = $menu_item->ID;
				$menu_array = array();

				foreach ($menu_items as $submenu) {
					if ($submenu->menu_item_parent == $parent) {

					$url = $registration['check'] && strtolower($submenu->title) === strtolower($registration['link']['title']) ? $registration['link']['url'] : $submenu->url;
						if (strcmp($current_url, $submenu->url) == 0) {
							$menu_array[] = '<li><a class="dropdown-item py-2 active" target="' . $submenu->target . '" href="' . $submenu->url . '">' . $submenu->title . '</a></li>' . "\n";
						} else {
							$menu_array[] = '<li><a class="dropdown-item py-2" target="' . $submenu->target . '" href="' . $submenu->url . '">' . $submenu->title . '</a></li>' . "\n";
						}
					}
				}

				if (count($menu_array) > 0) {
					$cont = $cont + 1;
					$url = $registration['check'] && strtolower($menu_item->title) === strtolower($registration['link']['title']) ? $registration['link']['url'] : $menu_item->url;

					$menu_list .= '<li class="pe-3 nav-item h5 dropdown nav-item-li-' . $cont . '">' . "\n";
					$menu_list .= '<a class="nav-link dropdown-toggle nav-item-num-' . $cont . '"" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">' . $menu_item->title . ' </a>' . "\n";
					$menu_list .= '<ul class="dropdown-menu p-0">' . "\n";
					$menu_list .= implode("\n", $menu_array);
					$menu_list .= '</ul>' . "\n";
				} else {
					$url = $registration['check'] && strtolower($menu_item->title) === strtolower($registration['link']['title']) ? $registration['link']['url'] : $menu_item->url;
					$cont = $cont + 1;
					$menu_list .= '<li class="pe-3 nav-item h5 nav-item-li-' . $cont . '">' . "\n";
					if (strcmp($current_url, $menu_item->url) == 0) {
						$menu_list .= '<a class="' . implode(" ", $menu_item->classes) . ' nav-link active nav-item-num-' . $cont . '"
                            target="' . $menu_item->target . '"
                            href="' . $url . '">
                            ' . $menu_item->title . '</a>' . "\n";
					} else {
						$menu_list .= '<a class="' . implode(" ", $menu_item->classes) . ' nav-link nav-item-num-' . $cont . '"
                            target="' . $menu_item->target . '"
                            href="' . $url . '">
                            ' . $menu_item->title . '</a>' . "\n";
					}
				}
			} // end <li>
			$menu_list .= '</li>' . "\n";
		}
	} else {
		// $menu_list = '<!-- no list defined -->';
	}
	echo $menu_list;
}
