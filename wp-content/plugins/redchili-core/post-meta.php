<?php
if ( !class_exists( 'RT_Postmeta' ) ) {
	return;
}

$REDCHILI_Postmeta = RT_Postmeta::getInstance();

///////////////////
// Page Settings //
///////////////////
$nav_menus = wp_get_nav_menus( array( 'fields' => 'id=>name' ) );
$nav_menus = array( 'default' => __( 'Default', 'redchili-core' ) ) + $nav_menus;
$sidebars  = array( 'default' => __( 'Default', 'redchili-core' ) ) + RDTheme_Helper::custom_sidebar_fields();

$REDCHILI_Postmeta->add_meta_box( 'page_settings', __( 'Layout Settings', 'redchili-core' ), array( 'page', 'post', 'rc_chef', 'rc_event', 'rc_recipe', 'food-menu' ), '', '', 'high', array(
	'fields' => array(
		'redchili_layout' => array(
			'label'   => __( 'Layout', 'redchili-core' ),
			'type'    => 'select',
			'options' => array(
				'default'       => __( 'Default', 'redchili-core' ),
				'full-width'    => __( 'Full Width', 'redchili-core' ),
				'left-sidebar'  => __( 'Left Sidebar', 'redchili-core' ),
				'right-sidebar' => __( 'Right Sidebar', 'redchili-core' ),
				),
			'default'  => 'default',
			),			
		'redchili_sidebar' => array(
			'label'    => __( 'Custom Sidebar', 'redchili-core' ),
			'type'     => 'select',
			'options'  => $sidebars,
			'default'  => 'default',
			),
		'redchili_page_menu' => array(
			'label'   => __( 'Main Menu', 'redchili-core' ),
			'type'    => 'select',
			'options' => $nav_menus,
			'default' => 'default',
			),
		'redchili_tr_header' => array(
			'label'   => __( 'Transparent Header', 'redchili-core' ),
			'type'    => 'select',
			'options' => array(
				'default' => __( 'Default', 'redchili-core' ),
				'on'      => __( 'Enabled', 'redchili-core' ),
				'off'     => __( 'Disabled', 'redchili-core' ),
				),
			'default'  => 'default',
			),
		'redchili_top_bar' => array(
			'label'   => __( 'Top Bar', 'redchili-core' ),
			'type'    => 'select',
			'options' => array(
				'default' => __( 'Default', 'redchili-core' ),
				'on'      => __( 'Enabled', 'redchili-core' ),
				'off'     => __( 'Disabled', 'redchili-core' ),
				),
			'default'  => 'default',
			),
		'redchili_top_bar_style' => array(
			'label'   => __( 'Top Bar Layout', 'redchili-core' ),
			'type'    => 'select',
			'options' => array(
				'default' => __( 'Default', 'redchili-core' ),
				'1'       => __( 'Layout 1', 'redchili-core' ),
				'2'       => __( 'Layout 2', 'redchili-core' ),
				'3'       => __( 'Layout 3', 'redchili-core' ),
				),
			'default'  => 'default',
			),
		'redchili_header' => array(
			'label'   => __( 'Header Layout', 'redchili-core' ),
			'type'    => 'select',
			'options' => array(
				'default' => __( 'Default', 'redchili-core' ),
				'1'       => __( 'Layout 1', 'redchili-core' ),
				'2'       => __( 'Layout 2', 'redchili-core' ),
				'3'       => __( 'Layout 3', 'redchili-core' ),
				'4'       => __( 'Layout 4', 'redchili-core' ),
				'5'       => __( 'Layout 5', 'redchili-core' ),
				),
			'default'  => 'default',
			),
		'redchili_top_padding' => array(
			'label'   => __( 'Content Padding Top', 'redchili-core' ),
			'type'    => 'select',
			'options' => array(
				'default' => __( 'Default', 'redchili-core' ),
				'0px'     => '0px',
				'10px'    => '10px',
				'20px'    => '20px',
				'30px'    => '30px',
				'40px'    => '40px',
				'50px'    => '50px',
				'60px'    => '60px',
				'70px'    => '70px',
				'80px'    => '80px',
				'90px'    => '90px',
				'100px'   => '100px',
				),
			'default'  => 'default',
			),
		'redchili_bottom_padding' => array(
			'label'   => __( 'Content Padding Bottom', 'redchili-core' ),
			'type'    => 'select',
			'options' => array(
				'default' => __( 'Default', 'redchili-core' ),
				'0px'     => '0px',
				'10px'    => '10px',
				'20px'    => '20px',
				'30px'    => '30px',
				'40px'    => '40px',
				'50px'    => '50px',
				'60px'    => '60px',
				'70px'    => '70px',
				'80px'    => '80px',
				'90px'    => '90px',
				'100px'   => '100px',
				),
			'default'  => 'default',
			),
		'redchili_banner' => array(
			'label'   => __( 'Banner', 'redchili-core' ),
			'type'    => 'select',
			'options' => array(
				'default' => __( 'Default', 'redchili-core' ),
				'on'      => __( 'Enable', 'redchili-core' ),
				'off'     => __( 'Disable', 'redchili-core' ),
				),
			'default'  => 'default',
			),
		'redchili_breadcrumb' => array(
			'label'   => __( 'Breadcrumb', 'redchili-core' ),
			'type'    => 'select',
			'options' => array(
				'default' => __( 'Default', 'redchili-core' ),
				'on'      => __( 'Enable', 'redchili-core' ),
				'off'     => __( 'Disable', 'redchili-core' ),
				),
			'default'  => 'default',
			),
		'redchili_banner_type' => array(
			'label'   => __( 'Banner Background Type', 'redchili-core' ),
			'type'    => 'select',
			'options' => array(
				'default'  => __( 'Default', 'redchili-core' ),
				'bgimg'    => __( 'Background Image', 'redchili-core' ),
				'bgcolor'  => __( 'Background Color', 'redchili-core' ),
				),
			'default'  => 'default',
			),
		'redchili_banner_bgimg' => array(
			'label' => __( 'Banner Background Image', 'redchili-core' ),
			'type'  => 'image',
			'desc'  => __( 'If not selected, default will be used', 'redchili-core' ),
			),
		'redchili_banner_bgcolor' => array(
			'label' => __( 'Banner Background Color', 'redchili-core' ),
			'type'  => 'color_picker',
			'desc'  => __( 'If not selected, default will be used', 'redchili-core' ),
			),
		),
	) 
);

