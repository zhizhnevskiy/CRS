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

if ($preview):
    ?>
    <img src="<?= $block['preview_image'] ?>" alt="">
<?php
else:
    ?>

    <div class="service-container">

        <div class="text">
            <h1 class="first-title"><?= $header ?></h1>

            <?php
            foreach ($paragraph as $value) { ?>
                <p class="subtitle subtitle-bottom"><?php
                    echo $value['paragraph']; ?></p>
                <?php
            } ?>

            <div class="link-container">
                <a href="<?= $linkText['url'] ?>" class="link"><?= $linkText['title'] ?></a>
            </div>
        </div>

        <div class="img-container">
            <img src="<?= $picture['url'] ?>" alt=""/>
        </div>

    </div>

<?php
endif;