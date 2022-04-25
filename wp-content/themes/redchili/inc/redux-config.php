<?php
if ( ! class_exists( 'Redux' ) ) {
    return;
}

$opt_name = "redchili";

$theme = wp_get_theme();
$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'disable_tracking' => true,
    'display_name'         => $theme->get( 'Name' ),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get( 'Version' ),
    // Version that appears at the top of your panel
    'menu_type'            => 'submenu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__( 'RedChili Options', 'redchili' ),
    'page_title'           => esc_html__( 'RedChili Options', 'redchili' ),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    //'google_api_key'       => 'AIzaSyC2GwbfJvi-WnYpScCPBGIUyFZF97LI0xs',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-menu',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    'forced_dev_mode_off'  => false,
    // Show the time the page took to load, etc
    'update_notice'        => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => 'redchili-options',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => true,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
);

Redux::setArgs( $opt_name, $args );

// Fields
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'General', 'redchili' ),
    'id'               => 'general_section',
    'heading'          => '',
    'icon'             => 'el el-network',
    'fields' => array(
        array(
            'id'       => 'primary_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Primary Color', 'redchili' ),
            'default'  => '#e7272d',
        ), 
        array(
            'id'       => 'secondery_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Secondery/Hover Color', 'redchili' ),
            'default'  => '#d32f2f',
        ),
        array(
            'id'       => 'preloader',
            'type'     => 'switch',
            'title'    => esc_html__( 'Preloader', 'redchili' ),
            'on'       => esc_html__( 'Enabled', 'redchili' ),
            'off'      => esc_html__( 'Disabled', 'redchili' ),
            'default'  => true,
        ),
		array(
			'id'       => 'preloader_image',
			'type'     => 'media',
			'title'    => esc_html__( 'Preloader Image', 'redchili' ),
			'subtitle' => esc_html__( 'Please upload your choice of preloader image. Transparent GIF format is recommended', 'redchili' ),
			'default'  => array(
			'url'=> RDTHEME_IMG_URL . 'preloader.gif'
			),
			'required' => array( 'preloader', 'equals', true )
		),
        array(
            'id'       => 'back_to_top',
            'type'     => 'switch',
            'title'    => esc_html__( 'Back to Top Arrow', 'redchili' ),
            'on'       => esc_html__( 'Enabled', 'redchili' ),
            'off'      => esc_html__( 'Disabled', 'redchili' ),
            'default'  => true,
        ),
        array(
            'id'       => 'no_preview_image',
            'type'     => 'media',
            'title'    => esc_html__( 'Alternative Preview Image', 'redchili' ),
            'subtitle' => esc_html__( 'This image will be used as preview image in some archive pages if no featured image exists', 'redchili' ),
            'default'  => array(
                'url'=> RDTHEME_IMG_URL . 'noimage.jpg'
            ),
        ),
		array(
			'id'       => 'recipe_slug',
			'type'     => 'text',
			'title'    => esc_html__( 'Recipe Slug', 'redchili' ),
			'subtitle' => esc_html__( 'Will be used as slug in Recipe breadcrumb', 'redchili' ),
			'default'  => 'recipe',
		),		
		array(
			'id'       => 'chef_slug',
			'type'     => 'text',
			'title'    => esc_html__( 'Chef Slug', 'redchili' ),
			'subtitle' => esc_html__( 'Will be used as slug in Chef breadcrumb', 'redchili' ),
			'default'  => 'chef',
		),
		array(
			'id'       => 'event_slug',
			'type'     => 'text',
			'title'    => esc_html__( 'Event Slug', 'redchili' ),
			'subtitle' => esc_html__( 'Will be used as slug in Event breadcrumb', 'redchili' ),
			'default'  => 'event',
		),
    )
) 
);

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Contact & Socials', 'redchili' ),
    'id'               => 'socials_section',
    'heading'          => '',
    'desc'             => esc_html__( 'In case you want to hide any field, keep that field empty', 'redchili' ),
    'icon'             => 'el el-twitter',
    'fields' => array(
        array(
            'id'       => 'phone',
            'type'     => 'text',
            'title'    => esc_html__( 'Phone', 'redchili' ),
			'default'  => '',
        ),
        array(
            'id'       => 'email',
            'type'     => 'text',
            'title'    => esc_html__( 'Email', 'redchili' ),
            'validate' => 'email',
			'default'  => '',
        ),
        array(
            'id'       => 'address',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Address', 'redchili' ),
			'default'  => '',
        ),
        array(
            'id'       => 'social_facebook',
            'type'     => 'text',
            'title'    => esc_html__( 'Facebook', 'redchili' ),
			'default'  => '',
        ),
        array(
            'id'       => 'social_twitter',
            'type'     => 'text',
            'title'    => esc_html__( 'Twitter', 'redchili' ),
			'default'  => '',
        ),
        array(
            'id'       => 'social_gplus',
            'type'     => 'text',
            'title'    => esc_html__( 'Google Plus', 'redchili' ),
			'default'  => '',
        ),
        array(
            'id'       => 'social_linkedin',
            'type'     => 'text',
            'title'    => esc_html__( 'Linkedin', 'redchili' ),
			'default'  => '',
        ),
        array(
            'id'       => 'social_youtube',
            'type'     => 'text',
            'title'    => esc_html__( 'Youtube', 'redchili' ),
			'default'  => '',
        ),
        array(
            'id'       => 'social_pinterest',
            'type'     => 'text',
            'title'    => esc_html__( 'Pinterest', 'redchili' ),
			'default'  => '',
        ),
        array(
            'id'       => 'social_instagram',
            'type'     => 'text',
            'title'    => esc_html__( 'Instagram', 'redchili' ),
			'default'  => '',
        ),
        array(
            'id'       => 'social_skype',
            'type'     => 'text',
            'title'    => esc_html__( 'Skype', 'redchili' ),
			'default'  => '',
        ),
        array(
            'id'       => 'social_rss',
            'type'     => 'text',
            'title'    => esc_html__( 'RSS', 'redchili' ),
			'default'  => '',
        ),
        array(
            'id'       => 'gmap_key',
            'type'     => 'text',
            'title'    => esc_html__( 'Google Map Key', 'redchili' ),
			'default'  => 'AIzaSyBgREM8KO8hjfbOC0R_btBhQsEQsnpzFGQ',
        ),
    )            
) );


Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Header', 'redchili' ),
    'id'               => 'header_section',
    'heading'          => '',
    'icon'             => 'el el-caret-up',
    'fields' => array(
		 array(
            'id'       => 'logo_type',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Logo Type', 'redchili' ),
            'options'  => array(
                'image_type'  		=> esc_html__( 'Image Logo', 'redchili' ),
                'text_type'    	=> esc_html__( 'Text Logo', 'redchili' ),
            ),
            'default' => 'image_type'
        ),
        array(
            'id'       => 'logo',
            'type'     => 'media',
            'title'    => esc_html__( 'Main Logo', 'redchili' ),
            'default'  => array(
                'url'=> RDTHEME_IMG_URL . 'logo-dark.png'
            ),
			'required' => array( 'logo_type', '=', 'image_type' ),
        ),
        array(
            'id'       => 'logo_light',
            'type'     => 'media',
            'title'    => esc_html__( 'Light Logo', 'redchili' ),
            'default'  => array(
                'url'=> RDTHEME_IMG_URL . 'logo-light.png'
            ),
            'subtitle' => esc_html__( 'Used when Transparent Header is enabled', 'redchili' ),
			'required' => array( 'logo_type', '=', 'image_type' ),
        ),
        array(
            'id'       => 'logo_text',
            'type'     => 'text',
            'title'    => esc_html__( 'Logo Text', 'redchili' ),
            'subtitle' => esc_html__( 'If you wants to Use Custom Text', 'redchili' ),           
            'default'  => get_bloginfo( 'name' ),
			'required' => array( 'logo_type', '=', 'text_type' ),
        ),
        array(
            'id'       => 'logo_text_typo',
            'type'     => 'typography',
            'title'    => esc_html__( 'Logo Text Typo', 'redchili' ),
            'google'   => true,
            'subsets'   => false,
            'text-align' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'default'     => array(
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '36px',
                'font-weight' => '700',
                'line-height' => '40',
                'letter-spacing' => '1px',
                'text-transform' => 'uppercase',
				'color'     	 => '#222222',
            ),
			'required' => array( 'logo_type', '=', 'text_type' ),
        ),
        array(
            'id'       => 'sticky_menu',
            'type'     => 'switch',
            'title'    => esc_html__( 'Sticky Header', 'redchili' ),
            'on'       => esc_html__( 'Enabled', 'redchili' ),
            'off'      => esc_html__( 'Disabled', 'redchili' ),
            'default'  => true,
            'subtitle' => esc_html__( 'Show header when scroll down', 'redchili' ),
        ), 
        array(
            'id'       => 'tr_header',
            'type'     => 'switch',
            'title'    => esc_html__( 'Transparent Header', 'redchili' ),
            'on'       => esc_html__( 'Enabled', 'redchili' ),
            'off'      => esc_html__( 'Disabled', 'redchili' ),
            'default'  => false,
            'subtitle' => esc_html__( 'You have to enable Banner or Slider in page to make it work properly. You can override this settings in individual pages', 'redchili' ),
        ),
        array(
            'id'       => 'top_bar',
            'type'     => 'switch',
            'title'    => esc_html__( 'Top Bar', 'redchili' ),
            'on'       => esc_html__( 'Enabled', 'redchili' ),
            'off'      => esc_html__( 'Disabled', 'redchili' ),
            'default'  => true,
            'subtitle' => esc_html__( 'You can override this settings in individual pages', 'redchili' ),
        ),
        array(
            'id'       => 'top_bar_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Top Bar Text Color', 'redchili' ),
            'default'  => '#a6b1b7',
        ),
        array(
            'id'       => 'top_bar_color_tr',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Transparent Top Bar Text Color', 'redchili' ),
            'subtitle' => esc_html__( 'Applied when Transparent Header is enabled', 'redchili' ),
            'default'  => '#efefef',
        ),
        array(
            'id'       => 'top_bar_bgcolor',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Top Bar Background Color', 'redchili' ),
            'default'  => '#222222',
        ),
        array(
            'id'       => 'top_bar_style',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Top Bar Layout', 'redchili' ),
            'default'  => '2',
            'options' => array(
                '1' => array(
                    'title' => '<b>'. esc_html__( 'Layout 1', 'redchili' ) . '</b>',
                    'img' => RDTHEME_IMG_URL . 'top1.jpg',
                ),
                '2' => array(
                    'title' => '<b>'. esc_html__( 'Layout 2', 'redchili' ) . '</b>',
                    'img' => RDTHEME_IMG_URL . 'top2.jpg',
                ),
                '3' => array(
                    'title' => '<b>'. esc_html__( 'Layout 3', 'redchili' ) . '</b>',
                    'img' => RDTHEME_IMG_URL . 'top3.jpg',
                ),
            ),
            'subtitle' => esc_html__( 'You can override this settings in individual pages', 'redchili' ),
        ),
        array(
            'id'       => 'header_style',
            'type'     => 'image_select',
            'title'    => esc_html__( 'Header Layout', 'redchili' ),
            'default'  => '1',
            'options' => array(
                '1' => array(
                    'title' => '<b>'. esc_html__( 'Layout 1', 'redchili' ) . '</b>',
                    'img' => RDTHEME_IMG_URL . 'header-1.jpg',
                ),
                '2' => array(
                    'title' => '<b>'. esc_html__( 'Layout 2', 'redchili' ) . '</b>',
                    'img' => RDTHEME_IMG_URL . 'header-2.jpg',
                ),
                '3' => array(
                    'title' => '<b>'. esc_html__( 'Layout 3', 'redchili' ) . '</b>',
                    'img' => RDTHEME_IMG_URL . 'header-3.jpg',
                ),
                '4' => array(
                    'title' => '<b>'. esc_html__( 'Layout 4', 'redchili' ) . '</b>',
                    'img' => RDTHEME_IMG_URL . 'header-4.jpg',
                ),
                '5' => array(
                    'title' => '<b>'. esc_html__( 'Layout 5', 'redchili' ) . '</b>',
                    'img' => RDTHEME_IMG_URL . 'header-5.jpg',
                ),
            ),
            'subtitle' => esc_html__( 'You can override this settings in individual pages', 'redchili' ),
        ),
        array(
            'id'       => 'header_btn_txt',
            'type'     => 'text',
            'title'    => esc_html__( 'Header Button Text', 'redchili' ),
            'subtitle' => esc_html__( 'Only used in Header Layout-5', 'redchili' ),
            'default'  => esc_html__( 'TRY IT !', 'redchili' ),
        ),
        array(
            'id'       => 'header_btn_url',
            'type'     => 'text',
            'title'    => esc_html__( 'Header Button URL', 'redchili' ),
            'subtitle' => esc_html__( 'Only used in Header Layout-5', 'redchili' ),
            'default'  => '#',
        ),
        array(
            'id'       => 'search_icon',
            'type'     => 'switch',
            'title'    => esc_html__( 'Search Icon', 'redchili' ),
            'on'       => esc_html__( 'Enabled', 'redchili' ),
            'off'      => esc_html__( 'Disabled', 'redchili' ),
            'default'  => true,
        ), 
        array(
            'id'       => 'cart_icon',
            'type'     => 'switch',
            'title'    => esc_html__( 'Cart Icon', 'redchili' ),
            'on'       => esc_html__( 'Enabled', 'redchili' ),
            'off'      => esc_html__( 'Disabled', 'redchili' ),
            'default'  => true,
        ), 
        array(
            'id'       => 'vertical_menu_icon',
            'type'     => 'switch',
            'title'    => esc_html__( 'Vertical Menu Icon', 'redchili' ),
            'on'       => esc_html__( 'Enabled', 'redchili' ),
            'off'      => esc_html__( 'Disabled', 'redchili' ),
            'default'  => false,
        ),
    )            
) 
);
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Main Menu', 'redchili' ),
    'id'               => 'menu_section',
    'heading'          => '',
    'icon'             => 'el el-book',
    'fields' => array(
        array(
            'id'       => 'section-mainmenu',
            'type'     => 'section',
            'title'    => esc_html__( 'Main Menu Items', 'redchili' ),
            'indent'   => true,
        ),
        array(
            'id'       => 'menu_typo',
            'type'     => 'typography',
            'title'    => esc_html__( 'Menu Font', 'redchili' ),
            'google'   => true,
            'subsets'   => false,
            'text-align' => false,
            'color'     => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'default'     => array(
                'font-family' => 'Oswald',
                'google'      => true,
                'font-size'   => '15px',
                'font-weight' => '400',
                'line-height' => '24px',
                'letter-spacing' => '1px',
                'text-transform' => 'uppercase',
            ),
        ),
        array(
            'id'       => 'menu_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Menu Color', 'redchili' ),
            'default'  => '#222222',
        ),
        array(
            'id'       => 'menu_color_tr',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Transparent Menu Color', 'redchili' ),
            'subtitle' => esc_html__( 'Applied when Transparent Header is enabled', 'redchili' ),
            'default'  => '#fff',
        ),
        array(
            'id'       => 'menu_hover_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Menu Hover Color', 'redchili' ),
            'default'  => '#e7272d',
        ),
        array(
            'id'       => 'section-submenu',
            'type'     => 'section',
            'title'    => esc_html__( 'Sub Menu Items', 'redchili' ),
            'indent'   => true,
        ), 
        array(
            'id'       => 'submenu_typo',
            'type'     => 'typography',
            'title'    => esc_html__( 'Submenu Font', 'redchili' ),
            'google'   => true,
            'subsets'   => false,
            'text-align'   => false,
            'color'   => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'default'     => array(
                'font-family' => 'Oswald',
                'google'      => true,
                'font-size'   => '14px',
                'font-weight' => '400',
                'line-height' => '21px',
                'letter-spacing' => '1px',
                'text-transform' => 'uppercase',
            ),
        ),
        array(
            'id'       => 'submenu_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Submenu Color', 'redchili' ),
            'default'  => '#ffffff',
        ), 
        array(
            'id'       => 'submenu_bgcolor',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Submenu Background Color', 'redchili' ),
            'default'  => '#e7272d',
        ),  
        array(
            'id'       => 'submenu_hover_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Submenu Hover Color', 'redchili' ),
            'default'  => '#071041',
        ), 
        array(
            'id'       => 'submenu_hover_bgcolor',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Submenu Hover Background Color', 'redchili' ),
            'default'  => '#e7272d',
        ),
        array(
            'id'       => 'section-resmenu',
            'type'     => 'section',
            'title'    => esc_html__( 'Mobile Menu', 'redchili' ),
            'indent'   => true,
        ), 
        array(
            'id'       => 'resmenu_width',
            'type'     => 'slider',
            'title'    => esc_html__( 'Screen width in which mobile menu activated', 'redchili' ),
            'subtitle' => esc_html__( 'Recommended value is: 992', 'redchili' ),
            'default'  => 992,
            'min'      => 0,
            'step'     => 1,
            'max'      => 2000,
        ),
        array(
            'id'       => 'resmenu_typo',
            'type'     => 'typography',
            'title'    => esc_html__( 'Mobile Menu Font', 'redchili' ),
            'google'   => true,
            'subsets'   => false,
            'text-align'   => false,
            'color'   => false,
            'default'     => array(
                'font-family' => 'Oswald',
                'google'      => true,
                'font-size'   => '14px',
                'font-weight' => '400',
                'line-height' => '21px',
            ),
        ),          
    )            
) 
);
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Banner', 'redchili' ),
    'id'               => 'banner_section',
    'heading'          => '',
    'icon'             => 'el el-flag',
    'fields' => array(
        array(
            'id'       => 'banner_heading_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Banner Heading Color', 'redchili' ),
            'default'  => '#ffffff',
        ), 
        array(
            'id'       => 'breadcrumb_link_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Breadcrumb Link Color', 'redchili' ),
            'default'  => '#8e9ba2',
        ),
        array(
            'id'       => 'breadcrumb_link_hover_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Breadcrumb Link Hover Color', 'redchili' ),
            'default'  => '#ffffff',
        ),
        array(
            'id'       => 'breadcrumb_active_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Active Breadcrumb Color', 'redchili' ),
            'default'  => '#e7272d',
        ),
        array(
            'id'       => 'breadcrumb_seperator_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Breadcrumb Seperator Color', 'redchili' ),
            'default'  => '#8e9ba2',
        ),
    )            
) 
);

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Footer', 'redchili' ),
    'id'               => 'footer_section',
    'heading'          => '',
    'icon'             => 'el el-caret-down',
    'fields' => array(
        array(
            'id'       => 'section-footer-area',
            'type'     => 'section',
            'title'    => esc_html__( 'Footer Area', 'redchili' ),
            'indent'   => true,
        ),
        array(
            'id'       => 'footer_area',
            'type'     => 'switch',
            'title'    => esc_html__( 'Display Footer Area', 'redchili' ),
            'on'       => esc_html__( 'Enabled', 'redchili' ),
            'off'      => esc_html__( 'Disabled', 'redchili' ),
            'default'  => true,
        ),
        array(
            'id'       => 'footer_column',
            'type'     => 'select',
            'title'    => esc_html__( 'Number of Columns', 'redchili' ),
            'options'  => array(
                '1' => '1 Column',
                '2' => '2 Columns',
                '3' => '3 Columns',
                '4' => '4 Columns',
            ),
            'default'  => '3',
            'required' => array( 'footer_area', 'equals', true )
        ),
        array(
            'id'       => 'footer_bgcolor',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Footer Background Color', 'redchili' ),
            'default'  => '#151515',
            'required' => array( 'footer_area', 'equals', true )
        ),
        array(
            'id'       => 'footer_title_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Footer Title Text Color', 'redchili' ),
            'default'  => '#ffffff',
            'required' => array( 'footer_area', 'equals', true )
        ), 
        array(
            'id'       => 'footer_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Footer Body Text Color', 'redchili' ),
            'default'  => '#d7d7d7',
            'required' => array( 'footer_area', 'equals', true )
        ), 
        array(
            'id'       => 'footer_link_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Footer Body Link Color', 'redchili' ),
            'default'  => '#e1e1e1',
            'required' => array( 'footer_area', 'equals', true )
        ), 
        array(
            'id'       => 'footer_link_hover_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Footer Body Link Hover Color', 'redchili' ),
            'default'  => '#e7272d',
            'required' => array( 'footer_area', 'equals', true )
        ), 
        array(
            'id'       => 'section-copyright-area',
            'type'     => 'section',
            'title'    => esc_html__( 'Copyright Area', 'redchili' ),
            'indent'   => true,
        ),
        array(
            'id'       => 'copyright_area',
            'type'     => 'switch',
            'title'    => esc_html__( 'Display Copyright Area', 'redchili' ),
            'on'       => esc_html__( 'Enabled', 'redchili' ),
            'off'      => esc_html__( 'Disabled', 'redchili' ),
            'default'  => true,
        ),
        array(
            'id'       => 'copyright_bgcolor',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Copyright Background Color', 'redchili' ),
            'default'  => '#e7272d',
            'required' => array( 'copyright_area', 'equals', true )
        ),
        array(
            'id'       => 'copyright_color',
            'type'     => 'color',
            'transparent' => false,
            'title'    => esc_html__( 'Copyright Text Color', 'redchili' ),
            'default'  => '#ffffff',
            'required' => array( 'copyright_area', 'equals', true )
        ),
        array(
            'id'       => 'copyright_text',
            'type'     => 'textarea',
            'title'    => esc_html__( 'Copyright Text', 'redchili' ),
            'default'  => '&copy; Copyright Red Chili 2017. All Right Reserved. Designed and Developed by <a target="_blank" href="' . RDTHEME_AUTHOR_URI . '"  style="color:#fff;">RadiusTheme</a>',
            'required' => array( 'copyright_area', 'equals', true )
        ),
    )            
) );

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Typography', 'redchili' ),
    'id'               => 'typo_section',
    'icon'             => 'el el-text-width',
    'fields' => array(
        array(
            'id'       => 'typo_body',
            'type'     => 'typography',
            'title'    => esc_html__( 'Body', 'redchili' ),
            'google'   => true,
            'subsets'   => false,
            'text-align'   => false,
            'font-weight'   => false,
            'color'   => false,
            'default'     => array(
                'font-family' => 'Roboto Slab',
                'google'      => true,
                'font-size'   => '14px',
                'font-weight' => '400',
                'line-height' => '24px',
            ),
        ),
        array(
            'id'       => 'typo_h1',
            'type'     => 'typography',
            'title'    => esc_html__( 'Header h1', 'redchili' ),
            'google'   => true,
            'subsets'   => false,
            'text-align'   => false,
            'font-weight'   => false,
            'color'   => false,
            'default'     => array(
                'font-family' => 'Oswald',
                'google'      => true,
                'font-size'   => '40px',
                'font-weight' => '500',
                'line-height'   => '44px',
            ),
        ),
        array(
            'id'       => 'typo_h2',
            'type'     => 'typography',
            'title'    => esc_html__( 'Header h2', 'redchili' ),
            'google'   => true,
            'subsets'   => false,
            'text-align'   => false,
            'font-weight'   => false,
            'color'   => false,
            'default'     => array(
                'font-family' => 'Oswald',
                'google'      => true,
                'font-size'   => '28px',
                'font-weight' => '500',
                'line-height' => '31px',
            ),
        ),
        array(
            'id'       => 'typo_h3',
            'type'     => 'typography',
            'title'    => esc_html__( 'Header h3', 'redchili' ),
            'google'   => true,
            'subsets'   => false,
            'text-align'   => false,
            'font-weight'   => false,
            'color'   => false,
            'default'     => array(
                'font-family' => 'Oswald',
                'google'      => true,
                'font-size'   => '20px',
                'font-weight' => '500',
                'line-height' => '26px',
            ),
        ),
        array(
            'id'       => 'typo_h4',
            'type'     => 'typography',
            'title'    => esc_html__( 'Header h4', 'redchili' ),
            'google'   => true,
            'subsets'   => false,
            'text-align'   => false,
            'font-weight'   => false,
            'color'   => false,
            'default'     => array(
                'font-family' => 'Oswald',
                'google'      => true,
                'font-size'   => '16px',
                'font-weight' => '500',
                'line-height' => '18px',
            ),
        ),
        array(
            'id'       => 'typo_h5',
            'type'     => 'typography',
            'title'    => esc_html__( 'Header h5', 'redchili' ),
            'google'   => true,
            'subsets'   => false,
            'text-align'   => false,
            'font-weight'   => false,
            'color'   => false,
            'default'     => array(
                'font-family' => 'Oswald',
                'google'      => true,
                'font-size'   => '14px',
                'font-weight' => '500',
                'line-height' => '16px',
            ),
        ),
        array(
            'id'       => 'typo_h6',
            'type'     => 'typography',
            'title'    => esc_html__( 'Header h6', 'redchili' ),
            'google'   => true,
            'subsets'   => false,
            'text-align'   => false,
            'font-weight'   => false,
            'color'   => false,
            'default'     => array(
                'font-family' => 'Oswald',
                'google'      => true,
                'font-size'   => '12px',
                'font-weight' => '500',
                'line-height' => '14px',
            ),
        ),
    )            
) );

