<?php get_header(); ?>

<style>
    .custom-news-page {
        max-width: 100%;
        margin: 0 auto;
        padding: 50px 10%;
    }

    .news-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .news-tag-filter {
        flex: 1;
        min-width: 0;
    }

    .tag-list {
        display: flex;
        flex-wrap: wrap;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 10px;
        justify-content: flex-end;
        align-items: center;
    }

    .tag-list a {
        display: block;
        padding: 12px 24px;
        border: 1px solid #868686;
        border-radius: 9999px;
        text-decoration: none;
        color: #868686;
        font-family: "Inter Tight", Helvetica;
        font-size: 16px;
        font-weight: 400;
        line-height: 140%;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .tag-list a:hover,
    .tag-list a.active {
        border-color: #2A2A2A;
        color: #2A2A2A;
    }

    .tag-list a.active {
        font-weight: 500;
    }

    .news-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 50px;
    }

    .news-card {
        background: #f4f4f4;
        border-radius: 8px;
        overflow: hidden;
        text-decoration: none;
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
        padding: 15px;
    }

    .news-card:hover {
        transform: translateY(-5px);
    }

    .news-card.featured-news {
        grid-column: 1 / -1;
        background: #f4f4f4;
    }

    .news-card a {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .news-thumbnail img {
        width: 100%;
        height: 240px;
        object-fit: cover;
        display: block;
        border-radius: 8px;
    }

    .news-card.featured-news .news-thumbnail img {
        height: 400px;
    }

    .news-card-content {
        display: flex;
        flex-direction: column;
        gap: 10px;
        flex-grow: 1;
    }

    .news-title {
        color: #292929;
        margin: 0;
    }

    .news-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }

    .news-date {
        color: #868686;
        margin: 0;
    }

    .reading-time {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #868686;
        margin: 0;
    }

    .reading-time svg {
        width: 16px;
        height: 16px;
        fill: #868686;
    }

    .news-tags {
        display: none;
    }

    .news-card.featured-news .news-tags {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .news-tag {
        font-size: 14px;
        padding: 4px 10px;
        background: #e0e0e0;
        border-radius: 4px;
        color: #555;
    }

    .news-pagination {
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }

    .nav-links {
        display: flex;
        gap: 8px;
    }

    .page-numbers {
        padding: 8px 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .page-numbers.current {
        background: #292929;
        color: white;
        border-color: #292929;
    }

    .tag-list a.active-tag {
        border-color: #292929;
        color: #292929;
        font-weight: 500;
    }

    .news-grid>.news-card:first-child {
        grid-column: 1 / -1;
    }

    .page-numbers {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1px solid #ddd;
        text-decoration: none;
        color: #292929;
        background: #F4F4F499;
        transition: all 0.3s ease;
    }

    .page-numbers-wrapper {
        display: flex;
        gap: 8px;
        margin: 0 20px;
    }

    .page-numbers:hover {
        background: #093D5F;
        color: white;
        border-color: #093D5F;
    }

    .page-numbers.current {
        background: #093D5F;
        color: white;
        border-color: #093D5F;
    }

    .page-numbers.dots {
        border: none;
        background: transparent;
        pointer-events: none;
        width: auto;
        color: #292929;
    }

    .pagination-arrow {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1px solid #ddd;
        background: #F4F4F499;
        transition: all 0.3s ease;
    }

    .pagination-arrow.prev {
        margin-right: 20px;
    }

    .pagination-arrow.next {
        margin-left: 20px;
    }

    .pagination-arrow:hover {
        background: #093D5F;
        border-color: #093D5F;
    }

    .pagination-arrow svg {
        width: 20px;
        height: 20px;
        fill: #292929;
        transition: fill 0.3s ease;
    }

    .pagination-arrow:hover svg {
        fill: white;
    }

    .pagination-arrow.disabled {
        opacity: 0.5;
        pointer-events: none;
        background: #F4F4F499;
    }

    @media (max-width: 1200px) {
        .news-card.featured-news .news-thumbnail img {
            height: 350px;
        }
    }

    @media (max-width: 1024px) {
        .news-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .news-card.featured-news .news-thumbnail img {
            height: 300px;
        }
    }

    @media (max-width: 768px) {
        .news-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 20px;
        }

        .news-tag-filter {
            width: 100%;
        }

        .tag-list {
            justify-content: flex-start;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .news-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .news-card-content {
            padding: 20px;
        }

        .news-thumbnail img,
        .news-card.featured-news .news-thumbnail img {
            height: 200px;
        }
    }
</style>

<main class="custom-news-page">
    <div class="news-header">
        <h1>
            <?php single_tag_title('News with tag: '); ?>
        </h1>
        <div class="news-tag-filter">
            <?php
            $tags = get_tags();
            if ($tags) :
                echo '<ul class="tag-list">';

                $blog_page_url = get_permalink(get_option('page_for_posts'));
                if (empty($blog_page_url)) {
                    $blog_page_url = home_url('/');
                }
                echo '<li><a href="' . esc_url($blog_page_url) . '">All</a></li>';

                foreach ($tags as $tag) {
                    $active_class = get_queried_object_id() == $tag->term_id ? 'active-tag' : '';
                    echo '<li><a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="' . $active_class . '">' . esc_html($tag->name) . '</a></li>';
                }
                echo '</ul>';
            endif;
            ?>
        </div>
    </div>

    <div class="news-grid">
        <?php
        $post_counter = 0;
        if (have_posts()) : while (have_posts()) : the_post();
                $post_counter++;
                if ($post_counter === 1) : ?>
                    <article class="news-card featured-news">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="news-thumbnail">
                                    <?php the_post_thumbnail('full', array(
                                        'loading' => 'eager',
                                        'alt' => get_the_title()
                                    )); ?>
                                </div>
                            <?php endif; ?>
                            <div class="news-card-content">
                                <h4 class="news-title"><?php the_title(); ?></h4>
                                <div class="news-meta">
                                    <p class="news-date"><?php echo get_the_date(); ?></p>
                                    <p class="reading-time">
                                        <?php
                                        $word_count = str_word_count(strip_tags(get_the_content()));
                                        echo ceil($word_count / 200) . ' min read';
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php else : ?>
                    <article class="news-card">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="news-thumbnail">
                                    <?php the_post_thumbnail('large', array(
                                        'loading' => 'lazy',
                                        'alt' => get_the_title()
                                    )); ?>
                                </div>
                            <?php endif; ?>
                            <div class="news-card-content">
                                <h4 class="news-title"><?php the_title(); ?></h4>
                                <div class="news-meta">
                                    <p class="news-date"><?php echo get_the_date(); ?></p>
                                    <p class="reading-time">
                                        <?php
                                        $word_count = str_word_count(strip_tags(get_the_content()));
                                        echo ceil($word_count / 200) . ' min read';
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php endif; ?>
            <?php endwhile;
        else: ?>
            <p>No posts found for this tag.</p>
        <?php endif; ?>
    </div>

    <div class="news-pagination">
        <?php
        global $wp_query;
        $current = max(1, get_query_var('paged'));
        $total = $wp_query->max_num_pages;

        if ($total > 1) {
            echo '<div class="nav-links">';

            if ($current > 1) {
                echo '<a class="pagination-arrow prev" href="' . get_pagenum_link($current - 1) . '">';
                echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/></svg>';
                echo '</a>';
            } else {
                echo '<span class="pagination-arrow prev disabled">';
                echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/></svg>';
                echo '</span>';
            }

            echo '<div class="page-numbers-wrapper">';

            $start = max(1, $current - 2);
            $end = min($start + 4, $total);

            for ($i = $start; $i <= $end; $i++) {
                if ($i == $current) {
                    echo '<span class="page-numbers current">' . $i . '</span>';
                } else {
                    echo '<a class="page-numbers" href="' . get_pagenum_link($i) . '">' . $i . '</a>';
                }
            }

            if ($end < $total - 1) {
                echo '<span class="page-numbers dots">...</span>';
            }
            if ($end < $total) {
                if ($total == $current) {
                    echo '<span class="page-numbers current">' . $total . '</span>';
                } else {
                    echo '<a class="page-numbers" href="' . get_pagenum_link($total) . '">' . $total . '</a>';
                }
            }

            echo '</div>';

            if ($current < $total) {
                echo '<a class="pagination-arrow next" href="' . get_pagenum_link($current + 1) . '">';
                echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg>';
                echo '</a>';
            } else {
                echo '<span class="pagination-arrow next disabled">';
                echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg>';
                echo '</span>';
            }

            echo '</div>';
        }
        ?>
    </div>
</main>

<?php get_footer(); ?>