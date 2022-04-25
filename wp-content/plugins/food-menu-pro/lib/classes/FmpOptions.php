<?php

if (!class_exists('FmpOptions')):

    class FmpOptions {

        function __construct() {
            // Settings
            add_filter('fmp_general_settings', [ $this, 'generalSettings' ], 10, 2);
            add_filter('tlp_fm_hidden_field_option', [ $this, 'detailsPageHiddenOptions' ]);
            add_filter('tlp_fm_settings_tab', [ $this, 'license_tab' ]);
            add_filter('tlp_fm_promotion_tab_title', [ $this, 'promotion_tab_title' ]);
            add_filter('tlp_fm_promotion_product_list', [ $this, 'promotionsFields' ]);

            // Shortcode
            add_filter('fmp_sc_layout_settings', [$this, 'scLayoutMetaFields']);
            add_filter('fmp_sc_layouts', [$this, 'scLayout']);
            add_filter('fmp_sc_order_by', [$this, 'scOrderBy']);
            add_filter('fmp_item_fields', [$this, 'fmpItemFields']);
            add_filter('fmp_sc_style', [$this, 'scStyleFields']);
        }

        // General Settings
        function generalSettings( $general, $settings ) {

            $options = array(
                'price_thousand_sep' => array(
                    'label' => __('Thousand Separator', 'food-menu-pro'),
                    'type'  => 'text',
                    'class' => 'small-text',
                    'value' => (!empty($settings['price_thousand_sep']) ? $settings['price_thousand_sep'] : ',')
                ),
                'price_decimal_sep'  => array(
                    'label' => __('Decimal Separator', 'food-menu-pro'),
                    'type'  => 'text',
                    'class' => 'small-text',
                    'value' => (!empty($settings['price_decimal_sep']) ? stripslashes($settings['price_decimal_sep']) : '.')
                ),
                'price_num_decimals' => array(
                    'label' => __('Number of Decimals', 'food-menu-pro'),
                    'type'  => 'number',
                    'class' => 'small-text',
                    'attr'  => 'min="0" step="1"',
                    'value' => (!empty($settings['price_num_decimals']) ? (absint($settings['price_num_decimals']) > 0 ? absint($settings['price_num_decimals']) : 2) : 2)
                ),
            );

            $general = array_merge($general, $options);

            return apply_filters('rt_fmp_general_settings', $general, $settings);
        }

        // Details Page Settings
        function detailsPageHiddenOptions( $options ) {
            return array_merge( $options, [
                'summery'     => 'Short Description',
                'taxonomy'    => 'Taxonomy (Category , Tag)',
                'description' => 'Description',
                'ingredient'  => 'Ingredient',
                'nutrition'   => 'Nutrition',
                'reviews'     => 'Reviews'
            ]);
        }

        function promotion_tab_title( $title ) {
            return __('Themes (Pro)', 'food-menu-pro');
        }

        // Promotion Fields
        function promotionsFields( $products ) {
            unset($products['plugins']);

            return $products;
        }

        // License
        function license_tab( $tabs ) {
            $position = array_search('details', array_keys($tabs));

            if ($position > -1) {
                $tab['license'] = [
                    'id' => 'plugin-license',
                    'title' => __('Plugin License', 'food-menu-pro'),
                    'icon' => 'dashicons-admin-network',
                    'content' => TLPFoodMenu()->rtFieldGenerator($this->rtLicenceField()),
                ];
                FmpHelper::array_insert($tabs, $position, $tab);
            }

            return $tabs;
        }

        function rtLicenceField() {
            $settings = get_option(TLPFoodMenu()->options['settings']);
            $status = !empty($settings['license_status']) && $settings['license_status'] === 'valid' ? true : false;
            $license_status = !empty($settings['license_key']) ? sprintf("<span class='license-status'>%s</span>",
                $status ? "<input type='submit' class='button-secondary rt-licensing-btn danger' name='license_deactivate' value='" . __("Deactivate License", "food-menu-pro") . "'/>"
                    : "<input type='submit' class='button-secondary rt-licensing-btn button-primary' name='license_activate' value='" . __("Activate License", "food-menu-pro") . "'/>"
            ) : ' ';

            return array(
                "license_key" => array(
                    'type'        => 'text',
                    'attr'        => 'style="min-width:300px;"',
                    'label'       => __('Enter your license key', 'food-menu-pro'),
                    'description' => $license_status,
                    'id'          => 'rt_fmp_license_key',
                    'value'       => isset($settings['license_key']) ? $settings['license_key'] : ''
                )
            );
        }

        // Shortcode Layout
        function scLayoutMetaFields( $fields ) {
            $position = array_search('fmp_layout', array_keys($fields));

            if ($position > -1) {
                $layoutFields = [
                    'fmp_isotope_selected_filter'   => array(
                        "type"        => "select",
                        "label"       => __("Isotope filter (Selected item)", 'food-menu-pro'),
                        'holderClass' => "fmp-isotope-item fmp-hidden",
                        "class"       => "fmp-select2",
                        "blank"       => __('Show All', 'food-menu-pro'),
                        "options"     => TLPFoodMenu()->getAllFmpCategoryList()
                    ),
                    'fmp_isotope_filter_show_all'   => array(
                        "type"        => "checkbox",
                        "label"       => "Isotope filter (Show All item)",
                        'holderClass' => "fmp-isotope-item fmp-hidden",
                        "id"          => "rt-tpg-sc-isotope-filter-show-all",
                        "optionLabel" => __('Disable', "food-menu-pro"),
                        "option"      => 1
                    ),
                    'fmp_isotope_search_filtering'  => array(
                        "type"        => "checkbox",
                        "label"       => "Isotope search filter",
                        'holderClass' => "fmp-isotope-item fmp-hidden",
                        "optionLabel" => 'Enable',
                        "option"      => 1
                    ),
                    'fmp_carousel_items_per_slider' => array(
                        "label"       => __("Number of items", 'food-menu-pro'),
                        "holderClass" => "hidden fmp-carousel-item",
                        "type"        => "number",
                        'default'     => 3,
                        "description" => __('Number of item to display', 'food-menu-pro'),
                    ),
                    'fmp_carousel_speed'            => array(
                        "label"       => __("Speed", 'food-menu-pro'),
                        "holderClass" => "fmp-hidden fmp-carousel-item",
                        "type"        => "number",
                        'default'     => 2000,
                        "description" => __('Auto play Speed in milliseconds', 'food-menu-pro'),
                    ),
                    'fmp_carousel_options'          => array(
                        "label"       => __("Carousel Options", 'food-menu-pro'),
                        "holderClass" => "fmp-hidden fmp-carousel-item",
                        "type"        => "checkbox",
                        "multiple"    => true,
                        "alignment"   => "vertical",
                        "options"     => $this->owlProperty(),
                        "default"     => array('autoplay', 'arrows', 'dots', 'responsive', 'infinite'),
                    ),
                    'fmp_carousel_autoplay_timeout' => array(
                        "label"       => __("Autoplay timeout", 'food-menu-pro'),
                        "holderClass" => "fmp-hidden fmp-carousel-auto-play-timeout",
                        "type"        => "number",
                        'default'     => 5000,
                        "description" => __('Autoplay interval timeout', 'food-menu-pro'),
                    ),
                ];
                FmpHelper::array_insert($fields, $position, $layoutFields);
            }

            $position = array_search('fmp_mobile_column', array_keys($fields));
            if ($position > -1) {
                $pagination = [
                    'fmp_pagination' => array(
                        "type" => "checkbox",
                        "label" => __("Pagination", "food-menu-pro"),
                        'holderClass' => "pagination",
                        "optionLabel" => __('Enable', "food-menu-pro"),
                        "option" => 1
                    ),
                    'fmp_posts_per_page' => array(
                        "type" => "number",
                        "label" => __("Display per page", "food-menu-pro"),
                        'holderClass' => "fmp-pagination-item fmp-hidden",
                        "default" => 5,
                        "description" => __("If value of Limit setting is not blank (empty), this value should be smaller than Limit value.",
                            "food-menu-pro")
                    ),
                    'fmp_pagination_type' => array(
                        "type" => "radio",
                        "label" => __("Pagination type", "food-menu-pro"),
                        'holderClass' => "fmp-pagination-item fmp-hidden",
                        "alignment" => "vertical",
                        "default" => 'pagination',
                        "options" => $this->paginationType(),
                    ),
                    'fmp_load_more_button_text' => array(
                        "type" => "text",
                        "label" => __("Load more button text", "food-menu-pro"),
                        'holderClass' => "fmp-load-more-item fmp-hidden",
                        "default" => __("Load more", "food-menu-pro")
                    ),
                ];
                FmpHelper::array_insert($fields, $position, $pagination);
            }

            $position = array_search('fmp_image_size', array_keys($fields));

            if ($position > -1) {
                $imgOption = [
                    'fmp_custom_image_size'         => array(
                        "type"        => "image_size",
                        "label"       => __("Custom Image Size", "food-menu-pro"),
                        'holderClass' => "hidden",
                    ),
                    'fmp_image_shape'               => array(
                        "type"      => "radio",
                        "label"     => __("Image Shape", "food-menu-pro"),
                        "alignment" => "vertical",
                        "default"   => 'normal',
                        "options"   => $this->get_image_shapes()
                    ),
                ];
                FmpHelper::array_insert($fields, $position, $imgOption);
            }

            $position = array_search('fmp_excerpt_limit', array_keys($fields));
            if ($position > -1) {
                $excerptOption = [
                    'fmp_read_more_button_text' => array(
                        "type" => "text",
                        "label" => __("Read more button text", "food-menu-pro"),
                        "default" => __("Read more", "food-menu-pro")
                    ),
                    'fmp_add_to_cart_text' => array(
                        "type" => "text",
                        "label" => __("Add to cart text (WooCommerce)", "food-menu-pro"),
                        "default" => __("Add to cart", "food-menu-pro")
                    ),
                    'fmp_margin' => array(
                        "type" => "radio",
                        "label" => __("Margin", "food-menu-pro"),
                        "alignment" => "vertical",
                        "description" => __("Select the margin for layout", "food-menu-pro"),
                        "default" => "default",
                        "options" => $this->scMarginOpt()
                    ),
                    'fmp_grid_style' => array(
                        "type" => "radio",
                        "label" => __("Grid style", "food-menu-pro"),
                        "alignment" => "vertical",
                        "description" => __("Select grid style for layout", "food-menu-pro"),
                        "default" => "even",
                        "options" => $this->scGridOpt()
                    ),
                ];
                FmpHelper::array_insert($fields, $position, $excerptOption);
            }

            $fields['fmp_single_food_popup'] = [
                "type"        => "checkbox",
                "label"       => __("Single food popup", "food-menu-pro"),
                'holderClass' => "fmp_single_food_popup fmp-hidden",
                "optionLabel" => __("Enable", "food-menu-pro"),
                "default"     => 1,
                "option"      => 1
            ];

            $fields['fmp_placeholder_image'] = [
                "type"        => "image",
                "label"       => __("Default preview  image", 'food-menu-pro'),
                "description" => __("Add an image for default preview", 'food-menu-pro')
            ];

            return $fields;
        }

        function scLayout( $layouts ) {
            return array_merge(
                [
                    'grid-by-cat1'     => __('Grid By Category 1', 'food-menu-pro'),
                    'grid-by-cat2'     => __('Grid By Category 2', 'food-menu-pro'),
                    'layout1'          => __('Layout 1', 'food-menu-pro'),
                    'layout2'          => __('Layout 2', 'food-menu-pro'),
                    'layout3'          => __('Layout 3', 'food-menu-pro'),
                    'layout4'          => __('Layout 4', 'food-menu-pro'),
                    'layout5'          => __('Layout 5(Full width)', 'food-menu-pro'),
                    'carousel1'        => __('Carousel 1', 'food-menu-pro'),
                    'carousel2'        => __('Carousel 2', 'food-menu-pro'),
                    'carousel3'        => __('Carousel 3', 'food-menu-pro'),
                    'carousel4'        => __('Carousel 4', 'food-menu-pro'),
                    'isotope1'         => __('Isotope 1', 'food-menu-pro'),
                    'isotope2'         => __('Isotope 2', 'food-menu-pro'),
                    'isotope3'         => __('Isotope 3', 'food-menu-pro'),
                    'isotope4'         => __('Isotope 4', 'food-menu-pro'),
                ],
                $layouts
            );
        }

        function scOrderBy( $order_by ) {
            $order_by['rand'] = __("Random", 'food-menu-pro');

            return $order_by;
        }

        function fmpItemFields( $items ) {

            $proItems = [
                'categories'  => __("Categories", "food-menu-pro"),
                'label'       => __("Label", "food-menu-pro"),
                'read_more'   => __("Read More", "food-menu-pro"),
            ];

            if (TLPFoodMenu()->isWcActive()) {
                $proItems['add_to_cart'] = __("Add to cart (WooCommerce)", "food-menu-pro");
                $proItems['quantity'] = __("Quantity (WooCommerce)", "food-menu-pro");
            }
            return array_merge( $items, $proItems);
        }

        function scStyleFields( $fields ) {
            $position = array_search('fmp_parent_class', array_keys($fields));
            if ($position > -1) {
                $colorOption = [
                    'fmp_primary_color'           => array(
                        "type"    => "colorpicker",
                        "label"   => __("Primary Color", "food-menu-pro"),
                        "default" => "#0367bf"
                    ),
                    'fmp_overlay_color'           => array(
                        "type"  => "colorpicker",
                        "label" => __("Overlay color", "food-menu-pro"),
                    ),
                    'fmp_overlay_opacity'         => array(
                        "type"        => "select",
                        "label"       => __("Overlay opacity", "food-menu-pro"),
                        "class"       => "fmp-select2",
                        "default"     => .8,
                        "options"     => $this->overflowOpacity(),
                        "description" => __("Overlay opacity use only positive integer value", 'food-menu-pro')
                    ),
                    'fmp_overlay_padding'         => array(
                        "type"        => "number",
                        "label"       => __("Overlay top padding", "food-menu-pro"),
                        "class"       => "small-text",
                        "description" => __("Overlay top padding use only positive integer value, e.g : 20 (with out postfix like px, em, % etc). it will displayed by %",
                            'food-menu-pro')
                    ),
                ];
                FmpHelper::array_insert($fields, $position, $colorOption);
            }

            $position = array_search('fmp_price_style', array_keys($fields));
            if ($position > -1) {
                $typeOption = [
                    'fmp_short_description_style' => array(
                        'type'  => 'style',
                        'label' => __('Short description', 'food-menu-pro'),
                    ),
                    'fmp_category_name_style' => array(
                        'type' => 'style',
                        'label' => __('Category name', 'food-menu-pro'),
                    ),
                ];
                FmpHelper::array_insert($fields, $position, $typeOption);
            }

            return $fields;
        }

        /**
         * Carousel Property
         *
         * @return array
         */
        private function owlProperty() {
            $oelProperty = array(
                'loop'               => __('Loop', 'food-menu-pro'),
                'autoplay'           => __('Auto Play', 'food-menu-pro'),
                'autoplayHoverPause' => __('Pause on mouse hover', 'food-menu-pro'),
                'nav'                => __('Nav Button', 'food-menu-pro'),
                'dots'               => __('Pagination', 'food-menu-pro'),
                'auto_height'        => __('Auto Height', 'food-menu-pro'),
                'lazy_load'          => __('Lazy Load', 'food-menu-pro'),
                'rtl'                => __('Right to left (RTL)', 'food-menu-pro')
            );

            return apply_filters('fmp_sc_owl_property', $oelProperty);
        }

        function paginationType() {
            return array(
                'pagination'      => __("Pagination", 'food-menu-pro'),
                'pagination_ajax' => __("Ajax Number Pagination ( Only for Grid )", 'food-menu-pro'),
                'load_more'       => __("Load more button (by ajax loading)", 'food-menu-pro'),
                'load_on_scroll'  => __("Load more on scroll (by ajax loading)", 'food-menu-pro')
            );
        }

        function get_image_shapes() {
            return array(
                'normal' => "Normal",
                'circle' => "Circle"
            );
        }

        function scMarginOpt() {
            return array(
                'default' => __("Bootstrap default", 'food-menu-pro'),
                'no'      => __("No Margin", 'food-menu-pro'),
            );
        }

        function scGridOpt() {
            return array(
                'even'    => __("Even", 'food-menu-pro'),
                'masonry' => __("Masonry", 'food-menu-pro')
            );
        }

        function overflowOpacity() {
            return array(
                10 => '10%',
                20 => '20%',
                30 => '30%',
                40 => '40%',
                50 => '50%',
                60 => '60%',
                70 => '70%',
                80 => '80%',
                90 => '90%',
            );
        }

    }

endif;