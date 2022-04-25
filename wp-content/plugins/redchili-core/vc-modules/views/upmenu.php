<?php
$class = vc_shortcode_custom_css_class( $css );
?>
<?php if ( $upmenu_id ) { ?>
<script> window.upmenuSettings = { id: "<?php echo esc_html($upmenu_id); ?>" }; </script>
<script src="https://cdn.upmenu.com/media/upmenu-widget.js"></script>
<div id="upmenu-widget"></div>
<?php } ?>