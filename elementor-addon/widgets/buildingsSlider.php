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
            'image_alt',
            [
                'label' => esc_html__('Image Alt Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Enter alt text for image', 'elementor-addon'),
            ]
        );

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

        echo '<div class="splide buildings-slider">';
        echo '<div class="splide__track">';
        echo '<ul class="splide__list">';

        

        foreach ($settings['slides'] as $slide) {
            echo '<li class="splide__slide slider-item">';
            if (!empty($slide['slide_image']['url'])) {
                echo '<img src="' . esc_url($slide['slide_image']['url']) . '" alt="' . esc_attr($slide['image_alt']) . '" class="slider-image" />';
            }
            echo '<div class="slider-content">';

            $fixed_titles = ['Building', 'Address', 'Developer', 'Units', 'Completed'];
            foreach ($fixed_titles as $title) {
                $key = strtolower($title) . '_text';
                if (!empty($slide[$key])) {
                    echo '<div class="slider-text-block">';
                    echo '<strong>' . esc_html__($title, 'elementor-addon') . ':</strong> ' . esc_html($slide[$key]);
                    echo '</div>';
                }
            }

            if (!empty($slide['button_text']) && !empty($slide['button_url']['url'])) {
                echo '<div class="slider-button">';
                echo '<a href="' . esc_url($slide['button_url']['url']) . '" class="btn">' . esc_html($slide['button_text']) . '</a>';
                echo '</div>';
            }

            echo '</div>'; // slider-content
            echo '</li>'; // splide__slide
        }

        echo '</ul>';
        echo '</div>'; // splide__track
        echo '</div>'; // splide
        ?>

<style>
            .buildings-slider {
                margin: 20px auto;
                max-width: 1200px;
            }
            .splide__slide {
                padding: 15px;
                background: #f7f7f7;
                border: 1px solid #ddd;
                border-radius: 8px;
                text-align: center;
            }
            .slider-image {
                max-width: 100%;
                height: auto;
                margin-bottom: 15px;
                border-radius: 5px;
            }
            .slider-content {
                font-family: 'Arial', sans-serif;
            }
            .slider-text-block {
                margin-bottom: 10px;
            }
            .slider-button .btn {
                display: inline-block;
                padding: 10px 20px;
                background-color: #093D5F;
                color: #fff;
                text-decoration: none;
                border-radius: 4px;
                transition: background-color 0.3s ease;
            }
            .slider-button .btn:hover {
                background-color: #fff;
                color: #093D5F;
                border: 1px solid #093D5F;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var splide = new Splide('.buildings-slider', {
                    perPage: 3,
                    rewind: true,
                    gap: '1rem',
                    breakpoints: {
                        768: {
                            perPage: 1,
                        },
                        1024: {
                            perPage: 2,
                        },
                    },
                });
                splide.mount();
            });
        </script>
        <?php
    }
}
