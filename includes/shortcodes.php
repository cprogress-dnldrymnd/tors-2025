<?php

function tors_logo()
{
    ob_start();
    get_template_part('template-parts/shortcodes/tors_logo');
    return ob_get_clean();
}

add_shortcode('tors_logo', 'tors_logo');

/*
function get_a_quote_form()
{
    ob_start();
    get_template_part('template-parts/shortcodes/get_a_quote_form');
    return ob_get_clean();
}
add_shortcode('get_a_quote_form', 'get_a_quote_form');
*/
/*
function instrument_box()
{
    ob_start();
    $product = wc_get_product(get_the_ID());
?>
    <input type="checkbox" price="<?= $product->get_price() ?>" instrument_id="<?= $product->get_id() ?>" name="instruments[]" value="<?= $product->get_name() ?>" id="instrument-<?= $product->get_id() ?>">
    <label for="instrument-<?= $product->get_id() ?>" class="d-flex align-items-center justify-content-between label-box">
        <div class="image-holder">
            <div class="image-box">
                <img src="<?= wp_get_attachment_image_url($product->get_image_id(), 'medium') ?>" alt="<?= $product->get_name() ?>">
            </div>
        </div>
        <div class="name-icon-box d-flex align-items-center justify-content-between">
            <!--
            <div class="name-box">
                <?= $product->get_name() ?>
                <div class="price-box">From <?= $product->get_price_html() ?></div>
            </div>-->
            <div class="plus-minus-box">

            </div>
        </div>
    </label>
    <?php
    return ob_get_clean();
}

add_shortcode('instrument_box', 'instrument_box');
*/
function instrument_box()
{
    ob_start();
    global $product;
?>
    <input type="checkbox" price="<?= $product->get_price() ?>" instrument_id="<?= $product->get_id() ?>"
        name="instruments[]" value="<?= $product->get_name() ?>" id="instrument-<?= $product->get_id() ?>">
    <label for="instrument-<?= $product->get_id() ?>" class="d-flex align-items-center justify-content-between label-box">
        <div class="image-holder">
            <div class="image-box">
                <img src="<?= wp_get_attachment_image_url($product->get_image_id(), 'medium') ?>"
                    alt="<?= $product->get_name() ?>">
            </div>
        </div>
        <div class="name-icon-box d-flex align-items-center justify-content-between">

            <div class="name-box">
                <?= $product->get_name() ?>
                <div class="price-box">From <?= $product->get_price_html() ?></div>
            </div>
            <div class="plus-minus-box">

            </div>
        </div>
    </label>
    <?php
    return ob_get_clean();
}

add_shortcode('instrument_box', 'instrument_box');


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
            <?= do_shortcode('[loading_animation]') ?>
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
        <label class="switch" for="before-after-<?= $class . get_the_ID() ?>"> <input class="switch-input" type="checkbox"
                id="before-after-<?= $class . get_the_ID() ?>" name="before-after-<?= $class . get_the_ID() ?>"> <span
                class="slider round"></span> </label>
        <span class="toggle-label toggle-label--after">After</span>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('audio_toggle', 'audio_toggle');
