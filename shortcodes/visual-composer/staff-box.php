<?php
function staff_box_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title' => null,
    'check' => 'yes',
    'tcolor' => 'black',
    'case' => 'sentence',
    'mem' => 'mem',
  ), $atts ) );

  ob_start()
  ?>
    <?php echo $check == "yes" ? '<div class="toggle-content">' : '' ?>
      <section class="staff-box">
          <?php if (isset($title)) { ?>
            <div class="title">
              <h3><?php echo $title ?></h3>
            </div>
          <?php } ?>
      </section>
      <?php if ($check == 'yes') { ?>
        <section class="staff-reveal reveal-box <?php echo $mem ?>">
          <div class="inner-wrapper">
            <div class="content-wrapper <?php echo $tcolor . " " . $case ?>">
              <h2><?php echo $title ?></h2>
              <?php echo wpautop($content); ?>
            </div>
          </div>
        </section>
      <?php echo $check == "yes" ? '</div>' : '' ?>
    <?php } ?>
  
  <?php
  $r = ob_get_clean();
  return $r;
}
add_shortcode('staff_box', 'staff_box_func');
add_action('vc_before_init', 'staff_box_map');
function staff_box_map()
{
  vc_map(array(
    'name' => __('Staff Box', 'my-text-domain'),
    'base' => 'staff_box',
    "content_element" => true,
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
    array(
      'type' => 'textfield',
      "holder" => "h2",
      'heading' => __( 'Name', 'my-text-domain' ),
      'param_name' => 'title',
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Add Content?', 'my-text-domain' ),
      "value" => array(
        'Yes'   => 'yes',
        'No'   => 'no',
      ),
      'param_name' => 'check',
    ),
    array(
      'type' => 'textarea_html',
      "holder" => "p",
      'heading' => __( 'Content', 'my-text-domain' ),
      'param_name' => 'content',
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Content Color', 'my-text-domain' ),
      "value" => array(
        'Black'   => 'black',
        'Green'   => 'green',
      ),
      'param_name' => 'tcolor',
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Text Case', 'my-text-domain' ),
      "value" => array(
        'Sentence Case'   => 'sentence',
        'Upper Case'   => 'upper',
      ),
      'param_name' => 'case',
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Member Box?', 'my-text-domain' ),
      'param_name' => 'mem',
      'value' => array(
        'Yes' => 'mem',
        'No' => 'non-mem',
      ),
    )
  )));
}