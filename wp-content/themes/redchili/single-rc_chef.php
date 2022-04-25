<?php get_header(); ?>
<div class="content-area">
	<?php while ( have_posts() ) : the_post(); ?>	
		<div class="single-chef-top-area">
		<?php
			if ( RDTheme::$options['chef_section_back'] == 1  ){ ?>
				<img class="img-responsive section-back" src="<?php echo RDTHEME_IMG_URL; ?>section-back.png" alt="<?php the_title(); ?>">
		<?php }	?>
			<div class="container">
				<div class="row">
					<?php get_template_part( 'template-parts/content-single', 'chef' );?>
				</div> 
			</div>  
		</div>	
		<?php			
			$show_other_chef = get_post_meta( get_the_ID(), 'rc_chef_other', true ); 			
			if( $show_other_chef == 'on' || $show_other_chef == '1' ){
				get_template_part( 'template-parts/content-single', 'chef-slider' );
			}
		?>
	<?php endwhile; ?>
</div>
<?php get_footer(); ?>