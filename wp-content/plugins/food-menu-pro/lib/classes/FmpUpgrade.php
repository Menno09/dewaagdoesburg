<?php

if ( ! class_exists('FmpUpgrade') ):

	class FmpUpgrade {
		function updateFreeToPro() {
			$freeVersion     = get_option( 'tlp-food-menu-installed-version' );
			$current_version = get_option( FMP()->options['installed_version'] );
			if ( $freeVersion && ! $current_version ) {
				$exData = get_option( TLPFoodMenu()->options['settings'] );
				$slug = !empty($exData['general']['slug']) ? $exData['general']['slug'] : TLPFoodMenu()->post_type;
				$currency = !empty($exData['general']['currency']) ? $exData['general']['currency'] : "USD";
				$currency_position = !empty($exData['general']['currency_position']) ? $exData['general']['currency_position'] : "left";
				$css = !empty($exData['others']['css']) ? $exData['others']['css'] : "";
				$data = array(
					'currency'           => $currency,
					'currency_position'  => $currency_position,
					'price_thousand_sep' => ',',
					'price_decimal_sep'  => '.',
					'price_num_decimals' => 2,
					'slug'               => $slug,
					'custom_css'         => $css
				);
				update_option( TLPFoodMenu()->options['settings'], $data );
			}elseif(!$freeVersion && ! $current_version){
				$data = array(
					'currency'           => "USD",
					'currency_position'  => "left",
					'price_thousand_sep' => ',',
					'price_decimal_sep'  => '.',
					'price_num_decimals' => 2,
					'slug'               => TLPFoodMenu()->post_type,
					'custom_css'         => ''
				);
				update_option( TLPFoodMenu()->options['settings'], $data );
			}


			if ( $freeVersion && ! $current_version ) {
				$allFreeMenu = get_posts( array(
					'post_type'      => TLPFoodMenu()->post_type,
					'posts_per_page' => - 1,
					'post_status'    => 'publish'
				) );
				if ( ! empty( $allFreeMenu ) ) {
					foreach ( $allFreeMenu as $post ) {
						$price = get_post_meta( $post->ID, 'price', true );
						if ( $price ) {
							update_post_meta( $post->ID, '_regular_price', TLPFoodMenu()->format_decimal( $price ) );
						}

					}
				}
			}

			delete_option( 'tlp-food-menu-installed-version' );
		}
	}

endif;