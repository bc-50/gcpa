<?php

function plain_content_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'title_t' => null,
    'title_b' => null,
    'link' => null,
  ), $atts ) );
  $link = ($link=='||') ? '' : $link;
  $link = vc_build_link( $link );
  $a_link = $link['url'];
  $a_title = ($link['title'] == '') ? '' : 'title="'.$link['title'].'"';
  $a_target = ($link['target'] == '') ? '' : 'target="'.$link['target'].'"';
  ob_start() ?>

    <section class="normal-text pad-link <?php echo isset($title_t) || isset($title_b) ? 'temp-fix' : '' ?>">
      <?php if (isset($title_t) || isset($title_b)) { ?>
        <div class="title-wrapper">
        <h2><?php echo $title_t ?></h2>
        <h2><?php echo $title_b ?></h2>
      </div>
      <?php } ?>
      <div class="content-wrapper">
        <?php echo wpautop($content) ?>
      </div>
      <?php if ($a_link != "") { ?>
        <div class="norm-button-wrapper">
          <a href="<?php echo $a_link?>"><?php echo $link['title'] ?></a>
        </div>
      <?php } ?>
    </section>
  <?php
  $r = ob_get_clean();
  return $r;
}
add_shortcode('plain_content', 'plain_content_func');
add_action('vc_before_init', 'plain_content_map');
function plain_content_map()
{
  vc_map(array(
    'name' => __('Normal Content', 'my-text-domain'),
    'base' => 'plain_content',
    "content_element" => true,
    /* "as_child" => array('only' => 'nested_container'), */
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    'params' => array(
    array(
      'type' => 'textfield',
      'heading' => __( 'Title Top', 'my-text-domain' ),
      'param_name' => 'title_t',
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Title Bottom', 'my-text-domain' ),
      'param_name' => 'title_b',
    ),
    array(
      'type' => 'textarea_html',
      'heading' => __( 'Content', 'my-text-domain' ),
      'param_name' => 'content',
    ),
    array(
      'type' => 'vc_link',
      'heading' => __( 'Content', 'my-text-domain' ),
      'param_name' => 'link',
    ),
  )));

  
}