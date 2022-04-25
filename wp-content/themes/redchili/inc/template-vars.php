<?php
add_action( 'template_redirect', 'redchili_template_vars' );
function redchili_template_vars() {
	// Single Pages
	if ( is_single() || is_page() ) {
		$post_type = get_post_type();
		$post_id = get_the_id();
		switch ( $post_type ) {
			case 'page':
			$prefix = 'page';
			break;
			case 'post':
			$prefix = 'single_post';
			break;
			case 'rc_chef':
			$prefix = 'chef';
			RDTheme::$options[$prefix. '_layout'] = 'full-width';
			break;
			case 'rc_recipe':
			$prefix = 'recipe';
			break;
			case 'product':
			$prefix = 'product';
			break;
			default:
			$prefix = 'single_post';
			break;
		}
		
		$layout          = get_post_meta( $post_id, 'redchili_layout', true );
		$sidebar         = get_post_meta( $post_id, 'redchili_sidebar', true );
        $tr_header       = get_post_meta( $post_id, 'redchili_tr_header', true );
        $top_bar         = get_post_meta( $post_id, 'redchili_top_bar', true );
        $top_bar_style   = get_post_meta( $post_id, 'redchili_top_bar_style', true );
        $header_style    = get_post_meta( $post_id, 'redchili_header', true );
		$padding_top     = get_post_meta( $post_id, 'redchili_top_padding', true );
		$padding_bottom  = get_post_meta( $post_id, 'redchili_bottom_padding', true );
		$has_banner      = get_post_meta( $post_id, 'redchili_banner', true );
		$has_breadcrumb  = get_post_meta( $post_id, 'redchili_breadcrumb', true );
		$bgtype          = get_post_meta( $post_id, 'redchili_banner_type', true );
		$bgcolor         = get_post_meta( $post_id, 'redchili_banner_bgcolor', true );
		$bgimg           = get_post_meta( $post_id, 'redchili_banner_bgimg', true );

		RDTheme::$layout    = ( empty( $layout ) || $layout == 'default' ) ? RDTheme::$options[$prefix. '_layout']: $layout;
		
		RDTheme::$sidebar = ( empty( $sidebar ) || $sidebar == 'default' ) ? RDTheme::$options[$prefix . '_sidebar'] : $sidebar;

        RDTheme::$tr_header = ( empty( $tr_header ) || $tr_header == 'default' ) ? RDTheme::$options['tr_header'] : $tr_header;
        
        RDTheme::$top_bar 	= ( empty( $top_bar ) || $top_bar == 'default' ) ? RDTheme::$options['top_bar'] : $top_bar;
        
        RDTheme::$top_bar_style = ( empty( $top_bar_style ) || $top_bar_style == 'default' ) ? RDTheme::$options['top_bar_style'] : $top_bar_style;
        
        RDTheme::$header_style  = ( empty( $header_style ) || $header_style == 'default' ) ? RDTheme::$options['header_style'] : $header_style;

		$padding_top = ( empty( $padding_top ) || $padding_top == 'default' ) ? RDTheme::$options[$prefix. '_padding_top']: $padding_top;
		RDTheme::$padding_top   = (int) $padding_top;      

		$padding_bottom       = ( empty( $padding_bottom ) || $padding_bottom == 'default' ) ? RDTheme::$options[$prefix. '_padding_bottom']: $padding_bottom;
		RDTheme::$padding_bottom = (int) $padding_bottom;  

		RDTheme::$has_banner     = ( empty( $has_banner ) || $has_banner == 'default' ) ? RDTheme::$options[$prefix. '_banner']: $has_banner;

		RDTheme::$has_breadcrumb = ( empty( $has_breadcrumb ) || $has_breadcrumb == 'default' ) ? RDTheme::$options[$prefix. '_breadcrumb']: $has_breadcrumb;

		RDTheme::$bgtype         = ( empty( $bgtype ) || $bgtype == 'default' ) ? RDTheme::$options[$prefix. '_bgtype']: $bgtype;

		RDTheme::$bgcolor        = empty( $bgcolor ) ? RDTheme::$options[$prefix. '_bgcolor']: $bgcolor;

		if ( !empty( $bgimg ) ) {
			$attch_url = wp_get_attachment_image_src( $bgimg, 'full', true );
			RDTheme::$bgimg =  $attch_url[0];
		}
	elseif ( !empty( RDTheme::$options[$prefix. '_bgimg']['id'] ) ) {
		$attch_url = wp_get_attachment_image_src( RDTheme::$options[$prefix. '_bgimg']['id'], 'full', true );
		RDTheme::$bgimg =  $attch_url[0];
	}
	else{
		RDTheme::$bgimg = RDTHEME_IMG_URL . 'banner.jpg';
	}
}

// Blog and Archive
elseif ( is_home() || is_archive() || is_search() || is_404() ) {
		if ( is_search() ) {
			$prefix = 'search';
		}
		elseif( is_404() ){
			$prefix = 'error';
		}
		elseif( function_exists( 'is_woocommerce' ) && is_woocommerce() ){
			$prefix = 'shop';
		}
		else{
			$prefix = 'blog';
		}

		RDTheme::$layout         = RDTheme::$options[$prefix. '_layout'];
		RDTheme::$tr_header      = RDTheme::$options['tr_header'];
		RDTheme::$top_bar        = RDTheme::$options['top_bar'];
		RDTheme::$top_bar_style  = RDTheme::$options['top_bar_style'];
		RDTheme::$header_style   = RDTheme::$options['header_style'];
		RDTheme::$padding_top    = RDTheme::$options[$prefix. '_padding_top'];
		RDTheme::$padding_bottom = RDTheme::$options[$prefix. '_padding_bottom'];
		RDTheme::$has_banner     = RDTheme::$options[$prefix. '_banner'];
		RDTheme::$has_breadcrumb = RDTheme::$options[$prefix. '_breadcrumb'];
		RDTheme::$bgtype         = RDTheme::$options[$prefix. '_bgtype'];
		RDTheme::$bgcolor        = RDTheme::$options[$prefix. '_bgcolor'];

		if ( !empty( RDTheme::$options[$prefix. '_bgimg']['id'] ) ) {
			$attch_url 			 = wp_get_attachment_image_src( RDTheme::$options[$prefix. '_bgimg']['id'], 'full', true );
			RDTheme::$bgimg 	 =  $attch_url[0];
		}
		else{
			RDTheme::$bgimg 	 = RDTHEME_IMG_URL . 'banner.jpg';
		}		
	}
}

// Add body class
add_filter( 'body_class' , 'redchili_body_classes' );
function redchili_body_classes( $classes ) {
        
        $classes[] = 'header-style-'. RDTheme::$header_style;

        if ( RDTheme::$top_bar == 1 || RDTheme::$top_bar == 'on' ){
            $classes[] = 'has-topbar topbar-style-'. RDTheme::$top_bar_style;
        }        

        if ( RDTheme::$tr_header == 1 || RDTheme::$tr_header == 'on' ){
           $classes[] = 'trheader';
        }
        
        $classes[] = ( RDTheme::$layout == 'full-width' ) ? 'no-sidebar' : 'has-sidebar';
        
        if( isset( $_COOKIE["shopview"] ) && $_COOKIE["shopview"] == 'list' ) {
            $classes[] = 'product-list-view';
        } else {
            $classes[] = 'product-grid-view';
        }
		
		if( is_singular('food-menu')){
			$classes[] = 'fmp';
		}
        
        return $classes;
    }