<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $post_id = get_the_ID();
        $word_count = str_word_count(strip_tags(get_the_content()));
        $read_time = ceil($word_count / 200) . ' min read';
        $post_url = urlencode(get_permalink());
        $post_title = urlencode(get_the_title());
?>

        <style>
            .blog-single {
                position: relative;
                display: grid;
                grid-template-columns: auto 3fr 1fr;
                gap: 3rem;
                width: 100%;
                padding: 4rem 2rem;
                box-sizing: border-box;
                margin-top: 6rem;
            }

            /* Share section styles */
            .share-container {
                position: relative;
                width: 60px;
            }

            .share-section {
                position: sticky;
                top: 150px;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }

            .share-label {
                color: #909DA2;
                font-size: 0.75rem;
                letter-spacing: 1px;
                margin-bottom: 10px;
            }

            .share-icons {
                display: flex;
                flex-direction: column;
                gap: 8px;
            }

            .share-icons a {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                background: #fff;
                border: 1px solid #e0e0e0;
                border-radius: 6px;
                transition: all 0.3s ease;
            }

            .share-icons a:hover {
                background: #f5f5f5;
                transform: translateY(-2px);
            }

            .share-icons svg {
                width: 18px;
                height: 18px;
            }

            /* Main content styles */
            .blog-main {
                grid-column: 2;
            }

            .blog-main h1 {
                margin-bottom: 1rem;
                font-size: 2rem;
                font-weight: 700;
                color: #22282B;
            }

            .blog-meta {
                color: #909DA2;
                margin-bottom: 1rem;
                font-size: 0.75rem;
            }

            .blog-main img {
                width: 100%;
                border-radius: 0.5rem;
                object-fit: cover;
                margin-bottom: 1.5rem;
                max-height: 500px;
            }

            .blog-content {
                font-size: 1rem;
                line-height: 1.6;
            }

            /* Sidebar styles */
            .sidebar {
                grid-column: 3;
                border: 1px solid #e5e7eb;
                border-radius: 0.75rem;
                background: #fafafa;
                padding: 1rem;
                height: fit-content;
            }

            .sidebar h3 {
                border-bottom: 1px solid #E6E9EA;
                padding-bottom: 0.75rem;
                margin: 0;
                font-size: 1.25rem;
                font-weight: 600;
                color: #22282B;
            }

            .recent-post {
                padding: 1rem 0;
                border-bottom: 1px solid #E6E9EA;
            }

            .recent-post:last-child {
                border-bottom: none;
                padding-bottom: 0;
            }

            .recent-post-title {
                font-weight: 600;
                margin-bottom: 0.25rem;
                color: #22282B;
                font-size: 0.9rem;
            }

            .recent-post-title a {
                color: #22282B;
                text-decoration: none;
            }

            .recent-post-title a:hover {
                text-decoration: underline;
            }

            /* Responsive styles */
            @media (max-width: 1024px) {
                .blog-single {
                    grid-template-columns: 1fr;
                    padding: 4rem 1.5rem;
                }

                .share-container {
                    display: none;
                }

                .blog-main {
                    grid-column: 1;
                }

                .sidebar {
                    grid-column: 1;
                    margin-top: 2rem;
                }
            }

            @media (min-width: 1025px) {
                .blog-main h1 {
                    font-size: 2.5rem;
                }

                .share-icons a {
                    width: 45px;
                    height: 45px;
                }

                .share-icons svg {
                    width: 20px;
                    height: 20px;
                }
            }
        </style>

        <div class="blog-single">
            <!-- Share section - left column -->
            <div class="share-container">
                <div class="share-section">
                    <div class="share-label">Share</div>
                    <div class="share-icons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_url; ?>" target="_blank" aria-label="Share on Facebook">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 12C22 6.477 17.523 2 12 2C6.477 2 2 6.477 2 12C2 16.991 5.657 21.128 10.438 21.878V14.891H7.898V12H10.438V9.797C10.438 7.291 11.93 5.907 14.215 5.907C15.309 5.907 16.453 6.102 16.453 6.102V8.562H15.193C13.95 8.562 13.563 9.333 13.563 10.124V12H16.336L15.893 14.891H13.563V21.878C18.343 21.128 22 16.991 22 12Z" fill="#093D5F" />
                                <path d="M15.893 14.891L16.336 12H13.563V10.124C13.563 9.333 13.95 8.562 15.193 8.562H16.453V6.102C16.453 6.102 15.309 5.907 14.215 5.907C11.93 5.907 10.438 7.291 10.438 9.797V12H7.898V14.891H10.438V21.878C10.946 21.959 11.468 22 12 22C12.532 22 13.054 21.959 13.563 21.878V14.891H15.893Z" fill="white" />
                            </svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo $post_url; ?>&text=<?php echo $post_title; ?>" target="_blank" aria-label="Share on Twitter">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22.46 6.01233C21.69 6.35233 20.86 6.58233 20 6.68233C20.88 6.15233 21.56 5.32233 21.88 4.31233C21.05 4.81233 20.13 5.16233 19.16 5.36233C18.37 4.52233 17.26 4.00233 16 4.00233C13.65 4.00233 11.73 5.92233 11.73 8.29233C11.73 8.62233 11.77 8.94233 11.84 9.25233C8.28004 9.09233 5.11004 7.38233 3.00004 4.79233C2.63004 5.42233 2.42004 6.15233 2.42004 6.93233C2.42004 8.40233 3.17004 9.70233 4.33004 10.4723C3.62004 10.4523 2.96004 10.2523 2.38004 9.93233V9.98233C2.38004 12.0623 3.86004 13.8123 5.82004 14.2423C5.19077 14.4122 4.53013 14.4362 3.89004 14.3123C4.16165 15.1625 4.69358 15.9084 5.41106 16.4429C6.12854 16.9775 6.99549 17.2737 7.89004 17.2923C6.37367 18.4907 4.49404 19.1394 2.56004 19.1323C2.22004 19.1323 1.88004 19.1123 1.54004 19.0723C3.44004 20.2923 5.70004 21.0023 8.12004 21.0023C16 21.0023 20.33 14.4623 20.33 8.79233C20.33 8.60233 20.33 8.41233 20.32 8.22233C21.16 7.62233 21.88 6.87233 22.46 6.01233Z" fill="#093D5F" />
                            </svg>
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $post_url; ?>&title=<?php echo $post_title; ?>" target="_blank" aria-label="Share on LinkedIn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 3C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V19C21 19.5304 20.7893 20.0391 20.4142 20.4142C20.0391 20.7893 19.5304 21 19 21H5C4.46957 21 3.96086 20.7893 3.58579 20.4142C3.21071 20.0391 3 19.5304 3 19V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19ZM18.5 18.5V13.2C18.5 12.3354 18.1565 11.5062 17.5452 10.8948C16.9338 10.2835 16.1046 9.94 15.24 9.94C14.39 9.94 13.4 10.46 12.92 11.24V10.13H10.13V18.5H12.92V13.57C12.92 12.8 13.54 12.17 14.31 12.17C14.6813 12.17 15.0374 12.3175 15.2999 12.5801C15.5625 12.8426 15.71 13.1987 15.71 13.57V18.5H18.5ZM6.88 8.56C7.32556 8.56 7.75288 8.383 8.06794 8.06794C8.383 7.75288 8.56 7.32556 8.56 6.88C8.56 5.95 7.81 5.19 6.88 5.19C6.43178 5.19 6.00193 5.36805 5.68499 5.68499C5.36805 6.00193 5.19 6.43178 5.19 6.88C5.19 7.81 5.95 8.56 6.88 8.56ZM8.27 18.5V10.13H5.5V18.5H8.27Z" fill="#093D5F" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main content - center column -->
            <div class="blog-main">
                <div class="blog-meta">
                    <?php echo esc_html($read_time); ?> • <?php echo esc_html(get_the_date('F Y')); ?>
                </div>
                <h1><?php the_title(); ?></h1>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('full', ['class' => 'blog-main-img', 'alt' => esc_attr(get_the_title())]); ?>
                    </div>
                <?php endif; ?>

                <div class="blog-content">
                    <?php
                    the_content();

                    wp_link_pages([
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'text-domain'),
                        'after'  => '</div>',
                    ]);
                    ?>
                </div>
            </div>

            <!-- Sidebar - right column -->
            <div class="sidebar">
                <h3>Recent News</h3>
                <?php
                $recent_posts = get_posts([
                    'numberposts' => 3,
                    'post__not_in' => [$post_id],
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'post_status' => 'publish',
                    'post_type' => 'post',
                    'suppress_filters' => false
                ]);

                if (!empty($recent_posts)) :
                    foreach ($recent_posts as $post) :
                        setup_postdata($post);
                ?>
                        <div class="recent-post">
                            <div class="recent-post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>
                            <div class="recent-post-date">
                                <?php echo get_the_date('j F Y'); ?>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    wp_reset_postdata();
                else : ?>
                    <div class="recent-post">
                        <p>No recent posts available</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

<?php
    endwhile;
else :
    echo '<p>' . esc_html__('No posts found.', 'text-domain') . '</p>';
endif;

get_footer();
?>