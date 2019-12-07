<?php
/**
 * Understrap enqueue scripts
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



if ( ! function_exists( 'understrap_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function understrap_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
		wp_enqueue_style( 'understrap-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $css_version );

        wp_enqueue_script( 'jquery' );
        
        wp_enqueue_script('aos', 'https://unpkg.com/aos@next/dist/aos.js', array('understrap-scripts'), 1.0, true );
        
        $gm_api = get_field('google_maps_api_key','option');
        if ($gm_api) {
            wp_enqueue_script('googlemaps', 'https://maps.googleapis.com/maps/api/js?key=' . $gm_api, null, null, true);
            wp_enqueue_script( 'googlemaps_config', get_template_directory_uri() . '/js/google-maps.js', array('understrap-scripts'), 1.0, true );
            wp_localize_script('googlemaps_config', 'script_vars', array('mapstyles' => get_field('map_stylers', 'option')));
        }

		$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/theme.min.js' );
		
		wp_enqueue_script( 'understrap-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true );
        
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // endif function_exists( 'understrap_scripts' ).

add_action( 'wp_enqueue_scripts', 'understrap_scripts' );
