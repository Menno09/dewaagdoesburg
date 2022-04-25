<?php

add_action( 'wp_enqueue_scripts', 'rdtheme_register_scripts', 12 );
function rdtheme_register_scripts(){
	/*CSS*/
	// owl.carousel CSS
	wp_register_style( 'owl-carousel', 			RDTHEME_CSS_URL . 'owl.carousel.min.css', array(), REDCHILI_THEME_VERSION );
	wp_register_style( 'owl-theme-default', 	RDTHEME_CSS_URL . 'owl.theme.default.min.css', array(), REDCHILI_THEME_VERSION );
	
	// owl.carousel.min js
	wp_register_script( 'owl-carousel', 		RDTHEME_JS_URL . 'owl.carousel.min.js', array( 'jquery' ), REDCHILI_THEME_VERSION, true );
	//flat icon
	wp_register_style( 'redchili-flaticon', 	RDTHEME_ASSETS_URL . 'fonts/flaticon.css', array(), REDCHILI_THEME_VERSION);
	//gmap
	wp_register_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key='. RDTheme::$options['gmap_key'] );
}

add_action( 'wp_enqueue_scripts', 'rdtheme_enqueue_scripts', 15 );
function rdtheme_enqueue_scripts() {
	/*CSS*/
	//Google fonts
	wp_enqueue_style( 'rdtheme-gfonts', 		RDTheme_Helper::fonts_url(), array(), REDCHILI_THEME_VERSION );
	//Bootstrap CSS	
	wp_enqueue_style( 'bootstrap',              RDTheme_Helper::maybe_rtl( 'bootstrap.min.css' ), array(), REDCHILI_THEME_VERSION );
	//font-awesome CSS
	wp_enqueue_style( 'font-awesome', 			RDTHEME_CSS_URL . 'font-awesome.min.css', array(), REDCHILI_THEME_VERSION );
	//Datetimepicker CSS
	wp_enqueue_style( 'datetimepicker', 		RDTHEME_CSS_URL . 'jquery.datetimepicker.min.css', array(), REDCHILI_THEME_VERSION );
	//Timepicker CSS
	wp_enqueue_style( 'timepicker', 		    RDTHEME_CSS_URL . 'jquery.timepicker.min.css', array(), REDCHILI_THEME_VERSION );
	//Defaults
	wp_enqueue_style( 'redchili-default',      	RDTheme_Helper::maybe_rtl( 'default.css' ), array(), REDCHILI_THEME_VERSION );
	//Style
	wp_enqueue_style( 'redchili-style',        	RDTheme_Helper::maybe_rtl( 'style.css' ), array(), REDCHILI_THEME_VERSION );	
	//VC modules
	wp_enqueue_style( 'redchili-vc',          	RDTheme_Helper::maybe_rtl( 'vc.css' ), array(), REDCHILI_THEME_VERSION );
	//Responsive style CSS
	wp_enqueue_style( 'redchili-responsive', 	RDTHEME_CSS_URL . 'responsive.css', array(), REDCHILI_THEME_VERSION );
	//variable style CSS
	ob_start();
	include RDTHEME_INC_DIR . 'variable-style.php';
	include RDTHEME_INC_DIR . 'variable-style-vc.php';
	$variable_css  = ob_get_clean();
	$variable_css .= wp_kses_post( RDTheme::$options['custom_css'] ); // custom css
	wp_add_inline_style( 'redchili-responsive', $variable_css );

	/*JS*/
	// bootstrap js
	wp_enqueue_script( 'bootstrap', 			RDTHEME_JS_URL . 'bootstrap.min.js', array( 'jquery' ), REDCHILI_THEME_VERSION, true );
	// Nav smooth scroll
	wp_enqueue_script( 'jquery-nav', 			RDTHEME_JS_URL . 'jquery.nav.min.js', array( 'jquery' ), REDCHILI_THEME_VERSION, true );
	// isotope
	wp_enqueue_script( 'isotope-pkgd',          RDTHEME_JS_URL . 'isotope.pkgd.min.js', array( 'jquery' ), REDCHILI_THEME_VERSION, true );
	// counterup js
	wp_enqueue_script( 'counterup', 			RDTHEME_JS_URL . 'jquery.counterup.min.js', array( 'jquery' ), REDCHILI_THEME_VERSION, true );
	// waypoints js
	wp_enqueue_script( 'waypoints', 			RDTHEME_JS_URL . 'waypoints.min.js', array( 'jquery' ), REDCHILI_THEME_VERSION, true );
	// datetimepicker js
	wp_enqueue_script( 'datetimepicker', 		RDTHEME_JS_URL . 'jquery.datetimepicker.full.min.js', array( 'jquery' ), REDCHILI_THEME_VERSION, true );
	// timepicker js
	wp_enqueue_script( 'timepicker', 			RDTHEME_JS_URL . 'jquery.timepicker.min.js', array( 'jquery' ), REDCHILI_THEME_VERSION, true );		

	/*Cookie js*/
	wp_enqueue_script( 'js-cookie', 			RDTHEME_JS_URL . 'js.cookie.min.js', array( 'jquery' ), REDCHILI_THEME_VERSION, true );
	// main js
	wp_enqueue_script( 'main', 					RDTHEME_JS_URL . 'main.js', array( 'jquery' ), time(), true );
	// Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular('rc_event') ) {		
		$rc_event_lan = get_post_meta(get_the_ID(), 'rc_event_lan', true);
		$rc_event_lat = get_post_meta(get_the_ID(), 'rc_event_lat', true);
		if(!empty($rc_event_lan) && !empty($rc_event_lat)){				
			wp_enqueue_script( 'google-map' );
			$isEventPage = 1;
		} else {
			$isEventPage = 0;
		}		
	} else {
		$isEventPage = 0;		
		$rc_event_lan = '';
		$rc_event_lat = '';
	}
	
	$vars = array( 'ajax_url' => admin_url( 'admin-ajax.php' ) );
		
	global $wp_query;
	
	$ajaxurl = admin_url('admin-ajax.php');
	// localize script
	$redchili_localize_data = array(
		'ajaxurl' => $ajaxurl,
		'isEventPage' => $isEventPage,
		'rc_event_lan'=> $rc_event_lan,
		'rc_event_lat'=> $rc_event_lat,
		'stickyMenu' => RDTheme::$options['sticky_menu'],
		'meanWidth'  => RDTheme::$options['resmenu_width'],
		'back_to_top' => RDTheme::$options['back_to_top'],
		'extraOffset' => RDTheme::$options['sticky_menu'] ? 70 : 0,
		'extraOffsetMobile' => RDTheme::$options['sticky_menu'] ? 52 : 0,
		'rtl'            => is_rtl() ? 'yes' : 'no', //@rtl
	);
	wp_localize_script( 'main', 'redChiliObj', $redchili_localize_data );
	wp_localize_script( 'main', 'WC_VARIATION_ADD_TO_CART', $vars );	
}

function load_custom_wp_admin_script_1() {
	wp_enqueue_style( 'rdtheme-gfonts', RDTheme_Helper::fonts_url(), array(), REDCHILI_THEME_VERSION );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_script_1', 1 );

// Admin Scripts
add_action( 'admin_enqueue_scripts', 'redchili_admin_scripts', 12 );
function redchili_admin_scripts(){
	global $pagenow, $typenow;

	wp_enqueue_style( 'font-awesome', RDTHEME_CSS_URL . 'font-awesome.min.css', array(), REDCHILI_THEME_VERSION );
	if( !in_array( $pagenow, array('post.php', 'post-new.php', 'edit.php') ) ) return;
	
	if( $typenow == 'wlshowcasesc' ){
	wp_enqueue_style( 'redchili-logo-showcase', RDTHEME_CSS_URL . 'admin-logo-showcase.css', array(), REDCHILI_THEME_VERSION );
	}
}