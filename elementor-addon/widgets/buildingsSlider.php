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

?>
        <div class="buildings-slider">
            <ul class="buildings-list">
                <?php foreach ($settings['slides'] as $slide): ?>
                    <li class="building-item">
                        <?php if (!empty($slide['slide_image']['url'])): ?>
                            <img
                                src="<?php echo esc_url($slide['slide_image']['url']); ?>"
                                alt="<?php echo esc_attr($slide['image_alt']); ?>"
                                class="slider-image" />
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

        <style>
            /* Slick Slider Styles */
            .buildings-slider .slick-slide {
                position: relative;
            }

            .buildings-slider .slider-content {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: rgba(0, 0, 0, 0.6);
                color: white;
                padding: 20px;
                border-radius: 8px;
            }

            .buildings-slider .slider-button .btn {
                background-color: #0073e6;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s;
            }

            .buildings-slider .slider-button .btn:hover {
                background-color: #005bb5;
            }
        </style>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

        <script>
            jQuery(document).ready(function($) {
                // Initialize Slick Slider
                $('.buildings-list').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 5000,
                    arrows: true,
                    dots: true,
                    responsive: [{
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        }
                    }, ]
                });
            });
        </script>

<?php
    }
}
