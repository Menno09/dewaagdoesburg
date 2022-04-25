<?php

if ( ! class_exists('FmpComments') ):

	class FmpComments {

		public function __construct() {
			add_action( 'comment_post', array( __CLASS__, 'add_comment_rating' ), 1 );
			// Clear transients
			add_action( 'wp_update_comment_count', array( __CLASS__, 'clear_transients' ) );


			// Count comments
			add_filter( 'wp_count_comments', array( __CLASS__, 'wp_count_comments' ), 10, 2 );

			// Delete comments count cache whenever there is a new comment or a comment status changes
			add_action( 'wp_insert_comment', array( __CLASS__, 'delete_comments_count_cache' ) );
			add_action( 'wp_set_comment_status', array( __CLASS__, 'delete_comments_count_cache' ) );

			// Support avatars for `review` comment type
			add_filter( 'get_avatar_comment_types', array( __CLASS__, 'add_avatar_for_review_comment_type' ) );

			// Review of verified purchase TODO
		}

		/**
		 * Rating field for comments.
		 *
		 * @param int $comment_id
		 */
		public static function add_comment_rating( $comment_id ) {
			if ( isset( $_POST['rating'] ) && TLPFoodMenu()->post_type === get_post_type( $_POST['comment_post_ID'] ) ) {
				if ( ! $_POST['rating'] || $_POST['rating'] > 5 || $_POST['rating'] < 0 ) {
					return;
				}
				add_comment_meta( $comment_id, 'rating', (int) esc_attr( $_POST['rating'] ), true );
			}
		}

		public static function clear_transients( $post_id ) {
			delete_post_meta( $post_id, '_fmp_average_rating' );
			delete_post_meta( $post_id, '_fmp_rating_count' );
			delete_post_meta( $post_id, '_fmp_review_count' );
		}

		/**
		 * Delete comments count cache whenever there is
		 * new comment or the status of a comment changes. Cache
		 * will be regenerated next time WC_Comments::wp_count_comments()
		 * is called.
		 *
		 * @return void
		 */
		public static function delete_comments_count_cache() {
			delete_transient( 'fmp_count_comments' );
		}


		/**
		 * Remove order notes from wp_count_comments().
		 * @since  2.2
		 * @param  object $stats
		 * @param  int $post_id
		 * @return object
		 */
		public static function wp_count_comments( $stats, $post_id ) {
			global $wpdb;

			if ( 0 === $post_id ) {
				$stats = get_transient( 'fmp_count_comments' );

				if ( ! $stats ) {
					$stats = array();

					$count = $wpdb->get_results( "SELECT comment_approved, COUNT( * ) AS num_comments FROM {$wpdb->comments} WHERE comment_type != 'order_note' GROUP BY comment_approved", ARRAY_A );

					$total = 0;
					$approved = array( '0' => 'moderated', '1' => 'approved', 'spam' => 'spam', 'trash' => 'trash', 'post-trashed' => 'post-trashed' );

					foreach ( (array) $count as $row ) {
						// Don't count post-trashed toward totals
						if ( 'post-trashed' != $row['comment_approved'] && 'trash' != $row['comment_approved'] ) {
							$total += $row['num_comments'];
						}
						if ( isset( $approved[ $row['comment_approved'] ] ) ) {
							$stats[ $approved[ $row['comment_approved'] ] ] = $row['num_comments'];
						}
					}

					$stats['total_comments'] = $total;
					$stats['all'] = $total;
					foreach ( $approved as $key ) {
						if ( empty( $stats[ $key ] ) ) {
							$stats[ $key ] = 0;
						}
					}

					$stats = (object) $stats;
					set_transient( 'fmp_count_comments', $stats );
				}
			}

			return $stats;
		}

		/**
		 * Make sure WP displays avatars for comments with the `review` type.
		 * @since  2.3
		 * @param  array $comment_types
		 * @return array
		 */
		public static function add_avatar_for_review_comment_type( $comment_types ) {
			return array_merge( $comment_types, array( 'review' ) );
		}

	}

endif;
