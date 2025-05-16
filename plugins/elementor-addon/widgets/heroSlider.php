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

        $repeater->add_control(
            'slide_title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Four Communities One Standard of Living',
                'label_block' => true,
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

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Button Text Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero-button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hero-button .hero-button-icon path' => 'fill: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__('Button Background Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#093D5F',
                'selectors' => [
                    '{{WRAPPER}} .hero-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => esc_html__('Button Border Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'transparent', 
                'selectors' => [
                    '{{WRAPPER}} .hero-button' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'button_text_color_hover',
            [
                'label' => esc_html__('Button Text Color Hover', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#093D5F',
                'selectors' => [
                    '{{WRAPPER}} .hero-button:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hero-button:hover .hero-button-icon path' => 'fill: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => esc_html__('Button Hover Background', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero-button:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Button Hover Border Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#093D5F',
                'selectors' => [
                    '{{WRAPPER}} .hero-button:hover' => 'border-color: {{VALUE}};',
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
                            $button_url = $slide['slide_button_link']['url'] ?? '#';
                            $button_target = $slide['slide_button_link']['is_external'] ? '_blank' : '_self';
                            $button_nofollow = $slide['slide_button_link']['nofollow'] ? 'nofollow' : '';
                        ?>
                            <div class="slide-content <?php echo $index === 0 ? 'active' : ''; ?>" data-slide-index="<?php echo esc_attr($index); ?>">
                                <h1 class="customTitle"><?php echo esc_html($slide['slide_title']); ?></h1>
                                <p class="customSubtitle"><?php echo esc_html($slide['slide_description']); ?></p>
                                <a href="<?php echo esc_url($button_url); ?>" class="hero-button" target="<?php echo esc_attr($button_target); ?>" <?php if($button_nofollow) { echo 'rel="' . esc_attr($button_nofollow) . '"'; } ?>>
                                    <?php echo esc_html($slide['slide_button_text']); ?>
                                    <?php echo $announce_property_svg; ?>
                                </a>
                            </div>
                        <?php endforeach; ?>
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
                padding-left: 5rem;
                z-index: 2;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-content {
                max-width: 1200px;
                width: 100%;
                margin: 0 auto;
                padding: 2rem 0;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                height: 100%;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-text-content {
                max-width: 36rem;
                position: relative;
                min-height: 200px;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .slide-content {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                opacity: 0;
                transition: opacity 0.8s ease;
                pointer-events: none;
                 display: flex;
                flex-direction: column;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .slide-content.active {
                opacity: 1;
                pointer-events: auto;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .customTitle {
                margin-bottom: 1.5rem;
                padding-top: 6.5rem; 
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .customSubtitle {
                max-width: 414px;
                margin-bottom: 1.5rem;
                text-align: left;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button {
                display: inline-flex;
                align-items: center;
                padding: 10px 20px;
                text-decoration: none;
                color: <?php echo esc_attr($settings['button_text_color'] ?: '#fff'); ?>;
                background-color: <?php echo esc_attr($settings['button_bg_color'] ?: '#093D5F'); ?>; 
                font-family: "Graphik Medium", Sans-serif;
                font-size: 16px;
                font-weight: normal;
                transition: all 0.3s ease;
                border: 2px solid <?php echo esc_attr($settings['button_border_color'] ?: 'transparent'); ?>;
                border-radius: 99999px;
                gap: 1rem;
                margin-top: 1rem;
                align-self: flex-start;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button:hover {
                color: <?php echo esc_attr($settings['button_text_color_hover'] ?: '#093D5F'); ?>;
                background-color: <?php echo esc_attr($settings['button_hover_bg_color'] ?: '#fff'); ?>;
                border-color: <?php echo esc_attr($settings['button_hover_border_color'] ?: '#093D5F'); ?>;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button .hero-button-icon {
                transition: fill 0.3s ease, transform 0.3s ease;
                display: inline-block;
                line-height: 1;
            }
            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button .hero-button-icon path {
                transition: fill 0.3s ease;
            }


            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button:hover .hero-button-icon {
                transform: translateX(4px);
            }
             /* #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button:hover .hero-button-icon path {
                 fill: <?php echo esc_attr($settings['button_text_color_hover'] ?: '#093D5F'); ?>;
             } */


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
                height: 100vh;
            }

            #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slider {
                width: 100%;
                height: 100%;
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
                
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slider-wrapper { /* Changed from .hero-slider */
                    height: 50vh; /* Adjusted from .hero-slider to affect the wrapper */
                }

                #hero-slider-<?php echo esc_attr($widget_id); ?> .customTitle {
                    font-size: 2.5rem; /* Example responsive size */
                    padding-top: 2rem; /* Adjust padding for smaller screens */
                }
                 #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-content-wrapper {
                    padding: 2rem; /* Adjust padding */
                }
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-text-content {
                    max-width: 100%;
                }

            }

            @media (max-width: 768px) {
                /* Original mobile styles from heroSlider had display: none !important for the whole slider */
                /* Keeping that behavior for now, adjust if needed */
                #hero-slider-<?php echo esc_attr($widget_id); ?> {
                    /*flex-direction: column;
                    min-height: auto;
                    padding-top: 0;
                    box-sizing: border-box;
                    margin: 0;
                    padding: 0;*/
                    display: none !important; /* This hides the slider on mobile per original styles */
                }

                /* If you want the slider to be visible and styled on mobile, you'd remove display:none and adjust here: */
                /* #hero-slider-<?php echo esc_attr($widget_id); ?> .customTitle {
                    font-weight: 600;
                    line-height: 90%;
                    letter-spacing: 0%;
                    text-align: center;
                    vertical-align: middle;
                    color: #2a2a2a;
                    font-size: 2rem; 
                    padding-top: 1rem;
                }

                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-content-wrapper {
                    padding: 1rem;
                    min-height: auto;
                }

                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slider-wrapper {
                    display: none; 
                }

                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-content {
                    padding: 0;
                }

                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-text-content {
                    max-width: 100%;
                    padding: 0;
                    text-align: center;
                }


                #hero-slider-<?php echo esc_attr($widget_id); ?> .customSubtitle {
                    max-width: 100%;
                    margin-left: auto;
                    text-align: center;
                    margin-right: auto;
                    margin-bottom: 20px; 
                    font-size: 0.9rem;
                }
                 #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button {
                    padding: 8px 16px;
                    font-size: 14px;
                    gap: 0.5rem; 
                    margin: 1rem auto 0; 
                    display: table; 
                }
                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-button:hover .hero-button-icon {
                    transform: translateX(3px);
                }


                #hero-slider-<?php echo esc_attr($widget_id); ?> .hero-navigation {
                    display: none;
                }
                */
            }
        </style>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sliderElement = document.querySelector('#hero-slider-<?php echo esc_attr($widget_id); ?> .hero-slider');
            if (!sliderElement) return; // Exit if slider element not found

            var heroSlider = new Swiper(sliderElement, {
                loop: true,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                speed: 1000,
                navigation: {
                    nextEl: '#hero-slider-<?php echo esc_attr($widget_id); ?> .hero-next',
                    prevEl: '#hero-slider-<?php echo esc_attr($widget_id); ?> .hero-prev',
                },
                on: {
                    init: function() {
                        var slidesContentContainer = document.querySelector('#hero-slider-<?php echo esc_attr($widget_id); ?>');
                        if (!slidesContentContainer) return;

                        slidesContentContainer.querySelectorAll('.slide-content').forEach(el => {
                            el.classList.remove('active');
                        });
                        
                        var firstSlide = slidesContentContainer.querySelector('.slide-content[data-slide-index="0"]');
                        if (firstSlide) {
                            firstSlide.classList.add('active');
                        }
                        
                        var totalSlidesEl = slidesContentContainer.querySelector('.total-slides');
                        if (totalSlidesEl && this.slides) {
                             // For loop: true, Swiper adds duplicate slides. We need the count of original slides.
                            var originalSlidesCount = <?php echo count($settings['slides']); ?>;
                            totalSlidesEl.textContent = String(originalSlidesCount).padStart(2, '0');
                        }
                        
                        var currentSlideEl = slidesContentContainer.querySelector('.current-slide');
                        if (currentSlideEl) {
                           currentSlideEl.textContent = '01';
                        }
                    },
                    slideChange: function() {
                        updateContent(this.realIndex);
                    }
                }
            });

            function updateContent(realIndex) {
                var slidesContentContainer = document.querySelector('#hero-slider-<?php echo esc_attr($widget_id); ?>');
                 if (!slidesContentContainer) return;

                var slideContents = slidesContentContainer.querySelectorAll('.slide-content');
                var currentSlide = slidesContentContainer.querySelector('.current-slide');
                
                slideContents.forEach(function(content) {
                    content.classList.remove('active');
                });
                
                var activeContent = slidesContentContainer.querySelector('.slide-content[data-slide-index="' + realIndex + '"]');
                if (activeContent) {
                    activeContent.classList.add('active');
                }
                
                if (currentSlide) {
                    currentSlide.textContent = String(realIndex + 1).padStart(2, '0');
                }
            }

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