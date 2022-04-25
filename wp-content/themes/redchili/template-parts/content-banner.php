<?php
if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
	$rdtheme_title = woocommerce_page_title( false );
} elseif ( is_404() ) {
	$rdtheme_title = RDTheme::$options['error_title'];
} elseif ( is_search() ) {
	$rdtheme_title = esc_html__( 'Search Results for : ', 'redchili' ) . get_search_query();
} elseif ( is_home() ) {
	if ( get_option( 'page_for_posts' ) ) {
		$rdtheme_title = get_the_title( get_option( 'page_for_posts' ) );
	}
	else {
		$rdtheme_title = apply_filters( 'rdtheme_blog_title', esc_html__( 'Blog', 'redchili' ) );
	}
} elseif ( is_archive() ) {
	$rdtheme_title = get_the_archive_title();
} else {
	$rdtheme_title = get_the_title();
}
?>
<?php if ( RDTheme::$has_banner == '1' || RDTheme::$has_banner == 'on' ): ?>
	<div class="inner-page-banner-area entry-banner">
		<div class="container">
			<div class="pagination-area">
				<h1><?php echo wp_kses_post( $rdtheme_title );?></h1>
				<?php if ( RDTheme::$has_breadcrumb == '1' || RDTheme::$has_breadcrumb == 'on' ): ?>
					<?php get_template_part( 'template-parts/content', 'breadcrumb' );?>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif; ?>