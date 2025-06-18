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
                    padding: 20px 10%;
                    padding-bottom:100px;
                    padding-top:0px;
                }
                @media screen and (max-width: 1600px) {
                    .pageWidthNWS {
                        width: 100%;
                        padding:20px 25px;
                    padding-top:0px;
                    padding-bottom:100px;
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
                    margin: 0;
                    padding-bottom: 25px;
                }

                .neighborhood-unique .grid-layout {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-between;
                    width: 100%;
                    align-items: baseline;
                    padding-top: 25px;
                }

                .neighborhood-unique .category-card {
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    width: 300px;
                }

                .neighborhood-unique .category-card .icon-block {
                    fill: <?php echo esc_attr($settings['icon_color']); ?>; /* Use fill for SVG icons */
                    display: flex;
                    justify-content: center;
                }

                .neighborhood-unique .category-card .icon-block svg {
                    width: 100px; /* Uniform size */
                    height: 120px; /* Uniform size */
                }

                .neighborhood-unique .category-card .category-name {
                    margin: 0;
                    font-weight: bold;
                    padding-top: 30px;
                    padding-bottom: 50px;
                }

                .neighborhood-unique .category-card .sub-itemNeib {
                    margin:0;
                    line-height: 1.2;

                }
                .gapperch {
                    padding-bottom:20px;
                    gap:40px;
                    display:flex;
                    flex-direction:column;
                }

                .neighborhood-unique .category-card .sub-itemNeib h5 {
                    font-weight: bold;
                    font-size:18px; 
                    margin: 0;
                    background:#F7F9FA;
                    padding:10px 0;
                }

                .neighborhood-unique .category-card .sub-itemNeib div {
                    padding-top:20px;
                    margin: 0;
                    color: #1A1A1A;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    gap:10px;
                    font-family:"Playfair Display";
                }
                .neighborhood-unique .category-card .sub-itemNeib div span {
                    font-weight:bold;
                    font-size:4rem;
                }
                .subTextWalk {
                    margin:0;
                }

                @media (max-width: 768px) {
                    .neighborhood-unique .grid-layout {
                        flex-direction: column;
                        align-items: center;
                    }
                    .neighborhood-unique .category-card {
                        width: 100%;
                        max-width: 15rem;
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
                        <h4 class="category-name"><?php echo esc_html($item['category_name']); ?></h4>
                        <div class="gapperch">
                                                    <?php foreach ($item['sub_items'] as $sub_item): ?>
                            <div class="sub-itemNeib">
                                <h5><?php echo esc_html($sub_item['sub_item_name']); ?></h5>
                                <div><span><?php echo esc_html($sub_item['sub_item_distance']); ?></span> <p class="subTextWalk">Minute <br/> Walk</p></div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
<?php
    }
}