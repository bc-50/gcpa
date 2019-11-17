<?php
   function main_goal_func($atts, $content = null){
     $r = '';
     extract( shortcode_atts( array(
       'title' => null,
     ), $atts ) );
     $r ='
        <section class="main-goals">
          <div class="main-goals-wrapper">
            <div class="title-wrapper">
              <h2>
              '. $title .'
              <div class="seperator-wrapper green">
                <div class="seperator"></div>
              </div>
              </h2>
            </div>
            <div class="goals">
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
       'name' => __('Main Goals', 'my-text-domain'),
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
     )));
   }