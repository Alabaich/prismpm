<?php
class Elementor_residentLoveSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'residentLoveSection';
    }

    public function get_title()
    {
        return esc_html__('Resident Love Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-testimonial';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Section Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Why Residents Love Living Here',
            ]
        );

        $this->add_control(
            'section_background_color',
            [
                'label' => esc_html__('Section Background Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#093D5F',
            ]
        );

        $this->add_control(
            'building_name',
            [
                'label' => esc_html__('Building Name', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '80 Bond',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'testimonial_text',
            [
                'label' => esc_html__('Testimonial Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'We absolutely love living here! The management and maintenance team are not only friendly and welcoming, they are present and responsive throughout the year, it truly feels like home.',
            ]
        );

        $repeater->add_control(
            'author_name',
            [
                'label' => esc_html__('Author Name', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Warren and Lorraine',
            ]
        );

        $repeater->add_control(
            'author_photo',
            [
                'label' => esc_html__('Photo', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'star_rating',
            [
                'label' => esc_html__('Star Rating', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 5,
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__('Testimonials', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ author_name }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <div class="resident-love-section pageWidthResLove">
            <style>
                .pageWidthResLove {
                    width: 100%;
                    padding: 25px 10%;
                }
                @media screen and (max-width: 1600px) {
                    .pageWidthResLove {
                        padding: 25px;
                    }
                }
                @media screen and (max-width: 768px) {
                    .pageWidthResLove {
                        padding: 15px;
                    }
                }
                .resident-love-section {
                    background-color: <?php echo esc_attr($settings['section_background_color']); ?>;
                    color: #fff;
                    text-align: center;
                }
                .resident-love-section .title-block {
                    margin: 0;
                    color: #fff;
                    padding-bottom: 25px;
                    padding-top:25px;
                }
                .resident-love-section .grid-layout {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(18rem, 1fr));
                    gap: 25px;
                    width: 100%;
                    padding-top: 25px;
                    padding-bottom:25px;
                }
                .resident-love-section .testimonial-card {
                    color: #FFFFFF;
                    text-align: left;
                    position: relative;
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-start;
                    height: 100%;
                }
                .resident-love-section .testimonial-author {
                    display: flex;
                    flex-direction: column;
                    align-items: baseline;
                    gap: 25px;
                    height: 100%;
                }
                .resident-love-section .testimonial-author img {
                    width: 100%;
                    height: 280px;
                    object-fit: cover;
                    border-radius: 6px;
                }
                .resident-love-section .testimonial-author .qwdqd {
                    font-size: 1rem;
                    margin: 0;
                    position: relative;
                    z-index: 1;
                }
                .resident-love-section .testimonial-author p::before {
                    content: '“';
                    font-size: 2rem;
                    margin-right: 0.25rem;
                    line-height:80%;
                    color: #FFFFFF;
                }
                .resident-love-section .testimonial-author p::after {
                    content: '”';
                    font-size: 2rem;
                    line-height:70%;
                    color: #FFFFFF;
                }
                .resident-love-section .testimonial-footer {
                    margin-top: auto;
                    display: flex;
                    flex-direction: column;
                    gap: 25px;
                }
                .resident-love-section .testimonial-author-info {
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                }
                .resident-love-section .testimonial-author-info .name {
                    font-weight: 500;
                    font-size:22px;
                    margin:0;
                }
                .resident-love-section .testimonial-author-info .building {
                    font-size: 1rem;
                }
                .resident-love-section .star-rating {
                    color: #FEE547;
                    font-size: 1.5rem;
                }
                @media (max-width: 768px) {
                    .resident-love-section .title-block {
                        font-size: 1.2rem;
                    }
                    .resident-love-section .grid-layout {
                        grid-template-columns: 1fr;
                    }
                }
                @media (min-width: 768px) and (max-width: 1024px) {
                    .resident-love-section .grid-layout {
                        grid-template-columns: repeat(2, 1fr);
                    }
                }
            </style>
            <h2 class="title-block"><?php echo esc_html($settings['section_title']); ?></h2>
            <div class="grid-layout">
                <?php foreach ($settings['testimonials'] as $testimonial): ?>
                    <div class="testimonial-card">
                        <div class="testimonial-author">
                            <img src="<?php echo esc_url($testimonial['author_photo']['url']); ?>" alt="<?php echo esc_attr($testimonial['author_name']); ?>" />
                            <p class="qwdqd"><?php echo esc_html($testimonial['testimonial_text']); ?></p>
                            <div class="testimonial-footer">
                                <div class="testimonial-author-info">
                                    <h5 class="name"><?php echo esc_html($testimonial['author_name']); ?></h5>
                                    <span class="building"><?php echo esc_html($settings['building_name']); ?></span>
                                </div>
                                <div class="star-rating">
                                    <?php for ($i = 0; $i < $testimonial['star_rating']; $i++): ?>
                                        ★
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
<?php
    }
}
