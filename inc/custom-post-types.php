<?php



 /*  function approved_post_type_func() {
    // Approved Supplier Post Type
    register_post_type('approved', array(
      //Most of the visual stuff in labels array
        'labels' => array(
          'name' => 'Approved Suppliers',
          'add_new_item' => 'Add New Approved Supplier',
          'edit_item' => 'Edit Approved Suppliers',
          'all_items' => 'All Approved Suppliers',
          'singular_name' => 'Approved Supplier'
        ),
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        'public' => true,
        'menu_icon' => 'dashicons-admin-users',
        'has_archive' => false,
        'map_meta_cap' => true        //wordpress applies role permission when needed
      ));
    }
    
    add_action( 'init', 'approved_post_type_func' ); */

define('MY_POST_TYPE', 'gallery');
define('MY_POST_SLUG', 'gallery');
 
function my_register_post_type () {
  $args = array (
      'label' => 'Gallery',
      'supports' => array( 'title','editor', 'excerpt','thumbnail' ),
      'register_meta_box_cb' => 'my_meta_box_cb',
      'has_archive' => true,
      'show_ui' => true,
      'public' => true,
<<<<<<< HEAD
      'query_var' => true,
      'show_in_rest' => true
      );
  register_post_type( MY_POST_TYPE , $args );
}
add_action( 'init', 'my_register_post_type' );
 
function my_meta_box_cb () {
  add_meta_box( 'my_details' , 'Media Library', 'my_meta_box_details', MY_POST_TYPE, 'normal', 'high' );
}
 
function my_meta_box_details () {
  global $post;
  $meta_key = 'my_details';
    echo image_uploader_field( $meta_key, get_post_meta($post->ID, $meta_key) );
}


function myplugin_save_postdata( $id ) {
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
  return $id;
  global $post;
  $meta_key = 'my_details';
 
  
=======
      'menu_icon' => 'dashicons-admin-users',
      'has_archive' => false,
    'map_meta_cap' => true        //wordpress applies role permission when needed
    ));
  }
  
  add_action( 'init', 'sponsor_post_type_func' );

 /*  function approved_post_type_func() {
    // Approved Supplier Post Type
    register_post_type('approved', array(
      //Most of the visual stuff in labels array
        'labels' => array(
          'name' => 'Approved Suppliers',
          'add_new_item' => 'Add New Approved Supplier',
          'edit_item' => 'Edit Approved Suppliers',
          'all_items' => 'All Approved Suppliers',
          'singular_name' => 'Approved Supplier'
        ),
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        'public' => true,
        'menu_icon' => 'dashicons-admin-users',
        'has_archive' => false,
        'map_meta_cap' => true        //wordpress applies role permission when needed
      ));
    }
    
    add_action( 'init', 'approved_post_type_func' ); */

define('MY_POST_TYPE', 'gallery');
define('MY_POST_SLUG', 'gallery');
 
function my_register_post_type () {
  $args = array (
      'label' => 'Gallery',
      'supports' => array( 'title','editor', 'excerpt','thumbnail' ),
      'register_meta_box_cb' => 'my_meta_box_cb',
      'has_archive' => true,
      'show_ui' => true,
      'public' => true,
      'query_var' => true,
      'show_in_rest' => true
      );
  register_post_type( MY_POST_TYPE , $args );
}
add_action( 'init', 'my_register_post_type' );
 
function my_meta_box_cb () {
  add_meta_box( 'my_details' , 'Media Library', 'my_meta_box_details', MY_POST_TYPE, 'normal', 'high' );
}
 
function my_meta_box_details () {
  global $post;
  $meta_key = 'my_details';
    echo image_uploader_field( $meta_key, get_post_meta($post->ID, $meta_key) );
}


function myplugin_save_postdata( $id ) {
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
  return $id;
  global $post;
  $meta_key = 'my_details';
 
  
>>>>>>> 3a08c6ab2a7ed7c520fb90b6d68f8fbe2ee42373
  $count = 1;
 if (isset($post) && !empty($_POST['my_details'])) {
  if ('' !== get_post_meta($post->ID, $meta_key)) {
    
    $metas = explode(',',$_POST['my_details']);
    update_post_meta( $id, $meta_key, $metas);
  }
 }

// if you would like to attach the uploaded image to this post, uncomment the line:
// wp_update_post( array( 'ID' => $_POST[$meta_key], 'post_parent' => $post_id ) );

return $id;
}

add_action('save_post', 'myplugin_save_postdata');