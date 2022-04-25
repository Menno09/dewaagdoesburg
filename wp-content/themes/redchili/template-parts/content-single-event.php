<?php
global $post;

$rc_event_start_date    = get_post_meta( $post->ID, 'rc_event_start_date', true );
$rc_event_start_time   	= get_post_meta( $post->ID, 'rc_event_start_time', true );
$rc_event_end_date     	= get_post_meta( $post->ID, 'rc_event_end_date', true );
$rc_event_end_time     	= get_post_meta( $post->ID, 'rc_event_end_time', true );
$rc_event_seat        	= get_post_meta( $post->ID, 'rc_event_seat', true );
$rc_event_location      = get_post_meta( $post->ID, 'rc_event_location', true );
$rc_event_ext_link      = get_post_meta( $post->ID, 'rc_event_ext_link', true );
$rc_event_lat      		= get_post_meta( $post->ID, 'rc_event_lat', true );
$rc_event_lan      		= get_post_meta( $post->ID, 'rc_event_lan', true );
$redchili_event_social  = get_post_meta( $post->ID, 'redchili_event_social', true );
?>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="single-event-top-img">
				<?php the_post_thumbnail( 'rdtheme-size1', array( 'class' => 'img-responsive' ) ); ?>
			</div>
		<?php } ?>
		<?php the_content();?>
	</div> 
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<?php if ( !empty( $rc_event_start_date ) || !empty( $rc_event_end_date ) ){ ?>
		<div class="event-info">		
			<h3><?php esc_html_e( 'Event Info', 'redchili' );?>:</h3>
			<ul>
				<?php if ( $rc_event_start_date ): ?>
					<li>
						<span><i class="fa fa-calendar" aria-hidden="true"></i><?php esc_html_e( 'Start Date', 'redchili' );?>:</span><?php echo esc_html( $rc_event_start_date );?>
					</li>
				<?php endif; ?>
				<?php if ( $rc_event_start_time ): ?>
					<li>
						<span><i class="fa fa-clock-o" aria-hidden="true"></i><?php esc_html_e( 'Start Time', 'redchili' );?>:</span><?php echo esc_html( $rc_event_start_time );?>
					</li>
				<?php endif; ?>				
				<?php if ( $rc_event_end_date ): ?>
					<li>
						<span><i class="fa fa-calendar-o" aria-hidden="true"></i><?php esc_html_e( 'End Date', 'redchili' );?>:</span><?php echo esc_html( $rc_event_end_date );?>		
					</li>				
				<?php endif; ?>

				<?php if ( $rc_event_end_time ): ?>
					<li><span><i class="fa fa-clock-o" aria-hidden="true"></i><?php esc_html_e( 'End Time', 'redchili' );?>:</span><?php echo esc_html( $rc_event_end_time );?> </li>
				<?php endif; ?>
				<?php if ( $rc_event_seat ): ?>
					<li><span><i class="fa fa-ticket" aria-hidden="true"></i><?php esc_html_e( 'Nubmer of Participant', 'redchili' );?>:</span><?php echo esc_html( $rc_event_seat );?></li>
				<?php endif; ?>
				<?php if ( $rc_event_location ): ?>
					<li>
						<span><i class="fa fa-map-marker" aria-hidden="true"></i><?php esc_html_e( 'Location', 'redchili' );?>:</span><?php echo esc_html( $rc_event_location );?>
					</li>
				<?php endif; ?>
				<?php if ( $rc_event_ext_link ): ?>
					<li><span><i class="fa fa-globe" aria-hidden="true"></i><?php esc_html_e( 'Website', 'redchili' );?>:</span><a href="<?php echo esc_html( $rc_event_ext_link );?>"><?php echo esc_html( $rc_event_ext_link );?></a></li>			
				<?php endif; ?>
			</ul>		
		</div>
		<?php } ?>
		<?php $check_empty = array_filter($redchili_event_social); if ( $check_empty ){ ?>
		<div class="event-social">		
			<h3><?php esc_html_e( 'Follow Event On', 'redchili' );?>:</h3>			
			<ul class="single-chef-social">
				<?php foreach ( $redchili_event_social as $redchili_key => $redchili_social ): ?>
					<?php if ( !empty( $redchili_social ) ): ?>
						<li><a target="_blank" href="<?php echo esc_attr( $redchili_social );?>"><i class="fa <?php echo esc_attr( RDTheme::$redchili_event_social[$redchili_key]['icon'] );?>"></i></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>	
		</div>
		<?php } ?>
	</div>
	<?php if(!empty($rc_event_lan) && !empty($rc_event_lat)){ ?>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<div class="event-map">
			<div id ="event-map">
			</div>
		</div>
	</div>
	<?php } ?>
</div>