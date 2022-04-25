<?php
$class = vc_shortcode_custom_css_class( $css );
$subtitle_style = $subtitle_color ? "color:{$subtitle_color};" : '';
?>
<div class="rt-title-1 <?php echo esc_attr( $class );?>" data-color="<?php echo esc_attr($subtitle_line_color); ?>">
	<h2 class="title" style="color:<?php echo esc_attr( $title_color );?>; font-size:<?php echo esc_attr( $rt_vc_font_size );?>px;"><?php echo esc_html( $title );?></h2>
	<div class="sub-title-holder">
		<span class="subtitle-line-lt" style="border-color:<?php echo esc_attr($subtitle_line_color); ?>;"></span>
		<span class="subtitle-color" style="font-size:<?php echo esc_attr($subtile_font_size); ?>px;<?php echo esc_attr( $subtitle_style ); ?>"><?php echo wp_kses_post( $subtitle );?></span>
		<span class="subtitle-line-rt" style="border-color:<?php echo esc_attr($subtitle_line_color); ?>;"></span>
	</div>	
</div>