<?php
if (!class_exists('FmpInit')):
    /**
     *
     */
    class FmpInit {

        function __construct() {
            add_action('init', array($this, 'init'), 1);
            add_action('plugins_loaded', array($this, 'plugin_loaded'));
            add_action('admin_enqueue_scripts', array($this, 'settings_admin_enqueue_scripts'));
            register_activation_hook(FOOD_MENU_PRO_PLUGIN_ACTIVE_FILE_NAME, array($this, 'activate'));
            register_deactivation_hook(FOOD_MENU_PRO_PLUGIN_ACTIVE_FILE_NAME, array($this, 'deactivate'));
        }

        public function activate() {
            $this->flushFmp();
        }

        private function flushFmp() {
            flush_rewrite_rules();
        }

        /**
         * Fired for each blog when the plugin is deactivated.
         *
         * @since 0.1.0
         */
        public function deactivate() {
            $this->flushFmp();
        }

        function init() {

            add_post_type_support( TLPFoodMenu()->post_type, 'comments' );

            register_post_type('fmp_variation',
                array(
                    'label'           => __('Variations', 'food-menu-pro'),
                    'public'          => false,
                    'hierarchical'    => false,
                    'supports'        => false,
                    'capability_type' => 'post'
                )
            );

            $tagLabels = array(
                'name'                       => __('Tags', 'food-menu-pro'),
                'singular_name'              => __('Tag', 'food-menu-pro'),
                'menu_name'                  => _x('Tags', 'Admin menu name', 'food-menu-pro'),
                'search_items'               => __('Search Tags', 'food-menu-pro'),
                'all_items'                  => __('All Tags', 'food-menu-pro'),
                'edit_item'                  => __('Edit Tag', 'food-menu-pro'),
                'update_item'                => __('Update Tag', 'food-menu-pro'),
                'add_new_item'               => __('Add New Tag', 'food-menu-pro'),
                'new_item_name'              => __('New Tag Name', 'food-menu-pro'),
                'popular_items'              => __('Popular Tags', 'food-menu-pro'),
                'separate_items_with_commas' => __('Separate Tags with commas', 'food-menu-pro'),
                'add_or_remove_items'        => __('Add or remove Tags', 'food-menu-pro'),
                'choose_from_most_used'      => __('Choose from the most used tags', 'food-menu-pro'),
                'not_found'                  => __('No Tags found', 'food-menu-pro'),
            );
            $tagArgs = array(
                'labels'            => $tagLabels,
                'public'            => true,
                'show_in_nav_menus' => true,
                'show_ui'           => true,
                'show_tagcloud'     => true,
                'hierarchical'      => false,
                'rewrite'           => array(
                    'slug'       => TLPFoodMenu()->taxonomies['tag'],
                    'with_front' => false,
                ),
                'show_admin_column' => true,
                'query_var'         => true,
            );
            register_taxonomy(TLPFoodMenu()->taxonomies['tag'], TLPFoodMenu()->post_type, $tagArgs);

            $inLabels = array(
                'name'                       => __('Ingredients', 'food-menu-pro'),
                'singular_name'              => __('Ingredient', 'food-menu-pro'),
                'menu_name'                  => __('Ingredients', 'food-menu-pro'),
                'edit_item'                  => __('Edit Ingredient', 'food-menu-pro'),
                'update_item'                => __('Update Ingredient', 'food-menu-pro'),
                'add_new_item'               => __('Add New Ingredient', 'food-menu-pro'),
                'new_item_name'              => __('New Ingredient', 'food-menu-pro'),
                'parent_item'                => __('Parent Ingredient', 'food-menu-pro'),
                'parent_item_colon'          => __('Parent Ingredient:', 'food-menu-pro'),
                'all_items'                  => __('All ingredients', 'food-menu-pro'),
                'search_items'               => __('Search ingredients', 'food-menu-pro'),
                'popular_items'              => __('Popular ingredients', 'food-menu-pro'),
                'separate_items_with_commas' => __('Separate ingredients with commas', 'food-menu-pro'),
                'add_or_remove_items'        => __('Add or remove ingredients', 'food-menu-pro'),
                'choose_from_most_used'      => __('Choose from the most used  ingredients', 'food-menu-pro'),
                'not_found'                  => __('No ingredients found.', 'food-menu-pro'),
            );
            $inArgs = array(
                'labels'            => $inLabels,
                'public'            => false,
                'show_in_nav_menus' => false,
                'show_ui'           => true,
                'show_tagcloud'     => false,
                'hierarchical'      => false,
                'rewrite'           => array('slug' => TLPFoodMenu()->taxonomies['ingredient']),
                'show_admin_column' => false,
                'query_var'         => false,
            );
            register_taxonomy(TLPFoodMenu()->taxonomies['ingredient'], TLPFoodMenu()->post_type, $inArgs);

            //Nutrition
            $nuLabels = array(
                'name'                       => __('Nutrition', 'food-menu-pro'),
                'singular_name'              => __('Nutrition', 'food-menu-pro'),
                'menu_name'                  => __('Nutrition', 'food-menu-pro'),
                'edit_item'                  => __('Edit nutrition', 'food-menu-pro'),
                'update_item'                => __('Update nutrition', 'food-menu-pro'),
                'add_new_item'               => __('Add New nutrition', 'food-menu-pro'),
                'new_item_name'              => __('New nutrition', 'food-menu-pro'),
                'parent_item'                => __('Parent nutrition', 'food-menu-pro'),
                'parent_item_colon'          => __('Parent nutrition', 'food-menu-pro'),
                'all_items'                  => __('All nutrition', 'food-menu-pro'),
                'search_items'               => __('Search nutrition', 'food-menu-pro'),
                'popular_items'              => __('Popular nutrition', 'food-menu-pro'),
                'separate_items_with_commas' => __('Separate nutrition with commas', 'food-menu-pro'),
                'add_or_remove_items'        => __('Add or remove nutrition', 'food-menu-pro'),
                'choose_from_most_used'      => __('Choose from the most used  nutrition', 'food-menu-pro'),
                'not_found'                  => __('No nutrition found.', 'food-menu-pro'),
            );
            $nuArgs = array(
                'labels'            => $nuLabels,
                'public'            => false,
                'show_in_nav_menus' => false,
                'show_ui'           => true,
                'show_tagcloud'     => false,
                'hierarchical'      => false,
                'rewrite'           => array('slug' => TLPFoodMenu()->taxonomies['nutrition']),
                'show_admin_column' => false,
                'query_var'         => false,
            );
            register_taxonomy(TLPFoodMenu()->taxonomies['nutrition'], TLPFoodMenu()->post_type, $nuArgs);
            //Unit
            $unLabels = array(
                'name'                       => __('Units', 'food-menu-pro'),
                'singular_name'              => __('Unit', 'food-menu-pro'),
                'menu_name'                  => __('Units', 'food-menu-pro'),
                'edit_item'                  => __('Edit unit', 'food-menu-pro'),
                'update_item'                => __('Update unit', 'food-menu-pro'),
                'add_new_item'               => __('Add New unit', 'food-menu-pro'),
                'new_item_name'              => __('New unit', 'food-menu-pro'),
                'parent_item'                => __('Parent unit', 'food-menu-pro'),
                'parent_item_colon'          => __('Parent unit', 'food-menu-pro'),
                'all_items'                  => __('All units', 'food-menu-pro'),
                'search_items'               => __('Search units', 'food-menu-pro'),
                'popular_items'              => __('Popular units', 'food-menu-pro'),
                'separate_items_with_commas' => __('Separate units with commas', 'food-menu-pro'),
                'add_or_remove_items'        => __('Add or remove units', 'food-menu-pro'),
                'choose_from_most_used'      => __('Choose from the most used units', 'food-menu-pro'),
                'not_found'                  => __('No unit found.', 'food-menu-pro'),
            );
            $unArgs = array(
                'labels'            => $unLabels,
                'public'            => false,
                'show_in_nav_menus' => false,
                'show_ui'           => true,
                'show_tagcloud'     => false,
                'hierarchical'      => false,
                'rewrite'           => array('slug' => TLPFoodMenu()->taxonomies['unit']),
                'show_admin_column' => false,
                'query_var'         => false,
            );
            register_taxonomy(TLPFoodMenu()->taxonomies['unit'], TLPFoodMenu()->post_type, $unArgs);

            $flush = get_option(TLPFoodMenu()->options['flash']);
            if ($flush) {
                $this->flushFmp();
                update_option(TLPFoodMenu()->options['flash'], false);
            }

            // register scripts
            $scripts = array();
            $styles = array();
            $scripts[] = array(
                'handle' => 'fmp-image-load',
                'src'    => FMP()->assetsUrl . "vendor/isotope/imagesloaded.pkgd.min.js",
                'deps'   => array('jquery'),
                'footer' => false
            );
            $scripts[] = array(
                'handle' => 'fmp-isotope',
                'src'    => FMP()->assetsUrl . "vendor/isotope/isotope.pkgd.min.js",
                'deps'   => array('jquery'),
                'footer' => false
            );
            $scripts[] = array(
                'handle' => 'fmp-jzoom',
                'src'    => FMP()->assetsUrl . "js/jzoom.min.js",
                'deps'   => array('jquery'),
                'footer' => false
            );
            $scripts[] = array(
                'handle' => 'fmp-scrollbar',
                'src'    => FMP()->assetsUrl . "vendor/scrollbar/jquery.mCustomScrollbar.min.js",
                'deps'   => array('jquery'),
                'footer' => false
            );

            $scripts[] = array(
                'handle' => 'fmp-owl-carousel',
                'src'    => FMP()->assetsUrl . "vendor/owl-carousel2/owl.carousel.min.js",
                'deps'   => array('jquery'),
                'footer' => false
            );
            $scripts[] = array(
                'handle' => 'fmp-flex',
                'src'    => FMP()->assetsUrl . "vendor/FlexSlider2/jquery.flexslider-min.js",
                'deps'   => array('jquery'),
                'footer' => false
            );
            $scripts[] = array(
                'handle' => 'fmp-actual-height',
                'src'    => FMP()->assetsUrl . "vendor/actual-height/jquery.actual.min.js",
                'deps'   => array('jquery'),
                'footer' => false
            );
            $scripts[] = array(
                'handle' => 'fmp-modal',
                'src'    => FMP()->assetsUrl . "vendor/jquery-modal/jquery.modal.min.js",
                'deps'   => array('jquery'),
                'footer' => false
            );
            $scripts[] = array(
                'handle' => 'fmp-single-food',
                'src'    => FMP()->assetsUrl . 'js/single-food.js',
                'deps'   => array('jquery'),
                'footer' => true
            );
            $scripts[] = array(
                'handle' => 'fmp-frontend',
                'src'    => FMP()->assetsUrl . 'js/foodmenu.js',
                'deps'   => array('jquery', 'fmp-actual-height', 'imagesloaded'),
                'footer' => true
            );
            // register acf styles
            $styles['fmp-fontawsome'] = FMP()->assetsUrl . 'vendor/font-awesome/css/font-awesome.min.css';
            $styles['fmp-scrollbar'] = FMP()->assetsUrl . 'vendor/scrollbar/jquery.mCustomScrollbar.min.css';
            $styles['fmp-owl-carousel'] = FMP()->assetsUrl . 'vendor/owl-carousel2/owl.carousel.min.css';
            $styles['fmp-owl-carousel-theme'] = FMP()->assetsUrl . 'vendor/owl-carousel2/owl.theme.default.min.css';
            $styles['fmp-flex'] = FMP()->assetsUrl . 'vendor/FlexSlider2/flexslider.css';
            $styles['fmp-modal'] = FMP()->assetsUrl . 'vendor/jquery-modal/jquery.modal.min.css';
            $styles['fmp-frontend'] = FMP()->assetsUrl . 'css/foodmenu.css';
            $styles['fmp-rtl'] = FMP()->assetsUrl . 'css/foodmenu-rtl.css';

            if (is_admin()) {
                $scripts[] = array(
                    'handle' => 'ace_code_highlighter_js',
                    'src'    => FMP()->assetsUrl . "vendor/ace/ace.js",
                    'deps'   => null,
                    'footer' => false
                );
                $scripts[] = array(
                    'handle' => 'ace_mode_js',
                    'src'    => FMP()->assetsUrl . "vendor/ace/mode-css.js",
                    'deps'   => array('ace_code_highlighter_js'),
                    'footer' => false
                );
                $scripts[] = array(
                    'handle' => 'fmp-accounting',
                    'src'    => FMP()->assetsUrl . "vendor/accounting/accounting.min.js",
                    'deps'   => array('jquery'),
                    'footer' => true
                );
                $scripts[] = array(
                    'handle' => 'fmp-admin-food',
                    'src'    => FMP()->assetsUrl . "js/admin-food.js",
                    'deps'   => array('jquery'),
                    'footer' => true
                );
                $scripts[] = array(
                    'handle' => 'fmp-admin',
                    'src'    => FMP()->assetsUrl . "js/admin.js",
                    'deps'   => array('jquery'),
                    'footer' => true
                );
                $scripts[] = array(
                    'handle' => 'fmp-admin-preview',
                    'src'    => FMP()->assetsUrl . "js/admin-preview.js",
                    'deps'   => array('jquery'),
                    'footer' => true
                );
                $scripts[] = array(
                    'handle' => 'fmp-admin-sc',
                    'src'    => FMP()->assetsUrl . "js/admin-sc.js",
                    'deps'   => array('jquery'),
                    'footer' => true
                );
                $scripts[] = array(
                    'handle' => 'fmp-admin-taxonomy',
                    'src'    => FMP()->assetsUrl . "js/admin-taxonomy.js",
                    'deps'   => array('jquery'),
                    'footer' => true
                );
                $styles['fmp-admin'] = FMP()->assetsUrl . 'css/admin.css';
                $styles['fmp-admin-preview'] = FMP()->assetsUrl . 'css/admin-preview.css';
            }

            $version = (defined('WP_DEBUG') && WP_DEBUG) ? time() : FMP()->options['version'];
            foreach ($scripts as $script) {
                wp_register_script($script['handle'], $script['src'], $script['deps'], $version, $script['footer']);
            }


            foreach ($styles as $k => $v) {
                wp_register_style($k, $v, false, $version);
            }

        }

        function settings_admin_enqueue_scripts() {
            global $pagenow, $typenow;

            // validate page
            if (!in_array($pagenow, array('edit.php'))) {
                return;
            }
            if ($typenow != TLPFoodMenu()->post_type) {
                return;
            }

            wp_enqueue_script(array(
                'ace_code_highlighter_js',
                'ace_mode_js',
                'fmp-admin',
            ));

            // styles
            wp_enqueue_style(array(
                'fmp-admin',
            ));

            $nonce = wp_create_nonce(TLPFoodMenu()->nonceText());
            wp_localize_script('fmp-admin', 'fmp_var',
                array(
                    'nonceID' => TLPFoodMenu()->nonceId(),
                    'nonce'   => $nonce,
                    'ajaxurl' => admin_url('admin-ajax.php')
                ));
        }

        public function plugin_loaded() {
            load_plugin_textdomain('food-menu-pro', false, FOOD_MENU_PRO_LANGUAGE_PATH);
            $this->updateVersion();
        }

        private function updateVersion() {
            update_option(FMP()->options['installed_version'], FMP()->options['version']);
        }

    }
endif;