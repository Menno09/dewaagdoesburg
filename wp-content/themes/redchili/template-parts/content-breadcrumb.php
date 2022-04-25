<?php
if( function_exists( 'bcn_display') ){
	echo '<div class="redchili-pagination">';
	if ( is_rtl() ) { //@rtl
		bcn_display( false, true, true );
	}
	else {
		bcn_display();
	}	
	echo '</div>';
}