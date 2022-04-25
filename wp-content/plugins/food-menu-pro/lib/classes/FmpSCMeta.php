<?php

if (!class_exists('FmpSCMeta')):
    /**
     *
     */
    class FmpSCMeta {

        function __construct() {
            add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
        }

        function admin_enqueue_scripts() {

            global $pagenow, $typenow;
            // validate page
            if (!in_array($pagenow, array('post.php', 'post-new.php', 'edit.php'))) {
                return;
            }
            if ($typenow != TLPFoodMenu()->shortCodePT) {
                return;
            }

            wp_enqueue_media();
            wp_deregister_script('fm-admin-preview');
            wp_dequeue_script('fm-admin-preview');
            // scripts
            wp_enqueue_script(array(
                'fmp-image-load',
                'fmp-actual-height',
                'fmp-owl-carousel',
                'fmp-isotope',
                'fmp-admin',
                'fmp-admin-sc',
                'fmp-admin-preview',
            ));

            // styles
            wp_enqueue_style(array(
                'fmp-owl-carousel',
                'fmp-isotope',
                'fmp-frontend',
                'fmp-admin',
                'fmp-admin-preview',
            ));

        }

    }
endif;