<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php get_header(); ?>
<!-- Food Menu 3 Area Start Here -->  
<div class="food-menu3-area food-archive content-area entry-content">
    <div class="container">
		<div class="row auto-clear">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php				
					$content = get_the_content();
					$content = apply_filters( 'the_content', $content );
					$content = wp_trim_words( $content, 20 );
				?>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="food-menu3-box">
					   <div class="food-menu3-box-img">
							<a href="<?php the_permalink(); ?>"><i class="fa fa-link" aria-hidden="true"></i></a>
							<?php the_post_thumbnail('rdtheme-size6'); ?>
						</div>
						<div class="food-menu3-box-content">
							<h3 class="title-bar-medium-left"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>							
							<p><?php echo wp_kses_post($content); ?></p>
							<div class="food-menu-price">
								<?php $regular_price = get_post_meta(get_the_ID() , '_regular_price', true); if(!empty($regular_price)){ ?>
								<span><?php echo wp_kses_post($regular_price); ?></span><?php } ?>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>			
		</div>
		<?php rt_vc_pagination();?>
	</div>
</div>
<?php get_footer(); ?>