// Generate Common post type fields
function rdtheme_redux_post_type_fields( $prefix ){
    return array(
        array(
            'id'       => $prefix. '_layout',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Layout', 'redchili' ),
            'options'  => array(
                'left-sidebar'  => esc_html__( 'Left Sidebar', 'redchili' ),
                'full-width'    => esc_html__( 'Full Width', 'redchili' ),
                'right-sidebar' => esc_html__( 'Right Sidebar', 'redchili' ),
            ),
            'default' => 'right-sidebar'
        ),
        array(
            'id'       => $prefix. '_sidebar',
            'type'     => 'select',
            'title'    => __( 'Custom Sidebar', 'redchili' ),
            'options'  => RDTheme_Helper::custom_sidebar_fields(),
            'default'  => 'sidebar',
            'required' => array( $prefix. '_layout', '!=', 'full-width' ),
        ),
        array(
            'id'       => $prefix. '_padding_top',
            'type'     => 'text',
            'title'    => esc_html__( 'Content Padding Top', 'redchili' ),
            'validate'  => 'numeric',
            'default' => '80',
        ),
        array(
            'id'       => $prefix. '_padding_bottom',
            'type'     => 'text',
            'title'    => esc_html__( 'Content Padding Bottom', 'redchili' ),
            'validate'  => 'numeric',
            'default' => '80'
        ),
        array(
            'id'       => $prefix. '_banner',
            'type'     => 'switch',
            'title'    => esc_html__( 'Banner', 'redchili' ),
            'on'       => esc_html__( 'Enabled', 'redchili' ),
            'off'      => esc_html__( 'Disabled', 'redchili' ),
            'default'  => true,
        ),
        array(
            'id'       => $prefix. '_breadcrumb',
            'type'     => 'switch',
            'title'    => esc_html__( 'Breadcrumb', 'redchili' ),
            'on'       => esc_html__( 'Enabled', 'redchili' ),
            'off'      => esc_html__( 'Disabled', 'redchili' ),
            'default'  => true,
            'required' => array( $prefix. '_banner', 'equals', true )
        ),
        array(
            'id'       => $prefix. '_bgtype',
            'type'     => 'button_set',
            'title'    => esc_html__( 'Banner Background Type', 'redchili' ),
            'options'  => array(
                'bgimg'    => esc_html__( 'Background Image', 'redchili' ),
                'bgcolor'  => esc_html__( 'Background Color', 'redchili' ),
            ),
            'default' => 'bgimg',
            'required' => array( $prefix. '_banner', 'equals', true )
        ),
        array(
            'id'       => $prefix. '_bgimg',
            'type'     => 'media',
            'title'    => esc_html__( 'Banner Background Image', 'redchili' ),
            'default'  => array(
                'url'=> RDTHEME_IMG_URL . 'banner.jpg'
            ),
            'required' => array( $prefix. '_bgtype', 'equals', 'bgimg' )
        ),		
        array(
            'id'       => $prefix. '_bgcolor',
            'type'     => 'color',
            'title'    => esc_html__('Banner Background Color', 'redchili'), 
            'validate' => 'color',
            'transparent' => false,
            'default' => '#606060',
            'required' => array( $prefix. '_bgtype', 'equals', 'bgcolor' )
        ),
    );
}

Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Layout Defaults', 'redchili' ),
    'id'               => 'layout_defaults',
    'icon'             => 'el el-th',
    ) );

