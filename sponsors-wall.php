<?php
/*
* Template name: Sponsors Wall
*/
get_header(); 

$data = get_field("data");
$dir = get_template_directory_uri();

if (have_posts()):
	while (have_posts()):
		the_post();
?>

		<style>
			.opacity-100{
				opacity: 1!important;
			}
			.text-orange{
				color: #e84c22!important;
			}
			.center {
			  display: flex;
			  justify-content: center;
			  align-items: center;
			}
			.text-gold {
				color: #ffd700;
			}
			.text-silver {
				color: #c0c0c0;
			}
			.text-bronze {
				color: #cd7f32;
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
		if( $data["gold_sponsors_cards"] ):
		?>
			<div class="side-padding">
				<div class="container-fluid pb-3">
					<div class="row pb-2">
						<div class="col text-center text-gold">
							<h3>
								<?= $data["gold_sponsors_title"] ?>
							</h3>
						</div>
					</div>
					<div class="row g-5 pb-5">
						<?php 
						foreach($data["gold_sponsors_cards"] as $card):
						?>
							<div class="col-sm col-md-4 col-lg-3">
								<div class="card h-100 p-3" type="button">
									<div class="ratio ratio-16x9">
		    	    					<img
		    	    					src="<?= $card["image"]["url"] ?>"
		    	    					class="img-fluid"
		    	    					style="object-fit: scale-down"
		    	    					/>
									</div>
								</div>
							</div>
						<?php
						endforeach;
						?>
					</div>
				</div>
			</div>
		<?php
		endif;
		?>

		<?php
		if( $data["silver_sponsors_cards"] ):
		?>
			<div class="side-padding">
				<div class="container-fluid pb-3">
					<div class="row pb-2">
						<div class="col text-center text-silver">
							<h3>
								<?= $data["silver_sponsors_title"] ?>
							</h3>
						</div>
					</div>
					<div class="row g-5 pb-5">
						<?php 
						foreach($data["silver_sponsors_cards"] as $card):
						?>
							<div class="col-sm col-md-4 col-lg-3">
								<div class="card h-100 p-3" type="button">
									<div class="ratio ratio-16x9">
		    	    					<img
		    	    					src="<?= $card["image"]["url"] ?>"
		    	    					class="img-fluid"
		    	    					style="object-fit: scale-down"
		    	    					/>
									</div>
								</div>
							</div>
						<?php
						endforeach;
						?>
					</div>
				</div>
			</div>
		<?php
		endif;
		?>

		<?php
		if( $data["bronze_sponsors_cards"] ):
		?>
			<div class="side-padding">
				<div class="container-fluid pb-3">
					<div class="row pb-2">
						<div class="col text-center text-bronze">
							<h3>
								<?= $data["bronze_sponsors_title"] ?>
							</h3>
						</div>
					</div>
					<div class="row g-5 pb-5">
						<?php 
						foreach($data["bronze_sponsors_cards"] as $card):
						?>
							<div class="col-sm col-md-4 col-lg-3">
								<div class="card h-100 p-3" type="button">
									<div class="ratio ratio-16x9">
		    	    					<img
		    	    					src="<?= $card["image"]["url"] ?>"
		    	    					class="img-fluid"
		    	    					style="object-fit: scale-down"
		    	    					/>
									</div>
								</div>
							</div>
						<?php
						endforeach;
						?>
					</div>
				</div>
			</div>
		<?php
		endif;
		?>

<?php
	endwhile;
endif;
?>

<?php
get_footer();
?>
