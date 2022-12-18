<?php
namespace Essential_Addons_Elementor\Elements;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use \Elementor\Plugin;
use \Elementor\Utils;
use \Elementor\Widget_Base;
use \Essential_Addons_Elementor\Classes\Helper;
use ParagonIE\Sodium\Core\Curve25519\Ge\P2;

class Business_Reviews extends Widget_Base {
	
	public function get_name() {
		return 'eael-business-reviews';
	}

	public function get_title() {
		return esc_html__( 'Business Reviews', 'essential-addons-for-elementor-lite' );
	}

	public function get_icon() {
		return 'eaicon-nft-gallery';
	}

	public function get_categories() {
		return [ 'essential-addons-elementor' ];
	}

	public function get_keywords() {
		return [
			'reviews',
			'business reviews',
			'ea business reviews',
			'google reviews',
			'ea google reviews',
			'ea',
			'essential addons'
		];
	}

	public function get_custom_help_url() {
		return 'https://essential-addons.com/elementor/docs/business-reviews/';
	}

	protected function register_controls() {

		/**
		 * Business Reviews Settings
		 */
		$this->start_controls_section(
			'eael_section_business_reviews_general_settings',
			[
				'label' => esc_html__( 'Query', 'essential-addons-for-elementor-lite' ),
			]
		);

		$this->add_control(
			'eael_business_reviews_sources',
			[
				'label'   => __( 'Source', 'essential-addons-for-elementor-lite' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'google-reviews',
				'options' => [
					'google-reviews' => __( 'Google Reviews', 'essential-addons-for-elementor-lite' ),
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Business Reviews Layout Settings
		 */
		$this->start_controls_section(
			'eael_section_business_reviews_layout_settings',
			[
				'label' => esc_html__( 'Layout', 'essential-addons-for-elementor-lite' ),
			]
		);

		$this->end_controls_section();

		/**
		 * Business Reviews Content
		 */
		$this->start_controls_section(
			'eael_section_business_reviews_content',
			[
				'label' => esc_html__( 'Content', 'essential-addons-for-elementor-lite' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		printf('%', esc_html('Hello Business Reviews'));
	}
}