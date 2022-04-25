<?php
extract($arg);
$class .= " fmp-item-". $pID;
?>
<div class="col-md-<?php echo esc_attr($col . " " . $class); ?> ">
    <div class='food-menu5-area'>
        <div class="food-menu5-box wow zoomIn" data-wow-duration="1s" data-wow-delay=".5s">
            <div class="food-menu5-title-area">
                <div class="food-menu5-title-holder">
                    <h2><?php echo esc_html($term->name); ?></h2>
                    <?php echo($term->description ? "<p class='cat-description'>" . wp_kses_post($term->description) . "</p>" : null); ?>
                </div>
            </div>
            <?php
            $gridQuery = new WP_Query($args);
            if ($gridQuery->have_posts()) {
                while ($gridQuery->have_posts()) : $gridQuery->the_post();
                    $id = get_the_ID();
                    $image = TLPFoodMenu()->getFeatureImage($id, $imgSize, $defaultImgId, $customImgSize);
                    $excerpt = TLPFoodMenu()->strip_tags_content(get_the_excerpt(), $excerpt_limit);
                    if ($taxonomy == 'product_cat') {
                        global $product;
                        $price = $product->get_price_html();
                    } else {
                        $price = FMP()->fmpHtmlPrice($id);
                    }
                    ?>

                    <div class="food-menu5-box wow zoomIn" data-wow-duration="1s" data-wow-delay=".5s">

                        <ul>
                            <li>
                                <?php if (in_array('title', $items)): ?>
                                    <h3><a class="<?php echo esc_attr($anchorClass); ?>" href="<?php the_permalink() ?>"
                                           data-id="<?php the_ID() ?>"><?php the_title(); ?></a></h3>
                                <?php endif; ?>
                                <?php if (in_array('excerpt', $items)): ?>
                                    <p><?php echo wp_kses_post($excerpt); ?></p>
                                <?php endif; ?>
                                <?php if (in_array('price', $items)): ?>
                                    <span><?php echo wp_kses_post($price); ?></span>
                                <?php endif; ?>

                            </li>

                        </ul>
                    </div>

                <?php
                endwhile;
            } else {
                echo "<p>" . __("No item found", "food-menu-pro") . "</p>";
            }

            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>