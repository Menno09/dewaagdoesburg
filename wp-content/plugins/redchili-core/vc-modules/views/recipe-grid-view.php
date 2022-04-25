<?php
$thumb_size = 'rdtheme-size7';

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
	'post_type'      => 'rc_recipe',
	'posts_per_page' => $grid_item_number,
	'paged'          => $paged,
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
$col_class = 'col-lg-' . $col_lg . ' col-md-' . $col_md . ' col-sm-' . $col_sm . ' col-xs-' . $col_xs;
$image_fix = '';
if($col_lg == 6){
	$image_fix = 'image-fix';
}

// Pagination fix
global $wp_query;
$wp_query   = NULL;
$wp_query   = $query;
?>
<div class="our-recipes-area">
	<div class="row auto-clear">	
	<?php if ( $query->have_posts() ) :?>
		<?php while ( $query->have_posts() ) : $query->the_post();?>
		<?php
			$id = get_the_ID();
			$rc_recipe_serving_people = get_post_meta( $id, 'rc_recipe_serving_people', true );
			$rc_recipe_prep_time = get_post_meta( $id, 'rc_recipe_prep_time', true );			
			$content = get_the_content();
			$content = apply_filters( 'the_content', $content );
			$content = wp_trim_words( $content, $content_limit );
			$thumbnail = false;
			if ( has_post_thumbnail() ){
				$thumbnail = get_the_post_thumbnail( null, $thumb_size, array( 'class' => 'img-responsive' ) );
			}
			else {
				if ( !empty( RDTheme::$options['no_preview_image']['id'] ) ) {
					$thumbnail = wp_get_attachment_image( RDTheme::$options['no_preview_image']['id'], $thumb_size );
				}
				elseif ( !empty( RDTheme::$options['no_preview_image']['url'] ) ) {
					$thumbnail = '<img class="img-responsive wp-post-image" src="'.RDTHEME_IMG_URL.'noimage_377x251.jpg" alt="'.get_the_title().'">';
				}
			}
		?>
		<div class="<?php echo esc_attr($image_fix); ?> <?php echo esc_attr( $col_class );?>">
			<div class="content-box2 auto-clear">
				<ul class="content-box2-social">
					<li><a href="<?php the_permalink(); ?>"><i class="fa fa-link" aria-hidden="true"></i></a></li>
				</ul>                               
				<div class="content-box2-img-holder">									
					<a href="<?php the_permalink(); ?>"><?php echo wp_kses_post($thumbnail); ?></a>
				</div>
				<div class="content-box2-bottom-content-holder">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><?php echo esc_html($content); ?>
					<?php if('yes' == $show_time){ ?>
						<ul>
							<li><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php _e('Time' , 'redchili-core'); ?>: <span><?php echo esc_html( $rc_recipe_prep_time );?></span></a></li>
						</ul>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php endwhile;?>
		<div class="col-sm-12 col-xs-12"><?php rt_vc_pagination();?></div>
	<?php wp_reset_query();	endif; ?>					
	</div>				
</div>