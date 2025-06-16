<?php
class Elementor_testimNew extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'testimNew';
    }

    public function get_title()
    {
        return esc_html__('testimNew', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-comments';
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
            'section_subtitle',
            [
                'label' => esc_html__('Section Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'testimonial_text',
            [
                'label' => esc_html__('Testimonial Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'This is a sample testimonial.',
            ]
        );

        $repeater->add_control(
            'author_name',
            [
                'label' => esc_html__('Author Name', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'John Doe',
            ]
        );

        $repeater->add_control(
            'author_location',
            [
                'label' => esc_html__('Location', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '80 Bond',
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

        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__('Testimonials', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'testimonial_text' => 'We absolutely love living here! The management and maintenance team are not only friendly and welcoming, they are present and responsive throughout the year. It truly feels like home.',
                        'author_name' => 'Warren and Lorraine',
                        'author_location' => '80 Bond',
                        'author_photo' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                    ],
                    [
                        'testimonial_text' => 'I love it! I love the high ceiling. I’m really happy with the view overlooking the park. The windows make it feel for me.',
                        'author_name' => 'Darlene and Dave',
                        'author_location' => '80 Bond',
                        'author_photo' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                    ],
                    [
                        'testimonial_text' => 'If you want to live in a cool, well-designed building with friendly people, then I would say come here.',
                        'author_name' => 'Kadija and David',
                        'author_location' => '80 Bond',
                        'author_photo' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                    ],
                    [
                        'testimonial_text' => '80 Bond has truly become our forever home. We’ve made so many wonderful friends here, and the sense of community is simply outstanding.',
                        'author_name' => 'Ellen and Barrie',
                        'author_location' => '80 Bond',
                        'author_photo' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                    ],
                ],
                'title_field' => '{{{ author_name }}}',
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__('Background Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#093D5F',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>

        <style>
                                                            .pageWidthTestim{
    width: 100%;
    padding: 25px 10%;
}
@media screen and (max-width: 1600px) {
 .pageWidthTestim{
  width: 100%;
  padding: 25px;
}
}
@media screen and (max-width: 768px) {
 .pageWidthTestim{
  width: 100%;
  padding: 15px;
}
}
            .testimonial-unique {
                background-color: <?php echo esc_attr($settings['background_color']); ?>;
                color: #fff;
                text-align: center;
            }

            .testimonial-unique .title-block {
                font-weight: 600;
                margin-bottom: 0.75rem;
                color: #fff;
            }

            .testimonial-unique .subtitle-block {
                color: #E0E0E0;
                font-weight: 400;
                margin: 0;
                margin-bottom: 1.5rem;
                line-height: 1.6;
            }

            .testimonial-unique .grid-layout {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(15.625rem, 1fr));
                gap: 1.875rem;
                margin: 0 auto;
                width: 90%;
            }

            .testimonial-unique .card-item {
                background: #fff;
                color: #2a2a2a;
                border-radius: 4px;
                padding: 1.625rem;
                text-align: left;
                box-shadow: 0 0.3125rem 0.9375rem rgba(0, 0, 0, 0.1);
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                font-family: "Inter Tight", sans-serif;
            }

            .testimonial-unique .card-item p {
                font-family: "Inter Tight", sans-serif;
                font-size: 1rem;
                margin-bottom: 3.5rem;
                margin-top: 0;
            }

            .testimonial-unique .author-details {
                display: flex;
                align-items: center;
                gap: 0.625rem;
            }

            .testimonial-unique .author-details img {
                width: 3rem;
                height: 3rem;
                border-radius: 50%;
                object-fit: cover;
            }

            .testimonial-unique .author-info {
                display: flex;
                flex-direction: column;
            }

            .testimonial-unique .author-info .name {
                font-size: 1rem;
            }

            .testimonial-unique .author-info .loc {
                font-size: 0.875rem;
                color: #666;
            }

            @media (max-width: 768px) {
                .testimonial-unique .title-block {
                    font-weight: 600;
                    line-height: 90%;
                    letter-spacing: 0%;
                    text-align: center;
                    vertical-align: middle;
                    color: white;
                    margin-bottom: 0.75rem;
                }
            }

            @media (min-width: 768px) and (max-width: 1024px) {
                .testimonial-unique .grid-layout {
                    grid-template-columns: repeat(2, 1fr);
                }
            }
        </style>

        <div class="testimonial-unique pageWidthTestim">
            <h1 class="title-block"><?php echo esc_html($settings['section_title']); ?></h1>
            <p class="subtitle-block"><?php echo esc_html($settings['section_subtitle']); ?></p>

            <div class="grid-layout">
                <?php foreach ($settings['testimonials'] as $testimonial): ?>
                    <div class="card-item">
                        <p><?php echo esc_html($testimonial['testimonial_text']); ?></p>
                        <div class="author-details">
                            <img src="<?php echo esc_url($testimonial['author_photo']['url']); ?>" alt="<?php echo esc_attr($testimonial['author_name']); ?>" />
                            <div class="author-info">
                                <span class="name"><?php echo esc_html($testimonial['author_name']); ?></span>
                                <span class="loc"><?php echo esc_html($testimonial['author_location']); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

<?php
    }
}