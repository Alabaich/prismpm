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

        <style>
            .building-blocks-container {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 20px;
                align-items: flex-start;
            }

            .building-block {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                max-width: 300px;
                width: 100%;
                box-sizing: border-box;
            }

            .building-block img {
                width: 100%;
                height: auto;
                max-height: 300px;
                object-fit: cover;
            }

            .building-info {
                margin-top: 10px;
                text-align: left;
                width: 100%;
            }

            .building-info p {
                display: flex;
                flex-direction: column;
                text-align: left;
                font-family: "Graphik Extralight", Sans-serif;
                font-size: 24px;
                font-weight: normal;
                border-bottom: 1px solid #80808066;
                padding-bottom: 5px;
            }

            .building-info p strong {
                font-family: "Graphik Extralight", Sans-serif;
                font-size: 14px;
                font-weight: normal;
            }

            .button {
                margin-top: 10px;
                text-decoration: none;
                padding: 10px 20px;
                color: #fff;
                background-color: #093D5F;
                display: inline-block;
                font-family: "Graphik Medium", Sans-serif;
                font-size: 12px;
                font-weight: normal;
                transition: all 0.3s ease;
                border: 2px solid transparent;
                font-size: 16px;
            }

            .button:hover {
                background-color: #fff;
                color: #093D5F;
                border-color: #093D5F;
            }
        </style>

        <div class="building-blocks-container">
            <?php foreach ($settings['slides'] as $slide): ?>
                <div class="building-block">
                    <img src="<?php echo esc_url($slide['slide_image']['url']); ?>" alt="">
                    <div class="building-info">
                        <p><strong>Building:</strong><?php echo esc_html($slide['building_text']); ?></p>
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
            <?php endforeach; ?>
        </div>

<?php
    }
}

?>