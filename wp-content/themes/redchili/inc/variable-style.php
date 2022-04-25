<?php
/*-------------------------------------
INDEX
=======================================
#. Common css/ default css
#. Top Bar
#. Header
#. Banner
#. Footer
#. Widget
#. Typography
#. Page Settings
#. Plugin: Layer Slider
#. Plugin: Logo Showcase
#. WooCommerce
#. Food menu color
#. Single recipe
#. carousel
#. Ghost-btn
#. Title part
#. Reservation
#. Scroll up
#. Site header
#. About section
#. Blog
#. 404 page
#. contact page
#. WooCommerce
-------------------------------------*/
$primary_color         = RDTheme::$options['primary_color']; // #e7272d
$secondary_color       = RDTheme::$options['secondery_color']; // #d32f2f
$primary_rgb           = RDTheme_Helper::hex2rgb( $primary_color ); // 231, 39, 45

$menu_typo             = RDTheme::$options['menu_typo'];
$menu_color            = RDTheme::$options['menu_color'];
$menu_color_tr         = RDTheme::$options['menu_color_tr'];
$menu_hover_color      = RDTheme::$options['menu_hover_color'];
$submenu_typo          = RDTheme::$options['submenu_typo'];
$submenu_color         = RDTheme::$options['submenu_color'];
$submenu_bgcolor       = RDTheme::$options['submenu_bgcolor'];
$submenu_hover_color   = RDTheme::$options['submenu_hover_color'];
$submenu_hover_bgcolor = RDTheme::$options['submenu_hover_bgcolor'];
$resmenu_typo          = RDTheme::$options['resmenu_typo'];
	 
$rdtheme_typo_body     = RDTheme::$options['typo_body'];
$rdtheme_typo_h1       = RDTheme::$options['typo_h1'];
$rdtheme_typo_h2       = RDTheme::$options['typo_h2'];
$rdtheme_typo_h3       = RDTheme::$options['typo_h3'];
$rdtheme_typo_h4       = RDTheme::$options['typo_h4'];
$rdtheme_typo_h5       = RDTheme::$options['typo_h5'];
$rdtheme_typo_h6       = RDTheme::$options['typo_h6'];

$logo_text_typo        = RDTheme::$options['logo_text_typo'];
?>
<?php
/*-------------------------------------
#. Common css/ default css
---------------------------------------*/
?>
blockquote {
	border-color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*-------------------------------------
#. Top Bar
---------------------------------------*/
?>
#tophead .tophead-contact .fa,
#tophead .tophead-address .fa,
#tophead .tophead-social li a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
#tophead {
    background-color: <?php echo esc_html( RDTheme::$options['top_bar_bgcolor'] ); ?>;
}
#tophead,
#tophead a,
#tophead .tophead-social li a {
    color: <?php echo esc_html( RDTheme::$options['top_bar_color'] ); ?>;
}
.trheader #tophead,
.trheader #tophead a,
.trheader #tophead .tophead-social li a {
	color: <?php echo esc_html( RDTheme::$options['top_bar_color_tr'] ); ?>;
}

