<?php
/**
* Plugin Name: ALCSE Public Dashboard
* Plugin URI: https://www.alcse.org
* Description: Allows Energy Alabama to display a public dashboard of stats pulled from a Google Sheet.
* Version: The Plugin's Version Number, e.g.: 1.0
* Author: Daniel Tait and Kyle Newman
* Author URI: https://www.alcse.org
* License: A "Slug" license name e.g. GPL2
*/



/*
*  OUTLINE:
*  * Enqueue the JavaScript to be used by the shortcode's output
*  * Enqueue the CSS for the front end (optional)
*  * Add the shortcode
*/



/**
* Load our custom JavaScript file on the front end only.
*
* For more information:
* https://developer.wordpress.org/reference/functions/add_action/
* https://developer.wordpress.org/reference/functions/wp_register_script/
*
*/
add_action( 'wp_enqueue_scripts', 'enqueue_alcse_public_dashboard_js' );
function enqueue_alcse_public_dashboard_js ()
{
  wp_register_script('alcse_public_dashboard',
    plugins_url('assets/javascript/alcse-dashboard.js', __FILE__),
    array('jquery'),
    '1.0',
    true);
  wp_enqueue_script('alcse_public_dashboard');
}



/**
* Load our custom CSS files on the front end only.
*
* For more information:
* https://developer.wordpress.org/reference/functions/wp_enqueue_style/
*/
function enqueue_alcse_public_dashboard_style() {
    wp_enqueue_style( 'alcse_public_dashboard-style', plugins_url('assets/css/style.css', __FILE__) );
}
add_action( 'wp_enqueue_scripts', 'enqueue_alcse_public_dashboard_style' );



/**
* Add the shortcode to WordPress.
*
* For more information:
* https://codex.wordpress.org/Function_Reference/add_shortcode
*/
add_shortcode( 'alcse_public_dashboard', 'alcse_public_dashboard_function');
function alcse_public_dashboard_function ( $atts )
{
  $a = shortcode_atts( array(
    'id' => 1
  ), $atts ) ;
  $c = get_post($a['id'],ARRAY_A);

  // I just concatenate because it's easier to read.
  // Single quotes ('') are for defining varible and double quotes ("") are printed to HTML

  // Container row
  $return_val .= '<div class="wc-shortcodes-row wc-shortcodes-item wc-shortcodes-clearfix" id="alcse-public-dashboard">';
  // FIRST COLUMN
  $return_val .= '<div class="wc-shortcodes-column wc-shortcodes-content wc-shortcodes-one-fourth wc-shortcodes-column-first">';
    $return_val .= '<div class="lievo-svg-wrapper"><img src="';
    // Icon for People Educated
    $return_val .= plugin_dir_url( (__FILE__) ) . 'assets/icons/weather-sun.svg';
    $return_val .= '"/><h3><strong id="people-educated-number"></strong> People Educated</h3></div>';
  $return_val .= '</div>';
  // SECOND COLUMN
  $return_val .= '<div class="wc-shortcodes-column wc-shortcodes-content wc-shortcodes-one-fourth">';
    $return_val .= '<div class="lievo-svg-wrapper"><img src="';
    // Icon for
    $return_val .= plugin_dir_url( (__FILE__) ) . 'assets/icons/weather-sun.svg';
    $return_val .= '"/><h3><strong id="building-space-committed-number"></strong>ft<sup>2</sup> Committed to Energy Efficiency</h3></div>';
  $return_val .= '</div>';
  // THIRD COLUMN
  $return_val .= '<div class="wc-shortcodes-column wc-shortcodes-content wc-shortcodes-one-fourth">';
    $return_val .= '<div class="lievo-svg-wrapper"><img src="';
    // Icon for
    $return_val .= plugin_dir_url( (__FILE__) ) . 'assets/icons/weather-sun.svg';
    $return_val .= '"/><h3><strong id="solar-built-number"></strong> kW of Solar Built</h3></div>';
  $return_val .= '</div>';
  // FOURTH COLUMN
  $return_val .= '<div class="wc-shortcodes-column wc-shortcodes-content wc-shortcodes-one-fourth wc-shortcodes-column-last">';
    $return_val .= '<div class="lievo-svg-wrapper"><img src="';
    // Icon for
    $return_val .= plugin_dir_url( (__FILE__) ) . 'assets/icons/weather-sun.svg';
    $return_val .= '"/><h3><strong id="member-number"></strong> People Educated</h3></div>';
  $return_val .= '</div>';

  $return_val .= '</div>';

  return $return_val;
}
?>
