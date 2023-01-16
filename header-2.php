<!DOCTYPE html>
<html lang="en">
<?php wp_head(); ?>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php is_front_page() ? the_title() : wp_title(''); ?></title>
</head>

<body>
    <?php
    $themeSettings = get_field('theme_settings', 'options');
    $banner = get_field('banner_data'); ?>
    <style>
        .main-header {
            background-image: url(<?= $banner['background_image']['url'] ?>);
            background-position: <?= $banner['background_position'] ?> right;
        }
    </style>
    <header class="main-header mb-5">
        <div class="w-100 h-100" style="background-color: rgba(0, 0, 0, 0.3)">
            <nav class="navbar navbar-expand-xl navbar-dark py-1 mx-md-4 mx-lg-3 mx-xl-5 pt-xl-4">
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
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                    <h5 class="text-black">FESTIVALS</h5>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <h5 class="text-black">AGENDA</h5>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <h5 class="text-black">SPEAKERS</h5>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <h5 class="text-black">SPONSORS</h5>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <h5 class="text-black">ABOUT US</h5>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <h5 class="text-black">YOUR VOICE</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container text-white py-5">
                <div class="row align-items-end" style="height: 400px">
                    <div class="col-lg-8 p-2 text-center text-lg-start">
                        <h1 class="py-3"><b>Featured Speakers</b></h1>
                        <p>
                            The festival agendas will be packed with speakers telling
                            stories that resonate with Gen Zers and demonstrate the
                            transformative power of higher education. We’re inviting young
                            entrepreneurs, notable alumni, bestselling authors and social
                            influencers they’ll do so much more than just speak to our
                            audience – who will engage, inspire and answer the hard-hitting
                            questions.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>