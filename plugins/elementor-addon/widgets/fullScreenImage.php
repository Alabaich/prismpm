<?php

class Elementor_fullScreenImage extends \Elementor\Widget_Base {

    public function get_name() {
        return 'fullScreenImage';
    }

    public function get_title() {
        return esc_html__('Fullscreen Image Section', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-image';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {
        $this->start_controls_section('content_section', [
            'label' => esc_html__('Content', 'elementor-addon'),
            'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('image', [
            'label' => esc_html__('Image', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="fullscreenImageSection">
            <?php if (!empty($settings['image']['url'])) : ?>
                <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="Fullscreen Image">
            <?php endif; ?>
        </div>

        <style>
            .fullscreenImageSection {
                width: 100%;
                padding: 0;
                margin: 0;
            }

            .fullscreenImageSection img {
                width: 100%;
                max-height: 100vh;
                min-height: 100vh;
                object-fit: cover;
                display: block;
            }

            @media (max-width: 768px) {
                .fullscreenImageSection img {
                    max-height: 80vh;
                    min-height: 80vh;
                }
            }
        </style>
        <?php
    }
}