// Page
$rdtheme_page_fields = rdtheme_redux_post_type_fields( 'page' );
$rdtheme_page_fields[0]['default'] = 'full-width';
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Page', 'redchili' ),
    'id'               => 'pages_section',
    'subsection' => true,
    'fields' => $rdtheme_page_fields     
    ) );

//Post Archive
$rdtheme_post_archive_fields = rdtheme_redux_post_type_fields( 'blog' );
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Blog / Archive', 'redchili' ),
    'id'         => 'blog_section',
    'subsection' => true,
    'fields'	 => $rdtheme_post_archive_fields
    ) );

// Single Post
$rdtheme_single_post_fields = rdtheme_redux_post_type_fields( 'single_post' );
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Post Single', 'redchili' ),
    'id'         => 'single_post_section',
    'subsection' => true,
    'fields' 	 => $rdtheme_single_post_fields           
    )
);

// Recipe Single
$recipe_fields2 = rdtheme_redux_post_type_fields( 'recipe' );
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Recipe Single', 'redchili' ),
    'id'               => 'recipe_section',
    'subsection' => true,
    'fields' => $recipe_fields2
    )
);

// Food Menu Single
$food_menu_fields = array(
    array(
        'id'       => 'related_food_menu',
        'type'     => 'switch',
        'title'    => esc_html__( 'Related Food Menu', 'redchili' ),
        'on'       => esc_html__( 'Show', 'redchili' ),
        'off'      => esc_html__( 'Hide', 'redchili' ),
        'default'  => true,
    ),	
    array(
        'id'       => 'stock_available_display',
        'type'     => 'switch',
        'title'    => esc_html__( 'Display Stock Available', 'redchili' ),
        'on'       => esc_html__( 'Show', 'redchili' ),
        'off'      => esc_html__( 'Hide', 'redchili' ),
        'default'  => true,
    ),
);
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Food Menu Single', 'redchili' ),
    'id'         => 'food_menu_section',
    'subsection' => true,
    'fields' 	 => $food_menu_fields
    )
);

