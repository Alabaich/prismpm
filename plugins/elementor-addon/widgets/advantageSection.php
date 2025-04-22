<?php

class Elementor_AdvantageSection extends \Elementor\Widget_Base 
{

    public function get_name() {
        return 'advantageSection';
    }

    public function get_title() {
        return esc_html__('Why Choose Prism', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-info';
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
                'label' => esc_html__('Main Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Why Choose Prism: A Better Rental Experience Starts Here',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'At Prism Property Management, we go beyond just providing apartments — we create communities. Here’s what makes us stand out.',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-paw',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $repeater->add_control(
            'card_title',
            [
                'label' => esc_html__('Card Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Card Title',
            ]
        );

        $repeater->add_control(
            'card_text',
            [
                'label' => esc_html__('Card Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Card description goes here.',
            ]
        );

        $this->add_control(
            'cards',
            [
                'label' => esc_html__('Cards', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'icon' => ['value' => 'fas fa-paw', 'library' => 'fa-solid'],
                        'card_title' => 'Pet-Friendly Living',
                        'card_text' => 'Every property welcomes your furry friends. No extra hassle — just happy tails and purring companions.',
                    ],
                    [
                        'icon' => ['value' => 'fas fa-map-marker-alt', 'library' => 'fa-solid'],
                        'card_title' => 'Prime Urban Locations',
                        'card_text' => 'All our communities are in walkable, transit-connected downtown hubs like Oshawa and Peterborough.',
                    ],
                    [
                        'icon' => ['value' => 'fas fa-headset', 'library' => 'fa-solid'],
                        'card_title' => '24/7 Maintenance Support',
                        'card_text' => 'Day or night, we’re here for you. Our team responds quickly to ensure your home stays safe and comfortable.',
                    ],
                    [
                        'icon' => ['value' => 'fas fa-home', 'library' => 'fa-solid'],
                        'card_title' => 'Well-Maintained Properties',
                        'card_text' => 'From curb appeal to interior care, we prioritize the upkeep of every building to make living easy.',
                    ],
                    [
                        'icon' => ['value' => 'fas fa-envelope', 'library' => 'fa-solid'],
                        'card_title' => 'Professional On-Site Management',
                        'card_text' => 'Friendly, responsive, and always available to help — our team’s on the ground to keep things running smoothly.',
                    ],
                    [
                        'icon' => ['value' => 'fas fa-shield-alt', 'library' => 'fa-solid'],
                        'card_title' => 'Secure Entry & Peace of Mind',
                        'card_text' => 'Modern access systems, secure entry points, and attentive property oversight help ensure that you feel safe and confident in your home.',
                    ],
                ],
                'title_field' => '{{{ card_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="why-choose-prism-section">
            <div class="why-choose-prism__container">
                <div class="why-choose-prism__header">
                    <h2 class="why-choose-prism__title"><?php echo esc_html($settings['main_title']); ?></h2>
                    <p class="why-choose-prism__description"><?php echo esc_html($settings['description']); ?></p>
                </div>

                <?php if ( ! empty($settings['cards']) ) : ?>
                    <div class="why-choose-prism__grid">
                        <?php foreach ( $settings['cards'] as $card ) : ?>
                            <div class="why-choose-prism__card">
                                <?php if (!empty($card['icon']['value'])) : ?>
                                    <div class="why-choose-prism__icon">
                                        <?php \Elementor\Icons_Manager::render_icon($card['icon'], ['aria-hidden' => 'true']); ?>
                                    </div>
                                <?php endif; ?>
                                <h4 class="why-choose-prism__card-title"><?php echo esc_html($card['card_title']); ?></h4>
                                <p class="why-choose-prism__card-text"><?php echo esc_html($card['card_text']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <style>
    .why-choose-prism-section {
        padding: 3.125rem 0rem; /* 50px 20px */
        background-color: #fff;
        text-align: center;
    }

    .why-choose-prism__container {
    }

    .why-choose-prism__header {
        margin-bottom: 2.5rem; /* 40px */
        max-width: 48.75rem; /* 780px */
        margin: auto;
    }

    .why-choose-prism__title {
        font-size: 3.25rem; /* 52px */
        font-weight: 600;
        text-align: center;
        color: #2A2A2A;
        margin: 0 0 1.5rem; /* 24px */
        line-height: 1.3;
    }

    .why-choose-prism__description {
        font-size: 1rem; /* 16px */
        font-family: "Inter Tight", sans-serif;
        color: #52525B;
        margin: 0;
        max-width: 32.125rem; /* 514px */
        margin-left: auto;
        margin-right: auto;
        line-height: 1.5;
        padding-bottom: 3.125rem; /* 50px */
    }

    .why-choose-prism__grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.875rem; /* 30px */
    }

    .why-choose-prism__card {
        background-color: #fff;
        max-width: 31.875rem; /* 510px */
        padding: 2.5rem; /* 40px */
        border: 1px solid #e0e0e0;
        border-radius: 0.5rem; /* 8px */
        text-align: center;
    }

    .why-choose-prism__icon {
        font-size: 3rem; /* 48px */
        color: #000;
        margin-bottom: 0.9375rem; /* 15px */
    }

    .why-choose-prism__icon svg {
        width: 3rem; /* 48px */
        height: 3rem;
    }

    .why-choose-prism__card-title {
        font-size: 2rem; /* 32px */
        font-weight: 600;
        color: #2A2A2A;
        margin: 0 0 1.5rem; /* 24px */
    }

    .why-choose-prism__card-text {
        font-size: 1.125rem; /* 18px */
        font-family: "Inter Tight", sans-serif;
        color: #52525B;
        margin: 0;
        line-height: 1.4;
    }

    @media (max-width: 991px) {
        .why-choose-prism__grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem; /* 20px */
        }
    }

    @media (max-width: 576px) {
        .why-choose-prism__grid {
            grid-template-columns: 1fr;
            gap: 0.9375rem; /* 15px */
        }

        .why-choose-prism__title {
            font-size: 1.5rem; /* 24px */
        }

        .why-choose-prism__description {
            font-size: 0.875rem; /* 14px */
        }

        .why-choose-prism__icon {
            font-size: 2.25rem; /* 36px */
        }

        .why-choose-prism__icon svg {
            width: 2.25rem; /* 36px */
            height: 2.25rem;
        }

        .why-choose-prism__card-title {
            font-size: 1rem; /* 16px */
        }

        .why-choose-prism__card-text {
            font-size: 0.8125rem; /* 13px */
        }
    }
</style>

        <?php
    }
}