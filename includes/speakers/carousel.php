<?php

function speaker_carousel_wiper_start()
{
    $result = "";
    $result .= <<<RESULT
        <script>
            const swiperSpeaker = new Swiper('.speaker-swiper-container', {
                loop: false,
                autoplay: {
                delay: 2500,
                disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                slidesPerView: 2,
                spaceBetween: 0,
                breakpoints: {
                    1200: {
                        slidesPerView: 4
                    },
                    992: {
                        slidesPerView: 3
                    }
                }
            });
        </script>
    RESULT;
    echo $result;
}

function speakers_carousel($speakersSettings)
{
    $top_content = $speakersSettings['top_content'];
    $result = "";
    $result .= <<<RESULT
    <style>
        .swiper-button-next, .swiper-button-prev {
            color: var(--swiper-navigation-color,#000);
        }
        .swiper-slide {
            text-align: center;
            padding: 3vw;
        }
        .speaker-swiper-container-pointer-events {
            touch-action: pan-y;
        }
        .speaker-swiper-container {
            margin-left: auto;
            margin-right: auto;
            position: relative;
            overflow: hidden;
            list-style: none;
            padding: 0;
            z-index: 1;
        }
    </style>
    <div class="side-padding mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 h3 text-black notoBold">
                    $top_content
                </div>
                <div class="col-12">
                    <!-- Slider main container -->
                    <div class="speaker-swiper-container">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
    RESULT;

    if ($speakersSettings['select'] == 'all') {
        $speakersArray = synclogic_get_all_speakers();
    } elseif ($speakersSettings['select'] == 'categories') {
        $categories = "";
        $categories = array_map(function ($category) {
            return $category['category'];
        }, $speakersSettings['categories']);
        $categories = implode(",", $categories);
        $speakersArray = synclogic_get_all_speakers_by_categories($categories);
    }

    foreach ($speakersArray as $key => $speaker) {
        if ($key == 10) break;
        $name = $speaker->speaker_name . " " . $speaker->speaker_family_name;
        $jobTitle = $speaker->job_title;
        $organization = $speaker->company;
        $image = $speaker->image_profile;
        $speakerModalId = "speaker" . $speaker->speaker_id;

        $result .= <<<RESULT
                <div class="swiper-slide align-self-start">
                    <div class="ratio ratio-1x1">
                        <a data-bs-toggle="modal" data-bs-target="#$speakerModalId">
                            <img class="mx-auto w-100 rounded-circle" style="object-fit: cover;height: 100%;" src="$image">
                        </a>
                    </div>
                    <div class="text-center pt-3">
                        <div class="fw-bolder">$name</div>
                        <div>$jobTitle</div>
                        <div class="fw-bolder">$organization</div>
                    </div>
                </div>
            RESULT;
    } //foreach

    $result .= <<<RESULT
                        </div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    RESULT;
    echo $result;
    //After printing the carousel, we initialize it after the wp_footer is executed, using this hook and adding priority 100
    add_action('wp_footer', 'speaker_carousel_wiper_start', 100);

    /*
    * Speakers modals
    */


    $speakersModals = $speakersArray;
    foreach ($speakersModals as $key => $speaker) {
        $name = $speaker->speaker_name . " " . $speaker->speaker_family_name;
        $jobTitle = $speaker->job_title;
        $organization = $speaker->company;
        $image = $speaker->image_profile;
        $speakerModalId = "speaker" . $speaker->speaker_id;
        $biography = $speaker->biography;
?>
        <!-- Modal -->
        <div class="modal fade" id="<?= $speakerModalId ?>" tabindex="-1" aria-labelledby="<?= $speakerModalId ?>Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="<?= $speakerModalId ?>Label"><?= ($name ?? '') ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body modal_dialog_content_body">
                        <div class="ratio ratio-1x1" style="width: 75%;margin: 0 auto;margin-bottom: 1rem;">
                            <div>
                                <img src="<?= $image ?>" alt="" class="mx-auto rounded-circle" style="object-fit: cover;width: 100%;height: 100%;">
                            </div>
                        </div>
                        <div class="text-center">
                            <strong><?= ($name ?? '') ?></strong>
                            <div><?= ($jobTitle ?? '') ?></div>
                            <div><?= ($organization ?? '') ?></div>
                        </div>
                        <div class="modal_dialog_content_body_right">
                            <div class="modal_dialog_content_body_right_content">
                                <?= $biography ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    } //foreach
}
