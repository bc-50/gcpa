<?php
function upcoming_func($atts, $content = null){
  $r = '';
  extract( shortcode_atts( array(
    'events' => null,
  ), $atts ) );
 /*  $events = new WP_Query(array(
    'post_type'			=> 'post',
    'post_per_page' => '3',
    'orderby' => 'date',
    'order' => 'ASC'
  )); */

  if (!isset($events)) {
    $events = tribe_get_events( [ 
      'posts_per_page' => 3, 
			'order' => 'desc',
      ] );
  }

  ob_start();

  ?>
    <section class="up-events">
      <div class="container-fluid">
        <div class="row justify-content-center title-row">
          <div class="col-lg-4">
            <div class="title-wrapper">
              <h2>
                Upcoming Events
                <div class="seperator-wrapper green">
                  <div class="seperator"></div>
                </div>
              </h2>
              
            </div>
          </div>
        </div>
        <div class="row justify-content-center content-row">
          <?php if(count($events) > 0):
                foreach ($events as $event): 
                $the_date = array();
                if (isset($event->event_date)) {
                  $date=date_create($event->event_date);
                  array_push($the_date, date_format($date,"M"), date_format($date,"d"));
                } 
                
                ?>
                  <div class="col-lg-4">
                    <div class="event-wrapper">
                      <div class="image-wrapper" style="background-image: linear-gradient(13deg,rgba(21,41,107,.5) 49%,transparent 49.33%), url(<?php echo get_the_post_thumbnail_url($event, 'full') ?>)"></div>
                      <div class="event-info">
                        <div class="date">
                          <div class="date-wrapper">
                            <?php if (!empty($the_date)) { ?>
                              <p><?php echo $the_date[0] ?></p>
                              <p><?php echo $the_date[1] ?></p>
                            <?php $the_date = null; } ?>
                          </div>
                        </div>
                        <div class="text-content">
                          <div class="title-wrapper">
                            <h3><?php echo $event->post_title ?></h3>
                          </div>
                          <div class="content-wrapper">
                            <?php echo $event->post_excerpt ? $event->post_excerpt : wp_trim_words($event->post_content, 14) ?>
                          </div>
                          <div class="button-wrapper">
                            <a href="<?php echo esc_url(get_the_permalink($event)) ?>">Book Now</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>

          <?php endif; ?>
        </div>
        <div class="row justify-content-center button-row">
          <div class="col-lg-3">
            <div class="button-wrapper">
              <a href="<?php echo esc_url(site_url('events')) ?>">All Events</a>
            </div>
          </div>
        </div>
      </div>
    </section>

  <?php
  $r= ob_get_clean();
  return $r;
}
add_shortcode('upcoming', 'upcoming_func');
add_action('vc_before_init', 'upcoming_map');
function upcoming_map()
{
  vc_map(array(
    'name' => __('Upcoming Events', 'my-text-domain'),
    'base' => 'upcoming',
    'category' => __( 'Brace Elements', 'my-text-domain'),
    'icon' => get_template_directory_uri().'/shortcodes/visual-composer/vc-brace-icon.png',
    ));
}