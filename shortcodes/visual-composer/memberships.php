<?php

function memberships_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title' => null,
	), $atts ) );
	$dom_care = new WP_Query( array( 
    'post_type'   => array('product', 'product_variation'),
    'post_per_page' => -1,
    'order' => 'ASC',
    'orderby' => 'meta_value',
		'meta_key' => '_price',
		'post_parent' => 356
	) );
	
	$care_home = new WP_Query( array( 
    'post_type'   => array('product', 'product_variation'),
    'post_per_page' => -1,
    'order' => 'ASC',
    'orderby' => 'meta_value',
		'meta_key' => '_price',
		'post_parent' => 340
  ) );
  ob_start(); ?>
<div class="light-group choose-memebership">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="toggle-content">
          <section class="light-box" style="background-image: linear-gradient(45deg, rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(//localhost:3000/gcpa/wp-content/uploads/2019/11/community.jpg)">
            <div class="light-angled">
              <div class="title">
                <h3>Care Home</h3>
                <div class="seperator-wrapper">
                  <div class="seperator"></div>
                </div>
              </div>
            </div>
          </section>
          <section class="green-content reveal-box">
						<div class="inner-wrapper">
							<div class="title-wrapper">
								<h2>
									Care Home
									<div class="seperator-wrapper green">
										<div class="seperator"></div>
									</div>
								</h2>
							</div>
							<select name="choice" id="membeship-choice-care">
								<?php
								foreach ($care_home->posts as $other_product) {
									if ($other_product->post_excerpt != '') {
									$att = wc_get_product_variation_attributes( $other_product->ID );
									$key = key($att);
									$taxonomy = str_replace('attribute_','',$key);
									$product_terms = get_terms(array(
										'taxonomy' => $taxonomy,
									));
									$target = site_url('cart') . '/?add-to-cart=' . $other_product->post_parent. '&variation_id=' . $other_product->ID. '&' .$key . '=' . $att[$key]; ?>
										<option class="d-b add-cart" value="<?php echo $target ?>"><?php echo $other_product->post_title ?></option>
										
									<?php 
									}
								} 
								wp_reset_postdata();
								?>
							</select>
							<div class="proceed-wrapper">
								<button class="add-cart-care">Choose Membership</button>
							</div>
            </div>
          </section>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="toggle-content">
          <section class="light-box" style="background-image: linear-gradient(45deg, rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(//localhost:3000/gcpa/wp-content/uploads/2019/11/community.jpg)">
            <div class="light-angled">
              <div class="title">
                <h3>Domiciliary Care</h3>
                <div class="seperator-wrapper">
                  <div class="seperator" ></div>
                </div>
              </div>
            </div>
          </section>
          <section class="green-content reveal-box">
						
            <div class="inner-wrapper">
							<div class="title-wrapper">
								<h2>
									Domiciliary Care
									<div class="seperator-wrapper green">
										<div class="seperator"></div>
									</div>
								</h2>
							</div>
							<select name="choice" id="membeship-choice-dom">
								<?php
								foreach ($dom_care->posts as $product) {
									if ($product->post_excerpt != '') {
									$att = wc_get_product_variation_attributes( $product->ID );
									$key = key($att);
									$taxonomy = str_replace('attribute_','',$key);
									$product_terms = get_terms(array(
										'taxonomy' => $taxonomy,
									));
									$target = site_url('cart') . '/?add-to-cart=' . $product->post_parent. '&variation_id=' . $product->ID. '&' .$key . '=' . $att[$key]; ?>
										<option class="d-b add-cart" value="<?php echo $target ?>"><?php echo $product->post_title ?></option>
										
									<?php 
									}
								} 
								wp_reset_postdata();
								?>
							</select>
							<div class="proceed-wrapper">
								<button class="add-cart-dom">Choose Membership</button>
							</div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <?php
  $r = ob_get_clean();
  return $r;
}
add_shortcode('memberships', 'memberships_func');
add_action('vc_before_init', 'memberships_map');
function memberships_map()
{
  vc_map(array(
    'name' => __('Memberships', 'my-text-domain'),
    'base' => 'memberships',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
    array(
      'type' => 'textfield',
      'holder' => 'p',
      'heading' => __( 'Title', 'my-text-domain' ),
      'param_name' => 'title',
    ),
    array(
      'type' => 'textarea_html',
      'holder' => 'p',
      'heading' => __( 'Content', 'my-text-domain' ),
      'param_name' => 'content',
    ),
  )));
}