<?php
/*
* Template name: Single Integration
*/
get_header();

$data = get_field('data'); ?>

<div>
	<div class="container p-4">
		<div class="row">
			<div class="col-12">
				<?php the_content() ?>
			</div>
			<div class="col-12" style="min-height: 650px;">
				<?= $data['code'] ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>