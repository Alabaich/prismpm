<?php
if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<div class="sidebar">
    <h3>Recent News</h3>
    <?php
    $post_id = get_the_ID();
    $recent_posts = wp_get_recent_posts([
        'numberposts' => 3,
        'post_status' => 'publish',
        'exclude' => [$post_id],
    ]);
    foreach ($recent_posts as $post) : ?>
        <div class="recent-post">
            <div class="recent-post-title">
                <a href="<?php echo esc_url(get_permalink($post['ID'])); ?>">
                    <?php echo esc_html($post['post_title']); ?>
                </a>
            </div>
            <div class="recent-post-date">
                <?php echo esc_html(get_the_date('j F Y', $post['ID'])); ?>
            </div>
        </div>
    <?php endforeach; ?>
    <?php wp_reset_postdata(); ?>
</div>

<style>
    .sidebar {
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        background: #fafafa;
        padding: 1rem;
        max-width: 100%;
    }

    .sidebar h3 {
        border-bottom: 1px solid #E6E9EA;
        padding-bottom: 0.75rem;
        margin: 0 0 1rem 0;
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

    .recent-post-date {
        color: #909DA2;
        font-size: 0.75rem;
    }

    @media (min-width: 769px) {
        .sidebar {
            padding: 1.5rem;
        }

        .sidebar h3 {
            font-size: 1.5rem;
            padding-bottom: 1.25rem;
        }

        .recent-post-title {
            font-size: 1rem;
        }

        .recent-post-date {
            font-size: 0.875rem;
        }
    }

    @media (max-width: 480px) {
        .sidebar {
            padding: 0.75rem;
        }

        .sidebar h3 {
            font-size: 1.1rem;
        }

        .recent-post-title {
            font-size: 0.85rem;
        }

        .recent-post-date {
            font-size: 0.7rem;
        }
    }
</style>