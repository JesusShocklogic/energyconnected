<?php
/*
* Template name: Universities
*/
get_header(); ?>

<?php
	global $wp_query;

	$args = array(
		//'posts_per_page'   => -1, // Negative numbers means ALL. Cero means ALL too, but some errors have been detected.
		'post_type'         => 'university', //it does accept Custom Types
		'offset'			=> 0,
		'post_status'      => 'publish',
		'order'           => 'asc',
	);
	// query
	$wp_query = new WP_Query( $args );
	
	if($wp_query->have_posts()){
?>

<!--UNIVERSITY GRID-->
<div class="p-5">
	<div class="container">
		<div class="row g-5">
			<?php while ($wp_query->have_posts()) {
				$wp_query->the_post();
            	$image = get_the_post_thumbnail_url();
            	$logo = get_field("logo")["url"];
            	$title = get_the_title();
            	$country = get_field("country");
            	$link = get_field('web');
            	if ($link) :
            	    $link_url = esc_url($link['url']);
            	    $link_title = esc_html($link['title']);
            	    $link_target = $link['target'] ? $link['target'] : '_self';
            	    $link_target = esc_attr($link_target);
            	endif;
			?>
				<div class="col-sm col-md-6 col-lg-4">
        	    	<div class="ratio ratio-1x1">
        	    	  <img
        	    	    src="<?= $image ?>"
        	    	    class="img-fluid"
        	    	    style="object-fit: cover"
        	    	  />
        	    	</div>
					<div class="d-flex mt-4">
        	      		<div
        	      		  class="ratio ratio-1x1 border border-dark"
        	      		  style="max-width: 100px; max-height: 100px"
        	      		>
        	      		  <img
							src="<?= $logo ?>"
        	      		    style="object-fit: scale-down"
        	      		  />
						</div>					
						<div class="w-100 ms-3">
        	        		<h3 class="m-0"><strong><?= $title ?></strong></h3>
        	        		<div class="fs-4"><?= $country ?></div>
        	        		<div class="d-flex justify-content-end">
							<a href="<?= $link_url ?>" type="button" class="p-1 view-more-btn">
        	        		    <small><?= $link_title ?></small>
        	        		  </a>
        	        		</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<?php
		wp_reset_query();
	}

	get_footer();
?>
