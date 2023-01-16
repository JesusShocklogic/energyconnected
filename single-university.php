<?php
/*
* Template name: Single university
*/
get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post(); ?>
		<div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<!--ABOUT UNIVERSITY-->
						<div class="px-5 pb-5">
							<h4 class="single-page-title">
								<strong>
									<span style="color: #00ff00"><em>/ </em></span>
									<?= get_the_title(); ?>
								</strong>
							</h4>
							<div class="px-4">
								<?= get_the_content(); ?>
							</div>
						</div>
					</div>
					<div class="col-12">
						<!--EXPLORE THESE FEATURED UNIVERSITIES-->
						<div class="pb-5">
							<div class="px-5">
								<h4 class="single-page-title">
									<strong>
										<span style="color: #00ff00"><em>/ </em></span>
										EXPLORE THESE FEATURED UNIVERSITIES
									</strong>
								</h4>
							</div>
							<div>
								<div class="container-fluid p-0 mb-3">
									<img type="button" src="<?= get_template_directory_uri() ?>/images/b_AllSoulsquad.jpg" style="height: 200px; width: 100%" />
								</div>
							</div>
						</div>
					</div>
					<div class="col-12">
						<!--CHOOSE A SUBJECT-->
						<div class="px-5 pb-5">
							<h4 class="single-page-title">
								<strong>
									<span style="color: #00ff00"><em>/ </em></span>
									CHOOSE A SUBJECT
								</strong>
							</h4>
							<div class="container-fluid px-4">
								<div class="row">
									<div class="col-sm col-md-4 col-lg-4 mb-4 ps-0">
										<img type="button" src="<?= get_template_directory_uri() ?>/images/1.jpg" class="m-2 img-fluid" width="350" />
									</div>
									<div class="col-sm col-md-4 col-lg-4 mb-4 ps-0">
										<img type="button" src="<?= get_template_directory_uri() ?>/images/2.jpg" class="m-2 img-fluid" width="350" />
									</div>
									<div class="col-sm col-md-4 col-lg-4 mb-4 ps-0">
										<img type="button" src="<?= get_template_directory_uri() ?>/images/1.jpg" class="m-2 img-fluid" width="350" />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

<?php
	}
} else {
	echo "No content was found";
}

get_footer();