function loading_animation()
{
    ob_start();
?>
    <div class="loading-animation">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="56" height="57"
            viewBox="0 0 56 57">
            <defs>
                <clipPath id="clip-path">
                    <rect id="Rectangle_183" data-name="Rectangle 183" width="56" height="57"
                        transform="translate(-28 0.142)" fill="currentColor" stroke="#707070" stroke-width="1"></rect>
                </clipPath>
            </defs>
            <g id="Mask_Group_26" data-name="Mask Group 26" transform="translate(28 -0.142)" clip-path="url(#clip-path)">
                <path id="Path_255" data-name="Path 255"
                    d="M52.312,25.535c-.225-1.671-.4-3.351-.687-5.011A23.806,23.806,0,0,0,47,10.174,25.429,25.429,0,0,0,35.681,1.739a25.261,25.261,0,0,0-5.812-1.5A28.266,28.266,0,0,0,23.026.178,26.247,26.247,0,0,0,12.761,3.485a25.075,25.075,0,0,0-11.349,13.5A27.17,27.17,0,0,0,.076,22.55c-.059.405-.016.824-.037,1.235A25.737,25.737,0,0,0,3.471,38.3a25.07,25.07,0,0,0,12.007,10.58,27.97,27.97,0,0,0,7.085,1.944c.527.079,1.065.088,1.6.119.631.037,1.264.1,1.894.085,1.068-.032,2.141-.073,3.2-.195A25.562,25.562,0,0,0,51.667,30.723a35.033,35.033,0,0,0,.432-3.565c.059-.534.091-1.07.135-1.606l.077-.016m-16.906.033c0,.19,0,.381,0,.571a3.911,3.911,0,0,1-.018.617,8.921,8.921,0,0,1-3.669,6.05,8.832,8.832,0,0,1-8.568,1.4c-4.469-1.67-6.948-5.514-6.3-9.984a9.451,9.451,0,0,1,9.173-7.914,8.348,8.348,0,0,1,4.393,1.22,9.048,9.048,0,0,1,4.991,8.042M15.347,4.522l-.067-.144a2.809,2.809,0,0,1,.363-.275c.668-.358,1.321-.753,2.018-1.05A21.943,21.943,0,0,1,24.248,1.51a22.678,22.678,0,0,1,5.318.123A16.735,16.735,0,0,1,34.9,3.186c.58.3,1.121.665,1.68,1l-.067.16A33.405,33.405,0,0,0,25.942,2.659a33.569,33.569,0,0,0-10.6,1.862m.3,42.242a33.017,33.017,0,0,0,21.2-.181c-4.54,3.678-16.128,4.328-21.2.181m.8-40.543L16.4,6.1c.318-.2.626-.418.955-.6a18.455,18.455,0,0,1,7.876-2.049A19.6,19.6,0,0,1,31.366,4a9.484,9.484,0,0,1,3.932,1.8,2.151,2.151,0,0,1,.217.247l-.052.108a30.2,30.2,0,0,0-19.016.059m.182,38.83.05-.057c1.563.341,3.113.77,4.693,1a33.281,33.281,0,0,0,4.832.357,32.789,32.789,0,0,0,4.833-.379c1.572-.239,3.112-.685,4.794-1.069-.4.253-.689.456-1,.627a18.734,18.734,0,0,1-7.96,2.074,18.59,18.59,0,0,1-4.7-.269,12.558,12.558,0,0,1-4.722-1.657c-.289-.189-.55-.417-.824-.627m.749-36.99a15.881,15.881,0,0,1,10.64-2.536c2.055.176,5.748,1.544,6.264,2.427a29,29,0,0,0-16.9.109m17.369,34.9c-3.208,3.327-14.015,3.431-16.941.119a26.925,26.925,0,0,0,8.5,1.213,31.252,31.252,0,0,0,8.437-1.332M18.313,9.777a10.986,10.986,0,0,1,6.887-2.4A14.551,14.551,0,0,1,33.235,9.52a35.17,35.17,0,0,0-14.922.257m.651,31.768a35.009,35.009,0,0,0,14.873-.269,11,11,0,0,1-7.055,2.406,14.391,14.391,0,0,1-7.818-2.138m.34-29.807c2.521-2.558,10.432-3.108,13.239-.175a32.187,32.187,0,0,0-6.615-.71,29.057,29.057,0,0,0-6.624.885M32.831,39.286l.064.2a15.26,15.26,0,0,1-1.565.878,13.471,13.471,0,0,1-6.574,1.067,10.691,10.691,0,0,1-3.739-.921c-.507-.247-.969-.583-1.452-.878l.064-.172a26.559,26.559,0,0,0,13.2-.177M20.188,13.83c1.958-2.5,9.335-2.681,11.278-.234a24.972,24.972,0,0,0-11.278.234M32,37.22c-1.221,1.3-4.237,2.335-6.94,2.006A7.978,7.978,0,0,1,20.8,37.561,26.127,26.127,0,0,0,32,37.22M30.89,15.342c-1.68-.1-3.263-.271-4.845-.265s-3.179.191-4.866.3a7.883,7.883,0,0,1,9.71-.039m-.011,20.33a7.55,7.55,0,0,1-9.5,0,32.36,32.36,0,0,0,9.5,0"
                    transform="translate(-26.156 1.625)" fill="currentColor"></path>
                <path id="Path_256" data-name="Path 256"
                    d="M194.523,185.771c-4.8,0-7.858,3.187-7.83,8.229a7.03,7.03,0,0,0,2.225,5.158,8.432,8.432,0,0,0,6.543,2.238,7.777,7.777,0,0,0,7.169-8.061,7.672,7.672,0,0,0-8.107-7.563m.122,7.141a.883.883,0,0,1,.757.686.91.91,0,0,1-.73.779.847.847,0,0,1-.761-.679.988.988,0,0,1,.734-.786"
                    transform="translate(-194.719 -166.425)" fill="currentColor"></path>
            </g>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="56" height="57"
            viewBox="0 0 56 57">
            <defs>
                <clipPath id="clip-path">
                    <rect id="Rectangle_183" data-name="Rectangle 183" width="56" height="57"
                        transform="translate(-28 0.142)" fill="currentColor" stroke="#707070" stroke-width="1"></rect>
                </clipPath>
            </defs>
            <g id="Mask_Group_26" data-name="Mask Group 26" transform="translate(28 -0.142)" clip-path="url(#clip-path)">
                <path id="Path_255" data-name="Path 255"
                    d="M52.312,25.535c-.225-1.671-.4-3.351-.687-5.011A23.806,23.806,0,0,0,47,10.174,25.429,25.429,0,0,0,35.681,1.739a25.261,25.261,0,0,0-5.812-1.5A28.266,28.266,0,0,0,23.026.178,26.247,26.247,0,0,0,12.761,3.485a25.075,25.075,0,0,0-11.349,13.5A27.17,27.17,0,0,0,.076,22.55c-.059.405-.016.824-.037,1.235A25.737,25.737,0,0,0,3.471,38.3a25.07,25.07,0,0,0,12.007,10.58,27.97,27.97,0,0,0,7.085,1.944c.527.079,1.065.088,1.6.119.631.037,1.264.1,1.894.085,1.068-.032,2.141-.073,3.2-.195A25.562,25.562,0,0,0,51.667,30.723a35.033,35.033,0,0,0,.432-3.565c.059-.534.091-1.07.135-1.606l.077-.016m-16.906.033c0,.19,0,.381,0,.571a3.911,3.911,0,0,1-.018.617,8.921,8.921,0,0,1-3.669,6.05,8.832,8.832,0,0,1-8.568,1.4c-4.469-1.67-6.948-5.514-6.3-9.984a9.451,9.451,0,0,1,9.173-7.914,8.348,8.348,0,0,1,4.393,1.22,9.048,9.048,0,0,1,4.991,8.042M15.347,4.522l-.067-.144a2.809,2.809,0,0,1,.363-.275c.668-.358,1.321-.753,2.018-1.05A21.943,21.943,0,0,1,24.248,1.51a22.678,22.678,0,0,1,5.318.123A16.735,16.735,0,0,1,34.9,3.186c.58.3,1.121.665,1.68,1l-.067.16A33.405,33.405,0,0,0,25.942,2.659a33.569,33.569,0,0,0-10.6,1.862m.3,42.242a33.017,33.017,0,0,0,21.2-.181c-4.54,3.678-16.128,4.328-21.2.181m.8-40.543L16.4,6.1c.318-.2.626-.418.955-.6a18.455,18.455,0,0,1,7.876-2.049A19.6,19.6,0,0,1,31.366,4a9.484,9.484,0,0,1,3.932,1.8,2.151,2.151,0,0,1,.217.247l-.052.108a30.2,30.2,0,0,0-19.016.059m.182,38.83.05-.057c1.563.341,3.113.77,4.693,1a33.281,33.281,0,0,0,4.832.357,32.789,32.789,0,0,0,4.833-.379c1.572-.239,3.112-.685,4.794-1.069-.4.253-.689.456-1,.627a18.734,18.734,0,0,1-7.96,2.074,18.59,18.59,0,0,1-4.7-.269,12.558,12.558,0,0,1-4.722-1.657c-.289-.189-.55-.417-.824-.627m.749-36.99a15.881,15.881,0,0,1,10.64-2.536c2.055.176,5.748,1.544,6.264,2.427a29,29,0,0,0-16.9.109m17.369,34.9c-3.208,3.327-14.015,3.431-16.941.119a26.925,26.925,0,0,0,8.5,1.213,31.252,31.252,0,0,0,8.437-1.332M18.313,9.777a10.986,10.986,0,0,1,6.887-2.4A14.551,14.551,0,0,1,33.235,9.52a35.17,35.17,0,0,0-14.922.257m.651,31.768a35.009,35.009,0,0,0,14.873-.269,11,11,0,0,1-7.055,2.406,14.391,14.391,0,0,1-7.818-2.138m.34-29.807c2.521-2.558,10.432-3.108,13.239-.175a32.187,32.187,0,0,0-6.615-.71,29.057,29.057,0,0,0-6.624.885M32.831,39.286l.064.2a15.26,15.26,0,0,1-1.565.878,13.471,13.471,0,0,1-6.574,1.067,10.691,10.691,0,0,1-3.739-.921c-.507-.247-.969-.583-1.452-.878l.064-.172a26.559,26.559,0,0,0,13.2-.177M20.188,13.83c1.958-2.5,9.335-2.681,11.278-.234a24.972,24.972,0,0,0-11.278.234M32,37.22c-1.221,1.3-4.237,2.335-6.94,2.006A7.978,7.978,0,0,1,20.8,37.561,26.127,26.127,0,0,0,32,37.22M30.89,15.342c-1.68-.1-3.263-.271-4.845-.265s-3.179.191-4.866.3a7.883,7.883,0,0,1,9.71-.039m-.011,20.33a7.55,7.55,0,0,1-9.5,0,32.36,32.36,0,0,0,9.5,0"
                    transform="translate(-26.156 1.625)" fill="currentColor"></path>
                <path id="Path_256" data-name="Path 256"
                    d="M194.523,185.771c-4.8,0-7.858,3.187-7.83,8.229a7.03,7.03,0,0,0,2.225,5.158,8.432,8.432,0,0,0,6.543,2.238,7.777,7.777,0,0,0,7.169-8.061,7.672,7.672,0,0,0-8.107-7.563m.122,7.141a.883.883,0,0,1,.757.686.91.91,0,0,1-.73.779.847.847,0,0,1-.761-.679.988.988,0,0,1,.734-.786"
                    transform="translate(-194.719 -166.425)" fill="currentColor"></path>
            </g>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="56" height="57"
            viewBox="0 0 56 57">
            <defs>
                <clipPath id="clip-path">
                    <rect id="Rectangle_183" data-name="Rectangle 183" width="56" height="57"
                        transform="translate(-28 0.142)" fill="currentColor" stroke="#707070" stroke-width="1"></rect>
                </clipPath>
            </defs>
            <g id="Mask_Group_26" data-name="Mask Group 26" transform="translate(28 -0.142)" clip-path="url(#clip-path)">
                <path id="Path_255" data-name="Path 255"
                    d="M52.312,25.535c-.225-1.671-.4-3.351-.687-5.011A23.806,23.806,0,0,0,47,10.174,25.429,25.429,0,0,0,35.681,1.739a25.261,25.261,0,0,0-5.812-1.5A28.266,28.266,0,0,0,23.026.178,26.247,26.247,0,0,0,12.761,3.485a25.075,25.075,0,0,0-11.349,13.5A27.17,27.17,0,0,0,.076,22.55c-.059.405-.016.824-.037,1.235A25.737,25.737,0,0,0,3.471,38.3a25.07,25.07,0,0,0,12.007,10.58,27.97,27.97,0,0,0,7.085,1.944c.527.079,1.065.088,1.6.119.631.037,1.264.1,1.894.085,1.068-.032,2.141-.073,3.2-.195A25.562,25.562,0,0,0,51.667,30.723a35.033,35.033,0,0,0,.432-3.565c.059-.534.091-1.07.135-1.606l.077-.016m-16.906.033c0,.19,0,.381,0,.571a3.911,3.911,0,0,1-.018.617,8.921,8.921,0,0,1-3.669,6.05,8.832,8.832,0,0,1-8.568,1.4c-4.469-1.67-6.948-5.514-6.3-9.984a9.451,9.451,0,0,1,9.173-7.914,8.348,8.348,0,0,1,4.393,1.22,9.048,9.048,0,0,1,4.991,8.042M15.347,4.522l-.067-.144a2.809,2.809,0,0,1,.363-.275c.668-.358,1.321-.753,2.018-1.05A21.943,21.943,0,0,1,24.248,1.51a22.678,22.678,0,0,1,5.318.123A16.735,16.735,0,0,1,34.9,3.186c.58.3,1.121.665,1.68,1l-.067.16A33.405,33.405,0,0,0,25.942,2.659a33.569,33.569,0,0,0-10.6,1.862m.3,42.242a33.017,33.017,0,0,0,21.2-.181c-4.54,3.678-16.128,4.328-21.2.181m.8-40.543L16.4,6.1c.318-.2.626-.418.955-.6a18.455,18.455,0,0,1,7.876-2.049A19.6,19.6,0,0,1,31.366,4a9.484,9.484,0,0,1,3.932,1.8,2.151,2.151,0,0,1,.217.247l-.052.108a30.2,30.2,0,0,0-19.016.059m.182,38.83.05-.057c1.563.341,3.113.77,4.693,1a33.281,33.281,0,0,0,4.832.357,32.789,32.789,0,0,0,4.833-.379c1.572-.239,3.112-.685,4.794-1.069-.4.253-.689.456-1,.627a18.734,18.734,0,0,1-7.96,2.074,18.59,18.59,0,0,1-4.7-.269,12.558,12.558,0,0,1-4.722-1.657c-.289-.189-.55-.417-.824-.627m.749-36.99a15.881,15.881,0,0,1,10.64-2.536c2.055.176,5.748,1.544,6.264,2.427a29,29,0,0,0-16.9.109m17.369,34.9c-3.208,3.327-14.015,3.431-16.941.119a26.925,26.925,0,0,0,8.5,1.213,31.252,31.252,0,0,0,8.437-1.332M18.313,9.777a10.986,10.986,0,0,1,6.887-2.4A14.551,14.551,0,0,1,33.235,9.52a35.17,35.17,0,0,0-14.922.257m.651,31.768a35.009,35.009,0,0,0,14.873-.269,11,11,0,0,1-7.055,2.406,14.391,14.391,0,0,1-7.818-2.138m.34-29.807c2.521-2.558,10.432-3.108,13.239-.175a32.187,32.187,0,0,0-6.615-.71,29.057,29.057,0,0,0-6.624.885M32.831,39.286l.064.2a15.26,15.26,0,0,1-1.565.878,13.471,13.471,0,0,1-6.574,1.067,10.691,10.691,0,0,1-3.739-.921c-.507-.247-.969-.583-1.452-.878l.064-.172a26.559,26.559,0,0,0,13.2-.177M20.188,13.83c1.958-2.5,9.335-2.681,11.278-.234a24.972,24.972,0,0,0-11.278.234M32,37.22c-1.221,1.3-4.237,2.335-6.94,2.006A7.978,7.978,0,0,1,20.8,37.561,26.127,26.127,0,0,0,32,37.22M30.89,15.342c-1.68-.1-3.263-.271-4.845-.265s-3.179.191-4.866.3a7.883,7.883,0,0,1,9.71-.039m-.011,20.33a7.55,7.55,0,0,1-9.5,0,32.36,32.36,0,0,0,9.5,0"
                    transform="translate(-26.156 1.625)" fill="currentColor"></path>
                <path id="Path_256" data-name="Path 256"
                    d="M194.523,185.771c-4.8,0-7.858,3.187-7.83,8.229a7.03,7.03,0,0,0,2.225,5.158,8.432,8.432,0,0,0,6.543,2.238,7.777,7.777,0,0,0,7.169-8.061,7.672,7.672,0,0,0-8.107-7.563m.122,7.141a.883.883,0,0,1,.757.686.91.91,0,0,1-.73.779.847.847,0,0,1-.761-.679.988.988,0,0,1,.734-.786"
                    transform="translate(-194.719 -166.425)" fill="currentColor"></path>
            </g>
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="56" height="57"
            viewBox="0 0 56 57">
            <defs>
                <clipPath id="clip-path">
                    <rect id="Rectangle_183" data-name="Rectangle 183" width="56" height="57"
                        transform="translate(-28 0.142)" fill="currentColor" stroke="#707070" stroke-width="1"></rect>
                </clipPath>
            </defs>
            <g id="Mask_Group_26" data-name="Mask Group 26" transform="translate(28 -0.142)" clip-path="url(#clip-path)">
                <path id="Path_255" data-name="Path 255"
                    d="M52.312,25.535c-.225-1.671-.4-3.351-.687-5.011A23.806,23.806,0,0,0,47,10.174,25.429,25.429,0,0,0,35.681,1.739a25.261,25.261,0,0,0-5.812-1.5A28.266,28.266,0,0,0,23.026.178,26.247,26.247,0,0,0,12.761,3.485a25.075,25.075,0,0,0-11.349,13.5A27.17,27.17,0,0,0,.076,22.55c-.059.405-.016.824-.037,1.235A25.737,25.737,0,0,0,3.471,38.3a25.07,25.07,0,0,0,12.007,10.58,27.97,27.97,0,0,0,7.085,1.944c.527.079,1.065.088,1.6.119.631.037,1.264.1,1.894.085,1.068-.032,2.141-.073,3.2-.195A25.562,25.562,0,0,0,51.667,30.723a35.033,35.033,0,0,0,.432-3.565c.059-.534.091-1.07.135-1.606l.077-.016m-16.906.033c0,.19,0,.381,0,.571a3.911,3.911,0,0,1-.018.617,8.921,8.921,0,0,1-3.669,6.05,8.832,8.832,0,0,1-8.568,1.4c-4.469-1.67-6.948-5.514-6.3-9.984a9.451,9.451,0,0,1,9.173-7.914,8.348,8.348,0,0,1,4.393,1.22,9.048,9.048,0,0,1,4.991,8.042M15.347,4.522l-.067-.144a2.809,2.809,0,0,1,.363-.275c.668-.358,1.321-.753,2.018-1.05A21.943,21.943,0,0,1,24.248,1.51a22.678,22.678,0,0,1,5.318.123A16.735,16.735,0,0,1,34.9,3.186c.58.3,1.121.665,1.68,1l-.067.16A33.405,33.405,0,0,0,25.942,2.659a33.569,33.569,0,0,0-10.6,1.862m.3,42.242a33.017,33.017,0,0,0,21.2-.181c-4.54,3.678-16.128,4.328-21.2.181m.8-40.543L16.4,6.1c.318-.2.626-.418.955-.6a18.455,18.455,0,0,1,7.876-2.049A19.6,19.6,0,0,1,31.366,4a9.484,9.484,0,0,1,3.932,1.8,2.151,2.151,0,0,1,.217.247l-.052.108a30.2,30.2,0,0,0-19.016.059m.182,38.83.05-.057c1.563.341,3.113.77,4.693,1a33.281,33.281,0,0,0,4.832.357,32.789,32.789,0,0,0,4.833-.379c1.572-.239,3.112-.685,4.794-1.069-.4.253-.689.456-1,.627a18.734,18.734,0,0,1-7.96,2.074,18.59,18.59,0,0,1-4.7-.269,12.558,12.558,0,0,1-4.722-1.657c-.289-.189-.55-.417-.824-.627m.749-36.99a15.881,15.881,0,0,1,10.64-2.536c2.055.176,5.748,1.544,6.264,2.427a29,29,0,0,0-16.9.109m17.369,34.9c-3.208,3.327-14.015,3.431-16.941.119a26.925,26.925,0,0,0,8.5,1.213,31.252,31.252,0,0,0,8.437-1.332M18.313,9.777a10.986,10.986,0,0,1,6.887-2.4A14.551,14.551,0,0,1,33.235,9.52a35.17,35.17,0,0,0-14.922.257m.651,31.768a35.009,35.009,0,0,0,14.873-.269,11,11,0,0,1-7.055,2.406,14.391,14.391,0,0,1-7.818-2.138m.34-29.807c2.521-2.558,10.432-3.108,13.239-.175a32.187,32.187,0,0,0-6.615-.71,29.057,29.057,0,0,0-6.624.885M32.831,39.286l.064.2a15.26,15.26,0,0,1-1.565.878,13.471,13.471,0,0,1-6.574,1.067,10.691,10.691,0,0,1-3.739-.921c-.507-.247-.969-.583-1.452-.878l.064-.172a26.559,26.559,0,0,0,13.2-.177M20.188,13.83c1.958-2.5,9.335-2.681,11.278-.234a24.972,24.972,0,0,0-11.278.234M32,37.22c-1.221,1.3-4.237,2.335-6.94,2.006A7.978,7.978,0,0,1,20.8,37.561,26.127,26.127,0,0,0,32,37.22M30.89,15.342c-1.68-.1-3.263-.271-4.845-.265s-3.179.191-4.866.3a7.883,7.883,0,0,1,9.71-.039m-.011,20.33a7.55,7.55,0,0,1-9.5,0,32.36,32.36,0,0,0,9.5,0"
                    transform="translate(-26.156 1.625)" fill="currentColor"></path>
                <path id="Path_256" data-name="Path 256"
                    d="M194.523,185.771c-4.8,0-7.858,3.187-7.83,8.229a7.03,7.03,0,0,0,2.225,5.158,8.432,8.432,0,0,0,6.543,2.238,7.777,7.777,0,0,0,7.169-8.061,7.672,7.672,0,0,0-8.107-7.563m.122,7.141a.883.883,0,0,1,.757.686.91.91,0,0,1-.73.779.847.847,0,0,1-.761-.679.988.988,0,0,1,.734-.786"
                    transform="translate(-194.719 -166.425)" fill="currentColor"></path>
            </g>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="56" height="57"
            viewBox="0 0 56 57">
            <defs>
                <clipPath id="clip-path">
                    <rect id="Rectangle_183" data-name="Rectangle 183" width="56" height="57"
                        transform="translate(-28 0.142)" fill="currentColor" stroke="#707070" stroke-width="1"></rect>
                </clipPath>
            </defs>
            <g id="Mask_Group_26" data-name="Mask Group 26" transform="translate(28 -0.142)" clip-path="url(#clip-path)">
                <path id="Path_255" data-name="Path 255"
                    d="M52.312,25.535c-.225-1.671-.4-3.351-.687-5.011A23.806,23.806,0,0,0,47,10.174,25.429,25.429,0,0,0,35.681,1.739a25.261,25.261,0,0,0-5.812-1.5A28.266,28.266,0,0,0,23.026.178,26.247,26.247,0,0,0,12.761,3.485a25.075,25.075,0,0,0-11.349,13.5A27.17,27.17,0,0,0,.076,22.55c-.059.405-.016.824-.037,1.235A25.737,25.737,0,0,0,3.471,38.3a25.07,25.07,0,0,0,12.007,10.58,27.97,27.97,0,0,0,7.085,1.944c.527.079,1.065.088,1.6.119.631.037,1.264.1,1.894.085,1.068-.032,2.141-.073,3.2-.195A25.562,25.562,0,0,0,51.667,30.723a35.033,35.033,0,0,0,.432-3.565c.059-.534.091-1.07.135-1.606l.077-.016m-16.906.033c0,.19,0,.381,0,.571a3.911,3.911,0,0,1-.018.617,8.921,8.921,0,0,1-3.669,6.05,8.832,8.832,0,0,1-8.568,1.4c-4.469-1.67-6.948-5.514-6.3-9.984a9.451,9.451,0,0,1,9.173-7.914,8.348,8.348,0,0,1,4.393,1.22,9.048,9.048,0,0,1,4.991,8.042M15.347,4.522l-.067-.144a2.809,2.809,0,0,1,.363-.275c.668-.358,1.321-.753,2.018-1.05A21.943,21.943,0,0,1,24.248,1.51a22.678,22.678,0,0,1,5.318.123A16.735,16.735,0,0,1,34.9,3.186c.58.3,1.121.665,1.68,1l-.067.16A33.405,33.405,0,0,0,25.942,2.659a33.569,33.569,0,0,0-10.6,1.862m.3,42.242a33.017,33.017,0,0,0,21.2-.181c-4.54,3.678-16.128,4.328-21.2.181m.8-40.543L16.4,6.1c.318-.2.626-.418.955-.6a18.455,18.455,0,0,1,7.876-2.049A19.6,19.6,0,0,1,31.366,4a9.484,9.484,0,0,1,3.932,1.8,2.151,2.151,0,0,1,.217.247l-.052.108a30.2,30.2,0,0,0-19.016.059m.182,38.83.05-.057c1.563.341,3.113.77,4.693,1a33.281,33.281,0,0,0,4.832.357,32.789,32.789,0,0,0,4.833-.379c1.572-.239,3.112-.685,4.794-1.069-.4.253-.689.456-1,.627a18.734,18.734,0,0,1-7.96,2.074,18.59,18.59,0,0,1-4.7-.269,12.558,12.558,0,0,1-4.722-1.657c-.289-.189-.55-.417-.824-.627m.749-36.99a15.881,15.881,0,0,1,10.64-2.536c2.055.176,5.748,1.544,6.264,2.427a29,29,0,0,0-16.9.109m17.369,34.9c-3.208,3.327-14.015,3.431-16.941.119a26.925,26.925,0,0,0,8.5,1.213,31.252,31.252,0,0,0,8.437-1.332M18.313,9.777a10.986,10.986,0,0,1,6.887-2.4A14.551,14.551,0,0,1,33.235,9.52a35.17,35.17,0,0,0-14.922.257m.651,31.768a35.009,35.009,0,0,0,14.873-.269,11,11,0,0,1-7.055,2.406,14.391,14.391,0,0,1-7.818-2.138m.34-29.807c2.521-2.558,10.432-3.108,13.239-.175a32.187,32.187,0,0,0-6.615-.71,29.057,29.057,0,0,0-6.624.885M32.831,39.286l.064.2a15.26,15.26,0,0,1-1.565.878,13.471,13.471,0,0,1-6.574,1.067,10.691,10.691,0,0,1-3.739-.921c-.507-.247-.969-.583-1.452-.878l.064-.172a26.559,26.559,0,0,0,13.2-.177M20.188,13.83c1.958-2.5,9.335-2.681,11.278-.234a24.972,24.972,0,0,0-11.278.234M32,37.22c-1.221,1.3-4.237,2.335-6.94,2.006A7.978,7.978,0,0,1,20.8,37.561,26.127,26.127,0,0,0,32,37.22M30.89,15.342c-1.68-.1-3.263-.271-4.845-.265s-3.179.191-4.866.3a7.883,7.883,0,0,1,9.71-.039m-.011,20.33a7.55,7.55,0,0,1-9.5,0,32.36,32.36,0,0,0,9.5,0"
                    transform="translate(-26.156 1.625)" fill="currentColor"></path>
                <path id="Path_256" data-name="Path 256"
                    d="M194.523,185.771c-4.8,0-7.858,3.187-7.83,8.229a7.03,7.03,0,0,0,2.225,5.158,8.432,8.432,0,0,0,6.543,2.238,7.777,7.777,0,0,0,7.169-8.061,7.672,7.672,0,0,0-8.107-7.563m.122,7.141a.883.883,0,0,1,.757.686.91.91,0,0,1-.73.779.847.847,0,0,1-.761-.679.988.988,0,0,1,.734-.786"
                    transform="translate(-194.719 -166.425)" fill="currentColor"></path>
            </g>
        </svg>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('loading_animation', 'loading_animation');

// Define the words per minute (WPM) for calculation.
// A common reading speed is around 200-250 words per minute.
if (!defined('READ_TIME_WPM')) {
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
    if (!$post_id) {
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
function recordings_by_genres_artists($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'genre' => 'current_object',
            ),
            $atts
        )
    );

    if ($genre == 'current_object') {
        $genre = get_queried_object()->slug;
    } else {
        $genre = $genre;
    }

    $artists = get__artists_by_genre($genre);
    echo '<section class="artists-songs-section swiper swiper-artists-songs-section">';
    echo '<div class="swiper-wrapper">';

    foreach ($artists as $artist) {


        $args = array(
            'post_type' => 'recordings',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'artists',
                    'field'    => 'slug',
                    'terms'    => $artist['slug'],
                ),
                array(
                    'taxonomy' => 'genres',
                    'field'    => 'slug',
                    'terms'    => $genre,
                ),
            ),
        );
        $query_recordings = new WP_Query($args);
        $query_recordings_count = $query_recordings->found_posts;

        echo '<div class="artists-songs-section-inner swiper-slide">';

        echo do_shortcode('[artist_box term_id=' . $artist['term_id'] . ']');

        echo '<div class="artist-songs">';
        echo '<div class="artist-songs--holder">';
        while ($query_recordings->have_posts()) {
            $query_recordings->the_post();
            echo do_shortcode('[recordings_box]');
        }

        if ($query_recordings_count > 1) {
            echo '<div class="show-all-artists-song desktop-only">';
            echo '<a class="show-all-song">Show All</a>';
            echo '</div>';
        }

        echo '</div>';

        echo '</div>';

        wp_reset_postdata();

        echo '</div>';
    }
    echo '</div>';
    echo '<div class="swiper-buttons-song"><div class="swiper-button-next swiper-button-next--song"></div> <div class="swiper-pagination swiper-pagination--song"></div>  <div class="swiper-button-prev swiper-button-prev--song"></div></div>';

    echo '</section>';

    return ob_get_clean();
}

