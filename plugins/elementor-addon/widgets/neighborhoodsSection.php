<?php
class Elementor_neighborhoodsSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'neighborhoodsSection';
    }

    public function get_title()
    {
        return esc_html__('Discover Our Neighborhoods', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-info';
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
                'default' => 'Discover Our Neighborhoods',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Oshawa offers diverse communities, each with its own unique character and charm. Find the perfect neighborhood to call home.',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'neighborhood_title',
            [
                'label' => esc_html__('Neighborhood Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Downtown Oshawa',
            ]
        );

        $repeater->add_control(
            'neighborhood_description',
            [
                'label' => esc_html__('Neighborhood Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'The cultural and commercial heart of the city with historic architecture, modern amenities, and a revitalized urban vibe.',
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
            'highlight1',
            [
                'label' => esc_html__('Highlight 1', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Diverse dining options',
            ]
        );

        $repeater->add_control(
            'highlight2',
            [
                'label' => esc_html__('Highlight 2', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Walkable streets',
            ]
        );

        $repeater->add_control(
            'highlight3',
            [
                'label' => esc_html__('Highlight 3', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Historic buildings',
            ]
        );

        $repeater->add_control(
            'highlight4',
            [
                'label' => esc_html__('Highlight 4', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Thriving arts scene',
            ]
        );

        $repeater->add_control(
            'highlight5',
            [
                'label' => esc_html__('Highlight 5', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->add_control(
            'neighborhoods',
            [
                'label' => esc_html__('Neighborhoods', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'neighborhood_title' => 'Downtown Oshawa',
                        'neighborhood_description' => 'The cultural and commercial heart of the city with historic architecture, modern amenities, and a revitalized urban vibe.',
                        'highlight1' => 'Diverse dining options',
                        'highlight2' => 'Walkable streets',
                        'highlight3' => 'Historic buildings',
                        'highlight4' => 'Thriving arts scene',
                        'highlight5' => '',
                    ],
                    [
                        'neighborhood_title' => 'North Oshawa',
                        'neighborhood_description' => 'Home to Ontario Tech University and Durham College, this area offers a perfect blend of academic energy and residential calm.',
                        'highlight1' => 'Educational institutions',
                        'highlight2' => 'Modern housing',
                        'highlight3' => 'Recreation facilities',
                        'highlight4' => '',
                        'highlight5' => '',
                    ],
                    [
                        'neighborhood_title' => 'Lakeview',
                        'neighborhood_description' => 'Stunning waterfront living with beautiful parks, beaches, and trails along Lake Ontario\'s picturesque shoreline.',
                        'highlight1' => 'Lakefront views',
                        'highlight2' => 'Outdoor recreation',
                        'highlight3' => 'Family-friendly',
                        'highlight4' => 'Natural beauty',
                        'highlight5' => '',
                    ],
                ],
                'title_field' => '{{{ neighborhood_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
    ?>
        <section class="neighborhoods-section pageWidthneib">
            <div class="neighborhoods__container">
                <h2 class="neighborhoods__title"><?php echo esc_html($settings['main_title']); ?></h2>
                <p class="neighborhoods__description"><?php echo esc_html($settings['description']); ?></p>
                <div class="neighborhoods__grid">
                    <?php foreach ($settings['neighborhoods'] as $neighborhood) : ?>
                        <div class="neighborhoods__card">
                            <?php if (!empty($neighborhood['image']['url'])) : ?>
                                <div class="neighborhoods__card-image" style="background-image: url('<?php echo esc_url($neighborhood['image']['url']); ?>');"></div>
                            <?php endif; ?>
                            <h3 class="neighborhoods__card-title"><?php echo esc_html($neighborhood['neighborhood_title']); ?></h3>
                            <p class="neighborhoods__card-description"><?php echo esc_html($neighborhood['neighborhood_description']); ?></p>
                            <div class="neighborhoods__highlights">
                                <?php
                                $highlights = [
                                    $neighborhood['highlight1'],
                                    $neighborhood['highlight2'],
                                    $neighborhood['highlight3'],
                                    $neighborhood['highlight4'],
                                    $neighborhood['highlight5'],
                                ];
                                foreach ($highlights as $highlight) {
                                    if (!empty(trim($highlight))) {
                                        echo '<div class="neighborhoods__highlight"><span class="highlight-circle"></span><span class="highlight-text">' . esc_html($highlight) . '</span></div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <style>
            .neighborhoods-section {
                text-align: center;
            }
                                    .pageWidthneib{
    width: 100%;
    padding: 25px 10%;
}
@media screen and (max-width: 1600px) {
 .pageWidthneib{
  width: 100%;
  padding: 25px;
}
}
@media screen and (max-width: 768px) {
 .pageWidthneib{
  width: 100%;
  padding: 15px;
}
}

            .neighborhoods__container {
                display:flex;
                flex-direction:column;
                align-items:center;
                justify-content:center;
            }

            .neighborhoods__title {
                margin: 0 0 1rem;
                color:#2C2D2C;
            }

            .neighborhoods__description {
                margin: 0;
                padding-bottom:1.5rem;
                max-width:500px;
                color: #52525B;
            }

            .neighborhoods__grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }

            .neighborhoods__card {
                background-color: #093D5F0D;
                padding:20px;
                border-radius: 8px;
                overflow: hidden;
            }

            .neighborhoods__card-image {
                background-size: cover;
                background-position: center;
                border-radius:8px;
                height: 240px;
                width: 100%;
                margin-bottom: 1rem;
            }

            .neighborhoods__card-title {
                margin: 0 0 0.75rem;
                color: #2A2A2A;
                font-weight: bold;
            }

            .neighborhoods__card-description {
                font-size: 1rem;
                margin: 0 0 1.25rem;
                color: #6B7280;
            }

            .neighborhoods__highlights {
                display: flex;
                flex-wrap:wrap;
                gap:8px;
                margin: 0;
            }

            .neighborhoods__highlight {
                display: flex;
                align-items: center;
                gap: 8px;
                padding: 8px 12px;
                background-color: #FFFFFF;
                border-radius: 9999px;
                margin:0;
                border: 1px solid #FFFFFF;
            }

            .highlight-circle {
                width: 8px;
                height: 8px;
                background-color: #10B981;
                border-radius: 50%;
            }

            .highlight-text {
                font-size: 1rem;
                color: #2A2A2A;
            }

            @media (max-width: 991px) {
                .neighborhoods__grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 576px) {
                .neighborhoods__grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    <?php
    }
}