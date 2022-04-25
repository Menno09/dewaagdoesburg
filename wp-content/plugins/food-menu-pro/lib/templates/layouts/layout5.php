<?php
$price_box = null;
if ( $source == 'product' && $wc == true ) {
	$_product = wc_get_product( $pID );
	$pType    = $_product->get_type();
	if ( $pType == 'variable' ) {
		$variations = $_product->get_available_variations();
		if ( ! empty( $variations ) ) {
			foreach ( $variations as $key => $value ) {
				$variation_id            = $value['variation_id'];
				$variable_product        = wc_get_product( $variation_id );
				$variant_attributes_html = null;
				if ( ! empty( $value['attributes'] ) ) {
					foreach ( $value['attributes'] as $attr_key => $attr_value ) {
						$term = get_term_by('slug', $attr_value, str_replace('attribute_', '', $attr_key));
						$variant_attributes_html .= sprintf( '<span class="fmp-attr-variation %s">%s</span>', $attr_key, $term ? $term->name : $attr_value );
					}
				}
				$price_box .= sprintf( '<div class="fmp-price-box">%s%s%s</div>',
					$variant_attributes_html ? sprintf( '<div class="fmp-attr-variation-wrapper">%s</div>', $variant_attributes_html ) : null,
					in_array( 'price', $items ) ? sprintf( '<span class="fmp-price">%s</span>', $variable_product->get_price_html() ) : null,
					( in_array( 'add_to_cart', $items ) && $variable_product->is_purchasable() && $variable_product->is_in_stock() ) ?
						sprintf( '<div class="quantity"><input type="number" class="input-text qty text" step="1" min="0" name="quantity" value="1" title="Quantity" size="4" pattern="[0-9]*" inputmode="numeric"></div><a href="%1$s?add-to-cart=%2$d" class="fmp-wc-add-to-cart-btn" data-id="%2$d" data-type="%3$s" data-variation-id="%4$d">%5$s</a>',
							$pLink,
							$pID,
							$pType,
							$variation_id,
							esc_html( $add_to_cart_text )
						) : null
				);
			}
		}
	} else {
		$price_box = sprintf( '<div class="fmp-price-box">%s%s</div>',
			in_array( 'price', $items ) ? sprintf( '<span class="fmp-price">%s</span>', $_product->get_price_html() ) : null,
			( in_array( 'add_to_cart', $items ) && $_product->is_purchasable() && $_product->is_in_stock() ) ?
				sprintf( '<div class="quantity"><input type="number" class="input-text qty text" step="1" min="0" name="quantity" value="1" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric"></div><a href="%1$s?add-to-cart=%2$d" class="fmp-wc-add-to-cart-btn" data-id="%2$d" data-type="%3$s">%4$s</a>',
					$pLink,
					$pID,
					$pType,
					esc_html( $add_to_cart_text )
				) : null
		);
	}

} else {
	$price_box = sprintf( '<div class="fmp-price-box">%s</div>',
		in_array( 'price', $items ) ? sprintf( '<span class="fmp-price">%s</span>', FMP()->fmpHtmlPrice( $pID ) ) : null
	);
}
$class .= " fmp-item-" . $pID;
?>
<div class="<?php echo esc_attr( $grid . " " . $class ); ?>">
    <div class="fmp-box">
        <div class="fmp-media">
			<?php
			if ( in_array( 'image', $items ) ) {
                $image = TLPFoodMenu()->getFeatureImage($pID, $imgSize, $defaultImgId, $customImgSize);
				if ( $link ) {
					printf( '<a class="%s fmp-pull-left" href="%s" data-id="%d">%s</a>',
						esc_attr( $anchorClass ),
						esc_url( $pLink ),
						absint( $pID ),
                        $image
					);
					?>
				<?php } else {
					printf( '<span class="fmp-pull-left">%s</span>', $image );
				}
			}
			?>
            <div class="fmp-media-body">
                <div class="fmp-row">
                    <div class="fmp-col-lg-7 fmp-col-md-6 fmp-col-sm-12 fmp-col-xs-12 info-part">
                        <?php if ( in_array( 'title', $items ) ): ?>
                            <h3 class="fmp-title">
                                <?php if ( $link ) { ?>
                                    <a class="<?php echo esc_attr( $anchorClass ); ?>"
                                       href="<?php echo esc_url( $pLink ) ?>"
                                       data-id="<?php echo absint( $pID ) ?>"><?php echo esc_html( $title ); ?></a>
                                <?php } else {
                                    echo esc_html( $title );
                                } ?>
                            </h3>
                        <?php endif; ?>

                        <?php if ( in_array( 'excerpt', $items ) ): ?>
                            <p><?php echo wp_kses_post( $excerpt ); ?></p>
                        <?php endif; ?>

                        <?php if ( in_array( 'read_more', $items ) && $link ): ?>
                            <a href="<?php echo esc_url( $pLink ) ?>" data-id="<?php echo esc_attr( $pID ) ?>"
                               class="<?php echo esc_attr( $anchorClass ); ?> fmp-btn-read-more"><?php echo esc_html( $read_more ); ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="fmp-col-lg-5 fmp-col-md-6 fmp-col-sm-12 fmp-col-xs-12 no-pad action-part">
                        <div class="fmp-price-box-wrap"><?php echo $price_box; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>