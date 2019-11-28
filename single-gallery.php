<?php
get_header();
global $post;
$image_ids = get_post_meta($post->ID, 'my_details');
$count = 1;

?>

<section class="image-gallery">
    <div class="container">
      <div class="row" id="gallery-row">
        <?php foreach ($image_ids[0] as $image_id) { ?>
        <?php $image =  wp_get_attachment_image_url( $image_id, 'large');?>
          <div class="col-lg-4 col-md-6 gallery-column gallery-col">
            <div class="single-gallery-image" data-src="<?php echo $image ?>" data-target="#image<?php echo $count ?>"></div>
            <div class="gallery-pop-up" id="image<?php echo $count++ ?>">
              <div class="inner-pop">
                <img src="<?php echo $image ?>" alt="">
              </div>
            </div>
          </div>
          
        <?php } ?>
      </div>
    </div>
</section>

<?php get_footer() ?>