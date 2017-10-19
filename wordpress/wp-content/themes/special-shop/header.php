<!DOCTYPE html>
<html <?php language_attributes(); ?> class="gr__arma24_biz">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/green.css">

  <title><?php wp_title( '' ); ?><?php if ( wp_title( '', false ) ) { echo ' :'; } ?> <?php bloginfo( 'name' ); ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="format-detection" content="telephone=no">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!--[if lt IE 9]>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/selectivizr/1.0.2/selectivizr-min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- css + javascript -->
  <?php wp_head(); ?>
</head>
<body data-gr-c-s-loaded="true">
  <div id="userpanel">
    <div class="inner">
      <!-- <a href="#"><i class="fa fa-sign-in mr5" aria-hidden="true"></i>Вход</a> | <a href="#">Регистрация</a> -->
    </div>
  </div>
  <div class="background"></div>

  <div class="inner">
    <!-- Шапка -->
    <div class="header">
      <div class="wraper">
        <div class="logo">
          <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
        </div>
        <div class="menu">
          <?php wp_nav_menu(); ?>
        </div>
      </div>
    </div>
    <!-- / Шапка -->
    <!-- Шапка невидимка -->
    <div class="hidden">
      <div class="logo">
        <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
      </div>
      <input class="button toggle" type="button" value="Меню сайта">
      <?php wp_nav_menu(); ?>
    </div>
    <!-- / Шапка невидимка-->
    <div class="warning">
      <div class="wraper">
        <?php
          $product_page = get_page_by_path('products');
          $product_page_id = $product_page -> ID;
          echo get_post_field('post_content', $product_page_id);
        ?>
      </div>
    </div>
