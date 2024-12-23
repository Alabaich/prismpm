<?php

class Elementor_BuildingsSlider extends \Elementor\Widget_Base {
    public function get_name() {
        return 'buildings_slider';
    }

    public function get_title() {
        return esc_html__('Buildings Slider', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-slider-3d';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {
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

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['slides'])) {
            return;
        }

        ?>
        <style>
            .buildings-slider {
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
            }

            .buildings-list {
                display: flex;
                gap: 20px;
                list-style: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
            }

            .building-item {
                width: 100%;
                box-sizing: border-box;
            }

            .slider-image {
                width: 100%;
                height: auto;
                border-radius: 8px;
                margin-bottom: 15px;
            }

            .slider-content {
                background-color: #fff;
                padding: 20px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
            }

            .slider-text-block {
                display: flex;
                flex-direction: column;
                gap: 5px;
            }

            .slider-button a {
                display: inline-block;
                padding: 10px 20px;
                background-color: #0073e6;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s;
                margin-top: 10px;
            }

            .slider-button a:hover {
                background-color: #005bb5;
            }
        </style>

        <div class="buildings-slider">
            <ul class="buildings-list">
                <?php foreach ($settings['slides'] as $slide): ?>
                    <li class="building-item">
                        <?php if (!empty($slide['slide_image']['url'])): ?>
                            <img 
                                src="<?php echo esc_url($slide['slide_image']['url']); ?>" 
                                alt="<?php echo esc_attr($slide['image_alt']); ?>" 
                                class="slider-image"
                            />
                        <?php endif; ?>

                        <div class="slider-content">
                            <?php
                            $fixed_titles = ['Building', 'Address', 'Developer', 'Units', 'Completed'];
                            foreach ($fixed_titles as $title):
                                $key = strtolower($title) . '_text';
                                if (!empty($slide[$key])): ?>
                                    <div class="slider-text-block">
                                        <strong><?php echo esc_html__($title, 'elementor-addon'); ?>:</strong> 
                                        <?php echo esc_html($slide[$key]); ?>
                                    </div>
                                <?php endif;
                            endforeach;
                            ?>

                            <?php if (!empty($slide['button_text']) && !empty($slide['button_url']['url'])): ?>
                                <div class="slider-button">
                                    <a href="<?php echo esc_url($slide['button_url']['url']); ?>" class="btn">
                                        <?php echo esc_html($slide['button_text']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.buildings-list').slick({
                    slidesToShow: 3, 
                    slidesToScroll: 1, 
                    autoplay: true, 
                    autoplaySpeed: 3000, 
                    prevArrow: '<button type="button" class="slick-prev">Previous</button>',
                    nextArrow: '<button type="button" class="slick-next">Next</button>',
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 2, 
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            });
        </script>
        <?php
    }
}

?>
