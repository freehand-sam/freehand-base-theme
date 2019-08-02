<?php
/**
 * Template Name: Full Width Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<div class="wrapper">
    <main class="site-main" id="main" role="main">
        <?php while ( have_posts() ) : the_post();
            if (is_front_page()):
                get_template_part( 'loop-templates/content', 'home' );
            elseif (is_page('contact')):
                get_template_part( 'loop-templates/content', 'contact' );
            else:
                get_template_part( 'loop-templates/content', 'blank' );
            endif;
        endwhile; // end of the loop. ?>
    </main><!-- #main -->	
</div><!-- #full-width-page-wrapper -->

<?php get_footer(); ?>
