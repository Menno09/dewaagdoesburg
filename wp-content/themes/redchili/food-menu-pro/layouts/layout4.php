<?php
$price = FMP()->fmpHtmlPrice( $pID );
?>
<div class="<?php echo $grid . " " . $class; ?>">
	<div class="fmp-layout4 fmp-box-wrapper">
		<div class="fmp-box">
            <div class="fmp-media">
				<?php
				if ( in_array( 'image', $items ) ) {
					if ( $link ) { ?>
                        <a class="<?php echo $anchorClass; ?> fmp-pull-left" href="<?php echo esc_url( $pLink ) ?>"
                           data-id="<?php echo absint( $pID ) ?>"><?php echo $img; ?></a>
					<?php } else {
						echo "<span class='fmp-pull-left'>" . $img . "</span>";
					}
				}
				?>

                <div class="fmp-media-body">
					<?php if ( in_array( 'title', $items ) ): ?>
                        <h3 class="fmp-title">
							<?php if ( $link ) { ?>
                                <a class="<?php echo $anchorClass; ?>"
                                   href="<?php echo esc_url($pLink) ?>"
                                   data-id="<?php echo absint($pID) ?>"><?php echo esc_html( $title ); ?></a>
							<?php } else {
							    echo esc_html( $title );
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
		</div>
	</div>
</div>