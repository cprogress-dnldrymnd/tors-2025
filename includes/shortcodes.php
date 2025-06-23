<?php

function tors_logo()
{
  ob_start();
  get_template_part('template-parts/shortcodes/tors_logo');
  return ob_get_clean();
}

add_shortcode('tors_logo', 'tors_logo');

function get_a_quote_form()
{
  ob_start();
  get_template_part('template-parts/shortcodes/get_a_quote_form');
  return ob_get_clean();
}

add_shortcode('get_a_quote_form', 'get_a_quote_form');


function our_artists() {
  ob_start();
  get_template_part('template-parts/shortcodes/our_artists');
  return ob_get_clean();
}


add_shortcode( 'our_artists', 'our_artists' );


function post_content() {
	return wpautop(get_the_content());
}

add_shortcode( 'post_content', 'post_content' );

function audio_box( $atts ) {
	ob_start();
	extract(
		shortcode_atts(
			array(
				'audio_type' => '',
			),
			$atts
		)
	);
	$audio = carbon_get_the_post_meta($audio_type .'_audio');
	  if ($audio) {
		  if($audio_type=='before') {
			  $class = 'active';
		  } else {
			  $class = '';
		  }
		  ?>
			<div class="audio-box-holder d-flex align-items-center audio-<?= $audio_type ?>">
				<div class="audio-box <?= $class ?> <?= $audio_type ?>-audio" id="<?= $audio_type ?>-audio-<?= get_the_ID() ?>"></div>
			</div>
		<?php
	  }
	return ob_get_clean();
}
add_shortcode( 'audio_box', 'audio_box' );

function audio_toggle() {
	ob_start();
	?>
<div class="audio-toggle d-flex align-items-center">
	<span class="toggle-label toggle-label--before">Before</span>
	<label class="switch" for="before-after-<?= get_the_ID() ?>"> <input class="switch-input" type="checkbox" id="before-after-<?= get_the_ID() ?>" name="before-after-<?= get_the_ID() ?>"> <span class="slider round"></span> </label>
	<span class="toggle-label toggle-label--after">After</span>
</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'audio_toggle', 'audio_toggle' );

// Define the words per minute (WPM) for calculation.
// A common reading speed is around 200-250 words per minute.
if ( ! defined( 'READ_TIME_WPM' ) ) {
    define( 'READ_TIME_WPM', 220 ); // You can adjust this value as needed
}

/**
 * Calculates the estimated read time for a given post.
 *
 * @param int $post_id Optional. The ID of the post to calculate read time for.
 * Defaults to the current post if not provided.
 * @return string The formatted estimated read time (e.g., "5 min read").
 */
function get_estimated_read_time( $post_id = null ) {
    // If no post ID is provided, try to get the current post ID.
    if ( null === $post_id ) {
        $post_id = get_the_ID();
    }

    // Check if we have a valid post ID.
    if ( ! $post_id ) {
        return ''; // Return empty if no post is found.
    }

    // Get the post content.
    $content = get_post_field( 'post_content', $post_id );

    // Strip HTML tags and shortcodes to get plain text.
    $content = strip_shortcodes( $content );
    $content = wp_strip_all_tags( $content );

    // Count the words in the content.
    $word_count = str_word_count( $content );

    // Calculate minutes.
    $minutes = floor( $word_count / READ_TIME_WPM );

    // Calculate remaining seconds (optional, but adds precision for shorter reads).
    $seconds = ceil( ( $word_count % READ_TIME_WPM ) / ( READ_TIME_WPM / 60 ) );

    // Handle cases where read time is less than a minute.
    if ( $minutes < 1 ) {
        if ( $seconds < 30 ) {
            return 'Less than a minute read';
        } else {
            return '1 min read'; // Round up to 1 minute if seconds are 30 or more.
        }
    }

    // Format the output string.
    $output = '';
    if ( $minutes === 1 ) {
        $output = '1 min read';
    } else {
        $output = $minutes . ' min read';
    }

    return $output;
}

/**
 * Register a shortcode for the estimated read time.
 * This allows you to easily insert the read time anywhere using [estimated_read_time].
 */
add_shortcode( 'estimated_read_time', 'get_estimated_read_time_shortcode' );

function get_estimated_read_time_shortcode( $atts ) {
    // You can pass a post ID as an attribute if needed, e.g., [estimated_read_time post_id="123"].
    $atts = shortcode_atts( array(
        'post_id' => get_the_ID(),
    ), $atts, 'estimated_read_time' );

    return get_estimated_read_time( $atts['post_id'] );
}