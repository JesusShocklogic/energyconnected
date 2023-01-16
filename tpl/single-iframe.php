<?php
/*
* Template name: Single Iframe
*/
get_header();

$data = get_field('data'); ?>

<div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 vh-100" style="min-height: 650px;">
				<iframe src="<?= $data['iframe'] ?>" width="100%" height="100%" frameborder="0" allow="microphone *; camera *" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen="" oallowfullscreen="" msallowfullscreen=""></iframe>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>