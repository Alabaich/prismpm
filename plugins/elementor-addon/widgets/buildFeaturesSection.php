<?php
class Elementor_buildFeaturesSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'buildFeaturesSection';
    }

    public function get_title()
    {
        return esc_html__('Building Features Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-building';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Section Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Sophisticated Building Features',
            ]
        );

        $this->add_control(
            'main_image',
            [
                'label' => esc_html__('Main Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => ''],
                'label_block' => true,
                'description' => esc_html__('Upload an image to display on the right side (640px x 380px).'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'feature_name',
            [
                'label' => esc_html__('Feature Name', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Bike Storage',
            ]
        );

        $repeater->add_control(
            'feature_icon',
            [
                'label' => esc_html__('Icon', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-bicycle',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'features',
            [
                'label' => esc_html__('Features', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['feature_name' => 'Luxury vinyl plank flooring throughout excluding bathroom(s)', 'feature_icon' => ['value' => 'fas fa-home', 'library' => 'fa-solid']],
                    ['feature_name' => 'Ceiling heights 10’ to 15’ (except in bathrooms, as per plan)', 'feature_icon' => ['value' => 'fas fa-ruler-vertical', 'library' => 'fa-solid']],
                    ['feature_name' => 'Bell Fibre Unlimited high-speed internet included at a promotional rate', 'feature_icon' => ['value' => 'fas fa-wifi', 'library' => 'fa-solid']],
                    ['feature_name' => 'Suites feature City Link smart unit controls', 'feature_icon' => ['value' => 'fas fa-mobile-alt', 'library' => 'fa-solid']],
                    ['feature_name' => 'In-suite laundry featuring Whirlpool front-loading washer and dryer', 'feature_icon' => ['value' => 'fas fa-washing-machine', 'library' => 'fa-solid']],
                    ['feature_name' => 'Flat white paint on all walls', 'feature_icon' => ['value' => 'fas fa-paint-brush', 'library' => 'fa-solid']],
                    ['feature_name' => 'Individually controlled heating and air conditioning with in-suite heat pumps', 'feature_icon' => ['value' => 'fas fa-thermometer-half', 'library' => 'fa-solid']],
                    ['feature_name' => 'Ceramic tile flooring in bathrooms', 'feature_icon' => ['value' => 'fas fa-tint', 'library' => 'fa-solid']],
                    ['feature_name' => 'Semi-gloss finish on all interior door frames, trim and baseboards', 'feature_icon' => ['value' => 'fas fa-paint-roller', 'library' => 'fa-solid']],
                ],
                'title_field' => '{{{ feature_name }}}',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1a3c5e',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $features = $settings['features'];
        $main_image = !empty($settings['main_image']['url']) ? $settings['main_image']['url'] : '';
        $item_count = count($features);
        $columns = ($item_count >= 10 && !$main_image) ? 5 : 3; // 3 columns by default, 5 if 10+ items and no image
        $full_rows = floor($item_count / $columns);
        $remaining_items = $item_count % $columns;
?>
        <div class="features-unique pageWidthBdF" id="AmenitiesSec">
            <style>
                .pageWidthBdF {
                    width: 100%;
                    padding: 100px 10%;
                }
                @media screen and (max-width: 1600px) {
                    .pageWidthBdF {
                        width: 100%;
                        padding: 100px 25px;
                    }
                }
                @media screen and (max-width: 768px) {
                    .pageWidthBdF {
                        width: 100%;
                        padding: 60px 15px;
                    }
                }

                .features-unique .feature-container {
                    display: flex;
                    flex-wrap: wrap;
                    width: <?php echo $main_image ? 'calc(100% - 560px)' : '100%'; ?>;
                    align-items: baseline;
                    justify-content: space-between; /* Space between for full rows */
                    gap: 20px;
                }

                .features-unique .last-row {
                    display: flex;
                    flex-wrap: wrap;
                    width: <?php echo $main_image ? 'calc(100% - 560px)' : '100%'; ?>;
                    align-items: baseline;
                    justify-content: center; /* Center for the last row */
                    gap: 20px;
                }

                .features-unique {
                    text-align: left;
                    flex-wrap: wrap;
                    justify-content: flex-start;
                    align-items: flex-start;
                }

                .features-unique .title-block {
                    flex: 0 0 100%;
                    padding-bottom: 70px;
                    font-family: "Playfair Display", serif;
                    font-size: 52px;
                    font-weight: 600;
                    margin: 0;
                    text-align: center;
                }

                .features-unique .feature-card {
                    flex: 0 0 calc(<?php echo 100 / $columns; ?>% - (20px * (<?php echo $columns; ?> - 1) / <?php echo $columns; ?>));
                    display: flex;
                    flex-direction: column;
                    text-align: center;
                    align-items: center;
                    gap: 10px;
                }

                .features-unique .feature-card .icon-block {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                .features-unique .feature-card .icon-block svg {
                    fill: <?php echo esc_attr($settings['icon_color']); ?> !important;
                    width: 100%; 
                    height: 80px;
                    object-fit: contain;
                }

                .features-unique .feature-card .feature-name {
                    margin: 0;
                    color: #1A1A1A;
                    font-weight: 600;
                    font-size: 30px; 
                    font-family: "Playfair Display", serif;
                    line-height: 120%;
                    padding: 0 10px;
                    word-wrap: break-word;
                }

                .features-unique .main-image {
                    display: none;
                    flex: 0 0 560px;
                    height: 320px;
                }
                                    .justifaichik {
                                        gap:20px;
                        display: flex;
                        flex-direction:column;
                    }

                <?php if ($main_image): ?>
                    .justifaichik {
                        display: flex;
                        justify-content: space-between;
                        flex-direction:row;
                        gap:20px;
                    }
                    .textAdditiImg {
                        font-family: "Playfair Display";
                        gap: 10px;
                        display: flex;
                        flex-direction: column;
                        padding-top: 30px;
                    }
                    .textAdditiImg p {
                        margin: 0;
                        color: #757575;
                        font-size: 14px;
                    }
                    .textAdditiImg h4 {
                        margin: 0;
                        font-size: 24px;
                        font-weight: 600;
                        color: <?php echo esc_attr($settings['icon_color']); ?>;
                    }
                    .features-unique .AlignImgWithText .main-image {
                        display: block;
                    }
                    .features-unique .AlignImgWithText .main-image img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        border-radius: 8px;
                    }
                    @media (max-width: 768px) {
                        .justifaichik {
                            gap:32px!important;
                        }
                                            .textAdditiImg {
                        padding-top: 16px;
                    }
                        .textAdditiImg h4 {
                        font-size: 16px;
                    }
                                        .textAdditiImg p {
                        font-size: 12px;
                    }
                    }
                <?php endif; ?>

                @media (max-width: 1200px) {
                    .features-unique .feature-container,
                    .features-unique .last-row {
                        width: 100%;
                    }
                    .features-unique .feature-card {
                        flex: 0 0 calc(33.33% - 13.33px);
                    }
                    .features-unique .main-image {
                        display: none;
                    }
                    .features-unique {
                        text-align: center;
                    }
                    .features-unique .title-block {
                        text-align: center;
                    }
                }

                @media (max-width: 768px) {
                    .features-unique .feature-container,
                    .features-unique .last-row {
                        width: 100%;
                    }
                    .features-unique .feature-card {
                        flex: 0 0 calc(50% - 10px);
                        min-width: 150px;
                    }
                    .features-unique .feature-card .feature-name {
                        font-size: 16px;
                    }
                    .features-unique .main-image {
                        display: none;
                    }
                    .features-unique {
                        text-align: center;
                    }
                    .features-unique .title-block {
                        text-align: center;
                        padding-bottom: 40px;
                        font-size: 28px;
                    }
                    .justifaichik {
                        flex-direction: column;
                        gap: 20px;
                    }
                    .features-unique .AlignImgWithText .main-image {
                        flex: 0 0 100%;
                        height: 200px;
                    }
                }
            </style>

            <h2 class="title-block"><?php echo esc_html($settings['section_title']); ?></h2>
            <div class="justifaichik">
                <div class="feature-container">
                    <?php
                    $full_items = $full_rows * $columns;
                    for ($i = 0; $i < $full_items; $i++) {
                        $feature = $features[$i];
                    ?>
                        <div class="feature-card">
                            <div class="icon-block">
                                <?php \Elementor\Icons_Manager::render_icon($feature['feature_icon'], ['aria-hidden' => 'true']); ?>
                            </div>
                            <h4 class="feature-name"><?php echo esc_html($feature['feature_name']); ?></h4>
                        </div>
                    <?php } ?>
                </div>
                <?php if ($remaining_items > 0): ?>
                    <div class="last-row">
                        <?php for ($i = $full_items; $i < $item_count; $i++) {
                            $feature = $features[$i];
                        ?>
                            <div class="feature-card">
                                <div class="icon-block">
                                    <?php \Elementor\Icons_Manager::render_icon($feature['feature_icon'], ['aria-hidden' => 'true']); ?>
                                </div>
                                <h4 class="feature-name"><?php echo esc_html($feature['feature_name']); ?></h4>
                            </div>
                        <?php } ?>
                    </div>
                <?php endif; ?>
                <?php if ($main_image): ?>
                    <div class="AlignImgWithText">
                        <div class="main-image">
                            <img src="<?php echo esc_url($main_image); ?>" alt="Main Feature Image">
                        </div>
                        <div class="textAdditiImg">
                            <h4>Complementary membership</h4>
                            <p>To pool and gym equipment</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
<?php
    }
}