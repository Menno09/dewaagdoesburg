<?php
if ( ! defined( 'WPB_VC_VERSION' ) ) {
	return;
}

if ( ! defined( 'RT_VC_FLATICON_ASSETS' ) ) {
	define( 'RT_VC_FLATICON_ASSETS',  REDCHILI_CORE_BASE_URL . 'vc-flaticon/assets/' );
}
if ( ! defined( 'RT_VC_FLATICON_VERSION' ) ) {
	define( 'RT_VC_FLATICON_VERSION',  REDCHILI_CORE_VERSION );
}

// Register Flaticon CSS
add_action( 'init', 'rt_register_flaticons' );
function rt_register_flaticons(){
	wp_register_style( 'rt-flaticon-gastronimy', RT_VC_FLATICON_ASSETS . 'flaticon-gastronimy.css', array(), RT_VC_FLATICON_VERSION );
	wp_register_style( 'rt-flaticon-redchili',   RT_VC_FLATICON_ASSETS . 'flaticon-redchili.css', array(), RT_VC_FLATICON_VERSION );
	wp_register_style( 'rt-flaticon-far',        RT_VC_FLATICON_ASSETS . 'flaticon-far.css', array(), RT_VC_FLATICON_VERSION );
	wp_register_style( 'rt-flaticon-bbq',        RT_VC_FLATICON_ASSETS . 'flaticon-bbq.css', array(), RT_VC_FLATICON_VERSION );
	wp_register_style( 'rt-flaticon-restaurant', RT_VC_FLATICON_ASSETS . 'flaticon-restaurant.css', array(), RT_VC_FLATICON_VERSION );
	do_action( 'rt_vc_flaticon_registers',       RT_VC_FLATICON_VERSION );
}

// Enqueue Flaticon CSS in VC Editor Mode
add_action( 'vc_backend_editor_enqueue_js_css', 'rt_enqueue_flaticon_in_editor' );
add_action( 'vc_frontend_editor_enqueue_js_css', 'rt_enqueue_flaticon_in_editor' );
function rt_enqueue_flaticon_in_editor() {	
	wp_enqueue_style( 'rt-flaticon-gastronimy' );
	wp_enqueue_style( 'rt-flaticon-redchili' );
	wp_enqueue_style( 'rt-flaticon-far' );
	wp_enqueue_style( 'rt-flaticon-bbq' );
	wp_enqueue_style( 'rt-flaticon-restaurant' );
	do_action( 'rt_vc_flaticon_enqueues');
}

// Enqueue Flaticon CSS in frontend
add_action( 'vc_enqueue_font_icon_element', 'rt_enqueue_flaticon_in_shortcode' );
function rt_enqueue_flaticon_in_shortcode( $font ){
	// remove substring after 2nd occurrence of '-'
	$newstr = substr( $font, 0, strpos( $font, '-', strpos( $font, '-' ) +1 ) );
	$newstr = 'rt-' . $newstr;
	// enqueue
	if ( wp_style_is( $newstr, 'registered' ) ) {
		wp_enqueue_style( $newstr );
	}
}

// Flaticon fields
add_filter( 'vc_iconpicker-type-flaticon', 'rt_flaticons_array' );
function rt_flaticons_array( $icons ) {	
	require 'flaticon-gastronimy.php';
	require 'flaticon-redchili.php';
	require 'flaticon-far.php';
	require 'flaticon-bbq.php';
	require 'flaticon-restaurant.php';
	$flaticons = array(
		__( 'Gastronimy', 'redchili-core' )	       => $flaticons_gastronimy,
		__( 'BBQ', 'redchili-core' )     	       => $flaticons_bbq,
		__( 'Food & Restaurant', 'redchili-core' ) => $flaticons_far,
		__( 'Restaurant', 'redchili-core' )        => $flaticons_restaurant,
		__( 'Icon', 'redchili-core' )              => $flaticons_redchili,
	);
	$flaticons = apply_filters( 'rt_vc_flaticon_fields', $flaticons );
	return array_merge( $icons, $flaticons );
}