<?php

$preview = crs_get_acf_field(
    'is_preview',
    false
);

$header = crs_get_acf_field(
    'header',
    ''
);

$contact = crs_get_acf_field(
    'contact',
    ''
);

$person = crs_get_acf_field(
    'person',
    []
);

$photo = crs_get_acf_field(
    'photo',
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

    <div class="staff-container">

        <div class="content-header">
            <h2 class="second-title"><?= $header ?></h2>
            <div class="description-container">
                <div class="subtitle">

                    <div>
                        <span><?= $contact ?></span>
                    </div>

                </div>
            </div>
        </div>

        <ul class="staff-cards-list">

            <?php
            foreach ($person as $personData) { ?>

                <li class="card-item">
                    <div class="avatar">
                        <img src="<?= $personData['photo']['url'] ?>" alt="avatar"/>
                    </div>
                    <div class="info">
                        <div class="person-contact"><?= $personData['paragraph'] ?></div>

                    </div>
                </li>

                <?php
            } ?>

        </ul>

    </div>
    <div class="separator-bottom"></div>
<?php
endif;