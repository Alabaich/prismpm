<?php

class Elementor_contactUsSection extends \Elementor\Widget_Base {

    public function get_name() {
        return 'contactUsSection';
    }

    public function get_title() {
        return __( 'Contact Us Section', 'elementor-addon' );
    }

    public function get_icon() {
        return 'eicon-mail';
    }

    public function get_categories() {
        return [ 'basic' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_settings',
            [
                'label' => __( 'Settings', 'elementor-addon' ),
            ]
        );

        $this->add_control(
            'is_first_section',
            [
                'label' => __( 'Is this the first section?', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'elementor-addon' ),
                'label_off' => __( 'No', 'elementor-addon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'textForButton',
            [
                'label' => __( 'Button Text', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Submit', 'elementor-addon' ),
                'placeholder' => __( 'Enter button text', 'elementor-addon' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Button Color', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
            ]
        );

        $this->add_control(
            'use_no_background',
            [
                'label' => __( 'Use No Background', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'elementor-addon' ),
                'label_off' => __( 'No', 'elementor-addon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'form_action_url',
            [
                'label' => __( 'Form Action URL', 'elementor-addon' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'elementor-addon' ),
                'default' => [
                    'url' => '',
                    'is_external' => false,
                    'nofollow' => false,
                ],
                'description' => __( 'Enter the URL where the form data should be sent. Leave blank to use default WordPress handling.', 'elementor-addon' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $first_class = ($settings['is_first_section'] === 'yes') ? 'first-contact-section' : '';
        $form_action = !empty($settings['form_action_url']['url']) ? esc_url($settings['form_action_url']['url']) : '';
        ?>
        <section class="contact-us-section elementor-contact-section <?= esc_attr($first_class) ?>">
            <div class="contact-container">
                <div class="left-column">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2869.582801139585!2d-78.85953908449699!3d43.89759627911457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d5025e39310767%3A0x3a643e7878579347!2s80%20Bond%20St%20E%2C%20Oshawa%2C%20ON%20L1G%200E6%2C%20Canada!5e0!3m2!1sen!2sus!4v1620310503001!5m2!1sen!2sus"
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                    <div class="contact-info">
                        <div><h6>Address</h6>80 Bond St E<br/>Oshawa ON L1G 0E6</div>
                        <div><h6>E-mail</h6>customercare@prismpm.ca<br/>lease@prismpm.ca</div>
                        <div><h6>Phone</h6>289-797-1604</div>
                    </div>
                </div>
                <div class="right-column">
                    <h2>Contact Us</h2>
                    <p>fill out the contact form and we`ll get back to you as soon as possible</p>
                    <form class="contact-form" action="<?php echo $form_action; ?>" method="post">
                        <input type="text" name="name" placeholder="Name" required>
                        <input type="text" name="phone" placeholder="Phone" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <textarea name="message" placeholder="Message" required></textarea>
                        <div class="submit-row">
                            <div class="buttonWrapperContact">
                                <button type="submit" class="btn">
                                    <?php echo esc_html($settings['textForButton'] ?: 'Submit'); ?>
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </button>
                            </div>
                            <small>By clicking the Contact us button you agree to our<br><a href="#">Privacy Policy terms</a></small>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <style>
            .buttonWrapperContact .btn {
                display: inline-flex;
                justify-content:center;
                gap: 0.75rem;
                border-radius: 9999px;
                background: #093D5F;
                padding: 0.75rem 1.75rem;
                font-size: 1rem;
                font-weight: 500;
                color:#FFFFFF;
                text-decoration: none;
                font-family: "Inter Tight", Sans-serif;
                border: none;
                cursor: pointer;
                transition: all 0.3s ease;
                border: 2px solid transparent;
            }

            .buttonWrapperContact .btn:hover {
                gap: 2rem;
                border-color:transparent>;
            }

            .buttonWrapperContact .btn svg {
                transition: all 0.3s ease;
                rotate: -45deg;
                width: 20px;
                height: 20px;
            }
            .contact-us-section {
                background: #fff;
                border-radius: 12px;
                padding: 2rem;
                background: #F4F4F499;
            }

            .contact-container {
                display: flex;
                gap: 2rem 7rem;
                flex-wrap: wrap;
                justify-content: center;
                max-width: 1568px;
                margin: 0 auto; 
            }

            .left-column {
                flex: 1;
                min-height: 400px;
                min-width: 300px;
                max-width: 700px;
            }
            .left-column iframe {
                border-radius: 8px; 
            }

            .contact-info {
                display: flex;
                justify-content: space-between;
                margin-top: 1rem;
                flex-wrap: wrap; 
            }

            .contact-info div {
                font-family: "Inter Tight", sans-serif; 
                font-size:1rem;
            }
            .contact-info h6 {
                font-family: "Playfair Display", serif; 
                font-size:1.125rem;
                margin:0;
            }

            .right-column {
                flex: 1;
                min-width: 300px;
                max-width: 450px;
            }

            .right-column h2 {
                font-size: 1.8rem;
                margin-bottom: 0.5rem;
                font-family: "Playfair Display", serif; 
                color: #333;
            }

            .right-column p {
                margin-bottom: 1.5rem;
                color: #555;
                font-family: "Inter Tight", sans-serif; 
            }

            .contact-form input,
            .contact-form textarea {
                width: 100%;
                padding: 0.75rem;
                margin-bottom: 1rem;
                border: 1px solid #ccc;
                border-radius: 8px;
                font-size: 0.9rem;
                box-sizing: border-box; 
                font-family: "Inter Tight", sans-serif;
            }

            .contact-form textarea {
                min-height: 100px;
                resize: vertical;
            }

            .submit-row {
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap; 
                gap: 1rem;
            }

            .submit-row small {
                font-size: 0.7rem;
                color: #888;
                flex-basis: 100%; 
                text-align: left; 
            }
            @media (min-width: 400px) { 
                .submit-row small {
                    flex-basis: auto;
                    text-align: right;
                }
            }

            .submit-row a {
                text-decoration: underline;
                color: #555;
            }
            .submit-row a:hover {
                color: #0e3c55;
            }

            .first-contact-section {
                margin-top: 120px;
            }

            @media (max-width: 767px) { 
                .contact-us-section {
                    margin: 2rem 1rem; 
                    padding: 1.5rem; 
                }
                .contact-container {
                    flex-direction: column; 
                    align-items: center;    
                    gap: 2rem;             
                }
                .left-column, .right-column {
                    width: 100%;          
                    min-width: unset;      
                    max-width: 500px;      
                    flex: none;            
                }
                .contact-info {
                    flex-direction: column;
                    text-align: center;
                    gap: 1rem;
                }
                .right-column h2, .right-column p {
                    text-align: center;
                }
                .first-contact-section {
                    margin-top: 40px;
                }
                .submit-row {
                    flex-direction: column;
                    align-items: stretch;
                }
                .submit-row button {
                    width: 100%;
                }
                .submit-row small {
                    text-align: center;
                    margin-top: 0.5rem;
                }
            }

            @media (min-width: 768px) and (max-width: 1024px) {
                .contact-us-section {
                }
                .contact-container {
                    flex-direction: column;
                    align-items: center; 
                    gap: 3rem; 
                }
                .left-column,
                .right-column {
                    width: 100%; 
                    flex-basis: auto;
                    flex: none; 
                    max-width: 700px; 
                }
                .contact-info {
                    justify-content: space-around;
                    gap: 1.5rem;
                }
            }
        </style>
        <?php
    }
}