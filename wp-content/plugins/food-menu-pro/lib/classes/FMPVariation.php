<?php
if ( ! class_exists('FMPVariation') ):

	class FMPVariation {
		function __construct() {
			add_action( 'wp_ajax_fmp_add_variation_action', array( $this, 'fmp_add_variation_action' ) );
			add_action( 'wp_ajax_fmp_remove_variation_action', array( $this, 'fmp_remove_variation_action' ) );
			add_action( 'wp_ajax_fmp_save_variations_action', array( $this, 'fmp_save_variations_action' ) );
		}
		
		function fmp_save_variations_action(){
			$error = true;
			parse_str( $_POST['data'], $data );

			if(!empty($data['variation'])){
				$error = false;
				foreach ($data['variation'] as $id => $field){
					$name = !empty($field['name']) ? sanitize_text_field($field['name']) : null;
					$price = !empty($field['name']) ? $field['price'] : null;
					update_post_meta($id, '_name', $name);
					update_post_meta($id, '_price', $price);
				}
			}
			wp_send_json(array('error' => $error));
			die();
		}

		function fmp_add_variation_action() {
			$parent_id       = absint( $_POST['parent_id'] );
			$variation_id         = wp_insert_post( array(
				'post_parent' => $parent_id,
				'post_type'   => 'fmp_variation'
			) );
			$variation_name = '';
			$flug            = "open";
			include( FMP()->includePath . 'html-fmp-variation.php' );
			die();
		}

		function fmp_remove_variation_action() {
			$error = true;
			$id    = ! empty( $_POST['post_id'] ) ? absint( $_POST['post_id'] ) : 0;
			if ( $id && wp_delete_post( $id, true ) ) {
				$error = false;
			}

			wp_send_json( array( 'error' => $error ) );
		}
	}
endif;