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
        // Content Tab
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
                    ],
                    [
                        'slide_image' => [
                            'url' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop',
                        ],
                    ],
                ],
                'title_field' => 'Slide',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Four Communities One Standard of Living',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Spacious, modern units across four unique buildings — thoughtfully designed for comfort and connection.',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Explore Now',
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'elementor-addon'),
                'selector' => '{{WRAPPER}} .hero-title',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__('Button Background', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-button' => 'background-color: {{VALUE}};',
                ],
                'default' => '#093D5F',
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => esc_html__('Button Hover Background', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-button:hover' => 'background-color: {{VALUE}};',
                ],
                'default' => '#0c4e7a',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $button_url = $settings['button_link']['url'];
        $widget_id = $this->get_id();
        ?>
        <section class="hero-slider-container" id="hero-slider-<?php echo esc_attr($widget_id); ?>">
            <div class="hero-content-wrapper">
                <div class="hero-content">
                    <div class="hero-text-content">
                        <h1 class="hero-title"><?php echo esc_html($settings['title']); ?></h1>
                        <p class="hero-description"><?php echo esc_html($settings['description']); ?></p>
                        <a href="<?php echo esc_url($button_url); ?>" class="hero-button">
                            <?php echo esc_html($settings['button_text']); ?>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="hero-button-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                    
                    <div class="hero-navigation">
                        <div class="nav-buttons">
                            <button class="nav-button hero-prev">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </button>
                            <button class="nav-button hero-next">
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
                                <img src="<?php echo esc_url($slide['slide_image']['url']); ?>" alt="Slide Image" class="hero-slide-image">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <style>
            #hero-slider-<?php echo esc_attr($widget_id); ?> {
                display: flex;
                width: 100%;
                position: relative;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-content-wrapper {
                width: 60%;
                display: flex;
                align-items: center;
                background: white;
                padding: 2rem;
                padding-left:0rem;
                z-index: 2;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-content {
                max-width: 1200px;
                width: 100%;
                margin: 0 auto;
                padding: 2rem;
                padding-left:0rem;
                padding-right:0rem;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                height: 100%;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-text-content {
                max-width: 36rem;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-title {
                font-size: 3.75rem;
                font-weight: 700;
                line-height: 1.1;
                margin-bottom: 1.5rem;
                padding-top:5rem;
                color: <?php echo esc_attr($settings['title_color'] ?: '#111827'); ?>;
                <?php if ($settings['title_typography_font_family']) : ?>
                font-family: <?php echo esc_attr($settings['title_typography_font_family']); ?>;
                <?php endif; ?>
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-description {
                font-size: 1.125rem;
                color: <?php echo esc_attr($settings['description_color'] ?: '#4b5563'); ?>;
                margin-bottom: 2rem;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button {
                display: inline-flex;
                align-items: center;
                gap: 0.75rem;
                border-radius: 9999px;
                background: <?php echo esc_attr($settings['button_bg_color'] ?: '#093D5F'); ?>;
                padding: 1rem 2rem;
                font-size: 1.125rem;
                font-weight: 500;
                color: white;
                transition: all 0.3s ease;
                text-decoration: none;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button:hover {
                background: <?php echo esc_attr($settings['button_hover_bg_color'] ?: '#0c4e7a'); ?>;
                gap: 1rem;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button-icon {
                transition: all 0.3s ease;
                rotate: -45deg;
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

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slider-wrapper {
                width: 40%;
                position: relative;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slider {
                width: 100%;
                height: 100vh;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .swiper-slide {
                height: 100%;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slide-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            @media (max-width: 1024px) {
                #hero-slider-<?php echo esc_attr($widget_id); ?> {
                    flex-direction: column;
                }
                
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-content-wrapper,
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slider-wrapper {
                    width: 100%;
                }
                
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slider {
                    height: 50vh;
                }

                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-title {
                    font-size: 2.5rem;
                }
            }

            @media (max-width: 768px) {
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-title {
                    font-size: 2rem;
                }

                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-content-wrapper {
                padding: 0rem;
                }
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slider-wrapper {
        display: none;
    }
                .hero-text-content{
                    text-align:center;
                    max-width:340px;
                }
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-navigation {
    display: none;
}
            }

            @media (max-width: 480px) {
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-title {
                    font-size: 1.75rem;
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var heroSlider = new Swiper('#hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slider', {
                    loop: true,
                    speed: 1000,
                    navigation: {
                        nextEl: '#hero-slider-<?php echo esc_attr($widget_id); ?> .hero-next',
                        prevEl: '#hero-slider-<?php echo esc_attr($widget_id); ?> .hero-prev',
                    },
                    on: {
                        init: function() {
                            var currentSlide = document.querySelector('#hero-slider-<?php echo esc_attr($widget_id); ?> .current-slide');
                            var totalSlides = document.querySelector('#hero-slider-<?php echo esc_attr($widget_id); ?> .total-slides');
                            if (currentSlide && totalSlides) {
                                currentSlide.textContent = '01';
                                totalSlides.textContent = String(this.slides.length - 2).padStart(2, '0');
                            }
                        },
                        slideChange: function() {
                            var currentSlide = document.querySelector('#hero-slider-<?php echo esc_attr($widget_id); ?> .current-slide');
                            if (currentSlide) {
                                currentSlide.textContent = String(this.realIndex + 1).padStart(2, '0');
                            }
                        }
                    }
                });

                var content = document.querySelector('#hero-slider-<?php echo esc_attr($widget_id); ?> .hero-content');
                if (content) {
                    content.style.opacity = '0';
                    content.style.transform = 'translateX(-20px)';
                    
                    setTimeout(function() {
                        content.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
                        content.style.opacity = '1';
                        content.style.transform = 'translateX(0)';
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