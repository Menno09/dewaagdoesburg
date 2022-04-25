<?php
if ( !class_exists( 'RDTheme_VC_Upmenu' ) ) {

	class RDTheme_VC_Upmenu extends RDTheme_VC_Modules {

		public function __construct(){
			$this->name = __( "Red Chili: Upmenu", 'redchili-core' );
			$this->base = 'redchili-vc-upmenu';
			parent::__construct();
		}

		public function fields(){
			$fields = array(
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => __( "Upmenu ", 'redchili-core' ),
					"param_name" => "upmenu_id",
					"value" => "32f26c62-28b2-11e9-916d-525400080321",
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
					'upmenu_id' => "32f26c62-28b2-11e9-916d-525400080321",
					'css' => '',
				), $atts ) );

			$template = 'upmenu';
			
			return $this->template( $template, get_defined_vars() );
			
			
		}
	}
}

new RDTheme_VC_Upmenu;