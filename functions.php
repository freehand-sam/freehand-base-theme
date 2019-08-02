<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

// Remove page templates inherited from the parent theme.
add_filter( 'theme_page_templates', 'child_theme_remove_page_template' );

function child_theme_remove_page_template( $page_templates ) {
    unset( $page_templates['page-templates/blank.php'] ); 
    unset( $page_templates['page-templates/empty.php'] ); 
    unset( $page_templates['page-templates/fullwidthpage.php'] ); 
    unset( $page_templates['page-templates/left-sidebarpage.php'] ); 
    unset( $page_templates['page-templates/right-sidebarpage.php'] ); 
    unset( $page_templates['page-templates/both-sidebarspage.php'] ); 
return $page_templates;
}