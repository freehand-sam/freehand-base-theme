<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<footer class="site-footer" id="wrapper-footer">
	<?php if(get_theme_mod('freehand_footer_logo') != ''): ?>
	  <?php $footer_logo = esc_url(get_theme_mod('freehand_footer_logo')); ?>
	  <img class="footer-logo" src="<?php echo $footer_logo; ?>" alt="<?php bloginfo( 'name' ); ?>" >
	<?php endif; ?>
    <div class="site-info">
        <?php echo dynamic_copyright() . ' '; bloginfo( 'name' ); ?> <span class="nowrap">All rights reserved.</span></a>
    </div>
</footer>

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>
</html>

