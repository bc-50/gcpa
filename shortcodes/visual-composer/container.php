<?php 
function nested_container_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title' => null,
  ), $atts ) );

  $r='
  <div class="container">
    <div class="row">
        <div class="container-wrapper">
          '. do_shortcode($content) .'
        </div>
    </div>
  </div>
  ';
  return $r;
}
add_shortcode('nested_container', 'nested_container_func');
add_action('vc_before_init', 'nested_container_map');
function nested_container_map()
{
  vc_map(array(
    'name' => __('Container', 'my-text-domain'),
    'base' => 'nested_container',
    /* "as_parent" => array('only' => 'plain_content'), */
    "content_element" => true,
    "show_settings_on_create" => true,
    "is_container" => true,
    "js_view"                 => 'VcColumnView',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
    array(
      'type' => 'textfield',
      'heading' => __( 'Title', 'my-text-domain' ),
      'param_name' => 'title',
    ),
  )));


  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_nested_container extends WPBakeryShortCodesContainer {
    }
  }
/*   if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_plain_content extends WPBakeryShortCode {
    }
  }   */
}