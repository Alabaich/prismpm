<?php

class Elementor_singleBlogPost extends \Elementor\Widget_Base {

    public function get_name() {
        return 'singleBlogPost';
    }

    public function get_title() {
        return esc_html__('Single Blog Post', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-single-post';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {
        $this->start_controls_section('section_content', [
            'label' => esc_html__('Content', 'elementor-addon'),
        ]);

        $this->add_control('post_title', [
            'label' => esc_html__('Post Title', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Pros & Cons Of Long-Term Leases: A Complete Guide',
        ]);

        $this->add_control('read_time', [
            'label' => esc_html__('Read Time', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '4 min read',
        ]);

        $this->add_control('post_date', [
            'label' => esc_html__('Date', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'June 2025',
        ]);

        $this->add_control('main_image', [
            'label' => esc_html__('Main Image', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::MEDIA,
        ]);

        // Repeater 1: Recent News
        $repeater = new \Elementor\Repeater();
        $repeater->add_control('news_title', [
            'label' => esc_html__('Title', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);
        $repeater->add_control('news_date', [
            'label' => esc_html__('Date', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);
        $this->add_control('recent_news', [
            'label' => esc_html__('Recent News Items', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ news_title }}}',
        ]);

        // Repeater 2: Advantages Of Long-Term Leases
        $advantages_repeater = new \Elementor\Repeater();
        $advantages_repeater->add_control('advantage_title', [
            'label' => esc_html__('Advantage Title', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);
        $advantages_repeater->add_control('advantage_description', [
            'label' => esc_html__('Description', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
        ]);
        $this->add_control('advantages_title', [
            'label' => esc_html__('Advantages Section Title', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => 'Advantages Of Long-Term Leases',
        ]);
        $this->add_control('advantages', [
            'label' => esc_html__('Advantages Items', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $advantages_repeater->get_controls(),
            'title_field' => '{{{ advantage_title }}}',
        ]);

        // Repeater 3: Key Considerations
        $consideration_item_repeater = new \Elementor\Repeater();
        $consideration_item_repeater->add_control('consideration_item_title', [
            'label' => esc_html__('Item Title', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);
        $consideration_item_repeater->add_control('consideration_item_description', [
            'label' => esc_html__('Item Description', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
        ]);

        $this->add_control('considerations_title', [
            'label' => esc_html__('Considerations Section Title', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
        ]);

        $this->add_control('considerations_description', [
            'label' => esc_html__('Considerations Description', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
        ]);

        $this->add_control('consideration_items', [
            'label' => esc_html__('Consideration Items', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $consideration_item_repeater->get_controls(),
            'title_field' => '{{{ consideration_item_title }}}',
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <style>
            .blog-single {
                display: grid;
                grid-template-columns: 3fr 1fr;
                gap: 3rem;
                padding: 2rem;
                padding-top: 6rem;
            }

            .blog-main h1 {
                margin-bottom: 1.5rem;
            }

            .blog-meta {
                color: #909DA2;
                margin-bottom: 1.5rem;
            }

            .blog-main img {
                width: 100%;
                border-radius: 0.5rem;
                object-fit: cover;
            }

            .blog-content {
                font-size: 1.05rem;
                line-height: 1.8;
            }

            .blog-content h2, .blog-content h3 {
                margin-top: 2rem;
                margin-bottom: 1rem;
            }

            .sidebar {
                border: 1px solid #e5e7eb;
                border-radius: 1rem;
                background: #fafafa;
                max-height:fit-content;
            }

            .sidebar h3 {
                border-bottom: 2px solid #E6E9EA;
                padding: 1.25rem;
                margin:0rem;
            }

            .recent-post {
                padding: 1.5rem;
                border-bottom: 2px solid #E6E9EA
            }
            .recent-post:last-child {
                border-bottom: none;
            }

            .recent-post-title {
                font-weight: 600;
                margin-bottom: 0.25rem;
            }

            .recent-post-date {
                color: #909DA2;
                font-size: 0.875rem;
            }

            .advantage-block, .consideration-block {
                margin-top: 2rem;
            }
            .consideration-block p{
                font-family: "Inter Tight", sans-serif;
                font-size: 1rem;
            }

            .advantage-block h2, .consideration-block h2 {
                margin-bottom: 1.5rem;
            }

            .advantage-item, .consideration-item {
                margin-bottom: 1.25rem;
            }

            .consideration-item {
                display:flex;
                align-items:baseline;
                justify-content:center;
                margin:0rem;
                gap:0 0.2rem;
            }
            .consideration-item p{
                margin:0rem;

            }

            .advantage-item h3, .consideration-item h6 {
                font-family: "Inter Tight", sans-serif;
                font-size: 1.38rem;
                margin-bottom: 0.5rem;
                color:#22282B;
                font-weight:400;
            }
            .consideration-item h6 {
                font-size: 1rem;
                font-family: "Inter Tight", sans-serif;
                text-align:center;
                min-width: fit-content;;
                color:#000000;
                margin:0rem;
            }

            .advantage-item p, .consideration-item p {
                font-family: "Inter Tight", sans-serif;
                color: #909DA2;
                font-size: 1rem;
                line-height: 1.6;
            }

            .blog-extra-content .extra-section {
                margin-bottom: 2rem;
            }

            .blog-extra-content .extra-section h3 {
                font-size: 1.2rem;
                margin-bottom: 0.5rem;
            }

            .blog-extra-content .extra-section p {
                font-size: 1rem;
  font-family: "Inter Tight", sans-serif;
                color: #909DA2;
                line-height: 1.6;
            }
        </style>

        <div class="blog-single">
            <div class="blog-main">
            <div class="blog-meta">
                    <?php echo esc_html($settings['read_time']); ?> &nbsp;&nbsp;•&nbsp;&nbsp; <?php echo esc_html($settings['post_date']); ?>
                </div>
                <h1><?php echo esc_html($settings['post_title']); ?></h1>
                <?php if (!empty($settings['main_image']['url'])) : ?>
                    <img src="<?php echo esc_url($settings['main_image']['url']); ?>" alt="Blog Image">
                <?php endif; ?>

                <!-- Advantages -->
                <?php if (!empty($settings['advantages'])) : ?>
                    <div class="advantage-block">
                        <h2><?php echo esc_html($settings['advantages_title']); ?></h2>
                        <?php foreach ($settings['advantages'] as $adv): ?>
                            <div class="advantage-item">
                                <h3><?php echo esc_html($adv['advantage_title']); ?></h3>
                                <p><?php echo esc_html($adv['advantage_description']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Considerations -->
                <?php if (!empty($settings['consideration_items'])) : ?>
                    <div class="consideration-block">
                        <h2><?php echo esc_html($settings['considerations_title']); ?></h2>
                        <p><?php echo esc_html($settings['considerations_description']); ?></p>
                        <?php foreach ($settings['consideration_items'] as $item): ?>
                            <div class="consideration-item">
                                <h6><?php echo esc_html($item['consideration_item_title']); ?></h6>
                                <p><?php echo esc_html($item['consideration_item_description']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Extra Section -->
                <?php if (!empty($settings['extra_sections'])) : ?>
                    <div class="blog-extra-content">
                        <?php foreach ($settings['extra_sections'] as $section): ?>
                            <div class="extra-section">
                                <h3><?php echo esc_html($section['extra_title']); ?></h3>
                                <p><?php echo esc_html($section['extra_description']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">
                <h3>Recent News</h3>
                <?php foreach ($settings['recent_news'] as $news): ?>
                    <div class="recent-post">
                        <div class="recent-post-title"><?php echo esc_html($news['news_title']); ?></div>
                        <div class="recent-post-date"><?php echo esc_html($news['news_date']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
}
