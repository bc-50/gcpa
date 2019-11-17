<?php 
function group_light_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title' => null,
  ), $atts ) );
  $boxes = explode('[/light_box]',$content);
  array_pop ($boxes);

  for ($i=0; $i < count($boxes); $i++) { 
    $boxes[$i] = $boxes[$i] . '[/light_box]' ;
  }
  ob_start();  
  ?>
  <div class="light-group">
    <div class="container">
      <div class="row">
        <?php for ($i=0; $i < count($boxes); $i++) { ?>
            <div class="col-lg-6">
              <?php echo do_shortcode($boxes[$i]); ?>
            </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php
  $r = ob_get_clean();
  return $r;
}
add_shortcode('group_light', 'group_light_func');
add_action('vc_before_init', 'group_light_map');
function group_light_map()
{
  vc_map(array(
    'name' => __('Group Light', 'my-text-domain'),
    'base' => 'group_light',
    "as_parent" => array('only' => 'light_box'),
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
    class WPBakeryShortCode_group_light extends WPBakeryShortCodesContainer {
    }
  }
}