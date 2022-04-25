<?php
	$rdtheme_footer_column = RDTheme::$options['footer_column'];
	switch ( $rdtheme_footer_column ) {
	case '1':
	$rdtheme_footer_class = 'col-sm-12 col-xs-12';
	break;
	case '2':
	$rdtheme_footer_class = 'col-sm-6 col-xs-12';
	break;
	case '3':
	$rdtheme_footer_class = 'col-sm-4 col-xs-12';
	break;		
	default:
	$rdtheme_footer_class = 'col-sm-3 col-xs-12';
	break;
}
?>
		<footer>
			<?php if ( RDTheme_Helper::has_footer() ){ ?>
					<div class="footer-area-top">
						<div class="container">
							<div class="row">						
								<?php
									for ( $i = 1; $i <= RDTheme::$options['footer_column']; $i++ ) {
										echo '<div class="' . $rdtheme_footer_class . '">';
										dynamic_sidebar( 'footer-'. $i );
										echo '</div>';
									}
								?>
							</div>
						</div>
					</div>
			<?php } ?>
			<?php if ( RDTheme::$options['copyright_area'] ){ ?>
			<div class="footer-area-bottom">
				<div class="container">
					<p><?php echo wp_kses_post( RDTheme::$options['copyright_text'] );?></p>
				</div>
			</div>
			<?php } ?>
		</footer>
	</div>	
	<?php if ( RDTheme::$options['back_to_top'] ): ?>
		<a href="#" class="scrollToTop"><i class="fa fa-arrow-up"></i></a>
	<?php endif; ?>
	<?php wp_footer();?>
</body>
</html>