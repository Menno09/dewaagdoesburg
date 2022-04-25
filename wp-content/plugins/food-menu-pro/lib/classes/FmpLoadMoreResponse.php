<?php

if (!class_exists('FmpLoadMoreResponse')):

    class FmpLoadMoreResponse {

        public function __construct() {
            add_action('wp_ajax_fmpLoadMore', array($this, 'fmpLoadMore'));
            add_action('wp_ajax_nopriv_fmpLoadMore', array($this, 'fmpLoadMore'));
        }

        function fmpLoadMore() {
            $error = true;
            $msg = $data = null;
            if (TLPFoodMenu()->verifyNonce()) {
                $scID = intval($_REQUEST['scID']);
                if ($scID && !is_null(get_post($scID))) {
                    $scMeta = get_post_meta($scID);
                    $layout = (!empty($scMeta['fmp_layout'][0]) ? $scMeta['fmp_layout'][0] : 'layout-free');
                    if (!in_array($layout, array_keys(TLPFoodMenu()->scLayout()))) {
                        $layout = 'layout-free';
                    }
                    $dCol = (isset($scMeta['fmp_desktop_column'][0]) ? absint($scMeta['fmp_desktop_column'][0]) : 3);
                    $tCol = (isset($scMeta['fmp_tab_column'][0]) ? absint($scMeta['fmp_tab_column'][0]) : 2);
                    $mCol = (isset($scMeta['fmp_mobile_column'][0]) ? absint($scMeta['fmp_mobile_column'][0]) : 1);
                    if (!in_array($dCol, array_keys(TLPFoodMenu()->scColumns()))) {
                        $dCol = 3;
                    }
                    if (!in_array($tCol, array_keys(TLPFoodMenu()->scColumns()))) {
                        $tCol = 2;
                    }
                    if (!in_array($dCol, array_keys(TLPFoodMenu()->scColumns()))) {
                        $mCol = 1;
                    }
                    $imgSize = (!empty($scMeta['fmp_image_size'][0]) ? $scMeta['fmp_image_size'][0] : "medium");
                    $excerpt_limit = (!empty($scMeta['fmp_excerpt_limit'][0]) ? absint($scMeta['fmp_excerpt_limit'][0]) : 0);


                    $isIsotope = preg_match('/isotope/', $layout);
                    $isCarousel = preg_match('/carousel/', $layout);
                    $isCat = preg_match('/grid-by-cat/', $layout);

                    /* Argument create */
                    $containerDataAttr = false;
                    $args = $arg = array();
                    $source = get_post_meta($scID, 'fmp_source', true);
                    $args['post_type'] = ($source && in_array($source, array_keys(TLPFoodMenu()->scProductSource()))) ? $source : TLPFoodMenu()->post_type;
                    $categoryTaxonomy = ($args['post_type'] == 'product') ? 'product_cat' : TLPFoodMenu()->taxonomies['category'];
                    $arg['taxonomy'] = $categoryTaxonomy;
                    // Common filter
                    /* post__in */
                    $post__in = (isset($scMeta['fmp_post__in'][0]) ? $scMeta['fmp_post__in'][0] : null);
                    if ($post__in) {
                        $post__in = explode(',', $post__in);
                        $args['post__in'] = $post__in;
                    }
                    /* post__not_in */
                    $post__not_in = (isset($scMeta['fmp_post__not_in'][0]) ? $scMeta['fmp_post__not_in'][0] : null);
                    if ($post__not_in) {
                        $post__not_in = explode(',', $post__not_in);
                        $args['post__not_in'] = $post__not_in;
                    }

                    /* LIMIT */
                    $limit = ((empty($scMeta['fmp_limit'][0]) || $scMeta['fmp_limit'][0] === '-1') ? 10000000 : (int)$scMeta['fmp_limit'][0]);
                    $args['posts_per_page'] = $limit;
                    $pagination = (!empty($scMeta['fmp_pagination'][0]) ? true : false);

                    if ($pagination) {
                        $posts_per_page = (isset($scMeta['fmp_posts_per_page'][0]) ? intval($scMeta['fmp_posts_per_page'][0]) : $limit);
                        if ($posts_per_page > $limit) {
                            $posts_per_page = $limit;
                        }
                        // Set 'posts_per_page' parameter
                        $args['posts_per_page'] = $posts_per_page;

                        $paged = (!empty($_REQUEST['paged'])) ? absint($_REQUEST['paged']) : 2;

                        $offset = $posts_per_page * ((int)$paged - 1);
                        $args['paged'] = $paged;

                        // Update posts_per_page
                        if (intval($args['posts_per_page']) > $limit - $offset) {
                            $args['posts_per_page'] = $limit - $offset;
                        }

                    }

                    // Taxonomy
                    $cats = (isset($scMeta['fmp_categories']) ? array_filter($scMeta['fmp_categories']) : array());
                    $taxQ = array();
                    if (is_array($cats) && !empty($cats)) {
                        $taxQ[] = array(
                            'taxonomy' => $categoryTaxonomy,
                            'field'    => 'term_id',
                            'terms'    => $cats,
                        );
                    }
                    if (!empty($taxQ)) {
                        $args['tax_query'] = $taxQ;
                    }

                    // Order
                    $order_by = (isset($scMeta['fmp_order_by'][0]) ? $scMeta['fmp_order_by'][0] : null);
                    $order = (isset($scMeta['fmp_order'][0]) ? $scMeta['fmp_order'][0] : null);
                    if ($order) {
                        $args['order'] = $order;
                    }
                    if ($order_by) {
                        if ($order_by == "price") {
                            $args['orderby'] = 'meta_value_num';
                            $args['meta_key'] = '_price';
                        } else {
                            $args['orderby'] = $order_by;
                        }
                    }


                    // Validation
                    $dCol = round(12 / $dCol);
                    $tCol = round(12 / $tCol);
                    $mCol = round(12 / $mCol);
                    if ($isCarousel) {
                        $dCol = $tCol = $mCol = 12;
                    }

                    $arg['grid'] = "fmp-col-lg-{$dCol} fmp-col-md-{$dCol} fmp-col-sm-{$tCol} fmp-col-xs-{$mCol}";
                    $gridType = !empty($scMeta['fmp_grid_style'][0]) ? $scMeta['fmp_grid_style'][0] : 'even';

                    $arg['customImgSize'] = get_post_meta($scID, 'fmp_custom_image_size', true);
                    $arg['defaultImgId'] = (!empty($scMeta['fmp_placeholder_image'][0]) ? absint($scMeta['fmp_placeholder_image'][0]) : null);

                    $arg['read_more'] = !empty($scMeta['fmp_read_more_button_text'][0]) ? esc_attr($scMeta['fmp_read_more_button_text'][0]) : null;
                    $arg['class'] = $gridType . "-grid-item";
                    $arg['class'] .= " fmp-grid-item";
                    if ($isIsotope) {
                        $arg['class'] .= ' fmp-isotope-item';
                    }
                    if ($isCarousel) {
                        $arg['class'] .= ' fmp-carousel-item';
                    }
                    $margin = !empty($scMeta['fmp_margin'][0]) ? $scMeta['fmp_margin'][0] : 'default';
                    if ($margin == 'no') {
                        $arg['class'] .= ' no-margin';
                    }

                    $image_shape = !empty($scMeta['fmp_image_shape'][0]) ? $scMeta['fmp_image_shape'][0] : null;
                    if ($image_shape == 'circle') {
                        $arg['class'] .= ' fmp-img-circle';
                    }

                    $arg['items'] = !empty($scMeta['fmp_item_fields']) ? $scMeta['fmp_item_fields'] : array();
                    $arg['anchorClass'] = null;
                    $link = !empty($scMeta['fmp_detail_page_link'][0]) ? true : false;
                    $popup = !empty($scMeta['fmp_single_food_popup'][0]) ? true : false;
                    if ($link) {
                        if ($popup) {
                            $arg['anchorClass'] .= ' fmp-popup';
                        }
                        $arg['link'] = true;
                    } else {
                        $arg['link'] = false;
                        $arg['anchorClass'] .= ' fmp-disable';
                    }

                    $arg['wc'] = TLPFoodMenu()->isWcActive();
                    $arg['source'] = $args['post_type'];
                    $fmpQuery = new WP_Query($args);
                    // Start layout
                    if ($fmpQuery->have_posts()) {

                        while ($fmpQuery->have_posts()) {
                            $fmpQuery->the_post();

                            $pID = get_the_ID();
                            $arg['pID'] = $pID;
                            $arg['title'] = get_the_title();
                            $arg['pLink'] = get_permalink();
                            $excerpt = get_the_excerpt();
                            $arg['excerpt'] = TLPFoodMenu()->strip_tags_content($excerpt, $excerpt_limit);
                            if ($isIsotope) {
                                $termAs = wp_get_post_terms($pID, $categoryTaxonomy,
                                    array("fields" => "all"));
                                $isoFilter = null;
                                if (!empty($termAs)) {
                                    foreach ($termAs as $term) {
                                        $isoFilter .= " " . "iso_" . $term->term_id;
                                    }
                                }
                                $arg['isoFilter'] = $isoFilter;
                            }
                            $arg['imgSize']    = $imgSize;
                            $data .= TLPFoodMenu()->render('layouts/' . $layout, $arg, true);

                        }
                        if (!empty($data)) {
                            $error = false;
                        }

                    } else {
                        $msg = __('No More Post to load', 'food-menu-pro');
                    }
                    wp_reset_postdata();

                } else {
                    $msg = __('No More Post to load', 'food-menu-pro');
                }
            } else {
                $msg = __('Security error', 'food-menu-pro');
            }
            wp_send_json(array(
                'error' => $error,
                'msg'   => $msg,
                'data'  => $data
            ));
            die();
        }

    }

endif;