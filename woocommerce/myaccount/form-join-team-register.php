<?php
/**
 * Teams for WooCommerce Memberships
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Teams for WooCommerce Memberships to newer
 * versions in the future. If you wish to customize Teams for WooCommerce Memberships for your
 * needs please refer to https://docs.woocommerce.com/document/teams-woocommerce-memberships/ for more information.
 *
 * @author    SkyVerge
 * @copyright Copyright (c) 2017-2021, SkyVerge, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

/**
 * Renders the registration & login forms on the join team page.
 *
 * This is basically a duplicate of myaccount/form-login.php, with some exceptions:
 * - registration form is always displayed
 * - register/login sides have been flipped, so that register appears first / on the left
 * - the join team token is included in the registration form to work around redirection issues
 * - translations are escaped
 *
 * Note that the use of 'woocommerce' textdomain is intentional!
 *
 * @type \SkyVerge\WooCommerce\Memberships\Teams\Invitation $invitation invitation object
 * @type string $token invitation token
 *
 * @version 1.0.2
 * @since 1.0.0
 */

defined( 'ABSPATH' ) or exit;

// prefill email from
$reg_email    = ( ! empty( $_POST['email'] ) )    ? $_POST['email']    : ( $invitation ? $invitation->get_email() : '' );
$reg_username = ( ! empty( $_POST['username'] ) ) ? $_POST['username'] : ( $invitation ? sanitize_user( $invitation->get_email() )  : '' );

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<section class="user-login">
	<div class="container" id="customer_login">
		<div class="row">
			<div class="col-lg-6">
				<div class="form-wrapper">
	
					<h2><?php esc_html_e( 'Already Have An Account?', 'woocommerce' ); ?></h2>
					<h2><?php esc_html_e( 'Login Here', 'woocommerce' ); ?></h2>
	
					<form class="woocommerce-form woocommerce-form-login login" method="post">
	
						<?php do_action( 'woocommerce_login_form_start' ); ?>
	
						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
							<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
						</p>
						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
							<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
						</p>
	
						<?php do_action( 'woocommerce_login_form' ); ?>
	
						
						<p class="woocommerce-LostPassword lost_password">
							<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
						</p>
						<p class="form-row">
							<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
								<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
							</label>
							<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
							<div class="button-wrapper">
								<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
							</div>
						</p>
						<?php do_action( 'woocommerce_login_form_end' ); ?>
	
					</form>
	
				</div>
			</div>
	
			<div class="col-lg-6">
				<div class="form-wrapper">
	
					<h2><?php esc_html_e( 'New To GCPA?', 'woocommerce' ); ?></h2>
					<h2><?php esc_html_e( 'Register An Account Here', 'woocommerce' ); ?></h2>
	
					<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
	
						<?php do_action( 'woocommerce_register_form_start' ); ?>
	
						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
	
							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
								<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
							</p>
	
						<?php endif; ?>
	
						<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
							<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
							<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
						</p>
	
						<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
	
							<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
								<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
								<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
							</p>
	
						<?php else : ?>
	
							<p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>
	
						<?php endif; ?>
	
						<?php do_action( 'woocommerce_register_form' ); ?>
            <p class="woocomerce-FormRow form-row">
              <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
              <input type="hidden" name="wc_memberships_for_teams_token" value="<?php echo esc_attr( $token ); ?>" />
              <div class="button-wrapper">
                <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
              </div>
            </p>
						<?php do_action( 'woocommerce_register_form_end' ); ?>
	
					</form>
				</div>
			</div>
		</div>				
	</div>
</section>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
