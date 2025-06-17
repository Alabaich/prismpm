<?php
class Elementor_propertyGridSec extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'propertyGridSec';
    }

    public function get_title()
    {
        return esc_html__('Property Grid', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
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
                    ['title' => '80 Bond', 'address' => '80 Bond St, Toronto', 'developer' => 'Atria Development', 'label_left' => 'Profile', 'value_left' => 'TBD', 'launch_date' => '2026', 'image' => ['url' => ''], 'image_link' => [], 'button_text' => 'Rent Now', 'button_link' => []],
                    ['title' => '100 Bond', 'address' => '100 Bond St, Toronto', 'developer' => 'Atria Development', 'label_left' => 'Profile', 'value_left' => 'TBD', 'launch_date' => '2026', 'image' => ['url' => ''], 'image_link' => [], 'button_text' => 'Rent Now', 'button_link' => []],
                    ['title' => 'Y Loft', 'address' => 'Y Loft St, Toronto', 'developer' => 'Atria Development', 'label_left' => 'Profile', 'value_left' => 'TBD', 'launch_date' => '2026', 'image' => ['url' => ''], 'image_link' => [], 'button_text' => 'Rent Now', 'button_link' => []],
                    ['title' => 'George Street Lofts', 'address' => 'George St, Toronto', 'developer' => 'Atria Development', 'label_left' => 'Profile', 'value_left' => 'TBD', 'launch_date' => '2026', 'image' => ['url' => ''], 'image_link' => [], 'button_text' => 'Rent Now', 'button_link' => []],
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
            .property-grid-section {
                padding: 25px 10%;
                width: 100%;
            }
            @media screen and (max-width: 1600px) {
                .property-grid-section {
                    padding: 25px;
                }
            }
            @media screen and (max-width: 768px) {
                .property-grid-section {
                    padding: 15px;
                }
            }

            .property-grid-section .title-container {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-wrap: nowrap;
                text-align:center;
                margin:0;
                padding-bottom: 25px;
            }

            .property-grid-section .section-titles {
                display: flex;
                flex-direction: column;
            }

            .property-grid-section .section-titles h1.customTitle {
                margin: 0;
                color: #1A1A1A;
                padding-bottom:20px;
            }

            .property-grid-section .section-titles .customSubtitle {
                color: #52525B;
                margin-bottom: 0;
            }
                        .property-grid-section .section-titles .customSubtitle p{
                color: #52525B;
                margin: 0;
            }

            .property-grid-section .section-titles .customSubtitle p:empty,
            .property-grid-section .section-titles .customSubtitle p>br:only-child {
                display: none;
            }

            .property-grid-section .section-img img {
                max-width: 100%;
                object-fit:cover;
                height: 380px;
            }

            .property-grid-section .property-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 25px;
                width: 100%;
            }

            .property-grid-section .property-card {
                background: #F7F9FA;
                border-radius: 8px;
                padding: 25px;
                display: flex;
                flex-direction: column;
                gap: 20px;
            }

            .property-grid-section .property-card .property-image img {
                width: 100%;
                height: 360px;
                object-fit: cover;
                border-radius: 8px;
            }

            .property-grid-section .property-card h3 {
                margin:0;
                padding-bottom:10px;
                color: #1A1A1A;
                text-align: left;
                font-weight:600;
            }

            .property-grid-section .property-card .metaq {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 1rem;
                font-size: 0.875rem;
                text-align: left;
                margin: 0;
                font-family:"Playfair Display";
            }

            .property-grid-section .property-card .metaq div {
                display: flex;
                flex-direction: column;
                gap: 4px;
            }

            .property-grid-section .property-card .metaq h5 {
                color: #6B7280;
                margin: 0;
                font-weight: 500;
                font-size:1rem;
            }

            .property-grid-section .property-card .metaq span {
                color: #2A2A2A;
                font-weight: 500;
                font-size:1.5rem;
            }

            .property-grid-section .property-card .property-button a {
                display: inline-flex;
                align-items: center;
                padding: 10px 20px;
                text-decoration: none;
                color: #fff;
                background-color: #093D5F;
                font-size: 1rem;
                border-radius: 99999px;
                gap: 0.5rem;
                transition: all 0.3s ease;
            }

            .property-grid-section .property-card .property-button a svg path {
                fill: currentColor;
                transition: fill 0.3s ease;
            }

            .property-grid-section .property-card .property-button a:hover {
                color: #093D5F;
                background-color: #fff;
                border: 2px solid #093D5F;
            }

            .property-grid-section .property-card .property-button a:hover svg {
                transform: translateX(4px);
            }

            @media (max-width: 768px) {
                .property-grid-section .property-grid {
                    grid-template-columns: 1fr;
                }

                .property-grid-section .property-card .property-image img {
                    height: 12rem;
                }

                .property-grid-section .property-card h3 {
                    font-size: 1.25rem;
                }

                .property-grid-section .property-card .metaq {
                    grid-template-columns: 1fr;
                    gap: 0.75rem;
                }

                .property-grid-section .property-card .property-button a {
                    font-size: 0.95rem;
                    padding: 8px 16px;
                }
            }
        </style>

        <?php
        $classes = ['property-grid-section'];
        $is_placeholder_image = false;
        if (!empty($settings['section_image']['url'])) {
            if (empty($settings['section_image']['id']) && $settings['section_image']['url'] === \Elementor\Utils::get_placeholder_image_src()) {
                $is_placeholder_image = true;
            }
        } else {
            $is_placeholder_image = true;
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
                    <div class="section-img">
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
                <div class="property-grid">
                    <?php foreach ($settings['properties'] as $item_index => $item): ?>
                        <div class="property-card elementor-repeater-item-<?= esc_attr($item['_id']); ?>">
                            <div class="property-image">
                                <?php if (!empty($item['image']['url'])): ?>
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
                                <?php endif; ?>
                            </div>
                            <h3><?= esc_html($item['title']); ?></h3>
                            <div class="metaq">
                                <?php if (!empty($item['address'])): ?>
                                    <div>
                                        <h5>Address:</h5> <span><?= esc_html($item['address']); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($item['developer'])): ?>
                                    <div>
                                        <h5>Developer:</h5> <span><?= esc_html($item['developer']); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($item['label_left']) || !empty($item['value_left'])): ?>
                                    <div>
                                        <h5><?= esc_html($item['label_left']); ?>:</h5> <span><?= esc_html($item['value_left']); ?></span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($item['launch_date'])): ?>
                                    <div>
                                        <h5>Estimated Launch:</h5> <span><?= esc_html($item['launch_date']); ?></span>
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
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
<?php
    }
}