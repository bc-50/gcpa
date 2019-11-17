<?php
function content_green_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title' => null,
    'link' => null,
  ), $atts ) );
$link = ($link=='||') ? '' : $link;
$link = vc_build_link( $link );
$a_link = $link['url'];
$a_title = ($link['title'] == '') ? '' : 'title="'.$link['title'].'"';
$a_target = ($link['target'] == '') ? '' : 'target="'.$link['target'].'"';
  ob_start();
  ?>
    <section class="green-content">
      <div class="inner-wrapper">
        <div class="title-wrapper">
          <h2>
            <?php echo $title ?>
            <div class="seperator-wrapper green">
              <div class="seperator"></div>
            </div>
          </h2>
        </div>
        <div class="content-wrapper">
          <?php echo wpautop($content); ?>
        </div>
        <?php if ($a_link != "") { ?>
          <div class="button-wrapper">
            <a href="<?php echo $a_link ?>"><?php echo $link['title'] ?></a>
          </div>
        <?php } ?>
      </div>
    </section>
  <?php
  $r = ob_get_clean();
  return $r;
}
add_shortcode('content_green', 'content_green_func');
add_action('vc_before_init', 'content_green_map');
function content_green_map()
{
  vc_map(array(
    'name' => __('Content Green', 'my-text-domain'),
    'base' => 'content_green',
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
      'type' => 'vc_link',
      'heading' => __( 'Button', 'my-text-domain' ),
      'param_name' => 'link',
    ),
  )));
}