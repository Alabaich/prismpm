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

        $this->add_control(
            'accent_color',
            [
                'label' => esc_html__('Accent Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#093D5F',
                'description' => esc_html__('Controls border, button background, and text color.', 'elementor-addon'),
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
        $accent_color = esc_attr($settings['accent_color']);
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
                                <div class="suite-title-priceRent" style="display: flex; justify-content: space-between; align-items: start; gap: 1rem;">
                                    <h5 class="rent-card-title"><?php echo esc_html($property['property_title']); ?></h5>
                                    <p class="rent-card-price"><?php echo esc_html($property['price']); ?></p>
                                </div>
                                <div class="rent-card-details">
                                    <span class="tag-item" style="border-color: <?php echo $accent_color; ?>;">
                                        <svg class="tag-icon-svg" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 1.5L11.25 4.5H14.625L12.375 7.5L13.5 10.5L10.5 9L7.5 10.5L8.625 7.5L6.375 4.5H9.75L9 1.5Z" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <?php echo esc_html($property['bedrooms']); ?>
                                    </span>
                                    <span class="tag-item" style="border-color: <?php echo $accent_color; ?>;">
                                        <svg class="tag-icon-svg" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 6H15V15C15 16.1 14.1 17 13 17H5C3.9 17 3 16.1 3 15V6Z" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M7.5 3H10.5V6H7.5V3Z" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <?php echo esc_html($property['bathrooms']); ?>
                                    </span>
                                    <span class="tag-item" style="border-color: <?php echo $accent_color; ?>;">
                                        <svg class="tag-icon-svg" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 3.75C7.071 3.75 5.5 5.321 5.5 7.25C5.5 9.179 7.071 10.75 9 10.75C10.929 10.75 12.5 9.179 12.5 7.25C12.5 5.321 10.929 3.75 9 3.75ZM9 3.75C10.656 3.75 12 5.094 12 6.75C12 8.406 10.656 9.75 9 9.75C7.344 9.75 6 8.406 6 6.75C6 5.094 7.344 3.75 9 3.75ZM9 12.75C6.514 12.75 0 14.321 0 16.75V17.25H18V16.75C18 14.321 11.486 12.75 9 12.75Z" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <?php echo esc_html($property['pet_friendly']); ?>
                                    </span>
                                </div>
                                <div class="rent-card-status">
                                    <span class="rent-status-dot"></span>
                                    <span class="rent-status-text"><?php echo esc_html($property['available']); ?></span>
                                </div>
                                <a href="#" class="rent-button explore-button" style="background-color: <?php echo $accent_color; ?>; color: #FFFFFF;">
                                    Explore Now <span class="arrow" style="transform: rotate(-45deg);">→</span>
                                </a>
                                <a href="#" class="rent-button view-button" style="color: <?php echo $accent_color; ?>; border-color: <?php echo $accent_color; ?>;">
                                    Book a Viewing <span class="arrow" style="transform: rotate(-45deg);">→</span>
                                </a>
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
                background: #F7F9FA;
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
                margin: 0;
                color: #1A1A1A;
                padding: 50px 0;
            }

            .pageWidthFR .rent-display .rent-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }

            .pageWidthFR .rent-display .rent-card {
                background-color: #FFFFFF;
                padding: 25px;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .pageWidthFR .rent-display .rent-card-image {
                background-size: cover;
                background-position: center;
                border-radius: 8px;
                height: 280px;
                width: 100%;
                margin-bottom: 30px;
            }

            .pageWidthFR .rent-display .suite-title-priceRent {
                margin: 0;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-bottom:25px;
            }

            .pageWidthFR .rent-display .rent-card-title {
                color: #1A1A1A;
                font-weight: 500;
                text-align:left;
                margin: 0;
            }

            .pageWidthFR .rent-display .rent-card-price {
                margin: 0;
                color: #2A2A2A;
                font-weight: bold;
                font-size: 1.2rem;
            }

            .pageWidthFR .rent-display .rent-card-details {
                display: flex;
                flex-wrap:wrap;
                gap: 10px;
                padding-bottom:25px;
            }

            .pageWidthFR .rent-display .tag-item {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                background:#F7F9FA;
                padding: 6px 12px;
                border-radius: 999px;
                font-size: 1rem;
                font-weight: 500;
                color: #1A1A1A;
            }

            .pageWidthFR .rent-display .tag-icon-svg {
                width: 18px;
                height: 18px;
            }

            .pageWidthFR .rent-display .rent-card-status {
                display: flex;
                align-items: center;
                gap: 8px;
                padding-bottom:30px;
                color: #2A2A2A;
                font-size: 1rem;
                font-family:"Playfair Display"
            }

            .pageWidthFR .rent-display .rent-status-dot {
                width: 12px;
                height: 12px;
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
                transition: all 0.3s ease;
            }

            .pageWidthFR .rent-display .explore-button:hover {
                opacity: 0.9;
            }

            .pageWidthFR .rent-display .view-button {
                border: 1px solid;
            }

            .pageWidthFR .rent-display .view-button:hover {
                background-color: #f0f0f0;
            }

            .pageWidthFR .rent-display .rent-button .arrow {
                display: inline-block;
                transition: transform 0.3s ease;
                font-size: 20px;
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