add_shortcode('recordings_by_genres_artists', 'recordings_by_genres_artists');


function recordings_box($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'display_artist'      => false,
                'display_artist_name' => true,
            ),
            $atts
        )
    );

    $before_audio = carbon_get_the_post_meta('before_audio');
    $after_audio = carbon_get_the_post_meta('after_audio');
    $artist = get_the_terms(get_the_ID(), 'artists');


    if ($display_artist) {
        $class = 'has--artists';
    } else {
        $class = '';
    }

    echo '<div class="artist-songs--box artist-songs--box--js audio-player--parent before-active audio-player--player ' . $class . '">';
    if ($display_artist) {


        echo '<div class="artist-songs--wrapper">';

        echo do_shortcode('[artist_box term_id=' . $artist[0]->term_id . ']');
    }
    echo '<div class="artist-songs--inner">';
    echo '<div class="artist-songs--title">';
    echo '<h4>';
    echo get_the_title();
    /*
    if ($display_artist_name) {
        echo ' by ' . $artist[0]->name;
    }*/

    echo '</h4>';
    echo '<div class="desktop-only audio-toggle-v3">';
    echo do_shortcode('[audio_toggle class="mobile"]');
    echo '</div>';
    echo '</div>';

    echo '<div class="artist-songs--body audio-before">';

    echo '<div class="audio-player--player-holder">';

    echo '<div class="play-pause-btn-holder">';
    echo '<div class="play-pause-btn play" target="' . $before_audio . '"><i aria-hidden="true" class="fas fa-play"></i></div>';
    echo '<div class="play-pause-btn pause" target="' . $before_audio . '"><i aria-hidden="true" class="fas fa-pause"></i></div>';
    echo '</div>';

    echo do_shortcode('[audio_box audio_type="before"]');

    /*
    echo '<div class="audio-player--timer desktop-only">';
    echo '<div class="audio-current-time" id="audio-' . $before_audio . '-current-time">00:00</div>';
    echo '<div class="audio-duration" id="audio-' . $before_audio . '-duration">00:00</div>';
    echo '</div>';
    */

    echo '</div>';



    echo '</div>';


    echo '<div class="artist-songs--body audio-after">';

    echo '<div class="audio-player--player-holder">';

    echo '<div class="play-pause-btn-holder">';
    echo '<div class="play-pause-btn play" target="' . $after_audio . '"><i aria-hidden="true" class="fas fa-play"></i></div>';
    echo '<div class="play-pause-btn pause" target="' . $after_audio . '"><i aria-hidden="true" class="fas fa-pause"></i></div>';
    echo '</div>';

    echo do_shortcode('[audio_box audio_type="after"]');


    /*
    echo '<div class="audio-player--timer">';
    echo '<div class="audio-current-time" id="audio-' . $after_audio . '-current-time">00:00</div>';
    echo '<div class="audio-duration" id="audio-' . $after_audio . '-duration">00:00</div>';
    echo '</div>';
    */

    echo '</div>';



    echo '</div>';
    echo '</div>';

    if ($display_artist) {
        echo '</div>';
    }

    echo '<div class="audio-toggle-v4 mobile-only">';
    echo do_shortcode('[audio_toggle]');
    echo '</div>';

    echo '</div>';
    return ob_get_clean();
}
add_shortcode('recordings_box', 'recordings_box');

