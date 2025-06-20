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
            'address',
            [
                'label' => esc_html__('Address', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '200 Bond St E, Oshawa',
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Oshawa, one of Canada’s fastest-growing cities, lies within the lands covered by the Williams Treaties and continues to be home to diverse Indigenous communities.',
            ]
        );

        $this->add_control(
            'cities',
            [
                'label' => esc_html__('Cities', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ city }}}',
                'default' => [
                    [
                        'city' => 'Oshawa',
                        'address' => '200 Bond St E, Oshawa',
                        'description' => 'Oshawa, one of Canada’s fastest-growing cities, lies within the lands covered by the Williams Treaties and continues to be home to diverse Indigenous communities.',
                    ],
                    [
                        'city' => 'Peterborough',
                        'address' => '200 Bond St E, Oshawa',
                        'description' => 'Peterborough is located on Treaty 20 territory, home to a rich Indigenous history and culture.Peterborough is located on Treaty 20 territory, home to a rich Indigenous history and culture.',
                    ],
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $cities_to_display = $settings['cities'];
?>
        <style>
            .show-case-section {
                width: 100%;
                padding: 100px 25px;
                background: #FFFFFF;
            }

            .show-case-section .section-heading {
                text-align: center;
                margin: 0 auto 70px auto;
                max-width: 600px;
            }

            .show-case-section .section-heading .customTitle {
                font-family: "Playfair Display", serif;
                font-weight: 600;
                font-size: 3rem;
                line-height: 1.2;
                margin: 0 0 1rem 0;
            }

            .show-case-section .section-heading .customSubtitle {
                font-family: "Inter Tight", sans-serif;
                color: #6B7280;
                line-height: 1.6;
                font-size: 1rem;
                margin: 0;
            }

            .city-columns {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 2rem 4rem;
                max-width: 1200px;
                margin: 0 auto;
            }

            .city-block {
                flex: 1;
                min-width: 300px;
                max-width: 450px;
                text-align: left;
                display: flex;
                flex-direction: column;
                gap: 25px;
            }

            .city-block h4 {
                font-family: "Playfair Display", serif;
                font-size: 2.25rem;
                font-weight: 600;
                margin: 0;
            }

            .city-address {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                font-family: "Inter Tight", sans-serif;
                font-weight: 500;
                color: #374151;
                margin: 0;
            }

            .city-block .city-address .address-text {
                font-family: "Playfair Display", serif;
                font-weight: 500;
                font-size: 22px;
                line-height: 120%;
                vertical-align: middle;
            }

            .city-address .address-icon svg {
                width: 24px;
                height: 24px;
                flex-shrink: 0;
            }

            .city-block .city-description {
                font-family: "Inter Tight", sans-serif;
                color: #6B7280;
                line-height: 1.7;
                margin: 0;
            }

            @media (max-width: 767px) {
                .city-columns {
                    flex-direction: column;
                    align-items: center;
                    gap: 3rem;
                }

                .show-case-section .section-heading {
                    margin: 0 auto 50px auto;
                }

                .city-block {
                    flex: 1;
                    min-width: 300px;
                    max-width: 450px;
                    text-align: left;
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                }

                .show-case-section {
                    width: 100%;
                    padding: 60px 25px;
                    background: #FFFFFF;
                }

                .city-block {
                    text-align: center;
                }

                .city-address {
                    justify-content: center;
                }
            }
        </style>

        <div class="show-case-section">
            <div class="section-heading">
                <?php if (!empty($settings['main_title'])) : ?>
                    <h1 class="customTitle"><?php echo esc_html($settings['main_title']); ?></h1>
                <?php endif; ?>

                <?php if (!empty($settings['subtitle'])) : ?>
                    <p class="customSubtitle"><?php echo esc_html($settings['subtitle']); ?></p>
                <?php endif; ?>
            </div>

            <?php if (!empty($cities_to_display)) : ?>
                <div class="city-columns">
                    <?php foreach ($cities_to_display as $city): ?>
                        <div class="city-block elementor-repeater-item-<?= esc_attr($city['_id']); ?>">

                            <?php if (!empty($city['city'])) : ?>
                                <h4><?php echo esc_html($city['city']); ?></h4>
                            <?php endif; ?>

                            <?php if (!empty($city['address'])) : ?>
                                <div class="city-address">
                                    <span class="address-icon">
                                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_1396_6488)">
                                                <path d="M21.5 9.99316C21.5 16.9932 12.5 22.9932 12.5 22.9932C12.5 22.9932 3.5 16.9932 3.5 9.99316C3.5 7.60622 4.44821 5.31703 6.13604 3.6292C7.82387 1.94138 10.1131 0.993164 12.5 0.993164C14.8869 0.993164 17.1761 1.94138 18.864 3.6292C20.5518 5.31703 21.5 7.60622 21.5 9.99316Z" stroke="#093D5F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M12.5 12.9932C14.1569 12.9932 15.5 11.65 15.5 9.99316C15.5 8.33631 14.1569 6.99316 12.5 6.99316C10.8431 6.99316 9.5 8.33631 9.5 9.99316C9.5 11.65 10.8431 12.9932 12.5 12.9932Z" stroke="#093D5F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_1396_6488">
                                                    <rect width="24" height="24" fill="white" transform="translate(0.5 -0.00683594)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </span>
                                    <span class="address-text"><?php echo esc_html($city['address']); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($city['description'])) : ?>
                                <p class="city-description"><?php echo esc_html($city['description']); ?></p>
                            <?php endif; ?>

                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
<?php
    }
}
