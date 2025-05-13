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
                'default' => 'Properties Coming Soon',
            ]
        );

        $this->add_control(
            'section_subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => 'Explore more properties and details at Atriadevelopment.ca',
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
                'default' => [],
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
                padding: 3.75rem 5rem;
            }

            .coming-soon-section h1 {
                margin-bottom: 0.625rem;
                font-size: 52px;
                font-family: "Playfair Display", serif;
                /* 10px */
            }

            .coming-soon-section.first-page h1 {
                font-size: 72px;
            }

            .coming-soon-section p {
                font-family: "Inter Tight", sans-serif;
                color: #52525B;
                margin-bottom: 1.875rem;
                font-size: 1rem;
                /* 30px */
            }

            .coming-soon-section.first-page p {
                max-width: 500px;
            }

            .coming-soon-section .property-card {
                display: flex;
                justify-content: space-between;
                background: #f9f9f9;
                padding: 1.25rem;
                /* 20px */
                border-radius: 0.75rem;
                /* 12px */
                margin-bottom: 1.25rem;
                /* 20px */
                flex-wrap: nowrap;
            }

            .coming-soon-section .property-content {
                max-width: 100%;
                min-width: 34.875rem;
                /* 558px */
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
                /* 8px */
            }

            .coming-soon-section .property-content h3 {
                font-size: 32px;
                margin-bottom: 0.625rem;
                /* 10px */
            }

            .coming-soon-section .property-content .metaq {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 2.5rem;
                /* 40px */
                font-size: 0.875rem;
                /* 14px */
            }

            .coming-soon-section .property-image img {
                border-radius: 0.25rem;
                /* 8px */
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .coming-soon-section .property-image {
                max-width: 100%;
                max-width: 586px;
                min-height: auto;
                min-width: auto;
                flex: 1 1 50%;
            }

            .metaq div {
                display: flex;
                flex-direction: column;
                gap: 0.75rem 0;
                /* 12px 0 */
                font-family: "Inter Tight", sans-serif;
                font-weight: 500;
            }

            .metaq h6 {
                font-size: 1rem;
                color: #6B7280;
                margin: 0;
            }

            .metaq span {
                font-size: 1.25rem;
                color: #2A2A2A;
            }

            .property-button {
                margin-top: auto;
                padding-bottom: 2rem;
                transition: 0.3s ease;
            }

            .property-button a {
                font-family: "Inter Tight", sans-serif;
                display: inline-flex;
                align-items: center;
                background: #093D5F;
                color: #fff;
                padding: 18px 28px;
                border-radius: 99999px;
                font-weight: 500;
                font-size: 1rem;
                text-decoration: none;
                transition: all 0.3s ease;
                gap: 1rem;
                transform: scale(1);
            }

            .property-button a svg {
                transition: transform 0.3s ease;
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
                /* 240px */
                height: auto;
            }

            .flex {
                display: flex;
            }

            .property-button a:hover svg {
                transform: translateX(4px);
                margin-left: 0.5rem;
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

            .title-container .section-titles .subtitle-content a {
                color: #093D5F;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
                position: relative;
                display: inline-block;
            }

            .title-container .section-titles .subtitle-content a:hover {
                color: rgb(6, 91, 151);
                text-decoration: underline;
                text-underline-offset: 3px;
                text-decoration-thickness: 2px;
            }

            .title-container .section-titles .subtitle-content a:hover::after {
                width: 100%;
            }

            .coming-soon-section.centered-header .section-img {
                display: none;
            }

            .coming-soon-section.first-page {
                padding-top: 6rem;
            }


            .anounc-button-icon {
                rotate: -45deg;
            }

            @media (max-width: 768px) {
                .coming-soon-section .property-card {
                    flex-direction: column;
                    text-align: left;
                    max-width: 100%;
                }

                .coming-soon-section {
                    padding: 2rem 1rem;
                    display: flex;
                    flex-direction: column;
                    justify-items: center;
                    align-items: center;
                }

                .coming-soon-section .property-content {
                    min-width: auto;
                }

                .coming-soon-section .property-image {
                    max-width: 310px;
                    min-width: 310px;
                    min-height: 200px;
                    max-height: 200px;
                    order: -1;
                    margin-bottom: 1rem;
                }

                .coming-soon-section .property-image img {
                    height: auto;
                    max-height: 200px;
                    max-width: 310px;
                    min-height: 200px;
                    min-width: 310px;
                    object-fit: cover;
                    border-radius: 0.5rem;
                }

                .coming-soon-section .property-content {
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    height: 100%;
                    min-height: 300px;
                    width: 100%;
                }

                .coming-soon-section .property-content h3 {
                    font-family: 'Darker Grotesque', sans-serif;
                    font-weight: 600;
                    font-size: 28px;
                    line-height: 90%;
                    text-align: center;
                    vertical-align: middle;
                    color: #2a2a2a;
                }

                .coming-soon-section .property-content .metaq {
                    grid-template-columns: 1fr;
                    gap: 1rem;
                    margin-bottom: auto;
                }

                .metaq div {
                    display: flex;
                    justify-content: space-between;
                    flex-direction: row;
                    flex-wrap: wrap;
                    gap: 1rem;
                    font-size: 0.875rem;
                }

                .metaq span {
                    font-size: 1rem;
                }

                .metaq h6 {
                    margin: 0;
                }

                .property-button {
                    margin-top: auto;
                    display: flex;
                    justify-content: flex-start;
                    margin-bottom: 1rem;
                }

                .property-button a {
                    font-size: 1rem;
                    padding: 0.625rem 1.25rem;
                }

                .section-img {
                    display: none;
                }

                .section-titles {
                    align-items: center;
                    text-align: center;
                }

                .title-container {
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                    gap: 1rem;
                }

                .section-titles h1,
                .coming-soon-section.first-page h1 {
                    font-family: 'Darker Grotesque', sans-serif;
                    font-weight: 600;
                    font-size: 28px;
                    line-height: 90%;
                    text-align: center;
                    vertical-align: middle;
                    color: #2a2a2a;
                    margin-bottom: 1.5rem;
                }

                .section-titles h1,
                .section-titles p {
                    margin-top: 0;
                    text-align: center;
                }
            }
        </style>


        <?php
        $classes = ['coming-soon-section'];
        if (empty($settings['section_image']['url'])) {
            $classes[] = 'centered-header';
        }
        if ($settings['is_first_page'] === 'yes') {
            $classes[] = 'first-page';
        }
        ?>
        <div class="<?= implode(' ', $classes); ?>">
            <div class="title-container">
                <div class="section-titles">
                    <h1 class="flex"><?= esc_html($settings['section_title']); ?></h1>
                    <div class="flex subtitle-content"><?= wp_kses_post($settings['section_subtitle']); ?></div>
                </div>
                <?php if (!empty($settings['section_image']['url'])) : ?>
                    <div class="section-img flex">
                        <?php if (!empty($settings['section_image_link']['url'])): ?>
                            <a href="<?= esc_url($settings['section_image_link']['url']); ?>" target="<?= esc_attr($settings['section_image_link']['is_external'] ? '_blank' : '_self'); ?>">
                                <img src="<?= esc_url($settings['section_image']['url']); ?>" alt="Section Image" />
                            </a>
                        <?php else: ?>
                            <img src="<?= esc_url($settings['section_image']['url']); ?>" alt="Section Image" />
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php foreach ($settings['properties'] as $item): ?>
                <div class="property-card">
                    <div class="property-content">
                        <h3><?= esc_html($item['title']); ?></h3>
                        <div class="metaq">
                            <div>
                                <h6>Address:</h6> <span><?= esc_html($item['address']); ?></span>
                            </div>
                            <div>
                                <h6>Developer:</h6> <span><?= esc_html($item['developer']); ?></span>
                            </div>
                            <div>
                                <h6><?= esc_html($item['label_left']); ?>:</h6> <span><?= esc_html($item['value_left']); ?></span>
                            </div>
                            <div>
                                <h6>Estimated Launch:</h6> <span><?= esc_html($item['launch_date']); ?></span>
                            </div>
                        </div>

                        <?php if (!empty($item['button_link']['url'])): ?>
                            <div class="property-button">
                                <a href="<?= esc_url($item['button_link']['url']); ?>" target="<?= esc_attr($item['button_link']['is_external'] ? '_blank' : '_self'); ?>">
                                    <?= esc_html($item['button_text']); ?>
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1 0C0.447715 0 1.49012e-08 0.447715 1.49012e-08 1C1.49012e-08 1.55228 0.447715 2 1 2H8.51314L0.292893 10.2929C-0.0976311 10.6834 -0.0976311 11.3166 0.292893 11.7071C0.683417 12.0976 1.31658 12.0976 1.70711 11.7071L10 3.34093V11C10 11.5523 10.4477 12 11 12C11.5523 12 12 11.5523 12 11V1C12 0.447715 11.5523 0 11 0H1Z" fill="white" />
                                    </svg>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="property-image">
                        <?php if (!empty($item['image_link']['url'])): ?>
                            <a href="<?= esc_url($item['image_link']['url']); ?>" target="<?= esc_attr($item['image_link']['is_external'] ? '_blank' : '_self'); ?>">
                                <img src="<?= esc_url($item['image']['url']); ?>" alt="<?= esc_attr($item['title']); ?>">
                            </a>
                        <?php else: ?>
                            <img src="<?= esc_url($item['image']['url']); ?>" alt="<?= esc_attr($item['title']); ?>">
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

<?php
    }
}
