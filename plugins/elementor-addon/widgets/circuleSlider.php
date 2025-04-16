<?php


class Elementor_circuleSlider extends \Elementor\Widget_Base {

    public function get_name() {
        return 'circuleSlider';
    }

    public function get_title() {
        return esc_html__('Circle Image Slider', 'plugin-name');
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Images', 'plugin-name'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'images',
            [
                'label' => esc_html__('Add Images', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'show_label' => false,
                'default' => [],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if (empty($settings['images'])) return;

        echo '<div class="circle-slider swiper">';
        echo '<div class="swiper-wrapper">';
        foreach ($settings['images'] as $image) {
            echo '<div class="swiper-slide">';
            echo '<div class="circle-image">';
            echo wp_get_attachment_image($image['id'], 'medium');
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    }

    public function get_script_depends() {
        return ['swiper'];
    }
}
