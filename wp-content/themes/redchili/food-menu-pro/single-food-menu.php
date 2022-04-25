<?php
// Layout class
if (RDTheme::$layout == 'full-width') {
    $redchili_layout_class = 'col-sm-12 col-xs-12';
} else {
    $redchili_layout_class = 'col-lg-9 col-md-9 col-sm-8 col-xs-12 leftside-container';
}
?>
<?php
get_header();
$food = FMP()->food();
$fmp_review_count = $food->get_review_count();
?>
    <div class="single-menu-area content-area">
        <div class="container">
            <div class="row">
                <?php
                if (RDTheme::$layout == 'left-sidebar') {
                    get_sidebar();
                }
                ?>
                <div class="<?php echo esc_attr($redchili_layout_class); ?>">
                    <?php while (have_posts()) : the_post();
                        global $post;
                        $html = null;
                        $html .= '<div class="fmp-col-md-12 fmp-col-lg-12 fmp-col-sm-12 fmp-images no-padding-lr">';
                        $html .= '<div id="images">';
                        $rc_foodmenu_stock = get_post_meta($post->ID, 'rc_foodmenu_stock', true);
                        $attachments = get_post_meta($post->ID, '_fmp_image_gallery', true);
                        $attachments = is_array($attachments) ? $attachments : array();
                        if (has_post_thumbnail()) {
                            array_unshift($attachments, get_post_thumbnail_id($post->ID));
                        }
                        if (!empty($attachments)) {
                            if (count($attachments) > 1) {
                                $thumbnails = null;
                                $slides = null;
                                foreach ($attachments as $attachment) {
                                    $slides .= "<li class='fmp-slide'>" . wp_get_attachment_image($attachment,
                                            'full') . "</li>";
                                }

                                $slider = null;
                                $slider .= "<div id='fmp-slide-wrapper'>";
                                $slider .= "<div id=\"slider\" class=\"flexslider\"><ul class=\"slides\">{$slides}</ul></div>";
                                $slider .= "</div>"; // #end fmp-slider

                                $html .= $slider;

                            } else {
                                $html .= "<div class='fmp-single-food-img-wrapper'>";
                                $html .= the_post_thumbnail('full');
                                $html .= "</div>";
                            }
                        } else {
                            $imgSrc = FMP()->placeholder_img_src();
                            $html .= "<div class='fmp-single-food-img-wrapper'>";
                            $html .= "<img class='fmp-single-food-img' alt='Place holder image' src='{$imgSrc}' />";
                            $html .= "</div>";
                        }
                        $html .= '</div>'; // #images
                        $html .= '</div>'; // fmp-images
                        echo wp_kses_post($html);
                        ?>
                        <div class="single-menu-inner fmp-col-md-12 fmp-col-lg-12 fmp-col-sm-12 fmp-images no-padding-lr">
                            <div class="single-menu-inner-content">
                                <?php if (!empty($fmp_review_count)) { ?>
                                    <ul class="tools-bar">
                                        <?php
                                        $total_rating = array();
                                        $comments = get_comments(array(
                                            'post_id' => get_the_ID(),
                                            'number'  => $fmp_review_count));
                                        foreach ($comments as $comment) {
                                            $meta_values = get_comment_meta($comment->comment_ID, 'rating', $single);
                                            array_push($total_rating, $meta_values);
                                        }
                                        $total_star = array_sum($total_rating);
                                        $final_rate = ($total_star / $fmp_review_count);
                                        $rating_width = ($final_rate * 100) / 5;
                                        ?>
                                        <div itemprop="reviewRating" itemscope="" itemtype="http://schema.org/Rating"
                                             class="star-rating"
                                             title="Rated <?php echo esc_html($final_rate); ?> out of 5">
                                            <span style="width:<?php echo esc_html($rating_width); ?>%"><strong
                                                        itemprop="ratingValue"><?php echo esc_html($final_rate); ?></strong><?php esc_html__('out of 5', 'redchili'); ?></span>
                                        </div>
                                    </ul>
                                <?php } ?>

                                <?php
                                $fmp_type = get_post_meta($post->ID, '_fmp_type', true);
								
                                if ('variable' != $fmp_type) {
                                    $gTotal = FMP()->fmpHtmlPrice();
                                    if (!empty($gTotal)) { ?>
									
                                        <div class="food-price <?php if ( RDTheme::$options['stock_available_display'] == 0 ){ ?> no-stock-div<?php } ?>"><span
                                                    class="price"><?php echo wp_kses_post($gTotal); ?></span></div>
										
                                    <?php } ?>
                                <?php } ?>
								
                                <?php
                                global $post;
                                if ('variable' === $fmp_type) {
                                    $variations = get_posts(array(
                                        'post_type'      => 'fmp_variation',
                                        'posts_per_page' => -1,
                                        'post_status'    => 'any',
                                        'post_parent'    => $post->ID,
                                        'order'          => 'ASC'
                                    ));
                                    $html = null;
                                    if (!empty($variations)) {
                                        $html .= '<table class="fmp-price-listing">';
                                        foreach ($variations as $variation) {
                                            $name = get_post_meta($variation->ID, '_name', true);
                                            $price = FMP()->getPriceWithSymbol(get_post_meta($variation->ID, '_price', true));
                                            $html .= "<tr><td>{$name}</td><td>{$price}</td>";
                                        }
                                        $html .= '</table>';
                                    }
                                    echo wp_kses_post( $html );
                                }
                                ?>
                                <?php if ('variable' != $fmp_type) { ?>
									
                                    <div class="inner-sub-title <?php if ( RDTheme::$options['stock_available_display'] == 0 ){ ?> no-stock-div<?php } ?>"><?php if ( RDTheme::$options['stock_available_display'] == 1 ) { ?>
                                        <div><?php esc_html_e('Availability', 'redchili'); ?> : <?php $stock_status = get_post_meta(get_the_ID(), '_stock_status', true);
                                            if ($stock_status == 'instock') {
                                                echo esc_html_e('In stock', 'redchili');
                                            } else {
                                                echo esc_html_e('Out of stock', 'redchili');
                                            } ?></div><?php } ?>
                                    </div>
									
                                <?php } ?>
                                <?php the_content(); ?>
                            </div>
                            <?php
                            $review_active = get_post_meta(get_the_ID(), 'comment_status', true);
                            $ingredients = (array) get_post_meta(get_the_ID(), '_ingredient');
                            $nutrition = (array) get_post_meta(get_the_ID(), '_nutrition');
                            $ingredient_is_active = get_post_meta(get_the_ID(), '_ingredient_status', true);
                            $nutrition_is_active = get_post_meta(get_the_ID(), '_nutrition_status', true);
                            ?>
                            <?php if ((!empty($ingredients) && $ingredient_is_active) || (!empty($nutrition) && $nutrition_is_active) ) { ?>
                                <div class="row">
                                    <?php if (!empty($ingredients) && $ingredient_is_active) { ?>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="ingredients-box">
                                                <h3><?php esc_html_e('Ingredients', 'redchili'); ?></h3>
                                                <?php
                                                $post_id = absint(get_the_ID());
                                                if (!$post_id) {
                                                    global $post;
                                                    $post_id = $post->ID;
                                                }
                                                $html = null;
                                                $ingredients = get_post_meta($post_id, '_ingredient');
                                                if (!empty($ingredients)) {
                                                    $html .= "<ul>";
                                                    foreach ($ingredients as $ingredient) {
                                                        $ing = !empty($ingredient['id']) ? get_term($ingredient['id'], TLPFoodMenu()->taxonomies['ingredient']) : null;
                                                        $unit = !empty($ingredient['unit_id']) ? get_term($ingredient['unit_id'], TLPFoodMenu()->taxonomies['unit']) : null;
                                                        $value = !empty($ingredient['value']) ? ' ' . $ingredient['value'] : null;
                                                        if (is_object($unit) && $unit->name && $value) {
                                                            $unit = " ( {$unit->name} )";
                                                        } else {
                                                            $unit = null;
                                                        }
                                                        if (is_object($ing)) {
                                                            $html .= "<li><i class='fa fa-check' aria-hidden='true'></i>{$ing->name}{$value}{$unit}</li>";
                                                        }

                                                    }
                                                    $html .= "</ul>";
                                                };
                                                echo wp_kses_post($html);
                                                ?>
                                            </div>
                                        </div>
                                    <?php }
                                    if (!empty($nutrition) && $nutrition_is_active) {
                                        ?>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="ingredients-box">
                                                <h3><?php esc_html_e('Nutrition', 'redchili'); ?></h3>
                                                <?php
                                                $post_id = absint(get_the_ID());
                                                if (!$post_id) {
                                                    global $post;
                                                    $post_id = $post->ID;
                                                }
                                                $html = null;
                                                $nutrition = get_post_meta($post_id, '_nutrition');
                                                if (!empty($nutrition)) {
                                                    $html .= "<ul>";
                                                    foreach ($nutrition as $nutrition) {
                                                        $nut = !empty($nutrition['id']) ? get_term($nutrition['id'], TLPFoodMenu()->taxonomies['nutrition']) : null;
                                                        $unit = !empty($nutrition['unit_id']) ? get_term($nutrition['unit_id'], TLPFoodMenu()->taxonomies['unit']) : null;
                                                        $value = !empty($nutrition['value']) ? ' ' . $nutrition['value'] : null;
                                                        if (is_object($unit) && !empty($unit->name) && $value) {
                                                            $unit = " ( {$unit->name} )";
                                                        } else {
                                                            $unit = null;
                                                        }
                                                        if (is_object($nut)) {
                                                            $html .= "<li><i class='fa fa-check' aria-hidden='true'></i>{$nut->name}{$value}{$unit}</li>";
                                                        }
                                                    }
                                                    $html .= "</ul>";
                                                };
                                                echo wp_kses_post($html);
                                                ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <?php $food = FMP()->food(); ?>
                            <?php if (!empty($review_active)) { ?>
                                <div id="reviews" class="fmp-reviews">
                                    <div id="comments">
                                        <h2 class="fmp-reviews-title"><?php
                                            if ($count = $food->get_review_count()) {
                                                printf(_n('%s review for %s%s%s', '%s reviews for %s%s%s', $count, 'redchili'), $count,
                                                    '<span>',
                                                    get_the_title(), '</span>');
                                            } else {
                                                esc_html_e('Reviews', 'redchili');
                                            }
                                            ?>
                                        </h2>
                                        <?php
                                        $comments = get_comments(array(
                                            'post_id' => $food->id,
                                            'status'  => 'approve' //Change this to the type of comments to be displayed
                                        ));

                                        if (!empty($comments) && is_array($comments)) : ?>
                                            <ol class="commentlist">
                                                <?php wp_list_comments(apply_filters('fmp_product_review_list_args',
                                                    array('callback' => 'FmFilterHook::fmp_comments')), $comments); ?>
                                            </ol>
                                            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) :
                                                echo '<nav class="fmp-pagination">';
                                                paginate_comments_links(apply_filters('fmp_comment_pagination_args', array(
                                                    'prev_text' => '&larr;',
                                                    'next_text' => '&rarr;',
                                                    'type'      => 'list',
                                                )));
                                                echo '</nav>';
                                            endif; ?>
                                        <?php else : ?>
                                            <p class="fmp-noreviews"><?php esc_html_e('There are no reviews yet.', 'redchili'); ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <div id="review_form_wrapper">
                                        <div id="review_form">
                                            <?php
                                            $commenter = wp_get_current_commenter();

                                            $comment_form = array(
                                                'title_reply'         => have_comments() ? esc_html__('Add a review',
                                                    'redchili') : sprintf(esc_html__('Be the first to review &ldquo;%s&rdquo;', 'redchili'),
                                                    get_the_title()),
                                                'title_reply_to'      => esc_html__('Leave a Reply to %s', 'redchili'),
                                                'comment_notes_after' => '',
                                                'fields'              => array(
                                                    'author' => '<p class="comment-form-author">' . '<label for="author">' . esc_html__('Name',
                                                            'redchili') . ' <span class="required">*</span></label> ' .
                                                        '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" aria-required="true" required /></p>',
                                                    'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__('Email',
                                                            'redchili') . ' <span class="required">*</span></label> ' .
                                                        '<input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" aria-required="true" required /></p>',
                                                ),
                                                'label_submit'        => esc_html__('Submit', 'redchili'),
                                                'logged_in_as'        => '',
                                                'comment_field'       => ''
                                            );

                                            $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf(esc_html__('You must be <a href="%s">logged in</a> to post a review.',
                                                    'redchili'), esc_url('/login/')) . '</p>';
                                            // TODO need to check logged in url

                                            // TODO check for is rating is enable
                                            $comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__('Your Rating',
                                                    'redchili') . '</label><select name="rating" id="rating" aria-required="true" required>
												<option value="">' . esc_html__('Rate&hellip;', 'redchili') . '</option>
												<option value="5">' . esc_html__('Perfect', 'redchili') . '</option>
												<option value="4">' . esc_html__('Good', 'redchili') . '</option>
												<option value="3">' . esc_html__('Average', 'redchili') . '</option>
												<option value="2">' . esc_html__('Not that bad', 'redchili') . '</option>
												<option value="1">' . esc_html__('Very Poor', 'redchili') . '</option>
											</select></div>';

                                            $comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__('Your Review',
                                                    'redchili') . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>';

                                            comment_form(apply_filters('fmp_food_review_comment_form_args', $comment_form));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="clear"></div>
                                </div>
                            <?php }
                            if (RDTheme::$options['related_food_menu'] == 1) { ?>
                                <?php get_template_part('template-parts/content-other', 'menu'); ?>
                            <?php } ?>

                        </div>
                    <?php endwhile; ?>
                </div>
                <?php
                if (RDTheme::$layout == 'right-sidebar') {
                    get_sidebar();
                }
                ?>
            </div>
        </div>
    </div>
<?php get_footer(); ?>