<?php
if ( !class_exists( 'RDTheme_VC_About' ) ) {
		
	class RDTheme_VC_About extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Red Chili: About", 'redchili-core' );
			$this->base = 'redchili-vc-about';
			$this->translate = array(
				'title'   		 => __( 'Red Chili<br>For Getting Real Taste', 'redchili-core' ),
				'title_2'   	 => __( 'About Our Coffee', 'redchili-core' ),
				'subtitle'   	 => __( 'Discover Our Food', 'redchili-core' ),
				'content_text'   => __( 'Morbi ut sapien scelerisque, fermentum ex ultrices, bibendum lacus. Aliquam id consequat ex. Integer luctus tellus at rutrum maximus. Quisque lacinia blandit quam rhoncus vulputate vulputate fermentum.', 'redchili-core' ),
				'content_text_2' => __( 'Morbi ut sapien scelerisque, fermentum ex ultrices, bibendum lacus. Aliquam id consequat ex. Integer luctus tellus at rutrum maximus. Quisque lacinia blandit quam rhoncus vulputate vulputate fermentum. Morbi ut sapien scelerisque, fermentum ex ultrices, bibendum lacus. Aliquam id consequat ex. Integer luctus  Integer luctus tellus at rutrum maximus. Quisque  Integer luctus tellus at rutrum maximus. Quisque', 'redchili-core' ),
				'buttontext' 	 => __( 'Read More', 'redchili-core' ),
			);
			parent::__construct();
		}

		public function fields(){
			$fields = array(
				array(
					"type"		  => "dropdown",
					"holder"	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Layout", 'redchili-core' ),
					"param_name"  => "layout",
					'value' 	  => array( 
						'Style 1' => 'style1',
						'Style 2' => 'style2'		
						),
					),
				array(
					"type"		  => "attach_image",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Image( Left side )", 'redchili-core' ),
					"param_name"  => "image",
				),			
				array(
					"type"		  => "colorpicker",
					"class" 	  => "",
					"heading" 	  => __( "Text Box color", "redchili-core" ),
					"param_name"  => "box_color",
					"value" 	  => '#e7272d',
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'style2' ),
						),
					),
				array(
					"type" 		  => "textfield",
					"holder" 	  => "div",
					"class"		  => "",
					"heading" 	  => __( "Title", 'redchili-core' ),
					"param_name"  => "title",
					"value" 	  => $this->translate['title'],
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'style1' ),
						),
				),
				array(
					"type" 		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Title", 'redchili-core' ),
					"param_name"  => "title_2",
					"value" 	  => $this->translate['title_2'],
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'style2' ),
						),
				),			
				array(
					"type" 		  => "colorpicker",
					"class" 	  => "",
					"heading" 	  => __( "Title color", "redchili-core" ),
					"param_name"  => "title_color",
					"value" 	  => '#000000',
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'style2' ),
						),
					),
				array(
					"type"		  => "textfield",
					"holder"	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Sub Title Font Size", 'redchili-core' ),
					"param_name"  => "title_font_size",
					"value" 	  => '28',
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'style2' ),
						),
					),
				array(
					"type" 		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Subtitle", 'redchili-core' ),
					"param_name"  => "subtitle",
					"value" 	  => $this->translate['subtitle'],
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'style1' ),
						),
				),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading"	  => __( "Subtitle color", "redchili-core" ),
					"param_name"  => "subtitle_color",
					"value" 	  => '#c4c4c4',
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'style1' ),
						),
					),
				array(
					"type"		  => "textfield",
					"holder"	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Sub Title Font Size", 'redchili-core' ),
					"param_name"  => "sub_title_font_size",
					"value" 	  => '24',
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'style1' ),
						),
					),
				array(
					"type"        => "textarea_raw_html",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Short Description", 'redchili-core' ),
					"param_name"  => "content_text",
					"value" 	  => "Morbi ut sapien scelerisque, fermentum ex ultrices, bibendum lacus. Aliquam id consequat ex. Integer luctus tellus at rutrum maximus. Quisque lacinia blandit quam rhoncus vulputate vulputate fermentum.",
					"rows" 		  => "1",
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'style1' ),
						),
				),
				array(
					"type"		  => "textarea_raw_html",
					"holder"	  => "div",
					"class"       => "",
					"heading" 	  => __( "Short Description", 'redchili-core' ),
					"param_name"  => "content_text_2",
					"value" 	  => base64_encode( $this->translate['content_text_2'] ),
					"rows" 	      => "1",
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'style2' ),
						),
				),
				array(
					"type" 		  => "textfield",
					"holder" 	  => "div",
					"class" 	  => "",
					"heading" 	  => __( "Button Text", 'redchili-core' ),
					"param_name"  => "buttontext",
					"value" 	  => $this->translate['buttontext'],
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'style1' ),
						),
				),
				array(
					"type" 		 => "textfield",
					"holder" 	 => "div",
					"class" 	 => "",
					"heading" 	 => __( "Button URL", 'redchili-core' ),
					"param_name" => "buttonurl",
					'dependency' => array(
						'element'=> 'layout',
						'value'  => array( 'style1' ),
						),
				),
				array(
					"type" 		 => "attach_image",
					"holder" 	 => "div",
					"class" 	 => "",
					"heading" 	 => __( "Section Bottom Image", 'redchili-core' ),
					"param_name" => "background_image",
					'dependency'  => array(
						'element' => 'layout',
						'value'   => array( 'style1' ),
						),
				),
			);
			return $fields;
		}

		public function shortcode( $atts, $content = '' ){
			extract( shortcode_atts( array(
				'layout' 			  => 'style1',
				'title'      		  => $this->translate['title'],
				'title_2'      		  => $this->translate['title_2'],
				'title_color' 		  => '#000000',
				'title_font_size'	  => '28',
				'box_color' 		  => '#e7272d',
				'subtitle_color' 	  => '#c4c4c4',
				'subtitle'      	  => $this->translate['subtitle'],
				'content_text'		  => base64_encode( $this->translate['content_text'] ),
				'content_text_2'	  => base64_encode( $this->translate['content_text_2'] ),
				'buttontext' 		  => $this->translate['buttontext'],
				'buttonurl'  		  => '',
				'image'      		  => '',
				'background_image'	  => '',
				'sub_title_font_size' => '24',
				), $atts ) );
			
			if($layout == 'style1'){ 
				$template = 'about-view-1';				
			} else if($layout == 'style2') { 	
				$template = 'about-view-2';
			}	
			
			return $this->template( $template, get_defined_vars() );
			
		}
	}
}

new RDTheme_VC_About;