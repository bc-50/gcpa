<?php
   function main_goal_func($atts, $content = null){
     $r = '';
     extract( shortcode_atts( array(
       'title' => null,
       'check' => 'no',
       'size' => 'no',
     ), $atts ) );
     $small = $size == 'yes' ? ' small' : '';
     $list = $check == "yes" ? 'islist' : '';
     $r ='
        <section class="main-goals">
          <div class="main-goals-wrapper'. $small .'">
            <div class="title-wrapper">
              <h2>
              '. $title .'
              <div class="seperator-wrapper green">
                <div class="seperator"></div>
              </div>
              </h2>
            </div>
            <div class="goals '. $list .'">
              '. $content .'
            </div>
          </div>
        </section>
     ';
     return $r;
   }
   add_shortcode('main_goal', 'main_goal_func');
   add_action('vc_before_init', 'main_goal_map');
   function main_goal_map()
   {
     vc_map(array(
       'name' => __('GCPA List', 'my-text-domain'),
       'base' => 'main_goal',
       'category' => __( 'Brace Elements', 'my-text-domain'),
       'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
       'params' => array(
       array(
         'type' => 'textfield',
         'heading' => __( 'Title', 'my-text-domain' ),
         'param_name' => 'title',
       ),
       array(
         'type' => 'textarea_html',
         'heading' => __( 'Content', 'my-text-domain' ),
         'param_name' => 'content',
       ),
       array(
        'type' => 'dropdown',
        'heading' => __( 'Add Bullet Points?', 'my-text-domain' ),
        "value" => array(
          'No'   => 'no',
          'Yes'   => 'yes',
        ),
        'param_name' => 'check',
      ),
      array(
        'type' => 'dropdown',
        'heading' => __( 'Size', 'my-text-domain' ),
        "value" => array(
          'Responsive'   => 'no',
          'Small'   => 'yes',
        ),
        'param_name' => 'size',
      ),
     )));
   }