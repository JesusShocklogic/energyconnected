<?php
/*
* Template name: About Us
*/
get_header(); 

if (have_posts()):
	while (have_posts()):
		the_post();
?>
		<style>
			.opacity-100{
				opacity: 1!important;
			}
		</style>
		<div class="side-padding">
			<div class="container-fluid">
				<div class="fs-6 text-black">
					<?= get_the_content() ?>
				</div>
			</div>
		</div>
		<?php
			$collapsible_data = get_field('allow_collapse_data');
			if ($collapsible_data):
				echo apply_collapse_data_to($collapsible_data); 
			endif;
		?>
		<?php
		if( have_rows('cards') ):
		?>
			<div class="side-padding">
				<div class="container-fluid">
				<h3 class="text-black fw-bolder py-4"><?= get_field('cards_title') ?></h3>
					<div class="row g-5 pb-4">
						<?php 
							while( have_rows('cards') ):
								the_row();

						?>
							<div class="col-sm col-md-4 col-lg-4">
								<div class="ratio ratio-16x9">
								<?php 
									$link = get_sub_field('link');
									$link_url = $link ? $link['url'] : "";
									$link_target = $link && $link['target'] ? $link['target'] : '_self';
									$disable= !$link? "btn disabled" : "";
								?>
								<a class="<?= $disable ?> opacity-100 p-0" href="<?= $link_url ?>" target="<?= esc_attr( $link_target ) ?>">
		    	    				<img
		    	    				src="<?= get_sub_field("image")["url"] ?>"
		    	    				class="img-fluid"
		    	    				style="object-fit: scale-down"
		    	    				/>
								</a>
								</div>
							</div>
						<?php
							endwhile;
						?>
					</div>
				</div>
			</div>
		<?php
		endif;
		?>

		<?php
		partners_carousel();
		?>

<?php
	endwhile;
endif;
?>

<?php
get_footer();
?>
