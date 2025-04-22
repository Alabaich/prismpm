<?php

class Elementor_announceProperty extends \Elementor\Widget_Base
{
    public function get_name() {
        return 'announceProperty';
    }

    public function get_title() {
        return esc_html__('Announce Property', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {
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
                'type' => \Elementor\Controls_Manager::TEXT,
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

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

<style>
    .coming-soon-section {
        padding: 3.75rem 0rem; /* 60px 20px */
    }

    .coming-soon-section h1 {
        margin-bottom: 0.625rem; /* 10px */
    }
    .coming-soon-section.first-page h1 {
        font-size: 72px;
    }

    .coming-soon-section p {
        font-family: "Inter Tight", sans-serif;
        color: #52525B;
        margin-bottom: 1.875rem; /* 30px */
    }
    .coming-soon-section.first-page p {
        max-width:500px;
    }

    .coming-soon-section .property-card {
        display: flex;
        justify-content: space-between;
        background: #f9f9f9;
        padding: 1.25rem; /* 20px */
        border-radius: 0.75rem; /* 12px */
        margin-bottom: 1.25rem; /* 20px */
        flex-wrap: nowrap;
    }

    .coming-soon-section .property-content {
        max-width: 100%;
        min-width: 34.875rem; /* 558px */
        display: flex;
        flex-direction: column;
        gap: 0.5rem; /* 8px */
    }

    .coming-soon-section .property-content h3 {
        font-size: 40px;
        margin-bottom: 0.625rem; /* 10px */
    }

    .coming-soon-section .property-content .metaq {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 2.5rem; /* 40px */
        font-size: 0.875rem; /* 14px */
    }

    .coming-soon-section .property-image img {
        border-radius: 0.5rem; /* 8px */
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .metaq div {
        display: flex;
        flex-direction: column;
        gap: 0.75rem 0; /* 12px 0 */
        font-family: "Inter Tight", sans-serif;
        font-weight: 500;
    }

    .metaq h6 {
        font-size: 18px;
        color: #52525B;
    }
    
    .metaq span {
        font-size: 1.5rem;
        color: #2A2A2A;
    }

    .property-button {
        margin-top: 2.5rem; /* 40px */
    }

    .property-button a {
        display: inline-flex;
        align-items: center;
        background: #04364C;
        color: #fff;
        padding: 0.625rem 1.25rem; /* 10px 20px */
        border-radius: 1.875rem; /* 30px */
        font-size: 1rem;
        margin-top: 1rem; /* 16px */
        text-decoration: none;
        transition: background 0.3s;
    }

    .title-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: nowrap;
    }

    .section-titles {
        display: flex;
        flex-direction: column;
    }

    .section-img img {
        max-width: 15rem; /* 240px */
        height: auto;
    }

    .flex {
        display: flex;
    }

    .property-button a:hover {
        background: #052b3b;
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
<div class="<?php echo implode(' ', $classes); ?>">
    <div class="title-container">
        <div class="section-titles">
            <h1 class="flex"><?php echo esc_html($settings['section_title']); ?></h1>
            <p class="flex"><?php echo esc_html($settings['section_subtitle']); ?></p>
        </div>
        <?php if (!empty($settings['section_image']['url'])) : ?>
        <div class="section-img flex">
            <img src="<?php echo esc_url($settings['section_image']['url']); ?>" alt="Section Image" />
        </div>
        <?php endif; ?>
    </div>
            <?php foreach ($settings['properties'] as $item): ?>
                <div class="property-card">
                    <div class="property-content">
                        <h3><?php echo esc_html($item['title']); ?></h3>
                        <div class="metaq">
                            <div><h6>Address:</h6> <span><?php echo esc_html($item['address']); ?></span></div>
                            <div><h6>Developer:</h6> <span><?php echo esc_html($item['developer']); ?></span></div>
                            <div><h6><?php echo esc_html($item['label_left']); ?>:</h6> <span><?php echo esc_html($item['value_left']); ?></span></div>
                            <div><h6>Estimated Launch:</h6> <span><?php echo esc_html($item['launch_date']); ?></span></div>
                        </div>

                        <?php if (!empty($item['button_link']['url'])): ?>
                            <div class="property-button">
                                <a href="<?php echo esc_url($item['button_link']['url']); ?>" target="<?php echo esc_attr($item['button_link']['is_external'] ? '_blank' : '_self'); ?>">
                                    Pre-Register →
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="property-image">
                        <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['title']); ?>">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php
    }
}
