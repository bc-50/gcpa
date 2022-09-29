<?php

function sponsors_menu_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'ptype' => null,
    'cat' => 'pagetype',
    'term' => 'partner-supplier'
  ), $atts ) );

  if ($cat == '' || $term == '') {
    $args = array(
      'post_type' => $ptype,
      'post_per_page' => -1,
      'order' => 'ASC',
    );
  }else{
    $args = array(
      'post_type' => $ptype,
      'post_per_page' => -1,
      'order' => 'ASC',
      'tax_query' => array(
        array(
          'taxonomy' => $cat,
          'field' => 'slug',
          'terms'    => $term,
        ),
      ),
    );
  }
  $sponsors = new WP_Query($args);
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
  $terms = get_terms();
  $new_terms = array();
  foreach ($terms as $term) {
    $new_terms[$term->name] = $term->slug;
  }

  $taxes = get_taxonomies(array(), 'objects');
  $new_tax = array();
  foreach ($taxes as $tax) {
    $new_tax[$tax->label] = $tax->name;
  }
  $new_terms['None'] = '';
  $new_tax['None'] = '';
  vc_map(array(
    'name' => __('Post Type Menu', 'my-text-domain'),
    'base' => 'sponsors_menu',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
      array(
        'type' => 'posttypes',
        "holder" => "p",
        'heading' => __( 'Post Type', 'my-text-domain' ),
        'param_name' => 'ptype',
      ),
      array(
        'type' => 'dropdown',
        "holder" => "p",
        'heading' => __( 'Category', 'my-text-domain' ),
        'param_name' => 'cat',
        'value' => $new_tax,
      ),
      array(
        'type' => 'dropdown',
        "holder" => "p",
        'heading' => __( 'Term', 'my-text-domain' ),
        'param_name' => 'term',
        'value' => $new_terms,
      ),
    )
    ));
}

