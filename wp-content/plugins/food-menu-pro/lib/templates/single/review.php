<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<li itemprop="review" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

		<?php
		/**
		 * The fmp_review_before hook
		 *
		 * @hooked fmp_review_display_gravatar - 10
		 */
		do_action( 'fmp_review_before', $comment );
		?>

		<div class="comment-text">

			<?php
			/**
			 * The fmp_review_before_comment_meta hook.
			 *
			 * @hooked fmp_review_display_rating - 10
			 */
			do_action( 'fmp_review_before_comment_meta', $comment );

			/**
			 * The fmp_review_meta hook.
			 *
			 * @hooked fmp_review_display_meta - 10
			 */
			do_action( 'fmp_review_meta', $comment );

			do_action( 'fmp_review_before_comment_text', $comment );

			/**
			 * The fmp_review_comment_text hook
			 *
			 * @hooked fmp_review_display_comment_text - 10
			 */
			do_action( 'fmp_review_comment_text', $comment );

			do_action( 'fmp_review_after_comment_text', $comment ); ?>

		</div>
	</div>