// Chef Single
$chef_fields1 = array(
    array(
        'id'       => 'chef_section_back',
        'type'     => 'switch',
        'title'    => esc_html__( 'Chef Page Bottom Image', 'redchili' ),
        'on'       => esc_html__( 'Show', 'redchili' ),
        'off'      => esc_html__( 'Hide', 'redchili' ),
        'default'  => true,
    ),
);
$chef_fields2 = rdtheme_redux_post_type_fields( 'chef' );
unset($chef_fields2[0]);
$chef_fields = array_merge( $chef_fields1, $chef_fields2 );
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Chef Single', 'redchili' ),
    'id'         => 'chef_section',
    'subsection' => true,
    'fields' 	 => $chef_fields
    )
);

// Event Single
$event_fields2 = rdtheme_redux_post_type_fields( 'event' );
Redux::setSection( $opt_name, array(
    'title'      => esc_html__( 'Event Single', 'redchili' ),
    'id'         => 'event_section',
    'subsection' => true,
    'fields' 	 => $event_fields2
    )
);

// Search
$rdtheme_search_fields = rdtheme_redux_post_type_fields( 'search' );
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Search Layout', 'redchili' ),
    'id'               => 'search_section',
    'heading'          => '',
    'subsection' => true,
    'fields' => $rdtheme_search_fields            
) 
);

