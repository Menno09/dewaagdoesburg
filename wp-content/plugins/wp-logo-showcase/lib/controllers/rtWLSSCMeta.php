<?php
/**
 * ShortCode Meta field Class
 *
 * This will generate the meta field for ShortCode generator post type
 *
 * @package WP_LOGO_SHOWCASE
 * @since   1.0
 * @author  RadiusTheme
 */

if ( ! class_exists( 'rtWLSSCMeta' ) ):
	/**
	 *
	 */
	class rtWLSSCMeta {

		function __construct() {
			add_action( 'add_meta_boxes', array( $this, 'sc_meta_boxes' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
			add_action( 'save_post', array( $this, 'save_team_sc_meta_data' ), 10, 3 );
			add_action( 'edit_form_after_title', array( $this, 'wls_sc_after_title' ) );
			add_action( 'admin_init', array( $this, 'rt_wls_pro_remove_all_meta_box' ) );
			add_filter( 'manage_edit-wlshowcasesc_columns', array( $this, 'arrange_wl_showcase_sc_columns' ) );
			add_action( 'manage_wlshowcasesc_posts_custom_column', array(
				$this,
				'manage_wl_showcase_sc_columns'
			), 10, 2 );
		}


		/**
		 * This will add input text field for shortCode
		 *
		 * @param $post
		 */
		function wls_sc_after_title( $post ) {
			global $rtWLS;
			if ( $rtWLS->shortCodePT !== $post->post_type ) {
				return;
			}

			$html = null;
			$html .= '<div class="postbox wls-sc-postbox"><div class="inside">';
			$html .= '<p><input type="text" onfocus="this.select();" readonly="readonly" value="[logo-showcase id=&quot;' . $post->ID . '&quot; title=&quot;' . $post->post_title . '&quot;]" class="large-text code rt-code-sc">
            <input type="text" onfocus="this.select();" readonly="readonly" value="&#60;&#63;php echo do_shortcode( &#39;[logo-showcase id=&quot;' . $post->ID . '&quot; title=&quot;' . $post->post_title . '&quot;]&#39; ); &#63;&#62;" class="large-text code rt-code-sc">
            </p>';
			$html .= '</div></div>';
			$rtWLS->print_html( $html );
		}

		/**
		 * Arrange the shortCode listing column
		 *
		 * @param $columns
		 *
		 * @return array
		 */
		public function arrange_wl_showcase_sc_columns( $columns ) {
			$shortcode = array( 'wls_short_code' => esc_html__( 'Shortcode', 'wp-logo-showcase' ) );

			return array_slice( $columns, 0, 2, true ) + $shortcode + array_slice( $columns, 1, null, true );
		}

		public function manage_wl_showcase_sc_columns( $column ) {
			switch ( $column ) {
				case 'wls_short_code':
					echo '<input type="text" onfocus="this.select();" readonly="readonly" value="[logo-showcase id=&quot;' . get_the_ID() . '&quot; title=&quot;' . get_the_title() . '&quot;]" class="large-text code rt-code-sc">';
					break;
				default:
					break;
			}
		}

		/**
		 *  Remove all unwanted meta box
		 */
		function rt_wls_pro_remove_all_meta_box() {
			if ( is_admin() ) {
				global $rtWLS;
				add_filter( "get_user_option_meta-box-order_{$rtWLS->shortCodePT}", array(
					$this,
					'remove_all_meta_boxes_wls_sc'
				) );
			}
		}

		/**
		 * Add only custom meta box
		 *
		 * @return array
		 */
		function remove_all_meta_boxes_wls_sc() {
			global $wp_meta_boxes, $rtWLS;
			$publishBox   = $wp_meta_boxes[ $rtWLS->shortCodePT ]['side']['core']['submitdiv'];
			$scBox        = $wp_meta_boxes[ $rtWLS->shortCodePT ]['normal']['high'][ $rtWLS->shortCodePT . '_sc_settings_meta' ];
			$scPreviewBox = $wp_meta_boxes[ $rtWLS->shortCodePT ]['normal']['high'][ $rtWLS->shortCodePT . '_sc_preview_meta' ];
			$docBox       = $wp_meta_boxes[ $rtWLS->shortCodePT ]['side']['low']['rt_plugin_sc_pro_information'];

			$wp_meta_boxes[ $rtWLS->shortCodePT ] = array(
				'side'   => array(
					'core' => [ 'submitdiv' => $publishBox ],
					'low'  => [ 'rt_plugin_sc_pro_information' => $docBox ]
				),
				'normal' => array(
					'high' => array(
						$rtWLS->shortCodePT . '_sc_settings_meta' => $scBox,
						$rtWLS->shortCodePT . '_sc_preview_meta'  => $scPreviewBox
					)
				)
			);

			return array();
		}

		/**
		 *  Add script for the shortCode generate page only
		 */
		function admin_enqueue_scripts() {

			global $pagenow, $typenow, $rtWLS;
			// validate page
			if ( ! in_array( $pagenow, array( 'post.php', 'post-new.php', 'edit.php' ) ) ) {
				return;
			}
			if ( $typenow != $rtWLS->shortCodePT ) {
				return;
			}

			$select2Id = 'rt-select2';
			if ( class_exists( 'WPSEO_Admin_Asset_Manager' ) && class_exists( 'Avada' ) ) {
				$select2Id = 'yoast-seo-select2';
			} elseif ( class_exists( 'WPSEO_Admin_Asset_Manager' ) ) {
				$select2Id = 'yoast-seo-select2';
			} elseif ( class_exists( 'Avada' ) ) {
				$select2Id = 'select2-avada-js';
			}

			// scripts
			wp_enqueue_script( array(
				'jquery',
				'jquery-ui-core',
				'jquery-ui-sortable',
				'jquery-ui-tooltip',
				'rt-actual-height-js',
				'rt-images-load',
				'wp-color-picker',
				'rt-slick',
				$select2Id,
				'rt-isotope',
				'rt-wls-admin',
			) );

			// styles
			wp_enqueue_style( array(
				'wp-color-picker',
				'rt-select2',
				'rt-wls-preview',
				'rt-wls-admin',
			) );

			$nonce = wp_create_nonce( $rtWLS->nonceText() );
			wp_localize_script( 'rt-wls-admin', 'wls',
				array(
					'nonceID' => $rtWLS->nonceID(),
					'nonce'   => $nonce,
					'ajaxurl' => admin_url( 'admin-ajax.php' )
				) );

		}

		/**
		 * Create the custom meta box for ShortCode post type
		 */
		function sc_meta_boxes() {

			global $rtWLS;
			add_meta_box(
				$rtWLS->shortCodePT . '_sc_settings_meta',
				esc_html__( 'Short Code Generator', 'wp-logo-showcase' ),
				array( $this, 'wls_sc_settings_selection' ),
				$rtWLS->shortCodePT,
				'normal',
				'high' );

			add_meta_box(
				$rtWLS->shortCodePT . '_sc_preview_meta',
				esc_html__( 'Layout Preview', 'wp-logo-showcase' ),
				array( $this, 'wls_sc_preview_selection' ),
				$rtWLS->shortCodePT,
				'normal',
				'high' );

			add_meta_box(
				'rt_plugin_sc_pro_information',
				__( 'Documentation', 'wp-logo-showcase' ),
				array( $this, 'rt_plugin_sc_pro_information' ),
				$rtWLS->shortCodePT,
				'side',
				'low'
			);
		}


		/**
		 *  Preview section
		 */
		function wls_sc_preview_selection() {
			global $rtWLS;
			$html = null;
			$html .= "<div class='rt-response'></div><div class='wls-preview-container rt-wpls'><div id='wls-sc-preview' class='row'></div></div>";
			$rtWLS->print_html( $html );

		}

		/**
		 * Setting Sections
		 *
		 * @param $post
		 */
		function wls_sc_settings_selection( $post ) {
			global $rtWLS;
			wp_nonce_field( $rtWLS->nonceText(), $rtWLS->nonceID() );
			$html = null;
			$html .= '<div class="rt-tab-container">';
			$html .= '<ul class="rt-tab-nav">
                            <li><a href="#sc-wls-layout"><i class="dashicons dashicons-layout"></i>' . esc_html__( 'Layout', 'wp-logo-showcase' ) . '</a></li>
                            <li><a href="#sc-wls-filter"><i class="dashicons dashicons-filter"></i>' . esc_html__( 'Logo Filtering', 'wp-logo-showcase' ) . '</a></li>
                            <li><a href="#sc-wls-layout-building"><i class="dashicons dashicons-editor-table"></i>' . esc_html__( 'Layout Building', 'wp-logo-showcase' ) . '</a></li>
                            <li><a href="#sc-wls-style"><i class="dashicons dashicons-admin-customizer"></i>' . esc_html__( 'Styling', 'wp-logo-showcase' ) . '</a></li>
                          </ul>';
			$html .= sprintf( '<div id="sc-wls-layout" class="rt-tab-content">%s</div>', $rtWLS->rtFieldGenerator( $rtWLS->scLayoutMetaFields(), true ) );

			$html .= sprintf( '<div id="sc-wls-filter" class="rt-tab-content">%s</div>', $rtWLS->rtFieldGenerator( $rtWLS->scFilterMetaFields(), true ) );

			$html .= sprintf( '<div id="sc-wls-layout-building" class="rt-tab-content">%s</div>', $this->rt_wls_sc_layout_building_meta() );

			$html .= sprintf( '<div id="sc-wls-style" class="rt-tab-content">%s</div>', $this->rt_wls_sc_style_meta( $post ) );
			$html .= "</div>";
			$rtWLS->print_html( $html );
		}

		function rt_plugin_sc_pro_information() {

			$html = sprintf( '<div class="rt-document-box">
							<div class="rt-box-icon"><i class="dashicons dashicons-media-document"></i></div>
							<div class="rt-box-content">
                    			<h3 class="rt-box-title">%1$s</h3>
                    				<p>%2$s</p>
                        			<a href="https://www.radiustheme.com/setup-configure-wp-logo-showcase-wordpress/" target="_blank" class="rt-admin-btn">%1$s</a>
                			</div>
						</div>',
				__( "Documentation", 'wp-logo-showcase' ),
				__( "Get started by spending some time with the documentation we included step by step process with screenshots with video.", 'wp-logo-showcase' )
			);

			$html .= '<div class="rt-document-box">
							<div class="rt-box-icon"><i class="dashicons dashicons-sos"></i></div>
							<div class="rt-box-content">
                    			<h3 class="rt-box-title">Need Help?</h3>
                    				<p>Stuck with something? Please create a 
                        <a href="https://www.radiustheme.com/contact/">ticket here</a> or post on <a href="https://www.facebook.com/groups/234799147426640/">facebook group</a>. For emergency case join our <a href="https://www.radiustheme.com/">live chat</a>.</p>
                        			<a href="https://www.radiustheme.com/contact/" target="_blank" class="rt-admin-btn">Get Support</a>
                			</div>
						</div>';

			echo $html;
		}


		/**
		 * Style section
		 *
		 * @param $post
		 *
		 * @return null|string
		 */
		function rt_wls_sc_style_meta( $post ) {
			global $rtWLS;
			$html   = null;
			$html   .= "<div class='rt-sc-meta-field-holder'>";
			$html   .= $rtWLS->rtFieldGenerator( $rtWLS->scStyleFields(), true );
			$fields = $rtWLS->scStyleItems();
			foreach ( $fields as $key => $field ) {
				$meta       = get_post_meta( $post->ID, '_wls_style_' . $key, true );
				$html       .= "<div class='rt-field-wrapper'>";
				$html       .= "<div class='rt-label'><label>{$field}</label></div>";
				$html       .= "<div class='rt-field rt-multiple-field-container'>";
				$meta_color = ( ! empty( $meta['color'] ) ? $meta['color'] : null );
				$html       .= "<div class='rt-inner-field rt-col-3'><label>Color</label><input type='text' value='{$meta_color}' class='rt-color' name='_wls_style_{$key}[color]'></div>";
				$html       .= "<div class='rt-inner-field rt-col-3'>";
				$html       .= sprintf( "<label>%s</label>", __( "Alignment", "wp-logo-showcase" ) );
				$html       .= "<select name='_wls_style_{$key}[align]' class='rt-select2'>";
				$html       .= sprintf( "<option value=''>%s</option>", __( "Default", "wp-logo-showcase" ) );
				$aligns     = $rtWLS->scWlsAlign();
				$meta_align = ( ! empty( $meta['align'] ) ? $meta['align'] : null );
				foreach ( $aligns as $aKey => $aValue ) {
					$selected = ( $aKey == $meta_align ? "selected" : null );
					$html     .= "<option {$selected} value='{$aKey}'>{$aValue}</option>";
				}
				$html      .= "</select>";
				$html      .= "</div>";
				$html      .= "<div class='rt-inner-field rt-col-3'>";
				$html      .= sprintf( "<label>%s</label>", __( "Size", "wp-logo-showcase" ) );
				$html      .= "<select name='_wls_style_{$key}[size]'  class='rt-select2'>";
				$html      .= sprintf( "<option value=''>%s</option>", __( "Default", "wp-logo-showcase" ) );
				$sizes     = $rtWLS->scWlsFontSize();
				$meta_size = ( ! empty( $meta['size'] ) ? $meta['size'] : null );
				foreach ( $sizes as $sKey => $sValue ) {
					$selected = ( $sKey == $meta_size ? "selected" : null );
					$html     .= "<option {$selected} value='{$sKey}'>{$sValue}</option>";
				}
				$html .= "</select>";
				$html .= "</div>";
				$html .= "</div>";
				$html .= "</div>";
			}

			$html .= "</div>"; // End

			return $html;

		}

		/**
		 * Layout drag and drop sorting Section
		 *
		 * @return null|string
		 */
		function rt_wls_sc_layout_building_meta() {
			global $rtWLS;
			$metaItems = get_post_meta( get_the_ID(), '_wls_items' );
			if ( ! in_array( 'logo', $metaItems ) ) {
				array_push( $metaItems, 'logo' );
			}
			$items     = $rtWLS->scLayoutItems();
			$items_key = array_keys( $items );
			$html      = null;
			$html      .= "<div class='rt-field-wrapper'>";
			$html      .= "<div class='rt-field'>";
			$html      .= "<div class='rt-sortable'>";

			$html .= "<div class='sort-values'>";
			if ( ! empty( $metaItems ) ) {
				foreach ( $metaItems as $item ) {
					$html .= "<input type='hidden' name='_wls_items[]' value='{$item}' >";
				}
			}
			$html .= "</div>";

			$html .= "<div class='sortable-list-holder'>";
			$html .= "<div class='sortable-list-content'>";
			$html .= "<h2>" . esc_html__( "Enabled", 'wp-logo-showcase' ) . "</h2>";
			$html .= "<ul class='sortable-list target'>";
			if ( ! empty( $metaItems ) ) {
				foreach ( $metaItems as $item ) {
					$html .= "<li class='sortable-item' data-item='$item'>{$items[$item]}</li>";
				}
			}
			$html      .= "</ul>";
			$html      .= "</div>";
			$html      .= "</div>";
			$html      .= "<div class='sortable-list-holder'>";
			$html      .= "<div class='sortable-list-content'>";
			$html      .= "<h2>" . esc_html__( "Disabled", 'wp-logo-showcase' ) . "</h2>";
			$html      .= "<ul class='sortable-list source'>";
			$items_key = array_diff( $items_key, $metaItems );
			foreach ( $items_key as $item ) {
				$html .= "<li class='sortable-item' data-item='$item'>{$items[$item]}</li>";
			}
			$html .= "</ul>";
			$html .= "</div>";
			$html .= "</div>";

			$html .= "</div>";
			$html .= "</div>";
			$html .= "</div>";

			return $html;
		}


		/**
		 * Save all the meta value for shortCode meta field
		 *
		 * @param $post_id
		 * @param $post
		 * @param $update
		 */
		function save_team_sc_meta_data( $post_id, $post, $update ) {

			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			global $rtWLS;
			if ( ! $rtWLS->verifyNonce() ) {
				return $post_id;
			}
			if ( $rtWLS->shortCodePT != $post->post_type ) {
				return $post_id;
			}

			$mates = $rtWLS->wlsScMetaNames();
			foreach ( $mates as $field ) {
				$rValue = ! empty( $_REQUEST[ $field['name'] ] ) ? $_REQUEST[ $field['name'] ] : null;
				$value  = $rtWLS->sanitize( $field, $rValue );
				if ( empty( $field['multiple'] ) ) {
					update_post_meta( $post_id, $field['name'], $value );
				} else {
					delete_post_meta( $post_id, $field['name'] );
					if ( is_array( $value ) && ! empty( $value ) ) {
						foreach ( $value as $item ) {
							add_post_meta( $post_id, $field['name'], $item );
						}
					}
				}
			}

			$meta = array();
			foreach ( $rtWLS->scStyleItems() as $key => $value ) {
				$key = "_wls_style_" . $key;
				if ( ! empty( $_REQUEST[ $key ] ) && is_array( $_REQUEST[ $key ] ) ) {
					$mValue          = array();
					$mValue['color'] = ( ! empty( $_REQUEST[ $key ]['color'] ) ? $rtWLS->sanitize_hex_color( $_REQUEST[ $key ]['color'] ) : null );
					$mValue['align'] = ( ! empty( $_REQUEST[ $key ]['align'] ) ? sanitize_text_field( $_REQUEST[ $key ]['align'] ) : null );
					$mValue['size']  = ( ! empty( $_REQUEST[ $key ]['size'] ) ? sanitize_text_field( $_REQUEST[ $key ]['size'] ) : null );
					$meta[ $key ]    = $mValue;
				} else {
					delete_post_meta( $post_id, $key );
				}
			}
			foreach ( $meta as $key => $data ) {
				update_post_meta( $post_id, $key, $data );
			}

		}
	}
endif;