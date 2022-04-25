<?php
extract( $arg );
$cat_thumb_id = get_term_meta( $term->term_id, 'fmp_cat_thumbnail_id', true );
$catImgSrc    = null;
if ( $cat_thumb_id ) {
	$catImageS = wp_get_attachment_image_src( $cat_thumb_id, 'large' );
	$catImgSrc = $catImageS[0];
}
$catDescription = '';
$catName = $term->name;
?>
<div class="<?php echo $grid . " " . $class; ?>">
	<div class='fmp-cat2 fmp-box-wrapper'>
		<div class="fmp-cat-title" style="background-image: url('<?php echo $catImgSrc; ?>');">
			<h2><?php echo $catName; ?></h2>
			<?php echo ($catDescription ? "<p class='cat-description'>{$catDescription}</p>" : null); ?>
		</div>
		<div class="fmp-box">
			<?php
			$gridQuery = new WP_Query( $args );
			if ( $gridQuery->have_posts() ) {
				echo '<ul class="menu-list">';
				while ( $gridQuery->have_posts() ) : $gridQuery->the_post();
					if ( !empty($excerpt_limit) ) {
						$excerpt = wp_trim_words( get_the_excerpt(), $excerpt_limit ); // @ parvez
					} else {
						$excerpt = wp_trim_words( get_the_excerpt(), 255 ); // @ parvez
					}
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
								<div class="food-menu-price visible-xs visible-sm hidden-lg hidden-md">
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
							<div class="food-menu-price hidden-sm hidden-xs">
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
							<?php } else { ?>							
								<div class="card-menu-title">
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
								</div>
								<div class="card-menu-price">
								<?php if ( in_array( 'price', $items ) ): ?>
									<span class="fmp-price"><?php echo $price; ?></span>
								<?php endif; ?>
								</div>
								<div class="clear"></div>
								<?php if ( in_array( 'excerpt', $items ) ): ?>
									<p><?php echo $excerpt; ?></p>
								<?php endif; ?>
							<?php } ?>
						</li>
					<?php
				endwhile;
				echo '</ul>';
				wp_reset_postdata();
			} else {
				echo "<ul class='menu-list no-menu'><li>" . __( "No item found.", "food-menu-pro" ) . "</li>";
			}
			?>
		</div>
	</div>
</div>