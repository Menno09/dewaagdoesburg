<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class rtWLSSElementorWidget extends \Elementor\Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_enqueue_style('rt-wls');
        wp_enqueue_script( 'rt-actual-height-js');
        wp_enqueue_script( 'rt-slick');
        wp_enqueue_script( 'rt-images-load');
        wp_enqueue_script( 'rt-isotope');
        wp_enqueue_script( 'rt-wls');
    }

	public function get_name() {
		return 'wp-logo-showcase';
	}

	public function get_title() {
		return __( 'WP Logo Showcase', 'wp-logo-showcase' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function _register_controls() {
        global $rtWLS;
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Layout', 'wp-logo-showcase' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'wls_layout',
            [
                'type'    => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Layout', 'wp-logo-showcase' ),
                'options' => [
                    'grid-layout'       => esc_html__( 'Grid Layout', 'wp-logo-showcase' ),
                    'carousel-layout'   => esc_html__( 'Carousel Layout', 'wp-logo-showcase' ),
                    'isotope-layout'    => esc_html__( 'Isotope Layout', 'wp-logo-showcase' ),
                ],
                'default' => 'grid-layout',
            ]
        );

        $this->add_control(
            'wls_tooltip',
            [
                'label'     => esc_html__( 'ToolTip', 'wp-logo-showcase' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'On', 'wp-logo-showcase' ),
                'label_off' => esc_html__( 'Off', 'wp-logo-showcase' ),
                'default'   => 'no',
            ]
        );

        $this->add_control(
            'wls_box_highlight',
            [
                'label'     => esc_html__( 'Box Highlight', 'wp-logo-showcase' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'On', 'wp-logo-showcase' ),
                'label_off' => esc_html__( 'Off', 'wp-logo-showcase' ),
                'default'   => 'no',
            ]
        );

        $this->add_control(
            'wls_grayscale',
            [
                'label'     => esc_html__( 'Grayscale', 'wp-logo-showcase' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'On', 'wp-logo-showcase' ),
                'label_off' => esc_html__( 'Off', 'wp-logo-showcase' ),
                'default'   => 'no',
            ]
        );

        $this->add_control(
            'wls_link_type',
            [
                'type'    => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Link Type', 'wp-logo-showcase' ),
                'options' => [
                    'new_window' => esc_html__( "Open in new window", 'wp-logo-showcase' ),
                    'self'       => esc_html__( "Open in same window", 'wp-logo-showcase' ),
                    'no_link'    => esc_html__( "No link", 'wp-logo-showcase' ),
                ],
                'default' => 'new_window',
            ]
        );

        $this->add_control(
            'wls_items',
            [
                'type'      => Controls_Manager::SELECT2,
                'label'     => esc_html__( 'Show Fields', 'wp-logo-showcase' ),
                'options'   => $rtWLS->scLayoutItems(),
                'multiple'  => true,
                'default'   => ['logo', 'title', 'description'],
            ]
        );

        $this->add_control(
            'wls_nofollow',
            [
                'label'     => esc_html__( 'Nofollow', 'wp-logo-showcase' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'On', 'wp-logo-showcase' ),
                'label_off' => esc_html__( 'Off', 'wp-logo-showcase' ),
                'default'   => 'no',
            ]
        );

		$this->end_controls_section();

		// Responsive Column
        $this->start_controls_section(
            'sec_responsive',
            [
                'label'   => esc_html__( 'Number of Responsive Columns', 'wp-logo-showcase' ),
            ]
        );

        $this->add_control(
            'wls_desktop_column',
            [
                'type'    => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Desktop column', 'wp-logo-showcase' ),
                'options'     => $rtWLS->scColumns(),
                'default' => 4,
            ]
        );

        $this->add_control(
            'wls_tab_column',
            [
                'type'      => Controls_Manager::SELECT2,
                'label'     => esc_html__( 'Tab column', 'wp-logo-showcase' ),
                'options'   => $rtWLS->scColumns(),
                'default'   => 2,
            ]
        );

        $this->add_control(
            'wls_mobile_column',
            [
                'type'      => Controls_Manager::SELECT2,
                'label'     => esc_html__( 'Mobile column', 'wp-logo-showcase' ),
                'options'   => $rtWLS->scColumns(),
                'default'   => 1,
            ]
        );

        $this->end_controls_section();

        // Carousel Settings
        $this->start_controls_section(
            'sec_carousel',
            [
                'label'   => esc_html__( 'Carousel Settings', 'wp-logo-showcase' ),
                'condition' => [
                    'wls_layout' => 'carousel-layout'
                ]
            ]
        );

        $this->add_control(
            'wls_carousel_slidesToScroll',
            [
                'type'    => Controls_Manager::NUMBER,
                'label'   => esc_html__( 'Slides To Scroll', 'wp-logo-showcase' ),
                'default' => 3,
            ]
        );

        $this->add_control(
            'wls_carousel_speed',
            [
                'type'    => Controls_Manager::NUMBER,
                'label'   => esc_html__( 'Speed', 'wp-logo-showcase' ),
                'default' => 2000,
            ]
        );

        $this->add_control(
            'wls_carousel_options',
            [
                'type'    => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Carousel Options', 'wp-logo-showcase' ),
                'options' => $rtWLS->carouselProperty(),
                'multiple'  => true,
                "default"     => ['autoplay', 'arrows', 'dots', 'responsive', 'infinite'],
            ]
        );

        $this->end_controls_section();

        // Filter Options
        $this->start_controls_section(
            'sec_filtering',
            [
                'label'   => esc_html__( 'Filtering Options', 'wp-logo-showcase' ),
            ]
        );

        $this->add_control(
            'wls_post__in',
            [
                'type'    => Controls_Manager::TEXT,
                'label'   => esc_html__( 'Include only', 'wp-logo-showcase' ),
                "description" => esc_html__( 'List of post IDs to show (comma-separated values, for example: 1,2,3)',
                    'wp-logo-showcase' ),
            ]
        );

        $this->add_control(
            'wls_post__not_in',
            [
                'type'    => Controls_Manager::TEXT,
                'label'   => esc_html__( 'Exclude', 'wp-logo-showcase' ),
                "description" => esc_html__( 'List of post IDs to skip (comma-separated values, for example: 1,2,3)',
                    'wp-logo-showcase' ),
            ]
        );

        $this->add_control(
            'wls_limit',
            [
                'type'    => Controls_Manager::NUMBER,
                'label'   => esc_html__( 'Limit', 'wp-logo-showcase' ),
                "description" => esc_html__( 'The number of posts to show. Set empty to show all found posts.',
                    'wp-logo-showcase' )
            ]
        );

        $this->add_control(
            'wls_categories',
            [
                'type'    => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Categories', 'wp-logo-showcase' ),
                "description" => esc_html__( 'Select the category you want to filter, Leave it blank for All category',
                    'wp-logo-showcase' ),
                "options"     => $rtWLS->getAllWlsCategoryList(),
                'multiple'  => true,
            ]
        );

        $this->add_control(
            'wls_order_by',
            [
                'type'    => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Order By', 'wp-logo-showcase' ),
                'options'   => $rtWLS->scOrderBy(),
                'default'   => 'date',
            ]
        );

        $this->add_control(
            'wls_order',
            [
                'type'    => Controls_Manager::SELECT2,
                'label'   => esc_html__( 'Order', 'wp-logo-showcase' ),
                'options'   => $rtWLS->scOrder(),
                'default'   => 'DESC',
            ]
        );

        // Color Tab

        $this->end_controls_section();

        $this->start_controls_section(
            'sec_color',
            [
                'label' => esc_html__( 'General', 'wp-logo-showcase' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'primary_color',
            [
                'type'  => Controls_Manager::COLOR,
                'label' => esc_html__('Primary Color', 'wp-logo-showcase'),
                'selectors' => [
                    'body > .rt-tooltip' => 'background-color: {{VALUE}}',
                    'body > .rt-tooltip .rt-tooltip-bottom:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'wls_gutter',
            [
                'label'     => __( 'Gutter / Padding', 'wp-logo-showcase' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 10,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 30,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rt-wpls [class*="rt-col-"]' => 'padding: 0 {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Title Style
        $this->start_controls_section(
            'sec_title_style',
            [
                'label' => esc_html__( 'Title', 'wp-logo-showcase' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'wls_items' => 'title'
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'type'  => Controls_Manager::COLOR,
                'label' => esc_html__('Color', 'wp-logo-showcase'),
                'selectors' => [
                    '{{WRAPPER}} .single-logo h3' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .single-logo h3 a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'type'  => Controls_Manager::COLOR,
                'label' => esc_html__('Hover Color', 'wp-logo-showcase'),
                'selectors' => [
                    '{{WRAPPER}} .single-logo h3 a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__('Typography', 'wp-logo-showcase'),
                'selector' => '{{WRAPPER}} .single-logo h3',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __( 'Padding', 'wp-logo-showcase' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .single-logo h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Description Style
        $this->start_controls_section(
            'sec_desc_style',
            [
                'label' => esc_html__( 'Description', 'wp-logo-showcase' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'wls_items' => 'description'
                ]
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'type'  => Controls_Manager::COLOR,
                'label' => esc_html__('Color', 'wp-logo-showcase'),
                'selectors' => [
                    '{{WRAPPER}} .logo-description p' => 'color: {{VALUE}}'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typo',
                'label' => esc_html__('Typography', 'wp-logo-showcase'),
                'selector' => '{{WRAPPER}} .logo-description p',
            ]
        );

        $this->end_controls_section();

        // Button Style
        $this->start_controls_section(
            'sec_btn_style',
            [
                'label' => esc_html__( 'Button', 'wp-logo-showcase' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'wls_layout' => 'isotope-layout'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'label' => esc_html__('Typography', 'wp-logo-showcase'),
                'selector' => '{{WRAPPER}} .logo-description p',
            ]
        );

        $this->start_controls_tabs( 'cat_box_style' );

        // Normal tab.
        $this->start_controls_tab(
            'box_style_normal',
            [
                'label'     => __( 'Normal', 'wp-logo-showcase' ),
            ]
        );

        // Normal background color.
        $this->add_control(
            'box_style_normal_bg_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => __( 'Background Color', 'wp-logo-showcase' ),
                'separator' => '',
                'selectors' => [
                    '{{WRAPPER}} .rt-wpls button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Normal Text color.
        $this->add_control(
            'box_style_normal_text_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => __( 'Text Color', 'wp-logo-showcase' ),
                'separator' => '',
                'selectors' => [
                    '{{WRAPPER}} .rt-wpls button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover tab.
        $this->start_controls_tab(
            'box_style_hover',
            [
                'label'     => __( 'Hover', 'wp-logo-showcase' ),
            ]
        );

        // Hover background color.
        $this->add_control(
            'box_style_hover_bg_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => __( 'Background Color', 'wp-logo-showcase' ),
                'separator' => '',
                'selectors' => [
                    '{{WRAPPER}} .rt-wpls button:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .rt-wpls button.selected' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Hover Text color.
        $this->add_control(
            'box_style_hover_title_color',
            [
                'type'      => Controls_Manager::COLOR,
                'label'     => __( 'Text Color', 'wp-logo-showcase' ),
                'separator' => '',
                'selectors' => [
                    '{{WRAPPER}} .rt-wpls button:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rt-wpls button.selected' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Box Style
        $this->start_controls_section(
            'sec_box_style',
            [
                'label' => esc_html__( 'Box', 'wp-logo-showcase' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __( 'Box Padding', 'wp-logo-showcase' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .rt-wpls .single-logo .single-logo-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'wls_item_gap',
            [
                'label'     => __( 'Box Item Gap', 'wp-logo-showcase' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 0,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rt-wpls .single-logo' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'box_bg',
            [
                'type'  => Controls_Manager::COLOR,
                'label' => esc_html__('Box Background', 'wp-logo-showcase'),
                'selectors' => [
                    '{{WRAPPER}} .rt-wpls .single-logo .single-logo-container' => 'background: {{VALUE}}'
                ],
            ]
        );

        $this->end_controls_section();

	}

	protected function render() {
        global $rtWLS;
        $settings       = $this->get_settings_for_display();
		$arg = [];
		$html = '';

        $layout             = $settings['wls_layout'];
        $isIsotope = preg_match('/isotope/', $layout);
        $isCarousel = preg_match('/carousel/', $layout);
        $colDesk            = $settings['wls_desktop_column'];
        $colDeskSlider = $colDesk;
        $colTab             = $settings['wls_tab_column'];
        $colMobile          = $settings['wls_mobile_column'];
        $arg['linkType']    = $settings['wls_link_type'];
        $arg['nofollow']    = $settings['wls_nofollow'] == 'yes' ? true : false;

        /* Argument create */
        $args = [];
        $itemIdsArgs = [];
        $args['post_type'] = $rtWLS->post_type;

        // Common filter
        /* post__in */
        $post__in = $settings['wls_post__in'];
        if ($post__in) {
            $post__in = explode(',', $post__in);
            $args['post__in'] = $post__in;
        }

        /* post__not_in */
        $post__not_in = $settings['wls_post__not_in'];
        if ($post__not_in) {
            $post__not_in = explode(',', $post__not_in);
            $args['post__not_in'] = $post__not_in;
        }

        /* LIMIT */
        $limit = empty($settings['wls_limit']) ? -1 : $settings['wls_limit'];
        $args['posts_per_page'] = $limit;

        // Taxonomy
        $taxQ = array();
        $cats = (!empty($settings['wls_categories']) ? $settings['wls_categories'] : array());
        if (!empty($cats)) {
            $taxQ[] = array(
                'taxonomy' => $rtWLS->taxonomy['category'],
                'field'    => 'term_id',
                'terms'    => $cats
            );
        }

        if (!empty($taxQ)) {
            $args['tax_query'] = $itemIdsArgs['tax_query'] = $taxQ;
        }

        // Order
        $order_by = (!empty($settings['wls_order_by']) ? $settings['wls_order_by'] : null);
        $order = (!empty($settings['wls_order']) ? $settings['wls_order'] : null);
        if ($order) {
            $args['order'] = $order;
        }
        if ($order_by) {
            $args['orderby'] = $order_by;
        }

        $containerDataAttr = " data-desktop-col='{$colDesk}'  data-tab-col='{$colTab}'  data-mobile-col='{$colMobile}'";
        $deskItem = $colDesk;
        $tabItem = $colTab;
        $mobileItem = $colMobile;
        $colDesk = $colDesk == 5 ? '24' : round(12 / $colDesk);
        $colTab = $colTab == 5 ? '24' : round(12 / $colTab);
        $colMobile = $colMobile == 5 ? '24' : round(12 / $colMobile);
        $arg['grid'] = "rt-col-md-{$colDesk} rt-col-sm-{$colTab} rt-col-xs-{$colMobile}";
        $arg['class'] = 'equal-height';

        $arg['styleClass'] = null;
        $arg['styleClass'] .= $settings['wls_tooltip'] == 'yes' ? ' wls-tooltip' : '';
        $arg['styleClass'] .= $settings['wls_box_highlight'] == 'yes' ? ' wls-boxhighlight' : '';
        $arg['styleClass'] .= $settings['wls_grayscale'] == 'yes' ? ' wls-grayscale' : '';

        if ($isIsotope) {
            $arg['class'] .= ' isotope-item';
        }

        $items = !empty($settings['wls_items']) ? $settings['wls_items'] : [];

        if (count($items) == 3) {
            $arg['items'][0] = 'logo';
            $arg['items'][1] = 'title';
            $arg['items'][2] = 'description';
        } elseif(in_array('title', $items) && in_array('logo', $items)) {
            $arg['items'][0] = 'logo';
            $arg['items'][1] = 'title';
        } else {
            $arg['items'] = $items;
        }

        $logoQuery = new WP_Query($args);

        if ($logoQuery->have_posts()) {
            $rand = mt_rand();
            $carouselClass = null;
            $isotopeClass = $containerClass = null;
            $carouselDir = $carouselAttribute = null;

            if ($isCarousel) {
                $carouselClass = "wpls-carousel ";
                $containerClass = "rt-loading";
                $slidesToScroll = (!empty($settings['wls_carousel_slidesToScroll']) ? (int)$settings['wls_carousel_slidesToScroll'] : 3);
                $autoPlaySpeed = (!empty($settings['wls_carousel_auto_play_speed']) ? (int)$settings['wls_carousel_auto_play_speed'] : 3000);
                $speed = (!empty($settings['wls_carousel_speed']) ? (int)$settings['wls_carousel_speed'] : 2000);
                $options = array();
                if (!empty($settings['wls_carousel_options']) && is_array($settings['wls_carousel_options'])) {
                    $options = $settings['wls_carousel_options'];
                }
                $deskItem = $colDeskSlider ? $colDeskSlider : $deskItem;
                $carouselAttribute = "data-slick='{
                        \"slidesToShow\": {$deskItem},
                        \"slidesToShowTab\": {$tabItem},
                        \"slidesToShowMobile\": {$mobileItem},
                        \"slidesToScroll\": {$slidesToScroll},
                        \"speed\": {$speed},
                        \"autoplaySpeed\": {$autoPlaySpeed},
                        \"dots\": " . (in_array('dots', $options) ? 'true' : 'false') . ",
                        \"arrows\": " . (in_array('arrows', $options) ? 'true' : 'false') . ",
                        \"infinite\": " . (in_array('infinite', $options) ? 'true' : 'false') . ",
                        \"lazyLoad\": " . (in_array('lazyLoad', $options) ? '"progressive"' : '"ondemand"') . ",
                        \"pauseOnHover\": " . (in_array('pauseOnHover', $options) ? 'true' : 'false') . ",
                        \"autoplay\": " . (in_array('autoplay', $options) ? 'true' : 'false') . ",
                        \"centerMode\": " . (in_array('centerMode', $options) ? 'true' : 'false') . ",
                        \"adaptiveHeight\": " . (in_array('adaptiveHeight', $options) ? 'true' : 'false') . ",
                        \"rtl\": " . (in_array('rtl', $options) ? 'true' : 'false') . "
                        }'";

                $carouselDir = (in_array('rtl', $options) ? ' dir="rtl"' : null);
            }

            if ($isIsotope) {
                $isotopeClass = "wpls-isotope";
            }


            $containerID = "rt-container-" . $rand;

            $pluginOptions = get_option($rtWLS->options['settings']);
            $imgReSize = (!empty($pluginOptions['image_resize']) ? true : false);
            $imgSize = array();
            if ($imgReSize) {
                $imgSize['width'] = isset($pluginOptions['image_width']) ? (int)($pluginOptions['image_width']) : 180;
                $imgSize['height'] = isset($pluginOptions['image_height']) ? (int)($pluginOptions['image_height']) : 90;
                $imgSize['crop'] = isset($pluginOptions['image_crop']) ? ($pluginOptions['image_crop'] ? true : false) : false;
            }

            $html .= "<div class='rt-container-fluid rt-wpls {$containerClass}' id='{$containerID}' {$containerDataAttr}>";
            $html .= "<div class='rt-row {$layout} {$carouselClass}' {$carouselAttribute} {$carouselDir}>";

            if ($isIsotope) {
                $terms = get_terms($rtWLS->taxonomy['category'], array(
                    'hide_empty' => true,
                ));
                $html .= '<div class="button-group filter-button-group option-set wls-isotope-button">
											<button data-filter="*" class="selected">' . esc_html__('Show all',
                        'wp-logo-showcase') . '</button>';
                if (!empty($terms) && !is_wp_error($terms)) {
                    foreach ($terms as $term) {
                        if (empty($cats)) {
                            $html .= "<button data-filter='.{$term->slug}'>" . $term->name . "</button>";
                        } else {
                            if (in_array($term->term_id, $cats)) {
                                $html .= "<button data-filter='.{$term->slug}'>" . $term->name . "</button>";
                            }
                        }
                    }
                }
                $html .= '</div>';
                $html .= "<div class='{$isotopeClass}' id='{$isotopeClass}-{$rand}'>";
            }

            while ($logoQuery->have_posts()) : $logoQuery->the_post();

                /* Argument for single member */
                $arg['pID'] = $pID = get_the_ID();
                $arg['title'] = get_the_title();
                $arg['url'] = get_post_meta($pID, '_wls_site_url', true);
                $arg['description'] = get_post_meta($pID, '_wls_logo_description', true);
                $arg['alt_text'] = get_post_meta($pID, '_wls_logo_alt_text', true);
                $arg['img_src'] = get_post_meta($pID, '_wls_logo_img_url', true);
                $imgClass = 'wls-logo';

                if (empty($arg['img_src'])) {
                    if (has_post_thumbnail()) {
                        $img = wp_get_attachment_image(get_post_thumbnail_id(), 'full', '', ['class' => $imgClass, 'title' => $arg['title']]);
                        $imgS = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        $arg['img_src'] = $img;
                        if ($imgReSize && !empty($imgSize)) {
                            $c = (!empty($imgSize['crop']) ? true : false);
                            $cropImg = $rtWLS->rtImageReSize($imgS[0], $imgSize['width'], $imgSize['height'], $c);
                            if ($cropImg) {
                                $arg['img_src'] = "<img title='{$arg['title']}' src='{$cropImg}' width='{$imgSize['width']}' height='{$imgSize['height']}' class='{$imgClass}' alt='{$arg['alt_text']}'>";
                            }
                        }
                    }
                }

                if (!empty($arg['img_src'])) {
                    $html .= $rtWLS->render('layouts/' . $layout, $arg, true);
                }

            endwhile;
            wp_reset_postdata();

            if ($isIsotope) {
                $html .= '</div>'; // end isotope item holder
            }

            $html .= '</div>'; //end row
            $html .= '</div>';// end container
        } else {
            $html .= "<p>" . esc_html__('No logo found', 'wp-logo-showcase') . "</p>";
        }

        echo $html;

	}
}