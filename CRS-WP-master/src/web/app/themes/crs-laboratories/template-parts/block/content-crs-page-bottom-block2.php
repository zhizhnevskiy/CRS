<?php

$preview = crs_get_acf_field(
    'is_preview',
    false
);

$header = crs_get_acf_field(
    'header',
    ''
);

$buttons = crs_get_acf_field('buttons', []);

if (empty($buttons)) {
    $buttons = array_map(
        static function ($item) {
            $post_id = get_post((int)$item->object_id);

            return [
                'button' => [
                    'url' => get_permalink($post_id),
                    'title' => $item->title,
                ],
            ];
        },
        crs_get_current_submenu('header_menu')
    );
}

if ($preview):
    ?>
    <img src="<?= $block['preview_image'] ?>" alt="">
<?php
else:
    ?>
    <div class="separator-bottom"></div>
    <div class="additional-services">
        <div class="title"><?= $header ?></div>
        <div class="links">
            <?php
            foreach ($buttons as $value) { ?>
                <button class="link-item f-24">
                    <a href="<?= $value['button']['url'] ?>"><?= $value['button']['title'] ?></a>
                </button>
                <?php
            } ?>
        </div>
    </div>

<?php
endif;