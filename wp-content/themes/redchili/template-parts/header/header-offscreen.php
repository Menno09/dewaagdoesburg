<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */ 
$nav_menu_args   = RDTheme_Helper::nav_menu_args();
$rdtheme_logo  =  empty( RDTheme::$options['logo']['id'] ) ? '<img width="489" height="121" class="logo-small" alt="'.get_bloginfo( 'name' ).'" src="'.RDTHEME_IMG_URL . 'logo-dark.png'.'">' :  wp_get_attachment_image(RDTheme::$options['logo']['id'],'full',"", array( "class" => "logo-small" ));

?>
 
<div class="rt-header-menu mean-container" id="meanmenu">
    <div class="mean-bar">
    	<a href="<?php echo esc_url(home_url('/'));?>" alt="<?php echo esc_attr( get_bloginfo( 'title' ) );?>"><?php echo $rdtheme_logo;?></a>
        <span class="sidebarBtn ">
            <span class="fa fa-bars">
            </span>
        </span>

    </div>

    <div class="rt-slide-nav">
        <div class="offscreen-navigation">
            <?php wp_nav_menu( $nav_menu_args );?>
        </div>
    </div>

</div>
