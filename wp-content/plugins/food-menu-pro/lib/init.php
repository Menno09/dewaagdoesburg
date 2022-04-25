<?php

if (!class_exists('FMP')) {

    class FMP {
        public $options;

        protected static $_instance;

        function __construct() {
            if ($this->isTLPFMActive()) {

                $this->options = array(
                    'version'           => FOOD_MENU_PRO_VERSION,
                    'installed_version' => 'fmp-installed-version'
                );

                TLPFoodMenu()->taxonomies['tag'] = TLPFoodMenu()->post_type . '-tag';
                TLPFoodMenu()->taxonomies['ingredient'] = TLPFoodMenu()->post_type . '-ingredient';
                TLPFoodMenu()->taxonomies['nutrition'] = TLPFoodMenu()->post_type . '-nutrition';
                TLPFoodMenu()->taxonomies['unit'] = TLPFoodMenu()->post_type . '-unit';

                $this->functionsPath = $this->plugin_path() . '/functions/';
                $this->classesPath = $this->plugin_path() . '/classes/';
                $this->modelsPath = $this->plugin_path() . '/models/';
                $this->includePath = $this->plugin_path() . '/includes/';
                $this->templatesPath = $this->plugin_path() . '/templates/';

                $this->assetsUrl = FOOD_MENU_PRO_PLUGIN_URL . '/assets/';
                $this->fmpLoadModel($this->modelsPath);
                $this->fmpLoadFunctions($this->functionsPath);
                $this->fmpLoadClass($this->classesPath);

                add_filter('tlp_fm_template_path', [$this, 'plugin_template_path']);

            } else {

                add_action('admin_notices', [ $this, 'requirement_notice' ]);

            }

        }

        function isTLPFMActive() {
            return class_exists('TLPFoodMenu') ? true : false;
        }

        public function requirement_notice() {

            $class = 'notice notice-error';

            $text = esc_html__('Food Menu', 'food-menu-pro');
            $link = esc_url(
                add_query_arg(
                    array(
                        'tab' => 'plugin-information',
                        'plugin' => 'tlp-food-menu',
                        'TB_iframe' => 'true',
                        'width' => '640',
                        'height' => '500',
                    ), admin_url('plugin-install.php')
                )
            );

            printf('<div class="%1$s"><p>Food Menu Pro is not working because you need to install and activate <a class="thickbox open-plugin-details-modal" href="%2$s"><strong>%3$s</strong></a> plugin to get pro features.</p></div>', $class, $link, $text);

        }

        /**
         * Get the plugin path.
         *
         * @return string
         */
        public function plugin_path() {
            return untrailingslashit(plugin_dir_path(__FILE__));
        }

        public function plugin_template_path() {
            return $this->plugin_path() . '/templates/';
        }

        public static function instance() {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function fmpLoadClass($dir) {
            if (!file_exists($dir)) {
                return;
            }

            $classes = array();

            foreach (scandir($dir) as $item) {
                if (preg_match("/.php$/i", $item)) {
                    require_once($dir . $item);
                    $className = str_replace(".php", "", $item);
                    $classes[] = new $className;
                }
            }

            if ($classes) {
                foreach ($classes as $class) {
                    $this->objects[] = $class;
                }
            }
        }

        /**
         * Load Model class
         *
         * @param $dir
         */
        function fmpLoadModel($dir) {
            if (!file_exists($dir)) {
                return;
            }
            foreach (scandir($dir) as $item) {
                if (preg_match("/.php$/i", $item)) {
                    require_once($dir . $item);
                }
            }
        }

        function fmpLoadWidget($dir) {
            if (!file_exists($dir)) {
                return;
            }
            foreach (scandir($dir) as $item) {
                if (preg_match("/.php$/i", $item)) {
                    require_once($dir . $item);
                    $class = str_replace(".php", "", $item);

                    if (method_exists($class, 'register_widget')) {
                        $caller = new $class;
                        $caller->register_widget();
                    } else {
                        register_widget($class);
                    }
                }
            }
        }

        function fmpLoadFunctions($dir) {
            if (!file_exists($dir)) {
                return;
            }

            foreach (scandir($dir) as $item) {
                if (preg_match("/.php$/i", $item)) {
                    require_once($dir . $item);
                }
            }

        }

        function render($template_name, $args = array(), $return = false) {

            $template_name = str_replace(".", "/", $template_name);

            if (!empty($args) && is_array($args)) {
                extract($args);
            }

            $template = array(
                "food-menu-pro/{$template_name}.php",
                "tlp-food-menu/{$template_name}.php",
                $template_name . ".php"
            );

            if (!$template_file = locate_template($template)) {
                $template_file = $this->plugin_template_path() . $template_name . '.php';
            }

            if (!file_exists($template_file)) {
                _doing_it_wrong(__FUNCTION__, sprintf('<code>%s</code> does not exist.', $template_file), '1.7.0');

                return;
            }
            if ($return) {

                ob_start();
                include $template_file;

                return ob_get_clean();
            } else {

                include $template_file;
            }
        }

        function renderView($viewName, $args = array(), $return = false) {

            $viewName = str_replace(".", "/", $viewName);

            if (!empty($args) && is_array($args)) {
                extract($args);
            }
        }


        /**
         * Dynamicaly call any  method from models class
         * by pluginFramework instance
         */
        function __call($name, $args) {
            if (!is_array($this->objects)) {
                return;
            }
            foreach ($this->objects as $object) {
                if (method_exists($object, $name)) {
                    $count = count($args);
                    if ($count == 0) {
                        return $object->$name();
                    } elseif ($count == 1) {
                        return $object->$name($args[0]);
                    } elseif ($count == 2) {
                        return $object->$name($args[0], $args[1]);
                    } elseif ($count == 3) {
                        return $object->$name($args[0], $args[1], $args[2]);
                    } elseif ($count == 4) {
                        return $object->$name($args[0], $args[1], $args[2], $args[3]);
                    } elseif ($count == 5) {
                        return $object->$name($args[0], $args[1], $args[2], $args[3], $args[4]);
                    } elseif ($count == 6) {
                        return $object->$name($args[0], $args[1], $args[2], $args[3], $args[4], $args[5]);
                    }
                }
            }
        }
    }


    function FMP() {
        return FMP::instance();
    }

    add_action('plugins_loaded', 'FMP', 20);
}