// Error 404 Layout
$rdtheme_search_fields = rdtheme_redux_post_type_fields( 'error' );
$rdtheme_search_fields[0]['default'] = 'full-width';
Redux::setSection( $opt_name, array(
    'title'   => esc_html__( 'Error 404 Layout', 'redchili' ),
    'id'      => 'error_section',
    'heading' => '',
    'subsection' => true,
    'fields'  => $rdtheme_search_fields           
	) 
);

if ( class_exists( 'WooCommerce' ) ) {
    // Woocommerce Shop Archive
    $rdtheme_shop_archive_fields = rdtheme_redux_post_type_fields( 'shop' );
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Shop Archive', 'redchili' ),
        'id'               => 'shop_section',
        'subsection' => true,
        'fields' => $rdtheme_shop_archive_fields
        ) );

    // Woocommerce Product
    $rdtheme_product_fields = rdtheme_redux_post_type_fields( 'product' );
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Product Single', 'redchili' ),
        'id'               => 'product_section',
        'subsection' => true,
        'fields' => $rdtheme_product_fields
        ) );
}

// Blog Settings
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Blog Settings', 'redchili' ),
    'id'               => 'blog_settings_section',
    'icon'             => 'el el-tags',
    'heading'          => '',
    'fields' => array(
        array(
            'id'       => 'blog_default_img',
            'type'     => 'media',
            'title'    => esc_html__( 'Default Featured Image', 'redchili' ),
            'subtitle' => esc_html__( 'This image will be used as preview image in Layout 2 if no featured image exists', 'redchili' ),
            'default'  => array(
                'url'=> RDTHEME_IMG_URL . 'blog-noimage.jpg'
            ),
            'required' => array( 'blog_style', 'equals', 'style2' )
        ), 
        array(
            'id'       => 'blog_date',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Date', 'redchili' ),
            'on'       => esc_html__( 'On', 'redchili' ),
            'off'      => esc_html__( 'Off', 'redchili' ),
            'default'  => true,
        ), 
        array(
            'id'       => 'blog_author_name',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Author Name', 'redchili' ),
            'on'       => esc_html__( 'On', 'redchili' ),
            'off'      => esc_html__( 'Off', 'redchili' ),
            'default'  => true,
        ),
        array(
            'id'       => 'blog_comment_num',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Comment Number', 'redchili' ),
            'on'       => esc_html__( 'On', 'redchili' ),
            'off'      => esc_html__( 'Off', 'redchili' ),
            'default'  => true,
        ), 
        array(
            'id'       => 'blog_cats',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Categories', 'redchili' ),
            'on'       => esc_html__( 'On', 'redchili' ),
            'off'      => esc_html__( 'Off', 'redchili' ),
            'default'  => true,
        ),
    )            
) 
);

