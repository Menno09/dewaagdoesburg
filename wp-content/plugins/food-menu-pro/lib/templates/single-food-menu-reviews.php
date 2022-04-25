<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}
$food = FMP()->food();
?>
<div id="reviews" class="fmp-reviews">
	<div id="comments">
		<h2 class="fmp-reviews-title"><?php
			if ( $count = $food->get_review_count() ) {
				printf( _n( '%s review for %s%s%s', '%s reviews for %s%s%s', $count, 'food-menu-pro' ), $count,
					'<span>',
					get_the_title(), '</span>' );
			} else {
				_e( 'Reviews', 'food-menu-pro' );
			}
			?></h2>

		<?php if ( have_comments() ) : ?>

			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'fmp_product_review_list_args',
					array( 'callback' => 'FmpFilterHook::fmp_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="fmp-pagination">';
				paginate_comments_links( apply_filters( 'fmp_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="fmp-noreviews"><?php _e( 'There are no reviews yet.', 'food-menu-pro' ); ?></p>

		<?php endif; ?>
	</div>

	<div id="review_form_wrapper">
		<div id="review_form">
			<?php
			$commenter = wp_get_current_commenter();

			$comment_form = array(
				'title_reply'         => have_comments() ? __( 'Add a review',
					'food-menu-pro' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'food-menu-pro' ),
					get_the_title() ),
				'title_reply_to'      => __( 'Leave a Reply to %s', 'food-menu-pro' ),
				'comment_notes_after' => '',
				'fields'              => array(
					'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name',
							'food-menu-pro' ) . ' <span class="required">*</span></label> ' .
					            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" required /></p>',
					'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email',
							'food-menu-pro' ) . ' <span class="required">*</span></label> ' .
					            '<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" required /></p>',
				),
				'label_submit'        => __( 'Submit', 'food-menu-pro' ),
				'logged_in_as'        => '',
				'comment_field'       => ''
			);


			$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.',
					'food-menu-pro' ), esc_url( '/login/' ) ) . '</p>';
			// TODO need to check logged in url

			// TODO check for is rating is enable
			$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __( 'Your Rating',
					'food-menu-pro' ) . '</label><select name="rating" id="rating" aria-required="true" required>
							<option value="">' . __( 'Rate&hellip;', 'food-menu-pro' ) . '</option>
							<option value="5">' . __( 'Perfect', 'food-menu-pro' ) . '</option>
							<option value="4">' . __( 'Good', 'food-menu-pro' ) . '</option>
							<option value="3">' . __( 'Average', 'food-menu-pro' ) . '</option>
							<option value="2">' . __( 'Not that bad', 'food-menu-pro' ) . '</option>
							<option value="1">' . __( 'Very Poor', 'food-menu-pro' ) . '</option>
						</select></p>';

			$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review',
					'food-menu-pro' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>';

			comment_form( apply_filters( 'fmp_food_review_comment_form_args', $comment_form ) );
			?>
		</div>
	</div>

	<div class="clear"></div>
</div>
