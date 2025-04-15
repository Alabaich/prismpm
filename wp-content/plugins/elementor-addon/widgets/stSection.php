<?php

class Elementor_stSection extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'stSection';
    }

    public function get_title()
    {
        return esc_html__('stSection', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-text-align-left';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['hello', 'world', 'text', 'rich'];
    }

    protected function register_controls()
    {

        // Content Tab Start

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );

        $this->add_control(
            'textForButton',
            [
                'label' => esc_html__('Text For Button', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('Insert text for button', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'url',
            [
                'label' => esc_html__('Button URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label' => esc_html__('Alignment', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'elementor-addon'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'elementor-addon'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'elementor-addon'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );

        $this->end_controls_section();

        // Style Tab Start

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Style', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .richText h1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .richText p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Button Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .buttonWrapper .btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab End

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Determine alignment class
        $alignment_class = '';
        if (!empty($settings['alignment'])) {
            $alignment_class = 'align-' . esc_attr($settings['alignment']);
        }
?>

        <style>
            .richTextContainer {
                display: flex;
                flex-direction: column;
                justify-content: center;
                background: #093D5F;
                text-align: center;
                padding-bottom: 146px;
                padding-top: 146px;
            }

            .richText h2 {
                color: #FFFFFF;
                font-family: "Darker Grotesque", Sans-serif;
                font-size: 52px;
                font-weight: 600;
                max-width: 902px;
                line-height: 92%;
                margin: 0px;
            }
            .richText h4 {
                color: #E0E0E0;
                font-family: "Inter Tight", Sans-serif;
                font-size: 22px;
                font-weight: normal;
                margin: 0px;
                margin-bottom: 16px;
            }

            .richText p {
                color: #E0E0E0;
                font-family: "Inter Tight", Sans-serif;
                font-size: 18px;
                font-weight: 400;
                max-width: 614px;
                margin-bottom: 80px;
            }

            .richTextText {
                padding: 0% 10% 0% 10%;
            }

            .align-left {
                align-items: flex-start;
                text-align: left;
            }

            .align-center {
                align-items: center;
                text-align: center;
            }

            .align-right {
                align-items: flex-end;
                text-align: right;
            }

            .buttonWrapper .btn {
                padding: 10px 20px;
                text-decoration: none;
                color: #2A2A2A;
                background-color: #FFFFFF;
                display: inline-block;
                font-family: "Inter Tight", Sans-serif;
                font-size: 16px;
                font-weight: 500;
                transition: all 0.3s ease;
                border: 2px solid transparent;
                font-size: 16px;
                border-radius: 9999px;
            }

            /* .buttonWrapper .btn:hover {
                color: #093D5F;
                background-color: #fff;
                border-color: #093D5F;
            } */

            @media (max-width: 1200px) {
                .richText h1 {
                    font-size: 30px;
                }
                .richTextText {
                padding: 0;
            }
            }

            @media (max-width: 768px) {
                .richText h1 {
                    font-size: 30px;
                }
            }

            @media (max-width: 480px) {
                .richText h1 {
                    font-size: 30px;
                }

                .richText p {
                    font-size: 14px;
                    padding: 0;
                }
            }
        </style>

        <div class="richTextContainer <?php echo esc_attr($alignment_class); ?>">
            <?php if (!empty($settings['subtitle'])) : ?>
                <div class="richText">
                    <h4>
                        <?php echo esc_html($settings['subtitle']); ?>
                    </h4>
                </div>
            <?php endif; ?>

            <?php if (!empty($settings['title'])) : ?>
                <div class="richText">
                    <h2>
                        <?php echo esc_html($settings['title']); ?>
                    </h2>
                </div>
            <?php endif; ?>

            <?php if (!empty($settings['text'])) : ?>
                <div class="richText richTextText">
                    <p>
                        <?php echo wp_kses_post($settings['text']); ?>
                    </p>
                </div>
            <?php endif; ?>

            <?php if (!empty($settings['textForButton']) && !empty($settings['url'])) : ?>
                <div class="buttonWrapper">
                    <a href="<?php echo esc_url($settings['url']); ?>" class="btn">
                        <?php echo esc_html($settings['textForButton']); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>

<?php
    }
}
