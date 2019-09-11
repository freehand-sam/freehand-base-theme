<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://freehand.studio
 * @since      1.0.0
 *
 * @package    Freehand_Cbf
 * @subpackage Freehand_Cbf/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Freehand_Cbf
 * @subpackage Freehand_Cbf/includes
 * @author     Sam Toerper <sam@freehand.studio>
 */
class Freehand_Cbf_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'freehand-cbf',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
