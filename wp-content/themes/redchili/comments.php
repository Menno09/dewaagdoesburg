<?php
if ( post_password_required() ) {
    return;
}
?>
<div id="comments" class="comments-area single-blog-bottom">
    <?php
		if ( have_comments() ):
		$redchili_comment_count = get_comments_number();
		$redchili_comments_text = number_format_i18n( $redchili_comment_count ) . ' ';
		if ( $redchili_comment_count > 1 ) {
			$redchili_comments_text .= esc_html__( 'Comments', 'redchili' );
		}
		else{
			$redchili_comments_text .= esc_html__( 'Comment', 'redchili' );
		}
	?>
		<h3><?php echo esc_html( $redchili_comments_text );?></h3>
	<?php
		$redchili_avatar = get_option( 'show_avatars' );
	?>  
		<ul class="comment-list<?php echo empty( $redchili_avatar ) ? ' avatar-disabled' : '';?>">
		<?php
			wp_list_comments(
				array(
					'style'             => 'ul',
					'callback'          => 'RDTheme_Helper::comments_callback',
					'reply_text'        => '<i class="fa fa-mail-forward" aria-hidden="true"></i> '. esc_html__( 'Reply', 'redchili' ),
					'avatar_size'       => 130,
					'format'            => 'html5',
					) 
				);
		 ?>
		</ul>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav class="pagination-area comment-navigation">
				<ul>
					<li><?php previous_comments_link( esc_html__( 'Older Comments', 'redchili' ) ); ?></li>
					<li><?php next_comments_link( esc_html__( 'Newer Comments', 'redchili' ) ); ?></li>
				</ul>
			</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation.?>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'redchili' ); ?></p>
	<?php endif;?>
	<div>
	<?php
		$redchili_commenter = wp_get_current_commenter();
		$redchili_req = get_option( 'require_name_email' );
		$redchili_aria_req = ( $redchili_req ? " required" : '' );

		$redchili_fields =  array(
			'author' =>
			'<div class="row"><div class="col-sm-6"><div class="form-group comment-form-author"><input type="text" id="author" name="author" value="' . esc_attr( $redchili_commenter['comment_author'] ) . '" placeholder="'. esc_attr__( 'Name', 'redchili' ).( $redchili_req ? ' *' : '' ).'" class="form-control"' . $redchili_aria_req . '></div></div>',

			'email' =>
			'<div class="col-sm-6 comment-form-email"><div class="form-group"><input id="email" name="email" type="email" value="' . esc_attr(  $redchili_commenter['comment_author_email'] ) . '" class="form-control" placeholder="'. esc_attr__( 'Email', 'redchili' ).( $redchili_req ? ' *' : '' ).'"' . $redchili_aria_req . '></div></div></div>',
			);

		$redchili_args = array(
			'class_submit'      => 'submit btn-send ghost-on-hover-btn',
			'submit_field'         => '<div class="form-group form-submit">%1$s %2$s</div>',
			'comment_field' =>  '<div class="form-group comment-form-comment"><textarea id="comment" name="comment" required placeholder="'.esc_attr__( 'Comment *', 'redchili' ).'" class="textarea form-control" rows="10" cols="40"></textarea></div>',
			'fields' => apply_filters( 'comment_form_default_fields', $redchili_fields ),
			);

			?>
		<?php comment_form( $redchili_args );?>
	</div>
</div>