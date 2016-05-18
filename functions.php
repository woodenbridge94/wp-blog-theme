<?php
/**
 * Peanut Butter 2015 functions and definitions
 *
 * @package Peanut Butter 2015
 */


/**
 * Set constants to be used.
 */

// Default pattern library version to use if none set in the theme options.
define('DPL_VERSION_DEFAULT','0.5.2');

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'pb2015_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pb2015_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Peanut Butter 2015, use a find and replace
	 * to change 'pb2015' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'pb2015', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'pb2015' ),
		'header-nav' => __( 'Header Menu', 'pb2015' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'pb2015_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	// Add featued image
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 360, 240);
	add_image_size('featured-post-image', 530 , 340 );

	// Remove the WordPress generator tag in the header
	// This means folks can't detect just by HTML whether or not the site is WordPress.
	// This removes, for example: <meta name="generator" content="WordPress 4.1.3" />
	remove_action('wp_head', 'wp_generator');


}
endif; // pb2015_setup
add_action( 'after_setup_theme', 'pb2015_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function pb2015_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'pb2015' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer left', 'pb2015' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer right', 'pb2015' ),
		'id'            => 'footer-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'pb2015_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pb2015_scripts() {
	wp_enqueue_style( 'pb2015-style', get_stylesheet_uri(), array('dpl-style') );

	wp_enqueue_style( 'dpl-style', dpl_url("styles/screen.css"), array(),'20150427', 'screen' );

	wp_enqueue_style( 'dpl-style-print', dpl_url("styles/print.css"),array(), '20150427', 'print' );

	// Add Genericons font; used by the main stylesheet
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons/genericons.css', array(), '3.2' );

	wp_enqueue_style( 'page-specific-styles' );


	wp_enqueue_script( 'pb2015-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'dpl-script', dpl_url("scripts/core.js"), array(), '20150427', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pb2015_scripts' );

// Accordion Shortcode
function accordion_shortcode( $atts, $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'title' => '',
		), $atts )
	);

	// Code
return '<div class="accordion">
<h3><a class="toggleLink" href="#">'.$title.'</a></h3>
<div class="toggle">'.$content.'</div></div>';

}
add_shortcode( 'accordion', 'accordion_shortcode' );

// Custom excerpt lengths
function custom_excerpt($limit) {
    return wp_trim_words(get_the_excerpt(), $limit,'&nbsp;&hellip;');
}

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Include the configuration for theme options.
 */
require get_template_directory() . '/inc/theme-options.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Functions to integrate with the Digital pattern library
 */
require get_template_directory() . '/inc/pattern-library.php';

/**
 * Load up custom fields for pages.
 */
require get_template_directory() . '/inc/page-custom-fields.php';

/**
 * Load up breadcrumbs function.
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Load up navigation functions.
 */
require get_template_directory() . '/inc/navigation.php';


////////////////////////////////////////////////////////////////////////////////
// OTHER STUFF
// This stuff could possible moved into better locations at some point
////////////////////////////////////////////////////////////////////////////////

/**
 * Allow HTML in author biographies
 */
remove_filter('pre_user_description', 'wp_filter_kses');