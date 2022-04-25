<?php
if ( !class_exists( 'RDTheme_VC_Infobox' ) ) {

	class RDTheme_VC_Infobox extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Red Chili: Info Box", 'redchili-core' );
			$this->base = 'redchili-vc-infobox';
			$this->translate = array(
				'title' => __( "I AM TITLE", 'redchili-core' ),
				'info'  => __( "This is the best restaurant wordpress theme around the country. The red chili Restuarant theme is the main reason for that. radius theme has done a tremendous work here.", 'redchili-core' ),
			);
			parent::__construct();
		}

		public function fields(){
			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Style", 'redchili-core' ),
					"param_name" => "infobox_style",
					'value' => array( 
						__('Style 01', 'redchili-core') => 'style1',	
						__('Style 02', 'redchili-core') => 'style2'		
						),
					'description' => __( 'Select Info Box Style', 'redchili-core' ),
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
					'value' => '60',
					'dependency' => array(
						'element' => 'icon_choice',
						'value'   => array( 'icon' , 'flaticon' ),
						
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
						'value'   => array( 'icon', 'flaticon' ),
						),
					),
				array(
					"type" => "colorpicker",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Mouseover color", 'seoengine-core' ),
					"param_name" => "hovercolor",
					"value" => "#e7272d",
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Space Below of Icon", 'redchili-core' ),
					"param_name" => "icon_margin_bottom",
					'description' => __( 'Icon Bottom Margin value in px. Default: 10', 'redchili-core' ),
					'value' => '10',
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
					"type" => "textfield",
					"class" => "",
					"heading" => __( "Title URL", "redchili-core" ),
					"param_name" => "title_url",
					"value" => '#',
					'description' => __( 'Set The URL for the Title. Default: #', 'redchili-core' ),
					),				
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title Font Size", 'redchili-core' ),
					"param_name" => "title_font_size",
					'description' => __( 'Title Font Size in px. Default: 14', 'redchili-core' ),
					'value' => '20',
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Title Color", "redchili-core" ),
					"param_name" => "title_color",
					"value" => '#222222',
					),
				array(
					"type" => "textarea_html",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content", 'redchili-core' ),
					"param_name" => "content",
					"value" => $this->translate['info'],
					'description' => __( 'Write Your Information here', 'redchili-core' ),
					),			
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content Font Size", 'redchili-core' ),
					"param_name" => "info_font_size",
					'description' => __( 'Info Text Font Size in px. Default: 14', 'redchili-core' ),
					'value' => '14',
					),			
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Content Color", "redchili-core" ),
					"param_name" => "info_color",
					"value" => '#646464',
					),
				);
			return $fields;
		}
		
		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(	
				'icon_flat'    			=> 'flaticon-bbq-chicken-leg',
				'icon_fa'       		=> 'fa fa-smile-o',
				'infobox_style'         => 'style1',
				'icon_choice'       	=> 'flaticon',
				'icon_size'       		=> '60',
				'icon_color'       		=> '',				
				'hovercolor'     		=> '#e7272d',
				'icon_margin_bottom'	=> '10',
				'icon_image'			=> '',
				'icon_image_size'		=> '100',
				'info_color'			=> '#646464',
				'info_font_size'		=> '14',
				'title'					=> $this->translate['title'],
				'title_url'				=> '#',
				'title_color'			=> '#222222',
				'title_font_size'		=> '20',
				), $atts ) );

			$icon_size   		 = intval( $icon_size );
			$icon_margin_bottom  = intval( $icon_margin_bottom );
			$info_font_size	 	 = intval( $info_font_size );
			$title_font_size	 = intval( $title_font_size );		
			
			if($infobox_style == 'style1'){
				$template = 'infobox-view1';			
			} else if($infobox_style == 'style2') {
				$template = 'infobox-view2';
			}
			
			$icon  = ( $icon_choice == 'flaticon' ) ? $icon_flat : $icon_fa;
			if ( $icon_choice == 'flaticon' ) {
				vc_icon_element_fonts_enqueue( $icon_flat );
			}
						
			return $this->template( $template, get_defined_vars() );
			
		}
	}
}

new RDTheme_VC_Infobox;