<?php

class Elementor_modelSuitesSection extends \Elementor\Widget_Base {

    public function get_name() {
        return 'modelSuitesSection';
    }

    public function get_title() {
        return esc_html__('Model Suites Section', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {
        $this->start_controls_section('section_content', [
            'label' => esc_html__('Content', 'elementor-addon'),
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('section_title', [
            'label' => esc_html__('Section Title', 'elementor-addon'),
            'type'  => \Elementor\Controls_Manager::TEXT,
            'default' => 'Model Suites',
        ]);

        $this->add_control('show_more_text', [
            'label' => esc_html__('Show More Button Text', 'elementor-addon'),
            'type'  => \Elementor\Controls_Manager::TEXT,
            'default' => 'Show More',
        ]);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control('image', [
            'label' => esc_html__('Image', 'elementor-addon'),
            'type'  => \Elementor\Controls_Manager::MEDIA,
        ]);

        $repeater->add_control('title', [
            'label' => esc_html__('Title', 'elementor-addon'),
            'type'  => \Elementor\Controls_Manager::TEXT,
            'default' => '1 Bed Loft In Downtown Peterborough',
        ]);

        $repeater->add_control('price', [
            'label' => esc_html__('Price ($)', 'elementor-addon'),
            'type'  => \Elementor\Controls_Manager::TEXT,
            'default' => '2,250',
        ]);

        $repeater->add_control('status', [
            'label' => esc_html__('Availability Status', 'elementor-addon'),
            'type'  => \Elementor\Controls_Manager::TEXT,
            'default' => 'available',
        ]);

        $repeater->add_control('tags', [
            'label' => esc_html__('Tags (comma separated)', 'elementor-addon'),
            'type'  => \Elementor\Controls_Manager::TEXT,
            'default' => '1 bedroom, 1 bathroom, Pet-friendly',
        ]);

        $repeater->add_control('button_text', [
            'label' => esc_html__('Button Text', 'elementor-addon'),
            'type'  => \Elementor\Controls_Manager::TEXT,
            'default' => 'View Apartment',
        ]);

        $repeater->add_control('button_link', [
            'label' => esc_html__('Button Link', 'elementor-addon'),
            'type'  => \Elementor\Controls_Manager::URL,
        ]);

        $this->add_control('suites_list', [
            'label' => esc_html__('Suites', 'elementor-addon'),
            'type'  => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [],
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <section class="model-suites">
            <div class="suites-header">
                <h2><?php echo esc_html($settings['section_title']); ?></h2>
                <button class="show-moreq"><?php echo esc_html($settings['show_more_text']); ?></button>
            </div>

            <div class="suites-grid">
                <?php foreach ($settings['suites_list'] as $suite) : ?>
                    <div class="suite-card">
                        <?php if (!empty($suite['image']['url'])) : ?>
                            <img src="<?php echo esc_url($suite['image']['url']); ?>" alt="Suite Image">
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
                                    $tags = explode(',', $suite['tags']);
                                    $icons = [
                                        '1 bedroom' => 'fa fa-bed',
                                        '1 bathroom' => 'fa fa-bath',
                                        'Pet-friendly' => 'fa fa-paw',
                                        '547.45' => 'fa fa-square',
                                    ];
                                    foreach ($tags as $tag_raw) {
                                        $tag = trim($tag_raw);
                                        $icon_class = isset($icons[$tag]) ? $icons[$tag] : '';
                            
                                        echo '<span class="askI"><i class="' . esc_attr($icon_class) . '"></i> ' . esc_html($tag) . '</span>';
                                    }
                                ?>
                            </div>
                            <div class="suite-footer">
                                <?php if (!empty($suite['button_link']['url'])) : ?>
                                    <a class="btn-primary" href="<?php echo esc_url($suite['button_link']['url']); ?>">
                                        <?php echo esc_html($suite['button_text']); ?> <span>→</span>
                                    </a>
                                <?php endif; ?>
                                <button class="wishlist">♡</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <style>
            .model-suites {
                padding: 2rem 0rem;
                padding-bottom:6rem;
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
                padding: 20px 58px;
                border: 1px solid #000;
                background: white;
                border-radius: 999px;
                cursor: pointer;
                color:#2A2A2A;
            }
            .show-moreq:hover {
                background:#0e3c55;
                color:white;
            }

            .suites-grid {
                display: flex;
                flex-wrap:wrap;
                justify-content:center;
                gap: 2rem;
            }

            .suite-card {
                width:fit-content;
                border: 1px solid #2A2A2A;
                border-radius: 1rem;
                overflow: hidden;
                background: white;
                display: flex;
                flex-direction: column;
                transition: box-shadow 0.2s ease;
            }

            .suite-card:hover {
                box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            }

            .suite-card img {
                border-bottom-left-radius: 1rem;
                border-bottom-right-radius: 1rem;
                width: 458px;
                height: 300px;
                object-fit: cover;
            }

            .suite-content {
                padding: 1.25rem;
                display: flex;
                flex-direction: column;
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
                max-width:280px;
            }

            .price {
                font-weight: 600;
                color:#2A2A2A;
                font-family: "Darker Grotesque", sans-serif;
                font-size: 28px;
            }
            .price span {
                font-family: "Inter Tight", sans-serif;
                display: block;
                font-size: 12px;
                color: #6B7280;
                text-align:end;
            }


            .boldichenko {
                font-size:24px;
                color: #10B981;
            
            }
            .suite-availability {
                display:flex;
                align-items:center;
                gap:0 2px;
                font-size: 14px;
                color:#2A2A2A;
            }

            .suite-tags {
                display: flex;
                padding-bottom:40px;
                max-width:380px;
                gap: 1rem;
                flex-wrap: wrap;
                font-size: 14px;
                font-weight:500;
                color: #2A2A2A;
            }
            .askI i {
                font-size:26px;
            }

            .suite-details {
                font-size: 14px;
                color: #6B7280;
            }

            .suite-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
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
            }

            .btn-primary:hover {
                opacity:1;
                color:white;
            }

            .wishlist {
                padding:0;
                background: none;
                border: none;
                font-size: 40px;
                color: black;
                cursor: pointer;
            }
            .wishlist:hover {
                color:red;
                background:none;
            }
        </style>

        <?php
    }
}
