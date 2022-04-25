<?php
if (!isset($content_width)) {
	$content_width = 1200;
}

add_action('after_setup_theme', 'rdtheme_setup');
function rdtheme_setup() {
	// Language
	load_theme_textdomain('redchili', RDTHEME_BASE_DIR . 'languages');

	// Theme support
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');
	add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
	add_theme_support('woocommerce');
				
	// for gutenberg support
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-color-palette', array(
		array(
			'name' => __( 'strong magenta', 'redchili' ),
			'slug' => 'strong-magenta',
			'color' => '#a156b4',
		),
		array(
			'name' => __( 'light grayish magenta', 'redchili' ),
			'slug' => 'light-grayish-magenta',
			'color' => '#d0a5db',
		),
		array(
			'name' => __( 'very light gray', 'redchili' ),
			'slug' => 'very-light-gray',
			'color' => '#eee',
		),
		array(
			'name' => __( 'very dark gray', 'redchili' ),
			'slug' => 'very-dark-gray',
			'color' => '#444',
		),
	) );
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => __( 'Small', 'redchili' ),
			'size' => 12,
			'slug' => 'small'
		),
		array(
			'name' => __( 'Normal', 'redchili' ),
			'size' => 16,
			'slug' => 'normal'
		),
		array(
			'name' => __( 'Large', 'redchili' ),
			'size' => 28,
			'slug' => 'large'
		),
		array(
			'name' => __( 'Huge', 'redchili' ),
			'size' => 50,
			'slug' => 'huge'
		)
	) );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support('editor-styles');	

	// Image sizes
	add_image_size( 'rdtheme-size1', 1200, 600, true ); // single blog full
	add_image_size( 'rdtheme-size2', 94, 84, true ); // recent recipe sidebar widget-3
	add_image_size( 'rdtheme-size3', 71, 69, true ); // footer blog thumbanail -1
	add_image_size( 'rdtheme-size4', 500, 635, true ); // Single Chef-2
	add_image_size( 'rdtheme-size5', 370, 522, true ); // other Chef -5
	add_image_size( 'rdtheme-size6', 400, 400, true ); // All square
	add_image_size( 'rdtheme-size7', 377, 251, true ); // Recipe Box Slider
	add_image_size( 'rdtheme-size8', 510, 539, true ); // Recipe Box Slider -2
	add_image_size( 'rdtheme-size9', 272, 342, true ); // Recipe Box Slider -1

	// Register menus
	register_nav_menus(array(
		'primary' => esc_html__('Primary', 'redchili'),
		'topright' => esc_html__('Header Right', 'redchili'),
	));
}

function redchili_theme_add_editor_styles() {
	add_editor_style( get_stylesheet_uri() );
}
add_action( 'admin_init', 'redchili_theme_add_editor_styles' );

function redchili_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'redchili_pingback_header' );

// Initialize Widgets
add_action( 'widgets_init', 'rdtheme_sidebar_init' );
function rdtheme_sidebar_init() {

	$footer_column = RDTheme::$options['footer_column'];
	switch ( $footer_column ) {
		case '1':
		$footer_class = 'col-sm-12 col-xs-12';
		break;
		case '2':
		$footer_class = 'col-sm-6 col-xs-12';
		break;
		case '3':
		$footer_class = 'col-sm-4 col-xs-12';
		break;		
		default:
		$footer_class = 'col-sm-3 col-xs-12';
		break;
	}

	$footer_widget_titles = array(
		'1' => esc_html__( 'Footer 1', 'redchili' ),
		'2' => esc_html__( 'Footer 2', 'redchili' ),
		'3' => esc_html__( 'Footer 3', 'redchili' ),
		'4' => esc_html__( 'Footer 4', 'redchili' ),
	);

	// Register Widget Areas
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'redchili' ),
		'id'            => 'sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s single-sidebar margin-bottom-sidebar">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle widget-title-bar title-sidebar title-bar">',
		'after_title'   => '</h2>',
		) );

	for ( $i = 1; $i <= $footer_column; $i++ ) {
		register_sidebar( array(
			'name'          => $footer_widget_titles[$i],
			'id'            => 'footer-'. $i,
			'before_widget' => '<div class="single-widget"><div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h3 class="widgettitle widget-title-bar">',
			'after_title'   => '</h3>',
			) );		
	}
}

