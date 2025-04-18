<?php

class Elementor_circleSlider extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'circleSlider';
    }

    public function get_title()
    {
        return esc_html__('Circle Image Slider', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_style_depends()
    {
        return ['circle-slider-style'];
    }

    public function get_script_depends()
    {
        return ['swiper', 'circle-slider-script'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'slides_section',
            [
                'label' => esc_html__('Slides', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'slide_image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
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
                        'slide_image' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                    ],
                ],
                'title_field' => '{{{ slide_image.url ? "Slide Image" : "Empty Slide" }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['slides'])) {
            return;
        }

        ?>
        <div class="circle-slider swiper">
            <div class="swiper-wrapper">
                <?php foreach ($settings['slides'] as $index => $slide) : 
                    if (empty($slide['slide_image']['url'])) {
                        continue;
                    }
                ?>
                    <div class="swiper-slide">
                        <div class="circle-image">
                            <img src="<?php echo esc_url($slide['slide_image']['url']); ?>" alt="<?php echo esc_attr__('Slide', 'elementor-addon') . ' ' . ($index + 1); ?>" />
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
}

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css',
        [],
        '10.0.0'
    );

    wp_enqueue_script(
        'swiper',
        'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js',
        [],
        '10.0.0',
        true
    );

    wp_enqueue_style('circle-slider-style', false);
    wp_add_inline_style('circle-slider-style', '
        .circle-slider {
            display: flex;

            width: 100%;
            padding: 20px 0;
            overflow: hidden;
        }
        .circle-slider .swiper-wrapper {
            display: flex;
            align-items: center;
        }
        .circle-slider .swiper-slide {
                        max-width: 312px;
            max-height: 312px;
            display: flex;
            flex-direction:row;
            justify-content: center;
            align-items: center;
            flex-wrap:nowrap;
        }
        .circle-slider .circle-image {
            max-width: 312px;
            max-height: 312px;
        }
        .circle-slider .circle-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .circle-slider .circle-slider-link {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
    ');

    wp_enqueue_script('circle-slider-script', false, ['swiper'], null, true);
    wp_add_inline_script('circle-slider-script', '
        jQuery(window).on("elementor/frontend/init", function() {
            elementorFrontend.hooks.addAction("frontend/element_ready/circle-slider.default", function($scope) {
                const slider = $scope.find(".circle-slider")[0];
                if (slider && !slider.swiper) {
                    new Swiper(slider, {
                        slidesPerView: "auto",
                        spaceBetween: 20,
                        loop: true,
                        grabCursor: true,
                        breakpoints: {
                            768: {
                                slidesPerView: 5,
                            },
                            480: {
                                slidesPerView: 3,
                            }
                        }
                    });
                }
            });
        });
    ');
});
?>