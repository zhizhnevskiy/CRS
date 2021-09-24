<?php

$preview = crs_get_acf_field(
    'is_preview',
    false
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

    <div class="service-padding-container">

        <div class="button-container">
            <button class="primary-button">
                <a href="<?= $button['url'] ?>"><?= $button['title'] ?></a>
            </button>
        </div>

    </div>

<?php
endif;