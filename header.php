<!DOCTYPE html>
<html>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5GWN3F5" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php

if (tribe_is_event_query()) { 
  $src = get_theme_file_uri('imgs/events.jpg');
} elseif (get_field('header_image')) { 
  $src = get_field('header_image');
} else {
  $src = get_theme_file_uri('imgs/bw.jpg');
} ?>

    <header class="main"
        style="background-image: linear-gradient(45deg, rgba(0,0,0,.5), rgba(0,0,0,.5)), url(<?php echo $src  ?>)">

        <div class="container">
            <div class="row menu">
                <div class="col">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <button class="hamburger hamburger--spring  navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                                <?php 
                  wp_nav_menu(array(
                  'menu' => 'Main Menu',
                  'menu_class' => 'main-nav',
                  'container_class' => 'main-nav-container',
                  'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                  'walker'          => new WP_Bootstrap_Navwalker(),
                  )); ?>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <section class="gradient-header">
            <div class="header-spacing">
                <div class="container">
                    <div class="row logo-row">
                        <div class="col-md-5">
                            <div class="gcpa-logo">
                                <div class="logo-wrapper">
                                    <a href="<?php echo esc_url(site_url()) ?>"><?php logo_svg('head') ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="members-button">
                                <a href="<?php echo esc_url(site_url('members-login')) ?>"><i class="fas fa-user"></i>
                                    Members Login</a>
                            </div>
                        </div>
                    </div>
                    <div class="row social-row">
                        <div class="col-lg-2">
                            <div class="social">
                                <ul>
                                    <li><a href="https://twitter.com/gcpagroup"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="https://www.facebook.com/gcpagroup/"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://www.instagram.com/gloucestershirecareproviders "><i
                                                class="fab fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row intro-text">
                <div class="col-lg-9">
                    <div class="head-text-content">
                        <h1>
                            <?php if (get_field('header_text')) {
              echo get_field('header_text');
            } elseif (tribe_is_event_query() && !get_field('header_text')) {
              echo 'Upcoming Events';
            } elseif (is_archive() && !get_field('header_text')) {
              echo str_replace('Archives:','',get_the_archive_title());
            } else { 
              echo get_the_title();
            } ?>
                            <?php if (!is_front_page()) { ?>
                            <div class="seperator-wrapper green">
                                <div class="seperator"></div>
                            </div>
                            <?php } ?>
                        </h1>
                    </div>
                </div>
            </div>
            <?php if (get_field('header_button')) { ?>
            <div class="row button-row">
                <div class="col-lg-4">
                    <div class="button-wrapper">
                        <a target="_blank"
                            href="https://www.carechoices.co.uk/browse/south-west/gloucestershire/gloucester/?radius=30 ">Find
                            Care</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </header>