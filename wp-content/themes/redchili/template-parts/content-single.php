<?php
$rdtheme_comments_number = get_comments_number();
$rdtheme_time_html = sprintf( '<span>%s<br>%s<br>%s<br></span>', get_the_time( 'd' ),get_the_time( 'M' ), get_the_time( 'Y' ) );
$rdtheme_time_html = apply_filters( 'rdtheme_single_time', $rdtheme_time_html );
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('entry-blog-post'); ?>>
	<?php if ( has_post_thumbnail() ): ?>
		<div class="entry-thumbnail"><?php the_post_thumbnail( 'rdtheme-size1' ); ?></div>
	<?php endif; ?>
	
	<?php if(!empty(RDTheme::$options['post_author_name']) || !empty(RDTheme::$options['post_comment_num']) || !empty(RDTheme::$options['post_tags']) ) { ?>	
	<ul class="title-bar">
		<?php if ( RDTheme::$options['post_author_name'] == 1 ){ ?>
			<li>
				<?php esc_html_e( 'Post by', 'redchili' );?>:<span> <?php the_author_posts_link();?></span>
			</li>
		<?php } ?>
		<?php if ( RDTheme::$options['post_date'] == 1 ){ ?>
			<?php if ( !has_post_thumbnail() ){ ?>			
				<li><?php esc_html_e( 'Date', 'redchili' );?>:<span> <?php echo get_the_date(); ?></span></li>
			<?php } ?>
		<?php } ?>
		<?php if ( RDTheme::$options['post_comment_num'] == 1 ){ ?>                       	
			<li>
				<?php printf( _nx( 'Comment (<span>%s</span>)', 'Comments <span>(%s)</span>', $rdtheme_comments_number, 'comments number', 'redchili' ),
				number_format_i18n( $rdtheme_comments_number ) ); ?>
			</li>
		<?php } ?>
		<?php if ( RDTheme::$options['post_tags'] == 1 ){
		if ( has_tag() ){ ?>
			<li>
				<?php esc_html_e( 'Tags: ', 'redchili' ); echo get_the_term_list( $post->ID, 'post_tag', '', ', ' ); ?>
			</li>
		<?php }
		}
		?>
	</ul>
	<?php } ?>
	<?php the_content();?>
	<?php wp_link_pages();?>
	<?php if ( has_post_thumbnail() ){ ?>
		<?php if ( RDTheme::$options['post_date'] == 1 ){ ?>
		<div class="rc-date">		
			<?php echo wp_kses_post( $rdtheme_time_html ); ?>		
		</div>
		<?php } ?>
	<?php } ?>	
</div>
<?php if(!empty(RDTheme::$options['post_cats']) || !empty(RDTheme::$options['post_social'])){ ?>
	<div class="single-blog-middle">
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 no-padding-lr">
		<?php if ( RDTheme::$options['post_cats'] == 1 ){ ?>
			<div class="single-blog-tag">
				<?php the_category();?>
			</div>
		<?php } ?>
		</div>
		<?php if ( RDTheme::$options['post_social'] == 1 ){ ?>
		<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 no-padding-lr text-right">
			<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) && RDTheme::$options['post_social'] ): ?>
				<div class="share"><?php ADDTOANY_SHARE_SAVE_KIT(); ?></div>                  
			<?php endif; ?>
		</div>
		<?php } ?>
	</div>
<?php } ?>