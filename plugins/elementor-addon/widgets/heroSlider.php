<?php
class Elementor_heroSlider extends \Elementor\Widget_Base {

    public function get_name() {
        return 'heroSlider';
    }

    public function get_title() {
        return esc_html__('Hero Slider', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-slides';
    }

    public function get_categories() {
        return ['basic'];
    }

    public function get_script_depends() {
        return ['swiper'];
    }

    public function get_style_depends() {
        return ['swiper'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'slide_image',
            [
                'label' => esc_html__('Slide Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'slide_title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Four Communities One Standard of Living',
                'label_block' => true,
            ]
        );
        
        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'slide_title_typography',
                'label' => esc_html__('Title Typography', 'elementor-addon'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .customTitle',
            ]
        );


        $repeater->add_control(
            'slide_description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Spacious, modern units across four unique buildings — thoughtfully designed for comfort and connection.',
            ]
        );

        $repeater->add_control(
            'slide_button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Explore Now',
            ]
        );

        $repeater->add_control(
            'slide_button_link',
            [
                'label' => esc_html__('Button Link', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => esc_html__('Slides', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slide_image' => [
                            'url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?q=80&w=2075&auto=format&fit=crop',
                        ],
                        'slide_title' => 'Four Communities One Standard of Living',
                        'slide_description' => 'Spacious, modern units across four unique buildings — thoughtfully designed for comfort and connection.',
                        'slide_button_text' => 'Explore Now',
                        'slide_button_link' => ['url' => '#']
                    ],
                    [
                        'slide_image' => [
                            'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop',
                        ],
                        'slide_title' => 'Premium Living Spaces',
                        'slide_description' => 'Experience luxury and comfort in our carefully designed apartments with modern amenities.',
                        'slide_button_text' => 'Discover More',
                        'slide_button_link' => ['url' => '#']
                    ],
                ],
                'title_field' => '{{{ slide_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_general',
            [
                'label' => esc_html__('General Styles', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
         $this->add_control(
            'content_bg_color',
            [
                'label' => esc_html__('Content Area Background', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-content-wrapper' => 'background-color: {{VALUE}};',
                ],
                'default' => '#FFFFFF',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_text',
            [
                'label' => esc_html__('Text Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_heading',
            [
                'label' => esc_html__( 'Title', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .customTitle' => 'color: {{VALUE}};',
                ],
                'default' => '#111827',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'elementor-addon'),
                'selector' => '{{WRAPPER}} .customTitle',
            ]
        );
        $this->add_control(
            'description_heading',
            [
                'label' => esc_html__( 'Description', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .customSubtitle' => 'color: {{VALUE}};',
                ],
                'default' => '#4b5563',
            ]
        );
         $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Description Typography', 'elementor-addon'),
                'selector' => '{{WRAPPER}} .customSubtitle',
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_navigation', 
            [
                'label' => esc_html__('Navigation', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
         $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desktop_counter_typography',
                'label' => esc_html__('Desktop Counter Typography', 'elementor-addon'),
                'selector' => '{{WRAPPER}} .slide-counter',
            ]
        );
        $this->add_control(
            'hr_mobile_nav',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
            'mobile_pagination_heading',
            [
                'label' => esc_html__( 'Mobile Pagination Dots', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'mobile_pagination_dot_color',
            [
                'label' => esc_html__('Dot Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#CCCCCC', 
                'selectors' => [
                    '{{WRAPPER}} .hero-swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'mobile_pagination_active_dot_color',
            [
                'label' => esc_html__('Active Dot Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#093D5F', 
                'selectors' => [
                    '{{WRAPPER}} .hero-swiper-pagination .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
                ],
            ]
        );
         $this->add_responsive_control(
            'mobile_pagination_dot_size',
            [
                'label' => esc_html__( 'Dot Size', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 4,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-swiper-pagination .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
         $this->add_responsive_control(
            'mobile_pagination_spacing',
            [
                'label' => esc_html__( 'Dot Spacing', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 2,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-swiper-pagination .swiper-pagination-bullet' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
         $this->add_responsive_control(
            'mobile_pagination_bottom_offset',
            [
                'label' => esc_html__( 'Bottom Offset', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                     '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();

        $announce_property_svg = '<svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="hero-button-icon announce-svg-icon">
                                        <path d="M11.5 -0.0078125C12.0523 -0.0078125 12.5 0.439903 12.5 0.992188V10.9922C12.5 11.5445 12.0523 11.9922 11.5 11.9922C10.9477 11.9922 10.5 11.5445 10.5 10.9922V3.33203L2.20703 11.6992C1.81651 12.0897 1.18349 12.0897 0.792969 11.6992C0.402446 11.3087 0.402445 10.6757 0.792969 10.2852L9.0127 1.99219H1.5C0.947715 1.99219 0.5 1.54447 0.5 0.992188C0.5 0.439903 0.947715 -0.0078125 1.5 -0.0078125H11.5Z" fill="currentColor"/>
                                     </svg>';
        ?>
        <section class="hero-slider-container" id="hero-slider-<?php echo esc_attr($widget_id); ?>">
            <div class="hero-content-wrapper">
                <div class="hero-content">
                    <div class="hero-text-content">
                        <?php foreach ($settings['slides'] as $index => $slide):
                            $this->add_render_attribute('slide_title_attrs' . $index, 'class', 'customTitle');
                        ?>
                            <div class="slide-content <?php echo $index === 0 ? 'active' : ''; ?>" data-slide-index="<?php echo esc_attr($index); ?>">
                                <h1 <?php echo $this->get_render_attribute_string('slide_title_attrs' . $index); ?> >
                                    <?php echo esc_html($slide['slide_title']); ?>
                                </h1>
                                <p class="customSubtitle"><?php echo wp_kses_post($slide['slide_description']); ?></p>
                                <?php
                                if (!empty($slide['slide_button_text']) && !empty($slide['slide_button_link']['url'])) {
                                    $this->add_link_attributes('button-' . $index, $slide['slide_button_link']);
                                    ?>
                                    <a <?php echo $this->get_render_attribute_string('button-' . $index); ?> class="hero-button" target="_blank" rel="noopener noreferrer">
                                        <?php echo esc_html($slide['slide_button_text']); ?>
                                        <?php echo $announce_property_svg; ?>
                                    </a>
                                <?php } ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="hero-navigation">
                        <div class="nav-buttons">
                            <button class="nav-button hero-prev" aria-label="<?php esc_attr_e('Previous Slide', 'elementor-addon'); ?>">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </button>
                            <button class="nav-button hero-next" aria-label="<?php esc_attr_e('Next Slide', 'elementor-addon'); ?>">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="slide-counter">
                            <span class="current-slide">01</span> / <span class="total-slides"><?php echo esc_html(str_pad(count($settings['slides']), 2, '0', STR_PAD_LEFT)); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="hero-slider-wrapper">
                <div class="swiper hero-slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['slides'] as $slide) : ?>
                            <div class="swiper-slide">
                                <?php if (!empty($slide['slide_image']['url'])): ?>
                                <img src="<?php echo esc_url($slide['slide_image']['url']); ?>" 
                                     alt="<?php echo esc_attr(wp_strip_all_tags($slide['slide_title'])); ?>" class="hero-slide-image">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination hero-swiper-pagination"></div>
                </div>
            </div>
            <div class="hero-mobile-total-slides-indicator">
                 </div>
        </section>

        <style>
            #hero-slider-<?php echo esc_attr($widget_id); ?> {
                display: flex;
                width: 100%;
                position: relative;
                overflow: hidden;
                height: 100vh;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-content-wrapper {
                width: 50%;
                display: flex;
                align-items: center;
                padding: 4rem 2rem 4rem 5rem;
                z-index: 2;
                box-sizing: border-box;
                height: 100%;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-content {
                max-width: 600px;
                width: 100%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                height: 100%;
                box-sizing: border-box;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-text-content {
                max-width: 100%;
                position: relative;
                min-height: 200px; 
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .slide-content {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                opacity: 0;
                transition: opacity 0.8s ease, transform 0.8s ease;
                pointer-events: none;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                transform: translateY(20px);
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .slide-content.active {
                opacity: 1;
                pointer-events: auto;
                transform: translateY(0);
            }
            #hero-slider-<?php echo esc_attr($widget_id); ?> .slide-content.initializing {
                 transition: none !important;
                 transform: translateY(0) !important;
                 opacity: 1 !important;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .customTitle {
                margin-bottom: 1.5rem;
                padding-top: 6.5rem; 
                line-height: 1.1;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .customSubtitle {
                max-width: 414px;
                margin-bottom: 1.5rem;
                text-align: left;
                 line-height: 1.6;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button {
                display: inline-flex;
                align-items: center;
                padding: 10px 20px;
                text-decoration: none;
                font-family: "Graphik Medium", Sans-serif;
                font-size: 16px;
                transition: all 0.3s ease;
                border: 2px solid transparent;
                border-radius: 99999px;
                gap: 1rem;
                margin-top: 1rem;
                align-self: flex-start;
                cursor: pointer;
                color: #ffffff;
                background-color: #093D5F;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button .hero-button-icon {
                transition: fill 0.3s ease, transform 0.3s ease;
                display: inline-block;
                line-height: 1;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button:hover {
                color: #093D5F;
                background-color: #ffffff;
                border-color: #093D5F;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button .hero-button-icon path {
                fill: currentColor;
                transition: fill 0.3s ease;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-navigation {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-top: 2rem; 
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .nav-buttons {
                display: flex;
                align-items: center;
                gap: 1rem;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .nav-button {
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                background: #f3f4f6; 
                padding: 1rem; 
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
            }
            #hero-slider-<?php echo esc_attr($widget_id); ?> .nav-button:hover {
                 background: #e5e7eb; 
            }
            #hero-slider-<?php echo esc_attr($widget_id); ?> .nav-button svg {
                stroke: #111827; 
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .slide-counter {
                font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
                font-size: 1.125rem;
                font-weight: 500;
                color: #111827; 
            }
            
            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-mobile-total-slides-indicator {
                display: none; 
            }
             #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-swiper-pagination {
                display: none; 
            }


            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slider-wrapper {
                width: 50%;
                position: relative;
                height: 100%;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slider {
                width: 100%;
                height: 100%;
                position: relative; /* Needed for absolute positioning of pagination */
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .swiper-slide {
                height: 100%;
                overflow: hidden;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slide-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            @media (max-width: 1024px) {
                #hero-slider-<?php echo esc_attr($widget_id); ?> {
                    flex-direction: column;
                    height: auto; 
                }
                
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-content-wrapper,
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slider-wrapper {
                    width: 100%;
                    height: auto; 
                }
                
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-content-wrapper {
                    padding: 3rem 2rem; 
                    min-height: auto; 
                    order: 1; 
                }

                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slider-wrapper {
                    min-height: 300px; 
                    height: 50vh; 
                    order: 2; 
                }
                 #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-content {
                    max-width: 100%; 
                    padding: 0;
                     justify-content: center; 
                     height: auto; 
                }

                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-text-content {
                     min-height: auto; 
                     position: relative; 
                }
                 #hero-slider-<?php echo esc_attr($widget_id); ?> .slide-content {
                    position: relative; 
                    transform: none; 
                    opacity: 1; 
                    display: none; 
                    width: 100%;
                    align-items: flex-start; 
                }
                #hero-slider-<?php echo esc_attr($widget_id); ?> .slide-content.active {
                    display: flex; 
                    flex-direction: column;
                    opacity: 1; 
                    transform: none; 
                }

                #hero-slider-<?php echo esc_attr($widget_id); ?> .customTitle {
                     margin-bottom: 1rem;
                     padding-top: 2rem; 
                }
                #hero-slider-<?php echo esc_attr($widget_id); ?> .customSubtitle {
                     max-width: 100%;
                     margin-bottom: 1.5rem;
                }
                 #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-navigation {
                     margin-top: 2rem; 
                }
            }

            @media (max-width: 767px) { 
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-content-wrapper {
                    padding: 2rem 1.5rem;
                }
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slider-wrapper {
                    height: 40vh; 
                    min-height: 280px; 
                }

                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-text-content {
                     text-align: center; 
                }
                 #hero-slider-<?php echo esc_attr($widget_id); ?> .slide-content.active {
                    align-items: center; 
                }
                #hero-slider-<?php echo esc_attr($widget_id); ?> .customTitle {
                     margin-bottom: 0.75rem;
                     padding-top: 1rem;
                }
                #hero-slider-<?php echo esc_attr($widget_id); ?> .customSubtitle {
                     margin-bottom: 1.25rem;
                     text-align: center;
                }
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button {
                    padding: 10px 20px;
                    gap: 0.5rem; 
                    margin-top: 1rem;
                    align-self: center; 
                }
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-navigation {
                    display: none !important; 
                }
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-mobile-total-slides-indicator {
                    display: none !important; 
                }
                 #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-swiper-pagination {
                    display: flex;
                    justify-content: center;
                    position: absolute;
                    bottom: 15px; 
                    left: 50%;
                    transform: translateX(-50%);
                    width: auto;
                    z-index: 10;
                }
                #hero-slider-<?php echo esc_attr($widget_id); ?> .swiper-pagination-bullet {
                    background-color: #ccc; 
                    opacity: 0.7;
                    transition: background-color 0.3s ease, opacity 0.3s ease;
                }
                #hero-slider-<?php echo esc_attr($widget_id); ?> .swiper-pagination-bullet-active {
                    background-color: #093D5F; 
                    opacity: 1;
                }
            }
             @media (max-width: 480px) {
                 #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-content-wrapper {
                    padding: 1.5rem 1rem;
                }
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slider-wrapper {
                    height: 35vh;
                    min-height: 250px; 
                }
                 #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button {
                    width: 100%;
                    justify-content: center;
                }
                 #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-swiper-pagination {
                     bottom: 10px;
                 }
             }

        </style>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sliderContainer = document.getElementById('hero-slider-<?php echo esc_attr($widget_id); ?>');
            if (!sliderContainer) return;

            var sliderElement = sliderContainer.querySelector('.hero-slider');
            if (!sliderElement) return;

            var heroSlider = new Swiper(sliderElement, {
                loop: true,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                speed: 1000, 
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: '#hero-slider-<?php echo esc_attr($widget_id); ?> .hero-next',
                    prevEl: '#hero-slider-<?php echo esc_attr($widget_id); ?> .hero-prev',
                },
                pagination: {
                    el: '#hero-slider-<?php echo esc_attr($widget_id); ?> .hero-swiper-pagination',
                    clickable: true,
                },
                on: {
                    init: function() {
                        var firstTextSlide = sliderContainer.querySelector('.slide-content[data-slide-index="0"]');
                        if (firstTextSlide) {
                             firstTextSlide.classList.add('initializing');
                        }
                        updateTextContentAndCounter(this.realIndex, sliderContainer, true, this.width); 
                        
                        if (firstTextSlide) {
                             setTimeout(function() {
                                if (firstTextSlide) firstTextSlide.classList.remove('initializing');
                             }, 50);
                         }
                        
                        var totalSlidesDesktopEl = sliderContainer.querySelector('.total-slides');
                        if (totalSlidesDesktopEl) {
                            var originalSlidesCount = <?php echo count($settings['slides']); ?>;
                            totalSlidesDesktopEl.textContent = String(originalSlidesCount).padStart(2, '0');
                        }
                    },
                    slideChangeTransitionStart: function () {
                        var screenWidth = this.width; 
                        if (screenWidth > 1024) { 
                             var allTextSlides = sliderContainer.querySelectorAll('.slide-content');
                             allTextSlides.forEach(function(contentEl, idx) {
                                 if (this.realIndex !== parseInt(contentEl.getAttribute('data-slide-index'))) { 
                                     contentEl.classList.remove('active');
                                 }
                             }.bind(this));
                        }
                    },
                    slideChange: function() { 
                        updateTextContentAndCounter(this.realIndex, sliderContainer, false, this.width); 
                    }
                }
            });

            function updateTextContentAndCounter(realIndex, container, isInit, swiperWidth) {
                var slideContents = container.querySelectorAll('.slide-content');
                var currentSlideDesktopCounterEl = container.querySelector('.current-slide');
                
                var isDesktop = (typeof swiperWidth === 'number' && swiperWidth > 1024) || window.innerWidth > 1024;

                slideContents.forEach(function(content) {
                    if(isDesktop) {
                        content.classList.remove('active'); 
                        content.style.display = 'flex'; 
                    } else {
                        content.classList.remove('active'); 
                        content.style.display = 'none';    
                    }
                });
                
                var activeContent = container.querySelector('.slide-content[data-slide-index="' + realIndex + '"]');
                if (activeContent) {
                    if (!isInit && isDesktop) { 
                        activeContent.classList.remove('initializing');
                    }
                    
                    if(isDesktop) {
                        activeContent.classList.add('active'); 
                    } else {
                        activeContent.style.display = 'flex'; 
                        activeContent.classList.add('active'); 
                    }
                }
                
                if (currentSlideDesktopCounterEl) {
                    currentSlideDesktopCounterEl.textContent = String(realIndex + 1).padStart(2, '0');
                }
            }
            
            var resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(function() {
                    if (heroSlider && typeof heroSlider.realIndex !== 'undefined' && sliderContainer && heroSlider.el && heroSlider.el.offsetWidth > 0) { 
                        updateTextContentAndCounter(heroSlider.realIndex, sliderContainer, false, heroSlider.width);
                    }
                }, 100); 
            });

            var heroContentBlock = sliderContainer.querySelector('.hero-content');
            if (heroContentBlock) {
                heroContentBlock.style.opacity = '0';
                heroContentBlock.style.transform = 'translateY(20px)';
                
                setTimeout(function() {
                    heroContentBlock.style.transition = 'opacity 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94), transform 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                    heroContentBlock.style.opacity = '1';
                    heroContentBlock.style.transform = 'translateY(0)';
                }, 100);
            }
        });
        </script>
        <?php
    }
}

function register_hero_slider_widget($widgets_manager) {
    wp_enqueue_style(
        'swiper',
        'https://unpkg.com/swiper@8/swiper-bundle.min.css',
        [],
        '8.4.5'
    );
    
    wp_enqueue_script(
        'swiper',
        'https://unpkg.com/swiper@8/swiper-bundle.min.js',
        [],
        '8.4.5',
        true
    );

    $widgets_manager->register(new \Elementor_heroSlider());
}
add_action('elementor/widgets/register', 'register_hero_slider_widget');
