<?php
if ( !class_exists( 'RT_Posts' ) ) {
	return;
}
$redchili_post_types = array(
	'rc_recipe'        => array(
		'title'        => __( 'Recipe', 'redchili-core' ),
		'plural_title' => __( 'Recipes', 'redchili-core' ),
		'menu_icon'    => 'dashicons-carrot',
		'rewrite'      => RDTheme::$options['recipe_slug'],
		),
		
	'rc_chef'          => array(
		'title'        => __( 'Chef', 'redchili-core' ),
		'plural_title' => __( 'Chefs', 'redchili-core' ),
		'menu_icon'    => 'dashicons-businessman',
		'rewrite'      => RDTheme::$options['chef_slug'],
		),
		
	'rc_testimonial'   => array(
		'title'        => __( 'Testimonial', 'redchili-core' ),
		'plural_title' => __( 'Testimonials', 'redchili-core' ),
		'menu_icon'    => 'dashicons-awards',
		'rewrite'      => false,
		),
		
	'rc_event'         => array(
		'title'        => __( 'Event', 'redchili-core' ),
		'plural_title' => __( 'Events', 'redchili-core' ),
		'menu_icon'    => 'dashicons-megaphone',
		'rewrite'      => RDTheme::$options['event_slug'],
		),
	);

$redchili_taxonomies = array(
	'rc_recipe_category' => array(
		'title'        => __( 'Recipe Category', 'redchili-core' ),
		'plural_title' => __( 'Recipe Categories', 'redchili-core' ),
		'post_types'   => 'rc_recipe',
		),
	'rc_chef_category' => array(
		'title'        => __( 'Chef Category', 'redchili-core' ),
		'plural_title' => __( 'Chef Categories', 'redchili-core' ),
		'post_types'   => 'rc_chef',
		),
	'rc_event_category'=> array(
		'title'        => __( 'Event Category', 'redchili-core' ),
		'plural_title' => __( 'Event Categories', 'redchili-core' ),
		'post_types'   => 'rc_event',
		),
	);

$REDCHILI_Posts = RT_Posts::getInstance();
$REDCHILI_Posts->add_post_types( $redchili_post_types );
$REDCHILI_Posts->add_taxonomies( $redchili_taxonomies );