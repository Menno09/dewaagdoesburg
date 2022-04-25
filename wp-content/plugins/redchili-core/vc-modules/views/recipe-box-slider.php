<?php
$thumb_size = 'rdtheme-size7';
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
<div class="recipe-of-the-day2-area">
	<div class="owl-wrap rt-owl-nav-2 rt-owl-dot-1 rt-owl-class-2 slider-nav-enabled">	 
		 <div class="rt-owl-carousel owl-carousel owl-theme" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
			<?php if ( $query->have_posts() ) :?>
				<?php while ( $query->have_posts() ) : $query->the_post();?>
					<?php
					$id = get_the_ID();
					$rc_recipe_prep_time = get_post_meta( $id, 'rc_recipe_prep_time', true );
					$thumbnail = false;
					if ( has_post_thumbnail() ){
						$thumbnail = get_the_post_thumbnail( null, $thumb_size );
					}
					else {
						if ( !empty( RDTheme::$options['no_preview_image']['id'] ) ) {
							$thumbnail = wp_get_attachment_image( RDTheme::$options['no_preview_image']['id'], $thumb_size );
						}
						elseif ( !empty( RDTheme::$options['no_preview_image']['url'] ) ) {
							$thumbnail = '<img class="wp-post-image" src="'.RDTHEME_IMG_URL.'noimage_377x251.jpg" alt="'.get_the_title().'">';
						}
					}
					
					$title = get_the_title();
					$title = apply_filters( 'the_title', $title );
					$title = wp_trim_words( $title, $title_limit );
					
					$content = get_the_content();
					$content = apply_filters( 'the_content', $content );
					$content = wp_trim_words( $content, $content_limit );
					?>
					<div class="content-box2">
						<ul class="content-box2-social">
							<li><a href="<?php the_permalink(); ?>"><i class="fa fa-link" aria-hidden="true"></i></a></li>
						</ul>                               
						<div class="content-box2-img-holder">                                   
							<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
						</div>
						<div class="content-box2-bottom-content-holder">
							<h3><a href="<?php the_permalink(); ?>"><?php echo esc_html( $title );?></a></h3>
							<p><?php echo esc_html($content); ?></p>
							<?php if('yes' == $show_time){ ?>
							<ul>
								<?php if ( $rc_recipe_prep_time ): ?>
									<li>
									<a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php _e('Time' , 'redchili-core'); ?>
									 : <span><?php echo esc_html( $rc_recipe_prep_time );?></span></a>
									</li>
								<?php endif; ?>
								<?php if(!empty($rc_recipe_cook_time)){ ?>
									<li><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i><?php _e( 'Cook Time', 'redchili-core' );?>: <span>
										<?php echo esc_html($rc_recipe_cook_time); ?></span></a>
									</li>
								<?php } ?>
								<?php if(!empty($rc_recipe_ready_in)){ ?>
									<li><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i><?php _e( 'Ready In', 'redchili-core' );?>: <span>
										<?php echo esc_html($rc_recipe_ready_in); ?></span></a>
									</li>
								<?php } ?>
							</ul>
							<?php } ?>
						</div>
					</div>
				<?php endwhile;?>
			<?php endif;?>
			<?php wp_reset_query();?>
		</div>
	</div>
</div>