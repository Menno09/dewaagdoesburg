<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( );
global $FMP;
?>
<div class="fmp-container fmp-wrapper fmp-archive" data-desktop-col="2" data-tab-col="1" data-mobile-col="1">
    <div class="category-title">
        <h3 class="page-title"><?php echo single_cat_title( "", false ); ?></h3>
    </div>
	<?php
	$html     = null;
	$settings = get_option( FMP()->options['settings'] );
	$colClass = "fmp-col-md-6 fmp-col-lg-6 fmp-col-sm-12 even-grid-item paddingl0";
	if ( have_posts() ) {
		$html  .= '<div class="fmp-row fmp-even">';
		$count = 0;
		while ( have_posts() ) : the_post();
			$html .= '<div class="' . esc_attr( $colClass ) . '">';
                $html .= '<div class="fmp-single-item-inner">';
                    $html .= '<div class="image-area fmp-col-md-5 fmp-col-lg-5 fmp-col-sm-6 paddingl0 "><a href="' . get_permalink() . '" title="' . get_the_title() . '">';
                    if ( has_post_thumbnail() ) {
                        $html .= get_the_post_thumbnail( get_the_ID(), 'medium' );
                    } else {
                        $html .= "<img src='" . FMP()->assetsUrl . 'images/demo-100x100.png' . "' alt='" . get_the_title() . "' />";
                    }
                    $html   .= '</a></div>';
                    $html   .= '<div class="fmp-col-md-7 fmp-col-lg-7 fmp-col-sm-6 padding0">';
                        $html   .= '<div class="title">';
                            $html   .= '<h3><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3>';
                            $gTotal = FMP()->fmpHtmlPrice(get_the_ID());
                            $html   .= '<span class="price">' . $gTotal . '</span>';
                        $html   .= '</div>';
                        $html   .= '<p>' . FMP()->string_limit_words( get_the_content(), 5 ) . '</p>';
                    $html .= '</div>';
                $html .= '</div>';
			$html .= '</div>';
		endwhile;
		$html .= '</div>';
	} else {
		$html .= "<p>" . __( 'No food found.', 'redchili' ) . "</p>";
	}
	echo wp_kses_post( $html );
	?>
</div>
<?php get_footer(); ?>