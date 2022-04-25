<?php
$rdtheme_comments_number = get_comments_number();
$rdtheme_time_html = sprintf( '<span>%s<br>%s<br>%s<br></span>', get_the_time( 'd' ),get_the_time( 'M' ), get_the_time( 'Y' ) );
$rdtheme_time_no_thumb = sprintf( '%s', get_the_time( 'd M, Y' ) );
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('blog-page-box'); ?>>
	<?php if (has_post_thumbnail()) { ?>	
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'rdtheme-size1' ); ?></a>
	<?php } ?>
	<?php $empty_option = ''; if ( empty(RDTheme::$options['blog_author_name']) && empty(RDTheme::$options['blog_comment_num']) && empty(RDTheme::$options['blog_cats']) ) { $empty_option = 'blog-title-height'; }
	?>		
	<h2 class="<?php echo esc_attr($empty_option); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>	
	<?php if ( !empty(RDTheme::$options['blog_author_name']) || !empty(RDTheme::$options['blog_comment_num']) || !empty(RDTheme::$options['blog_date'])  || !empty(RDTheme::$options['blog_cats']) ) { ?> 
	<ul class="title-bar">
	<?php if ( RDTheme::$options['blog_author_name'] == 1 ){ ?>
		<li>		
			<?php esc_html_e( 'Post by', 'redchili' );?><span> <?php the_author_posts_link();?></span>
		</li>
	<?php }	if ( RDTheme::$options['blog_comment_num'] == 1 ){ ?>
		<li>
			<?php printf( _nx( 'Comment <span>( %s )</span>', 'Comments <span>( %s )</span>', $rdtheme_comments_number, 'comments number', 'redchili' ), number_format_i18n( $rdtheme_comments_number ) ); ?>                	
		</li>        
	<?php } if ( !(has_post_thumbnail()) ) { ?>
		<li>	
			<?php if ( RDTheme::$options['blog_date'] == 1 ){ ?>
				<?php esc_html_e( 'Date', 'redchili' );?> <span> <?php echo esc_html( get_the_date() ); ?></span>
			<?php }	?>
		</li>
	<?php } ?>
	<?php if ( RDTheme::$options['blog_cats'] == 1 ){ ?>	
		<?php if ( has_category() ){ ?>
			<li><?php esc_html_e( 'Categories: ', 'redchili' ); the_category( ', ' ); ?></li>
		<?php } ?>
	<?php } ?>	
	</ul>
	<?php } ?>
	<?php the_excerpt(); ?>
	<div class="clear"></div>
	<a href="<?php the_permalink(); ?>" class="ghost-color-btn"><?php esc_html_e( 'Read More', 'redchili' );?></a>
	<?php if ( has_post_thumbnail() ): ?>
		<?php if ( RDTheme::$options['blog_date'] == 1 ){ ?>
			<div class="rc-date">			
				<?php echo wp_kses_post( $rdtheme_time_html ); ?>
			</div>
		<?php } ?>
	<?php endif; ?>
</div>