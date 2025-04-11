<?php

class Elementor_aboutUs extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'aboutUs';
    }

    public function get_title()
    {
        return esc_html__('About Us Container', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-slider-3d';
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
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Enter title', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Enter subtitle', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'regular_text',
            [
                'label' => esc_html__('Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => '',
                'placeholder' => esc_html__('Enter text with formatting', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $has_text_content = !empty($settings['title']) || !empty($settings['subtitle']) || !empty($settings['regular_text']);
        $has_image = !empty($settings['image']['url']);

        if (!$has_text_content && !$has_image) {
            return;
        }
?>

        <style>
            .about-us-container {
                display: flex;
                gap: 50px;
                align-items: stretch;
            }

            .about-us-text {
                width: 60%;
                background-color: #093D5F;
                color: #fff;
                padding: 0 5%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                gap: 20px;
            }

            .about-us-text h2,
            .about-us-text h3,
            .about-us-text p {
                margin: 0 0;
            }

            .about-us-image {
                width: 40%;
            }

            .about-us-image img {
                width: 100%;
                height: auto;
            }

            @media screen and (max-width: 768px) {
                .about-us-container {
                    display: flex;
                    gap: 0px;
                    align-items: stretch;
                    flex-direction: column;
                }

                .about-us-text {
                    width: 100%;
                    padding-bottom: 50px;
                    padding-top: 50px;
                }

                .about-us-image {
                    width: 100%;
                }
            }

            @media screen and (max-width: 1268px) {
                .about-us-container {
                    gap: 20px;
                }

                .about-us-text {
                    width: 50%;
                    padding: 5%;
                }

                .about-us-image {
                    width: 50%;
                }

                .about-us-image img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
            }
        </style>

        <div class="about-us-container">
            <?php if ($has_text_content) : ?>
                <div class="about-us-text">
                    <?php if (!empty($settings['title'])) : ?>
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($settings['subtitle'])) : ?>
                        <h3><?php echo esc_html($settings['subtitle']); ?></h3>
                    <?php endif; ?>

                    <?php if (!empty($settings['regular_text'])) : ?>
                        <div><?php echo $settings['regular_text']; ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($has_image) : ?>
                <div class="about-us-image">
                    <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="">
                </div>
            <?php endif; ?>
        </div>

<?php
    }
}

?>