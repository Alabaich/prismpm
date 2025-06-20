<?php

class Elementor_richTextWithBackground extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'richTextWithBackground';
    }

    public function get_title()
    {
        return esc_html__('Rich Text', 'elementor-addon');
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

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'background_none',
            [
                'label' => esc_html__('No Background', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'Yes',
                'label_off' => 'No',
                'return_value' => 'yes',
                'default' => 'no',
                'description' => esc_html__('If enabled, no background color or image will be applied.', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'is_first_page',
            [
                'label' => esc_html__('Is First Page?', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'Yes',
                'label_off' => 'No',
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'background_image',
            [
                'label' => esc_html__('Background Image (for first page)', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
                'condition' => [
                    'is_first_page' => 'yes',
                ],
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
            'uppertitle',
            [
                'label' => esc_html__('Upper Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
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

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Style', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_overlay_color',
            [
                'label' => esc_html__('Background Image Overlay Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'condition' => [
                    'is_first_page' => 'yes',
                    'background_none!' => 'yes',
                    'background_image[url]!' => '',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .richText h2' => 'color: {{VALUE}};',
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
            'button_background_color',
            [
                'label' => esc_html__('Button Background Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .buttonWrapper .btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Button Text Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .buttonWrapper .btn' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .buttonWrapper .btn svg' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => esc_html__('Button Border Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .buttonWrapper .btn' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label' => esc_html__('Button Hover Background Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .buttonWrapper .btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => esc_html__('Button Hover Text Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .buttonWrapper .btn:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .buttonWrapper .btn:hover svg' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Button Hover Border Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .buttonWrapper .btn:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $is_first_page = $settings['is_first_page'] === 'yes';
        $background_image_url = $settings['background_image']['url'] ?? '';
        $use_no_background = $settings['background_none'] === 'yes';
        $image_overlay_color_value = $settings['image_overlay_color'] ?? '';

        $has_background_image = $is_first_page && !empty($background_image_url) && !$use_no_background;
        $inline_style = '';

        if ($use_no_background) {
            $inline_style = 'background: none;';
        } elseif ($has_background_image) {
            $image_url_escaped = esc_url($background_image_url);
            if (!empty($image_overlay_color_value)) {
                $gradient = "linear-gradient(" . esc_attr($image_overlay_color_value) . ", " . esc_attr($image_overlay_color_value) . ")";
                $inline_style = "background-image: " . $gradient . ", url('" . $image_url_escaped . "'); height: 80vh; background-size: cover; background-position: center;";
            } else {
                $inline_style = "background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('" . $image_url_escaped . "'); height: 80vh; background-size: cover; background-position: center;";
            }
        } else {
            $inline_style = "background-color: #093D5F;";
            if ($is_first_page && !$use_no_background) {
                $inline_style .= " height: 100vh;";
            }
        }

        $alignment_class = '';
        if ($is_first_page && (empty($background_image_url) || $use_no_background)) {
            $alignment_class = 'centered';
        }
        if (!empty($settings['alignment'])) {
            $alignment_class = 'align-' . esc_attr($settings['alignment']);
        }

?>

        <style>
            .richTextContainer {
                <?php if ($is_first_page): ?>padding-bottom: 140px;
                padding-top: 140px;
                <?php endif; ?>
            }

            .richTextContainer .richText h2 {
                <?php if ($is_first_page): ?>font-size: 72px;
                <?php endif; ?>
            }

            .richTextContainer .richText h2 {
                <?php if ($use_no_background): ?>color: #2A2A2A;
                <?php endif; ?>
            }

            .richTextContainer .richText p {
                <?php if ($use_no_background): ?>color: #52525B;
                <?php endif; ?>
            }

            .richTextContainer .richText p {
                <?php if ($is_first_page): ?>padding-bottom: 40px;
                max-width: 464px;
                <?php endif; ?>
            }

            .richTextContainer {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                background: #093D5F;
                text-align: center;
                padding-bottom: 140px;
                padding-top: 140px;
            }

            .richText h2 {
                color: #FFFFFF;
                font-family: "Playfair Display", serif;
                max-width: 902px;
                font-size: 52px;
                line-height: 96%;
                margin: 0px;
            }

            <?php if (empty($settings['text'])): ?>.richText h2 {
                margin-bottom: 60px;
            }

            <?php endif; ?>.richText h4 {
                color: #E0E0E0;
                font-family: "Inter Tight", Sans-serif;
                font-size: 1rem;
                font-weight: normal;
                margin: 0px;
                margin-bottom: 16px;
            }

            .richText p {
                color: #E0E0E0;
                font-family: "Inter Tight", Sans-serif;
                font-size: 1rem;
                font-weight: 400;
                max-width: 614px;
                margin: 0;
                padding-top: 1.5rem;
                padding-bottom: 70px;
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
                display: inline-flex;
                align-items: center;
                gap: 0.75rem;
                border-radius: 9999px;
                padding: 1rem 2rem;
                font-size: 1.125rem;
                font-weight: 500;
                text-decoration: none;
                font-family: "Inter Tight", Sans-serif;
                border: 2px solid;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .buttonWrapper .btn:hover {
                gap: 2rem;
            }

            .buttonWrapper .btn svg {
                transition: all 0.3s ease;
                rotate: -45deg;
                width: 24px;
                height: 24px;
            }

            @media (max-width: 1200px) {
                .richText h1 {
                    font-size: 30px;
                }

                .richTextText {
                    padding: 0;
                }
            }

            @media (max-width: 768px) {
                .richTextContainer .richText h2 {
                    <?php if ($is_first_page): ?>font-size: 28px;
                    <?php endif; ?>
                }

                .richTextContainer {
                    <?php if ($is_first_page): ?>padding-bottom: 0px;
                    padding-top: 0px;
                    <?php endif; ?>
                }

                .richTextContainer {
                    padding-bottom: 50px;
                    padding-top: 100px;
                    padding-left: 20px;
                    padding-right: 20px;
                }

                .richTextContainer .richText h2 {
                    font-family: Playfair Display;
                    font-weight: 600;
                    font-size: 32px;
                    line-height: 90%;
                    letter-spacing: 0%;
                    text-align: center;
                    vertical-align: middle;
                    text-transform: capitalize;
                }

                .richTextContainer.richTextContainer-first-page-mobile {
                    height: 40vh !important;
                }

                .richTextContainer {
                    padding-top: 60px !important;
                    padding-bottom: 60px !important;
                }

                .richText h2 {
                    margin-bottom: 40px;
                }

                .richText h1 {
                    font-size: 30px;
                }

                .richText p {
                    font-size: 14px;
                    padding-top: 1rem;
                    padding-bottom: 2rem;
                }
            }
        </style>

        <div class="richTextContainer <?php echo esc_attr($alignment_class); ?>" style="<?php echo esc_attr($inline_style); ?>">
            <?php if (!empty($settings['uppertitle'])) : ?>
                <div class="richText">
                    <h4>
                        <?php echo esc_html($settings['uppertitle']); ?>
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
                <div class="richText">
                    <p class='QWkdj'>
                        <?php echo esc_html($settings['text']); ?>
                    </p>
                </div>
            <?php endif; ?>

            <?php if (!empty($settings['textForButton']) && !empty($settings['url'])) : ?>
                <div class="buttonWrapper">
                    <a href="<?php echo esc_url($settings['url']); ?>" class="btn">
                        <?php echo esc_html($settings['textForButton']); ?>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
            <?php endif; ?>
        </div>

<?php
    }
}
