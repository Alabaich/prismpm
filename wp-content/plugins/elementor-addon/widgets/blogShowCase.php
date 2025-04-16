<?php

class Elementor_blogShowCase extends \Elementor\Widget_Base {

    public function get_name() {
        return 'blogShowCase';
    }

    public function get_title() {
        return esc_html__('Blog Showcase', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-posts-grid';
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
            'main_title',
            [
                'label' => esc_html__('Main Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Latest Insights And Updates From Our Blog',
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Insights, updates, and ideas to keep you ahead',
            ]
        );

        $this->add_control(
            'featured_image',
            [
                'label' => esc_html__('Featured Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'featured_title',
            [
                'label' => esc_html__('Featured Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'featured_date',
            [
                'label' => esc_html__('Featured Date', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'date',
            [
                'label' => esc_html__('Date', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'read_time',
            [
                'label' => esc_html__('Read Time', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '6 min read',
            ]
        );

        $this->add_control(
            'blog_cards',
            [
                'label' => esc_html__('Blog Cards', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <style>
            .blog-showcase {
                padding: 4rem 2rem;
                text-align: center;
            }

            .blog-showcase h1 {
                margin-bottom: 1.5rem;
            }

            .blog-showcase .subtitle {
                color: #555;
                margin-bottom: 2.5rem;
            }

            .featured-post {
                margin-bottom: 3rem;
                text-align: left;
            }

            .featured-post img {
                width: 100%;
                border-radius: 0.2rem;
                object-fit: cover;
                max-height: 350px;
            }

            .featured-post .title {
                font-size: 2rem;
                margin-top: 1rem;
                margin-bottom: 1rem;
                font-weight: 600;
            }

            .featured-post .date {
                color: #52525B;
            }

            .blog-cards {
                display: flex;
                justify-content:center;
                align-items:center;
                gap: 2rem;
                flex-wrap: wrap;
                margin-top: 2rem;
            }

            .blog-card {
                background: #F4F4F499/60;
                border-radius: 0.5rem;
                padding: 0.5rem;
                text-align: left;
                max-width: 26rem;
                box-shadow: 0 0 10px rgba(0,0,0,0.05);
            }

            .blog-card img {
                width: 100%;
                border-radius: 0.75rem;
                margin-bottom: 0.75rem;
                object-fit: cover;
            }

            .blog-card .title {
                font-size: 1.5rem;
                margin-bottom: 1rem;
            }

            .blog-card .meta {
                display:flex;
                align-items:center;
                justify-content:space-between;
                font-size: 1.125rem;
                color: #52525B;
            }

            .meta span {
                color:#909DA2;
            }
        </style>

        <div class="blog-showcase">
            <h1><?php echo esc_html($settings['main_title']); ?></h1>
            <p class="subtitle interTight"><?php echo esc_html($settings['subtitle']); ?></p>

            <?php if (!empty($settings['featured_image']['url']) || !empty($settings['featured_title'])): ?>
                <div class="featured-post">
                    <?php if (!empty($settings['featured_image']['url'])): ?>
                        <img src="<?php echo esc_url($settings['featured_image']['url']); ?>" alt="">
                    <?php endif; ?>
                    <h2 class="title"><?php echo esc_html($settings['featured_title']); ?></h2>
                    <p class="date"><?php echo esc_html($settings['featured_date']); ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($settings['blog_cards']) && is_array($settings['blog_cards'])): ?>
                <div class="blog-cards">
                    <?php foreach ($settings['blog_cards'] as $card): ?>
                        <div class="blog-card">
                            <?php if (!empty($card['image']['url'])): ?>
                                <img src="<?php echo esc_url($card['image']['url']); ?>" alt="">
                            <?php endif; ?>
                            <h3 class="title"><?php echo esc_html($card['title']); ?></h3>
                            <div class="meta">
                                <?php echo esc_html($card['date']); ?> <span><?php echo esc_html($card['read_time']); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }
}
