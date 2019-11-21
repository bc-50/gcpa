<?php
function logo_grid_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title' => null,
  ), $atts ) );
  $r ='
      
  ';
  return $r;
}
add_shortcode('logo_grid', 'logo_grid_func');
add_action('vc_before_init', 'logo_grid_map');
function logo_grid_map()
{
  vc_map(array(
    'name' => __('Logo Grid', 'my-text-domain'),
    'base' => 'logo_grid',
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