<?php

function top_menu_desktop($menu_name)
{
    global $wp;
    //getting the Current URL for the active class
    $current_url = home_url(add_query_arg(array(), $wp->request)) . '/';

    if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {

        $menu = wp_get_nav_menu_object($locations[$menu_name]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $result = "";
        foreach ($menu_items as $key => $menu_item) {

            $title = $menu_item->title;
            $registration = get_field('registration_menu', get_the_ID());
            $link = !empty($registration['check']) && $title == $registration['link']['title'] ? $registration['link']['url'] : $menu_item->url;
            $target = $menu_item->target;
            $icon = get_field('icon', $menu_item->ID) ? get_field('icon', $menu_item->ID)['url'] : "";
			
			//Show info on modal
			$show_on_modal_active = get_field('show_on_modal', $menu_item->ID);
			$url = $show_on_modal_active? "#" : $link;
			$show_modal_options = $show_on_modal_active? "data-bs-toggle=\"modal\" data-bs-target=\"#topMenuModal\" data-topmenu-set-iframe=\"topMenuModalIframeContainer\" data-topmenu-iframe=\"$link\"" : "";

            $result .= <<<RESULT
                <li class="nav-item">
RESULT;

            if (!empty($icon)) {
                $result .= <<<RESULT
                    <a href="$url" target="$target">
                        <img src="$icon" class="social-icons me-5 d-none d-lg-flex" alt="" />
                    </a>
                </li>
                RESULT;
            } else {
                $result .= <<<RESULT
                    <a href="$url" target="$target" $show_modal_options class="btn bg-green border-none box-shadow-none py-1 mt-4 mt-lg-0 rounded-pill px-4">
                        <b>$title</b>
                    </a>
                </li>
RESULT;
            }
        } //foreach
    } // if menu exist
    echo $result;
} //top_menu_desktop

function floating_icons_menu_desktop($menu_name){

    global $wp;
    //getting the Current URL for the active class
    $current_url = home_url(add_query_arg(array(), $wp->request)) . '/';

	if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])):

        $menu = wp_get_nav_menu_object($locations[$menu_name]);
    	$menu_items = wp_get_nav_menu_items($menu->term_id);

		$icons = array_filter($menu_items, function($menu_item){
			return get_field('icon', $menu_item->ID);
		});

		$icon_html = function($image,$url,$target){
			return <<<RESULT
				<div class="py-1">
					<a href="$url" target="$target">
						<img src="$image" class="social-icons py-1" alt="" />
					</a>
				</div>
			RESULT;
		};

		$result = <<<RESULT
			<div class="floating-icons-container m-4 d-none d-lg-block">
		RESULT;

		foreach($icons as $icon):
			$image = get_field('icon', $icon->ID)['url'];
			$url = $icon->url;
			$target = $icon->target;
			$result .= $icon_html($image,$url,$target);
		endforeach;

		$result .= <<<RESULT
			</div>
			<script>
				(function() {
					let shown = false

					document.addEventListener('DOMContentLoaded', () => {
						const measureScroll = () => {
							const header = document.querySelector('header nav.navbar'),
								rawHeight = getComputedStyle(header).height.replace('px', ''),
								height = parseFloat(rawHeight)

							if (window.pageYOffset > height) {
								container.classList.add('shown')
								shown = true
							} else {
								container.classList.remove('shown')
								shown = false
							}
						}, container = document.querySelector(".floating-icons-container")

						measureScroll()
						window.onscroll = function() {
							measureScroll()
						}
					})
				})()
			</script>
		RESULT;

	endif;

	return $result;

}

