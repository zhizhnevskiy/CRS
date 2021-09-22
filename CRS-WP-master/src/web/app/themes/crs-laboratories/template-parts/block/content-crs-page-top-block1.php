<?php

$preview = crs_get_acf_field(
    'is_preview',
    false
);

$items = crs_get_acf_field(
    'page_menu',
    []
);

$header = crs_get_acf_field(
    'header',
    ''
);

$linkText = crs_get_acf_field(
    'link_text',
    [
        'url' => '',
        'alt' => '',
    ]
);

$picture = crs_get_acf_field(
    'picture',
    [
        'url' => '',
        'alt' => '',
    ]
);

$picture_back = crs_get_acf_field(
    'picture_back',
    [
        'url' => '',
        'alt' => '',
    ]
);

if ($preview):
    ?>
    <img src="<?= $block['preview_image'] ?>" alt="">
<?php
else:
    ?>

    <div class="overview-container">

        <div class="text-container">
            <div class="links-row">
                <?php
                foreach ($items as $item) { ?>
                    <span class="overview-link"><?=$item['text']?></span>
                    <?php
                } ?>
            </div>

            <div class="overview-img">
                <h1 id="header-caption" class="first-title"><?= $header ?></h1>
            </div>

            <div class="familiarize">
                <a href="<?= $linkText['url'] ?>" class=""><?= $linkText['title'] ?></a>
            </div>
        </div>

        <div class="img-container">
            <img src="<?= $picture['url'] ?>" alt="second-image"/>
<!--            <img class="back-img" src="--><?php //= $picture_back['url'] ?><!--" alt="background-img" />-->
        </div>

    </div>

<?php
endif;
