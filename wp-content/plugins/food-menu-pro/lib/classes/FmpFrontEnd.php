<?php

if ( ! class_exists('FmpFrontEnd') ):

	class FmpFrontEnd {
		function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_front_end' ) );
		}

		function enqueue_scripts_front_end() {
			wp_enqueue_style( 'fmp-frontend' );
            if ( is_single() && get_post_type() == TLPFoodMenu()->post_type ) {
                wp_enqueue_style( 'fmp-flex' );
                wp_enqueue_script( 'fmp-flex' );
                wp_enqueue_script( 'fmp-actual-height' );
                wp_enqueue_script( 'fmp-single-food' );
                wp_enqueue_script( 'fmp-frontend' );
            }
		}

	}

endif;