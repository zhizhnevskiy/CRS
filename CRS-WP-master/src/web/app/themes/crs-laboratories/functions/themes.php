<?php

// add menus
add_theme_support('menus');

// Registering Menu Display Areas
add_action(
    'init',
    static function () {
        register_nav_menus(
            [ // id area => area name
                'header_menu' => 'Header menu',
                'page_menu' => 'Page menu',
            ]
        );
    }
);

// add styles
add_action(
    'wp_enqueue_scripts',
    static function () {
        wp_enqueue_style(
            'crs-common-css',
            get_stylesheet_directory_uri() . '/assets/css/common.css'
        );
        wp_enqueue_style(
            'crs-contact-page-css',
            get_stylesheet_directory_uri() . '/assets/css/contact-page/contact-page.css'
        );
        wp_enqueue_style(
            'crs-main-page-css',
            get_stylesheet_directory_uri() . '/assets/css/main-page/main-page.css'
        );
        wp_enqueue_style(
            'crs-post-page-css',
            get_stylesheet_directory_uri() . '/assets/css/post-page/post-page.css'
        );
        wp_enqueue_style(
            'crs-service-details-page-css',
            get_stylesheet_directory_uri() . '/assets/css/service-details-page/service-details-page.css'
        );
        wp_enqueue_style(
            'crs-services-page-css',
            get_stylesheet_directory_uri() . '/assets/css/services-page/services-page.css'
        );
        wp_enqueue_style(
            'crs-override-css',
            get_stylesheet_directory_uri() . '/assets/css/override.css'
        );
    }
);

// add styles for gutenberg
add_action(
    'after_setup_theme',
    static function () {
        add_theme_support('editor-styles'); // !!!
        add_editor_style('style-editor.css');
    }
);

// add scripts
add_action(
    'wp_enqueue_scripts',
    static function () {
        wp_register_script(
            'header-scripts-js',
            get_stylesheet_directory_uri() . '/assets/js/header.script.css'
        );
    }
);

# add SVG file
add_filter(
    'upload_mimes',
    static function ($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
);

add_filter(
    'wp_check_filetype_and_ext',
    static function ($data, $file, $filename, $mimes, $real_mime = '') {
        // WP 5.1 +
        if (version_compare($GLOBALS['wp_version'], '5.1.0', '>=')) {
            $dosvg = in_array($real_mime, ['image/svg', 'image/svg+xml']);
        } else {
            $dosvg = ('.svg' === strtolower(substr($filename, -4)));
        }
        // mime type has been reset, let's fix it
        // and also check the user rights
        if ($dosvg) {
            // let's resolve
            if (current_user_can('manage_options')) {
                $data['ext'] = 'svg';
                $data['type'] = 'image/svg+xml';
            } // ban
            else {
                $data['ext'] = $type_and_ext['type'] = false;
            }
        }
        return $data;
    },
    10,
    5
);