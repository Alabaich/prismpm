<?php

class Elementor_gallerySection extends \Elementor\Widget_Base {

    public function get_name() {
        return 'gallerySection';
    }

    public function get_title() {
        return esc_html__('Gallery Grid', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="gallery-grid-widget">
            <div class="gallery-header">
                <h2><?php echo esc_html($settings['title']); ?></h2>
                <p><?php echo esc_html($settings['subtitle']); ?></p>
            </div>
    
            <div class="gallery-grid">
                <?php foreach ($settings['gallery_items'] as $index => $item): ?>
                    <?php if (!empty($item['image']['url'])): ?>
                        <div class="gallery-item <?php echo $index < 2 ? 'wide' : ''; ?>">
                            <img src="<?php echo esc_url($item['image']['url']); ?>" alt="">
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>
    
        <style>
            .gallery-grid-widget {
                text-align: center;
                padding: 4rem 0rem;
            }
    
            .gallery-header h2 {
                font-size: 52px;
                margin-bottom: 0.25rem;
            }
    
            .gallery-header p {
                font-size: 13px;
                color: #6b7280;
                margin-bottom: 2rem;
                font-family: "Inter Tight", sans-serif;
            }
    
            .gallery-grid {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                margin: 0 auto;
            }
    
            .gallery-item {
                cursor: pointer;
                border-radius: 8px;
                overflow: hidden;
            }
    
            .gallery-item img {
                width: 100%;
                height: auto;
                display: block;
            }
    
            .gallery-item.wide {
                flex: 0 0 calc(50% - 0.5rem);
            }
    
            .gallery-item:not(.wide) {
                flex: 0 0 calc(25% - 0.75rem);
            }
    
            @media (max-width: 1024px) {
                .gallery-item.wide {
                    flex: 0 0 100%;
                }
                .gallery-item:not(.wide) {
                    flex: 0 0 48%;
                }
            }
    
            @media (max-width: 600px) {
                .gallery-item {
                    flex: 0 0 100% !important;
                }
            }
        </style>
        <?php
    }
    
    
}
