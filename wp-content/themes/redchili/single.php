<?php
if ( RDTheme::$layout == 'full-width' ) {
	$redchili_layout_class = 'col-sm-12 col-xs-12';
}
else{
	$redchili_layout_class = 'col-lg-9 col-md-9 col-sm-8 col-xs-12 leftside-container';
}
?>
<?php get_header(); ?>
<div class="content-area">
    <div class="container">
        <div class="row">
			<?php
			if ( RDTheme::$layout == 'left-sidebar' ) {
				get_sidebar();
			}
			?>
            <div class="<?php echo esc_attr( $redchili_layout_class );?>">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'template-parts/content-single', get_post_format() );?>
						<?php if ( comments_open() || get_comments_number() ){ ?>
							<hr class="post-separator">
						<?php comments_template(); } ?>
					<?php endwhile; ?>
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