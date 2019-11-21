<?php
function gallery_func($atts, $content = null){
  $r = '';
  $gallery = shortcode_atts( array(
    'imgs' => 'imgs',
  ), $atts );

  $image_ids = explode(',',$gallery['imgs']);
  $count = 1;

  ob_start();

  $gallery = new WP_Query(array(
    'post_type' => 'my',
    'meta_query' => array(
      array(
        'meta_key' => 'my_details',
        'compare' => 'EXISTS'
      )
    ),
  
  ));
 var_dump($gallery->query_vars);

  if ( $gallery->have_posts() ) : while ( $gallery->have_posts() ) : $gallery->the_post(); 
  var_dump(get_post_meta(get_the_ID()));
    endwhile; endif;


  ?>

    <section class="image-gallery">
        <div class="container">
          <div class="row">
            <?php foreach ($image_ids as $image_id) { ?>
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
  vc_map(array(
    'name' => __('Gallery', 'my-text-domain'),
    'base' => 'gallery',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
      array(
        'type' => 'attach_images',
        'heading' => __( 'Images', 'my-text-domain' ),
        'param_name' => 'imgs',
      ),
  )));
}