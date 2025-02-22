<?php
/**
 * Plugin Name: E2E Search Console Property Endpoint
 * Description: REST Endpoint for setting the Search Console property for Site Kit during E2E tests.
 */

use Google\Site_Kit\Core\REST_API\REST_Routes;

add_action( 'rest_api_init', function () {
	if ( ! defined( 'GOOGLESITEKIT_PLUGIN_MAIN_FILE' ) ) {
		return;
	}

	register_rest_route(
		REST_Routes::REST_ROOT,
		'e2e/setup/search-console-property',
		array(
			'methods'  => WP_REST_Server::EDITABLE,
			'callback' => function ( WP_REST_Request $request ) {
				if ( $request['property'] ) {
					update_option( 'googlesitekit_search_console_property', $request['property'] );
				} else {
					delete_option( 'googlesitekit_search_console_property' );
				}
			}
		)
	);
}, 0 );
