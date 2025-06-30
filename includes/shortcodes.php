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


function our_artists()
{
    ob_start();
    get_template_part('template-parts/shortcodes/our_artists');
    return ob_get_clean();
}


add_shortcode('our_artists', 'our_artists');


function post_content()
{
    return wpautop(get_the_content());
}

add_shortcode('post_content', 'post_content');

function audio_box($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'audio_type' => '',
            ),
            $atts
        )
    );
    $audio = carbon_get_the_post_meta($audio_type . '_audio');
    if ($audio) {
        $audio_url = wp_get_attachment_url($audio);
        if ($audio_type == 'before') {
            $class = 'active';
        } else {
            $class = '';
        }
?>
        <div class="audio-box-holder d-flex align-items-center audio-<?= $audio_type ?>" audio_url="<?= $audio_url ?>">
            <div class="audio-box <?= $class ?> <?= $audio_type ?>-audio" id="audio-<?= $audio ?>"></div>
        </div>
    <?php
    }
    return ob_get_clean();
}
add_shortcode('audio_box', 'audio_box');

function audio_toggle($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'class' => '',
            ),
            $atts
        )
    );
    ?>
    <div class="audio-toggle d-flex align-items-center">
        <span class="toggle-label toggle-label--before">Before</span>
        <label class="switch" for="before-after-<?= $class . get_the_ID() ?>"> <input class="switch-input" type="checkbox" id="before-after-<?= $class . get_the_ID() ?>" name="before-after-<?= $class . get_the_ID() ?>"> <span class="slider round"></span> </label>
        <span class="toggle-label toggle-label--after">After</span>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('audio_toggle', 'audio_toggle');

// Define the words per minute (WPM) for calculation.
// A common reading speed is around 200-250 words per minute.
if (! defined('READ_TIME_WPM')) {
    define('READ_TIME_WPM', 220); // You can adjust this value as needed
}

/**
 * Calculates the estimated read time for a given post.
 *
 * @param int $post_id Optional. The ID of the post to calculate read time for.
 * Defaults to the current post if not provided.
 * @return string The formatted estimated read time (e.g., "5 min read").
 */
function get_estimated_read_time($post_id = null)
{
    // If no post ID is provided, try to get the current post ID.
    if (null === $post_id) {
        $post_id = get_the_ID();
    }

    // Check if we have a valid post ID.
    if (! $post_id) {
        return ''; // Return empty if no post is found.
    }

    // Get the post content.
    $content = get_post_field('post_content', $post_id);

    // Strip HTML tags and shortcodes to get plain text.
    $content = strip_shortcodes($content);
    $content = wp_strip_all_tags($content);

    // Count the words in the content.
    $word_count = str_word_count($content);

    // Calculate minutes.
    $minutes = floor($word_count / READ_TIME_WPM);

    // Calculate remaining seconds (optional, but adds precision for shorter reads).
    $seconds = ceil(($word_count % READ_TIME_WPM) / (READ_TIME_WPM / 60));

    // Handle cases where read time is less than a minute.
    if ($minutes < 1) {
        if ($seconds < 30) {
            return 'Less than a minute read';
        } else {
            return '1 min read'; // Round up to 1 minute if seconds are 30 or more.
        }
    }

    // Format the output string.
    $output = '';
    if ($minutes === 1) {
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
add_shortcode('estimated_read_time', 'get_estimated_read_time_shortcode');

function get_estimated_read_time_shortcode($atts)
{
    // You can pass a post ID as an attribute if needed, e.g., [estimated_read_time post_id="123"].
    $atts = shortcode_atts(array(
        'post_id' => get_the_ID(),
    ), $atts, 'estimated_read_time');

    return get_estimated_read_time($atts['post_id']);
}
/*
add_shortcode('import_to_woocommerce', 'import_to_woocommerce');
function import_to_woocommerce()
{
    ob_start();
    $get_a_quote_form = carbon_get_theme_option('get_a_quote_form');
    $reversed = array_reverse($get_a_quote_form);
    foreach ($reversed as $form) {
        // Define product details
        $product_name = $form['name'];
        $product_sku = 'EQUIPMENT_' . str_replace(' ', '_', $form['name']);
        $product_price = '100.00';
        $product_description = '';
        $product_short_description = '';
        create_my_woocommerce_product($product_name, $product_sku, $product_price, $product_description, $product_short_description, $form['image']);
    }
    return ob_get_clean();
}
/**
 * Programmatically create a new WooCommerce product.
 * This function should ideally be hooked to a 'admin_init' or 'init' action
 * and run only once, or triggered by a specific event.
 */
function create_my_woocommerce_product($product_name, $product_sku, $product_price, $product_description, $product_short_description, $image_id)
{

    // Check if WooCommerce is active
    if (! class_exists('WC_Product')) {
        error_log('WooCommerce is not active. Cannot create product.');
        return;
    }



    // Check if a product with this SKU already exists to prevent duplicates
    $product_id_by_sku = wc_get_product_id_by_sku($product_sku);

    if ($product_id_by_sku) {
        error_log('Product with SKU ' . $product_sku . ' already exists (ID: ' . $product_id_by_sku . '). Skipping creation.');
        // You could uncomment the line below to update the existing product instead
        // $product = wc_get_product( $product_id_by_sku );
        return;
    }

    // Create a new WC_Product_Simple object
    // For other types, use WC_Product_Variable, WC_Product_Grouped, etc.
    $product = new WC_Product_Simple();

    // Set basic product data
    $product->set_name($product_name); // Product title
    $product->set_status('publish'); // 'publish', 'pending', 'draft'
    $product->set_catalog_visibility('visible'); // 'visible', 'catalog', 'search', 'hidden'
    $product->set_description($product_description);
    $product->set_short_description($product_short_description);
    $product->set_sku($product_sku);
    $product->set_price($product_price);
    $product->set_regular_price($product_price);
    $product->set_manage_stock(false); // Set to true to enable stock management
    $product->set_stock_status('instock'); // 'instock', 'outofstock', 'onbackorder'
    $product->set_reviews_allowed(false); // Enable reviews


    // Save the product
    $new_product_id = $product->save();

    if ($new_product_id) {
        set_post_thumbnail($new_product_id, $image_id);
        echo 'Product "' . $product_name . '" created successfully with ID: ' . $new_product_id;
        // You can add further actions here, e.g., set gallery images, attributes, etc.
    } else {
        echo 'Failed to create product "' . $product_name . '".';
    }
}

function test()
{
    ob_start();
    $alternative = get__artists_by_genre('alternative');
    foreach ($alternative as $alt) {
        $args = array(
            'post_type' => 'recordings',
            'tax_query' => array(
                array(
                    'taxonomy' => 'artists',
                    'field' => 'slug',
                    'terms' => $alt,
                ),
            ),
        );
        $query = new WP_Query($args);
        while ($query->have_posts()) {
            the_title();
            $query->the_post();
        }
    }
    return ob_get_clean();
}

add_shortcode('test', 'test');
