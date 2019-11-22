<?php get_header(); 
  global $post;
  $sponsors = new WP_Query(array(
    'post_type' => 'sponsors',
    'post_per_page' => -1,
    'order' => 'ASC'
  ));

?>

<section class="single-page">

<div class="container">
  <div class="row justify-content-between">
    <div class="col-lg-3">
      <section class="menu-single">
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
    </div>
    <div class="col-lg-7">
      <section class="sponsor-content">
        <div class="inner-wrapper">
          <?php
            if (has_excerpt()) { ?>
              <div class="title-wrapper">
                <h2><?php echo get_the_excerpt() ?></h2>
              </div>
          <?php }
          ?>
          <div class="image-wrapper">
            <img src="<?php echo get_the_post_thumbnail_url($post, 'large') ?>" alt="<?php echo get_the_title() ?>">
          </div>
          <div class="content-wrapper">
            <?php echo wpautop($post->post_content); ?>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
</section>

<?php get_footer() ?>
