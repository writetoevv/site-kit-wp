<?php
/**
 * Plugin Name: E2E Tests Reset Plugin
 * Plugin URI:  https://github.com/google/site-kit-wp
 * Description: Utility plugin for resetting Site Kit during E2E tests.
 * Author:      Google
 * Author URI:  https://opensource.google.com
 */

use Google\Site_Kit\Context;
use Google\Site_Kit\Core\Util\Reset;

register_activation_hook( __FILE__, static function () {
	( new Reset( new Context( GOOGLESITEKIT_PLUGIN_MAIN_FILE ) ) )->all();

	/**
	 * Remove anything left behind.
	 * @link https://github.com/google/site-kit-wp/issues/351
	 */
	global $wpdb;

	$wpdb->query(
		"DELETE FROM $wpdb->options WHERE option_name LIKE '%googlesitekit%'"
	);
	$wpdb->query(
		"DELETE FROM $wpdb->usermeta WHERE meta_key LIKE '%googlesitekit%'"
	);
} );
