<?php
/**
 * Renders a link displayed to customers when they must first login
 * before being able to purchase tickets.
 *
 * Override this template in your own theme by creating a file at:
 *
 *     [your-theme]/tribe-events/login-to-purchase.php
 *
 * @version 4.7
 */

$login_url = Tribe__Tickets__Tickets::get_login_url();
?>

<div class="login-wrapper">
  <a href="<?php echo esc_url(site_url('members-login')); ?>"><?php esc_html_e( 'Log in to purchase', 'event-tickets' ); ?></a>
</div>