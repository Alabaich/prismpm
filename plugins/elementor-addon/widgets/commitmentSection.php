<?php

class Elementor_commitmentSection extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'commitmentSection';
    }

    public function get_title()
    {
        return esc_html__('Commitment Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-editor-paragraph';
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
                'default' => 'Our Commitment To You',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'At Prism, our mission is simple — to build and maintain vibrant, safe, and welcoming communities...',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Resident Portal',
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => ['url' => '#'],
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
?>

        <style>
            .commitment-section {
                padding: 100px 80px;
                background-color: #fff;
            }

            .commitment-section__container {
                display: flex;
                align-items: stretch;
                justify-content: space-between;
                gap: 2rem;
            }

            .commitment-section__text {
                flex: 1 1 40%;
                width: 30%;
            }

            .commitment-section__title {
                font-size: 52px;
                margin-bottom: 1rem;
                color: #2A2A2A;
            }

            .commitment-section__description {
                font-size: 18px;
                max-width: 486px;
                line-height: 1.6;
                color: #52525B;
                margin-bottom: 4rem;
                margin-top: 0px;
                font-family: "Inter Tight", sans-serif;
            }

            .commitment-section__button {
                border: 1px solid white;
                display: flex;
                align-items: center;
                align-content: center;
                justify-items: center;
                padding: 0.75rem 1.5rem;
                background: #093D5F;
                color: white;
                border-radius: 100px;
                font-size: 1rem;
                text-decoration: none;
                transition: background 0.3s ease;
            }

            .commitment-section__button a {
                color: white;
            }

            .commitment-section__button:hover a {
                color: black;
            }

            .commitment-section__button:hover {
                background: none;
                border: 1px solid black;
                gap: 2rem;
            }

            .commitment-section__button .arrow {
                margin-left: 0.5rem;
                font-size: 1.1rem;
            }

            .buttonWrapper .btn {
                border: 1px solid white;
                display: inline-flex;
                align-items: center;
                padding: 0.75rem 1.5rem;
                gap: 0.75rem;
                background: #093D5F;
                color: white;
                border-radius: 100px;
                font-size: 1rem;
                text-decoration: none;
                transition: background 0.3s ease;
                transition: all 0.3s ease;
            }


            .buttonWrapper .btn:hover {
                background: transparent;
                transition: all 0.3s ease;
                border: 1px solid black;
                color: #2A2A2A;
                gap: 2rem;
            }

            .buttonWrapper:hover {
                background: transparent;
                color: #2A2A2A;
                border: black;
                transition: all 0.3s ease;
            }


            .buttonWrapper .btn svg {
                transition: all 0.3s ease;
                rotate: -45deg;
                width: 24px;
                height: 24px;
            }

            .commitment-section__image {
                flex: 1 1 40%;
                display: flex;
                justify-content: flex-end;
                width: 60%;
            }

            .commitment-section__image img {
                max-width: 100%;
                height: 100%;
                /* Изменено с auto для заполнения высоты */
                object-fit: cover;
                /* Добавлено для сохранения пропорций при height: 100% */
                border-radius: 10px;
                display: block;
            }

            @media (max-width: 768px) {
                .commitment-section__container {
                    flex-direction: column;
                    text-align: center;
                }

                .commitment-section__text {
                    width: 100%;
                }

                .commitment-section__image {
                    width: 100%;
                }

                .commitment-section__text,
                .commitment-section__image {
                    flex: 1 1 100%;
                    max-width: 100%;
                }

                .commitment-section__image {
                    margin-top: 2rem;
                }

                .commitment-section__image img {
                    /* Для мобильных возвращаем height:auto, если нужно */
                    height: auto;
                }

                .commitment-section__title {
                    font-size: 24px;
                }
            }
        </style>

        <section class="commitment-section">
            <div class="commitment-section__container">
                <div class="commitment-section__text">
                    <h2 class="commitment-section__title"><?php echo esc_html($settings['title']); ?></h2>
                    <p class="commitment-section__description"><?php echo esc_html($settings['description']); ?></p>
                    <?php
                    $button_link_actual_url = $settings['button_link']['url'] ?? '';
                    if (!empty($settings['button_text']) && !empty($button_link_actual_url)) :
                        $button_target = $settings['button_link']['is_external'] ? '_blank' : '_self';
                        $button_nofollow = $settings['button_link']['nofollow'] ? 'nofollow' : '';
                    ?>
                        <div class="buttonWrapper">
                            <a href="<?php echo esc_url($button_link_actual_url); ?>"
                                class="btn"
                                target="<?php echo esc_attr($button_target); ?>"
                                <?php if ($button_nofollow) {
                                    echo 'rel="' . esc_attr($button_nofollow) . '"';
                                } ?>>
                                <?php echo esc_html($settings['button_text']); ?>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="commitment-section__image">
                    <?php if (!empty($settings['image']['url'])) : ?>
                        <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>" />
                    <?php endif; ?>
                </div>
            </div>
        </section>

<?php
    }
}
