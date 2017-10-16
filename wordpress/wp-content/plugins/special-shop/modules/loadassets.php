<?php
  add_action('admin_enqueue_scripts', 'specshop_media_files');
  function specshop_media_files()
  {
      wp_enqueue_media();
  }

  // create SpecShop options page
  add_action('admin_menu', 'Specshop_options');
  function Specshop_options()
  {
      add_menu_page('SpecShop', 'SpecShop', 'edit_posts', 'specshop', 'specshop_options_page', '', 24);
  }

  // load
  add_action('admin_enqueue_scripts', 'load_specshop_admin_files');
  function load_specshop_admin_files()
  {
    wp_register_style('specshop_admin_styles', plugin_dir_url(__FILE__) . '../css/special-shop-admin.css', false, '1.0.0');
    wp_enqueue_style('specshop_admin_styles');

    wp_register_script('jquery', plugin_dir_url(__FILE__) . 'js/jquery.js', false, '1.12.4');
    wp_enqueue_script('jquery');

    wp_register_script('specshop_admin_scripts', plugin_dir_url(__FILE__) . '../js/special-shop-admin.js', false, '1.0.0');
    wp_enqueue_script('specshop_admin_scripts');
  }

  add_action('init', 'specshop_frontend'); // Add Scripts to wp_head
  function specshop_frontend()
  {
    if (!is_admin()) {

      wp_register_style('specshop_front_styles', plugin_dir_url(__FILE__) . '../css/special-shop-main.css', false, '1.0.0');
      wp_enqueue_style('specshop_front_styles');

      //  Load footer scripts (footer.php)
      wp_register_script('specshop_front_scripts', plugin_dir_url(__FILE__) . '../js/special-shop-scripts.js', array(), '1.0.0', true); // Custom scripts
      wp_enqueue_script('specshop_front_scripts'); // Enqueue it!
    }
  }
?>
