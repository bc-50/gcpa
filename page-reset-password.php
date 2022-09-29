<?php
get_header();

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<section class="user-login">
  <div class="container" id="customer_login">
    <div class="row justify-content-center">
      <div class="col-sm-7">
        <div class="form-wrapper">
          <h2>First Login Password Reset</h2>
          <form method="post" class="woocommerce-ResetPassword lost_reset_password">
          
            <p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'You must reset your passord on first login. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>
          
            <p class="woocommerce-form-row woocommerce-form-row--first form-row">
              <label for="user_login"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?></label>
              <input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" />
            </p>
          
            <div class="clear"></div>
          
            <?php do_action( 'woocommerce_lostpassword_form' ); ?>
          
            <p class="woocommerce-form-row form-row button-wrapper">
              <input type="hidden" name="wc_reset_password" value="true" />
              <button type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
            </p>
          
            <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>
          
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
do_action( 'woocommerce_after_lost_password_form' );
get_footer();

