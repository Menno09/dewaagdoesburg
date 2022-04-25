<?php
if (!class_exists('FmpFoodMeta')):

    /**
     *
     */
    class FmpFoodMeta {

        function __construct() {
            // actions
            add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'), 10);
            add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts_shortcode'));
            add_action('save_post', array($this, 'save_post'), 10, 2);
            add_action('restrict_manage_posts', array($this, 'add_taxonomy_filters'));
            add_filter('manage_edit-food-menu_columns', array($this, 'arrange_fmp_columns'));
            add_action('manage_food-menu_posts_custom_column', array($this, 'manage_fmp_columns'), 10, 2);

            // Meta box
            add_action('add_meta_boxes', array($this, 'remove_meta_boxes'), 10);
            add_action('add_meta_boxes', array($this, 'rename_meta_boxes'), 20);
        }


        function admin_enqueue_scripts() {
            global $pagenow, $typenow;

            // validate page
            if (!in_array($pagenow, array('post.php', 'post-new.php', 'edit.php'))) {
                return;
            }
            if ($typenow != TLPFoodMenu()->post_type) {
                return;
            }

            wp_dequeue_script('autosave');
            // scripts
            $select2Id = 'fmp-select2';
            if (class_exists('WPSEO_Admin_Asset_Manager') && class_exists('Avada')) {
                $select2Id = 'yoast-seo-select2';
            } elseif (class_exists('WPSEO_Admin_Asset_Manager')) {
                $select2Id = 'yoast-seo-select2';
            } elseif (class_exists('Avada')) {
                $select2Id = 'select2-avada-js';
            } elseif (class_exists('wp_megamenu_base')) {
                wp_dequeue_script('wpmm-select2');
                wp_dequeue_script('wpmm_scripts_admin');
            }
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_script('ace_code_highlighter_js');
            wp_enqueue_script('ace_mode_js');
            wp_enqueue_script('fmp-accounting');
            wp_enqueue_script($select2Id);
            wp_enqueue_script('fmp-admin-food');
            wp_enqueue_script('fmp-admin');

            // styles
            wp_enqueue_style('fm-select2');
            wp_enqueue_style('fm-admin');
            wp_enqueue_style('fmp-admin');


            $units = get_terms(array(
                'taxonomy'   => TLPFoodMenu()->taxonomies['unit'],
                'hide_empty' => false,
                'orderby'    => 'name',
                'order'      => 'ASC'
            ));
            $unitList = array();
            if (!empty($units)) {
                foreach ($units as $unit) {
                    $unitList[$unit->term_id] = $unit->name;
                }
            }

            $nonce = wp_create_nonce(TLPFoodMenu()->nonceText());
            wp_localize_script('fmp-admin', 'fmp_var',
                array(
                    'nonceID' => TLPFoodMenu()->nonceId(),
                    'nonce'   => $nonce,
                    'ajaxurl' => admin_url('admin-ajax.php'),
                    'units'   => $unitList
                ));

            add_action('admin_head', array($this, 'admin_head'));
        }

        function admin_enqueue_scripts_shortcode() {
            global $pagenow, $typenow;
            // validate page
            if ( ! in_array( $pagenow, array( 'post.php', 'post-new.php', 'edit.php' ) ) ) {
                return;
            }

            if ( $typenow != TLPFoodMenu()->getShortCodePT() ) {
                return;
            }

            wp_enqueue_style( array( 'wp-color-picker', 'fm-select2', 'fm-admin', 'fm-frontend' ) );
            wp_enqueue_script( array( 'wp-color-picker', 'fm-select2', 'fm-admin' ) );
            $nonce = wp_create_nonce( TLPFoodMenu()->nonceText() );
            wp_localize_script( 'fm-admin', 'fmp_var',
                array(
                    'nonceID' => TLPFoodMenu()->nonceId(),
                    'nonce'   => $nonce,
                    'ajaxurl' => admin_url( 'admin-ajax.php' )
                )
            );
        }

        /**
         * Remove bloat.
         */
        public function remove_meta_boxes() {
            remove_meta_box('tagsdiv-' . TLPFoodMenu()->taxonomies['ingredient'], TLPFoodMenu()->post_type, 'side');
            remove_meta_box('tagsdiv-' . TLPFoodMenu()->taxonomies['nutrition'], TLPFoodMenu()->post_type, 'side');
            remove_meta_box('tagsdiv-' . TLPFoodMenu()->taxonomies['unit'], TLPFoodMenu()->post_type, 'side');
            remove_meta_box('pageparentdiv', TLPFoodMenu()->post_type, 'side');
            remove_meta_box('commentsdiv', TLPFoodMenu()->post_type, 'normal');
            remove_meta_box('commentstatusdiv', TLPFoodMenu()->post_type, 'side');
            remove_meta_box('commentstatusdiv', TLPFoodMenu()->post_type, 'normal');
        }

        /**
         * Rename core meta boxes.
         */
        public function rename_meta_boxes() {
            global $post;

            // Comments/Reviews
            if (isset($post) && ('publish' == $post->post_status || 'private' == $post->post_status)) {
                remove_meta_box('commentsdiv', 'product', 'normal');

                add_meta_box('commentsdiv', __('Reviews', 'food-menu-pro'), 'post_comment_meta_box', 'product', 'normal');
            }
        }

        /**
         *  Add meta info Box
         */
        function admin_head() {
            add_meta_box(
                'fmp-food-data',
                __('Food Data', 'food-menu-pro'),
                array($this, 'fmp_food_data'),
                TLPFoodMenu()->post_type,
                'normal', 'high');
            add_meta_box(
                'postexcerpt',
                __('Excerpt', 'food-menu-pro'),
                array($this, 'fmp_excerpt'),
                TLPFoodMenu()->post_type,
                'normal');
            add_meta_box(
                'fmp-meta-images',
                __('Gallery', 'food-menu-pro'),
                array($this, 'fmp_food_images'),
                TLPFoodMenu()->post_type, 'side', 'low');
        }

        function fmp_excerpt($post) {
            $settings = array(
                'textarea_name' => 'excerpt',
                'quicktags'     => array('buttons' => 'em,strong,link'),
                'tinymce'       => array(
                    'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
                    'theme_advanced_buttons2' => '',
                ),
                'editor_css'    => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>'
            );

            wp_editor(htmlspecialchars_decode($post->post_excerpt), 'excerpt',
                apply_filters('woocommerce_product_short_description_editor_settings', $settings));
        }

        function fmp_food_images($post) {
            ?>
            <div id="fmp_images_container">
                <ul class="fmp_images">
                    <?php
                    $attachments = get_post_meta($post->ID, '_fmp_image_gallery', true);

                    $update_meta = false;
                    $updated_gallery_ids = array();
                    if (!empty($attachments)) {
                        foreach ($attachments as $attachment_id) {
                            $attachment = wp_get_attachment_image($attachment_id, 'thumbnail');

                            // if attachment is empty skip
                            if (empty($attachment)) {
                                $update_meta = true;
                                continue;
                            }

                            echo '<li class="image" data-attachment_id="' . esc_attr($attachment_id) . '">
								' . $attachment . '
								<ul class="actions">
									<li><a href="#" class="delete tips" data-tip="' . esc_attr__('Delete image',
                                    'food-menu-pro') . '">' . __('Delete', 'food-menu-pro') . '</a></li>
								</ul>
							</li>';

                            // rebuild ids to be saved
                            $updated_gallery_ids[] = $attachment_id;
                        }

                        // need to update product meta to set new gallery ids
                        if ($update_meta) {
                            update_post_meta($post->ID, '_fmp_image_gallery', $updated_gallery_ids);
                        }
                    }
                    ?>
                </ul>

                <input type="hidden" id="fmp_image_gallery" name="fmp_image_gallery"
                       value="<?php echo esc_attr(implode(',', $attachments)); ?>"/>

            </div>
            <p class="add_fmp_images hide-if-no-js">
                <a href="#" data-choose="<?php esc_attr_e('Add Images to Gallery', 'food-menu-pro'); ?>"
                   data-update="<?php esc_attr_e('Add to gallery', 'food-menu-pro'); ?>"
                   data-delete="<?php esc_attr_e('Delete image', 'food-menu-pro'); ?>"
                   data-text="<?php esc_attr_e('Delete', 'food-menu-pro'); ?>"><?php _e('Add gallery images',
                        'food-menu-pro'); ?></a>
            </p>
            <?php
        }

        function fmp_food_data($post) {
            wp_nonce_field(TLPFoodMenu()->nonceText(), TLPFoodMenu()->nonceId());
            ?>
            <div class="fmp-meta-data-container">
                <div class="panel-wrapper fmp-panel-wrapper fmp-clear">
                    <ul class="fmp_data_tabs fmp-tabs">
                        <li class="general_options fmp_options_tab active">
                            <a href="#general_fmp_data"><span><?php esc_html_e("General", "food-menu-pro"); ?></span></a>
                        </li>
                        <li class="ingredient_options fmp_options_tab">
                            <a href="#ingredient_fmp_data"><span><?php esc_html_e("Ingredient", "food-menu-pro"); ?></a>
                        </li>
                        <li class="nutrition_options fmp_options_tab">
                            <a href="#nutrition_fmp_data"><span><?php esc_html_e("Nutrition", "food-menu-pro"); ?></a>
                        </li>
                        <li class="advanced_options fmp_options_tab">
                            <a href="#advanced_fmp_data"><span><?php esc_html_e("Advanced", "food-menu-pro"); ?></a>
                        </li>
                    </ul>
                    <div class="panel fmp_options_panel fmp-metaboxes-wrapper" id="general_fmp_data"
                         style="display: block">
                        <?php echo TLPFoodMenu()->rtFieldGenerator(TLPFoodMenu()->foodGeneralOptions()); ?>
                        <div class="variation-wrapper fmp-hidden">
                            <div class="toolbar toolbar-top">
                                <button type="button"
                                        class="button add_variation"><?php esc_html_e("Add Variation", "food-menu-pro"); ?></button>
                            </div>
                            <div class="fmp_variations">
                                <?php
                                $variations = get_posts(array(
                                    'post_type'      => 'fmp_variation',
                                    'posts_per_page' => -1,
                                    'post_status'    => 'any',
                                    'post_parent'    => $post->ID,
                                    'order'          => 'ASC'
                                ));
                                if (!empty($variations)) {
                                    foreach ($variations as $variation) {
                                        $variation_id = $variation->ID;
                                        $variation_name = get_post_meta($variation_id, '_name', true);
                                        $variation_price = get_post_meta($variation_id, '_price', true);
                                        $flug = 'closed';
                                        include(FMP()->includePath . 'html-fmp-variation.php');
                                    }
                                }
                                ?>
                            </div>
                            <div class="toolbar">
                                <button class="button save_variations button-primary" type="button">
                                    <?php esc_html_e("Save Variations", "food-menu-pro"); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="panel fmp_options_panel hidden" id="ingredient_fmp_data">
                        <?php

                        $metaIngredients = get_post_meta($post->ID, '_ingredient');
                        $excludeIngredients = array();
                        if (!empty($metaIngredients)) {
                            foreach ($metaIngredients as $item) {
                                $excludeIngredients[] = $item['id'];
                            }
                        }
                        $ingredients = get_terms(array(
                            'taxonomy'   => TLPFoodMenu()->taxonomies['ingredient'],
                            'hide_empty' => false,
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                            'exclude'    => $excludeIngredients
                        ));
                        $units = get_terms(array(
                            'taxonomy'   => TLPFoodMenu()->taxonomies['unit'],
                            'hide_empty' => false,
                            'orderby'    => 'name',
                            'order'      => 'ASC'
                        ));
                        ?>
                        <div class="ingredient-wrapper">
                            <div id="ingredient-container" class="fmp-clear fmp-lists-container">
                                <ul id="fmp-active-ing-list" class="fmp-active-list fmp-sortable-list fmp-clear"
                                    data-title="Active Ingredient">
                                    <?php
                                    if (!empty($metaIngredients)) {
                                        foreach ($metaIngredients as $ingredient) {

                                            $ingTerm = get_term(!empty($ingredient['id']) ? absint($ingredient['id']) : 0,
                                                TLPFoodMenu()->taxonomies['ingredient']);
                                            $unit_id = !empty($ingredient['unit_id']) ? absint($ingredient['unit_id']) : 0;
                                            $ingValue = !empty($ingredient['value']) ? absint($ingredient['value']) : null;
                                            echo "<li class='fmp-sortable-item active-item' data-id='{$ingTerm->term_id}'>" .
                                                "<label>{$ingTerm->name}</label>" .
                                                "<div class='fmp-sortable-item-values'>" .
                                                "<input type='text' class='item-value' name='_ingredient[{$ingTerm->term_id}][value]' value='{$ingValue}'>" .
                                                "<select name='_ingredient[{$ingTerm->term_id}][unit_id]' class='item-unit'>" .
                                                "<option value=''>Unit</option>";
                                            if (!empty($units)) {
                                                foreach ($units as $unit) {
                                                    $sel = ($unit_id == $unit->term_id ? " selected" : null);
                                                    echo "<option value='{$unit->term_id}'{$sel}>{$unit->name}</option>";
                                                }
                                            }
                                            echo "</select>" .
                                                "</div>" .
                                                "</li>";
                                        }
                                    }
                                    ?>
                                </ul>
                                <ul id="fmp-available-ing-list"
                                    class="fmp-available-list fmp-sortable-list fmp-clear"
                                    data-title="Available Ingredient">
                                    <li class="fmp-item-search"><input type="text" placeholder="Search"></li>
                                    <?php
                                    if (!empty($ingredients)) {
                                        foreach ($ingredients as $ing) {
                                            echo "<li class='fmp-sortable-item available-item' data-id='{$ing->term_id}'>" .
                                                "<label>{$ing->name}</label><div class='fmp-sortable-item-values'></div>" .
                                                "</li>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div> <!-- End Ingredient wrapper -->
                    </div> <!-- End Ingredient panel -->
                    <div class="panel fmp_options_panel hidden" id="nutrition_fmp_data">
                        <?php

                        $metaNutritionList = get_post_meta($post->ID, '_nutrition');
                        $excludeNutrition = array();
                        if (!empty($metaNutritionList)) {
                            foreach ($metaNutritionList as $item) {
                                $excludeNutrition[] = $item['id'];
                            }
                        }

                        $nutritionList = get_terms(array(
                            'taxonomy'   => TLPFoodMenu()->taxonomies['nutrition'],
                            'hide_empty' => false,
                            'orderby'    => 'name',
                            'order'      => 'ASC',
                            'exclude'    => $excludeNutrition
                        ));

                        $units = get_terms(array(
                            'taxonomy'   => TLPFoodMenu()->taxonomies['unit'],
                            'hide_empty' => false,
                            'orderby'    => 'name',
                            'order'      => 'ASC'
                        ));
                        ?>
                        <div class="nutrition-wrapper">
                            <div id="nutrition-container" class="fmp-clear fmp-lists-container">
                                <ul id="fmp-active-nutrition-list" class="fmp-active-list fmp-sortable-list fmp-clear"
                                    data-title="Active Nutrition">
                                    <?php
                                    if (!empty($metaNutritionList)) {
                                        foreach ($metaNutritionList as $nutrition) {

                                            $nutTerm = get_term(!empty($nutrition['id']) ? absint($nutrition['id']) : 0,
                                                TLPFoodMenu()->taxonomies['nutrition']);

                                            $unit_id = !empty($nutrition['unit_id']) ? absint($nutrition['unit_id']) : 0;
                                            $nutValue = !empty($nutrition['value']) ? absint($nutrition['value']) : null;
                                            echo "<li class='fmp-sortable-item active-item' data-id='{$nutTerm->term_id}'>" .
                                                "<label>{$nutTerm->name}</label>" .
                                                "<div class='fmp-sortable-item-values'>" .
                                                "<input type='text' class='item-value' name='_nutrition[{$nutTerm->term_id}][value]' value='{$nutValue}'>" .
                                                "<select name='_nutrition[{$nutTerm->term_id}][unit_id]' class='item-unit'>" .
                                                "<option value=''>Unit</option>";
                                            if (!empty($units)) {
                                                foreach ($units as $unit) {
                                                    $sel = ($unit_id == $unit->term_id ? " selected" : null);
                                                    echo "<option value='{$unit->term_id}'{$sel}>{$unit->name}</option>";
                                                }
                                            }
                                            echo "</select>" .
                                                "</div>" .
                                                "</li>";
                                        }
                                    }
                                    ?>
                                </ul>
                                <ul id="fmp-available-ing-list"
                                    class="fmp-available-list fmp-sortable-list fmp-clear"
                                    data-title="Available Nutrition">
                                    <li class="fmp-item-search"><input type="text" placeholder="Search"></li>
                                    <?php
                                    if (!empty($nutritionList)) {
                                        foreach ($nutritionList as $nutrition) {
                                            echo "<li class='fmp-sortable-item available-item' data-id='{$nutrition->term_id}'>" .
                                                "<label>{$nutrition->name}</label><div class='fmp-sortable-item-values'></div>" .
                                                "</li>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>  <!-- End nutrition wrapper -->
                    </div> <!-- End nutrition -->
                    <div class="panel fmp_options_panel" id="advanced_fmp_data">
                        <?php echo TLPFoodMenu()->rtFieldGenerator(TLPFoodMenu()->foodAdvancedOptions()); ?>
                    </div><!-- End advanced -->
                </div>
            </div>
            <?php
        }

        public function arrange_fmp_columns($columns) {

            if (isset($columns['title'])) {
                unset($columns['title']);
            }
            $cols = array();
            $cols['cb'] = $columns['cb'];
            $cols['thumb'] = '<span class="fmp-image tips" data-tip="' . esc_attr__('Image',
                    'food-menu-pro') . '">' . __('Image', 'food-menu-pro') . '</span>';
            $cols['title'] = __('Name', 'food-menu-pro');
            $cols['stock'] = __('Stock', 'food-menu-pro');
            $cols['price'] = __('Price', 'food-menu-pro');
            if (isset($columns['cb'])) {
                unset($columns['cb']);
            }

            return array_merge($cols, $columns);
        }

        public function manage_fmp_columns($column, $post_id) {
            // global $post;
            switch ($column) {
                case 'thumb':
                    echo get_the_post_thumbnail($post_id, 'thumbnail');
                    break;

                case 'stock':
                    echo FMP()->getStockStatus($post_id);
                    break;

                case 'price':
                    $price = FMP()->fmpHtmlPrice($post_id);
                    echo !empty($price) ? $price : '<span class="na">–</span>';
                    break;
            }
        }

        function save_post($post_id, $post) {

            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }
            if (!TLPFoodMenu()->verifyNonce()) {
                return $post_id;
            }
            if (TLPFoodMenu()->post_type != $post->post_type) {
                return $post_id;
            }

            $mates = TLPFoodMenu()->singleFoodMetaFields();
            foreach ($mates as $metaKey => $field) {
                if($metaKey === "menu_order") {
                    continue;
                }
                $rValue = isset($_REQUEST[$metaKey]) ? $_REQUEST[$metaKey] : null;
                $value = TLPFoodMenu()->sanitize($field, $rValue);
                if (empty($field['multiple'])) {
                    update_post_meta($post_id, $metaKey, $value);
                } else {
                    delete_post_meta($post_id, $metaKey);
                    if (is_array($value) && !empty($value)) {
                        foreach ($value as $item) {
                            add_post_meta($post_id, $metaKey, $item);
                        }
                    }
                }
            }

            // Ingredient
            delete_post_meta($post_id, '_ingredient');
            if (!empty($_POST['_ingredient'])) {
                foreach ($_POST['_ingredient'] as $id => $ingredient) {
                    $item = array(
                        'id'      => $id,
                        'unit_id' => !empty($ingredient['unit_id']) ? $ingredient['unit_id'] : null,
                        'value'   => !empty($ingredient['value']) ? $ingredient['value'] : null,
                    );
                    add_post_meta($post_id, '_ingredient', $item);
                }
            }

            // Nutrition
            delete_post_meta($post_id, '_nutrition');
            if (!empty($_POST['_nutrition'])) {
                foreach ($_POST['_nutrition'] as $id => $ingredient) {
                    $item = array(
                        'id'      => $id,
                        'unit_id' => !empty($ingredient['unit_id']) ? $ingredient['unit_id'] : null,
                        'value'   => !empty($ingredient['value']) ? $ingredient['value'] : null,
                    );
                    add_post_meta($post_id, '_nutrition', $item);
                }
            }

            $meta = array();
            // gallery image
            $meta['_fmp_image_gallery'] = isset($_POST['fmp_image_gallery']) ? array_filter(explode(',',
                FMP()->fmp_clean($_POST['fmp_image_gallery']))) : array();

            $regular_price = get_post_meta($post_id, '_regular_price', true);
            $sale_price = get_post_meta($post_id, '_sale_price', true);

            // Update price if on sale
            if ('' !== $sale_price) {
                $meta['_price'] = $sale_price;
            } else {
                $meta['_price'] = $regular_price;
            }

            foreach ($meta as $key => $value) {
                update_post_meta($post->ID, $key, $value);
            }


        }

        /**
         *
         */
        public function add_taxonomy_filters() {
            global $typenow;
            // Must set this to the post type you want the filter(s) displayed on
            if (TLPFoodMenu()->post_type !== $typenow) {
                return;
            }
            foreach (TLPFoodMenu()->taxonomies as $tax_slug) {
                echo $this->build_taxonomy_filter($tax_slug);
            }
        }

        /**
         * Build an individual dropdown filter.
         *
         * @param string $tax_slug Taxonomy slug to build filter for.
         *
         * @return string Markup, or empty string if taxonomy has no terms.
         */
        protected function build_taxonomy_filter($tax_slug) {
            $terms = get_terms($tax_slug);
            if (0 == count($terms)) {
                return '';
            }
            $tax_name = $this->get_taxonomy_name_from_slug($tax_slug);
            $current_tax_slug = isset($_GET[$tax_slug]) ? $_GET[$tax_slug] : false;
            $filter = '<select name="' . esc_attr($tax_slug) . '" id="' . esc_attr($tax_slug) . '" class="postform">';
            $filter .= '<option value="0">' . esc_html($tax_name) . '</option>';
            $filter .= $this->build_term_options($terms, $current_tax_slug);
            $filter .= '</select>';

            return $filter;
        }

        /**
         * Get the friendly taxonomy name, if given a taxonomy slug.
         *
         * @param string $tax_slug Taxonomy slug.
         *
         * @return string Friendly name of taxonomy, or empty string if not a valid taxonomy.
         */
        protected function get_taxonomy_name_from_slug($tax_slug) {
            $tax_obj = get_taxonomy($tax_slug);
            if (!$tax_obj) {
                return '';
            }

            return $tax_obj->labels->name;
        }

        /**
         * Build a series of option elements from an array.
         *
         * Also checks to see if one of the options is selected.
         *
         * @param array  $terms            Array of term objects.
         * @param string $current_tax_slug Slug of currently selected term.
         *
         * @return string Markup.
         */
        protected function build_term_options($terms, $current_tax_slug) {
            $options = '';
            foreach ($terms as $term) {
                $options .= sprintf(
                    "<option value='%s' %s />%s</option>",
                    esc_attr($term->slug),
                    selected($current_tax_slug, $term->slug, false),
                    esc_html($term->name . '(' . $term->count . ')')
                );
                // $options .= selected( $current_tax_slug, $term->slug );
            }

            return $options;
        }

    }
endif;