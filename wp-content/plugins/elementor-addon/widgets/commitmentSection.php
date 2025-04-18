<?php

class Elementor_commitmentSection extends \Elementor\Widget_Base {

    public function get_name() {
        return 'commitmentSection';
    }

    public function get_title() {
        return esc_html__('Commitment Section', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-editor-paragraph';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {

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

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <style>
            .commitment-section {
                padding: 6rem 2rem;
                background-color: #fff;
            }
            .commitment-section__container {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
}

.commitment-section__text {
    flex: 1 1 50%;
    max-width: 600px;
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
                margin-bottom: 2rem;
                margin-top: 0px
  font-family: "Inter Tight", sans-serif;
            }

            .commitment-section__button {
                border: 1px solid white;
                display: inline-flex;
                align-items: center;
                padding: 0.75rem 1.5rem;
                background: #093D5F;
                color: white;
                border-radius: 100px;
                font-size: 0.95rem;
                text-decoration: none;
                transition: background 0.3s ease;
            }
            .commitment-section__button a{
                color:white;
            }
            .commitment-section__button:hover a{
                color:black;
            }

            .commitment-section__button:hover {
                background: none;
                border: 1px solid black;
            }

            .commitment-section__button .arrow {
                margin-left: 0.5rem;
                font-size: 1.1rem;
            }

.commitment-section__image {
    flex: 1 1 40%;
    display: flex;
    justify-content: flex-end; 
}

.commitment-section__image img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    display: block;
}

            @media (max-width: 768px) {
                .commitment-section__container {
                    flex-direction: column;
                }

                .commitment-section__text, .commitment-section__image {
                    flex: 1 1 100%;
                    max-width: 100%;
                }

                .commitment-section__image {
                    margin-top: 2rem;
                }
            }
        </style>

        <section class="commitment-section">
            <div class="commitment-section__container">
                <div class="commitment-section__text">
                    <h2 class="commitment-section__title"><?php echo esc_html($settings['title']); ?></h2>
                    <p class="commitment-section__description"><?php echo esc_html($settings['description']); ?></p>
                    <?php if (!empty($settings['button_text'])) : ?>
                        <button class="commitment-section__button">
                        <a class="commitment-sectionLink" href="<?php echo esc_url($settings['button_link']['url']); ?>" target="_blank" rel="noopener">
                            <?php echo esc_html($settings['button_text']); ?>
                            <span class="arrow">→</span>
                        </a>
                        </button>
                    <?php endif; ?>
                </div>
                <div class="commitment-section__image">
                    <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="Commitment Image" />
                </div>
            </div>
        </section>

        <?php
    }
}
