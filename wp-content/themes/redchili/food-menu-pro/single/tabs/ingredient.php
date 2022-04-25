<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$heading = apply_filters( 'fmp_food_menu_ingredient_heading', esc_html__( 'Ingredient', 'redchili' ) );

?>

<?php if ( $heading ): ?>
	<h2><?php echo esc_html($heading); ?></h2>
<?php endif; ?>

<?php echo wp_kses_post( FMP()->get_fm_ingredient_list() ); ?>

