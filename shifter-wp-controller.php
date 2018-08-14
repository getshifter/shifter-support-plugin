<?php
/*
Plugin Name: Shifter WP Controller
Plugin URI: https://github.com/getshifter/shifter-wp-controller
Description: Shifter controls from the WordPress Dashboard.
Version: 1.1.7
Author: DigitalCube
Author URI: https://getshifter.io
License: GPL2
*/

/*
 * Shifter API
 */

require("api/shifter_api.php");

// /*
//  * CSS Styles
//  * Admin and Front-End
//  */

add_action('wp_enqueue_scripts', 'add_shifter_support_css' );
add_action('admin_enqueue_scripts', 'add_shifter_support_css' );
function add_shifter_support_css() {

  // $shifter_css = plugins_url( 'src/css/main.css', __FILE__ );
  // wp_register_style("shifter-support", $shifter_css);

  wp_register_style("sweetalert2", "https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.26.11/sweetalert2.min.css");

  if (is_user_logged_in()) {
    wp_enqueue_style("sweetalert2");
  }
}

/*
 * JS Scripts
 * Admin and Front-End
 * Load after enqueue jQuery
 */

add_action('wp_enqueue_scripts', 'add_shifter_support_js' );
add_action('admin_enqueue_scripts', 'add_shifter_support_js' );
function add_shifter_support_js() {

  $shifter_js = plugins_url( 'main/main.js', __FILE__ );

  wp_register_script("shifter-js", $shifter_js, array( 'jquery' ));
  wp_localize_script('shifter-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

  wp_register_script( 'sweetalert2', 'https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.26.11/sweetalert2.min.js', null, null, true );
  wp_localize_script('sweetalert2', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

  if (is_user_logged_in()) {
    wp_enqueue_script("shifter-js");
    wp_enqueue_script("sweetalert2");
  }
}

/*
 * Admin Menu
 *
 */

add_action("wp_before_admin_bar_render", "add_shifter_support");
function add_shifter_support() {
  $local_class = getenv("SHIFTER_LOCAL") ? "disable_shifter_operation" : "";
  $api = new Shifter;
  global $wp_admin_bar;
  $shifter_support = array(
    "id" => "shifter_support",
    "title" => '<span id="shifter-support-top-menu">Shifter</span>'
  );
  $shifter_support_back_to_shifter_dashboard = array(
    "id"    => "shifter_support_back_to_shifter_dashboard",
    "title" => "Back to Shifter Dashboard",
    "parent" => "shifter_support",
    "href" => $api->shifter_dashboard_url
  );
  $shifter_support_terminate = array(
    "id"    => "shifter_support_terminate",
    "title" => "Terminate app",
    "parent" => "shifter_support",
    "href" => "#",
    "meta" => array("class" => $local_class)
  );
  $shifter_support_generate = array(
    "id"    => "shifter_support_generate",
    "title" => "Generate artifact",
    "parent" => "shifter_support",
    "href" => "#",
    "meta" => array("class" => $local_class)
  );
  $wp_admin_bar->add_menu($shifter_support);
  $wp_admin_bar->add_menu($shifter_support_back_to_shifter_dashboard);
  $wp_admin_bar->add_menu($shifter_support_terminate);
  $wp_admin_bar->add_menu($shifter_support_generate);
}

/*
 * Admin Dashboard Widget
 *
 */

add_action("wp_dashboard_setup", "add_shifter_diag");
function add_shifter_diag() {
  wp_add_dashboard_widget("shifter_app_diag", "Shifter", "add_shifter_diag_contents");
}

function add_shifter_diag_contents() {
  include("diag/diag.php");
}

add_action("wp_ajax_shifter_app_terminate", "shifter_app_terminate");
function shifter_app_terminate() {
  $api = new Shifter;
  return $api->terminate_wp_app();
}

add_action("wp_ajax_shifter_app_generate", "shifter_app_generate");
function shifter_app_generate() {
  $api = new Shifter;
  return $api->generate_wp_app();
}
