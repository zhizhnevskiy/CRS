<?php
/**
 * The template for displaying the footer
 * Contains the closing of the #content div and all content after.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<footer id="footer">

    <div class="footer-info">

        <div class="footer-links">

            <ul class="contact-links">
                <?php
                crs_get_sidebar('footer_first_block'); ?>
            </ul>

            <ul class="address-info">
                <?php
                crs_get_sidebar('footer_second_block'); ?>
            </ul>

        </div>

        <div class="partners">
            <img src="<?php
            echo get_stylesheet_directory_uri(); ?>/assets/svg/main-page/platina.jfif" class="platina"/>
            <img src="<?php
            echo get_stylesheet_directory_uri(); ?>/assets/svg/main-page/vipauvoimaa.png" class="vipauvoimaa"/>
            <img src="<?php
            echo get_stylesheet_directory_uri(); ?>/assets/svg/main-page/euroopan.png" class="euroopan"/>
        </div>
    </div>

    <div class="copyright">
        <?php
        crs_get_sidebar('footer_last_text'); ?>
    </div>

</footer>

<div class="side-img">
    <img src="<?php
    echo get_stylesheet_directory_uri(); ?>/assets/svg/main-page/side-img.svg" alt="side-img"/>
</div>

<script src="<?php
echo get_stylesheet_directory_uri(); ?>/assets/js/header.script.js"></script>

<?php
wp_footer(); ?>
</body>
</html>
