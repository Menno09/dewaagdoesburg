<?php
$price = FMP()->fmpHtmlPrice( $pID );
$img = TLPFoodMenu()->getFeatureImage($pID, $imgSize, $defaultImgId, $customImgSize);

?>
<div class="<?php echo $grid . " " . $class; ?>">
	<div class="fmp-layout3 fmp-box-wrapper">
		<div class="fmp-box">
			<?php if ( !empty( $price ) ) { ?>
				<span class="fmp-price"><?php echo $price;?></span>
			<?php } ?>
			<?php
			if ( in_array( 'image', $items ) ) {
				if ( $link ) { ?>
                    <a class="<?php echo $anchorClass; ?>" href="<?php echo esc_url( $pLink ); ?>"
                       data-id="<?php echo absint( $pID ); ?>"><?php echo $img; ?></a>
				<?php } else {
					echo $img;
				}
			} echo $img; ?>
			<div class="fmp-info">
				<div class="fmp-title">
					<h3 class="title-small title-bar-small-center"><?php if ( $link ) { ?><a class="<?php echo $anchorClass; ?>" href="<?php echo esc_url( $pLink ); ?>" data-id="<?php echo absint( $pID ); ?>"><?php echo esc_html( $title ); ?></a>
						<?php } else {
							echo esc_html( $title );
						} ?></h3>
					<?php if ( in_array( 'excerpt', $items ) ): ?>
						<p><?php echo $excerpt; ?></p>
					<?php endif; ?>
					<?php if ( in_array( 'read_more', $items ) && $link ): ?>
						<a href="<?php echo esc_url( $pLink ) ?>" data-id="<?php echo absint( $pID ) ?>"
						   class="ghost-semi-color-btn <?php echo $anchorClass; ?> fmp-btn-read-more"><?php echo esc_attr( $read_more ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>