<?php
class Elementor_scoreAnimatedSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'score_section';
    }

    public function get_title()
    {
        return esc_html__('Score Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-number-field';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {
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

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
            <div class="score-section pageWidthAnSc">
                <?php if (!empty($settings['section_title'])): ?>
                    <h2><?php echo esc_html($settings['section_title']); ?></h2>
                <?php endif; ?>
                <div class="score-container">
                    <?php if (!empty($settings['walk_score'])): ?>
                        <div class="score-item" data-score="<?php echo esc_attr($settings['walk_score']); ?>">
                            <span class="score-value" style="order: -1; margin-right: 2rem;">
                                <?php echo esc_html($settings['walk_score']); ?>
                                <span class="score-valueText">Walk Score</span>
                            </span>
                            <div class="score-circle">
                                <div class="score-ring"></div>
                                <span class="icon">🚶‍♂️</span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($settings['bike_score'])): ?>
                        <div class="score-item" data-score="<?php echo esc_attr($settings['bike_score']); ?>">
                            <div class="score-circle">
                                <div class="score-ring"></div>
                                <span class="icon">🚴‍♀️</span>
                            </div>
                            <span class="score-value" style="order: 1; margin-left: 2rem;">
                                <?php echo esc_html($settings['bike_score']); ?>
                                <span class="score-valueText">Bike Score</span>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($settings['section_subtitle'])): ?>
                    <p class="animateStoryTale"><?php echo esc_html($settings['section_subtitle']); ?></p>
                <?php endif; ?>
            </div>
         <style>
            .pageWidthAnSc {
                padding: 25px 10%;
                width: 100%;
            }
            @media screen and (max-width: 1600px) {
                .pageWidthAnSc { padding: 25px; }
            }
            @media screen and (max-width: 768px) {
                .pageWidthAnSc { padding: 15px; }
            }
            .animateStoryTale {
                color:white;
                font-size:1.25rem;
                max-width: 80%;
                margin:0 auto;
            }

            .score-section { text-align: center; background:#093D5F; }
            .score-section h2 {
                margin:0;
                color:white;
                padding-bottom:40px;
            }

            .score-section .score-container {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 2rem;
                margin:0;
                padding-bottom:3rem;
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
                padding: 0px;
                box-sizing: border-box;
                background: conic-gradient(#28a745 0deg, transparent 0deg);
                -webkit-mask: radial-gradient(farthest-side, transparent calc(90%), black calc(90%));
                mask: radial-gradient(farthest-side, transparent calc(90%), black calc(90%));
            }

            .score-section .icon {
                font-size: 6rem;
                z-index: 1;
            }

            .score-value {
                color: gray;
                font-size: 4rem;
                z-index: 1;
                display:flex;
                flex-direction:column;
                align-items:center;
                justify-content:center;
            }
            .score-valueText {
                font-size:1.5rem;
            }

            .score-item {
                display: flex;
                align-items: center;
            }

            @media (max-width: 768px) {
                .score-section .score-container {
                    flex-direction: column;
                }
                .score-item {
                    flex-direction: column;
                    text-align: center;
                }
                .score-value {
                    margin-top: 10px;
                }
            }
        </style>

        <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.score-item').forEach(item => {
                const score = parseInt(item.getAttribute('data-score')) || 0;
                const ring = item.querySelector('.score-ring');
                const duration = 5000;
                const frames = 60;
                const maxDeg = score * 3.6;
                let current = 0;
                const increment = maxDeg / (duration / (1000 / frames));

                function animate() {
                    current += increment;
                    if (current >= maxDeg) current = maxDeg;
                    ring.style.background = `conic-gradient(#28a745 ${current}deg, transparent ${current}deg 360deg)`;
                    if (current < maxDeg) requestAnimationFrame(animate);
                }

                requestAnimationFrame(animate);
            });
        });
        </script>
<?php
    }
}
