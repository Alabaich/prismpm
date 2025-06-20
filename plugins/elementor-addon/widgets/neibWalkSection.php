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

        $this->add_control(
            'checker_span_color',
            [
                'label' => esc_html__('Checker Span Color', 'elementor-addon'),
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
        <div class="neighborhood-unique pageWidthNWS" id="NeighbourhoodSec">
            <style>
                .pageWidthNWS {
                    width: 100%;
                    padding: 100px 10%;
                }
                @media screen and (max-width: 1600px) {
                    .pageWidthNWS {
                        width: 100%;
                        padding: 100px 25px;
                    }
                }
                @media screen and (max-width: 768px) {
                    .pageWidthNWS {
                        width: 100%;
                        padding: 60px 15px;
                    }
                }
                .neighborhood-unique {
                    text-align: center;
                    font-family: "Playfair Display", serif;
                }

                .neighborhood-unique .title-block {
                    margin: 0;
                    padding-bottom: 70px;
                    font-size: 52px;
                    font-weight: 600;
                }

                .neighborhood-unique .grid-layout {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-between;
                    width: 100%;
                    align-items: baseline; 
                }

                .neighborhood-unique .category-card {
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-start;
                    width: 300px;
                    min-height: 400px; 
                    margin-bottom: 20px;
                }

                .neighborhood-unique .category-card .icon-block {
                    display: flex;
                    justify-content: center;
                }

                .neighborhood-unique .category-card .icon-block svg {
                    width: 100%;
                    height: 80px;
                }

                .neighborhood-unique .category-card .category-name {
                    margin: 0;
                    font-weight: 600;
                    font-size: 30px; 
                    padding-top: 30px;
                    padding-bottom: 50px;
                    color: #1A1A1A;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    text-align: center;
                }

                .neighborhood-unique .category-card .sub-itemNeib {
                    margin: 0;
                    line-height: 1.2;
                    flex-grow: 1; 
                }

                .gapperch {
                    gap: 40px;
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-end; 
                }

                .neighborhood-unique .category-card .sub-itemNeib h5 {
                    font-weight: 600;
                    color: #1A1A1A;
                    font-size: 18px;
                    margin: 0;
                    background: #F7F9FA;
                    padding: 10px 0;
                }

                .neighborhood-unique .category-card .sub-itemNeib div {
                    padding-top: 20px;
                    margin: 0;
                    color: #1A1A1A;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 10px;
                    font-family: "Playfair Display";
                    height: auto;
                }

                .neighborhood-unique .category-card .sub-itemNeib .checkerSpan {
                    margin: 0;
                    font-weight: 600;
                    font-size: 68px;
                    color: <?php echo esc_attr($settings['checker_span_color']); ?>;
                }

                .subTextWalk {
                    margin: 0;
                    font-weight: 500;
                    font-size: 16px;
                }

                @media (max-width: 768px) {
                    .neighborhood-unique .grid-layout {
                        align-items: center; 
                        justify-content: center;
                        gap:40px;
                        width: 100%;
                    }
                    .neighborhood-unique .category-card {
                        width: 160px;
                    }
                    .neighborhood-unique .title-block {
                        padding-bottom: 40px;
                        font-size: 24px;
                    }
                    .neighborhood-unique .category-card .category-name {
                        font-size: 18px; malheureusement
                        padding: 16px 0; 
                    }
                    .neighborhood-unique .category-card .sub-itemNeib h5 {
                        font-size: 16px;
                    }
                
                    .subTextWalk {
                        font-size: 14px;
                    }
                    .neighborhood-unique .category-card .sub-itemNeib .checkerSpan {
                        font-size: 32px;
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
                                    <div><p class="checkerSpan"><?php echo esc_html($sub_item['sub_item_distance']); ?></p> <p class="subTextWalk">Minute <br/> Walk</p></div>
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
?>