<?php

$preview = crs_get_acf_field(
    'is_preview',
    false
);

$header = crs_get_acf_field(
    'header',
    ''
);

$paragraph = crs_get_acf_field(
    'paragraph',
    ''
);

$picture = crs_get_acf_field(
    'picture',
    [
        'url' => '',
        'alt' => '',
    ]
);

$paged = get_query_var('paged') ?: 1;
$GLOBALS['wp_query'] = $wp_query = new WP_Query();
$defaults = [
    'posts_per_page' => 5,
    'category' => 0,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_type' => 'post',
    'suppress_filters' => true,
    'paged' => $paged,
];
$posts = $wp_query->query($defaults);

if ($preview):
    ?>
    <img src="<?= $block['preview_image'] ?>" alt="">
<?php
else:
    ?>

    <div class="services-list-container">

        <div class="services">

            <div class="text">

                <h1 class="first-title"><?= $header ?? '' ?></h1>

                <div class="subtitle">
                    <?= $paragraph ?? '' ?>
                </div>
            </div>

            <ul class="services-list">
                <?php
                foreach ($posts as $post) { ?>
                    <li class="list-item">
                        <div class="date"><?= get_the_date('d.m.Y', $post) ?> </div>
                        <div class="title f-24"><a href="<?= get_permalink($post) ?>"><?= $post->post_title ?></a></div>
                    </li>
                    <?php
                } ?>
            </ul>

            <div id="pagination">
                <?= paginate_links(); ?>
            </div>
        </div>

        <div class="img-container">
            <img src="<?= $picture['url'] ?>" alt=""/>
        </div>

        <?php
        wp_reset_postdata();
        wp_reset_query(); ?>

    </div>

<?php
endif;