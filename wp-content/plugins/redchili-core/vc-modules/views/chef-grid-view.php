<?php
$thumb_size = 'rdtheme-size5';
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
}
elseif ( get_query_var('page') ) {
	$paged = get_query_var('page');
}
else {
	$paged = 1;
}
$args = array(
	'post_type'      => 'rc_chef',
	'posts_per_page' => $grid_item_number,
	'paged'          => $paged,
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
$col_class = "col-lg-$col_lg col-md-$col_md col-sm-$col_sm col-xs-$col_xs";
$image_fix = '';
if($col_lg == 6){
	$image_fix = 'image-fix';
}

// Pagination fix
global $wp_query;
$wp_query   = NULL;
$wp_query   = $query;
?>
<div class="all-chefs-area">
	<div class="row">
		<?php if ( $query->have_posts() ) :?>
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
					$id = get_the_id();
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
				<div class="<?php echo esc_attr($image_fix); ?> <?php echo esc_attr( $col_class );?>">
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
				</div>
			<?php endwhile;?>
			<div class="col-sm-12 col-xs-12"><?php rt_vc_pagination();?></div>
		<?php wp_reset_query();	endif; ?>
	</div>
</div>