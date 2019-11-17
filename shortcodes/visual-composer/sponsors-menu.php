<?php

function sponsors_menu_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
  ), $atts ) );
  $sponsors = new WP_Query(array(
    'post_type' => 'sponsors',
    'post_per_page' => -1,
    'order' => 'ASC'
  ));
  ob_start() ?>
  <section class="sponsor-menu">
    <ul>
      <?php if ($sponsors->have_posts()) {
        while ($sponsors->have_posts()) {
          $sponsors->the_post(); ?>
          <li class="menu-item"><a href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a></li>
          <?php }
        wp_reset_postdata();
      } ?>
    </ul>
  </section>
  
  <?php
  
  
 
  $r = ob_get_clean();
  return $r;
}
add_shortcode('sponsors_menu', 'sponsors_menu_func');
add_action('vc_before_init', 'sponsors_menu_map');
function sponsors_menu_map()
{
  vc_map(array(
    'name' => __('Sponsors Menu', 'my-text-domain'),
    'base' => 'sponsors_menu',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    ));
}