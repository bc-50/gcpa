<?php function simple_title_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title' => null,
    'tag' => 'h2',
    'tagTwo' => 'h4',
    'font' => '1.5',
  ), $atts ) );
  $r ='
      <div class="container">
        <div class="row">
          <div class="col-lg" style="padding-top: 2rem;">
           <div class="simple-title">
              <'. $tag .' style="font-size: '. $font . 'em">
                '. $title .'
                <div class="seperator-wrapper green">
                  <div class="seperator"></div>
                </div>
              </'. $tag .'>
           </div>

            <div class="simple-title">
              <'. $tagTwo .' style="margin-top: 1.25rem; font-size: 16px;">
                *Please register or login to order a membership
              </'. $tagTwo .'>
           </div>
          </div>
        </div>
      </div>
  ';
  return $r;
}
add_shortcode('simple_title', 'simple_title_func');
add_action('vc_before_init', 'simple_title_map');
function simple_title_map()
{
  vc_map(array(
    'name' => __('Generic Underline Title', 'my-text-domain'),
    'base' => 'simple_title',
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
      'holder' => 'p',
      'heading' => __( 'Title Tag', 'my-text-domain' ),
      'param_name' => 'tag',
      'value' => array(
        'H1' => 'h1',
        'H2' => 'h2',
        'H3' => 'h3',
        'H4' => 'h4',
        'H5' => 'h5',
        'H6' => 'h6',
      ),
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Font Size', 'my-text-domain' ),
      'description' => __( 'Note: In em', 'my-text-domain' ),
      'param_name' => 'font',
    ),
  )));
}