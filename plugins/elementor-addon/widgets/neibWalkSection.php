<?php
class Elementor_neibWalkSection extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'neibWalkSection';
    }

    public function get_title()
    {
        return esc_html__('Neighbourhood Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-location';
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
                'default' => 'Neighbourhood',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'category_name',
            [
                'label' => esc_html__('Category Name', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Grocery Stores',
            ]
        );

        $repeater->add_control(
            'sub_items',
            [
                'label' => esc_html__('Sub Items', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'sub_item_name',
                        'label' => esc_html__('Item Name', 'elementor-addon'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => 'FreshCo',
                    ],
                    [
                        'name' => 'sub_item_distance',
                        'label' => esc_html__('Distance (Minutes Walk)', 'elementor-addon'),
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'default' => 15,
                    ],
                ],
                'default' => [
                    ['sub_item_name' => 'FreshCo', 'sub_item_distance' => 15],
                    ['sub_item_name' => 'FreshCo', 'sub_item_distance' => 15],
                    ['sub_item_name' => 'FreshCo', 'sub_item_distance' => 15],
                ],
                'title_field' => '{{{ sub_item_name }}}',
            ]
        );

        $repeater->add_control(
            'category_icon',
            [
                'label' => esc_html__('Icon', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-shopping-basket',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'categories',
            [
                'label' => esc_html__('Categories', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'category_name' => 'Grocery Stores',
                        'sub_items' => [
                            ['sub_item_name' => 'FreshCo', 'sub_item_distance' => 15],
                            ['sub_item_name' => 'FreshCo', 'sub_item_distance' => 15],
                            ['sub_item_name' => 'FreshCo', 'sub_item_distance' => 15],
                        ],
                        'category_icon' => ['value' => 'fas fa-shopping-basket', 'library' => 'fa-solid'],
                    ],
                    [
                        'category_name' => 'Parks',
                        'sub_items' => [
                            ['sub_item_name' => 'FreshCo', 'sub_item_distance' => 15],
                            ['sub_item_name' => 'FreshCo', 'sub_item_distance' => 15],
                            ['sub_item_name' => 'FreshCo', 'sub_item_distance' => 15],
                        ],
                        'category_icon' => ['value' => 'fas fa-tree', 'library' => 'fa-solid'],
                    ],
                    [
                        'category_name' => 'Transit Stops',
                        'sub_items' => [
                            ['sub_item_name' => 'FreshCo', 'sub_item_distance' => 15],
                            ['sub_item_name' => 'FreshCo', 'sub_item_distance' => 15],
                            ['sub_item_name' => 'FreshCo', 'sub_item_distance' => 15],
                        ],
                        'category_icon' => ['value' => 'fas fa-bus', 'library' => 'fa-solid'],
                    ],
                    [
                        'category_name' => 'Commute',
                        'sub_items' => [
                            ['sub_item_name' => 'FreshCo', 'sub_item_distance' => 15],
                            ['sub_item_name' => 'FreshCo', 'sub_item_distance' => 15],
                            ['sub_item_name' => 'FreshCo', 'sub_item_distance' => 15],
                        ],
                        'category_icon' => ['value' => 'fas fa-map-marker-alt', 'library' => 'fa-solid'],
                    ],
                ],
                'title_field' => '{{{ category_name }}}',
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
?>
        <div class="neighborhood-unique pageWidthNWS">
            <style>
                .pageWidthNWS {
                    width: 100%;
                    padding: 25px 10%;
                }
                @media screen and (max-width: 1600px) {
                    .pageWidthNWS {
                        width: 100%;
                        padding: 25px;
                    }
                }
                @media screen and (max-width: 768px) {
                    .pageWidthNWS {
                        width: 100%;
                        padding: 15px;
                    }
                }
                .neighborhood-unique {
                    text-align: center;
                }

                .neighborhood-unique .title-block {
                    font-size: 1.5rem;
                    margin-bottom: 1.5rem;
                }

                .neighborhood-unique .grid-layout {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(15rem, 1fr));
                    gap: 1.875rem;
                    margin: 0 auto;
                    width: 90%;
                }

                .neighborhood-unique .category-card {
                    background: #fff;
                    padding: 1rem;
                    border-radius: 4px;
                    box-shadow: 0 0.125rem 0.3125rem rgba(0, 0, 0, 0.1);
                }

                .neighborhood-unique .category-card .icon-block {
                    font-size: 2rem;
                    color: <?php echo esc_attr($settings['icon_color']); ?>;
                    margin-bottom: 0.5rem;
                }

                .neighborhood-unique .category-card .category-name {
                    font-size: 1.1rem;
                    margin-bottom: 0.5rem;
                }

                .neighborhood-unique .category-card .sub-item {
                    font-size: 0.9rem;
                    margin: 0.25rem 0;
                }

                @media (max-width: 768px) {
                    .neighborhood-unique .grid-layout {
                        grid-template-columns: 1fr;
                    }
                }
            </style>

            <h2 class="title-block"><?php echo esc_html($settings['section_title']); ?></h2>
            <div class="grid-layout">
                <?php foreach ($settings['categories'] as $item): ?>
                    <div class="category-card">
                        <div class="icon-block">
                            <?php \Elementor\Icons_Manager::render_icon($item['category_icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                        <h3 class="category-name"><?php echo esc_html($item['category_name']); ?></h3>
                        <?php foreach ($item['sub_items'] as $sub_item): ?>
                            <p class="sub-item"><?php echo esc_html($sub_item['sub_item_name']); ?> <br> <?php echo esc_html($sub_item['sub_item_distance']); ?> Minute Walk</p>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
<?php
    }
}