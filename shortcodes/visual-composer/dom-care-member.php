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
  ) ); ?>

  <select name="choice" id="membeship-choice">
    <?php
    foreach ($products->posts as $product) {
      if ($product->post_excerpt != '') {
      $att = wc_get_product_variation_attributes( $product->ID );
      $key = key($att);
      $taxonomy = str_replace('attribute_','',$key);
      $product_terms = get_terms(array(
        'taxonomy' => $taxonomy,
      ));
      // $target = site_url('cart') . '/?add-to-cart=' . $product->post_parent. '&variation_id=' . $product->ID. '&' .$key . '=' . $att[$key]; 
      $target = 0; 
      ?>
        <option class="d-b add-cart" value="<?php echo $target ?>"><?php echo $product->post_title ?></option>
        
      <?php 
      }
    } ?>
  </select>
  <button class="add-cart">Add To Cart</button>
  <?php
 wp_reset_postdata(); 
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