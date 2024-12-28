<?php

class Elementor_PropertiesComingSoon extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'PropertiesComingSoon';
    }

    public function get_title()
    {
        return esc_html__('Properties Coming Soon', 'elementor-addon');
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

        $fixed_titles = ['Building', 'Address', 'Developer', 'Towers', 'estimated'];

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
            ]
        );

        $repeater->add_control(
            'button_url',
            [
                'label' => esc_html__('Button URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
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
            .properties-coming-soon-container {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                gap: 20px;
                align-items: flex-start;
                padding: 50px 15px;
                width: 100%;
                background-color: #093D5F;
            }

            .property-coming-soon-block {
                display: flex;
                align-items: center;
                text-align: center;
                max-width: 40%;
                width: 100%;
                gap: 20px;
                box-sizing: border-box;
            }

            .property-coming-soon-block img {
                width: 100%;
                height: 100%;
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
                color: #fff;
                border-bottom: 1px solid #80808066;
                padding-bottom: 5px;
            }

            .building-info p strong {
                font-family: "Graphik Extralight", Sans-serif;
                font-size: 14px;
                color: #fff;
                font-weight: normal;
            }

            .button {
                text-decoration: none;
                padding: 10px 20px;
                color: #fff;
                background-color: #fff;
                display: inline-block;
                font-family: "Graphik Medium", Sans-serif;
                font-size: 12px;
                font-weight: normal;
                transition: all 0.3s ease;
                border: 2px solid transparent;
                font-size: 16px;
            }

            .button:hover {
                background-color: #093D5F;
                color: #fff;
                border-color: #fff;
            }

            .property-coming-soon-block .property-image-container {
                height: 100%;
                width: 100%;
            }

            @media screen and (max-width: 1600px) {
                .property-coming-soon-block {
                    max-width: 380px;
                }

                .building-blocks-container {
                    gap: 40px;
                }
            }

            @media screen and (max-width: 768px) {
                .property-coming-soon-block {
                    max-width: 75%;
                }
            }

            @media screen and (max-width: 600px) {
                .property-coming-soon-block img {
                    max-height: 250px;
                }

                .property-coming-soon-block {
                    max-width: 100%;
                }

                .building-info p {
                    font-size: 18px;
                }

                .building-blocks-container {
                    gap: 25px;
                }
            }
        </style>

        <div class="properties-coming-soon-container">
            <?php foreach ($settings['slides'] as $slide): ?>
                <div class="property-coming-soon-block">
                    <div class="property-image-container">
                        <img src="<?php echo esc_url($slide['slide_image']['url']); ?>" alt="">
                    </div>

                    <div class="building-info">
                        <p><strong>Building:</strong><?php echo esc_html($slide['building_text']); ?></p>
                        <p><strong>Address:</strong> <?php echo esc_html($slide['address_text']); ?></p>
                        <p><strong>Developer:</strong> <?php echo esc_html($slide['developer_text']); ?></p>
                        <p><strong>Towers:</strong> <?php echo esc_html($slide['towers_text']); ?></p>
                        <p><strong>Estimated Launch:</strong> <?php echo esc_html($slide['estimated_text']); ?></p>
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