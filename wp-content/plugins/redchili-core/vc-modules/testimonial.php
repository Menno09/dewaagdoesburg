<?php
if ( !class_exists( 'RDTheme_VC_Testimonial' ) ) {

	class RDTheme_VC_Testimonial extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Red Chili: Testimonial", 'redchili-core' );
			$this->base = 'redchili-vc-testimonial';
			$this->translate = array(
				'title'    => __( "OUR CLIENTS SAY", 'redchili-core' ),			
				'subtitle' => __( "What Client Say", 'redchili-core' ),
				'cols'     => array( 
					__( '1 col', 'redchili-core' ) => '12',
					__( '2 col', 'redchili-core' ) => '6',
					__( '3 col', 'redchili-core' ) => '4',
					__( '4 col', 'redchili-core' ) => '3',
					__( '6 col', 'redchili-core' ) => '2',
				),
			);
			parent::__construct();
		}
		
		public function load_scripts(){	
			wp_enqueue_style( 'owl-carousel' );
			wp_enqueue_style( 'owl-theme-default' );
			wp_enqueue_script( 'owl-carousel' );	
		}

		public function fields(){

			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Layout", 'redchili-core' ),
					"param_name" => "layout",
					'value' => array( 
						__('Style 1', 'redchili-core') => 'style1',
						__('Style 2', 'redchili-core' ) => 'style2',
						__('Style 3', 'redchili-core') => 'style4',
						__('Style 4 - Half Width', 'redchili-core') => 'halfwidth'
						),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Heading", 'redchili-core' ),
					"param_name" => "title",
					"value" => $this->translate['title'],
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'halfwidth' ),
						),
					),
				array(
					"type" => "textarea",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Sub-Heading", 'redchili-core' ),
					"param_name" => "subtitle",
					"value" => $this->translate['subtitle'],
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'halfwidth' ),
						),
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Heading color", "redchili-core" ),
					"param_name" => "title_color",
					"value" => '',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'halfwidth' ),
						),
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Sub Heading Color", "redchili-core" ),
					"param_name" => "subtitle_color",
					"value" => '#111111',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'halfwidth' ),
						),
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Title color", "redchili-core" ),
					"param_name" => "testi_title_color",
					"value" => '#111111',
					),		
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Designation color", "redchili-core" ),
					"param_name" => "testi_designation_color",
					"value" => '#111111',
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Text color", "redchili-core" ),
					"param_name" => "testi_text_color",
					"value" => '#111111',
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Text Border color", "redchili-core" ),
					"param_name" => "testi_txt_bord_color",
					"value" => '#646464',
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style2' ),
						),
					),					
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Display Rating", 'redchili-core' ),
					"param_name" => "display_rating",
					"value" => array( 
						__( "Enable", "redchili-core" )  => 'enable',
						__( "Disable", "redchili-core" ) => 'disable',
						),
					"description" => __( "Enable or disable display rating. Default: Enable", 'redchili-core' ),					
					"std" => "enable",
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Total number of items", 'redchili-core' ),
					"param_name" => "slider_item_number",
					"value" => 6,
					'description' => __( 'Write -1 to show all', 'redchili-core' ),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 1199px )", 'redchili-core' ),
					"param_name" => "col_lg",
					"value" => $this->translate['cols'],
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style4' ),
						),
					"std" => "3",
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 991px )", 'redchili-core' ),
					"param_name" => "col_md",
					"value" => $this->translate['cols'],
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style4' ),
						),
					"std" => "4",
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Tablets > 767px )", 'redchili-core' ),
					"param_name" => "col_sm",
					"value" => $this->translate['cols'],
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style4' ),
						),
					"std" => "6",
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Phones < 768px )", 'redchili-core' ),
					"param_name" => "col_xs",
					"value" => $this->translate['cols'],
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style4' ),
						),
					"std" => "12",
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Small Phones < 480px )", 'redchili-core' ),
					"param_name" => "col_mobile",
					"value" => $this->translate['cols'],
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style4' ),
						),
					"std" => "12",
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Navigation Arrow", 'redchili-core' ),
					"param_name" => "slider_nav",
					"value" => array( 
						__( "Enable", "redchili-core" )  => 'true',
						__( "Disable", "redchili-core" ) => 'false',
						),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style4' ),
						),
					"description" => __( "Enable or disable navigation arrow. Default: Enable", 'redchili-core' ),
					"group" => __( "Slider Options", 'redchili-core' ),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Navigation Dots", 'redchili-core' ),
					"param_name" => "slider_dots",
					"value" => array(  
						__( "Disable", "redchili-core" ) => 'false',
						__( "Enable", "redchili-core" )  => 'true',
						),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'style4' ),
						),
					"description" => __( "Enable or disable navigation dots. Default: Disable", 'redchili-core' ),
					"group" => __( "Slider Options", 'redchili-core' ),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay", 'redchili-core' ),
					"param_name" => "slider_autoplay",
					"value" => array( 
						__( "Enable", "redchili-core" )  => 'true',
						__( "Disable", "redchili-core" ) => 'false',
						),
					"description" => __( "Enable or disable autoplay. Default: Enable", 'redchili-core' ),
					"group" => __( "Slider Options", 'redchili-core' ),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Stop on Hover", 'redchili-core' ),
					"param_name" => "slider_stop_on_hover",
					"value" => array( 
						__( "Enable", "redchili-core" )  => 'true',
						__( "Disable", "redchili-core" ) => 'false',
						),
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Stop autoplay on mouse hover. Default: Enable", 'redchili-core' ),
					"group" => __( "Slider Options", 'redchili-core' ),
					),
				array(
					"type" 		  => "dropdown",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Interval", 'redchili-core' ),
					"param_name"  => "slider_interval",
					"value" 	  => array( 
						__( "5 Seconds", "redchili-core" )  => '5000',
						__( "4 Seconds", "redchili-core" )  => '4000',
						__( "3 Seconds", "redchili-core" )  => '3000',
						__( "2 Seconds", "redchili-core" )  => '4000',
						__( "1 Seconds", "redchili-core" )  => '1000',
						),
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds", 'redchili-core' ),
					"group" 	  => __( "Slider Options", 'redchili-core' ),
					),
				array(
					"type"		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay Slide Speed", 'redchili-core' ),
					"param_name"  => "slider_autoplay_speed",
					"value" 	  => 200,
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Slide speed in milliseconds. Default: 200", 'redchili-core' ),
					"group" 	  => __( "Slider Options", 'redchili-core' ),
					),	
				array(
					"type" 		 => "dropdown",
					"holder" 	 => "div",
					"class" 	 => "",
					"heading" 	 => __( "Loop", 'redchili-core' ),
					"param_name" => "slider_loop",
					"value" 	 => array( 
						__( "Enable", "redchili-core" )  => 'true',
						__( "Disable", "redchili-core" ) => 'false',
						),
					"description"=> __( "Loop to first item. Default: Enable", 'redchili-core' ),
					"group" 	 => __( "Slider Options", 'redchili-core' ),
					),
			);

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'layout'                  => 'style1',
				'title'           		  => $this->translate['title'],
				'subtitle'        		  => $this->translate['subtitle'],
				'title_color'     		  => '',
				'testi_designation_color' => '#111111',				
				'subtitle_color'  		  => '#111111',
				'slider_item_number'      => '6',
				'testi_title_color'		  => '#111111',
				'testi_text_color'		  => '#111111',
				'testi_txt_bord_color'    => '',
				'display_rating'		  => 'enable',
				'col_lg'                  => '3',
				'col_md'                  => '4',
				'col_sm'                  => '6',
				'col_xs'                  => '12',
				'col_mobile'              => '12',
				'slider_nav'           	  => 'true',
				'slider_dots'             => 'false',
				'slider_autoplay'         => 'true',
				'slider_stop_on_hover'    => 'true',
				'slider_interval'         => '5000',
				'slider_autoplay_speed'   => '200',
				'slider_loop'             => 'true',
				), $atts ) );

			$layout                = esc_attr( $layout );
			$slider_item_number    = intval( $slider_item_number );

			$owl_data = array( 
				'nav'                => ( $slider_nav === 'true' ) ? true : false,
				'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
				'dots'               => ( $slider_dots === 'true' ) ? true : false,
				'autoplay'           => ( $slider_autoplay === 'true' ) ? true : false,
				'autoplayTimeout'    => $slider_interval,
				'autoplaySpeed'      => $slider_autoplay_speed,
				'autoplayHoverPause' => ( $slider_stop_on_hover === 'true' ) ? true : false,
				'loop'               => ( $slider_loop === 'true' ) ? true : false,
				'margin'             => 20,
				'responsive'         => array(
					'0'    => array( 'items' => 12 / $col_mobile ),
					'480'  => array( 'items' => 12 / $col_xs ),
					'768'  => array( 'items' => 12 / $col_sm ),
					'992'  => array( 'items' => 12 / $col_md ),
					'1200' => array( 'items' => 12 / $col_lg ),
					)
				);
			
			if($layout == 'style1'){ 
				$owl_data['nav'] = false;
				$owl_data['dots'] = true;
				$owl_data['responsive'] = array(
					'0'    => array( 'items' => 1 )					
					);
				$template = 'testimonial-style1';
				
			} else if($layout == 'halfwidth') {				
				$owl_data['nav'] = false;
				$owl_data['dots'] = true;
				$owl_data['responsive'] = array(
					'0'    => array( 'items' => 1 )
					);
				$template = 'testimonial-half';
				
			} else if($layout == 'style2'){				
				$owl_data['nav'] = false;
				$owl_data['dots'] = true;
				$owl_data['responsive'] = array(
					'0'    => array( 'items' => 1 ),
					'480'  => array( 'items' => 2 ),
					'768'  => array( 'items' => 2 ),
					'992'  => array( 'items' => 2 ),
					'1200' => array( 'items' => 2 ),
					);
				$template = 'testimonial-style2';
				
			} else {
				$template = 'testimonial-style4';
				
			}
			$this->load_scripts();

			$owl_data = json_encode( $owl_data );	
			
			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Testimonial;