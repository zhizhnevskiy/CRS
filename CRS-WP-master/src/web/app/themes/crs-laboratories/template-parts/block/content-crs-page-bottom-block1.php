<?php

$preview = crs_get_acf_field(
    'is_preview',
    false
);

$picture = crs_get_acf_field(
    'picture',
    [
        'url' => '',
        'alt' => '',
    ]
);

$header = crs_get_acf_field(
    'header',
    ''
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

if ($preview):
    ?>
    <img src="<?= $block['preview_image'] ?>" alt="">
<?php
else:
    ?>

    <div class="contact-our-services-container">
        <div class="img-container">
            <img src="<?= $picture['url'] ?>" alt="person"/>
            <div class="overlay"></div>
        </div>
        <div class="text-container">
            <h2 class="second-title"><?= $header ?></h2>
            <p class="subtitle">
                <?= $paragraph ?>
            </p>
            <div class="button-container">
                <button class="primary-button">
                    <a href="<?= $button['url'] ?>">
                        <i class="fas fa-chevron-right"></i>
                        <?= $button['title'] ?>
                    </a>
                </button>
            </div>
        </div>
    </div>

<?php
endif;