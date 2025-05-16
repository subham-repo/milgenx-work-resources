<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Clubio
 */
?>
<div class="divider d-block d-md-none"></div>
<aside id="secondary" class="widget-area col-sm-12 col-md-4 col-lg-3 rightColumn">
    <?php
        if (clubio_sidebars('sb_blog01')) {
            echo clubio_sidebars('sb_blog01');
        } elseif (clubio_sidebars('default01')) {
            echo clubio_sidebars('default01');
        }
    ?>
</aside>
