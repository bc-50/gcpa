<?php
function light_box_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title' => null,
    'img' => null,
    'link' => null,
    'check' => 'yes',
    'tcolor' => 'black',
    'ctitle' => 'yes',
    'case' => 'sentence',
    'link_box' => 'no',
    'link_bx' => null
  ), $atts ) );

  $image_src = wp_get_attachment_image_src($img, 'full');
  $link = ($link=='||') ? '' : $link;
  $link = vc_build_link( $link );
  $a_link = $link['url'];
  $a_title = ($link['title'] == '') ? '' : 'title="'.$link['title'].'"';
  $a_target = ($link['target'] == '') ? '' : 'target="'.$link['target'].'"';


  $link_bx = ($link_bx=='||') ? '' : $link_bx;
  $link_bx = vc_build_link( $link_bx );
  $b_link = $link_bx['url'];
  $b_title = ($link_bx['title'] == '') ? '' : 'title="'.$link_bx['title'].'"';
  $b_target = ($link_bx['target'] == '') ? '' : 'target="'.$link_bx['target'].'"';

  ob_start()
  ?>
    <?php echo $link_box == "yes" ? '<a href="'. $b_link .'" style="text-decoration: none">' : '' ?>
    <?php echo $check == "yes" ? '<div class="toggle-content">' : '' ?>
      <section class="light-box" style="background-image: linear-gradient(45deg, rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(<?php echo $image_src[0] ?>)">
        <div class="light-angled">
          <?php if (isset($title)) { ?>
            <div class="title">
              <h3><?php echo $title ?></h3>
              <div class="seperator-wrapper">
                <div class="seperator"></div>
              </div>
            </div>
          <?php } ?>
        </div>
      </section>
      <?php if ($check == 'yes') { ?>
        <section class="green-content reveal-box">
          <div class="inner-wrapper">
            <div class="title-wrapper">
              <?php if ($ctitle == "yes") { ?>
                <h2>
                  <?php echo $title ?>
                  <div class="seperator-wrapper green">
                    <div class="seperator"></div>
                  </div>
                </h2>
              <?php } ?>
            </div>
            <div class="content-wrapper <?php echo $tcolor . " " . $case ?>">
              <?php echo wpautop($content); ?>
            </div>
            <?php if ($a_link != "") { ?>
              <div class="button-wrapper">
                <a href="<?php echo $a_link ?>"><?php echo $link['title'] ?></a>
              </div>
            <?php } ?>
          </div>
        </section>
      <?php echo $check == "yes" ? '</div>' : '' ?>
    <?php } ?>
    <?php echo $link_box == "yes"? '</a>' : '' ?>
  
  <?php
  $r = ob_get_clean();
  return $r;
}
add_shortcode('light_box', 'light_box_func');
add_action('vc_before_init', 'light_box_map');
function light_box_map()
{
  vc_map(array(
    'name' => __('Light Box', 'my-text-domain'),
    'base' => 'light_box',
    "content_element" => true,
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
    array(
      'type' => 'textfield',
      "holder" => "h2",
      'heading' => __( 'Title', 'my-text-domain' ),
      'param_name' => 'title',
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Add Content Title?', 'my-text-domain' ),
      "value" => array(
        'Yes'   => 'yes',
        'No'   => 'no',
      ),
      'param_name' => 'ctitle',
    ),
    array(
      'type' => 'attach_image',
      "holder" => "img",
      'heading' => __( 'Background Image', 'my-text-domain' ),
      'param_name' => 'img',
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
      'type' => 'vc_link',
      'heading' => __( 'Content Button', 'my-text-domain' ),
      'param_name' => 'link',
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Full Box Link', 'my-text-domain' ),
      'description' => __( 'Should entire box link to a page', 'my-text-domain' ),
      "value" => array(
        'No'   => 'no',
        'Yes'   => 'yes',
      ),
      'param_name' => 'link_box',
    ),
    array(
      'type' => 'vc_link',
      'heading' => __( 'Entire Box Link', 'my-text-domain' ),
      'param_name' => 'link_bx',
    ),
  )));
}