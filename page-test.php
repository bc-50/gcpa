<?php
  get_header();
  // $user_id = get_current_user_id();
  // $active_memberships = wc_memberships_get_user_memberships( $user_id);  
  // var_dump(get_post_meta('6520', '_payment_method', true));
  // $users = get_users(array('role' => 'auto_user'));
  // $members = array();
  // foreach ($users as $user) {
  //   array_push( $members,wc_memberships_get_user_memberships($user->ID));
  // }
  // 
  global $post;
  echo do_shortcode(get_the_content($post));
  ?>
  
<?php  get_footer(); ?>



