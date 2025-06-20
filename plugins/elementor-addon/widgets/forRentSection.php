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
            'sqf',
            [
                'label' => esc_html__('SqFeet', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '547.45',
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
                        'price' => '$2,250',
                        'bedrooms' => '1 bedroom',
                        'bathrooms' => '1 bathroom',
                        'pet_friendly' => 'Pet-friendly',
                        'sqf' => '547.45',
                        'available' => 'available',
                    ],
                    [
                        'property_title' => '1 Bed Loft in Downtown Peterborough',
                        'price' => '$2,250',
                        'bedrooms' => '1 bedroom',
                        'bathrooms' => '1 bathroom',
                        'pet_friendly' => 'Pet-friendly',
                        'sqf' => '547.45',
                        'available' => 'available',
                    ],
                    [
                        'property_title' => '1 Bed Loft in Downtown Peterborough',
                        'price' => '$2,250',
                        'bedrooms' => '1 bedroom',
                        'bathrooms' => '1 bathroom',
                        'pet_friendly' => 'Pet-friendly',
                        'sqf' => '547.45',
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
        <section class="pageWidthFR" id="SuitesSec">
            <div class="rent-display">
                <div class="rent-container">
                    <h2 class="rent-title"><?php echo esc_html($settings['main_title']); ?></h2>
                    <div class="rent-grid">
                        <?php foreach ($settings['properties'] as $property) : ?>
                            <div class="rent-card">
                                <?php if (!empty($property['image']['url'])) : ?>
                                    <div class="rent-card-image" style="background-image: url('<?php echo esc_url($property['image']['url']); ?>');"></div>
                                <?php endif; ?>
                                <div class="suite-title-priceRent" style="display: flex; justify-content: space-between; align-items: center;">
                                    <h5 class="rent-card-title"><?php echo esc_html($property['property_title']); ?></h5>
                                    <p class="rent-card-price"><?php echo esc_html($property['price']); ?> <br/><span>month</span></p>
                                </div>
                                                                <div class="rent-card-status">
                                    <span class="rent-status-dot"></span>
                                    <span class="rent-status-text"><?php echo esc_html($property['available']); ?></span>
                                </div>
                                <div class="rent-card-details">
                                    <span class="tag-item" style="border-color: <?php echo $accent_color; ?>;">
                                        <svg class="tag-icon-svg" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M3 5V18M3 15H20M20 18V13C20 11.9599 20.2026 11.3972 20 11C19.8218 10.6506 19.3497 10.178 19 10C18.6024 9.79757 18.0411 10 17 10H11V15M7 12V12M8 12C8 12.5128 7.51331 12 7 12C6.48669 12 6 12.5128 6 12C6 11.4872 6.48669 11 7 11C7.51331 11 8 11.4872 8 12Z" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

                                        <?php echo esc_html($property['bedrooms']); ?>
                                    </span>
                                    <span class="tag-item" style="border-color: <?php echo $accent_color; ?>;">
                                        <svg class="tag-icon-svg" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M12 5C10.7565 5.27805 10 6.70444 10 8H15C15 6.77309 14.1443 5.34267 13 5C13.2198 4.52715 14.4324 4 15 4C15.7732 4 16 5.24688 16 6V11H4V13H5V16C5 17.1296 5.8402 18 7 18H15C16.1598 18 17 17.1296 17 16V13H18V11H17V6C17 4.49377 16.5464 3 15 3C13.6699 3 12.2855 3.78881 12 5ZM6 13H16V16C16 16.3765 15.3866 17 15 17H7C6.6134 17 6 16.3765 6 16V13ZM12 6C12.5182 6 13.758 6.59241 14 7H11C11.242 6.59241 11.4818 6 12 6Z" fill="#1A1A1A"/>
</svg>

                                        <?php echo esc_html($property['bathrooms']); ?>
                                    </span>
                                    <span class="tag-item" style="border-color: <?php echo $accent_color; ?>;">
                                        <svg class="tag-icon-svg" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4.00004 15C3.79246 17.6492 5.49178 20 8.00004 20H13C15.8197 20 17.4671 17.9517 17 15C16.507 11.9017 13.9667 9 11 9C7.78258 9 4.26816 11.5992 4.00004 15Z" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M10 7C11.3807 7 12 6.38071 12 5C12 3.61929 11.3807 2 10 2C8.61927 2 7 3.61929 7 5C7 6.38071 8.61927 7 10 7Z" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M16 8C17.1046 8 18 7.10457 18 6C18 4.89543 17.1046 4 16 4C14.8955 4 14 4.89543 14 6C14 7.10457 14.8955 8 16 8Z" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M20 12C20.8284 12 21 11.8284 21 11C21 10.1715 20.8284 9 20 9C19.1716 9 18 10.1715 18 11C18 11.8284 19.1716 12 20 12Z" stroke="#1A1A1A" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M4 10C5.10457 10 6 9.10456 6 8C6 6.89544 5.10457 6 4 6C2.89543 6 2 6.89544 2 8C2 9.10456 2.89543 10 4 10Z" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

                                        <?php echo esc_html($property['pet_friendly']); ?>
                                    </span>
                                    <span class="tag-item" style="border-color: <?php echo $accent_color; ?>;">
                                        <svg class="tag-icon-svg" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.33333 0.75H2.58333C2.0971 0.75 1.63079 0.943154 1.28697 1.28697C0.943154 1.63079 0.75 2.0971 0.75 2.58333V5.33333M17.25 5.33333V2.58333C17.25 2.0971 17.0568 1.63079 16.713 1.28697C16.3692 0.943154 15.9029 0.75 15.4167 0.75H12.6667M12.6667 17.25H15.4167C15.9029 17.25 16.3692 17.0568 16.713 16.713C17.0568 16.3692 17.25 15.9029 17.25 15.4167V12.6667M0.75 12.6667V15.4167C0.75 15.9029 0.943154 16.3692 1.28697 16.713C1.63079 17.0568 2.0971 17.25 2.58333 17.25H5.33333" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

                                        <?php echo esc_html($property['sqf']); ?>
                                    </span>
                                </div>
                                <div style="display:flex; flex-direction:column; gap:10px;">
                                    <a href="#" class="rent-button explore-button" style="background-color: <?php echo $accent_color; ?>; color: #FFFFFF;">
                                        Explore Now <span class="arrow" style="margin-left:10px;">
                                            <svg width="12" height="12" viewBox="0 0 11 10" fill="#FFFFFF" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.1221 0C10.582 0.000175951 10.9549 0.373029 10.9551 0.833008V9.16699C10.9549 9.62697 10.582 9.99982 10.1221 10C9.66194 10 9.28826 9.62708 9.28809 9.16699V2.7832L2.37793 9.75586C2.05249 10.0813 1.52466 10.0813 1.19922 9.75586C0.873783 9.43042 0.873782 8.90259 1.19922 8.57715L8.04883 1.66699H1.78809C1.328 1.66682 0.955078 1.29314 0.955078 0.833008C0.955254 0.373029 1.32811 0.000175823 1.78809 0H10.1221Z"/>
                                            </svg>
                                        </span>
                                    </a>
                                    <a href="#" class="rent-button view-button" style="color: <?php echo $accent_color; ?>; border-color: <?php echo $accent_color; ?>;">
                                        Book a Viewing <span class="arrow" style="margin-left:10px;">
                                            <svg width="12" height="12" viewBox="0 0 11 10" fill="<?php echo $accent_color; ?>" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10.1221 0C10.582 0.000175951 10.9549 0.373029 10.9551 0.833008V9.16699C10.9549 9.62697 10.582 9.99982 10.1221 10C9.66194 10 9.28826 9.62708 9.28809 9.16699V2.7832L2.37793 9.75586C2.05249 10.0813 1.52466 10.0813 1.19922 9.75586C0.873783 9.43042 0.873782 8.90259 1.19922 8.57715L8.04883 1.66699H1.78809C1.328 1.66682 0.955078 1.29314 0.955078 0.833008C0.955254 0.373029 1.32811 0.000175823 1.78809 0H10.1221Z"/>
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <style>
            .pageWidthFR {
                padding: 100px 10%;
                width: 100%;
                background: #F7F9FA;
            }
            @media screen and (max-width: 1600px) {
                .pageWidthFR {
                    padding: 100px 25px;
                }
            }
            @media screen and (max-width: 768px) {
                .pageWidthFR {
                    padding: 60px 15px;
                }
                .pageWidthFR .rent-display .rent-title {
                font-size:24px;
                padding-bottom:40px;
                }   
            }

            .pageWidthFR .rent-display .rent-grid {
                width: 100%;
            }

            .pageWidthFR .rent-display {
                text-align: center;
            }

            .pageWidthFR .rent-display .rent-title {
                margin: 0;
                color: #1A1A1A;
                padding-bottom:70px;
                font-family: "Playfair Display";
                font-size:52px;
                font-weight:600;
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
                margin-bottom: 32px;
            }

            .pageWidthFR .rent-display .suite-title-priceRent {
                margin: 0;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding-bottom:25px;
            }

            .pageWidthFR .rent-display .rent-card-title {
                font-family: "Playfair Display";
                color: #1A1A1A;
                font-weight: 600;
                font-size:22px;
                text-align:left;
                margin: 0;
                max-width:300px;
            }

            .pageWidthFR .rent-display .rent-card-price {
                font-family: "Playfair Display";
                display:flex;
                flex-direction:column;
                margin: 0;
                color: #2A2A2A;
                font-weight: bold;
                font-size: 30px;
                justify-content:center;
            }
            .pageWidthFR .rent-display .rent-card-price span {
                font-size: 1rem;
                color:#2C2C2C;
                font-weight:400;
            }

            .pageWidthFR .rent-display .rent-card-details {
                display: flex;
                flex-wrap:wrap;
                gap: 10px;
                padding-bottom:40px;
            }

            .pageWidthFR .rent-display .tag-item {
                display: inline-flex;
                font-family: "Playfair Display", serif;
                align-items: center;
                gap: 0.5rem;
                background:#F7F9FA;
                padding: 15px;
                border-radius: 999px;
                font-size: 1rem;
                font-weight: 500;
                color: #1A1A1A;
            }

            .pageWidthFR .rent-display .tag-icon-svg {
                width: 20px;
                height: 20px;
            }

            .pageWidthFR .rent-display .rent-card-status {
                display: flex;
                align-items: center;
                gap: 8px;
                padding-bottom:25px;
                color: #2A2A2A;
                font-size: 1rem;
                font-family: "Playfair Display", serif;

            }

            .pageWidthFR .rent-display .rent-status-dot {
                width: 12px;
                height: 12px;
                background-color: #10B981;
                border-radius: 50%;
            }

            .pageWidthFR .rent-display .rent-button {
                font-family: "Playfair Display", serif;

                font-size:1rem;
                display: inline-block;
                padding: 16px 0;
                margin:0;
                border-radius: 9999px;
                text-decoration: none;
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

            .pageWidthFR .rent-display .rent-button .arrow svg {
                display: inline-block;
                transition: transform 0.3s ease;
                font-size: 20px;
            }

            @media (max-width: 991px) {
                .pageWidthFR .rent-display .rent-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }
            @media screen and (max-width: 768px) {
                .pageWidthFR {
                    padding: 60px 15px;
                }
                .pageWidthFR .rent-display .rent-title {
                font-size:24px;
                padding-bottom:40px;
                }   
                            .pageWidthFR .rent-display .rent-card {
                padding: 16px;
            }
                        .pageWidthFR .rent-display .rent-card-image {
                height: 200px;
                margin-bottom: 16px;
            }
                        .pageWidthFR .rent-display .suite-title-priceRent {
                padding-bottom:16px;
            }
                        .pageWidthFR .rent-display .rent-card-status {
                gap: 6px;
                padding-bottom:16px;
            }
                        .pageWidthFR .rent-display .rent-card-title {
                max-width:240px;
            }
                        .pageWidthFR .rent-display .rent-card-details {
                gap: 8px;
                padding-bottom:20px;
            }
                        .pageWidthFR .rent-display .rent-button {
                font-size:14px;
            }
                        .pageWidthFR .rent-display .rent-card-price {
                font-size: 22px;
            }
                        .pageWidthFR .rent-display .rent-card-price span {
                font-size: 14px;
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