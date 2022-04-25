<?php
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
	'post_type'      => 'rc_event',
	'posts_per_page' => $grid_item_number,
	'paged'          => $paged,
	'orderby'		 => $orderby,
	'order'			 => $order,
	);
	
if ( !empty( $cat ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'rc_event_category',
			'field' => 'term_id',
			'terms' => $cat,
		)
	);
}

$query = new WP_Query( $args );

$col_class = "col-lg-$col_lg col-md-$col_md col-sm-$col_sm col-xs-$col_xs";
$image_fix = '';
if( $col_lg == 6 ){
	$image_fix = 'image-fix';
}

// Pagination fix
global $wp_query;
$wp_query   = NULL;
$wp_query   = $query;
$query = new WP_Query( $args );
?>

<div class="all-event-area">
	<div class="row auto-clear">
		<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
					$id = get_the_ID();

					$rc_event_start_date = get_post_meta( $id, 'rc_event_start_date', true );
					$rc_event_start_time = get_post_meta( $id, 'rc_event_start_time', true );
					$rc_event_location = get_post_meta( $id, 'rc_event_location', true );

					$content = get_the_content();
					$content = apply_filters( 'the_content', $content );
					$content = wp_trim_words( $content, $content_limit );
				?>
				<?php 
					$time = current_time( 'mysql' );
					$today = strtotime($time);
					$dt = $rc_event_start_date . ' ' . $rc_event_start_time;
					$event_date_time = strtotime($dt); 

					if($event_type == 'upcoming'){
						if($event_date_time > $today){
				?>							
					<div class="<?php echo esc_attr($image_fix); ?> <?php echo esc_attr( $col_class );?>">
						<div class="content-box2">
							<div class="content-box2-bottom-content-holder">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<ul>
									<?php if ( $rc_event_start_date ): ?>
										<li>
										<i class="fa fa-calendar" aria-hidden="true"></i>
										<span><?php echo esc_html( $rc_event_start_date );?></span>
										</li>
									<?php endif; ?>							
									<?php if ( $rc_event_start_time ): ?>
										<li>
											<i class="fa fa-clock-o" aria-hidden="true"></i><span><?php echo esc_html( $rc_event_start_time );?></span>
										</li>
									<?php endif; ?>							
									<?php if ( $rc_event_location ): ?>
										<li>
											<i class="fa fa-map-marker" aria-hidden="true"></i><span><?php echo esc_html( $rc_event_location );?></span>
										</li>
									<?php endif; ?>	
								</ul>						
								<p><?php echo esc_html($content); ?></p>
							</div>
							<div class="event-mark"></div>
						</div>
					</div>
					<?php }							
						} else if($event_type == 'past'){ 
							if($event_date_time < $today){ 
					?>
					<div class="<?php echo esc_attr($image_fix); ?> <?php echo esc_attr( $col_class );?>">
						<div class="content-box2">
							<div class="content-box2-bottom-content-holder">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<ul>
									<?php if ( $rc_event_start_date ): ?>
										<li>
										<i class="fa fa-calendar" aria-hidden="true"></i>
										<span><?php echo esc_html( $rc_event_start_date );?></span>
										</li>
									<?php endif; ?>							
									<?php if ( $rc_event_start_time ): ?>
										<li>
											<i class="fa fa-clock-o" aria-hidden="true"></i><span><?php echo esc_html( $rc_event_start_time );?></span>
										</li>
									<?php endif; ?>							
									<?php if ( $rc_event_location ): ?>
										<li>
											<i class="fa fa-map-marker" aria-hidden="true"></i><span><?php echo esc_html( $rc_event_location );?></span>
										</li>
									<?php endif; ?>	
								</ul>						
								<p><?php echo esc_html($content); ?></p>
							</div>
							<div class="event-mark"></div>
						</div>
					</div>							
					<?php 	}
						} else { ?>
					<div class="<?php echo esc_attr($image_fix); ?> <?php echo esc_attr( $col_class );?>">
						<div class="content-box2">
							<div class="content-box2-bottom-content-holder">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<ul>
									<?php if ( $rc_event_start_date ): ?>
										<li>
										<i class="fa fa-calendar" aria-hidden="true"></i>
										<span><?php echo esc_html( $rc_event_start_date );?></span>
										</li>
									<?php endif; ?>							
									<?php if ( $rc_event_start_time ): ?>
										<li>
											<i class="fa fa-clock-o" aria-hidden="true"></i><span><?php echo esc_html( $rc_event_start_time );?></span>
										</li>
									<?php endif; ?>							
									<?php if ( $rc_event_location ): ?>
										<li>
											<i class="fa fa-map-marker" aria-hidden="true"></i><span><?php echo esc_html( $rc_event_location );?></span>
										</li>
									<?php endif; ?>	
								</ul>						
								<p><?php echo esc_html($content); ?></p>
							</div>
							<div class="event-mark"></div>
						</div>
					</div>							
					<?php }						
					endwhile; ?>
			<div class="col-sm-12 col-xs-12"><?php rt_vc_pagination();?></div>
		<?php } else { ?>																
			<div class="content-box2">
				<div class="content-box2-bottom-content-holder">
					<h3><?php echo esc_html('No Event Found', 'redchili-core'); ?></h3>
				</div>
				<div class="event-mark"></div>
			</div>
		<?php } ?>
		<?php wp_reset_query();?>
	</div>
</div>