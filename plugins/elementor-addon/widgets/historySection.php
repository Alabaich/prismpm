<?php
class Elementor_historySection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'historySection';
    }

    public function get_title()
    {
        return esc_html__('Our Rich History', 'elementor-addon');
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
                'default' => 'Our Rich History',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Explore the key moments that shaped our city\'s evolution from settlement to modern urban center.',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'year',
            [
                'label' => esc_html__('Year', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '1800s',
            ]
        );

        $repeater->add_control(
            'event_title',
            [
                'label' => esc_html__('Event Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Early Settlement',
            ]
        );

        $repeater->add_control(
            'event_description',
            [
                'label' => esc_html__('Event Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'The area was initially settled by United Empire Loyalists. The Harbour Road was constructed, establishing Oshawa as a port community.',
            ]
        );

        $this->add_control(
            'timeline',
            [
                'label' => esc_html__('Timeline', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'year' => '1800s',
                        'event_title' => 'Early Settlement',
                        'event_description' => 'The area was initially settled by United Empire Loyalists. The Harbour Road was constructed, establishing Oshawa as a port community.',
                    ],
                    [
                        'year' => '1850',
                        'event_title' => 'Early Settlement',
                        'event_description' => 'The area was initially settled by United Empire Loyalists. The Harbour Road was constructed, establishing Oshawa as a port community.',
                    ],
                    [
                        'year' => '1879',
                        'event_title' => 'Early Settlement',
                        'event_description' => 'The area was initially settled by United Empire Loyalists. The Harbour Road was constructed, establishing Oshawa as a port community.',
                    ],
                    [
                        'year' => '1924',
                        'event_title' => 'Early Settlement',
                        'event_description' => 'The area was initially settled by United Empire Loyalists. The Harbour Road was constructed, establishing Oshawa as a port community.',
                    ],
                ],
                'title_field' => '{{{ year }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <section class="rich-history-section pageWidth">
            <div class="rich-history__container">
                <h2 class="rich-history__title"><?php echo esc_html($settings['main_title']); ?></h2>
                <p class="rich-history__description"><?php echo esc_html($settings['description']); ?></p>
                <div class="rich-history__timeline">
                    <?php foreach ($settings['timeline'] as $index => $item) : ?>
                        <div class="rich-history__timeline-item <?php echo ($index % 2 == 0) ? 'year-left' : 'year-right'; ?>">
                            <div class="rich-history__dot"></div>
                            <div class="rich-history__year"><?php echo esc_html($item['year']); ?></div>
                            <div class="rich-history__event">
                                <h3 class="rich-history__event-title"><?php echo esc_html($item['event_title']); ?></h3>
                                <p class="rich-history__event-description"><?php echo esc_html($item['event_description']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="rich-history__line"></div>
                </div>
            </div>
        </section>

        <style>
            .pageWidth {
                width: 100%;
                padding: 25px 10%;
            }

            @media screen and (max-width: 1600px) {
                .pageWidth {
                    width: 100%;
                    padding: 25px;
                }
            }

            @media screen and (max-width: 768px) {
                .pageWidth {
                    width: 100%;
                    padding: 15px;
                }
            }

            .rich-history-section {
                text-align: center;
                position: relative;
            }

            .rich-history__container {
                position: relative;
                padding:0 100px;
            }

            .rich-history__title {
                margin-bottom: 1.5rem;
                color: #2A2A2A;
                margin:0;
                padding-bottom:1.25rem;
            }

            .rich-history__description {
                margin:0;
                color: #6B7280;
                max-width: 600px;
                margin-left: auto;
                margin-right: auto;
                padding-bottom:4.25rem;
            }

            .rich-history__timeline {
                position: relative;
                display: flex;
                flex-direction: column;
                align-items: center;
                min-height: 600px;
                width: 100%;
            }

            .rich-history__timeline-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 100%;
                margin-bottom: 80px;
                position: relative;
            }

            .rich-history__timeline-item.year-left .rich-history__year {
                order: 1;
                margin-left: auto;
            }

            .rich-history__timeline-item.year-left .rich-history__event {
                order: 2;
                margin-left: auto;
            }

            .rich-history__timeline-item.year-right .rich-history__year {
                order: 2;
                margin-right: auto;
            }

            .rich-history__timeline-item.year-right .rich-history__event {
                order: 1;
                margin-right: auto;
            }

            .rich-history__year {
                font-size: 52px;
                color:rgb(118, 131, 158);
                font-weight: 400;
                font-family: "Darker Grotesque", sans-serif;
                flex: 0 0 auto;
            }

            .rich-history__event {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                max-width: 400px;
            }

            .rich-history__event-title {
                margin: 0 0 1.125rem;
                color: #2A2A2A;
                font-weight: bold;
                word-wrap: break-word;
            }

            .rich-history__event-description {
                margin: 0;
                color: #6B7280;
                word-wrap: break-word;
            }

            .rich-history__dot {
                width: 20px;
                height: 20px;
                background-color: #093D5F;
                border-radius: 50%;
                position: absolute;
                left: 50%;
                transform: translateX(-50%);
                z-index: 1;
            }

            .rich-history__line {
                position: absolute;
                top: 0;
                bottom: 0;
                left: 50%;
                width: 2px;
                background-color: #E0E0E0;
                transform: translateX(-50%);
                z-index: 0;
            }

            @media screen and (max-width: 768px) {
                .pageWidth {
                    padding: 15px;
                }

                .rich-history-section {
                    padding: 20px 0;
                }

                .rich-history__timeline-item {
                    flex-direction: column;
                    align-items: flex-start;
                    justify-content: flex-start;
                    margin-bottom: 40px;
                }

                .rich-history__timeline-item .rich-history__year {
                    margin-right: 0;
                    margin-bottom: 10px;
                }

                .rich-history__timeline-item .rich-history__event {
                    margin-left: 0;
                    margin-right: 0;
                    align-items: flex-start;
                    text-align: left;
                }

                .rich-history__event-description {
                    max-width: 100%;
                }

                .rich-history__dot {
                    left: 0;
                    transform: translateX(0);
                    top: 0;
                    transform: translateY(-50%);
                }

                .rich-history__line {
                    left: 5px;
                    width: 1px;
                    top: 10px;
                    bottom: 10px;
                }
            }
        </style>
<?php
    }
}