function artist_box($atts)
{
    ob_start();
    extract(
        shortcode_atts(
            array(
                'term_id' => '',
            ),
            $atts
        )
    );

    $artist = get_term_by('id', $term_id, 'artists');

    $image = carbon_get_term_meta($term_id, 'image');
    $video = carbon_get_term_meta($term_id, 'video');

    echo '<div class="artist-details">';

    echo '<div class="artist-details--image">';
    echo '<div class="image--style">';
    echo wp_get_attachment_image($image, 'medium');
    echo '</div>';
    echo '</div>';



    echo '<div class="artist-details--content">';

    echo '<h3>' . $artist->name . '</h3>';

    echo '<div class="artist-details--desc">';
    echo wpautop($artist->description);
    echo '</div>';

    if ($video) {
        echo '<div><a class="testimonial-fancybox" data-fancybox="video-gallery" href="' . convertToEmbedLink($video) . '" ><svg xmlns="http://www.w3.org/2000/svg" width="52.005" height="37.733" viewBox="0 0 52.005 37.733">
  <g id="Group_1766" data-name="Group 1766" transform="translate(0 -3)">
    <path id="Path_9769" data-name="Path 9769" d="M49,10.28a6.065,6.065,0,0,0-4.233-4.364C41.014,5,26,5,26,5S10.991,5,7.238,6A6.066,6.066,0,0,0,3,10.368,63.275,63.275,0,0,0,2,21.91,63.275,63.275,0,0,0,3,33.54a6.066,6.066,0,0,0,4.233,4.189c3.753,1,18.765,1,18.765,1s15.012,0,18.765-1A6.066,6.066,0,0,0,49,33.365,63.278,63.278,0,0,0,50,21.91,63.272,63.272,0,0,0,49,10.28Z" transform="translate(0)" fill="none" stroke="#fecd55" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"/>
    <path id="Path_9770" data-name="Path 9770" d="M9.75,10.934c0-1.146,0-1.718.239-2.038a1.2,1.2,0,0,1,.875-.478c.4-.028.88.281,1.844.9L22.172,15.4c.836.537,1.254.806,1.4,1.148a1.2,1.2,0,0,1,0,.934c-.144.342-.563.611-1.4,1.148l-9.464,6.084c-.964.62-1.445.929-1.844.9a1.2,1.2,0,0,1-.875-.478c-.239-.32-.239-.892-.239-2.038Z" transform="translate(10.852 4.784)" fill="none" stroke="#fecd55" stroke-linecap="round" stroke-linejoin="round" stroke-width="4"/>
  </g>
</svg> Here from ' . $artist->name . '  </a></div>';
    }

    echo '</div>';

    echo '</div>';
    return ob_get_clean();
}

