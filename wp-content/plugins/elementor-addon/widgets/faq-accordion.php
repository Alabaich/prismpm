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
                'label' => esc_html__('FAQ Items', 'elementor-addon'),
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

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'question',
            [
                'label' => esc_html__('Question', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Enter your question', 'elementor-addon'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'answer',
            [
                'label' => esc_html__('Answer', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('Enter your answer here.', 'elementor-addon'),
            ]
        );

        $this->add_control(
            'faqs',
            [
                'label' => esc_html__('FAQ Items', 'elementor-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
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
                    [
                        'question' => 'How Do I Schedule A Viewing?',
                        'answer' => 'You can schedule a viewing by contacting our leasing office via phone or email.',
                    ],
                ],
                'title_field' => '{{{ question }}}',
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

    if (empty($settings['faqs'])) {
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
        <div class="faq-items">
            <?php foreach ($settings['faqs'] as $index => $faq) : ?>
                <div class="faq-item">
                    <div class="faq-item-header">
                        <span class="faq-item-number"><?php echo esc_html(sprintf('%02d', $index + 1)); ?></span>
                        <h3 class="faq-item-question"><?php echo esc_html($faq['question']); ?></h3>
                        <span class="faq-item-toggle">+</span>
                    </div>
                    <div class="faq-item-content" style="display: none;">
                        <div class="faq-item-answer"><?php echo wp_kses_post($faq['answer']); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
        <style>
            .faq-accordion.faq-first-page .qwdsadqwdasdas{
                display: none;
            }
            .faq-accordion.faq-first-page {
                padding-top: 180px;
            }

            .faq-accordion.faq-first-page h2 {
                max-width: 500px;
                text-align:center;
                margin:auto;
                font-size: 72px;
            }
            .qwdsa {
                display:flex;
                align-items:center;
                justify-content: space-between;
                padding-bottom:50px;
            }
            .faq-accordion {
                padding: 40px;
                padding-bottom:140px;
                font-family: sans-serif;
            }
            .faq-accordion h2 {
                font-size: 52px;
                font-weight: bold;
                margin:0;
            }
            .faq-item {
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                margin-bottom: 10px;
                background: #fff;
                overflow: hidden;
            }
            .faq-item-header {
                display: flex;
                align-items: center;
                padding: 15px;
                cursor: pointer;
            }
            .faq-item-number {
                font-size: 18px;
                font-weight: 400;
                margin-right: 18px;
                color: #2A2A2A;
                width: 30px;
            }
            .faq-item-question {
                flex: 1;
                font-size: 40px;
                font-weight: 600;
                margin: 0;
            }
            .faq-item-toggle {
                font-size: 20px;
                font-weight: bold;
                color: #000;
                width: 20px;
                text-align: center;
            }
            .faq-item-content {
                padding: 0 15px 15px;
                display: none;
            }
            .faq-item.active .faq-item-content {
                display: block;
            }
            .faq-item.active .faq-item-toggle {
                content: "−";
            }
            .faq-item-answer {
                font-size: 18px;
                margin-left:50px;
                line-height: 140%;
                color: #52525B;
            }
            .qwdsadqwdasdas {
                padding: 20px 58px;
                border: 1px solid #000;
                background: white;
                border-radius: 999px;
                cursor: pointer;
                transition: background 0.3s ease;

                color:#2A2A2A;
            }
            .qwdsadqwdasdas:hover {
                background:#0e3c55;
                color:white;
            }
        </style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const faqItems = document.querySelectorAll('.faq-item');

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
    });
</script>
        <?php
    }
}
?>