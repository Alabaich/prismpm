<?php

class Elementor_socialSection extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'socialSection';
    }

    public function get_title()
    {
        return esc_html__('Social Section', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-social-icons';
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
                'label' => esc_html__('Content', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => esc_html__('Main Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Follow Us On Social Media',
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'label',
            [
                'label' => esc_html__('Label', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'George Street Lofts:',
            ]
        );

        $repeater->add_control(
            'facebook',
            [
                'label' => esc_html__('Facebook Handle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '@georgestreetlofts',
            ]
        );

        $repeater->add_control(
            'instagram',
            [
                'label' => esc_html__('Instagram Handle', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '@georgestreetlofts',
            ]
        );

        $repeater->add_control(
            'icon_set',
            [
                'label' => esc_html__('Icon Set (optional)', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->add_control(
            'socials',
            [
                'label' => esc_html__('Social Blocks', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
            ]
        );

        $this->add_control(
            'bottom_image',
            [
                'label' => esc_html__('Bottom Image', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>

        <style>
            .social-follow-section {
                padding: 4rem 0rem;
                text-align: center;
                overflow-x: hidden;
            }

            .social-follow-section h1 {
                font-size: 52px;
                margin-bottom: 0.75rem;
                font-weight: 600;
                color: #111827;
            }

            .social-follow-section .subtitle {
                color: #6B7280;
                font-size: 1rem;
                max-width: 420px;
                margin: 0 auto 2rem;
                line-height: 1.6;
            }

            .social-follow-rows {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 2rem;
            }

            .social-block {
                background: #fff;
                gap: 1.25rem;
                border-radius: 0.5rem;
                transition: all 0.3s ease;
                padding-bottom:50px;
                display:flex;
                flex-direction:column;
            }

            .social-block span {
                display: block;
                font-weight: 400;
                font-size: 1rem;
  font-family: "Inter Tight", sans-serif;

                color: #52525B;
                margin-bottom: 1.25rem;
                text-align: left;
            }

            .social-block p {
  font-family: "Inter Tight", sans-serif;
  display:flex;
  justify-items:baseline;
                align-items:center;
                color: #374151;
                margin:0px;
                display: flex;
                align-items: center;
                font-size: 1.125rem;
                gap: 1rem;
            }

            .social-block i {
                font-size: 2rem;
                color: #000;
            }

            .bottom-social-image img {
                width: 100%;
                object-fit: fit-content;
                height: auto;
                border-radius: 0.5rem;
                display: block;
                image-rendering: auto;
                transition: filter 0.3s;
            }

            .bottom-social-image img:hover {
                filter: brightness(1.05);
            }


            .qwedas {
                display:flex;
                align-items:baseline;
                flex-direction:column;
            
            }
            @media (max-width: 768px) {
                .social-follow-section {
                    padding: 2rem 1rem;
                }

                .social-follow-section h1 {
                    font-family: 'Darker Grotesque', sans-serif;
                    font-weight: 600;
                    font-size: 28px;
                    line-height: 90%;
                    letter-spacing: 0%;
                    text-align: center;
                    vertical-align: middle;
                    color: #2a2a2a;
                }

                .social-follow-section .subtitle {
                    max-width: 100%;
                    font-size: 1rem;
                }

                .social-follow-rows {
                    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
                    gap: 0rem;
                    margin-bottom: 1rem;
                }

                .social-block {
                    padding: 1rem;
                    border-radius: 0.5rem;
                }

                .social-block span {
                    font-size: 1rem;
                    font-weight: 600;
                    margin-bottom: 0.25rem;
                    color: #111827;
                }

                .social-block p {
                    font-size: 0.95rem;
                    color: #374151;
                    margin: 0.2rem 0;
                    display: flex;
                    align-items: center;
                    gap: 0.4rem;
                }

                .social-block i {
                    color: #000;
                    font-size: 1rem;
                }

                .bottom-social-image img {
                    border-radius: 0.5rem;
                    width: 100%;
                    height: 200px;
                    object-fit: cover;
                }
            }
        </style>


        <div class="social-follow-section">
            <h1><?php echo esc_html($settings['main_title']); ?></h1>
            <p class="subtitle interTight"><?php echo esc_html($settings['subtitle']); ?></p>

            <div class="social-follow-rows">
                <?php foreach ($settings['socials'] as $social): ?>
                    <div class="social-block">
                        <span><?php echo esc_html($social['label']); ?></span>
                        <div class='qwedas'>
                            
                        <?php if (!empty($social['facebook'])): ?>
                            <p><i class="fab fa-facebook"></i> <?php echo esc_html($social['facebook']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($social['instagram'])): ?>
                            <p><i class="fab fa-instagram"></i> <?php echo esc_html($social['instagram']); ?></p>
                        <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


            <?php if (!empty($settings['bottom_image']['url'])): ?>
                <div class="bottom-social-image">
                    <img src="<?php echo esc_url($settings['bottom_image']['url']); ?>" alt="Social Media Image" loading="lazy">
                </div>
            <?php endif; ?>
        </div>



<?php
    }
}
