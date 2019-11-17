<?php 
function group_staff_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title' => null,
    'lines' => 'lines',
  ), $atts ) );
  $column = '';
  $boxes = explode('[/staff_box]',$content);
  array_pop ($boxes);

  for ($i=0; $i < count($boxes); $i++) { 
    $boxes[$i] = $boxes[$i] . '[/staff_box]' ;
  }

  if (count($boxes) > 3) {
    $column = '-4';
  }
  ob_start();  
  ?>
  <div class="staff-group">
      <div class="row m-0">
        <div class="col-lg">
          <div class="role-wrapper">
            <h2 class="<?php echo $lines ?>"><?php echo $title ?></h2>
          </div>
        </div>
      </div>
      <div class="row m-0 justify-content-center">
        <?php for ($i=0; $i < count($boxes); $i++) { ?>
            <div class="col-lg<?php echo $column ?> p-0 nth-15">
              <?php echo do_shortcode($boxes[$i]); ?>
            </div>
        <?php } ?>
      </div>
  </div>
  <?php
  $r = ob_get_clean();
  return $r;
}
add_shortcode('group_staff', 'group_staff_func');
add_action('vc_before_init', 'group_staff_map');
function group_staff_map()
{
  vc_map(array(
    'name' => __('Group Members', 'my-text-domain'),
    'base' => 'group_staff',
    "as_parent" => array('only' => 'staff_box'),
    "content_element" => true,
    "show_settings_on_create" => true,
    "is_container" => true,
    "js_view"                 => 'VcColumnView',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
    array(
      'type' => 'textfield',
      'holder' => 'h2',
      'heading' => __( 'Title', 'my-text-domain' ),
      'param_name' => 'title',
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Add Title Lines', 'my-text-domain' ),
      'param_name' => 'lines',
      'value' => array(
        'Yes' => 'lines',
        'No' => 'no-lines',
      ),
    ),
  )));


  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_group_staff extends WPBakeryShortCodesContainer {
    }
  }
}