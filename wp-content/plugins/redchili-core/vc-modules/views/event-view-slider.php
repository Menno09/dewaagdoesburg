<?php
$args = array(
		'post_type'      => 'rc_event',
		'posts_per_page' => $slider_item_number,
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
$slider_nav_class = ( $slider_nav == 'true' ) ? ' slider-nav-enabled' : '';
?>
<div class="event-slider">
	<div class="owl-wrap rt-owl-nav-2 rt-owl-event-slider rt-owl-dot-1 <?php echo esc_attr( $slider_nav_class );?>">
		<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $owl_data );?>">
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
							if($event_date_time > $today){ ?>						
								<div class="content-box2">
									<div class="content-box2-bottom-content-holder">
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<ul>
											<?php if ( $rc_event_start_date ): ?>
												<li>
												<i class="fa fa-calendar" aria-hidden="true"></i><span><?php echo esc_html( $rc_event_start_date );?></span>
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
						<?php }
							
						} else if($event_type == 'past'){ 
							if($event_date_time < $today){ ?>					
								<div class="content-box2">
									<div class="content-box2-bottom-content-holder">
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<ul>
											<?php if ( $rc_event_start_date ): ?>
												<li>
												<i class="fa fa-calendar" aria-hidden="true"></i><span><?php echo esc_html( $rc_event_start_date );?></span>
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
							<?php } ?>
						<?php } ?>
				<?php endwhile;?>
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
</div>