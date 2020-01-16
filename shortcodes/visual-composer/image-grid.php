<?php
function image_grid_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'grows' => null,
  ), $atts ) );

  $rows = vc_param_group_parse_atts( $atts['grows'] );

  ob_start();
  ?>
    <div class="container">
      <?php foreach ($rows as $row) { ?>
        <?php
          if (isset($row['rlink'])) {
            $row['rlink'] = ($row['rlink']=='||') ? '' : $row['rlink'];
            $row['rlink'] = vc_build_link( $row['rlink'] );
            $a_link = $row['rlink']['url'];
            $a_title = ($row['rlink']['title'] == '') ? '' : 'title="'.$row['rlink']['title'].'"';
            $a_target = ($row['rlink']['target'] == '') ? '' : 'target="'.$row['rlink']['target'].'"';
          }

          if (isset($row['llink'])) {
            $row['llink'] = ($row['llink']=='||') ? '' : $row['llink'];
            $row['llink'] = vc_build_link( $row['llink'] );
            $b_link = $row['llink']['url'];
            $b_title = ($row['llink']['title'] == '') ? '' : 'title="'.$row['llink']['title'].'"';
            $b_target = ($row['llink']['target'] == '') ? '' : 'target="'.$row['llink']['target'].'"';
          }
        ?>
        <div class="row justify-content-between grid-row">
          <div class="col-md-6">
            <a href="<?php echo $b_link ?>" class="grid-wrapper" style="background-image: url(<?php echo isset($row['limg']) ? wp_get_attachment_image_src($row['limg'], 'full')[0] : ''; ?>)">
            </a>
          </div>
          <div class="col-md-6">
            <a href="<?php echo $a_link ?>" class="grid-wrapper" style="background-image: url(<?php echo isset($row['rimg']) ? wp_get_attachment_image_src($row['rimg'], 'full')[0] : ''; ?>)">
            </a>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php
  $r = ob_get_clean();
  return $r;
}
add_shortcode('image_grid', 'image_grid_func');
add_action('vc_before_init', 'image_grid_map');
function image_grid_map()
{
  vc_map(array(
    'name' => __('Image Grid', 'my-text-domain'),
    'base' => 'image_grid',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
     array(
      'type' => 'param_group',
      'heading' => 'Rows',
      'param_name' => 'grows',
      'params' => array(
        array(
          'type' => 'attach_image',
          'holder' => 'img',
          'heading' => __( 'Left Image', 'my-text-domain' ),
          'param_name' => 'limg',
        ),
        array(
          'type' => 'vc_link',
          'heading' => __( 'Left Link', 'my-text-domain' ),
          'param_name' => 'llink',
        ),
        array(
          'type' => 'attach_image',
          'holder' => 'img',
          'heading' => __( 'Right Image', 'my-text-domain' ),
          'param_name' => 'rimg',
        ),
        array(
          'type' => 'vc_link',
          'heading' => __( 'Right Link', 'my-text-domain' ),
          'param_name' => 'rlink',
        ),
    ))
  )));
}