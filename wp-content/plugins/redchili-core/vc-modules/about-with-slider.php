<?php
if ( !class_exists( 'RDTheme_VC_AboutWithSlider' ) ) {
	
	class RDTheme_VC_AboutWithSlider extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Red Chili: About With Slider", 'redchili-core' );
			$this->base = 'redchili-vc-aboutwithslider';
			$this->translate = array(
				'title' => __( 'Our History', 'redchili-core' ),
				'cols'  => array( 
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
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"class" 	 => "",
					"heading" 	 => __( "Title", 'redchili-core' ),
					"param_name" => "title",
					"value" 	 => $this->translate['title'],
				),			
				array(
					"type" 		 => "colorpicker",
					"class" 	 => "",
					"heading"	 => __( "Title color", "redchili-core" ),
					"param_name" => "title_color",
					"value" 	 => '#222222'
					),			
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"class" 	 => "",
					"heading" 	 => __( "Title Font Size", 'redchili-core' ),
					"param_name" => "title_font_size",
					"value" 	 => "48",
					),
				array(
					"type" 		 => "textarea_html",
					"holder" 	 => "div",
					"class" 	 => "",
					"heading" 	 => __( "About Content Text", 'redchili-core' ),
					"param_name" => "content",
					"value" 	 =>  __( '<p><span><span>1947</span>ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.ex ea commodo consequat.</span></p>', 'redchili-core' ),
					"rows"		 => "1",
					),
				array(
					"type" 		  => "attach_images",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "About Slider Right Images", 'redchili-core' ),
					"param_name"  => "image",				
					"group" 	  => __( "Slider Options", 'redchili-core' ),
				),
				array(
					"type" 		  => "dropdown",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Navigation Dots", 'redchili-core' ),
					"param_name"  => "slider_dots",
					"value" 	  => array(  
						__( "Enable", "redchili-core" )  => 'true',
						__( "Disable", "redchili-core" ) => 'false',
						),
					"description" => __( "Enable or disable navigation dots. Default: Disable", 'redchili-core' ),
					"group" 	  => __( "Slider Options", 'redchili-core' ),
					),
				array(
					"type" 		  => "dropdown",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Autoplay", 'redchili-core' ),
					"param_name"  => "slider_autoplay",
					"value" 	  => array(  
						__( "Enable", "redchili-core" )  => 'true',
						__( "Disable", "redchili-core" ) => 'false',
						),
					"description" => __( "Enable or disable autoplay. Default: Enable", 'redchili-core' ),
					"group" 	  => __( "Slider Options", 'redchili-core' ),
					),
				array(
					"type" 		  => "dropdown",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Stop on Hover", 'redchili-core' ),
					"param_name"  => "slider_stop_on_hover",
					"value" 	  => array(  
						__( "Enable", "redchili-core" )  => 'true',
						__( "Disable", "redchili-core" ) => 'false',
						),
					'dependency'  => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Stop autoplay on mouse hover. Default: Enable", 'redchili-core' ),
					"group" 	  => __( "Slider Options", 'redchili-core' ),
					),
				array(
					"type" 			 => "dropdown",
					"holder" 		 => "div",
					"class" 		 => "",
					"heading" 		 => __( "Autoplay Interval", 'redchili-core' ),
					"param_name"     => "slider_interval",
					"value" 	 	 => $this->translate['cols'],
					'dependency'	 => array(
						'element'	 => 'slider_autoplay',
						'value'		 => array( 'true' ),
						),
					"description" 	 => __( "Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds", 'redchili-core' ),
					"group" 		 => __( "Slider Options", 'redchili-core' ),
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
					"type" 		  => "dropdown",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Loop", 'redchili-core' ),
					"param_name"  => "slider_loop",
					"value"		  => array(  
						__( "Enable", "redchili-core" )  => 'true',
						__( "Disable", "redchili-core" ) => 'false',
						),
					"description" => __( "Loop to first item. Default: Enable", 'redchili-core' ),
					"group" 	  => __( "Slider Options", 'redchili-core' ),
					),			
				
			);
			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'title'      			=> $this->translate['title'],
				'image'      			=> '',
				'title_font_size' 		=> '48',
				'title_color' 			=> '#222222',
				'col_lg'                => '12',
				'col_md'                => '12',
				'col_sm'                => '12',
				'col_xs'                => '12',
				'col_mobile'            => '12',
				'slider_nav'            => 'false',
				'slider_dots'           => 'true',
				'slider_autoplay'       => 'true',
				'slider_stop_on_hover'  => 'true',
				'slider_interval'       => '5000',
				'slider_autoplay_speed' => '200',
				'slider_loop'           => 'true',
				
				), $atts ) );

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
						'0'    			 => array( 'items' => 1 ),
						)
					);
					
			$owl_data = json_encode( $owl_data );
			
			$this->load_scripts();
			
			$template = 'about-with-slider-view';
			
			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_AboutWithSlider;