<?php

class Elementor_BuildingsSlider extends \Elementor\Widget_Base {
    public function get_name() {
        return 'buildings_slider';
    }

    public function get_title() {
        return esc_html__('Buildings Slider', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-slider-3d';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'slider_content_section',
            [
                'label' => esc_html__('Slider Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        // Неизменяемые заголовки
        $fixed_titles = ['Building', 'Address', 'Developer', 'Units', 'Completed'];
        
        // Для каждого фиксированного заголовка создаем поле
        foreach ($fixed_titles as $title) {
            $repeater->add_control(
                strtolower($title) . '_text',
                [
                    'label' => esc_html__($title, 'elementor-addon'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => '',
                    'placeholder' => esc_html__("Enter $title", 'elementor-addon'),
                ]
            );
        }

        // Добавляем поле для изображения (если нужно)
        $repeater->add_control(
            'slide_image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Добавляем поле для текста кнопки
        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Learn More', 'elementor-addon'),
            ]
        );

        // Добавляем URL для кнопки
        $repeater->add_control(
            'button_url',
            [
                'label' => esc_html__('Button URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
            ]
        );

        // Добавляем контрол для репитера
        $this->add_control(
            'slides',
            [
                'label' => esc_html__('Slides', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ building_text }}}', // Это будет выводить значение "Building" из каждого слайда
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Если слайды пустые, ничего не выводим
        if (empty($settings['slides'])) {
            return;
        }

        ?>
        <div class="buildings-slider">
            <ul class="buildings-list">
                <?php foreach ($settings['slides'] as $slide): ?>
                    <li class="building-item">
                        <?php if (!empty($slide['slide_image']['url'])): ?>
                            <img 
                                src="<?php echo esc_url($slide['slide_image']['url']); ?>" 
                                alt="<?php echo esc_attr($slide['image_alt']); ?>" 
                                class="slider-image"
                            />
                        <?php endif; ?>

                        <div class="slider-content">
                            <?php
                            $fixed_titles = ['Building', 'Address', 'Developer', 'Units', 'Completed'];
                            foreach ($fixed_titles as $title):
                                $key = strtolower($title) . '_text';
                                if (!empty($slide[$key])): ?>
                                    <div class="slider-text-block">
                                        <strong><?php echo esc_html__($title, 'elementor-addon'); ?>:</strong> 
                                        <?php echo esc_html($slide[$key]); ?>
                                    </div>
                                <?php endif;
                            endforeach;
                            ?>

                            <?php if (!empty($slide['button_text']) && !empty($slide['button_url']['url'])): ?>
                                <div class="slider-button">
                                    <a href="<?php echo esc_url($slide['button_url']['url']); ?>" class="btn">
                                        <?php echo esc_html($slide['button_text']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    }
}
?>
