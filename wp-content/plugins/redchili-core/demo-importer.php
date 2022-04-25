<?php
add_action( 'plugins_loaded', 'redchili_core_load_demo_importer', 15 );
function redchili_core_load_demo_importer(){
	add_filter( 'plugin_action_links_rt-demo-importer/rt-demo-importer.php', 'redchili_importer_add_action_links' );
	add_filter( 'rt_demo_installer_warning', 'theme_importer_warning' );
	add_filter( 'fw:ext:backups-demo:demos', 'redchili_importer_backups_demos' );
	add_action( 'fw:ext:backups:tasks:success:id:demo-content-install', 'redchili_importer_after_demo_install' );
}

function theme_importer_warning( $links ) {
	$html  = '<div style="color:#f00;font-size:20px;line-height:1.3;font-weight:600;margin-bottom:40px;border-color: #f00;border-style: dashed;border-width: 1px 0;padding:10px 0;">';
	$html .= sprintf( __( 'Warning: All your old data will be lost if you install One Click demo data from here, so it is suitable only for a new website. For existing website please use XML data import method which is described in the documentation <a %s>here</a>', 'redchili-core'), 'href="https://radiustheme.com/demo/wordpress/redchili/docs/#demo" target="_blank" style="color:red;"' );
	$html .= '</div>';
	return $html;
}

function redchili_importer_add_action_links( $links ) {
	$mylinks = array(
		'<a href="' . esc_url( admin_url( 'tools.php?page=fw-backups-demo-content' ) ) . '">'.__( 'Install Demo Contents', 'redchili-core' ).'</a>',
	);
	return array_merge( $links, $mylinks );
}

function redchili_importer_backups_demos( $demos ) {
	$demos_array = array(
		'demo1' => array(
			'title' => __( 'Home 1', 'redchili-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/redchili/',
		),
		'demo2' => array(
			'title' => __( 'Home 2', 'redchili-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/redchili/home-2/',
		),
		'demo3' => array(
			'title' => __( 'Home 3', 'redchili-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/redchili/home-3/',
		),
		'demo4' => array(
			'title' => __( 'Home 4', 'redchili-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/redchili/home-4/',
		),
		'demo5' => array(
			'title' => __( 'Home 5', 'redchili-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/redchili/home-5/',
		),
		'demo6' => array(
			'title' => __( 'Home 6', 'redchili-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/redchili/home-6/',
		),
		'demo7' => array(
			'title' => __( 'Home 1 Onepage', 'redchili-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot1.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/redchili/home-1-onepage/',
		),
		'demo8' => array(
			'title' => __( 'Home 2 Onepage', 'redchili-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot2.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/redchili/home-2-onepage/',
		),
		'demo9' => array(
			'title' => __( 'Home 3 Onepage', 'redchili-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot3.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/redchili/home-3-onepage/',
		),
		'demo10' => array(
			'title' => __( 'Home 4 Onepage', 'redchili-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot4.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/redchili/home-4-onepage/',
		),
		'demo11' => array(
			'title' => __( 'Home 5 Onepage', 'redchili-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot5.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/redchili/home-5-onepage/',
		),
		'demo12' => array(
			'title' => __( 'Home 6 Onepage', 'redchili-core' ),
			'screenshot' => plugins_url( 'screenshots/screenshot6.jpg', __FILE__ ),
			'preview_link' => 'https://radiustheme.com/demo/wordpress/redchili/home-6-onepage/',
		),
	);

	$download_url = 'http://radiustheme.com/demo/wordpress/demo-content/redchili/';

	foreach ($demos_array as $id => $data) {
		$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
			'url' => $download_url,
			'file_id' => $id,
		));
		$demo->set_title($data['title']);
		$demo->set_screenshot($data['screenshot']);
		$demo->set_preview_link($data['preview_link']);

		$demos[ $demo->get_id() ] = $demo;

		unset($demo);
	}

	return $demos;
}

// Run after demo install
function redchili_importer_after_demo_install( $collection ){
	// Update front page id
	$demos = array(
		'demo1' => 413,
		'demo2' => 349,
		'demo3' => 2716,
		'demo4' => 1717,
		'demo5' => 1750,
		'demo6' => 2966,		
		'demo7' => 2683,
		'demo8' => 2702,
		'demo9' => 415,
		'demo10' => 2724,
		'demo11' => 2736,
		'demo12' => 3021,
	);

	$data = $collection->to_array();

	foreach( $data['tasks'] as $task ) {
		if( $task['id'] == 'demo:demo-download' ){
			$demo_id = $task['args']['demo_id'];
			$page_id = $demos[$demo_id];
			update_option( 'page_on_front', $page_id );
			flush_rewrite_rules();
			break;
		}
	}

	// Update contact form 7 email
	$cf7ids = array(277, 278, 281, 566, 1769);
	foreach ( $cf7ids as $cf7id ) {
		$mail = get_post_meta( $cf7id, '_mail', true );
		$mail['recipient'] = get_option( 'admin_email' );
		
		if ( class_exists( 'WPCF7_ContactFormTemplate' ) ) {
			$pattern = "/<[^@\s]*@[^@\s]*\.[^@\s]*>/"; // <email@email.com>
			$replacement = '<'. WPCF7_ContactFormTemplate::from_email().'>';
			$mail['sender'] = preg_replace($pattern, $replacement, $mail['sender']);
		}	
		
		update_post_meta( $cf7id, '_mail', $mail );		
	}
	
}