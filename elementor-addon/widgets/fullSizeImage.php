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
        $phone_image = esc_url( $settings['phone_image']['url'] );
        $logo_image = esc_url( $settings['logo_image']['url'] );
        $title_text = esc_html( $settings['title_text'] );
        ?>
        <style>
            .hero-banner {
                position: relative;
                width: 100%;
                height: 100vh;
                overflow: hidden;
            }
    
            .hero-banner img.hero-image {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
    
            .hero-banner .hero-text {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
                color: #fff;
            }
    
            .hero-banner .hero-text h1 {
                font-size: 3rem;
                font-weight: bold;
                margin: 0;
            }
    
            .hero-banner .hero-logo {
                max-width: 150px;
                margin: 0 auto 20px;
            }
        </style>
    
        <div class="hero-banner">
            <img 
                src="<?php echo $desktop_image; ?>" 
                srcset="<?php echo $phone_image; ?> 480w, 
                        <?php echo $tablet_image; ?> 768w, 
                        <?php echo $desktop_image; ?> 1200w" 
                sizes="(max-width: 480px) 100vw, 
                       (max-width: 768px) 100vw, 
                       100vw"
                alt="Hero Image" 
                class="hero-image">
            <div class="hero-text">
                <img src="<?php echo $logo_image; ?>" alt="Logo" class="hero-logo">
                <h1><?php echo $title_text; ?></h1>
            </div>
        </div>
        <?php
    }
    
}
