<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header(); ?>

    <section id="content">

        <?php
        if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?= crs_page_with_heading_content() ?>
        <?php
        endwhile; else : ?>

            <article>
                <p>Sorry, no entries were found!</p>
            </article>

        <?php
        endif; ?>

    </section>

<?php
get_footer();
