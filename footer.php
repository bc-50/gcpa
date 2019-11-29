<footer>
 <div class="container">
   <div class="row justify-content-end member-row">
     <div class="col-lg-5">
       <div class="member-wrapper">
         <h3><?php echo get_field('member_text') ?></h3>
       </div>
       <div class="button-wrapper">
         <a href="#">Find Out More</a>
       </div>
     </div>
   </div>
   <div class="wrapper">
     <div class="row logo-row">
      <div class="col-lg-3">
        <div class="footer-logo">
        <a href="<?php echo esc_url(site_url('membership')) ?>"><?php logo_svg('foot') ?></a>
        </div>
      </div>
     </div>
     <div class="row main-footer">
      <div class="col-lg-2">
        <div class="pages">
          <?php 
            wp_nav_menu(array(
            'menu' => 'Footer Menu',
            'menu_class' => 'footer-nav',
            'container_class' => 'footer-nav-container',
            )); ?>
        </div>
      </div>
      <div class="col-lg-2"></div>
      <div class="col-lg-2">
        <div class="contact-us">
          <h4>Contact Us:</h4>
          <ul class="contact-list">
            <li>T: <a href="tel:07799 021612">01242 395470</a></li>
            <li>E: <a href="tel:care@gcpa.co.uk">care@gcpa.co.uk</a></li>
            <br>
            <li>c/o Royal Court, </li>
            <li>Fiddlers Green Lane,</li>
            <li>Cheltenham GL51 0SF</li>
          </ul>
        </div>
      </div>
      <div class="col-lg-1"></div>
      <div class="col-lg-2">
        <div class="social">
          <h4>Connect With Us:</h4>
          <ul>
            <li><a href="https://www.facebook.com/gcpagroup/"><i class="fab fa-twitter"></i></a></li>
            <li><a href="https://twitter.com/gcpagroup"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="https://www.instagram.com/gloucestershirecareproviders "><i class="fab fa-instagram"></i></a></li>
          </ul>
        </div>
      </div>
     </div>
   </div>
 </div>
</footer>


<?php wp_footer() ?>

</body>

</html> 