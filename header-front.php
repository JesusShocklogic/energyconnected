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
    $iframe = get_field('background_iframe_code'); ?>
    <style>
        header {
            background-color: <?= get_field('background_color') ?>;
            background-position: <?= $banner['background_position'] ?> right;
        }

        header iframe {
            width: 100% !important;
        }

        .bg-header {
            background-color: #004259 !important;
        }

        /* Bootstrap Media Query */

        /* Small devices (landscape phones, 576px and up) */
        @media (min-width: 576px) {}

        /* Medium devices (tablets, 768px and up) */
        @media (min-width: 768px) {}

        /* Large devices (desktops, 992px and up) */
        @media (min-width: 992px) {}

        /* X-Large devices (large desktops, 1200px and up) */
        @media (min-width: 1200px) {

            /*
            header,
            header iframe {
                height: 78vh;
            }

            header nav {
                z-index: 1;
            }
            */

            header .iframe-container {
                /* position: absolute;
                z-index: 0;
                top: 0; */
                width: 100%;
            }

            header .iframe-container iframe {
                width: 100%;
                height: 100%;
            }

        }

        @media (max-width: 850px) {
            .main-header {
                background-position: center;
                background-size: cover;
                aspect-ratio: 11 / 9;
            }
        }
    </style>
    <header class="main-header mb-5">
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

                    <?= floating_icons_menu_desktop('top-menu'); ?>

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

            <div class="iframe-container full-height">
                <?= $iframe ?>
            </div>

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