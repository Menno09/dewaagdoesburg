<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists('FmpVcInit') ):

	class FmpVcInit {

		function __construct() {
			add_action( 'init', array( $this, 'fmpVcIntegration' ) );
		}

		function scListA(){
			$sc = array();
			$scQ = get_posts( array('post_type' => TLPFoodMenu()->shortCodePT, 'order_by' => 'title', 'order' => 'DESC', 'post_status' => 'publish', 'posts_per_page' => -1) );
			$sc['Default'] = '';
			if ( count($scQ) ) {
				foreach($scQ as $post){
					$sc[$post->post_title] = $post->ID;
				}
			}
			return $sc;
		}


		function fmpVcIntegration() {
			if ( ! defined( 'WPB_VC_VERSION' ) ) {
				return;
			}
			if(function_exists('vc_map')){
				vc_map( array(
						"name" => __("Food Menu Pro", 'food-menu-pro'),
						"base" => 'foodmenu',
						"class" => "",
						"icon"      => TLPFoodMenu()->assetsUrl . 'images/icon-32x32.png',
						"controls" => "full",
						"category" => 'Content',
						'admin_enqueue_js' => '',
						'admin_enqueue_css' => '',
						"params" => array(
							array(
								"type" => "dropdown",
								"heading" => __("Short Code", 'food-menu-pro'),
								"param_name" => "id",
								"value" => $this->scListA(),
								"admin_label" => true,
								"description" => __("Short Code list", 'food-menu-pro')
							)
						)
					)

				);
			}else{
				wpb_map( array(
						"name" => __("Food Menu Pro", 'food-menu-pro'),
						"base" => 'foodmenu',
						"class" => "",
						"icon"      => TLPFoodMenu()->assetsUrl . 'images/icon-32x32.png',
						"controls" => "full",
						"category" => 'Content',
						'admin_enqueue_js' => '',
						'admin_enqueue_css' => '',
						"params" => array(
							array(
								"type" => "dropdown",
								"heading" => __("Short Code", 'food-menu-pro'),
								"param_name" => "id",
								"value" => $this->scListA(),
								"admin_label" => true,
								"description" => __("Short Code list", 'food-menu-pro')
							)
						)
					)

				);
			}

		}
	}

endif;