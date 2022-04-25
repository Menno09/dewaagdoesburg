<?php
extract($arg);
?>
<div class="<?php echo $grid . " " . $class; ?>">
    <div class='fmp-cat1 fmp-box-wrapper'>
        <div class="fmp-cat-title">
            <h2><?php echo esc_html($term->name); ?></h2>
            <?php echo($term->description ? "<p class='cat-description'>" . wp_kses_post($term->description) . "</p>" : null); ?>
        </div>
        <div class="fmp-box">
            <?php
            $gridQuery = new WP_Query($args);
            if ($gridQuery->have_posts()) {
                echo '<ul class="menu-list">';
                while ($gridQuery->have_posts()) : $gridQuery->the_post();
                    $id = get_the_ID();
                    $image = TLPFoodMenu()->getFeatureImage($id, $imgSize, $defaultImgId, $customImgSize);
                    $excerpt = TLPFoodMenu()->strip_tags_content(get_the_excerpt(), $excerpt_limit);
                    $add_to_cart = null;
                    if ($source == 'product' && $wc == true) {
                        $_product = wc_get_product(get_the_ID());
                        $pID = $id;
                        $pLink = get_the_permalink($pID);
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
                        $price = FMP()->fmpHtmlPrice(get_the_ID());
                    }
                    ?>
                    <li class="fmp-item-<?php the_ID() ?>">
                        <div class="fmp-media">
                            <?php
                            if (in_array('image', $items)) {
                                if ($link) { ?>
                                    <a class="<?php echo esc_attr($anchorClass); ?> fmp-pull-left"
                                       href="<?php the_permalink() ?>"
                                       data-id="<?php the_ID() ?>"><?php echo wp_kses_post($image); ?></a>
                                <?php } else {
                                    echo "<span class='fmp-pull-left'>" . wp_kses_post($image) . "</span>";
                                }
                            } ?>

                            <div class="fmp-media-body">
                                <div class="fmp-title-price">
                                    <?php if (in_array('title', $items)): ?>
                                        <h3 class="fmp-title">
                                            <?php if ($link) { ?>
                                                <a class="<?php echo esc_attr($anchorClass); ?>"
                                                   href="<?php the_permalink() ?>"
                                                   data-id="<?php the_ID() ?>"><?php the_title(); ?></a>
                                            <?php } else {
                                                the_title();
                                            } ?>
                                        </h3>
                                    <?php endif; ?>
                                    <?php if (in_array('price', $items)): ?>
                                        <span class="fmp-price"><?php echo wp_kses_post($price); ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php if (in_array('excerpt', $items)): ?>
                                    <p><?php echo wp_kses_post($excerpt); ?></p>
                                <?php endif; ?>
                                <?php if (in_array('read_more', $items) && $link): ?>
                                    <a href="<?php the_permalink() ?>" data-id="<?php the_ID() ?>"
                                       class="<?php echo esc_attr($anchorClass); ?> fmp-btn-read-more"><?php echo esc_html($read_more); ?></a>
                                <?php endif; ?>
                                <?php echo stripslashes_deep($add_to_cart); ?>
                            </div>
                        </div>
                    </li>
                <?php
                endwhile;
                echo '</ul>';
                wp_reset_postdata();
            } else {
                echo "<p>" . __("No item found.", "food-menu-pro") . "</p>";
            }
            ?>
        </div>
    </div>
</div>