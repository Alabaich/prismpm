<?php
class Elementor_gridGallery12 extends \Elementor\Widget_Base
{
    public function get_name() {
        return 'gridGallery12';
    }

    public function get_title() {
        return esc_html__('Gallery Grid12', 'elementor-addon');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return ['basic'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Gallery Content', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control('title', [
            'label' => esc_html__('Title', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__('Gallery', 'elementor-addon'),
            'placeholder' => esc_html__('Enter your title', 'elementor-addon'),
        ]);

        $this->add_control('subtitle', [
            'label' => esc_html__('Subtitle', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => esc_html__('Why Residents Love Living Here', 'elementor-addon'),
            'placeholder' => esc_html__('Enter your subtitle', 'elementor-addon'),
        ]);

        for ($i = 1; $i <= 12; $i++) {
            $this->add_control('image_' . $i, [
                'label' => esc_html__('Image ', 'elementor-addon') . $i,
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => ['url' => ''],
                'label_block' => true,
            ]);
        }

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
?>
<div class="uniquebuilder">
    <style>
        .uniquebuilder {
            padding: 120px 10%;
            width: 100%
        }
        @media screen and (max-width: 1600px) {
            .uniquebuilder { padding:100px 25px; }
        }
        @media screen and (max-width: 768px) {
            .uniquebuilder { padding: 15px; }
        }
      .uniquebuilder .gallery-exhibit .gallery-grid {
            width: 100%;
        }
        .uniquebuilder .gallery-exhibit { text-align: center; }
        .uniquebuilder .gallery-header h2.customTitle {
            margin: 0 0 25px;
            color: #000000;
        }
        .uniquebuilder .gallery-header p.customSubtitle {
            color: #6b7280;
            margin: 0 0 50px;
            max-width: 580px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }
        .uniquebuilder .gallery-grid {
            display: grid;
            grid-template-rows: repeat(4, auto);
            gap: 20px;
        }
        .uniquebuilder .gallery-row {
            display: flex;
            justify-content: space-between;
            align-items: stretch;
            gap: 20px;
        }
        .uniquebuilder .gallery-item {
            overflow: hidden;
            border-radius: 8px;
        }
        .uniquebuilder .gallery-row-1 .gallery-item,
        .uniquebuilder .gallery-row-3 .gallery-item {
            width: 50%;
            height: 500px;
        }
        .uniquebuilder .gallery-row-2 .gallery-item,
        .uniquebuilder .gallery-row-4 .gallery-item {
            width: 25%;
            height: 380px;
        }
        .uniquebuilder .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        @media (max-width: 768px) {
            .uniquebuilder .gallery-grid { gap: 10px; }
            .uniquebuilder .gallery-row { flex-direction: column; gap:10px;}
            .uniquebuilder .gallery-item { width: 100%; height: 250px !important; }
        }
        @media (max-width: 480px) {
            .uniquebuilder .gallery-header h2 { font-size: 24px; }
            .uniquebuilder .gallery-header p { font-size: 14px; }
            .uniquebuilder .gallery-item { height: 180px !important; }
        }
    </style>

    <div class="gallery-exhibit">
        <div class="gallery-header">
            <h2 class="customTitle"><?php echo esc_html($settings['title']); ?></h2>
            <p class="customSubtitle"><?php echo esc_html($settings['subtitle']); ?></p>
        </div>
        <div class="gallery-grid">
            <?php
            $images = [];
            for ($i = 1; $i <= 12; $i++) {
                if (!empty($settings['image_' . $i]['url'])) {
                    $images[] = $settings['image_' . $i]['url'];
                }
            }
            if (count($images)) {
                echo '<div class="gallery-row gallery-row-1">';
                foreach (array_slice($images, 0, 2) as $i => $url) {
                    echo '<div class="gallery-item gallery-item-' . ($i + 1) . '"><img src="' . esc_url($url) . '" alt="Gallery Image ' . ($i + 1) . '"></div>';
                }
                echo '</div>';
                echo '<div class="gallery-row gallery-row-2">';
                foreach (array_slice($images, 2, 4) as $i => $url) {
                    echo '<div class="gallery-item gallery-item-' . ($i + 3) . '"><img src="' . esc_url($url) . '" alt="Gallery Image ' . ($i + 3) . '"></div>';
                }
                echo '</div>';
                echo '<div class="gallery-row gallery-row-3">';
                foreach (array_slice($images, 6, 2) as $i => $url) {
                    echo '<div class="gallery-item gallery-item-' . ($i + 7) . '"><img src="' . esc_url($url) . '" alt="Gallery Image ' . ($i + 7) . '"></div>';
                }
                echo '</div>';
                echo '<div class="gallery-row gallery-row-4">';
                foreach (array_slice($images, 8, 4) as $i => $url) {
                    echo '<div class="gallery-item gallery-item-' . ($i + 9) . '"><img src="' . esc_url($url) . '" alt="Gallery Image ' . ($i + 9) . '"></div>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>
<?php
    }
}
