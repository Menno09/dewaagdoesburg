<?php
if ( !class_exists( 'RDTheme_VC_WooCom_Product' ) ) {
		
	class RDTheme_VC_WooCom_Product extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Red Chili: WooCommerce Food Menu", 'redchili-core' );
			$this->base = 'redchili-core-vc-woocom-foodmenu';
			$this->translate = array(
				'title'    => __( "Sweet Dessert", 'redchili-core' ),
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
			$terms = get_terms( array('taxonomy' => 'product_cat') );
			$category_dropdown = array( __('All Categories', 'redchili-core') => '0' );
			foreach ( $terms as $category ) {
				$category_dropdown[$category->name] = $category->term_id;
			}
			
			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Style", 'redchili-core' ),
					"param_name" => "slider_style",
					"value" => array( 
						__( 'Carousel', 'redchili-core' )  	  => 'style1',
						__( 'Menu Card', 'redchili-core' ) 	  => 'style2',
						__( 'Menu Card 2', 'redchili-core' )  => 'style4',
						__( 'Isotope', 'redchili-core' )   	  => 'style3',
						__( 'Isotope 2', 'redchili-core' )    => 'style5',
						),
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
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Order By", 'redchili-core' ),
					"param_name" => "orderby",
					'value' => array(
						__( "None", 'redchili-core' )  => '',
						__( "Name", 'redchili-core' )  => 'title',
						__( "ID", 'redchili-core' )    => 'ID',
						__( "Date", 'redchili-core' )  => 'date',
						__( "Menu Order", 'redchili-core' )  => 'menu_order',
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Post Display Order", 'redchili-core' ),
					"param_name" => "order",
					'value' => array(
						__( "Descending", 'redchili-core' )  => 'DESC',
						__( "Ascending", 'redchili-core' )  => 'ASC',
						),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Word count", 'redchili-core' ),
					"param_name" => "count",
					"value" => 5,
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1', 'style2', 'style3', 'style5'  ),
						),
					'description' => __( 'Maximum number of words', 'redchili-core' ),
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
					"heading" => __( "Display Image", 'redchili-core' ),
					"param_name" => "showimage",
					"value" => array( 
						__( "Enabled", "redchili-core" )  => 'true',
						__( "Disabled", "redchili-core" ) => 'false',
						),
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style2' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Show Link to Title & Image", 'redchili-core' ),
					"param_name" => "showlink",
					"value" => array( 
						__( "Enabled", "redchili-core" )  => 'true',
						__( "Disabled", "redchili-core" ) => 'false',
						),
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style2' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Display Image Style", 'redchili-core' ),
					"param_name" => "imagestyle",
					"value" => array(
						__( "Circle", "redchili-core" )  => 'circle',
						__( "Square", "redchili-core" )  => 'square',
						),
					'dependency'  => array(
						'element' => 'showimage',
						'value'   => array( 'true' ),
						),
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Title Color", "redchili-core" ),
					"param_name" => "title_color",
					"value" => '#222222',
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1' ),
						),
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Title Hover Color", "redchili-core" ),
					"param_name" => "title_color_hover",
					"value" => '#cb1011',
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1' ),
						),
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Content Color", "redchili-core" ),
					"param_name" => "content_color",
					"value" => '#222222',
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1' ),
						),
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Button Color", "redchili-core" ),
					"param_name" => "button_color",
					"value" => '#222222',
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Display Add To Cart", 'redchili-core' ),
					"param_name" => "showcart",
					"value" => array( 
						__( "Enabled", "redchili-core" )  => 'true',
						__( "Disabled", "redchili-core" ) => 'false',
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Display Feature Product", 'redchili-core' ),
					"param_name" => "showfeatured",
					"value" => array( 
						__( "Disabled", "redchili-core" ) => 'false',
						__( "Enabled", "redchili-core" )  => 'true',
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Display Pagination", 'redchili-core' ),
					"param_name" => "showpagination",
					"value" => array( 
						__( "Disabled", "redchili-core" ) => 'false',
						__( "Enabled", "redchili-core" )  => 'true',
						),
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style2' , 'style3' , 'style4' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 1199px )", 'redchili-core' ),
					"param_name" => "col_lg",
					"value" => $this->translate['cols'],
					"std" => "4",
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1', 'style3' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 991px )", 'redchili-core' ),
					"param_name" => "col_md",
					"value" => $this->translate['cols'],
					"std" => "4",
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1', 'style3' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Tablets > 767px )", 'redchili-core' ),
					"param_name" => "col_sm",
					"value" => $this->translate['cols'],
					"std" => "4",
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1', 'style3' ),
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Phones < 768px )", 'redchili-core' ),
					"param_name" => "col_xs",
					"value" => $this->translate['cols'],
					"std" => "6",
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1', 'style3' ),
						),					
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Small Phones < 480px )", 'redchili-core' ),
					"param_name" => "col_mobile",
					"value" => $this->translate['cols'],
					"std" => "12",
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1', 'style3' ),
						),
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
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1' ),
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
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1' ),
						),
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
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1' ),
						),
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
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1' ),
						),
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
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1' ),
						),
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
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1' ),
						),
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
					'dependency'  => array(
						'element' => 'slider_style',
						'value'   => array( 'style1' ),
						),
					),			
				array(
					'type' => 'css_editor',
					'heading' => __( 'Css', 'redchili-core' ),
					'param_name' => 'css',
					'group' => __( 'Design options', 'redchili-core' )
				),
			);

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'slider_style'          => 'style1',
				'cat'                   => '',
				'order'				    => 'DESC',
				'orderby'			    => '',
				'title_color'	   		=> '#222222',
				'title_color_hover'	   	=> '#cb1011',
				'content_color'	   		=> '#222222',
				'button_color'	   		=> '#cb1011',
				'section_title_color'   => '#222222',
				'slider_item_number'    => '6',
				'count'                 => '5',
				'showimage'             => 'true',
				'showlink'              => 'true',
				'showfeatured'          => 'false',
				'imagestyle'            => 'circle',
				'showcart'              => 'true',
				'showpagination'        => 'false',
				'col_lg'                => '4',
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
				'css'         			=> '',
				), $atts ) );

			$slider_style          = esc_attr( $slider_style );
			$slider_item_number    = intval( $slider_item_number );
			$cat                   = empty( $cat ) ? '' : $cat;

			$owl_data = array( 
				'nav'                => ( $slider_nav === 'true' ) ? true : false,
				'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
				'dots'               => ( $slider_dots === 'false' ) ? false : true,
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
				
			switch ( $slider_style ) {
				case 'style5':
					$template = 'wc-foodmenu-isotope-2';
				break;
				case 'style4':
					$template = 'wc-foodmenu-card2';
				break;
				case 'style3':
					$template = 'wc-foodmenu-isotope';
				break;
				case 'style2':
					$template = 'wc-foodmenu-card';
				break;	
				default:
					$template = 'wc-foodmenu-slider';
					$owl_data = json_encode( $owl_data );
					$this->load_scripts();
				break;
			}
			
			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_WooCom_Product;