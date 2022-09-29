<?php
function block_menu_func($atts, $content = null){
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
  ob_start();
  ?>
      <div class="single-page">
        <section class="menu-single">
          <ul>
            <li><a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo get_the_title( $post->ID ); ?></a></li>
            <?php if ($child->have_posts()) {
              while ($child->have_posts()) {
                $child->the_post(); ?>
                <li class="menu-item"><a href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a></li>
                <?php }
              wp_reset_postdata();
            } ?>
          </ul>
        </section>
      </div>

  <?php
  $r = ob_get_clean();
  return $r;
}
add_shortcode('block_menu', 'block_menu_func');
add_action('vc_before_init', 'block_menu_map');
function block_menu_map()
{
  vc_map(array(
    'name' => __('Block Child Menu', 'my-text-domain'),
    'base' => 'block_menu',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    ));
}