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



    });
</script>
<script>
    (function($) { // Ensure jQuery is available and used within this scope

        /**
         * Function to execute when the filter is deemed "finished".
         * Place your custom code here.
         */
        function onElementorTaxonomyFilterFinish() {
            console.log('Elementor Taxonomy Filter has likely finished updating the content.');
            // --- Your custom code goes here ---
            // For example, you might want to:
            // - Reinitialize a custom script that depends on the filtered content
            // - Update UI elements
            // - Log analytics
            // - Re-run any third-party script that needs to operate on new DOM elements
            // --- End of your custom code ---
        }

        // Check if Elementor is loaded and ready
        $(window).on('elementor/frontend/init', function() {
            console.log('Elementor frontend initialized.');

            // Identify the container that holds the posts/content being filtered.
            // You will likely need to inspect your Elementor page to find the
            // correct selector for the container that gets updated after filtering.
            // Common selectors might be:
            // - '.elementor-posts-container'
            // - '.elementor-widget-posts'
            // - A custom class you've added to your posts widget
            const targetNode = document.querySelector('.elementor-posts-container'); // <<< ADJUST THIS SELECTOR

            if (!targetNode) {
                console.warn('Elementor Taxonomy Filter: Target container not found. Please adjust the `targetNode` selector.');
                return;
            }

            // Options for the MutationObserver (what to observe)
            const config = {
                childList: true, // Observe direct children additions/removals
                subtree: true, // Observe all descendants
                attributes: false, // Do not observe attribute changes
                characterData: false // Do not observe text content changes
            };

            // Callback function to execute when mutations are observed
            const callback = function(mutationsList, observer) {
                for (const mutation of mutationsList) {
                    if (mutation.type === 'childList') {
                        // Check if new nodes were added or existing ones removed.
                        // This often indicates content has been updated.
                        if (mutation.addedNodes.length > 0 || mutation.removedNodes.length > 0) {
                            // A small debounce might be useful here to prevent
                            // multiple calls during a rapid series of DOM changes.
                            // For simplicity, we'll call it directly for now.
                            onElementorTaxonomyFilterFinish();
                            // If you only want it to fire once per filter action,
                            // you might need more sophisticated logic, like checking
                            // if the filter button was clicked recently.
                        }
                    }
                }
            };

            // Create an instance of the MutationObserver
            const observer = new MutationObserver(callback);

            // Start observing the target node for configured mutations
            observer.observe(targetNode, config);

            console.log('Elementor Taxonomy Filter: MutationObserver started on:', targetNode);

            // Optional: If you know the specific filter element, you could also
            // listen for clicks on the filter buttons/links, and then perhaps
            // add a small delay before calling onElementorTaxonomyFilterFinish,
            // or wait for the observer to detect changes.
            // Example:
            // $('.elementor-filter-button').on('click', function() {
            //     console.log('Filter button clicked. Waiting for content update...');
            //     // You might want to set a flag here and clear it in the observer callback
            //     // to ensure your `onElementorTaxonomyFilterFinish` only runs once
            //     // per actual filter completion.
            // });
        });

    })(jQuery); // Pass jQuery to the immediately invoked function expression
</script>
<script>
    var WaveSurfer_TORS = [];
    jQuery(document).ready(function() {
        checkVisibility();

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

        /*
        jQuery('.recordings-filter .e-filter-item').click(function(e) {
            console.log('xxx');
            setTimeout(function() {
                initialize_wavesurfer();
            }, 2000);
        });*/
    });

    // Function to check if an element is visible in the viewport
    // This function takes a jQuery element as input.
    function isElementInViewport(el) {
        // Get the position of the element relative to the document
        var rect = el[0].getBoundingClientRect();

        // Get the viewport height
        var viewportHeight = (window.innerHeight || document.documentElement.clientHeight);

        // Check if the element is within the viewport vertically
        // The element is visible if its top edge is above the bottom of the viewport
        // AND its bottom edge is below the top of the viewport.
        return (
            rect.top <= viewportHeight && // Top of element is above or at the bottom of the viewport
            rect.bottom >= 0 // Bottom of element is below or at the top of the viewport
        );
    }

    // Function to handle the scroll event
    function checkVisibility() {
        // Iterate over each element with the class 'my-element'
        jQuery('.audio-box-holder').each(function() {
            var $this = jQuery(this); // Cache the jQuery object for the current element

            // Check if the current element is in the viewport
            if (isElementInViewport($this)) {
                // If visible, add the 'is-visible' class
                // This class can be used for styling or triggering animations

                if (!$this.hasClass('audio-loading') && !$this.hasClass('audio-ready')) {
                    $this.addClass('audio-loading');
                }

                $id = jQuery(this).find('.audio-box').attr('id');
                $audio_url = jQuery(this).attr('audio_url');

                if (!$this.hasClass('audio-ready')) {
                    wavesurfer($id, $audio_url);
                }
            }
        });
    }

    // Bind the checkVisibility function to the window's scroll event
    jQuery(window).on('scroll', checkVisibility);


    function formatTime(time) {
        const minutes = Math.floor(time / 60);
        const seconds = Math.floor(time % 60);
        return `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
    }

    function wavesurfer($id, $url, ) {
        if (!jQuery('#' + $id).parents('.audio-box-holder').hasClass('audio-loading')) {
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
                jQuery('#' + $id).parents('.audio-box-holder').addClass('audio-ready');
                jQuery('#' + $id).parents('.audio-box-holder').removeClass('audio-loading');
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