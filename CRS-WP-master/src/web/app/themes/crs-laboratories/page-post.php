<?php
/**
 * Template Name: Post template
 * Template post type: page, post
 **/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$blocks = crs_post_template_content_blocks();

get_header();
?>

    <section id="content">
        <?php crs_get_sidebar('post_list_page'); ?>
        <div class="post-container">
            <h1 class="first-title"><?= get_the_title() ?></h1>

            <div class="post-date">
                <span class="icon"><i class="fas fa-calendar-alt"></i></span>
                <span class="text"><?=get_the_date('d.m.Y') ?></span>
            </div>

            <div class="description-container">
                <?php foreach ($blocks as $lastUsedBlock => $block) { ?>
                    <?php if ($block['core']) { unset($blocks[$lastUsedBlock]) ?>
                        <?= $block['content'] ?>
                    <?php } else {break;} ?>
                <?php } ?>
            </div>
        </div>
        <div class="separator-bottom"></div>
        <?php foreach ($blocks as $block) { ?>
            <?= $block['content'] ?>
        <?php } ?>

    </section>

<?php
get_footer();
