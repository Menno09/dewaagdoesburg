<?php
class RDTheme {

	protected static $instance = null;

	// Sitewide static variables
	public static $options = null;
	public static $redchili_chef_social = null;
	public static $redchili_event_social = null;

	// Template specific variables
	public static $layout = null;
	public static $sidebar = null;
	public static $tr_header = null;
	public static $top_bar = null;
	public static $top_bar_style = null;
	public static $header_style = null;	
	public static $padding_top = null;
	public static $padding_bottom = null;
	public static $has_banner = null;
	public static $has_breadcrumb = null;
	public static $bgtype = null;
	public static $bgimg = null;
	public static $bgcolor = null;

	private function __construct() {
		$this->redux_init();
		add_action( 'after_setup_theme', array( $this, 'set_redux_option' ) );
		add_action( 'init', array( $this, 'rewrite_flush_check' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function redux_init() {
		add_action( 'admin_menu', array( $this, 'remove_redux_menu' ), 12 ); // Remove Redux Menu
		add_filter( 'redux/redchili/aURL_filter', '__return_empty_string' ); // Remove Redux Ads		
		add_action( 'redux/loaded', array( $this, 'remove_redux_demo' ) ); // Removes the demo link and the notice

		// Flash permalink after options changed
		add_action( 'redux/options/redchili/saved', array( $this, 'flush_redux_saved' ), 10, 2 );
		add_action( 'redux/options/redchili/section/reset', array( $this, 'flush_redux_reset' ) );
		add_action( 'redux/options/redchili/reset', array( $this, 'flush_redux_reset' ) );
	}

	public function set_redux_option(){
		if ( ! class_exists( 'Redux' ) ) {
			include RDTHEME_INC_DIR . 'redux-data.php';
			self::$options = json_decode( $redchili_redux_data, true );
			return;
		}		
		global $redchili;
		self::$options = $redchili ? $redchili : array();
		// Prevent Redux first activation error
		if ( count( self::$options ) < 3 ) {
			include RDTHEME_INC_DIR . 'redux-data.php';
			self::$options = json_decode( $redchili_redux_data, true );
		}
	}

	public function remove_redux_menu() {
		remove_submenu_page('tools.php','redux-about');
	}
	
	public function remove_redux_demo(){
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			add_filter( 'plugin_row_meta', array( $this, 'redux_remove_extra_meta' ), 12, 2 );
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
		}
	}
	
	public function redux_remove_extra_meta( $links, $file ){
		if ( strpos( $file, 'redux-framework.php' ) !== false ) {
			$links = array_slice( $links, 0, 3 );
		}

		return $links;
	}

	// Flush rewrites
	public function flush_redux_saved( $saved_options, $changed_options ){
		if ( empty( $changed_options ) ) {
			return;
		}
		$flush = false;
		//if there are post types, then rewrite post type slug
		$slugs = array( 'recipe_slug', 'chef_slug' );
		foreach ( $slugs as $slug ) {
			if ( array_key_exists( $slug, $changed_options ) ) {
				$flush = true;
			}
		}

		if ( $flush ) {
			update_option( 'redchili_rewrite_flash', true );
		}
	}

	public function flush_redux_reset(){
		update_option( 'redchili_rewrite_flash', true );
	}

	public function rewrite_flush_check() {
		if ( get_option('redchili_rewrite_flash') == true ) {
			flush_rewrite_rules();
			update_option( 'redchili_rewrite_flash', false );
		}
	}
}

RDTheme::instance();