function main_menu_desktop($menu)
{
	global $wp;
	//getting the Current URL for the active class
	$current_url = home_url(add_query_arg(array(), $wp->request)) . '/';


	if (($locations = get_nav_menu_locations()) && isset($locations[$menu])) {
		$menu = wp_get_nav_menu_object($locations[$menu]);
		$menu_items = wp_get_nav_menu_items($menu->term_id);

		$cont = 0;
		$menu_list = "";

		foreach ($menu_items as $menu_item) {
			if ($menu_item->menu_item_parent == 0) {
				$parent = $menu_item->ID;
				$menu_array = array();

				foreach ($menu_items as $submenu) {
					if ($submenu->menu_item_parent == $parent) {

						if (strcmp($current_url, $submenu->url) == 0) {
							$menu_array[] = '<li><a class="dropdown-item active" target="' . $submenu->target . '" href="' . $submenu->url . '">' . $submenu->title . '</a></li>' . "\n";
						} else {
							$menu_array[] = '<li><a class="dropdown-item" target="' . $submenu->target . '" href="' . $submenu->url . '">' . $submenu->title . '</a></li>' . "\n";
						}
					}
				}

				if (count($menu_array) > 0) {
					$cont = $cont + 1;

					$menu_list .= '<li class="pe-3 nav-item h5 dropdown nav-item-li-' . $cont . '">' . "\n";
					$menu_list .= '<a class="nav-link dropdown-toggle nav-item-num-' . $cont . '"" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">' . $menu_item->title . ' </a>' . "\n";
					$menu_list .= '<ul class="dropdown-menu p-0">' . "\n";
					$menu_list .= implode("\n", $menu_array);
					$menu_list .= '</ul>' . "\n";
				} else {
					$cont = $cont + 1;
					$menu_list .= '<li class="pe-3 nav-item h5 nav-item-li-' . $cont . '">' . "\n";
					if (strcmp($current_url, $menu_item->url) == 0) {
						$menu_list .= '<a class="' . implode(" ", $menu_item->classes) . ' nav-link active nav-item-num-' . $cont . '"
                            target="' . $menu_item->target . '"
                            href="' . $menu_item->url . '">
                            ' . $menu_item->title . '</a>' . "\n";
					} else {
						$menu_list .= '<a class="' . implode(" ", $menu_item->classes) . ' nav-link nav-item-num-' . $cont . '"
                            target="' . $menu_item->target . '"
                            href="' . $menu_item->url . '">
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

/*
* Custom menu code - Level 3
*/
function custom_menu_level_3($location)
{
    $menuLocations = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object($menuLocations[$location]);
    $menu_items = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));

    $menuContent = "";
    $menuContent .= <<<ITEM
        <ul class="navbar-nav">
    ITEM;

    if ($menu_items) {

        $current_position = 0;
        $max_items = count($menu_items);
        do {
            $title = $menu_items[$current_position]->title;

            //if there are no more items
            if (!isset($menu_items[$current_position + 1])) {
                $link = $menu_items[$current_position]->url;
                $menuContent .= <<<ITEM
                        <li class="nav-item"><a class="nav-link" href="$link">$title</a></li>
                    ITEM;
                break;
            }
            //if there are more items
            //if current item is not a father
            if ($menu_items[$current_position]->ID != $menu_items[$current_position + 1]->menu_item_parent) {
                $link = $menu_items[$current_position]->url;
                $menuContent .= <<<ITEM
                    <li class="nav-item"><a class="nav-link" href="$link">$title</a></li>
                ITEM;
            }
            //if current item is a father - 2nd level
            else {
                $current_parent_1 = $menu_items[$current_position]->ID;
                $menuContent .= <<<ITEM
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">$title</a>
                            <ul class="dropdown-menu">
                ITEM;

                //getting childs level 2
                do {
                    $current_position++;
                    $title = $menu_items[$current_position]->title;

                    //if there are no more next items
                    if (!isset($menu_items[$current_position + 1])) {
                        $link = $menu_items[$current_position]->url;
                        $menuContent .= <<<ITEM
                            <li><a class="dropdown-item" href="$link">$title</a></li>
                        ITEM;
                        break;
                    }

                    //if the current item is not the father of the next
                    if ($menu_items[$current_position]->ID != $menu_items[$current_position + 1]->menu_item_parent) {
                        $link = $menu_items[$current_position]->url;
                        $menuContent .= <<<ITEM
                            <li><a class="dropdown-item" href="$link">$title</a></li>
                        ITEM;
                    }
                    // If the current element is the father of the next - 3rd level
                    else {
                        $current_parent_2 = $menu_items[$current_position]->ID;
                        $menuContent .= <<<ITEM
                            <li><a class="dropdown-item" href="#">$title &raquo; </a>
                                <ul class="submenu dropdown-menu">
                        ITEM;

                        // Getting childs Level 3
                        do {
                            $current_position++;

                            $title = $menu_items[$current_position]->title;

                            //if there are no more next items
                            if (!isset($menu_items[$current_position + 1])) {
                                $link = $menu_items[$current_position]->url;
                                $menuContent .= <<<ITEM
                                            <li><a class="dropdown-item" href="$link">$title</a></li>
                                        ITEM;

                                break;
                            }

                            //if the current item is not the father of the next
                            if ($menu_items[$current_position]->ID != $menu_items[$current_position + 1]->menu_item_parent) {
                                $link = $menu_items[$current_position]->url;
                                $menuContent .= <<<ITEM
                                            <li><a class="dropdown-item" href="$link">$title</a></li>
                                        ITEM;
                            } else {
                                /*
                                * JC 2021/11/03 - If we need a fourth level, the code would be here
                                * TIP: basically, we need to re-use the code from the last while(true).
                                * If you are able to make it recursive, GREAT, but please keep in mind that
                                * The second level uses only "dropdown" class, and from the third level and below,
                                * they use the "submenu dropdown" classes. This will allow you to make them recursive.
                                */

                                break;
                            }
                        } while (isset($menu_items[$current_position + 1]) && $current_parent_2 == $menu_items[$current_position + 1]->menu_item_parent); //while level 3
                        // if the father is still the same

                        $menuContent .= <<<ITEM
                                        </ul>
                                    </li>
                                ITEM;
                    } //else
                    //continue while the next element is also a child
                } while (isset($menu_items[$current_position + 1]) && $current_parent_1 == $menu_items[$current_position + 1]->menu_item_parent);

                $menuContent .= <<<ITEM
                                    </ul>
                                </a>
                            </li>
                        ITEM;
            }
            $current_position++;
        } while ($current_position < $max_items); //do while
    } //if there is a menu to show

    $menuContent .= <<<ITEM
        </ul>
    ITEM;

    echo $menuContent;
} //Custom_menu_level_3