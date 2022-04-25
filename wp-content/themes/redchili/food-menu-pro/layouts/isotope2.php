<?php
$price = FMP()->fmpHtmlPrice( $pID );
?>
<div class="<?php echo $grid . " " . $class . " " . $isoFilter; ?>">
    <div class="fmp-layout2 fmp-box-wrapper">
        <div class="fmp-box">
			<?php if ( in_array( 'image', $items ) ) { ?>
                <div class="fmp-img-wrapper">
					<?php if ( $link ) { ?>
                        <a class="<?php echo $anchorClass; ?>" href="<?php echo $pLink ?>" data-id="<?php echo $pID ?>"><i
                                    class="fa fa-link" aria-hidden="true"></i></a>
					<?php }
					echo $img; ?>
                </div>
			<?php } ?>
            <div class="fmp-content">
				<?php if ( in_array( 'title', $items ) ): ?>
                    <h3><?php if ( $link ) { ?>
                            <a class="<?php echo $anchorClass; ?>" href="<?php echo esc_url( $pLink ) ?>"
                               data-id="<?php echo $pID ?>"><?php echo esc_html( $title ); ?></a>
						<?php } else {
							echo esc_html( $title );
						} ?></h3>
					<?php if ( in_array( 'price', $items ) ): ?>
                        <span class="fmp-price"><?php echo $price; ?></span>
					<?php endif; ?>
				<?php endif; ?>
				<?php if ( in_array( 'excerpt', $items ) ): ?>
                    <p><?php echo $excerpt; ?></p>
				<?php endif; ?>

				<?php if ( in_array( 'read_more', $items ) && $link ): ?>
                    <a href="<?php echo esc_url( $pLink ) ?>" data-id="<?php echo absint( $pID ) ?>"
                       class="<?php echo $anchorClass; ?> fmp-btn-read-more"><?php echo esc_attr( $read_more ); ?></a>
				<?php endif; ?>

            </div>
        </div>
    </div>
</div>