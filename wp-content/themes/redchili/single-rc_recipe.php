<?php
if ( RDTheme::$layout == 'full-width' ) {
	$redchili_layout_class = 'col-sm-12 col-xs-12';
}
else{
	$redchili_layout_class = 'col-lg-9 col-md-9 col-sm-8 col-xs-12 leftside-container';
}
?>
<?php get_header(); ?>
<div class="content-area single-recipe-area">
    <div class="container">
        <div class="row">
			<?php
			if ( RDTheme::$layout == 'left-sidebar' ) {
				get_sidebar();
			}
			?>
            <div class="<?php echo esc_attr( $redchili_layout_class );?>">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'template-parts/content-single', 'recipe' );?>
				<?php endwhile; ?>
				<?php 
					$rc_recipe_other = get_post_meta( get_the_ID(), 'rc_recipe_other', true );
						if( $rc_recipe_other == 'on' || $rc_recipe_other == '1' ){
						get_template_part( 'template-parts/content-single', 'recipe-slider' );
					}
				?>
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