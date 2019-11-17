<?php
function dom_care_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'parent' => null,
  ), $atts ) );
  ob_start();




  $products = new WP_Query( array( 
    'post_type'   => array('product', 'product_variation'),
    'post_per_page' => -1,
    'order' => 'ASC',
    'orderby' => 'meta_value',
    'meta_key' => '_price'
  ) );


  foreach ($products->posts as $product) {
    if ($product->post_excerpt != '') {
    $att = wc_get_product_variation_attributes( $product->ID );
    $key = key($att);
    $taxonomy = str_replace('attribute_','',$key);
    $product_terms = get_terms(array(
      'taxonomy' => $taxonomy,
    ));?>
      <div class="d-b add-cart" data-cart="<?php echo site_url('cart') ?>/?add-to-cart=<?php echo $product->post_parent ?>&variation_id=<?php echo $product->ID ?>&<?php echo $key ?>=<?php echo $att[$key] ?>"><?php echo $product->post_title ?></div>
    <?php 
    }
    
  }

  
  $r = ob_get_clean();
  return $r;
}
add_shortcode('dom_care', 'dom_care_func');
add_action('vc_before_init', 'dom_care_map');
function dom_care_map()
{
  vc_map(array(
    'name' => __('Domiciliary Care Memberships', 'my-text-domain'),
    'base' => 'dom_care',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
    array(
      'type' => 'vc_link',
      'heading' => __( 'Choose Membership', 'my-text-domain' ),
      'param_name' => 'parent',
    ),
    array(
      'type' => 'textarea_html',
      'heading' => __( 'Content', 'my-text-domain' ),
      'param_name' => 'content',
    ),
  )));
}