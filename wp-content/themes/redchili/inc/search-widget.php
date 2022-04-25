<?php
add_filter( 'get_search_form', 'rdtheme_search_widget' );
function rdtheme_search_widget(){
	$output =  '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
	<div class="sidebar-search-area margin-bottom-sidebar">
		<div class="input-group stylish-input-group">			
			<input type="text" class="form-control" placeholder="' . esc_attr__( 'Search here ...', 'redchili' ) . '"  value="' . get_search_query() . '" name="s" />
			<span class="input-group-addon">
				<button type="submit">
					<span class="glyphicon glyphicon-search"></span>
				</button>		
			</span>			 
		</div>
	</div></form>';
	return $output;
}