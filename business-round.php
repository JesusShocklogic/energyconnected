<?php
/*
* Template name: Business Round Tables
*/
get_header(); 

$data = get_field("data");
$dir = get_template_directory_uri();
$modal = function($dir, $key, $modal_data){
	return <<<RESULT
		<div class="modal fade" id="card$key" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-body">
						<div class="d-flex p-2 justify-content-end">
							<img src="$dir/images/btn-close-orange.svg" loading=lazy type="button" data-bs-dismiss="modal" aria-label="Close" />
						</div>
						<div class="d-flex flex-lg-row flex-column">
							<div class="m-auto">
								<img src="{$modal_data["image"]["url"]}" loading=lazy style="object-fit: scale-down; max-width: 200px" />
							</div>
							<div class="px-4">
								<div class="text-orange fw-bold pb-2">
									{$modal_data["title"]}
								</div>
								<div>
									{$modal_data["text"]}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	RESULT;
};

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
		</style>
		<div class="side-padding">
			<div class="container-fluid">
				<div class="fs-6 text-black">
					<?= get_the_content() ?>
				</div>
			</div>
		</div>

		<?php
		if( $data["cards"] ):
		?>
			<div class="side-padding">
				<div class="container-fluid pb-3">
					<div class="row g-5 pb-5">
						<?php 
						foreach($data["cards"] as $key => $card):
						?>
							<div class="col-sm col-md-4 col-lg-3">
								<div class="card h-100 p-3" type="button" data-bs-toggle="modal" data-bs-target="#card<?= $key ?>">
									<div class="ratio ratio-16x9">
		    	    					<img
		    	    					src="<?= $card["image"]["url"] ?>"
		    	    					class="img-fluid"
		    	    					style="object-fit: scale-down"
		    	    					/>
									</div>
									<div class="center text-orange fw-bold h-100">
										<?= $card["title"] ?>
									</div>
								</div>
							</div>
						<?php
							echo $modal($dir,$key,$card);
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
