<?php

require_once __DIR__ . '/functions/blocks.php';
require_once __DIR__ . '/functions/sidebars.php';
require_once __DIR__ . '/functions/themes.php';
require_once __DIR__ . '/functions/acf_fields.php';
require_once __DIR__ . '/functions/classes/CRS_Menu_Walker.php';
require_once __DIR__ . '/functions/classes/PageSelectorWidget.php';

# function for delete classes from Gutentor plugin
function crs_page_with_heading_content()
{
    ob_start();
    the_content();

    $content = ob_get_clean();

    return preg_replace(
        [
            '/(wp-block-gutentor-[^\s]*\s*)|(section-gm[^\s]*)\s*/',
            '/gutentor(-[^\s"]*)*\s*/',
            '/grid-container\s*/',
        ],
        '',
        $content
    );
}

function crs_post_template_content_blocks(): array
{
    the_post();

    $blocksRaw = parse_blocks(get_the_content());

    $specialCoreBlocks = ['acf/crs-special-headline'];

    $blocks = [];
    foreach ($blocksRaw as $blockRaw) {
        $blockName = $blockRaw['blockName'];
        $blockHtml = trim(render_block($blockRaw));

        if ($blockName === 'core/shortcode') {
            $blockHtml = do_shortcode(trim($blockRaw['innerHTML']));
        }

        if (!empty($blockHtml)) {
            $blocks[] = [
                'name'    => $blockName,
                'content' => $blockHtml,
                'acf'     => strpos($blockName, 'acf/') === 0 && !in_array($blockName, $specialCoreBlocks, true),
                'core'    => strpos($blockName, 'core/') === 0 || in_array($blockName, $specialCoreBlocks, true),
            ];
        }
    }

    return $blocks;
}

function crs_article_template_content_blocks(): array
{
    $blocks = crs_post_template_content_blocks();

    $out = [
        'header' => [],
        'center' => [],
        'footer' => [],
    ];

    $count = count($blocks);

    for ($index = 0; $index !== $count; ++$index) {
        $block = $blocks[$index];

        if (!$block['acf']) {
            break;
        }

        $out['header'][] = $block;
    }

    for (; $index !== $count; ++$index) {
        $block = $blocks[$index];

        if ($block['acf']) {
            break;
        }

        $out['center'][] = $block;
    }

    for (; $index !== $count; ++$index) {
        $block = $blocks[$index];

        if (!$block['acf']) {
            break;
        }

        $out['footer'][] = $block;
    }

    return $out;
}

# function for get submenu
function crs_get_current_submenu(string $name, array $args = []): array
{
    global $post;

    $locations = get_nav_menu_locations() ?? [];

    if (empty($locations[$name])) {
        return [];
    }

    $menu_items = wp_get_nav_menu_items($locations[$name], $args);

    $currentMenuItem = null;

    foreach ($menu_items as $menu_item) {
        /** @noinspection TypeUnsafeComparisonInspection */
        if ($menu_item->object_id == $post->ID) {
            $currentMenuItem = $menu_item;
            break;
        }
    }

    if ($currentMenuItem === null) {
        return [];
    }

    $i = 0;
    /** @noinspection TypeUnsafeComparisonInspection */
    while ($currentMenuItem->menu_item_parent != 0) {
        ++$i;
        foreach ($menu_items as $menu_item) {
            /** @noinspection TypeUnsafeComparisonInspection */
            if ($menu_item->ID == $currentMenuItem->menu_item_parent) {
                $currentMenuItem = $menu_item;
                break;
            }
        }

        if ($i === 1000) {
            return [];
        }
    }

    return array_filter(
        $menu_items,
        static function (WP_Post $item) use ($currentMenuItem) {
            /** @noinspection TypeUnsafeComparisonInspection */
            return $item->menu_item_parent == $currentMenuItem->ID;
        }
    );
}
