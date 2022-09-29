<?php
function slant_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'phone' => null,
    'email' => null,
  ), $atts ) );
	$tel = str_replace(" ", "", $phone);
	$tel = preg_replace("/^0/", "+44",$tel);
  $r ='
    <section class="angle-container">
      <div class="angle-clip">
        <div class="contact-info">
          <div class="text-fixed">
            <div class="pad-link">
              <div class="phone">
                <p class="">Call us on <a href="tel:'. $tel .'">'. $phone .'</a></p>
              </div>
              <div class="seperator-wrapper green"><div class="seperator"></div></div>
              <div class="email">
                <a href="mailto:care@gcpa.co.uk">'. $email .'</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  ';
  return $r;
}
add_shortcode('slant', 'slant_func');
add_action('vc_before_init', 'slant_map');
function slant_map()
{
  vc_map(array(
    'name' => __('Angled Box', 'my-text-domain'),
    'base' => 'slant',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
    array(
      'type' => 'textfield',
      'heading' => __( 'Phone', 'my-text-domain' ),
      'param_name' => 'phone',
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Email', 'my-text-domain' ),
      'param_name' => 'email',
    ),
  )));
}