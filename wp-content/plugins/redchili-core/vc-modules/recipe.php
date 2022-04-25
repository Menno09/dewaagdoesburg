<?php
if ( !class_exists( 'RDTheme_VC_Recipe' ) ) {
	
	class RDTheme_VC_Recipe extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Red Chili: Recipe", 'redchili-core' );
			$this->base = 'redchili-vc-recipe';
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
			$terms = get_terms( array('taxonomy' => 'rc_recipe_category') );
			$category_dropdown = array( __('All Categories' , 'redchili-core') => '0' );
			foreach ( $terms as $category ) {
				$category_dropdown[$category->name] = $category->term_id;
			}

			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Layout", 'redchili-core' ),
					"param_name" => "layout",
					'value' => array( 
						__('Box Slider','redchili-core') => 'boxslider',	
						__('Card Slider','redchili-core') => 'cardslider'		
						),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title Limit", 'redchili-core' ),
					"param_name" => "title_limit",
					"value" => '5',
					"description" => __( "Maximum number of words to display. Default: 5", 'redchili-core' ),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content Limit", 'redchili-core' ),
					"param_name" => "content_limit",
					"value" => '20',
					"description" => __( "Maximum number of words to display. Default: 20", 'redchili-core' ),
					),
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
					"heading" => __( "Total number of items", 'redchili-core' ),
					"param_name" => "slider_item_number",
					"value" => 6,
					'description' => __( 'Write -1 to show all', 'redchili-core' ),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Display Time", 'redchili-core' ),
					"param_name" => "show_time",
					'value' => array( 
						__('Enabled','redchili-core') => 'yes',	
						__('Disabled','redchili-core') => 'no'		
						),
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
						'value'   => array( 'boxslider' ),
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
						'value'   => array( 'boxslider' ),
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
						'value'   => array( 'boxslider' ),
						),
					"std" => "4",
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
						'value'   => array( 'boxslider' ),
						),
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
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'boxslider' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Navigation Arrow", 'redchili-core' ),
					"param_name" => "slider_nav",
					"value" => array( 
						'Enable'  => 'true',
						'Disable' => 'false',
						),
					"description" => __( "Enable or disable navigation arrow. Default: Enable", 'redchili-core' ),
					"group" => __( "Slider Options", 'redchili-core' ),
					'dependency' => array(
						'element' => 'layout',
						'value'   => array( 'boxslider' ),
						),	
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
					"type" 		  => "dropdown",
					"holder"	  => "div",
					"class"		  => "",
					"heading" 	  => __( "Loop", 'redchili-core' ),
					"param_name"  => "slider_loop",
					"value" 	  => array( 
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
				'layout'                => 'boxslider',
				'title_limit'         	=> '5',
				'content_limit'         => '20',
				'slider_item_number'    => '6',
				'show_time'    			=> 'yes',
				'cat'                   => '',
				'col_lg'                => '3',
				'col_md'                => '4',
				'col_sm'                => '4',
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

			$layout                = esc_attr( $layout );
			$content_limit         = intval( $content_limit );
			$slider_item_number    = intval( $slider_item_number );
			$cat                   = empty( $cat ) ? '' : $cat;

			$owl_data = array( 
				'nav'                => ( $slider_nav === 'true' ) ? true : false,
				'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
				'dots'               => ( $slider_dots === 'true' ) ? true : false,
				'autoplay'           => ( $slider_autoplay === 'true' ) ? true : false,
				'autoplayTimeout'    => $slider_interval,
				'autoplaySpeed'      => $slider_autoplay_speed,
				'autoplayHoverPause' => ( $slider_stop_on_hover === 'true' ) ? true : false,
				'loop'               => ( $slider_loop === 'true' ) ? true : false,
				'margin'             => 0,
				'responsive'         => array(
					'0'    => array( 'items' => 12 / $col_mobile ),
					'480'  => array( 'items' => 12 / $col_xs ),
					'768'  => array( 'items' => 12 / $col_sm ),
					'992'  => array( 'items' => 12 / $col_md ),
					'1200' => array( 'items' => 12 / $col_lg ),
					)
				);

			$owl_data_card = array( 
				'nav'                => ( $slider_nav === 'true' ) ? true : false,
				'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
				'dots'               => ( $slider_dots === 'true' ) ? true : false,
				'autoplay'           => ( $slider_autoplay === 'true' ) ? true : false,
				'autoplayTimeout'    => $slider_interval,
				'autoplaySpeed'      => $slider_autoplay_speed,
				'autoplayHoverPause' => ( $slider_stop_on_hover === 'true' ) ? true : false,
				'loop'               => ( $slider_loop === 'true' ) ? true : false,
				'margin'             => 0,
				'responsive'         => array(
						'0'    => array( 'items' => 1 ),
					)
				);
			
			if($layout == 'boxslider'){ 
				$template = 'recipe-box-slider';
				$owl_data = json_encode( $owl_data );
				$this->load_scripts();
			} else if($layout == 'cardslider') { 	
				$template = 'recipe-card-slider';
				$this->load_scripts();
				$owl_data_card = json_encode( $owl_data_card );
			}
						
			return $this->template( $template, get_defined_vars() );
			
		}
	}
}

new RDTheme_VC_Recipe;