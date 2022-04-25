<?php
/**
 * Widget API: About Widget class
 * By : Radius Theme
 */
class RDTheme_About_Widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
            'redchili_about_widget', // Base ID
            esc_html__( 'RDTheme: About', 'redchili-core' ), // Name
            array( 'description' => esc_html__( 'RDTheme: About Widget With Social Link', 'redchili-core' ) ) // Args
            );
	}

	public function widget( $args, $instance ){
		echo wp_kses_post( $args['before_widget'] );
		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', esc_html( $instance['title'] ) ) . wp_kses_post( $args['after_title'] );
		}
		?>
		<div class="textwidget">
			<?php if( !empty( $instance['description'] ) ) echo esc_html( $instance['description'] ); ?>			
		</div>
		<div class="footer-social-media-area">
			<ul class="footer-social">
				<?php
				if( !empty( $instance['facebook'] ) ){
					?><li><a href="<?php echo esc_url( $instance['facebook'] ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php
				}
				if( !empty( $instance['twitter'] ) ){
					?><li><a href="<?php echo esc_url( $instance['twitter'] ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php
				}
				if( !empty( $instance['gplus'] ) ){
					?><li><a href="<?php echo esc_url( $instance['gplus'] ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php
				}
				if( !empty( $instance['linkedin'] ) ){
					?><li><a href="<?php echo esc_url( $instance['linkedin'] ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php
				}
				if( !empty( $instance['youtube'] ) ){
					?><li><a href="<?php echo esc_url( $instance['youtube'] ); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li><?php
				}
				if( !empty( $instance['pinterest'] ) ){
					?><li><a href="<?php echo esc_url( $instance['pinterest'] ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li><?php
				}
				if( !empty( $instance['rss'] ) ){
					?><li><a href="<?php echo esc_url( $instance['rss'] ); ?>" target="_blank"><i class="fa fa-rss"></i></a></li><?php
				}
				if( !empty( $instance['instagram'] ) ){
					?><li><a href="<?php echo esc_url( $instance['instagram'] ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li><?php
				}
				?>
			</ul>
		</div> 

		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ){
		$instance                  = array();
		$instance['title']         = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['description']   = ( ! empty( $new_instance['description'] ) ) ? wp_kses_post( $new_instance['description'] ) : '';
		$instance['facebook']      = ( ! empty( $new_instance['facebook'] ) ) ? sanitize_text_field( $new_instance['facebook'] ) : '';
		$instance['twitter']       = ( ! empty( $new_instance['twitter'] ) ) ? sanitize_text_field( $new_instance['twitter'] ) : '';
		$instance['gplus']         = ( ! empty( $new_instance['gplus'] ) ) ? sanitize_text_field( $new_instance['gplus'] ) : '';
		$instance['linkedin']      = ( ! empty( $new_instance['linkedin'] ) ) ? sanitize_text_field( $new_instance['linkedin'] ) : '';
		$instance['youtube']  	   = ( ! empty( $new_instance['youtube'] ) ) ? sanitize_text_field( $new_instance['youtube'] ) : '';
		$instance['pinterest']     = ( ! empty( $new_instance['pinterest'] ) ) ? sanitize_text_field( $new_instance['pinterest'] ) : '';
		$instance['rss']           = ( ! empty( $new_instance['rss'] ) ) ? sanitize_text_field( $new_instance['rss'] ) : '';
		$instance['instagram']     = ( ! empty( $new_instance['instagram'] ) ) ? sanitize_text_field( $new_instance['instagram'] ) : '';
		return $instance;
	}

	public function form( $instance ){
		$defaults = array(
			'title'          => esc_html__( 'About Company' , 'redchili-core' ),
			'description'    => '',
			'facebook'       => '',
			'twitter'        => '',
			'gplus'          => '',
			'linkedin'       => '',
			'youtube'        => '',
			'pinterest'      => '',
			'rss'            => '', 
			'instagram'      => '',
			);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = array(
			'title'          => array(
				'label'    	 => esc_html__( 'Title', 'redchili-core' ),
				'type'       => 'text',
				),
			'description'          => array(
				'label'		 => esc_html__( 'Description', 'redchili-core' ),
				'type'       => 'textarea',
				),
			'facebook'          => array(
				'label'		 => esc_html__( 'Facebook URL', 'redchili-core' ),
				'type'       => 'url',
				),
			'twitter'		 => array(
				'label'		 => esc_html__( 'Twitter URL', 'redchili-core' ),
				'type'       => 'url',
				),
			'gplus'          => array(
				'label'		 => esc_html__( 'Google Plus URL', 'redchili-core' ),
				'type'       => 'url',
				),
			'linkedin'		 => array(
				'label'		 => esc_html__( 'Linkedin URL', 'redchili-core' ),
				'type'       => 'url',
				),
			'youtube'		 => array(
				'label'		 => esc_html__( 'Youtube URL', 'redchili-core' ),
				'type'       => 'url',
				),
			'pinterest'		 => array(
				'label'		 => esc_html__( 'Pinterest URL', 'redchili-core' ),
				'type'       => 'url',
				),
			'rss'   		 => array(
				'label' 	 => esc_html__( 'Rss Feed URL', 'redchili-core' ),
				'type'       => 'url',
				),
			'instagram'		 => array(
				'label'		 => esc_html__( 'Instagram URL', 'redchili-core' ),
				'type'       => 'url',
				),
			);
		
		RT_Widget_Fields::display( $fields, $instance, $this );
	}
}