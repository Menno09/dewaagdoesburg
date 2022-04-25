<?php
$thumb_size = 'rdtheme-size5';
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
	<div class="owl-wrap rt-owl-nav-2 rt-owl-dot-1 <?php echo esc_attr( $slider_nav_class );?>">
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
								$thumbnail = '<img class="attachment-rdtheme-size5 size-rdtheme-size5 wp-post-image" src="'.RDTHEME_IMG_URL.'noimage_370x522.jpg" alt="'.get_the_title().'">';
							}
						}
					?>
					<div class="chef-box">
						<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
						<div class="chef-box-content">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php if ( $designation_display == 'true' ){ ?>
							<p><?php echo esc_html( $rc_chef_designation );?></p>
							<?php } ?>						
							<?php if ( !empty( $redchili_chef_social ) ){ ?>
							<div class="chef-social-wrap">
								<div class="chef-sep"></div>		
								<ul class="chef-social">
									<?php foreach ( $redchili_chef_social as $redchili_key => $redchili_social ): ?>
										<?php if ( !empty( $redchili_social ) ): ?>
											<li><a target="_blank" href="<?php echo esc_attr( $redchili_social );?>"><i class="fa <?php echo esc_attr( RDTheme::$redchili_chef_social[$redchili_key]['icon'] );?>"></i></a></li>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>								
							</div>
							<?php } ?>
						</div>
					</div>
				<?php endwhile;?>
			<?php endif;?>
			<?php wp_reset_query();?>
		</div>
	</div>
</div>