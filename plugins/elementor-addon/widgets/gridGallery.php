<?php
class Elementor_gridGallery extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'gridGallery';
    }

    public function get_title()
    {
        return esc_html__('Gallery Grid', 'elementor-addon');
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
            'content_section',
            [
                'label' => esc_html__('Gallery Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Gallery', 'elementor-addon'),
                'placeholder' => esc_html__('Enter your title', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Why Residents Love Living Here', 'elementor-addon'),
                'placeholder' => esc_html__('Enter your subtitle', 'elementor-addon'),
            ]
        );

        for ($i = 1; $i <= 9; $i++) {
            $this->add_control(
                'image_' . $i,
                [
                    'label' => esc_html__('Image ', 'elementor-addon') . $i,
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => '',
                    ],
                    'label_block' => true,
                ]
            );
        }

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <div class="uniquemaker">
            <style>
                .uniquemaker {
                    padding: 25px 10%; /* Only side padding, no width constraint */
                    width: 100%
                }
                @media screen and (max-width: 1600px) {
                    .uniquemaker {
                        padding: 25px;
                    }
                }
                @media screen and (max-width: 768px) {
                    .uniquemaker {
                        padding: 15px;
                    }
                }

                .uniquemaker .gallery-exhibit .gallery-grid {
                    width: 100%; /* Full width within uniquemaker */
                    margin-top: 1rem;
                }

                .uniquemaker .gallery-exhibit {
                    text-align: center;
                }

                .uniquemaker .gallery-exhibit .gallery-header h2.customTitle {
                    margin:0;
                    margin-bottom: 1rem;
                    color: #2a2a2a;
                }

                .uniquemaker .gallery-exhibit .gallery-header p.customSubtitle {
                    color: #6b7280;
                    margin:0;
                    margin-bottom: 2.5rem;
                    max-width: 550px;
                    margin-left: auto;
                    margin-right: auto;
                    line-height: 1.6;
                }

                .uniquemaker .gallery-exhibit .gallery-grid {
                    display: grid;
                    grid-template-columns: 1fr;
                    grid-template-rows: repeat(4, auto); 
                    gap: 15px;
                }

                .uniquemaker .gallery-exhibit .gallery-row {
                    display: flex;
                    justify-content: space-between;
                    align-items: stretch;
                    gap: 15px;
                }

                .uniquemaker .gallery-exhibit .gallery-item {
                    overflow: hidden;
                    border-radius: 8px;
                    height: 300px; 
                }

                .uniquemaker .gallery-exhibit .gallery-item img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                }

                /* Width assignments for each row */
                .uniquemaker .gallery-exhibit .gallery-row-1 .gallery-item-1 { width: 20%; }
                .uniquemaker .gallery-exhibit .gallery-row-1 .gallery-item-2 { width: 80%; }

                .uniquemaker .gallery-exhibit .gallery-row-2 .gallery-item-3 { width: 20%; }
                .uniquemaker .gallery-exhibit .gallery-row-2 .gallery-item-4 { width: 80%; }

                .uniquemaker .gallery-exhibit .gallery-row-3 .gallery-item-5 { width: 50%; }
                .uniquemaker .gallery-exhibit .gallery-row-3 .gallery-item-6 { width: 50%; }

                .uniquemaker .gallery-exhibit .gallery-row-4 .gallery-item-7,
                .uniquemaker .gallery-exhibit .gallery-row-4 .gallery-item-8,
                .uniquemaker .gallery-exhibit .gallery-row-4 .gallery-item-9 { width: 33.33%; }

                @media (max-width: 768px) {
                    .uniquemaker .gallery-exhibit .gallery-grid {
                        gap: 10px;
                    }
                    .uniquemaker .gallery-exhibit .gallery-row {
                        flex-direction: column;
                    }
                    .uniquemaker .gallery-exhibit .gallery-item-1, .uniquemaker .gallery-exhibit .gallery-item-2,
                    .uniquemaker .gallery-exhibit .gallery-item-3, .uniquemaker .gallery-exhibit .gallery-item-4,
                    .uniquemaker .gallery-exhibit .gallery-item-5, .uniquemaker .gallery-exhibit .gallery-item-6,
                    .uniquemaker .gallery-exhibit .gallery-item-7, .uniquemaker .gallery-exhibit .gallery-item-8,
                    .uniquemaker .gallery-exhibit .gallery-item-9 {
                        width: 100%;
                        height: 250px;
                    }
                }

                @media (max-width: 480px) {
                    .uniquemaker .gallery-exhibit .gallery-header h2 {
                        font-size: 24px;
                    }
                    .uniquemaker .gallery-exhibit .gallery-header p {
                        font-size: 14px;
                    }
                    .uniquemaker .gallery-exhibit .gallery-item-1, .uniquemaker .gallery-exhibit .gallery-item-2,
                    .uniquemaker .gallery-exhibit .gallery-item-3, .uniquemaker .gallery-exhibit .gallery-item-4,
                    .uniquemaker .gallery-exhibit .gallery-item-5, .uniquemaker .gallery-exhibit .gallery-item-6,
                    .uniquemaker .gallery-exhibit .gallery-item-7, .uniquemaker .gallery-exhibit .gallery-item-8,
                    .uniquemaker .gallery-exhibit .gallery-item-9 {
                        height: 180px;
                    }
                }
            </style>

            <div class="gallery-exhibit">
                <div class="gallery-header">
                    <h2 class="customTitle"><?php echo esc_html($settings['title']); ?></h2>
                    <p class="customSubtitle"><?php echo esc_html($settings['subtitle']); ?></p>
                </div>

                <div class="gallery-grid">
                    <?php
                    $image_urls = [];
                    for ($i = 1; $i <= 9; $i++) {
                        if (!empty($settings['image_' . $i]['url'])) {
                            $image_urls[$i] = $settings['image_' . $i]['url'];
                        }
                    }

                    // Row 1 (Images 1 and 2)
                    if (isset($image_urls[1]) || isset($image_urls[2])):
                    ?>
                        <div class="gallery-row gallery-row-1">
                            <?php for ($i = 1; $i <= 2; $i++):
                                if (isset($image_urls[$i])):
                            ?>
                                <div class="gallery-item gallery-item-<?php echo $i; ?>">
                                    <img src="<?php echo esc_url($image_urls[$i]); ?>" alt="Gallery Image <?php echo $i; ?>">
                                </div>
                            <?php
                                endif;
                            endfor; ?>
                        </div>
                    <?php
                    endif;

                    // Row 2 (Images 3 and 4)
                    if (isset($image_urls[3]) || isset($image_urls[4])):
                    ?>
                        <div class="gallery-row gallery-row-2">
                            <?php for ($i = 3; $i <= 4; $i++):
                                if (isset($image_urls[$i])):
                            ?>
                                <div class="gallery-item gallery-item-<?php echo $i; ?>">
                                    <img src="<?php echo esc_url($image_urls[$i]); ?>" alt="Gallery Image <?php echo $i; ?>">
                                </div>
                            <?php
                                endif;
                            endfor; ?>
                        </div>
                    <?php
                    endif;

                    // Row 3 (Images 5 and 6)
                    if (isset($image_urls[5]) || isset($image_urls[6])):
                    ?>
                        <div class="gallery-row gallery-row-3">
                            <?php for ($i = 5; $i <= 6; $i++):
                                if (isset($image_urls[$i])):
                            ?>
                                <div class="gallery-item gallery-item-<?php echo $i; ?>">
                                    <img src="<?php echo esc_url($image_urls[$i]); ?>" alt="Gallery Image <?php echo $i; ?>">
                                </div>
                            <?php
                                endif;
                            endfor; ?>
                        </div>
                    <?php
                    endif;

                    // Row 4 (Images 7, 8, and 9)
                    if (isset($image_urls[7]) || isset($image_urls[8]) || isset($image_urls[9])):
                    ?>
                        <div class="gallery-row gallery-row-4">
                            <?php for ($i = 7; $i <= 9; $i++):
                                if (isset($image_urls[$i])):
                            ?>
                                <div class="gallery-item gallery-item-<?php echo $i; ?>">
                                    <img src="<?php echo esc_url($image_urls[$i]); ?>" alt="Gallery Image <?php echo $i; ?>">
                                </div>
                            <?php
                                endif;
                            endfor; ?>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
<?php
    }
}