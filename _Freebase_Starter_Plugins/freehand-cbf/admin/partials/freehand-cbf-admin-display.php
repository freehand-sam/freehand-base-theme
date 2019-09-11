<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://freehand.studio
 * @since      1.0.0
 *
 * @package    Freehand_Cbf
 * @subpackage Freehand_Cbf/admin/partials
 */
?>

<?php
/**
**
**/
?>

<div class="wrap">

    <h2 class="nav-tab-wrapper">Clean up</h2>

        <form method="post" name="cleanup_options" action="options.php">

        <?php
            //Grab all options
            $options = get_option($this->plugin_name);

            // Cleanup
            $cleanup = $options['cleanup'];
            $comments_css_cleanup = $options['comments_css_cleanup'];
            $gallery_css_cleanup = $options['gallery_css_cleanup'];
            $body_class_slug = $options['body_class_slug'];
            $footer_logo = $options['footer_logo'];
            $options_page = $options['options_page'];
            $jquery_cdn = $options['jquery_cdn'];
            $cdn_provider = $options['cdn_provider'];

            // New Login customization vars
            $login_logo_id = $options['login_logo_id'];
            $login_logo = wp_get_attachment_image_src( $login_logo_id, 'thumbnail' );
            $login_logo_url = $login_logo[0];
            $login_background_color = $options['login_background_color'];
            $login_button_primary_color = $options['login_button_primary_color'];
        ?>

        <?php
            settings_fields($this->plugin_name);
            do_settings_sections($this->plugin_name);
        ?>

        <!-- remove some meta and generators from the <head> -->
        <fieldset>
            <legend class="screen-reader-text">
                <span>Clean WordPress head section</span>
            </legend>
            <label for="<?php echo $this->plugin_name; ?>-cleanup">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-cleanup" name="<?php echo $this->plugin_name; ?>[cleanup]" value="1" <?php checked($cleanup, 1); ?> />
                <span><?php esc_attr_e('Clean up the head section', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <!-- remove injected CSS from comments widgets -->
        <fieldset>
            <legend class="screen-reader-text"><span>Remove Injected CSS for comment widget</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-comments_css_cleanup">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-comments_css_cleanup" name="<?php echo $this->plugin_name; ?>[comments_css_cleanup]" value="1" <?php checked($comments_css_cleanup, 1); ?> />
                <span><?php esc_attr_e('Remove Injected CSS for comment widget', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <!-- remove injected CSS from gallery -->
        <fieldset>
            <legend class="screen-reader-text"><span>Remove Injected CSS for galleries</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-gallery_css_cleanup">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-gallery_css_cleanup" name="<?php echo $this->plugin_name; ?>[gallery_css_cleanup]" value="1" <?php checked( $gallery_css_cleanup, 1 ); ?>  />
                <span><?php esc_attr_e('Remove Injected CSS for galleries', $this->plugin_name); ?></span>
            </label>
        </fieldset>


		<!-- add an ACF Options page -->
		<fieldset>
		    <legend class="screen-reader-text"><span><?php _e('Add an ACF Options Page to Admin?', $this->plugin_name); ?></span></legend>
		    <label for="<?php echo $this->plugin_name; ?>-options-page">
		        <input type="checkbox" id="<?php echo $this->plugin_name; ?>-options-page" name="<?php echo $this->plugin_name; ?>[options_page]" value="1" <?php checked($options_page, 1); ?>  />
		        <span><?php esc_attr_e('Add an ACF Options Page to Admin?', $this->plugin_name); ?></span>
		    </label>
		</fieldset>

        <!-- add a logo for footer -->
        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Add a Footer Logo Option to Customizer?', $this->plugin_name); ?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-footer-logo">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-footer-logo" name="<?php echo $this->plugin_name; ?>[footer_logo]" value="1" <?php checked($footer_logo, 1); ?>  />
                <span><?php esc_attr_e('Add a Footer Logo Option to Customizer?', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <!-- Login page customizations -->

           <h2 class="nav-tab-wrapper"><?php _e('Login customization', $this->plugin_name);?></h2>

               <p><?php _e('Add logo to login form change buttons and background color', $this->plugin_name);?></p>

               <!-- add your logo to login -->
                   <fieldset>
                       <legend class=""><span><?php esc_attr_e('Login Logo', $this->plugin_name);?></span></legend>
                       <label for="<?php echo $this->plugin_name;?>-login_logo">
                           <input type="hidden" id="login_logo_id" name="<?php echo $this->plugin_name;?>[login_logo_id]" value="<?php echo $login_logo_id; ?>" />
                           <input id="upload_login_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', $this->plugin_name); ?>" />
                           <span><?php esc_attr_e('Login Logo', $this->plugin_name);?></span>
                       </label>
                       <div id="upload_logo_preview" class="freehand_cbf-upload-preview <?php if(empty($login_logo_id)) echo 'hidden'?>">
                           <img src="<?php echo $login_logo_url; ?>" />
                           <button id="freehand_cbf-delete_logo_button" class="freehand_cbf-delete-image">X</button>
                       </div>
                   </fieldset>

               <!-- login background color-->
                   <fieldset class="freehand_cbf-admin-colors">
                       <legend class=""><span><?php _e('Login Background Color', $this->plugin_name);?></span></legend>
                       <label for="<?php echo $this->plugin_name;?>-login_background_color">
                           <input type="text" class="<?php echo $this->plugin_name;?>-color-picker" id="<?php echo $this->plugin_name;?>-login_background_color" name="<?php echo $this->plugin_name;?>[login_background_color]"  value="<?php echo $login_background_color;?>"  />
                           <span><?php esc_attr_e('Login Background Color', $this->plugin_name);?></span>
                       </label>
                   </fieldset>

               <!-- login buttons and links primary color-->
                   <fieldset class="freehand_cbf-admin-colors">
                       <legend class=""><span><?php _e('Login Button and Links Color', $this->plugin_name);?></span></legend>
                       <label for="<?php echo $this->plugin_name;?>-login_button_primary_color">
                           <input type="text" class="<?php echo $this->plugin_name;?>-color-picker" id="<?php echo $this->plugin_name;?>-login_button_primary_color" name="<?php echo $this->plugin_name;?>[login_button_primary_color]" value="<?php echo $login_button_primary_color;?>" />
                           <span><?php esc_attr_e('Login Button and Links Color', $this->plugin_name);?></span>
                       </label>
                   </fieldset>

               <?php submit_button(__('Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>

    </form>

</div>

