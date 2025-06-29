<?php $moroko_redux_demo = get_option('redux_demo'); ?>
<!-- Footer Area Start 
    ====================================================== -->
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
<?php
$args = array(
    'post_type'      => 'recordings',
    'posts_per_page' => -1,
);
$query = new WP_Query($args);
?>
<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiperRecordings", {
        slidesPerView: 3,
        spaceBetween: 30,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
        },
    });
</script>
<script>
    jQuery(document).ready(function() {
        jQuery('.switch-input').each(function(index, element) {
            jQuery(this).change(function(e) {
                if (jQuery(this).is(":checked")) {
                    jQuery(this).parents('.audio-box-wrapper').removeClass('before-active').addClass('after-active');
                    jQuery(this).parents('.audio-box-wrapper').find('.audio-box').addClass('active').removeClass('active');
                } else {
                    jQuery(this).parents('.audio-box-wrapper').addClass('before-active').removeClass('after-active');
                    jQuery(this).parents('.audio-box-wrapper').find('.audio-box').removeClass('active').addClass('active');

                }
                e.preventDefault();
            });
        });
    });
</script>
<script>
    if (jQuery('.audio-box').length > 0) {
        <?php
        while ($query->have_posts()) {
            $query->the_post();
            $before_audio = carbon_get_the_post_meta('before_audio');
            $after_audio = carbon_get_the_post_meta('after_audio');

            if ($before_audio) {
        ?>
                $id = 'before-audio-<?= get_the_ID() ?>';
                $before_audio_url = '<?= wp_get_attachment_url($before_audio); ?>';
                wavesurfer($id, $before_audio_url);
            <?php
            }
            if ($after_audio) {
            ?>
                $id = 'after-audio-<?= get_the_ID() ?>';
                $after_audio_url = '<?= wp_get_attachment_url($after_audio); ?>';
                wavesurfer($id, $after_audio_url);
        <?php
            }
        }
        wp_reset_postdata();
        ?>

        function wavesurfer($id, $url) {
            // With pre-decoded audio data
            var $id_val = $id;
            console.log($id_val);
            const playBTN = document.querySelector('.play-before-audio-' + $id);
            const WaveSurfer_TORS = WaveSurfer.create({
                "container": document.getElementById($id),
                "height": 50,
                "splitChannels": false,
                "normalize": true,
                "waveColor": "#fff",
                "progressColor": "#FECD55",
                "cursorColor": "#ddd5e9",
                "cursorWidth": 4,
                "barWidth": 4,
                "barGap": 3,
                "barRadius": 50,
                "barHeight": null,
                "minPxPerSec": 1,
                "fillParent": true,
                "url": $url,
                "autoplay": false,
                "interact": true,
                "hideScrollbar": false,
                "audioRate": 1,
                "autoScroll": true,
                "autoCenter": true,
                "sampleRate": 8000
            })

            WaveSurfer_TORS.on('interaction', () => {
                wavesurfer.play();
            });

            WaveSurfer_TORS.on('finish', () => {
                wavesurfer.setTime(0);
            });


            playBTN.addEventListener('click', () => {
                WaveSurfer_TORS.play();
            });

        }
    }
</script>