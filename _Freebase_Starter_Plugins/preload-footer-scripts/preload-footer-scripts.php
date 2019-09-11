<?php
/**
 * Plugin Name: Preload Footer Scripts
 * Plugin URI:  https://freehand.studio
 * Description: Adds a Preload directive to any script loaded in the footer to speed site performance
 * Version:     1.0.0
 * Author:      Freehand
 * Author URI:  https://freehand.studio
 * Text Domain: 
 * Domain Path: 
 * License:     GPL2
 */

add_action('wp_head', function () {

    global $wp_scripts;

    foreach($wp_scripts->queue as $handle) {
        $script = $wp_scripts->registered[$handle];

        //-- Weird way to check if script is being enqueued in the footer.
        if($script->extra['group'] === 1) {

            //-- If version is set, append to end of source.
            $source = $script->src . ($script->ver ? "?ver={$script->ver}" : "");

            //-- Spit out the tag.
            echo "<link rel='preload' href='{$source}' as='script'/>\n";
        }
    }
}, 1);