<?php

class Elementor_contactUsSection extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'contactUsSection';
    }

    public function get_title()
    {
        return __('Contact Us Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-mail';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_settings',
            [
                'label' => __('Settings', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'is_first_section',
            [
                'label' => __('Is this the first section?', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'elementor-addon'),
                'label_off' => __('No', 'elementor-addon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'form_shortcode',
            [
                'label' => esc_html__('WPForms Shortcode', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => '[wpforms id="123"]',
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $first_class = ($settings['is_first_section'] === 'yes') ? 'first-contact-section' : '';
        ?>

        <style>
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
                font-size: 0.9rem;
                flex-wrap: wrap;
                gap: 1rem;
            }

            .contact-info div {
                flex: 1 1 150px;
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

            .submit-row button {
                background: #0e3c55;
                color: #fff;
                border: none;
                border-radius: 999px;
                padding: 0.75rem 1.5rem;
                font-weight: 500;
                cursor: pointer;
                transition: background-color 0.3s ease;
                font-family: "Inter Tight", sans-serif;
            }

            .submit-row button:hover {
                background: #072738;
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

                .left-column,
                .right-column {
                    width: 100%;
                    min-width: unset;
                    max-width: 500px;
                    flex: none;
                }

                .contact-info {
                    flex-direction: column;
                    text-align: center;
                    gap: 1.5rem;
                }

                .right-column h2,
                .right-column p {
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

            .submit-row button {
                background: #0e3c55;
                color: #fff;
                border: 2px solid #0e3c55;
                padding: 12px 30px;
                border-radius: 30px;
                cursor: pointer;
                font-weight: 600;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                gap: 8px;
                font-family: "Inter Tight", sans-serif;
                font-size: 1rem;
            }

            .submit-row button:hover {
                background: white;
                color: #0e3c55;
            }

            .submit-row button:hover svg {
                fill: #0e3c55;
            }

            @media (max-width: 767px) {
                .submit-row button {
                    width: 100%;
                    justify-content: center;
                }
            }
        </style>


        <section class="contact-us-section elementor-contact-section <?= esc_attr($first_class) ?>">
            <div class="contact-container">
                <div class="left-column">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2869.582801139585!2d-78.85953908449699!3d43.89759627911457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d5025e39310767%3A0x3a643e7878579347!2s80%20Bond%20St%20E%2C%20Oshawa%2C%20ON%20L1G%200E6%2C%20Canada!5e0!3m2!1sen!2sus!4v1620310503001!5m2!1sen!2sus"
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>


                    <div class="contact-info">
                        <div><strong>Address</strong><br>80 Bond St E<br>Oshawa ON L1G 0E6</div>
                        <div><strong>E-mail</strong><br>customercare@prismpm.ca<br>lease@prismpm.ca</div>
                        <div><strong>Phone</strong><br>289-797-1604</div>
                    </div>
                </div>
                <div class="right-column">
                    <?php if (!empty($settings['form_shortcode'])): ?>
                        <div class="form-wrapper">
                            <?php echo do_shortcode($settings['form_shortcode']); ?>
                        </div>
                    <?php endif; ?>
                    <h2>Contact Us</h2>
                    <p>fill out the contact form and we`ll get back to you as soon as possible</p>
                    <form class="contact-form">
                        <input type="text" name="name" placeholder="Name" required>
                        <input type="text" name="phone" placeholder="Phone" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <textarea name="message" placeholder="Message" required></textarea>
                        <div class="submit-row">
                            <button type="submit">
                                Submit
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M14.167 5C14.627 5.00018 14.9998 5.37303 15 5.83301V14.167C14.9998 14.627 14.627 14.9998 14.167 15C13.7069 15 13.3332 14.6271 13.333 14.167V7.7832L6.42285 14.7559C6.09741 15.0813 5.56958 15.0813 5.24414 14.7559C4.9187 14.4304 4.9187 13.9026 5.24414 13.5771L12.0938 6.66699H5.83301C5.37292 6.66682 5 6.29314 5 5.83301C5.00018 5.37303 5.37303 5.00018 5.83301 5H14.167Z"
                                        fill="currentColor" />
                                </svg>
                            </button>
                            <small>By clicking the Contact us button you agree to our<br><a href="#">Privacy Policy
                                    terms</a></small>
                        </div>
                    </form>
                </div>
            </div>
        </section>


        <?php
    }
}
