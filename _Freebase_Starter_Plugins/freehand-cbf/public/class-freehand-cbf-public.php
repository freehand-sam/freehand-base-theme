<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://freehand.studio
 * @since      1.0.0
 *
 * @package    Freehand_Cbf
 * @subpackage Freehand_Cbf/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Freehand_Cbf
 * @subpackage Freehand_Cbf/public
 * @author     Sam Toerper <sam@freehand.studio>
 */
class Freehand_Cbf_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->freehand_cbf_options = get_option($this->plugin_name);
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Freehand_Cbf_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Freehand_Cbf_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/freehand-cbf-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Freehand_Cbf_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Freehand_Cbf_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/freehand-cbf-public.js', array( 'jquery' ), $this->version, false );

	}


	    /**
	     * Cleanup functions depending on each checkbox returned value in admin
	     *
	     * @since    1.0.0
	     */
	    // Cleanup head
	    public function freehand_cbf_cleanup() {

	        if($this->freehand_cbf_options['cleanup']){

	            remove_action( 'wp_head', 'rsd_link' );                 // RSD link
	            remove_action( 'wp_head', 'feed_links_extra', 3 );            // Category feed link
	            remove_action( 'wp_head', 'feed_links', 2 );                // Post and comment feed links
	            remove_action( 'wp_head', 'index_rel_link' );
	            remove_action( 'wp_head', 'wlwmanifest_link' );
	            remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );        // Parent rel link
	            remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );       // Start post rel link
	            remove_action( 'wp_head', 'rel_canonical', 10, 0 );
	            remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	            remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Adjacent post rel link
	            remove_action( 'wp_head', 'wp_generator' );               // WP Version
	            remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	            remove_action( 'wp_print_styles', 'print_emoji_styles' );

	        }
	    }   
	    // Cleanup head
	    public function freehand_cbf_remove_x_pingback($headers) {
	        if(!empty($this->freehand_cbf_options['cleanup'])){
	            unset($headers['X-Pingback']);
	            return $headers;
	        }
	    }

	    // Remove Comment inline CSS
	    public function freehand_cbf_remove_comments_inline_styles() {
	        if(!empty($this->freehand_cbf_options['comments_css_cleanup'])){
	            global $wp_widget_factory;
	            if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
	                remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	            }

	            if ( isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments']) ) {
	                remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	            }
	        }
	    }

	    // Remove gallery inline CSS
	    public function freehand_cbf_remove_gallery_styles($css) {
	        if(!empty($this->freehand_cbf_options['gallery_css_cleanup'])){
	            return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
	        }

	    }


	    // Add Footer Logo option
	    public function freehand_cbf_footer_logo( $wp_customize ) {
	        if(!empty($this->freehand_cbf_options['footer_logo'])){

	        	// add a setting 
	        	    $wp_customize->add_setting('freehand_footer_logo');
	        	// Add a control to upload the hover logo
	        	    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'freehand_footer_logo', array(
	        	        'label' => 'Upload Footer Logo',
	        	        'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
	        	        'settings' => 'freehand_footer_logo',
	        	        'priority' => 9 // show it just below the custom-logo
	        	    )));
	            
	        }
	    }

	    // Create an ACF Options Page
	    public function freehand_cbf_options_page(){
	        if( function_exists('acf_add_options_page') ) {
	        	
	        	acf_add_options_page(array(
	        		'page_title' 	=> 'Website General Settings',
	        		'menu_title'	=> 'Site Settings',
	        		'menu_slug' 	=> 'website-general-settings',
	        		'capability'	=> 'edit_posts',
	        		'icon_url' => 'dashicons-welcome-widgets-menus',
	        		'redirect'		=> false,
	        		'position' => '20.3' // use decimal instead of integer to avoid conflict
	        	));
	        	
	        }
	    }


	   



}
