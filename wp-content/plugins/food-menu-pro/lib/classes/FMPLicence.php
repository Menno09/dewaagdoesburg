<?php

if ( ! class_exists( 'FMPLicence' ) ):

	class FMPLicence {
		function __construct() {
			add_action( 'wp_ajax_rtFmpManageLicencing', array( $this, 'rtFmpManageLicencing' ) );
			add_action( 'wp_ajax_rtFmp_active_Licence', array( $this, 'rtFmp_active_Licence' ) );
			add_action( 'admin_init', array( $this, 'fmp_licence' ) );
		}

		function fmp_licence() {
			$settings = get_option( TLPFoodMenu()->options['settings'] );
			$license  = ! empty( $settings['license_key'] ) ? trim( $settings['license_key'] ) : null;
			new EDD_FMP_Plugin_Updater( EDD_FOOD_MENU_PRO_STORE_URL, FOOD_MENU_PRO_PLUGIN_ACTIVE_FILE_NAME, array(
				'version' => FOOD_MENU_PRO_VERSION,
				'license' => $license,
				'item_id' => EDD_FOOD_MENU_PRO_ITEM_ID,
				'author'  => FOOD_MENU_PRO_AUTHOR,
				'url'     => home_url(),
				'beta'    => false
			) );
		}

		function rtFmp_active_Licence() {

			$error = true;
			$html  = $message = null;
			if ( TLPFoodMenu()->verifyNonce() ) {
				$settings   = get_option( TLPFoodMenu()->options['settings'] );
				$license    = ! empty( $settings['license_key'] ) ? trim( $settings['license_key'] ) : null;
				$api_params = array(
					'edd_action' => 'activate_license',
					'license'    => $license,
					'item_id'    => EDD_FOOD_MENU_PRO_ITEM_ID,
					'url'        => home_url()
				);
				$response   = wp_remote_post( EDD_FOOD_MENU_PRO_STORE_URL,
					array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );
				if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
					$err     = $response->get_error_message();
					$message = ( is_wp_error( $response ) && ! empty( $err ) ) ? $err : __( 'An error occurred, please try again.', "food-menu-pro" );
				} else {
					$license_data = json_decode( wp_remote_retrieve_body( $response ) );
					if ( false === $license_data->success ) {
						switch ( $license_data->error ) {
							case 'expired' :
								$message = sprintf(
									__( 'Your license key expired on %s.', "food-menu-pro" ),
									date_i18n( get_option( 'date_format' ),
										strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
								);
								break;
							case 'revoked' :
								$message = __( 'Your license key has been disabled.', "food-menu-pro" );
								break;
							case 'missing' :
								$message = __( 'Invalid license.', "food-menu-pro" );
								break;
							case 'invalid' :
							case 'site_inactive' :
								$message = __( 'Your license is not active for this URL.', "food-menu-pro" );
								break;
							case 'item_name_mismatch' :
								$message = sprintf( __( 'This appears to be an invalid license key for %s.', "food-menu-pro" ),
									EDD_FOOD_MENU_PRO_ITEM_NAME );
								break;
							case 'no_activations_left':
								$message = __( 'Your license key has reached its activation limit.', "food-menu-pro" );
								break;
							default :
								$message = __( 'An error occurred, please try again.', "food-menu-pro" );
								break;
						}
					}
					// Check if anything passed on a message constituting a failure
					if ( empty( $message ) ) {
						$settings['license_status'] = $license_data->license;
						update_option( TLPFoodMenu()->options['settings'], $settings );
						$error   = false;
						$message = __( 'Successfully activated', 'food-menu-pro' );
					}
					$html = ( $license_data->license === 'valid' ) ? "<input type='submit' class='button-secondary rt-licensing-btn danger' name='license_deactivate' value='Deactivate License'/>"
						: "<input type='submit' class='button-secondary rt-licensing-btn button-primary' name='license_activate' value='Activate License'/>";
				}
			} else {
				$message = __( 'Session Error !!', 'food-menu-pro' );
			}
			$response = array(
				'error' => $error,
				'msg'   => $message,
				'html'  => $html,
			);
			wp_send_json( $response );
		}

		function rtFmpManageLicencing() {
			$error = true;
			$name  = $value = $data = $class = $message = null;
			if ( TLPFoodMenu()->verifyNonce() ) {
				$settings = get_option( TLPFoodMenu()->options['settings'] );
				$license  = ! empty( $settings['license_key'] ) ? trim( $settings['license_key'] ) : null;
				if ( ! empty( $_REQUEST['type'] ) && $_REQUEST['type'] == "license_activate" ) {
					$api_params = array(
						'edd_action' => 'activate_license',
						'license'    => $license,
						'item_id'    => EDD_FOOD_MENU_PRO_ITEM_ID,
						'url'        => home_url()
					);
					$response   = wp_remote_post( EDD_FOOD_MENU_PRO_STORE_URL,
						array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

					if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
						$err     = $response->get_error_message();
						$message = ( is_wp_error( $response ) && ! empty( $err ) ) ? $err : __( 'An error occurred, please try again.', "food-menu-pro" );
					} else {
						$license_data = json_decode( wp_remote_retrieve_body( $response ) );
						if ( false === $license_data->success ) {
							switch ( $license_data->error ) {
								case 'expired' :
									$message = sprintf(
										__( 'Your license key expired on %s.' ),
										date_i18n( get_option( 'date_format' ),
											strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
									);
									break;
								case 'revoked' :
									$message = __( 'Your license key has been disabled.', "food-menu-pro" );
									break;
								case 'missing' :
									$message = __( 'Invalid license.', "food-menu-pro" );
									break;
								case 'invalid' :
								case 'site_inactive' :
									$message = __( 'Your license is not active for this URL.', "food-menu-pro" );
									break;
								case 'item_name_mismatch' :
									$message = sprintf( __( 'This appears to be an invalid license key for %s.', "food-menu-pro" ), EDD_FOOD_MENU_PRO_ITEM_NAME );
									break;
								case 'no_activations_left':
									$message = __( 'Your license key has reached its activation limit.', "food-menu-pro" );
									break;
								default :
									$message = __( 'An error occurred, please try again.', "food-menu-pro" );
									break;
							}
						}
						// Check if anything passed on a message constituting a failure
						if ( empty( $message ) ) {
							$settings['license_status'] = $license_data->license;
							update_option( TLPFoodMenu()->options['settings'], $settings );
							$error = false;
							$name  = 'license_deactivate';
							$value = 'Deactivate License';
							$class = 'button-primary';
						}
					}
				}
				if ( ! empty( $_REQUEST['type'] ) && $_REQUEST['type'] == "license_deactivate" ) {
					$api_params = array(
						'edd_action' => 'deactivate_license',
						'license'    => $license,
						'item_id'    => EDD_FOOD_MENU_PRO_ITEM_ID,
						'url'        => home_url()
					);
					$response   = wp_remote_post( EDD_FOOD_MENU_PRO_STORE_URL,
						array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

					// Make sure there are no errors
					if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
						$err     = $response->get_error_message();
						$message = ( is_wp_error( $response ) && ! empty( $err ) ) ? $err : __( 'An error occurred, please try again.' );
					} else {
//						$license_data = json_decode( wp_remote_retrieve_body( $response ) );
						unset( $settings['license_status'] );
						update_option( TLPFoodMenu()->options['settings'], $settings );
						$error = false;
						$name  = 'license_activate';
						$value = 'Activate License';
						$class = 'button-primary';
					}
				}
			} else {
				$message = __( 'Security Error !!', 'food-menu-pro' );
			}
			$data     = $_REQUEST;
			$response = array(
				'error' => $error,
				'msg'   => $message,
				'name'  => $name,
				'value' => $value,
				'class' => $class,
				'data'  => $data
			);
			wp_send_json( $response );
			die();
		}
	}

endif;