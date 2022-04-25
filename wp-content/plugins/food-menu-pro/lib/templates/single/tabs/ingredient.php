<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$heading = apply_filters( 'fmp_food_menu_ingredient_heading', __( 'Ingredient', 'food-menu-pro' ) );

?>

<?php if ( $heading ): ?>
	<h2><?php echo $heading; ?></h2>
<?php endif; ?>

<?php echo FMP()->get_fm_ingredient_list(); ?>

