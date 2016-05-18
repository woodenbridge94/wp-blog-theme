<?php
/**
 * Functions to integrate with the digital pattern library.
 *
 * @package Peanut Butter 2015
 */


/**
 * Creates a URL for an asset in the Digital pattern library.
 *
 * @param $path Sub-path to the asset. e.g. "styles/screen.css"
 * @return string
 */
function dpl_url($path) {
    return dpl_endpoint().'/'.dpl_version().'/'.$path;
}

/**
 * Return the Digital pattern library endpoint.
 *
 * @return string
 */
function dpl_endpoint() {
    return "//www.st-andrews.ac.uk/~cdn/dpl";
}

/**
 * Return the Digital pattern library version.
 *
 * @return string
 */
function dpl_version() {
    $options = get_option('pb2015_theme_options');
    return $options['dpl_version'] ? $options['dpl_version'] : DPL_VERSION_DEFAULT;
}
