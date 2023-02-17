<?php
/*
* Template name: Guest Speakers
*/
get_header();

//Get the day TAB number.
//This works only with Synclogic, our programme TPL template and the Bootstrap List Tab Items
function getDayProgrammeTab($dayValue)
{
	//get_programme_days is located in synclogic
	$days = get_programme_days();
	$tab = 0;
	foreach ($days as $key => $day) {
		if ($dayValue == $day->session_day) {
			$tab = $key;
		}
	}
	return $tab;
} ?>
<!--Speaker's Grid-->
<style>
	.speacker-avatar {
		box-shadow: 3px 3px 10px #00000026;
		border: 3px solid #E84C22;
	}

	.f-096 {
		font-size: 0.96rem;
	}
</style>
</style>
<div class="container">
	<style>
		#searchbar,
		#searchbar:focus {
			border: 1px solid #ededed;
			border-top-left-radius: .50rem !important;
			border-bottom-left-radius: .50rem !important;
			background-color: #ededed;
			box-shadow: none;
		}

		.search-icon {
			border-top-right-radius: .50rem !important;
			border-bottom-right-radius: .50rem !important;
			border: 1px solid #e84c22 !important;
			background-color: #e84c22 !important;
			color: white;
		}
	</style>
	<div class="row justify-content-center pb-4">
		<div class="col-12 col-lg-4">
			<div class="input-group mb-3">
				<input id="searchbar" type="text" class="form-control py-2" placeholder="Search">
				<span class="input-group-text search-icon py-2"><i class="fas fa-search"></i></span>
			</div>
		</div>
	</div>

	<div class="row pt-3 pb-5">

		<?php
		$result = "";
		$dir = get_template_directory_uri();
		//$speakersArray = synclogic_get_all_speakers();
		$speakersArray = synclogic_get_all_speakers_by_category(3);

		if ($speakersArray) {
			foreach ($speakersArray as $key => $speaker) {
				$name = $speaker->speaker_name . " " . $speaker->speaker_family_name;
				$jobTitle = $speaker->job_title;
				$organization = $speaker->company;
				$image = $speaker->image_profile;
				$biography = $speaker->biography;
				$id = $speaker->speaker_id; ?>

				<div class="col-sm col-md-4 col-lg-3 mb-4" id="Speakers-Content">
					<div class="mx-auto px-4 pb-4">
						<div class="ratio ratio-1x1">
							<img src="<?= $image ?>" class="speacker-avatar" style="object-fit: cover;" loading=lazy type="button" data-bs-toggle="modal" data-bs-target="#speakerModal-<?= $id ?>" />
						</div>
						<div class="mt-3">
							<div id="name" class="fs-5 text-black"><b><?= $name ?></b></div>
							<div class="f-096"><?= $jobTitle ?></div>
							<div class="f-096"><b><?= $organization ?></b></div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="speakerModal-<?= $id ?>" tabindex="-1">
					<div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
						<div class="modal-content modal-content-speaker border-dark">
							<div class="modal-body">
								<div class="d-flex p-2 justify-content-end">
									<img src="<?= get_template_directory_uri() ?>/images/btn-close-orange.svg" loading=lazy type="button" data-bs-dismiss="modal" aria-label="Close" />
								</div>
								<div class="d-flex flex-lg-row flex-column">
									<div class="d-flex p-4 justify-content-center align-self-lg-center">
										<div class="modal-image ratio ratio-1x1 m-auto">
											<img src="<?= $image ?>" class="speacker-avatar" loading=lazy style="object-fit: cover;" />
										</div>
									</div>
									<div class="px-4">
										<div class="pb-4">
											<div><b><?= $name ?></b></div>
											<div><?= $jobTitle ?></div>
											<div><?= $organization ?></div>
										</div>
										<div class="pb-4">
											<?= $biography ?>
										</div>
									</div>
								</div>
							</div>
							<?php
							$sessions = get_sessions_by_speaker_id($speaker->speaker_id);
							if ($sessions) : ?>
								<div class="modal-footer modal_dialog_content_footer" style="display:block;">
									<?php
									foreach ($sessions as $key => $session) {
										$session_title = $session->session_title ?? null;
										$session_day_name = $session->session_day_name ?? null;
										$start_time = $session->start_time ?? null;
										$end_time = $sessions->end_time ?? null;

										$rol = "| ";
										if ($session->IsSpeaker) :
											//$rol .= $captions['speaker'];
											$rol .= "Speaker";
										elseif ($session->IsChair) :
											//$rol .= $captions['chair'];
											$rol .= "Chair";
										elseif ($session->IsCoChair) :
											//$rol .= $captions['co_chair'];
											$rol .= "Co-chair";
										endif;

										$presentations = get_presentations_by_speaker_and_author($speaker->speaker_id, $speaker->speaker_email, $session->session_id);
									?>
										<div class="modal_dialog_content_footer_session">
											<?php if ($session_title) : ?>
												<div style="display:flex;">
													<div class="modal_dialog_content_footer_session_title pe-1"><strong><?= $session->session_title; ?></strong></div>
													<div class="modal_dialog_content_footer_session_rol"><?= $rol; ?></div>
												</div>
											<?php endif; ?>

											<div style="display:flex;">
												<?php if ($session_day_name) : ?>
													<div class="modal_dialog_content_footer_session_day_name pe-1"><?= $session->session_day_name; ?></div>
												<?php endif; ?>
												<?php if ($start_time) : ?>
													<div class="modal_dialog_content_footer_session_time">
														<?php if ($session->start_time) : echo " | " . $session->start_time;
															if ($end_time) : echo " - " . $end_time;
															endif;
														endif; ?>
													</div>
												<?php endif; ?>
											</div>

											<?php
											//if ($shocklogic_synclogic_speakers_group['link_to_programme'] == "link_to_programme") :
											if ($shocklogic_synclogic_speakers_group['link_to_programme'] = "link_to_programme") :
												$programme_page_link = isset($shocklogic_synclogic_speakers_group['programme_page_link']) ? $shocklogic_synclogic_speakers_group['programme_page_link'] : null;
												if ($programme_page_link) :
													$getTab = getDayProgrammeTab($session->session_day); ?>
													<div>
														<a href="<?= $programme_page_link . "?DayTab=" . $getTab . "&SessionId=" . $session->session_id ?>">
															<?= $shocklogic_synclogic_speakers_group['programme_link_caption'] ?>
														</a>
													</div>
											<?php endif;
											endif; ?>

											<?php if ($presentations) : ?>
												<div class="modal_dialog_content_footer_session_presentations">
													<?php
													//if ($captions['presentations_title']) :
													if ($captions['presentations_title'] = "Presentations") : ?>
														<div class="modal_dialog_content_footer_session_presentations_title"><?= $captions['presentations_title'] ?></div>
													<?php endif; ?>
													<ul class="modal_dialog_content_footer_session_presentations_presentation">
														<?php foreach ($presentations as $key => $presentation) { ?>
															<li class="modal_dialog_content_footer_session_presentations_presentation_title"><?= $presentation->presentation_title ?></li>
														<?php } //foreach 
														?>
													</ul>
												</div>
											<?php endif; ?>
										</div>
									<?php } ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
		<?php } //foreach 
		} else {
			echo "No speakers where found";
		} ?>

	</div>
</div>

<?php get_footer(); ?>
<script>
	//Search bar
	$('#searchbar').on('keyup', function() {
		let searchval = this.value.toUpperCase();

		$('#Speakers-Content #name').map(function() {
			var string = $(this)[0].innerHTML.toUpperCase();

			if (string.includes(searchval)) {
				$(this).parent().parent().parent().show();
			} else {
				$(this).parent().parent().parent().hide();
			}
		});
	})
</script>