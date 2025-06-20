<?php
class Elementor_scoreAnimatedSection extends \Elementor\Widget_Base
{
    public function get_name() {
        return 'score_section';
    }

    public function get_title() {
        return esc_html__('Score Section', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-number-field';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {
        $this->start_controls_section('section_content', [
            'label' => esc_html__('Score Content', 'elementor-addon'),
        ]);

        $this->add_control('section_title', [
            'label' => esc_html__('Title', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Now is the time. This is the place.',
        ]);

        $this->add_control('section_subtitle', [
            'label' => esc_html__('Subtitle', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => 'Oshawa has become one of Canada\'s most dynamic cities...',
        ]);

        $this->add_control('walk_score', [
            'label' => esc_html__('Walk Score', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 95,
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ]);

        $this->add_control('bike_score', [
            'label' => esc_html__('Bike Score', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 80,
            'min' => 0,
            'max' => 100,
            'step' => 1,
        ]);

        $this->add_control(
            'section_background_color',
            [
                'label' => esc_html__('Section Background Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#093D5F',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="score-section pageWidthAnSc" id="score-section-<?php echo esc_attr($this->get_id()); ?>">
            <?php if (!empty($settings['section_title'])): ?>
                <h2><?php echo esc_html($settings['section_title']); ?></h2>
            <?php endif; ?>
            <div class="score-container">
                <?php if (!empty($settings['walk_score'])): ?>
                    <div class="score-item" data-score="<?php echo esc_attr($settings['walk_score']); ?>">
                        <div class="score-circle">
                            <div class="score-ring"></div>
                            <span class="icon">
                                <svg class="phBike" width="120" height="150" viewBox="0 0 96 155" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M52 4C58.0305 4 62 8.35861 62 14C62 19.6414 58.0305 25 52 25C45.9695 25 41 19.6414 41 14C41 8.35861 45.9695 4 52 4ZM52 0C43.4538 0 36 6.00517 36 14C36 21.9948 43.4538 29 52 29C60.5462 29 67 21.9948 67 14C67 6.00517 60.5462 0 52 0Z" fill="white"/>
<path d="M86 76.0004C84.8331 76.0004 84.1116 75.4492 83 75.0004L68 70.0004C67.0821 69.6849 66 68.9379 66 68.0004V54.0004C66 53.2739 66.3796 52.4136 67 52.0004C67.6181 51.5827 68.292 51.7471 69 52.0004L89 59.0004C93.5916 60.8532 95.7619 66.6882 94 71.0004C93.096 73.2064 91.2739 74.1095 89 75.0004C87.9115 75.4314 87.1462 76.0004 86 76.0004ZM71 66.0004L84 71.0004C85.1785 71.4736 86.9392 71.4247 88 71.0004C89.1024 70.5694 89.5641 70.0645 90 69.0004C90.851 66.9187 90.2116 64.8957 88 64.0004L71 57.0004V66.0004Z" fill="white"/>
<path d="M57.0001 30C61.7488 30 66.0001 34.4687 66.0001 39V87L85.0001 105C86.1799 106.091 86.8206 108.443 87.0001 110C91.1805 146.268 91.0001 143.336 91.0001 144C91.0001 147.267 88.494 150.748 85.0001 151C84.8297 151.013 85.1684 151 85.0001 151C81.6359 151 78.3548 148.245 78.0001 145L75.0001 115C74.8274 113.423 74.1981 112.1 73.0001 111C68.8926 107.221 58.8923 98.3382 52.0001 92L40.0001 124C39.6864 124.826 38.6184 125.349 38.0001 126L17.0001 148C15.7135 149.599 13.9641 151 12.0001 151C10.6226 151 9.18218 149.855 8.00014 149C5.96794 147.529 5.57279 145.239 6.00014 143C6.17745 142.069 6.36366 141.807 7.00014 141L28.0001 119C28.7116 118.241 28.7069 116.983 29.0001 116L38.0001 87V47C32.4082 51.1322 29.755 53.7397 28.0001 55C26.5635 56.0303 24.9888 57.2842 25.0001 59V72C25.0183 75.4337 22.5985 77.987 19.0001 78C15.4449 78 12.0183 75.4641 12.0001 72V53C11.991 51.3276 12.6203 50.0325 14.0001 49L38.0001 31C38.9276 30.3037 39.8204 30 41.0001 30H57.0001ZM57.0001 26H41.0001C38.8088 26 36.7209 26.7072 35.0001 28L12.0001 45C9.49967 46.8763 7.98423 49.9654 8.00014 53V72C8.03197 77.7916 12.9308 82 19.0001 82C22.0007 81.9892 24.9179 81.0043 27.0001 79C29.0801 76.9957 30.0161 74.8199 30.0001 72V59C30.0001 58.6594 29.716 58.2039 30.0001 58C30.6616 57.525 31.7204 56.9284 33.0001 56V87L25.0001 115C24.8956 115.347 24.2525 115.731 24.0001 116L3.00014 138C2.91603 138.091 3.07743 137.902 3.00014 138C1.95904 139.319 1.30474 141.386 1.00014 143C0.247727 146.941 1.64724 150.575 5.00014 153C6.94596 154.406 9.56559 155 12.0001 155C15.4053 155 18.8838 153.529 21.0001 151L42.0001 129C43.0231 127.924 43.4841 126.364 44.0001 125L54.0001 100L70.0001 114C70.4252 114.39 69.9388 115.438 70.0001 116L74.0001 145C74.5934 150.449 79.2627 155 85.0001 155C85.282 155 85.7137 155.02 86.0001 155C91.7944 154.584 96.0001 149.542 96.0001 144C96.007 143.631 95.5616 141.835 95.0001 137C94.4319 132.113 93.6414 123.227 92.0001 109C91.7046 106.445 90.9346 103.79 89.0001 102L70.0001 86V39C70.0001 32.0848 64.247 26 57.0001 26Z" fill="white"/>
</svg>
                            </span>
                        </div>
                        <span class="score-value">
                            <?php echo esc_html($settings['walk_score']); ?>
                            <span class="score-valueText">Walk Score</span>
                        </span>
                    </div>
                <?php endif; ?>
                <?php if (!empty($settings['bike_score'])): ?>
                    <div class="score-item" data-score="<?php echo esc_attr($settings['bike_score']); ?>">
                        <div class="score-circle">
                            <div class="score-ring"></div>
                            <span class="icon">
                                <svg class="phChel" width="150" height="120" viewBox="0 0 160 89" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M30 89C13.4568 89 0 75.5427 0 59C0 42.4573 13.4568 29 30 29C46.5432 29 60 42.4573 60 59C60 75.5427 46.5411 89 30 89ZM30 33C15.7578 33 4 44.7583 4 59C4 73.2417 15.7578 85 30 85C44.2422 85 56 73.2417 56 59C56 44.7583 44.2401 33 30 33Z" fill="white"/>
<path d="M130 89C113.457 89 100 75.5427 100 59C100 42.4573 113.457 29 130 29C146.543 29 160 42.4573 160 59C160 75.5427 146.543 89 130 89ZM130 33C115.758 33 104 44.7583 104 59C104 73.2417 115.758 85 130 85C144.242 85 156 73.2417 156 59C156 44.7583 144.242 33 130 33Z" fill="white"/>
<path d="M79.9995 61.0004H29.9995C29.175 61.0004 28.3471 60.7294 27.9995 60.0004C27.6519 59.2672 27.4696 58.6172 27.9995 58.0004L67.9995 11.0004L66.9995 3.00039C66.7791 1.87262 67.8507 1.21846 68.9995 1.00039C70.1611 0.792694 70.7791 1.8747 70.9995 3.00039L72.9995 11.0004C72.9932 10.9672 73.0059 11.0336 72.9995 11.0004L81.9995 59.0004C82.1182 59.6089 82.4023 59.5248 81.9995 60.0004C81.5968 60.4781 80.6312 61.0004 79.9995 61.0004ZM34.9995 57.0004H76.9995L68.9995 16.0004L34.9995 57.0004Z" fill="white"/>
<path d="M79 61.0001C78.5498 61.0001 78.3851 61.293 78 61.0001C77.0805 60.2981 76.2888 58.9057 77 58.0001L121 2.00013C121.711 1.09251 123.078 0.300207 124 1.00013C124.92 1.70214 125.711 3.09459 125 4.00013L81 60.0001C80.5855 60.5277 79.6292 61.0001 79 61.0001Z" fill="white"/>
<path d="M130 62C129.072 62 128.258 60.9316 128 60L115 14H70C68.8327 14 68 13.1604 68 12C68 10.8396 68.8327 10 70 10H117C117.952 10 118.748 11.0893 119 12L132 59C132.309 60.1163 131.125 61.6916 130 62C130.186 62 129.812 62.0504 130 62Z" fill="white"/>
<path d="M80 67C84.1421 67 87 64.1421 87 60C87 55.8579 84.1421 52 80 52C75.8579 52 72 55.8579 72 60C72 64.1421 75.8579 67 80 67Z" fill="white"/>
<path d="M79 6H62C60.2807 6 59 4.656 59 3C59 1.344 60.2807 0 62 0H79C80.7193 0 82 1.344 82 3C82 4.656 80.7193 6 79 6Z" fill="white"/>
<path d="M132 15H128C126.832 15 125 14.1241 125 13C125 11.8759 126.832 11 128 11H132C133.684 11 135 9.61812 135 8C135 6.38188 133.684 5 132 5H113C111.832 5 111 4.12415 111 3C111 1.87585 111.832 1 113 1H132C136.017 1 139 4.13968 139 8C139 11.8603 136.017 15 132 15Z" fill="white"/>
</svg>
                            </span>
                        </div>
                        <span class="score-value">
                            <?php echo esc_html($settings['bike_score']); ?>
                            <span class="score-valueText">Bike Score</span>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
            <?php if (!empty($settings['section_subtitle'])): ?>
                <p class="animateStoryTale"> <?php echo esc_html($settings['section_subtitle']); ?></p>
            <?php endif; ?>
        </div>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Darker+Grotesque:wght@400;500;600&family=Inter+Tight:wght@400&family=Playfair+Display&display=swap");

            .pageWidthAnSc {
                padding: 100px 10%;
                width: 100%;
            }
            @media screen and (max-width: 1600px) {
                .pageWidthAnSc { padding: 100px 25px; }
            }
            @media screen and (max-width: 768px) {
                .pageWidthAnSc { padding: 60px 15px; }
            }
            .animateStoryTale {
                color: white;
                font-size: 1.375rem;
                max-width: 80%;
                margin: 0 auto;
                font-family: "Playfair Display", serif;
            }

            .score-section { 
                text-align: center; 
                background: <?php echo esc_attr($settings['section_background_color']); ?>;
            }
            .score-section h2 {
                margin: 0;
                color: white;
                padding-bottom: 70px;
                font-size:52px;
                font-family: "Playfair Display", serif;
            }

            .score-section .score-container {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 50px;
                margin: 0;
                flex-wrap: wrap;
                padding-bottom: 50px;
            }

            .score-circle {
                position: relative;
                width: 280px;
                height: 280px;
                border-radius: 50%;
                display: flex;
                justify-content: center;
                align-items: center;
                box-sizing: border-box;
            }

            .score-ring {
                position: absolute;
                width: 100%;
                height: 100%;
                border-radius: 50%;
                box-sizing: border-box;
                background: conic-gradient(white 0deg, rgba(255, 255, 255, 0.2) 0deg 360deg);
                -webkit-mask: radial-gradient(farthest-side, transparent calc(90%), #fff calc(90%));
                mask: radial-gradient(farthest-side, transparent calc(80%),transparent calc(90%), #fff calc(96%));
                transition: background 4s ease-out;
                stroke-linecap: round;
            }

            .score-section .icon {
                font-size: 6rem;
                z-index: 1;
                display:flex;
                object-fit:cover;
                align-self:center;
            }

            .score-value {
                padding-top:20px;
                color: white;
                font-size: 3.25rem; 
                z-index: 1;
                display: flex;
                gap: 10px;
                font-family: "Playfair Display", serif;
            }
            .score-value span {
                display:flex;
                align-self:flex-end;
            }
            .score-valueText {
                font-size: 1.375rem;
                display:flex;
                align-self:flex-end;
                font-weight:500;
            }

            .score-item {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            @media (max-width: 768px) {
                .score-section .score-container {
                    flex-direction: column;
                gap: 20px;
                padding-bottom: 32px;
                }
                .score-item {
                    text-align: center;
                }
                .score-value {
                    margin-top: 10px;
                }
                .score-section h2 {
                    padding-bottom: 40px;
                    font-size:24px;
                    max-width:320px;
                    margin:0 auto;
                }
                .score-item {
                    flex-direction: row;
                    align-items: center;
                    gap:20px;
                }
                .score-value {
                    padding-top:0;
                    font-size: 32px; 
                    gap: 10px;
                    flex-direction:column;
                    margin:0;
                }
                            .score-circle {
                width: 220px;
                height: 220px;
            }
            .score-section .icon .phBike{
                height: 100px;
                width: 120px;
            }
            .score-section .icon .phChel{
                height: 120px;
                width: 100px;
            }
                        .score-valueText {
                font-size: 18px;
                align-self:center;
            }
                        .animateStoryTale {
                font-size: 18px;
            }
                        .animateStoryTale {
                max-width: 100%;
            }
        }
        </style>

        <script>
        document.addEventListener("DOMContentLoaded", function () {
            const section = document.getElementById('score-section-<?php echo esc_js($this->get_id()); ?>');
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        document.querySelectorAll('.score-item').forEach(item => {
                            const score = parseInt(item.getAttribute('data-score')) || 0;
                            const ring = item.querySelector('.score-ring');
                            const duration = 4000; 
                            const startTime = performance.now();

                            function animate(currentTime) {
                                const progress = Math.min((currentTime - startTime) / duration, 1);
                                const maxDeg = score * 3.6;
                                const currentDeg = maxDeg * easeInOutQuad(progress);

                                ring.style.background = `conic-gradient(white ${currentDeg}deg, rgba(255, 255, 255, 0.2) ${currentDeg}deg 360deg)`;
                                if (progress < 1) {
                                    requestAnimationFrame(animate);
                                }
                            }

                            function easeInOutQuad(t) {
                                return t < 0.5 ? 2 * t * t : 1 - Math.pow(-2 * t + 2, 2) / 2;
                            }

                            requestAnimationFrame(animate);
                        });
                        observer.unobserve(entry.target); 
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(section);
        });
        </script>
        <?php
    }
}
?>