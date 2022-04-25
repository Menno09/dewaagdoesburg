<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $comment;
$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

if ( $rating ) { ?>

	<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating"
	     title="<?php echo sprintf( esc_attr__( 'Rated %d out of 5', 'redchili' ), esc_attr( $rating ) ) ?>">
		<span style="width:<?php echo ( esc_attr( $rating ) / 5 ) * 100; ?>%"><strong
				itemprop="ratingValue"><?php echo esc_html( $rating ); ?></strong> <?php esc_html_e( 'out of 5',
				'redchili' ); ?></span>
	</div>

<?php }