<?php
/*-------------------------------------
#. Header
---------------------------------------*/
?>
<?php // Text Logo Typo  ?>
.site-branding .rt-text-logo {
	font-family: <?php echo esc_html( $logo_text_typo['font-family'] ); ?>, sans-serif;
	font-size : <?php echo esc_html( $logo_text_typo['font-size'] ); ?>;
	font-weight : <?php echo esc_html( $logo_text_typo['font-weight'] ); ?>;
	line-height : <?php echo esc_html( $logo_text_typo['line-height'] ); ?>;
	color: <?php echo esc_html( $logo_text_typo['color'] ); ?>;
	font-style: <?php echo empty( $logo_text_typo['font-style'] ) ? 'normal' : $logo_text_typo['font-style']; ?>;
	letter-spacing : <?php echo esc_html( $logo_text_typo['letter-spacing'] ); ?>;
	text-transform : <?php echo esc_html( $logo_text_typo['text-transform'] ); ?>;
}
<?php // Main Menu ?>
.site-header .main-navigation ul li a {
	font-family: <?php echo esc_html( $menu_typo['font-family'] ); ?>, sans-serif;
	font-size : <?php echo esc_html( $menu_typo['font-size'] ); ?>;
	font-weight : <?php echo esc_html( $menu_typo['font-weight'] ); ?>;
	line-height : <?php echo esc_html( $menu_typo['line-height'] ); ?>;
	color: <?php echo esc_html( $menu_color ); ?>;
	font-style: <?php echo empty( $menu_typo['font-style'] ) ? 'normal' : $menu_typo['font-style']; ?>;
	letter-spacing : <?php echo esc_html( $menu_typo['letter-spacing'] ); ?>;
	text-transform : <?php echo esc_html( $menu_typo['text-transform'] ); ?>;
}
.site-header .main-navigation ul.menu > li > a:hover,
.site-header .main-navigation ul.menu > li.current-menu-item > a,
.site-header .main-navigation ul.menu > li.current > a,
.trheader.non-stick .site-header .main-navigation ul.menu > li > a:hover,
.trheader.non-stick .site-header .main-navigation ul.menu > li.current-menu-item > a,
.trheader.non-stick .site-header .main-navigation ul.menu > li.current > a {
	color: <?php echo esc_html( $menu_hover_color ); ?>;
}
.site-header .main-navigation ul li a.active {
	color: <?php echo esc_html( $menu_hover_color );?> !important;
}
.trheader.non-stick .site-header .main-navigation ul.menu > li > a,
.trheader.non-stick .site-header .search-box .search-button i,
.trheader.non-stick .header-icon-seperator,
.trheader.non-stick .header-icon-area .cart-icon-area > a, 
.trheader.non-stick .additional-menu-area a.side-menu-trigger {
	color: <?php echo esc_html( $menu_color_tr ); ?>;
}
.bottomBorder {
  border-bottom: 2px solid <?php echo esc_html( $primary_color ); ?>;
}
<?php // Submenu ?>
.site-header .main-navigation ul li ul li {
	background-color: <?php echo esc_html( $submenu_bgcolor ); ?>;
}
.site-header .main-navigation ul li ul li:hover {
	background-color: <?php echo esc_html( $submenu_hover_bgcolor ); ?>;
}
.site-header .main-navigation ul li ul li a {
	font-family: <?php echo esc_html( $submenu_typo['font-family'] ); ?>, sans-serif;
	font-size : <?php echo esc_html( $submenu_typo['font-size'] ); ?>;
	font-weight : <?php echo esc_html( $submenu_typo['font-weight'] ); ?>;
	line-height : <?php echo esc_html( $submenu_typo['line-height'] ); ?>;
	color: <?php echo esc_html( $submenu_color ); ?>;
	font-style: <?php echo empty( $submenu_typo['font-style'] ) ? 'normal' : $submenu_typo['font-style']; ?>;
	letter-spacing : <?php echo esc_html( $submenu_typo['letter-spacing'] ); ?>;
	text-transform : <?php echo esc_html( $submenu_typo['text-transform'] ); ?>;
}
.site-header .main-navigation ul li ul li:hover > a {
	color: <?php echo esc_html( $submenu_hover_color ); ?>;
}
<?php // Sticky Menu ?>
.stick .site-header {
	border-color: <?php echo esc_html( $primary_color ); ?>
}
<?php // Multi Column Menu ?>
.site-header .main-navigation ul li.mega-menu > ul.sub-menu {
	background-color: <?php echo esc_html( $submenu_bgcolor ); ?>
}
.site-header .main-navigation ul li.mega-menu ul.sub-menu li a {
	color: <?php echo esc_html( $submenu_color ); ?>
}
.site-header .main-navigation ul li.mega-menu ul.sub-menu li a:hover {
	background-color: <?php echo esc_html( $submenu_hover_bgcolor ); ?>;
	color: <?php echo esc_html( $submenu_hover_color ); ?>;
}
<?php // Mean Menu ?>
.mean-container a.meanmenu-reveal,
.mean-container .mean-nav ul li a.mean-expand {
	color: <?php echo esc_html( $menu_hover_color ); ?>;
}
.mean-container a.meanmenu-reveal span {
	background-color: <?php echo esc_html( $menu_hover_color ); ?>;
}
.mean-container .mean-bar {
	border-color: <?php echo esc_html( $menu_hover_color ); ?>;
}
.mean-container .mean-nav ul li a {
	font-family: <?php echo esc_html( $resmenu_typo['font-family'] ); ?>, sans-serif;
	font-size : <?php echo esc_html( $resmenu_typo['font-size'] ); ?>;
	font-weight : <?php echo esc_html( $resmenu_typo['font-weight'] ); ?>;
	line-height : <?php echo esc_html( $resmenu_typo['line-height'] ); ?>;
	color: <?php echo esc_html( $menu_color ); ?>;
	font-style: <?php echo empty( $resmenu_typo['font-style'] ) ? 'normal' : $resmenu_typo['font-style']; ?>;
}
.mean-container .mean-nav ul li a:hover,
.mean-container .mean-nav > ul > li.current-menu-item > a {
	color: <?php echo esc_html( $menu_hover_color ); ?>;
}

<!-- <?php // Header icons ?>
.header-icon-area .cart-icon-area .cart-icon-num {
	background-color: <?php echo esc_html( $menu_hover_color );?>;
}
.additional-menu-area a.side-menu-trigger:hover,
.trheader.non-stick .additional-menu-area a.side-menu-trigger:hover {
	color: <?php echo esc_html( $menu_hover_color );?>;
}
.site-header .search-box .search-text {
	border-color: <?php echo esc_html( $menu_hover_color );?>;
} -->

