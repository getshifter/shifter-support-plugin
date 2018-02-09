<?php

/*
Plugin Name: Shifter Support Plugin
Plugin URI: https://github.com/getshifter/shifter-support-plugin
Description: This plugin is provided access to Shifter support.
Version: 1.0.5
Author: Shifter Team
Author URI: https://getshifter.io
License: GPL2
*/



/*
 * Shifter API
 */

require("api/shifter_api.php");



/*
 * Assets
 * Dirs and Vars
 */

define('SHIFTER_ASSET_DIR', content_url('/mu-plugins/') . basename(__DIR__) . '/src/');
define('SHIFTER_JS', SHIFTER_ASSET_DIR . 'js/app.js');
define('SHIFTER_CSS', SHIFTER_ASSET_DIR . 'css/main.css');



/*
 * CSS Styles
 * Admin and Front-End
 */

function add_shifter_support_css() {
  wp_register_style("shifter-support", SHIFTER_CSS);
  wp_enqueue_style("shifter-support");
}

add_action('wp_enqueue_scripts', 'add_shifter_support_css' );
add_action('admin_enqueue_scripts', 'add_shifter_support_css' );


/*
 * JS Scripts
 * Admin and Front-End
 * Load after enqueue jQuery
 */

function add_shifter_support_js() {
  wp_register_script("shifter-js", SHIFTER_JS, array( 'jquery' ));
  wp_enqueue_script("shifter-js");
}

add_action('wp_enqueue_scripts', 'add_shifter_support_js' );
add_action('admin_enqueue_scripts', 'add_shifter_support_js' );

/*
 * Admin Menu
 *
 */

add_action("wp_before_admin_bar_render", "add_shifter_support");
function add_shifter_support() {
  $local_class = getenv("SHIFTER_LOCAL") ? "disable_shifter_operation" : "";
  global $wp_admin_bar;

  $shifter_support = array(
    "id" => "shifter_support",
    "title" => '<span id="shifter-support-top-menu">Shifter</span>',
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


// add_action("admin_footer", "add_generator_call");
// function add_generator_call() {
//   $is_local = getenv("SHIFTER_LOCAL");
//   if(!$is_local) {
//     include ("generator/trigger.js.php");
//   }
// }


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
?>
