<?php
/**
 * Theme filters.
 *
 * All filters should be applied here.
 *
 * @package falcon
 */

namespace App;

use function Roots\asset;
/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter(
	'excerpt_more',
	function () {
		return sprintf( ' &hellip; <a href="%s">%s</a>', get_permalink(), __( 'Continued', 'sage' ) );
	}
);

/**
 * Add custom classes to the top level menu items
 *
 * @param [type] $classes menu item classes.
 * @param [type] $item menu item object.
 * @param [type] $args menu arguments.
 * @param [type] $depth menu depth.
 * @return String
 */
function falcon_nav_add_custom_classes( $classes, $item, $args, $depth ) {
	if ( 'primary_navigation' === $args->theme_location ) {
		if ( 0 === $depth ) {
			$classes[] = 'first-level-menu-item';
		}
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', __NAMESPACE__ . '\falcon_nav_add_custom_classes', 10, 4 );

/**
 * Common style for all anchor tags in the menu
 *
 * @param [type] $atts anchor tag attributes.
 * @param [type] $item menu item object.
 * @param [type] $args menu arguments.
 * @param [type] $depth menu depth.
 * @return String
 */
function falcon_add_class_for_all_menu_location_atts( $atts, $item, $args, $depth ) {
	// check if the item is in the primary menu.
	if ( 'primary_navigation' === $args->theme_location ) {
		/**
		 * If the item is a top level menu item, add the class 'no-underline' and prevent the item from being clickable
		 */
		if ( 0 === $depth ) {
			// add the desired attributes:.
			$atts['class'] = 'no-underline';
			// prevent parent menu items from being clickable.
			$atts['onClick'] = 'return false';
		} else {
			/**
			 * If the item is a sub-menu item, add the class 'py-1 inline-block no-underline hover:text-primary-500 hover:underline'
			 * to style the anchor tag.
			 */
			$atts['class'] = 'py-1 inline-block no-underline hover:text-primary-500 hover:underline';
		}
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', __NAMESPACE__ . '\falcon_add_class_for_all_menu_location_atts', 10, 4 );

/**
 * Prefetch the main stylesheet
 */
add_filter(
	'wp_resource_hints',
	function ( $hints, $relation_type ) {
		if ( 'prefetch' === $relation_type ) {
			$hints[] = asset( 'app-styles.css' )->uri(); // Adjust path if necessary.
		}
		return $hints;
	},
	10,
	2
);

/**
 * Allow anonymous comments
 */
add_filter( 'rest_allow_anonymous_comments', '__return_true' );
