<?php
/**
 * Single Event Template
 *
 * A single event complete template, divided in smaller template parts.
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/single-event-blocks.php
 *
 * See more documentation about our Blocks Editor templating system.
 *
 * @link {INSERT_ARTCILE_LINK_HERE}
 *
 * @version 4.7
 *
 */


$is_recurring = '';

if ( ! empty( $event_id ) && function_exists( 'tribe_is_recurring_event' ) ) {
	$is_recurring = tribe_is_recurring_event( $event_id );
}

	$start_date_full = tribe_get_start_date();
	if (strpos($start_date_full,'@') !== false) {
		$at_position = strpos($start_date_full,'@');

		$time = substr($start_date_full,$at_position+1);

		$start_date = substr($start_date_full,0,$at_position);

		$at_position = strpos($start_date,',');

		$start_date = substr($start_date,0,$at_position);
	}else{
		$at_position = strpos($start_date_full,',');
		$start_date = substr($start_date_full,0,$at_position);

		$time = 'All Day';
	}
	$start_date  = tribe_get_start_date($event_id, false);
	$venue = tribe_get_venue_object();
	$venue_name = tribe_get_venue();
if (tribe_get_venue()) {
	$full_veneue = $venue_name;
	$full_veneue = !empty($venue->address) ? $full_veneue . ',' . $venue->address : $full_veneue;
	$full_veneue = !empty($venue->state_province) ? $full_veneue . ',' . $venue->state_province : $full_veneue;
	$full_veneue = !empty($venue->zip) ? $full_veneue . ',' . $venue->zip : $full_veneue;
}

?>

<div id="tribe-events" class="tribe-events-single tribe-blocks-editor">
	<section class="single-event">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="title-wrapper">
						<h2><?php echo get_the_title() ?></h2>
						<div class="seperator-wrapper green"><div class="seperator"></div></div>
					</div>
					<div class="main-content">
						<div class="details">
							<div class="text-wrapper<?php echo !get_the_post_thumbnail_url($event_id, 'large') ? ' w-100' : '' ?>">
								<h3>Details</h3>
								<p>Date: <?php echo $start_date  ?></p>
								<p>Time: <?php echo $time  ?></p>
								<p>Venue: <?php echo $venue_name != '' ? $venue_name : 'To Be Announced' ?></p>
							</div>
							<?php if(get_the_post_thumbnail_url($event_id, 'large')){ ?>
								<div class="image-wrapper">
									<img src="<?php echo get_the_post_thumbnail_url($event_id, 'large') ?>" alt="">
								</div>
							<?php } ?>
							<div class="event-info">
								<?php if(!get_the_post_thumbnail_url($event_id, 'large')){ ?>
									<p class="m-0"></p>
								<?php } ?>
								<?php echo wpautop(get_the_content()) ?>
							</div>
						</div>
					</div>
					<div class="map-wrapper d-none">
						<p><?php echo isset($full_veneue) ? $full_veneue : 'To Be Announced' ?></p>
						<?php if (tribe_get_map_link()) { ?>
							<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo tribe_get_map_link(); ?>&output=embed"></iframe>
						<?php } ?>
					</div>
				</div>
				<?php if (tribe_events_has_tickets()) { ?>
					<div class="col-lg-6">
						<div class="book-tickets">
							<div class="main-book">
								<div class="ticket-bg"></div>
								<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
</div>