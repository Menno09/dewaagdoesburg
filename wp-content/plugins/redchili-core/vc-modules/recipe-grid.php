<?php
if ( !class_exists( 'RDTheme_VC_Recipegrid' ) ) {
		
	class RDTheme_VC_Recipegrid extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Red Chili: Recipe Grid", 'redchili-core' );
			$this->base = 'redchili-vc-recipegrid';
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

		public function fields(){
			$terms = get_terms( array('taxonomy' => 'rc_recipe_category') );
			$category_dropdown = array( __('All Categories', 'redchili-core') => '0' );
			foreach ( $terms as $category ) {
				$category_dropdown[$category->name] = $category->term_id;
			}

			$fields = array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Items Per Page", 'redchili-core' ),
					"param_name" => "grid_item_number",
					"value" => 6,
					'description' => __( 'Write -1 to show all', 'redchili-core' ),
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content Limit", 'redchili-core' ),
					"param_name" => "content_limit",
					"value" => '10',
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
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Display Time", 'redchili-core' ),
					"param_name" => "show_time",
					'value' => array( 
						__('Enabled','redchili-core') => 'yes',	
						__('Disabled','redchili-core')=> 'no'		
						),
					),
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Number of columns ( Desktops > 1199px )", 'redchili-core' ),
					"param_name" => "col_lg",
					"value" => $this->translate['cols'],
					"std" => "3",
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
					"std" => "12",
					),
			);

			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'content_limit'         => '10',
				'grid_item_number'      => '6',
				'cat'                   => '',
				'show_time'    			=> 'yes',
				'col_lg'                => '3',
				'col_md'                => '4',
				'col_sm'                => '6',
				'col_xs'                => '12'
				), $atts ) );
				
				$template = 'recipe-grid-view';

						
			return $this->template( $template, get_defined_vars() );
			
			
		}
	}
}

new RDTheme_VC_Recipegrid;