<?php // Header Layout 3 ?>
.header-style-3 .header-contact .fa,
.header-style-3 .header-social li a:hover,
.header-style-3.trheader .header-social li a:hover {
	color: <?php echo esc_html( $menu_hover_color );?>;
}
.header-style-3.trheader .header-contact li a,
.header-style-3.trheader .header-social li a {
	color: <?php echo esc_html( $menu_color_tr ); ?>;
}

<?php // Header Layout 4 ?>
.header-style-4 .header-contact .fa,
.header-style-4 .header-social li a:hover,
.header-style-4.trheader .header-social li a:hover {
	color: <?php echo esc_html( $menu_hover_color );?>;
}
.header-style-4.trheader .header-contact li a,
.header-style-4.trheader .header-social li a {
	color: <?php echo esc_html( $menu_color_tr ); ?>;
}
<?php // Header Layout 5 ?>
.header-style-5 .header-menu-btn {
	background-color: <?php echo esc_html( $primary_color );?>;
}
.trheader.non-stick.header-style-5 .header-menu-btn {
	color: <?php echo esc_html( $menu_color_tr ); ?>;
}
<?php //Primary Color ?>
a:link,
a:visited,
#tophead .tophead-contact .fa,
#tophead .tophead-social li a:hover,
.cart-icon-products .widget_shopping_cart .mini_cart_item a:hover,
.entry-summary h3 a:hover,
.entry-summary h3 a:active,
.entry-header-single .entry-meta ul li .fa,
.class-footer ul li .fa,
.comments-area .main-comments .comments-body .replay-area a:hover,
.comments-area .main-comments .comments-body .replay-area a i,
#respond form .btn-send,
.widget_redchili_about ul li a:hover,
.widget_redchili_address ul li i,
.widget_redchili_address ul li a:hover,
.widget_redchili_address ul li a:active,
.sidebar-widget-area ul li a:hover,
.sidebar-widget-area .widget_redchili_address ul li a:hover,
.sidebar-widget-area .widget_redchili_address ul li a:active,
.wpcf7 label.control-label .fa,
.rdtheme-primary-color,
.redchili-primary-color{
	color: <?php echo esc_html( $primary_color );?>;
}
.site-header .search-box .search-button i,
.scrollToTop:after {
	color: <?php echo esc_html( $primary_color );?> !important;
}
.header-icon-area .cart-icon-area .cart-icon-num,
button,
input[type="button"],
input[type="reset"],
input[type="submit"],
.breadcrumb-area .entry-breadcrumb,
.entry-header .entry-meta,
.vc-post-slider .date,
.entry-summary a.read-more:hover,
.entry-summary a.read-more:active,
#respond form .btn-send:hover,
.widget_redchili_about ul li a,
.search-form .custom-search-input button.btn,
.sidebar-widget-area .widget h3:after,
.error-page-area .error-page-message .home-page a,
.rdtheme-button-1 a:hover,
.wpcf7 .submit-button,
.rdtheme-primary-bgcolor,
.redchili-primary-bgcolor{
	background-color: <?php echo esc_html( $primary_color );?>;
}
.widget .tagcloud a:hover {
	border: 1px solid <?php echo esc_html( $primary_color );?>;
	background-color: <?php echo esc_html( $primary_color );?>;
}
blockquote,
.stick,
.site-header .search-box .search-text,
.scrollToTop,
.entry-summary a.read-more:link,
.entry-summary a.read-more:visited,
#respond form .btn-send {
	border-color: <?php echo esc_html( $primary_color );?>;
}
.infobox-style2 i{
	color: <?php echo esc_html( $primary_color );?>;
}
<?php //Secondery Color ?>
a:hover,
a:focus,
a:active {
	color: <?php echo esc_html( $secondary_color );?>;
}
.search-form .custom-search-input button.btn:hover,
.widget .tagcloud a:hover {
	background-color: <?php echo esc_html( $secondary_color );?>;
}
<?php
/*-------------------------------------
#. Banner
---------------------------------------*/
?>
.inner-page-banner-area .pagination-area h1{
    color: <?php echo esc_html( RDTheme::$options['banner_heading_color'] );?>;
}
.entry-banner {
<?php if ( RDTheme::$bgtype == 'bgcolor' ): ?>
	background-color: <?php echo esc_html( RDTheme::$bgcolor );?>;
<?php else: ?>
	background: url(<?php echo esc_url( RDTheme::$bgimg );?>) no-repeat scroll center center / cover;
<?php endif; ?>
}
.entry-banner .entry-banner-content h1 {
	color: <?php echo esc_html( RDTheme::$options['banner_heading_color'] );?>;
}
.inner-page-banner-area .pagination-area .redchili-pagination span a {
	color: <?php echo esc_html( RDTheme::$options['breadcrumb_link_color'] );?>;
}
.inner-page-banner-area .pagination-area .redchili-pagination span a:hover {
	color: <?php echo esc_html( RDTheme::$options['breadcrumb_link_hover_color'] );?>;
}
.inner-page-banner-area .pagination-area .redchili-pagination{
	color: <?php echo esc_html( RDTheme::$options['breadcrumb_seperator_color'] );?>;
}
.inner-page-banner-area .pagination-area .redchili-pagination > span:last-child {
	color: <?php echo esc_html( RDTheme::$options['breadcrumb_active_color'] );?>;
}
.fmp-load-more button{
	border: 2px solid <?php echo esc_html( $primary_color ); ?> !important;
    color: <?php echo esc_html( $primary_color ); ?> !important;
}
.fmp-utility .fmp-load-more button:hover{
	background-color:<?php echo esc_html( $primary_color ); ?> !important;	
    color: #ffffff !important;
	border: 2px solid <?php echo esc_html( $primary_color ); ?> !important;
}
.pagination-area ul li.active a,
.pagination-area ul li a:hover,
.pagination-area ul li .current {
  background-color: <?php echo esc_html( $primary_color ); ?>;
  border-color: <?php echo esc_html( $primary_color ); ?>;
}
.pagination-area ul li a,
.pagination-area ul li span {
  border: 1px solid <?php echo esc_html( $primary_color ); ?>;
}
<?php
/*-------------------------------------
#. Footer
---------------------------------------*/
$rdtheme_footer_bgcolor = RDTheme::$options['footer_bgcolor'];
$rdtheme_footer_title_color = RDTheme::$options['footer_title_color'];
$rdtheme_footer_link_color = RDTheme::$options['footer_link_color'];
$rdtheme_footer_color = RDTheme::$options['footer_color'];
$rdtheme_footer_link_hover_color = RDTheme::$options['footer_link_hover_color'];
$rdtheme_copyright_bgcolor = RDTheme::$options['copyright_bgcolor'];
$rdtheme_copyright_color = RDTheme::$options['copyright_color'];
$rdtheme_back_to_top = RDTheme::$options['back_to_top'];
?>
.footer-area-top {
	background-color: <?php echo esc_html( $rdtheme_footer_bgcolor ); ?>;
}
.footer-area-top,
.footer-area-top .widget h4 a,
.footer-area-top .opening-schedule li,
.footer-area-top .widget li a,
.footer-area-top .widget .tagcloud a{
	color: <?php echo esc_html( $rdtheme_footer_color ); ?>;
}
.footer-area-top .widget h3 {
	color: <?php echo esc_html( $rdtheme_footer_title_color ); ?>;
}
.footer-area-top .textwidget a:hover,
.footer-area-top .widget a:hover,
.footer-area-bottom p a:hover,
.footer-area-top .widget li a:hover{
	color: <?php echo esc_html( $rdtheme_footer_link_hover_color ); ?>;
}
.footer-area-bottom{
	background-color: <?php echo esc_html( $rdtheme_copyright_bgcolor ); ?>;
}
.footer-area-bottom p,
.footer-area-bottom p a{
	color: <?php echo esc_html( $rdtheme_copyright_color ); ?>;
}
.footer-area-top .footer-social li a {
	background: <?php echo esc_html( $primary_color ); ?>;	
}
.footer-area-top .footer-social li a:hover i{
  color: <?php echo esc_html( $primary_color ); ?>;	
}
<?php if($rdtheme_back_to_top == 0){ ?>
#scrollUp {
	display:none;
}
<?php } ?>

