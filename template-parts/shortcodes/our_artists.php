<?php
$args = array(
  'post_type'      => 'recordings',
  'posts_per_page' => -1,
);
$query = new WP_Query($args);
?>
<?php if ($query->have_posts()) { ?>
  <div class="our-recordings">
    <div class="container">
      <div class="swiper mySwiperRecordings">
        <div class="swiper-wrapper">
          <?php while ($query->have_posts()) { ?>
            <?php
            $query->the_post();
            $artist = get_the_terms(get_the_ID(), 'artists')[0]->name;
            $background_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
            ?>
            <!-- Swiper -->
            <div class="swiper-slide">
              <div class="recording-box" style="background-image: url(<?= $background_image ?>)">
                <div class="inner">
                  <div class="name-box">
                    <h3><?= $artist ?></h3>
                  </div>
                  <div class="title-box">
                    <span><?php the_title() ?></span>
                  </div>
                  <div class="audio-box-wrapper before-active">
					  <?= do_shortcode('[audio_toggle]') ?>
					  <?= do_shortcode('[audio_box audio_type="before"]') ?>
					  <?= do_shortcode('[audio_box audio_type="after"]') ?>
                  </div>
                </div>
              </div>
              <div class="text-box">
                <?= wpautop(get_the_content()) ?>
              </div>

            </div>
          <?php } ?>
          <?php
          wp_reset_postdata();
          ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>
<?php } else { ?>
  <div class="no-post">
    <p>No recordings found</p>
  </div>
<?php } ?>