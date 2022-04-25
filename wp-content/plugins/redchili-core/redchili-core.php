<?php
/*
Plugin Name: RedChili Core
Plugin URI: http://radiustheme.com
Description: Red Chili Core Plugin for RedChili Theme
Version: 1.7.2
Author: Radius Theme
Author URI: http://radiustheme.com
GitLab Plugin URI: https://gitlab.com/wp-products/redchili-core
*/

define( 'REDCHILI_CORE_UPDATE_1', true );
define( 'REDCHILI_CORE_VERSION', ( WP_DEBUG ) ? time() : '1.5' );
define( 'REDCHILI_CORE_BASE_URL', plugin_dir_url( __FILE__ ) );

// Text Domain
add_action( 'plugins_loaded', 'redchili_core_load_textdomain' );
if(!function_exists('redchili_core_load_textdomain')){
	function redchili_core_load_textdomain() {
		load_plugin_textdomain( 'redchili-core' , false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
	}
}

add_action( 'after_setup_theme', 'vc_init' );
add_action( 'after_setup_theme', 'layerslider_init' );


function vc_init() {
	if ( function_exists('vc_updater') ) {
		remove_filter( 'upgrader_pre_download', array( vc_updater(), 'preUpgradeFilter' ), 10);
		remove_filter( 'pre_set_site_transient_update_plugins', array( vc_updater()->updateManager(), 'check_update' ) );				
	}
}

function layerslider_init() {
	add_action( 'layerslider_ready', 'disable_layerslider_autoupdate' );
	add_action( 'admin_init', 'layerslider_disable_plugin_notice' ); // Remove LayerSlider purchase notice from plugins page

	if ( !is_admin() || !apply_filters( 'rdtheme_disable_layerslider_autoupdate', true ) || get_option( 'layerslider-authorized-site' ) ) return;

	// Fix issue of Layerslider update via TGM. Side effect: autoupdate disabled permanently
	global $LS_AutoUpdate;
	if ( isset( $LS_AutoUpdate ) && defined( 'LS_ROOT_FILE' ) ) {
		remove_filter( 'pre_set_site_transient_update_plugins', array( $LS_AutoUpdate, 'set_update_transient' ) );
		remove_filter( 'plugins_api', array( $LS_AutoUpdate, 'set_updates_api_results'), 10, 3 );
		remove_filter( 'upgrader_pre_download', array( $LS_AutoUpdate, 'pre_download_filter' ), 10, 4 );
		remove_filter( 'in_plugin_update_message-'.plugin_basename( LS_ROOT_FILE ), array( $LS_AutoUpdate, 'update_message' ) );
		remove_filter( 'wp_ajax_layerslider_authorize_site', array( $LS_AutoUpdate, 'handleActivation' ) );
		remove_filter( 'wp_ajax_layerslider_deauthorize_site', array( $LS_AutoUpdate, 'handleDeactivation' ) );
	}
}

function layerslider_disable_plugin_notice() {
	if ( defined( 'LS_PLUGIN_BASE' ) ) {
		remove_action( 'after_plugin_row_' . LS_PLUGIN_BASE, 'layerslider_plugins_purchase_notice', 10, 3 );
	}
}

function disable_layerslider_autoupdate() {
	$GLOBALS['lsAutoUpdateBox'] = false;
}

require_once 'widgets/widget-settings.php';
require_once 'widgets/address-widget.php';
require_once 'widgets/about-widget.php';
require_once 'widgets/rt-recent-post-widget.php';
require_once 'widgets/rt-recent-recipe-widget.php';
require_once 'widgets/rt-open-hour-widget.php';
require_once 'optimization/__init__.php';

// Post types
add_action( 'after_setup_theme', 'redchili_core_post_types', 15 );
if(!function_exists('redchili_core_post_types')){
	function redchili_core_post_types(){
		if ( !defined( 'REDCHILI_THEME_VERSION' ) || ! defined( 'RT_FRAMEWORK_VERSION' ) ) {
			return;
		}
		require_once 'post-types.php';
		require_once 'post-meta.php';		
	}
}

// Visual composer
add_action( 'after_setup_theme', 'redchili_core_vc_modules', 20 );
if(!function_exists('redchili_core_vc_modules')){
	function redchili_core_vc_modules(){
		if ( !defined( 'REDCHILI_THEME_VERSION' ) || ! defined( 'WPB_VC_VERSION' ) ) {
			return;
		}
		
		require_once 'vc-flaticon/vc-flaticon.php';
		
		$modules = array( 'inc/abstruct', 'title', 'about', 'about-with-slider', 'recipe', 'recipe-grid', 'counter', 'chef', 'chef-grid', 'post-slider', 'infobox', 'testimonial', 'contact', 'event', 'event-grid', 'upmenu' );
		
		if ( class_exists( 'WC_Widget_Cart' ) ) {			
			array_push($modules,"woocommerce-product-layout");
		}
		
		foreach ( $modules as $module ) {
			require_once 'vc-modules/' . $module. '.php';
		}
	}
}

//Custom Functions
function rt_vc_pagination(){
	if ( !defined( 'REDCHILI_THEME_VERSION' ) ) {
		return;
	}
	return RDTheme_Helper::pagination();
}

// Demo Importer settings
require_once 'demo-importer.php';