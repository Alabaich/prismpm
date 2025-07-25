<?php

get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $post_id = get_the_ID();
        // Расчет времени чтения (примерно 200 слов в минуту)
        $word_count = str_word_count(strip_tags(get_the_content()));
        $read_time = ceil($word_count / 200) . ' min read';
?>

<style>
    .blog-single {
        position: relative;
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
        padding: 1rem 0;
        padding-top: 4rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .blog-single .share-icons {
        position: absolute;
        left: -60px;
        top: 80px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        width: 40px;
        height: 120px;
    }

    .blog-single .share-icons a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        transition: background 0.3s ease;
        font-size: 0.9rem;
    }

    .blog-single .share-icons a:hover {
        background: #333;
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
    }

    .blog-content {
        font-size: 1rem;
        line-height: 1.6;
    }

    .blog-content h2, .blog-content h3 {
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }

    .advantage-block, .consideration-block {
        margin-top: 1.5rem;
    }

    .consideration-block p {
        font-family: "Inter Tight", sans-serif;
        font-size: 0.9rem;
    }

    .advantage-block h2, .consideration-block h2 {
        margin-bottom: 1rem;
        font-size: 1.5rem;
        font-weight: 600;
        color: #22282B;
    }

    .advantage-item, .consideration-item {
        margin-bottom: 1rem;
    }

    .consideration-item {
        display: flex;
        align-items: flex-start;
        gap: 0 0.5rem;
        flex-direction: column;
    }

    .consideration-item p {
        margin: 0;
    }

    .advantage-item h3, .consideration-item h6 {
        font-family: "Inter Tight", sans-serif;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
        color: #22282B;
        font-weight: 400;
    }

    .consideration-item h6 {
        font-size: 0.9rem;
        font-family: "Inter Tight", sans-serif;
        color: #000000;
        margin: 0;
    }

    .advantage-item p, .consideration-item p {
        font-family: "Inter Tight", sans-serif;
        color: #909DA2;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    @media (min-width: 769px) {
        .blog-single {
            grid-template-columns: 3fr 1fr;
            gap: 3rem;
            padding: 2rem 0;
            padding-top: 6rem;
        }

        .blog-single .share-icons {
            left: -80px;
            top: 100px;
            width: 55px;
            height: 177px;
        }

        .blog-single .share-icons a {
            width: 55px;
            height: 55px;
            font-size: 1rem;
        }

        .blog-main h1 {
            font-size: 2.5rem;
        }

        .blog-meta {
            font-size: 0.875rem;
        }

        .blog-content {
            font-size: 1.05rem;
            line-height: 1.8;
        }

        .advantage-block h2, .consideration-block h2 {
            font-size: 1.75rem;
        }

        .advantage-item h3, .consideration-item h6 {
            font-size: 1.38rem;
        }

        .advantage-item p, .consideration-item p {
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .blog-single .share-icons {
            flex-direction: row;
            position: static;
            margin: 0 auto 1rem;
            justify-content: center;
            width: auto;
            height: auto;
        }

        .blog-single .share-icons a {
            margin: 0 0.25rem;
        }

        .blog-main h1 {
            font-size: 1.5rem;
        }

        .blog-meta {
            font-size: 0.7rem;
        }

        .blog-content {
            font-size: 0.9rem;
        }

        .advantage-block h2, .consideration-block h2 {
            font-size: 1.25rem;
        }

        .advantage-item h3, .consideration-item h6 {
            font-size: 1rem;
        }
    }
</style>

<div class="blog-single">
    <!-- Share Icons -->
    <div class="share-icons">
        <a href="javascript:window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>', '_blank')" class="social-icon"><i class="fab fa-facebook-f"></i></a>
        <a href="javascript:window.open('https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>', '_blank')" class="social-icon"><i class="fab fa-twitter"></i></a>
        <a href="javascript:window.open('https://www.instagram.com', '_blank')" class="social-icon"><i class="fab fa-instagram"></i></a>
    </div>

    <!-- Main Content -->
    <div class="blog-main">
        <div class="blog-meta">
            <?php echo esc_html($read_time); ?>   •   <?php echo esc_html(get_the_date('F Y')); ?>
        </div>
        <h1><?php the_title(); ?></h1>
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('full', ['class' => 'blog-main-img', 'alt' => 'Blog Image']); ?>
        <?php endif; ?>

        <div class="blog-content">
            <?php the_content(); ?>
        </div>

        <?php
        $content = get_the_content();
        $advantages_block = '';
        if (preg_match('/<h2>Advantages Of Long-Term Leases<\/h2>(.*?)<h2>/s', $content, $matches)) {
            $advantages_block = $matches[1];
        } elseif (has_post_meta($post_id, 'advantages_content')) {
            $advantages_block = get_post_meta($post_id, 'advantages_content', true);
        }
        if ($advantages_block) : ?>
            <div class="advantage-block">
                <h2>Advantages Of Long-Term Leases</h2>
                <?php
                $advantages_items = preg_match_all('/<h3>(.*?)<\/h3>\s*<p>(.*?)<\/p>/s', $advantages_block, $items, PREG_SET_ORDER);
                foreach ($items as $item) :
                    echo '<div class="advantage-item">';
                    echo '<h3>' . esc_html($item[1]) . '</h3>';
                    echo '<p>' . esc_html($item[2]) . '</p>';
                    echo '</div>';
                endforeach;
                ?>
            </div>
        <?php endif; ?>

        <?php
        $considerations_block = '';
        if (preg_match('/<h2>Key Considerations<\/h2>(.*?)(?:<h2>|$)/s', $content, $matches)) {
            $considerations_block = $matches[1];
        } elseif (has_post_meta($post_id, 'considerations_content')) {
            $considerations_block = get_post_meta($post_id, 'considerations_content', true);
        }
        if ($considerations_block) : ?>
            <div class="consideration-block">
                <h2>Key Considerations</h2>
                <?php
                $desc_match = preg_match('/<p>(.*?)<\/p>/s', $considerations_block, $desc);
                $description = $desc_match ? $desc[1] : '';
                echo '<p>' . esc_html($description) . '</p>';
                $consideration_items = preg_match_all('/<h6>(.*?)<\/h6>\s*<p>(.*?)<\/p>/s', $considerations_block, $items, PREG_SET_ORDER);
                foreach ($items as $item) :
                    echo '<div class="consideration-item">';
                    echo '<h6>' . esc_html($item[1]) . '</h6>';
                    echo '<p>' . esc_html($item[2]) . '</p>';
                    echo '</div>';
                endforeach;
                ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Sidebar -->
    <?php get_sidebar('blog'); ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const shareIcons = document.querySelector('.blog-single .share-icons');
        if (shareIcons) {
            window.addEventListener('scroll', function() {
                const blogMain = document.querySelector('.blog-single .blog-main');
                const rect = blogMain.getBoundingClientRect();
                const windowHeight = window.innerHeight;

                if (rect.top < windowHeight && rect.bottom > 0) {
                    shareIcons.style.opacity = '1';
                } else {
                    shareIcons.style.opacity = '0';
                }
            });
        }
    });
</script>

<?php
    endwhile;
else :
    echo '<p>' . esc_html__('No posts found.', 'text-domain') . '</p>';
endif;

get_footer();
?>