<?php
namespace Essential_Addons_Elementor\Elements;

if (!defined('ABSPATH')) { exit; }

use \Elementor\Controls_Manager;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;

class Sticky_Video extends Widget_Base {
	use \Essential_Addons_Elementor\Traits\Helper;

	public function get_name() {
		return 'eael-sticky-video';
	}

	public function get_title() {
		return esc_html__( 'EA Sticky Video', 'essential-addons-elementor' );
	}

	public function get_icon() {
		return 'eicon-youtube';
	}

   public function get_categories() {
		return [ 'essential-addons-elementor' ];
	}
	
	protected function _register_controls() {
		//add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'eaelsv_custom_scripts' ] );

		/** 
		 * Sticky Option Starts
		*/
		$this->start_controls_section(
			'eaelsv_sticky_option_section',
			[
				'label' => __( 'Sticky Options', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eaelsv_is_sticky',
			[
				'label'         => __( 'Sticky', 'essential-addons-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_block' 	=> false,
				'label_on'		=> __( 'On', 'essential-addons-elementor' ),
				'label_off'    	=> __( 'Off', 'essential-addons-elementor' ),
				'return_value'	=> 'yes',
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} div.eaelsv-sticky-player'  => 'display: block',
				]
            ]
		);

		$this->add_control(
			'eaelsv_sticky_position',
			[
				'label'     => __( 'Position', 'essential-addons-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'options'	=> [
					'top-left'   	=> __( 'Top Left', 'essential-addons-elementor' ),
					'top-right'     => __( 'Top Right', 'essential-addons-elementor' ),
					'bottom-left'	=> __( 'Bottom Left', 'essential-addons-elementor' ),
					'bottom-right'	=> __( 'Bottom Right', 'essential-addons-elementor' ),
				],
				'default' 	=> 'bottom-right',
				'condition'     => [
                    'eaelsv_is_sticky' => 'yes'
                ]
            ]
		);

		$this->end_controls_section();
		//========================================

  		$this->start_controls_section(
  			'eael_section_video_settings',
  			[
				'label' => esc_html__( 'Video', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
  			]
		);

		$this->add_control(
			'eael_video_source',
			[
				'label'         => __( 'Source', 'essential-addons-elementor' ),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'youtube',
                'options'       => [
					'youtube'   	=> __( 'YouTube', 'essential-addons-elementor' ),
					'vimeo'       	=> __( 'Vimeo', 'essential-addons-elementor' ),
					//'dailymotion'	=> __( 'Dailymotion', 'essential-addons-elementor' ),
					'self_hosted'	=> __( 'Self Hosted', 'essential-addons-elementor' ),
				],
            ]
		);
		
		$this->add_control(
			'eaelsv_link_youtube',
			[
				'label'         => __( 'Link', 'essential-addons-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'placeholder'   => __( 'Enter your URL (YouTube)', 'essential-addons-elementor' ),
				'label_block' 	=> true,
				'default'       => 'https://www.youtube.com/watch?v=uuyXfUDqRZM',
                'condition'     => [
                    'eael_video_source' => 'youtube'
                ]
            ]
		);
		
		$this->add_control(
			'eaelsv_link_vimeo',
			[
				'label'         => __( 'Link', 'essential-addons-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'placeholder'   => __( 'Enter your URL (Vimeo)', 'essential-addons-elementor' ),
				'label_block' 	=> true,
				'default'		=> 'https://vimeo.com/235215203',
                'condition'     => [
                    'eael_video_source' => 'vimeo'
                ]
            ]
		);
		
		$this->add_control(
			'eaelsv_link_dailymotion',
			[
				'label'         => __( 'Link', 'essential-addons-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'placeholder'   => __( 'Enter your URL (Dailymotion)', 'essential-addons-elementor' ),
				'label_block' => true,
                'condition'     => [
                    'eael_video_source' => 'dailymotion'
                ]
            ]
		);
		
		$this->add_control(
			'eaelsv_link_external',
			[
				'label'         => __( 'External URL', 'essential-addons-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_block' => false,
                'condition'     => [
					'eael_video_source' => 'self_hosted',
					//'eaelsv_link_external' => 'yes'
                ]
            ]
		);

		$this->add_control(
			'eaelsv_hosted_url',
			[
				'label' => __( 'Choose File', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::MEDIA_CATEGORY,
					],
				],
				'media_type' => 'video',
				'condition' => [
					'eael_video_source' => 'self_hosted',
					'eaelsv_link_external' => '',
				],
			]
		);
		
		$this->add_control(
			'eaelsv_external_url',
			[
				'label'         => __( 'Link', 'essential-addons-elementor' ),
				'type'          => Controls_Manager::TEXT,
				'placeholder'   => __( 'Enter your URL', 'essential-addons-elementor' ),
				'label_block' => true,
				'show_label'  => false,
                'condition'     => [
					'eael_video_source' => 'self_hosted',
                    'eaelsv_link_external' => 'yes'
                ]
            ]
		);

		$this->add_control(
			'eael_video_self_hosted_link',
			[
				'label'     => __( 'Choose File', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::MEDIA,
				'label_block' => true,
				'condition'     => [
					'eael_video_source' => 'self_hosted',
					'eael_video_source_external' => ''
                ]
             ]
		);
		
		$this->add_control(
			'eaelsv_start_time',
			[
				'label' => __( 'Start Time', 'essential-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10000,
				'step' => 1,
				'default' => '',
				'description' => 'Specify a start time (in seconds)',
			]
		);

		$this->add_control(
			'eaelsv_end_time',
			[
				'label' => __( 'End Time', 'essential-addons-elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10000,
				'step' => 1,
				'default' => '',
				'description' => 'Specify an end time (in seconds)',
			]
		);

		$this->add_control(
			'eael_video_video_options',
			[
				'label' => __( 'Video Options', 'essential-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'eaelsv_autopaly',
			[
				'label'         => __( 'Autoplay', 'essential-addons-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_block' => false,
				'return_value' => 'yes',
				'default' => '',
				/*
				'selectors' => [
					'{{WRAPPER}} .default__button--big' => 'display: none;',
					'{{WRAPPER}} .compact__button--big' => 'display: none;',
				],
				*/
            ]
		);

		$this->add_control(
			'eaelsv_mute',
			[
				'label'         => __( 'Mute', 'essential-addons-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_block' => false,
				'return_value' => 'yes',
				'default' => '',
            ]
		);

		$this->add_control(
			'eaelsv_loop',
			[
				'label'         => __( 'Loop', 'essential-addons-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_block' => false,
				'return_value' => 'yes',
				'default' => '',
            ]
		);
		/*
		$this->add_control(
			'eaelsv_display_options',
			[
				'label' => __( 'Display', 'essential-addons-elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'     => [
					'eael_video_source' => 'self_hosted'
                ]
			]
		);
		*/
		$this->add_control(
			'eaelsv_sh_show_bar',
			[
				'label'         => __( 'Show Bar', 'essential-addons-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_block' => false,
				'default' => 'yes',
				'condition'     => [
					'eael_video_source' => 'self_hosted'
				],
				'selectors' => [
					'{{WRAPPER}} .ckin__controls' => 'display: flex!important;',
                ],
            ]
		);

		$this->end_controls_section();


		//=========================================================================
		$this->start_controls_section(
			'eael_video_image_overlay_section',
			[
				'label' => __( 'Image Overlay', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eaelsv_overlay_options',
			[
				'label'         => __( 'Image Overlay', 'essential-addons-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_block' => false,
				'label_on' => __( 'Show', 'essential-addons-elementor' ),
				'label_off' => __( 'Hide', 'essential-addons-elementor' ),
				'return_value' => 'yes',
				'default' => '',
            ]
		);

		$this->add_control(
			'eaelsv_overlay_image',
			[
				'label'     => __( 'Choose Image1', 'essential-addons-elementor' ),
				'type'      => Controls_Manager::MEDIA,
				'label_block' => true,
				'condition'     => [
					'eaelsv_overlay_options' => 'yes'
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'selectors' => [
                   	//'{{WRAPPER}} div.eael-sticky-video-player'  => 'background-image: url("'.\Elementor\Utils::get_placeholder_image_src().'")'
				]
            ]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'default'   => 'full',
				'name'      => 'eaelsv_overlay_image_size',
				'condition'     => [
					'eaelsv_overlay_options' => 'yes'
				],
            ]
		);
		
		$this->add_control(
			'eaelsv_overlay_play_icon',
			[
				'label'         => __( 'Play Icon', 'essential-addons-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_block' => false,
				'return_value' => 'yes',
				'default' => 'yes',
				'condition'     => [
					'eaelsv_overlay_options' => 'yes'
				],
            ]
		);

		$this->add_control(
			'eaelsv_icon_new',
			[
				'label' => esc_html__( 'Icon', 'essential-addons-elementor' ),
				'type'  => Controls_Manager::ICONS,
				'fa4compatibility' => 'eaelsv_icon',
				'condition'     => [
					'eaelsv_overlay_options' => 'yes',
					'eaelsv_overlay_play_icon' => 'yes'
				],
			]
		);
		/*
		$this->add_control(
			'eael_video_image_overlay_lightbox',
			[
				'label'         => __( 'Lightbox', 'essential-addons-elementor' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_block' => false,
				'label_on' => __( 'On', 'essential-addons-elementor' ),
				'label_off' => __( 'Off', 'essential-addons-elementor' ),
				'return_value' => 'yes',
				'default' => '',
				'condition'     => [
					'eaelsv_overlay_options' => 'yes'
				],
				'separator' => 'before',
            ]
		);
		*/
		$this->end_controls_section();
		//===================================================================

		/**
		 * Style Tab Started
		 */
		$this->start_controls_section(
			'eaelsv_sticky_video_interface',
			[
				'label' => __( 'Sticky Video Interface', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'     => [
                    'eaelsv_is_sticky' => 'yes'
                ]
			]
		);

		

		$this->add_control(
			'eaelsv_sticky_width',
			[
				'label'     => __( 'Width', 'essential-addons-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
						'min' => 100,
						'max' => 500,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 300,
				],
				'condition'     => [
                    'eaelsv_is_sticky' => 'yes'
                ],
				'selectors' => [
					'{{WRAPPER}} div.eaelsv-sticky-player'  => 'width: {{SIZE}}px;',
					'{{WRAPPER}} div.eael-sticky-video-wrapper.out'  => 'width: {{SIZE}}px!important;'
				]
            ]
        );
		
		$this->add_control(
			'eaelsv_sticky_height',
			[
				'label'     => __( 'Height', 'essential-addons-elementor' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
						'min' => 100,
						'max' => 500,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 200,
				],
				'condition'     => [
                    'eaelsv_is_sticky' => 'yes'
                ],
				'selectors' => [
					'{{WRAPPER}} div.eaelsv-sticky-player'  => 'height: {{SIZE}}px;',
					'{{WRAPPER}} div.eael-sticky-video-wrapper.out'  => 'height: {{SIZE}}px!important;'
				]
            ]
		);

		$this->add_control(
			'eaelsv_sticky_close_button_color',
			[
				'label' => __( 'Close Button Color', 'essential-addons-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				/*
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				*/
				'condition'	=> [
                    'eaelsv_is_sticky' => 'yes'
                ],
				'selectors' => [
					'{{WRAPPER}} .eaelsv-sticky-player-close' => 'color: {{VALUE}}!important',
				],
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'eaelsv_sh_player_section',
			[
				'label' => __( 'Player', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'eaelsv_sh_video_width',
			[
				'label'      => esc_html__( 'Width', 'essential-addons-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					//'{{WRAPPER}} .ckin__player' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .eael-sticky-video-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'eaelsv_sh_video_border_type',
			[
				'label'     => __( 'Border Type', 'essential-addons-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'none',
                'options'	=> [
					'none'   	=> __( 'None', 'essential-addons-elementor' ),
					'solid'     => __( 'Solid', 'essential-addons-elementor' ),
					'double'	=> __( 'Double', 'essential-addons-elementor' ),
					'dotted'	=> __( 'Dotted', 'essential-addons-elementor' ),
					'dashed'	=> __( 'Dashed', 'essential-addons-elementor' ),
				],
				'selectors' => [
					//'{{WRAPPER}} .ckin__player' => 'border-style: {{VALUE}};',
					'{{WRAPPER}} .eael-sticky-video-wrapper' => 'border-style: {{VALUE}};',
				],
            ]
		);

		$this->add_responsive_control(
            'eaelsv_sh_video_border_width',
            [
                'label' => esc_html__('Border Width', 'essential-addons-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    //'{{WRAPPER}} .ckin__player' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .eael-sticky-video-wrapper' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            ]
		);
		
		$this->add_control(
            'eaelsv_sh_video_border_color',
            [
                'label' => esc_html__('Border Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
					//'{{WRAPPER}} .ckin__player' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .eael-sticky-video-wrapper' => 'border-color: {{VALUE}};',
                ],
            ]
		);
		
		$this->add_responsive_control(
            'eaelsv_sh_video_border_radius',
            [
                'label' => esc_html__('Border Radius', 'essential-addons-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    //'{{WRAPPER}} .ckin__player' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .eael-sticky-video-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .eaelsv-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .eael-sticky-video-player2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'eaelsv_sh_player_interface_section',
			[
				'label' => __( 'Interface', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eaelsv_sh_video_skin',
			[
				'label'     => __( 'Player Skin', 'essential-addons-elementor' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'default',
                'options'	=> [
					'default'	=> __( 'Default', 'essential-addons-elementor' ),
					'compact'	=> __( 'Compact', 'essential-addons-elementor' ),
				],
				'condition'     => [
					'eael_video_source' => 'self_hosted',
                ]
            ]
		);

		$this->add_control(
            'eaelsv_sh_video_interface_color',
            [
                'label' => esc_html__('Interface Color', 'essential-addons-elementor'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ADD8E6',
            ]
		);

		$this->add_responsive_control(
            'eaelsv_sh_play_button_size',
            [
                'label' => __('Play Button Size', 'essential-addons-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 64,
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 64,
                        'max' => 192,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
					'{{WRAPPER}} .default__button--big' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .compact__button--big' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition'     => [
					'eael_video_source' => 'self_hosted',
				]
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'eaelsv_sh_player_bar_section',
			[
				'label' => __( 'Bar', 'essential-addons-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'     => [
					'eael_video_source' => 'self_hosted',
				]
			]
		);

		$this->add_responsive_control(
            'eaelsv_sh_player_bar_padding',
            [
                'label' => __('Bar Padding', 'essential-addons-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
					'{{WRAPPER}} .compact__controls' => 'padding: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .default__controls' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
		);
		
		$this->add_responsive_control(
            'eaelsv_sh_bar_button_size',
            [
                'label' => __('Button Size', 'essential-addons-elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 12,
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 12,
                        'max' => 32,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
					'{{WRAPPER}} .default__button' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .compact__button' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
		);
		
		$this->add_responsive_control(
            'eaelsv_sh_bar_margin',
            [
                'label' => esc_html__('Bar Margin', 'essential-addons-elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
					'{{WRAPPER}} .default__controls' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .compact__controls' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);

		$this->end_controls_section();
    }

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id = $this->eaelsv_get_url_id($settings);
		$iconNew = $settings['eaelsv_icon_new'];
		$st = $settings['eaelsv_start_time'];
		$et = $settings['eaelsv_end_time'];
		$sticky = $settings['eaelsv_is_sticky'];
		$stickyCloseColor = $settings['eaelsv_sticky_close_button_color'];
		if( 'youtube' == $settings['eael_video_source'] ){
			$eaelsvPlayer = $this->eaelsv_load_player_youtube($settings);
		}
		if( 'vimeo' == $settings['eael_video_source'] ){
			$eaelsvPlayer = '';
			$eaelsvPlayer = $this->eaelsv_load_player_vimeo($settings);
		}
		if( 'self_hosted' == $settings['eael_video_source'] ){
			$eaelsvPlayer = $this->eaelsv_load_player_self_hosted($settings);
		}
		?>
		<div class="eael-sticky-video-wrapper">
		<?php
		if('yes' === $settings['eaelsv_overlay_options']){
			if('yes' === $settings['eaelsv_overlay_play_icon']):
				if($iconNew['value']!=''):
					$icon = $iconNew['value'];
				else:
					$icon = 'eicon-play';
				endif;
			endif;
			$this->add_render_attribute(
				'esvp_overlay_wrapper',
				[
					'class' => 'eaelsv-overlay',
					'style'	=> "background-image:url('".$settings['eaelsv_overlay_image']['url']."');",
				]
			);
			?>
			<div <?php echo $this->get_render_attribute_string( 'esvp_overlay_wrapper' ); ?>>
                <div class="eaelsv-overlay-icon"><i class="<?php echo esc_attr($icon); ?>"></i></div>
			</div>
		<?php 
		}
		$this->add_render_attribute(
			'esvp_overlay_wrapper2',
			[
				'class' 		=> 'eael-sticky-video-player2',
				'data-sticky'	=> $sticky,
				'data-position'	=> $settings['eaelsv_sticky_position'],
				'data-sheight'	=> $settings['eaelsv_sticky_height']['size'],
				'data-swidth'	=> $settings['eaelsv_sticky_width']['size'],
				'data-autoplay'	=> $settings['eaelsv_autopaly'],
				'data-overlay'	=> $settings['eaelsv_overlay_options'],
			]
		);
		?>
		<div <?php echo $this->get_render_attribute_string( 'esvp_overlay_wrapper2' ); ?>>
			<?php echo $eaelsvPlayer; ?>
		</div>
		<?php //endif; ?>
		<span class="eaelsv-sticky-player-close"><i class="fas fa-times-circle"></i></span>
		</div>

		<style>
		.eaelsv-overlay {
			position: absolute;
			display: block;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: rgba(0,0,0,0.5);
			z-index: 4;
			cursor: pointer;
			background-size: cover;
			background-position: 50%;
			text-align: center;
			overflow: hidden;
		}

		.eaelsv-overlay-icon{
			position: absolute;
			top: 50%;
			left: 50%;
			font-size: 90px;
			color: white;
			transform: translate(-50%,-50%);
			-ms-transform: translate(-50%,-50%);
		}
		</style>
		<?php
	}
	
	protected function render1() {
		$settings = $this->get_settings_for_display();
		$id = $this->eaelsv_get_url_id($settings);
		$iconNew = $settings['eaelsv_icon_new'];
		$st = $settings['eaelsv_start_time'];
		$et = $settings['eaelsv_end_time'];
		$sticky = $settings['eaelsv_is_sticky'];
		$stickyCloseColor = $settings['eaelsv_sticky_close_button_color'];
		if( 'youtube' == $settings['eael_video_source'] ){
			$eaelsvPlayer = $this->eaelsv_load_player_youtube($settings);
		}
		if( 'vimeo' == $settings['eael_video_source'] ){
			$eaelsvPlayer = '';
			$eaelsvPlayer = $this->eaelsv_load_player_vimeo($settings);
		}
		if( 'self_hosted' == $settings['eael_video_source'] ){
			$eaelsvPlayer = $this->eaelsv_load_player_self_hosted($settings);
		}
		?>
		<div class="eael-sticky-video-wrapper">
		<?php
		if('yes' === $settings['eaelsv_overlay_options']):
			if('yes' === $settings['eaelsv_overlay_play_icon']):
				if($iconNew['value']!=''):
					$icon = $iconNew['value'];
				else:
					$icon = 'eicon-play';
				endif;
			endif;
			$this->add_render_attribute(
				'esvp_overlay_wrapper',
				[
					'class' 		=> 'eael-sticky-video-player',
					'data-player' 	=> esc_attr($eaelsvPlayer),
					'data-sticky'	=> $sticky,
					'data-position'	=> $settings['eaelsv_sticky_position'],
					'data-sheight'	=> $settings['eaelsv_sticky_height']['size'],
					'data-swidth'	=> $settings['eaelsv_sticky_width']['size'],
					'style'	=> "background-image:url('".$settings['eaelsv_overlay_image']['url']."');",
				]
			);
			?>
			<div <?php echo $this->get_render_attribute_string( 'esvp_overlay_wrapper' ); ?>>
                <div class="owp-play"><i class="<?php echo esc_attr($icon); ?>"></i></div>
			</div>
		<?php else: 
			$this->add_render_attribute(
				'esvp_overlay_wrapper2',
				[
					'class' 		=> 'eael-sticky-video-player2',
					'data-sticky'	=> $sticky,
					'data-position'	=> $settings['eaelsv_sticky_position'],
					'data-sheight'	=> $settings['eaelsv_sticky_height']['size'],
					'data-swidth'	=> $settings['eaelsv_sticky_width']['size'],
					'data-autoplay'	=> $settings['eaelsv_autopaly'],
				]
			);
			?>
			<div <?php echo $this->get_render_attribute_string( 'esvp_overlay_wrapper2' ); ?>>
				<?php echo $eaelsvPlayer; ?>
			</div>
		<?php endif; ?>
		<span class="eaelsv-sticky-player-close"><i class="fas fa-times-circle"></i></span>
		</div>
		<?php
	}

	protected function eaelsv_load_player_youtube($settings){
		ob_start();
		$id = $this->eaelsv_get_url_id($settings);
		?>
		<div
			class="eaelsv-player-<?php echo rand(10,100); ?>" 
			data-plyr-provider="youtube" 
			data-plyr-embed-id="<?php echo esc_attr($id); ?>"
			data-plyr-config='{ "autoplay":1, "muted":0, "loop" : {"active":true} }'
		></div>
		<?php
		return ob_get_clean();
	}

	protected function eaelsv_load_player_vimeo($settings){
		ob_start();
		$id = $this->eaelsv_get_url_id($settings);
		?>
		<div 
			class="eaelsv-player-<?php echo rand(10,100); ?>" 
			data-plyr-provider="vimeo" 
			data-plyr-embed-id="<?php echo esc_attr($id); ?>"
			data-plyr-config='{ "hideControls":true, "autoplay":0, "muted":0, "loop" : {"active":true} }'
		></div>
		<?php
		return ob_get_clean();
	}

	protected function eaelsv_load_player_self_hosted($settings){
		ob_start();
		if($settings['eaelsv_external_url']!=''){
			$video = $settings['eaelsv_external_url'];
		} else{
			$video = $settings['eaelsv_hosted_url']['url'];
		}
		$controlBars = $settings['eaelsv_sh_show_bar'];
		$autoplay = $settings['eaelsv_autopaly'];
		$mute = $settings['eaelsv_mute'];
		$loop = $settings['eaelsv_loop'];
		$interfaceColor = $settings['eaelsv_sh_video_interface_color'];
		$skin = $settings['eaelsv_sh_video_skin'];
		$startTime = $settings['eaelsv_start_time'];
		$endTime = $settings['eaelsv_end_time'];
		?>
		<video  
			id="player1"
			class="eaelsv-player-<?php echo rand(10,100); ?>" 
			playsinline controls autoplay muted loop
		>
			<source 
			src="<?php echo esc_attr($video); ?>#t=<?php echo esc_attr($startTime); ?>,<?php echo esc_attr($endTime); ?>" 
			type="video/mp4" />
		</video>
		<?php
		return ob_get_clean();
	}

	protected function eaelsv_load_player_youtube1($settings){
		ob_start();
		$id = $this->eaelsv_get_url_id($settings);
		$autoplay = $settings['eaelsv_autopaly'];
		$mute = $settings['eaelsv_mute'];
		$loop = $settings['eaelsv_loop'];
		$startTime = $settings['eaelsv_start_time'];
		$endTime = $settings['eaelsv_end_time'];
		if($autoplay=='yes'){ 
			$am = "autoplay=1&mute=1";
		}
		if(('yes'== $mute) && ($autoplay=='yes')){ 
			$am = "autoplay=1&mute=1"; 
		}
		if(('yes'!= $mute) && ($autoplay!='yes')){ 
			$am = "autoplay=0&mute=0"; 
		}
		if(('yes'== $mute) && ($autoplay!='yes')){ 
			$am = "autoplay=0&mute=1"; 
		}
		if('yes'== $loop){ $lp = '1';
		} else{ $lp = 0; }
		$src = "https://www.youtube.com/embed/{$id}?{$am}&loop={$lp}&playlist={$id}&rel=0&controls=1&showinfo=0&wmode=opaque&start={$startTime}&end={$endTime}";
		?>
		<iframe
			src="<?php echo esc_attr($src); ?>"
			webkitallowfullscreen mozallowfullscreen allowfullscreen>
		</iframe>
		<?php
		return ob_get_clean();
	}

	protected function eaelsv_load_player_vimeo1($settings){
		ob_start();
		$color = ltrim($settings['eaelsv_sh_video_interface_color'], '#');
		$id = $this->eaelsv_get_url_id($settings);
		$autoplay = $settings['eaelsv_autopaly'];
		$mute = $settings['eaelsv_mute'];
		$loop = $settings['eaelsv_loop'];
		if($autoplay=='yes'){ 
			$am = "autoplay=1&mute=1";
		}
		if(('yes'== $mute) && ($autoplay=='yes')){ 
			$am = "autoplay=1&mute=1"; 
		}
		if(('yes'!= $mute) && ($autoplay!='yes')){ 
			$am = "autoplay=0&mute=0"; 
		}
		if(('yes'== $mute) && ($autoplay!='yes')){ 
			$am = "autoplay=0&mute=1"; 
		}
		if('yes'== $loop){ $lp = '1';
		} else{ $lp = 0; }
		$src = "https://player.vimeo.com/video/{$id}?{$am}&color={$color}&title=1&byline=1&portrait=1&loop={$lp}";
		?>
		<iframe controls
			src="<?php echo esc_attr($src); ?>"
			webkitallowfullscreen mozallowfullscreen allowfullscreen>
		</iframe>
		<?php
		return ob_get_clean();
	}

	protected function eaelsv_load_player_self_hosted1($settings){
		ob_start();
		if($settings['eaelsv_external_url']!=''){
			$video = $settings['eaelsv_external_url'];
		} else{
			$video = $settings['eaelsv_hosted_url']['url'];
		}
		$controlBars = $settings['eaelsv_sh_show_bar'];
		$autoplay = $settings['eaelsv_autopaly'];
		$mute = $settings['eaelsv_mute'];
		$loop = $settings['eaelsv_loop'];
		$interfaceColor = $settings['eaelsv_sh_video_interface_color'];
		$skin = $settings['eaelsv_sh_video_skin'];
		$startTime = $settings['eaelsv_start_time'];
		$endTime = $settings['eaelsv_end_time'];
		if('yes'==$autoplay){ ?>
			<style>
			.default__button--big{display: none;}
			.compact__button--big{display: none;}
			</style>
		<?php } ?>
		<video
			src="<?php echo esc_attr($video); ?>#t=<?php echo esc_attr($startTime); ?>,<?php echo esc_attr($endTime); ?>" 
			data-color="<?php echo esc_attr($interfaceColor); ?>" 
			data-ckin="<?php echo esc_attr($skin); ?>" 
			data-overlay="1"
			<?php if('yes'==$autoplay) echo "autoplay muted"; ?>
			<?php if('yes'==$loop) echo "loop"; ?>
			<?php if('yes'==$mute) echo "muted"; ?>
			poster="ckin.jpg">
		</video>
		<?php
		return ob_get_clean();
	}

	protected function eaelsv_get_url_id( $settings ){
		if('youtube' === $settings['eael_video_source']){
			$url = $settings['eaelsv_link_youtube'];
			$link = explode( '=', parse_url($url, PHP_URL_QUERY) );
			$id = $link[1];
		}
		if('vimeo' === $settings['eael_video_source']){
			$url = $settings['eaelsv_link_vimeo'];
			$link = explode('/', $url);
			$id = $link[3];
		}
		if('self_hosted' === $settings['eael_video_source']){
			$externalUrl = $settings['eaelsv_link_external'];
			if('yes'==$externalUrl){
				$id = $settings['eaelsv_external_url'];
			} else{
				$id = $settings['eaelsv_hosted_url']['url'];
			}
		}
		return $id;
	}

}