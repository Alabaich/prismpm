<?php
class Elementor_welcomeSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'welcomeSection';
    }

    public function get_title()
    {
        return esc_html__('80 Bond Welcome Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-number-field';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Section Content', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'This Bond takes living to a whole new level',
            ]
        );

        $this->add_control(
            'section_subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Suites feature 9’ and higher ceilings (as per plan), individual climate control, stainless steel appliances and in-suite laundry. 80 Bond also features underground parking and onsite property management, as well as an unbeatable range of amenities including large, fully-equipped gym, business centre, party room, terrace, dog wash and stunning, spacious lobby.',
            ]
        );

        $this->add_control(
            'score_image',
            [
                'label' => esc_html__('Score Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => ''],
            ]
        );

        $this->add_control(
            'header_image',
            [
                'label' => esc_html__('Header Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => ''],
            ]
        );

        $this->add_control(
            'header_color',
            [
                'label' => esc_html__('Header Background Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Text Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1a3c5e',
            ]
        );

        $this->add_control(
            'additional_texts',
            [
                'label' => esc_html__('Additional Texts', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'text',
                        'label' => esc_html__('Text', 'elementor-addon'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => '',
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <style>
            .pageWidthNewHead {
                width: 100%;
                padding: 25px 10%;
                box-sizing: border-box;
            }
            @media screen and (max-width: 1600px) {
                .pageWidthNewHead {
                    padding: 25px;
                }
            }
            @media screen and (max-width: 768px) {
                .pageWidthNewHead {
                    padding: 15px;
                }
            }

            .welcome-section {
                text-align: center;
                position: relative;
            }

            .welcome-header {
                background-color: <?php echo esc_attr($settings['header_color']); ?>;
                position: absolute;
                top: 0;
                width: 100%;
                left: 0;
                z-index: 99;
                transition: top 0.3s ease, position 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .welcome-header.active {
                position: fixed;
                top: 100px;
            }

            .welcome-header .pageWidthNewHead {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px 10%;
            }

            .welcome-header img {
                height: 54px;
                width: 160px;
            }

            .welcome-header nav {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 2rem;
            }

            .welcome-header nav a {
                color: #fff;
                text-decoration: none;
                font-size: 1rem;
                font-family: "Playfair Display";
            }

            .welcome-header nav .button {
                background-color: #fff;
                color: #1A1A1A;
                border-radius: 66px;
                text-decoration: none;
                font-weight: 500;
                padding: 10px 20px;
            }

            .welcome-content {
                display: flex;
                justify-content: space-between;
                padding-top: 172px;
            }

            .welcome-content .text-content {
                width: 50%;
                text-align: left;
                align-items: flex-start;
                justify-content: flex-start;
                display: flex;
                flex-direction: column;
                gap: 25px;
            }

            .welcome-content .text-content h1 {
                color: <?php echo esc_attr($settings['title_color']); ?>;
                margin: 0;
                padding-bottom: 25px;
            }

            .welcome-content .text-content p {
                color: #4D4D4D;
                font-size: 1.125rem;
                margin: 0;
                line-height: 1.1;
            }

            .welcome-content .additional-texts p {
                color: #4D4D4D;
            }

            .welcome-content .score-value {
                width: 40%;
                overflow: hidden;
                margin-bottom: -6%;
                justify-content: flex-end;
                align-items: flex-end;
                display: flex;
                z-index: -10;
            }

            .welcome-content .score-value img {
                width: 100%;
                height: auto;
                object-fit: contain;
                display: block;
            }

            @media (max-width: 768px) {
                .welcome-content {
                    flex-direction: column;
                    text-align: center;
                    padding-top: 100px;
                }
                .welcome-content .text-content {
                    max-width: 100%;
                }
                .welcome-header.active {
                    top: 50px;
                }
                .welcome-header img {
                    max-height: 40px;
                }
                .welcome-content .score-value {
                    width: 100%;
                    margin-bottom: -5%;
                }
            }
        </style>

        <div class="welcome-header" id="welcome-header-<?php echo esc_attr($this->get_id()); ?>">
            <div class="pageWidthNewHead">
                <?php if (!empty($settings['header_image']['url'])) : ?>
                    <img src="<?php echo esc_url($settings['header_image']['url']); ?>" alt="Header Image">
                <?php endif; ?>
                <nav>
                    <a href="#">About</a>
                    <a href="#">Amenities</a>
                    <a href="#">Suites</a>
                    <a href="#">Neighbourhood</a>
                    <a href="#">Gallery</a>
                    <a href="#" class="button">Schedule a tour</a>
                    <a href="#" class="button">Apply</a>
                </nav>
            </div>
        </div>

        <div class="pageWidthNewHead">
            <div class="welcome-section" id="welcome-section-<?php echo esc_attr($this->get_id()); ?>">
                <div class="welcome-content">
                    <div class="text-content">
                        <h1><?php echo esc_html($settings['section_title']); ?></h1>
                        <p><?php echo esc_html($settings['section_subtitle']); ?></p>
                        <div class="additional-texts">
                            <?php foreach ($settings['additional_texts'] as $index => $text) : ?>
                                <p><?php echo esc_html($text['text']); ?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="score-value">
                        <?php if (!empty($settings['score_image']['url'])) : ?>
                            <img src="<?php echo esc_url($settings['score_image']['url']); ?>" alt="Score Image">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var section = document.getElementById('welcome-section-<?php echo esc_js($this->get_id()); ?>');
                var header = document.getElementById('welcome-header-<?php echo esc_js($this->get_id()); ?>');
                var lastScrollY = window.scrollY;
                var sectionTop = section.getBoundingClientRect().top + window.scrollY;

                function checkScrollDirection() {
                    var currentScrollY = window.scrollY;
                    var sectionBottom = sectionTop + section.offsetHeight;
                    var scrollDown = currentScrollY > lastScrollY;
                    var scrollUp = currentScrollY < lastScrollY;
                    var isPastSection = currentScrollY > sectionBottom;

                    if (isPastSection && scrollDown) {
                        header.classList.add('active');
                    } else if (scrollUp && currentScrollY <= sectionTop) {
                        header.classList.remove('active');
                    }

                    lastScrollY = currentScrollY <= 0 ? 0 : currentScrollY;
                }

                window.addEventListener('scroll', checkScrollDirection);
                window.addEventListener('resize', function() {
                    sectionTop = section.getBoundingClientRect().top + window.scrollY;
                    checkScrollDirection();
                });
                checkScrollDirection();
            });
        </script>
<?php
    }
}