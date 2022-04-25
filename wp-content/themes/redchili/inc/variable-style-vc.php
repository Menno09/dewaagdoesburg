<?php
$primary_color   	 = RDTheme::$options['primary_color']; // #e7272d
$secondary_color 	 = RDTheme::$options['secondery_color']; // #d32f2f
$rdtheme_primary_rgb = RDTheme_Helper::hex2rgb( $primary_color ); // 231, 39, 45

/*-------------------------------------    
INDEX
===================================
#. VC: Owl Nav 1
#. VC: Chef Section
#. VC: Recipe Card slider
#. VC: Recipe box slider
#. VC: event slider
#. VC: Counter
#. VC: Food Menu – carousel
#. VC: Food Menu – card layout
#. VC: Info box
#. VC: Woocommerce Food Menu - Carousel
#. VC: Woocommerce Food Menu - Isotope
#. VC: Woocommerce Food Menu - Card
-------------------------------------*/
?>
<?php /*--- VC: Owl Dots 1 ---*/ ?>
.rt-owl-dot-1 .owl-theme .owl-dots .owl-dot.active span,
.rt-owl-dot-1 .owl-theme .owl-dots .owl-dot:hover span {
	background-color: <?php echo esc_html( $primary_color );?>;
}
.rt-title-1 .subtitle-color {
	color: <?php echo esc_html( $primary_color );?>;
}
<?php /*--- VC: Chef Section ---*/  ?>
.chef-area .owl-nav .owl-prev,
.chef-area .owl-nav .owl-next,
.rt-owl-event-slider .owl-nav .owl-prev,
.rt-owl-event-slider .owl-nav .owl-next,
.chef-area .owl-controls .owl-dots .active span,
.rt-owl-event-slider .owl-controls .owl-dots .active span,
.rt-owl-nav-2 .owl-nav .owl-prev,
.rt-owl-nav-2 .owl-nav .owl-next{
  background-color: <?php echo esc_html( $primary_color ); ?> !important;
}
.chef-area .owl-nav .owl-prev:hover,
.chef-area .owl-nav .owl-next:hover,
.rt-owl-event-slider .owl-nav .owl-prev:hover,
.rt-owl-event-slider .owl-nav .owl-next:hover,
.rt-owl-nav-2 .owl-nav .owl-prev:hover,
.rt-owl-nav-2 .owl-nav .owl-next:hover{
	border: 1px solid <?php echo esc_html( $primary_color ); ?>;
	background-color: transparent !important;
}
.chef-area .owl-nav .owl-prev:hover i,
.chef-area .owl-nav .owl-next:hover i,
.rt-owl-nav-2 .owl-nav .owl-prev:hover i,
.rt-owl-nav-2 .owl-nav .owl-next:hover i,
.rt-owl-event-slider .owl-nav .owl-prev:hover i,
.rt-owl-event-slider .owl-nav .owl-next:hover i,
.rt-owl-event-slider .content-box2 .content-box2-bottom-content-holder ul li i,
.all-event-area .content-box2 .content-box2-bottom-content-holder ul li i,
.pagination-area ul li, .woocommerce nav.woocommerce-pagination ul li {
	color: <?php echo esc_html( $primary_color ); ?> !important;
}
.chef-box .chef-box-content,
.chef-box .chef-box-content ul li:hover {
	background: <?php echo esc_html( $primary_color ); ?>;
}
.chef-box .chef-box-content h3 a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
 }
 .chef-box .chef-box-content p:before {
	background: <?php echo esc_html( $primary_color ); ?>;
 }
 
