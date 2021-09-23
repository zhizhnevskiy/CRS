<?php
/**
 * The header.
 * This is the template that displays all of the <head> section and everything up until main.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<!DOCTYPE html>
<html <?php
language_attributes(); ?> class="no-js no-svg">
<head>

    <meta charset="<?php
    bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.gstatic.com"/>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link rel="stylesheet" href="https://use.typekit.net/hac8kgr.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f80253c461.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title>
        <?php
        bloginfo('name'); ?> &raquo; <?php
        is_front_page() ? bloginfo('description') : wp_title(''); ?>
    </title>
    <?php
    wp_head(); ?>
</head>

<body <?php
body_class(); ?>>

<?php
wp_body_open(); ?>

<header id="header" class="header">
    <div class="header-width">

        <div class="logo-container">
            <?php  crs_get_sidebar('header_picture'); ?>
        </div>

        <nav class="header-nav">

            <div class="lang-picker-container">
                <?php  crs_get_sidebar('language_switcher'); ?>
            </div>

            <div class="burger-menu">
                <div class="lines">
                    <span class="line"></span>
                </div>
            </div>

            <?php
            // add head menu
            wp_nav_menu(
                [
                    'theme_location' => 'header_menu',
                    'container' => false,
                    'menu_class' => 'nav-list',
                    'echo' => true,
                    'walker' => new CRS_Menu_Walker(),
                ]
            ); ?>

        </nav>

    </div>
</header>

<div class="header-overlay"></div>
