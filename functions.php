<?php
require_once('inc/custom-post-types.php');
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
require_once get_template_directory() . '/inc/svg.php';
error_reporting(E_ALL);
    ini_set("display_errors", 1);



function theme_files()
{
 
  wp_enqueue_script('Main-Scripts', get_theme_file_uri('js/scripts.min.js'), NULL, microtime(), true);
  wp_enqueue_style('MyStyles', get_stylesheet_uri());
  wp_enqueue_style('Hamburger', get_theme_file_uri('lib/hamburgers.min.css'));
  wp_enqueue_script('BootstrapJS', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js', array('jquery'));
  wp_enqueue_style('Bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
  wp_enqueue_script('Jquerysc', 'https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js');
  wp_enqueue_style('FontAwes', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css');
  wp_localize_script( 'Main-Scripts', 'ajax_posts', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'noposts' => __('No older posts found', 'event'),
  ));
  


  /* fonts */
  wp_enqueue_style('Montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap');
  
}

add_action('wp_enqueue_scripts', 'theme_files');

/* Extra theme support */
function extra_theme_support()
{
  register_nav_menus(array(
    'primary' => __('Primary Menu')
  ));
  add_theme_support( 'title-tag' );
}

add_action('after_setup_theme', 'extra_theme_support');

add_theme_support( 'post-thumbnails' );

add_action('init', 'brace_autoload_shortcodes', 1);
function brace_autoload_shortcodes(){
    $dir = get_stylesheet_directory() . '/shortcodes/visual-composer';
    $pattern = $dir . '/*.php';
    
    $files = glob($pattern);
    foreach($files as $file){
        $parts = pathinfo($file);
        $name = $parts['filename'];
        
        require_once($file);        
    }
  }



  function more_post_ajax(){

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 3;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

    header("Content-Type: text/html");

    $loops = tribe_get_events( [ 
      'posts_per_page' => $ppp, 
      'paged'    => $page,
			'order' => 'desc',
      ] );

    $out = '';

    foreach ($loops as $loop):
        $the_date = array();
        if (isset($loop->event_date)) {
          $date=date_create($loop->event_date);
          array_push($the_date, date_format($date,"M"), date_format($date,"d"));
        } 
        $out .= '
        <div class="col-lg-4">
											<div class="event-wrapper">
												<div class="image-wrapper" style="background-image: linear-gradient(13deg,rgba(21,41,107,.5) 49%,transparent 49.33%), url('. get_the_post_thumbnail_url($loop, 'full') .')"></div>
												<div class="event-info">
													<div class="date">
														<div class="date-wrapper">';
															 if (!empty($the_date)) { 
																$out .= '<p>'.  $the_date[0] .'</p>
																<p>'.  $the_date[1] .'</p>'; 
                                $the_date = null; };
                          $out .=	'</div>
													</div>
													<div class="text-content">
														<div class="title-wrapper">
															<h3>'. $loop->post_title .'</h3>
														</div>
														<div class="content-wrapper">
															'.  $loop->post_content .'
														</div>
														<div class="button-wrapper">
															<a href="'. esc_url(get_the_permalink($loop)) .'">Book Now</a>
														</div>
													</div>
												</div>
											</div>
										</div>
         ';

    endforeach;
    wp_reset_postdata();
    die($out);
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');


function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {
  if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
         $validation_errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
  }
  if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
         $validation_errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );
  }
  /* if ( isset( $_POST['registered_manager'] ) && empty( $_POST['registered_manager'] ) ) {
    $validation_errors->add( 'registered_manager', __( '<strong>Error</strong>: Registered Manager is required!.', 'woocommerce' ) );
} */
     return $validation_errors;
}
add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );

function wooc_extra_register_fields() {?>
  <p class="form-row form-row-wide">
  <label for="reg_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?></label>
  <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php if ( ! empty( $_POST['billing_phone'] ) ) esc_attr_e( $_POST['billing_phone'] ); ?>" />
  </p>
  <p class="form-row form-row-first">
  <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>
  <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
  </p>
  <p class="form-row form-row-last">
  <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?><span class="required">*</span></label>
  <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
  </p>
 <!--  <p class="form-row form-row-wide">
  <label for="reg_mang"><?php  _e( 'Registered Manager', 'woocommerce' ); ?><span class="required">*</span></label>
  <input type="text" class="input-text" name="registered_manager" id="reg_mang" value="<?php if ( ! empty( $_POST['registered_manager'] ) ) esc_attr_e( $_POST['registered_manager'] ); ?>" />
  </p> -->
  
  <div class="clear"></div>
  <?php
}
add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );

function woocommerce_edit_my_account_page() {
  return apply_filters( 'woocommerce_forms_field', array(
      'kc_custom_change' => array(
          'type'        => 'text',
          'label'       => __( 'Registered Manager', ' cloudways' ),
          'placeholder' => __( 'Manager', 'cloudways' ),
          'required'    => true,
      ),
  ) );
}
function edit_my_account_page_woocommerce() {
  $fields = woocommerce_edit_my_account_page();
  foreach ( $fields as $key => $field_args ) {
      woocommerce_form_field( $key, $field_args );
  }
}
add_action( 'woocommerce_register_form', 'edit_my_account_page_woocommerce', 15 );

function wooc_save_extra_register_fields( $customer_id, $new_customer_data ) {
  if ( isset( $_POST['billing_phone'] ) ) {
               // Phone input filed which is used in WooCommerce
               update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
        }
    if ( isset( $_POST['billing_first_name'] ) ) {
           //First name field which is by default
           update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
           // First name field which is used in WooCommerce
           update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
    }
    if ( isset( $_POST['billing_last_name'] ) ) {
           // Last name field which is by default
           update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
           // Last name field which is used in WooCommerce
           update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
    }
    if ( isset( $_POST['kc_custom_change'] ) ) {
      // Last name field which is by default
      add_user_meta( $customer_id, 'kc_custom_change', sanitize_text_field( $_POST['kc_custom_change'] ) );
      // Last name field which is used in WooCommerce
      echo print_r($new_customer_data);
}
}
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields', 15, 2 );

function wc_new_order_column( $columns ) {
  $columns['my_column'] = 'My column';
  $columns['my_column2'] = 'My column2';
  return $columns;
}
add_filter( 'manage_edit-shop_order_columns', 'wc_new_order_column' );


function sv_wc_cogs_add_order_profit_column_content( $column ) {
  global $post;

  if ('my_column' === $column) {
      echo "hey";
  }
    
}

add_action( 'manage_shop_order_posts_custom_column', 'sv_wc_cogs_add_order_profit_column_content' );
