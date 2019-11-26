<?php
function gallery_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'gal' => '0',
  ), $atts ) );

  $count = 1;

  ob_start();

  $the_gallery = new WP_Query(array(
    'post_type' => 'my',
    'p' => $gal,
  ));

  

$image_ids = get_post_meta($the_gallery->posts[0]->ID, 'my_details');
   ?>

    <section class="image-gallery">
        <div class="container">
          <div class="row">
            <?php foreach ($image_ids[0] as $image_id) { ?>
            <?php $image =  wp_get_attachment_image_url( $image_id, 'large');?>
              <div class="col-lg-4 col-md-6 gallery-column gallery-col">
                <div class="single-gallery-image" data-src="<?php echo $image ?>" data-target="#image<?php echo $count ?>"></div>
              </div>
              <div class="gallery-pop-up" id="image<?php echo $count++ ?>">
                  <div class="inner-pop">
                    <img src="<?php echo $image ?>" alt="">
                  </div>
              </div>
            <?php } ?>
          </div>
        </div>
    </section>

  <?php

  $r = ob_get_clean(); 
  return $r;
}
add_shortcode('gallery', 'gallery_func');
add_action('vc_before_init', 'gallery_map');
function gallery_map()
{

  $gallery = new WP_Query(array(
    'post_type' => 'my', 
  ));

  $galleries = $gallery->posts;
  $choice = array();
  foreach ($galleries as $gal) {
    $choice[$gal->post_title] = $gal->ID;
  }
  wp_reset_postdata();
  vc_map(array(
    'name' => __('Gallery', 'my-text-domain'),
    'base' => 'gallery',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
      array(
        'type' => 'dropdown',
        "holder" => "p",
        'heading' => __( 'Category', 'my-text-domain' ),
        'param_name' => 'gal',
        'value' => $choice,
      ),
  )));
}