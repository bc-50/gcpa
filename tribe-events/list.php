<?php
/**
 * List View Template
 * The wrapper template for a list of events. This includes the Past Events and Upcoming Events views
 * as well as those same views filtered to a specific category.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

	 	 if (!isset($events)) {
			$events = tribe_get_events( [ 
				'posts_per_page' => 3,
				'order' => 'asc',
				'start_date' => 'now'
			] );
		}
	
		/* $date=date_create($events->event_date);
		echo date_format($date,"M"); */
	
		?>
			<section class="up-events">
				<div class="container-fluid">
					<div class="row justify-content-center content-row" id="ajax-posts">
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
                            	<?php echo $event->post_excerpt ? wp_trim_words($event->post_excerpt, 27) : wp_trim_words($event->post_content, 14) ?>
														</div>
														<div class="button-wrapper mt-3">
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
								<div id="more_posts">Load More</div>
							</div>
						</div>
					</div>
				</div>
			</section>

