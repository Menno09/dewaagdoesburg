<?php
/**
 * Plugin Name: Food Menu Pro - Restaurant Menu & Online Ordering for WooCommerce
 * Plugin URI: http://demo.radiustheme.com/wordpress/plugins/food-menu/
 * Description: A Simple Food & Restaurant Menu Display Plugin for Restaurant, Cafes, Fast Food, Coffee House with WooCommerce Online Ordering.
 * Author: RadiusTheme
 * Version: 2.0.3
 * Text Domain: food-menu-pro
 * Domain Path: /languages
 * Author URI: https://radiustheme.com/
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$plugin_data = get_file_data( __FILE__, array( 'name'    => 'Plugin Name',
                                               'version' => 'Version',
                                               'author'  => 'Author'
), false );
define( 'FOOD_MENU_PRO_VERSION', $plugin_data['version'] );
define( 'FOOD_MENU_PRO_AUTHOR', $plugin_data['author'] );
define( 'EDD_FOOD_MENU_PRO_STORE_URL', 'https://www.radiustheme.com' );
define( 'EDD_FOOD_MENU_PRO_ITEM_ID', 5265 );
define( 'EDD_FOOD_MENU_PRO_ITEM_NAME', $plugin_data['name']  );
define( 'FOOD_MENU_PRO_PLUGIN_PATH', dirname( __FILE__ ) );
define( 'FOOD_MENU_PRO_PLUGIN_ACTIVE_FILE_NAME', __FILE__ );
define( 'FOOD_MENU_PRO_PLUGIN_URL', plugins_url( '', __FILE__ ) );
define( 'FOOD_MENU_PRO_LANGUAGE_PATH', dirname( plugin_basename( __FILE__ ) ) . '/languages' );

require( 'lib/init.php' );