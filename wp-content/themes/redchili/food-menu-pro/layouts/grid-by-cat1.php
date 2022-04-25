<?php
extract( $arg );$catName ='';
$catDescription = '';
?>
<div class="<?php echo $grid . " " . $class; ?>">
	<div class='fmp-cat1 fmp-box-wrapper'>
		<div class="fmp-cat-title">
			<h2><?php echo $catName; ?></h2>
			<?php echo ($catDescription ? "<p class='cat-description'>{$catDescription}</p>" : null); ?>
		</div>
		<div class="fmp-box">
			<?php
			$gridQuery = new WP_Query( $args );
			if ( $gridQuery->have_posts() ) {
				echo '<ul class="menu-list">';
				while ( $gridQuery->have_posts() ) : $gridQuery->the_post();
					$id      = get_the_ID();
					$image   = FMP()->getFeatureImage( $id, $imgSize, $defaultImgId, $customImgSize );
					$excerpt = FMP()->strip_tags_content( get_the_excerpt(), $excerpt_limit );
					$price   = FMP()->fmpHtmlPrice( $id );
					?>
					<li>
						<div class="fmp-media">
							<?php
							if ( in_array( 'image', $items ) ) {
								if ( $link ) { ?>
                                    <a class="<?php echo $anchorClass; ?> fmp-pull-left" href="<?php the_permalink() ?>"
                                       data-id="<?php the_ID() ?>"><?php echo $image; ?></a>
								<?php } else {
									echo "<span class='fmp-pull-left'>" . $image . "</span>";
								}
							}?>

							<div class="fmp-media-body">
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
								<?php if ( in_array( 'price', $items ) ): ?>
									<span class="fmp-price"><?php echo $price; ?></span>
								<?php endif; ?>
								<?php if ( in_array( 'excerpt', $items ) ): ?>
									<p><?php echo $excerpt; ?></p>
								<?php endif; ?>

							</div>
						</div>
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