<?php
/*
Plugin Name: WPC Frequently Bought Together for WooCommerce
Plugin URI: https://wpclever.net/
Description: Increase your sales with personalized product recommendations.
Version: 7.6.9
Author: WPClever
Author URI: https://wpclever.net
Text Domain: woo-bought-together
Domain Path: /languages/
Requires Plugins: woocommerce
Requires at least: 4.0
Tested up to: 6.8
WC requires at least: 3.0
WC tested up to: 10.1
*/

defined( 'ABSPATH' ) || exit;

! defined( 'WOOBT_VERSION' ) && define( 'WOOBT_VERSION', '7.6.9' );
! defined( 'WOOBT_LITE' ) && define( 'WOOBT_LITE', __FILE__ );
! defined( 'WOOBT_FILE' ) && define( 'WOOBT_FILE', __FILE__ );
! defined( 'WOOBT_URI' ) && define( 'WOOBT_URI', plugin_dir_url( __FILE__ ) );
! defined( 'WOOBT_DIR' ) && define( 'WOOBT_DIR', plugin_dir_path( __FILE__ ) );
! defined( 'WOOBT_SUPPORT' ) && define( 'WOOBT_SUPPORT', 'https://wpclever.net/support?utm_source=support&utm_medium=woobt&utm_campaign=wporg' );
! defined( 'WOOBT_REVIEWS' ) && define( 'WOOBT_REVIEWS', 'https://wordpress.org/support/plugin/woo-bought-together/reviews/?filter=5' );
! defined( 'WOOBT_CHANGELOG' ) && define( 'WOOBT_CHANGELOG', 'https://wordpress.org/plugins/woo-bought-together/#developers' );
! defined( 'WOOBT_DISCUSSION' ) && define( 'WOOBT_DISCUSSION', 'https://wordpress.org/support/plugin/woo-bought-together' );
! defined( 'WPC_URI' ) && define( 'WPC_URI', WOOBT_URI );

include 'includes/dashboard/wpc-dashboard.php';
include 'includes/kit/wpc-kit.php';
include 'includes/hpos.php';

if ( ! function_exists( 'woobt_init' ) ) {
	add_action( 'plugins_loaded', 'woobt_init', 11 );

	function woobt_init() {
		if ( ! function_exists( 'WC' ) || ! version_compare( WC()->version, '3.0', '>=' ) ) {
			add_action( 'admin_notices', 'woobt_notice_wc' );

			return null;
		}

		require_once 'includes/class-helper.php';
		require_once 'includes/class-blocks.php';
		require_once 'includes/class-woobt.php';
	}
}

if ( ! function_exists( 'woobt_notice_wc' ) ) {
	function woobt_notice_wc() {
		?>
        <div class="error">
            <p><strong>WPC Frequently Bought Together</strong> requires WooCommerce version 3.0 or greater.</p>
        </div>
		<?php
	}
}
