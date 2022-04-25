<?php
if ( !class_exists( 'RDTheme_VC_Title' ) ) {

	class RDTheme_VC_Title extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Red Chili: Section Title", 'redchili-core' );
			$this->base = 'redchili-vc-title';
			$this->translate = array(
				'title' => __( "I AM TITLE", 'redchili-core' ),
			);
			parent::__construct();
		}

		public function fields(){
			$fields = array(
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
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title Font Size", 'redchili-core' ),
					"param_name" => "rt_vc_font_size",
					"value" => 48,
					),
				array(
					"type" => "textarea",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Subtitle", 'redchili-core' ),
					"param_name" => "subtitle",
					"value" => "Lorem ipsum dolor",
					),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Title Font Size", 'redchili-core' ),
					"param_name" => "subtile_font_size",
					"value" => 18,
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Title color", "redchili-core" ),
					"param_name" => "title_color",
					"value" => '#111111',
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Subtitle color", "redchili-core" ),
					"param_name" => "subtitle_color",
					"value" => '',
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Subtitle Line color", "redchili-core" ),
					"param_name" => "subtitle_line_color",
					"value" => '#707070',
					),
				array(
					'type' 			   => 'css_editor',
					'heading' 		   => __( 'Css', 'redchili-core' ),
					'param_name' 	   => 'css',
					'group' 		   => __( 'Design options', 'redchili-core' ),
					'edit_field_class' => 'vc-no-bg vc-no-border',
					),
				);
			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'title'             	=> $this->translate['title'],
				'subtitle'          	=> "Lorem ipsum dolor",
				'rt_vc_font_size'   	=> 48,			
				'subtile_font_size' 	=> 18,
				'title_color'     		=> '#111111',
				'subtitle_color'  		=> '',
				'subtitle_line_color'  	=> '#707070',
				'css'             		=> '',
				), $atts ) );

			$template = 'title-1';
					
			return $this->template( $template, get_defined_vars() );
			
		}
	}
}

new RDTheme_VC_Title;