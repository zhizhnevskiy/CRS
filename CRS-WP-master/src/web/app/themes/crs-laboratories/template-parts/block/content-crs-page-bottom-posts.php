<?php

$preview = crs_get_acf_field(
    'is_preview',
    false
);

$leftSideContent = crs_get_acf_field(
    'left_side',
    ''
);

$posts = crs_get_acf_field_repeater_post(
    'posts',
    []
);

if ($preview):
    ?>
    <img src="<?= $block['preview_image'] ?>" alt="">
<?php
else:
    ?>

    <div class="shared-card-container">
        <div class="shared-card">
            <div class="left">
                <div class="inner-content"><?= $leftSideContent ?></div>
            </div>
            <div class="right">
                <div class="inner-content">
                    <?php
                    foreach ($posts as $post) { ?>
                        <div class="first-date">
                            <div class="label"><?= get_the_date('d.m.Y', $post['post']) ?></div>
                            <div class="text">
                                <a href="<?php
                                echo $post['url']; ?>"><?php
                                    echo $post['title']; ?></a>
                            </div>
                        </div>
                        <?php
                    } ?>
                </div>
            </div>
        </div>
    </div>

<?php
endif;