<?php
/*-------------------------------------
#. Widget
---------------------------------------*/
?>
.rc-sidebar h4 a:hover{
  color: <?php echo esc_html( $primary_color ); ?>;	
}
.widget ul li a i,
.widget_categories ul li a i,
.categories ul li a i,
.widget ul li::before,
.widget ul li a:hover,
.widget_categories ul li a:hover,
.archives ul li a:hover,
.widget_archive ul li a:hover,
.categories ul li a:hover
.archives ul li span span,
.widget_archive ul li span span,
.recent-recipes .media-body h3 a:hover,
.rc-sidebar .opening-schedule li span.os-close{
	color: <?php echo esc_html( $primary_color ); ?>;	
}

<?php
/*-------------------------------------
#. Typography
---------------------------------------*/
?>
<?php
$rdtheme_typo_body = RDTheme::$options['typo_body'];
$rdtheme_typo_h1   = RDTheme::$options['typo_h1'];
$rdtheme_typo_h2   = RDTheme::$options['typo_h2'];
$rdtheme_typo_h3   = RDTheme::$options['typo_h3'];
$rdtheme_typo_h4   = RDTheme::$options['typo_h4'];
$rdtheme_typo_h5   = RDTheme::$options['typo_h5'];
$rdtheme_typo_h6   = RDTheme::$options['typo_h6'];
?>
body {
	font-family: <?php echo esc_html( $rdtheme_typo_body['font-family'] ); ?>, sans-serif;
	font-size: <?php echo esc_html( $rdtheme_typo_body['font-size'] ); ?>;
	line-height: <?php echo esc_html( $rdtheme_typo_body['line-height'] ); ?>;
}
h1 {
	font-family: <?php echo esc_html( $rdtheme_typo_h1['font-family'] ); ?>;
	font-size: <?php echo esc_html( $rdtheme_typo_h1['font-size'] ); ?>;
	line-height: <?php echo esc_html( $rdtheme_typo_h1['line-height'] ); ?>;
}
h2 {
	font-family: <?php echo esc_html( $rdtheme_typo_h2['font-family'] ); ?>, sans-serif;
	font-size: <?php echo esc_html( $rdtheme_typo_h2['font-size'] ); ?>;
	line-height: <?php echo esc_html( $rdtheme_typo_h2['line-height'] ); ?>;
}
h3 {
	font-family: <?php echo esc_html( $rdtheme_typo_h3['font-family'] ); ?>, sans-serif;
	font-size: <?php echo esc_html( $rdtheme_typo_h3['font-size'] ); ?>;
	line-height: <?php echo esc_html( $rdtheme_typo_h3['line-height'] ); ?>;
}
h4 {
	font-family: <?php echo esc_html( $rdtheme_typo_h4['font-family'] ); ?>, sans-serif;
	font-size: <?php echo esc_html( $rdtheme_typo_h4['font-size'] ); ?>;
	line-height: <?php echo esc_html( $rdtheme_typo_h4['line-height'] ); ?>;
}
h5 {
	font-family: <?php echo esc_html( $rdtheme_typo_h5['font-family'] ); ?>, sans-serif;
	font-size: <?php echo esc_html( $rdtheme_typo_h5['font-size'] ); ?>;
	line-height: <?php echo esc_html( $rdtheme_typo_h5['line-height'] ); ?>;
}
h6 {
	font-family: <?php echo esc_html( $rdtheme_typo_h6['font-family'] ); ?>, sans-serif;
	font-size: <?php echo esc_html( $rdtheme_typo_h6['font-size'] ); ?>;
	line-height: <?php echo esc_html( $rdtheme_typo_h6['line-height'] ); ?>;
}

