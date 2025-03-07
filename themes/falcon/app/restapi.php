<?php
/**
 * REST API Custom route.
 *
 * @package falcon
 */

namespace App;

/**
 * Register custom REST API routes for menus
 */
add_action(
	'rest_api_init',
	function () {
		// Route for fetching a single menu by ID.
		register_rest_route(
			'smart-menu-api/v1',
			'/menus/(?P<id>\d+)',
			array(
				'methods'             => 'GET',
				'callback'            => __NAMESPACE__ . '\falcon_callback_get_single_menu',
				'permission_callback' => '__return_true',
				'args'                => array(
					'id' => array(
						'required'          => true,
						'validate_callback' => function ( $param, $request, $key ) {
							return is_numeric( $param );
						},
					),
				),
			)
		);
	}
);

/**
 * Callback for fetching a single menu by ID
 *
 * @param \WP_REST_Request $request Request object.
 * @return WP_REST_Response
 */
function falcon_callback_get_single_menu( \WP_REST_Request $request ) {
	$menu_id    = $request->get_param( 'id' );
	$menu_items = wp_get_nav_menu_items( $menu_id );

	if ( empty( $menu_items ) ) {
		return new \WP_REST_Response(
			array(
				'message' => 'Menu not found',
			),
			404
		);
	}

	$response = array_map(
		function ( $item ) {
			return array(
				'id'          => $item->ID,
				'title'       => $item->title,
				'url'         => $item->url,
				'parent'      => $item->menu_item_parent,
				'description' => $item->description,
				'classes'     => $item->classes,
			);
		},
		$menu_items
	);

	return new \WP_REST_Response( $response, 200 );
}
