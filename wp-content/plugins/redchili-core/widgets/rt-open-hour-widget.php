<?php
/**
* Widget API: Open Hour Widget class
* By : Radius Theme
*/
class RDTheme_Open_Hour_Widget extends WP_Widget {
	public $weekdays;
	public function __construct() {
		$widget_ops = array(
			'classname' => 'rt_widget_open_hour',
			'description' => esc_html__( 'Display the opening hours' , 'redchili-core' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rt-open-hour', esc_html__( 'RDTheme: Opening Hours' , 'redchili-core' ), $widget_ops );	
		
		$this->weekdays = array(
			'monday'   => esc_html__( 'Monday', 'redchili-core' ),
			'tuesday'  => esc_html__( 'Tuesday', 'redchili-core' ),
			'wednesday'=> esc_html__( 'Wednesday', 'redchili-core' ),
			'thursday' => esc_html__( 'Thursday', 'redchili-core' ),
			'friday'   => esc_html__( 'Friday', 'redchili-core' ),
			'saturday' => esc_html__( 'Saturday', 'redchili-core' ),
			'sunday'   => esc_html__( 'Sunday', 'redchili-core' ),
		);
	}
	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		
		echo wp_kses_post( $args['before_widget'] );
		if ( ! empty( $title ) ) {
			echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );
		} ?>		
		<ul class="opening-schedule">
			<?php foreach( $this->weekdays as $key=>$weekday ){
				$from_label = $key.'_from';
				$to_label = $key.'_to';
				$from_label = ! empty( $instance[$from_label] ) ? $instance[$from_label] : '';
				$to_label   = ! empty( $instance[$to_label] ) ? $instance[$to_label] : '';
			?>
				<li>
					<?php echo esc_html( $weekday ); ?>
					<?php if( !empty( $from_label ) && !empty( $to_label ) ){ ?>
						<span> <?php echo esc_html( $from_label ); ?> - <?php echo esc_html( $to_label ); ?> </span> 
					<?php } else { ?>
						<span class="os-close"><?php esc_html_e('Closed' , 'redchili-core');?></span>
					<?php } ?>
				</li>
			<?php } ?>
		</ul>
		<?php
		echo wp_kses_post( $args['after_widget'] );
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		
		foreach( $this->weekdays as $key=>$weekday ){	
			$from_label = $key.'_from';
			$to_label = $key.'_to';
			
			$instance[$from_label] 	= sanitize_text_field( $new_instance[$from_label] );
			$instance[$to_label] 	= sanitize_text_field( $new_instance[$to_label] );
		}			

		return $instance;
	}
	// the form
	public function form( $instance ) {		
		//default data
		$instance = wp_parse_args( (array) $instance, array( 
			'title' => '',		
			'saturday_from' => '',
			'saturday_to' => '',
			'sunday_from' => '',
			'sunday_to' => '',
			'monday_from' => '',
			'monday_to' => '',
			'tuesday_from' => '',
			'tuesday_to' => '',
			'wednesday_from' => '',
			'wednesday_to' => '',
			'thursday_from' => '',
			'thursday_to' => '',
			'friday_from' => '',
			'friday_to' => ''
		) );

		$title = sanitize_text_field( $instance['title'] );
		?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'redchili-core' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<table>
			<tr>
				<th style="width: 30%"><?php esc_html_e( 'Days' , 'redchili-core'); ?></th>
				<th style="width: 30%"><?php esc_html_e( 'From' , 'redchili-core'); ?></th>
				<th style="width: 10%; text-align: center"></th>
				<th style="width: 30%"><?php esc_html_e( 'To' , 'redchili-core'); ?></th>
			</tr>
		<?php foreach ( $this->weekdays as $key=>$weekday ): ?>
			<?php			
				$from_label = $key.'_from';
				$to_label = $key.'_to';
				if( empty($from_label) || empty( $to_label ) ) {
					$from = '';
					$to   = '';
				} else {
					$from = sanitize_text_field( $instance[$from_label] );
					$to   = sanitize_text_field( $instance[$to_label] );
				}
			?>
			<tr>
				<td style="width: 30%">
					<label for="<?php echo esc_attr( $this->get_field_id( $from_label ) ); ?>">
						<?php echo esc_html($weekday); ?>
					</label>
				</td>
				<td style="width: 30%">
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $from_label ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $from_label ) ); ?>" type="text" value="<?php if( !empty( $from ) ) { echo esc_attr( $from ); } ?>" />
				</td>
				<td style="width: 10%; text-align: center">
					<label for="<?php echo esc_attr( $this->get_field_id( $to_label ) ); ?>">
						<?php esc_html_e( '-', 'redchili-core' ); ?>
					</label>
				</td>
				<td style="width: 30%">
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $to_label ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $to_label ) ); ?>" type="text" value="<?php if( !empty( $to ) ) { echo esc_attr( $to ); } ?>" />
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
		<?php
	}
}