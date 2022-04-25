<?php
$thumb_size = 'rdtheme-size6';
$args = array(
	'post_type'      => 'rc_chef',
	'posts_per_page' => $slider_item_number,
	);
	
if ( !empty( $cat ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'rc_chef_category',
			'field' => 'term_id',
			'terms' => $cat,
		)
	);
}
$query = new WP_Query( $args );
$slider_nav_class = ( $slider_nav == 'true' ) ? ' slider-nav-enabled' : '';
?>
<div class="chef-area">
	<div class="owl-wrap rt-owl-nav-2 rt-owl-chef-3 rt-owl-dot-1 <?php echo esc_attr( $slider_nav_class );?>">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
					<?php if ( $query->have_posts() ) :?>
						<?php while ( $query->have_posts() ) : $query->the_post();?>
							<?php
								$id = get_the_ID();
								$rc_chef_designation = get_post_meta( $id, 'rc_chef_designation', true );
								$redchili_chef_social = get_post_meta( $id, 'redchili_chef_social', true );
								$thumbnail = false;
								if ( has_post_thumbnail() ){
									$thumbnail = get_the_post_thumbnail( null, $thumb_size );
								}
								else {
									if ( !empty( RDTheme::$options['no_preview_image']['id'] ) ) {
										$thumbnail = wp_get_attachment_image( RDTheme::$options['no_preview_image']['id'], $thumb_size );
									}
									elseif ( !empty( RDTheme::$options['no_preview_image']['url'] ) ) {
										$thumbnail = '<img class="attachment-rdtheme-size5 size-rdtheme-size5 wp-post-image" src="'.RDTHEME_IMG_URL.'noimage_400x400.jpg" alt="'.get_the_title().'">';
									}
								}
							?>
							<div class="vc-item-wrap">
								<div class="vc-item">
									<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
									<div class="vc-overly">
										<?php if ( !empty( $redchili_chef_social ) ): ?>
											<ul>
												<?php foreach ( $redchili_chef_social as $key => $social ): ?>
													<?php if ( !empty( $social ) ): ?>
														<li><a target="_blank" href="<?php echo esc_url( $social );?>"><i class="fa <?php echo esc_attr( RDTheme::$redchili_chef_social[$key]['icon'] );?>" aria-hidden="true"></i></a></li>
													<?php endif; ?>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									</div>
								</div>
								<div class="vc-chef-meta">
								<h3 class="name"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
									<?php if ( $designation_display == 'true' ): ?>
										<div class="designation"><?php echo esc_html( $rc_chef_designation );?></div>
									<?php endif; ?>
								</div>
							</div>
						<?php endwhile;?>
					<?php endif;?>
					<?php wp_reset_query();?>
				</div>
			</div>
		</div>
	</div>
</div>