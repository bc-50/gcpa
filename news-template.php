<?php 
/* 
Template Name: News Page Template 
Template Post Type: page
*/ 
get_header();

if (!is_user_logged_in()) {
  wp_redirect(site_url(), '301');
}
global $post;
$posts = new WP_Query(array(
  'post_type' => 'post'
));
?>

<section class="news-posts">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <h2 class="heading"><?php echo $post->post_content; ?></h2>
      </div>
    </div>
    <?php if ( $posts->have_posts() ) : while ( $posts->have_posts() ) : $posts->the_post(); ?>
        <div class="row justify-content-center">
          <div class="col-lg-4 title-column">
            <section class="light-box" style="background-image: linear-gradient(45deg, rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(<?php echo get_the_post_thumbnail_url() ?>)">
              <a href="<?php echo get_the_permalink() ?>" class="light-angled">
                  <div class="title">
                    <h3><?php echo get_the_title() ?></h3>
                    <div class="seperator-wrapper">
                      <div class="seperator"></div>
                    </div>
                  </div>
              </a>
            </section>
          </div>
          <div class="col-lg-6">
            <div class="news-ex-wrapper">
              <h2><?php echo get_the_title() ?></h2>
              
              <div class="news-excerpt">
                <?php echo wpautop(wp_trim_words(get_the_content(), 40)) ?>
              </div>
              
              <div class="read-more">
                <a href="<?php echo get_the_permalink() ?>">Read More</a>
              </div>
            </div>
          </div>
        </div>
    <?php endwhile;?>
    <?php endif; ?>
    <div class="row">
      <div class="paginate">
        <?php echo paginate_links(); ?>
      </div> 
    </div>
  </div>
</section>
<?php get_footer(); ?>