add_action( 'wp_ajax_fmp_ajax', array('RDTheme_Helper','rtoverride' ), 0);
add_action( 'wp_ajax_nopriv_fmp_ajax', array('RDTheme_Helper','rtoverride' ), 0);

// Head Script
add_action( 'wp_head', 'rdtheme_head', 1 );
if( !function_exists( 'rdtheme_head' ) ) {
	function rdtheme_head(){
		// Hide preloader if js is disabled
		echo '<noscript><style>#preloader{display:none;}</style></noscript>';
	}	
}

// Footer Html
add_action( 'wp_footer', 'rdtheme_footer_html', 1 );
if( !function_exists( 'rdtheme_footer_html' ) ) {
	function rdtheme_footer_html(){
		// Back-to-top link
		if ( RDTheme::$options['back_to_top'] ){
			echo '<a href="#" class="scrollToTop"><i class="fa fa-arrow-up"></i></a>';
		}
		// Preloader
		if ( RDTheme::$options['preloader'] ){
			if ( !empty( RDTheme::$options['preloader_image']['url'] ) ) {
				$preloader_img = RDTheme::$options['preloader_image']['url'];
			}
			else {
				$preloader_img = RDTHEME_IMG_URL . 'preloder.gif';
			}
			echo '<div id="preloader" style="background-image:url(' . esc_url( $preloader_img ) . ');"></div>';
		}
	}
}

/*show variable product price in custom loop*/
function show_variable_price( $product_id ) {
    $wc_product_variable  =  new WC_Product_Variable( $product_id );
    $variation_price_html  =  $wc_product_variable->get_price_html( );
    return $variation_price_html;
}

/*variable product cart ajax*/
add_action( 'wp_ajax_woocommerce_add_variation_to_cart', 'so_add_variation_to_cart' );
add_action( 'wp_ajax_nopriv_woocommerce_add_variation_to_cart', 'so_add_variation_to_cart' );

function so_add_variation_to_cart() {	

    $product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
    $quantity          = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( $_POST['quantity'] );

    $variation_id      = isset( $_POST['variation_id'] ) ? absint( $_POST['variation_id'] ) : '';
    $variations         = ! empty( $_POST['variation'] ) ? (array) $_POST['variation'] : array();

    $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity, $variation_id, $variations, $cart_item_data );

    if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variations ) ) {
        do_action( 'woocommerce_ajax_added_to_cart', $product_id );
        if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
            wc_add_to_cart_message( $product_id );
        }
        // Return fragments
        WC_AJAX::get_refreshed_fragments();
    } else {
        // If there was an error adding to the cart, redirect to the product page to show any errors
        $data = array(
            'error' => true,
            'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
        );
        wp_send_json( $data );
    }
    die();
}

add_action( 'wp_ajax_rt_add_to_cart_variable_rc', 'rt_add_variation_to_cart' );
add_action( 'wp_ajax_nopriv_rt_add_to_cart_variable_rc', 'rt_add_variation_to_cart' );

function rt_add_variation_to_cart(){
	$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
	$quantity = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
	$variation_id = absint($_POST['variation_id']);
	$variation  = $_POST['variation'];
	$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

	if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation  ) ) {
		do_action( 'woocommerce_ajax_added_to_cart', $product_id );
		WC_AJAX::get_refreshed_fragments();
	} else {
		$data = array(
            'error' => true,
            'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
        );
        wp_send_json( $data );
	}
	die();
}

add_action( 'wp_ajax_rt_get_woo_single_data', 'rt_get_woo_single_data' );
add_action( 'wp_ajax_nopriv_rt_get_woo_single_data', 'rt_get_woo_single_data' );

function rt_get_woo_single_data(){
	
	$rt_product_id = $_POST['product_id'];
	$showcart = $_POST['showcart'];
	
	$product = get_post($rt_product_id);	

	ob_start();
	
	include( 'query/product-details.php' );
		
	$content = ob_get_clean();
   
	wp_send_json(array('title'=> $product->post_title, 'success' => true, 'content' => $content));
}

?>