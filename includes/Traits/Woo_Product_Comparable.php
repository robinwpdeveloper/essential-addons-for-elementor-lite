<?php

namespace Essential_Addons_Elementor\Traits;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use WC_Product;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

trait Woo_Product_Comparable {
	public function get_style_depends() {
		return [
			'font-awesome-5-all',
			'font-awesome-4-shim',
		];
	}

	public function get_script_depends() {
		return [
			'font-awesome-4-shim',
		];
	}

	/**
	 * Get an array of field types.
	 * @return array
	 */
	public static function get_field_types() {
		return apply_filters( 'eael/wcpc/default-fields', [
			'image'       => __( 'Image', 'essential-addons-for-elementor-lite' ),
			'title'       => __( 'Title', 'essential-addons-for-elementor-lite' ),
			'price'       => __( 'Price', 'essential-addons-for-elementor-lite' ),
			'add-to-cart' => __( 'Add to cart', 'essential-addons-for-elementor-lite' ),
			'description' => __( 'Description', 'essential-addons-for-elementor-lite' ),
			'sku'         => __( 'SKU', 'essential-addons-for-elementor-lite' ),
			'stock'       => __( 'Availability', 'essential-addons-for-elementor-lite' ),
			'weight'      => __( 'weight', 'essential-addons-for-elementor-lite' ),
			'dimension'   => __( 'Dimension', 'essential-addons-for-elementor-lite' ),
			'pa_color'    => __( 'Color', 'essential-addons-for-elementor-lite' ),
			'pa_size'     => __( 'Size', 'essential-addons-for-elementor-lite' ),
		] );
	}

	public static function get_themes() {
		return apply_filters( 'eael/wcpc/default-themes', [
			''        => __( 'Theme Default', 'essential-addons-for-elementor-lite' ),
			'theme-1' => __( 'Theme 1', 'essential-addons-for-elementor-lite' ),
			'theme-2' => __( 'Theme 2', 'essential-addons-for-elementor-lite' ),
			'theme-3' => __( 'Theme 3', 'essential-addons-for-elementor-lite' ),
			'theme-4' => __( 'Theme 4', 'essential-addons-for-elementor-lite' ),
			'theme-5' => __( 'Theme 5', 'essential-addons-for-elementor-lite' ),
			'theme-6' => __( 'Theme 6', 'essential-addons-for-elementor-lite' ),
		] );
	}

	/**
	 * Get default fields value for the repeater's default value
	 */
	public static function get_default_rf_fields() {
		return apply_filters( 'eael/wcpc/default-rf-fields', [
			[
				'field_type'  => 'image',
				'field_label' => __( 'Image', 'essential-addons-for-elementor-lite' ),
			],
			[
				'field_type'  => 'title',
				'field_label' => __( 'Title', 'essential-addons-for-elementor-lite' ),
			],
			[
				'field_type'  => 'price',
				'field_label' => __( 'Price', 'essential-addons-for-elementor-lite' ),
			],
			[
				'field_type'  => 'description',
				'field_label' => __( 'Description', 'essential-addons-for-elementor-lite' ),
			],
			[
				'field_type'  => 'add-to-cart',
				'field_label' => __( 'Add to cart', 'essential-addons-for-elementor-lite' ),
			],
			[
				'field_type'  => 'sku',
				'field_label' => __( 'SKU', 'essential-addons-for-elementor-lite' ),
			],
			[
				'field_type'  => 'stock',
				'field_label' => __( 'Availability', 'essential-addons-for-elementor-lite' ),
			],
			[
				'field_type'  => 'weight',
				'field_label' => __( 'Weight', 'essential-addons-for-elementor-lite' ),
			],
			[
				'field_type'  => 'dimension',
				'field_label' => __( 'Dimension', 'essential-addons-for-elementor-lite' ),
			],
			[
				'field_type'  => 'pa_color',
				'field_label' => __( 'Color', 'essential-addons-for-elementor-lite' ),
			],
			[
				'field_type'  => 'pa_size',
				'field_label' => __( 'Size', 'essential-addons-for-elementor-lite' ),
			],
		] );
	}

	protected function init_content_wc_notice_controls() {
		if ( ! function_exists( 'WC' ) ) {
			$this->start_controls_section( 'eael_global_warning', [
				'label' => __( 'Warning!', 'essential-addons-for-elementor-lite' ),
			] );
			$this->add_control( 'eael_global_warning_text', [
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __( '<strong>WooCommerce</strong> is not installed/activated on your site. Please install and activate <a href="plugin-install.php?s=woocommerce&tab=search&type=term" target="_blank">WooCommerce</a> first.', 'essential-addons-for-elementor-lite' ),
				'content_classes' => 'eael-warning',
			] );
			$this->end_controls_section();

			return;
		}
	}

