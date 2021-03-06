<?php
$nav_menu_args = RDTheme_Helper::nav_menu_args();

// Logo
$rdtheme_dark_logo = empty( RDTheme::$options['logo']['url'] ) ? RDTHEME_IMG_URL . 'logo-dark.png' : RDTheme::$options['logo']['url'];
$rdtheme_light_logo = empty( RDTheme::$options['logo_light']['url'] ) ? RDTHEME_IMG_URL . 'logo-light.png' : RDTheme::$options['logo_light']['url'];

// Menu and Icon wrapper classes
$rdtheme_icon_count = 0;
if ( RDTheme::$options['search_icon'] ) {
	$rdtheme_icon_count++;
}
if ( RDTheme::$options['cart_icon'] && class_exists( 'WC_Widget_Cart' ) ) {
	$rdtheme_icon_count++;
}
if ( RDTheme::$options['vertical_menu_icon'] && has_nav_menu( 'topright' ) ) {
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
<div class="container masthead-container" id="sticker">
	<div class="row">
		<div class="col-sm-2 col-xs-12">
			<div class="site-branding">
				<?php if ( RDTheme::$options['logo_type'] == 'image_type' ) { ?>
					<a class="dark-logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( $rdtheme_dark_logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
					<a class="light-logo" href="<?php echo esc_url( home_url( '/' ) );?>"><img src="<?php echo esc_url( $rdtheme_light_logo );?>" alt="<?php esc_attr( bloginfo( 'name' ) ) ;?>"></a>
				<?php } else { ?>
					<a class="rt-text-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo RDTheme::$options['logo_text'];  ?></a>
				<?php } ?>
			</div>
		</div>
		<div class="<?php echo esc_attr( $rdtheme_menu_class );?>">
			<div id="site-navigation" class="main-navigation">
				<?php wp_nav_menu( $nav_menu_args ); ?>				
			</div>
		</div>
		<?php if ( $rdtheme_icon_count ): ?>
			<div class="<?php echo esc_attr( $rdtheme_icon_class );?>">
				<?php get_template_part( 'template-parts/header/icon', 'area' );?>
			</div>
		<?php endif; ?>
	</div>
</div>