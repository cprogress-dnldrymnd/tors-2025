<?php

/**
 * Setup Moroko Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */

define('theme_dir', get_stylesheet_directory_uri() . '/');
define('assets_dir', theme_dir . 'assets/');
define('image_dir', assets_dir . 'images/');
define('vendor_dir', assets_dir . 'vendors/');
function moroko_child_theme_setup()
{
	load_child_theme_textdomain('moroko-child', get_stylesheet_directory() . '/languages');


	//include_once('plugins/tors-elementor/tors-elementor.php');

}
add_action('after_setup_theme', 'moroko_child_theme_setup');
/*-----------------------------------------------------------------------------------*/
/* Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/
function enqueue_scripts()
{
	wp_enqueue_script('jquery');
	wp_enqueue_style('swiper--css', vendor_dir . 'swiper/swiper-bundle.min.css');
	wp_enqueue_style('fancybox--css', vendor_dir . 'fancybox/fancybox.css');
	wp_enqueue_script('swiper--js', vendor_dir . 'swiper/swiper-bundle.min.js');
	wp_enqueue_script('fancybox--js', vendor_dir . 'fancybox/fancybox.umd.js');
	wp_enqueue_script('main--js', assets_dir . 'javascripts/main.js');
}

add_action('wp_enqueue_scripts', 'enqueue_scripts'); // Register this fxn and allow Wordpress to call it automatcally in the header

/*-----------------------------------------------------------------------------------*/
/* Register Carbofields
/*-----------------------------------------------------------------------------------*/
add_action('carbon_fields_register_fields', 'tissue_paper_register_custom_fields');
function tissue_paper_register_custom_fields()
{
	require_once('includes/post-meta.php');
}


/*-----------------------------------------------------------------------------------*/
/* Require Files
/*-----------------------------------------------------------------------------------*/
require_once('includes/post-types.php');
require_once('includes/shortcodes.php');
require_once('includes/elementor.php');


add_filter('wpcf7_autop_or_not', '__return_false');

function convertToEmbedLink($youtubeUrl)
{
	$videoId = false;

	// Regex patterns to match different YouTube URL formats
	$patterns = [
		'/^(?:https?:\/\/)?(?:www\.)?(?:m\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=|embed\/|v\/|)([\w-]{11})(?:\S+)?$/',
		'/^(?:https?:\/\/)?(?:www\.)?(?:m\.)?(?:youtube\.com|youtu\.be)\/shorts\/([\w-]{11})(?:\S+)?$/'
	];

	foreach ($patterns as $pattern) {
		if (preg_match($pattern, $youtubeUrl, $matches)) {
			$videoId = $matches[1];
			break;
		}
	}

	if ($videoId) {
		return "https://www.youtube.com/embed/" . $videoId;
	} else {
		// Return false if no video ID could be extracted
		return false;
	}
}



function action_admin_head()
{
?>
	<style>

	</style>
<?php

}
add_action('admin_head', 'action_admin_head');


add_filter('gettext', 'translate_text', 30);
add_filter('ngettext', 'translate_text', 30);
function translate_text($translated)
{
	$words = array(
		// 'word to translate' => 'translation'
		'Moroko' => 'TORS',
	);
	$translated = str_ireplace(array_keys($words), $words, $translated);
	return $translated;
}
