<?php
class Elementor_gridGallery12 extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'gridGallery12';
    }

    public function get_title()
    {
        return esc_html__('Gallery Grid/Slider', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_script_depends()
    {
        return ['splide-js'];
    }

    public function get_style_depends()
    {
        return ['splide-css'];
    }

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        wp_register_style('splide-css', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide-core.min.css', [], '4.1.4');
        wp_register_script('splide-js', 'https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js', [], '4.1.4', true);
    }

    protected function register_controls()
    {
        $this->start_controls_section('content_section', ['label' => esc_html__('Gallery Content', 'elementor-addon'), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT]);
        $this->add_control('title', ['label' => esc_html__('Title', 'elementor-addon'), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => esc_html__('Explore Our Gallery', 'elementor-addon')]);
        $this->add_control('subtitle', ['label' => esc_html__('Subtitle', 'elementor-addon'), 'type' => \Elementor\Controls_Manager::TEXTAREA, 'default' => esc_html__('Insights, updates, and ideas to keep you ahead', 'elementor-addon')]);

        $repeater = new \Elementor\Repeater();
        $repeater->add_control('image', ['label' => esc_html__('Image', 'elementor-addon'), 'type' => \Elementor\Controls_Manager::MEDIA, 'default' => ['url' => \Elementor\Utils::get_placeholder_image_src()]]);

        $this->add_control('gallery_images', [
            'label' => esc_html__('Add Images', 'elementor-addon'),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ "Image" }}}',
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $images = $settings['gallery_images'];
?>
        <div class="linked-gallery-container">
            <style>
                .linked-gallery-container {
                    padding: 100px 10%;
                    width: 100%;
                    text-align: center;
                }

                @media screen and (max-width: 1600px) {
                    .linked-gallery-container {
                        padding: 100px 25px;
                    }
                }

                @media screen and (max-width: 768px) {
                    .linked-gallery-container {
                        padding: 15px;
                    }
                }

                .linked-gallery-container h2 {
                    margin: 0 0 25px;
                    color: #000000;
                    font-family: "Playfair Display", serif;
                    font-size: 52px;
                    font-weight: 600;
                }

                .linked-gallery-container p {
                    color: #4D4D4D;
                    margin: 0 0 50px;
                    max-width: 580px;
                    margin-left: auto;
                    margin-right: auto;
                    font-family: "Playfair Display", serif;
                    font-size: 16px;
                }

                .desktop-grid {
                    display: grid;
                    grid-template-rows: repeat(4, auto);
                    gap: 20px;
                }

                .desktop-grid-row {
                    display: flex;
                    justify-content: center;
                    align-items: stretch;
                    gap: 20px;
                }

                .desktop-grid-item {
                    overflow: hidden;
                    border-radius: 8px;
                }

                .desktop-grid-row-1 .desktop-grid-item,
                .desktop-grid-row-3 .desktop-grid-item {
                    flex: 1 1 50%;
                    height: 500px;
                }

                .desktop-grid-row-2 .desktop-grid-item,
                .desktop-grid-row-4 .desktop-grid-item {
                    flex: 1 1 25%;
                    height: 380px;
                }

                .desktop-grid-item img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: block;
                }

                .mobile-slider-wrapper {
                    display: none;
                }

                @media (max-width: 768px) {
                    .desktop-grid {
                        display: none;
                    }

                    .mobile-slider-wrapper {
                        display: block;
                        position: relative;
                    }

                    .mobile-slider-wrapper .splide__slide img {
                        width: 100%;
                        height: 250px;
                        object-fit: cover;
                        border-radius: 8px;
                    }

                    .mobile-slider-wrapper .splide__pagination {
                        position: static;
                        margin-top: 10px;
                    }

                    .mobile-slider-wrapper .splide__pagination__page {
                        background: #d1d1d1;
                        width: 7px;
                        height: 7px;
                        border-radius: 50%;
                        margin: 0 4px;
                        transition: background-color 0.2s;
                        border: none;
                        padding: 0;
                    }

                    .mobile-slider-wrapper .splide__pagination__page.is-active {
                        background-color: #333;
                    }
                }

                @media (max-width: 480px) {
                    .linked-gallery-container h2 {
                        font-size: 24px;
                    }

                    .linked-gallery-container p {
                        font-size: 14px;
                    }

                    .mobile-slider-wrapper .splide__slide img {
                        height: 250px;
                    }
                }
            </style>
            <div class="gallery-header">
                <h2><?php echo esc_html($settings['title']); ?></h2>
                <p><?php echo esc_html($settings['subtitle']); ?></p>
            </div>

            <?php if (!empty($images) && is_array($images)): ?>
                <div class="desktop-grid">
                    <?php
                    $image_cursor = 0;
                    $rows_structure = [2, 4, 2, 4];
                    foreach ($rows_structure as $row_index => $images_in_row) {
                        $row_images = array_slice($images, $image_cursor, $images_in_row);
                        if (empty($row_images)) {
                            break;
                        }
                        echo '<div class="desktop-grid-row desktop-grid-row-' . ($row_index + 1) . '">';
                        foreach ($row_images as $item) {
                            if (!empty($item['image']['url'])) {
                                echo '<div class="desktop-grid-item"><img src="' . esc_url($item['image']['url']) . '" alt=""></div>';
                            }
                        }
                        echo '</div>';
                        $image_cursor += count($row_images);
                    }
                    ?>
                </div>

                <div class="mobile-slider-wrapper">
                    <div class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <?php foreach ($images as $item):
                                    if (!empty($item['image']['url'])): ?>
                                        <li class="splide__slide"><img src="<?php echo esc_url($item['image']['url']); ?>" alt=""></li>
                                <?php endif;
                                endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var splideElement = document.querySelector('.linked-gallery-container .splide');
                        if (window.innerWidth <= 768 && splideElement) {
                            new Splide(splideElement, {
                                type: 'loop',
                                perPage: 1,
                                perMove: 1,
                                flickMaxPages: 1,
                                gap: '20px',
                                pagination: true,
                                arrows: false,
                                drag: true,
                                breakpoints: {
                                    480: {
                                        gap: '10px',
                                    }
                                }
                            }).mount();
                        }
                    });
                </script>
            <?php endif; ?>
        </div>
<?php
    }
}
