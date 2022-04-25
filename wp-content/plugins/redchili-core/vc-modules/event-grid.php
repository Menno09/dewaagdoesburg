<?php
if ( !class_exists( 'RDTheme_VC_EventGrid' ) ) {

	class RDTheme_VC_EventGrid extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Red Chili: Event Grid", 'redchili-core' );
			$this->base = 'redchili-vc-eventgrid';
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
			
			$terms = get_terms( array('taxonomy' => 'rc_event_category') );
			$category_dropdown = array( __('All Categories', 'redchili-core') => '0' );
			foreach ( $terms as $category ) {
				$category_dropdown[$category->name] = $category->term_id;
			}

			$fields = array(
				array(
					"type" => "dropdown",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Event Type", 'redchili-core' ),
					"param_name" => "event_type",
					"value" => array( 
						__('All Events' , 'redchili-core') => 'all',
						__('Upcoming Events', 'redchili-core') => 'upcoming',
						__('Past Events','redchili-core') => 'past',
						),
					"std" => "all",
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
					"heading" => __( "Post Display Order", 'redchili-core' ),
					"param_name" => "order",
					'value' => array(
						__( "Descending", 'redchili-core' )  => 'DESC',
						__( "Ascending", 'redchili-core' )  => 'ASC',
						),
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
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Content Limit", 'redchili-core' ),
					"param_name" => "content_limit",
					"value" => '10',
					"description" => __( "Maximum number of words to display. Default: 20", 'redchili-core' ),
					),
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
					"std" => "4",
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
				'grid_item_number'   	=> '6',
				'event_type'            => 'all',
				'cat'                   => '',
				'order'			   		=> 'DESC',
				'orderby'		   		=> '',				
				'content_limit' 		=> '10',
				'col_lg'                => '3',
				'col_md'                => '4',
				'col_sm'                => '4',
				'col_xs'                => '12',
				), $atts ) );
				
			$template = 'event-view-grid';
			
			return $this->template( $template, get_defined_vars() );
			
		}
	}
}

new RDTheme_VC_EventGrid;