<?php

  $u = wp_get_current_user();
<<<<<<< HEAD
  $u->add_role('member');
=======
  $u->set_role('member');
>>>>>>> 3a08c6ab2a7ed7c520fb90b6d68f8fbe2ee42373
  wp_safe_redirect( site_url('members-login/members-area') );


?>
