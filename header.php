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
    <header class="header-area">
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