<?php
class Elementor_buildFeaturesSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'buildFeaturesSection';
    }

    public function get_title()
    {
        return esc_html__('Building Features Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-building';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Section Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Sophisticated Building Features',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'feature_name',
            [
                'label' => esc_html__('Feature Name', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Bike Storage',
            ]
        );

        $repeater->add_control(
            'feature_icon',
            [
                'label' => esc_html__('Icon', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-bicycle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'features',
            [
                'label' => esc_html__('Features', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['feature_name' => 'Bike Storage', 'feature_icon' => ['value' => 'fas fa-bicycle', 'library' => 'fa-solid']],
                    ['feature_name' => 'Stainless Steel Appliances', 'feature_icon' => ['value' => 'fas fa-utensils', 'library' => 'fa-solid']],
                    ['feature_name' => 'EV Charging', 'feature_icon' => ['value' => 'fas fa-charging-station', 'library' => 'fa-solid']],
                    ['feature_name' => 'Fully Equipped Gym', 'feature_icon' => ['value' => 'fas fa-dumbbell', 'library' => 'fa-solid']],
                    ['feature_name' => 'Smart Unit Phone Control', 'feature_icon' => ['value' => 'fas fa-mobile-alt', 'library' => 'fa-solid']],
                    ['feature_name' => '24/7 Security', 'feature_icon' => ['value' => 'fas fa-shield-alt', 'library' => 'fa-solid']],
                    ['feature_name' => 'Lobby Lounge with Fireplace', 'feature_icon' => ['value' => 'fas fa-fire', 'library' => 'fa-solid']],
                    ['feature_name' => '9 ft or Higher Ceilings', 'feature_icon' => ['value' => 'fas fa-ruler-vertical', 'library' => 'fa-solid']],
                    ['feature_name' => 'Parcel Lockers', 'feature_icon' => ['value' => 'fas fa-box', 'library' => 'fa-solid']],
                    ['feature_name' => 'Dog Wash Station', 'feature_icon' => ['value' => 'fas fa-paw', 'library' => 'fa-solid']],
                    ['feature_name' => 'Party Room', 'feature_icon' => ['value' => 'fas fa-glass-cheers', 'library' => 'fa-solid']],
                    ['feature_name' => 'Business Centre', 'feature_icon' => ['value' => 'fas fa-briefcase', 'library' => 'fa-solid']],
                    ['feature_name' => 'Rooftop Terrace', 'feature_icon' => ['value' => 'fas fa-umbrella-beach', 'library' => 'fa-solid']],
                    ['feature_name' => 'Storage Lockers', 'feature_icon' => ['value' => 'fas fa-archive', 'library' => 'fa-solid']],
                ],
                'title_field' => '{{{ feature_name }}}',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1a3c5e',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <div class="features-unique pageWidthBdF">
            <style>
                .pageWidthBdF {
                    width: 100%;
                    padding: 25px 10%;
                }
                @media screen and (max-width: 1600px) {
                    .pageWidthBdF {
                        width: 100%;
                        padding: 25px;
                    }
                }
                @media screen and (max-width: 768px) {
                    .pageWidthBdF {
                        width: 100%;
                        padding: 15px;
                    }
                }
                .features-unique {
                    text-align: center;
                }

                .features-unique .title-block {
                    padding-bottom: 25px;
                    margin: 0;
                }

                .features-unique .grid-layout {
                    padding-top: 25px;
                    display: grid;
                    grid-template-columns: repeat(5, 1fr); 
                    gap: 50px; 
                    justify-content:center;
                    width: 100%;
                }

                .features-unique .feature-card {
                }

                .features-unique .feature-card .icon-block {
                    font-size: 1.5rem; 
                    fill: <?php echo esc_attr($settings['icon_color']); ?>;
                    margin-bottom: 10px;
                    display: flex;
                    justify-content: center;
                }

                .features-unique .feature-card .icon-block svg {
                    width: 50%; 
                    height: 50%; 
                }

                .features-unique .feature-card .feature-name {
                    padding-top:20px;
                    margin: 0;
                    color:#1A1A1A;
                    font:bold;
                }

                @media (max-width: 1200px) {
                    .features-unique .grid-layout {
                        grid-template-columns: repeat(3, 1fr); 
                    }
                }

                @media (max-width: 768px) {
                    .features-unique .grid-layout {
                        grid-template-columns: 1fr; 
                    }
                }
            </style>

            <h2 class="title-block"><?php echo esc_html($settings['section_title']); ?></h2>
            <div class="grid-layout">
                <?php foreach ($settings['features'] as $feature): ?>
                    <div class="feature-card">
                        <div class="icon-block">
                            <?php \Elementor\Icons_Manager::render_icon($feature['feature_icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                        <h4 class="feature-name"><?php echo esc_html($feature['feature_name']); ?></h4>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
<?php
    }
}