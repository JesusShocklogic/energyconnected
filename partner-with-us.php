<?php
/*
* Template name: Partner With Us
*/
get_header(); 

if (have_posts()):
	while (have_posts()):
		the_post();
?>

		<div class="side-padding pb-3">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<h3 class="display-5 text-center text-black fw-bold pb-3">
							<?= get_the_title() ?>
						</h3>
						<div class="fs-6">
							<?= get_the_content() ?>
						</div>
					</div>
				</div>
				<?php
					if (get_field('button')):
				?>
					<div class="row">
						<div class="col-12">
							<div class="d-grid gap-2 d-flex justify-content-center">
								<a 
									href="<?=get_field("button")["url"] ?>" 
									type="button" 
									class="btn btn-dark btn-lg bgcolor-black m-3 py-1 px-4"
									style="border-radius: 10px;"
								>
									<strong><?=get_field("button")["title"] ?></strong>
								</a>
							</div>
						</div>
					</div>
				<?php
					endif;
				?>
			</div>
		</div>

		<div 
			style="background-image: url(<?= get_field('banner')["image"]["url"] ?>);" 
			class="partner-banner"
		>
			<div class="w-100 h-100 side-padding" style="background-color: rgba(0, 0, 0, 0.3)">
        		<div class="container-fluid text-white py-5">
        		    <div class="row align-items-center" style="min-height: 625px">
        		        <div class="col-lg-6 p-1 text-center text-lg-start">
							<div class="fs-5"><?= get_field('banner')["text"] ?></div>
        		        </div>
        		    </div>
        		</div>
			</div>
		</div>

		<!-- STATS -->
		<?php
		if(have_rows("stats")):
		?>
			<div class="container side-padding pt-5">
				<div class="row g-4 justify-content-between">
				<?php
				while( have_rows('stats') ):
					the_row();
				?>
					<div class="col-lg-3 col-md-3 col-12">
						<div class="row text-center text-black">
							<div class="col-12">
								<h1 class="notoBold stats-font"><?= get_sub_field("number"); ?></h1>
							</div>
							<div class="col-12">
								<div class="fs-5 notoBold"><?= get_sub_field("text"); ?></div>
							</div>
						</div>
					</div>
				<?php
				endwhile;
				?>
				</div>
			</div>
		<?php
		endif;
		?>

		<!-- CARDS -->
		<?php
		if(have_rows("cards")):
		?>
			<div class="side-padding">
				<div class="container-fluid">
				<h2 class="text-black notoBold py-4"><?= get_field("cards_title") ?></h2>
					<div class="row g-5">
						<?php while( have_rows('cards') ){
							the_row();
						?>
							<div class="col-sm col-md-4 col-lg-4">
								<div class="ratio ratio-16x9">
									<a href="<?= get_sub_field("url") ?>">
		    	    					<img
		    	    					src="<?= get_sub_field("image")["url"] ?>"
		    	    					class="img-fluid"
		    	    					style="object-fit: scale-down"
		    	    					/>
									</a>
								</div>
							</div>
						<?php
						}
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

get_footer();
?>
