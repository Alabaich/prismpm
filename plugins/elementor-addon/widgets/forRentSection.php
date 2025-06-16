<?php
class Elementor_forRentSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'forRentSection';
    }

    public function get_title()
    {
        return esc_html__('For Rent Listings', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-home';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => esc_html__('Main Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'For Rent',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'property_title',
            [
                'label' => esc_html__('Property Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '1 Bed Loft in Downtown Peterborough',
            ]
        );

        $repeater->add_control(
            'price',
            [
                'label' => esc_html__('Price', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '$2,250/month',
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $repeater->add_control(
            'bedrooms',
            [
                'label' => esc_html__('Bedrooms', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '1 bedroom',
            ]
        );

        $repeater->add_control(
            'bathrooms',
            [
                'label' => esc_html__('Bathrooms', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '1 bathroom',
            ]
        );

        $repeater->add_control(
            'pet_friendly',
            [
                'label' => esc_html__('Pet Friendly', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Pet-friendly',
            ]
        );

        $repeater->add_control(
            'available',
            [
                'label' => esc_html__('Available', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'available',
            ]
        );

        $this->add_control(
            'properties',
            [
                'label' => esc_html__('Properties', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'property_title' => '1 Bed Loft in Downtown Peterborough',
                        'price' => '$2,250/month',
                        'bedrooms' => '1 bedroom',
                        'bathrooms' => '1 bathroom',
                        'pet_friendly' => 'Pet-friendly',
                        'available' => 'available',
                    ],
                    [
                        'property_title' => '1 Bed Loft in Downtown Peterborough',
                        'price' => '$2,250/month',
                        'bedrooms' => '1 bedroom',
                        'bathrooms' => '1 bathroom',
                        'pet_friendly' => 'Pet-friendly',
                        'available' => 'available',
                    ],
                    [
                        'property_title' => '1 Bed Loft in Downtown Peterborough',
                        'price' => '$2,250/month',
                        'bedrooms' => '1 bedroom',
                        'bathrooms' => '1 bathroom',
                        'pet_friendly' => 'Pet-friendly',
                        'available' => 'available',
                    ],
                ],
                'title_field' => '{{{ property_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
    ?>
        <section class="pageWidthFR">
            <div class="rent-display">
                <div class="rent-container">
                    <h2 class="rent-title"><?php echo esc_html($settings['main_title']); ?></h2>
                    <div class="rent-grid">
                        <?php foreach ($settings['properties'] as $property) : ?>
                            <div class="rent-card">
                                <?php if (!empty($property['image']['url'])) : ?>
                                    <div class="rent-card-image" style="background-image: url('<?php echo esc_url($property['image']['url']); ?>');"></div>
                                <?php endif; ?>
                                <h3 class="rent-card-title"><?php echo esc_html($property['property_title']); ?></h3>
                                <p class="rent-card-price"><?php echo esc_html($property['price']); ?></p>
                                <div class="rent-card-details">
                                    <span class="rent-detail"><?php echo esc_html($property['bedrooms']); ?></span>
                                    <span class="rent-detail"><?php echo esc_html($property['bathrooms']); ?></span>
                                    <span class="rent-detail"><?php echo esc_html($property['pet_friendly']); ?></span>
                                </div>
                                <div class="rent-card-status">
                                    <span class="rent-status-dot"></span>
                                    <span class="rent-status-text"><?php echo esc_html($property['available']); ?></span>
                                </div>
                                <a href="#" class="rent-button explore-button">Explore Now <span>→</span></a>
                                <a href="#" class="rent-button view-button">Book a Viewing <span>→</span></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <style>
            .pageWidthFR {
                padding: 25px 10%;
                width: 100%;
            }
            @media screen and (max-width: 1600px) {
                .pageWidthFR {
                    padding: 25px;
                }
            }
            @media screen and (max-width: 768px) {
                .pageWidthFR {
                    padding: 15px;
                }
            }

            .pageWidthFR .rent-display .rent-grid {
                width: 100%; 
                margin-top: 1rem;
            }

            .pageWidthFR .rent-display {
                text-align: center;
            }

            .pageWidthFR .rent-display .rent-title {
                margin: 0 0 1rem;
                color: #2C2D2C;
                font-size: 2rem;
            }

            .pageWidthFR .rent-display .rent-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }

            .pageWidthFR .rent-display .rent-card {
                background-color: #FFFFFF;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .pageWidthFR .rent-display .rent-card-image {
                background-size: cover;
                background-position: center;
                border-radius: 8px;
                height: 240px;
                width: 100%;
                margin-bottom: 1rem;
            }

            .pageWidthFR .rent-display .rent-card-title {
                margin: 0 0 0.5rem;
                color: #2A2A2A;
                font-weight: bold;
                font-size: 1.1rem;
            }

            .pageWidthFR .rent-display .rent-card-price {
                margin: 0 0 0.75rem;
                color: #2A2A2A;
                font-weight: bold;
                font-size: 1.2rem;
            }

            .pageWidthFR .rent-display .rent-card-details {
                display: flex;
                gap: 10px;
                margin-bottom: 0.5rem;
                color: #6B7280;
                font-size: 0.9rem;
            }

            .pageWidthFR .rent-display .rent-card-status {
                display: flex;
                align-items: center;
                gap: 8px;
                margin-bottom: 1rem;
                color: #10B981;
                font-size: 0.9rem;
            }

            .pageWidthFR .rent-display .rent-status-dot {
                width: 8px;
                height: 8px;
                background-color: #10B981;
                border-radius: 50%;
            }

            .pageWidthFR .rent-display .rent-button {
                display: inline-block;
                padding: 10px 20px;
                margin: 5px 0;
                border-radius: 9999px;
                text-decoration: none;
                font-size: 0.9rem;
                font-weight: bold;
                width: 100%;
                text-align: center;
            }

            .pageWidthFR .rent-display .explore-button {
                background-color: #093D5F;
                color: #FFFFFF;
            }

            .pageWidthFR .rent-display .view-button {
                background-color: #FFFFFF;
                color: #093D5F;
                border: 1px solid #093D5F;
            }

            .pageWidthFR .rent-display .rent-button span {
                margin-left: 5px;
            }

            @media (max-width: 991px) {
                .pageWidthFR .rent-display .rent-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 576px) {
                .pageWidthFR .rent-display .rent-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    <?php
    }
}