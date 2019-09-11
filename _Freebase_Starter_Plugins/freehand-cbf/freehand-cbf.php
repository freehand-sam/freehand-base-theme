<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://freehand.studio
 * @since             1.0.0
 * @package           Freehand_Cbf
 *
 * @wordpress-plugin
 * Plugin Name:       WP Clean Up and Base Functions
 * Plugin URI:        https://freehand.studio
 * Description:       Head section cleanup and typical settings and functions used on all Freehand websites.
 * Version:           1.0.0
 * Author:            Freehand
 * Author URI:        https://freehand.studio
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       freehand-cbf
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'Freehand_Cbf', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-freehand-cbf-activator.php
 */
function activate_freehand_cbf() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-freehand-cbf-activator.php';
	Freehand_Cbf_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-freehand-cbf-deactivator.php
 */
function deactivate_freehand_cbf() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-freehand-cbf-deactivator.php';
	Freehand_Cbf_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_freehand_cbf' );
register_deactivation_hook( __FILE__, 'deactivate_freehand_cbf' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-freehand-cbf.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_freehand_cbf() {

	$plugin = new Freehand_Cbf();
	$plugin->run();

}
run_freehand_cbf();
