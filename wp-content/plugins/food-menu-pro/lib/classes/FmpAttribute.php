<?php

if ( ! class_exists('FmpAttribute') ):

	class FmpAttribute {

		function __construct() {
			add_action( 'wp_ajax_fmp_add_attribute_action', array( $this, 'fmp_add_attribute_action' ) );
			add_action( 'wp_ajax_fmp_save_attributes_action', array( $this, 'fmp_save_attributes_action' ) );
		}

		function fmp_add_attribute_action(){

			$i             = absint( $_POST['i'] );
			$position      = 0;
			$metabox_class = array();
			$attribute     = array(
				'name'         => '',
				'value'        => '',
				'is_visible'   => 1,
				'is_variation' => 0
			);
			$attribute_label = '';
			$flug = "open";
			include(FMP()->includePath .'html-fmp-attribute.php');
			die();
		}
		
		function fmp_save_attributes_action(){
			$attributes = array();
			$post_id = !empty($_POST['post_id']) ? absint($_POST['post_id']) : 0;
			parse_str( $_POST['data'], $data );
			if ( isset( $data['attribute_names'], $data['attribute_values'] ) ) {
				$attribute_names         = $data['attribute_names'];
				$attribute_values        = $data['attribute_values'];
				$attribute_visibility    = isset( $data['attribute_visibility'] ) ? $data['attribute_visibility'] : array();
				$attribute_variation     = isset( $data['attribute_variation'] ) ? $data['attribute_variation'] : array();
				$attribute_position      = $data['attribute_position'];
				$attribute_names_max_key = max( array_keys( $attribute_names ) );

				for ( $i = 0; $i <= $attribute_names_max_key; $i++ ) {
					if ( empty( $attribute_names[ $i ] ) || ! isset( $attribute_values[ $i ] ) ) {
						continue;
					}
					$options        = isset( $attribute_values[ $i ] ) ? $attribute_values[ $i ] : '';

					$attribute_name = sanitize_text_field( $attribute_names[ $i ] );

					$attribute_id = sanitize_title($attribute_name);
					$attribute['name'] = $attribute_name ;
					$attribute['value'] = $options;
					$attribute['position'] =  $attribute_position[ $i ];
					$attribute['is_visible'] =isset( $attribute_visibility[ $i ] );
					$attribute['is_variation'] =  isset( $attribute_variation[ $i ] );
					$attributes[$attribute_id] = $attribute;
				}
			}
			update_post_meta($post_id, '_fmp_attributes', $attributes);

		}

	}

endif;