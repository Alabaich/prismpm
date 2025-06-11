<?php
class Elementor_proudSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'proudSection';
    }

    public function get_title()
    {
        return esc_html__('Proud To Call Peterborough Home', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-info';
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
                'label' => esc_html__('Main Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Proud To Call Peterborough Home',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'For generations, businesses and residents have thrived in our vibrant city.',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'stat_number',
            [
                'label' => esc_html__('Stat Number', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '150+',
            ]
        );

        $repeater->add_control(
            'stat_text',
            [
                'label' => esc_html__('Stat Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Years of History',
            ]
        );

        $this->add_control(
            'stats',
            [
                'label' => esc_html__('Stats', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'stat_number' => '150+',
                        'stat_text' => 'Years of History',
                    ],
                    [
                        'stat_number' => '175,000+',
                        'stat_text' => 'Proud Residents',
                    ],
                    [
                        'stat_number' => '6,000+',
                        'stat_text' => 'Local Businesses',
                    ],
                ],
                'title_field' => '{{{ stat_number }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <section class="proud-peterborough-section pageWidth">
            <div class="proud-peterborough__container">
                <div class="aligtextcont">
                    <h2 class="proud-peterborough__title"><?php echo esc_html($settings['main_title']); ?></h2>
                    <p class="proud-peterborough__description"><?php echo esc_html($settings['description']); ?></p>
                </div>
                <div class="proud-peterborough__grid">
                    <?php foreach ($settings['stats'] as $stat) : ?>
                        <div class="proud-peterborough__stat">
                            <span class="proud-peterborough__stat-number"><?php echo esc_html($stat['stat_number']); ?></span>
                            <p class="proud-peterborough__stat-text"><?php echo esc_html($stat['stat_text']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <style>
                                                .pageWidth{
    width: 100%;
    padding: 25px 10%;
}
@media screen and (max-width: 1600px) {
 .pageWidth{
  width: 100%;
  padding: 25px;
}
}
@media screen and (max-width: 768px) {
 .pageWidth{
  width: 100%;
  padding: 15px;
}
}
.aligtextcont{
                    display:flex;
                flex-direction:column;
                align-items:center;
                justify-content:center;
}
            .proud-peterborough-section {
                background-color: #093D5F;
                color: #FFFFFF;
                text-align: center;
            }

            .proud-peterborough__container {
                padding:80px 0;
            }

            .proud-peterborough__title {
                margin:0;
                padding-bottom:1.5rem;
            }

            .proud-peterborough__description {
                margin:0;
                color:#E0E0E0;
                padding-bottom:3.125rem;
                max-width:600px;
            }

            .proud-peterborough__grid {
                display: flex;
                justify-content: space-between;
                align-items:center;
            }

            .proud-peterborough__stat {
                display:flex;
                align-items:center;
                flex-direction:column;
                justify-content: center;
            }

            .proud-peterborough__stat-number {
                font-size: 4rem;
                margin: 0;
                font-weight:600;
            }

            .proud-peterborough__stat-text {
                font-size: 1.5rem;
                margin: 0;
                color:#E0E0E0;
            }
        </style>
<?php
    }
}