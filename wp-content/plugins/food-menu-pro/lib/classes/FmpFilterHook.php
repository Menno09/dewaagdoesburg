<?php

if ( ! class_exists('FmpFilterHook') ):

	class FmpFilterHook {
		public function __construct() {
			add_filter( 'fmp_food_menu_tabs', array( $this, 'fmp_default_food_menu_tabs' ) );
			add_filter( 'fmp_food_menu_tabs', array( $this, 'fmp_sort_food_menu_tabs' ), 99 );
            add_filter( 'fmp_template_path', [ $this, 'template_path' ] );
		}

        function template_path( $path ) {
            $path = 'food-menu-pro/';
		    return $path;
        }

		function fmp_sort_food_menu_tabs( $tabs = array() ) {
			// Make sure the $tabs parameter is an array
			if ( ! is_array( $tabs ) ) {
				trigger_error( "Function fmp_sort_food_menu_tabs() expects an array as the first parameter. Defaulting to empty array." );
				$tabs = array();
			}

			// Re-order tabs by priority
			if ( ! function_exists( '_sort_priority_callback' ) ) {
				function _sort_priority_callback( $a, $b ) {
					if ( $a['priority'] === $b['priority'] ) {
						return 0;
					}

					return ( $a['priority'] < $b['priority'] ) ? - 1 : 1;
				}
			}

			uasort( $tabs, '_sort_priority_callback' );

			return $tabs;
		}

		function fmp_default_food_menu_tabs( $tabs = array() ) {
			global $post;
			$settings      = get_option( TLPFoodMenu()->options['settings'] );
			$hiddenOptions = ! empty( $settings['hide_options'] ) ? $settings['hide_options'] : array();

			// Description tab - shows product content
			if ( $post->post_content && ! in_array( 'description', $hiddenOptions ) ) {
				$tabs['description'] = array(
					'title'    => __( 'Description', 'food-menu-pro' ),
					'priority' => 10,
					'callback' => 'FmpFilterHook::fmp_food_menu_description_tab'
				);
			}

			// Ingredient tab - shows ingredient
			$ingredient_status = get_post_meta( $post->ID, '_ingredient_status', true );
			if ( $ingredient_status && ! in_array( 'ingredient', $hiddenOptions ) ) {
				$tabs['ingredient'] = array(
					'title'    => __( 'Ingredients', 'food-menu-pro' ),
					'priority' => 20,
					'callback' => 'FmpFilterHook::fmp_food_menu_ingredient_tab'
				);
			}
			// Nutrition tab - shows nutrition
			$nutrition_status = get_post_meta( $post->ID, '_nutrition_status', true );
			if ( $nutrition_status && ! in_array( 'nutrition', $hiddenOptions ) ) {
				$tabs['nutrition'] = array(
					'title'    => __( 'Nutrition', 'food-menu-pro' ),
					'priority' => 30,
					'callback' => 'FmpFilterHook::fmp_food_menu_nutrition_tab'
				);
			}

			// Reviews tab - shows comments
			if ( comments_open() && ! in_array( 'reviews', $hiddenOptions ) ) {
				$tabs['reviews'] = array(
					'title'    => sprintf( __( 'Reviews (%d)', 'food-menu-pro' ), FMP()->food()->get_review_count() ),
					'priority' => 40,
					'callback' => 'comments_template'
				);
			}

			return $tabs;
		}

		static public function fmp_comments( $comment, $args, $depth ) {
			$GLOBALS['comment'] = $comment;
			FMP()->render( 'single/review', compact( 'comment', 'args', 'depth' ) );
		}

		static public function fmp_food_menu_description_tab() {
			FMP()->render( 'single/tabs/description');
		}

		static public function fmp_food_menu_ingredient_tab() {
			FMP()->render( 'single/tabs/ingredient');
		}

		static public function fmp_food_menu_nutrition_tab() {
			FMP()->render( 'single/tabs/nutrition');
		}
	}

endif;