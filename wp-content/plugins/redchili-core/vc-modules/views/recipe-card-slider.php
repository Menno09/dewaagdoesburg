<?php
$thumb_size = 'rdtheme-size8';
$args = array(
	'post_type'      => 'rc_recipe',
	'posts_per_page' => $slider_item_number,
	);

if ( !empty( $cat ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'rc_recipe_category',
			'field' => 'term_id',
			'terms' => $cat,
		)
	);
}
$query = new WP_Query( $args );
?>
<div class="recipe-of-the-day-area">
	<div class="row">
		<div class="rt-owl-carousel owl-carousel owl-theme" data-carousel-options="<?php echo esc_attr( $owl_data_card );?>">                   
		<?php if ( $query->have_posts() ) :?>
			<?php while ( $query->have_posts() ) : $query->the_post();?>
			<?php
				$id = get_the_ID();
				$rc_recipe_prep_time = get_post_meta( $id, 'rc_recipe_prep_time', true );
				$rc_recipe_cook_time = get_post_meta( $id, 'rc_recipe_cook_time', true );
				$rc_recipe_ready_in = get_post_meta( $id, 'rc_recipe_ready_in', true );
				$thumbnail = false;
				if ( has_post_thumbnail() ){
					$thumbnail = get_the_post_thumbnail( null, $thumb_size );
				}
				else {
					if ( !empty( RDTheme::$options['no_preview_image']['id'] ) ) {
						$thumbnail = wp_get_attachment_image( RDTheme::$options['no_preview_image']['id'], $thumb_size );
					}
					elseif ( !empty( RDTheme::$options['no_preview_image']['url'] ) ) {
						$thumbnail = '<img class="wp-post-image" src="'.RDTHEME_IMG_URL.'noimage_510x539-card.jpg" alt="'.get_the_title().'">';
					}
				}
				$content = get_the_content();
				$content = apply_filters( 'the_content', $content );
				$content = wp_trim_words( $content, $content_limit );
			?>
			<div class="recipe-of-the-day-box clear">
				<div class="container">
					<div class="row">
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
					<div class="recipe-of-the-day-content">
						<div class="recipe-of-the-day-content-inner">
							<h2 class="title-recipe"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p class="recipe-of-the-day-content-details"><?php echo esc_html($content); ?></p>
							<?php if('yes' == $show_time){ ?>
								<ul class="time-needs">
								<?php if ( $rc_recipe_prep_time ): ?>
									<li>
										<i class="fa fa-clock-o" aria-hidden="true"></i>
										<p><?php _e('Preparation' , 'redchili-core'); ?></p>
										<p><?php echo esc_html( $rc_recipe_prep_time );?></p>
									</li>							
								<?php endif; ?>
								<?php if ( $rc_recipe_cook_time ): ?>
									<li>
										<i class="fa fa-clock-o" aria-hidden="true"></i>
										<p><?php _e('Cook Time' , 'redchili-core'); ?></p>
										<p><?php echo esc_html( $rc_recipe_cook_time );?></p>
									</li>							
								<?php endif; ?>
								<?php if ( $rc_recipe_ready_in ): ?>
									<li>
										<i class="fa fa-clock-o" aria-hidden="true"></i>
										<p><?php _e('Ready In' , 'redchili-core'); ?></p>
										<p><?php echo esc_html( $rc_recipe_ready_in );?></p>
									</li>							
								<?php endif; ?>
								</ul>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 recipe-of-the-day-img-holder">
					<div class="recipe-of-the-day-content">
						<div class="recipe-of-the-day-img">
							<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
			</div>
			<?php endwhile;?>
		<?php endif;?>
		<?php wp_reset_query();?>
		</div>
	</div>
</div>