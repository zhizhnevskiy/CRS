<?php

function crs_get_sidebar(string $id)
{
    if (is_active_sidebar($id)) {
        dynamic_sidebar($id);
    }
}

add_action(
    'widgets_init',
    static function () {
        register_sidebar(
            [
                'id' => 'language_switcher',
                'name' => 'Language switcher',
                'description' => 'Sidebar for Polylang Language switcher',
                'class' => '',
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '',
                'after_title' => '',
            ]
        );

        register_sidebar(
            [
                'id' => 'footer_first_block',
                'name' => 'Footer First block',
                'description' => 'Sidebar for footer first block',
                'class' => '',
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '',
                'after_title' => ''
            ]
        );

        register_sidebar(
            [
                'id' => 'footer_second_block',
                'name' => 'Footer Second block',
                'description' => 'Sidebar for footer second block',
                'class' => '',
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '',
                'after_title' => ''
            ]
        );

        register_sidebar(
            [
                'id' => 'footer_last_text',
                'name' => 'Footer Last Text',
                'description' => 'Sidebar for footer Last text',
                'class' => '',
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '',
                'after_title' => ''
            ]
        );

        register_sidebar(
            [
                'id' => 'post_list_page',
                'name' => 'Page with list of posts',
                'description' => 'The page having all the posts on the site',
                'class' => '',
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '',
                'after_title' => ''
            ]
        );

        register_sidebar(
            [
                'id' => 'header_picture',
                'name' => 'Header picture',
                'description' => 'Sidebar for logo in header',
                'class' => '',
                'before_widget' => '',
                'after_widget' => '',
                'before_title' => '',
                'after_title' => ''
            ]
        );
    }
);