<?php 
/* 
Template Name: Single Page Template 
Template Post Type: sponsors,page,approved
*/ ?>

<?php get_header(); 
  global $post;

  $the_term = '';
  $the_tax = '';
  $ptype = $post->post_type;

  $terms = get_terms();
  foreach ($terms as $term) {
    if (has_term($term->term_id,$term->taxonomy,$post)) {
      $the_term = $term->slug;
      $the_tax = $term->taxonomy;
    }
  }


  if ($the_term == '' || $the_tax == '') {
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
          'taxonomy' => $the_tax,
          'field' => 'slug',
          'terms'    => $the_term,
        ),
      ),
    );
  }

  if (is_page() && $post->post_parent) {
    $args['post_parent'] = $post->post_parent;
  }

  $sponsors = new WP_Query($args);
?>

<section class="single-page">

  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-3">
        <section class="menu-single">
          <ul>
            <?php if (is_page()) { ?>
              <li><a href="<?php echo get_permalink( $post->post_parent ); ?>"><?php echo get_the_title( $post->post_parent ); ?></a></li>
            <?php } else { ?>
              <li><a href="<?php echo esc_url(site_url($post->post_type)) ?>"><?php echo str_replace('-',' ',$post->post_type) ?></a></li>
            <?php } ?>
            <?php if ($sponsors->have_posts()) {
              while ($sponsors->have_posts()) {
                $sponsors->the_post(); ?>
                <li class="menu-item"><a href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a></li>
                <?php }
              wp_reset_postdata();
            } ?>
          </ul>
        </section>
      </div>
      <div class="col-lg-8">
        <section class="sponsor-content">
          <div class="inner-wrapper">
            <?php
              if (has_excerpt()) { ?>
                <div class="title-wrapper">
                  <h2><?php echo get_the_excerpt() ?></h2>
                </div>
            <?php }
            if (has_post_thumbnail()) { ?>
              <div class="image-wrapper">
                <a href="<?php echo get_field('link') ? get_field('link') : '#' ?>"><img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php echo get_the_title() ?> Logo"></a>
              </div>
            <?php } ?>
            <div class="content-wrapper">
              <?php echo wpautop(do_shortcode($post->post_content)); ?>
            </div>
          </div>
        </section>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="more-sponsors">
            <h3>Read More From Our Other Sponsors</h3>
        </div>
      </div>
    </div>
    <div class="row logo-row justify-content-center">
      <?php if ($sponsors->have_posts()) {
        while ($sponsors->have_posts()) {
          $sponsors->the_post(); 
            if (has_post_thumbnail()) { ?>
              <div class="col-lg-2">
                <div class="logo-wrapper">
                  <a href="<?php echo get_the_permalink() ?>"><img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php echo get_the_title() ?> Logo"></a>
                </div>
              </div>
            <?php } ?>
          <?php }
        wp_reset_postdata();
      } ?>
    </div>
  </div>
</section>




<?php get_footer() ?>
