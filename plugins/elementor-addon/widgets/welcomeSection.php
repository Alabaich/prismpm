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
                padding: 100px 10%;
                box-sizing: border-box;
            }
            @media screen and (max-width: 1600px) {
                .pageWidthNewHead {
                    padding:100px 25px;
                }
            }
            @media screen and (max-width: 768px) {
                .pageWidthNewHead {
                    padding: 15px;
                }
            }
            .welcome-header .pageWidthNewHead {
                width: 100%;
                padding: 20px 10%;
                box-sizing: border-box;
            }
            @media screen and (max-width: 1600px) {
                .welcome-header .pageWidthNewHead {
                    padding:20px;
                }
            }
            @media screen and (max-width: 768px) {
                .welcome-header .pageWidthNewHead {
                    padding: 15px;
                }
            }
            .welcome-section {
                text-align: center;
                position: relative;
            }

            .welcome-header {
                background-color: <?php echo esc_attr($settings['header_color']); ?>;
                position: sticky;
                top: 127px;
                width: 100%;
                left: 0;
                z-index: 99;
                transition: opacity 0.3s ease, transform 0.6s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                transform: translateY(-40%); 
            }

            .welcome-header.active {
                position: fixed;
                top: 90px;
                transform: translateY(0); 
            }

            .welcome-header .pageWidthNewHead {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .welcome-header img {
                object-fit: contain;
                height: 100%;
                width: auto;
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
                font-family: "Playfair Display", serif;
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
            }

            .welcome-content .text-content {
                width: 50%;
                text-align: left;
                align-items: flex-start;
                justify-content: flex-start;
                display: flex;
                flex-direction: column;
                font-family: "Playfair Display";
                gap: 25px;
            }

            .welcome-content .text-content h1 {
                color: <?php echo esc_attr($settings['title_color']); ?>;
                margin: 0;
                padding-bottom: 25px;
                font-size: 68px;
                font-weight: 600;
                max-width: 700px;
            }

            .welcome-content .text-content p {
                color: #4D4D4D;
                font-size: 1.125rem;
                margin: 0;
                line-height: 1.1;
                max-width: 580px;
            }

            .welcome-content .additional-texts p {
                color: #4D4D4D;
            }

            .welcome-content .score-value {
                width: 40%;
                overflow: hidden;
                margin-bottom: -10%;
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
            .butNavGApEtc {
                display:flex;
                align-items:center;
                gap:8px;
            }

            @media (max-width: 768px) {
                .welcome-content {
                    flex-direction: column;
                    text-align: center;
                }
                .skritich {
                    display:none;
                }
                            .butNavGApEtc {
                gap: 4px;
            }
                .welcome-content .text-content {
                }
                .welcome-header.active {
                    top: 80px;
                }
                .welcome-header img {
                    max-height: 40px;
                }
                .welcome-content .score-value {
                    width: 100%;
                }
            .welcome-content .text-content p {
                    width: 100%;
                    font-size:14px;

            }
            .welcome-content .text-content h1 {
                    width: 100%;
                    padding-bottom:16px;
                    font-size:24px;
            }
                        .welcome-content .text-content {
                width: 100%;
                text-align: center;
                align-items: center;
                justify-content: center;
                gap: 16px;
            }
                            .welcome-content .score-value {
                    width: 80%;
                    margin:0 auto;
                    margin-bottom:-16%;
                }
                .welcome-content {
                    gap:40px;
                }
                            .welcome-header {
                top: 104px;
            }
                        .welcome-header nav a {
                font-size: 14px;
            }
                        .welcome-header nav .button {
                padding: 6px 12px;
            }
            }
        </style>

        <div class="welcome-header" id="welcome-header-<?php echo esc_attr($this->get_id()); ?>">
            <div class="pageWidthNewHead">
                <?php if (!empty($settings['header_image']['url'])) : ?>
                    <img src="<?php echo esc_url($settings['header_image']['url']); ?>" alt="Header Image">
                <?php endif; ?>
                <nav>
                    <a class ="skritich" href="#AboutSec">About</a>
                    <a class ="skritich" href="#AmenitiesSec">Amenities</a>
                    <a class ="skritich" href="#SuitesSec">Suites</a>
                    <a class ="skritich" href="#NeighbourhoodSec">Neighbourhood</a>
                    <a class ="skritich" href="#GallerySec">Gallery</a>
                    <div class ="butNavGApEtc">
                                            <a href="#" class="button">Schedule a tour</a>
                    <a href="#" class="button">Apply</a>
                    </div>
                </nav>
            </div>
        </div>

        <div class="pageWidthNewHead" id="AboutSec">
            <div class="welcome-section" id="welcome-section-<?php echo esc_attr($this->get_id()); ?>">
                <div class="welcome-content" >
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

    document.querySelectorAll('nav a').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault(); 
            const href = this.getAttribute('href');
            const target = document.querySelector(href);
            if (target) {
                const headerHeight = header.offsetHeight; 
                const targetPosition = target.getBoundingClientRect().top + window.scrollY - headerHeight;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

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