<?php

$contents = crs_get_acf_field(
    'contents', ''
);

$linkText = crs_get_acf_field(
    'link_text',
    [
        'url' => '',
        'alt' => '',
    ]
);

?>

<div class="service-padding-container">

<!--    <div class="description-block">-->
    <?php foreach ($contents as $value) { ?>
        <div class="description-block">
        <div class="header"><?= $value['header'] ?? ''?></div>

        <div class="subheader"><?= $value['paragraph']  ?? ''?></div>

        <?= $value['content'] ?? ''?>

        <img src="<?= $value['picture']['url']  ?? ''?>" class="img" alt=""/>
        </div>
    <?php } ?>

<!--    </div>-->

    <div class="button-container">
        <button class="primary-button">
            <a href="<?= $linkText['url'] ?>"><?= $linkText['title'] ?></a>
        </button>
    </div>

</div>
