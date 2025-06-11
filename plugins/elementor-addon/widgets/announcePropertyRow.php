<?php
class Elementor_announcePropertyRow extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'announcPropertyRow';
    }

    public function get_title()
    {
        return esc_html__('Announce PropertyRow', 'elementor-addon');
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
                .pageWidthAnRaw {
                    width: 100%;
                    padding: 25px 10%;
                    display: flex;
                    justify-content: center;
                }
                @media screen and (max-width: 1600px) {
                    .pageWidthAnRaw  {
                        padding: 25px;
                    }
                }
                @media screen and (max-width: 768px) {
                    .pageWidthAnRaw  {
                        padding: 15px;
                    }
                }

                .announce-section {
                    text-align: center;
                }

                .announce-section .suites-grid {
                    display: flex;
                    flex-wrap: nowrap;
                    justify-content: center;
                    gap: 1.5rem;
                    overflow-x: auto;
                    -webkit-overflow-scrolling: touch;
                    padding-bottom: 1rem;
                }

                .announce-section .property-card {
                    padding:1.25rem;
                    min-width: 320px;
                    width: 408px;
                    flex-shrink: 0;
                    background: #f9f9f9;
                    border-radius: 0.75rem;
                    overflow: hidden;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    transition: transform 0.2s ease;
                }

                .announce-section .property-card:hover {
                    transform: translateY(-5px);
                    cursor: pointer;
                }

                .announce-section .property-image img {
                    width: 100%;
                    height: 200px;
                    object-fit: cover;
                    border-radius:8px;
                }

                .announce-section .property-content {
                    padding-top: 1rem;
                    flex-grow: 1;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                }

                .announce-section .property-content h3 {
                    margin: 0.5rem 0;
                    color: #2A2A2A;
                    font-weight: 600;
                }

                .announce-section .property-content .metaq {
                    font-size: 16px;
                    color: #6B7280;
                    margin-bottom: 1rem;
                }

                .announce-section .property-content .metaq div {
                    margin: 0.25rem 0;
                }

                .announce-section .property-content .metaq span {
                    color: #2A2A2A;
                    font-weight: 500;
                }

                .property-button a {
                    display: inline-flex;
                    align-items: center;
                    padding: 0.75rem 1.5rem;
                    text-decoration: none;
                    color: #fff;
                    background-color: #093D5F;
                    font-size: 16px;
                    border-radius: 99999px;
                    margin-top: 0.5rem;
                    transition: all 0.3s ease;
                }

                .property-button a:hover {
                    color: #093D5F;
                    background-color: #fff;
                    border: 2px solid #093D5F;
                }

                @media (max-width: 768px) {
                    .announce-section .suites-grid {
                        flex-wrap: wrap;
                        overflow-x: hidden;
                        justify-content: center;
                    }
                    .announce-section .property-card {
                        width: 100%;
                        min-width: 0;
                        margin-bottom: 1rem;
                    }
                    .announce-section .property-image img {
                        height: 150px;
                    }
                }
            </style>
            <div class="announce-section pageWidthAnRaw ">
                <?php if (!empty($settings['properties'])) : ?>
                    <div class="suites-grid">
                        <?php foreach ($settings['properties'] as $item): ?>
                            <div class="property-card">
                                <?php if (!empty($item['image']['url'])): ?>
                                    <div class="property-image">
                                        <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['address']); ?>">
                                    </div>
                                <?php endif; ?>
                                <div class="property-content">
                                    <?php if (!empty($item['address'])): ?>
                                        <h3><?php echo esc_html($item['address']); ?></h3>
                                    <?php endif; ?>
                                    <div class="metaq">
                                        <?php if (!empty($item['developer'])): ?>
                                            <div>Developer: <span><?php echo esc_html($item['developer']); ?></span></div>
                                        <?php endif; ?>
                                        <?php if (!empty($item['label_left']) && !empty($item['value_left'])): ?>
                                            <div><?php echo esc_html($item['label_left']); ?>: <span><?php echo esc_html($item['value_left']); ?></span></div>
                                        <?php endif; ?>
                                        <?php if (!empty($item['launch_date'])): ?>
                                            <div>Estimated Launch: <span><?php echo esc_html($item['launch_date']); ?></span></div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($item['button_text']) && !empty($item['button_link']['url'])): ?>
                                        <div class="property-button">
                                            <a href="<?php echo esc_url($item['button_link']['url']); ?>" target="_self">
                                                <?php echo esc_html($item['button_text']); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
<?php
    }
}   