////////////
// Recipe //
////////////
$REDCHILI_Postmeta->add_meta_box( 'recipe_info', __( 'Recipe Information', 'redchili-core' ), array( 'rc_recipe' ), '', '', 'high', array(
	'fields' => array(
		'rc_recipe_prep_time' => array(
			'label' => __( 'Preparation Time', 'redchili-core' ),
			'type'  => 'text',
			'desc'  => __( 'Enter text eg. 20 Mins , 1 Hour', 'redchili-core' ),
			),
		'rc_recipe_cook_time' => array(
			'label' => __( 'Cooking Time', 'redchili-core' ),
			'type'  => 'text',
			'desc'  => __( 'Enter text eg. 20 Mins , 1 Hour', 'redchili-core' ),
			),
		'rc_recipe_ready_in' => array(
			'label' => __( 'Ready In', 'redchili-core' ),
			'type'  => 'text',
			'desc'  => __( 'Enter text eg. 20 Mins , 1 Hour', 'redchili-core' ),
			),
		'rc_recipe_serving_people' => array(
			'label' => __( 'Number of Serving People', 'redchili-core' ),
			'type'  => 'number',
			'desc'  => __( 'Enter text eg. 2 or 5', 'redchili-core' ),
			),			
		'rc_recipe_ingredient_box' => array(
			'label' => __( 'Ingredents', 'redchili-core' ),
			'type'  => 'header',			
			),
		'rc_recipe_ingredient_list' => array(
			'type'   => 'repeater',
			'button' => __( 'Add New Ingredient', 'redchili-core' ),
			'value'  => array(				
				'ingredient_item' => array(
					'label' => __( 'Item', 'redchili-core' ),
					'type'  => 'text',
					'desc'  => __( 'Enter text eg. 60 ml extra virgin olive oil', 'redchili-core' ),					
					),					
				'ingredient_quantity' => array(
						'label' => __( 'Quantity', 'redchili-core' ),
						'type'  => 'number',
						'desc'  => __( 'Enter Quantity eg. 60', 'redchili-core' ),
					),										
				'ingredient_unit' => array(
						'label' => __( 'Unit', 'redchili-core' ),
						'type'  => 'text',
						'desc'  => __( 'Enter Quantity unit. Like gm, ml, litre, cup , tea spoon', 'redchili-core' ),
					),
				)
			),
		'rc_recipe_nutrition_box' => array(
			'label' => __( 'Nutrition', 'redchili-core' ),
			'type'  => 'header',
			),		
		'rc_recipe_nutrition_serve' => array(
			'label' => __( 'Subtitle', 'redchili-core' ),
			'type'  => 'text',
			'desc'  => __( 'Enter text eg. per serving', 'redchili-core' ),
			),
		'rc_recipe_nutritions_list' => array(
			'type'   => 'repeater',
			'button' => __( 'Add New Nutrition Item', 'redchili-core' ),
			'value'  => array(				
				'nutritions_item' => array(
					'label' => __( 'Nutrition Item', 'redchili-core' ),
					'type'  => 'text',
					'desc'  => __( 'Enter text eg. Protine: 6.60g', 'redchili-core' ),
					
					)
				)
			),
		'rc_recipe_pdf' => array(
			'label' => __( 'Recipe PDF', 'redchili-core' ),
			'type'  => 'file',
			'desc'  => __( 'Please upload the PDF file here(optional)', 'redchili-core' ),
			),			
		'rc_recipe_other' => array(
			'label' => __( 'Show Other Recipes', 'redchili-core' ),
			'type'  => 'select',
			'options' => array(				
				'on'    => 'Yes',
				'off'   => 'No',
				),
			'default'  => '1',
			),		
		)
	)
);

