<?php

class Elementor_gallerySection extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'gallerySection';
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
                'default' => esc_html__('Explore Our Gallery', 'elementor-addon'),
                'placeholder' => esc_html__('Enter your title', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Insights, Updates, and ideas to keep you ahead', 'elementor-addon'),
                'placeholder' => esc_html__('Enter your subtitle', 'elementor-addon'),
            ]
        );

        for ($i = 1; $i <= 6; $i++) {
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
        <section class="gallery-grid-widget">
            <div class="gallery-header">
                <h2 class="customTitle"><?php echo esc_html($settings['title']); ?></h2>
                <p class="customSubtitle"><?php echo esc_html($settings['subtitle']); ?></p>
            </div>

            <div class="gallery-grid">
                <?php
                $image_urls = [];
                for ($i = 1; $i <= 6; $i++) {
                    if (!empty($settings['image_' . $i]['url'])) {
                        $image_urls[] = $settings['image_' . $i]['url'];
                    }
                }

                foreach ($image_urls as $index => $url):
                ?>
                    <div class="gallery-item <?php echo $index < 2 ? 'wide' : ''; ?>">
                        <img src="<?php echo esc_url($url); ?>" alt="">
                    </div>
                <?php
                endforeach;
                ?>
            </div>
        </section>

        <style>
            .gallery-grid-widget {
                text-align: center;
                padding: 100px 80px;
                font-family: sans-serif;
            }

            .gallery-header h2.customTitle {
                margin-bottom: 0.5rem;
                color: #2a2a2a;
            }

            .gallery-header p.customSubtitle {
                color: #6b7280;
                margin-bottom: 2.5rem;
                max-width: 550px;
                margin-left: auto;
                margin-right: auto;
                line-height: 1.6;
            }

            .gallery-grid {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                margin: 0 auto;
                box-sizing: border-box;
            }

            .gallery-item {
                cursor: pointer;
                border-radius: 8px;
                overflow: hidden;
                flex-grow: 1;
                display: flex;
            }

            .gallery-item img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            .gallery-item.wide {
                flex: 0 0 calc(50% - 0.5rem);
                height: 400px;
            }

            .gallery-item:not(.wide) {
                flex: 0 0 calc(25% - 0.75rem);
                height: 250px;
            }

            @media (max-width: 768px) {
                .gallery-grid-widget {
                    padding: 2.5rem 0;
                }

                .gallery-header p {
                    margin-bottom: 1.5rem;
                    max-width: 90%;
                }

                .gallery-grid {
                    gap: 0.8rem;
                    padding: 0 15px;
                }

                .gallery-item,
                .gallery-item.wide,
                .gallery-item:not(.wide) {
                    flex: 0 0 100% !important;
                    height: 220px;
                }
            }

            @media (max-width: 480px) {
                .gallery-grid-widget {
                    padding: 2rem 0;
                }
                .gallery-header h2 {
                    font-size: 30px;
                }
                .gallery-header p {
                    font-size: 13px;
                }
                .gallery-item,
                .gallery-item.wide,
                .gallery-item:not(.wide) {
                    height: 180px;
                }
            }
        </style>
<?php
    }
}