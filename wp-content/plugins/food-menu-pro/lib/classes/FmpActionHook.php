<?php

if (!class_exists('FmpActionHook')):

    class FmpActionHook {

        public function __construct() {

            remove_action('fmp_single_summery', array(TLPFoodMenu(), 'fmp_summery_price'), 30);
            add_action('fmp_single_summery', array($this, 'fmp_summery_price'), 30);

            add_action('fmp_single_details', array($this, 'fmp_single_before_details'), 10);
            add_action('fmp_single_details', array($this, 'fmp_single_tabs'), 20);
            add_action('fmp_single_details', array($this, 'fmp_single_after_details'), 30);


            /* comment */
            add_action('fmp_review_before', array($this, 'fmp_review_display_gravatar'), 10);
            add_action('fmp_review_before_comment_meta', array($this, 'fmp_review_display_rating'), 10);
            add_action('fmp_review_meta', array($this, 'fmp_review_display_meta'), 10);
            //add_action( 'fmp_review_before_comment_text', array( $this, 'fmp_review_display_gravatar' ), 10 );
            add_action('fmp_review_comment_text', array($this, 'fmp_review_display_comment_text'), 10);
            //add_action( 'fmp_review_after_comment_text', array( $this, 'fmp_review_display_gravatar' ), 10 );

        }

        function fmp_summery_price() {
            $settings = get_option(TLPFoodMenu()->options['settings']);
            $hiddenOptions = !empty($settings['hide_options']) ? $settings['hide_options'] : array();
            if (!in_array('price', $hiddenOptions)) {
                global $post;
                if ($post->post_type == 'product' && TLPFoodMenu()->isWcActive()) {
                    woocommerce_template_single_price();
                    echo '<div class="wc-add-to-cart fmp-qv-add-to-cart">';
                    woocommerce_template_single_add_to_cart();
                    echo '</div>';
                } else {
                    $fmp_type = get_post_meta($post->ID, '_fmp_type', true);
                    if ('variable' === $fmp_type) {
                        $variations = get_posts(array(
                            'post_type'      => 'fmp_variation',
                            'posts_per_page' => -1,
                            'post_status'    => 'any',
                            'post_parent'    => $post->ID,
                            'order'          => 'ASC'
                        ));
                        $html = null;
                        if (!empty($variations)) {
                            $html .= '<table class="fmp-price-listing">';
                            foreach ($variations as $variation) {
                                $name = get_post_meta($variation->ID, '_name', true);
                                $price = FMP()->getPriceWithSymbol(get_post_meta($variation->ID, '_price', true));
                                $html .= "<tr><td>{$name}</td><td>{$price}</td>";
                            }
                            $html .= '</table>';
                        }
                        echo $html;
                    } else {
                        $gTotal = FMP()->fmpHtmlPrice();
                        echo "<div class='offers'>{$gTotal}</div>";
                    }
                }

            }
        }

        function fmp_review_display_rating() {
            FMP()->render('single/review-rating');
        }

        function fmp_review_display_meta() {
            FMP()->render('single/review-meta');
        }

        function fmp_review_display_comment_text() {
            echo '<div itemprop="description" class="description">';
            comment_text();
            echo '</div>';
        }

        function fmp_review_display_gravatar($comment) {
            echo get_avatar($comment, apply_filters('fmp_review_gravatar_size', '60'), '');
        }

        function fmp_single_before_details() {
            echo "<div id='fmp-single-details'>";
        }

        function fmp_single_tabs() {
            FMP()->render('single/tabs/tabs');
        }

        function fmp_single_after_details() {
            echo "</div>";
        }
    }
endif;