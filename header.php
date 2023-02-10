<!DOCTYPE html>
<html lang="en">
<?php wp_head(); ?>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<title><?php is_front_page() ? the_title() : wp_title(''); ?></title>
</head>

<body>

	<?php
	$themeSettings = get_field('theme_settings', 'options');
	$banner = get_field('banner_data');
	$background_image = isset($banner['background_image']['url']) ? $banner['background_image']['url'] : null; ?>
	<style>
		.main-header {
			background-image: url(<?= $banner['background_image']['url'] ?>);
			background-position: center left;
		}

		.bg-header {
			background-color: #004259 !important;
		}

		.mh-header {
			min-height: 400px;
		}

		@media (min-width: 1200px) {
			.main-header {
				background-position: <?= $banner['background_position'] ?> right;
			}
		}

		@media (max-width: 850px) {
			.main-header {
				background-position: center;
				background-size: cover;
				aspect-ratio: 16 / 9;
			}

			.mh-header {
				min-height: auto;
			}
		}
	</style>
	<!-- HEADER -->
	<header class="mb-5">
		<div class="w-100 h-100" style="background-color: rgba(0, 0, 0, 0.3)">
			<div class="menu-shadow"></div>
			<nav class="navbar navbar-expand-xl navbar-dark py-md-1 py-2 mx-md-4 mx-lg-3 mx-xl-5 pt-xl-4 bg-header">
				<div class="container-fluid">
					<!-- HAMBURGER MENU ICON -->
					<button class="navbar-toggler border-0 p-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon p-0"></span>
					</button>
					<!-- LOGO -->
					<a class="navbar-brand m-0 py-0 logo-size mx-auto" href="<?= $themeSettings['logo_url'] ?>">
						<img src="<?= $themeSettings['main_logo']['url'] ?>" class="d-block w-100" alt="" />
					</a>

					<!-- EXPANDED MENU -->
					<div class="collapse navbar-collapse flex-column" id="navbarTogglerDemo02">
						<ul class="navbar-nav ms-auto mb-4">
							<?php top_menu_desktop('top-menu'); ?>
						</ul>
						<ul class="navbar-nav ms-auto">
							<?php custom_menu_level_3('main-menu'); ?>
						</ul>
					</div>

					<!-- HAMBURGER MENU -->
					<div class="offcanvas offcanvas-start d-flex d-xl-none offcanvas-size" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
						<div class="offcanvas-header">
							<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
						</div>
						<div class="offcanvas-body">
							<ul class="navbar-nav ms-auto mb-4">
								<?php main_menu_mobile('mobile-menu'); ?>
							</ul>
						</div>
					</div>
				</div>
			</nav>

			<?= floating_icons_menu_desktop('top-menu'); ?>

			<?php if ($background_image) : ?>
				<div class="main-header side-padding">
					<div class="container-fluid text-white py-5">
						<div class="row align-items-center mh-header">
							<div class="col-lg-7 p-2 text-center text-lg-start">
								<?php echo $banner['text'] ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</header>

	<!-- Top Menu Modal -->
	<div class="modal fade" id="topMenuModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="topMenuModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" style="width:900px; height:90%">
			<div class="modal-content h-100">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div id="topMenuModalIframeContainer" class="modal-body p-0 overflow-hidden">
					<span class="loader">Loading...</span>
					<iframe width="100%" height="100%" frameborder="0" allow="microphone *; camera *" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen="" oallowfullscreen="" msallowfullscreen=""></iframe>
				</div>
			</div>
		</div>
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			document.querySelector("[data-topmenu-set-iframe]").addEventListener('click', function(e) {
				console.log("hola")
				const iframeSrc = this.dataset.topmenuIframe,
					iframeContainer = document.querySelector(`#${this.dataset.topmenuSetIframe} iframe`),
					spinner = document.querySelector(`#${this.dataset.topmenuSetIframe} span`)
				iframeContainer.src = iframeSrc
				iframeContainer.addEventListener('load', () => {
					spinner.style.display = 'none'
				})
			})
		})
	</script>