<?php
if ( !class_exists( 'RDTheme_VC_Counter' ) ) {
		
	class RDTheme_VC_Counter extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Red Chili: Counter", 'redchili-core' );
			$this->base = 'redchili-vc-counter';
			$this->translate = array(
				'title' => __( "I AM TITLE", 'redchili-core' ),
			);
			parent::__construct();
		}

		public function fields(){
			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Counter Style", 'redchili-core' ),
					"param_name" => "counter_style",
					'value' => array( 
						__('Style 01', 'redchili-core') => 'style1',	
						__('Style 02', 'redchili-core') => 'style2'		
						),					
					'description' => __( 'Select Counter Style', 'redchili-core' ),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Use Icon or Image", 'redchili-core' ),
					"param_name" => "icon_choice",
					'value' => array( 
						__( 'FlatIcon', 'redchili-core' )     => 'flaticon',
						__( 'FontAwesome', 'redchili-core' )  => 'icon',
						__( 'Custom Image', 'redchili-core' ) => 'image',
						),
					),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'Flaticon', 'redchili-core' ),
					'param_name' => 'icon_flat',
					"value" => 'flaticon-bbq-chicken-leg',
					'settings' => array(
						'emptyIcon' => false,
						'type' => 'flaticon',
						'iconsPerPage' => 300,
						),
					'dependency' => array(
						'element' => 'icon_choice',
						'value'   => array( 'flaticon' ),
						),
					),
				array(
					'type' => 'iconpicker',
					'heading' => __( 'FontAwesome Icon', 'redchili-core' ),
					'param_name' => 'icon_fa',
					"value" => 'fa fa-bar-chart',
					'settings' => array(
						'emptyIcon' => false,
						'iconsPerPage' => 300,
						),
					'dependency' => array(
						'element' => 'icon_choice',
						'value'   => array( 'icon' ),
						),
					),
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Image", 'redchili-core' ),
					"param_name" => "icon_image",
					'dependency' => array(
						'element' => 'icon_choice',
						'value'   => array( 'image' ),
						),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Image Size", 'redchili-core' ),
					"param_name" => "icon_image_size",
					'dependency' => array(
						'element' => 'icon_choice',
						'value'   => array( 'image' ),
						),					
					"std" => "100",
				),				
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Icon size", 'redchili-core' ),
					"param_name" => "icon_size",
					'description' => __( 'Icon size in px. Default: 36', 'redchili-core' ),
					'value' => '36',
					'dependency' => array(
						'element' => 'icon_choice',
						'value'   => array( 'icon', 'flaticon' ),
						),
					),		
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Icon Color", "redchili-core" ),
					"param_name" => "icon_color",
					"value" => '',
					'dependency' => array(
						'element' => 'icon_choice',
						'value'   => array( 'icon' , 'flaticon' ),
						),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Space Below Icon", 'redchili-core' ),
					"param_name" => "icon_margin_bottom",
					'description' => __( 'Icon Bottom Margin value in px. Default: 10', 'redchili-core' ),
					'value' => '20',
					),				
				//for counter number
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Counter Number", 'redchili-core' ),
					"param_name" => "counter_number",
					"value" => 500,
					'description' => __( 'Counter Number to show. Like : 400', 'redchili-core' ),
					),				
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Number Color", "redchili-core" ),
					"param_name" => "number_color",
					"value" => '#000000',
					),				
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number Font Size", 'redchili-core' ),
					"param_name" => "number_font_size",
					'description' => __( 'Number Font Size in px. Default: 40', 'redchili-core' ),
					'value' => '40',
					),
				//for title
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title", 'redchili-core' ),
					"param_name" => "title",
					"value" => $this->translate['title'],
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Title Color", "redchili-core" ),
					"param_name" => "title_color",
					"value" => '#b2b2b2',
					),				
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title Font Size", 'redchili-core' ),
					"param_name" => "title_font_size",
					'description' => __( 'Title Font Size in px. Default: 14', 'redchili-core' ),
					'value' => '14',
					),
				);
			return $fields;
		}
		
		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(	
				'icon_flat'    		 => 'flaticon-bbq-chicken-leg',
				'icon_fa'       	 => 'fa fa-smile-o',
				'counter_style'      => 'style1',
				'icon_choice'        => 'flaticon',
				'icon_size'       	 => '36',
				'icon_color'       	 => '',
				'icon_margin_bottom' => '20',
				'icon_image'		 => '',
				'icon_image_size'	 => '100',
				'counter_number'	 => '500',
				'number_color'		 => '#000000',
				'number_font_size'	 => '40',
				'title'				 => $this->translate['title'],
				'title_color'		 => '#b2b2b2',
				'title_font_size'	 => '14',
				), $atts ) );

			$icon_size   		 = intval( $icon_size );
			$icon_margin_bottom  = intval( $icon_margin_bottom );
			$counter_number		 = intval( $counter_number );
			$number_font_size	 = intval( $number_font_size );
			$title_font_size	 = intval( $title_font_size );
			
			if($counter_style == 'style1'){
				$template = 'counter-style1';
			} else if($counter_style == 'style2') {
				$template = 'counter-style2';
			}
			
			$icon  = ( $icon_choice == 'flaticon' ) ? $icon_flat : $icon_fa;
			if ( $icon_choice == 'flaticon' ) {
				vc_icon_element_fonts_enqueue( $icon_flat );
			}
			
			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Counter;