<?php
$products = get_posts(array(
  'post_type' => 'product',
  'numberposts' => -1,
  'fields' => 'ids',
  'tax_query' => array(
    array(
      'taxonomy' => 'product_cat',
      'field'    => 'slug',
      'terms'    => 'instruments'
    )
  )
));
?>

<div class="get-a-quote-form">
  <div class="instruments">
    <div class="row">
      <?php foreach ($products as  $product_id) { ?>
        <?php $product = wc_get_product($product_id) ?>
        <div class="col-lg-4">
          <input type="checkbox" instrument_id="<?= $product->get_id() ?>" name="instruments[]" value="<?= $product->get_name() ?>" id="instrument-<?= $product->get_id() ?>">
          <label for="instrument-<?= $product->get_id() ?>" class="d-flex align-items-center justify-content-between label-box">
            <div class="image-holder">
              <div class="image-box">
                <img src="<?= wp_get_attachment_image_url($product->get_image_id(), 'medium') ?>" alt="<?= $product->get_name() ?>">
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
    jQuery(".instrument--box").click(function(event) {
      setTimeout(function() {
        var val_name = jQuery(".instruments input:checkbox:checked").map(function() {
          return jQuery(this).val();
        }).get();
        var val_ids = jQuery(".instruments input:checkbox:checked").map(function() {
          return jQuery(this).attr('instrument_id');
        }).get();

        $append = '';
        $textarea_val = '';
        $textarea_val_ids = '';

        jQuery.each(val_name, function(index, value) {
          $append = $append + '<li>' + value + '</li>';
          $textarea_val = $textarea_val + value + '\n';
        });

        jQuery.each(val_ids, function(index, value) {
          $textarea_val_ids = $textarea_val_ids + value + '\n';
        });

        jQuery('.selection').html('');
        jQuery(jQuery($append)).appendTo('.selection');
        jQuery('textarea[name="instruments"]').val($textarea_val);
        jQuery('textarea[name="instruments_id"]').val($textarea_val_ids);

      }, 100);
    });

    jQuery('.clear-selection').click(function(e) {
      jQuery('.selection').html('');
      jQuery(".instruments input[type='checkbox']").removeAttr('checked');
      jQuery('textarea[name="instruments"]').val('');
    });
  });
</script>