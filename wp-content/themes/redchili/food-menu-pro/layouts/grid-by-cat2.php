<?php
extract( $arg );$catName ='';
$cat_thumb_id = get_term_meta( $catId, 'fmp_cat_thumbnail_id', true );
$catImgSrc    = null;
if ( $cat_thumb_id ) {
	$catImageS = wp_get_attachment_image_src( $cat_thumb_id, 'large' );
	$catImgSrc = $catImageS[0];
}
$catDescription = '';
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
					$excerpt = FMP()->strip_tags_content( get_the_excerpt(), $excerpt_limit );
					$price   = FMP()->fmpHtmlPrice( get_the_ID() );
					?>
					<li>
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
						<?php if ( in_array( 'excerpt', $items ) ): ?>
							<p><?php echo $excerpt; ?></p>
						<?php endif; ?>
						<?php if ( in_array( 'price', $items ) ): ?>
							<span class="fmp-price"><?php echo $price; ?></span>
						<?php endif; ?>
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