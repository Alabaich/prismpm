<?php

class Elementor_faqAccordion extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'faq-accordion';
    }

    public function get_title()
    {
        return esc_html__('FAQ Accordion', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-accordion';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'faq_section',
            [
                'label' => esc_html__('FAQ Categories', 'elementor-addon'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'is_first_page',
            [
                'label' => esc_html__('Is First Page Hero Section?', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'Yes',
                'label_off' => 'No',
                'return_value' => 'yes',
                'default' => 'no',
                'description' => esc_html__('If yes, the title will be larger and centered, and the "Show More" button will be hidden.', 'elementor-addon'),
            ]
        );

        $category_repeater = new \Elementor\Repeater();

        $category_repeater->add_control(
            'category_title',
            [
                'label' => esc_html__('Category Title', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Category Title', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $question_repeater = new \Elementor\Repeater();

        $question_repeater->add_control(
            'question',
            [
                'label' => esc_html__('Question', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Enter your question', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $question_repeater->add_control(
            'answer',
            [
                'label' => esc_html__('Answer', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Enter your answer here.', 'elementor-addon'),
            ]
        );

        $category_repeater->add_control(
            'questions',
            [
                'label' => esc_html__('Questions', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $question_repeater->get_controls(),
                'default' => [
                    [
                        'question' => 'How Can I Apply For An Apartment?',
                        'answer' => 'With 370 beautiful suites and a wide range of amenities, 80 Bond has fast become the premier address in downtown Oshawa.',
                    ],
                    [
                        'question' => 'Are Pets Allowed?',
                        'answer' => 'Yes, pets are allowed under certain conditions.',
                    ],
                ],
                'title_field' => '{{{ question }}}',
            ]
        );

        $this->add_control(
            'faq_categories',
            [
                'label' => esc_html__('FAQ Categories', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $category_repeater->get_controls(),
                'default' => [
                    [
                        'category_title' => 'Questions About Moving',
                        'questions' => [
                            [
                                'question' => 'How Can I Apply For An Apartment?',
                                'answer' => 'With 370 beautiful suites and a wide range of amenities, 80 Bond has fast become the premier address in downtown Oshawa.',
                            ],
                            [
                                'question' => 'Are Pets Allowed?',
                                'answer' => 'Yes, pets are allowed under certain conditions.',
                            ],
                            [
                                'question' => 'What Utilities Are Included In The Rent?',
                                'answer' => 'Utilities such as water and heat are included. Electricity is separately metered.',
                            ],
                            [
                                'question' => 'Is Parking Available?',
                                'answer' => 'Yes, parking is available for residents at an additional cost.',
                            ],
                        ],
                    ],
                    [
                        'category_title' => 'Questions About Cook Old\'s',
                        'questions' => [
                            [
                                'question' => 'How Do I Schedule A Viewing?',
                                'answer' => 'You can schedule a viewing by contacting our leasing office via phone or email.',
                            ],
                            [
                                'question' => 'What Is The Minimum Lease Term?',
                                'answer' => 'The minimum lease term is typically 12 months.',
                            ],
                            [
                                'question' => 'Are The Buildings Accessible?',
                                'answer' => 'Yes, our buildings are designed to be accessible.',
                            ],
                            [
                                'question' => 'How Do I Know Which Units Are Currently Available?',
                                'answer' => 'You can check availability on our website or contact our leasing office.',
                            ],
                        ],
                    ],
                ],
                'title_field' => '{{{ category_title }}}',
            ]
        );
        $this->add_control(
            'url',
            [
                'label' => esc_html__('Button URL', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__('https://your-link.com', 'elementor-addon'),
                'condition' => [
                    'is_first_page!' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'toggle_all_text',
            [
                'label' => esc_html__('Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Show More', 'elementor-addon'),
                'condition' => [
                    'is_first_page!' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['faq_categories'])) {
            return;
        }

        $is_first_page = $settings['is_first_page'] === 'yes';
        $first_page_class = $is_first_page ? 'faq-is-first-page' : '';
        $this->add_render_attribute('wrapper', 'class', ['faq-accordion-widget', $first_page_class]);

?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div class="faq-main-header">
                <h2><?php echo esc_html__('Frequently Asked Questions', 'elementor-addon'); ?></h2>
                <?php if (!$is_first_page && !empty($settings['toggle_all_text']) && !empty($settings['url'])) : ?>
                    <div class="faq-view-all-button-wrapper">
                        <a class="faq-view-all-button btn" href="<?php echo esc_url($settings['url']); ?>">
                            <?php echo esc_html($settings['toggle_all_text']); ?>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="faq-button-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <?php foreach ($settings['faq_categories'] as $cat_index => $category) : ?>
                <div class="faq-category">
                    <?php if (!empty($category['category_title'])) : ?>
                        <h3 class="faq-category-title"><?php echo esc_html($category['category_title']); ?></h3>
                    <?php endif; ?>
                    <div class="faq-items">
                        <?php foreach ($category['questions'] as $index => $faq) :
                            $item_id = 'faq-item-' . $this->get_id() . '-' . $cat_index . '-' . $index;
                            $header_id = 'faq-header-' . $this->get_id() . '-' . $cat_index . '-' . $index;
                        ?>
                            <div class="faq-item">
                                <div class="faq-item-header" role="button" tabindex="0" aria-expanded="false" aria-controls="<?php echo esc_attr($item_id); ?>" id="<?php echo esc_attr($header_id); ?>">
                                    <span class="faq-item-number"><?php echo esc_html(sprintf('%02d', $index + 1)); ?></span>
                                    <h4 class="faq-item-question"><?php echo esc_html($faq['question']); ?></h4>
                                    <span class="faq-item-toggle-icon">
                                        <svg class="icon-plus" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        <svg class="icon-minus" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </span>
                                </div>
                                <div class="faq-item-content" role="region" aria-labelledby="<?php echo esc_attr($header_id); ?>" id="<?php echo esc_attr($item_id); ?>">
                                    <div class="faq-item-answer"><?php echo wp_kses_post($faq['answer']); ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <style>
            .faq-accordion-widget {
                padding: 80px 0px;
                font-family: "Inter Tight", sans-serif;
            }

            .faq-main-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 2.5rem;
            }

            .faq-accordion-widget h2 {
                font-size: 2.75rem;
                font-family: "Playfair Display", serif;
                color: #2A2A2A;
                font-weight: 700;
                margin: 0;
            }

            .faq-accordion-widget.faq-is-first-page {
                padding-top: 4rem;
                padding-bottom: 4rem;
            }

            .faq-accordion-widget.faq-is-first-page .faq-main-header {
                justify-content: center;
                margin-bottom: 3rem;
            }

            .faq-accordion-widget.faq-is-first-page .faq-main-header h2 {
                font-size: 3.5rem;
                text-align: center;
                max-width: 1000px;
                margin-left: auto;
                margin-right: auto;
            }

            .faq-accordion-widget.faq-is-first-page .faq-view-all-button-wrapper {
                display: none;
            }

            .faq-view-all-button-wrapper .faq-view-all-button {
                display: inline-flex;
                align-items: center;
                gap: 0.6rem;
                border-radius: 50px;
                background: #FFFFFF;
                padding: 0.75rem 1.5rem;
                font-size: 1rem;
                font-weight: 500;
                color: #2A2A2A;
                text-decoration: none;
                font-family: "Inter Tight", Sans-serif;
                cursor: pointer;
                transition: all 0.3s ease;
                border: 1px solid #2A2A2A;
            }

            .faq-view-all-button-wrapper .faq-view-all-button:hover {
                background: #FFFFFF;
                color: #2A2A2A;
                border-color: #2A2A2A;
                gap:0 2rem;
            }

            .faq-button-icon {
                transition: all 0.3s ease;
                rotate: -45deg;
                width: 20px;
                height: 20px;
            }

            .faq-category {
                margin-bottom: 2.5rem;
            }

            .faq-category:last-child {
                margin-bottom: 0;
            }

            .faq-category-title {
                font-size: 1.75rem;
                font-family: "Playfair Display", serif;
                font-weight: 600;
                color: #333;
                margin-bottom: 1rem;
                padding-bottom: 0.5rem;
                border-bottom: 1px solid #eee;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .faq-item {
                border: 1px solid #e0e0e0;
                border-radius: 6px;
                margin-bottom: 0.75rem;
                background: #fff;
                overflow: hidden;
                transition: box-shadow 0.3s ease;
            }

            .faq-item:hover {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            }

            .faq-item-header {
                display: flex;
                align-items: center;
                padding: 1rem;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .faq-item-number {
                font-size: 1rem;
                font-weight: 500;
                margin-right: 1rem;
                color: #093D5F;
                width: auto;
                flex-shrink: 0;
            }

            .faq-item-question {
                font-family: "Darker Grotesque", serif;
                color: #2A2A2A;
                flex: 1;
                font-size: 1.25rem;
                font-weight: 500;
                margin: 0;
                line-height: 1.4;
            }

            .faq-item-toggle-icon {
                margin-left: 1rem;
                color: #2A2A2A;
                width: 20px;
                height: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: transform 0.3s ease-out;
            }

            .faq-item-toggle-icon .icon-minus {
                display: none;
            }

            .faq-item.active .faq-item-toggle-icon .icon-plus {
                display: none;
            }

            .faq-item.active .faq-item-toggle-icon .icon-minus {
                display: block;
            }

            .faq-item.active .faq-item-header {
                background-color: #f7f9fa;
            }

            .faq-item-content {
                max-height: 0;
                opacity: 0;
                overflow: hidden;
                transition: max-height 0.5s ease-in-out, opacity 0.5s ease-in-out, padding 0.5s ease-in-out;
                background: #f7f9fa;
            }

            .faq-item.active .faq-item-content {
                max-height: 1000px;
                opacity: 1;
                padding: 0.5rem 1rem 1rem;
            }

            .faq-item-answer {
                font-size: 1rem;
                margin-left: 2.25rem;
                line-height: 1.6;
                font-family: "Inter Tight", sans-serif;
                color: #52525B;
            }

            .faq-item-answer p:first-child {
                margin-top: 0;
            }

            .faq-item-answer p:last-child {
                margin-bottom: 0;
            }

            @media (max-width: 1024px) {
                .faq-accordion-widget h2 {
                    font-size: 2.25rem;
                }

                .faq-accordion-widget.faq-is-first-page .faq-main-header h2 {
                    font-size: 3rem;
                }

                .faq-category-title {
                    font-size: 1.5rem;
                }

                .faq-item-question {
                    font-size: 1.15rem;
                }

                .faq-item-answer {
                    font-size: 0.95rem;
                }

                .faq-view-all-button-wrapper .faq-view-all-button {
                    padding: 0.6rem 1.2rem;
                    font-size: 0.9rem;
                }
            }

            @media (min-width: 768px) and (max-width: 1024px) {
                .faq-accordion-widget {
                padding: 40px 0px;
                }
            }

            @media (max-width: 767px) {
                .faq-accordion-widget h2 {
                    font-size: 2rem;
                }

                .faq-accordion-widget.faq-is-first-page .faq-main-header h2 {
                    font-size: 2.5rem;
                }

                .faq-main-header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 1rem;
                }

                .faq-view-all-button-wrapper {
                    align-self: flex-start;
                }

                .faq-category-title {
                    font-size: 1.35rem;
                }

                .faq-item-question {
                    font-size: 1.1rem;
                }

                .faq-item-answer {
                    font-size: 0.9rem;
                    margin-left: 0;
                    padding-left: 1rem;
                }

                .faq-item-header {
                    padding: 0.85rem;
                }

                .faq-item-number {
                    margin-right: 0.85rem;
                }

                .faq-accordion-widget {
                padding: 20px 0px;

                }
            }

            @media (max-width: 480px) {
                .faq-accordion-widget h2 {
                    font-size: 1.75rem;
                }

                .faq-accordion-widget.faq-is-first-page .faq-main-header h2 {
                    font-size: 2rem;
                }

                .faq-category-title {
                    font-size: 1.2rem;
                }

                .faq-item-question {
                    font-size: 1rem;
                }

                .faq-item-answer {
                    font-size: 0.85rem;
                }

                .faq-view-all-button-wrapper .faq-view-all-button {
                    padding: 0.5rem 1rem;
                    font-size: 0.85rem;
                    justify-content: center;
                }

                .faq-main-header {
                    align-items: center;
                }

                .faq-view-all-button-wrapper {
                    display:flex;
                    justify-content:center;
                    width: 100%;
                }
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const faqAccordions = document.querySelectorAll('.faq-accordion-widget');

                faqAccordions.forEach(accordion => {
                    const faqItems = accordion.querySelectorAll('.faq-item');

                    faqItems.forEach(item => {
                        const header = item.querySelector('.faq-item-header');
                        const content = item.querySelector('.faq-item-content');

                        if (!header || !content) return;

                        header.addEventListener('click', () => {
                            const isActive = item.classList.contains('active');
                            if (isActive) {
                                item.classList.remove('active');
                                header.setAttribute('aria-expanded', 'false');
                            } else {
                                item.classList.add('active');
                                header.setAttribute('aria-expanded', 'true');
                            }
                        });

                        header.addEventListener('keydown', function(event) {
                            if (event.key === 'Enter' || event.key === ' ') {
                                event.preventDefault();
                                header.click();
                            }
                        });
                    });
                });
            });
        </script>
<?php
    }
}
