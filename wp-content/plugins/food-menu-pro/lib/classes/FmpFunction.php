<?php

if (!class_exists('FmpFunction')):

    /**
     *
     */
    class FmpFunction {

        function __construct() {

        }

        function getStockStatus($id = null) {
            if ($id) {
                $id = absint($id);
            } else {
                $id = get_the_ID();
            }
            $stock = get_post_meta($id, '_stock_status', true);
            $stockHtml = null;
            $fmp_type = get_post_meta($id, '_fmp_type', true);
            if ('variable' === $fmp_type) {
                $stockHtml = '<span class="na">–</span>';
            } else {
                if ($stock == "instock") {
                    $stockHtml = '<mark class="instock">In stock</mark>';
                } elseif ($stock == "outofstock") {
                    $stockHtml = '<mark class="outofstock">Out of stock</mark>';
                }
            }


            return $stockHtml;
        }

        function fmpHtmlPrice($id = null) {
            if ($id) {
                $id = absint($id);
            } else {
                global $post;
                $id = $post->ID;
            }
            $price_html = null;
            $sale_price_html = null;
            $regular_price_html = null;
            $regular_price = get_post_meta($id, '_regular_price', true);
            $sale_price = get_post_meta($id, '_sale_price', true);

            if ($regular_price > 0) {
                $fRegularPrice = $this->getPriceWithSymbol($regular_price);
                $regular_price_html = '<span class="fmp-price-amount amount">' . $fRegularPrice . '</span>';
            }
            if ($sale_price > 0) {
                $fSalePrice = $this->getPriceWithSymbol($sale_price);
                $sale_price_html = '<span class="fmp-price-amount amount">' . $fSalePrice . '</span>';
            } elseif ($sale_price == '') {
                $sale_price_html = null;
            } elseif ($sale_price == 0) {
                $sale_price_html = '<span class="amount">' . __('Free!', 'food-menu-pro') . '</span>';
            }

            if ($regular_price_html && $sale_price_html) {
                $price_html = '<del>' . $regular_price_html . '</del>' . '<inc>' . $sale_price_html . '</inc>';
            } elseif (!$regular_price_html && $sale_price_html) {
                $price_html = $sale_price_html;
            } elseif ($regular_price_html && !$sale_price_html) {
                $price_html = $regular_price_html;
            }
            $fmp_type = get_post_meta($id, '_fmp_type', true);
            if ('variable' === $fmp_type) {
                $vPrices = array();
                $variations = get_posts(array(
                    'post_type'      => 'fmp_variation',
                    'posts_per_page' => -1,
                    'post_status'    => 'any',
                    'post_parent'    => $id,
                    'order'          => 'ASC'
                ));
                if (!empty($variations)) {
                    foreach ($variations as $variation) {
                        $vp = get_post_meta($variation->ID, '_price', true);
                        if ($vp) {
                            $vPrices[] = $vp;
                        }
                    }
                    if (!empty($vPrices) && count($vPrices) > 1) {
                        $max = $this->getPriceWithSymbol(max($vPrices));
                        $min = $this->getPriceWithSymbol(min($vPrices));
                        $price_html = $min . ' - ' . $max;
                    } else if (!empty($vPrices) && count($vPrices) == 1) {
                        $price_html = $this->getPriceWithSymbol(max($vPrices));
                    } else {
                        $price_html = "<span class='na'>–</span>";
                    }
                }
            }

            return $price_html;
        }

        static function get_formatted_amount($amount) {
            $settings = get_option(TLPFoodMenu()->options['settings']);
            $thousands_sep = isset($settings['price_thousand_sep']) ? stripslashes($settings['price_thousand_sep']) : ',';
            $decimal_sep = isset($settings['price_decimal_sep']) ? stripslashes($settings['price_decimal_sep']) : '.';
            $decimals = isset($settings['price_num_decimals']) ? absint($settings['price_num_decimals']) : 2;

            $un_formatted_price = $amount;
            $negative = $amount < 0;
            $amount = apply_filters('fmp_raw_amount', floatval($negative ? $amount * -1 : $amount));
            $amount = apply_filters('fmp_formatted_amount', number_format($amount, $decimals, $decimal_sep, $thousands_sep));

            if (apply_filters('fmp_price_trim_zeros', false, $decimals) && $decimals > 0) {
                $amount = self::trim_zeros($amount, $decimal_sep);
            }

            return apply_filters('fmp_get_formatted_amount', $amount, $un_formatted_price, $decimals, $decimal_sep, $thousands_sep);

        }

        static function trim_zeros($amount, $decimal_sep) {
            return preg_replace('/' . preg_quote($decimal_sep, '/') . '0++$/', '', $amount);
        }

        function getPriceWithSymbol($price) {
            $price = self::get_formatted_amount($price);
            $currencyP = TLPFoodMenu()->getCurrencyPosition();
            $symbol = '<span class="fmp-price-currencySymbol">' . TLPFoodMenu()->getCurrencySymbol() . '</span>';

            switch ($currencyP) {
                case 'left':
                    $price = $symbol . $price;
                    break;

                case 'right':
                    $price = $price . $symbol;
                    break;

                case 'left_space':
                    $price = $symbol . " " . $price;
                    break;

                case 'right_space':
                    $price = $price . " " . $symbol;
                    break;

                default:

                    break;
            }

            return $price;
        }

        function fmp_clean($var) {
            if (is_array($var)) {
                return array_map(array($this, 'fmp_clean'), $var);
            } else {
                return is_scalar($var) ? sanitize_text_field($var) : $var;
            }
        }
    }

endif;
