<?php
class Elementor_videoTourSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'videoTourSection';
    }

    public function get_title()
    {
        return esc_html__('Video Tour Listings', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-video-camera';
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tour_title',
            [
                'label' => esc_html__('Tour Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '80 Bond - F3; 3BR',
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $repeater->add_control(
            'tour_link',
            [
                'label' => esc_html__('Tour Link', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'tours',
            [
                'label' => esc_html__('Tours', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tour_title' => '80 Bond - F3; 3BR',
                        'image' => ['url' => ''],
                        'tour_link' => ['url' => '', 'is_external' => true, 'nofollow' => true],
                    ],
                    [
                        'tour_title' => '80 Bond - F3; 3BR',
                        'image' => ['url' => ''],
                        'tour_link' => ['url' => '', 'is_external' => true, 'nofollow' => true],
                    ],
                    [
                        'tour_title' => '80 Bond - F3; 3BR',
                        'image' => ['url' => ''],
                        'tour_link' => ['url' => '', 'is_external' => true, 'nofollow' => true],
                    ],
                    [
                        'tour_title' => '80 Bond - F3; 3BR',
                        'image' => ['url' => ''],
                        'tour_link' => ['url' => '', 'is_external' => true, 'nofollow' => true],
                    ],
                ],
                'title_field' => '{{{ tour_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
    ?>
        <section class="pageWidthVT">
            <div class="tour-showcase">
                <div class="tour-grid">
                    <?php foreach ($settings['tours'] as $tour) : ?>
                        <div class="tour-card">
                            <?php if (!empty($tour['image']['url'])) : ?>
                                <a href="<?php echo esc_url($tour['tour_link']['url']); ?>" target="_blank" <?php echo $tour['tour_link']['nofollow'] ? 'rel="nofollow"' : ''; ?> class="tour-link">
                                    <div class="tour-card-image" style="background-image: url('<?php echo esc_url($tour['image']['url']); ?>');">
                                        <div class="image-overlay"></div>
                                        <div class="tour-card-text">
                                            <h5 class="tour-card-title"><?php echo esc_html($tour['tour_title']); ?></h5>
                                            <p class="tour-card-subtitle">Explore 3D space</p>
                                        </div>
                                        <svg class="play-icon" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                        </svg>
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <style>
            .pageWidthVT {
                padding: 25px 10%;
                background:#F7F9FA;

                width: 100%; 
            }
            @media screen and (max-width: 1600px) {
                .pageWidthVT {
                    padding: 25px;
                }
            }
            @media screen and (max-width: 768px) {
                .pageWidthVT {
                    padding: 15px;
                }
            }

            .pageWidthVT .tour-showcase .tour-grid {
                width: 100%; 
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
            }

            .pageWidthVT .tour-showcase .tour-card {
                border-radius: 8px;
                overflow: hidden;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                cursor: pointer;
            }

            .pageWidthVT .tour-showcase .tour-link {
                text-decoration: none;
                color: inherit;
                display: block;
            }

            .pageWidthVT .tour-showcase .tour-card-image {
                background-size: cover;
                background-position: center;
                position: relative;
                height: 300px;
                width: 100%;
            }

            .pageWidthVT .tour-showcase .image-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.3); 
            }

            .pageWidthVT .tour-showcase .tour-card-text {
                position: absolute;
                top: 66%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
                color: #FFFFFF;
                width: 100%;
                box-sizing: border-box;
            }

            .pageWidthVT .tour-showcase .tour-card-title {
                margin: 0 0 10px;
                font-weight: bold;
            }

            .pageWidthVT .tour-showcase .tour-card-subtitle {
                margin: 0;
                font-size: 0.9rem;
            }

            .pageWidthVT .tour-showcase .play-icon {
                position: absolute;
                top: 44%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 40px;
                height: 40px;
                transition: transform 0.3s ease, width 0.3s ease, height 0.3s ease;
            }

            .pageWidthVT .tour-showcase .tour-card:hover .play-icon {
                transform: translate(-50%, -50%) scale(1.2);
            }

            @media (max-width: 991px) {
                .pageWidthVT .tour-showcase .tour-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width: 576px) {
                .pageWidthVT .tour-showcase .tour-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    <?php
    }
}