<?php
/*-------------------------------------
#. Page Settings
---------------------------------------*/
?>
.content-area {
	padding-top: <?php echo esc_html( RDTheme::$padding_top );?>px;
	padding-bottom: <?php echo esc_html( RDTheme::$padding_bottom );?>px;
}
.entry-banner {
<?php if ( RDTheme::$bgtype == 'bgcolor' ): ?>
	background-color: <?php echo esc_html( RDTheme::$bgcolor );?>;
<?php else: ?>
	background: url(<?php echo esc_url( RDTheme::$bgimg );?>) no-repeat scroll center center / cover;
<?php endif; ?>
}

<?php
/*-------------------------------------
#. Plugin: Layer Slider
---------------------------------------*/
?>
.ls-bar-timer {
	background-color: <?php echo esc_html( $primary_color );?>;
	border-bottom-color: <?php echo esc_html( $primary_color );?>;
}

<?php
/*-------------------------------------
#. Plugin: Logo Showcase
---------------------------------------*/
?>
.rt-wpls .wpls-carousel .slick-prev,
.rt-wpls .wpls-carousel .slick-next {
    background-color: <?php echo esc_html( $primary_color );?>;
}

<?php
/*-------------------------------------
#. Food menu color
---------------------------------------*/
?>
.food-menu-title span i:before,
.fmp-layout-custom-grid-by-cat1 .card-menu-price
.fmp-layout-custom-grid-by-cat2 .amount,
.fmp-layout-custom-grid-by-cat2 .fmp-price,
.fmp-layout-custom-grid-by-cat3 .card-menu-price .amount,
.fmp-layout-custom-grid-by-cat3 .card-menu-price,
.tasty-menu-inner ul li .media-body .amount,
.tasty-menu-inner ul li .media-body .card-menu-price,
.food-menu2-area .food-menu2-box .food-menu2-img-holder .food-menu2-more-holder ul li a,
.food-menu2-area .food-menu2-box .food-menu2-img-holder .food-menu2-more-holder ul li a:hover {
	color: <?php echo esc_html( $primary_color );?> !important ;
}
.fmp-layout-custom-isotope-redchili-2 ul li a:hover{
	color: <?php echo esc_html( $primary_color );?> !important ;
}
.food-menu-title span:before,
.fmp-layout-carousel3 .amount,
.food-menu4-area .food-menu4-box span.amount,
.single-menu-area .single-menu-inner .related-products .food-menu2-box .food-menu2-title-holder .fmp-price,
.fmp-layout-custom-isotope-redchili .isotop-price,
.food-menu3-area .food-menu3-box .food-menu3-box-content .food-menu-price,
.fmp-layout-carousel3 .fmp-price{
  background: <?php echo esc_html( $primary_color );?> !important;
}
.food-menu2-area .food-menu2-box .food-menu2-title-holder .isotop-price-2,
.fmp-layout-custom-isotope-redchili .isotop-price,
.food-menu4-area .food-menu4-box .fmp-price {
  background-color: <?php echo esc_html( $primary_color );?> !important;
}
.single-menu-area .single-menu-inner .single-menu-inner-content .price{
	color: <?php echo esc_html( $primary_color );?>;
}
.food-menu-title span:after ,
.food-menu3-area .food-menu3-box .food-menu3-box-img a:hover i ,
.food-menu3-area .food-menu3-box .food-menu3-box-content .food-menu-price  { 
	background: <?php echo esc_html( $primary_color );?>;
} 
.fmp-layout-isotope-redchili-home button {
	font-family: <?php echo esc_html( $rdtheme_typo_h3['font-family'] ); ?>, sans-serif;
}
.food-menu3-area .food-menu3-box .food-menu3-box-content .food-menu-price:after {
	border-color: transparent <?php echo esc_html( $primary_color );?>;
}
.wrapper .fmp-layout3 .fmp-box .fmp-title h3:hover{
	color: <?php echo esc_html( $primary_color );?>;
}
.fmp-layout3 .fmp-info h3 a:hover{
	color: <?php echo esc_html( $primary_color );?>;
}
.fmp-layout-custom-grid-by-cat2 h3.fmp-title a {
	color: #000000;
}
.fmp-layout-custom-grid-by-cat2 h3.fmp-title a:hover,
.isotope-home h3 a:hover {
	color: <?php echo esc_html( $primary_color );?>;
}
.fmp-wrapper .fmp-title h3 a:hover{
	color: <?php echo esc_html( $primary_color );?> !important;
}
.food-menu1-area .food-menu1-box ul li .media-body h3 a:hover,
.tasty-menu-inner ul li .media-body h3 a:hover{
	color: <?php echo esc_html( $primary_color );?> !important;	
}
.other-menu .owl-custom-nav .owl-prev,
.other-menu .owl-custom-nav .owl-next,
.rt-owl-nav-3 .owl-custom-nav .owl-prev,
.rt-owl-nav-3 .owl-custom-nav .owl-next{	
	background-color: <?php echo esc_html( $primary_color );?>;
}
.isotope-home h4 a:hover,
.food-menu3-area .food-menu3-box .food-menu3-box-content h3 a:hover {
	color: <?php echo esc_html( $primary_color );?> !important;
}
.fmp-pagination ul.pagination-list li span,
.fmp-pagination ul.pagination-list li a{
	background: transparent;
	color:<?php echo esc_html( $primary_color );?> !important;
	border: 1px solid <?php echo esc_html( $primary_color );?> !important;
}
.fmp-pagination ul.pagination-list li.active span,
.fmp-pagination ul.pagination-list li span:hover,
.fmp-pagination ul.pagination-list li a:hover{
	background: <?php echo esc_html( $primary_color );?> !important;
	color: #ffffff  !important;
	border: 1px solid <?php echo esc_html( $primary_color );?> !important;
}
.fmp-layout-carousel3 .fmp-title a.ghost-semi-color-btn{
	border: 2px solid <?php echo esc_html( $primary_color );?> !important;
}
.fmp .title-bar-small-center::before {
    background-color: <?php echo esc_html( $primary_color );?> !important;
}
.fmp-layout-carousel3 .owl-nav .owl-prev, .fmp-layout-carousel3 .owl-nav .owl-next, .fmp-layout-carousel3 .owl-controls .owl-dots .active span {
	border: 1px solid <?php echo esc_html( $primary_color );?> !important;
}
<?php
/*-------------------------------------
#. Single recipe
---------------------------------------*/
?>
.rt-owl-nav-3 .owl-custom-nav .owl-next {
    border: 1px solid <?php echo esc_html( $primary_color );?>;
}
.other-menu .owl-custom-nav .owl-prev:hover, .other-menu .owl-custom-nav .owl-next:hover, .rt-owl-nav-3 .owl-custom-nav .owl-prev:hover, .rt-owl-nav-3 .owl-custom-nav .owl-next:hover, .rt-owl-nav-3 .owl-prev:hover, .rt-owl-nav-3 .owl-next:hover {
background-color: #fff;
    color: <?php echo esc_html( $primary_color );?>;
}
.single-recipe-area .tools-bar li:last-child i,
.single-recipe-area .single-recipe-inner .tools-bar li a i,
.single-recipe-area .single-recipe-inner .tools-bar li a:hover,
.single-recipe-area .single-recipe-inner .tools-bar li span,
.single-recipe-area .single-recipe-inner .tools-bar li span,
.content-box2 .content-box2-bottom-content-holder h3 a:hover,
.recipe-serving i {
  color: <?php echo esc_html( $primary_color );?>;
}
.single-recipe-area .single-recipe-inner .ingredients-box ul li i{
	background-color: <?php echo esc_html( $primary_color );?>;
}
.title-recipe:before {
  background: <?php echo esc_html( $primary_color );?>;
}

