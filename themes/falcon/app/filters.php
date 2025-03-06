<?php

/**
 * Theme filters.
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
 * @param [type] $classes menu item classes
 * @param [type] $item menu item object
 * @param [type] $args menu arguments
 * @param [type] $depth menu depth
 * @return void
 */
function Sage_Nav_Add_Custom_classes( $classes, $item, $args, $depth ) {
	if ( 'primary_navigation' === $args->theme_location ) {
		if ( 0 === $depth ) {
			$classes[] = 'first-level-menu-item';
		}
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', __NAMESPACE__ . '\Sage_Nav_Add_Custom_classes', 10, 4 );

/**
 * Common style for all anchor tags in the menu
 *
 * @param [type] $atts
 * @param [type] $item
 * @param [type] $args
 * @param [type] $depth
 * @return void
 */
function add_class_for_all_menu_location_atts( $atts, $item, $args, $depth ) {
	// check if the item is in the primary menu
	if ( $args->theme_location == 'primary_navigation' ) {
		/**
		 * If the item is a top level menu item, add the class 'no-underline' and prevent the item from being clickable
		 */
		if ( 0 === $depth ) {
			// add the desired attributes:
			$atts['class'] = 'no-underline';
			// prevent parent menu items from being clickable
			$atts['onClick'] = 'return false';
		} else {
			/**
			 *
			 */
			$atts['class'] = 'py-1 inline-block no-underline hover:text-primary-500 hover:underline';
		}
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', __NAMESPACE__ . '\add_class_for_all_menu_location_atts', 10, 4 );


add_filter('wp_resource_hints', function ($hints, $relation_type) {
    if ('prefetch' === $relation_type) {
        $hints[] = asset('app-styles.css')->uri(); // Adjust path if necessary
    }
    return $hints;
}, 10, 2);

function allow_cors_for_rest_api() {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Headers: Authorization, Content-Type");
}
// add_action('rest_api_init', function () {
//     add_action('send_headers', 'allow_cors_for_rest_api');
// });

add_filter('rest_allow_anonymous_comments', '__return_true');

/**
 * Register custom REST API routes for menus
 */
add_action('rest_api_init', function () {
    // Route for fetching all menus
    // register_rest_route('custom/v1', '/menus', array(
    //     'methods'  => 'GET',
    //     'callback' => __NAMESPACE__ . '\get_all_menus',
    //     'permission_callback' => '__return_true',
    // ));

	/**
	 * Register a custom REST API route for menus.
	 */
    register_rest_route('smart-menu-api/v1', '/menus', [
        'methods'  => 'GET',
        'callback' => __NAMESPACE__. '\get_menus_data',
        'permission_callback' => '__return_true', // Make it public (can modify as needed).
    ]);


    // Route for fetching a single menu by ID
    register_rest_route('smart-menu-api/v1', '/menus/(?P<id>\d+)', array(
        'methods'  => 'GET',
        'callback' => __NAMESPACE__ . '\get_single_menu',
        'permission_callback' => '__return_true',
        'args'     => array(
            'id' => array(
                'required'          => true,
                'validate_callback' => function ($param, $request, $key) {
                    return is_numeric($param);
                },
            ),
        ),
    ));
});

/**
 * Callback for fetching all menus
 *
 * @return WP_REST_Response
 */
function get_all_menus() {
    $menus = wp_get_nav_menus();
	$reg_menus = get_registered_nav_menus();

    if (empty($menus)) {
        return new \WP_REST_Response(array(
            'message' => 'No menus found',
        ), 404);
    }

    $response = array_map(function ($menu) {
        return array(
            'id'   => $menu->term_id,
            'name' => $menu->name,
            'slug' => $menu->slug,
        );
    }, $menus);

    return new \WP_REST_Response($response, 200);
}

/**
 * Callback for fetching a single menu by ID
 *
 * @param WP_REST_Request $request
 * @return WP_REST_Response
 */
function get_single_menu(\WP_REST_Request $request) {
    $menu_id = $request->get_param('id');
    $menu_items = wp_get_nav_menu_items($menu_id);

    if (empty($menu_items)) {
        return new \WP_REST_Response(array(
            'message' => 'Menu not found',
        ), 404);
    }

    $response = array_map(function ($item) {
        return array(
            'id'         => $item->ID,
            'title'      => $item->title,
            'url'        => $item->url,
            'parent'     => $item->menu_item_parent,
            'description'=> $item->description,
            'classes'    => $item->classes,
        );
    }, $menu_items);

    return new \WP_REST_Response($response, 200);
}

/**
 * Callback function to fetch menu data.
 */
function get_menus_data($request) {
    // Get all registered menu locations
    $registered_menus = get_registered_nav_menus();

    // Get assigned menus (locations mapped to menu IDs)
    $menu_locations = get_nav_menu_locations();
	// var_dump($registered_menus);
	// var_dump($menu_locations);

    $menus = [];
    foreach ($registered_menus as $location => $description) {
        $menu_id = isset($menu_locations[$location]) ? $menu_locations[$location] : null;
        $menu_items = $menu_id ? wp_get_nav_menu_items($menu_id) : [];
		$menu_object = $menu_id ? wp_get_nav_menu_object($menu_id) : null;
		// var_dump($menu_object);

        $menus[] = [
            'location'      => $location,
            'description'   => $description,
            'menu_id'       => $menu_id,
			'menu_name'     => $menu_object ? $menu_object->name : null, // Add menu name
            'menu_slug'     => $menu_object ? $menu_object->slug : null, // Add menu slug
            // 'menu_items'    => array_map(function ($item) {
            //     return [
            //         'id'    => $item->ID,
            //         'title' => $item->title,
            //         'url'   => $item->url,
            //         'parent'=> $item->menu_item_parent, // For nested menus
            //     ];
            // }, $menu_items ?: []),
        ];
    }

    return rest_ensure_response($menus);
}