<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>

    <img class="wave_img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/body/wave.png" alt="logo">
    <img class="back_img" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/body/back.png" alt="logo">

    <div class="div_page">

        <section>

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <article>
                    <?php the_content(); ?>
                </article>

            <?php endwhile; else : ?>

                <article>
                    <p>Sorry, no entries were found!</p>
                </article>

            <?php endif; ?>

        </section>

    </div>

<?php get_footer();