<?php
/*-------------------------------------
#. carousel
---------------------------------------*/
?>
.owl-controls .owl-prev 
.owl-controls .owl-next {
	border: 1px solid <?php echo esc_html( $primary_color );?>;
}
.owl-controls .owl-next:hover
.owl-controls .owl-prev:hover {
  background: <?php echo esc_html( $primary_color );?> !important;
}

<?php
/*-------------------------------------
#. Ghost-btn
---------------------------------------*/
?>
.ghost-btn:hover {
	background: <?php echo esc_html( $primary_color );?>;
	border: 2px solid <?php echo esc_html( $primary_color );?>;
}
.ghost-color-btn {
	border: 2px solid <?php echo esc_html( $primary_color );?>;
	color: <?php echo esc_html( $primary_color );?>;
}
.ghost-color-btn-2 {	
	border: 2px solid <?php echo esc_html( $primary_color );?>;
	color: <?php echo esc_html( $primary_color );?>;
}
.ghost-color-btn i {
	color: <?php echo esc_html( $primary_color );?>;
}
.ghost-color-btn:hover {
  background: <?php echo esc_html( $primary_color );?>;
}
.ghost-text-color-btn {
  color: <?php echo esc_html( $primary_color );?>;
}
.ghost-text-color-btn:hover {
  border: 2px solid <?php echo esc_html( $primary_color );?>;
  background: <?php echo esc_html( $primary_color );?>;
}
.ghost-semi-color-btn:hover {
  background: <?php echo esc_html( $primary_color );?>;
}

