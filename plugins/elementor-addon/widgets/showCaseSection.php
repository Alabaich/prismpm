<?php

class Elementor_showCaseSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'showCaseSection';
    }

    public function get_title()
    {
        return esc_html__('Show Case', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-editor-align-center';
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

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $cities = array_slice($settings['cities'], 0, 2);
?>
        <style>
            .land-acknowledgement-section-wrapper {
                margin: 5rem 5rem;
            }

            .land-acknowledgement-section {
                width: 100%;
                padding: 1rem 1rem;
                background: #093D5F0D;
            }

            .land-acknowledgement-section .section-heading {
                text-align: center;
                margin-bottom: 50px;
                max-width: 488px;
                margin: auto;
            }

            .land-acknowledgement-section .section-heading h2 {
                font-weight: 600;
                font-size: 52px;
                line-height: 1.1;
                letter-spacing: 0em;
                text-transform: capitalize;
                margin: 0 0 0.75rem 0;
                font-family: "Playfair Display", serif;
            }

            .land-acknowledgement-section .section-heading p {
                color: #6B7280;
                font-size: 1rem;
                margin: 0 auto 3rem;
                line-height: 1.6;
            }

            .city-columns {
                display: flex;
                flex-wrap: nowrap;
                justify-content: space-between;
                gap: 35px;
            }

            .city-block {
                display: flex;
                flex-direction: row;
                width: calc(50% - 17.5px);
                border-radius: 0.5rem;
                overflow: hidden;
                align-items: flex-start;
                gap: 1.5rem;
            }

            .city-block img {
                width: 377px;
                height: 426px;
                object-fit: fit-content;
                border-radius: 0.5rem 0 0 0.5rem;
            }

            .city-block-text {
                width: 55%;
                padding-top: 1rem;
                padding-bottom: 1rem;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                height: 100%;
            }

            .city-block-text h4 {
                margin-bottom: 1rem;
                color: #111827;
                font-size: 30px;
                margin: 0px;
            }

            .city-block-text p {
                font-family: "Inter Tight", sans-serif;
                font-weight: 400;
                font-size: 1rem;
                letter-spacing: -0.01em;
                color: #52525B;
                margin: 0px;
                padding-right: 10px;
            }

            @media (max-width: 768px) {
                .land-acknowledgement-section-wrapper {
                    margin: 5rem 5%;
                }

                .city-columns {
                    flex-direction: column;
                    align-items: center;
                    gap: 2rem;
                }

                .land-acknowledgement-section {
                    padding: 5rem 1rem;
                    background: transparent;
                }

                .land-acknowledgement-section .section-heading h2 {
                    font-weight: 600;
                    font-size: 28px;
                    line-height: 90%;
                    letter-spacing: 0%;
                    text-align: center;
                    vertical-align: middle;
                    color: #2a2a2a;
                }

                .land-acknowledgement-section .section-heading p {
                    max-width: 100%;
                }

                .city-block {
                    width: 100%;
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                    gap: 1rem;
                    padding-top: 10px;
                }

                .city-block img {
                    height: 200px;
                    object-fit: cover;
                    border-radius: 0.5rem;
                }

                .city-block-text {
                    width: 100%;
                    padding: 1rem 0;
                    text-align: center;
                    display: flex;
                    flex-direction: column;
                    gap: 15px;
                }

                .city-block-text h4 {
                    font-size: 1.5rem;
                }

                .city-block-text p {
                    font-size: 1rem;
                }
            }
        </style>

        <div class="land-acknowledgement-section-wrapper">
            <div class="land-acknowledgement-section">
                <div class="section-heading">
                    <?php if (!empty($settings['main_title'])) : ?>
                        <h2><?php echo esc_html($settings['main_title']); ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($settings['subtitle'])) : ?>
                        <p class="subtitle interTight"><?php echo esc_html($settings['subtitle']); ?></p>
                    <?php endif; ?>
                </div>

                <div class="city-columns">
                    <?php foreach ($cities as $city): ?>
                        <div class="city-block">
                            <img src="<?php echo esc_url($city['image']['url']); ?>" alt="<?php echo esc_attr($city['city']); ?>">
                            <div class="city-block-text">
                                <h4><?php echo esc_html($city['city']); ?></h4>
                                <p><?php echo esc_html($city['description']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

<?php
    }
}
