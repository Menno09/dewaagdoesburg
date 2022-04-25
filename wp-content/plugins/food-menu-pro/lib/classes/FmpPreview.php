<?php

if (!class_exists('FmpPreview')):

    class FmpPreview {

        function __construct() {
            add_filter('rt_fm_preview_data', [$this, 'preview_shortcode'], 10, 2);
            add_filter('rt_fm_preview_query_args', [$this, 'preview_query_args'], 5, 2);
            add_filter('rt_fm_preview_row_class', [$this, 'row_class'], 10, 2);
            add_action('fmp_sc_preview_css', [$this, 'layoutStyle'], 10, 2);
            add_action('rt_fm_preview_before_loop', [$this, 'add_container_before_shortcode'], 10, 2);
            add_action('rt_fm_preview_after_loop', [$this, 'add_container_after_shortcode']);
        }

        function add_container_before_shortcode($scMeta, $rand) {
            $layout = (!empty($scMeta['fmp_layout']) ? $scMeta['fmp_layout'] : 'layout-free');
            if (!in_array($layout, array_keys(TLPFoodMenu()->scLayout()))) {
                $layout = 'layout-free';
            }

            $isCarousel = preg_match('/carousel/', $layout);
            $isIsotope = preg_match('/isotope/', $layout);

            $source = (!empty($scMeta['fmp_source']) ? $scMeta['fmp_source'] : 'food-menu');
            $args['post_type'] = ($source && in_array($source, array_keys(TLPFoodMenu()->scProductSource()))) ? $source : TLPFoodMenu()->post_type;
            $categoryTaxonomy = ($args['post_type'] == 'product') ? 'product_cat' : TLPFoodMenu()->taxonomies['category'];

            $cats = (isset($scMeta['fmp_categories']) ? array_filter($scMeta['fmp_categories']) : array());

            $html = '';

            if ($isIsotope) {
                $metaKey = ($categoryTaxonomy === "product") ? 'order' : '_order';
                if (function_exists('get_term_meta')) {
                    $terms = get_terms(array(
                        'taxonomy'   => $categoryTaxonomy,
                        'hide_empty' => false,
                        'orderby'    => 'meta_value_num',
                        'order'      => 'ASC',
                        'meta_query'   => [
                            'relation' => 'OR',
                            [
                                'key' => $metaKey,
                                'compare' => 'NOT EXISTS'
                            ],
                            [
                                'key' => $metaKey,
                                'type' => 'NUMERIC'
                            ]
                        ],
                        'include'    => $cats
                    ));
                } else {
                    $terms = get_terms($categoryTaxonomy, array(
                        'hide_empty' => false,
                        'orderby'    => 'meta_value_num',
                        'order'      => 'ASC',
                        'meta_query'   => [
                            'relation' => 'OR',
                            [
                                'key' => $metaKey,
                                'compare' => 'NOT EXISTS'
                            ],
                            [
                                'key' => $metaKey,
                                'type' => 'NUMERIC'
                            ]
                        ],
                        'include'    => $cats
                    ));
                }

                $html .= '<div class="fmp-iso-filter"><div id="iso-button-' . $rand . '" class="fmp-isotope-buttons button-group filter-button-group option-set">';
                $htmlButton = null;
                $fSelectTrigger = false;
                if (!empty($terms) && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        $tItem = !empty($scMeta['fmp_isotope_selected_filter']) ? $scMeta['fmp_isotope_selected_filter'] : null;
                        $fSelect = null;
                        if ($tItem == $term->term_id) {
                            $fSelect = 'class="selected"';
                            $fSelectTrigger = true;
                        }
                        $htmlButton .= "<button data-filter='.iso_{$term->term_id}' {$fSelect}>" . $term->name . "</button>";
                    }
                }
                if (empty($scMeta['fmp_isotope_filter_show_all'])) {
                    $fSelect = ($fSelectTrigger ? null : 'class="selected"');
                    $html .= "<button data-filter='*' {$fSelect}>" . __('Show all',
                            'food-menu-pro') . "</button>";
                }
                $html .= $htmlButton;
                $html .= '</div>';
                if (!empty($scMeta['fmp_isotope_search_filtering'])) {
                    $html .= "<div class='iso-search'><input type='text' class='iso-search-input' placeholder='" . __('Search',
                            'food-menu-pro') . "' /></div>";
                }
                $html .= '</div>';

                $html .= '<div class="fmp-isotope" id="fmp-isotope-' . $rand . '">';
            } elseif ($isCarousel) {
                $items = !empty($scMeta['fmp_carousel_items_per_slider']) ? absint($scMeta['fmp_carousel_items_per_slider']) : 3;
                $smartSpeed = !empty($scMeta['fmp_carousel_speed']) ? absint($scMeta['fmp_carousel_speed']) : 250;
                $autoplayTimeout = !empty($scMeta['fmp_carousel_autoplay_timeout']) ? absint($scMeta['fmp_carousel_autoplay_timeout']) : 5000;
                $cOpt = !empty($scMeta['fmp_carousel_options']) ? $scMeta['fmp_carousel_options'] : array();
                $autoPlay = (in_array('autoplay', $cOpt) ? 'true' : 'false');
                $autoPlayHoverPause = (in_array('autoplayHoverPause', $cOpt) ? 'true' : 'false');
                $nav = (in_array('nav', $cOpt) ? 'true' : 'false');
                $dots = (in_array('dots', $cOpt) ? 'true' : 'false');
                $loop = (in_array('loop', $cOpt) ? 'true' : 'false');
                $lazyLoad = (in_array('lazyLoad', $cOpt) ? 'true' : 'false');
                $autoHeight = (in_array('autoHeight', $cOpt) ? 'true' : 'false');
                $rtl = (in_array('rtl', $cOpt) ? 'true' : 'false');

                $html .= "<div class='fmp-carousel owl-carousel owl-theme'
										data-loop='{$loop}'
			                            data-items='{$items}'
			                            data-autoplay='{$autoPlay}'
			                            data-autoplay-timeout='{$autoplayTimeout}'
			                            data-autoplay-hover-pause='{$autoPlayHoverPause}'
			                            data-dots='{$dots}'
			                            data-nav='{$nav}'
			                            data-lazyLoad='{$lazyLoad}'
			                            data-autoHeight='{$autoHeight}'
			                            data-rtl='{$rtl}'
			                            data-smafmp-speed='{$smartSpeed}'
										>";
            }
            echo $html;
        }

        function add_container_after_shortcode($scMeta) {
            $layout = (!empty($scMeta['fmp_layout']) ? $scMeta['fmp_layout'] : 'layout-free');
            if (!in_array($layout, array_keys(TLPFoodMenu()->scLayout()))) {
                $layout = 'layout-free';
            }

            $isCarousel = preg_match('/carousel/', $layout);
            $isIsotope = preg_match('/isotope/', $layout);

            $html = '';
            if ($isIsotope || $isCarousel) {
                $html .= '</div>'; // End isotope / Carousel item holder
            }
            echo $html;
        }

        function row_class($class, $scMeta) {
            $layout = (!empty($scMeta['fmp_layout']) ? $scMeta['fmp_layout'] : 'layout-free');
            if (!in_array($layout, array_keys(TLPFoodMenu()->scLayout()))) {
                $layout = 'layout-free';
            }

            $gridType = !empty($scMeta['fmp_grid_style']) ? $scMeta['fmp_grid_style'] : 'even';

            $isCarousel = preg_match('/carousel/', $layout);
            $isIsotope = preg_match('/isotope/', $layout);

            if ($isCarousel || $isIsotope) {
                $class['preLoader'] .= ' fmp-pre-loader';
            }

            if ($gridType == "even") {
                $class['masonryG'] .= " fmp-even";
            } else if ($gridType == "masonry" && !$isIsotope && !$isCarousel) {
                $class['masonryG'] .= " fmp-masonry";
            }

            return $class;
        }

        function preview_shortcode( $arg, $scMeta ) {
            $scID = $scMeta['sc_id'];
            // Add image shape class
            $image_shape = !empty($scMeta['fmp_image_shape']) ? $scMeta['fmp_image_shape'] : null;
            if ($image_shape == 'circle') {
                $arg['class'] .= ' fmp-img-circle';
            }
            // Add carousel class
            $layout = (!empty($scMeta['fmp_layout']) ? $scMeta['fmp_layout'] : 'layout-free');
            if (!in_array($layout, array_keys(TLPFoodMenu()->scLayout()))) {
                $layout = 'layout-free';
            }

            $isCarousel = preg_match('/carousel/', $layout);
            $isIsotope = preg_match('/isotope/', $layout);

            if ($isCarousel) {
                $arg['class'] .= ' fmp-carousel-item';
            }
            // Add isotope class
            if ($isIsotope) {
                $arg['class'] .= ' fmp-isotope-item';
            }
            // Add layout class
            $gridType = !empty($scMeta['fmp_grid_style']) ? $scMeta['fmp_grid_style'] : 'even';
            $arg['class'] .= " {$gridType}-grid-item";
            // Add margin class
            $margin = !empty($scMeta['fmp_margin']) ? $scMeta['fmp_margin'] : 'default';
            if ($margin == 'no') {
                $arg['class'] .= ' no-margin';
            }
            // Custom image size
            $arg['customImgSize'] = get_post_meta($scID, 'fmp_custom_image_size', true);
            // Default image
            $arg['defaultImgId'] = (!empty($scMeta['fmp_placeholder_image']) ? absint($scMeta['fmp_placeholder_image']) : null);
            // Read more button text
            $arg['read_more'] = !empty($scMeta['fmp_read_more_button_text']) ? esc_attr($scMeta['fmp_read_more_button_text']) : null;
            // Add to cart button text
            $arg['add_to_cart_text'] = !empty($scMeta['fmp_add_to_cart_text']) ? esc_attr($scMeta['fmp_add_to_cart_text']) : __("Add to cart", "food-menu-pro");
            // Popup
            $popup = !empty($scMeta['fmp_single_food_popup']) ? true : false;
            if ($arg['link'] && $popup) {
                $arg['anchorClass'] .= ' fmp-popup';
            }

            return $arg;
        }

        function preview_query_args( $args, $scMeta ) {

            $layout = (!empty($scMeta['fmp_layout']) ? $scMeta['fmp_layout'] : 'layout-free');
            if (!in_array($layout, array_keys(TLPFoodMenu()->scLayout()))) {
                $layout = 'layout-free';
            }

            $isCarousel = preg_match('/carousel/', $layout);

            $limit = ((empty($scMeta['fmp_limit']) || $scMeta['fmp_limit'] === '-1') ? 10000000 : (int)$scMeta['fmp_limit']);
            $pagination = (!empty($scMeta['fmp_pagination']) ? true : false);

            if ($pagination) {
                $posts_per_page = (isset($scMeta['fmp_posts_per_page']) ? intval($scMeta['fmp_posts_per_page']) : $limit);

                if ($posts_per_page > $limit) {
                    $posts_per_page = $limit;
                }

                // Set 'posts_per_page' parameter
                $args['posts_per_page'] = $posts_per_page;

                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                $offset = $posts_per_page * ((int)$paged - 1);
                $args['paged'] = $paged;

                // Update posts_per_page
                if (intval($args['posts_per_page']) > $limit - $offset) {
                    $args['posts_per_page'] = $limit - $offset;
                }

            }

            if ($isCarousel) {
                $args['posts_per_page'] = $limit;
            }

            return $args;

        }

        function layoutStyle($ID, $scMeta) {
            $css = null;
            // Primary Color
            $primaryColor = (!empty($scMeta['fmp_primary_color']) ? $scMeta['fmp_primary_color'] : null);
            if ($primaryColor) {
                // Cat layout
                $css .= "#{$ID} .fmp-cat1 .fmp-cat-title:after,
						#{$ID} .fmp-layout1 .fmp-box span.fmp-price { ";
                $css .= "background :" . $primaryColor . ";";
                $css .= "}";


                $css .= "#{$ID} .fmp-cat1 .fmp-media-body h3, ";
                $css .= "#{$ID} .fmp-cat2 .fmp-box ul.menu-list li, ";
                $css .= "#{$ID} .fmp-cat1 .fmp-media-body h3 {";
                $css .= "border-color :" . $primaryColor . ";";
                $css .= "}";
            }
            // Overlay
            $overlay_color = (!empty($scMeta['fmp_overlay_color']) ? TLPFoodMenu()->rtHex2rgba($scMeta['fmp_overlay_color'],
                !empty($scMeta['fmp_overlay_opacity']) ? absint($scMeta['fmp_overlay_opacity']) / 100 : .8) : null);
            $overlay_padding = (!empty($scMeta['fmp_overlay_padding']) ? absint($scMeta['fmp_overlay_padding']) : null);
            if ($overlay_color || $overlay_padding) {
                $css .= "#{$ID} .fmp-layout1 .fmp-box .fmp-title,";
                $css .= "#{$ID} .fmp-layout1 .fmp-box .fmp-title h3,";
                $css .= "#{$ID} .fmp-layout-grid-by-cat2 .fmp-cat2 .fmp-cat-title:after {";
                if ($overlay_color) {
                    $css .= "background-color:" . $overlay_color . ";";
                }
                if ($overlay_padding) {
                    $css .= "top:" . $overlay_padding . "%;";
                }
                $css .= "}";
                if ($overlay_padding) {
                    $css .= "#{$ID} .fmp-layout1 .fmp-box .fmp-title,";
                    $css .= "#{$ID} .fmp-layout-grid-by-cat2 .fmp-cat2 .fmp-cat-title:after {";

                    $css .= "top:" . $overlay_padding . "%;";
                    $css .= "}";
                }
            }
            // Short Description
            $sDesc = (!empty($scMeta['fmp_short_description_style']) ? $scMeta['fmp_short_description_style'] : array());
            if (!empty($sDesc)) {
                $sDesc_color = (!empty($sDesc['color']) ? $sDesc['color'] : null);
                $sDesc_size = (!empty($sDesc['size']) ? absint($sDesc['size']) : null);
                $sDesc_weight = (!empty($sDesc['weight']) ? $sDesc['weight'] : null);
                $sDesc_alignment = (!empty($sDesc['align']) ? $sDesc['align'] : null);
                $css .= "#{$ID} .fmp-box .fmp-title p,";
                $css .= "#{$ID} .fmp-content-wrap > p,";
                $css .= "#{$ID} .fmp-media-body > p,";
                $css .= "#{$ID} .fmp-box li > p,";
                $css .= "#{$ID} .fmp-content > p,";
                $css .= "#{$ID} .fmp-media-body .info-part > p {";
                if ($sDesc_color) {
                    $css .= "color:" . $sDesc_color . ";";
                }
                if ($sDesc_size) {
                    $css .= "font-size:" . $sDesc_size . "px;";
                }
                if ($sDesc_weight) {
                    $css .= "font-weight:" . $sDesc_weight . ";";
                }
                if ($sDesc_alignment) {
                    $css .= "text-align:" . $sDesc_alignment . ";";
                }
                $css .= "}";
            }
            // Category name
            $cat = (!empty($scMeta['fmp_category_name_style']) ? $scMeta['fmp_category_name_style'] : array());
            if (!empty($cat)) {
                $cat_color = (!empty($cat['color']) ? $cat['color'] : null);
                $cat_size = (!empty($cat['size']) ? absint($cat['size']) : null);
                $cat_weight = (!empty($cat['weight']) ? $cat['weight'] : null);
                $cat_alignment = (!empty($cat['align']) ? $cat['align'] : null);

                $css .= "#{$ID} .fmp-category-title,";
                $css .= "#{$ID} .fmp-cat-title h2 {";

                if ($cat_color) {
                    $css .= "color:" . $cat_color . ";";
                }
                if ($cat_size) {
                    $css .= "font-size:" . $cat_size . "px;";
                }
                if ($cat_weight) {
                    $css .= "font-weight:" . $cat_weight . ";";
                }
                if ($cat_alignment) {
                    $css .= "text-align:" . $cat_alignment . ";";
                }
                $css .= "}";
                if ($cat_color) {
                    $css .= "#{$ID} .fmp-cat-title p.cat-description {";
                    $css .= "color:" . $cat_color . ";";
                    $css .= "}";
                }
            }

            echo $css;
        }

    }

endif;