<?php
/*-------------------------------------
#. Title part
---------------------------------------*/
?>
.title-bar-small-center:before,
.title-bar-big-left-close:before,
.title-bar-medium-left:before,
.title-bar-small-left:before,
.widget-title-bar:before,
.rc-sidebar .widget-title-bar:before,
.title-bar:after,
.title-bar-big-center:before,
.title-bar-full-width:before{
	background: <?php echo esc_html( $primary_color ); ?>;
}
.title-small a:hover,
.subtitle-color {
	color: <?php echo esc_html( $primary_color );?>;
}
#commentform #submit.ghost-on-hover-btn:hover,
.ghost-on-hover-btn:hover,
input.ghost-on-hover-btn:hover,
.single-recipe-area .ghost-on-hover-btn,
.contact-us-right .wpcf7-form-control.ghost-on-hover-btn:hover,
input.ghost-on-hover-btn{
  border: 2px solid <?php echo esc_html( $primary_color );?>;
  color: <?php echo esc_html( $primary_color );?>;
}
.default-btn {
  background: <?php echo esc_html( $primary_color );?>;
}

<?php
/*-------------------------------------
#. Reservation
---------------------------------------*/
?>
.table-reservation2-area input.book-now-btn:hover,
.book-now-btn:hover {
	color: <?php echo esc_html( $primary_color );?>;	
}
.table-reservation3-area input.book-now-btn:hover,
.book-now-btn:hover {
	color: <?php echo esc_html( $primary_color );?>;
}
.table-reservation1-area .book-now-btn{
	border: 1px solid <?php echo esc_html( $primary_color );?>;	
}

<?php
/*-------------------------------------
#. Scroll up
---------------------------------------*/
?>
#scrollUp:hover i,
#scrollUp:focus i {
  color: <?php echo esc_html( $primary_color );?>;
}
.scrollToTop {
    background-color: <?php echo esc_html( $primary_color );?>;
}


