<?php
/*
* Template name: Chinese Page
*/
get_header(); 

if (have_posts()):
	while (have_posts()):
		the_post();
		$btn_background = get_field("register_button")["background_color"];
		$btn_text = get_field("register_button")["text_color"];
?>
		<style>
			.opacity-100{
				opacity: 1!important;
			}

			.register-btn-color{
				background-color: <?= $btn_background ?> !important;
				color: <?= $btn_text ?>
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
		if (get_field("speakers_iframe")):
		?>
		<div class="side-padding pb-5">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<h3 class="text-black fw-bolder py-4"><?= get_field('speakers_title') ?></h3>
					</div>
				</div>
				<div class="row">
					<div class="col-12" style="min-height: 650px;">
						<iframe src="<?= get_field("speakers_iframe") ?>" width="100%" height="100%" frameborder="0" allow="microphone *; camera *" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen="" oallowfullscreen="" msallowfullscreen=""></iframe>
					</div>
				</div>
			</div>
		</div>
		<?php
		endif;
		?>

		<?php
		if (get_field("agenda_iframe")):
		?>
		<div class="side-padding pb-5">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<h3 class="text-black fw-bolder py-4"><?= get_field('agenda_title') ?></h3>
					</div>
				</div>
				<div class="row">
					<div class="col-12" style="min-height: 650px;">
						<iframe src="<?= get_field("agenda_iframe") ?>" width="100%" height="100%" frameborder="0" allow="microphone *; camera *" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen="" oallowfullscreen="" msallowfullscreen=""></iframe>
					</div>
				</div>
			</div>
		</div>
		<?php
		endif;
		?>

		<div class="side-padding pb-5">
			<div class="container-fluid">
				<div class="fs-6 text-black">
					<?= get_field("more_text") ?>
				</div>
			</div>
		</div>

		<?php
		$link = get_field('register_link');
		if ($link):
			$link_url = $link['url'];
			$link_title = $link["title"];
			$link_target = $link['target']? : '_self';
		?>
			<div class="side-padding pb-5">
				<div class="row">
					<div class="col-12">
						<div class="d-grid gap-2 d-flex justify-content-center">
							<a 
								href="<?= $link_url ?>" 
								type="button" 
								class="btn btn-lg register-btn-color m-3 py-1 px-4"
								style="border-radius: 10px;"
								target="<?= esc_attr( $link_target ) ?>"
							>
								<strong><?= $link_title ?></strong>
							</a>
						</div>
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
