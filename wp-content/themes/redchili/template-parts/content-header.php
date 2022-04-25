<?php
// Logo
$rdtheme_dark_logo = empty( RDTheme::$options['logo']['url'] ) ? RDTHEME_IMG_URL . 'logo-dark.png' : RDTheme::$options['logo']['url'];
$rdtheme_light_logo = empty( RDTheme::$options['logo_light']['url'] ) ? RDTHEME_IMG_URL . 'logo-light.png' : RDTheme::$options['logo_light']['url'];

// Navigation menu condition
$rdtheme_pagemenu = false;
if ( ( is_single() || is_page() ) ) {
	$rdtheme_menuid = get_post_meta( get_the_id(), 'rdtheme_page_menu', true );
	if ( !empty( $rdtheme_menuid ) && $rdtheme_menuid != 'default' ) {
		$rdtheme_pagemenu = $rdtheme_menuid;
	}
}

// Menu and Icon wrapper classes
$rdtheme_icon_count = 0;
if ( RDTheme::$options['search_icon'] ) {
	$rdtheme_icon_count++;
}
if ( RDTheme::$options['cart_icon'] && class_exists( 'WC_Widget_Cart' ) ) {
	$rdtheme_icon_count++;
}
if ( RDTheme::$options['vertical_menu_icon'] ) {
	$rdtheme_icon_count++;
}

switch ( $rdtheme_icon_count ) {
	case 1:
	case 2:
	$rdtheme_menu_class = 'col-sm-9 col-xs-12';
	$rdtheme_icon_class = 'col-sm-1 col-xs-12';
	break;
	case 3:
	$rdtheme_menu_class = 'col-sm-8 col-xs-12';
	$rdtheme_icon_class = 'col-sm-2 col-xs-12';
	break;	
	default:
	$rdtheme_menu_class = 'col-sm-10 col-xs-12';
	break;
}
?>
<div class="header2-area">
	<?php 
	if ( RDTheme::$options['top_bar'] == 1  ){
		get_template_part( 'template-parts/content', 'header-top' );
	}
	?>
    <div class="header-bottom-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="logo-area">
						<a class="dark-logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( $rdtheme_dark_logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="main-menu-area main-navigation" id="site-navigation">
						<?php
						if ( $rdtheme_pagemenu ) {
							wp_nav_menu( array( 'menu' => $rdtheme_pagemenu,'container' => 'nav' ) );
						}
						else{
							wp_nav_menu( array( 'theme_location' => 'primary','container' => 'nav' ) );
						}
						?>                    
                    </div>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <ul class="header-cart-area">
                    	<?php if ( RDTheme::$options['search_icon'] == 1 ){ ?>
                        <li class="header-search">
                           <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) );?>">
                                <input type="text" name="s" class="search-form" placeholder="<?php esc_attr_e( 'Search Here......', 'redchili' );?>" required="">                                    
                                <a href="#" class="search-button" id="search-button"><i class="fa fa-search" aria-hidden="true"></i></a>
                            </form> 
                        </li>
                        <?php } ?>
						<?php if ( RDTheme::$options['cart_icon'] == 1 && class_exists( 'WC_Widget_Cart' ) ){ ?>
                        <li>
                            <div class="cart-area">
                                <a href="<?php echo esc_url( WC()->cart->get_cart_url() );?>"><i aria-hidden="true" class="fa fa-shopping-cart"></i><span class="cart-icon-num"><?php echo WC()->cart->get_cart_contents_count();?></span></a>
                                <ul>
                                	<?php the_widget( 'WC_Widget_Cart' ); ?>
                                </ul>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>                          
        </div> 
    </div>
</div>