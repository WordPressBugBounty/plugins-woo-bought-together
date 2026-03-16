<?php
defined( 'ABSPATH' ) || exit;

register_activation_hook( defined( 'WOOBT_LITE' ) ? WOOBT_LITE : WOOBT_FILE, 'woobt_activate' );
register_deactivation_hook( defined( 'WOOBT_LITE' ) ? WOOBT_LITE : WOOBT_FILE, 'woobt_deactivate' );
add_action( 'admin_init', 'woobt_check_version' );

function woobt_check_version() {
	if ( ! empty( get_option( 'woobt_version' ) ) && ( get_option( 'woobt_version' ) < WOOBT_VERSION ) ) {
		wpc_log( 'woobt', 'upgraded' );
		update_option( 'woobt_version', WOOBT_VERSION, false );
	}
}

function woobt_activate() {
	wpc_log( 'woobt', 'installed' );
	update_option( 'woobt_version', WOOBT_VERSION, false );
}

function woobt_deactivate() {
	wpc_log( 'woobt', 'deactivated' );
}

if ( ! function_exists( 'wpc_log' ) ) {
	function wpc_log( $prefix, $action ) {
		$logs = get_option( 'wpc_logs', [] );
		$user = wp_get_current_user();

		if ( ! isset( $logs[ $prefix ] ) ) {
			$logs[ $prefix ] = [];
		}

		$logs[ $prefix ][] = [
			'time'   => current_time( 'mysql' ),
			'user'   => $user->display_name . ' (ID: ' . $user->ID . ')',
			'action' => $action
		];

		update_option( 'wpc_logs', $logs, false );
	}
}