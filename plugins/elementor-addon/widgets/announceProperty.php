<?php

class Elementor_announceProperty extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'announceProperty';
    }

    public function get_title()
    {
        return esc_html__('Announce Property', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-post-list';
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
                'label' => esc_html__('Section Content', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'is_first_page',
            [
                'label' => esc_html__('Is First Page?', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'Yes',
                'label_off' => 'No',
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Find Your Perfect Home!',
            ]
        );

        $this->add_control(
            'section_subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => 'Explore more properties and details at AtriaDevelopment.ca',
            ]
        );

        $this->add_control(
            'section_image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'section_image_link',
            [
                'label' => esc_html__('Image Link', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Property Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Town Centre Place',
            ]
        );

        $repeater->add_control(
            'address',
            [
                'label' => esc_html__('Address', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '1680 Brimley Rd, Toronto',
            ]
        );

        $repeater->add_control(
            'developer',
            [
                'label' => esc_html__('Developer', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Atria Development',
            ]
        );

        $repeater->add_control(
            'label_left',
            [
                'label' => esc_html__('Left Label (e.g. Towers or Units)', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Towers',
            ]
        );

        $repeater->add_control(
            'value_left',
            [
                'label' => esc_html__('Left Value (e.g. 4 or 244)', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '4',
            ]
        );

        $repeater->add_control(
            'launch_date',
            [
                'label' => esc_html__('Estimated Launch', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Fall 2026',
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'image_link',
            [
                'label' => esc_html__('Image Link', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Pre-Register',
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => esc_html__('Pre-Register Link', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => 'https://your-link.com',
            ]
        );

        $this->add_control(
            'properties',
            [
                'label' => esc_html__('Properties', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['title' => '80 Bond', 'address' => '80 Bond St, Toronto', 'developer' => 'Atria Development', 'label_left' => 'TBI', 'value_left' => '', 'launch_date' => '', 'image' => ['url' => ''], 'image_link' => [], 'button_text' => 'Pre-Register', 'button_link' => []],
                    ['title' => '100 Bond', 'address' => '100 Bond St, Toronto', 'developer' => 'Atria Development', 'label_left' => 'TBI', 'value_left' => '', 'launch_date' => '', 'image' => ['url' => ''], 'image_link' => [], 'button_text' => 'Pre-Register', 'button_link' => []],
                    ['title' => 'Lof', 'address' => 'Lof St, Toronto', 'developer' => 'Atria Development', 'label_left' => 'TBI', 'value_left' => '', 'launch_date' => '', 'image' => ['url' => ''], 'image_link' => [], 'button_text' => 'Pre-Register', 'button_link' => []],
                    ['title' => 'George Street Lofts', 'address' => 'George St, Toronto', 'developer' => 'Atria Development', 'label_left' => 'TBI', 'value_left' => '', 'launch_date' => '', 'image' => ['url' => ''], 'image_link' => [], 'button_text' => 'Pre-Register', 'button_link' => []],
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>

        <style>
                        .coming-soon-section {
                padding: 25px 10%;
                width: 100%; 
            }
            @media screen and (max-width: 1600px) {
                .coming-soon-section {
                    padding: 25px;
                }
            }
            @media screen and (max-width: 768px) {
                .coming-soon-section {
                    padding: 15px;
                }
            }
            .coming-soon-section {
            }

            .coming-soon-section h1.customTitle {
                margin-bottom: 0.625rem;
            }

            .coming-soon-section div.customSubtitle {
                color: #52525B;
                margin-bottom: 1.875rem;
                text-align: left;
            }

            .coming-soon-section div.customSubtitle p:empty,
            .coming-soon-section div.customSubtitle p>br:only-child {
                display: none;
            }

            .title-container .section-titles .customSubtitle a {
                color: #093D5F;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
                position: relative;
                display: inline-block;
            }

            .title-container .section-titles .customSubtitle a:hover {
                color: rgb(6, 91, 151);
                text-decoration: underline;
                text-underline-offset: 3px;
                text-decoration-thickness: 2px;
            }

            .coming-soon-section.first-page p {
                max-width: 500px;
            }

            .coming-soon-section.first-page div.customSubtitle {
                text-align: center;
            }

            .coming-soon-section .property-card {
                display: flex;
                justify-content: space-between;
                background: #f9f9f9;
                padding: 1.25rem;
                border-radius: 0.75rem;
                margin-bottom: 1.25rem;
                flex-wrap: nowrap;
                gap: 1.5rem;
            }

            .coming-soon-section .property-content {
                width: 55%;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                order: 1;
            }

            .coming-soon-section .property-image {
                width: 45%;
                max-width: 586px;
                flex-shrink: 0;
                display: flex;
                align-items: center;
                order: 2;
            }

            .coming-soon-section .property-image img {
                border-radius: 0.25rem;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .coming-soon-section .property-content h3 {
                font-size: 32px;
                margin-bottom: 0.625rem;
                text-align: left;
            }

            .coming-soon-section .property-content .metaq {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 2.5rem;
                font-size: 0.875rem;
                text-align: left;
            }

            .metaq div {
                display: flex;
                flex-direction: column;
                gap: 0.75rem 0;
                font-family: "Inter Tight", sans-serif;
                font-weight: 500;
            }

            .metaq h6 {
                font-size: 1rem;
                color: #6B7280;
                margin: 0;
                font-weight: 500;
            }

            .metaq span {
                font-size: 1.25rem;
                color: #2A2A2A;
                font-weight: 500;
                overflow-wrap: break-word;
                word-break: break-word;
            }

            .property-button {
                margin-top: auto;
                text-align: left;
            }

            .property-button a {
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

            .property-button a svg path {
                fill: currentColor;
                transition: fill 0.3s ease;
            }

            .property-button a:hover {
                color: #093D5F;
                background-color: #fff;
                border-color: #093D5F;
            }

            .property-button a svg {
                transition: transform 0.3s ease;
            }

            .property-button a:hover svg {
                transform: translateX(4px);
            }

            .title-container {
                display: flex;
                justify-content: space-between;
                align-items: start;
                flex-wrap: nowrap;
            }

            .section-titles {
                display: flex;
                flex-direction: column;
            }

            .section-img img {
                max-width: 15rem;
                height: auto;
            }

            .flex {
                display: flex;
            }

            .coming-soon-section.centered-header .title-container {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 1rem;
            }

            .coming-soon-section.centered-header .section-titles {
                align-items: center;
            }

            .coming-soon-section.centered-header .section-img {
                display: none;
            }

            .coming-soon-section.first-page {
                padding-top: 6rem;
            }

            /* Tablet / iPad Air specific styles */
            @media (min-width: 769px) and (max-width: 821px) {
                .coming-soon-section {
                    padding: 2rem 1.5rem;
                    align-items: center;
                }

                .title-container,
                .coming-soon-section.centered-header .title-container {
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                    gap: 1rem;
                    width: 100%;
                }

                .section-titles,
                .coming-soon-section.centered-header .section-titles {
                    align-items: center;
                    text-align: center;
                }

                .coming-soon-section.first-page p,
                .coming-soon-section div.customSubtitle {
                    text-align: center;
                }

                .section-img,
                .coming-soon-section.centered-header .section-img {
                    display: none;
                }

                .coming-soon-section .property-card {
                    flex-direction: column;
                    align-items: center;
                    width: 100%;
                    padding: 1.25rem;
                    gap: 0;
                }

                .coming-soon-section .property-content {
                    order: 2;
                    width: 100%;
                    max-width: 100%;
                    min-width: 0;
                    flex: 0 0 auto;
                    text-align: center;
                }

                .coming-soon-section .property-image {
                    order: 1;
                    width: 100%;
                    max-width: 100%;
                    min-width: 0;
                    flex: 0 0 auto;
                    margin-bottom: 1.5rem;
                }

                .coming-soon-section .property-image img {
                    width: 100%;
                    height: auto;
                    max-height: 350px;
                    object-fit: cover;
                    border-radius: 0.5rem;
                }

                .coming-soon-section .property-content h3 {
                    text-align: center;
                    font-size: 28px;
                    margin-bottom: 1rem;
                }

                .coming-soon-section .property-content .metaq {
                    grid-template-columns: 1fr;
                    gap: 1rem;
                    margin-bottom: 1.5rem;
                    text-align: left;
                }

                .metaq div {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 0.25rem;
                    padding: 0 0.5rem;
                }

                .metaq div h6 {
                    font-size: 0.9rem;
                    color: #6B7280;
                    margin: 0;
                }

                .metaq div span {
                    font-size: 1.1rem;
                    color: #2A2A2A;
                    text-align: left;
                    width: 100%;
                }

                .property-button {
                    margin-top: auto;
                    display: flex;
                    justify-content: center;
                    width: 100%;
                    text-align: center;
                }

                .property-button a {
                    font-size: 1rem;
                }
            }

            /* Mobile styles ( <= 768px ) */
            @media (max-width: 768px) {
                .coming-soon-section {
                    padding: 2rem 1rem;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }

                .title-container,
                .coming-soon-section.centered-header .title-container {
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                    gap: 1rem;
                    width: 100%;
                }

                .section-titles,
                .coming-soon-section.centered-header .section-titles {
                    align-items: center;
                    text-align: center;
                }

                .section-img,
                .coming-soon-section.centered-header .section-img {
                    display: none;
                }

                .coming-soon-section.first-page p,
                .coming-soon-section div.customSubtitle {
                    text-align: center;
                }

                .section-titles h1.customTitle,
                .coming-soon-section.first-page h1.customTitle {
                    font-weight: 600;
                    font-size: 28px;
                    line-height: 1.1;
                    text-align: center;
                    color: #2a2a2a;
                    margin-bottom: 1rem;
                }

                .coming-soon-section .property-card {
                    flex-direction: column;
                    align-items: center;
                    width: 100%;
                    max-width: 100%;
                    padding: 1rem;
                    gap: 0;
                }

                .coming-soon-section .property-content {
                    order: 2;
                    min-width: auto;
                    width: 100%;
                    text-align: center;
                    flex: 0 0 auto;
                }

                .coming-soon-section .property-image {
                    order: 1;
                    width: 100%;
                    max-width: 100%;
                    min-width: 0;
                    flex: 0 0 auto;
                    margin-bottom: 1rem;
                }

                .coming-soon-section .property-image img {
                    width: 100%;
                    height: auto;
                    max-height: 280px;
                    object-fit: cover;
                    border-radius: 0.5rem;
                }

                .coming-soon-section .property-content h3 {
                    font-family: 'Darker Grotesque', sans-serif;
                    font-weight: 600;
                    font-size: 26px;
                    line-height: 1.1;
                    text-align: center;
                    color: #2a2a2a;
                    margin-bottom: 1rem;
                }

                .coming-soon-section .property-content .metaq {
                    grid-template-columns: 1fr;
                    gap: 0.75rem;
                    margin-bottom: 1rem;
                    text-align: left;
                }

                .metaq div {
                    display: flex;
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 0.25rem;
                }

                .metaq div h6 {
                    margin: 0;
                    color: #6B7280;
                    font-size: 0.875rem;
                    font-weight: 500;
                }

                .metaq div span {
                    font-size: 1rem;
                    color: #2A2A2A;
                    text-align: left;
                    width: 100%;
                    overflow-wrap: break-word;
                    word-break: break-word;
                    font-weight: 500;
                }

                .property-button {
                    margin-top: 1rem;
                    display: flex;
                    justify-content: center;
                    width: 100%;
                    text-align: center;
                }

                .property-button a {
                    font-size: 0.95rem;
                    padding: 10px 18px;
                }
            }
        </style>

        <?php
        $classes = ['coming-soon-section'];
        $is_placeholder_image = false;
        if (!empty($settings['section_image']['url'])) {
            if (empty($settings['section_image']['id']) && $settings['section_image']['url'] === \Elementor\Utils::get_placeholder_image_src()) {
                $is_placeholder_image = true;
            }
        } else {
            $is_placeholder_image = true;
        }

        if ($is_placeholder_image) {
            $classes[] = 'centered-header';
        }

        if ($settings['is_first_page'] === 'yes') {
            $classes[] = 'first-page';
        }
        ?>
        <div class="<?= implode(' ', $classes); ?>">
            <div class="title-container">
                <div class="section-titles">
                    <?php if (!empty($settings['section_title'])): ?>
                        <h1 class="customTitle"><?= esc_html($settings['section_title']); ?></h1>
                    <?php endif; ?>
                    <?php
                    if (!empty($settings['section_subtitle'])) {
                        $subtitle_html = $settings['section_subtitle'];
                        $subtitle_html_cleaned = preg_replace('/<p\b[^>]*>(\s| |<br\s*\/?>)*<\/p>/im', '', $subtitle_html);
                        $subtitle_html_cleaned = trim($subtitle_html_cleaned);
                        $subtitle_html_processed = wp_kses_post($subtitle_html_cleaned);

                        if (!empty($subtitle_html_processed)) {
                            echo '<div class="customSubtitle">' . $subtitle_html_processed . '</div>';
                        }
                    }
                    ?>
                </div>
                <?php if (!$is_placeholder_image && !empty($settings['section_image']['url'])) : ?>
                    <div class="section-img flex">
                        <?php
                        $section_img_url = $settings['section_image']['url'];
                        $section_img_alt = esc_attr($settings['section_title']);
                        if (!empty($settings['section_image_link']['url'])):
                            $target_section_img = !empty($settings['section_image_link']['is_external']) ? '_blank' : '_self';
                            $nofollow_section_img = !empty($settings['section_image_link']['nofollow']) ? 'nofollow' : '';
                        ?>
                            <a href="<?= esc_url($settings['section_image_link']['url']); ?>" target="<?= esc_attr($target_section_img); ?>" <?= $nofollow_section_img ? 'rel="' . esc_attr($nofollow_section_img) . '"' : ''; ?>>
                                <img src="<?= esc_url($section_img_url); ?>" alt="<?= $section_img_alt; ?>" />
                            </a>
                        <?php else: ?>
                            <img src="<?= esc_url($section_img_url); ?>" alt="<?= $section_img_alt; ?>" />
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($settings['properties'])) : ?>
                <?php foreach ($settings['properties'] as $item_index => $item): ?>
                    <div class="property-card elementor-repeater-item-<?= esc_attr($item['_id']); ?>">

                        <div class="property-content">
                            <?php if (!empty($item['title'])): ?>
                                <h3><?= esc_html($item['title']); ?></h3>
                            <?php endif; ?>

                            <div class="metaq">
                                <?php if (!empty($item['address'])): ?>
                                    <div>
                                        <h6>Address:</h6> <span><?= esc_html($item['address']); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($item['developer'])): ?>
                                    <div>
                                        <h6>Developer:</h6> <span><?= esc_html($item['developer']); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($item['label_left']) || !empty($item['value_left'])): ?>
                                    <div>
                                        <h6><?= esc_html($item['label_left']); ?>:</h6> <span><?= esc_html($item['value_left']); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($item['launch_date'])): ?>
                                    <div>
                                        <h6>Estimated Launch:</h6> <span><?= esc_html($item['launch_date']); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($item['button_text']) && !empty($item['button_link']['url'])):
                                $target_button = !empty($item['button_link']['is_external']) ? '_blank' : '_self';
                                $nofollow_button = !empty($item['button_link']['nofollow']) ? 'nofollow' : '';
                            ?>
                                <div class="property-button">
                                    <a href="<?= esc_url($item['button_link']['url']); ?>" target="<?= esc_attr($target_button); ?>" <?= $nofollow_button ? 'rel="' . esc_attr($nofollow_button) . '"' : ''; ?>>
                                        <?= esc_html($item['button_text']); ?>
                                        <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="anounc-button-icon" aria-hidden="true">
                                            <path d="M11.5 -0.0078125C12.0523 -0.0078125 12.5 0.439903 12.5 0.992188V10.9922C12.5 11.5445 12.0523 11.9922 11.5 11.9922C10.9477 11.9922 10.5 11.5445 10.5 10.9922V3.33203L2.20703 11.6992C1.81651 12.0897 1.18349 12.0897 0.792969 11.6992C0.402446 11.3087 0.402445 10.6757 0.792969 10.2852L9.0127 1.99219H1.5C0.947715 1.99219 0.5 1.54447 0.5 0.992188C0.5 0.439903 0.947715 -0.0078125 1.5 -0.0078125H11.5Z" fill="currentColor" />
                                        </svg>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($item['image']['url'])): ?>
                            <div class="property-image">
                                <?php
                                $property_img_url = $item['image']['url'];
                                $property_img_alt = !empty($item['title']) ? esc_attr($item['title']) : 'Property Image';
                                if (!empty($item['image_link']['url'])):
                                    $target_item_img = !empty($item['image_link']['is_external']) ? '_blank' : '_self';
                                    $nofollow_item_img = !empty($item['image_link']['nofollow']) ? 'nofollow' : '';
                                ?>
                                    <a href="<?= esc_url($item['image_link']['url']); ?>" target="<?= esc_attr($target_item_img); ?>" <?= $nofollow_item_img ? 'rel="' . esc_attr($nofollow_item_img) . '"' : ''; ?>>
                                        <img src="<?= esc_url($property_img_url); ?>" alt="<?= $property_img_alt; ?>">
                                    </a>
                                <?php else: ?>
                                    <img src="<?= esc_url($property_img_url); ?>" alt="<?= $property_img_alt; ?>">
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

<?php
    }
}