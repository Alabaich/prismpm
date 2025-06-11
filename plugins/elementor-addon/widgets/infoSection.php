<?php
class Elementor_infoSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'infoSection';
    }

    public function get_title()
    {
        return esc_html__('Did You Know?', 'elementor-addon');
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
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Did You Know?',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Oshawa is home to the Canadian Automotive Museum, celebrating the city\'s rich automotive heritage as the "Automotive Capital of Canada."',
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $image_url = $settings['image']['url'];
?>
        <section class="did-you-know-section">
            <div class="pageWidthinf ff">
                <div class="did-you-know__content">
                    <h1 class="did-you-know__title"><?php echo esc_html($settings['title']); ?></h1>
                    <p class="did-you-know__description"><?php echo esc_html($settings['description']); ?></p>
                </div>
                <?php if (!empty($image_url)) : ?>
                    <div class="did-you-know__image" style="background-image: url('<?php echo esc_url($image_url); ?>');"></div>
                <?php endif; ?>
            </div>
        </section>

        <style>
            .did-you-know-section {
                background-color: #F5F7FA;
                display: flex;
                align-items: center;
                gap: 20px;
            }
.did-you-know__content {
    display: flex;
    flex-direction:column;
    justify-content:center;
}
            .ff {
                display:flex;
                justify-content:space-between;
            }

            .pageWidthinf {
                width: 100%;
                padding: 25px 10%;
            }

            @media screen and (max-width: 1600px) {
                .pageWidthinf {
                    width: 100%;
                    padding: 25px;
                }
            }

            @media screen and (max-width: 768px) {
                .pageWidthinf {
                    width: 100%;
                    padding: 15px;
                }
            }

            .did-you-know__title {
                margin: 0 0 2rem;
                color:black;
                font-weight:600;
            }

            .did-you-know__description {
                font-size: 1.375rem;
                color:#52525B;
                max-width:500px;
                margin: 0;
            }

            .did-you-know__image {
                background-size: cover;
                width: 600px;
                height: 380px;
            }
        </style>
<?php
    }
}