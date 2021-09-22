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

$header = crs_get_acf_field(
    'header',
    ''
);

$picture = crs_get_acf_field(
    'picture',
    [
        'url' => '',
        'alt' => '',
    ]
);

$contents = crs_get_acf_field(
    'contents',
    ''
);

$name = crs_get_acf_field(
    'name',
    ''
);

$qualification = crs_get_acf_field(
    'qualification',
    ''
);

$linkPhone = crs_get_acf_field(
    'link_phone',
    [
        'url' => '',
        'alt' => '',
    ]
);

$linkEmail = crs_get_acf_field(
    'link_email',
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

<div class="back-button">
    <a href="<?= $button['url'] ?>"><i class="fas fa-arrow-left"></i> <span><?= $button['title'] ?? '' ?></span></a>
</div>

<div class="post-container">

    <h1 class="first-title"><?= $header ?? '' ?></h1>

    <div class="post-date">
        <span class="icon"><i class="fas fa-calendar-alt"></i></span>
        <span class="text"><?= the_date('d.m.Y'); ?></span>
    </div>

    <img src="<?= $picture['url'] ?>" class="image" alt="post-image"/>

    <div class="post-links">

        <?php
        echo do_shortcode(
            '[Sassy_Social_Share style="
            text-align: left;
            "]'
        )
        ?>

    </div>

    <div class="description-container">
        <?= $contents ?>
    </div>

    <div class="author-contact">
        <div class="name"><?= $name ?? '' ?></div>
        <div class="qualification"><?= $qualification ?? '' ?></div>
        <div class="phone-number">p. <a href="<?= $linkPhone['url'] ?>" class="link"><?= $linkPhone['title'] ?></a>
        </div>
        <div class="email"><a href="<?= $linkEmail['url'] ?>" class="link"><?= $linkEmail['title'] ?></a></div>
    </div>

</div>

<?php
endif;