<?php
class Elementor_discoverSection extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'discoverSection';
    }

    public function get_title()
    {
        return esc_html__('Discover Peterborough', 'elementor-addon');
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
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Discover Peterborough',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Nestled on the shores of Lake Ontario, Ottawa combines rich industrial heritage with modern innovation and natural beauty.',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-users',
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
                        'icon' => ['value' => 'fas fa-users', 'library' => 'fa-solid'],
                        'card_title' => 'Thriving Community',
                        'card_text' => 'Experience the warmth of a diverse, welcoming community that takes pride in its city and neighbors.',
                    ],
                    [
                        'icon' => ['value' => 'fas fa-landmark', 'library' => 'fa-solid'],
                        'card_title' => 'Rich Heritage',
                        'card_text' => 'Explore Oshawa\'s fascinating history from Indigenous settlements to innovative manufacturing powerhouses.',
                    ],
                    [
                        'icon' => ['value' => 'fas fa-leaf', 'library' => 'fa-solid'],
                        'card_title' => 'Natural Beauty',
                        'card_text' => 'Discover stunning parks, conservation areas, and the scenic Lake Ontario waterfront.',
                    ],
                    [
                        'icon' => ['value' => 'fas fa-building', 'library' => 'fa-solid'],
                        'card_title' => 'Economic Hub',
                        'card_text' => 'Witness the transformation from automotive center to a diverse economy with education, healthcare, and technology.',
                    ],
                ],
                'title_field' => '{{{ card_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <section class="discover-peterborough-section pageWidth">
            <div class="">
                <div class="discover-peterborough__header">
                    <h2 class="discover-peterborough__title"><?php echo esc_html($settings['main_title']); ?></h2>
                    <p class="discover-peterborough__description"><?php echo esc_html($settings['description']); ?></p>
                </div>

                <?php if (! empty($settings['cards'])) : ?>
                    <div class="discover-peterborough__grid">
                        <?php foreach ($settings['cards'] as $card) : ?>
                            <div class="discover-peterborough__card">
                                <?php if (!empty($card['icon']['value'])) : ?>
                                    <div class="discover-peterborough__icon">
                                        <?php \Elementor\Icons_Manager::render_icon($card['icon'], ['aria-hidden' => 'true']); ?>
                                    </div>
                                <?php endif; ?>
                                <h4 class="discover-peterborough__card-title"><?php echo esc_html($card['card_title']); ?></h4>
                                <p class="discover-peterborough__card-text"><?php echo esc_html($card['card_text']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <style>
                        .pageWidth{
    width: 100%;
    padding: 25px 10%;
}
@media screen and (max-width: 1600px) {
 .pageWidth{
  width: 100%;
  padding: 25px;
}
}
@media screen and (max-width: 768px) {
 .pageWidth{
  width: 100%;
  padding: 15px;
}
}
            .discover-peterborough-section {
                background-color: #fff;
                text-align: center;
            }

            .discover-peterborough__container {}

            .discover-peterborough__header {
                margin-bottom: 2.5rem;
                max-width: 48.75rem;
                margin: auto;
            }

            .discover-peterborough__title {
                text-align: center;
                color: #2A2A2A;
                margin: 0 0 1.5rem;
                line-height: 1.3;
                font-family: "Playfair Display", sans-serif;
            }

            .discover-peterborough__description {
                font-size: 1rem;
                font-family: "Inter Tight", sans-serif;
                color: #52525B;
                margin: 0;
                max-width: 32.125rem;
                margin-left: auto;
                margin-right: auto;
                line-height: 1.5;
                padding-bottom: 3.125rem;
            }

            .discover-peterborough__grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 1rem;
            }

            .discover-peterborough__card {
                background-color: #F5F7FA;
                padding: 2.5rem;
                border: 1px solid #e0e0e0;
                text-align: center;
            }

            .discover-peterborough__icon {
                font-size: 3rem;
                color: #2A6EBB;
                margin-bottom: 0.9375rem;
            }

            .discover-peterborough__icon svg {
                fill: #093D5F;
                width: 3rem;
                height: 3rem;
            }

            .discover-peterborough__card-title {
                color: #2A2A2A;
                margin: 0 0 1.25rem;
                font-family: "Darker Grotesque", sans-serif;
            }

            .discover-peterborough__card-text {
                color: #52525B;
                margin: 0;
                line-height: 1.4;
            }

            @media (max-width: 991px) {
                .discover-peterborough__grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 1.25rem;
                }
            }

            @media (max-width: 576px) {
                .discover-peterborough__grid {
                    grid-template-columns: 1fr;
                    gap: 0.9375rem;
                }

                .discover-peterborough__title {
                    font-size: 1.5rem;
                }

                .discover-peterborough__description {
                    font-size: 0.875rem;
                }

                .discover-peterborough__icon {
                    font-size: 2rem;
                }

                .discover-peterborough__icon svg {
                    width: 2.25rem;
                    height: 2.25rem;
                }

                .discover-peterborough__card-title {
                    font-size: 1rem;
                }

                .discover-peterborough__card-text {
                    font-size: 0.8125rem;
                }
            }
        </style>

<?php
    }
}