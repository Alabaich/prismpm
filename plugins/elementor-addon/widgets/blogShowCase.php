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
                'label' => esc_html__('Number of Posts (regular grid)', 'elementor-addon'),
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

        $args = [
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_count'] + ($settings['show_featured_post'] === 'yes' ? 2 : 0),
            'post_status' => 'publish',
            'ignore_sticky_posts' => true,
            'orderby' => 'date',
            'order' => 'DESC'
        ];

        $query = new WP_Query($args);

        $featured_posts = [];
        if ($settings['show_featured_post'] === 'yes' && $query->have_posts()) {
            if (isset($query->posts[0])) {
                $featured_posts[] = $query->posts[0];
            }
            if (isset($query->posts[1])) {
                $featured_posts[] = $query->posts[1];
            }
        }
        $has_featured_for_class = ($settings['show_featured_post'] === 'yes' && !empty($featured_posts));
?>

        <style>
            .blog-showcase {
                padding: 4rem 5rem;
                text-align: center;
            }

            .blog-showcase h1.customTitle {
                color: #2A2A2A;
                max-width: 584px;
                margin: auto;
                margin-bottom: 1.5rem;
                margin-top: 0px;
            }

            .blog-showcase p.customSubtitle {
                color: #6B7280;
                margin: 0 auto 2.5rem auto;
                max-width: 584px;
            }

            .sadqwd {
                display: flex;
                flex-wrap: nowrap;
                gap: 1rem;
                margin-bottom: 1rem;
            }

            .featured-post {
                width: 50%;
                text-align: left;
                border-radius: 0.5rem;
                background: #f9f9f9;
                padding: 1rem;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                display: flex;
                flex-direction: column;
            }

            .featured-post a,
            .blog-card a {
                text-decoration: none;
                color: inherit;
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            .featured-post img {
                width: 100%;
                border-radius: 0.5rem;
                object-fit: cover;
                height: 400px;
                margin-bottom: 1rem;
            }

            .featured-post .title {
                font-size: 20px;
                margin-bottom: 0.5rem;
                font-weight: 600;
                color: #333;
                line-height: 1.3;
                min-height: calc(1.3em * 2);
            }

            .featured-post .meta {
                display: flex;
                justify-content: space-between;
                font-size: 1rem;
                color: #6B7280;
                font-family: "Inter Tight", sans-serif;
                margin-top: auto;
                padding-top: 0.5rem;
            }

            .featured-post .meta .read-time,
            .featured-post .meta .date {
                color: #6B7280;
            }

            .blog-cards {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 1rem;
            }

            .blog-card {
                background: #f9f9f9;
                border-radius: 0.5rem;
                text-align: left;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                padding: 1rem;
            }

            .blog-card img {
                width: 100%;
                height: 200px;
                object-fit: cover;
                border-radius: 0.5rem;
            }

            .blog-card .content {
                padding-top: 0rem;
                display: flex;
                flex-direction: column;
                flex-grow: 1;
            }

            .blog-card .title {
                font-size: 20px;
                margin-bottom: 1.5rem;
                margin-top: 1rem;
                color: #2A2A2A;
                line-height: 1.3;
                min-height: calc(1.3em * 2);
                font-weight: 600;
            }

            .blog-card .meta {
                display: flex;
                justify-content: space-between;
                font-size: 1rem;
                color: #6B7280;
                font-family: "Inter Tight", sans-serif;
                margin-top: auto;
                padding-top: 0.5rem;
            }

            .meta .read-time {
                color: #6B7280;
            }

            .read-more-btn {
                display: inline-flex;
                align-items: center;
                margin-top: 50px;
                padding: 10px 20px;
                text-decoration: none;
                color: #fff;
                background-color: #093D5F;
                font-family: "Graphik Medium", Sans-serif;
                font-size: 16px;
                font-weight: normal;
                transition: all 0.3s ease;
                border: 2px solid transparent;
                border-radius: 99999px;
                gap: 1rem;
            }

            .read-more-btn svg path {
                fill: #fff;
                transition: fill 0.3s ease;
            }

            .read-more-btn:hover {
                color: #093D5F;
                background-color: #fff;
                border-color: #093D5F;
            }

            .read-more-btn:hover svg path {
                fill: #093D5F;
            }

            .read-more-btn svg {
                transition: transform 0.3s ease;
            }

            .read-more-btn:hover svg {
                transform: translateX(4px);
            }

            @media (max-width: 767px) {
                .blog-showcase {
                    padding: 4rem 1rem;
                }

                .blog-showcase h1.customTitle {
                    line-height: 1.2;
                    letter-spacing: 0%;
                    text-align: center;
                    color: #2a2a2a;
                    margin-bottom: 1rem;
                }

                .blog-showcase p.customSubtitle {
                    margin: 0 auto 2rem auto;
                }

                .featured-post {
                    display: none;
                }

                .sadqwd {
                    display: none;
                }

                .blog-cards {
                    grid-template-columns: 1fr;
                    gap: 1.5rem;
                }

                .blog-card img {
                    height: 180px;
                }

                .blog-card .content {
                    padding-top: 1rem;
                }

                .read-more-btn {
                    margin-top: 2.5rem;
                }
            }

            @media (min-width: 768px) and (max-width: 1024px) {
                .blog-showcase {
                    padding: 3.75rem 5rem;
                }

                .sadqwd {
                    display: block;
                    margin-bottom: 1.5rem;
                }

                .featured-post {
                    width: 100%;
                    margin-bottom: 1.5rem;
                }

                .sadqwd .featured-post:nth-child(n+2) {
                    display: none;
                }

                .blog-cards {
                    display: grid;
                    grid-template-columns: repeat(2, 1fr);
                    gap: 1rem;
                }

                .blog-showcase.has-featured-posts .blog-cards .blog-card:nth-child(n+3) {
                    display: none;
                }

                .blog-showcase:not(.has-featured-posts) .blog-cards .blog-card:first-child {
                    grid-column: 1 / -1;
                    margin-bottom: 1rem;
                }

                .blog-showcase:not(.has-featured-posts) .blog-cards .blog-card:nth-child(n+4) {
                    display: none;
                }
            }
        </style>

        <div class="blog-showcase <?php if ($has_featured_for_class) echo 'has-featured-posts'; ?>" id="<?php echo esc_attr($this->get_id()); ?>">
            <h1 class="customTitle"><?php echo esc_html($settings['main_title']); ?></h1>
            <p class="customSubtitle"><?php echo esc_html($settings['subtitle']); ?></p>

            <?php if ($settings['show_featured_post'] === 'yes' && !empty($featured_posts)): ?>
                <div class='sadqwd'>
                    <?php
                    foreach ($featured_posts as $featured_post_obj):
                    ?>
                        <div class="featured-post">
                            <a href="<?php echo esc_url(get_permalink($featured_post_obj->ID)); ?>">
                                <?php if (has_post_thumbnail($featured_post_obj->ID)): ?>
                                    <?php echo get_the_post_thumbnail($featured_post_obj->ID, 'large'); ?>
                                <?php else: ?>
                                    <img src="<?php echo esc_url(\Elementor\Utils::get_placeholder_image_src()); ?>" alt="Placeholder Image">
                                <?php endif; ?>
                                <h3 class="title"><?php echo esc_html($featured_post_obj->post_title); ?></h3>
                                <div class="meta">
                                    <span class="date"><?php echo get_the_date('', $featured_post_obj->ID); ?></span>
                                    <span class="read-time">
                                        <?php
                                        $featured_content_for_time = get_post_field('post_content', $featured_post_obj->ID);
                                        $read_time = $this->estimate_reading_time($featured_content_for_time);
                                        echo $read_time . ' ' . esc_html($settings['read_time_text']);
                                        ?>
                                    </span>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="blog-cards">
                <?php
                $posts_shown_count = 0;
                $skip_these_ids = [];
                if ($settings['show_featured_post'] === 'yes' && !empty($featured_posts)) {
                    foreach ($featured_posts as $fp) {
                        $skip_these_ids[] = $fp->ID;
                    }
                }

                $regular_args_final = [
                    'post_type' => 'post',
                    'posts_per_page' => $settings['posts_count'],
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ];
                if (!empty($skip_these_ids)) {
                    $regular_args_final['post__not_in'] = $skip_these_ids;
                }

                $regular_query_final = new WP_Query($regular_args_final);

                if ($regular_query_final->have_posts()):
                    while ($regular_query_final->have_posts()): $regular_query_final->the_post();
                ?>
                        <div class="blog-card">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()): ?>
                                    <?php the_post_thumbnail('medium_large'); ?>
                                <?php else: ?>
                                    <img src="<?php echo esc_url(\Elementor\Utils::get_placeholder_image_src()); ?>" alt="Placeholder Image">
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
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>

            <?php
            if (empty($featured_posts) && !$regular_query_final->have_posts()): ?>
                <p><?php esc_html_e('No posts found.', 'elementor-addon'); ?></p>
            <?php endif; ?>

            <?php
            $blog_page_url = get_permalink(get_option('page_for_posts'));
            if ($blog_page_url && ($regular_query_final->found_posts > 0 || !empty($featured_posts))) :
            ?>
                <a href="<?php echo esc_url($blog_page_url); ?>" class="read-more-btn">
                    <?php esc_html_e('Read More', 'elementor-addon'); ?>
                    <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="hqwdasdicon">
                        <path d="M11.5 -0.0078125C12.0523 -0.0078125 12.5 0.439903 12.5 0.992188V10.9922C12.5 11.5445 12.0523 11.9922 11.5 11.9922C10.9477 11.9922 10.5 11.5445 10.5 10.9922V3.33203L2.20703 11.6992C1.81651 12.0897 1.18349 12.0897 0.792969 11.6992C0.402446 11.3087 0.402445 10.6757 0.792969 10.2852L9.0127 1.99219H1.5C0.947715 1.99219 0.5 1.54447 0.5 0.992188C0.5 0.439903 0.947715 -0.0078125 1.5 -0.0078125H11.5Z" fill="currentColor" />
                    </svg>
                </a>
            <?php endif; ?>
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
