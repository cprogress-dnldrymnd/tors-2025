<?php
$products = get_posts(array(
  'post_type' => 'product',
  'numberposts' => -1
));
?>

<div class="get-a-quote-form">
  <div class="instruments">
    <div class="row">
      <?php foreach ($products as  $product) { ?>
        <?= $product = wc_get_product($product->ID) ?>
        <div class="col-lg-4">
          <input type="checkbox" name="instruments[]" value="<?= $product->get_name() ?>" id="instrument-<?= $product->get_id() ?>">
          <label for="instrument-<?= $product->get_id() ?>" class="d-flex align-items-center justify-content-between label-box">
            <div class="image-holder">
              <div class="image-box">
                <img src="<?= wp_get_attachment_image_url(get_post_thumbnail_id($product->ID), 'medium') ?>" alt="<?= $product->get_name() ?>">
              </div>
            </div>
            <div class="name-icon-box d-flex align-items-center justify-content-between">
              <div class="name-box">
                <?= $product->get_name() ?>
                <div class="price-box"><?= $product->get_price() ?></div>
              </div>
              <div class="plus-minus-box">

              </div>
            </div>
          </label>
        </div>
      <?Php } ?>
    </div>
  </div>
  <div class="form-box">
    <div class="form-box-header text-center">
      <div class="svg-box">
        <svg xmlns="http://www.w3.org/2000/svg" width="46" height="19" viewBox="0 0 46 19">
          <path id="Polygon_2" data-name="Polygon 2" d="M23,0,46,19H0Z" transform="translate(46 19) rotate(180)"
            fill="#e2e2e2" />
        </svg>
      </div>
    </div>
    <div class="inner">
      <div class="instrument-selection text-center">
        <h4>Your Selection</h4>
        <ul class="selection">

        </ul>
      </div>
      <div class="form">
        <?= do_shortcode('[contact-form-7 id="734" title="Get A Quote"]') ?>
      </div>
    </div>
  </div>
</div>

<script>
  jQuery(document).ready(function() {
    jQuery(".label-box").click(function(event) {

      setTimeout(function() {
        var val = jQuery(".instruments input:checkbox:checked").map(function() {
          return jQuery(this).val();
        }).get(); // <----

        $append = '';
        $textarea_val = '';

        jQuery.each(val, function(index, value) {
          $append = $append + '<li>' + value + '</li>';
          $textarea_val = $textarea_val + value + '\n';
        });

        console.log($append);
        jQuery('.selection').html('');
        jQuery(jQuery($append)).appendTo('.selection');
        jQuery('textarea[name="instruments"]').val($textarea_val);

      }, 100);
    });

    jQuery('.clear-selection').click(function(e) {
      jQuery('.selection').html('');
      jQuery(".instruments input[type='checkbox']").removeAttr('checked');
      jQuery('textarea[name="instruments"]').val('');
    });
  });
</script>