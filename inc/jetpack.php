<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Peanut Butter 2015
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function pb2015_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'pb2015_jetpack_setup' );
