<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<?php
$redchili_pagemenu = false;
if ( ( is_single() || is_page() ) ) {
	$redchili_menuid = get_post_meta( get_the_id(), 'redchili_page_menu', true );
	if ( !empty( $redchili_menuid ) && $redchili_menuid != 'default' ) {
		$redchili_pagemenu = $redchili_menuid;
	}
}
?>
<body <?php body_class(); ?>>
	<?php do_action( 'wp_body_open' ); ?>
    <div class="wrapper">
        <header id="masthead" class="site-header">
			<div id="header-<?php echo esc_attr( RDTheme::$header_style ); ?>" class="header-area header-fixed " style="top: 0px;">
				<?php
				if ( RDTheme::$top_bar == 1 || RDTheme::$top_bar == 'on' ){
					get_template_part( 'template-parts/header/header-top', RDTheme::$top_bar_style );
				}
				get_template_part( 'template-parts/header/header', RDTheme::$header_style );
				?>
			</div>
        </header>
        <?php get_template_part('template-parts/header/header', 'offscreen'); ?>
		<div id="header-area-space"></div>
        <?php get_template_part('template-parts/content', 'banner'); ?>