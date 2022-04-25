<?php
add_action( 'tgmpa_register', 'rdtheme_register_required_plugins' );
function rdtheme_register_required_plugins() {
	$plugins = array(
		// Bundled
		array(
			'name'         => 'RedChili Core',
			'slug'         => 'redchili-core',
			'source'       => 'redchili-core.zip',
			'required'     =>  true,
			'external_url' => 'http://radiustheme.com',
			'version'      => '1.7.2'
		),
		array(
			'name'         => 'RT Framework',
			'slug'         => 'rt-framework',
			'source'       => 'rt-framework.zip',
			'required'     =>  true,
			'external_url' => 'http://radiustheme.com',
			'version'      => '1.7'
		),
		array(
			'name'         => 'RT Demo Importer',
			'slug'         => 'rt-demo-importer',
			'source'       => 'rt-demo-importer.zip',
			'required'     =>  true,
			'external_url' => 'http://radiustheme.com',
			'version'      => '4.1'
		),
		array(
			'name'         => 'WPBakery Page Builder',
			'slug'         => 'js_composer',
			'source'       => 'js_composer.zip',
			'required'     => true,
			'external_url' => 'http://vc.wpbakery.com',
			'version'      => '6.6.0'
		),
		array(
			'name'         => 'LayerSlider WP',
			'slug'         => 'LayerSlider',
			'source'       => 'LayerSlider.zip',
			'required'     => false,
			'external_url' => 'https://layerslider.kreaturamedia.com',
			'version'      => '6.11.8'
		),
		array(
			'name'         => 'WP Logo Showcase',
			'slug'         => 'wp-logo-showcase',
			'source'       => 'wp-logo-showcase.zip',
			'required'     => true,
			'external_url' => 'https://radiustheme.com/',
			'version'      => '2.5.6'
		),
		array(
			'name'         => 'Food Menu Pro',
			'slug'         => 'food-menu-pro',
			'source'       => 'food-menu-pro.zip',
			'required'     => true,
			'external_url' => 'https://radiustheme.com/',
			'version'      => '2.0.3'
		),
		// Repository
		array(
			'name'     => 'Redux Framework',
			'slug'     => 'redux-framework',
			'required' => true,
		),

		array(
			'name'     => 'Food Menu - Restaurant Menu & Online Ordering for WooCommerce',
			'slug'     => 'tlp-food-menu',
			'required' => true,
		),

		array(
			'name'     => 'Breadcrumb NavXT',
			'slug'     => 'breadcrumb-navxt',
			'required' => true,
		),
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false,
		),
		array(
			'name'     => 'WP Extended Search',
			'slug'     => 'wp-extended-search',
			'required' => false,
		),
		array(
			'name'     => 'WooCommerce',
			'slug'     => 'woocommerce',
			'required' => false,
		),
		array(
			'name'     => 'WP Retina 2x',
			'slug'     => 'wp-retina-2x',
			'required' => false,
		),
		array(
			'name'     => 'YITH WooCommerce Quick View',
			'slug'     => 'yith-woocommerce-quick-view',
			'required' => false,
		),
		array(
			'name'     => 'YITH WooCommerce Wishlist',
			'slug'     => 'yith-woocommerce-wishlist',
			'required' => false,
		),

	);

	$config = array(
		'id'           => 'redchili',             // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => RDTHEME_PLUGINS_DIR,   // Default absolute path to bundled plugins.
		'menu'         => 'rdtheme-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
