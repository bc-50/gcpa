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

$at_position = strpos($start_date_full,'@');

$start_date = substr($start_date_full,0,$at_position);

$time = substr($start_date_full,$at_position+1);
echo $time;
echo $start_date;

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
							<div class="text-wrapper">
								<h3>Details</h3>
								<p>Date: <?php echo $start_date  ?></p>
								<p>Time: <?php echo $time  ?></p>
								<p>Venue: <?php echo tribe_get_venue () ?></p>
							</div>
							<div class="image-wrapper">
								<img src="<?php echo get_the_post_thumbnail_url(null, 'large') ?>" alt="">
							</div>
						</div>
						<div class="event-info">
							<?php echo wpautop(get_the_content()) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>