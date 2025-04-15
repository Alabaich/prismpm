<?php

class Elementor_ndSection extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ndSection';
    }

    public function get_title() {
        return esc_html__( 'ndSection', 'elementor-addon' );
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'elementor-addon' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Left Image', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'big_number',
            [
                'label' => esc_html__( 'Big Number', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '40',
            ]
        );

        $this->add_control(
            'text_right',
            [
                'label' => esc_html__( 'Text on Right', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Years Of Excellence, Managing Properties One Building At A Time',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
<style>
    .years-section {
        display: flex;
        flex-wrap: wrap;
        align-items: stretch;
        justify-content: space-between;
    }

    .years-section .left {
        max-width: 50%;
        flex: 1;
    }

    .years-section .right {
        max-width: 50%;
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-family: "Darker Grotesque", sans-serif;
        padding: 40px;
    }

    .years-section .right .big-number {
        font-family: "ES Rebond Grotesque TRIAL", sans-serif;
        font-size: 460px;
        color: #d3dde5;
        font-weight: 500;
        line-height: 106%;
        position: relative;
    }

    .years-section .right .text {
        position: absolute;
                top: 40%;
                left: 50%;
        font-size: 52px;
        font-weight: 600;
        color: #000;
        text-align: center;
        line-height: 92%;
        max-width: 80%;
        z-index: 666;
    }

    @media (max-width: 1024px) {
        .years-section {
            flex-direction: column;
        }
        .years-section .left,
        .years-section .right {
            max-width: 100%;
        }
        .years-section .right {
            padding: 20px;
        }
        .years-section .right .big-number {
            font-size: 160px;
        }
        .years-section .right .text {
            margin-top: -60px;
            font-size: 36px;
        }
    }

    @media (max-width: 768px) {
        .years-section .right .big-number {
            font-size: 100px;
        }
        .years-section .right .text {
            margin-top: -40px;
            font-size: 24px;
        }
    }
</style>

        <div class="years-section">
            <div class="left">
                <?php echo wp_get_attachment_image( $settings['image']['id'], 'full' ); ?>
            </div>
            <div class="right">
                <div class="big-number"><?php echo esc_html( $settings['big_number'] ); ?></div>
                <div class="text"><?php echo esc_html( $settings['text_right'] ); ?></div>
            </div>
        </div>
        <?php
    }
}
