<?php 
/**
* Widget API: Recent Recipe Widget class
* By : Radius Theme
*/
Class RDTheme_Recent_Recipe_With_Image_Widget extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'rt_widget_recent_recipe_with_image',
			'description' => esc_html__( 'Your site&#8217;s most recent recipes.' , 'redchili-core' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rt-recent-recipe', esc_html__( 'RDTheme: Latest Recipe' , 'redchili-core' ), $widget_ops );
		$this->alt_option_name = 'rt_widget_recent_recipe';
	}
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}		
		$args['before_title']='<h2 class="widgettitle widget-title-bar title-sidebar title-bar">';
		$args['after_title'] ='</h2>';
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Recipe'  , 'redchili-core' );
		
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$result_query = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'post_type'			  => 'rc_recipe',
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true			
		) ) );

		if ($result_query->have_posts()) {
		?>
		<?php echo wp_kses_post($args['before_widget']); ?>
		<?php if ( $title ) {
			 echo wp_kses_post($args['before_title']) . $title . wp_kses_post($args['after_title']);
		} ?>
		<?php while ( $result_query->have_posts() ) : $result_query->the_post(); ?>
			<div class="media">
				<a href="<?php the_permalink(); ?>" class="pull-left" title="<?php the_title_attribute(); ?>">
					<?php if ( has_post_thumbnail() ) { ?>
						<?php the_post_thumbnail('rdtheme-size2'); ?>					
					<?php } else { ?>
						<img src="<?php echo RDTHEME_IMG_URL ; ?>widget-post-demo.jpg" alt="<?php the_title(); ?>" class="img-responsive" />
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
		<?php
		wp_reset_postdata();
		} else {
			_e('No Recipe Found', 'redchili-core');
		}
		 echo wp_kses_post($args['after_widget']); 
	}
		
	public function form( $instance ){
		$defaults = array(
			'title'          => esc_html__( 'Latest Recipe' , 'redchili-core' ),
			'number'    	 => '5',
			'show_date'		 => true,
			);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = array(
			'title'          => array(
				'label'    	 => esc_html__( 'Title', 'redchili-core' ),
				'type'       => 'text',
				),
			'number'         => array(
				'label'    	 => esc_html__( 'Number of posts to show', 'redchili-core' ),
				'type'       => 'number',
				),
			'show_date'		 => array(
				'label'		 => esc_html__( 'Display post date?', 'redchili-core' ),
				'type'       => 'checkbox',
				),
			);
		
		RT_Widget_Fields::display( $fields, $instance, $this );
	}		
}