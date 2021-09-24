<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$blocksGroups = crs_article_template_content_blocks();

get_header(); ?>

    <section id="content">
        <?php foreach ($blocksGroups['header'] as $block ) { ?>
            <?= $block['content'] ?>
        <?php } ?>

        <?php if (!empty($blocksGroups['center'])) { ?>
            <div class="service-padding-container">
                <div class="description-block">
                    <?php foreach ($blocksGroups['center'] as $block ) { ?>
                        <?= $block['content'] ?>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>

        <?php foreach ($blocksGroups['footer'] as $block ) { ?>
            <?= $block['content'] ?>
        <?php } ?>
    </section>

<?php
get_footer();
