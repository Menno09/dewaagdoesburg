<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $comment;
if ( '0' === $comment->comment_approved ) { ?>

	<p class="meta"><em><?php esc_attr_e( 'Your comment is awaiting approval', 'food-menu-pro' ); ?></em></p>

<?php } else { ?>

	<p class="meta">
		<strong itemprop="author"><?php comment_author(); ?></strong>&ndash; <time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( ); ?></time>:
	</p>

<?php }
