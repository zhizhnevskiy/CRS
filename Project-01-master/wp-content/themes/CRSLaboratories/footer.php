<?php
/**
 * The template for displaying the footer
 * Contains the closing of the #content div and all content after.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<footer class="footer">

    <?php echo do_shortcode('[Sassy_Social_Share]'); ?>

    <hr class="footer-line">

    <section class="footer_section">

        <article class="footer_article">
            <p>
                <b>CRS Laboratories Oy</b><br>
                Y-tunnus: 0971958-0<br>
                <a class="a" href="">Tietosuojalauseke</a>
            </p>
        </article>

        <article class="footer_article">
            <p>
                Näytelistojen ja lähetteiden toimitus: <a class="a" href="">samples@crs.fi</a><br>
                Näytteiden vastaanotto: ovi P8<br>
                Käyntiosoite: Takatie 6, 90440 Kempele
            </p>
        </article>

        <article class="footer_article">
            <div class="footer_div">
                <img class="footer_img_1"
                     src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/footer/Screenshot%20from%202021-03-26%2010-09-41.png"
                     alt="logo">
                <img class="footer_img_2"
                     src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/footer/vipuvoima-300x197.png"
                     alt="logo">
                <img class="footer_img_3"
                     src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/footer/aluekehitysrahasto-300x280.png"
                     alt="logo">
            </div>
        </article>

    </section>

    <hr class="footer-line">

    <p class="footer-copyright">Copyright © <?php echo date('Y') ?> CRS Laboratories. All Rights Reserved.</p>

</footer>

<?php wp_footer(); ?>

</body>

</html>