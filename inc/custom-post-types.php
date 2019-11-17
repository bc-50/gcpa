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