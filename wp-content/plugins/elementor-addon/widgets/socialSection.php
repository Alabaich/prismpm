<?php

class Elementor_socialSection extends \Elementor\Widget_Base {

public function get_name() {
    return 'socialSection';
}

public function get_title() {
    return esc_html__('Social Section', 'elementor-addon');
}

public function get_icon() {
    return 'eicon-social-icons';
}

public function get_categories() {
    return ['basic'];
}

protected function register_controls() {
    $this->start_controls_section(
        'content_section',
        [
            'label' => esc_html__('Content', 'elementor-addon'),
        ]
    );

    $this->add_control(
        'main_title',
        [
            'label' => esc_html__('Main Title', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Follow Us On Social Media',
        ]
    );

    $this->add_control(
        'subtitle',
        [
            'label' => esc_html__('Subtitle', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
        ]
    );

    $repeater = new \Elementor\Repeater();

    $repeater->add_control(
        'label',
        [
            'label' => esc_html__('Label', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'George Street Lofts:',
        ]
    );

    $repeater->add_control(
        'facebook',
        [
            'label' => esc_html__('Facebook Handle', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '@georgestreetlofts',
        ]
    );

    $repeater->add_control(
        'instagram',
        [
            'label' => esc_html__('Instagram Handle', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '@georgestreetlofts',
        ]
    );

    $repeater->add_control(
        'icon_set',
        [
            'label' => esc_html__('Icon Set (optional)', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '',
        ]
    );

    $this->add_control(
        'socials',
        [
            'label' => esc_html__('Social Blocks', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [],
        ]
    );

    $this->add_control(
        'bottom_image',
        [
            'label' => esc_html__('Bottom Image', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::MEDIA,
        ]
    );

    $this->end_controls_section();
}

protected function render() {
    $settings = $this->get_settings_for_display();
    ?>

    <style>
        .social-follow-section {
            padding: 4rem 0.2rem;
            text-align: center;
        }

        .social-follow-section h1 {
            margin-bottom: 0.5rem;
        }

        .social-follow-section .subtitle {
            color: #52525B;
            margin-bottom: 2rem;
        }

        .social-follow-rows {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .social-block {
            min-width: 180px;
            text-align: left;
            color:#52525B
        }

        .social-block p {
            color:black;
            margin: 0.25rem 0;
            display: flex;
            align-items: center;
            font-size: 1.375rem;
            gap: 0.5rem;
        }

        .social-block i {
            font-size: 1.2rem;
        }

        .bottom-social-image img {
            width: 100%;
            border-radius: 0.2rem;
            margin: 0 auto;
        }
    </style>

    <div class="social-follow-section">
        <h1><?php echo esc_html($settings['main_title']); ?></h1>
        <p class="subtitle interTight"><?php echo esc_html($settings['subtitle']); ?></p>

        <div class="social-follow-rows">
            <?php foreach ($settings['socials'] as $social): ?>
                <div class="social-block">
                    <span><?php echo esc_html($social['label']); ?></span>
                    <p><i class="fab fa-facebook"></i> George street Lofts</p>
                    <p><i class="fab fa-instagram"></i> <?php echo esc_html($social['instagram']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (!empty($settings['bottom_image']['url'])): ?>
            <div class="bottom-social-image">
                <img src="<?php echo esc_url($settings['bottom_image']['url']); ?>" alt="Social Media Image">
            </div>
        <?php endif; ?>
    </div>

    <?php
}
}
