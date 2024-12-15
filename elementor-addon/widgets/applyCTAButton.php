<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Elementor_applyCTAButton extends \Elementor\Widget_Base {

    public function get_name() {
        return 'apply_cta_button';
    }

    public function get_title() {
        return esc_html__( 'Apply CTA Button', 'elementor-addon' );
    }

    public function get_icon() {
        return 'eicon-phone';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    public function get_keywords() {
        return [ 'apply', 'cta', 'button', 'phone' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Content', 'elementor-addon' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'phoneNumber',
            [
                'label'       => esc_html__( 'Phone Number', 'elementor-addon' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( '+1 234 567 890', 'elementor-addon' ),
                'default'     => '',
                'description' => esc_html__( 'Enter the phone number for the Apply button.', 'elementor-addon' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings    = $this->get_settings_for_display();
        $phoneNumber = ! empty( $settings['phoneNumber'] ) ? esc_attr( $settings['phoneNumber'] ) : '';

        // If no phone number provided, we can still show the button, or you can conditionally hide it.
        ?>
        <style>
            .apply-cta-button-wrapper {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 9999;
            }

            .apply-cta-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: #093D5F;
                color: #fff;
                padding: 12px 20px;
                border-radius: 30px;
                text-decoration: none;
                font-weight: 600;
                font-family: sans-serif;
                font-size: 16px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
                transition: background 0.3s ease;
            }

            .apply-cta-button:hover {
                background: #072C45; /* Slightly darker on hover */
            }

            .apply-cta-button i {
                margin-right: 8px;
            }
        </style>

        <div class="apply-cta-button-wrapper">
            <a 
                class="apply-cta-button" 
                href="<?php echo $phoneNumber ? 'tel:' . $phoneNumber : '#'; ?>"
                aria-label="Apply Now"
            >
                <i class="fas fa-phone"></i> Apply
            </a>
        </div>
        <?php
    }
}
