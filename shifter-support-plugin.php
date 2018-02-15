<?php

/*
Plugin Name: Shifter Support Plugin
Plugin URI: https://github.com/getshifter/shifter-support-plugin
Description: This plugin is provided access to Shifter support.
Version: 1.1.0
Author: Shifter Team
Author URI: https://getshifter.io
License: GPL2
*/



/*
 * Shifter API
 */

require("api/shifter_api.php");


/*
 * Check Env
 * If ./src exists run as development
 */

function shifter_support_env() {
  $asset_dir = '/src/';
  $asset_src_path = dirname(__FILE__) . $asset_dir;

  if (realpath($asset_src_path)) {
    return 'development';
  } else {
    return 'production';
  }
}

/*
 * CSS Styles
 * Admin and Front-End
 */

function add_shifter_support_css() {

  if (shifter_support_env() === 'development') {
    $shifter_css = plugins_url( 'src/css/main.css', __FILE__ );
  } else {
    $json = file_get_contents( 'dist/_rev-manifest.json', __FILE__ );
    $manifest = json_decode( $json, true );
    $shifter_css = plugins_url('dist/' . $manifest['css/main.min.css'], __FILE__);
  }

  wp_register_style("shifter-support", $shifter_css);
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
  if (shifter_support_env() === 'development') {
    $shifter_js = plugins_url( 'src/js/app.js', __FILE__ );
  } else {
    $shifter_js = plugins_url( 'dist/js/app.min.js', __FILE__ );
  }

  wp_register_script("shifter-js", $shifter_js, array( 'jquery' ));
  wp_localize_script( 'shifter-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
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

/*
 * Add Intercom Support Widget
 *
 */

add_action('admin_footer', 'intercom_support_widget', 999);

function intercom_support_widget() { ?>
  <script>
    window.intercomSettings = {
      app_id: "w5yiaz2d"
    };
  </script>
  <script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/w5yiaz2d';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>
<?php }
