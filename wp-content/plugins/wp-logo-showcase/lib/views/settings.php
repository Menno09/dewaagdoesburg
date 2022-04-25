<?php global $rtWLS; ?>

<div class="wrap">
    <h2><?php esc_html_e( 'Wp Logo Showcases Settings', 'wp-logo-showcase' ); ?></h2>

    <div class="rt-settings-container">
        <div class="rt-setting-title">
            <h3><?php esc_html_e( 'General settings', 'wp-logo-showcase' ); ?>
                <a class="wls-title-doc"
                   href="https://www.radiustheme.com/setup-configure-wp-logo-showcase-wordpress/"
                   target="_blank"><?php esc_html_e( 'Documentation', 'wp-logo-showcase' ) ?></a>
            </h3>
        </div>
        <div class="rt-setting-content">
            <div class="rt-response"></div>
            <form id="rt-wls-settings-form">
                <div class="rt-tab-container">
                    <ul class="rt-tab-nav">
                        <li><a href="#s-wls-general"><i
                                        class="dashicons dashicons-layout"></i><?php esc_html_e( 'General Settings', 'wp-logo-showcase' ); ?>
                            </a>
                        </li>
                        <li><a href="#s-wls-custom-css"><i
                                        class="dashicons dashicons-admin-customizer"></i><?php esc_html_e( 'Custom CSS', 'wp-logo-showcase' ); ?>
                            </a>
                        </li>
                    </ul>
                    <div id="s-wls-general" class="rt-tab-content">
						<?php $rtWLS->print_html( $rtWLS->rtFieldGenerator( $rtWLS->rtWLSGeneralSettings(), true ) ); ?>
                    </div>
                    <div id="s-wls-custom-css" class="rt-tab-content">
						<?php $rtWLS->print_html( $rtWLS->rtFieldGenerator( $rtWLS->rtWLSCustomCss(), true ) ); ?>
                    </div>
                </div>

                <p class="submit">
                    <input type="submit"
                           name="submit"
                           id="rtSaveButton"
                           class="rt-admin-btn button button-primary"
                           value="<?php esc_html_e( "Save Changes", 'wp-logo-showcase' ); ?>">
                </p>

				<?php wp_nonce_field( $rtWLS->nonceText(), $rtWLS->nonceId() ); ?>
            </form>
            <div class="rt-response"></div>
        </div>
        <div class="rt-pro-feature-content">
			<?php $rtWLS->rt_plugin_sc_pro_information(); ?>
        </div>
    </div>

</div>
