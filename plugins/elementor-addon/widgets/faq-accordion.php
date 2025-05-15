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
                'label' => esc_html__('Is First Page?', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => 'Yes',
                'label_off' => 'No',
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        // Repeater для категорий
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

        // Repeater для вопросов внутри категории
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
            'toggle_all_text',
            [
                'label' => esc_html__('Toggle All Button Text', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Show More', 'elementor-addon'),
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
        $first_page_class = $is_first_page ? 'faq-first-page' : '';
        ?>
        <div class="faq-accordion <?php echo esc_attr($first_page_class); ?>">
            <div class="qwdsa">
                <h2>Frequently Asked Questions</h2>
                <?php if (!empty($settings['toggle_all_text'])) : ?>
                    <button class="qwdsadqwdasdas"><?php echo esc_html($settings['toggle_all_text']); ?></button>
                <?php endif; ?>
            </div>

            <?php foreach ($settings['faq_categories'] as $cat_index => $category) : ?>
                <div class="faq-category">
                    <h3 class="faq-category-title"><?php echo esc_html($category['category_title']); ?></h3>
                    <div class="faq-items">
                        <?php foreach ($category['questions'] as $index => $faq) : ?>
                            <div class="faq-item">
                                <div class="faq-item-header">
                                    <span class="faq-item-number"><?php echo esc_html(sprintf('%02d', $index + 1)); ?></span>
                                    <h4 class="faq-item-question"><?php echo esc_html($faq['question']); ?></h4>
                                    <span class="faq-item-toggle">+</span>
                                </div>
                                <div class="faq-item-content" style="display: none;">
                                    <div class="faq-item-answer"><?php echo wp_kses_post($faq['answer']); ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <style>
    .faq-accordion.faq-first-page .qwdsadqwdasdas {
        display: none;
    }
    .faq-accordion.faq-first-page {
        padding-top: 11.25rem; /* 180px */
    }
    .faq-accordion.faq-first-page h2 {
        max-width: 31.25rem; /* 500px */
                font-family: "Darker Grotesque", serif;

        text-align: center;
        margin: auto;
        font-size: 4.5rem; /* 72px */
    }
    .qwdsa {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 3.125rem; /* 50px */
    }
    .faq-accordion {
        padding: 2.5rem; /* 40px */
        padding-left: 0;
        padding-right: 0;
        padding-bottom: 8.75rem; /* 140px */
    }
    .faq-accordion h2 {
        font-size: 3.25rem; /* 52px */
                font-family: "Darker Grotesque", serif;
                color:#2A2A2A;
        font-weight: bold;
        margin: 0;
    }
    .faq-category {
        margin-bottom: 2.5rem; /* 40px */
    }
    .faq-category-title {
        font-size: 2rem; /* 40px */
                font-family: "Darker Grotesque", serif;


        font-weight: 500;
        color: #2A2A2A;
        margin-bottom: 1.25rem; /* 20px */
        text-transform: uppercase;
    }
    .faq-item {
        border: 0.0625rem solid #e0e0e0; /* 1px */
        border-radius: 0.5rem; /* 8px */
        margin-bottom: 0.625rem; /* 10px */
        background: #fff;
        overflow: hidden;
    }
    .faq-item-header {
        display: flex;
        align-items: center;
        padding: 0.9375rem; /* 15px */
        cursor: pointer;
    }
    .faq-item-number {
        font-size: 1.125rem; /* 18px */
        font-weight: 400;
        margin-right: 1.125rem; /* 18px */
        color: #2A2A2A;
        width: 1.875rem; /* 30px */
    }
    .faq-item-question {
                font-family: "Darker Grotesque", serif;
                color:#2A2A2A;


        flex: 1;
        font-size: 1.5rem; /* 32px */
        font-weight: 5;
        margin: 0;
        color: #2A2A2A;
    }
    .faq-item-toggle {
        font-size: 1.25rem; /* 20px */
        font-weight: bold;
        color: #000;
        width: 1.25rem; /* 20px */
        text-align: center;
    }
    .faq-item-content {
        padding: 0 0.9375rem 0.9375rem; /* 0 15px 15px */
        display: none;
    }
    .faq-item.active .faq-item-content {
        display: block;
    }
    .faq-item.active .faq-item-toggle {
        content: "−";
    }
    .faq-item-answer {
        font-size: 1.125rem; /* 18px */
        margin-left: 3.125rem; /* 50px */
        line-height: 140%;
  font-family: "Inter Tight", sans-serif;

        color: #52525B;
    }
    .qwdsadqwdasdas {
        padding: 1.25rem 3.625rem; /* 20px 58px */
        border: 0.0625rem solid #000; /* 1px */
        background: white;
        border-radius: 62.4375rem; /* 999px */
        cursor: pointer;
        transition: background 0.3s ease;
        color: #2A2A2A;
    }
    .qwdsadqwdasdas:hover {
        background: #0e3c55;
        color: white;
    }
    @media (max-width: 768px) {
        .qwdsadqwdasdas {
            display:none;
        }
        .faq-accordion h2 {
            font-size:32px;
        }
        .qwdsa {
            text-align:center;
            justify-content:center;
            padding-bottom:1.5rem;
        }
        .faq-category-title {
            font-size:24px;
        }
        .faq-item-question {
            font-size:22px;
        }
        .faq-accordion.faq-first-page h2 {
            font-size:32px;
        }
    }

</style>


        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const faqItems = document.querySelectorAll('.faq-item');
                const toggleAllBtn = document.querySelector('.qwdsadqwdasdas');

                faqItems.forEach(item => {
                    const header = item.querySelector('.faq-item-header');
                    const content = item.querySelector('.faq-item-content');
                    const toggle = item.querySelector('.faq-item-toggle');

                    header.addEventListener('click', () => {
                        const isActive = item.classList.contains('active');
                        if (isActive) {
                            item.classList.remove('active');
                            content.style.display = 'none';
                            toggle.textContent = '+';
                        } else {
                            item.classList.add('active');
                            content.style.display = 'block';
                            toggle.textContent = '−';
                        }
                    });
                });

                if (toggleAllBtn) {
                    toggleAllBtn.addEventListener('click', function () {
                        const anyActive = document.querySelector('.faq-item.active');
                        if (anyActive) {
                            faqItems.forEach(item => {
                                item.classList.remove('active');
                                item.querySelector('.faq-item-content').style.display = 'none';
                                item.querySelector('.faq-item-toggle').textContent = '+';
                            });
                        } else {
                            faqItems.forEach(item => {
                                item.classList.add('active');
                                item.querySelector('.faq-item-content').style.display = 'block';
                                item.querySelector('.faq-item-toggle').textContent = '−';
                            });
                        }
                    });
                }
            });
        </script>
        <?php
    }
}
?>