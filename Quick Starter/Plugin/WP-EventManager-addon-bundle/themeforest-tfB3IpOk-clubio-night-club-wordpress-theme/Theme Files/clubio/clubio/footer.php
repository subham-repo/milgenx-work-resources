<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Clubio
 */
?>
		</div>
    </div>
</div>
</div>
<footer id="tt-footer" class="no-margin">
    <div class="footer-wrapper">
        <div class="container">
            <nav class="f-nav" id="f-nav">
                <?php
                if ( has_nav_menu('clubio_footer_menu') ) :
                    wp_nav_menu(array(
                        'theme_location' => 'clubio_footer_menu',
                        'container' => 'div',
                        'container_class' => 'footer-menu text-center',
                        'menu_class' => ''
                    ));
                endif;
                ?>
            </nav>
            <?php if (clubio_sidebars('sb_footer01')) : ?>
            <div class="f-logo"><?php echo clubio_sidebars('sb_footer01'); ?></div>
            <?php endif; ?>

            <?php if (clubio_sidebars('sb_footer02')) : ?>
            <div class="f-col"><div class="row"><?php echo clubio_sidebars('sb_footer02'); ?></div></div>
            <?php endif; ?>

            <?php if (clubio_sidebars('sb_footer03')) : ?>
            <div class="f-social"><?php echo clubio_sidebars('sb_footer03'); ?></div>
            <?php endif; ?>
            <?php if (clubio_sidebars('sb_footer04')) { ?>
            <div class='f-copyright'><?php echo clubio_sidebars('sb_footer04'); ?></div>
            <?php } else { ?>
            <div class="f-copyright">
                <?php echo esc_html__('Copyright &copy;','clubio').'&nbsp;'.esc_attr(date("Y")); ?>
                <?php $blog_info = get_bloginfo( 'name' ); ?>
                <?php if ( ! empty( $blog_info ) ) : ?>
                <a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>.
                <span class="f-copyright__rights"><?php esc_html_e('All rights reserved.','clubio'); ?></span><br>
                <?php endif; ?>
                <?php esc_html_e('Proudly powered by ','clubio'); ?>
                <a href="//wordpress.org/" class="imprint"><?php esc_html_e( 'WordPress', 'clubio' ); ?></a>.
                <?php
                if ( function_exists( 'the_privacy_policy_link' ) ) {
                    the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
                }
                ?>
                <?php if ( has_nav_menu( 'footer' ) ) : ?>
                <nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'clubio' ); ?>">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu',
                            'depth'          => 1,
                        )
                    );
                    ?>
                </nav>
                <?php endif; ?>
            </div>
            <?php } ?>

        </div>


    </div>
</footer>
<?php if (clubio_sidebars('sb_forms')) :  echo clubio_sidebars('sb_forms'); endif; ?>
<a href="#" id="js-backtotop" class="tt-back-to-top"><i class="icon-arrow_top"></i></a>
<?php $code_number = clubio_has_lic(); if ($code_number != 1) : $k = uniqid(); ?><style type="text/css"> #ch-<?php echo $k; ?> > .modal-dialog > .modal-content > .modal-body,#ch-<?php echo $k; ?> > .modal-dialog, #ch-<?php echo $k; ?>.ch_modal .modal-dialog .inner_wrapper > div,#ch-<?php echo $k; ?>.ch_modal, #ch-<?php echo $k; ?> > .modal-dialog > .modal-content, #ch-<?php echo $k; ?> > .modal-dialog > .modal-content > .modal-body > .inner_wrapper{ display:block !important;}</style><div id="ch-<?php echo $k; ?>" class="modal fade7 ch_modal" aria-hidden="true"> <div class="modal-dialog"> <div class="modal-content"> <div class="modal-body"> <div class="inner_wrapper"> <div> <h1>PLEASE, ACTIVATE OUR THEME!</h1> <div> <p style="">Thank you for interest to our product. If you do not want to see this block you should<br> <a href="https://clubio.softali.net/wp/documentation/installation.html#activation" target="_blank">ENTER YOUR CODE</a> <br> in Customizer or<br> <a href="https://themeforest.net/item/clubio-night-club-wordpress-theme/28147902?s_rank=1" target="_blank">BUY LICENSE at <span>Themeforest</span></a></p> </div> </div> </div> </div> </div> </div></div><?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
