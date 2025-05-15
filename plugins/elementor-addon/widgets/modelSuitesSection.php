<?php

class Elementor_modelSuitesSection extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'modelSuitesSection';
    }

    public function get_title()
    {
        return esc_html__('Model Suites Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-posts-grid';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('section_content', [
            'label' => esc_html__('Content', 'elementor-addon'),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('section_title', [
            'label'   => esc_html__('Section Title', 'elementor-addon'),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => 'Model Suites',
        ]);

        $this->add_control('show_more_text', [
            'label'   => esc_html__('Show More Button Text', 'elementor-addon'),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => 'Show More',
        ]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('image', [
            'label' => esc_html__('Image', 'elementor-addon'),
            'type'  => \Elementor\Controls_Manager::MEDIA,
        ]);

        $repeater->add_control('title', [
            'label'   => esc_html__('Title', 'elementor-addon'),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => '1 Bed Loft In Downtown Peterborough',
        ]);

        $repeater->add_control('price', [
            'label'   => esc_html__('Price ($)', 'elementor-addon'),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => '2,250',
        ]);

        $repeater->add_control('status', [
            'label'   => esc_html__('Availability Status', 'elementor-addon'),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => 'available',
        ]);

        $repeater->add_control('tags', [
            'label'   => esc_html__('Tags (comma separated)', 'elementor-addon'),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => '1 bedroom, 1 bathroom, Pet-friendly',
        ]);

        $repeater->add_control('button_text', [
            'label'   => esc_html__('Button Text', 'elementor-addon'),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => 'View Apartment',
        ]);

        $repeater->add_control('button_link', [
            'label' => esc_html__('Button Link', 'elementor-addon'),
            'type'  => \Elementor\Controls_Manager::URL,
        ]);

        $this->add_control('suites_list', [
            'label'   => esc_html__('Suites', 'elementor-addon'),
            'type'    => \Elementor\Controls_Manager::REPEATER,
            'fields'  => $repeater->get_controls(),
            'default' => [],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>

        <style>
            .model-suites {
                padding: 2rem 0rem;
                padding-bottom: 6rem;
                font-family: "Inter Tight", sans-serif;
            }

            .suites-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 4.5rem;
            }

            .suites-header h2 {
                font-size: 52px;
                margin: 0;
            }

            .show-moreq {
                padding: 20px 28px;
                font-family: "Inter Tight", sans-serif;
                font-weight: 500;
                border: 1px solid #000;
                background: white;
                border-radius: 999px;
                cursor: pointer;
                color: #2A2A2A;
                display: flex;
                align-items: center;
                gap: 0rem 1rem;
                transition: transform 0.3s ease, gap 0.3s ease;
            }

            .show-moreq svg {
                transition: transform 0.3s ease;
            }

            .show-moreq:hover {
                background: white;
                color: #2A2A2A;
                gap: 0rem 2rem;
            }

            .show-moreq:hover svg {
                transform: translateX(16px);
            }

            .suites-grid {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 2rem;
            }

            .suite-card {
                width: calc((100% - 4rem) / 3);
                border: 1px solid #2A2A2A;
                border-radius: 1rem;
                overflow: hidden;
                background: white;
                display: flex;
                flex-direction: column;
                transition: box-shadow 0.2s ease;
                box-sizing: border-box;
            }

            .suite-card:hover {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }

            .suite-card img {
                border-bottom-left-radius: 1rem;
                border-bottom-right-radius: 1rem;
                width: 100%;
                height: 300px;
                object-fit: cover;
            }

            .suite-content {
                padding: 1.25rem;
                display: flex;
                flex-direction: column;
                flex-grow: 1;
            }

            .suite-title-price {
                display: flex;
                justify-content: space-between;
                align-items: start;
                gap: 1rem;
            }

            .suite-title-price h3 {
                font-size: 28px;
                margin: 0;
                max-width: 280px;
            }

            .price {
                font-weight: 600;
                color: #2A2A2A;
                font-family: "Darker Grotesque", sans-serif;
                font-size: 28px;
                white-space: nowrap;
            }

            .price span {
                font-family: "Inter Tight", sans-serif;
                display: block;
                font-size: 12px;
                color: #6B7280;
                text-align: end;
            }

            .boldichenko {
                font-size: 24px;
                color: #10B981;
                line-height: 1;
            }

            .suite-availability {
                display: flex;
                align-items: center;
                gap: 0 2px;
                font-size: 14px;
                color: #2A2A2A;
                margin-bottom: 0.5rem;
            }

            .suite-availability .status {}

            .suite-availability .status.available {}

            .suite-tags {
                display: flex;
                flex-wrap: wrap;
                padding-bottom: 40px;
                max-width: 380px;
                gap: 0.5rem 1rem;
                font-size: 14px;
                font-weight: 500;
                color: #2A2A2A;
            }

            .askI {
                display: inline-flex;
                align-items: center;
            }

            .askI i {
                font-size: 26px;
                margin-right: 0.3rem;
            }

            .suite-details {
                font-size: 14px;
                color: #6B7280;
            }

            .suite-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: auto;
            }

            .btn-primary {
                background-color: #0F3D5F;
                color: white;
                padding: 18px 32px;
                border-radius: 999px;
                text-decoration: none;
                font-size: 14px;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                transition: opacity 0.3s ease, background-color 0.3s ease;
            }

            .btn-primary:hover {
                opacity: 0.9;
                color: white;
            }

            .wishlist {
                padding: 0;
                background: none;
                border: none;
                font-size: 40px;
                color: black;
                cursor: pointer;
                transition: color 0.3s ease;
            }

            .wishlist:hover {
                color: red;
                background: none;
            }

            @media (max-width: 1024px) {
                .suite-card {}

                .suites-header h2 {
                    font-size: 44px;
                }

                .suite-title-price h3 {
                    font-size: 24px;
                    max-width: 220px;
                }

                .price {
                    font-size: 24px;
                }
            }

            @media (max-width: 767px) {
                .suites-header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 1.5rem;
                    margin-bottom: 3rem;
                }

                .suites-header h2 {
                    font-size: 36px;
                }

                .show-moreq {
                    padding: 16px 24px;
                    font-size: 15px;
                }

                .suite-card {
                    width: 100%;
                    margin-bottom: 2rem;
                }

                .suite-card img {
                    height: 250px;
                }

                .suite-title-price h3 {
                    font-size: 22px;
                    max-width: none;
                }

                .price {
                    font-size: 22px;
                }

                .suite-tags {
                    padding-bottom: 20px;
                    max-width: 100%;
                }

                .askI i {
                    font-size: 22px;
                }

                .btn-primary {
                    padding: 16px 28px;
                    font-size: 13px;
                }

                .wishlist {
                    font-size: 36px;
                }
            }

            @media (max-width: 480px) {
                .suites-header h2 {
                    font-size: 30px;
                }

                .show-moreq {
                    width: 100%;
                    justify-content: center;
                }

                .suite-card img {
                    height: 220px;
                }

                .suite-title-price {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 0.5rem;
                }

                .suite-title-price h3 {
                    font-size: 20px;
                }

                .price {
                    font-size: 20px;
                    text-align: left;
                }

                .price span {
                    text-align: left;
                }

                .suite-footer {
                    flex-direction: column;
                    align-items: stretch;
                    gap: 1rem;
                }

                .btn-primary {
                    width: 100%;
                    justify-content: center;
                }

                .wishlist {
                    align-self: center;
                }
            }
        </style>

        <section class="model-suites">
            <div class="suites-header">
                <h2><?php echo esc_html($settings['section_title']); ?></h2>
                <?php
                if (!empty($settings['show_more_text'])) : ?>
                    <button class="show-moreq">
                        <?php echo esc_html($settings['show_more_text']); ?>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="hero-button-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                <?php endif; ?>
            </div>

            <div class="suites-grid">
                <?php foreach ($settings['suites_list'] as $key => $suite) : ?>
                    <div class="suite-card elementor-repeater-item-<?php echo esc_attr($suite['_id']); ?>">
                        <?php if (!empty($suite['image']['url'])) : ?>
                            <img src="<?php echo esc_url($suite['image']['url']); ?>" alt="<?php echo esc_attr($suite['title']); // Используем заголовок как alt 
                                                                                            ?>">
                        <?php endif; ?>
                        <div class="suite-content">
                            <div class="suite-title-price">
                                <h3><?php echo esc_html($suite['title']); ?></h3>
                                <div class="price">$<?php echo esc_html($suite['price']); ?> <span>month</span></div>
                            </div>
                            <div class="suite-availability">
                                <span class="boldichenko">●</span><span class="status available"><?php echo esc_html($suite['status']); ?></span>
                            </div>
                            <div class="suite-tags">
                                <?php
                                if (!empty($suite['tags'])) {
                                    $tags = explode(',', $suite['tags']);
                                    $icons = [
                                        '1 bedroom' => 'fa fa-bed',
                                        '1 bathroom' => 'fa fa-bath',
                                        'Pet-friendly' => 'fa fa-paw',
                                        '547.45' => 'fa fa-square',
                                    ];
                                    foreach ($tags as $tag_raw) {
                                        $tag = trim($tag_raw);
                                        if (empty($tag)) continue;
                                        $icon_class = isset($icons[$tag]) ? $icons[$tag] : '';
                                        echo '<span class="askI">';
                                        if (!empty($icon_class)) {
                                            echo '<i class="' . esc_attr($icon_class) . '"></i> ';
                                        }
                                        echo esc_html($tag) . '</span>';
                                    }
                                }
                                ?>
                            </div>
                            <div class="suite-footer">
                                <?php if (!empty($suite['button_link']['url']) && !empty($suite['button_text'])) :
                                    $target = $suite['button_link']['is_external'] ? ' target="_blank"' : '';
                                    $nofollow = $suite['button_link']['nofollow'] ? ' rel="nofollow"' : '';
                                ?>
                                    <a class="btn-primary" href="<?php echo esc_url($suite['button_link']['url']); ?>" <?php echo $target . $nofollow; ?>>
                                        <?php echo esc_html($suite['button_text']); ?> <span>&rarr;</span>
                                    </a>
                                <?php endif; ?>
                                <button class="wishlist">♡</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

<?php
    }
}