// Post Settings
Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Post Settings', 'redchili' ),
    'id'               => 'post_settings_section',
    'icon'             => 'el el-file-edit',
    'heading'          => '',
    'fields' => array(
        array(
            'id'       => 'post_date',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Post Date', 'redchili' ),
            'on'       => esc_html__( 'On', 'redchili' ),
            'off'      => esc_html__( 'Off', 'redchili' ),
            'default'  => true,
        ), 
        array(
            'id'       => 'post_comment_num',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Comment Number', 'redchili' ),
            'on'       => esc_html__( 'On', 'redchili' ),
            'off'      => esc_html__( 'Off', 'redchili' ),
            'default'  => true,
        ), 
        array(
            'id'       => 'post_cats',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Categories', 'redchili' ),
            'on'       => esc_html__( 'On', 'redchili' ),
            'off'      => esc_html__( 'Off', 'redchili' ),
            'default'  => true,
        ),
        array(
            'id'       => 'post_tags',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Tags', 'redchili' ),
            'on'       => esc_html__( 'On', 'redchili' ),
            'off'      => esc_html__( 'Off', 'redchili' ),
            'default'  => true,
        ),
        array(
            'id'       => 'post_social',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Social Shares', 'redchili' ),
            'on'       => esc_html__( 'On', 'redchili' ),
            'off'      => esc_html__( 'Off', 'redchili' ),
            'default'  => true,
        ),
        array(
            'id'       => 'post_author_name',
            'type'     => 'switch',
            'title'    => esc_html__( 'Show Author Name', 'redchili' ),
            'on'       => esc_html__( 'On', 'redchili' ),
            'off'      => esc_html__( 'Off', 'redchili' ),
            'default'  => true,
        )
    )
) 
);

