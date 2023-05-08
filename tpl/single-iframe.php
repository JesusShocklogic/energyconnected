<?php
/*
 * Template name: Single Iframe
 */
get_header();

$data = get_field('data'); ?>

<style>
	.single_iframe_iframe {
		height: 100dvh;
	}
</style>
<div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<?php the_content() ?>
			</div>
			<div class="col-12 single_iframe_iframe">
				<iframe src="<?= $data['iframe'] ?>" width="100%" height="100%" frameborder="0"
					allow="microphone *; camera *" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen=""
					oallowfullscreen="" msallowfullscreen=""></iframe>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>