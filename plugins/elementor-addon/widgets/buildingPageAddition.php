<?php

class Elementor_buildingPageAddition extends \Elementor\Widget_Base {

public function get_name() {
    return 'buildingPageAddition';
}

public function get_title() {
    return esc_html__('Building Addition Block', 'elementor-addon');
}

public function get_icon() {
    return 'eicon-posts-ticker';
}

public function get_categories() {
    return ['basic'];
}

protected function register_controls() {

    $this->start_controls_section('content_section', [
        'label' => esc_html__('Content', 'elementor-addon'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]);

    $this->add_control('main_title_image', [
        'label' => esc_html__('Main Title Image', 'elementor-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
        'default' => [
            'url' => \Elementor\Utils::get_placeholder_image_src(),
        ],
    ]);

    $this->add_control('about_title', [
        'label' => esc_html__('About Title', 'elementor-addon'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'default' => 'About George Street Lofts',
    ]);

    $this->add_control('about_text', [
        'label' => esc_html__('About Text', 'elementor-addon'),
        'type' => \Elementor\Controls_Manager::TEXTAREA,
        'default' => 'George Street Lofts is a beautifully restored, three-story building originally constructed in 1879 in the French Second Empire style.',
    ]);

    $this->add_control('image', [
        'label' => esc_html__('Image', 'elementor-addon'),
        'type' => \Elementor\Controls_Manager::MEDIA,
    ]);

    $this->add_control('features_list', [
        'label' => esc_html__('Features', 'elementor-addon'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => [
            [
                'name' => 'feature',
                'label' => esc_html__('Feature', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Sample feature',
            ],
        ],
    ]);

    $this->end_controls_section();
}

protected function render() {
    $settings = $this->get_settings_for_display();
    ?>

    <div class="aboutPropertyBlock">
        <?php if (!empty($settings['main_title_image']['url'])) : ?>
            <div class="logoImgDiv">
                <img src="<?php echo esc_url($settings['main_title_image']['url']); ?>" alt="Main Title Image" >
            </div>
        <?php endif; ?>
        <div class="aboutPropertyFlex">
            <div class="aboutText">
                <div class="aboutTextDiv">
                    <h3><?php echo esc_html($settings['about_title']); ?></h3>
                    <p class="wqhjashfjka"><?php echo esc_html($settings['about_text']); ?></p>
                </div>
                <ul class="featureList">
                    <?php foreach ($settings['features_list'] as $item) : ?>
                        <li><?php echo esc_html($item['feature']); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="aboutImage">
                <?php if (!empty($settings['image']['url'])) : ?>
                    <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="Property Image">
                <?php endif; ?>
            </div>
        </div>
    </div>

    <style>
        .logoImgDiv {
            max-width:140px;
            min-width:140px;
            margin:auto;
            margin-bottom:2rem;
        }
        .logoImgDiv img{
            width: 100%;
            object-fit:cover;
        }
        .aboutPropertyBlock {
            display:flex;
            flex-direction:column;
            padding: 4rem 0rem;
            font-family: "Inter Tight", sans-serif;
        }

        .aboutPropertyBlock h2 {
            font-size: 52px;
            color:black;
            text-align: center;
            width:fit-content;
            max-width:784px;
            margin:auto;
            margin-bottom: 2rem;
        }

        .aboutPropertyFlex {
            display: flex;
            flex-wrap: wrap;
            justify-content:space-between;
            gap: 2rem;
            align-items: stretch;
        }

        .aboutText {
            flex: 1 1 36%;
            height:auto;
            display:flex;
            flex-direction:column;
            justify-content:space-between;
        }

        .aboutTextDiv {
            display:flex;
            flex-direction:column;
        }

        .aboutText h3 {
            font-size: 32px;
            margin-bottom: 1.5rem;
            color:black;
            margin-top:0;
        }

        .aboutTextDiv p {
            font-family: "Inter Tight", sans-serif;
            font-size: 18px;
            color: #52525B;
            max-width:514px;
            line-height:140%;
        }

        .featureList {
            display:flex;
            flex-direction:column;
            gap:1.5rem 0rem;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .featureList li {
            position: relative;
            padding-left: 2rem;
            font-weight:400;
            font-size: 18px;
        }

        .featureList li::before {
            content: "✔";
            position: absolute;
            left: 0;
            top: 0;
            color: #000;
        }

.wqhjashfjka{
    margin:0;
    font-size:16px;
}
            .aboutImage {
                flex: 1 1 50%;
            }

        .aboutImage img {
            width: 100%;
            max-height:500px;
            border-radius: 0.5rem;
            object-fit: cover;
        }

        @media (max-width: 768px) {
                    .aboutPropertyBlock {
            padding: 2rem 0rem;
        }
                .logoImgDiv {
            max-width:80px;
            min-width:80px;
            margin-bottom:1rem;
        }
                    .aboutImage img {
        }
            .aboutPropertyFlex {
                flex-direction: column;
            }

            .aboutText, .aboutImage {
                flex: 1 1 100%;
            }
        .aboutPropertyBlock h2 {
            font-size:24px;
            margin-bottom:0.5rem;
        }
        .aboutText h3 {
            display:none;
        }
        .wqhjashfjka{
            text-align:center;
        }
        .featureList li {
            font-size:1rem;
            font-weight:500;
        }
                .aboutTextDiv p {
            font-size: 16px;
            color: #52525B;
            max-width:314px;
        }
        .aboutTextDiv {
            margin:0 auto;
        }
        }
    </style>

    <?php
}
}