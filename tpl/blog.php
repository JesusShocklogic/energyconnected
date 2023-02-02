<?php
/*
* Template name: Blog page template
*/
get_header();

?>

<style>
    .blog_wrapper {
        display: grid;
        align-items: start;
        justify-items: center;
        align-content: center;
        grid-template-columns: repeat(auto-fill, minmax(20rem, 1fr));
        grid-gap: 20px;
    }

    .blog_wrapper_single {
        width: 100%;
    }

    .blog_wrapper_single_title a {
        color: black;
        text-decoration: none;
    }

    .blog_wrapper_single_title a {
        color: #004259;
    }

    .blog_wrapper_single_image {
        width: 100%;
        height: 300px;
    }

    .blog_wrapper_single_image img {
        max-width: 100%;
        width: 100%;
        object-fit: cover;
        height: 100%;
    }
</style>
<div class="side-padding">
    <?php
    global $wp_query;

    $args = array(
        'posts_per_page'   => -1, // Negative numbers means ALL. Cero means ALL too, but some errors have been detected.
        'post_type'         => 'post', //it does accept Custom Types
        'offset'            => 0,
        'post_status'      => 'publish',
        'order'             => 'ASC', // ASC ascended , DESC descend
    );
    // query
    $wp_query = new WP_Query($args);

    if ($wp_query->have_posts()) { ?>
        <div class="blog">
            <div class="blog_wrapper">
                <?php
                while ($wp_query->have_posts()) {
                    $wp_query->the_post(); ?>


                    <div class="blog_wrapper_single">
                        <div class="blog_wrapper_single_image">
                            <a href="<?= get_permalink() ?>">
                                <img src="<?= get_the_post_thumbnail_url() ?>" alt="">
                            </a>
                        </div>
                        <div class="blog_wrapper_single_title">
                            <a href="<?= get_permalink() ?>">
                                <strong><?= the_title() ?></strong>
                            </a>
                        </div>
                        <div class="blog_wrapper_single_ecerpt">
                            <?= get_the_excerpt() ?>
                        </div>
                    </div>

                <?php
                };
                wp_reset_query(); ?>
            </div>
        </div>
    <?php
    } //if
    else {
        echo "No posts where found";
    }

    ?>
</div>
<?php
get_footer();
