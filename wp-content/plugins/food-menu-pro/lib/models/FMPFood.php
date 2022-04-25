<?php

if ( ! class_exists( 'FMPFood' ) ):

	class FMPFood {
		public $id = 0;

		/**
		 * $post Stores post data.
		 *
		 * @var $post WP_Post
		 */
		public $post = null;

		/**
		 * The product's type (simple, variable etc).
		 *
		 * @var string
		 */
		public $product_type = null;

		/**
		 * Product shipping class.
		 *
		 * @var string
		 */
		protected $shipping_class    = '';

		/**
		 * ID of the shipping class this product has.
		 *
		 * @var int
		 */
		protected $shipping_class_id = 0;

		/** @public string The product's total stock, including that of its children. */
		public $total_stock;

		/**
		 * Supported features such as 'ajax_add_to_cart'.
		 * @var array
		 */
		protected $supports = array();

		public function __construct( $food ) {
			if ( is_numeric( $food ) ) {
				$this->id   = absint( $food );
				$this->post = get_post( $this->id );
			} elseif ( $food instanceof FMPFood ) {
				$this->id   = absint( $food->id );
				$this->post = $food->post;
			} elseif ( isset( $food->ID ) ) {
				$this->id   = absint( $food->ID );
				$this->post = $food;
			}else{
				global $post;
				$this->id = $post->ID;
			}
		}

		/**
		 * __isset function.
		 *
		 * @param mixed $key
		 * @return bool
		 */
		public function __isset( $key ) {
			return metadata_exists( 'post', $this->id, '_' . $key );
		}

		/**
		 * Get the product's post data.
		 *
		 * @return object
		 */
		public function get_post_data() {
			return $this->post;
		}


		public function get_review_count() {
			global $wpdb;

			// No meta date? Do the calculation
			if ( ! metadata_exists( 'post', $this->id, '_fmp_review_count' ) ) {
				$count = $wpdb->get_var( $wpdb->prepare("
				SELECT COUNT(*) FROM $wpdb->comments
				WHERE comment_parent = 0
				AND comment_post_ID = %d
				AND comment_approved = '1'
			", $this->id ) );

				update_post_meta( $this->id, '_fmp_review_count', $count );
			} else {
				$count = get_post_meta( $this->id, '_fmp_review_count', true );
			}

			return apply_filters( 'fmp_product_review_count', $count, $this );
		}
	}

endif;