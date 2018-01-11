<?php

/*
Plugin Name: Shifter Support Plugin
Plugin URI: https://github.com/getshifter/shifter-support-plugin
Description: This plugin is provided access to Shifter support.
Version: 1.0.0
Author: Shifter Team
Author URI: https://getshifter.io
License: GPL2
*/
add_action('admin_enqueue_scripts', 'add_shifter_support_css');

function add_shifter_support_css() {
  error_log("shifter_support");
  wp_register_style('shifter-support', plugins_url('css/shifter-support.css', __FILE__));
	wp_enqueue_style('shifter-support');
}


add_action('wp_before_admin_bar_render', 'add_shifter_support');

function add_shifter_support() {

  global $wp_admin_bar;
  $shifter_support = array(
		'id'    => 'shifter_support',
		'title' => '<span id="shifter-support-top-menu">Shifter</span>',
	);

  $shifter_support_terminate = array(
    'id'    => 'shifter_support_terminate',
		'title' => 'Terminate the app',
    'parent' => 'shifter_support'
  );

  $shifter_support_generate = array(
    'id'    => 'shifter_support_generate',
		'title' => 'Generate the artifact',
    'parent' => 'shifter_support'
  );

  $wp_admin_bar->add_menu( $shifter_support );
  $wp_admin_bar->add_menu( $shifter_support_diag );
  $wp_admin_bar->add_menu( $shifter_support_terminate );
  $wp_admin_bar->add_menu( $shifter_support_generate );
}

add_action( 'wp_dashboard_setup', 'add_shifter_diag' );

function add_shifter_diag() {
  wp_add_dashboard_widget('shifter_app_diag', 'Your Shifter app environment', 'add_shifter_diag_contents');
}

function add_shifter_diag_contents() {
  include("diag/diag.php");
}

?>
