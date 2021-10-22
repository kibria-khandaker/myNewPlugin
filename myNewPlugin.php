<?php
/**
 * Plugin Name:       My New Plugin
 * Plugin URI:        https://skillice.com/
 * Description:       <a href="https://skillice.com/">My New Plugin</a> is the Custom Elementor Extra Addons 
 * Version:           1.0.0
 * Requires at least: 5.0
 * Requires PHP:      7.0
 * Author:            Kibria
 * Author URI:        https://skillice.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://skillice.com/
 * Text Domain:       my-New-Plugin
 * Domain Path:       /languages
 */


// Plugin er main file niche if condition ta add korte hobe 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly. 
}



/**
 * Widgets Loader // widgets-loader.php conection
 */
require plugin_dir_path(__FILE__).'widgets-loader.php';