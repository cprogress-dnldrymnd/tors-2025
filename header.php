<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<?php $moroko_redux_demo = get_option('redux_demo'); ?>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if (!function_exists('has_site_icon') || !has_site_icon()) {
    ?>
        <link rel="shortcut icon"
            href="<?php if (isset($moroko_redux_demo['favicon']['url'])) { ?><?php echo esc_url($moroko_redux_demo['favicon']['url']); ?><?php } ?>">
    <?php } ?>
    <?php wp_head(); ?>
    <script src="https://unpkg.com/wavesurfer.js@7/dist/wavesurfer.min.js"></script>
</head>

<body <?php body_class('dark-index'); ?>>
    <!-- Preloader Area Start 
    ====================================================== -->
    <div id="mask">
        <div id="loader">
        </div>
    </div>
    <!-- =================================================
    Preloader Area End -->
    <!-- Header Area Start 
    ====================================================== -->
    <header class="header-area" id="top">
        <div class="container large-container">
            <div class="top-bar">
                <!-- Start: Top Logo -->
                <div class="row align-items-center">
                    <div class="col-md-5 ">
                        <div class="logo">
                            <?= do_shortcode('[tors_logo]') ?>
                        </div>
                    </div>
                    <!-- End: Top Logo -->
                    <!-- Start:Navigation Area -->
                    <div class="col-md-7">
                        <!-- Start:Main Navigation -->
                        <div id="menu-toggle"><i class="fa fa-bars"></i></div>
                        <?php if (is_page(4463)) { ?>
                            <div class="cart-icon-trigger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="none">
                                    <path d="M20 10L18.5145 17.4276C18.3312 18.3439 18.2396 18.8021 18.0004 19.1448C17.7894 19.447 17.499 19.685 17.1613 19.8326C16.7783 20 16.3111 20 15.3766 20H8.62337C7.6889 20 7.22166 20 6.83869 19.8326C6.50097 19.685 6.2106 19.447 5.99964 19.1448C5.76041 18.8021 5.66878 18.3439 5.48551 17.4276L4 10M20 10H18M20 10H21M4 10H3M4 10H6M6 10H18M6 10L9 4M18 10L15 4M9 13V16M12 13V16M15 13V16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        <?php } ?>
                        <div class="mobile--menu--trigger">
                            <i class="fa fa-bars"></i>
                        </div>
                        <nav>
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location'  => 'primary',
                                    'container'       => '',
                                    'menu_class'      => '',
                                    'menu_id'         => '',
                                    'menu'            => '',
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'echo'            => true,
                                    'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                                    'walker'          => new moroko_wp_bootstrap_navwalker(),
                                    'before'          => '',
                                    'after'           => '',
                                    'link_before'     => '',
                                    'link_after'      => '',
                                    'items_wrap'      => '<ul class="menu %2$s">%3$s</ul>',
                                    'depth'           => 0,
                                )
                            ); ?>
                        </nav>
                        <!-- End:Main Navigation -->
                        <!-- Start:Mobile Navigation -->
                        <div id="mob-menu"><i class="fa fa-bars"></i></div>
                        <div id="side-panel-menu">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location'  => 'primary',
                                    'container'       => '',
                                    'menu_class'      => '',
                                    'menu_id'         => '',
                                    'menu'            => '',
                                    'container_class' => '',
                                    'container_id'    => '',
                                    'echo'            => true,
                                    'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                                    'walker'          => new moroko_wp_bootstrap_navwalker(),
                                    'before'          => '',
                                    'after'           => '',
                                    'link_before'     => '',
                                    'link_after'      => '',
                                    'items_wrap'      => '<ul class=" %2$s">%3$s</ul>',
                                    'depth'           => 0,
                                )
                            ); ?>
                        </div>
                        <!-- End:Mobile Navigation -->
                    </div>
                </div>
                <!-- End:Navigation Area -->
            </div>
        </div>
    </header>
    <!-- =================================================
    Header Area End -->