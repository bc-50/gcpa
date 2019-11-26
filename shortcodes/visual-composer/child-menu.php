<?php
function child_menu_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title' => null,
  ), $atts ) );
global $post;
  $args = array(
    'post_type' => $post->post_type,
    'post_per_page' => -1,
    'order' => 'ASC',
    'post_parent' => $post->ID
  );

  $child = new WP_Query($args);
  ob_start() ?>
  <section class="sponsor-menu">
    <ul>
      <?php if ($child->have_posts()) {
        while ($child->have_posts()) {
          $child->the_post(); ?>
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
add_shortcode('child_menu', 'child_menu_func');
add_action('vc_before_init', 'child_menu_map');
function child_menu_map()
{
  vc_map(array(
    'name' => __('Child Pages Menu', 'my-text-domain'),
    'base' => 'child_menu',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    ));
}