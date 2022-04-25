<div class="fmp_variation fmp-metabox <?php echo $flug; ?>" rel="<?php  ?>">
	<h3>
		<a href="#" data-id="<?php echo $variation_id; ?>" class="remove_row delete"><?php _e( 'Remove', 'food-meta-pro' ); ?></a>
		<div class="handlediv" title="<?php esc_attr_e( 'Click to toggle', 'food-meta-pro' ); ?>"></div>
		<strong># <?php echo $variation_id; ?> # </strong><strong class="variation_name"><?php echo esc_html( $variation_name ); ?></strong>
	</h3>
	<div class="fmp_variation_data fmp-metabox-content">
		<div class="item-wrap">
			<label><?php _e('Name', 'food-menu-pro') ?></label>
			<input type="text" value="<?php echo $variation_name; ?>" class="variation_name" name="variation[<?php echo $variation_id; ?>][name]">
		</div>
		<div class="item-wrap">
            <label><?php _e('Price', 'food-menu-pro') ?></label>
			<input type="number" step="any" value="<?php echo $variation_price; ?>" name="variation[<?php echo $variation_id; ?>][price]">
		</div>
	</div>
</div> 
