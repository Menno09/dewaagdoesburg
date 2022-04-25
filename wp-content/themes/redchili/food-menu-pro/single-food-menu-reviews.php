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
				printf( _n( '%s review for %s%s%s', '%s reviews for %s%s%s', $count, 'redchili' ), $count,
					'<span>',
					get_the_title(), '</span>' );
			} else {
				esc_html_e( 'Reviews', 'redchili' );
			}
			?></h2>
		
<?php $have_comments = have_comments(); echo esc_html($have_comments); ?>


		<?php if ( have_comments() ) : ?>

			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'fmp_product_review_list_args',
					array( 'callback' => 'FmFilterHook::fmp_comments' ) ) ); ?>
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

			<p class="fmp-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'redchili' ); ?></p>

		<?php endif; ?>
	</div>

	<div id="review_form_wrapper">
		<div id="review_form">
			<?php
			$commenter = wp_get_current_commenter();

			$comment_form = array(
				'title_reply'         => have_comments() ? esc_html__( 'Add a review',
					'redchili' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'redchili' ),
					get_the_title() ),
				'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'redchili' ),
				'comment_notes_after' => '',
				'fields'              => array(
					'author' => '<p class="comment-form-author">' . '<label for="author">' . esc_html__( 'Name',
							'redchili' ) . ' <span class="required">*</span></label> ' .
					            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" required /></p>',
					'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email',
							'redchili' ) . ' <span class="required">*</span></label> ' .
					            '<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" required /></p>',
				),
				'label_submit'        => esc_html__( 'Submit', 'redchili' ),
				'logged_in_as'        => '',
				'comment_field'       => ''
			);


			$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be <a href="%s">logged in</a> to post a review.',
					'redchili' ), esc_url( '/login/' ) ) . '</p>';
			// TODO need to check logged in url

			// TODO check for is rating is enable
			$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . esc_html__( 'Your Rating',
					'redchili' ) . '</label><select name="rating" id="rating" aria-required="true" required>
							<option value="">' . esc_html__( 'Rate&hellip;', 'redchili' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'redchili' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'redchili' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'redchili' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'redchili' ) . '</option>
							<option value="1">' . esc_html__( 'Very Poor', 'redchili' ) . '</option>
						</select></p>';

			$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Your Review',
					'redchili' ) . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>';

			comment_form( apply_filters( 'fmp_food_review_comment_form_args', $comment_form ) );
			?>
		</div>
	</div>

	<div class="clear"></div>
</div>
