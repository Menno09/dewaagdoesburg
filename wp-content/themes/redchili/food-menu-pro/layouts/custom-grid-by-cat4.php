<?php
extract( $arg );
$cat_thumb_id = get_term_meta( $catId, 'fmp_cat_thumbnail_id', true );
$catImgSrc    = null;
if ( $cat_thumb_id ) {
	$catImageS = wp_get_attachment_image_src( $cat_thumb_id, 'large' );
	$catImgSrc = $catImageS[0];
}
$catName = $term->name;

?>
<div class="<?php echo esc_attr($grid) . " " . esc_attr($class); ?>">
	<div class='fmp-cat2 fmp-box-wrapper'>	
		<span class="top-pattern"></span>
		<span class="bottom-pattern"></span>
		<div class="fmp-cat-title">
			<h2><?php echo esc_html($catName);?></h2>
		</div>
		<div class="fmp-box">
			<?php
			$gridQuery = new WP_Query( $args );
			if ( $gridQuery->have_posts() ) {
				echo '<ul class="menu-list">';
				while ( $gridQuery->have_posts() ) : $gridQuery->the_post();					
					$excerpt = FMP()->strip_tags_content( get_the_excerpt(), $excerpt_limit );
					$price   = FMP()->fmpHtmlPrice( get_the_ID() );
					?>
					<li>
						<?php
							$fmp_type = get_post_meta(get_the_ID(), '_fmp_type', true);
							global $post;
							if( 'variable' === $fmp_type ){
						?>							
						<div class="food-menu-content">
							<?php if ( in_array( 'title', $items ) ): ?>
								<h3 class="fmp-title">
									<?php if ( $link ) { ?>
										<a class="<?php echo $anchorClass; ?>"
										   href="<?php the_permalink() ?>"
										   data-id="<?php the_ID() ?>"><?php the_title(); ?></a>
									<?php } else {
										the_title();
									} ?>
								</h3>
							<?php endif; ?>
							<div class="food-menu-price">
								<?php
									$fmp_type = get_post_meta(get_the_ID(), '_fmp_type', true);
									if( 'variable' != $fmp_type){ ?>
									<?php if ( in_array( 'price', $items ) ): ?>
										<span class="fmp-price"><?php echo $price; ?></span>
									<?php endif; ?>
								<?php } ?>
								<?php
									global $post;
									if( 'variable' === $fmp_type ){
										$variations = get_posts(array(
											'post_type' => 'fmp_variation',
											'posts_per_page' => -1,
											'post_status' => 'any',
											'post_parent' => $post->ID,
											'order' => 'ASC'
										));
										$html = null;
										if(!empty($variations)) {
											$html .= '<table class="fmp-price-listing">';
											foreach ( $variations as $variation ) {
												$name = get_post_meta($variation->ID, '_name', true);
												$price = FMP()->getPriceWithSymbol(get_post_meta($variation->ID, '_price', true));
												$html .="<tr><td>{$name}</td><td>{$price}</td>";
											}
											$html .= '</table>';
										}
										echo $html;
									}
								?>
							</div>
							<?php if ( in_array( 'excerpt', $items ) ): ?>
								<p><?php echo $excerpt; ?></p>
							<?php endif; ?>
						</div>
					<?php } else { ?>					
						<div class="title-holder">
							<div class="card-menu-title">
								<?php if ( in_array( 'title', $items ) ): ?>
									<h3 class="fmp-title">
										<?php if ( $link ) { ?>
											<a class="<?php echo esc_attr($anchorClass); ?>"
											   href="<?php the_permalink() ?>"
											   data-id="<?php the_ID() ?>"><?php the_title(); ?></a>
										<?php } else { 
											the_title();
										} ?><?php if ( in_array( 'price', $items ) ): ?>
										<span class="fmp-price"> - <?php echo wp_kses_post($price); ?></span>
									<?php endif; ?>
									</h3>
								<?php endif; ?>
							</div>
							<div class="card-menu-price">
								<?php if ( in_array( 'price', $items ) ): ?>
								<span class="fmp-price"><?php echo wp_kses_post($price); ?></span>
								<?php endif; ?>
							</div>
						</div>
						<div class="clear"></div>
						<?php if ( in_array( 'excerpt', $items ) ): ?>
							<p><?php echo esc_html($excerpt); ?></p> 
						<?php endif; ?>
					<?php } ?>
					</li>
					<?php
				endwhile;
				echo '</ul>';
				wp_reset_postdata();
			} else {
				echo "<p>" . __( "No item found.", "food-menu-pro" ) . "</p>";
			}
			?>
		</div>
	</div>
</div>