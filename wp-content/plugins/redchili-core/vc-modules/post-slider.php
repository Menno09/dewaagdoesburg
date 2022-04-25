<?php
if ( !class_exists( 'RDTheme_VC_Post_Slider' ) ) {
		
	class RDTheme_VC_Post_Slider extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Red Chili: Post Slider", 'redchili-core' );
			$this->base = 'redchili-vc-post-slider';
			$this->translate = array(
				'cols' => array( 
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
			$categories = get_categories();
			$category_dropdown = array( 'All Categories' => '0' );

			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Categories", 'redchili-core' ),
					"param_name" => "cat",
					'value' => $category_dropdown,
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Total number of posts", 'redchili-core' ),
					"param_name" => "number",
					"value" => 6,
					'description' => __( 'Write -1 to show all', 'redchili-core' ),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Word count", 'redchili-core' ),
					"param_name" => "count",
					"value" => 35,
					'description' => __( 'Maximum number of words', 'redchili-core' ),
					),		
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Background Image", 'redchili-core' ),
					"param_name" => "background_image",
				),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 1199px )", 'redchili-core' ),
					"param_name" => "col_lg",
					"value" => $this->translate['cols'],
					"std" => "4",
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 991px )", 'redchili-core' ),
					"param_name" => "col_md",
					"value" => $this->translate['cols'],
					"std" => "4",
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Tablets > 767px )", 'redchili-core' ),
					"param_name" => "col_sm",
					"value" => $this->translate['cols'],
					"std" => "6",
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Phones < 768px )", 'redchili-core' ),
					"param_name" => "col_xs",
					"value" => $this->translate['cols'],
					"std" => "6",
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Small Phones < 480px )", 'redchili-core' ),
					"param_name" => "col_mobile",
					"value" => $this->translate['cols'],
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
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay Interval", 'redchili-core' ),
					"param_name" => "slider_interval",
					"value" => array( 
						__( "5 Seconds", "redchili-core" )  => '5000',
						__( "4 Seconds", "redchili-core" )  => '4000',
						__( "3 Seconds", "redchili-core" )  => '3000',
						__( "2 Seconds", "redchili-core" )  => '4000',
						__( "1 Seconds", "redchili-core" )  => '1000',
						),
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds", 'redchili-core' ),
					"group" => __( "Slider Options", 'redchili-core' ),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Autoplay Slide Speed", 'redchili-core' ),
					"param_name" => "slider_autoplay_speed",
					"value" => 200,
					'dependency' => array(
						'element' => 'slider_autoplay',
						'value'   => array( 'true' ),
						),
					"description" => __( "Slide speed in milliseconds. Default: 200", 'redchili-core' ),
					"group" => __( "Slider Options", 'redchili-core' ),
					),	
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Loop", 'redchili-core' ),
					"param_name" => "slider_loop",
					"value" => array( 
						__( "Enable", "redchili-core" )  => 'true',
						__( "Disable", "redchili-core" ) => 'false',
						),
					"description" => __( "Loop to first item. Default: Enable", 'redchili-core' ),
					"group" => __( "Slider Options", 'redchili-core' ),
					),
				);
			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'number'                => '6',
				'count'                 => '35',
				'cat'                   => '',
				'background_image'      => '',
				'col_lg'                => '4',
				'col_md'                => '4',
				'col_sm'                => '6',
				'col_xs'                => '6',
				'col_mobile'            => '12',
				'slider_nav'            => 'true',
				'slider_dots'           => 'false',
				'slider_autoplay'       => 'true',
				'slider_stop_on_hover'  => 'true',
				'slider_interval'       => '5000',
				'slider_autoplay_speed' => '200',
				'slider_loop'           => 'true',
				), $atts ) );

			// validation
			$number                = intval( $number );
			$count                 = intval( $count );
			$cat                   = empty( $cat ) ? '' : $cat;

			$owl_data = array( 
				'nav'                => ( $slider_nav === 'true' ) ? true : false,
				'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
				'dots'               => ( $slider_dots === 'true' ) ? true : false,
				'autoplay'           => ( $slider_autoplay === 'true' ) ? true: false,
				'autoplayTimeout'    => $slider_interval,
				'autoplaySpeed'      => $slider_autoplay_speed,
				'autoplayHoverPause' => ( $slider_stop_on_hover === 'true' ) ? true: false,
				'loop'               => ( $slider_loop === 'true' ) ? true: false,
				'margin'             => 0,
				'responsive'         => array(
					'0'    => array( 'items' => 12 / $col_mobile ),
					'480'  => array( 'items' => 12 / $col_xs ),
					'768'  => array( 'items' => 12 / $col_sm ),
					'992'  => array( 'items' => 12 / $col_md ),
					'1200' => array( 'items' => 12 / $col_lg ),
					)
				);

			$template = 'post-slider-view';
			
			$this->load_scripts();
			$owl_data = json_encode( $owl_data );			
						
			return $this->template( $template, get_defined_vars() );
			
		}
	}
}

new RDTheme_VC_Post_Slider;