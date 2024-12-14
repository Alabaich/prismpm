<?php

class Elementor_totalServices extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'totalServices';
    }

    public function get_title()
    {
        return esc_html__('Total Services', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-code';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['services', 'blocks', 'features'];
    }

    protected function register_controls()
    {
        // Section Title Controls
        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Title & Subtitle', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Our Services', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('What we offer', 'elementor-addon'),
            ]
        );

        $this->end_controls_section();

        // Repeater Section Controls
        $this->start_controls_section(
            'section_services',
            [
                'label' => esc_html__('Services', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $repeater->add_control(
            'service_title',
            [
                'label' => esc_html__('Service Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Service Title', 'elementor-addon'),
            ]
        );

        $repeater->add_control(
            'service_description',
            [
                'label' => esc_html__('Service Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Service description goes here.', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'services_list',
            [
                'label' => esc_html__('Services List', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'service_title' => esc_html__('Service 1', 'elementor-addon'),
                        'service_description' => esc_html__('Description for service 1.', 'elementor-addon'),
                    ],
                    [
                        'service_title' => esc_html__('Service 2', 'elementor-addon'),
                        'service_description' => esc_html__('Description for service 2.', 'elementor-addon'),
                    ],
                ],
                'title_field' => '{{{ service_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>

        <style>
            .total-services {
                text-align: center;
            }

            .section-header {
                margin-bottom: 20px;
            }

            .section-header h2 {
                font-family: "Graphik Light", Sans-serif;
                font-size: 50px;
                font-weight: normal;
                color: #093d5f;
            }

            .section-header p {
                font-size: 1rem;
                padding: 0% 10% 0% 10%
            }

            .services-list {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 20px;
            }

            .service-block {
                display: flex;
                flex-direction: column;
                align-items: start;
                flex: 1 1 calc(33.333% - 20px);
                max-width: 400px;
                padding: 20px;
                text-align: center;
                box-sizing: border-box;
                gap: var(--gap);
            }

            .service-block .icon-wrapper {
                margin-bottom: 5px;
            }

            .service-block h2 {
                padding: 0px 0px 5px 0px;
                border-style: solid;
                width: 100%;
                color: #093d5f;
                text-align: left;
                border-width: 0px 0px 1px 0px;
                border-color: #093d5f;
            }

            .service-block p {
                font-size: 1rem;
                color: #555;
            }

            @media screen and (max-width: 600px) {
                .service-block {
                    width: 100%;
                }
            }
        </style>


        <div class="total-services">
            <div class="section-header">
                <h2 class="elementor-heading-title elementor-size-default"><?php echo esc_html($settings['title']); ?></h2>
                <p class="elementor-widget-container elementor-motion-effects-element"><?php echo esc_html($settings['subtitle']); ?></p>
            </div>
            <div class="services-list">
                <?php foreach ($settings['services_list'] as $service) : ?>
                    <div class="service-block">
                        <div class="icon-wrapper">
                            <?php \Elementor\Icons_Manager::render_icon($service['icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                        <h2 class="elementor-heading-title elementor-size-default"> <?php echo esc_html($service['service_title']); ?> </h2>
                        <p class="service-description"> <?php echo esc_html($service['service_description']); ?> </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
<?php
    }
}
