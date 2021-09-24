<?php
/**
 * The template for displaying all single posts.
 */

get_header(); ?>

    <section id="content">

        <?php
        if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php
            the_content(); ?>
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