<?php /*--- #. VC: Recipe Card slider ---*/  ?>
.recipe-of-the-day-area .recipe-of-the-day-box .recipe-of-the-day-content {
	border: 5px solid <?php echo esc_html( $primary_color ); ?>;
}
.recipe-of-the-day-area .recipe-of-the-day-box .recipe-of-the-day-content .time-needs li i{
	color: <?php echo esc_html( $primary_color ); ?>;
}
.recipe-of-the-day-area .owl-controls .active span {
	background: <?php echo esc_html( $primary_color ); ?> !important;
}
.recipe-of-the-day-area .recipe-of-the-day-box .recipe-of-the-day-content .awards-box ul li a i {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.recipe-of-the-day-area .owl-prev i,
.recipe-of-the-day-area .owl-next i{
	color:<?php echo esc_html( $primary_color ); ?>;
}
.recipe-of-the-day-area .recipe-of-the-day-box .recipe-of-the-day-content h2 a:hover {
	color: <?php echo esc_html( $primary_color );?>;
}
<?php /*--- #. VC: food menu card  ---*/  ?>
.fmp-layout-custom-grid-by-cat7 .menu-list li .food-menu-price table th:last-child ,
.fmp-layout-custom-grid-by-cat7 .menu-list li .food-menu-price table td:last-child ,
.fmp-layout-custom-grid-by-cat2 .menu-list li .food-menu-price table th:last-child ,
.fmp-layout-custom-grid-by-cat2 .menu-list li .food-menu-price table td:last-child {
	color: <?php echo esc_html( $primary_color ); ?>;
}
<?php /*--- VC: Recipe box slider ---*/  ?>
.content-box2 .content-box2-img-holder:after{
	background-color: rgba(<?php echo esc_html( $rdtheme_primary_rgb );?>, 0.8);
}
.content-box2 .content-box2-bottom-content-holder ul li a:hover,
.content-box2 .content-box2-bottom-content-holder ul li a i {
	color: <?php echo esc_html( $primary_color );?>;
}
<?php /*--- VC: Testimonial ---*/  ?>
.rt-owl-testimonial-2 .rt-vc-content,
.owl-theme .owl-controls .owl-prev,
.owl-theme .owl-controls .owl-next,
.chef-box .chef-sep {
	border-color: <?php echo esc_html( $primary_color );?>;	
}
<?php /*--- VC: event slider ---*/ ?>
<?php //event single ?>
.event-social li a{
	border: 1px solid <?php echo esc_html( $primary_color );?>;
}
.event-mark {
    border-bottom: 35px solid <?php echo esc_html( $primary_color );?>;
}
.client-reviews-area .client-reviews-right h2,
.event-info ul li i{
	color: <?php echo esc_html( $primary_color );?>;
}

<?php /*--- VC: Counter ---*/ ?>
.counter-right-1 i,
.award1-area-box i,
.about2-award-box .icon-part i{
    color: <?php echo esc_html( $primary_color );?>;   
}

<?php /*--- VC: Food Menu – carousel ---*/ ?>
.fmp-layout-carousel3 .owl-nav .owl-prev,
.fmp-layout-carousel3 .owl-nav .owl-next,
.fmp-layout-carousel3 .owl-controls .owl-dots .active span {
  background-color: <?php echo esc_html( $primary_color ); ?> !important;
}
.fmp-layout-carousel3 .owl-nav .owl-prev:hover,
.fmp-layout-carousel3 .owl-nav .owl-next:hover{
	border: 1px solid <?php echo esc_html( $primary_color ); ?>;
	background-color: transparent !important;
}
.fmp-layout-carousel3 .owl-nav .owl-prev:hover i,
.fmp-layout-carousel3 .owl-nav .owl-next:hover i {
  color: <?php echo esc_html( $primary_color ); ?> !important;
}
.fmp-isotope-buttons button:hover ,
.fmp-isotope-buttons button.selected {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
<?php /*--- VC: Info box ---*/ ?>
.infobox-style1-right h2 a:hover{
	color: <?php echo esc_html( $primary_color ); ?> !important;
}
.info-box-1 i ,
.infobox-style2 i {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.client-area .owl-controls .owl-dot:hover span {
	background: rgba(<?php echo esc_html( $rdtheme_primary_rgb );?>, 0.5) !important;
}
<?php /*--- #. VC: Woocommerce Food Menu - Carousel ---*/ ?>
.wfmc-area .wfmc-layout-1 .fmp-price,
.client-area .owl-controls .active span {
	background: <?php echo esc_html( $primary_color ); ?> !important;
}
.wfmc-info-1 .wfmc-title a:hover {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.wfmc-info-1 .title-bar-small-center:before {
  background-color: <?php echo esc_html( $primary_color ); ?>;
}
.wfmc-info-1 .button.add_to_cart_button {
	border: 2px solid <?php echo esc_html( $primary_color ); ?>;
}
.wfmc-info-1 .button.add_to_cart_button:hover {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.wfmc-area .owl-controls .owl-dots .active span {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.wfmc-area .owl-nav .owl-prev {
	border: 1px solid <?php echo esc_html( $primary_color ); ?>;
}
.wfmc-area .owl-nav .owl-next {
	border: 1px solid <?php echo esc_html( $primary_color ); ?>;
}
.wfmc-area .single_add_to_cart_button ,
.wfmc-area .isotope-variable ,
.wfmc-area .ajax_add_to_cart.add_to_cart_button {
	border: 2px solid <?php echo esc_html( $primary_color ); ?>;
}
.wfmc-area .single_add_to_cart_button:hover,
.wfmc-area .isotope-variable:hover,
.wfmc-area .ajax_add_to_cart.add_to_cart_button:hover {	
	background-color: <?php echo esc_html( $primary_color ); ?>;	
}
.wfmc-area .variations label {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.wfmc-area .modal-dialog .single_add_to_cart_button.button.alt {
	border-color: <?php echo esc_html( $primary_color ); ?>;
	color: <?php echo esc_html( $primary_color ); ?>;
}
.fmp-carousel3 .owl-theme .owl-nav .owl-next,
.fmp-carousel3 .owl-theme .owl-nav .owl-prev {
	background: <?php echo esc_html( $primary_color ); ?>;
}
.fmp-carousel3 .owl-theme .owl-nav > div:hover {
	background: <?php echo esc_html( $secondary_color ); ?>;
}
<?php /*--- #. VC: Woocommerce Food Menu - Isotope ---*/ ?>
#inner-isotope .fmp-iso-filter  .current {
	background: <?php echo esc_html( $primary_color ); ?>;
}
#inner-isotope .single_add_to_cart_button ,
#inner-isotope .isotope-variable ,
#inner-isotope .ajax_add_to_cart.add_to_cart_button {
	border: 2px solid <?php echo esc_html( $primary_color ); ?>;
	color: <?php echo esc_html( $primary_color ); ?>;
}
#inner-isotope .single_add_to_cart_button:hover,
#inner-isotope .isotope-variable:hover,
#inner-isotope .ajax_add_to_cart.add_to_cart_button:hover {	
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
#inner-isotope .variations label {
	color: <?php echo esc_html( $primary_color ); ?>;
}
<?php /*--- #. VC: Woocommerce Food Menu - Card ---*/ ?>
.wfmc-layout-3 .single_add_to_cart_button ,
.wfmc-layout-3 .isotope-variable,
.wfmc-layout-3 .ajax_add_to_cart.add_to_cart_button {
	border: 2px solid <?php echo esc_html( $primary_color ); ?>;
	color: <?php echo esc_html( $primary_color ); ?>;
}
.wfmc-layout-3 .single_add_to_cart_button:hover,
.wfmc-layout-3 .isotope-variable:hover,
.wfmc-layout-3 .ajax_add_to_cart.add_to_cart_button:hover {	
	background-color: <?php echo esc_html( $primary_color ); ?>;	
	border: 2px solid <?php echo esc_html( $primary_color ); ?>;	
}
.wfmc-layout-3 .variations label {
	color: <?php echo esc_html( $primary_color ); ?>;
}
.wfmc-layout-3 .rt-menu-price .woocommerce-Price-amount {
	background-color: <?php echo esc_html( $primary_color ); ?>;
}
.wfmc-layout-3 .input-text.qty.text {
	border: 2px solid <?php echo esc_html( $primary_color ); ?>;
}