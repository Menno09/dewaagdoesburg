<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$heading = apply_filters( 'fmp_food_menu__description_heading', esc_html__( 'Description', 'redchili' ) ) ;

?>

<?php if ( $heading ): ?>
	<h2><?php echo esc_html($heading); ?></h2>
<?php endif; ?>

<?php the_content(); ?>
