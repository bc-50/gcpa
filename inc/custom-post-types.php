<?php

function sponsor_post_type_func() {
  // Sponsor Post Type
  register_post_type('sponsors', array(
    //Most of the visual stuff in labels array
      'labels' => array(
        'name' => 'Sponsors',
        'add_new_item' => 'Add New Sponsor',
        'edit_item' => 'Edit Sponsors',
        'all_items' => 'All Sponsors',
        'singular_name' => 'Sponsor'
      ),
      'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
      'public' => true,
      'menu_icon' => 'dashicons-admin-users',
      'has_archive' => false,
      'map_meta_cap' => true        //wordpress applies role permission when needed
    ));
  }
  
  add_action( 'init', 'sponsor_post_type_func' );


  define('MY_POST_TYPE', 'my');
define('MY_POST_SLUG', 'gallery');
 
function my_register_post_type () {
  $args = array (
      'label' => 'Gallery',
      'supports' => array( 'title', 'excerpt','thumbnail' ),
      'register_meta_box_cb' => 'my_meta_box_cb',
      'show_ui' => true,
      'query_var' => true
  );
  register_post_type( MY_POST_TYPE , $args );
}
add_action( 'init', 'my_register_post_type' );
 
function my_meta_box_cb () {
  add_meta_box( 'my_details' , 'Media Library', 'my_meta_box_details', MY_POST_TYPE, 'normal', 'high' );
}
 
function my_meta_box_details () {
  global $post;
  $meta_key = 'second_featured_img';
    echo misha_image_uploader_field( $meta_key, get_post_meta($post->ID, $meta_key, true) );
}


function myplugin_save_postdata( $id ) {

  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
  return $id;
  global $post;
  $meta_key = 'second_featured_img';

  if ('' !== get_post_meta($post->ID, $meta_key, true)) {


  update_post_meta( $id, $meta_key, sanitize_text_field( $_POST[$meta_key] ) );
}

// if you would like to attach the uploaded image to this post, uncomment the line:
// wp_update_post( array( 'ID' => $_POST[$meta_key], 'post_parent' => $post_id ) );

return $id;
}

add_action('save_post', 'myplugin_save_postdata');