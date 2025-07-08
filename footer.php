<?php $moroko_redux_demo = get_option('redux_demo'); ?>
<!-- Footer Area Start 
    ====================================================== -->
<?= do_shortcode('[elementor-template id="3621"]') ?>
<footer class="footer-area">
    <!-- Start:Footer Main Contents-->
    <div class="footer-contents">
        <!-- Start:Footer Top Content Area (Supporters) -->
        <div class="footer-top-sec">
            <div class="container large-container">
                <?php if (is_active_sidebar('footer-area-1')): ?>
                    <?php dynamic_sidebar('footer-area-1'); ?>
                <?php endif; ?>
            </div>
        </div>
        <!-- End:Footer Top Content Area (Supporters) -->
        <!-- Start:Footer Bottom Content Area  -->
        <div class="footer-middle-sec">
            <div class="container">
                <div class="row">
                    <!-- Start:Logo Sec-->
                    <?php
                    $i = 0;
                    if (is_active_sidebar('footer-area-2')) {
                        $i++;
                    }
                    if (is_active_sidebar('footer-area-3')) {
                        $i++;
                    }
                    if (is_active_sidebar('footer-area-4')) {
                        $i++;
                    }
                    if (is_active_sidebar('footer-area-5')) {
                        $i++;
                    }
                    ?>
                    <?php if (is_active_sidebar('footer-area-2')): ?>
                        <div class="<?= $i > 3 ? 'col-md-3' : 'col-md-4' ?> ">
                            <div class="logo">
                                <?php dynamic_sidebar('footer-area-2'); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Start:Logo Sec -->
                    <!-- Start:Quick Links -->
                    <?php if (is_active_sidebar('footer-area-3')): ?>
                        <div class="<?= $i > 3 ? 'col-md-3' : 'col-md-4' ?> ">
                            <?php dynamic_sidebar('footer-area-3'); ?>
                        </div>
                    <?php endif; ?>

                    <!-- End:Quick Links -->
                    <!-- Start:News Letter Area -->
                    <?php if (is_active_sidebar('footer-area-4')): ?>
                        <div class="<?= $i > 3 ? 'col-md-3' : 'col-md-4' ?> ">
                            <?php dynamic_sidebar('footer-area-4'); ?>
                        </div>
                    <?php endif; ?>
                    <!-- Start:News Letter Area -->
                    <?php if (is_active_sidebar('footer-area-5')): ?>
                        <!-- Start:Social Icon Area -->
                        <div class="class=" <?= $i > 3 ? 'col-md-3' : 'col-md-4' ?> ">
                                                                <div class=" social-icon">
                            <?php dynamic_sidebar('footer-area-5'); ?>
                        </div>
                </div>
            <?php endif; ?>
            <!-- End:Social Icon Area -->
            </div>
        </div>
    </div>
    <!-- End:Footer Bottom Content Area -->
    </div>
    <!-- Start:Footer Main Contents-->
    <!-- Start:Copyright Area -->
    <div class="copyright">
        <div class="container">
            <p><?php if (isset($moroko_redux_demo['footer_text'])) { ?>
                    <?php echo htmlspecialchars_decode(esc_attr($moroko_redux_demo['footer_text'])); ?>
                <?php } else { ?>
                <?php echo esc_html__('2022 © Moroko. All rights reserved.', 'moroko');
                } ?></p>
        </div>
    </div>
    <!-- End:Copyright Area -->
</footer>
<!-- =================================================
    Footer Area End -->
<?php wp_footer(); ?>
</body>

</html>