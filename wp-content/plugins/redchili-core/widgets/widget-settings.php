<?php
add_action( 'widgets_init', 'rdtheme_widgets_init' );
function rdtheme_widgets_init() {

	// Register Custom Widgets
	register_widget( 'RDTheme_About_Widget' );
	register_widget( 'RDTheme_Recent_Posts_With_Image_Widget' );
	register_widget( 'RDTheme_Recent_Recipe_With_Image_Widget' );
	register_widget( 'RDTheme_Address_Widget' );
	register_widget( 'RDTheme_Open_Hour_Widget' );
}