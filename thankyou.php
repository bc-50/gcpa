<?php

  $u = wp_get_current_user();
  $u->add_role('member');
  wp_safe_redirect( site_url('members-login/members-area') );


?>
