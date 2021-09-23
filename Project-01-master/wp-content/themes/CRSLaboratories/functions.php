<?php
/**
 * Functions and definitions
 */

// add styles
add_action('wp_enqueue_scripts', 'enqueue_styles');
function enqueue_styles()
{
    wp_enqueue_style(
        'whitesquare-style',
        get_stylesheet_uri()
    );
    wp_enqueue_style(
        'body',
        '/wp-content/themes/CRSLaboratories/assets/css/body.css'
    );
    wp_enqueue_style(
        'footer',
        '/wp-content/themes/CRSLaboratories/assets/css/footer.css'
    );
    wp_enqueue_style(
        'gutenberg',
        '/wp-content/themes/CRSLaboratories/assets/css/gutenberg.css'
    );
    wp_enqueue_style(
        'header',
        '/wp-content/themes/CRSLaboratories/assets/css/header.css'
    );
    wp_enqueue_style(
        'page',
        '/wp-content/themes/CRSLaboratories/assets/css/page.css'
    );
    wp_enqueue_style(
        'sidebar',
        '/wp-content/themes/CRSLaboratories/assets/css/sidebar.css'
    );
    wp_enqueue_style(
        'single',
        '/wp-content/themes/CRSLaboratories/assets/css/single.css'
    );
}

// add scripts
add_action('wp_enqueue_scripts', 'enqueue_scripts');
function enqueue_scripts()
{
    wp_register_script('html5-shim', 'http://html5shim.googlecode.com/svn/trunk/html5.js');
    wp_enqueue_script('html5-shim');
    wp_enqueue_script('jquery');
}

// add menus
add_theme_support('menus');

// Registering Menu Display Areas
add_action('init', 'add_Main_Nav');

function add_Main_Nav()
{
    register_nav_menus(
        array( // id area => area name
            'header_menu' => 'Header menu',
            'page_menu' => 'Page menu'
        )
    );
}

// add sidebar
add_action('widgets_init', 'add_widget_Support');

function add_widget_Support()
{
    register_sidebar(
        array(
            'name' => 'Sidebar',
            'id' => 'sidebar',
            'before_widget' => '<div>',
            'after_widget' => '</div>',
            'before_title' => '<h4>',
            'after_title' => '</h4>',
        )
    );
}

//add template
add_filter('template_include', 'my_template');

function my_template($template)
{
    if (is_page('etusivu')) {
        if ($new_template = locate_template(array('/template-parts/page/page-etusivu.php'))) {
            return $new_template;
        }
    }

    return $template;
}

// add acf block
add_action('acf/init', 'my_acf_init');
function my_acf_init()
{
    // check function exists
    if (function_exists('acf_register_block')) {
        // register a testimonial block
        acf_register_block(
            array(
                'name' => 'testimonial',
                'title' => __('Testimonial'),
                'description' => __('A custom testimonial block.'),
                'render_callback' => 'my_acf_block_render_callback',
                'category' => 'formatting',
                'icon' => 'admin-comments',
                'keywords' => array('testimonial', 'quote'),
            )
        );
    }
}

function my_acf_block_render_callback($block)
{
    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/', '', $block['name']);

    // include a template part from within the "template-parts/block" folder
    if (file_exists(get_theme_file_path("/template-parts/block/content-{$slug}.php"))) {
        include(get_theme_file_path("/template-parts/block/content-{$slug}.php"));
    }
}

// add header menu
$menu_name = 'header_menu';
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object($locations[$menu_name]);
$menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));
?>

<ul class="nav-list">
    <?php
    $count = 0;
    $submenu = false;

    foreach ($menuitems as $item):
        $link = $item->url;
        $title = $item->title;

        if (!$item->menu_item_parent):
            $parent_id = $item->ID;
            ?>
            <li class="nav-list-item with-hidden-list">
            <a href="<?php
            echo $link; ?>" class="nav-link"><?php
                echo $title;
                if ($parent_id == $item->menu_item_parent):?>
                    <i class="fas fa-caret-down"></i>
                <?php
                endif;
                if (!$submenu):?>
                    <i></i>
                <?php
                endif; ?>
            </a>
            <!--                     верхний пункт меню -->
        <?php
        endif; ?>

        <?php
        if ($parent_id == $item->menu_item_parent): ?>

            <?php
            if (!$submenu): $submenu = true; ?>
                <ul class="hidden-list">
                <!--                    выпадающее меню -->
            <?php
            endif; ?>
            <li class="hidden-list-item">
                <a href="<?php
                echo $link; ?>"><?php
                    echo $title; ?></a>
            </li>
            <?php
            if ($menuitems[$count + 1]->menu_item_parent != $parent_id && $submenu): ?>
                </ul>

                <?php
                $submenu = false; endif; ?>

        <?php
        endif; ?>

        <?php
        if (($count + 1 < count($menuitems)) && ($menuitems[$count + 1]->menu_item_parent != $parent_id)) : ?>
            </li>

            <?php
            $submenu = false; endif; ?>

        <?php
        $count++; endforeach; ?>
</ul>