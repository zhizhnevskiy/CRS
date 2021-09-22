<?php

$preview = crs_get_acf_field(
    'is_preview',
    false
);

$headerContent      = crs_get_acf_field('header_content', '');
$addressPartHeaderContent = crs_get_acf_field('address_part_header_with_line', '');
$addressPartContent = crs_get_acf_field('address_part_content', '');
$googleMapUrl = crs_get_acf_field('google_map_url', '');

$button = crs_get_acf_field(
    'button',
    [
        'url'   => '',
        'title' => '',
    ]
);

if ($preview):
    ?>
    <img src="<?= $block['preview_image'] ?>" alt="">
<?php
else:
    ?>

    <div class="contact-container">

        <div class="header-contact">
            <div class="text-container"><?= $headerContent ?></div>
            <div class="spacer"></div>
        </div>

        <div class="info-container">
            <div class="info">
                <?php if (!empty($addressPartHeaderContent)) { ?>
                    <div class="address">
                        <div class="text">
                            <?= $addressPartHeaderContent ?>
                        </div>
                        <div class="line-container">
                            <div class="line"></div>
                        </div>
                    </div>
                <?php } ?>
                <div class="address-part-content"><?= $addressPartContent ?></div>
                <div class="button-container">
                    <button class="primary-button">
                        <a href="<?= $button['url'] ?>">
                            <?= $button['title'] ?>
                            <i class="fas fa-map-marker-alt"></i>
                        </a>
                    </button>
                </div>
            </div>
            <div class="map">
                <?php if (!empty($googleMapUrl)) { ?>
                    <iframe
                            src="<?=$googleMapUrl?>"
                            width=100%
                            height="450"
                            style="border: 0"
                            allowfullscreen=""
                            loading="lazy"
                    ></iframe>
                <?php } ?>
            </div>
        </div>
    </div>

<?php
endif;
