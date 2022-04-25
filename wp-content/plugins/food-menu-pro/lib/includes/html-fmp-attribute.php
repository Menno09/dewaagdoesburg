<div class="fmp_attribute fmp-metabox <?php echo $flug; ?>" rel="<?php echo $position; ?>">
	<h3>
		<a href="#" class="remove_row delete"><?php _e( 'Remove', 'food-meta-pro' ); ?></a>
		<div class="handlediv" title="<?php esc_attr_e( 'Click to toggle', 'food-meta-pro' ); ?>"></div>
		<strong class="attribute_name"><?php echo esc_html( $attribute_label ); ?></strong>
	</h3>
	<div class="fmp_attribute_data fmp-metabox-content">
		<table cellpadding="0" cellspacing="0">
			<tbody>
			<tr>
				<td class="attribute_name">
					<label><?php _e( 'Name', 'food-menu-pro' ); ?>:</label>
                    <input type="text" class="attribute_name" name="attribute_names[<?php echo $i; ?>]" value="<?php echo esc_attr( $attribute['name'] ); ?>" />
					<input type="hidden" name="attribute_position[<?php echo $i; ?>]" class="attribute_position" value="<?php echo esc_attr( $position ); ?>" />
				</td>
				<td rowspan="3">
					<label><?php _e( 'Value(s)', 'food-menu-pro' ); ?>:</label><textarea name="attribute_values[<?php echo $i; ?>]" cols="5" rows="5" placeholder="<?php echo esc_attr( sprintf( __( 'Enter some text, or some attributes by "%s" separating values.', 'food-menu-pro' ), '|' ) ); ?>"><?php echo esc_textarea( $attribute['value'] ); ?></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<label><input type="checkbox" class="checkbox" <?php checked( $attribute['is_visible'], 1 ); ?> name="attribute_visibility[<?php echo $i; ?>]" value="1" /> <?php _e( 'Visible on the product page', 'food-menu-pro' ); ?></label>
				</td>
			</tr>
			<tr>
				<td>
					<div class="enable_variation show_if_variable">
						<label><input type="checkbox" class="checkbox" <?php checked( $attribute['is_variation'], 1 ); ?> name="attribute_variation[<?php echo $i; ?>]" value="1" /> <?php _e( 'Used for variations', 'food-menu-pro' ); ?></label>
					</div>
				</td>
			</tr>
			</tbody>
		</table>
	</div>
</div>
