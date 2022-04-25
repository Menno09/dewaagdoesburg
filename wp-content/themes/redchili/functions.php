<?php
$rdtheme_theme_data = wp_get_theme();
define( 'REDCHILI_THEME_VERSION', ( WP_DEBUG ) ? time() : $rdtheme_theme_data->get( 'Version' ) );
define( 'RDTHEME_AUTHOR_URI', $rdtheme_theme_data->get( 'AuthorURI' ) );
define( 'RDTHEME_PREFIX', 'redchili' );

// DIR
define( 'RDTHEME_BASE_DIR',    get_template_directory(). '/' );
define( 'RDTHEME_INC_DIR',     RDTHEME_BASE_DIR . 'inc/' );
define( 'RDTHEME_LIB_DIR',     RDTHEME_BASE_DIR . 'lib/' );
define( 'RDTHEME_WID_DIR',     RDTHEME_INC_DIR . 'widgets/' );
define( 'RDTHEME_PLUGINS_DIR', RDTHEME_INC_DIR . 'plugins/' );
define( 'RDTHEME_JS_DIR',      RDTHEME_BASE_DIR . 'assets/js/' );

// URL
define( 'RDTHEME_BASE_URL',    get_template_directory_uri(). '/' );
define( 'RDTHEME_ASSETS_URL',  RDTHEME_BASE_URL . 'assets/' );
define( 'RDTHEME_CSS_URL',     RDTHEME_ASSETS_URL . 'css/' );
define( 'RDTHEME_AUTORTL_URL', RDTHEME_ASSETS_URL . 'css-auto-rtl/' );
define( 'RDTHEME_JS_URL',      RDTHEME_ASSETS_URL . 'js/' );
define( 'RDTHEME_IMG_URL',     RDTHEME_ASSETS_URL . 'img/' );
define( 'RDTHEME_LIB_URL',     RDTHEME_BASE_URL . 'lib/' );

// Includes
require_once RDTHEME_INC_DIR . 'helper-functions.php';
require_once RDTHEME_INC_DIR . 'redux-config.php';
require_once RDTHEME_INC_DIR . 'rdtheme.php';
require_once RDTHEME_INC_DIR . 'general.php';
require_once RDTHEME_INC_DIR . 'scripts.php';
require_once RDTHEME_INC_DIR . 'template-vars.php';
require_once RDTHEME_INC_DIR . 'vc-settings.php';
require_once RDTHEME_INC_DIR . 'sidebar-generator.php';
require_once RDTHEME_INC_DIR . 'search-widget.php';
require_once RDTHEME_INC_DIR . 'lc-helper.php';
require_once RDTHEME_INC_DIR . 'lc-utility.php';

// WooCommerce
if ( class_exists( 'WooCommerce' ) ) {
	require_once RDTHEME_INC_DIR . 'woo-functions.php';
	require_once RDTHEME_INC_DIR . 'woo-hooks.php';
}

// TGM Plugin Activation
if ( is_admin() ) {
	require_once RDTHEME_LIB_DIR . 'class-tgm-plugin-activation.php';
	require_once RDTHEME_INC_DIR . 'tgm-config.php';
}

add_editor_style( 'style-editor.css' );


// Widgets fallback
if ( function_exists( 'redchili_core_load_textdomain' ) && !defined( 'REDCHILI_CORE_UPDATE_1' ) ) {
	add_action( 'admin_notices', 'redchili_widgets_fallback_notice' );
}

function redchili_widgets_fallback_notice() {
	$notice = '<div class="error"><p>' . sprintf( __( "Please update plugin <b><i>Redchili Core</b></i> to the latest version otherwise some functionalities will not work properly. You can update it from <a href='%s'>here</a>", 'redchili' ), menu_page_url( 'redchili-install-plugins', false ) ) . '</p></div>';
	echo wp_kses_post( $notice );
}

function redchili_food_layout( $layout) {

	$new_layout = [

			'custom-grid-by-cat2' 		=> __( 'Redchili Menu - Card Style 1', 'food-menu-pro' ), // food menu card 01
			'custom-grid-by-cat4' 		=> __( 'Redchili Menu - Card Style 2', 'food-menu-pro' ), // food menu card 02
			'custom-grid-by-cat3' 		=> __( 'Redchili Menu - Card Style 3', 'food-menu-pro' ), // food menu card 03
			'custom-grid-by-cat1' 		=> __( 'Redchili Menu - Card Style 4', 'food-menu-pro' ), // food menu card 04
			'custom-grid-by-cat5' 		=> __( 'Redchili Menu - Card Style 5', 'food-menu-pro' ), // food menu card 05
			'custom-layout6' 			=> __( 'Redchili Menu - Card Style 6 ( load more )', 'food-menu-pro' ), // food menu card 06
			'custom-grid-by-cat6' 		=> __( 'Redchili Menu - Card Style 7 ( New )', 'food-menu-pro' ), // card 06 (with variable price)
			'custom-isotope-redchili' 	=> __( 'Redchili Menu - Isotope Style 1', 'food-menu-pro' ), // ok
			'custom-isotope-redchili-2' => __( 'Redchili Menu - Isotope Style 2', 'food-menu-pro' ), // ok
			'custom-isotope-redchili-3' => __( 'Redchili Menu - Isotope Style 3', 'food-menu-pro' ), // ok
			'custom-layout-redchili' 	=> __( 'Redchili Menu - Grid with Pagination', 'food-menu-pro' ), //ok
			'custom-grid-layout1'      	=> __( 'Redchili Menu - Grid with Load More', 'food-menu-pro' ),
	];

    return array_merge($layout,$new_layout);

}
add_filter('fmp_sc_layouts', 'redchili_food_layout');