// Error
$rdtheme_fields2 = array( 
    array(
        'id'       => 'error_title',
        'type'     => 'text',
        'title'    => esc_html__( 'Page Title', 'redchili' ),
        'default'  => esc_html__( '404', 'redchili' ),
    ), 
    array(
        'id'       => 'error_text1',
        'type'     => 'text',
        'title'    => esc_html__( 'Body Text 1', 'redchili' ),
        'default'  => esc_html__( 'Page Was Not Found', 'redchili' ),
    ),
    array(
        'id'       => 'error_text2',
        'type'     => 'text',
        'title'    => esc_html__( 'Body Text 2', 'redchili' ),
        'default'  => esc_html__( 'The page you are looking is not available or has been removed. Try going to Home Page by using the button below.', 'redchili' ),
    ),    
    array(
        'id'       => 'error_buttontext',
        'type'     => 'text',
        'title'    => esc_html__( 'Button Text', 'redchili' ),
        'default'  => esc_html__( 'Go to Home Page', 'redchili' ),
    )
);
Redux::setSection( $opt_name, array(
    'title'   => esc_html__( 'Error Page Settings', 'redchili' ),
    'id'      => 'error_srttings_section',
    'heading' => '',
    'icon'    => 'el el-error-alt',
    'fields'  => $rdtheme_fields2           
) 
);

