<?php
if ( RDTheme::$layout == 'full-width' ) {
	$rdtheme_layout_class = 'col-sm-12 col-xs-12';
}
else{
	$redchili_layout_class = 'col-sm-8 col-md-9 col-xs-12';
}
?>
<?php get_header(); ?>
<div class="content-area entry-content">
	<div class="container">
		<div class="row">
			<?php
			if ( RDTheme::$layout == 'left-sidebar' ) {
				get_sidebar();
			}
			?>
			<div class="<?php echo esc_attr( $redchili_layout_class );?>">
				<?php if ( have_posts() ) :?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content', 'search' ); ?>
				<?php endwhile; ?>
					<?php RDTheme_Helper::pagination();?>
				<?php else:?>
					<?php get_template_part( 'template-parts/content', 'none' );?>
				<?php endif;?>
			</div>
			<?php
			if ( RDTheme::$layout == 'right-sidebar' ) {
				get_sidebar();
			}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>