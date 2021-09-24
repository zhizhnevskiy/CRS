<?php

$preview = crs_get_acf_field(
    'is_preview',
    false
);

$paragraph = crs_get_acf_field(
    'paragraph',
    ''
);

$button = crs_get_acf_field(
    'button',
    [
        'url' => '',
        'title' => '',
    ]
);

$picture_01 = crs_get_acf_field(
    'picture_01',
    [
        'url' => '',
        'alt' => '',
    ]
);

$picture_02 = crs_get_acf_field(
    'picture_02',
    [
        'url' => '',
        'alt' => '',
    ]
);

$picture_03 = crs_get_acf_field(
    'picture_03',
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

    <div class="service-description-container">

        <div class="text-container">

            <?php
            foreach ($paragraph as $value) { ?>
                <p><?php
                    echo $value['paragraph']; ?></p>
                <?php
            } ?>

            <button class="primary-button">
                <a href="<?= $button['url'] ?>">
                    <i class="fas fa-chevron-right"></i><?= $button['title'] ?>
                </a>
            </button>
        </div>

        <div class="images-container">

            <div class="top">
                <img src="<?= $picture_01['url'] ?>" alt="women-lab"/>
            </div>

            <div class="bottom">
                <img src="<?= $picture_02['url'] ?>" class="cube" alt="test-cube"/>
                <img src="<?= $picture_03['url'] ?>" alt="women-lab2"/>
            </div>

        </div>



    </div>
    <div class="separator-bottom"></div>

<?php
endif;