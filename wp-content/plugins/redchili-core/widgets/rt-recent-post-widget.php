<?php 
/**
* Widget API: Recent Post Widget class
* By : Radius Theme
*/
Class RDTheme_Recent_Posts_With_Image_Widget extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'rt_widget_recent_entries_with_image',
			'description' => esc_html__( 'Your site&#8217;s most recent Posts.' , 'redchili-core' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rt-recent-posts', esc_html__( 'RDTheme: Recent Posts' , 'redchili-core' ), $widget_ops );
		$this->alt_option_name = 'rt_widget_recent_entries';
	}
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$args['before_title']='<h3 class="widget-title-bar">';
		$args['after_title']='</h3>';
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts' , 'redchili-core' );		
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$result_query = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );
		if ($result_query->have_posts()) :
		?>
		<?php echo wp_kses_post($args['before_widget']); ?>
		<?php if ( $title ) {
			echo wp_kses_post($args['before_title']) . $title . wp_kses_post($args['after_title']);
		} ?>
		<?php while ( $result_query->have_posts() ) : $result_query->the_post(); ?>
			<div class="media">
				<a href="<?php the_permalink(); ?>" class="pull-left" title="<?php the_title_attribute(); ?>">
					<?php if ( has_post_thumbnail() ) { ?>
						<?php the_post_thumbnail('rdtheme-size3'); ?>					
					<?php } ?>					
				</a>
				<div class="media-body">
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<?php if ( $show_date ) : ?>
					<p><?php echo get_the_date('d M, Y'); ?></p>
					<?php endif; ?>
				</div>
			</div>
		<?php endwhile; ?>		
		<?php echo wp_kses_post($args['after_widget']); ?>
		<?php
		wp_reset_postdata();
		endif;
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance 				= $old_instance;
		$instance['title'] 		= sanitize_text_field( $new_instance['title'] );
		$instance['number'] 	= (int) $new_instance['number'];
		$instance['show_date']  = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}
	
	public function form( $instance ){
		$defaults = array(
			'title'         => esc_html__( 'Latest Post' , 'redchili-core' ),
			'number'		=> '5',
			'show_date'		=> true,
			);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = array(
			'title'			=> array(
				'label'		=> esc_html__( 'Title', 'redchili-core' ),
				'type'		=> 'text',
				),
			'number'        => array(
				'label'		=> esc_html__( 'Number of posts to show', 'redchili-core' ),
				'type'      => 'number',
				),
			'show_date'		=> array(
				'label'		=> esc_html__( 'Display post date?', 'redchili-core' ),
				'type'      => 'checkbox',
				),
			);
		
		RT_Widget_Fields::display( $fields, $instance, $this );
	}		
}