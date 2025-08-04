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

        $this->add_control(
            'mobile_height',
            [
                'label' => esc_html__('Mobile Height (vh)', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['vh'],
                'range' => [
                    'vh' => [
                        'min' => 20,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'vh',
                    'size' => 40,
                ],
                'selectors' => [
                    '(mobile){{WRAPPER}} .richTextContainer.is-first-page-mobile' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'is_first_page' => 'yes',
                ],
                'description' => esc_html__('Set the container height on mobile devices when "Is First Page?" is enabled.', 'elementor-addon'),
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

        $container_classes = [];
        if (!empty($settings['alignment'])) {
            $container_classes[] = 'align-' . esc_attr($settings['alignment']);
        }
        if ($is_first_page) {
            $container_classes[] = 'is-first-page-mobile';
        }
        $alignment_class = implode(' ', $container_classes);

        if ($is_first_page) {
            echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('is-first-page');
        });
    </script>";
        }

        if ($is_first_page) {
            echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.classList.add('is-first-page');
            
            const firstBlock = document.querySelector('.is-first-page-mobile');
            if (!firstBlock) return;
            
            const firstBlockHeight = firstBlock.offsetHeight;
            
            function checkScroll() {
                if (window.scrollY > firstBlockHeight * 0.8) {
                    document.body.classList.remove('is-first-page');
                    document.body.classList.add('scrolled-past-first');
                } else {
                    document.body.classList.add('is-first-page');
                    document.body.classList.remove('scrolled-past-first');
                }
            }
            
            checkScroll();
            
            window.addEventListener('scroll', checkScroll);
        });
    </script>";
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

            <style>.is-first-page~.headr {
                background: transparent;
                box-shadow: none;
            }

            .is-first-page~.headr .headr-nav a {
                color: #fff;
            }

            .is-first-page~.headr .btn.phone {
                background: rgba(255, 255, 255, 0.1);
                color: #fff;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .is-first-page~.headr .btn.email {
                background: #fff;
                color: #0e3c55;
            }

            .is-first-page~.headr .site-logo img {
                filter: brightness(0) invert(1);
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
                padding: 10px 20px;
                font-size: 1.125rem;
                font-weight: 500;
                text-decoration: none;
                font-family: "Inter Tight", Sans-serif;
                border: 2px solid;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .buttonWrapper .btn svg {
                transition: all 0.3s ease;
                stroke: none !important;
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
                        <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="hqwdasdicon">
                            <path d="M11.5 -0.0078125C12.0523 -0.0078125 12.5 0.439903 12.5 0.992188V10.9922C12.5 11.5445 12.0523 11.9922 11.5 11.9922C10.9477 11.9922 10.5 11.5445 10.5 10.9922V3.33203L2.20703 11.6992C1.81651 12.0897 1.18349 12.0897 0.792969 11.6992C0.402446 11.3087 0.402445 10.6757 0.792969 10.2852L9.0127 1.99219H1.5C0.947715 1.99219 0.5 1.54447 0.5 0.992188C0.5 0.439903 0.947715 -0.0078125 1.5 -0.0078125H11.5Z" fill="currentColor" />
                        </svg>
                    </a>
                </div>
            <?php endif; ?>
        </div>

<?php
    }
}
