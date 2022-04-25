<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
	<div class="rc-sidebar">
		<?php
			if ( RDTheme::$sidebar ) {
				if ( is_active_sidebar( RDTheme::$sidebar ) ) dynamic_sidebar( RDTheme::$sidebar );
			}
			else {
				if ( is_active_sidebar( 'sidebar' ) ) dynamic_sidebar( 'sidebar' );
			}
		?>
	</div>
</div>