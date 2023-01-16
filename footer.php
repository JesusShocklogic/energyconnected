<?php
$footer = get_field("footer_settings", "option");

$bg_rules = "";
$footer_color = $footer['text_colour'];
$footer_bg = $footer['bakground_colour'];
$links_hover_colour = $footer['links_hover_colour'];
$bg_rules = <<<RULES
    <style>
        .bg-rules, .bg-rules a {
            background-color: $footer_bg;
            color: $footer_color;
        }
        .bg-rules a:hover {
            color: $links_hover_colour;
        }
    </style>
RULES;

echo $bg_rules;
?>
<!-- FOOTER-->
<footer class="side-padding bg-rules pt-4 mt-5">
    <div class="container-fluid">
        <div class="row py-4">
            <!-- FIRST COLUMN-->
            <div class="col-12 col-xl-4 pb-5 pb-xl-0 text-footer">
                <div class="row">
                    <div class="col-12">
                        <h5 class="notoBold mb-3">
                            <?= $footer["column_1_title"] ?>
                        </h5>
                        <?php
                        if ($footer["column_1"]) {
                            foreach ($footer["column_1"] as $text) :
                                $link_url = esc_url($text['link']['url']);
                                $link_title = esc_html($text['link']['title']);
                                $link_target = $text['link']['target'] ? $text['link']['target'] : '_self';
                                $link_target = esc_attr($link_target);
                        ?>
                                <p class="mb-1">
                                    <a target="<?= $link_target ?>" href="<?= $link_url ?>" class="text-decoration-none ">
                                        <?= $link_title ?>
                                    </a>
                                </p>
                        <?php
                            endforeach;
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- SECOND COLUMN-->
            <div class="col-12 col-xl-4 pb-5 pb-xl-0 text-footer">
                <h5 class="notoBold mb-3">
                    <?= $footer["column_2_title"] ?>
                </h5>
                <div>
					<?= $footer["column_2"] ?>
				</div>
            </div>
            <!-- THIRD COLUMN-->
            <div class="col-12 col-xl-4 text-footer">
                <!-- MAILING LIST-->
                <div class="row mb-3 justify-content-center justify-content-xl-start">
                    <div class="col-12">
                        <?= do_shortcode($footer['mailchimp_shortcode']) ?>
						<?= $footer['text_column_3']; ?>
                    </div>
                </div>
                <!-- SOCIAL -->
                <div class="row">
                    <div class="col-12">
                        <h5 class="notoBold mb-3">
                            <?= $footer["column_social_title"] ?>
                        </h5>
                        <div class="row justify-content-center">
                            <div class="col-10 col-xl-12">
                                <?php
                                if ($footer["column_social_icons"]) {
                                    foreach ($footer["column_social_icons"] as $icon) :
                                        $link_url = esc_url($icon['link']['url']);
                                        //$link_title = esc_html($icon['link']['title']);
                                        $link_target = $icon['link']['target'] ? $icon['link']['target'] : '_self';
                                        $link_target = esc_attr($link_target);
                                ?>
                                        <a href="<?= $link_url ?>" target="$link_target" class="text-decoration-none ">
                                            <img src="<?= $icon["icon"]["url"] ?>" class="social-icons me-3 me-xl-5" alt="">
                                        </a>
                                <?php
                                    endforeach;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ps-xl-4 text-footer">
            <div class="col-12 ps-xl-5">
                <p class="text-center" style="font-size: 1.5vh;">Copyright © 2022 All rights reserved</p>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
<script>
    $(".full-height").css('min-height', window.innerHeight - $(".menu-shadow").innerHeight());
</script>
</body>

</html>
