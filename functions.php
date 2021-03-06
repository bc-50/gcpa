<?php
require_once('inc/custom-post-types.php');
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
require_once get_template_directory() . '/inc/svg.php';
error_reporting(E_ALL);
ini_set("display_errors", 1);




function theme_files()
{
 
  wp_enqueue_script('Main-Scripts', get_theme_file_uri('js/scripts.min.js'), array('jquery'));
  wp_enqueue_style('MyStyles', get_stylesheet_uri());
  wp_enqueue_style('Hamburger', get_theme_file_uri('lib/hamburgers.min.css'));
  wp_enqueue_script('BootstrapJS', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js', array('jquery'));
  wp_enqueue_style('Bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
  wp_enqueue_style('FontAwes', 'https://use.fontawesome.com/releases/v5.7.2/css/all.css');
  wp_localize_script( 'Main-Scripts', 'ajax_posts', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'noposts' => __('No older posts found', 'event'),
    'siteurl' => site_url(),
  ));
  wp_enqueue_script('lazy', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.10/jquery.lazy.min.js');
  wp_enqueue_script('lazyplug', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.10/jquery.lazy.min.js');
  wp_enqueue_style('MyStyles', get_stylesheet_uri());


  /* fonts */
  wp_enqueue_style('Montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap');
  
}

add_action('wp_enqueue_scripts', 'theme_files');

function include_myuploadscript() {
	/*
	 * I recommend to add additional conditions just to not to load the scipts on each page
	 * like:
	 * if ( !in_array('post-new.php','post.php') ) return;
	 */
	if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}
  wp_enqueue_style('MyStyles', get_stylesheet_directory_uri() . '/backend-styles/admin-main.min.css');
 
   wp_enqueue_script( 'myuploadscript', get_stylesheet_directory_uri() . '/js/scripts.min.js', array('jquery'), null, false );
   wp_enqueue_script('lazy', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.10/jquery.lazy.min.js');
   wp_enqueue_script('lazyplug', 'https://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.10/jquery.lazy.min.js');
  }
 
add_action( 'admin_enqueue_scripts', 'include_myuploadscript' );


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

/* Ajax Functions */

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
   

/* function membership_selection(){
  ?>
  <!-- <script>
    console.log('sss');
  </script> -->
  <?php
  $info = (isset($_POST["info"])) ? $_POST["info"] : '';
 $_GET["info"] = 'test';
  $url = $GLOBAL['cart_links'][$info];
  var_dump($GLOBAL['cart_links']);
  header("Content-Type: text/html"); ?>
  
  <?php
}
add_action('wp_ajax_nopriv_membership_selection', 'membership_selection');
add_action('wp_ajax_membership_selection', 'membership_selection'); */
<<<<<<< HEAD



=======



>>>>>>> 3a08c6ab2a7ed7c520fb90b6d68f8fbe2ee42373
  /* More Form Fields */

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
  <input type="text" class="input-text" name="registered_manager" id="reg_mang" value="<?php if ( ! empty( $_POST['registered_'] ) ) esc_attr_e( $_POST['registered_manager'] ); ?>" />
  </p> -->
  
  <div class="clear"></div>
  <?php


}
add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );

function woocommerce_edit_my_account_page() {
  return apply_filters( 'woocommerce_forms_field', array(
      'kc_register_manager' => array(
          'type'        => 'text',
          'label'       => __( 'Registered Manager', ' cloudways' ),
          'placeholder' => __( 'Manager', 'cloudways' ),
          'required'    => true,
      ),

      'kc_position' => array(
        'type'        => 'text',
        'label'       => __( 'Position within organisation', ' cloudways' ),
        'placeholder' => __( 'Position', 'cloudways' ),
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
    add_user_meta( $customer_id, 'kc_register_manager', sanitize_text_field( $_POST['kc_register_manager'] ) );

    if ( isset( $_POST['kc_register_manager'] ) ) {

      // Last name field which is by default
      update_user_meta( $customer_id, 'kc_register_manager', sanitize_text_field( $_POST['kc_register_manager'] ) );
      // Last name field which is used in WooCommerce
    }
    add_user_meta( $customer_id, 'kc_position', sanitize_text_field( $_POST['kc_position'] ) );

    if ( isset( $_POST['kc_position'] ) ) {
      // Last name field which is by default
      update_user_meta( $customer_id, 'kc_position', sanitize_text_field( $_POST['kc_position'] ) );
      // Last name field which is used in WooCommerce
    }
}
add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields', 15, 2 );

function wc_new_order_column( $columns ) {

  $column['order-number'] = 'Order Number';
  return $columns;
}
add_filter( 'manage_edit-shop_order_columns', 'wc_new_order_column' );


function sv_wc_cogs_add_order_profit_column_content( $column ) {
  global $post;

  if ('my_column' === $column) {
      echo get_user_meta(19,'kc_register_manager', true);
  }
    
}

add_action( 'manage_shop_order_posts_custom_column', 'sv_wc_cogs_add_order_profit_column_content' );

function my_account_menu_order() {
  $menuOrder = array(
    'dashboard'          => __( 'Dashboard', 'woocommerce' ),
    'orders'             => __( 'Orders', 'woocommerce' ),
    'edit-address'       => __( 'Addresses', 'woocommerce' ),
    'edit-account'    	=> __( 'Account Details', 'woocommerce' ),
    'customer-logout'    => __( 'Logout', 'woocommerce' ),
  );
  return $menuOrder;
}
add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );


function new_orders_columns( $columns = array() ) {

  $columns['order-number'] = __( 'Order Number', 'Text Domain' );
  $columns['order-date'] = __( 'Order Date', 'Text Domain' );

  return $columns;
}
add_filter( 'woocommerce_account_orders_columns', 'new_orders_columns' );

function image_uploader_field( $name, $values = array()) {
	$image = ' button">Upload image';
	$image_size = 'full'; // it would be better to use thumbnail size here (150x150 or so)
  $display = 'none'; // display state ot the "Remove image" button
  $r = '<div class="gallery-wrapper">';
  if (!empty($values)) {
    foreach ($values[0] as $value) {
      if( $image_attributes = wp_get_attachment_image_src( $value, $image_size ) ) {
   
        // $image_attributes[0] - image URL
        // $image_attributes[1] - image width
        // $image_attributes[2] - image height
     
        $image = '<img src="' . $image_attributes[0] . '" style="max-width:95%;display:block;" />';
        $display = 'inline-block';
     
        $r .='
        <div class="admin-image-wrapper">
          '. $image .'
        </div>';
      } 
    }
  }
  $r .= '
          <div class="upload">Upload Image</div>
          </div>
        <a href="#" style="display: none;" class="remove_image_button">Remove All</a>';
	return $r;
}


add_action( 'init', 'create_type_taxonomy');

function create_type_taxonomy (){
  register_taxonomy('pagetype','page',array(
    'hierarchical' => true,
    'exclude_from_search' => false,
    'labels' => array(
      'name' => _x( 'Page Type', 'taxonomy general name' ),
      'singular_name' => _x( 'Page', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Pages' ),
      'all_items' => __( 'All Pages' ),
      'parent_item' => __( 'Parent Page' ),
      'parent_item_colon' => __( 'Parent Page:' ),
      'edit_item' => __( 'Edit Page' ),
      'update_item' => __( 'Update Page' ),
      'add_new_item' => __( 'Add New Page' ),
      'new_item_name' => __( 'New Page Name' ),
      'menu_name' => __( 'Pages' ),
    ),
  ));
}
<<<<<<< HEAD

function sv_conditional_email_recipient( $recipient, $order ) {
	// Bail on WC settings pages since the order object isn't yet set yet
	// Not sure why this is even a thing, but shikata ga nai
	$page = $_GET['page'] = isset( $_GET['page'] ) ? $_GET['page'] : '';
	if ( 'wc-settings' === $page ) {
		return $recipient; 
	}
	
	$recipient .= ', kevvy.cadette@hotmail.com';
	return $recipient;
}

add_filter( 'woocommerce_email_recipient_new_account', 'sv_conditional_email_recipient', 10, 2 );


add_filter( 'woocommerce_email_headers', 'mycustom_headers_filter_function', 10, 2);

function mycustom_headers_filter_function( $headers, $object ) {
        $headers .= 'BCC: My name <kevvy.cadette@hotmail.com>' . "\r\n" . print_r($object);

      

    return $headers;
}


function add_excerpt_to_pages() 
{
     add_post_type_support( 'page', 'excerpt' );
}

add_action( 'init' , 'add_excerpt_to_pages' );

function additional_head(){ ?>
  <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5GWN3F5');</script>
<!-- End Google Tag Manager -->
<?php
}

add_action('wp_head', 'additional_head');
=======
>>>>>>> 3a08c6ab2a7ed7c520fb90b6d68f8fbe2ee42373
