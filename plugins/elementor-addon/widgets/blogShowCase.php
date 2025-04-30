<?php

class Elementor_BlogShowCase extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'blog_showcase';
    }

    public function get_title()
    {
        return esc_html__('Blog Showcase', 'elementor-addon');
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
            'show_featured_post',
            [
                'label' => esc_html__('Show Featured Post', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'elementor-addon'),
                'label_off' => esc_html__('Hide', 'elementor-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'posts_count',
            [
                'label' => esc_html__('Number of Posts', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 4,
                'min' => 1,
                'max' => 12,
            ]
        );

        $this->add_control(
            'read_time_text',
            [
                'label' => esc_html__('Read Time Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'min read',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Get the latest posts
        $args = [
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_count'],
            'post_status' => 'publish',
            'ignore_sticky_posts' => true,
        ];

        $query = new WP_Query($args);

        // Get featured post (first post from the query)
        $featured_post = null;
        if ($settings['show_featured_post'] === 'yes' && $query->have_posts()) {
            $featured_post = $query->posts[0];
        }
?>
        <style>
            .blog-showcase {
                padding: 4rem 5rem;
                text-align: center;
            }

            .blog-showcase h1 {
                font-size: 52px;
                color: #2A2A2A;
                max-width:584px;
                margin:auto;
                margin-bottom: 1.5rem;
                margin-top:0px;
            }

            .blog-showcase .subtitle {
                color: #52525B;
                margin-top:0px;
                margin-bottom: 2.5rem;
                font-size: 1rem;
  font-family: "Inter Tight", sans-serif;
            }

            .featured-post {
                width: 50%;
                text-align: left;
                border-radius: 0.5rem;
                background: #F4F4F4;
                padding: 1rem;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .featured-post img {
                width: 100%;
                border-radius: 0.5rem;
                object-fit: cover;
                height: 400px;
            }

            .featured-post .title {
                font-size: 2rem;
                margin-bottom: 0.5rem;
                font-weight: 600;
                color: #333;
            }

            .featured-post .date {
                color: #52525B;
  font-family: "Inter Tight", sans-serif;

                font-size: 1rem;
            }

            .blog-cards {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 1rem 2rem;
            }

            .blog-card {
                background: #F4F4F4;
                border-radius: 0.5rem;
                text-align: left;
                overflow: hidden;
            }

            .blog-card img {
                width: 100%;
                height: 200px;
                object-fit: cover;
            }

            .blog-card .content {
                padding: 1rem;
                padding-top: 0rem;
            }

            .blog-card .title {
                font-size: 28px;
                margin-bottom: 1.5rem;
                margin-top:0px;
                color: #2A2A2A;
            }

            .blog-card .meta {
                display: flex;
                justify-content: space-between;
                font-size: 1rem;
                color: #52525B;
  font-family: "Inter Tight", sans-serif;

                margin-top: auto;
            }

            .meta .read-time {
                color: #909DA2;
            }

            .read-more-btn {
                display: inline-flex;
                align-items: center;
                margin-top: 70px;
                padding: 20px 28px;
                border: 1px solid #000;
                border-radius: 2rem;
                width: 188px;
                background: #fff;
                font-family: "Inter Tight", sans-serif;
                color: #2A2A2A;
                font-weight: 500;
                text-decoration: none;
                transition: all 0.3s ease;
                gap: 1rem;
            }

            .hero-button-icon {
                color: #2A2A2A;
                transition: transform 0.3s ease;
            }

            .read-more-btn:hover {
                width: 218px;

            }

            .read-more-btn:hover .hero-button-icon {
                transform: translateX(42px);
            }

            .sadqwd {
                display:flex;
                flex-wrap:nowrap;
                gap: 0rem 1rem;
                margin-bottom: 3rem;

            }

            @media (max-width: 768px) {
                .blog-showcase {
                    padding: 4rem 1rem;
                }

                .blog-showcase h1 {
                    font-family: 'Darker Grotesque', sans-serif;
                    font-weight: 600;
                    font-size: 28px;
                    line-height: 90%;
                    letter-spacing: 0%;
                    text-align: center;
                    vertical-align: middle;
                    color: #2a2a2a;
                }

                .blog-showcase .subtitle {
                    font-size: 1rem;
                }

                .featured-post {
                    display: none;
                }

                .blog-cards {
                    grid-template-columns: 1fr;
                }

                .blog-card img {
                    height: 180px;
                }
            }
        </style>

        <div class="blog-showcase">
            <h1><?php echo esc_html($settings['main_title']); ?></h1>
            <p class="subtitle"><?php echo esc_html($settings['subtitle']); ?></p>

            <?php if ($featured_post): ?>
                <div class='sadqwd'>
                <div class="featured-post">
                    <a href="<?php echo esc_url(get_permalink($featured_post->ID)); ?>">
                        <?php if (has_post_thumbnail($featured_post->ID)): ?>
                            <?php echo get_the_post_thumbnail($featured_post->ID, 'large'); ?>
                        <?php endif; ?>
                        <h2 class="title"><?php echo esc_html($featured_post->post_title); ?></h2>
                        <p class="date"><?php echo get_the_date('', $featured_post->ID); ?></p>
                    </a>
                </div>
                <div class="featured-post">
                    <a href="<?php echo esc_url(get_permalink($featured_post->ID)); ?>">
                        <?php if (has_post_thumbnail($featured_post->ID)): ?>
                            <?php echo get_the_post_thumbnail($featured_post->ID, 'large'); ?>
                        <?php endif; ?>
                        <h2 class="title"><?php echo esc_html($featured_post->post_title); ?></h2>
                        <p class="date"><?php echo get_the_date('', $featured_post->ID); ?></p>
                    </a>
                </div>
                </div>
            <?php endif; ?>

            <div class="blog-cards">
                <?php
                $posts_shown = 0;
                while ($query->have_posts()): $query->the_post();
                    // Skip featured post if it's shown
                    if ($settings['show_featured_post'] === 'yes' && $posts_shown === 0) {
                        $posts_shown++;
                        continue;
                    }
                ?>
                    <div class="blog-card">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php endif; ?>
                            <div class="content">
                                <h3 class="title"><?php the_title(); ?></h3>
                                <div class="meta">
                                    <span class="date"><?php echo get_the_date(); ?></span>
                                    <span class="read-time">
                                        <?php
                                        $read_time = $this->estimate_reading_time(get_the_content());
                                        echo $read_time . ' ' . esc_html($settings['read_time_text']);
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="read-more-btn">
                <?php esc_html_e('Read More', 'elementor-addon'); ?>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="hero-button-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>
<?php
    }

    private function estimate_reading_time($content)
    {
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200);
        return $reading_time ?: 1;
    }
}