do_action('rt_after_redux_options_loaded','redchili'); 

if ( class_exists( 'WooCommerce' ) ) {
    // Woocommerce Settings
    Redux::setSection( $opt_name, array(
        'title'   => esc_html__( 'WooCommerce', 'redchili' ),
        'id'      => 'woo_Settings_section',
        'heading' => '',
        'icon'    => 'el el-shopping-cart',
        'fields'  => array(
            array(
                'id'       => 'wc_sec_general',
                'type'     => 'section',
                'title'    => esc_html__( 'General', 'redchili' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'wc_num_product',
                'type'     => 'text',
                'title'    => esc_html__( 'Number of Products Per Page', 'redchili' ),
                'default'  => '9',
            ),
            array(
                'id'       => 'wc_product_hover',
                'type'     => 'switch',
                'title'    => esc_html__( 'Product Hover Effect', 'redchili' ),
                'on'       => esc_html__( 'Enabled', 'redchili' ),
                'off'      => esc_html__( 'Disabled', 'redchili' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_wishlist_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Product Add to Wishlist Icon', 'redchili' ),
                'on'       => esc_html__( 'Enabled', 'redchili' ),
                'off'      => esc_html__( 'Disabled', 'redchili' ),
                'default'  => true,
                'required' => array( 'wc_product_hover', 'equals', true )
            ),
            array(
                'id'       => 'wc_quickview_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Product Quickview Icon', 'redchili' ),
                'on'       => esc_html__( 'Enabled', 'redchili' ),
                'off'      => esc_html__( 'Disabled', 'redchili' ),
                'default'  => true,
                'required' => array( 'wc_product_hover', 'equals', true )
            ),
            array(
                'id'       => 'wc_sec_product',
                'type'     => 'section',
                'title'    => esc_html__( 'Product Single Page', 'redchili' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'wc_show_excerpt',
                'type'     => 'switch',
                'title'    => esc_html__( "Show excerpt when short description doesn't exist", 'redchili' ),
                'on'       => esc_html__( 'Enabled', 'redchili' ),
                'off'      => esc_html__( 'Disabled', 'redchili' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_cats',
                'type'     => 'switch',
                'title'    => esc_html__( 'Categories', 'redchili' ),
                'on'       => esc_html__( 'Show', 'redchili' ),
                'off'      => esc_html__( 'Hide', 'redchili' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_tags',
                'type'     => 'switch',
                'title'    => esc_html__( 'Tags', 'redchili' ),
                'on'       => esc_html__( 'Show', 'redchili' ),
                'off'      => esc_html__( 'Hide', 'redchili' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_related',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Products', 'redchili' ),
                'on'       => esc_html__( 'Show', 'redchili' ),
                'off'      => esc_html__( 'Hide', 'redchili' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_description',
                'type'     => 'switch',
                'title'    => esc_html__( 'Description Tab', 'redchili' ),
                'on'       => esc_html__( 'Show', 'redchili' ),
                'off'      => esc_html__( 'Hide', 'redchili' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_reviews',
                'type'     => 'switch',
                'title'    => esc_html__( 'Reviews Tab', 'redchili' ),
                'on'       => esc_html__( 'Show', 'redchili' ),
                'off'      => esc_html__( 'Hide', 'redchili' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_additional_info',
                'type'     => 'switch',
                'title'    => esc_html__( 'Additional Information Tab', 'redchili' ),
                'on'       => esc_html__( 'Show', 'redchili' ),
                'off'      => esc_html__( 'Hide', 'redchili' ),
                'default'  => true,
            ),
            array(
                'id'       => 'wc_sec_cart',
                'type'     => 'section',
                'title'    => esc_html__( 'Cart Page', 'redchili' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'wc_cross_sell',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cross Sell Products', 'redchili' ),
                'on'       => esc_html__( 'Show', 'redchili' ),
                'off'      => esc_html__( 'Hide', 'redchili' ),
                'default'  => true,
            ),
        )
) 
);
}

Redux::setSection( $opt_name, array(
    'title'   => __( 'Advanced', 'redchili' ),
    'id'      => 'advanced_section',
    'heading' => '',
    'icon'    => 'el el-css',
    'fields'  => array(
        array(
            'id'       => 'custom_css',
            'type'     => 'ace_editor',
            'title'    => __( 'Custom CSS', 'redchili' ),
            'subtitle' => __( 'Paste your CSS code here.', 'redchili' ),
            'mode'     => 'css',
            'theme'    => 'chrome',
            'default'  => "body{\n   margin: 0 auto;\n}",
            'options'    => array('minLines' => 30)
        ),
    )
) 
);
// -> END Fields