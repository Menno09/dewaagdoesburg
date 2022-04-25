<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$heading = esc_html( apply_filters( 'fmp_food_menu__description_heading', __( 'Description', 'food-menu-pro' ) ) );

?>

<?php if ( $heading ): ?>
	<h2><?php echo $heading; ?></h2>
<?php endif; ?>

<?php the_content(); ?>
