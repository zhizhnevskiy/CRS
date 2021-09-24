<?php
/**
 * The sidebar containing the main widget area.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if (is_active_sidebar('sidebar')) : ?>

    <?php
    dynamic_sidebar('sidebar'); ?>

<?php
endif;