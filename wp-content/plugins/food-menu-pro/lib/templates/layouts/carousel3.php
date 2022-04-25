<?php
$add_to_cart = null;
if ($source == 'product' && $wc == true) {
    $_product = wc_get_product($pID);
    $price = $_product->get_price_html();
    $pType = $_product->get_type();
    if ($_product->is_purchasable()) {
        if ($_product->is_in_stock()) {
            $quantity_html = sprintf('<div class="fmp-wc-quantity-wrap"><input type="number" name="quantity" step="%1$d" min="%1$d" title="%2$s" size="%3$d" pattern="[0-9]*" inputmode="numeric" value="%1$d"></div>', 1, __("Qty", "food-menu-pro"), 4);
            $add_to_cart_button = sprintf('<a href="%1$s?add-to-cart=%2$d" class="fmp-wc-add-to-cart-btn" data-id="%2$d" data-type="%3$s">%4$s</a>',
                $pLink,
                $pID,
                $pType,
                esc_html($add_to_cart_text)
            );

            if ((in_array('add_to_cart', $items)) || (in_array('quantity', $items))) {
                $add_to_cart = sprintf('<div class="fmp-wc-add-to-cart-wrap">%s%s</div>',
                    in_array('quantity', $items) ? $quantity_html : null,
                    in_array('add_to_cart', $items) ? $add_to_cart_button : null
                );
            }
        }
    }
} else {
    $price = FMP()->fmpHtmlPrice($pID);
}
$class .= " fmp-item-". $pID;
?>
<div class="<?php echo esc_attr($grid . " " . $class); ?>">
    <div class="fmp-layout3 fmp-box-wrapper">
        <div class="fmp-box">
            <?php
            if (in_array('image', $items)) {
                $image = TLPFoodMenu()->getFeatureImage($pID, $imgSize, $defaultImgId, $customImgSize);
                if ($link) { ?>
                    <a class="<?php echo esc_attr($anchorClass); ?>" href="<?php echo esc_url($pLink); ?>"
                       data-id="<?php echo absint($pID); ?>"><?php echo wp_kses_post($image); ?></a>
                <?php } else {
                    echo wp_kses_post($image);
                }
            } ?>
            <div class="fmp-info">
                <div class="fmp-title">
                    <h3><?php if ($link) { ?>
                            <a class="<?php echo esc_attr($anchorClass); ?>" href="<?php echo esc_url($pLink); ?>"
                               data-id="<?php echo absint($pID); ?>"><?php echo esc_html($title); ?></a>
                        <?php } else {
                            echo esc_html($title);
                        } ?></h3>
                    <span class="fmp-price"><?php echo wp_kses_post($price); ?></span>
                    <?php if (in_array('excerpt', $items)): ?>
                        <p><?php echo wp_kses_post($excerpt); ?></p>
                    <?php endif; ?>
                    <?php if (in_array('read_more', $items) && $link): ?>
                        <a href="<?php echo esc_url($pLink) ?>" data-id="<?php echo absint($pID) ?>"
                           class="<?php echo esc_attr($anchorClass); ?> fmp-btn-read-more"><?php echo esc_html($read_more); ?></a>
                    <?php endif; ?>
                    <?php echo stripslashes_deep($add_to_cart); ?>
                </div>
            </div>
        </div>
    </div>
</div>