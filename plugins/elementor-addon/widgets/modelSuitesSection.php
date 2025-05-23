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

        $this->add_control('show_more_link', [
            'label' => esc_html__('Show More Button Link', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
            'show_external' => true,
            'default' => [
                'url' => '',
                'is_external' => true,
                'nofollow' => true,
            ],
            'dynamic' => [
                'active' => true,
            ],
            'condition' => [
                'show_more_text!' => '',
            ],
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

        $repeater->add_control('bedrooms', [
            'label'   => esc_html__('Bedrooms', 'elementor-addon'),
            'type'    => \Elementor\Controls_Manager::NUMBER,
            'default' => 1,
            'min'     => 0,
        ]);

        $repeater->add_control('bathrooms', [
            'label'   => esc_html__('Bathrooms', 'elementor-addon'),
            'type'    => \Elementor\Controls_Manager::NUMBER,
            'default' => 1,
            'min'     => 0,
        ]);

        $repeater->add_control('square_meters', [
            'label'   => esc_html__('Area (sq ft)', 'elementor-addon'),
            'type'    => \Elementor\Controls_Manager::TEXT,
            'default' => '550',
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
            'title_field' => '{{{ title }}}',
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
                display: inline-flex;
                align-items: center;
                gap: 0rem 1rem;
                transition: transform 0.3s ease, gap 0.3s ease, background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
                box-sizing: border-box;
                text-decoration: none;
            }

            .show-moreq svg {
                transition: transform 0.3s ease, stroke 0.3s ease;
                stroke: currentColor;
            }

            .show-moreq:hover {
                background: white;
                color: #2A2A2A;
                gap: 0rem 2rem;
                border-color: #000;
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

            .wishlist:focus,
            .wishlist:focus-visible {
                background-color: transparent !important;
                outline: none !important;
                box-shadow: none !important;
            }

            .wishlist:active {
                background-color: transparent !important;
            }

            .suite-card {
                width: calc((100% - 4rem) / 3);
                border-radius: 1rem;
                overflow: hidden;
                background: #f9f9f9;
                display: flex;
                flex-direction: column;
                transition: box-shadow 0.2s ease;
                box-sizing: border-box;
            }

            .suite-card:hover {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            }

            .suite-image-wrapper {
                padding: 1rem;
                background-color: transparent;
            }

            .suite-card img {
                width: 100%;
                height: 300px;
                object-fit: cover;
                display: block;
                border-radius: 0.5rem;
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
                color: #0F3D5F;
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

            .suite-tags {
                display: flex;
                flex-wrap: wrap;
                padding-bottom: 20px;
                max-width: 380px;
                gap: 0.5rem 1rem;
            }

            .tag-item {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                background: white;
                padding: 0.5rem 1rem;
                border-radius: 999px;
                border: 1px solid #e0e0e0;
                font-size: 0.9rem;
                font-weight: 500;
                color: #2A2A2A;
            }

            .tag-item i {
                font-size: 18px;
                line-height: 1;
            }

            .tag-item .tag-icon-svg {
                width: 18px;
                height: 18px;
            }

            .tag-item .tag-icon-svg path {
                stroke: #1E1E1E;
            }

            .suite-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: auto;
            }

            .btn-primary {
                display: inline-flex;
                align-items: center;
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

            .btn-primary:hover {
                color: #093D5F;
                background-color: #fff;
                border-color: #093D5F;
                opacity: 1;
            }

            .btn-primary .btn-primary-icon {
                width: 13px;
                height: 12px;
                transition: transform 0.3s ease;
            }

            .btn-primary .btn-primary-icon path {
                fill: #fff;
                transition: fill 0.3s ease;
            }

            .btn-primary:hover .btn-primary-icon {
                transform: translateX(4px);
            }

            .btn-primary:hover .btn-primary-icon path {
                fill: #093D5F;
            }

            .wishlist {
                background: none;
                border: none;
                cursor: pointer;
                padding: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                width: 32px;
                height: 32px;
                transition: transform 0.3s ease;
            }

            .wishlist:hover {
                background-color: transparent;
                transform: scale(1.1);
            }

            .wishlist:active {
                transform: scale(0.9);
            }

            .wishlist .heart-icon {
                width: 24px;
                height: 24px;
                color: gray;
                transition: color 0.3s ease, fill 0.3s ease;
            }

            .wishlist .heart-icon path {
                transition: fill 0.3s ease, stroke 0.3s ease;
            }

            .wishlist:hover .heart-icon {
                color: #ff0000;
            }

            .wishlist .heart-icon path.filled {
                fill: #ff0000;
                stroke: #ff0000;
            }

            .wishlist-notification {
                position: fixed;
                left: 50%;
                transform: translateX(-50%);
                top: 50px;
                background-color: #81C784;
                color: white;
                padding: 15px 20px;
                border-radius: 8px;
                z-index: 1000;
                opacity: 0;
                transition: opacity 0.5s ease-in-out;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                font-size: 1rem;
            }

            .wishlist-notification.show {
                opacity: 1;
            }

            @media (max-width: 1024px) {
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

                .btn-primary {
                    font-size: 15px;
                    padding: 9px 18px;
                }

                .suite-card {
                    width: calc((100% - 2rem) / 2);
                }
            }

            @media (min-width: 768px) and (max-width: 1024px) {
                .suites-grid {
                    flex-wrap: nowrap;
                    overflow-x: auto;
                    justify-content: flex-start;
                    padding-bottom: 1rem;
                    -webkit-overflow-scrolling: touch;
                }

                .suite-card {
                    width: 380px;
                    min-width: 300px;
                    flex-shrink: 0;
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
                    font-size: 15px;
                }

                .suite-card {
                    width: 100%;
                    margin-bottom: 0;
                }

                .suites-grid {
                    gap: 1.5rem;
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

                .tag-item i,
                .tag-item .tag-icon-svg {
                    font-size: 20px;
                    width: 20px;
                    height: 20px;
                }

                .btn-primary {
                    padding: 10px 20px;
                    font-size: 14px;
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
                    flex-direction: row;
                    align-items: center;
                    gap: 1rem;
                }

                .btn-primary {
                    flex-grow: 1;
                    width: auto;
                    justify-content: center;
                    font-size: 14px;
                    padding: 12px 15px;
                }

                .wishlist {
                    flex-shrink: 0;
                }
            }
        </style>

        <section class="model-suites">
            <div class="suites-header">
                <h2><?php echo esc_html($settings['section_title']); ?></h2>
                <?php
                if (!empty($settings['show_more_link']['url'])) {
                    $link_url = $settings['show_more_link']['url'];
                    $link_text = !empty($settings['show_more_text']) ? esc_html($settings['show_more_text']) : esc_html__('Show More', 'elementor-addon');
                    $target = $settings['show_more_link']['is_external'] ? ' target="_blank"' : '';
                    $nofollow = $settings['show_more_link']['nofollow'] ? ' rel="nofollow"' : '';
                ?>
                    <a href="<?php echo esc_url($link_url); ?>" class="show-moreq" <?php echo $target . $nofollow; ?>>
                        <?php echo $link_text; ?>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="hero-button-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                <?php
                } elseif (!empty($settings['show_more_text'])) {
                ?>
                    <button class="show-moreq" type="button" disabled>
                        <?php echo esc_html($settings['show_more_text']); ?>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="hero-button-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                <?php
                }
                ?>
            </div>

            <div class="suites-grid">
                <?php foreach ($settings['suites_list'] as $key => $suite) : ?>
                    <div class="suite-card elementor-repeater-item-<?php echo esc_attr($suite['_id']); ?>">
                        <?php if (!empty($suite['image']['url'])) : ?>
                            <div class="suite-image-wrapper">
                                <img src="<?php echo esc_url($suite['image']['url']); ?>" alt="<?php echo esc_attr($suite['title']); ?>">
                            </div>
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
                                if (!empty($suite['bedrooms']) && intval($suite['bedrooms']) > 0) {
                                    echo '<span class="tag-item">';
                                    echo '<i class="fa fa-bed"></i>';
                                    echo esc_html($suite['bedrooms']) . ' ' . (intval($suite['bedrooms']) > 1 ? esc_html__('Bedrooms', 'elementor-addon') : esc_html__('Bedroom', 'elementor-addon'));
                                    echo '</span>';
                                }
                                if (!empty($suite['bathrooms']) && intval($suite['bathrooms']) > 0) {
                                    echo '<span class="tag-item">';
                                    echo '<i class="fa fa-bath"></i>';
                                    echo esc_html($suite['bathrooms']) . ' ' . (intval($suite['bathrooms']) > 1 ? esc_html__('Bathrooms', 'elementor-addon') : esc_html__('Bathroom', 'elementor-addon'));
                                    echo '</span>';
                                }
                                if (!empty($suite['square_meters'])) {
                                    echo '<span class="tag-item">';
                                    echo '<svg class="tag-icon-svg" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.33333 2.75H4.58333C4.0971 2.75 3.63079 2.94315 3.28697 3.28697C2.94315 3.63079 2.75 4.0971 2.75 4.58333V7.33333M19.25 7.33333V4.58333C19.25 4.0971 19.0568 3.63079 18.713 3.28697C18.3692 2.94315 17.9029 2.75 17.4167 2.75H14.6667M14.6667 19.25H17.4167C17.9029 19.25 18.3692 19.0568 18.713 18.713C19.0568 18.3692 19.25 17.9029 19.25 17.4167V14.6667M2.75 14.6667V17.4167C2.75 17.9029 2.94315 18.3692 3.28697 18.713C3.63079 19.0568 4.0971 19.25 4.58333 19.25H7.33333" stroke="#1E1E1E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>';
                                    echo esc_html($suite['square_meters']) . ' ' . esc_html__('sq ft', 'elementor-addon');
                                    echo '</span>';
                                }
                                echo '<span class="tag-item">';
                                echo '<i class="fa fa-paw"></i>';
                                echo esc_html__('Pet-friendly', 'elementor-addon');
                                echo '</span>';
                                ?>
                            </div>
                            <div class="suite-footer">
                                <?php if (!empty($suite['button_link']['url']) && !empty($suite['button_text'])) :
                                    $target = $suite['button_link']['is_external'] ? ' target="_blank"' : '';
                                    $nofollow = $suite['button_link']['nofollow'] ? ' rel="nofollow"' : '';
                                ?>
                                    <a class="btn-primary" href="<?php echo esc_url($suite['button_link']['url']); ?>" <?php echo $target . $nofollow; ?>>
                                        <?php echo esc_html($suite['button_text']); ?>
                                        <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="btn-primary-icon">
                                            <path d="M11.5 -0.0078125C12.0523 -0.0078125 12.5 0.439903 12.5 0.992188V10.9922C12.5 11.5445 12.0523 11.9922 11.5 11.9922C10.9477 11.9922 10.5 11.5445 10.5 10.9922V3.33203L2.20703 11.6992C1.81651 12.0897 1.18349 12.0897 0.792969 11.6992C0.402446 11.3087 0.402445 10.6757 0.792969 10.2852L9.0127 1.99219H1.5C0.947715 1.99219 0.5 1.54447 0.5 0.992188C0.5 0.439903 0.947715 -0.0078125 1.5 -0.0078125H11.5Z" />
                                        </svg>
                                    </a>
                                <?php endif; ?>
                                <button class="wishlist" data-unit-id="<?php echo esc_attr($suite['_id']); ?>" aria-label="Add to wishlist">
                                    <svg class="heart-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 21.35L10.55 20.03C5.4 15.36 2 12.28 2 8.5C2 5.42 4.42 3 7.5 3C9.24 3 10.91 3.81 12 5.09C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.42 22 8.5C22 12.28 18.6 15.36 13.45 20.03L12 21.35Z" fill="none" stroke="currentColor" stroke-width="2" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const wishlistButtons = document.querySelectorAll('.wishlist');

                function toggleWishlistItem(unitId) {
                    let wishlist = JSON.parse(localStorage.getItem('wishlist') || '[]');
                    const index = wishlist.indexOf(unitId);
                    let added = false;

                    if (index === -1) {
                        wishlist.push(unitId);
                        showWishlistMessage(unitId, 'added to', '#81C784');
                        added = true;
                    } else {
                        wishlist.splice(index, 1);
                        showWishlistMessage(unitId, 'removed from', '#F44336');
                        added = false;
                    }

                    localStorage.setItem('wishlist', JSON.stringify(wishlist));
                    return added;
                }

                function showWishlistMessage(unitId, action, color) {
                    const existingNotification = document.querySelector('.wishlist-notification');
                    if (existingNotification) {
                        existingNotification.remove();
                    }

                    const messageDiv = document.createElement('div');
                    messageDiv.classList.add('wishlist-notification');
                    const suiteCard = document.querySelector(`.suite-card .wishlist[data-unit-id="${unitId}"]`)?.closest('.suite-card');
                    let displayName = unitId;
                    if (suiteCard) {
                        const titleElement = suiteCard.querySelector('.suite-title-price h3');
                        if (titleElement && titleElement.textContent.trim() !== '') {
                            displayName = `"${titleElement.textContent.trim()}"`;
                        }
                    }
                    messageDiv.textContent = `Suite ${displayName} ${action} favorites!`;
                    messageDiv.style.backgroundColor = color;
                    document.body.appendChild(messageDiv);

                    setTimeout(() => {
                        messageDiv.classList.add('show');
                    }, 10);

                    setTimeout(() => {
                        messageDiv.classList.remove('show');
                        setTimeout(() => {
                            messageDiv.remove();
                        }, 500);
                    }, 2000);
                }

                function markWishlistItems() {
                    const wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];
                    const allWishlistButtons = document.querySelectorAll('.wishlist');

                    allWishlistButtons.forEach(button => {
                        const unitId = button.dataset.unitId;
                        const heartIconPath = button.querySelector('.heart-icon path');

                        if (unitId && heartIconPath) {
                            if (wishlist.includes(unitId)) {
                                heartIconPath.classList.add('filled');
                            } else {
                                heartIconPath.classList.remove('filled');
                            }
                        }
                    });
                }

                wishlistButtons.forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();
                        event.stopPropagation();

                        const unitId = this.dataset.unitId;
                        const heartIconPath = this.querySelector('.heart-icon path');

                        if (unitId && heartIconPath) {
                            const wasAdded = toggleWishlistItem(unitId);
                            if (wasAdded) {
                                heartIconPath.classList.add('filled');
                            } else {
                                heartIconPath.classList.remove('filled');
                            }
                        }
                    });
                });
                markWishlistItems();
            });
        </script>

<?php
    }
}
