<?php

class Elementor_showCaseSection extends \Elementor\Widget_Base
{
    public function get_name() {
        return 'showCaseSection';
    }

    public function get_title() {
        return esc_html__('Show Case', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-editor-align-center';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Land Acknowledgement',
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'We respectfully acknowledge that we are gathered on the traditional territories of the Mississauga Anishinaabeg.',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'city',
            [
                'label' => esc_html__('City', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Oshawa',
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Oshawa, one of Canada’s fastest-growing cities...',
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

        $this->add_control(
            'cities',
            [
                'label' => esc_html__('Cities', 'elementor-addon'),
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
    .land-acknowledgement-section {
        background-color: #04364C;
        color: white;
        padding: 5rem 1.25rem;
        text-align: center;
    }

    .land-acknowledgement-section h1 {
        font-size: 2rem;
        margin-bottom: 0.75rem;
    }

    .land-acknowledgement-section .subtitle {
        max-width: 32rem;
        margin: 0 auto 2.5rem;
        font-size: 1rem;
        line-height: 1.6;
        color: #eee;
    }

    .city-columns {
        display: flex;
        flex-direction: column;
        gap: 3rem;
        align-items: baseline;
    }

    .city-block {
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 30rem;
        margin: 0 auto;
    }

    .city-block img {
        width: 100%;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        object-fit: cover;
        max-height: 300px;
        max-width:380px;
    }

    .city-block-text h4 {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    .city-block-text p {
        font-size: 1rem;
        color: #E0E0E0;
        line-height: 1.5;
    }

    @media (min-width: 768px) {
        .land-acknowledgement-section {
            padding: 6rem 2rem;
        }

        .city-columns {
            flex-direction: row;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .city-block {
            flex-direction: column;
            max-width: 20rem;
        }

        .city-block img {
            max-height: 250px;
            max-width:300px;
        }

        .city-block-text h4 {
            font-size: 1.5rem;
        }

        .city-block-text p {
            font-size: 1.125rem;
        }
    }
</style>


        <div class="land-acknowledgement-section">
            <h1><?php echo esc_html($settings['main_title']); ?></h1>
            <p class="subtitle"><?php echo esc_html($settings['subtitle']); ?></p>
            <div class="city-columns">
                <?php foreach ($settings['cities'] as $city): ?>
                    <div class="city-block">
                        <img src="<?php echo esc_url($city['image']['url']); ?>" alt="<?php echo esc_attr($city['city']); ?>">
                        <div class = "city-block-text">
                            <h4><?php echo esc_html($city['city']); ?></h4>
                            <p><?php echo esc_html($city['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php
    }
}