<?php
/*-------------------------------------
#. About section
---------------------------------------*/
?>
.about-one-area .about-one-area-top h2 span {
  color: <?php echo esc_html( $primary_color ); ?>;
}
.about-layout-two .about2-top .about2-top-box h2 a:hover,
.about-layout-two .about2-top .about2-top-box:hover i:before,
.about-layout-two .about2-top .about2-top-box h2 a:hover,
.about-layout-two .about2-top .about2-top-box:hover i:before,
.about-layout-two .about2-award-box .media a i:before,
.about-page-left p span span
{
  color:<?php echo esc_html( $primary_color ); ?>;
}
.about-page-right .owl-controls .owl-dots .active span{
	background:<?php echo esc_html( $primary_color ); ?>;
}
.stylish-input-group .input-group-addon button span,
.rc-sidebar .opening-schedule li span.os-close {
  color:<?php echo esc_html( $primary_color ); ?>;
}
.about-one-area .title-bar-big-left:before {
  background: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*--------
#. Blog   
----------*/
?>
.blog-page-box ul li span,
.content-area .entry-blog-post ul li span{
	color:<?php echo esc_html( $primary_color ); ?>;
}
.blog-page-box .rc-date,
.content-area .entry-blog-post .rc-date,
.content-area .single-blog-middle .single-blog-social li:hover {
  background: <?php echo esc_html( $primary_color ); ?>;
}
.content-area .single-blog-middle .single-blog-tag ul li a {
  color: <?php echo esc_html( $primary_color ); ?>;
}
.content-area .single-blog-middle .single-blog-tag ul li:hover {
  background: <?php echo esc_html( $primary_color ); ?>;
  border: 1px solid <?php echo esc_html( $primary_color ); ?>;
}
.content-area .single-blog-middle .single-blog-social li{
  border: 1px solid <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*-------------------------------------
#. 404 page
---------------------------------------*/
?>
.page-error-area .page-error-top {
  background: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*-------------------------------------
#. Contact page
---------------------------------------*/
?>
.contact-us-left ul > li > i {
  color: <?php echo esc_html( $primary_color ); ?>;
}
.contact-us-left ul > li .contact-social li:hover a {
  background: <?php echo esc_html( $primary_color ); ?>;
  border: 1px solid <?php echo esc_html( $primary_color ); ?>;
}
.single-chef-top-area .single-chef-top-content .skill-area .progress:nth-child(1) .progress-bar ,
.single-chef-top-area .single-chef-top-content .skill-area .progress:nth-child(2) .progress-bar ,
.single-chef-top-area .single-chef-top-content .skill-area .progress:nth-child(3) .progress-bar ,
.single-chef-top-area .single-chef-top-content .skill-area .progress:nth-child(4) .progress-bar ,
.single-chef-top-area .single-chef-top-content .skill-area .progress:nth-child(5) .progress-bar {
  background: <?php echo esc_html( $primary_color ); ?>;
}
.single-chef-top-area .single-chef-top-content .single-chef-social li a {
	border: 1px solid <?php echo esc_html( $primary_color ); ?>;
}
.event-social li:hover a,
.single-chef-top-area .single-chef-top-content .single-chef-social li:hover a {
	border: 1px solid <?php echo esc_html( $primary_color ); ?>;
	background: <?php echo esc_html( $primary_color ); ?>;
}
.table-reservation1-area .reservation-form .reservation-input-box i{
	color: <?php echo esc_html( $primary_color ); ?>;
}
.testimonial-style-4 .rc-icon-box::before{
	color: <?php echo esc_html( $primary_color ); ?>;
}

<?php
/*-------------------------------------
#. WooCommerce
---------------------------------------*/
?>
.product-grid-view .woo-shop-top .view-mode ul li:first-child .fa,
.product-list-view .woo-shop-top .view-mode ul li:last-child .fa,
.woocommerce ul.products li.product h3 a:hover,
.woocommerce ul.products li.product .price,
.woocommerce .product-thumb-area .product-info ul li a:hover .fa,
.woocommerce a.woocommerce-review-link:hover,
.woocommerce div.product p.price, .woocommerce div.product span.price,
.woocommerce div.product .product-meta a:hover,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
.woocommerce-message::before,
.woocommerce-info::before {
	color: <?php echo esc_html( $primary_color );?>;
}

.woocommerce ul.products li.product .onsale,
.woocommerce span.onsale,
.woocommerce a.added_to_cart,
.woocommerce div.product form.cart .button,
.woocommerce #respond input#submit,
.woocommerce a.button,
.woocommerce button.button,
.woocommerce input.button,
p.demo_store,
.woocommerce #respond input#submit.disabled:hover, .woocommerce #respond input#submit:disabled:hover, .woocommerce #respond input#submit[disabled]:disabled:hover, .woocommerce a.button.disabled:hover, .woocommerce a.button:disabled:hover, .woocommerce a.button[disabled]:disabled:hover, .woocommerce button.button.disabled:hover, .woocommerce button.button:disabled:hover, .woocommerce button.button[disabled]:disabled:hover, .woocommerce input.button.disabled:hover, .woocommerce input.button:disabled:hover, .woocommerce input.button[disabled]:disabled:hover,
.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,
.woocommerce-account .woocommerce-MyAccount-navigation ul li a {
	background-color: <?php echo esc_html( $primary_color );?>;
}

.woocommerce-message,
.woocommerce-info {
	border-color: <?php echo esc_html( $primary_color );?>;
}

.woocommerce .product-thumb-area .overlay {
    background-color: rgba(<?php echo esc_html( $primary_rgb );?>, 0.8);
}