<?php
/**
 * Widget Class
 * This will generate the meta field for ShortCode generator post type
 *
 * @package WP_LOGO_SHOWCASE
 * @since   1.0
 * @author  RadiusTheme
 */

if (!class_exists('rtWLSWidget')):


    /**
     *
     */
    class rtWLSWidget extends WP_Widget
    {

        /**
         * Wp Logo Showcase widget setup
         */
        function __construct() {
            $widget_ops = array(
                'classname'   => 'widget_rt_wls',
                'description' => esc_html__('Display the Logo showcase.', 'wp-logo-showcase')
            );
            parent::__construct('widget_rt_wls', esc_html__('Wp Logo Showcase', 'wp-logo-showcase'), $widget_ops);

        }

        /**
         * display the widgets on the screen.
         */
        function widget($args, $instance) {
            extract($args);
            global $rtWLS;
            $id = (!empty($instance['id']) ? $instance['id'] : null);
            $rtWLS->print_html($before_widget);
            if (!empty($instance['title'])) {
                $rtWLS->print_html($args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title']);
            }
            if ($id) {
                echo do_shortcode('[logo-showcase id="' . $id . '"]');
            }
            $rtWLS->print_html($after_widget);
        }

        function form($instance) {
            global $rtWLS;
            $defaults = array(
                'title' => "Wp Logo Showcase",
                'id'    => null
            );
            $instance = wp_parse_args((array)$instance, $defaults);

            ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'wp-logo-showcase'); ?></label>
                <input type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       class="widefat"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                       value="<?php echo esc_attr($instance['title']); ?>"/></p>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('id')); ?>"><?php esc_html_e('Select Shortcode:', 'wp-logo-showcase'); ?></label>
                <select name="<?php echo esc_attr($this->get_field_name('id')); ?>"
                        id="<?php echo esc_attr($this->get_field_id('id')); ?>">
                    <option value=''><?php esc_html_e("Select One", "wp-logo-showcase") ?></option>
                    <?php
                    $scList = $rtWLS->getWlsShortCodeList();
                    if (!empty($scList)) {
                        foreach ($scList as $scId => $sc) {
                            $selected = ($instance['id'] == $scId ? "selected" : null);
                            echo "<option {$selected} value='" . esc_attr($scId) . "'>" . esc_html($sc) . "</option>";
                        }
                    }
                    ?>
                </select></p>
            <?php
        }

        public function update($new_instance, $old_instance) {

            $instance = array();
            $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
            $instance['id'] = (!empty($new_instance['id'])) ? (int)($new_instance['id']) : '';

            return $instance;
        }


    }


endif;
