<?php
if ( ! class_exists('FmpHelper') ) :

	class FmpHelper {
        function __construct() {
            add_filter('fmp_image_size', [$this, 'get_image_sizes']);
            add_filter('rt_fm_setting_fields', [$this, 'setting_fields']);
        }

        function get_image_sizes($imgSize) {
            $imgSize['fmp_custom'] = __("Custom image size", "food-menu-pro");

            return $imgSize;
        }

        public static function array_insert(&$array, $position, $insert_array) {
            $first_array = array_splice($array, 0, $position + 1);
            $array = array_merge($first_array, $insert_array, $array);
        }

        function food( $food = null ) {
            return new FMPFood( $food );
        }

        function setting_fields($settings) {
            return array_merge(
                $settings,
                FMP()->rtLicenceField()
            );
        }

        /**
         * @param null $post_id
         *
         * @return null|string
         */
        function get_fm_nutrition_list( $post_id = null ) {
            $post_id = absint( $post_id );
            if ( ! $post_id ) {
                global $post;
                $post_id = $post->ID;
            }
            $html      = null;
            $nutrition = get_post_meta( $post_id, '_nutrition' );
            if ( ! empty( $nutrition ) ) {
                $html .= "<ul>";
                foreach ( $nutrition as $nutrition ) {
                    $nut   = ! empty( $nutrition['id'] ) ? get_term( $nutrition['id'], TLPFoodMenu()->taxonomies['nutrition'] ) : null;
                    $unit  = ! empty( $nutrition['unit_id'] ) ? get_term( $nutrition['unit_id'], TLPFoodMenu()->taxonomies['unit'] ) : null;
                    $value = ! empty( $nutrition['value'] ) ? ' ' . $nutrition['value'] : null;
                    if ( is_object( $unit ) && ! empty( $unit->name ) && $value ) {
                        $unit = " ( {$unit->name} )";
                    } else {
                        $unit = null;
                    }
                    if ( is_object( $nut ) ) {
                        $html .= "<li>{$nut->name}{$value}{$unit}</li>";
                    }
                }
                $html .= "</ul>";
            };

            return $html;
        }


        /**
         * @param null $post_id
         *
         * @return null|string
         */
        function get_fm_ingredient_list( $post_id = null ) {
            $post_id = absint( $post_id );
            if ( ! $post_id ) {
                global $post;
                $post_id = $post->ID;
            }
            $html        = null;
            $ingredients = get_post_meta( $post_id, '_ingredient' );
            if ( ! empty( $ingredients ) ) {
                $html .= "<ul>";
                foreach ( $ingredients as $ingredient ) {
                    $ing   = ! empty( $ingredient['id'] ) ? get_term( $ingredient['id'], TLPFoodMenu()->taxonomies['ingredient'] ) : null;
                    $unit  = ! empty( $ingredient['unit_id'] ) ? get_term( $ingredient['unit_id'], TLPFoodMenu()->taxonomies['unit'] ) : null;
                    $value = ! empty( $ingredient['value'] ) ? ' ' . $ingredient['value'] : null;
                    if ( is_object( $unit ) && $unit->name && $value ) {
                        $unit = " ( {$unit->name} )";
                    } else {
                        $unit = null;
                    }
                    if ( is_object( $ing ) ) {
                        $html .= "<li>{$ing->name}{$value}{$unit}</li>";
                    }

                }
                $html .= "</ul>";
            };

            return $html;
        }

        /**
         * Returns the product tags.
         *
         * @param        $id
         * @param string $sep (default: ', ')
         * @param string $before (default: '')
         * @param string $after (default: '')
         *
         * @return array
         */
        public function get_tags( $id, $sep = ', ', $before = '', $after = '' ) {
            return get_the_term_list( $id, TLPFoodMenu()->taxonomies['tag'], $before, $sep, $after );
        }

        function pagination( $pages = '', $range = 4, $ajax = false, $scID = '' ) {

            $html      = null;
            $showitems = ( $range * 2 ) + 1;
            global $paged;
            if ( empty( $paged ) ) {
                $paged = 1;
            }
            if ( $pages == '' ) {
                global $wp_query;
                $pages = $wp_query->max_num_pages;
                if ( ! $pages ) {
                    $pages = 1;
                }
            }
            $ajaxClass = null;
            $dataAttr  = null;

            if ( $ajax ) {
                $ajaxClass = ' fmp-ajax';
                $dataAttr  = "data-sc-id='{$scID}' data-paged='1'";
            }

            if ( 1 != $pages ) {

                $html .= '<div class="fmp-pagination' . $ajaxClass . '" ' . $dataAttr . '>';
                $html .= '<ul class="pagination-list">';
                if ( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) {
                    $html .= "<li><a data-paged='1' href='" . get_pagenum_link( 1 ) . "' aria-label='First'>&laquo;</a></li>";
                }

                if ( $paged > 1 && $showitems < $pages ) {
                    $p    = $paged - 1;
                    $html .= "<li><a data-paged='{$p}' href='" . get_pagenum_link( $p ) . "' aria-label='Previous'>&lsaquo;</a></li>";
                }


                for ( $i = 1; $i <= $pages; $i ++ ) {
                    if ( 1 != $pages && ( ! ( $i >= $paged + $range + 1 || $i <= $paged - $range - 1 ) || $pages <= $showitems ) ) {
                        $html .= ( $paged == $i ) ? "<li class=\"active\"><span>" . $i . "</span>

    </li>" : "<li><a data-paged='{$i}' href='" . get_pagenum_link( $i ) . "'>" . $i . "</a></li>";

                    }

                }

                if ( $paged < $pages && $showitems < $pages ) {
                    $p    = $paged + 1;
                    $html .= "<li><a data-paged='{$p}' href=\"" . get_pagenum_link( $paged + 1 ) . "\"  aria-label='Next'>&rsaquo;</a></li>";
                }

                if ( $paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages ) {
                    $html .= "<li><a data-paged='{$pages}' href='" . get_pagenum_link( $pages ) . "' aria-label='Last'>&raquo;</a></li>";
                }

                $html .= "</ul>";
                $html .= "</div>";
            }

            return $html;

        }

    }
endif;