	public function init_content_product_compare_controls() {
		$this->start_controls_section( 'section_content_content', [
			'label' => __( 'Product Compare', 'essential-addons-for-elementor-lite' ),
		] );
		if ( 'eael-woo-product-compare' === $this->get_name() ) {
			$this->add_control( "product_ids", [
				'label'       => __( 'Product IDs', 'essential-addons-for-elementor-lite' ),
				'description' => __( 'Enter Product IDs separated by a comma', 'essential-addons-for-elementor-lite' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( 'Eg. 123, 456 etc.', 'essential-addons-for-elementor-lite' ),
			] );
			$this->add_control( "highlighted_product_id", [
				'label'       => __( 'Highlighted Product ID', 'essential-addons-for-elementor-lite' ),
				'type'        => Controls_Manager::NUMBER,
				'description' => __( 'Enter any ID from the Product IDs used above', 'essential-addons-for-elementor-lite' ),
				'condition'   => [
					'theme' => [
						'theme-3',
						'theme-4',
					],
				],
			] );
		}
		$this->add_control( 'theme', [
			'label'   => __( 'Presets', 'essential-addons-for-elementor-lite' ),
			'type'    => Controls_Manager::SELECT,
			'options' => $this->get_themes(),
			'default' => '',
		] );
		$this->add_control( "ribbon", [
			'label'       => __( 'Ribbon Text', 'essential-addons-for-elementor-lite' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'eg. New', 'essential-addons-for-elementor-lite' ),
			'default'     => __( 'New', 'essential-addons-for-elementor-lite' ),
			'condition'   => [
				'theme' => 'theme-4',
			],
		] );
		$this->end_controls_section();
	}

	public function init_content_table_settings_controls() {
		$this->start_controls_section( 'section_content_table', [
			'label' => __( 'Compare Table Settings', 'essential-addons-for-elementor-lite' ),
		] );
		$this->add_control( "table_title", [
			'label'       => __( 'Table Title', 'essential-addons-for-elementor-lite' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Compare Products', 'essential-addons-for-elementor-lite' ),
			'placeholder' => __( 'Compare Products', 'essential-addons-for-elementor-lite' ),
		] );
		$repeater = new Repeater();
		$repeater->add_control( 'field_type', [
			'label'   => __( 'Type', 'essential-addons-for-elementor-lite' ),
			'type'    => Controls_Manager::SELECT,
			'options' => $this->get_field_types(),
			'default' => 'title',
		] );
		$repeater->add_control( 'field_label', [
			'label'   => __( 'Label', 'essential-addons-for-elementor-lite' ),
			'type'    => Controls_Manager::TEXT,
			'dynamic' => [
				'active' => true,
			],
		] );
		$this->add_control( 'fields', [
			'label'       => __( 'Fields to show', 'essential-addons-for-elementor-lite' ),
			'description' => __( 'Select the fields to show in the comparison table', 'essential-addons-for-elementor-lite' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => apply_filters( 'eael/wcpc/rf-fields', $repeater->get_controls() ),
			'default'     => $this->get_default_rf_fields(),
			'title_field' => '{{{ field_label }}}',
		] );
		$this->add_control( 'repeat_price', [
			'label'       => __( 'Repeat "Price" field', 'essential-addons-for-elementor-lite' ),
			'description' => __( 'Repeat the "Price" field at the end of the table', 'essential-addons-for-elementor-lite' ),
			'type'        => Controls_Manager::SWITCHER,
			'default'     => 'yes',
		] );
		$this->add_control( 'repeat_add_to_cart', [
			'label'       => __( 'Repeat "Add to cart" field', 'essential-addons-for-elementor-lite' ),
			'description' => __( 'Repeat the "Add to cart" field at the end of the table', 'essential-addons-for-elementor-lite' ),
			'type'        => Controls_Manager::SWITCHER,
		] );
		$this->add_control( 'linkable_img', [
			'label'       => __( 'Make Product Image Linkable', 'essential-addons-for-elementor-lite' ),
			'description' => __( 'You can link the product image to product details page', 'essential-addons-for-elementor-lite' ),
			'type'        => Controls_Manager::SWITCHER,
		] );
		$this->add_control( 'field_icon', [
			'label'   => __( 'Fields Icon', 'elementor' ),
			'type'    => Controls_Manager::ICONS,
			'default' => [
				'value'   => 'fas fa-arrow-right',
				'library' => 'fa-solid',
			],
		] );
		$this->end_controls_section();
	}

	public function init_style_content_controls( $css_classes = [] ) {
		extract( $css_classes );
		$this->start_controls_section( 'section_style_general', [
			'label' => __( 'Compare Table General', 'essential-addons-for-elementor-lite' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		$container_class = ! empty( $container_class ) ? $container_class : '{{WRAPPER}} .eael-wcpc-wrapper';
		$this->add_responsive_control( "eael_container_width", [
			'label'      => esc_html__( 'Width', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [
				'px',
				'rem',
				'%',
			],
			'range'      => [
				'px'  => [
					'min'  => 0,
					'max'  => 1920,
					'step' => 5,
				],
				'rem' => [
					'min'  => 0,
					'max'  => 20,
					'step' => .5,
				],
				'%'   => [
					'min' => 0,
					'max' => 100,
				],
			],
			'desktop'    => [
				'unit' => '%',
				'size' => 100,
			],
			'selectors'  => [
				$container_class => 'width: {{SIZE}}{{UNIT}}; overflow-x:scroll',
			],

		] );
		$this->add_responsive_control( "eael_container_margin", [
			'label'      => __( 'Margin', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'em',
				'%',
			],
			'selectors'  => [
				$container_class => $this->apply_dim( 'margin' ),
			],
		] );
		$this->add_responsive_control( "eael_container_padding", [
			'label'      => __( 'Padding', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'em',
				'%',
			],
			'selectors'  => [
				$container_class => $this->apply_dim( 'padding' ),
			],
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => "eael_container_border",
			'selector' => $container_class,
		] );
		$this->add_control( "eael_container_border_radius", [
			'label'      => __( 'Border Radius', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'%',
			],
			'selectors'  => [
				$container_class => $this->apply_dim( 'border-radius' ),
			],
		] );
		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => "eael_container_bg_color",
			'label'    => __( 'Background Color', 'essential-addons-for-elementor-lite' ),
			'types'    => [
				'classic',
				'gradient',
			],
			'selector' => $container_class,
		] );
		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'label'    => __( 'Container Box Shadow', 'essential-addons-for-elementor-lite' ),
			'name'     => 'eael_container_shadow',
			'selector' => $container_class,
			'exclude'  => [
				'box_shadow_position',
			],
		] );
		$this->end_controls_section();
	}

	public function init_style_table_controls( $css_classes = [] ) {
		extract( $css_classes );
		$table            = isset( $table ) ? $table : "{{WRAPPER}} .eael-wcpc-wrapper table";
		$table_title      = isset( $table_title ) ? $table_title : "{{WRAPPER}} .eael-wcpc-wrapper .wcpc-title";
		$table_title_wrap = isset( $table_title_wrap ) ? $table_title_wrap : "{{WRAPPER}} .eael-wcpc-wrapper .first-th";
		$this->start_controls_section( 'section_style_table', [
			'label' => __( 'Table Style', 'essential-addons-for-elementor-lite' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );
		$this->add_control( 'separate_col_style', [
			'label' => __( 'Style Content Column Separately', 'essential-addons-for-elementor-lite' ),
			'type'  => Controls_Manager::SWITCHER,
		] );
		//-------Table Style--------
		$this->add_control( 'table_style_pot', [
			'label'        => __( 'Table Style', 'essential-addons-for-elementor-lite' ),
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'label_off'    => __( 'Default', 'essential-addons-for-elementor-lite' ),
			'label_on'     => __( 'Custom', 'essential-addons-for-elementor-lite' ),
			'return_value' => 'yes',
		] );
		$this->start_popover();
		$this->add_responsive_control( "table_width", [
			'label'      => esc_html__( 'Table Width', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [
				'px',
				'rem',
				'%',
			],
			'range'      => [
				'%'  => [
					'min' => 0,
					'max' => 100,
				],
				'px' => [
					'min' => 0,
					'max' => 2000,
				],
			],
			'desktop'    => [
				'unit' => '%',
				'size' => 100,
			],
			'selectors'  => [
				$table => 'width: {{SIZE}}{{UNIT}}; max-width: none',
			],
			'condition'  => [
				'table_style_pot' => 'yes',
			],

		] );
		$this->add_responsive_control( "table_margin", [
			'label'      => __( 'Table Margin', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'em',
				'%',
			],
			'selectors'  => [
				$table => $this->apply_dim( 'margin' ),
			],
			'condition'  => [
				'table_style_pot' => 'yes',
			],
		] );
		$this->add_responsive_control( "table_padding", [
			'label'      => __( 'Table Padding', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'em',
				'%',
			],
			'selectors'  => [
				$table => $this->apply_dim( 'padding' ),
			],
			'condition'  => [
				'table_style_pot' => 'yes',
			],
		] );
		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'      => "table_bg_color",
			'label'     => __( 'Background Color', 'essential-addons-for-elementor-lite' ),
			'types'     => [
				'classic',
				'gradient',
			],
			'exclude'   => [ 'image' ],
			'selector'  => $table,
			'condition' => [
				'table_style_pot' => 'yes',
			],
		] );
		$this->add_control( 'tbl_brd_heading', [
			'label'     => __( 'Table Border', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [
				'table_style_pot' => 'yes',
			],
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => "tbl_border",
			'selector'  => $table,
			'condition' => [
				'table_style_pot' => 'yes',
			],
		] );
		$this->add_control( "tbl_border_radius", [
			'label'      => __( 'Border Radius', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'%',
			],
			'selectors'  => [
				$table => $this->apply_dim( 'border-radius' ),
			],
			'condition'  => [
				'table_style_pot' => 'yes',
			],
		] );
		$this->end_popover();

		//-------Table Title Style--------
		$this->add_control( 'tbl_ttl_style_pot', [
			'label'        => __( 'Table Title Style', 'essential-addons-for-elementor-lite' ),
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'label_off'    => __( 'Default', 'essential-addons-for-elementor-lite' ),
			'label_on'     => __( 'Custom', 'essential-addons-for-elementor-lite' ),
			'return_value' => 'yes',
			'condition'    => [ 'table_title!' => '' ],
		] );
		$this->start_popover();
		$this->add_control( 'tbl_title_color', [
			'label'     => __( 'Table Title Text Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'separator' => 'before',
			'selectors' => [ $table_title => 'color:{{VALUE}}' ],
			'condition' => [ 'tbl_ttl_style_pot' => 'yes' ],
		] );
		$this->add_control( 'tbl_title_bg', [
			'label'     => __( 'Table Title Background', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $table_title_wrap => 'background-color:{{VALUE}}' ],
			'condition' => [ 'tbl_ttl_style_pot' => 'yes' ],
		] );
		$this->add_responsive_control( "table_title_padding", [
			'label'      => __( 'Table Title Padding', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'em',
				'%',
			],
			'selectors'  => [
				$table_title => $this->apply_dim( 'padding' ),
			],
			'condition'  => [ 'tbl_ttl_style_pot' => 'yes' ],
		] );
		$this->add_control( 'tbl_title_brd_heading', [
			'label'     => __( 'Table Title Border', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [ 'tbl_ttl_style_pot' => 'yes' ],
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => "tbl_title_cell_border",
			'selector'  => $table_title_wrap,
			'condition' => [ 'tbl_ttl_style_pot' => 'yes' ],
		] );
		$this->add_control( "tbl_title_cell_border_radius", [
			'label'      => __( 'Border Radius', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'%',
			],
			'selectors'  => [
				$table_title_wrap => $this->apply_dim( 'border-radius' ),
			],
			'condition'  => [
				'tbl_ttl_style_pot'             => 'yes',
				'tbl_title_cell_border_border!' => '',
			],
		] );
		$this->end_popover();
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => "tbl_title_text_typo",
			'label'     => __( 'Table Title Typography', 'essential-addons-for-elementor-lite' ),
			'selector'  => $table_title,
			'condition' => [ 'table_title!' => '' ],
		] );
		$this->add_control( 'title_row_typ_separator', [
			'type' => Controls_Manager::DIVIDER,
		] );
		$this->init_style_table_common_style( $table );
		$this->end_controls_section();

		$this->init_style_header_column_style();
		foreach ( range( 0, 2 ) as $column ) {
			$this->init_style_product_column_style( $column, $table );
		}

		$this->init_style_icon_controls( $table );
	}

	public function init_style_table_common_style( $tbl = '' ) {
		$tbl = ! empty( $tbl ) ? $tbl : "{{WRAPPER}} .eael-wcpc-wrapper table";
		$td  = "{$tbl} td";
		$th  = "{$tbl} tr:not(.image):not(.title) th:not(.first-th)"; // if we do not need to give title row weight, then remove :not(.title)

		$img_class = "{$tbl} tr.image td";
		$img       = "{$tbl} tr.image td img";
		$title_row = "{$tbl} tr.title th, {$tbl} tr.title td";
		$btn       = "{$tbl} a.button";
		$btn_hover = "{$tbl} a.button:hover";
		$tr_even   = "{$tbl} tr:nth-child(even) th, {$tbl} tr:nth-child(even) td";
		$tr_odd    = "{$tbl} tr:nth-child(odd) th, {$tbl} tr:nth-child(odd) td";

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => "title_row_typo",
			'label'     => __( 'Product Title Row Typography', 'essential-addons-for-elementor-lite' ),
			'selector'  => $title_row,
			'condition' => [
				'separate_col_style!' => 'yes',
			],
		] );
		// common columns
		$this->add_control( 'common_th_style_pot', [
			'label'        => __( 'Header Column Style', 'essential-addons-for-elementor-lite' ),
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'label_off'    => __( 'Default', 'essential-addons-for-elementor-lite' ),
			'label_on'     => __( 'Custom', 'essential-addons-for-elementor-lite' ),
			'return_value' => 'yes',
			'separator'    => 'before',
			'condition'    => [ 'separate_col_style!' => 'yes' ],
		] );
		$this->start_popover();
		$this->add_responsive_control( "table_gen_th_width", [
			'label'      => esc_html__( 'Header Column Width', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [
				'px',
				'rem',
				'%',
			],
			'range'      => [
				'px'  => [
					'min'  => 0,
					'max'  => 550,
					'step' => 5,
				],
				'rem' => [
					'min'  => 0,
					'max'  => 10,
					'step' => .5,
				],
				'%'   => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors'  => [
				$th => 'width: {{SIZE}}{{UNIT}};',
			],
			'condition'  => [ 'common_th_style_pot' => 'yes' ],
		] );
		$this->add_responsive_control( "table_gen_th_padding", [
			'label'      => __( 'Header Column Padding', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'em',
				'%',
			],
			'selectors'  => [
				$th => $this->apply_dim( 'padding' ),
			],
			'condition'  => [ 'common_th_style_pot' => 'yes' ],
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => "common_h_col_border",
			'label'     => __( 'Header border', 'essential-addons-for-elementor-lite' ),
			'selector'  => $th,
			'condition' => [ 'common_th_style_pot' => 'yes' ],
		] );
		$this->add_control( "common_h_col_border_radius", [
			'label'      => __( 'Border Radius', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'%',
			],
			'selectors'  => [
				$th => $this->apply_dim( 'border-radius' ),
			],
			'condition'  => [
				'common_h_col_border_border!' => '',
				'common_th_style_pot'         => 'yes',
			],
		] );
		$this->end_popover();
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => "tbl_gen_th_typo",
			'label'     => __( 'Header Column Typography', 'essential-addons-for-elementor-lite' ),
			'selector'  => $th,
			'condition' => [
				'separate_col_style!' => 'yes',
			],
		] );
		// Product column
		$this->add_control( 'common_td_style_pot', [
			'label'        => __( 'Product Column Style', 'essential-addons-for-elementor-lite' ),
			'type'         => Controls_Manager::POPOVER_TOGGLE,
			'label_off'    => __( 'Default', 'essential-addons-for-elementor-lite' ),
			'label_on'     => __( 'Custom', 'essential-addons-for-elementor-lite' ),
			'return_value' => 'yes',
			'separator'    => 'before',
			'condition'    => [ 'separate_col_style!' => 'yes' ],
		] );
		$this->start_popover();
		$this->add_responsive_control( "table_gen_td_width", [
			'label'      => esc_html__( 'Product Column Width', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [
				'px',
				'rem',
				'%',
			],
			'range'      => [
				'px'  => [
					'min'  => 0,
					'max'  => 550,
					'step' => 5,
				],
				'rem' => [
					'min'  => 0,
					'max'  => 10,
					'step' => .5,
				],
				'%'   => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors'  => [
				$td => 'width: {{SIZE}}{{UNIT}};',
			],
			'condition'  => [ 'common_td_style_pot' => 'yes' ],
		] );
		$this->add_responsive_control( "table_gen_td_padding", [
			'label'      => __( 'Product Column Padding', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'em',
				'%',
			],
			'selectors'  => [
				$td => $this->apply_dim( 'padding' ),
			],
			'condition'  => [ 'common_td_style_pot' => 'yes' ],
		] );
		$this->add_responsive_control( "table_gen_img_td_padding", [
			'label'      => __( 'Product Image Box Padding', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'em',
				'%',
			],
			'selectors'  => [
				$img_class => $this->apply_dim( 'padding' ),
			],
			'condition'  => [ 'common_td_style_pot' => 'yes' ],
		] );
		$this->add_responsive_control( "table_gen_img_padding", [
			'label'      => __( 'Product Image Padding', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'em',
				'%',
			],
			'selectors'  => [
				$img => $this->apply_dim( 'padding' ),
			],
			'condition'  => [ 'common_td_style_pot' => 'yes' ],
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => "common_td_col_border",
			'label'     => __( 'Product column border', 'essential-addons-for-elementor-lite' ),
			'selector'  => $td,
			'condition' => [ 'common_td_style_pot' => 'yes' ],
		] );
		$this->add_control( "common_td_col_border_radius", [
			'label'      => __( 'Border Radius', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'%',
			],
			'selectors'  => [
				$td => $this->apply_dim( 'border-radius' ),
			],
			'condition'  => [
				'separate_col_style!'          => 'yes',
				'common_td_col_border_border!' => '',
			],
		] );
		$this->add_control( 'common_img_col_brd_heading', [
			'label'     => __( 'Product Image Box Border', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [ 'common_td_style_pot' => 'yes' ],
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => "common_img_col_border",
			'label'     => __( 'Image Box border', 'essential-addons-for-elementor-lite' ),
			'selector'  => $img_class,
			'condition' => [ 'common_td_style_pot' => 'yes' ],
		] );
		$this->add_control( 'common_img_brd_heading', [
			'label'     => __( 'Product Image Border', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [ 'common_td_style_pot' => 'yes' ],
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'      => "common_img_border",
			'label'     => __( 'Product Image border', 'essential-addons-for-elementor-lite' ),
			'selector'  => $img_class . ' img',
			'condition' => [ 'common_td_style_pot' => 'yes' ],
		] );
		$this->add_control( "common_img_border_radius", [
			'label'      => __( 'Border Radius', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'%',
			],
			'selectors'  => [
				$img_class . ' img' => $this->apply_dim( 'border-radius' ),
			],
			'condition'  => [
				'common_td_style_pot'       => 'yes',
				'common_img_border_border!' => '',
			],

		] );
		$this->end_popover();
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => "tbl_gen_td_typo",
			'label'     => __( 'Product Column Typography', 'essential-addons-for-elementor-lite' ),
			'selector'  => $td,
			'condition' => [ 'separate_col_style!' => 'yes' ],
		] );

		// Colors
		$this->add_control( 'common_colors_heading', [
			'label'     => __( 'Colors', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
			'condition' => [
				'separate_col_style!' => 'yes',
			],
		] );
		$this->start_controls_tabs( "tabs_table_common_style", [
			'condition' => [
				'separate_col_style!' => 'yes',
			],
		] );
		/*-----NORMAL state------ */
		$this->start_controls_tab( "tab_table_common_style_normal", [
			'label'     => __( 'Normal', 'essential-addons-for-elementor-lite' ),
			'condition' => [
				'separate_col_style!' => 'yes',
			],
		] );
		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => "image_bg",
			'label'    => __( 'Image Background', 'essential-addons-for-elementor-lite' ),
			'types'    => [
				'classic',
				'gradient',
			],
			'selector' => $img_class,
		] );
		$this->add_control( "common_column_color_heading", [
			'label'     => __( 'Columns', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_control( 'common_h_col_bg', [
			'label'     => __( 'Header Background', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $th => 'background-color:{{VALUE}}' ],
		] );
		$this->add_control( 'common_h_col_color', [
			'label'     => __( 'Header Text Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $th => 'color:{{VALUE}}' ],
		] );
		$this->add_control( 'common_td_col_bg', [
			'label'     => __( 'Product Column Background', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $td => 'background-color:{{VALUE}}' ],
		] );
		$this->add_control( 'common_td_col_color', [
			'label'     => __( 'Product Column Text Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $td => 'color:{{VALUE}}' ],
		] );

		$this->add_control( "common_buttons_color_heading", [
			'label'     => __( 'Buttons', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_control( 'btn_color', [
			'label'     => __( 'Button Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $btn => 'color:{{VALUE}}' ],
		] );
		$this->add_control( 'btn_bg_color', [
			'label'     => __( 'Button Background Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $btn => 'background:{{VALUE}}' ],
		] );
		$this->add_control( "common_row_color_heading", [
			'label'     => __( 'Rows', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_control( 'common_title_row_bg', [
			'label'     => __( 'Title Row Background', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $title_row => 'background-color:{{VALUE}}', ],
		] );
		$this->add_control( 'common_title_row_color', [
			'label'     => __( 'Title Row Text Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $title_row => 'color:{{VALUE}}' ],
		] );
		$this->add_control( 'common_tr_even_bg', [
			'label'     => __( 'Even Row Background', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $tr_even => 'background-color:{{VALUE}}' ],
			'separator' => 'before',
		] );
		$this->add_control( 'common_tr_even_color', [
			'label'     => __( 'Even Row Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $tr_even => 'color:{{VALUE}}' ],
		] );
		$this->add_control( 'common_tr_odd_bg', [
			'label'     => __( 'Odd Row Background', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $tr_odd => 'background-color:{{VALUE}}' ],
		] );
		$this->add_control( 'common_tr_odd_color', [
			'label'     => __( 'Odd Row Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $tr_odd => 'color:{{VALUE}}' ],
		] );
		$this->end_controls_tab();


		/*-----HOVER state------ */
		$this->start_controls_tab( "tab_table_common_style_hover", [
			'label' => __( 'Hover', 'essential-addons-for-elementor-lite' ),
		] );
		$this->add_control( 'btn_color_hover', [
			'label'     => __( 'Button Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $btn_hover => 'color:{{VALUE}}' ],
		] );
		$this->add_control( 'btn_bg_color_hover', [
			'label'     => __( 'Button Background Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $btn_hover => 'background:{{VALUE}}' ],
		] );
		$this->end_controls_tab();
		$this->end_controls_tabs();
	}

	public function init_style_header_column_style( $tbl = '' ) {
		$tbl      = ! empty( $tbl ) ? $tbl : "{{WRAPPER}} .eael-wcpc-wrapper table";
		$h_col    = "{$tbl} tr:not(.image):not(.title) th:not(.first-th)";
		$title_th = "{$tbl} tr.title th";
		$tr_even  = "{$tbl} tr:nth-child(even):not(.image) th:not(.first-th)";
		$tr_odd   = "{$tbl} tr:nth-child(odd):not(.image) th:not(.first-th)";
		$this->start_controls_section( 'section_style_h_clm', [
			'label'     => __( 'Header Column', 'essential-addons-for-elementor-lite' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'separate_col_style' => 'yes',
			],
		] );
		$this->add_responsive_control( "h_col_width", [
			'label'      => esc_html__( 'Width', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [
				'px',
				'rem',
				'%',
			],
			'range'      => [
				'px'  => [
					'min'  => 0,
					'max'  => 550,
					'step' => 5,
				],
				'rem' => [
					'min'  => 0,
					'max'  => 10,
					'step' => .5,
				],
				'%'   => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors'  => [
				$h_col => 'width: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( "h_col_padding", [
			'label'      => __( 'Padding', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'em',
				'%',
			],
			'selectors'  => [
				$h_col => $this->apply_dim( 'padding' ),
			],
		] );
		$this->add_control( 'h_col_clr_heading', [
			'label' => __( 'Colors', 'essential-addons-for-elementor-lite' ),
			'type'  => Controls_Manager::HEADING,
		] );
		$this->add_control( 'title_h_col_bg', [
			'label'     => __( 'Title Background', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $title_th => 'background-color:{{VALUE}}' ],
		] );
		$this->add_control( 'title_h_col_color', [
			'label'     => __( 'Title Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $title_th => 'color:{{VALUE}}' ],
		] );
		$this->add_control( 'h_col_bg', [
			'label'     => __( 'Column Background Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $h_col => 'background-color:{{VALUE}}' ],
		] );
		$this->add_control( 'h_col_color', [
			'label'     => __( 'Column Text Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $h_col => 'color:{{VALUE}}' ],
		] );
		$this->add_control( "h_rows_clr_heading", [
			'label'     => __( 'Rows', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_control( 'tr_even_bg', [
			'label'     => __( 'Even Row Background', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $tr_even => 'background-color:{{VALUE}}' ],
			'separator' => 'before',
		] );
		$this->add_control( 'tr_even_color', [
			'label'     => __( 'Even Row Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $tr_even => 'color:{{VALUE}}' ],
		] );
		$this->add_control( 'tr_odd_bg', [
			'label'     => __( 'Odd Row Background', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $tr_odd => 'background-color:{{VALUE}}' ],
		] );
		$this->add_control( 'tr_odd_color', [
			'label'     => __( 'Odd Row Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $tr_odd => 'color:{{VALUE}}' ],
		] );
		$this->add_control( 'title_border_heading', [
			'label'     => __( 'Title Border', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => "title_h_col_border",
			'selector' => $title_th,
		] );
		$this->add_control( 'h_border_heading', [
			'label'     => __( 'Header Border', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => "h_col_border",
			'selector' => $h_col,
		] );
		$this->add_control( 'h_typo_heading', [
			'label'     => __( 'Typography', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => "title_h_col_typo",
			'label'    => __( 'Title', 'essential-addons-for-elementor-lite' ),
			'selector' => $title_th,
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => "h_col_typo",
			'label'    => __( 'Header', 'essential-addons-for-elementor-lite' ),
			'selector' => $h_col,
		] );
		$this->end_controls_section();
	}

	public function init_style_product_column_style( $column_number, $tbl = '' ) {
		$tbl = ! empty( $tbl ) ? $tbl : "{{WRAPPER}} .eael-wcpc-wrapper table";

		$title_number = 1 + $column_number; // first column number is 0, so title number will start from 1 in the loop.
		$pfx          = "col{$column_number}";
		// New selectors
		$column_class = "{$tbl} td:nth-of-type(3n+{$title_number})";
		$title_row    = "{$tbl} tr.title td:nth-of-type(3n+{$title_number})";
		$tr_even      = "{$tbl} tr:nth-of-type(even) td:nth-of-type(3n+{$title_number})";
		$tr_odd       = "{$tbl} tr:nth-of-type(odd) td:nth-of-type(3n+{$title_number})";
		$btn          = "{$tbl} td:nth-of-type(3n+{$title_number}) a.button";
		$btn_hover    = "{$btn}:hover";
		$img_td       = "{$tbl} tr.image td:nth-of-type(3n+{$title_number})";
		$img          = "{$img_td} img";
		$this->start_controls_section( 'section_style_' . $pfx, [
			'label'     => sprintf( __( 'Product Column %d', 'essential-addons-for-elementor-lite' ), $title_number ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'separate_col_style' => 'yes',
			],
		] );
		$this->add_responsive_control( "{$pfx}_width", [
			'label'      => esc_html__( 'Width', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [
				'px',
				'rem',
				'%',
			],
			'range'      => [
				'px'  => [
					'min'  => 0,
					'max'  => 550,
					'step' => 5,
				],
				'rem' => [
					'min'  => 0,
					'max'  => 10,
					'step' => .5,
				],
				'%'   => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors'  => [
				$column_class => 'width: {{SIZE}}{{UNIT}};',
			],
		] );
		$this->add_responsive_control( "{$pfx}_padding", [
			'label'      => __( 'Padding', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'em',
				'%',
			],
			'selectors'  => [
				$column_class => $this->apply_dim( 'padding' ),
			],
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => "{$pfx}_border",
			'selector' => $column_class,
		] );
		$this->add_control( "{$pfx}_img_col_brd_heading", [
			'label'     => __( 'Product Image Box Border', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => "{$pfx}_img_col_border",
			'label'    => __( 'Image Box border', 'essential-addons-for-elementor-lite' ),
			'selector' => $img_td,
		] );
		$this->add_control( "{$pfx}_img_brd_heading", [
			'label'     => __( 'Product Image Border', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => "{$pfx}_img_border",
			'label'    => __( 'Product Image border', 'essential-addons-for-elementor-lite' ),
			'selector' => $img,
		] );
		$this->add_control( "{$pfx}_img_border_radius", [
			'label'      => __( 'Border Radius', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'%',
			],
			'selectors'  => [
				$img => $this->apply_dim( 'border-radius' ),
			],
			'condition'  => [
				"{$pfx}_img_border_border!" => '',
			],
		] );

		//Typography
		$this->add_control( "{$pfx}_typo_heading", [
			'label'     => __( 'Typography', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => "{$pfx}_title_typo",
			'label'    => sprintf( __( 'Title', 'essential-addons-for-elementor-lite' ), $title_number ),
			'selector' => $title_row,
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => "{$pfx}_text_typo",
			'label'    => sprintf( __( 'Text', 'essential-addons-for-elementor-lite' ), $title_number ),
			'selector' => $column_class,
		] );
		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => "{$pfx}_btn_typo",
			'label'    => sprintf( __( 'Button', 'essential-addons-for-elementor-lite' ), $title_number ),
			'selector' => $btn,
		] );

		//COLORS
		$this->add_control( "{$pfx}_clr_heading", [
			'label'     => __( 'Colors', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->start_controls_tabs( "{$pfx}_tabs_style" );
		/*-----NORMAL state------ */
		$this->start_controls_tab( "{$pfx}_tab_style_normal", [
			'label' => __( 'Normal', 'essential-addons-for-elementor-lite' ),
		] );
		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => "{$pfx}_img_bg",
			'label'    => __( 'Image Background', 'essential-addons-for-elementor-lite' ),
			'types'    => [
				'classic',
				'gradient',
			],
			'selector' => $img_td,
			'exclude'  => [ 'image' ],
		] );
		$this->add_control( "{$pfx}_title_bg", [
			'label'     => __( 'Title Background', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $title_row => 'background-color:{{VALUE}}', ],
			'condition' => [
				'theme' => [
					'theme-1',
					'theme-2',
					'theme-5',
				],
			],
		] );
		$this->add_control( "{$pfx}_title_color", [
			'label'     => __( 'Title Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $title_row => 'color:{{VALUE}}' ],
			'condition' => [
				'theme' => [
					'theme-1',
					'theme-2',
					'theme-5',
				],
			],
		] );
		$this->add_control( "{$pfx}_button_clr_heading", [
			'label'     => __( 'Button', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_control( "{$pfx}_btn_color", [
			'label'     => __( 'Button Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $btn => 'color:{{VALUE}}' ],
			'separator' => 'before',
		] );
		$this->add_control( "{$pfx}_btn_bg", [
			'label'     => __( 'Button Background', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $btn => 'background-color:{{VALUE}}' ],
		] );
		$this->add_control( "{$pfx}_rows_clr_heading", [
			'label'     => __( 'Rows', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		] );
		$this->add_control( "{$pfx}_tr_even_bg", [
			'label'     => __( 'Even Row Background', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $tr_even => 'background-color:{{VALUE}}' ],
			'separator' => 'before',
		] );
		$this->add_control( "{$pfx}_tr_even_color", [
			'label'     => __( 'Even Row Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $tr_even => 'color:{{VALUE}}' ],
		] );
		$this->add_control( "{$pfx}_tr_odd_bg", [
			'label'     => __( 'Odd Row Background', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $tr_odd => 'background-color:{{VALUE}}' ],
		] );
		$this->add_control( "{$pfx}_tr_odd_color", [
			'label'     => __( 'Odd Row Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $tr_odd => 'color:{{VALUE}}' ],
		] );
		$this->end_controls_tab();
		/*-----HOVER state------ */
		$this->start_controls_tab( "{$pfx}_tab_style_hover", [
			'label' => __( 'Hover', 'essential-addons-for-elementor-lite' ),
		] );
		$this->add_control( "{$pfx}_btn_color_hover", [
			'label'     => __( 'Button Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $btn_hover => 'color:{{VALUE}}' ],
		] );
		$this->add_control( "{$pfx}_btn_bg_hover", [
			'label'     => __( 'Button Background', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $btn_hover => 'background-color:{{VALUE}}' ],
		] );
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	public function init_style_icon_controls( $tbl = '' ) {
		$icon = "{$tbl} i";
		$this->start_controls_section( 'section_style_icon', [
			'label'     => __( 'Fields Icon', 'essential-addons-for-elementor-lite' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'field_icon[value]!' => '',
			],
		] );
		$this->add_responsive_control( "field_icon_size", [
			'label'      => esc_html__( 'Size', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [
				'px',
				'rem',
				'%',
			],
			'range'      => [
				'px'  => [
					'min'  => 0,
					'max'  => 550,
					'step' => 5,
				],
				'rem' => [
					'min'  => 0,
					'max'  => 10,
					'step' => .5,
				],
			],
			'selectors'  => [
				$icon => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( "field_icon_size_margin", [
			'label'      => __( 'Margin', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'rem',
			],
			'selectors'  => [
				$icon => $this->apply_dim( 'margin' ),
			],
		] );
		$this->add_responsive_control( "field_icon_pos", [
			'label'      => __( 'Position', 'essential-addons-for-elementor-lite' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [
				'px',
				'rem',
			],
			'selectors'  => [
				$icon => "position:relative; top: {{TOP}}{{UNIT}};right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};",
			],
		] );
		$this->add_control( 'field_icon_size_margin_color', [
			'label'     => __( 'Color', 'essential-addons-for-elementor-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [ $icon => 'color:{{VALUE}}' ],
		] );
		$this->end_controls_section();
	}

	public static function render_compare_table( $options ) {
		$products               = $fields = [];
		$highlighted_product_id = null;
		$theme_wrap_class       = $theme = $title = $ribbon = $repeat_price = $repeat_add_to_cart = $linkable_img = '';
		extract( $options );
		do_action( 'eael/wcpc/before_content_wrapper' ); ?>
        <div class="eael-wcpc-wrapper woocommerce <?php echo esc_attr( $theme_wrap_class ); ?>">
			<?php do_action( 'eael/wcpc/before_main_table' ); ?>
            <table class="eael-wcpc-table table-responsive">
                <tbody>
				<?php if ( empty( $products ) ) { ?>

                    <tr class="no-products">
                        <td><?php esc_html_e( 'No products added to compare.', 'essential-addons-for-elementor-lite' ) ?></td>
                    </tr>

				<?php } else {

					// for product grid, show remove button
					if ( 'Essential_Addons_Elementor\Elements\Woo_Product_Compare' !== self::class ) {
						echo '<tr class="remove-row"><th class="remove-th">&nbsp;</th>';
						$rm_index = 0;
						foreach ( $products as $product_id => $product ) {
							?>
                            <td class="rm-col<?php echo esc_attr( $rm_index ); ?>">
                                <i class="fas fa-trash eael-wc-remove" data-product-id="<?php echo esc_attr( $product_id ); ?>" title="<?php esc_attr_e( 'Remove', 'essential-addons-for-elementor-lite' ); ?>"></i>
                            </td>
							<?php
							$rm_index ++;
						}
						echo '</tr>';
					}

					$count = 1;
					foreach ( $fields as $field => $name ) {
						$f_heading_class = 1 === $count ? 'first-th' : '';
						$count ++;
						?>
                        <tr class="<?php echo esc_attr( $field ); ?>">
                            <th class="thead <?php echo esc_attr( $f_heading_class ); ?>">
                                <div>
									<?php if ( $field === 'image' ) {
										if ( ! empty( $title ) ) {
											printf( "<h1 class='wcpc-title'>%s</h1>", esc_html( $title ) );
										}
									} else {
										if ( ! empty( $icon ) ) {
											self::print_icon( $icon );
										}
										if ( 'theme-5' === $theme && $field === 'title' ) {
											echo '&nbsp;';
										} else {
											printf( '<span class="field-name">%s</span>', esc_html( $name ) );

										}
									} ?>
                                </div>
                            </th>

							<?php
							$index = 0;
							/**
							 * @var int $product_id
                             * @var WC_Product $product */
							foreach ( $products as $product_id => $product ) {
								$is_highlighted = $product_id === $highlighted_product_id;
								$highlighted    = $is_highlighted ? 'featured' : '';
								$product_class  = ( $index % 2 == 0 ? 'odd' : 'even' ) . " col_{$index} product_{$product_id} $highlighted" ?>
                                <td class="<?php echo esc_attr( $product_class ); ?>">
                                    <span>
                                    <?php
                                    if ( $field === 'image' ) {
	                                    echo '<span class="img-inner">';
	                                    if ( 'theme-4' === $theme && $is_highlighted && $ribbon ) {
		                                    printf( '<span class="ribbon">%s</span>', esc_html( $ribbon ) );
	                                    }

	                                    if ( 'yes' === $linkable_img ) {
                                            printf( "<a href='%s'>", esc_url( $product->get_permalink()));
	                                    }
                                    }

                                    echo ! empty( $product->fields[ $field ] ) ? $product->fields[ $field ] : '&nbsp;';

                                    if ( $field === 'image' ) {
	                                    if ( 'yes' === $linkable_img ) {
		                                    echo '</a>';
	                                    }
	                                    if ( 'theme-4' === $theme ) {
		                                    echo ! empty( $product->fields['title'] ) ? sprintf( "<p class='product-title'>%s</p>", esc_html( $product->fields['title'] ) ) : '&nbsp;';
		                                    echo ! empty( $product->fields['price'] ) ? wp_kses_post( $product->fields['price'] ) : '&nbsp;';
	                                    }
	                                    echo '</span>';
                                    }
                                    ?>
                                    </span>
                                </td>

								<?php
								++ $index;
							}
							?>

                        </tr>

					<?php } ?>

					<?php if ( 'yes' === $repeat_price && isset( $fields['price'] ) ) : ?>
                        <tr class="price repeated">
                            <th>
                                <div>
									<?php
									if ( ! empty( $icon ) ) {
										self::print_icon( $icon );
									}
									echo wp_kses_post( $fields['price'] ) ?>
                                </div>
                            </th>

							<?php
							$index             = 0;
							foreach ( $products as $product_id => $product ) :
								$highlighted = $product_id === $highlighted_product_id ? 'featured' : '';
								$product_class = ( $index % 2 == 0 ? 'odd' : 'even' ) . " col_{$index} product_{$product_id} $highlighted" ?>
                                <td class="<?php echo esc_attr( $product_class ) ?>"><?php echo wp_kses_post( $product->fields['price'] ); ?></td>
								<?php
								++ $index;
							endforeach; ?>

                        </tr>
					<?php endif; ?>

					<?php if ( 'yes' === $repeat_add_to_cart && isset( $fields['add-to-cart'] ) ) : ?>
                        <tr class="add-to-cart repeated">
                            <th>
                                <div>
									<?php
									if ( ! empty( $icon ) ) {
										self::print_icon( $icon );
									}
									echo wp_kses_post( $fields['add-to-cart'] ); ?>
                                </div>
                            </th>

							<?php
							$index             = 0;
							foreach ( $products as $product_id => $product ) :
								$highlighted = $product_id === $highlighted_product_id ? 'featured' : '';
								$product_class = ( $index % 2 == 0 ? 'odd' : 'even' ) . " col_{$index} product_{$product_id} $highlighted" ?>
                                <td class="<?php echo esc_attr( $product_class ); ?>">
									<?php woocommerce_template_loop_add_to_cart(); ?>
                                </td>
								<?php
								++ $index;
							endforeach; ?>

                        </tr>
					<?php endif; ?>

				<?php } ?>
                </tbody>
            </table>
			<?php do_action( 'eael/wcpc/after_main_table' ); ?>
        </div>
		<?php do_action( 'eael/wcpc/after_content_wrapper' );
	}

	/**
	 * It will apply value like Elementor's dimension control to a property
	 * and return it.
	 *
	 * @param string $css_property CSS property name
	 *
	 * @return string
	 */
	public function apply_dim( $css_property ) {
		return "{$css_property}: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};";
	}

	/**
	 * Return the array with all products and all attributes values
	 *
	 * @param array $products ids of wc product
	 *
	 * @return array The complete list of products with all attributes value
	 */
	public function get_products_list( $products = [] ) {
		$products_list = [];
		if ( empty( $products ) ) {
			$products = $this->products_list;
		}

		$products = apply_filters( 'eael/wcpc/products_ids', $products );
		$fields   = $this->fields( $products );
		global $product;
		if ( ! empty( $products ) && is_array( $products ) ) {
			foreach ( $products as $product_id ) {
				/** @type WC_Product $product WooCommerce Product */
				$product = wc_get_product( $product_id );
				if ( ! $product ) {
					continue;
				}

				$product->fields = [];

				// custom attributes
				foreach ( $fields as $field => $name ) {
					switch ( $field ) {
						case 'title':
							$product->fields[ $field ] = $product->get_title();
							break;
						case 'price':
							$product->fields[ $field ] = $product->get_price_html();
							break;
						case 'add-to-cart':
							ob_start();
							woocommerce_template_loop_add_to_cart();
							$product->fields[ $field ] = ob_get_clean();
							break;
						case 'image':
							$product->fields[ $field ] = $product->get_image();
							break;
						case 'description':
							$description               = apply_filters( 'woocommerce_short_description', $product->get_short_description() ? $product->get_short_description() : wc_trim_string( $product->get_description(), 400 ) );
							$product->fields[ $field ] = apply_filters( 'eael/wcpc/woocommerce_short_description', $description );
							break;
						case 'stock':
							$availability = $product->get_availability();
							if ( empty( $availability['availability'] ) ) {
								$availability['availability'] = __( 'In stock', 'essential-addons-for-elementor-lite' );
							}
							$product->fields[ $field ] = sprintf( '<span>%s</span>', esc_html( $availability['availability'] ) );
							break;
						case 'sku':
							$sku = $product->get_sku();
							! $sku && $sku = '-';
							$product->fields[ $field ] = $sku;
							break;
						case 'weight':
							if ( $weight = $product->get_weight() ) {
								$weight = wc_format_localized_decimal( $weight ) . ' ' . esc_attr( get_option( 'woocommerce_weight_unit' ) );
							} else {
								$weight = '-';
							}
							$product->fields[ $field ] = sprintf( '<span>%s</span>', esc_html( $weight ) );
							break;
						case 'dimension':
							$dimensions = function_exists( 'wc_format_dimensions' ) ? wc_format_dimensions( $product->get_dimensions( false ) ) : $product->get_dimensions();
							! $dimensions && $dimensions = '-';
							$product->fields[ $field ] = sprintf( '<span>%s</span>', esc_html( $dimensions ) );
							break;
						default:
							if ( taxonomy_exists( $field ) ) {
								$product->fields[ $field ] = [];
								$terms                     = get_the_terms( $product_id, $field );
								if ( ! empty( $terms ) && is_array( $terms ) ) {
									foreach ( $terms as $term ) {
										$term                        = sanitize_term( $term, $field );
										$product->fields[ $field ][] = $term->name;
									}
								}
								if ( ! empty( $product->fields[ $field ] ) ) {
									$product->fields[ $field ] = implode( ', ', $product->fields[ $field ] );
								} else {
									$product->fields[ $field ] = '-';
								}
							} else {
								do_action( 'eael/wcpc/compare_field_' . $field, [
									$product,
									&$product->fields,
								] );
							}
							break;
					}
				}

				$products_list[ $product_id ] = $product;
			}
		}

		return apply_filters( 'eael/wcpc/products_list', $products_list );
	}

	/**
	 * Get the fields to show in the comparison table
	 *
	 * @param array $products Optional array of products ids
	 *
	 * @return array $fields it returns an array of fields to show on the comparison table
	 */
	public function fields( $products = [] ) {
		$fields = $this->get_settings_for_display( 'fields' );
		if ( empty( $fields ) || ! is_array( $fields ) ) {
			return apply_filters( 'eael/wcpc/products_fields_none', [] );
		}

		$df             = $this->get_field_types();
		$fields_to_show = [];
		foreach ( $fields as $field ) {
			if ( isset( $df[ $field['field_type'] ] ) ) {
				$fields_to_show[ $field['field_type'] ] = $field['field_label'];
			} else {
				if ( taxonomy_exists( $field['field_type'] ) ) {
					$fields_to_show[ $field['field_type'] ] = wc_attribute_label( $field['field_type'] );
				}
			}
		}

		return apply_filters( 'eael/wcpc/products_fields_to_show', $fields_to_show, $products );
	}

	public function get_product_remove_url( $product_id ) {
		$url_args = [
			'action' => $this->remove_action,
			'id'     => $product_id,
		];

		return apply_filters( 'eael/wcpc/get_product_remove_url', esc_url_raw( add_query_arg( $url_args, site_url() ) ), $this->remove_action );
	}

	public static function print_icon( $icon ) {
		if ( ! empty( $icon['value'] ) && ! empty( $icon['library'] ) ) {
			Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] );
		}
	}

	// static methods for product grids only
	public static function print_compare_button( $id ) {
		printf( '<button class="eael-wc-compare button" data-product-id="%d" rel="nofollow">%s</button>', intval( $id, 10 ), __( 'Compare', 'essential-addons-for-elementor-lite' ) );
	}

	public function get_compare_table() {
		$ajax      = wp_doing_ajax();
		$page_id   = 0;
		$widget_id = 0;

		if ( ! empty( $_POST['page_id'] ) ) {
			$page_id = intval( $_POST['page_id'], 10 );
		} else {
			$err_msg = __( 'Page ID is missing', 'essential-addons-for-elementor-lite' );
		}
		if ( ! empty( $_POST['widget_id'] ) ) {
			$widget_id = sanitize_text_field( $_POST['widget_id'] );
		} else {
			$err_msg = __( 'Widget ID is missing', 'essential-addons-for-elementor-lite' );
		}
		if ( ! empty( $_POST['product_id'] ) ) {
			$product_id = sanitize_text_field( $_POST['product_id'] );
		} else {
			$err_msg = __( 'Product ID is missing', 'essential-addons-for-elementor-lite' );
		}
		$product_ids = get_transient( 'eael_product_compare_ids' );
		if ( ! empty( $product_id ) ) {
			$p_exist = ! empty( $product_ids ) && is_array( $product_ids );
			if ( ! empty( $_POST['remove_product'] ) && $p_exist ) {
				unset( $product_ids[ $product_id ] );
			} else {
				if ( $p_exist ) {
					$product_ids[ $product_id ] = $product_id;
				} else {
					$product_ids = [ $product_id => $product_id ];
				}
			}
		}

		$this->eael_set_transient( 'eael_product_compare_ids', $product_ids );


		if ( ! empty( $err_msg ) ) {
			if ( $ajax ) {
				wp_send_json_error( $err_msg );
			}

			return false;
		}
		if ( empty( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'eael_product_grid' ) ) {
			if ( $ajax ) {
				wp_send_json_error( __( 'Security token did not match', 'essential-addons-for-elementor-lite' ) );
			}

			return false;
		}
		$product_ids = array_values( $product_ids );
		$ds          = $this->eael_get_widget_settings( $page_id, $widget_id );
		$products    = self::static_get_products_list( $product_ids, $ds );
		$fields      = self::static_fields( $product_ids, $ds );

		$title                  = isset( $ds['table_title'] ) ? $ds['table_title'] : '';
		$ribbon                 = isset( $ds['ribbon'] ) ? $ds['ribbon'] : '';
		$repeat_price           = isset( $ds['repeat_price'] ) ? $ds['repeat_price'] : '';
		$repeat_add_to_cart     = isset( $ds['repeat_add_to_cart'] ) ? $ds['repeat_add_to_cart'] : '';
		$linkable_img     = isset( $ds['linkable_img'] ) ? $ds['linkable_img'] : '';
		$highlighted_product_id = ! empty( $ds['highlighted_product_id'] ) ? $ds['highlighted_product_id'] : null;
		$icon                   = ! empty( $ds['field_icon'] ) && ! empty( $ds['field_icon']['value'] ) ? $ds['field_icon'] : [];
		$theme_wrap_class       = $theme = '';
		if ( ! empty( $ds['theme'] ) ) {
			$theme            = esc_attr( $ds['theme'] );
			$theme_wrap_class = " custom {$theme}";
		}
		ob_start();
		self::render_compare_table( compact( 'products', 'fields', 'title', 'highlighted_product_id', 'theme_wrap_class', 'theme', 'ribbon', 'repeat_price', 'repeat_add_to_cart', 'icon', 'linkable_img' ) );
		$table = ob_get_clean();
		wp_send_json_success( [ 'compare_table' => $table ] );

		return null;
	}

	/**
	 * Return the array with all products and all attributes values
	 *
	 * @param array $products ids of wc product
	 * @param array $settings
	 *
	 * @return array The complete list of products with all attributes value
	 */
	public static function static_get_products_list( $products = [], $settings = [] ) {
		$products_list = [];

		$products = apply_filters( 'eael/wcpc/products_ids', $products );
		$fields   = self::static_fields( $products, $settings );

		global $product;
		if ( ! empty( $products ) && is_array( $products ) ) {
			foreach ( $products as $product_id ) {
				/** @type WC_Product $product WooCommerce Product */
				$product = wc_get_product( $product_id );
				if ( ! $product ) {
					continue;
				}

				$product->fields = [];

				// custom attributes
				foreach ( $fields as $field => $name ) {
					switch ( $field ) {
						case 'title':
							$product->fields[ $field ] = $product->get_title();
							break;
						case 'price':
							$product->fields[ $field ] = $product->get_price_html();
							break;
						case 'add-to-cart':
							ob_start();
							woocommerce_template_loop_add_to_cart();
							$product->fields[ $field ] = ob_get_clean();
							break;
						case 'image':
							$product->fields[ $field ] = $product->get_image();
							break;
						case 'description':
							$description               = apply_filters( 'woocommerce_short_description', $product->get_short_description() ? $product->get_short_description() : wc_trim_string( $product->get_description(), 400 ) );
							$product->fields[ $field ] = apply_filters( 'eael/wcpc/woocommerce_short_description', $description );
							break;
						case 'stock':
							$availability = $product->get_availability();
							if ( empty( $availability['availability'] ) ) {
								$availability['availability'] = __( 'In stock', 'essential-addons-for-elementor-lite' );
							}
							$product->fields[ $field ] = sprintf( '<span>%s</span>', esc_html( $availability['availability'] ) );
							break;
						case 'sku':
							$sku = $product->get_sku();
							! $sku && $sku = '-';
							$product->fields[ $field ] = $sku;
							break;
						case 'weight':
							if ( $weight = $product->get_weight() ) {
								$weight = wc_format_localized_decimal( $weight ) . ' ' . esc_attr( get_option( 'woocommerce_weight_unit' ) );
							} else {
								$weight = '-';
							}
							$product->fields[ $field ] = sprintf( '<span>%s</span>', esc_html( $weight ) );
							break;
						case 'dimension':
							$dimensions = function_exists( 'wc_format_dimensions' ) ? wc_format_dimensions( $product->get_dimensions( false ) ) : $product->get_dimensions();
							if ( empty( $dimensions ) ) {
								$dimensions = '-';
							}
							$product->fields[ $field ] = sprintf( '<span>%s</span>', esc_html( $dimensions ) );
							break;
						default:
							if ( taxonomy_exists( $field ) ) {
								$product->fields[ $field ] = [];
								$terms                     = get_the_terms( $product_id, $field );
								if ( ! empty( $terms ) && is_array( $terms ) ) {
									foreach ( $terms as $term ) {
										$term                        = sanitize_term( $term, $field );
										$product->fields[ $field ][] = $term->name;
									}
								}

								if ( ! empty( $product->fields[ $field ] ) ) {
									$product->fields[ $field ] = implode( ', ', $product->fields[ $field ] );
								} else {
									$product->fields[ $field ] = '-';
								}
							} else {
								do_action( 'eael/wcpc/compare_field_' . $field, [
									$product,
									&$product->fields,
								] );
							}
							break;
					}
				}

				$products_list[ $product_id ] = $product;
			}
		}

		return apply_filters( 'eael/wcpc/products_list', $products_list );
	}

	/**
	 * Get the fields to show in the comparison table
	 *
	 * @param array $products Optional array of products ids
	 * @param array $settings
	 *
	 * @return array $fields it returns an array of fields to show on the comparison table
	 */
	public static function static_fields( $products = [], $settings = [] ) {
		if ( empty( $settings['fields'] ) || ! is_array( $settings['fields'] ) ) {
			return apply_filters( 'eael/wcpc/products_fields_none', [] );
		}
		$fields         = $settings['fields'];
		$df             = self::get_field_types();
		$fields_to_show = [];
		foreach ( $fields as $field ) {
			if ( isset( $df[ $field['field_type'] ] ) ) {
				$fields_to_show[ $field['field_type'] ] = $field['field_label'];
			} else {
				if ( taxonomy_exists( $field['field_type'] ) ) {
					$fields_to_show[ $field['field_type'] ] = wc_attribute_label( $field['field_type'] );
				}
			}
		}

		return apply_filters( 'eael/wcpc/products_fields_to_show', $fields_to_show, $products );
	}

}
