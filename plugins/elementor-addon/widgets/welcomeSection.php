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
            'score_value',
            [
                'label' => esc_html__('Score Value', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 80,
                'min' => 0,
                'max' => 100,
                'step' => 1,
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
            'score_color',
            [
                'label' => esc_html__('Score Text Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#6d8299',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <div class="pageWidth">
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

                .welcome-section {
                    text-align: center;
                    position: relative;
                }

                .welcome-section .welcome-header {
                    background-color: <?php echo esc_attr($settings['header_color']); ?>;
                    padding: 10px 0;
                    position: absolute; 
                    top: 0;
                    width: 100%;
                    left: 0;
                    z-index: 99; 
                    transition: top 0.3s ease, position 0.3s ease; 
                }

                .welcome-section .welcome-header.active {
                    position: fixed; 
                    top: 60px; 
                }

                .welcome-section .welcome-header nav {
                    display: flex;
                    justify-content: center;
                    gap: 2rem;
                }

                .welcome-section .welcome-header nav a {
                    color: #fff;
                    text-decoration: none;
                    font-size: 1rem;
                }

                .welcome-section .welcome-header nav .button {
                    background-color: #fff;
                    color: #000;
                    padding: 5px 15px;
                    border-radius: 5px;
                    text-decoration: none;
                }

                .welcome-section .welcome-content {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    gap: 2rem;
                    padding: 2rem 0;
                }

                .welcome-section .welcome-content .text-content {
                    max-width: 50%;
                    text-align: left;
                }

                .welcome-section .welcome-content .text-content h2 {
                    color: <?php echo esc_attr($settings['title_color']); ?>;
                    font-size: 2.5rem;
                    margin: 0;
                }

                .welcome-section .welcome-content .text-content p {
                    color: #000;
                    font-size: 1rem;
                    line-height: 1.5;
                }

                .welcome-section .welcome-content .score-value {
                    font-size: 10rem;
                    font-weight: bold;
                    color: <?php echo esc_attr($settings['score_color']); ?>;
                    line-height: 0.8;
                }

                @media (max-width: 768px) {
                    .welcome-section .welcome-content {
                        flex-direction: column;
                        text-align: center;
                    }
                    .welcome-section .welcome-content .text-content {
                        max-width: 100%;
                    }
                    .welcome-section .welcome-header.active {
                        top: 50px; 
                    }
                }
            </style>

            <div class="welcome-section" id="welcome-section-<?php echo esc_attr($this->get_id()); ?>">
                <div class="welcome-header">
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
                <div class="welcome-content">
                    <div class="text-content">
                        <h2><?php echo esc_html($settings['section_title']); ?></h2>
                        <p><?php echo esc_html($settings['section_subtitle']); ?></p>
                    </div>
                    <div class="score-value"><?php echo esc_html($settings['score_value']); ?></div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var section = document.getElementById('welcome-section-<?php echo esc_js($this->get_id()); ?>');
                    var header = section.querySelector('.welcome-header');
                    var lastScrollY = window.scrollY;
                    var sectionTop = section.getBoundingClientRect().top + window.scrollY;

                    function checkScrollDirection() {
                        var currentScrollY = window.scrollY;
                        var rect = section.getBoundingClientRect();
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
        </div>
<?php
    }
}