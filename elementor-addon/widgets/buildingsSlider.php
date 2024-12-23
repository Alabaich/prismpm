<?php

class Elementor_BuildingsSlider extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'buildings_slider';
    }

    public function get_title()
    {
        return esc_html__('Buildings Slider', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-slider-3d';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'slider_content_section',
            [
                'label' => esc_html__('Slider Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $fixed_titles = ['Building', 'Address', 'Developer', 'Units', 'Completed'];

        foreach ($fixed_titles as $title) {
            $repeater->add_control(
                strtolower($title) . '_text',
                [
                    'label' => esc_html__($title, 'elementor-addon'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => '',
                    'placeholder' => esc_html__("Enter $title", 'elementor-addon'),
                ]
            );
        }

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

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Learn More', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'button_url',
            [
                'label' => esc_html__('Button URL', 'elementor-addon'),
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
                'default' => [],
                'title_field' => '{{{ building_text }}}',
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

        <div class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php foreach ($settings['slides'] as $slide): ?>
                        <li class="splide__slide">
                            <div class="building-slide">
                                <img src="<?php echo esc_url($slide['slide_image']['url']); ?>" alt="">
                                <div class="building-info">
                                    <h3><?php echo esc_html($slide['building_text']); ?></h3>
                                    <p><strong>Address:</strong> <?php echo esc_html($slide['address_text']); ?></p>
                                    <p><strong>Developer:</strong> <?php echo esc_html($slide['developer_text']); ?></p>
                                    <p><strong>Units:</strong> <?php echo esc_html($slide['units_text']); ?></p>
                                    <p><strong>Completed:</strong> <?php echo esc_html($slide['completed_text']); ?></p>
                                    <?php if (!empty($slide['button_url']['url'])): ?>
                                        <a href="<?php echo esc_url($slide['button_url']['url']); ?>" class="button">
                                            <?php echo esc_html($slide['button_text']); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <script type="module">
            import Splide from '@splidejs/splide';
            import {
                AutoScroll
            } from '@splidejs/splide-extension-auto-scroll';

            const splide = new Splide('.splide', {
                type: 'loop',
                drag: 'free',
                focus: 'center',
                perPage: 3,
                autoScroll: {
                    speed: 1,
                },
                breakpoints: {
                    768: {
                        perPage: 1, // Show 1 slide per page on smaller screens
                    },
                },
            });

            splide.mount();
        </script>

        <style>
            /* Optional: Add custom styles for the slider */
            .splide__list {
                display: flex;
                gap: 20px;
            }

            .splide__slide {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
            }

            .building-slide {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                width: 100%;
            }

            .building-slide img {
                height: 300px;
            }

            .building-info {
                margin-top: 10px;
                text-align: left;
            }

            .building-info p {
                display: flex;
                flex-direction: column;
                text-align: left;
            }

            .button {
                margin-top: 10px;
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                text-decoration: none;
                border-radius: 5px;
            }
        </style>

<?php
    }
}

?>