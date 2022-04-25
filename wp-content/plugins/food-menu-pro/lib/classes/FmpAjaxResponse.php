<?php

if (!class_exists('FmpAjaxResponse')):

    class FmpAjaxResponse {

        public function __construct() {
            add_action('wp_ajax_fmp_ajax', array($this, 'fmp_ajax'));
            add_action('wp_ajax_nopriv_fmp_ajax', array($this, 'fmp_ajax'));
            add_action('wp_ajax_fmpShortCodeList', array($this, 'shortCodeList'));

            add_action('wp_ajax_fmp_sc_source_change', array($this, 'fmp_sc_source_change'));

            add_action('wp_ajax_fmp_wc_ajax_add_to_cart', array($this, 'fmp_wc_ajax_add_to_cart'));
            add_action('wp_ajax_nopriv_fmp_wc_ajax_add_to_cart', array($this, 'fmp_wc_ajax_add_to_cart'));
        }

        public function fmp_sc_source_change() {
            $catList = '';
            $source = esc_attr($_REQUEST['source']);
            $source = ($source && in_array($source, array_keys(TLPFoodMenu()->scProductSource()))) ? $source : TLPFoodMenu()->post_type;

            $terms = array();
            if ($source == 'product' && TLPFoodMenu()->isWcActive()) {
                $termList = get_terms('product_cat', array('hide_empty' => 0));
                if (is_array($termList) && !empty($termList) && empty($termList['errors'])) {
                    $terms = $termList;
                }
            } else {
                $termList = get_terms(TLPFoodMenu()->taxonomies['category'], array('hide_empty' => 0));
                if (is_array($termList) && !empty($termList) && empty($termList['errors'])) {
                    $terms = $termList;
                }
            }
            if (!empty($terms)) {
                foreach ($terms as $term) {
                    $catList .= "<option value='{$term->term_id}'>{$term->name}</option>";
                }
            }

            wp_send_json(array(
                'cat_list' => $catList,
                'x'        => $_REQUEST
            ));
            die();
        }

        public function fmp_ajax() {
            $content = '';
            if (!empty($_REQUEST['id']) && $id = absint($_REQUEST['id'])) {

                global $post;
                $post = get_post(absint($id));
                setup_postdata($post);
                $ingredient = get_post_meta($id, '_ingredient_status', true);
                $nutrition = get_post_meta($id, '_nutrition_status', true);
                ob_start();
                echo "<div class='fmp-popup-container'>";
                do_action('fmp_single_summery');
                if ($ingredient || $nutrition) {
                    echo "<div class='fmp-ingredient-nutrition-wrapper'>";
                    if ($ingredient) {
                        echo "<div class='fmp-popup-ingredient'>";
                        echo "<h3>" . __('Ingredients', 'food-menu-pro') . "</h3>";
                        echo FMP()->get_fm_ingredient_list($id);
                        echo "</div>";
                    }
                    if ($nutrition) {
                        echo "<div class='fmp-popup-nutrition'>";
                        echo "<h3>" . __('Nutrition', 'food-menu-pro') . "</h3>";
                        echo FMP()->get_fm_nutrition_list($id);
                        echo "</div>";
                    }
                    echo "</div>";
                }
                echo "</div>";
                $content = ob_get_clean();
                wp_reset_postdata();
            }
            wp_send_json(array('html' => $content));
            die();
        }

        function shortCodeList() {
            $html = null;
            $scQ = new WP_Query(array('post_type' => TLPFoodMenu()->shortCodePT, 'order_by' => 'title', 'order' => 'DESC', 'post_status' => 'publish', 'posts_per_page' => -1));
            if ($scQ->have_posts()) {

                $html .= "<div class='mce-container mce-form'>";
                $html .= "<div class='mce-container-body'>";
                $html .= '<label class="mce-widget mce-label" style="padding: 20px;font-weight: bold;" for="scid">' . __('Select Short code', 'the-post-grid-pro') . '</label>';
                $html .= "<select name='id' id='scid' style='width: 150px;margin: 15px;'>";
                $html .= "<option value=''>" . __('Default', 'food-menu-pro') . "</option>";
                while ($scQ->have_posts()) {
                    $scQ->the_post();
                    $html .= "<option value='" . get_the_ID() . "'>" . get_the_title() . "</option>";
                }
                $html .= "</select>";
                $html .= "</div>";
                $html .= "</div>";
            } else {
                $html .= "<div>" . __('No shortCode found.', 'food-menu-pro') . "</div>";
            }
            echo $html;
            die();
        }

        function fmp_wc_ajax_add_to_cart() {
            if (TLPFoodMenu()->isWcActive()) {
                $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
                $quantity = empty($_POST['quantity']) ? 1 : apply_filters('woocommerce_stock_amount', $_POST['quantity']);
                $variation_id = isset($_POST['variation_id']) ? absint($_POST['variation_id']) : 0;
                $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
                if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id)) {
                    do_action('woocommerce_ajax_added_to_cart', $product_id);
                    WC_AJAX::get_refreshed_fragments();
                } else {
                    $data = array(
                        'error'       => true,
                        'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
                    );
                    wp_send_json($data);
                }
            }
            wp_send_json(array(
                'error' => true,
                'msg'   => __("WooCommerce not installed", "food-menu-pro")
            ));
        }

    }
endif;