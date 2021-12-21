<?php

namespace Essential_Addons_Elementor\Elements;

// If this file is called directly, abort.
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Widget_Base;

class Interactive_Circle extends Widget_Base {
	public function get_name() {
		return 'eael-interactive-circle';
	}

	public function get_title() {
		return esc_html__( 'Interactive Circle', 'essential-addons-for-elementor-lite' );
	}

	public function get_icon() {
		return 'eaicon-interactive-circle';
	}

	public function get_categories() {
		return [ 'essential-addons-elementor' ];
	}

	public function get_keywords() {
		return [
			'interactive circle',
			'interactive tabs',
			'interactive infobox',
			'ea interactive circle',
			'ea interactive infobox',
			'ea interactive tabs',
			'circle',
			'ea circle',
			'ea',
			'essential addons',
		];
	}

	public function get_custom_help_url() {
		return 'https://essential-addons.com/elementor/docs/interactive-circle/';
	}

	protected function eael_interactive_circle_general() {
		/**
		 * Advance Tabs Settings
		 */
		$this->start_controls_section(
			'eael_section_interactive_circle_settings',
			[
				'label' => esc_html__( 'General', 'essential-addons-for-elementor-lite' ),
			]
		);
		$this->add_control(
			'eael_interactive_circle_preset',
			[
				'label'       => esc_html__( 'Preset', 'essential-addons-for-elementor-lite' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'eael-interactive-circle-preset-1',
				'label_block' => false,
				'options'     => [
					'eael-interactive-circle-preset-1' => esc_html__( 'Preset 1', 'essential-addons-for-elementor-lite' ),
					'eael-interactive-circle-preset-2' => esc_html__( 'Preset 2', 'essential-addons-for-elementor-lite' ),
					'eael-interactive-circle-preset-3' => esc_html__( 'Preset 3', 'essential-addons-for-elementor-lite' ),
					'eael-interactive-circle-preset-4' => esc_html__( 'Preset 4', 'essential-addons-for-elementor-lite' ),
				],
			]
		);

		$this->add_control(
			'eael_interactive_circle_btn_settings',
			[
				'label'     => esc_html__( 'Button', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'eael_interactive_circle_btn_icon_show',
			[
				'label'        => esc_html__( 'Show Icon', 'essential-addons-for-elementor-lite' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'eael_interactive_circle_btn_text_show',
			[
				'label'        => esc_html__( 'Show Text', 'essential-addons-for-elementor-lite' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'return_value' => 'yes',
			]
		);

		$this->end_controls_section();
	}

	protected function eael_interactive_circle_item() {
		/**
		 * Advance Tabs Content Settings
		 */
		$this->start_controls_section(
			'eael_section_interactive_circle_content_settings',
			[
				'label' => esc_html__( 'Content', 'essential-addons-for-elementor-lite' ),
			]
		);

		$this->add_control( 'eael_global_warning_text', [
			'type'            => Controls_Manager::RAW_HTML,
			'raw'             => __( '<strong>Circle Item limit max 8.</strong> If the item is more than 8 it will break the preset layout design.', 'essential-addons-for-elementor-lite' ),
			'content_classes' => 'eael-warning',
		] );

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'interactive_circle_tabs' );

		$repeater->start_controls_tab( 'interactive_circle_btn_tab', [ 'label' => __( 'Button', 'essential-addons-for-elementor-lite' ) ] );

		$repeater->add_control(
			'eael_interactive_circle_btn_icon',
			[
				'label'   => esc_html__( 'Icon', 'essential-addons-for-elementor-lite' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-home',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'eael_interactive_circle_btn_title',
			[
				'name'    => 'eael_interactive_circle_btn_title',
				'label'   => esc_html__( 'Short Title', 'essential-addons-for-elementor-lite' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title', 'essential-addons-for-elementor-lite' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'interactive_circle_content_tab', [ 'label' => __( 'Content', 'essential-addons-for-elementor-lite' ) ] );

		$repeater->add_control(
			'eael_interactive_circle_item_content',
			[
				'name'    => 'eael_interactive_circle_item_content',
				'label'   => esc_html__( 'Tab Content', 'essential-addons-for-elementor-lite' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'essential-addons-for-elementor-lite' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'interactive_circle_item_style_tab', [ 'label' => __( 'Style', 'essential-addons-for-elementor-lite' ) ] );

		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'eael_interactive_circle_tab_bgtype',
				'types'    => [ 'gradient','classic' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .eael-circle-wrapper:not(.eael-interactive-circle-preset-4) .eael-circle-info .eael-circle-inner {{CURRENT_ITEM}} .eael-circle-btn-icon, {{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-4 .eael-circle-info .eael-circle-inner {{CURRENT_ITEM}} .eael-circle-icon-shapes',
			]
		);

		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();

		$this->add_control(
			'eael_interactive_circle_item',
			[
				'type'        => Controls_Manager::REPEATER,
				'separator'   => 'before',
				'default'     => [
					[
						'eael_interactive_circle_btn_icon'            => [
							'value'   => 'fas fa-leaf',
							'library' => 'fa-solid',
						],
						'eael_interactive_circle_btn_title'           => esc_html__( 'Item 1', 'essential-addons-for-elementor-lite' ),
						'eael_interactive_circle_item_default_active' => __( 'active', 'essential-addons-for-elementor-lite' ),
						'eael_interactive_circle_item_content'        => esc_html__( 'Present your content in an attractive Circle layout item 1. You can highlight key information with click or hover effects and style it as per your preference.', 'essential-addons-for-elementor-lite' ),
					],
					[
						'eael_interactive_circle_btn_icon'     => [
							'value'   => 'fas fa-comment',
							'library' => 'fa-solid',
						],
						'eael_interactive_circle_btn_title'    => esc_html__( 'Item 2', 'essential-addons-for-elementor-lite' ),
						'eael_interactive_circle_item_content' => esc_html__( 'Present your content in an attractive Circle layout item 2. You can highlight key information with click or hover effects and style it as per your preference.', 'essential-addons-for-elementor-lite' ),
					],
					[
						'eael_interactive_circle_btn_icon'     => [
							'value'   => 'fas fa-map-marker-alt',
							'library' => 'fa-solid',
						],
						'eael_interactive_circle_btn_title'    => esc_html__( 'Item 3', 'essential-addons-for-elementor-lite' ),
						'eael_interactive_circle_item_content' => esc_html__( 'Present your content in an attractive Circle layout item 3. You can highlight key information with click or hover effects and style it as per your preference.', 'essential-addons-for-elementor-lite' ),
					],
					[
						'eael_interactive_circle_btn_icon'     => [
							'value'   => 'fas fa-rocket',
							'library' => 'fa-solid',
						],
						'eael_interactive_circle_btn_title'    => esc_html__( 'Item 4', 'essential-addons-for-elementor-lite' ),
						'eael_interactive_circle_item_content' => esc_html__( 'Present your content in an attractive Circle layout item 4. You can highlight key information with click or hover effects and style it as per your preference.', 'essential-addons-for-elementor-lite' ),
					],
					[
						'eael_interactive_circle_btn_icon'     => [
							'value'   => 'fas fa-hourglass-half',
							'library' => 'fa-solid',
						],
						'eael_interactive_circle_btn_title'    => esc_html__( 'Item 5', 'essential-addons-for-elementor-lite' ),
						'eael_interactive_circle_item_content' => esc_html__( 'Present your content in an attractive Circle layout item 5. You can highlight key information with click or hover effects and style it as per your preference.', 'essential-addons-for-elementor-lite' ),
					],
					[
						'eael_interactive_circle_btn_icon'     => [
							'value'   => 'fas fa-tag',
							'library' => 'fa-solid',
						],
						'eael_interactive_circle_btn_title'    => esc_html__( 'Item 6', 'essential-addons-for-elementor-lite' ),
						'eael_interactive_circle_item_content' => esc_html__( 'Present your content in an attractive Circle layout item 6. You can highlight key information with click or hover effects and style it as per your preference.', 'essential-addons-for-elementor-lite' ),
					],
				],
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{eael_interactive_circle_btn_title}}',
			]
		);
		$this->end_controls_section();
	}

	protected function eael_interactive_circle_additional() {
		$this->start_controls_section(
			'eael_section_interactive_circle_additional',
			[
				'label' => esc_html__( 'Additional Settings', 'essential-addons-for-elementor-lite' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eael_interactive_circle_event',
			[
				'label'       => esc_html__( 'Mouse Event', 'essential-addons-for-elementor-lite' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'eael-interactive-circle-event-click',
				'label_block' => false,
				'options'     => [
					'eael-interactive-circle-event-click' => esc_html__( 'Click', 'essential-addons-for-elementor-lite' ),
					'eael-interactive-circle-event-hover' => esc_html__( 'Hover', 'essential-addons-for-elementor-lite' ),
				],
			]
		);

		$this->add_control(
			'eael_interactive_circle_animation',
			[
				'label'       => esc_html__( 'Animation', 'essential-addons-for-elementor-lite' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'eael-interactive-circle-animation-0',
				'label_block' => false,
				'options'     => [
					'eael-interactive-circle-animation-0' => esc_html__( 'None', 'essential-addons-for-elementor-lite' ),
					'eael-interactive-circle-animation-1' => esc_html__( 'Bounce In', 'essential-addons-for-elementor-lite' ),
					'eael-interactive-circle-animation-2' => esc_html__( 'Rotate', 'essential-addons-for-elementor-lite' ),
					'eael-interactive-circle-animation-3' => esc_html__( 'Spinning', 'essential-addons-for-elementor-lite' ),
				],
			]
		);
		$this->end_controls_section();
	}

	protected function eael_interactive_circle_general_style() {
		/**
		 * -------------------------------------------
		 * Tab Style Advance Tabs Generel Style
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'eael_section_interactive_circle_style_settings',
			[
				'label' => esc_html__( 'General', 'essential-addons-for-elementor-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'eael_interactive_circle_width',
			[
				'label'      => __( 'Circle Width', 'essential-addons-for-elementor-lite' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .eael-circle-inner'                                         => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eael-interactive-circle-preset-2 .eael-circle-inner'       => 'width: {{SIZE}}{{UNIT}}; height: calc({{SIZE}}{{UNIT}} / 2);',
					'{{WRAPPER}} .eael-interactive-circle-preset-2 .eael-circle-content'     => 'height: calc({{SIZE}}{{UNIT}} / 2)!important;',
					'{{WRAPPER}} .eael-interactive-circle-preset-2 .eael-circle-btn-content' => 'height: calc({{SIZE}}{{UNIT}} / 2)!important;',
				],
			]
		);

		$this->add_responsive_control(
			'eael_interactive_circle_padding',
			[
				'label'      => esc_html__( 'Padding', 'essential-addons-for-elementor-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .eael-circle-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'eael_interactive_circle_margin',
			[
				'label'      => esc_html__( 'Margin', 'essential-addons-for-elementor-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .eael-circle-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'eael_interactive_circle_border',
				'label'    => esc_html__( 'Border', 'essential-addons-for-elementor-lite' ),
				'selector' => '{{WRAPPER}} .eael-circle-inner',
				'exclude' => [ 'color' ],
			]
		);

		$this->add_control(
			'eael_interactive_circle_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-circle-inner' => 'border-color: {{VALUE}}!important;',
				],
			]
		);

		$this->add_responsive_control(
			'eael_interactive_circle_connectors',
			[
				'label'     => esc_html__( 'Connectors', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'eael_interactive_circle_preset' => 'eael-interactive-circle-preset-3'
				],
			]
		);
		$this->add_control(
			'eael_interactive_circle_connector_color',
			[
				'label'     => esc_html__( 'Color', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-shape-1, {{WRAPPER}} .eael-shape-2' => 'background: {{VALUE}}!important;',
				],
				'condition' => [
					'eael_interactive_circle_preset' => 'eael-interactive-circle-preset-3'
				],
			]
		);

		$this->end_controls_section();
	}

	protected function eael_interactive_circle_button_style() {
		$this->start_controls_section(
			'eael_section_interactive_circle_tab_style_settings',
			[
				'label' => esc_html__( 'Item', 'essential-addons-for-elementor-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'eael_interactive_circle_btn_typo',
				'selector' => '{{WRAPPER}} .eael-circle-btn-txt',
			]
		);
		$this->add_responsive_control(
			'eael_interactive_circle_btn_width',
			[
				'label'      => __( 'Width', 'essential-addons-for-elementor-lite' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .eael-circle-btn' => 'width: {{SIZE}}px!important; height: {{SIZE}}px!important;',
				],

			]
		);
		$this->add_responsive_control(
			'eael_interactive_circle_btn_icon_size',
			[
				'label'      => __( 'Icon Size', 'essential-addons-for-elementor-lite' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 16,
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .eael-circle-btn-icon i'   => 'font-size: {{SIZE}}{{UNIT}}!important;',
					'{{WRAPPER}} .eael-circle-btn-icon svg' => 'width: {{SIZE}}{{UNIT}}!important; height: {{SIZE}}{{UNIT}}!important; min-width: {{SIZE}}{{UNIT}}!important; min-height: {{SIZE}}{{UNIT}}!important;',
				],
			]
		);

		$this->start_controls_tabs( 'eael_interactive_circle_header_tabs' );
		// Normal State Tab
		$this->start_controls_tab( 'eael_interactive_circle_header_normal', [ 'label' => esc_html__( 'Normal', 'essential-addons-for-elementor-lite' ) ] );
		$this->add_control(
			'eael_interactive_circle_tab_color',
			[
				'label'     => esc_html__( 'Background Color', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-1 .eael-circle-btn .eael-circle-btn-icon, {{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-2 .eael-circle-btn .eael-circle-btn-icon'     => 'background-color: {{VALUE}}!important;',
					'{{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-3 .eael-circle-btn .eael-circle-icon-inner, {{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-4 .eael-circle-btn .eael-circle-icon-inner' => 'background-color: {{VALUE}}!important;',
				],
			]
		);
		$this->add_control(
			'eael_interactive_circle_tab_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-circle-btn .eael-circle-btn-txt' => 'color: {{VALUE}}!important;',
				],
			]
		);
		$this->add_control(
			'eael_interactive_circle_tab_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::COLOR,
				//			    'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .eael-circle-btn i'   => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .eael-circle-btn svg' => 'fill: {{VALUE}}!important;',
				],
				'condition' => [
					'eael_interactive_circle_btn_icon_show' => 'yes'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'eael_interactive_circle_btn_border',
				'label'    => esc_html__( 'Border', 'essential-addons-for-elementor-lite' ),
				'selector' => '{{WRAPPER}} .eael-circle-wrapper .eael-circle-info .eael-circle-inner .eael-circle-item .eael-circle-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'eael_interactive_circle_btn_shadow',
				'selector' => '{{WRAPPER}} .eael-circle-wrapper .eael-circle-info .eael-circle-inner .eael-circle-item .eael-circle-btn',
			]
		);

		$this->end_controls_tab();
		// Hover State Tab
		$this->start_controls_tab( 'eael_interactive_circle_header_hover', [ 'label' => esc_html__( 'Hover', 'essential-addons-for-elementor-lite' ) ] );
		$this->add_control(
			'eael_interactive_circle_tab_color_hover',
			[
				'label'     => esc_html__( 'Background Color', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-1 .eael-circle-btn:hover .eael-circle-btn-icon, {{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-2 .eael-circle-btn:hover .eael-circle-btn-icon'                   => 'background-color: {{VALUE}}!important;',
					'{{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-3 .eael-circle-btn:hover .eael-circle-icon-inner, {{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-4 .eael-circle-btn:hover .eael-circle-icon-inner'               => 'background-color: {{VALUE}}!important;',
					'{{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-1 .eael-circle-btn.active:hover .eael-circle-btn-icon, {{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-2 .eael-circle-btn.active:hover .eael-circle-btn-icon'     => 'background-color: {{VALUE}}!important;',
					'{{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-3 .eael-circle-btn.active:hover .eael-circle-icon-inner, {{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-4 .eael-circle-btn.active:hover .eael-circle-icon-inner' => 'background-color: {{VALUE}}!important;',
				],
			]
		);

		$this->add_control(
			'eael_interactive_circle_tab_text_color_hover',
			[
				'label'     => esc_html__( 'Text Color', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::COLOR,
				//			    'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .eael-circle-btn:hover .eael-circle-btn-txt, {{WRAPPER}} .eael-circle-btn.active:hover .eael-circle-btn-txt' => 'color: {{VALUE}}!important;',
				],
			]
		);
		$this->add_control(
			'eael_interactive_circle_tab_icon_color_hover',
			[
				'label'     => esc_html__( 'Icon Color', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::COLOR,
				//			    'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .eael-circle-btn:hover i, {{WRAPPER}} .eael-circle-btn.active:hover i'     => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .eael-circle-btn:hover svg, {{WRAPPER}} .eael-circle-btn.active:hover svg' => 'fill: {{VALUE}}!important;',
				],
				'condition' => [
					'eael_interactive_circle_btn_icon_show' => 'yes'
				],
			]
		);

		$this->add_control(
			'eael_interactive_circle_btn_border_color_hover',
			[
				'label'     => esc_html__( 'Border Color', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::COLOR,
				//			    'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .eael-circle-btn:hover, {{WRAPPER}} .eael-circle-btn.active:hover' => 'border-color: {{VALUE}}!important;',
				],
				'condition' => [
					'eael_interactive_circle_btn_border_border!' => ''
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'eael_interactive_circle_btn_shadow_hover',
				'selector' => '{{WRAPPER}} .eael-circle-wrapper .eael-circle-info .eael-circle-inner .eael-circle-item .eael-circle-btn:hover',
			]
		);

		$this->end_controls_tab();
		// Active State Tab
		$this->start_controls_tab( 'eael_interactive_circle_header_active', [ 'label' => esc_html__( 'Active', 'essential-addons-for-elementor-lite' ) ] );
		$this->add_control(
			'eael_interactive_circle_tab_color_active',
			[
				'label'     => esc_html__( 'Background Color', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-1 .eael-circle-btn.active .eael-circle-btn-icon, {{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-2 .eael-circle-btn.active .eael-circle-btn-icon'     => 'background-color: {{VALUE}}!important;',
					'{{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-3 .eael-circle-btn.active .eael-circle-icon-inner, {{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-4 .eael-circle-btn.active .eael-circle-icon-inner' => 'background-color: {{VALUE}}!important;',

					'{{WRAPPER}} .eael-circle-btn.active .eael-circle-btn-icon' => 'background-color: {{VALUE}}!important;',
				],
			]
		);

		$this->add_control(
			'eael_interactive_circle_tab_text_color_active',
			[
				'label'     => esc_html__( 'Text Color', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .eael-circle-btn.active .eael-circle-btn-txt' => 'color: {{VALUE}}!important;',
				],
			]
		);
		$this->add_control(
			'eael_interactive_circle_tab_icon_color_active',
			[
				'label'     => esc_html__( 'Icon Color', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::COLOR,
				//			    'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .eael-circle-btn.active i'   => 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .eael-circle-btn.active svg' => 'fill: {{VALUE}}!important;',
				],
				'condition' => [
					'eael_interactive_circle_btn_icon_show' => 'yes'
				],
			]
		);
		$this->add_control(
			'eael_interactive_circle_btn_border_color_active',
			[
				'label'     => esc_html__( 'Border Color', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::COLOR,
				//			    'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .eael-circle-btn.active' => 'border-color: {{VALUE}}!important;',
				],
				'condition' => [
					'eael_interactive_circle_btn_border_border!' => ''
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'eael_interactive_circle_btn_shadow_active',
				'selector' => '{{WRAPPER}} .eael-circle-wrapper .eael-circle-info .eael-circle-inner .eael-circle-item .eael-circle-btn.active',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function eael_interactive_circle_content_style() {

		$this->start_controls_section(
			'eael_section_interactive_circle_tab_content_style_settings',
			[
				'label' => esc_html__( 'Content', 'essential-addons-for-elementor-lite' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'eael_section_interactive_circle_content_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .eael-circle-content' => 'background: {{VALUE}} !important;',
					'{{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-3 .eael-circle-info .eael-circle-inner .eael-circle-item .eael-circle-btn-content .eael-circle-content' => 'background: {{VALUE}} !important;',
					'{{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-4 .eael-circle-info .eael-circle-item .eael-circle-btn-content .eael-circle-content' => 'background: {{VALUE}} !important;',
				],
				'condition' => [
					'eael_interactive_circle_preset!' => 'eael-interactive-circle-preset-2'
				],
			]
		);

		$this->add_control(
			'eael_section_interactive_circle_content_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'essential-addons-for-elementor-lite' ),
				'type'      => Controls_Manager::COLOR,
				//			    'default' => '#333',
				'selectors' => [
					'{{WRAPPER}} .eael-circle-content' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'eael_interactive_circle_content_typo',
				'selector' => '{{WRAPPER}} .eael-circle-content',
			]
		);
		$this->add_responsive_control(
			'eael_interactive_circle_content_padding',
			[
				'label'      => esc_html__( 'Padding', 'essential-addons-for-elementor-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .eael-circle-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_responsive_control(
			'eael_interactive_circle_content_margin',
			[
				'label'      => esc_html__( 'Margin', 'essential-addons-for-elementor-lite' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .eael-circle-btn-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'eael_interactive_circle_content_border',
				'label'    => esc_html__( 'Border', 'essential-addons-for-elementor-lite' ),
				'selector' => '{{WRAPPER}} .eael-circle-content',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'eael_interactive_circle_content_shadow',
				'selector'  => '{{WRAPPER}} .eael-circle-wrapper:not(.eael-interactive-circle-preset-1) .eael-circle-content, {{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-3 .eael-circle-info .eael-circle-inner .eael-circle-item .eael-circle-btn-content .eael-circle-content, {{WRAPPER}} .eael-circle-wrapper.eael-interactive-circle-preset-1 .eael-circle-inner',
				'condition' => [
					'eael_interactive_circle_preset!' => 'eael-interactive-circle-preset-2'
				],
			]
		);
		$this->end_controls_section();
	}

	protected function _register_controls() {
		$this->eael_interactive_circle_general();
		$this->eael_interactive_circle_item();
		$this->eael_interactive_circle_additional();

		$this->eael_interactive_circle_general_style();

		$this->eael_interactive_circle_button_style();
		$this->eael_interactive_circle_content_style();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			'eael_interactive_circle_container',
			[
				'id'         => "eael-interactive-circle-{$this->get_id()}",
				'class'      => [ 'eael-interactive-circle', ],
				'data-tabid' => $this->get_id(),
			]
		);

		$this->add_render_attribute(
			'eael_circle_wrapper',
			[
				'class' => [ 'eael-circle-wrapper', $settings[ 'eael_interactive_circle_preset' ], $settings[ 'eael_interactive_circle_animation' ], $settings[ 'eael_interactive_circle_event' ] ],
			]
		);

		$item_count     = count( $settings[ 'eael_interactive_circle_item' ] );
		$show_btn_icon  = isset( $settings[ 'eael_interactive_circle_btn_icon_show' ] ) && 'yes' === $settings[ 'eael_interactive_circle_btn_icon_show' ];
		$show_btn_title = isset( $settings[ 'eael_interactive_circle_btn_text_show' ] ) && 'yes' === $settings[ 'eael_interactive_circle_btn_text_show' ];


		?>
    <div <?php echo $this->get_render_attribute_string( 'eael_interactive_circle_container' ); ?>>
		<?php if ( ( $settings[ 'eael_interactive_circle_preset' ] != 'eael-interactive-circle-preset-2' ) ) { ?>
        <div <?php echo $this->get_render_attribute_string( 'eael_circle_wrapper' ); ?>>
        <div class="eael-circle-info" data-items="<?php echo $item_count; ?>">
            <div class="eael-circle-inner">
				<?php foreach ( $settings[ 'eael_interactive_circle_item' ] as $index => $item ) :
					$item_count = $index + 1;
					?>
                    <div class="eael-circle-item elementor-repeater-item-<?php echo $item[ '_id' ]; ?>">
                        <div class="eael-circle-btn" id="eael-circle-item-<?php echo $item_count; ?>">
                            <div class="eael-circle-icon-shapes">
                                <div class="eael-shape-1"></div>
                                <div class="eael-shape-2"></div>
                            </div>
                            <div class="eael-circle-btn-icon">
                                <div class="eael-circle-icon-inner">
									<?php
									if ( $show_btn_icon ) {
										Icons_Manager::render_icon( $item[ 'eael_interactive_circle_btn_icon' ] );
									}
									if ( $show_btn_title ) {
										echo '<span class="eael-circle-btn-txt">' . $item[ 'eael_interactive_circle_btn_title' ] . '</span>';
									}
									?>
                                </div>
                            </div>
                        </div>
                        <div class="eael-circle-btn-content eael-circle-item-<?php echo $item_count; ?>">
                            <div class="eael-circle-content">
								<?php echo $item[ 'eael_interactive_circle_item_content' ] ?>
                            </div>
                        </div>
                    </div>

				<?php endforeach; ?>

            </div>
        </div>

	<?php } else { ?>

        <div <?php echo $this->get_render_attribute_string( 'eael_circle_wrapper' ); ?>>
            <div class="eael-circle-info">
                <div class="eael-circle-inner" data-items="<?php echo $item_count; ?>">
					<?php foreach ( $settings[ 'eael_interactive_circle_item' ] as $index => $item ) :
						$item_count = $index + 1;
						?>
                        <div class="eael-circle-item elementor-repeater-item-<?php echo $item[ '_id' ]; ?>">
                            <div class="eael-circle-btn" id="eael-circle-item-<?php echo $item_count; ?>">
                                <div class="eael-circle-icon-shapes">
                                    <div class="eael-shape-1"></div>
                                    <div class="eael-shape-2"></div>
                                </div>
                                <div class="eael-circle-btn-icon">
                                    <div class="eael-circle-btn-icon-inner">
										<?php
										if ( $show_btn_icon ) {
											Icons_Manager::render_icon( $item[ 'eael_interactive_circle_btn_icon' ] );
										}
										if ( $show_btn_title ) {
											echo '<span class="eael-circle-btn-txt">' . $item[ 'eael_interactive_circle_btn_title' ] . '</span>';
										}
										?>
                                    </div>
                                </div>
                            </div>
                            <div class="eael-circle-btn-content eael-circle-item-<?php echo $item_count; ?>">
                                <div class="eael-circle-content">
									<?php echo $item[ 'eael_interactive_circle_item_content' ] ?>
                                </div>
                            </div>
                        </div>
					<?php endforeach; ?>

                </div>
            </div>
        </div>

	<?php } ?>

        </div>
	<?php }
}
