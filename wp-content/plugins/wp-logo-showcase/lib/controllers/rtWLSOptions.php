<?php
/**
 * WLS Options Class
 * @package WP_LOGO_SHOWCASE
 * @since   1.0
 * @author  RadiusTheme
 */

if ( ! class_exists( 'rtWLSOptions' ) ):

	class rtWLSOptions {

		/**
		 * Generate Getting field option
		 * @return array
		 */
		function rtWLSGeneralSettings() {
			global $rtWLS;
			$settings = get_option( $rtWLS->options['settings'] );

			return array(
				'image_resize' => array(
					'type'  => 'checkbox',
					'name'  => 'image_resize',
					'id'    => 'wls_image_resize',
					'label' => esc_html__( 'Enable Image Re-Size', 'wp-logo-showcase' ),
					'value' => isset( $settings['image_resize'] ) ? trim( $settings['image_resize'] ) : null
				),
				'image_width'  => array(
					'type'        => 'number',
					'name'        => 'image_width',
					'id'          => "wls_image_width",
					'label'       => esc_html__( "Image Width", 'wp-logo-showcase' ),
					'holderClass' => 'hidden',
					'default'     => 250,
					'holderID'    => 'wls_image_width_holder',
					'value'       => isset( $settings['image_width'] ) ? (int) ( $settings['image_width'] ) : null
				),
				'image_height' => array(
					'type'        => 'number',
					'name'        => 'image_height',
					'id'          => "wls_image_height",
					'label'       => esc_html__( "Image Height", 'wp-logo-showcase' ),
					'holderClass' => 'hidden',
					'default'     => 190,
					'holderID'    => 'wls_image_height_holder',
					'value'       => isset( $settings['image_height'] ) ? (int) ( $settings['image_height'] ) : null
				),
				'image_crop'   => array(
					'type'        => 'select',
					'name'        => 'image_crop',
					'id'          => "image_crop",
					'label'       => esc_html__( "Image Crop", 'wp-logo-showcase' ),
					'class'       => "rt-select2",
					'holderID'    => 'wls_image_crop_holder',
					'holderClass' => 'hidden',
					'options'     => array(
						false => esc_html__( "Soft Crop", 'wp-logo-showcase' ),
						true  => esc_html__( "Hard Crop", 'wp-logo-showcase' )
					),
					'value'       => isset( $settings['image_crop'] ) ? (int) ( $settings['image_crop'] ) : null
				),
			);

		}

		/**
		 * Generate Custom css Field for setting page
		 * @return array
		 */
		function rtWLSCustomCss() {
			global $rtWLS;
			$settings = get_option( $rtWLS->options['settings'] );

			return array(
				'custom_css' => array(
					'type'        => 'custom_css',
					'name'        => 'custom_css',
					'id'          => 'custom-css',
					'holderClass' => 'full',
					'value'       => isset( $settings['custom_css'] ) ? trim( $settings['custom_css'] ) : null,
				),
			);
		}

		/**
		 * Layout array
		 * @return array
		 */
		function scLayout() {
			return array(
				'grid-layout'     => esc_html__( 'Grid Layout', 'wp-logo-showcase' ),
				'carousel-layout' => esc_html__( 'Carousel Layout', 'wp-logo-showcase' ),
				'isotope-layout'  => esc_html__( 'Isotope Layout', 'wp-logo-showcase' ),
			);
		}

		/**
		 * Layout item list
		 * @return array
		 */
		function scLayoutItems() {
			return array(
				'title'       => esc_html__( "Title", 'wp-logo-showcase' ),
				'logo'        => esc_html__( "Logo", 'wp-logo-showcase' ),
				'description' => esc_html__( "Description", 'wp-logo-showcase' )
			);
		}


		/**
		 * Style field
		 * @return array
		 */
		function scStyleItems() {
			$items = $this->scLayoutItems();
			unset( $items['logo'] );

			return $items;
		}

		/**
		 * Align options
		 * @return array
		 */
		function scWlsAlign() {
			return array(
				'left'   => esc_html__( "Left", 'wp-logo-showcase' ),
				'center' => esc_html__( "Center", 'wp-logo-showcase' ),
				'right'  => esc_html__( "Right", 'wp-logo-showcase' ),
			);
		}

		/**
		 * FontSize Options
		 * @return array
		 */
		function scWlsFontSize() {

			$size = array();

			for ( $i = 14; $i <= 60; $i ++ ) {
				$size[ $i ] = "{$i} px";
			}

			return $size;
		}

		/**
		 * Order By Options
		 * @return array
		 */
		function scOrderBy() {
			return array(
				'menu_order' => esc_html__( "Menu Order", 'wp-logo-showcase' ),
				'title'      => esc_html__( "Name", 'wp-logo-showcase' ),
				'date'       => esc_html__( "Date", 'wp-logo-showcase' ),
				'rand'       => esc_html__( "Random order", 'wp-logo-showcase' ),
			);
		}

		/**
		 * Order Options
		 * @return array
		 */
		function scOrder() {
			return array(
				'ASC'  => esc_html__( "Ascending", 'wp-logo-showcase' ),
				'DESC' => esc_html__( "Descending", 'wp-logo-showcase' ),
			);
		}

		/**
		 * Style field options
		 * @return array
		 */
		function scStyleFields() {
			return array(
				'primary_color'          => array(
					'type'  => 'colorpicker',
					'name'  => 'wls_primary_color',
					'label' => esc_html__( 'Primary color', 'wp-logo-showcase' ),
				),
				'button_bg_color'        => array(
					'type'  => 'colorpicker',
					'name'  => 'wls_button_bg_color',
					'label' => esc_html__( 'Button background color', 'wp-logo-showcase' ),
				),
				'button_bg_hover_color'  => array(
					'type'  => 'colorpicker',
					'name'  => 'wls_button_bg_hover_color',
					'label' => esc_html__( 'Button background color on hover', 'wp-logo-showcase' ),
				),
				'button_bg_active_color' => array(
					'type'  => 'colorpicker',
					'name'  => 'wls_button_bg_active_color',
					'label' => esc_html__( 'Button background color on active', 'wp-logo-showcase' ),
				),
				'button_text_color'      => array(
					'type'  => 'colorpicker',
					'name'  => 'wls_button_text_color',
					'label' => esc_html__( 'Button text color', 'wp-logo-showcase' ),
				),
				'gutter'                 => array(
					'type'        => 'number',
					'name'        => 'wls_gutter',
					'label'       => esc_html__( 'Gutter / Padding', 'wp-logo-showcase' ),
					'description' => esc_html__( "Unit will be pixel, No need to give any unit. Only integer value will be valid.<br> Leave it blank for default", 'wp-logo-showcase' )
				),
			);
		}


		/**
		 * Column Options
		 * @return array
		 */
		function scColumns() {
			return array(
				1 => esc_html__( "1 Column", 'wp-logo-showcase' ),
				2 => esc_html__( "2 Column", 'wp-logo-showcase' ),
				3 => esc_html__( "3 Column", 'wp-logo-showcase' ),
				4 => esc_html__( "4 Column", 'wp-logo-showcase' ),
				5 => esc_html__( "5 Column", 'wp-logo-showcase' ),
				6 => esc_html__( "6 Column", 'wp-logo-showcase' ),
			);
		}

		/**
		 * Link type options
		 * @return array
		 */
		function scLinkTypes() {
			return array(
				'new_window' => esc_html__( "Open in new window", 'wp-logo-showcase' ),
				'self'       => esc_html__( "Open in same window", 'wp-logo-showcase' ),
				'no_link'    => esc_html__( "No link", 'wp-logo-showcase' ),
			);
		}

		/**
		 * Filter Options
		 * @return array
		 */
		function scFilterMetaFields() {
			global $rtWLS;

			return array(
				'wls_post__in'     => array(
					"name"        => "wls_post__in",
					"label"       => esc_html__( "Include only", 'wp-logo-showcase' ),
					"type"        => "text",
					"class"       => "full",
					"description" => esc_html__( 'List of post IDs to show (comma-separated values, for example: 1,2,3)',
						'wp-logo-showcase' )
				),
				'wls_post__not_in' => array(
					"name"        => "wls_post__not_in",
					"label"       => esc_html__( "Exclude", 'wp-logo-showcase' ),
					"type"        => "text",
					"class"       => "full",
					"description" => esc_html__( 'List of post IDs to show (comma-separated values, for example: 1,2,3)',
						'wp-logo-showcase' )
				),
				'wls_limit'        => array(
					"name"        => "wls_limit",
					"label"       => esc_html__( "Limit", 'wp-logo-showcase' ),
					"type"        => "number",
					"class"       => "full",
					"description" => esc_html__( 'The number of posts to show. Set empty to show all found posts.',
						'wp-logo-showcase' )
				),
				'wls_categories'   => array(
					"name"        => "wls_categories",
					"label"       => esc_html__( "Categories", 'wp-logo-showcase' ),
					"type"        => "select",
					"class"       => "rt-select2",
					"id"          => "wls_categories",
					"multiple"    => true,
					"description" => esc_html__( 'Select the category you want to filter, Leave it blank for All category',
						'wp-logo-showcase' ),
					"options"     => $rtWLS->getAllWlsCategoryList()
				),
				'wls_order_by'     => array(
					"name"    => "wls_order_by",
					"label"   => esc_html__( "Order By", 'wp-logo-showcase' ),
					"type"    => "select",
					"class"   => "rt-select2",
					"default" => "date",
					"options" => $this->scOrderBy()
				),
				'wls_order'        => array(
					"name"      => "wls_order",
					"label"     => esc_html__( "Order", 'wp-logo-showcase' ),
					"type"      => "radio",
					"class"     => "rt-select2",
					"options"   => $this->scOrder(),
					"default"   => "DESC",
					"alignment" => "vertical",
				),
			);
		}

		/**
		 * ShortCode Layout Options
		 * @return array
		 */
		function scLayoutMetaFields() {
			global $rtWLS;

			return array(
				'wls_layout'                  => array(
					'name'    => 'wls_layout',
					'type'    => 'select',
					'id'      => 'wls_layout',
					'label'   => esc_html__( 'Layout', 'wp-logo-showcase' ),
					'class'   => 'rt-select2',
					'options' => $this->scLayout()
				),
				'wls_desktop_column'          => array(
					'name'        => 'wls_desktop_column',
					'type'        => 'select',
					'label'       => esc_html__( 'Desktop column', 'wp-logo-showcase' ),
					'id'          => 'wls_desktop_column',
					"holderClass" => "wls_column_options_holder",
					'class'       => 'rt-select2',
					'default'     => 4,
					'options'     => $this->scColumns()
				),
				'wls_tab_column'              => array(
					'name'        => 'wls_tab_column',
					'type'        => 'select',
					'label'       => esc_html__( 'Tab column', 'wp-logo-showcase' ),
					'id'          => 'wls_tab_column',
					"holderClass" => "wls_column_options_holder",
					'class'       => 'rt-select2',
					'default'     => 2,
					'options'     => $this->scColumns()
				),
				'wls_mobile_column'           => array(
					'name'        => 'wls_mobile_column',
					'type'        => 'select',
					'label'       => esc_html__( 'Mobile column', 'wp-logo-showcase' ),
					'id'          => 'wls_mobile_column',
					"holderClass" => "wls_column_options_holder",
					'class'       => 'rt-select2',
					'default'     => 1,
					'options'     => $this->scColumns()
				),
				'wls_desktop_slider'          => array(
					'name'        => 'wls_desktop_slider',
					'type'        => 'number',
					'label'       => esc_html__( 'Desktop slider number', 'wp-logo-showcase' ),
					'id'          => 'wls_desktop_slider',
					"holderClass" => "hidden wls_carousel_options_holder",
					"description" => esc_html__( 'If you want more that 6 item then set it.', 'wp-logo-showcase' ),
				),
				'wls_carousel_slidesToScroll' => array(
					"name"        => "wls_carousel_slidesToScroll",
					"label"       => esc_html__( "Slides To Scroll", 'wp-logo-showcase' ),
					"holderClass" => "hidden wls_carousel_options_holder",
					"type"        => "number",
					'default'     => 3,
					"description" => esc_html__( 'Number of logo to to scroll, Recommended > same as  slides to show',
						'wp-logo-showcase' ),
				),
				'wls_carousel_speed'          => array(
					"name"        => "wls_carousel_speed",
					"label"       => esc_html__( "Speed", 'wp-logo-showcase' ),
					"holderClass" => "hidden wls_carousel_options_holder",
					"type"        => "number",
					'default'     => 2000,
					"description" => esc_html__( 'Auto play Speed in milliseconds', 'wp-logo-showcase' ),
				),
				'wls_carousel_options'        => array(
					"name"        => "wls_carousel_options",
					"label"       => esc_html__( "Carousel Options", 'wp-logo-showcase' ),
					"holderClass" => "hidden wls_carousel_options_holder",
					"type"        => "checkbox",
					"multiple"    => true,
					"alignment"   => "vertical",
					"options"     => $rtWLS->carouselProperty(),
					"default"     => array( 'autoplay', 'arrows', 'dots', 'responsive', 'infinite' ),
				),
				'wls_tooltip'                 => array(
					'name'   => 'wls_tooltip',
					'type'   => 'checkbox',
					'label'  => esc_html__( 'ToolTip', 'wp-logo-showcase' ),
					'option' => 'Enable',
					'id'     => 'wls_tooltip'
				),
				'wls_box_highlight'           => array(
					'name'   => 'wls_box_highlight',
					'type'   => 'checkbox',
					'label'  => esc_html__( 'Box Highlight', 'wp-logo-showcase' ),
					'option' => 'Enable',
					'id'     => 'wls_box_highlight'
				),
				'wls_grayscale'               => array(
					'name'   => 'wls_grayscale',
					'type'   => 'checkbox',
					'label'  => esc_html__( 'Grayscale', 'wp-logo-showcase' ),
					'option' => 'Enable',
					'id'     => 'wls_grayscale'
				),
				'wls_link_type'               => array(
					'name'    => 'wls_link_type',
					'type'    => 'select',
					'label'   => esc_html__( 'Link Type', 'wp-logo-showcase' ),
					'id'      => 'wls_link_type',
					'class'   => 'rt-select2',
					'options' => $this->scLinkTypes()
				),
				'wls_nofollow'                => array(
					'name'   => 'wls_nofollow',
					'type'   => 'checkbox',
					'label'  => esc_html__( 'Nofollow', 'wp-logo-showcase' ),
					'option' => esc_html__( 'Enable', 'wp-logo-showcase' )
				)
			);
		}


		/**
		 * Carousel Property
		 * @return array
		 */
		function carouselProperty() {
			return array(
				'autoplay'       => esc_html__( 'Auto Play', 'wp-logo-showcase' ),
				'arrows'         => esc_html__( 'Arrow nav button', 'wp-logo-showcase' ),
				'dots'           => esc_html__( 'Dots', 'wp-logo-showcase' ),
				'pauseOnHover'   => esc_html__( 'Pause on hover', 'wp-logo-showcase' ),
				'adaptiveHeight' => esc_html__( 'Adaptive height', 'wp-logo-showcase' ),
				'lazyLoad'       => esc_html__( 'Lazy Load (progressive)', 'wp-logo-showcase' ),
				'infinite'       => esc_html__( 'Infinite loop', 'wp-logo-showcase' ),
				'centerMode'     => esc_html__( 'Center mode', 'wp-logo-showcase' ),
				'rtl'            => esc_html__( 'Right to Left', 'wp-logo-showcase' )
			);
		}

		/**
		 * Custom Meta field for logo post type
		 * @return array
		 */
		function rtLogoMetaFields() {
			return array(
				'site_url'         => array(
					'type'        => 'url',
					'name'        => '_wls_site_url',
					'label'       => esc_html__( 'Client website URL', 'wp-logo-showcase' ),
					'placeholder' => esc_html__( "Client URL e.g: http://example.com", 'wp-logo-showcase' ),
					'description' => "Link to open when image is clicked (if links are active)"
				),
				'logo_description' => array(
					'type'        => 'textarea',
					'name'        => '_wls_logo_description',
					'class'       => 'rt-textarea',
					'esc_html'    => true,
					'label'       => esc_html__( 'Logo Description', 'wp-logo-showcase' ),
					'placeholder' => esc_html__( "Logo description", 'wp-logo-showcase' )
				),
				'logo_img_url'     => array(
					'type'        => 'url',
					'name'        => '_wls_logo_img_url',
					'label'       => esc_html__( 'Custom Image URL', 'wp-logo-showcase' ),
					'placeholder' => esc_html__( "This will dominate over featured image", 'wp-logo-showcase' ),
					'description' => esc_html__( "If you don't want to use an image from your media gallery, you can set an URL for your image here.",
						'wp-logo-showcase' )
				),
				'logo_alt_text'    => array(
					'type'        => 'text',
					'name'        => '_wls_logo_alt_text',
					'label'       => esc_html__( 'Alternate Text', 'wp-logo-showcase' ),
					'placeholder' => esc_html__( "Alt for url and image", 'wp-logo-showcase' )
				),
			);
		}
	}

endif;
