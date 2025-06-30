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
                    jQuery(this).parents('.audio-player--parent').removeClass('before-active').addClass('after-active');
                    jQuery(this).parents('.audio-player--parent').find('.audio-box').addClass('active').removeClass('active');
                } else {
                    jQuery(this).parents('.audio-player--parent').addClass('before-active').removeClass('after-active');
                    jQuery(this).parents('.audio-player--parent').find('.audio-box').removeClass('active').addClass('active');

                }
                e.preventDefault();
            });
        });
    });
</script>
<script>
    if (jQuery('.audio-box').length > 0) {
        var WaveSurfer_TORS = [];

        jQuery(document).ready(function() {
            jQuery('.audio-box-holder').each(function(index, element) {
                $id = jQuery(this).find('.audio-box').attr('id');
                $audio_url = jQuery(this).attr('audio_url');
                wavesurfer($id, $audio_url);
            });

            jQuery('.play-pause-btn').each(function(index, element) {
                var $target = jQuery(this).attr('target');
                jQuery(this).click(function(e) {
                    $target_val = 'audio-' + $target;
                    WaveSurfer_TORS[$target_val].playPause();
                    jQuery(this).parents('.audio-player--player').toggleClass('playing');
                    e.preventDefault();
                });
            });

            jQuery('.show-all-song').click(function(e) {
                if (jQuery(this).parents('.artist-songs--holder').hasClass('show-all')) {
                    jQuery(this).text('Show All');
                    jQuery(this).parents('.artist-songs--holder').removeClass('show-all');
                } else {
                    jQuery(this).text('Show Less');
                    jQuery(this).parents('.artist-songs--holder').addClass('show-all');
                }

                e.preventDefault();
            });
        });

        function formatTime(time) {
            const minutes = Math.floor(time / 60);
            const seconds = Math.floor(time % 60);
            return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        }

        function wavesurfer($id, $url, ) {
            // With pre-decoded audio data

            WaveSurfer_TORS[$id] = WaveSurfer.create({
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
            });

            WaveSurfer_TORS[$id].on('interaction', () => {
                WaveSurfer_TORS[$id].play();
                jQuery('#' + $id).parents('.audio-player--player').addClass('playing');
            });

            WaveSurfer_TORS[$id].on('finish', () => {
                WaveSurfer_TORS[$id].setTime(0);
                jQuery('#' + $id).parents('.audio-player--player').removeClass('playing');

            });
            WaveSurfer_TORS[$id].on('ready', function() {
                var $duration = '#' + $id + '-duration';
                const $totalTime = WaveSurfer_TORS[$id].getDuration();
                jQuery($duration).text(formatTime($totalTime));
            });

            WaveSurfer_TORS[$id].on('audioprocess', function() {
                if (WaveSurfer_TORS[$id].isPlaying()) {
                    var $current_time = '#' + $id + '-current-time';
                    const $currentTime = WaveSurfer_TORS[$id].getCurrentTime();
                    jQuery($current_time).text(formatTime($currentTime));

                }
            });
            return WaveSurfer_TORS[$id];

        }
    }
</script>