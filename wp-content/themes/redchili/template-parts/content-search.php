<?php
$rdtheme_time_html = sprintf( '<span>%s<br>%s<br>%s<br></span>', get_the_time( 'd' ),get_the_time( 'M' ), get_the_time( 'Y' ) );
$rdtheme_time_no_thumb = sprintf( '%s', get_the_time( 'd M, Y' ) );
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('blog-page-box'); ?>>	
	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	<ul class="title-bar">
		<li>
			<?php esc_html_e( 'Date', 'redchili' );?> <span> <?php echo wp_kses_post( $rdtheme_time_no_thumb ); ?></span>	
		</li>
	</ul>
	<?php the_excerpt(); ?>
	<a href="<?php the_permalink(); ?>" class="ghost-color-btn"><?php esc_html_e( 'Read More', 'redchili' );?></a>
</div>