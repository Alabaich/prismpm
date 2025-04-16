<?php

class Elementor_announceProperty extends \Elementor\Widget_Base
{
    public function get_name() {
        return 'announceProperty';
    }

    public function get_title() {
        return esc_html__('Announce Property', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Section Content', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Properties Coming Soon',
            ]
        );

        $this->add_control(
            'section_subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Explore more properties and details at Atriadevelopment.ca',
            ]
        );
        $this->add_control(
            'section_image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Property Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Town Centre Place',
            ]
        );

        $repeater->add_control(
            'address',
            [
                'label' => esc_html__('Address', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '1680 Brimley Rd, Toronto',
            ]
        );

        $repeater->add_control(
            'developer',
            [
                'label' => esc_html__('Developer', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Atria Development',
            ]
        );

        $repeater->add_control(
            'label_left',
            [
                'label' => esc_html__('Left Label (e.g. Towers or Units)', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Towers',
            ]
        );

        $repeater->add_control(
            'value_left',
            [
                'label' => esc_html__('Left Value (e.g. 4 or 244)', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '4',
            ]
        );

        $repeater->add_control(
            'launch_date',
            [
                'label' => esc_html__('Estimated Launch', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Fall 2026',
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => esc_html__('Pre-Register Link', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
            ]
        );

        $this->add_control(
            'properties',
            [
                'label' => esc_html__('Properties', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <style>
            .coming-soon-section {
                padding: 60px 20px;
            }

            .coming-soon-section h1 {
                margin-bottom: 10px;
            }

            .coming-soon-section p {
                color: #555;
                margin-bottom: 30px;
            }

            .property-card {
                display: flex;
                justify-content: space-between;
                background: #f9f9f9;
                padding: 20px;
                border-radius: 12px;
                margin-bottom: 20px;
                flex-wrap: nowrap;
            }

            .property-content {
                max-width: 100%;
                min-width: 558px;
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .property-content h3 {
                font-size: 22px;
                margin-bottom: 10px;
            }

            .property-content .meta {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 40px;
                font-size: 14px;
                color: #333;
            }

            .property-image img {
                border-radius: 8px;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .meta div {
                display: flex;
                flex-direction: column;
                gap: 12px 0;
            }

            .meta span {
                font-weight: 400;
            }

            .property-button {
                margin-top:40px;
            }

            .property-button a {
                display: inline-flex;
                align-items: center;
                background: #04364C;
                color: #fff;
                padding: 10px 20px;
                border-radius: 30px;
                font-size: 1rem;
                margin-top: 16px;
                text-decoration: none;
                transition: background 0.3s;
            }
            .title-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: nowrap;
}
            .section-titles {
                display:flex;
                flex-direction: column;
            }
            .section-img img {
                max-width: 240px;
                height: auto;
            }

            .flex {
                display:flex;
            }
            .property-button a:hover {
                background: #052b3b;
            }
            .meta-bold {
                font-size: 1.5rem;
                font-weight: 600;
            }
        </style>

        <div class="coming-soon-section">
            <div class="title-container">
                <div class="section-titles">
                    <h1 class="flex"><?php echo esc_html($settings['section_title']); ?></h2>
                    <p class="flex"><?php echo esc_html($settings['section_subtitle']); ?></p>
                </div>
                <?php if (!empty($settings['section_image']['url'])) : ?>
                <div class="section-img flex">
                    <img src="<?php echo esc_url($settings['section_image']['url']); ?>" alt="Section Image" />
                </div>
                <?php endif; ?>
            </div>
            <?php foreach ($settings['properties'] as $item): ?>
                <div class="property-card">
                    <div class="property-content">
                        <h3><?php echo esc_html($item['title']); ?></h3>
                        <div class="meta">
    <div><span>Address:</span> <span class="meta-bold"><?php echo esc_html($item['address']); ?></span></div>
    <div><span>Developer:</span> <span class="meta-bold"><?php echo esc_html($item['developer']); ?></span></div>
    <div><span><?php echo esc_html($item['label_left']); ?>:</span> <span class="meta-bold"><?php echo esc_html($item['value_left']); ?></span></div>
    <div><span>Estimated Launch:</span> <span class="meta-bold"><?php echo esc_html($item['launch_date']); ?></span></div>
</div>

                        <?php if (!empty($item['button_link']['url'])): ?>
                            <div class="property-button">
                                <a href="<?php echo esc_url($item['button_link']['url']); ?>" target="<?php echo esc_attr($item['button_link']['is_external'] ? '_blank' : '_self'); ?>">
                                    Pre-Register →
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="property-image">
                        <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php
    }
}
