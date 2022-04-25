<?php
/**
 * Sorting Class
 *
 * Drag and drop sorting up on menu order
 *
 * @package
 * @since 1.0
 * @author RadiusTheme
 */

if ( ! class_exists('FmpSorting') ) {

	class FmpSorting {

		function __construct() {
			//add_action( 'admin_init', array( $this, 'refresh' ) );
			add_action( 'wp_ajax_fmp-logo-update-menu-order', array( $this, 'fmp_logo_update_menu_order' ) );
			add_action( 'wp_ajax_fmp-cat-update-order', array( $this, 'fmp_cat_update_order' ) );
			add_action( 'pre_get_posts', array( $this, 'fmp_pre_get_posts' ) );
		}

		function fmp_pre_tax( $wp_query ) {

			/*echo "<pre>";
			print_r( $wp_query );
			echo "</pre>";*/
		}

		/**
		 * pre_get_posts Query update for FMP()->post_type
		 *
		 * @param $wp_query
		 */
		function fmp_pre_get_posts( $wp_query ) {

			if ( is_admin() ) {
				if ( isset( $wp_query->query['post_type'] ) && ! isset( $_GET['orderby'] ) && $wp_query->query['post_type'] == TLPFoodMenu()->post_type && $wp_query->is_main_query() ) {
					$wp_query->set( 'orderby', 'menu_order' );
					$wp_query->set( 'order', 'ASC' );
				}
			}
		}


		/**
		 * Update menu order for FMP()->post_type
		 * @return bool
		 */
		function fmp_logo_update_menu_order() {
			global $wpdb;
			$data = ( ! empty( $_POST['post'] ) ? $_POST['post'] : array() );
			if ( ! is_array( $data ) ) {
				return false;
			}

			$id_arr = array();
			foreach ( $data as $position => $id ) {
				$id_arr[] = $id;
			}

			$menu_order_arr = array();
			foreach ( $id_arr as $key => $id ) {
				$results = $wpdb->get_results( "SELECT menu_order FROM $wpdb->posts WHERE ID = " . intval( $id ) );
				foreach ( $results as $result ) {
					$menu_order_arr[] = $result->menu_order;
				}
			}


			sort( $menu_order_arr );

			foreach ( $data as $position => $id ) {
				$wpdb->update( $wpdb->posts, array( 'menu_order' => $menu_order_arr[ $position ] ), array( 'ID' => intval( $id ) ) );
			}

			die();
		}

		/**
		 * Update menu order for FMP()->post_type
		 * @return bool
		 */
		function fmp_cat_update_order() {
			global $wpdb;
			$data = ( ! empty( $_POST['tag'] ) ? $_POST['tag'] : array() );

			if ( ! is_array( $data ) ) {
				return false;
			}

			$id_arr = array();
			foreach ( $data as $position => $id ) {
				$id_arr[] = $id;
			}
			$order_arr = array();
			foreach ( $id_arr as $key => $id ) {
				$order_arr[] = get_term_meta( intval( $id ), '_order', true );
			}
			sort( $order_arr );

			foreach ( $data as $position => $id ) {
				update_term_meta( intval( $id ), '_order', $order_arr[ $position ] );
			}
			die();
		}


		/**
		 * Refresh database for  FMP()->post_type
		 *
		 */
		function refresh() {
			global $wpdb;
			$results = $wpdb->get_results( "
            SELECT ID
            FROM $wpdb->posts
            WHERE post_type = '" . TLPFoodMenu()->post_type . "' AND post_status IN ('publish', 'pending', 'draft', 'private', 'future')
            ORDER BY menu_order ASC
        " );
			foreach ( $results as $key => $result ) {
				$wpdb->update( $wpdb->posts, array( 'menu_order' => $key + 1 ), array( 'ID' => $result->ID ) );
			}

		}

	}

}