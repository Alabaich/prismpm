<?php

class Elementor_FullSizeImage extends \Elementor\Widget_Base {

    public function get_name() {
        return 'full_size_image';
    }

    public function get_title() {
        return esc_html__( 'Full Size Image Banner', 'elementor-addon' );
    }

    public function get_icon() {
        return 'eicon-image';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    public function get_keywords() {
        return [ 'image', 'banner', 'hero', 'responsive' ];
    }

    protected function register_controls() {

        // Section: Content
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'elementor-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Control: Desktop Image
        $this->add_control(
            'desktop_image',
            [
                'label' => esc_html__( 'Desktop Image', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'medium_image',
            [
                'label' => esc_html__( '1366x768 Image', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Control: Tablet Image
        $this->add_control(
            'tablet_image',
            [
                'label' => esc_html__( 'Tablet Image', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Control: Phone Image
        $this->add_control(
            'phone_image',
            [
                'label' => esc_html__( 'Phone Image', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Control: Logo
        $this->add_control(
            'logo_image',
            [
                'label' => esc_html__( 'Logo Image', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Control: Title
        $this->add_control(
            'title_text',
            [
                'label' => esc_html__( 'Title', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Your Hero Title', 'elementor-addon' ),
            ]
        );

        $this->end_controls_section();

        // Section: Style
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'elementor-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-text h1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'elementor-addon' ),
                'selector' => '{{WRAPPER}} .hero-text h1',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
    
        $desktop_image = esc_url( $settings['desktop_image']['url'] );
        $tablet_image = esc_url( $settings['tablet_image']['url'] );
        $medium_image = esc_url( $settings['medium_image']['url'] );
        $phone_image = esc_url( $settings['phone_image']['url'] );
        $logo_image = esc_url( $settings['logo_image']['url'] );
        $title_text = esc_html( $settings['title_text'] );
        ?>
    <style>
.hero-banner {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.hero-banner img.hero-image {
    width: 100%;
    height: auto;
    display: block;
}

/* Positioning adjustments for logo and text */
.hero-banner .hero-logo {
    position: absolute;
    right: 0;
    bottom: 25px;
    width: auto;
    height: 100%;
    transition: transform 0.2s ease-out;
    z-index: 10;
}

.hero-banner .hero-text {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    text-align: center;
    color: #fff;
    background: rgba(8, 62, 95, 0.75);
    padding: 15px;
    z-index: 9;
}


.hero-banner .hero-text h1 {
    font-size: 3rem;
    font-weight: bold;
    margin: 0;
    line-height: 1.2;
}


@media (max-width: 1366px) {

    .hero-banner .hero-text h1 {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .hero-banner .hero-logo {
    bottom: 0;
}


    .hero-banner .hero-text h1 {
        font-size: 1.5rem;
    }
}

@media (max-width: 480px) {


    .hero-banner .hero-text h1 {
        font-size: 1rem;
    }
}

        </style>
    
        <div class="hero-banner">
            <img 
                src="<?php echo $desktop_image; ?>" 
                srcset="<?php echo $phone_image; ?> 600w, 
                    <?php echo $tablet_image; ?> 768w, 
                    <?php echo $medium_image; ?> 1366w, 
                    <?php echo $desktop_image; ?> 1920w" 
                sizes="(max-width: 600px) 100vw, 
                       (max-width: 768px) 100vw, 
                       (max-width: 1366px) 100vw, 
                       100vw"
                alt="Hero Image" 
                class="hero-image">
                
            <img src="<?php echo $logo_image; ?>" alt="Logo" class="hero-logo" id="parallax-logo">

            <div class="hero-text">  
                <h1><?php echo $title_text; ?></h1>
            </div>
        </div>

        <script>
        // Parallax Effect for Logo
        document.addEventListener("scroll", function() {
            const logo = document.getElementById("parallax-logo");
            const scrollPosition = window.scrollY;
            logo.style.transform = `translateY(${scrollPosition * -0.3}px)`; // Adjust parallax speed
        });
    </script>
        <?php
    }
    
}