add_shortcode('artist_box', 'artist_box');


function term_desc($atts)
{
    extract(
        shortcode_atts(
            array(
                'taxonomy' => '',
            ),
            $atts
        )
    );

    $term = get_the_terms(get_the_ID(), $taxonomy);
    return $term[0]->description;
}
add_shortcode('term_desc', 'term_desc');

function plus_minus()
{
    return '<div class="plus-minus-box"> </div>';
}
add_shortcode('plus_minus', 'plus_minus');

function group_products()
{
    global $product;

    // Get the IDs of the child products associated with this grouped product
    // The get_children() method is specific to WC_Product_Grouped objects
    $children_ids = $product->get_children();
    $children_products = '<div class="group-products">';

    // If there are child IDs, loop through them to get the full WC_Product objects
    if (!empty($children_ids)) {
        foreach ($children_ids as $child_id) {
            $children_products .= '<div class="group-product">';
            $children_products .= '<div class="group-product-inner">';
            $children_products .= get_the_title($child_id);
            $children_products .= '</div>';
            $children_products .= '</div>';
        }
    }
    $children_products .= '</div>';
    return $children_products;
}
add_shortcode('group_products', 'group_products');

function group_product_input()
{
    ob_start();
    global $product;
?>
    <input type="checkbox" class="is-group-product" price="<?= $product->get_price() ?>" instrument_id="<?= $product->get_id() ?>"
        name="instruments[]" value="<?= $product->get_name() ?>" id="instrument-<?= $product->get_id() ?>">
<?php
    return ob_get_clean();
}
add_shortcode('group_product_input', 'group_product_input');
