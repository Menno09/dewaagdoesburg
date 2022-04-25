<?php
if ( !class_exists( 'RDTheme_VC_Contact' ) ) {
		
	class RDTheme_VC_Contact extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Red Chili: Contact", 'redchili-core' );
			$this->base = 'redchili-vc-contact';
			$this->translate = array(
				'title' => __( "Information", 'redchili-core' ),
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
					"value" => 30,
					),
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __( "Title color", "redchili-core" ),
					"param_name" => "title_color",
					"value" => '#111111',
					),
				array(
					"type" => "checkbox",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Show Phone Number", 'redchili-core' ),
					"param_name" => "rt_vc_contact_phone",
					"value" => true,					
					"description" => __( 'Phone number is coming from theme option', 'redchili-core' ),
					"default" => true
					),
				array(
					"type" => "checkbox",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Show Address", 'redchili-core' ),
					"param_name" => "rt_vc_contact_address",
					"value" => true,					
					"description" => __( 'Address is coming from theme option', 'redchili-core' ),				
					"std" => true,
					),
				array(
					"type" => "checkbox",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Show Email Address", 'redchili-core' ),
					"param_name" => "rt_vc_contact_email",
					"value" => true,					
					"description" => __( 'Email Address is coming from theme option', 'redchili-core' ),			
					"std" => 1,
					),
				array(
					"type"        => "checkbox",
					"holder"      => "div",
					"class" 	  => "",
					"heading"     => __( "Show Social Links", 'redchili-core' ),
					"param_name"  => "rt_vc_contact_social",
					"value" 	  => true,					
					'description' => __( 'Please set social Links from theme option', 'redchili-core' ),
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
				'title'           		=> $this->translate['title'],
				'rt_vc_font_size'       => 30,
				'title_color'     		=> '#111111',
				'rt_vc_contact_phone'   => true,			
				'rt_vc_contact_address' => true,			
				'rt_vc_contact_email'   => true,
				'rt_vc_contact_social'  => true,
				'css'             		=> '',
				), $atts ) );
				
				$rt_vc_font_size = intval($rt_vc_font_size);				

			$template = 'contact-1';
			
			return $this->template( $template, get_defined_vars() );
		}
	}
}

new RDTheme_VC_Contact;