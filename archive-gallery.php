<?php get_header(); 

$galleries = new WP_Query(array(
  'post_type' => 'gallery',
  'order' => 'ASC',
));


?>
<section class="gallery-archive">
  <div class="container">
    <div class="row">
      <?php if ( $galleries->have_posts() ) : while ( $galleries->have_posts() ) : $galleries->the_post(); ?>
        <div class="col-lg-4">
          <div class="single-gal-wrapper">
            <div class="title-wrapper">
              <a href="<?php echo get_the_permalink() ?>"><h3><?php echo get_the_title(); ?></h3></a>
            </div>
            <a href="<?php echo get_the_permalink() ?>"><div class="image-wrapper">
               <?php if (get_the_post_thumbnail_url()) { ?>
                 <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="<?php echo get_the_title() ?> Gallery Thumbnail">
               <?php } else{ ?>
                 <a href="<?php echo get_the_permalink() ?>"><img src="<?php echo get_theme_file_uri('imgs/pin.png') ?>" alt="Default Gallery Thumbnail"></a>
               <?php } ?>
            </div></a>
            <div class="content-wrapper">
              <?php echo wpautop(get_the_content()); ?>
            </div>
          </div>
        </div>
      <?php endwhile; endif; ?>
    </div>
  </div>
</section>
<?php get_footer() ?>
