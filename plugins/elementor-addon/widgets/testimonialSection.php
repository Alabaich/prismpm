<?php

class Elementor_testimonialsSection extends \Elementor\Widget_Base
{
    public function get_name() {
        return 'testimonials_section';
    }

    public function get_title() {
        return esc_html__('Testimonials Section', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-comments';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Section Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Why Residents Love Living Here',
            ]
        );

        $this->add_control(
            'section_subtitle',
            [
                'label' => esc_html__('Section Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'testimonial_text',
            [
                'label' => esc_html__('Testimonial Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'This is a sample testimonial.',
            ]
        );

        $repeater->add_control(
            'author_name',
            [
                'label' => esc_html__('Author Name', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'John Doe',
            ]
        );

        $repeater->add_control(
            'author_location',
            [
                'label' => esc_html__('Location', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '80 Bond',
            ]
        );

        $repeater->add_control(
            'author_photo',
            [
                'label' => esc_html__('Photo', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__('Testimonials', 'elementor-addon'),
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
            .testimonial-section {
                background-color: #093D5F;
                color: #fff;
                text-align: center;
                padding: 100px 20px;
            }

            .testimonial-section h2 {
                font-size: 42px;
                font-weight: 600;
                margin-bottom: 12px;
            }

            .testimonial-section h4 {
                color: #E0E0E0;
                font-size: 20px;
                margin-bottom: 50px;
                margin-top: 0px;
            }

            .testimonial-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 30px;
                max-width: 1200px;
                margin: 0 auto;
            }

            .testimonial-card {
                background: #fff;
                color: #2a2a2a;
                border-radius: 12px;
                padding: 26px;
                text-align: left;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .testimonial-card p {
                font-size: 16px;
                margin-bottom: 20px;
                margin-top: 0px;
            }

            .testimonial-author {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .testimonial-author img {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                object-fit: cover;
            }

            .testimonial-author-info {
                display: flex;
                flex-direction: column;
            }

            .testimonial-author-info .name {
                font-size: 16px;
            }

            .testimonial-author-info .loc {
                font-size: 14px;
                color: #666;
            }
        </style>

        <div class="testimonial-section">
            <h2><?php echo esc_html($settings['section_title']); ?></h2>
            <h4><?php echo esc_html($settings['section_subtitle']); ?></h4>

            <div class="testimonial-grid">
                <?php foreach ($settings['testimonials'] as $testimonial): ?>
                    <div class="testimonial-card">
                        <p><?php echo esc_html($testimonial['testimonial_text']); ?></p>
                        <div class="testimonial-author">
                            <img src="<?php echo esc_url($testimonial['author_photo']['url']); ?>" alt="Author Photo" />
                            <div class="testimonial-author-info">
                                <span class = "name"><?php echo esc_html($testimonial['author_name']); ?></span>
                                <span class = "loc"><?php echo esc_html($testimonial['author_location']); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php
    }
}
