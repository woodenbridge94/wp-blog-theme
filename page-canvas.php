<?php
/*
 * Template Name: Blank canvas
 *
 * This page template is used to get a complete blank slate to include
 * any needed HTML code from the pattern library.
 * 
 * This is not ideal for typical content pages, but rather is
 * ideal when you want to have a blank cavas to work with.
 *
 * @package Peanut Butter 2015
 */


    // Add custom styles if on a page template: 
    $page_custom_css = null;
    if ('page' == get_post_type() && 'page-canvas.php' == get_page_template_slug()) {
        $page_custom_css = get_post_meta( get_the_ID(), '_page_custom_css', true);
    }

    // Remove the auto <p> that WordPress adds by default.
    remove_filter( 'the_content', 'wpautop' );


get_header(); ?>


<?php while ( have_posts() ) : the_post(); ?>


	<?php the_content(); ?>
			

<?php endwhile; // end of the loop. ?>

<style type="text/css">
<?php print $page_custom_css ? $page_custom_css : null; ?>
</style>

<?php get_footer(); ?>
