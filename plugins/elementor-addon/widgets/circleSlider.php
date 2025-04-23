<?php

class Elementor_circleSlider extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'circleSlider';
    }

    public function get_title()
    {
        return esc_html__('Circle Slider', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_script_depends()
    {
        return ['swiper'];
    }

    public function get_style_depends()
    {
        return ['swiper'];
    }

    protected function register_controls()
    {
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
                    [
                        'slide_image' => [
                            'url' => 'https://images.unsplash.com/photo-1598928506311-c55ded91a20c?q=80&w=2070&auto=format&fit=crop',
                        ],
                    ],
                ],
                'title_field' => 'Slide',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();

        if (empty($settings['slides'])) {
            echo '<p>' . esc_html__('No slides added. Please add at least one slide in the widget settings.', 'elementor-addon') . '</p>';
            return;
        }

        $valid_slides = array_filter($settings['slides'], function($slide) {
            return !empty($slide['slide_image']['url']);
        });

        if (empty($valid_slides)) {
            echo '<p>' . esc_html__('No valid slides with images found. Please ensure all slides have images.', 'elementor-addon') . '</p>';
            return;
        }
        ?>
        <section class="circle-slider-container" id="circle-slider-<?php echo esc_attr($widget_id); ?>">
            <div class="circle-slider-wrapper">
                <div class="swiper circle-slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($valid_slides as $index => $slide) : ?>
                            <div class="swiper-slide">
                                <img src="<?php echo esc_url($slide['slide_image']['url']); ?>" alt="Slide Image" class="circle-slide-image">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <style>
            #circle-slider-<?php echo esc_attr($widget_id); ?> {
                width: 100%;
                position: relative;
                overflow: hidden;
            }

            #circle-slider-<?php echo esc_attr($widget_id); ?> .circle-slider-wrapper {
                width: 100%;
            }

            #circle-slider-<?php echo esc_attr($widget_id); ?> .circle-slider {
                width: 100%;
                padding: 20px 0;
            }

            #circle-slider-<?php echo esc_attr($widget_id); ?> .swiper-wrapper {
                display: flex;
                flex-direction: row !important;
                align-items: center;
            }

            #circle-slider-<?php echo esc_attr($widget_id); ?> .swiper-slide {
                width: 310px;
                height: 200px;
                flex-shrink: 0;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            #circle-slider-<?php echo esc_attr($widget_id); ?> .circle-slide-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 50%;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            @media (max-width: 768px) {
                #circle-slider-<?php echo esc_attr($widget_id); ?> .swiper-slide {
                    width: 100px;
                    height: 100px;
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                try {
                    var circleSlider = new Swiper('#circle-slider-<?php echo esc_attr($widget_id); ?> .circle-slider', {
                        loop: true,
                        speed: 600,
                        slidesPerView: 'auto',
                        spaceBetween: 20,
                        grabCursor: true,
                        autoplay: {
                            delay: 3000,
                            disableOnInteraction: false,
                        },
                        breakpoints: {
                            480: {
                                slidesPerView: 3,
                            },
                            768: {
                                slidesPerView: 5,
                            }
                        },
                        on: {
                            init: function() {
                                console.log('Circle Slider initialized successfully:', this);
                            }
                        }
                    });
                } catch (error) {
                    console.error('Error initializing Circle Slider:', error);
                }
            });
        </script>
        <?php
    }
}

function register_circle_slider_widget($widgets_manager) {
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

    $widgets_manager->register(new \Elementor_circleSlider());
}
add_action('elementor/widgets/register', 'register_circle_slider_widget');
?>