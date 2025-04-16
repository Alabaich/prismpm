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

    .land-acknowledgement-section h2 {
        font-size: 2rem;
        margin-bottom: 0.625rem;
    }

    .land-acknowledgement-section p.subtitle {
        max-width: 30.5rem;
        margin: 0 auto 2.5rem;
        font-size: 1rem;
        line-height: 1.6;
        color: #eee;
    }

    .city-columns {
        display: flex;
        flex-wrap: nowrap;
        justify-content: center;
        gap: 0 2rem;
        margin-top: 1.25rem;
    }

    .city-block {
        display: flex;
        text-align: left;
        gap: 0 1rem;
    }

    .city-block-text {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .city-block img {
        border-radius: 0.5rem;
        width: 17.25rem;
        margin-bottom: 0.75rem;
    }

    .city-block-text h4 {
        font-size: 2rem;
    }

    .city-block-text p {
        font-size: 1.375rem;
        color: #E0E0E0;
        line-height: 108%;
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
