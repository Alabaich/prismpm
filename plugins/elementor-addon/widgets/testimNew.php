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
            'rating',
            [
                'label' => esc_html__('Rating (1-5)', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 5,
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
                        'rating' => 5,
                        'author_photo' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                    ],
                    [
                        'testimonial_text' => 'I love it! I love the high ceiling. I’m really happy with the view overlooking the park. The windows make it feel for me.',
                        'author_name' => 'Darlene and Dave',
                        'author_location' => '80 Bond',
                        'rating' => 5,
                        'author_photo' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                    ],
                    [
                        'testimonial_text' => 'If you want to live in a cool, well-designed building with friendly people, then I would say come here.',
                        'author_name' => 'Kadija and David',
                        'author_location' => '80 Bond',
                        'rating' => 5,
                        'author_photo' => ['url' => \Elementor\Utils::get_placeholder_image_src()],
                    ],
                    [
                        'testimonial_text' => '80 Bond has truly become our forever home. We’ve made so many wonderful friends here, and the sense of community is simply outstanding.',
                        'author_name' => 'Ellen and Barrie',
                        'author_location' => '80 Bond',
                        'rating' => 5,
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
            .pageWidthTestim {
                width: 100%;
                padding: 25px 10%;
            }

            @media screen and (max-width: 1600px) {
                .pageWidthTestim {
                    width: 100%;
                    padding: 25px;
                }
            }

            @media screen and (max-width: 768px) {
                .pageWidthTestim {
                    width: 100%;
                    padding: 15px;
                }
            }

            .testimonial-unique {
                background-color: <?php echo esc_attr($settings['background_color']); ?>;
                color: #fff;
                text-align: center;
                display: flex;
                flex-direction: column;
                gap: 50px;
            }

            .testimonial-unique .titleContainer {
                display: flex;
                flex-direction: column;
                gap: 25px;
            }

            .testimonial-unique .title-block {
                font-weight: 600;
                margin: 0;
                color: #fff;
            }

            .testimonial-unique .subtitle-block {
                color: #FFFFFFCC;
                font-weight: 400;
                margin: 0;
                margin-bottom: 0;
                line-height: 1.6;
            }

            .testimonial-unique .grid-layout {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(15.625rem, 1fr));
                gap: 20px;
                margin: 0 auto;
                width: 90%;
            }

            .testimonial-unique .card-item {
                color: #fff;
                border-radius: 4px;
                text-align: left;
                display: flex;
                flex-direction: column;
                gap: 25px;
                justify-content: flex-start;
                font-family: "Inter Tight", sans-serif;
            }

            .testimonial-unique .card-item>img {
                width: 100%;
                height: 250px;
                object-fit: cover;
            }

            .testimonial-unique .card-item p {
                margin: 0;
                font-family: Playfair Display;
                font-weight: 400;
                font-size: 1rem;
                flex-grow: 1;
            }

            .testimonial-unique .author-details {
                display: flex;
                align-items: center;
                gap: 0.625rem;
            }

            .testimonial-unique .author-info {
                display: flex;
                flex-direction: column;
            }

            .testimonial-unique .author-info .name {
                font-family: 'Playfair Display', serif;
                font-weight: 500;
                font-size: 1.25rem;
                line-height: 120%;
                letter-spacing: 0%;
            }

            .testimonial-unique .author-info .loc {
                font-family: 'Playfair Display', serif;
                font-weight: 400;
                font-size: 0.875rem;
                letter-spacing: 0%;
                color: #FFFFFFCC;
            }

            .testimonial-unique .star-rating span {
                margin-right: 2px;
                vertical-align: middle;
            }

            .testimonial-unique .card-item .opening-quote {
                font-family: 'Playfair Display', serif;
                font-weight: 600;
                font-size: 2.25rem;
                line-height: 0.5;
                letter-spacing: 0%;
                text-transform: capitalize;
                float: left;
                margin-right: 4px;
            }

            .testimonial-unique .card-item .closing-quote {
                font-family: 'Playfair Display', serif;
                font-weight: 600;
                font-size: 30px;
                line-height: 0.5;
                letter-spacing: 0%;
            }

            @media (max-width: 768px) {
                .testimonial-unique .title-block {
                    font-family: Playfair Display;
                    font-weight: 600;
                    font-size: 24px;
                    text-align: center;
                    vertical-align: middle;
                    text-transform: capitalize;
                }

                .testimonial-unique {
                    gap: 20px;
                }

                .testimonial-unique .titleContainer {
                    gap: 15px;
                }

                .testimonial-unique .subtitle-block {
                    font-family: Playfair Display;
                    font-weight: 400;
                    font-size: 14px;
                    text-align: center;
                }

                .testimonial-unique .card-item {
                    color: #fff;
                    text-align: left;
                    display: flex;
                    flex-direction: column;
                    gap: 15px;
                    justify-content: flex-start;
                    font-family: "Inter Tight", sans-serif;
                }
            }

            @media (min-width: 768px) and (max-width: 1024px) {
                .testimonial-unique .grid-layout {
                    grid-template-columns: repeat(2, 1fr);
                }
            }
        </style>

        <div class="testimonial-unique pageWidthTestim">

            <div class="titleContainer">
                <h1 class="title-block"><?php echo esc_html($settings['section_title']); ?></h1>
                <p class="subtitle-block"><?php echo esc_html($settings['section_subtitle']); ?></p>
            </div>


            <div class="grid-layout">
                <?php foreach ($settings['testimonials'] as $testimonial): ?>
                    <div class="card-item">
                        <img src="<?php echo esc_url($testimonial['author_photo']['url']); ?>" alt="<?php echo esc_attr($testimonial['author_name']); ?>" />

                        <p><span class="opening-quote">“</span><?php echo esc_html($testimonial['testimonial_text']); ?><span class="closing-quote">”</span></p>

                        <div class="author-details">
                            <div class="author-info">
                                <span class="name"><?php echo esc_html($testimonial['author_name']); ?></span>
                                <span class="loc"><?php echo esc_html($testimonial['author_location']); ?></span>
                            </div>
                        </div>

                        <div class="star-rating">
                            <?php
                            $rating = !empty($testimonial['rating']) ? (int)$testimonial['rating'] : 0;
                            for ($i = 1; $i <= 5; $i++):
                                if ($i <= $rating): ?>
                                    <span class="star-filled">
                                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.241 1.4441C8.57978 0.401446 10.0549 0.401447 10.3936 1.4441L11.6041 5.16944C11.7556 5.63573 12.1901 5.95143 12.6804 5.95143H16.5974C17.6938 5.95143 18.1496 7.35431 17.2626 7.9987L14.0937 10.3011C13.697 10.5893 13.5311 11.1001 13.6826 11.5664L14.893 15.2917C15.2318 16.3344 14.0384 17.2014 13.1515 16.557L9.98252 14.2546C9.58587 13.9664 9.04877 13.9664 8.65212 14.2546L5.48315 16.557C4.59622 17.2014 3.40286 16.3344 3.74164 15.2917L4.95208 11.5664C5.10358 11.1001 4.93761 10.5893 4.54096 10.3011L1.37199 7.9987C0.485062 7.35431 0.940886 5.95143 2.03719 5.95143H5.95425C6.44454 5.95143 6.87906 5.63573 7.03057 5.16944L8.241 1.4441Z" fill="#FEE547" />
                                        </svg>
                                    </span>
                                <?php else: ?>
                                    <span class="star-empty">
                                        <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8.241 1.4441C8.57978 0.401446 10.0549 0.401447 10.3936 1.4441L11.6041 5.16944C11.7556 5.63573 12.1901 5.95143 12.6804 5.95143H16.5974C17.6938 5.95143 18.1496 7.35431 17.2626 7.9987L14.0937 10.3011C13.697 10.5893 13.5311 11.1001 13.6826 11.5664L14.893 15.2917C15.2318 16.3344 14.0384 17.2014 13.1515 16.557L9.98252 14.2546C9.58587 13.9664 9.04877 13.9664 8.65212 14.2546L5.48315 16.557C4.59622 17.2014 3.40286 16.3344 3.74164 15.2917L4.95208 11.5664C5.10358 11.1001 4.93761 10.5893 4.54096 10.3011L1.37199 7.9987C0.485062 7.35431 0.940886 5.95143 2.03719 5.95143H5.95425C6.44454 5.95143 6.87906 5.63573 7.03057 5.16944L8.241 1.4441Z" fill="#e1e1e1" />
                                        </svg>
                                    </span>
                            <?php endif;
                            endfor;
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

<?php
    }
}
