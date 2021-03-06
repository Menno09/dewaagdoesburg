<?php

if (!class_exists('FmOptions')):

    class FmOptions {

        function scItemFields() {
            return array(
                "fmp_item_fields" => array(
                    "type"      => "checkbox",
                    "label"     => __("Field Selection", "tlp-food-menu"),
                    "multiple"  => true,
                    "alignment" => "vertical",
                    "default"   => array_keys($this->fmpItemFields()),
                    "options"   => $this->fmpItemFields()
                )
            );
        }

        function fmpItemFields() {
            $items = [
                'title'       => __("Title", "tlp-food-menu"),
                'image'       => __("Image", "tlp-food-menu"),
                'price'       => __("Price", "tlp-food-menu"),
                'excerpt'     => __("Excerpt", "tlp-food-menu"),
            ];

            return apply_filters('fmp_item_fields', $items);
        }


        function foodGeneralOptions() {
            return array(
                '_fmp_type'      => array(
                    'label'   => "Food menu type",
                    'type'    => 'select',
                    'options' => $this->get_fmp_type_list()
                ),
                '_regular_price' => array(
                    'label'       => 'Regular price (' . TLPFoodMenu()->getCurrencySymbol() . ')',
                    'type'        => 'price',
                    'holderClass' => 'simple_menu_attr',
                    'class'       => 'short fmp_input_price'
                ),
                '_sale_price'    => array(
                    'label'       => 'Sale price (' . TLPFoodMenu()->getCurrencySymbol() . ')',
                    'type'        => 'price',
                    'holderClass' => 'simple_menu_attr',
                    'class'       => 'short fmp_input_price'
                ),
                '_stock_status'  => array(
                    'label'       => __('Stock status', "tlp-food-menu"),
                    'type'        => 'select',
                    'class'       => 'short fmp_select',
                    'holderClass' => 'simple_menu_attr',
                    'options'     => array(
                        'instock'    => __('In stock', 'tlp-food-menu'),
                        'outofstock' => __('Out of stock', 'tlp-food-menu')
                    )
                )
            );
        }

        function get_fmp_type_list() {
            return array(
                'simple'   => __("Simple Menu", "tlp-food-menu"),
                'variable' => __("Variable Menu", "tlp-food-menu")
            );
        }

        function foodAdvancedOptions() {
            return array(
                'menu_order'         => array(
                    'label'   => __('Menu order', 'tlp-food-menu'),
                    'type'    => 'number',
                    'default' => 0,
                ),
                '_ingredient_status' => array(
                    'label'   => __('Enable ingredient', 'tlp-food-menu'),
                    'type'    => 'checkbox',
                    'option'  => 1,
                    'default' => 1,
                ),
                '_nutrition_status'  => array(
                    'label'   => __('Enable nutrition', 'tlp-food-menu'),
                    'type'    => 'checkbox',
                    'default' => 1,
                    'option'  => 1
                ),
                'comment_status'     => array(
                    'label'   => __('Enable reviews', 'tlp-food-menu'),
                    'type'    => 'checkbox',
                    'default' => 'open',
                    'option'  => 'open'
                ),
            );
        }

        function generalSettings() {
            $settings = get_option(TLPFoodMenu()->options['settings']);

            $general = array(
                'slug'               => array(
                    'label'       => __('Food Menu (Slug)', 'tlp-food-menu'),
                    'type'        => 'slug',
                    'class'       => 'slug',
                    'attr'        => 'max="20" required="true"',
                    'value'       => (!empty($settings['slug']) ? sanitize_title_with_dashes($settings['slug']) : 'food-menu'),
                    'description' => __("This option can't be blank, must have a maximum length of 20 characters and cannot contain capital letters or spaces. <br>After each change, please resave your permalinks (Go to Dashboard > Settings > Permalinks. Click save button).",
                        "tlp-food-menu")
                ),
                'currency'           => array(
                    'label'   => __('Currency', 'tlp-food-menu'),
                    'type'    => 'select',
                    "class"   => "fmp-select2",
                    'options' => TLPFoodMenu()->getCurrencyList(),
                    'blank'   => __('Select one', 'tlp-food-menu'),
                    'value'   => (!empty($settings['currency']) ? $settings['currency'] : 'USD')
                ),
                'currency_position'  => array(
                    'label'   => __('Currency Position', 'tlp-food-menu'),
                    'type'    => 'select',
                    "class"   => "fmp-select2",
                    'options' => TLPFoodMenu()->currency_position_list(),
                    'blank'   => __('Select one', 'tlp-food-menu'),
                    'value'   => (!empty($settings['currency_position']) ? $settings['currency_position'] : 'left')
                ),
            );

            return apply_filters('fmp_general_settings', $general, $settings);
        }

        function detailPageSettings() {
            $settings = get_option(TLPFoodMenu()->options['settings']);

            $detailPageSettings = array(
                'hide_options' => array(
                    "label"     => __("Hide Options", 'tlp-food-menu'),
                    "type"      => "checkbox",
                    "multiple"  => true,
                    "alignment" => "vertical",
                    "options"   => $this->detailsPageHiddenOptions(),
                    "value"     => !empty($settings['hide_options']) ? $settings['hide_options'] : array(),
                ),
            );

            return apply_filters('fmp_detail_page_settings', $detailPageSettings, $settings);
        }

        function detailsPageHiddenOptions() {
            $options = [
                'image'       => 'Image',
                'price'       => 'Price',
            ];

            return apply_filters('tlp_fm_hidden_field_option', $options);
        }

        function promotionsFields() {
            $products = array(
                "themes" => array(
                    'food-cart' => array(
                        'price'     => 39,
                        'title'     => "FoodCart ??? Restaurant WordPress Theme",
                        'image_url' => TLPFoodMenu()->assetsUrl . 'images/food-cart.png',
                        'url'       => 'https://www.radiustheme.com/downloads/foodcart-restaurant-wordpress-theme/',
                        'demo_url'  => 'https://www.radiustheme.com/demo/wordpress/themes/foodcart/',
                        'buy_url'   => 'https://www.radiustheme.com/downloads/foodcart-restaurant-wordpress-theme/',
                        'doc_url'   => 'https://radiustheme.com/demo/wordpress/themes/foodcart/docs/'
                    ),
                    'red-chili' => array(
                        'price'     => 39,
                        'title'     => "RedChili - Restaurant WordPress Theme",
                        'image_url' => TLPFoodMenu()->assetsUrl . 'images/red-chili.png',
                        'url'       => 'https://themeforest.net/item/red-chili-restaurant-wordpress-theme/20166175',
                        'demo_url'  => 'https://radiustheme.com/demo/wordpress/redchili/',
                        'buy_url'   => 'https://themeforest.net/item/red-chili-restaurant-wordpress-theme/20166175',
                        'doc_url'   => 'https://radiustheme.com/demo/wordpress/redchili/docs/'
                    )
                ),
                "plugins" => array(
                    "food-menu-pro" => array(
                        'price'     => 19,
                        'title'     => "Food Menu PRO Plugin for WordPress",
                        'image_url' => TLPFoodMenu()->assetsUrl . 'images/food-menu-pro.png',
                        'url'       => 'https://www.radiustheme.com/downloads/food-menu-pro-wordpress/',
                        'demo_url'  => 'https://www.radiustheme.com/demo/plugins/food-menu/',
                        'buy_url'   => 'https://www.radiustheme.com/downloads/food-menu-pro-wordpress/',
                        'doc_url'   => 'https://www.radiustheme.com/docs/food-menu/getting-started/installations/'
                    )
                )
            );

            return apply_filters('tlp_fm_promotion_product_list', $products);
        }

        /**
         * Style field options
         *
         * @return array
         */
        function scStyleFields() {
            $scStyleFields = array(
                'fmp_parent_class'            => array(
                    "type"        => "text",
                    "label"       => __("Parent class", "tlp-food-menu"),
                    "class"       => "medium-text",
                    "description" => __("Parent class for adding custom css", 'tlp-food-menu')
                ),
                'fmp_button_bg_color'         => array(
                    "type"  => "colorpicker",
                    "label" => __("Button background color", "tlp-food-menu"),
                ),
                'fmp_button_text_color'       => array(
                    "type"  => "colorpicker",
                    "label" => __("Button text color", "tlp-food-menu"),
                ),
                'fmp_button_hover_bg_color'   => array(
                    "type"  => "colorpicker",
                    "label" => __("Button hover background color", "tlp-food-menu"),
                ),
                'fmp_button_hover_text_color'  => array(
                    "type"  => "colorpicker",
                    "label" => __("Button hover text color", "tlp-food-menu"),
                ),
                'fmp_button_typo'  => array(
                    "type"  => "style",
                    "label" => __("Button Typography", "tlp-food-menu"),
                ),
                'fmp_title_style'             => array(
                    'type'  => 'style',
                    'label' => __('Title', 'tlp-food-menu'),
                ),
                'fmp_price_style'             => array(
                    'type'  => 'style',
                    'label' => __('Price', 'tlp-food-menu'),
                ),
            );

            return apply_filters('fmp_sc_style', $scStyleFields);
        }

        /**
         * ShortCode Layout Options
         *
         * @return array
         */
        function scLayoutMetaFields() {

            $scLayoutMetaFields = array(
                'fmp_layout'                    => array(
                    'type'    => 'select',
                    'label'   => __('Layout', 'tlp-food-menu'),
                    'class'   => 'fmp-select2',
                    'options' => $this->scLayout()
                ),
                'fmp_desktop_column'            => array(
                    'type'    => 'select',
                    'label'   => __('Desktop column', 'tlp-food-menu'),
                    'id'      => 'fmp_column',
                    'class'   => 'fmp-select2',
                    'default' => 3,
                    'options' => $this->scColumns()
                ),
                'fmp_tab_column'                => array(
                    'type'    => 'select',
                    'label'   => __('Tab column', 'tlp-food-menu'),
                    'id'      => 'fmp_column',
                    'class'   => 'fmp-select2',
                    'default' => 2,
                    'options' => $this->scColumns()
                ),
                'fmp_mobile_column'             => array(
                    'type'    => 'select',
                    'label'   => __('Mobile column', 'tlp-food-menu'),
                    'id'      => 'fmp_column',
                    'class'   => 'fmp-select2',
                    'default' => 1,
                    'options' => $this->scColumns()
                ),
                'fmp_image_size'                => array(
                    "type"    => "select",
                    "label"   => __("Image Size", "tlp-food-menu"),
                    "class"   => "fmp-select2",
                    "options" => TLPFoodMenu()->get_image_sizes()
                ),
                'fmp_excerpt_limit'             => array(
                    "type"        => "number",
                    "label"       => __("Excerpt limit", "tlp-food-menu"),
                    "description" => __("Excerpt limit only integer number is allowed, Leave it blank for full excerpt.",
                        "tlp-food-menu")
                ),
                'fmp_detail_page_link'          => array(
                    "type"        => "checkbox",
                    "label"       => __("Detail page link", "tlp-food-menu"),
                    "optionLabel" => __("Enable", "tlp-food-menu"),
                    "default"     => 1,
                    "option"      => 1
                ),
            );

            return apply_filters('fmp_sc_layout_settings', $scLayoutMetaFields);
        }

        function imageCropType() {
            return array(
                'soft' => __("Soft Crop", 'tlp-food-menu'),
                'hard' => __("Hard Crop", 'tlp-food-menu')
            );
        }


        /**
         * Layout array
         *
         * @return array
         */
        public function scLayout() {
            $layouts = array(
                'layout-free'      => __('Layout (Free)', 'tlp-food-menu'),
                'grid-by-cat-free' => __('Grid By Category (Free)', 'tlp-food-menu'),
            );

            return apply_filters('fmp_sc_layouts', $layouts);
        }

        /**
         * Column Options
         *
         * @return array
         */
        function scColumns() {
            $coumns = array(
                1 => __("1 Column", 'tlp-food-menu'),
                2 => __("2 Column", 'tlp-food-menu'),
                3 => __("3 Column", 'tlp-food-menu'),
                4 => __("4 Column", 'tlp-food-menu'),
                6 => __("6 Column", 'tlp-food-menu'),
            );

            return apply_filters('fmp_sc_columns', $coumns);
        }

        /**
         * Filter Options
         *
         * @return array
         */
        function scFilterMetaFields() {

            $scFilterMetaFields = array(
                'fmp_source'       => array(
                    "label"       => __("Food item data source", 'tlp-food-menu'),
                    "type"        => "radio",
                    "options"     => $this->scProductSource(),
                    "default"     => TLPFoodMenu()->post_type,
                    "alignment"   => "vertical",
                    "description" => __('Please select a food item data source', 'tlp-food-menu')
                ),
                'fmp_post__in'     => array(
                    "label"       => __("Include only", 'tlp-food-menu'),
                    "type"        => "text",
                    "class"       => "full",
                    "description" => __('List of post IDs to show (comma-separated values, for example: 1,2,3)',
                        'tlp-food-menu')
                ),
                'fmp_post__not_in' => array(
                    "label"       => __("Exclude", 'tlp-food-menu'),
                    "type"        => "text",
                    "class"       => "full",
                    "description" => __('List of post IDs to show (comma-separated values, for example: 1,2,3)',
                        'tlp-food-menu')
                ),
                'fmp_limit'        => array(
                    "label"       => __("Limit", 'tlp-food-menu'),
                    "type"        => "number",
                    "class"       => "full",
                    "description" => __('The number of posts to show. Set empty to show all found posts.',
                        'tlp-food-menu')
                ),
                'fmp_categories'   => array(
                    "label"       => __("Categories", 'tlp-food-menu'),
                    "type"        => "select",
                    "class"       => "fmp-select2",
                    "multiple"    => true,
                    "description" => __('Select the category you want to filter, Leave it blank for All category',
                        'tlp-food-menu'),
                    "options"     => TLPFoodMenu()->getAllFmpCategoryList()
                ),
                'fmp_order_by'     => array(
                    "label"   => __("Order By", 'tlp-food-menu'),
                    "type"    => "select",
                    "class"   => "fmp-select2",
                    "default" => "date",
                    "options" => $this->scOrderBy()
                ),
                'fmp_order'        => array(
                    "label"     => __("Order", 'tlp-food-menu'),
                    "type"      => "radio",
                    "options"   => $this->scOrder(),
                    "default"   => "DESC",
                    "alignment" => "vertical",
                ),
            );

            return apply_filters('fmp_sc_filtering', $scFilterMetaFields);
        }


        function fmpCatOperators() {
            return array(
                'IN'         => __("IN ??? show posts which associate with one or more of selected terms",
                    'tlp-food-menu'),
                'NOT IN'     => __("NOT IN ??? show posts which do not associate with any of selected terms",
                    'tlp-food-menu'),
                'AND'        => __("AND ??? show posts which associate with all of selected terms", 'tlp-food-menu'),
                'EXISTS'     => __("EXISTS ???", 'tlp-food-menu'),
                'NOT EXISTS' => __("NOT EXISTS ???", 'tlp-food-menu'),
            );
        }

        /**
         * Order By Options
         *
         * @return array
         */
        private function scOrderBy() {
            $order_by = array(
                'menu_order' => __("Menu Order", 'tlp-food-menu'),
                'title'      => __("Name", 'tlp-food-menu'),
                'date'       => __("Date", 'tlp-food-menu'),
                'price'      => __("Price", 'tlp-food-menu'),
                'ID'         => __("ID", 'tlp-food-menu'),
            );

            return apply_filters('fmp_sc_order_by', $order_by);
        }

        /**
         * Order Options
         *
         * @return array
         */
        private function scOrder() {
            return array(
                'ASC'  => __("Ascending", 'tlp-food-menu'),
                'DESC' => __("Descending", 'tlp-food-menu'),
            );
        }

        function scProductSource() {
            $source = array(
                TLPFoodMenu()->post_type => __("Food Menu", 'tlp-food-menu')
            );

            if (TLPFoodMenu()->isWcActive()) {
                $source['product'] = __("WooCommerce", 'tlp-food-menu');
            }

            return apply_filters('fmp_product_src', $source);
        }


        function currency_position_list() {
            return array(
                'left'        => __('Left (??99.99)', 'tlp-food-menu'),
                'right'       => __('Right (99.99??)', 'tlp-food-menu'),
                'left_space'  => __('Left with space (?? 99.99)', 'tlp-food-menu'),
                'right_space' => __('Right with space (99.99 ??)', 'tlp-food-menu')
            );
        }


        function col_lists() {
            return array(
                2 => __('Display in 2 column', 'tlp-food-menu'),
                1 => __('Display in 1 column', 'tlp-food-menu')
            );
        }

        function currency_list() {
            return array(
                'AED' => array(
                    'code'           => 'AED',
                    'symbol'         => '??.??',
                    'name'           => 'United Arab Emirates Dirham',
                    'numeric_code'   => '784',
                    'code_placement' => 'before',
                    'minor_unit'     => 'Fils',
                    'major_unit'     => 'Dirham',
                ),
                'AFN' => array(
                    'code'         => 'AFN',
                    'symbol'       => 'Af',
                    'name'         => 'Afghan Afghani',
                    'decimals'     => 0,
                    'numeric_code' => '971',
                    'minor_unit'   => 'Pul',
                    'major_unit'   => 'Afghani',
                ),
                'ANG' => array(
                    'code'         => 'ANG',
                    'symbol'       => 'NAf.',
                    'name'         => 'Netherlands Antillean Guilder',
                    'numeric_code' => '532',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Guilder',
                ),
                'AOA' => array(
                    'code'         => 'AOA',
                    'symbol'       => 'Kz',
                    'name'         => 'Angolan Kwanza',
                    'numeric_code' => '973',
                    'minor_unit'   => 'C??ntimo',
                    'major_unit'   => 'Kwanza',
                ),
                'ARM' => array(
                    'code'       => 'ARM',
                    'symbol'     => 'm$n',
                    'name'       => 'Argentine Peso Moneda Nacional',
                    'minor_unit' => 'Centavos',
                    'major_unit' => 'Peso',
                ),
                'ARS' => array(
                    'code'         => 'ARS',
                    'symbol'       => 'AR$',
                    'name'         => 'Argentine Peso',
                    'numeric_code' => '032',
                    'minor_unit'   => 'Centavo',
                    'major_unit'   => 'Peso',
                ),
                'AUD' => array(
                    'code'             => 'AUD',
                    'symbol'           => '$',
                    'name'             => 'Australian Dollar',
                    'numeric_code'     => '036',
                    'symbol_placement' => 'before',
                    'minor_unit'       => 'Cent',
                    'major_unit'       => 'Dollar',
                ),
                'AWG' => array(
                    'code'         => 'AWG',
                    'symbol'       => 'Afl.',
                    'name'         => 'Aruban Florin',
                    'numeric_code' => '533',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Guilder',
                ),
                'AZN' => array(
                    'code'       => 'AZN',
                    'symbol'     => 'man.',
                    'name'       => 'Azerbaijanian Manat',
                    'minor_unit' => 'Q??pik',
                    'major_unit' => 'New Manat',
                ),
                'BAM' => array(
                    'code'         => 'BAM',
                    'symbol'       => 'KM',
                    'name'         => 'Bosnia-Herzegovina Convertible Mark',
                    'numeric_code' => '977',
                    'minor_unit'   => 'Fening',
                    'major_unit'   => 'Convertible Marka',
                ),
                'BBD' => array(
                    'code'         => 'BBD',
                    'symbol'       => 'Bds$',
                    'name'         => 'Barbadian Dollar',
                    'numeric_code' => '052',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Dollar',
                ),
                'BDT' => array(
                    'code'         => 'BDT',
                    'symbol'       => 'Tk',
                    'name'         => 'Bangladeshi Taka',
                    'numeric_code' => '050',
                    'minor_unit'   => 'Paisa',
                    'major_unit'   => 'Taka',
                ),
                'BGN' => array(
                    'code'                => 'BGN',
                    'symbol'              => '????',
                    'name'                => 'Bulgarian lev',
                    'thousands_separator' => ' ',
                    'decimal_separator'   => ',',
                    'symbol_placement'    => 'after',
                    'code_placement'      => 'hidden',
                    'numeric_code'        => '975',
                    'minor_unit'          => 'Stotinka',
                    'major_unit'          => 'Lev',
                ),
                'BHD' => array(
                    'code'         => 'BHD',
                    'symbol'       => 'BD',
                    'name'         => 'Bahraini Dinar',
                    'decimals'     => 3,
                    'numeric_code' => '048',
                    'minor_unit'   => 'Fils',
                    'major_unit'   => 'Dinar',
                ),
                'BIF' => array(
                    'code'         => 'BIF',
                    'symbol'       => 'FBu',
                    'name'         => 'Burundian Franc',
                    'decimals'     => 0,
                    'numeric_code' => '108',
                    'minor_unit'   => 'Centime',
                    'major_unit'   => 'Franc',
                ),
                'BMD' => array(
                    'code'         => 'BMD',
                    'symbol'       => 'BD$',
                    'name'         => 'Bermudan Dollar',
                    'numeric_code' => '060',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Dollar',
                ),
                'BND' => array(
                    'code'         => 'BND',
                    'symbol'       => 'BN$',
                    'name'         => 'Brunei Dollar',
                    'numeric_code' => '096',
                    'minor_unit'   => 'Sen',
                    'major_unit'   => 'Dollar',
                ),
                'BOB' => array(
                    'code'         => 'BOB',
                    'symbol'       => 'Bs',
                    'name'         => 'Bolivian Boliviano',
                    'numeric_code' => '068',
                    'minor_unit'   => 'Centavo',
                    'major_unit'   => 'Bolivianos',
                ),
                'BRL' => array(
                    'code'                => 'BRL',
                    'symbol'              => 'R$',
                    'name'                => 'Brazilian Real',
                    'numeric_code'        => '986',
                    'symbol_placement'    => 'before',
                    'code_placement'      => 'hidden',
                    'thousands_separator' => '.',
                    'decimal_separator'   => ',',
                    'minor_unit'          => 'Centavo',
                    'major_unit'          => 'Reais',
                ),
                'BSD' => array(
                    'code'         => 'BSD',
                    'symbol'       => 'BS$',
                    'name'         => 'Bahamian Dollar',
                    'numeric_code' => '044',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Dollar',
                ),
                'BTN' => array(
                    'code'         => 'BTN',
                    'symbol'       => 'Nu.',
                    'name'         => 'Bhutanese Ngultrum',
                    'numeric_code' => '064',
                    'minor_unit'   => 'Chetrum',
                    'major_unit'   => 'Ngultrum',
                ),
                'BWP' => array(
                    'code'         => 'BWP',
                    'symbol'       => 'BWP',
                    'name'         => 'Botswanan Pula',
                    'numeric_code' => '072',
                    'minor_unit'   => 'Thebe',
                    'major_unit'   => 'Pulas',
                ),
                'BYR' => array(
                    'code'                => 'BYR',
                    'symbol'              => '??????.',
                    'name'                => 'Belarusian ruble',
                    'numeric_code'        => '974',
                    'symbol_placement'    => 'after',
                    'code_placement'      => 'hidden',
                    'decimals'            => 0,
                    'thousands_separator' => ' ',
                    'major_unit'          => 'Ruble',
                ),
                'BZD' => array(
                    'code'         => 'BZD',
                    'symbol'       => 'BZ$',
                    'name'         => 'Belize Dollar',
                    'numeric_code' => '084',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Dollar',
                ),
                'CAD' => array(
                    'code'         => 'CAD',
                    'symbol'       => 'CA$',
                    'name'         => 'Canadian Dollar',
                    'numeric_code' => '124',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Dollar',
                ),
                'CDF' => array(
                    'code'         => 'CDF',
                    'symbol'       => 'CDF',
                    'name'         => 'Congolese Franc',
                    'numeric_code' => '976',
                    'minor_unit'   => 'Centime',
                    'major_unit'   => 'Franc',
                ),
                'CHF' => array(
                    'code'          => 'CHF',
                    'symbol'        => 'Fr.',
                    'name'          => 'Swiss Franc',
                    'rounding_step' => '0.05',
                    'numeric_code'  => '756',
                    'minor_unit'    => 'Rappen',
                    'major_unit'    => 'Franc',
                ),
                'CLP' => array(
                    'code'         => 'CLP',
                    'symbol'       => 'CL$',
                    'name'         => 'Chilean Peso',
                    'decimals'     => 0,
                    'numeric_code' => '152',
                    'minor_unit'   => 'Centavo',
                    'major_unit'   => 'Peso',
                ),
                'CNY' => array(
                    'code'                => 'CNY',
                    'symbol'              => '??',
                    'name'                => 'Chinese Yuan Renminbi',
                    'numeric_code'        => '156',
                    'symbol_placement'    => 'before',
                    'code_placement'      => 'hidden',
                    'thousands_separator' => '',
                    'minor_unit'          => 'Fen',
                    'major_unit'          => 'Yuan',
                ),
                'COP' => array(
                    'code'                => 'COP',
                    'symbol'              => '$',
                    'name'                => 'Colombian Peso',
                    'decimals'            => 0,
                    'numeric_code'        => '170',
                    'symbol_placement'    => 'before',
                    'code_placement'      => 'hidden',
                    'thousands_separator' => '.',
                    'decimal_separator'   => ',',
                    'minor_unit'          => 'Centavo',
                    'major_unit'          => 'Peso',
                ),
                'CRC' => array(
                    'code'         => 'CRC',
                    'symbol'       => '??',
                    'name'         => 'Costa Rican Col??n',
                    'decimals'     => 0,
                    'numeric_code' => '188',
                    'minor_unit'   => 'C??ntimo',
                    'major_unit'   => 'Col??n',
                ),
                'CUC' => array(
                    'code'       => 'CUC',
                    'symbol'     => 'CUC$',
                    'name'       => 'Cuban Convertible Peso',
                    'minor_unit' => 'Centavo',
                    'major_unit' => 'Peso',
                ),
                'CUP' => array(
                    'code'         => 'CUP',
                    'symbol'       => 'CU$',
                    'name'         => 'Cuban Peso',
                    'numeric_code' => '192',
                    'minor_unit'   => 'Centavo',
                    'major_unit'   => 'Peso',
                ),
                'CVE' => array(
                    'code'         => 'CVE',
                    'symbol'       => 'CV$',
                    'name'         => 'Cape Verdean Escudo',
                    'numeric_code' => '132',
                    'minor_unit'   => 'Centavo',
                    'major_unit'   => 'Escudo',
                ),
                'CZK' => array(
                    'code'                => 'CZK',
                    'symbol'              => 'K??',
                    'name'                => 'Czech Republic Koruna',
                    'numeric_code'        => '203',
                    'thousands_separator' => ' ',
                    'decimal_separator'   => ',',
                    'symbol_placement'    => 'after',
                    'code_placement'      => 'hidden',
                    'minor_unit'          => 'Hal????',
                    'major_unit'          => 'Koruna',
                ),
                'DJF' => array(
                    'code'         => 'DJF',
                    'symbol'       => 'Fdj',
                    'name'         => 'Djiboutian Franc',
                    'numeric_code' => '262',
                    'decimals'     => 0,
                    'minor_unit'   => 'Centime',
                    'major_unit'   => 'Franc',
                ),
                'DKK' => array(
                    'code'                => 'DKK',
                    'symbol'              => 'kr.',
                    'name'                => 'Danish Krone',
                    'numeric_code'        => '208',
                    'thousands_separator' => ' ',
                    'decimal_separator'   => ',',
                    'symbol_placement'    => 'after',
                    'code_placement'      => 'hidden',
                    'minor_unit'          => '??re',
                    'major_unit'          => 'Kroner',
                ),
                'DOP' => array(
                    'code'         => 'DOP',
                    'symbol'       => 'RD$',
                    'name'         => 'Dominican Peso',
                    'numeric_code' => '214',
                    'minor_unit'   => 'Centavo',
                    'major_unit'   => 'Peso',
                ),
                'DZD' => array(
                    'code'         => 'DZD',
                    'symbol'       => 'DA',
                    'name'         => 'Algerian Dinar',
                    'numeric_code' => '012',
                    'minor_unit'   => 'Santeem',
                    'major_unit'   => 'Dinar',
                ),
                'EEK' => array(
                    'code'                => 'EEK',
                    'symbol'              => 'Ekr',
                    'name'                => 'Estonian Kroon',
                    'thousands_separator' => ' ',
                    'decimal_separator'   => ',',
                    'numeric_code'        => '233',
                    'minor_unit'          => 'Sent',
                    'major_unit'          => 'Krooni',
                ),
                'EGP' => array(
                    'code'         => 'EGP',
                    'symbol'       => 'EG??',
                    'name'         => 'Egyptian Pound',
                    'numeric_code' => '818',
                    'minor_unit'   => 'Piastr',
                    'major_unit'   => 'Pound',
                ),
                'ERN' => array(
                    'code'         => 'ERN',
                    'symbol'       => 'Nfk',
                    'name'         => 'Eritrean Nakfa',
                    'numeric_code' => '232',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Nakfa',
                ),
                'ETB' => array(
                    'code'         => 'ETB',
                    'symbol'       => 'Br',
                    'name'         => 'Ethiopian Birr',
                    'numeric_code' => '230',
                    'minor_unit'   => 'Santim',
                    'major_unit'   => 'Birr',
                ),
                'EUR' => array(
                    'code'                => 'EUR',
                    'symbol'              => '???',
                    'name'                => 'Euro',
                    'thousands_separator' => ' ',
                    'decimal_separator'   => ',',
                    'symbol_placement'    => 'after',
                    'code_placement'      => 'hidden',
                    'numeric_code'        => '978',
                    'minor_unit'          => 'Cent',
                    'major_unit'          => 'Euro',
                ),
                'FJD' => array(
                    'code'         => 'FJD',
                    'symbol'       => 'FJ$',
                    'name'         => 'Fijian Dollar',
                    'numeric_code' => '242',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Dollar',
                ),
                'FKP' => array(
                    'code'         => 'FKP',
                    'symbol'       => 'FK??',
                    'name'         => 'Falkland Islands Pound',
                    'numeric_code' => '238',
                    'minor_unit'   => 'Penny',
                    'major_unit'   => 'Pound',
                ),
                'GBP' => array(
                    'code'             => 'GBP',
                    'symbol'           => '??',
                    'name'             => 'British Pound Sterling',
                    'numeric_code'     => '826',
                    'symbol_placement' => 'before',
                    'code_placement'   => 'hidden',
                    'minor_unit'       => 'Penny',
                    'major_unit'       => 'Pound',
                ),
                'GHS' => array(
                    'code'       => 'GHS',
                    'symbol'     => 'GH???',
                    'name'       => 'Ghanaian Cedi',
                    'minor_unit' => 'Pesewa',
                    'major_unit' => 'Cedi',
                ),
                'GIP' => array(
                    'code'         => 'GIP',
                    'symbol'       => 'GI??',
                    'name'         => 'Gibraltar Pound',
                    'numeric_code' => '292',
                    'minor_unit'   => 'Penny',
                    'major_unit'   => 'Pound',
                ),
                'GMD' => array(
                    'code'         => 'GMD',
                    'symbol'       => 'GMD',
                    'name'         => 'Gambian Dalasi',
                    'numeric_code' => '270',
                    'minor_unit'   => 'Butut',
                    'major_unit'   => 'Dalasis',
                ),
                'GNF' => array(
                    'code'         => 'GNF',
                    'symbol'       => 'FG',
                    'name'         => 'Guinean Franc',
                    'decimals'     => 0,
                    'numeric_code' => '324',
                    'minor_unit'   => 'Centime',
                    'major_unit'   => 'Franc',
                ),
                'GTQ' => array(
                    'code'         => 'GTQ',
                    'symbol'       => 'GTQ',
                    'name'         => 'Guatemalan Quetzal',
                    'numeric_code' => '320',
                    'minor_unit'   => 'Centavo',
                    'major_unit'   => 'Quetzales',
                ),
                'GYD' => array(
                    'code'         => 'GYD',
                    'symbol'       => 'GY$',
                    'name'         => 'Guyanaese Dollar',
                    'decimals'     => 0,
                    'numeric_code' => '328',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Dollar',
                ),
                'HKD' => array(
                    'code'             => 'HKD',
                    'symbol'           => 'HK$',
                    'name'             => 'Hong Kong Dollar',
                    'numeric_code'     => '344',
                    'symbol_placement' => 'before',
                    'code_placement'   => 'hidden',
                    'minor_unit'       => 'Cent',
                    'major_unit'       => 'Dollar',
                ),
                'HNL' => array(
                    'code'         => 'HNL',
                    'symbol'       => 'HNL',
                    'name'         => 'Honduran Lempira',
                    'numeric_code' => '340',
                    'minor_unit'   => 'Centavo',
                    'major_unit'   => 'Lempiras',
                ),
                'HRK' => array(
                    'code'         => 'HRK',
                    'symbol'       => 'kn',
                    'name'         => 'Croatian Kuna',
                    'numeric_code' => '191',
                    'minor_unit'   => 'Lipa',
                    'major_unit'   => 'Kuna',
                ),
                'HTG' => array(
                    'code'         => 'HTG',
                    'symbol'       => 'HTG',
                    'name'         => 'Haitian Gourde',
                    'numeric_code' => '332',
                    'minor_unit'   => 'Centime',
                    'major_unit'   => 'Gourde',
                ),
                'HUF' => array(
                    'code'                => 'HUF',
                    'symbol'              => 'Ft',
                    'name'                => 'Hungarian Forint',
                    'numeric_code'        => '348',
                    'decimal_separator'   => ',',
                    'thousands_separator' => ' ',
                    'decimals'            => 0,
                    'symbol_placement'    => 'after',
                    'code_placement'      => 'hidden',
                    'major_unit'          => 'Forint',
                ),
                'IDR' => array(
                    'code'         => 'IDR',
                    'symbol'       => 'Rp',
                    'name'         => 'Indonesian Rupiah',
                    'decimals'     => 0,
                    'numeric_code' => '360',
                    'minor_unit'   => 'Sen',
                    'major_unit'   => 'Rupiahs',
                ),
                'ILS' => array(
                    'code'             => 'ILS',
                    'symbol'           => '???',
                    'name'             => 'Israeli New Shekel',
                    'numeric_code'     => '376',
                    'symbol_placement' => 'before',
                    'code_placement'   => 'hidden',
                    'minor_unit'       => 'Agora',
                    'major_unit'       => 'New Shekels',
                ),
                'INR' => array(
                    'code'         => 'INR',
                    'symbol'       => 'Rs',
                    'name'         => 'Indian Rupee',
                    'numeric_code' => '356',
                    'minor_unit'   => 'Paisa',
                    'major_unit'   => 'Rupee',
                ),
                'IRR' => array(
                    'code'             => 'IRR',
                    'symbol'           => '???',
                    'name'             => 'Iranian Rial',
                    'numeric_code'     => '364',
                    'symbol_placement' => 'after',
                    'code_placement'   => 'hidden',
                    'minor_unit'       => 'Rial',
                    'major_unit'       => 'Toman',
                ),
                'ISK' => array(
                    'code'                => 'ISK',
                    'symbol'              => 'Ikr',
                    'name'                => 'Icelandic Kr??na',
                    'decimals'            => 0,
                    'thousands_separator' => ' ',
                    'numeric_code'        => '352',
                    'minor_unit'          => 'Eyrir',
                    'major_unit'          => 'Kronur',
                ),
                'JMD' => array(
                    'code'             => 'JMD',
                    'symbol'           => 'J$',
                    'name'             => 'Jamaican Dollar',
                    'numeric_code'     => '388',
                    'symbol_placement' => 'before',
                    'code_placement'   => 'hidden',
                    'minor_unit'       => 'Cent',
                    'major_unit'       => 'Dollar',
                ),
                'JOD' => array(
                    'code'         => 'JOD',
                    'symbol'       => 'JD',
                    'name'         => 'Jordanian Dinar',
                    'decimals'     => 3,
                    'numeric_code' => '400',
                    'minor_unit'   => 'Piastr',
                    'major_unit'   => 'Dinar',
                ),
                'JPY' => array(
                    'code'             => 'JPY',
                    'symbol'           => '??',
                    'name'             => 'Japanese Yen',
                    'decimals'         => 0,
                    'numeric_code'     => '392',
                    'symbol_placement' => 'before',
                    'code_placement'   => 'hidden',
                    'minor_unit'       => 'Sen',
                    'major_unit'       => 'Yen',
                ),
                'KES' => array(
                    'code'         => 'KES',
                    'symbol'       => 'Ksh',
                    'name'         => 'Kenyan Shilling',
                    'numeric_code' => '404',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Shilling',
                ),
                'KGS' => array(
                    'code'                => 'KGS',
                    'code_placement'      => 'hidden',
                    'symbol'              => '??????',
                    'symbol_placement'    => 'after',
                    'name'                => 'Kyrgyzstani Som',
                    'numeric_code'        => '417',
                    'thousands_separator' => '',
                    'major_unit'          => 'Som',
                    'minor_unit'          => 'Tyiyn',
                ),
                'KMF' => array(
                    'code'         => 'KMF',
                    'symbol'       => 'CF',
                    'name'         => 'Comorian Franc',
                    'decimals'     => 0,
                    'numeric_code' => '174',
                    'minor_unit'   => 'Centime',
                    'major_unit'   => 'Franc',
                ),
                'KRW' => array(
                    'code'         => 'KRW',
                    'symbol'       => '???',
                    'name'         => 'South Korean Won',
                    'decimals'     => 0,
                    'numeric_code' => '410',
                    'minor_unit'   => 'Jeon',
                    'major_unit'   => 'Won',
                ),
                'KWD' => array(
                    'code'         => 'KWD',
                    'symbol'       => 'KD',
                    'name'         => 'Kuwaiti Dinar',
                    'decimals'     => 3,
                    'numeric_code' => '414',
                    'minor_unit'   => 'Fils',
                    'major_unit'   => 'Dinar',
                ),
                'KYD' => array(
                    'code'         => 'KYD',
                    'symbol'       => 'KY$',
                    'name'         => 'Cayman Islands Dollar',
                    'numeric_code' => '136',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Dollar',
                ),
                'KZT' => array(
                    'code'                => 'KZT',
                    'symbol'              => '????.',
                    'name'                => 'Kazakhstani tenge',
                    'numeric_code'        => '398',
                    'thousands_separator' => ' ',
                    'decimal_separator'   => ',',
                    'symbol_placement'    => 'after',
                    'code_placement'      => 'hidden',
                    'minor_unit'          => 'Tiyn',
                    'major_unit'          => 'Tenge',
                ),
                'LAK' => array(
                    'code'         => 'LAK',
                    'symbol'       => '???N',
                    'name'         => 'Laotian Kip',
                    'decimals'     => 0,
                    'numeric_code' => '418',
                    'minor_unit'   => 'Att',
                    'major_unit'   => 'Kips',
                ),
                'LBP' => array(
                    'code'         => 'LBP',
                    'symbol'       => 'LB??',
                    'name'         => 'Lebanese Pound',
                    'decimals'     => 0,
                    'numeric_code' => '422',
                    'minor_unit'   => 'Piastre',
                    'major_unit'   => 'Pound',
                ),
                'LKR' => array(
                    'code'         => 'LKR',
                    'symbol'       => 'SLRs',
                    'name'         => 'Sri Lanka Rupee',
                    'numeric_code' => '144',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Rupee',
                ),
                'LRD' => array(
                    'code'         => 'LRD',
                    'symbol'       => 'L$',
                    'name'         => 'Liberian Dollar',
                    'numeric_code' => '430',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Dollar',
                ),
                'LSL' => array(
                    'code'         => 'LSL',
                    'symbol'       => 'LSL',
                    'name'         => 'Lesotho Loti',
                    'numeric_code' => '426',
                    'minor_unit'   => 'Sente',
                    'major_unit'   => 'Loti',
                ),
                'LTL' => array(
                    'code'         => 'LTL',
                    'symbol'       => 'Lt',
                    'name'         => 'Lithuanian Litas',
                    'numeric_code' => '440',
                    'minor_unit'   => 'Centas',
                    'major_unit'   => 'Litai',
                ),
                'LVL' => array(
                    'code'         => 'LVL',
                    'symbol'       => 'Ls',
                    'name'         => 'Latvian Lats',
                    'numeric_code' => '428',
                    'minor_unit'   => 'Santims',
                    'major_unit'   => 'Lati',
                ),
                'LYD' => array(
                    'code'         => 'LYD',
                    'symbol'       => 'LD',
                    'name'         => 'Libyan Dinar',
                    'decimals'     => 3,
                    'numeric_code' => '434',
                    'minor_unit'   => 'Dirham',
                    'major_unit'   => 'Dinar',
                ),
                'MAD' => array(
                    'code'             => 'MAD',
                    'symbol'           => ' Dhs',
                    'name'             => 'Moroccan Dirham',
                    'numeric_code'     => '504',
                    'symbol_placement' => 'after',
                    'code_placement'   => 'hidden',
                    'minor_unit'       => 'Santimat',
                    'major_unit'       => 'Dirhams',
                ),
                'MDL' => array(
                    'code'             => 'MDL',
                    'symbol'           => 'MDL',
                    'name'             => 'Moldovan leu',
                    'symbol_placement' => 'after',
                    'numeric_code'     => '498',
                    'code_placement'   => 'hidden',
                    'minor_unit'       => 'bani',
                    'major_unit'       => 'Lei',
                ),
                'MMK' => array(
                    'code'         => 'MMK',
                    'symbol'       => 'MMK',
                    'name'         => 'Myanma Kyat',
                    'decimals'     => 0,
                    'numeric_code' => '104',
                    'minor_unit'   => 'Pya',
                    'major_unit'   => 'Kyat',
                ),
                'MNT' => array(
                    'code'         => 'MNT',
                    'symbol'       => '???',
                    'name'         => 'Mongolian Tugrik',
                    'decimals'     => 0,
                    'numeric_code' => '496',
                    'minor_unit'   => 'M??ng??',
                    'major_unit'   => 'Tugriks',
                ),
                'MOP' => array(
                    'code'         => 'MOP',
                    'symbol'       => 'MOP$',
                    'name'         => 'Macanese Pataca',
                    'numeric_code' => '446',
                    'minor_unit'   => 'Avo',
                    'major_unit'   => 'Pataca',
                ),
                'MRO' => array(
                    'code'         => 'MRO',
                    'symbol'       => 'UM',
                    'name'         => 'Mauritanian Ouguiya',
                    'decimals'     => 0,
                    'numeric_code' => '478',
                    'minor_unit'   => 'Khoums',
                    'major_unit'   => 'Ouguiya',
                ),
                'MTP' => array(
                    'code'       => 'MTP',
                    'symbol'     => 'MT??',
                    'name'       => 'Maltese Pound',
                    'minor_unit' => 'Shilling',
                    'major_unit' => 'Pound',
                ),
                'MUR' => array(
                    'code'         => 'MUR',
                    'symbol'       => 'MURs',
                    'name'         => 'Mauritian Rupee',
                    'decimals'     => 0,
                    'numeric_code' => '480',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Rupee',
                ),
                'MXN' => array(
                    'code'             => 'MXN',
                    'symbol'           => '$',
                    'name'             => 'Mexican Peso',
                    'numeric_code'     => '484',
                    'symbol_placement' => 'before',
                    'code_placement'   => 'hidden',
                    'minor_unit'       => 'Centavo',
                    'major_unit'       => 'Peso',
                ),
                'MYR' => array(
                    'code'             => 'MYR',
                    'symbol'           => 'RM',
                    'name'             => 'Malaysian Ringgit',
                    'numeric_code'     => '458',
                    'symbol_placement' => 'before',
                    'code_placement'   => 'hidden',
                    'minor_unit'       => 'Sen',
                    'major_unit'       => 'Ringgits',
                ),
                'MZN' => array(
                    'code'       => 'MZN',
                    'symbol'     => 'MTn',
                    'name'       => 'Mozambican Metical',
                    'minor_unit' => 'Centavo',
                    'major_unit' => 'Metical',
                ),
                'NAD' => array(
                    'code'         => 'NAD',
                    'symbol'       => 'N$',
                    'name'         => 'Namibian Dollar',
                    'numeric_code' => '516',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Dollar',
                ),
                'NGN' => array(
                    'code'         => 'NGN',
                    'symbol'       => '???',
                    'name'         => 'Nigerian Naira',
                    'numeric_code' => '566',
                    'minor_unit'   => 'Kobo',
                    'major_unit'   => 'Naira',
                ),
                'NIO' => array(
                    'code'         => 'NIO',
                    'symbol'       => 'C$',
                    'name'         => 'Nicaraguan Cordoba Oro',
                    'numeric_code' => '558',
                    'minor_unit'   => 'Centavo',
                    'major_unit'   => 'Cordoba',
                ),
                'NOK' => array(
                    'code'                => 'NOK',
                    'symbol'              => 'Nkr',
                    'name'                => 'Norwegian Krone',
                    'thousands_separator' => ' ',
                    'decimal_separator'   => ',',
                    'numeric_code'        => '578',
                    'minor_unit'          => '??re',
                    'major_unit'          => 'Krone',
                ),
                'NPR' => array(
                    'code'         => 'NPR',
                    'symbol'       => 'NPRs',
                    'name'         => 'Nepalese Rupee',
                    'numeric_code' => '524',
                    'minor_unit'   => 'Paisa',
                    'major_unit'   => 'Rupee',
                ),
                'NZD' => array(
                    'code'         => 'NZD',
                    'symbol'       => 'NZ$',
                    'name'         => 'New Zealand Dollar',
                    'numeric_code' => '554',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Dollar',
                ),
                'PAB' => array(
                    'code'         => 'PAB',
                    'symbol'       => 'B/.',
                    'name'         => 'Panamanian Balboa',
                    'numeric_code' => '590',
                    'minor_unit'   => 'Cent??simo',
                    'major_unit'   => 'Balboa',
                ),
                'PEN' => array(
                    'code'             => 'PEN',
                    'symbol'           => 'S/.',
                    'name'             => 'Peruvian Nuevo Sol',
                    'numeric_code'     => '604',
                    'symbol_placement' => 'before',
                    'code_placement'   => 'hidden',
                    'minor_unit'       => 'C??ntimo',
                    'major_unit'       => 'Nuevos Sole',
                ),
                'PGK' => array(
                    'code'         => 'PGK',
                    'symbol'       => 'PGK',
                    'name'         => 'Papua New Guinean Kina',
                    'numeric_code' => '598',
                    'minor_unit'   => 'Toea',
                    'major_unit'   => 'Kina ',
                ),
                'PHP' => array(
                    'code'         => 'PHP',
                    'symbol'       => '???',
                    'name'         => 'Philippine Peso',
                    'numeric_code' => '608',
                    'minor_unit'   => 'Centavo',
                    'major_unit'   => 'Peso',
                ),
                'PKR' => array(
                    'code'         => 'PKR',
                    'symbol'       => 'PKRs',
                    'name'         => 'Pakistani Rupee',
                    'decimals'     => 0,
                    'numeric_code' => '586',
                    'minor_unit'   => 'Paisa',
                    'major_unit'   => 'Rupee',
                ),
                'PLN' => array(
                    'code'                => 'PLN',
                    'symbol'              => 'z??',
                    'name'                => 'Polish Z??oty',
                    'decimal_separator'   => ',',
                    'thousands_separator' => ' ',
                    'numeric_code'        => '985',
                    'symbol_placement'    => 'after',
                    'code_placement'      => 'hidden',
                    'minor_unit'          => 'Grosz',
                    'major_unit'          => 'Z??otych',
                ),
                'PYG' => array(
                    'code'         => 'PYG',
                    'symbol'       => '???',
                    'name'         => 'Paraguayan Guarani',
                    'decimals'     => 0,
                    'numeric_code' => '600',
                    'minor_unit'   => 'C??ntimo',
                    'major_unit'   => 'Guarani',
                ),
                'QAR' => array(
                    'code'         => 'QAR',
                    'symbol'       => 'QR',
                    'name'         => 'Qatari Rial',
                    'numeric_code' => '634',
                    'minor_unit'   => 'Dirham',
                    'major_unit'   => 'Rial',
                ),
                'RHD' => array(
                    'code'       => 'RHD',
                    'symbol'     => 'RH$',
                    'name'       => 'Rhodesian Dollar',
                    'minor_unit' => 'Cent',
                    'major_unit' => 'Dollar',
                ),
                'RON' => array(
                    'code'       => 'RON',
                    'symbol'     => 'RON',
                    'name'       => 'Romanian Leu',
                    'minor_unit' => 'Ban',
                    'major_unit' => 'Leu',
                ),
                'RSD' => array(
                    'code'       => 'RSD',
                    'symbol'     => 'din.',
                    'name'       => 'Serbian Dinar',
                    'decimals'   => 0,
                    'minor_unit' => 'Para',
                    'major_unit' => 'Dinars',
                ),
                'RUB' => array(
                    'code'                => 'RUB',
                    'symbol'              => '??????.',
                    'name'                => 'Russian Ruble',
                    'thousands_separator' => ' ',
                    'decimal_separator'   => ',',
                    'numeric_code'        => '643',
                    'symbol_placement'    => 'after',
                    'code_placement'      => 'hidden',
                    'minor_unit'          => 'Kopek',
                    'major_unit'          => 'Ruble',
                ),
                'SAR' => array(
                    'code'         => 'SAR',
                    'symbol'       => 'SR',
                    'name'         => 'Saudi Riyal',
                    'numeric_code' => '682',
                    'minor_unit'   => 'Hallallah',
                    'major_unit'   => 'Riyals',
                ),
                'SBD' => array(
                    'code'         => 'SBD',
                    'symbol'       => 'SI$',
                    'name'         => 'Solomon Islands Dollar',
                    'numeric_code' => '090',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Dollar',
                ),
                'SCR' => array(
                    'code'         => 'SCR',
                    'symbol'       => 'SRe',
                    'name'         => 'Seychellois Rupee',
                    'numeric_code' => '690',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Rupee',
                ),
                'SDD' => array(
                    'code'         => 'SDD',
                    'symbol'       => 'LSd',
                    'name'         => 'Old Sudanese Dinar',
                    'numeric_code' => '736',
                    'minor_unit'   => 'None',
                    'major_unit'   => 'Dinar',
                ),
                'SEK' => array(
                    'code'                => 'SEK',
                    'symbol'              => 'kr',
                    'name'                => 'Swedish Krona',
                    'numeric_code'        => '752',
                    'thousands_separator' => ' ',
                    'decimal_separator'   => ',',
                    'symbol_placement'    => 'after',
                    'code_placement'      => 'hidden',
                    'minor_unit'          => '??re',
                    'major_unit'          => 'Kronor',
                ),
                'SGD' => array(
                    'code'         => 'SGD',
                    'symbol'       => 'S$',
                    'name'         => 'Singapore Dollar',
                    'numeric_code' => '702',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Dollar',
                ),
                'SHP' => array(
                    'code'         => 'SHP',
                    'symbol'       => 'SH??',
                    'name'         => 'Saint Helena Pound',
                    'numeric_code' => '654',
                    'minor_unit'   => 'Penny',
                    'major_unit'   => 'Pound',
                ),
                'SLL' => array(
                    'code'         => 'SLL',
                    'symbol'       => 'Le',
                    'name'         => 'Sierra Leonean Leone',
                    'decimals'     => 0,
                    'numeric_code' => '694',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Leone',
                ),
                'SOS' => array(
                    'code'         => 'SOS',
                    'symbol'       => 'Ssh',
                    'name'         => 'Somali Shilling',
                    'decimals'     => 0,
                    'numeric_code' => '706',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Shilling',
                ),
                'SRD' => array(
                    'code'       => 'SRD',
                    'symbol'     => 'SR$',
                    'name'       => 'Surinamese Dollar',
                    'minor_unit' => 'Cent',
                    'major_unit' => 'Dollar',
                ),
                'SRG' => array(
                    'code'         => 'SRG',
                    'symbol'       => 'Sf',
                    'name'         => 'Suriname Guilder',
                    'numeric_code' => '740',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Guilder',
                ),
                'STD' => array(
                    'code'         => 'STD',
                    'symbol'       => 'Db',
                    'name'         => 'S??o Tom?? and Pr??ncipe Dobra',
                    'decimals'     => 0,
                    'numeric_code' => '678',
                    'minor_unit'   => 'C??ntimo',
                    'major_unit'   => 'Dobra',
                ),
                'SYP' => array(
                    'code'         => 'SYP',
                    'symbol'       => 'SY??',
                    'name'         => 'Syrian Pound',
                    'decimals'     => 0,
                    'numeric_code' => '760',
                    'minor_unit'   => 'Piastre',
                    'major_unit'   => 'Pound',
                ),
                'SZL' => array(
                    'code'         => 'SZL',
                    'symbol'       => 'SZL',
                    'name'         => 'Swazi Lilangeni',
                    'numeric_code' => '748',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Lilangeni',
                ),
                'THB' => array(
                    'code'         => 'THB',
                    'symbol'       => '???',
                    'name'         => 'Thai Baht',
                    'numeric_code' => '764',
                    'minor_unit'   => 'Satang',
                    'major_unit'   => 'Baht',
                ),
                'TND' => array(
                    'code'         => 'TND',
                    'symbol'       => 'DT',
                    'name'         => 'Tunisian Dinar',
                    'decimals'     => 3,
                    'numeric_code' => '788',
                    'minor_unit'   => 'Millime',
                    'major_unit'   => 'Dinar',
                ),
                'TOP' => array(
                    'code'         => 'TOP',
                    'symbol'       => 'T$',
                    'name'         => 'Tongan Pa??anga',
                    'numeric_code' => '776',
                    'minor_unit'   => 'Senit',
                    'major_unit'   => 'Pa??anga',
                ),
                'TRY' => array(
                    'code'                => 'TRY',
                    'symbol'              => 'TL',
                    'name'                => 'Turkish Lira',
                    'numeric_code'        => '949',
                    'thousands_separator' => '.',
                    'decimal_separator'   => ',',
                    'symbol_placement'    => 'after',
                    'code_placement'      => '',
                    'minor_unit'          => 'Kurus',
                    'major_unit'          => 'Lira',
                ),
                'TTD' => array(
                    'code'         => 'TTD',
                    'symbol'       => 'TT$',
                    'name'         => 'Trinidad and Tobago Dollar',
                    'numeric_code' => '780',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Dollar',
                ),
                'TWD' => array(
                    'code'         => 'TWD',
                    'symbol'       => 'NT$',
                    'name'         => 'New Taiwan Dollar',
                    'numeric_code' => '901',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'New Dollar',
                ),
                'TZS' => array(
                    'code'         => 'TZS',
                    'symbol'       => 'TSh',
                    'name'         => 'Tanzanian Shilling',
                    'decimals'     => 0,
                    'numeric_code' => '834',
                    'minor_unit'   => 'Senti',
                    'major_unit'   => 'Shilling',
                ),
                'UAH' => array(
                    'code'                => 'UAH',
                    'symbol'              => '??????.',
                    'name'                => 'Ukrainian Hryvnia',
                    'numeric_code'        => '980',
                    'thousands_separator' => '',
                    'decimal_separator'   => '.',
                    'symbol_placement'    => 'after',
                    'code_placement'      => 'hidden',
                    'minor_unit'          => 'Kopiyka',
                    'major_unit'          => 'Hryvnia',
                ),
                'UGX' => array(
                    'code'         => 'UGX',
                    'symbol'       => 'USh',
                    'name'         => 'Ugandan Shilling',
                    'decimals'     => 0,
                    'numeric_code' => '800',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Shilling',
                ),
                'USD' => array(
                    'code'             => 'USD',
                    'symbol'           => '$',
                    'name'             => 'United States Dollar',
                    'numeric_code'     => '840',
                    'symbol_placement' => 'before',
                    'code_placement'   => 'hidden',
                    'minor_unit'       => 'Cent',
                    'major_unit'       => 'Dollar',
                ),
                'UYU' => array(
                    'code'         => 'UYU',
                    'symbol'       => '$U',
                    'name'         => 'Uruguayan Peso',
                    'numeric_code' => '858',
                    'minor_unit'   => 'Cent??simo',
                    'major_unit'   => 'Peso',
                ),
                'VEF' => array(
                    'code'       => 'VEF',
                    'symbol'     => 'Bs.F.',
                    'name'       => 'Venezuelan Bol??var Fuerte',
                    'minor_unit' => 'C??ntimo',
                    'major_unit' => 'Bolivares Fuerte',
                ),
                'VND' => array(
                    'code'                => 'VND',
                    'symbol'              => '??',
                    'name'                => 'Vietnamese Dong',
                    'decimals'            => 0,
                    'thousands_separator' => '.',
                    'symbol_placement'    => 'after',
                    'symbol_spacer'       => '',
                    'code_placement'      => 'hidden',
                    'numeric_code'        => '704',
                    'minor_unit'          => 'H??',
                    'major_unit'          => 'Dong',
                ),
                'VUV' => array(
                    'code'         => 'VUV',
                    'symbol'       => 'VT',
                    'name'         => 'Vanuatu Vatu',
                    'decimals'     => 0,
                    'numeric_code' => '548',
                    'major_unit'   => 'Vatu',
                ),
                'WST' => array(
                    'code'         => 'WST',
                    'symbol'       => 'WS$',
                    'name'         => 'Samoan Tala',
                    'numeric_code' => '882',
                    'minor_unit'   => 'Sene',
                    'major_unit'   => 'Tala',
                ),
                'XAF' => array(
                    'code'         => 'XAF',
                    'symbol'       => 'FCFA',
                    'name'         => 'CFA Franc BEAC',
                    'decimals'     => 0,
                    'numeric_code' => '950',
                    'minor_unit'   => 'Centime',
                    'major_unit'   => 'Franc',
                ),
                'XCD' => array(
                    'code'         => 'XCD',
                    'symbol'       => 'EC$',
                    'name'         => 'East Caribbean Dollar',
                    'numeric_code' => '951',
                    'minor_unit'   => 'Cent',
                    'major_unit'   => 'Dollar',
                ),
                'XOF' => array(
                    'code'         => 'XOF',
                    'symbol'       => 'CFA',
                    'name'         => 'CFA Franc BCEAO',
                    'decimals'     => 0,
                    'numeric_code' => '952',
                    'minor_unit'   => 'Centime',
                    'major_unit'   => 'Franc',
                ),
                'XPF' => array(
                    'code'         => 'XPF',
                    'symbol'       => 'CFPF',
                    'name'         => 'CFP Franc',
                    'decimals'     => 0,
                    'numeric_code' => '953',
                    'minor_unit'   => 'Centime',
                    'major_unit'   => 'Franc',
                ),
                'YER' => array(
                    'code'         => 'YER',
                    'symbol'       => 'YR',
                    'name'         => 'Yemeni Rial',
                    'decimals'     => 0,
                    'numeric_code' => '886',
                    'minor_unit'   => 'Fils',
                    'major_unit'   => 'Rial',
                ),
                'ZAR' => array(
                    'code'             => 'ZAR',
                    'symbol'           => 'R',
                    'name'             => 'South African Rand',
                    'numeric_code'     => '710',
                    'symbol_placement' => 'before',
                    'code_placement'   => 'hidden',
                    'minor_unit'       => 'Cent',
                    'major_unit'       => 'Rand',
                ),
                'ZMK' => array(
                    'code'         => 'ZMK',
                    'symbol'       => 'ZK',
                    'name'         => 'Zambian Kwacha',
                    'decimals'     => 0,
                    'numeric_code' => '894',
                    'minor_unit'   => 'Ngwee',
                    'major_unit'   => 'Kwacha',
                ),
            );
        }

        function get_pro_feature_list() {
            return $html = '<ol>
								<li>11 Amazing Layouts with Grid, Masonry, Isotope & Slider.</li>
								<li>Even and Masonry Grid for all Grid.</li>
								<li>Search field on Isotope</li>
								<li>Woocommerce Support</li>
								<li>Order by Id, Name, Create Date, Menu Order, Random & Price</li>
								<li>Display image size (thumbnail, medium, large, full and Custom Image Size)</li>
								<li>Ajax Pagination: Load more, Load on scroll and AJAX Number Pagination</li>
								<li>AJAX Number Pagination (only for Grid layouts)</li>
								<li>Single popup Menu Item Popup</li>
								<li>Overlay color and opacity control</li>
								<li>All Text color, size and Button Color control.</li>
							</ol>
						<a href="https://www.radiustheme.com/downloads/food-menu-pro-wordpress/" class="rt-admin-btn" target="_blank">Get Pro Version</a>';
        }

    }

endif;