<div <?php post_class( 'page-error-area ' );?>>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="page-error-top">
			<span><?php echo esc_html( RDTheme::$options['error_title'] );?></span>
			<p><?php echo esc_html( RDTheme::$options['error_text1'] );?></p>
		</div>
	</div>
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="page-error-bottom">
			<p><?php echo esc_html( RDTheme::$options['error_text2'] );?></p>
			<a href="<?php echo esc_url( home_url( '/' ) );?>" class="default-btn"><?php echo esc_html( RDTheme::$options['error_buttontext'] );?></a>
		</div>
	</div>
</div>