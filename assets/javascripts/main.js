var WaveSurfer_TORS = [];
jQuery(document).ready(function () {
    Fancybox.bind("[data-fancybox]", {
        Carousel: {
            Video: {
                autoplay: true,
            },
        },
    });

    checkVisibility();

    jQuery(document).on('change', '.switch-input', function (e) {
        if (jQuery(this).is(":checked")) {
            jQuery(this).parents('.audio-player--parent').removeClass('before-active').addClass('after-active');
            jQuery(this).parents('.audio-player--parent').find('.audio-box').addClass('active').removeClass('active');

            $target = jQuery(this).parents('.artist-songs--box--js').find('.audio-after .play').attr('target');
            $parent = jQuery(this).parents('.artist-songs--box--js').find('.artist-songs--body');

            play_song($target, $parent);
        } else {
            jQuery(this).parents('.audio-player--parent').addClass('before-active').removeClass('after-active');
            jQuery(this).parents('.audio-player--parent').find('.audio-box').removeClass('active').addClass('active');

            $target = jQuery(this).parents('.artist-songs--box--js').find('.audio-before .play').attr('target');
            $parent = jQuery(this).parents('.artist-songs--box--js').find('.artist-songs--body');
            play_song($target, $parent);
        }
        e.preventDefault();
    });



    jQuery(document).on('click', '.play-pause-btn.play', function (e) {
        $target = jQuery(this).attr('target');
        $parent = jQuery(this).parents('.artist-songs--body');
        play_song($target, $parent);
        e.preventDefault();
    });

    jQuery(document).on('click', '.play-pause-btn.pause', function (e) {
        $target = jQuery(this).attr('target');
        $parent = jQuery(this).parents('.artist-songs--body');
        pause_song($target, $parent);
        e.preventDefault();
    });




    jQuery('.show-all-song').click(function (e) {
        if (jQuery(this).parents('.artist-songs--holder').hasClass('show-all')) {
            jQuery(this).text('Show All');
            jQuery(this).parents('.artist-songs--holder').removeClass('show-all');
        } else {
            jQuery(this).text('Show Less');
            jQuery(this).parents('.artist-songs--holder').addClass('show-all');
        }
        e.preventDefault();
    });

    jQuery(document).on('click', '.recordings-filter .e-filter-item', function (e) {
        setTimeout(function () {
            checkVisibility();
        }, 3000);
    });

    jQuery('a.has-submenu').click(function (e) {
        jQuery(this).toggleClass('submenu--active');
        e.preventDefault();
    });


    $container_margin = jQuery('.header-area .container').css('margin-left');
    jQuery('body').css('--container-margin', $container_margin);

});

function play_song($target, $parent) {
    $target_val = 'audio-' + $target;
    console.log($target_val);
    play_wavesurfer($target_val);
    $parent.addClass('playing');
}

function pause_song($target, $parent) {
    $target_val = 'audio-' + $target;
    WaveSurfer_TORS[$target_val].pause();
    $parent.removeClass('playing');
}

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
    jQuery('.audio-box-holder:not(.audio-loading)').each(function () {
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

function wavesurfer($id, $url,) {
    if (window.innerWidth > 767) {
        $height = 50;
    } else {
        $height = 30;
    }
    WaveSurfer_TORS[$id] = WaveSurfer.create({
        "container": document.getElementById($id),
        "height": $height,
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
        play_wavesurfer($id);
    });

    WaveSurfer_TORS[$id].on('finish', () => {
        WaveSurfer_TORS[$id].setTime(0);
        jQuery('#' + $id).parents('.artist-songs--body').removeClass('playing');

    });
    WaveSurfer_TORS[$id].on('ready', function () {
        var $duration = '#' + $id + '-duration';
        const $totalTime = WaveSurfer_TORS[$id].getDuration();
        jQuery($duration).text(formatTime($totalTime));
        jQuery('#' + $id).parents('.audio-box-holder').addClass('audio-ready');
        jQuery('#' + $id).parents('.audio-box-holder').removeClass('audio-loading');
        setTimeout(function () {
            jQuery('#' + $id).parents('.audio-box-holder').addClass('display-audio');
        }, 1000);
    });

    WaveSurfer_TORS[$id].on('audioprocess', function () {
        if (WaveSurfer_TORS[$id].isPlaying()) {
            var $current_time = '#' + $id + '-current-time';
            const $currentTime = WaveSurfer_TORS[$id].getCurrentTime();
            jQuery($current_time).text(formatTime($currentTime));
        }
    });
    return WaveSurfer_TORS[$id];
}

function play_wavesurfer($id) {
    for (let key in WaveSurfer_TORS) {
        if (key !== $id && WaveSurfer_TORS[key].isPlaying()) {
            WaveSurfer_TORS[key].pause();
            // Optionally, remove the 'playing' class from other players
            jQuery('#' + key).parents('.artist-songs--body').removeClass('playing');
        }
    }
    WaveSurfer_TORS[$id].play();
    jQuery('#' + $id).parents('.artist-songs--body').addClass('playing');
}


function pause_all_wavesurfer() {
    for (let key in WaveSurfer_TORS) {
        WaveSurfer_TORS[key].pause();
        // Optionally, remove the 'playing' class from other players
        jQuery('#' + key).parents('.artist-songs--body').removeClass('playing');
    }
}