//////////
// Chef //
//////////
$redchili_chef_social = array(
	'facebook' => array(
		'label' => __( 'Facebook', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-facebook',
		),
	'twitter' => array(
		'label' => __( 'Twitter', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-twitter',
		),
	'linkedin' => array(
		'label' => __( 'Linkedin', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-linkedin',
		),
	'gplus' => array(
		'label' => __( 'Google Plus', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-google-plus',
		),
	'skype' => array(
		'label' => __( 'Skype', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-skype',
		),
	'youtube' => array(
		'label' => __( 'Youtube', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-youtube-play',
		),
	'pinterest' => array(
		'label' => __( 'Pinterest', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-pinterest-p',
		),
	'instagram' => array(
		'label' => __( 'Instagram', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-instagram',
		),
	'github' => array(
		'label' => __( 'Github', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-github',
		),
	'stackoverflow' => array(
		'label' => __( 'Stackoverflow', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-stack-overflow',
		),
	);

$redchili_chef_social = apply_filters( 'chef_socials', $redchili_chef_social );

RDTheme::$redchili_chef_social = $redchili_chef_social;

$REDCHILI_Postmeta->add_meta_box( 'chef_socials', __( 'Chef Socials', 'redchili-core' ), array( 'rc_chef' ), '', '', 'high', array(
	'fields' => array(
		'rc_chef_socials_header' => array(
			'label' => __( 'Socials', 'redchili-core' ),
			'type'  => 'header',
			'desc'  => __( 'Put your chefs links here', 'redchili-core' ),
			),
		'redchili_chef_social' => array(
			'type'  => 'group',
			'value'  => $redchili_chef_social
			),
		)
	)
);

$REDCHILI_Postmeta->add_meta_box( 'chef_info', __( 'Chef Information', 'redchili-core' ), array( 'rc_chef' ), '', '', 'high', array(
	'fields' => array(
		'rc_chef_designation' => array(
			'label' => __( 'Designation', 'redchili-core' ),
			'type'  => 'text',
			),
		'rc_chef_other' => array(
			'label' => __( 'Show Other Chef', 'redchili-core' ),
			'type'  => 'select',
			'options' => array(					
				'off' => 'No',
				'on'    => 'Yes',
				),
			),
		)
	)
);

$REDCHILI_Postmeta->add_meta_box( 'chef_skills', __( 'Chef Skills', 'redchili-core' ), array( 'rc_chef' ), '', '', 'high', array(
	'fields' => array(
		'rc_chef_skill' => array(
			'type'  => 'repeater',
			'button' => __( 'Add New Skill', 'redchili-core' ),
			'value'  => array(
				'skill_name' => array(
					'label' => __( 'Skill Name', 'redchili-core' ),
					'type'  => 'text',
					'desc'  => __( 'eg. Recipes', 'redchili-core' ),
					),
				'skill_value' => array(
					'label' => __( 'Skill Percentage (%)', 'redchili-core' ),
					'type'  => 'text',
					'desc'  => __( 'eg. 75', 'redchili-core' ),
					),
				)
			),
		)
	)
);

/////////////////
// Testimonial //
/////////////////
$REDCHILI_Postmeta->add_meta_box( 'testimonial_info',
	__( 'Testimonial Information', 'redchili-core' ), array( 'rc_testimonial' ), '', '', 'high', array(
	'fields' => array(
		'rc_testimonial_rating' => array(
			'label' => __( 'Select the Rating', 'redchili-core' ),
			'type'  => 'select',
			'options' => array(
				'default' => __( 'Default', 'redchili-core' ),
				'1'    => '1',
				'2'    => '2',
				'3'    => '3',
				'4'    => '4',
				'5'    => '5'
				),
			'default'  => 'default',
			),
		'rc_testimonial_designation' => array(
			'label' => __( 'Designation', 'redchili-core' ),
			'type'  => 'text',
			'default'  => '',
			)		
		)
	)
);

/////////////////
//	 Event 	   //
/////////////////
$redchili_event_social = array(
	'facebook' => array(
		'label' => __( 'Facebook', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-facebook',
		),
	'twitter' => array(
		'label' => __( 'Twitter', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-twitter',
		),
	'linkedin' => array(
		'label' => __( 'Linkedin', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-linkedin',
		),
	'gplus' => array(
		'label' => __( 'Google Plus', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-google-plus',
		),
	'skype' => array(
		'label' => __( 'Skype', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-skype',
		),
	'youtube' => array(
		'label' => __( 'Youtube', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-youtube-play',
		),
	'pinterest' => array(
		'label' => __( 'Pinterest', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-pinterest-p',
		),
	'instagram' => array(
		'label' => __( 'Instagram', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-instagram',
		),
	'github' => array(
		'label' => __( 'Github', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-github',
		),
	'stackoverflow' => array(
		'label' => __( 'Stackoverflow', 'redchili-core' ),
		'type'  => 'text',
		'icon'  => 'fa-stack-overflow',
		),
	);

$redchili_event_social = apply_filters( 'event_socials', $redchili_event_social );

RDTheme::$redchili_event_social = $redchili_event_social;

$REDCHILI_Postmeta->add_meta_box( 'event_info',
	__( 'Event Information', 'redchili-core' ), array( 'rc_event' ), '', '', 'high', array(
	'fields' => array(
		'rc_event_start_date' => array(
			'label' => __( 'Start Date', 'redchili-core' ),
			'type'  => 'date_picker',
			'default'  => '',
			),
		'rc_event_start_time' => array(
			'label' => __( 'Start Time', 'redchili-core' ),
			'type'  => 'time_picker_24',
			'default'  => '',
			),
		'rc_event_end_date' => array(
			'label' => __( 'End Date', 'redchili-core' ),
			'type'  => 'date_picker',
			'default'  => '',
			),
		'rc_event_end_time' => array(
			'label' => __( 'End Time', 'redchili-core' ),
			'type'  => 'time_picker_24',
			'default'  => '',
			),
		'rc_event_seat' => array(
			'label' => __( 'Participant Nubmer', 'redchili-core' ),
			'type'  => 'number',
			'default'  => '',
			),
		'rc_event_location' => array(
			'label' => __( 'Address', 'redchili-core' ),
			'type'  => 'text',
			'default'  => '',
			),
		'rc_event_lat' => array(
			'label' => __( 'Location Map Latitude', 'redchili-core' ),
			'type'  => 'text',
			'default'  => '',
			),
		'rc_event_lan' => array(
			'label' => __( 'Location Map Longitude', 'redchili-core' ),
			'type'  => 'text',
			'default'  => '',
			),
		'rc_event_ext_link' => array(
			'label' => __( 'External Web Link', 'redchili-core' ),
			'type'  => 'text',
			'default'  => '',
			),	
		)
	)
);

$REDCHILI_Postmeta->add_meta_box( 'event_socials', __( 'Event Socials Link', 'redchili-core' ), array( 'rc_event' ), '', '', 'high', array(
	'fields' => array(
		'rc_event_socials_header' => array(
			'label' => __( 'Socials', 'redchili-core' ),
			'type'  => 'header',
			'desc'  => __( 'Put your Event links here', 'redchili-core' ),
			),
		'redchili_event_social' => array(
			'type'  => 'group',
			'value'  => $redchili_event_social
			),
		)
	)
);
