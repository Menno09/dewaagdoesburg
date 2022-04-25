<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tabs = apply_filters( 'fmp_food_menu_tabs', array() );

if ( ! empty( $tabs ) ) : ?>
	<div class="fmp-tabs-wrapper">
		<ul class="fmp-tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>
				<li class="<?php echo esc_attr( $key ); ?>_tab" data-id="tab-fmp-<?php echo esc_attr( $key ); ?>">
					<?php echo esc_html( $tab['title'] ); ?>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php foreach ( $tabs as $key => $tab ) : ?>
			<div class="fmp-tab-panel fmp-tab-panel-<?php echo esc_attr( $key ); ?>"
			     id="tab-fmp-<?php echo esc_attr( $key ); ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ); ?>
			</div>
		<?php endforeach; ?>

	</div>
<?php endif; ?>