<?php 
function tribe_events_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title' => null,
  ), $atts ) );

  $events = tribe_get_events( [ 
    'posts_per_page' => 3, 
  ] );

  foreach ($events as $event) {
    $venue = tribe_get_venue_object( $event );
    var_dump($venue);
  }


  $events2 = new WP_Query(array(
    'post_type' => 'tribe_events'
  ));

  var_dump($events2);

  ob_start(); ?>

  

  

<?php
  $r = ob_get_clean();
  return $r;
}
add_shortcode('tribe_events', 'tribe_events_func');
add_action('vc_before_init', 'tribe_events_map');
function tribe_events_map()
{
  vc_map(array(
    'name' => __('Tribe Events', 'my-text-domain'),
    'base' => 'tribe_events',
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