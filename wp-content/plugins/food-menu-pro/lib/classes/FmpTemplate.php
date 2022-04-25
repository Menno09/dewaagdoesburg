<?php

if ( ! class_exists('FmpTemplate') ):

	/**
	 *
	 */
	class FmpTemplate {

		function __construct() {
			add_filter( 'comments_template', array( $this, 'comments_template_loader' ) );
		}

		public static function comments_template_loader( $template ) {

			if ( get_post_type() !== TLPFoodMenu()->post_type ) {
				return $template;
			}

			$check_dirs = array(
				trailingslashit( get_stylesheet_directory() ) . TLPFoodMenu()->template_path(),
				trailingslashit( get_template_directory() ) . TLPFoodMenu()->template_path(),
				trailingslashit( get_stylesheet_directory() ),
				trailingslashit( get_template_directory() ),
				FMP()->plugin_template_path()
			);

			foreach ( $check_dirs as $dir ) {
				if ( file_exists( trailingslashit( $dir ) . 'single-food-menu-reviews.php' ) ) {
					return trailingslashit( $dir ) . 'single-food-menu-reviews.php';
				}
			}

			return $template;
		}


	}

endif;